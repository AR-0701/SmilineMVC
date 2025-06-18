<?php
// Incluir la clase de conexión
include '../modelo/Conexion.php';

try {
    // Crear instancia de la conexión PDO
    $conexionBD = new ConexionBD();
    $conexion = $conexionBD->getConexion();

    // Consulta para obtener clientes
    $consulta = "SELECT idUsuario, nombre, aPaterno, aMaterno, email, genero FROM usuarios WHERE idRol = 3";
    $stmt = $conexion->query($consulta);

    // Generar el HTML para las filas de la tabla
    if ($stmt->rowCount() > 0) {
        while ($fila = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['idUsuario']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['nombre'] . " " . $fila['aPaterno'] . " " . $fila['aMaterno']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['genero']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay clientes registrados.</td></tr>";
    }
} catch (Exception $e) {
    echo "<tr><td colspan='5'>Error al obtener los datos: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>