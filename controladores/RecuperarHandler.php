<?php
require_once '../controladores/RecuperarController.php';

$controller = new RecuperarController();

if (isset($_POST['solicitar'])) {
    $email = $_POST['email'];
    $msg = $controller->enviarCorreoRecuperacion($email);
    echo $msg;
}

if (isset($_POST['cambiar'])) {
    $token = $_POST['token'];
    $nueva = $_POST['nuevaPass'];
    $msg = $controller->cambiarPassword($token, $nueva);
    echo $msg;
}
