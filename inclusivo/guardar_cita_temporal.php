<?php
require '../modelo/Conexion.php';

try {
    $conexionBD = new ConexionBD();
    $conexion = $conexionBD->getConexion();
} catch (Exception $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$dia = $_POST['dia'] ?? '';
$hora = $_POST['hora'] ?? '';

if (empty($nombre) || empty($dia) || empty($hora)) {
    echo json_encode(['error' => 'Datos incompletos']);
    exit;
}

// Verificar que la cita no esté ocupada en citas normales
$queryVerificarNormal = "
    SELECT 1 FROM citas 
    WHERE dia = ? 
    AND hora = ? 
    AND estado IN ('pendiente', 'confirmada')
    LIMIT 1
";
$stmtVerificarNormal = $conexion->prepare($queryVerificarNormal);
$stmtVerificarNormal->execute([$dia, $hora]);

if ($stmtVerificarNormal->fetch()) {
    echo json_encode(['error' => 'Horario ya ocupado en sistema normal']);
    exit;
}

// Verificar que la cita no esté ocupada en citas temporales
$queryVerificarTemporal = "
    SELECT 1 FROM citas_temporales
    WHERE dia = ? 
    AND hora = ? 
    LIMIT 1
";
$stmtVerificarTemporal = $conexion->prepare($queryVerificarTemporal);
$stmtVerificarTemporal->execute([$dia, $hora]);

if ($stmtVerificarTemporal->fetch()) {
    echo json_encode(['error' => 'Horario ya ocupado en sistema temporal']);
    exit;
}

// Insertar cita temporal
$queryInsertar = "
    INSERT INTO citas_temporales (nombre, dia, hora, estado)
    VALUES (?, ?, ?, 'pendiente')
";
$stmtInsertar = $conexion->prepare($queryInsertar);
$stmtInsertar->execute([$nombre, $dia, $hora]);

echo json_encode(['success' => true]);