<?php
header('Content-Type: application/json');

// 🔌 Conexión directa a la base de datos
$host = "localhost";      // o tu host
$user = "root";     // cambia esto por tu usuario
$pass = "";  // cambia esto por tu contraseña
$dbname = "smileline";      // cambia esto por tu base de datos

$conexion = new mysqli($host, $user, $pass, $dbname);

// Validar conexión
if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión: ' . $conexion->connect_error]);
    exit;
}

// 📅 Obtener y validar la fecha
$fecha = $_GET['fecha'] ?? null;

if (!$fecha) {
    echo json_encode(['success' => false, 'error' => 'Fecha no proporcionada.']);
    exit;
}

// Obtener el día de la semana en inglés y traducirlo al español
$diaSemana = date('l', strtotime($fecha));
$diasMap = [
    'Monday'    => 'Lunes',
    'Tuesday'   => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday'  => 'Jueves',
    'Friday'    => 'Viernes',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo'
];

$dia = $diasMap[$diaSemana] ?? null;

if (!$dia) {
    echo json_encode(['success' => false, 'error' => 'Día de la semana inválido.']);
    exit;
}

// 🕒 Consulta SQL
$query = "SELECT hApertura, hCierre FROM Horarios WHERE dia = ?";
$stmt = $conexion->prepare($query);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Error al preparar la consulta.']);
    exit;
}

$stmt->bind_param("s", $dia);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

$stmt->close();
$conexion->close();

// 📤 Respuesta JSON
echo json_encode(['success' => true, 'data' => $horarios]);
?>
