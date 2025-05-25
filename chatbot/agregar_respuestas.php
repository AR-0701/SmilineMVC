<?php
include 'db.php';

$pregunta = trim($_POST["pregunta"]);
$respuesta = trim($_POST["respuesta"]);
$categoria = trim($_POST["categoria"]);

if ($pregunta && $respuesta && $categoria) {
    $sql = "INSERT INTO preguntas (pregunta, respuesta, categoria) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $pregunta, $respuesta, $categoria);
    $stmt->execute();

    $sql = "DELETE FROM preguntas_nuevas WHERE pregunta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pregunta);
    $stmt->execute();
    
    echo "Pregunta agregada correctamente.";
} else {
    echo "Faltan datos.";
}
?>
