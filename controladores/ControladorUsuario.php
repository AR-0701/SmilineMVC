<?php
session_start();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'login':
        login();
        break;

    case 'validarRol': // lo usas en vistas protegidas
        validarRol();
        break;

    case 'logout':
        logout();
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Acción no válida'
        ]);
        break;
}

// ==============================
// FUNCIONES
// ==============================

function login() {
    include_once '../modelo/modeloLogin.php'; // ahí validas el usuario y asignas $_SESSION
    // modeloLogin ya debe devolver el json con success y redirect
}

function validarRol() {
    $rolesPermitidos = $_POST['roles'] ?? [];

    if (!isset($_SESSION['idRol'])) {
        header("Location: ../public/login.php");
        exit;
    }

    if (!in_array($_SESSION['idRol'], $rolesPermitidos)) {
        redirigirPorRol();
    }

    // Si todo bien, continúa (no haces nada, dejas cargar la página)
}

function redirigirPorRol() {
    switch ($_SESSION['idRol']) {
        case 1:
            header("Location: ../public/inicioClientes.php");
            break;
        case 2:
        case 3:
            header("Location: ../public/principalAsis.php");
            break;
        case 4:
            header("Location: ../public/principalAdmin.php");
            break;
        default:
            header("Location: ../login.php");
            break;
    }
    exit;
}

function logout() {
    session_destroy();
    header("Location: ../public/login.php");
    exit;
}
