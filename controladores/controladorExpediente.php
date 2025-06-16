<?php
require_once '../modelo/modeloExpedientes.php.php';

class ExpedienteController {
    private $model;

    public function __construct() {
        $this->model = new ExpedienteModel();
    }

    public function ver($idCita) {
        // Verificar sesión y permisos
        session_start();
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3) {
            header("Location: ../login.php");
            exit();
        }

        $cita = $this->model->obtenerDatosCita($idCita);
        $expediente = $this->model->obtenerPorCita($idCita) ?? [
            'motivo' => '',
            'diagnostico' => '',
            'tratamiento' => '',
            'observacion' => ''
        ];

        include '../vistas/expediente/ver.php';
    }

    public function guardar() {
        // Verificar sesión y permisos
        session_start();
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3 || 
            $_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: ../login.php");
            exit();
        }

        $idCita = $_POST['idCita'] ?? 0;
        $datos = [
            'motivo' => $_POST['motivo'] ?? '',
            'diagnostico' => $_POST['diagnostico'] ?? '',
            'tratamiento' => $_POST['tratamiento'] ?? '',
            'observacion' => $_POST['observacion'] ?? ''
        ];

        if ($this->model->guardar($idCita, $datos)) {
            header("Location: expediente.php?id=$idCita&guardado=1");
        } else {
            header("Location: expediente.php?id=$idCita&error=1");
        }
        exit();
    }
}
?>