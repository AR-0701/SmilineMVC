<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que viene de la modificación de horario
    if (isset($_POST['fechaSeleccionada']) && isset($_POST['horariosIN']) && isset($_POST['horariosCI']) && isset($_POST['disponibilidad'])) {
        include('../modelo/modeloHorario.php'); // Aquí llamas el modelo
        exit;
    } else {
        echo "<script>alert('Datos insuficientes para modificar el horario.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Método de solicitud no permitido.'); window.history.back();</script>";
}
