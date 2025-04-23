<?php
include 'logica/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'] ?? null;

    if (!$fecha) {
        echo "<tr><td colspan='5'>Fecha no válida.</td></tr>";
        exit;
    }

    // Consulta para filtrar citas por fecha.
    $consulta = $conexion->prepare("
        SELECT 
            citas.idCita, 
            CONCAT(usuarios.nombre, ' ', usuarios.aPaterno, ' ', usuarios.aMaterno) AS cliente,
            citas.dia,  
            citas.hora
        FROM Citas citas
        INNER JOIN Usuarios usuarios ON citas.idUsuario = usuarios.idUsuario
        INNER JOIN Horarios horarios ON citas.idHorario = horarios.idHorario
        WHERE citas.dia = ?
    ");
    $consulta->bind_param("s", $fecha);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
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

    $consulta->close();
    $conexion->close();
}
