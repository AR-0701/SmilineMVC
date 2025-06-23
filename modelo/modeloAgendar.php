<?php

function agendarCita($idUsuario, $dia, $hora)
{
    require_once '../modelo/Conexion.php';
    require_once '../vendor/autoload.php';
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
            header("Location: ../public/agendar.php?msg=horario_ocupado");
            exit;
        } else {

            // --- NUEVO: Obtener datos del usuario para el correo ---
            $queryUsuario = "SELECT nombre, aPaterno, aMaterno, email FROM Usuarios WHERE idUsuario = ?";
            $stmtUsuario = $conexion->prepare($queryUsuario);
            $stmtUsuario->execute([$idUsuario]);
            $usuario = $stmtUsuario->fetch();

            // Insertar cita
            $queryInsertar = "INSERT INTO Citas (idUsuario, dia, idHorario, hora, estado) VALUES (?, ?, ?, ?, 'pendiente')";
            $stmtInsertar = $conexion->prepare($queryInsertar);
            $stmtInsertar->execute([$idUsuario, $dia, $idHorario, $hora]);

            // --- NUEVO: Enviar correo de confirmación ---
            if ($usuario && !empty($usuario['email'])) {
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'smilelineoficial@gmail.com'; // Cambiar
                    $mail->Password = 'oalb znsk woow qxse'; // Cambiar
                    $mail->SMTPSecure = 'tls';

                    $mail->setFrom('smilelineoficial@gmail.com', 'SmileLine');
                    $mail->addAddress($usuario['email']);
                    $mail->isHTML(true);
                    $mail->Subject = '✅ Confirmación de Cita';

                    // Cuerpo del correo con datos dinámicos
                    $nombreCompleto = $usuario['nombre'] . ' ' . $usuario['aPaterno'] . ' ' . $usuario['aMaterno'];
                    $mail->Body = "
                        <h2>¡Hola, {$nombreCompleto}!</h2>
                        <p>Tu cita ha sido agendada exitosamente:</p>
                        <ul>
                            <li><strong>Fecha:</strong> {$dia}</li>
                            <li><strong>Hora:</strong> {$hora}</li>
                        </ul>
                        <p>¡Gracias por confiar en nosotros!</p>
                    ";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Error al enviar correo: " . $mail->ErrorInfo);
                    // No detener el flujo si falla el correo
                }
            }

            header("Location: ../public/agendar.php?msg=cita_agendada");
        exit;
        }
    } else {
            header("Location: ../public/agendar.php?msg=no_horarios");

    }
}
