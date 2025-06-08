<?php
session_start();

// Asegura que la petición sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/login.php");
    exit;
}

// Identificamos qué formulario envió los datos
if (isset($_POST['tipoFormulario'])) {
    $tipo = $_POST['tipoFormulario'];

    switch ($tipo) {
        case 'cliente':
            include '../modelo/modeloRegistro.php';
            break;
        case 'asistente':
            include '../modelo/modeloRegistroAsis.php';
            break;
        default:
            echo "<script>alert('Formulario desconocido'); window.location.href='../public/login.php';</script>";
            exit;
    }

} else {
    echo "<script>alert('No se especificó el tipo de registro'); window.location.href='../login.php';</script>";
    exit;
}
?>
