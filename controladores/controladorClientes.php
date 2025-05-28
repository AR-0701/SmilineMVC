<?php
session_start();

// Validar que el usuario está logueado
if (!isset($_SESSION['idUsuario']) || !in_array($_SESSION['idRol'], [1, 3])) {
    header('Location: ../public/login.php');
    exit();
}

// Detectar acción
$accion = $_POST['accion'] ?? null;

if ($accion === 'agendar') {
    require_once '../modelo/modeloAgendar.php';

    $idUsuario = $_POST['idUsuario'] ?? null;
    $dia = $_POST['dia'] ?? null;
    $hora = $_POST['hora'] ?? null;

    agendarCita($idUsuario, $dia, $hora);
} else {
    header("Location: ../vista/mensaje.view.php?msg=accion_invalida&redirect=../vistas/inicioClientes.php");
    exit();
}
