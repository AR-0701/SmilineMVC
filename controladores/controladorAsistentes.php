<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'] ?? null;

    if (!$fecha) {
        echo "<tr><td colspan='5'>Fecha no válida.</td></tr>";
        exit;
    }

    include '../modelo/modeloFiltrarCitas.php';
    filtrarCitasPorFecha($fecha); // Llama a la función del modelo
}
?>
