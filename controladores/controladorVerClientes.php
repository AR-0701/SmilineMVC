<?php
require_once '../modelo/Conexion.php';
require_once '../modelo/modeloVerClientes.php';

try {
    $conexionBD = new ConexionBD();
    $conexion = $conexionBD->getConexion();
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

$clientes = [];

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'verClientes';

switch ($accion) {
    case 'verClientes':
        $clientes = verClientes($conexion);
        break;

    // Futuras funciones aquí
    // case 'buscarClientePorNombre':
    //     $clientes = buscarClientePorNombre($conexion, $_GET['nombre']);
    //     break;

    default:
        $clientes = verClientes($conexion);
        break;
}
?>
