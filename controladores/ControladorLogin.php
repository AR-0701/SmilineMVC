<?php
require_once '../modelo/Conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $con = Conexion::conectar();
    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$usuario, $password]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../vistas/principal.php");
    } else {
        header("Location: ../vistas/error.php");
    }
}
?>