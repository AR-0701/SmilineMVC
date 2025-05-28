<?php
function filtrarCitasPorFecha($fecha) {
    require_once '../modelo/Conexion.php'; // Asegúrate de la ruta correcta

    try {
        $conexionBD = new ConexionBD();
        $conexion = $conexionBD->getConexion();

        $sql = "
            SELECT 
                citas.idCita, 
                CONCAT(usuarios.nombre, ' ', usuarios.aPaterno, ' ', usuarios.aMaterno) AS cliente,
                citas.dia,  
                citas.hora
            FROM Citas citas
            INNER JOIN Usuarios usuarios ON citas.idUsuario = usuarios.idUsuario
            INNER JOIN Horarios horarios ON citas.idHorario = horarios.idHorario
            WHERE citas.dia = :fecha
        ";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        $citas = $stmt->fetchAll();

        if (count($citas) > 0) {
            foreach ($citas as $fila) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['idCita']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['cliente']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['dia']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['hora']) . "</td>";
                echo "<td><button class='button1' onclick='eliminarCita(" . htmlspecialchars($fila['idCita']) . ")'>Eliminar</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay citas para esta fecha.</td></tr>";
        }

    } catch (Exception $e) {
        echo "<tr><td colspan='5'>Error al consultar las citas: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
}
