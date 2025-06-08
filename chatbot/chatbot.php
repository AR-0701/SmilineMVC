<?php
require '../vendor/autoload.php';
session_start();

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->chat;
    $preguntasCollection = $db->preguntas;
    $interaccionesCollection = $db->interacciones;
    $preguntasNuevasCollection = $db->preguntas_nuevas;

    $preguntaUsuario = trim($_POST["pregunta"]);
    $usuarioId = session_id();

    // 1. Búsqueda exacta (insensible a mayúsculas)
    $exactMatch = $preguntasCollection->findOne([
        'pregunta' => new MongoDB\BSON\Regex('^' . preg_quote($preguntaUsuario) . '$', 'i')
    ]);

    if ($exactMatch) {
        registrarInteraccion($interaccionesCollection, $usuarioId, $preguntaUsuario, $exactMatch['_id'], 100);
        actualizarEstadisticas($preguntasCollection, $exactMatch['_id']);
        
        echo json_encode([
            "respuesta" => $exactMatch['respuesta'],
            "categoria" => $exactMatch['categoria'],
            "confianza" => 100
        ]);
        exit;
    }

    // 2. Búsqueda por similitud usando agregación
    $pipeline = [
        ['$addFields' => [
            'similitud' => [
                '$function' => [
                    'body' => 'function(preguntaDB, preguntaInput) {
                        const wordsDB = preguntaDB.toLowerCase().split(/\\s+/);
                        const wordsInput = preguntaInput.toLowerCase().split(/\\s+/);
                        const matches = wordsInput.filter(w => wordsDB.includes(w));
                        return (matches.length / wordsInput.length) * 100;
                    }',
                    'args' => ['$pregunta', $preguntaUsuario],
                    'lang' => 'js'
                ]
            ]
        ]],
        ['$match' => ['similitud' => ['$gte' => 50]]],
        ['$sort' => ['similitud' => -1]],
        ['$limit' => 3]
    ];

    $resultados = $preguntasCollection->aggregate($pipeline)->toArray();

    if (!empty($resultados)) {
        $mejorResultado = $resultados[0];
        registrarInteraccion($interaccionesCollection, $usuarioId, $preguntaUsuario, $mejorResultado['_id'], $mejorResultado['similitud']);
        actualizarEstadisticas($preguntasCollection, $mejorResultado['_id']);
        
        echo json_encode([
            "respuesta" => $mejorResultado['respuesta'],
            "categoria" => $mejorResultado['categoria'],
            "confianza" => round($mejorResultado['similitud'], 2)
        ]);
    } else {
        guardarPreguntaDesconocida($preguntasNuevasCollection, $usuarioId, $preguntaUsuario);
        $respuestaGenerica = generarRespuestaInteligente($preguntaUsuario);
        
        echo json_encode([
            "respuesta" => $respuestaGenerica,
            "categoria" => "desconocida",
            "confianza" => 0
        ]);
    }

} catch (MongoDB\Driver\Exception\Exception $e) {
    echo json_encode(["respuesta" => "Lo siento, estoy teniendo problemas técnicos. Por favor intenta más tarde.", "categoria" => "error"]);
}

function registrarInteraccion($collection, $usuarioId, $pregunta, $respuestaId, $confianza) {
    $collection->insertOne([
        'usuario_id' => $usuarioId,
        'pregunta' => $pregunta,
        'respuesta_id' => $respuestaId,
        'confianza' => $confianza,
        'fecha' => new MongoDB\BSON\UTCDateTime(),
        'dispositivo' => detectarDispositivo(),
        'metadata' => [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]
    ]);
}

function actualizarEstadisticas($collection, $preguntaId) {
    $collection->updateOne(
        ['_id' => $preguntaId],
        [
            '$inc' => ['stats.veces_consultada' => 1],
            '$set' => ['stats.ultima_consulta' => new MongoDB\BSON\UTCDateTime()]
        ]
    );
}

function guardarPreguntaDesconocida($collection, $usuarioId, $pregunta) {
    $collection->insertOne([
        'usuario_id' => $usuarioId,
        'pregunta' => $pregunta,
        'fecha' => new MongoDB\BSON\UTCDateTime(),
        'procesada' => false,
        'metadata' => [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]
    ]);
}

function generarRespuestaInteligente($pregunta) {
    $preguntaLower = strtolower($pregunta);
    
    if (strpos($preguntaLower, 'emergencia') !== false) {
        return "🚑 Para emergencias dentales, llama inmediatamente al 555-7890. Estamos disponibles 24/7 para ayudarte.";
    } elseif (strpos($preguntaLower, 'horario') !== false || strpos($preguntaLower, 'hora') !== false) {
        return "🕒 Nuestro horario de atención es de lunes a viernes de 9:00 am a 6:00 pm y sábados de 9:00 am a 1:00 pm.";
    } elseif (strpos($preguntaLower, 'precio') !== false || strpos($preguntaLower, 'costo') !== false) {
        return "💵 Los precios varían según el tratamiento. Comunícate al 555-1234 para una cotización personalizada.";
    } elseif (strpos($preguntaLower, 'cita') !== false || strpos($preguntaLower, 'agendar') !== false) {
        return "📅 Para agendar una cita, visita nuestro sitio web o llama al 555-1234. ¡Estaremos encantados de atenderte!";
    } else {
        return "🤔 No tengo información sobre eso. ¿Puedes reformular tu pregunta? También puedo ayudarte con: citas, horarios, emergencias o información sobre tratamientos.";
    }
}

function detectarDispositivo() {
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (preg_match('/mobile|android|iphone|ipad|ipod/i', $ua)) {
        return 'mobile';
    }
    return 'desktop';
}
?>