<?php
function verClientes($conexion)
{
    try {
        $sql = "SELECT idUsuario, nombre, aPaterno, aMaterno, email, genero FROM usuarios WHERE idRol = 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); // Devuelve array asociativo
    } catch (PDOException $e) {
        die("Error al obtener clientes: " . $e->getMessage());
    }
}
