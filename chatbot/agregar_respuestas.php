<?php
require '../vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://rolando98alex1234:soIo8NyYxaCRr9dR@cluster0.xt7xsuv.mongodb.net/chat");
$db = $client->selectDatabase('chat');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agregar a preguntas
    $db->preguntas->insertOne([
        'pregunta' => $_POST['pregunta_texto'],
        'respuesta' => $_POST['respuesta'],
        'categoria' => $_POST['categoria'],
        'fecha' => new MongoDB\BSON\UTCDateTime(),
        'keywords' => extraerKeywords($_POST['pregunta_texto']),
        'stats' => [
            'veces_consultada' => 0,
            'ultima_consulta' => null
        ]
    ]);

    // Marcar como procesada en preguntas_nuevas
    $db->preguntas_nuevas->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($_POST['pregunta_id'])],
        ['$set' => ['procesada' => true]]
    );

    header('Location: ../chatbot/revisar_preguntas.php?success=1');
    exit;
}

function extraerKeywords($texto)
{
    $stopwords = ['de', 'la', 'que', 'el', 'en', 'los', 'con', 'para', 'por'];
    $palabras = preg_split('/\s+/', strtolower($texto));
    $palabras = preg_replace('/[^a-záéíóúñ]/', '', $palabras);
    return array_values(array_diff(array_unique($palabras), $stopwords));
}
