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

if (empty($nombre)) {
    echo json_encode(['error' => 'Nombre no proporcionado']);
    exit;
}

// Insertar paciente temporal si no existe
$insert = $conexion->prepare("INSERT IGNORE INTO pacientes_temporales (nombre) VALUES (?)");
$insert->execute([$nombre]);

// Configuración
$intervalo = 30; // Intervalo de minutos entre citas
$diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']; // Días laborales
$limiteDias = 14; // Máximo de días a buscar
$citasPorDia = 3; // Citas a mostrar por día

$resultado = [];
$diasEncontrados = 0;
$fechaActual = new DateTime();

for ($i = 0; $i < $limiteDias && $diasEncontrados < 3; $i++) {
    $fechaActual->modify('+1 day');
    $nombreDia = $diasSemana[$fechaActual->format('N') - 1] ?? null;
    
    if (!$nombreDia) continue; // Saltar domingos o días no laborales
    
    // Obtener horario del día
    $queryHorario = "SELECT hApertura, hCierre FROM horarios WHERE dia = ? AND disponibilidad = 'disponible' LIMIT 1";
    $stmtHorario = $conexion->prepare($queryHorario);
    $stmtHorario->execute([$nombreDia]);
    $horario = $stmtHorario->fetch(PDO::FETCH_ASSOC);
    
    if (!$horario) continue;
    
    // Generar horas disponibles
    $horaInicio = new DateTime($horario['hApertura']);
    $horaFin = new DateTime($horario['hCierre']);
    $horaActual = clone $horaInicio;
    
    $horasDisponibles = [];
    $fechaFormateada = $fechaActual->format('Y-m-d');
    
    while ($horaActual < $horaFin && count($horasDisponibles) < $citasPorDia) {
        $horaFormateada = $horaActual->format('H:i:s');
        
        // Verificar disponibilidad
        $queryDisponibilidad = "
            SELECT 1 FROM citas 
            WHERE dia = ? 
            AND hora = ? 
            AND estado IN ('pendiente', 'confirmada')
            UNION
            SELECT 1 FROM citas_temporales
            WHERE dia = ? 
            AND hora = ?
        ";
        
        $stmtDisponibilidad = $conexion->prepare($queryDisponibilidad);
        $stmtDisponibilidad->execute([$fechaFormateada, $horaFormateada, $fechaFormateada, $horaFormateada]);
        
        if ($stmtDisponibilidad->rowCount() === 0) {
            $horasDisponibles[] = $horaFormateada;
        }
        
        $horaActual->modify("+$intervalo minutes");
    }
    
    if (!empty($horasDisponibles)) {
        $resultado[] = [
            'fecha' => $fechaFormateada,
            'horas' => $horasDisponibles
        ];
        $diasEncontrados++;
    }
}

echo json_encode($resultado);