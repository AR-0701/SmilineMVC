<?php
error_reporting(E_ALL);

include '../modelo/Conexion.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

try {
    if (!$email || !$password) {
        throw new Exception("Email o contraseña vacíos.");
    }

    $conexion = (new ConexionBD())->getConexion();
    $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['aPaterno'] = $user['aPaterno'];
        $_SESSION['aMaterno'] = $user['aMaterno'];
        $_SESSION['idRol'] = $user['idRol'];


        switch ($user['idRol']) {
            case 1:
                $redirect = '../public/inicioClientes.php';
                break;
            case 2:
            case 3:
                $redirect = '../public/principalAsis.php';
                break;
            case 4:
                $redirect = '../public/principalAdmin.php';
                break;
            default:
                throw new Exception("Rol no reconocido.");
        }

        echo json_encode([
            'success' => true,
            'redirect' => $redirect
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Correo o contraseña incorrectos.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
