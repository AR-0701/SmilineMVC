<?php
require_once '../modelo/modeloHsotrial.php';

class HistorialController {
    private $model;

    public function __construct() {
        $this->model = new HistorialModel();
    }

    public function ver($idUsuario) {
        // Verificar sesión y permisos
        session_start();
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3) {
            header("Location: ../login.php");
            exit();
        }

        $paciente = $this->model->obtenerPaciente($idUsuario);
        $citas = $this->model->obtenerCitasConExpedientes($idUsuario);

        include '../vistas/pruebaVer.php';
    }
}
?>