<?php

function agendarCita($idUsuario, $dia, $hora)
{
    require_once '../modelo/Conexion.php';
    $db = new ConexionBD();
    $conexion = $db->getConexion();

    if (empty($dia) || empty($hora)) {
        die("Faltan datos para agendar la cita.");
    }

    // Obtener día de la semana
    $nombreDia = date('l', strtotime($dia));
    $dias = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];
    $diaSemana = $dias[$nombreDia] ?? '';

    // Buscar horario disponible
    $queryHorarios = "SELECT idHorario FROM Horarios WHERE dia = ? AND disponibilidad = 'disponible' LIMIT 1";
    $stmtHorarios = $conexion->prepare($queryHorarios);
    $stmtHorarios->execute([$diaSemana]);
    $row = $stmtHorarios->fetch();

    if ($row) {
        $idHorario = $row['idHorario'];

        // Verificar si ya existe una cita
        $queryVerificar = "SELECT * FROM Citas WHERE dia = ? AND hora = ? AND estado IN ('pendiente', 'confirmada')";
        $stmtVerificar = $conexion->prepare($queryVerificar);
        $stmtVerificar->execute([$dia, $hora]);

        if ($stmtVerificar->rowCount() > 0) {
            header("Location: ../vistas/mensaje.view.php?msg=horario_ocupado&redirect=../public/agendar.php");
            exit;
        } else {
            // Insertar cita
            $queryInsertar = "INSERT INTO Citas (idUsuario, dia, idHorario, hora, estado) VALUES (?, ?, ?, ?, 'pendiente')";
            $stmtInsertar = $conexion->prepare($queryInsertar);
            $stmtInsertar->execute([$idUsuario, $dia, $idHorario, $hora]);

            header("Location: ../vistas/mensaje.view.php?msg=cita_agendada&redirect=../public/inicioClientes.php");
            exit;
        }
    } else {
        header("Location: ../vistas/mensaje.view.php?msg=no_horarios&redirect=../public/agendar.php");
        exit;
    }
}
