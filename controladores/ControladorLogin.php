<?php
session_start();
require_once '../modelo/Usuarios.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->autenticar($email, $password);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location: ../views/dashboard.php'); // O donde vayas después del login
        exit;
    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header('Location: ../views/login.php');
        exit;
    }
}
else {
    header('Location: ../public/login.php');
    exit;
}