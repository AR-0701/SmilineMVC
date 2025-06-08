<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fechaSeleccionada'] ?? null;
    $horaApertura = $_POST['horariosIN'] ?? null;
    $horaCierre = $_POST['horariosCI'] ?? null;
    $disponibilidad = $_POST['disponibilidad'] ?? null;

    if ($fecha && $horaApertura && $horaCierre && in_array($disponibilidad, ['disponible', 'ocupado'])) {
        // Convertir fecha al nombre del día
        $diaSemana = date('l', strtotime($fecha));
        $diasMap = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];
        $dia = $diasMap[$diaSemana] ?? null;

        if ($dia) {
            include('../modelo/modeloModificar.php');
            $resultado = modificarHorario($horaApertura, $horaCierre, $disponibilidad, $dia);

            if ($resultado === true) {
                echo "<script>alert('Horario modificado exitosamente.'); window.location.href = '../public/mHorario.php';</script>";
            } else {
                echo "<script>alert('Error: $resultado'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Fecha inválida.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Por favor completa todos los campos correctamente.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Acceso inválido.'); window.history.back();</script>";
}
?>
