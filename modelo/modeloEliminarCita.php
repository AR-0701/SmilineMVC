<?php
require_once '../modelo/Conexion.php';
session_start(); // Por si entra directo aquí

$clienteLogueado = [
    'id' => $_SESSION['idUsuario'] ?? null,
    'idRol' => $_SESSION['idRol'] ?? null
];

try {
    $conexionBD = new ConexionBD();
    $pdo = $conexionBD->getConexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idCita'])) {
        $idCita = intval($_POST['idCita']);

        if ($idCita > 0) {
            // Verificar si la cita existe
            $stmtVerificar = $pdo->prepare("SELECT idCita FROM Citas WHERE idCita = ?");
            $stmtVerificar->execute([$idCita]);
            $cita = $stmtVerificar->fetch();

            if ($cita) {
                // Eliminar la cita
                $stmtEliminar = $pdo->prepare("DELETE FROM Citas WHERE idCita = ?");
                if ($stmtEliminar->execute([$idCita])) {
                    // Redireccionar según el rol
                    switch ($clienteLogueado['idRol']) {
                        case 1:
                            header("Location: ../vistas/inicioClientes");
                            break;
                        case 2:
                            header("Location: ../vistas/inicioAsistentes.php?msg=eliminada");
                            break;
                        case 3:
                            header("Location: ../vistas/inicioAdmin.php?msg=eliminada");
                            break;
                        default:
                            header("Location: ../login.php");
                            break;
                    }
                    exit();
                } else {
                    echo "Error al eliminar la cita.";
                }
            } else {
                echo "La cita no existe.";
            }
        } else {
            echo "ID de cita no válido.";
        }
    } else {
        echo "No se recibió un ID de cita válido.";
    }
} catch (Exception $e) {
    echo "Error de conexión o consulta: " . $e->getMessage();
}
