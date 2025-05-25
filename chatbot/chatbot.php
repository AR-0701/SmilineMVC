<?php
session_start();
include 'db.php';

$usuario_id = session_id(); // Identifica al usuario por sesión
$pregunta = trim($_POST["pregunta"]); // Recibe la pregunta del usuario

$umbral_similitud = 50; // Porcetahe de similitud

// Consultar todas las preguntas en la base de datos
$sql = "SELECT pregunta, respuesta FROM preguntas";
$result = $conn->query($sql);

$mejor_coincidencia = null;
$mejor_similitud = 0;

// Recorrer todas las preguntas
while ($row = $result->fetch_assoc()) {
    // Calcular la similitud 
    $similitud = 0;
    similar_text($pregunta, $row['pregunta'], $similitud);

    // Si la similitud es mayor o igual al umbral de 50%, se guarda la respuesta correspondiente
    if ($similitud >= $umbral_similitud) {
        $mejor_coincidencia = $row['respuesta'];
        break;  // Si encontramos una coincidencia suficientemente buena, salimos del bucle
    }
}

// Si encontramos una coincidencia, enviamos la respuesta, de lo contrario, guardamos la pregunta para revisión
if ($mejor_coincidencia) {
    echo json_encode(["respuesta" => $mejor_coincidencia]);
} else {
    $respuesta = "Lo siento, no tengo una respuesta para eso aún.";
    
    // Guardar la pregunta para revisión
    $sql = "INSERT INTO preguntas_nuevas (usuario_id, pregunta) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario_id, $pregunta);
    $stmt->execute();
    
    echo json_encode(["respuesta" => $respuesta]);
}
?>
