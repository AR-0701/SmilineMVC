<?php
require_once '../modelo/Conexion.php';

class ExpedienteModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionBD();
    }

    public function obtenerPorCita($idCita) {
        $pdo = $this->conexion->getConexion();
        
        $sql = "SELECT * FROM expediente_cita WHERE idCita = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idCita]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($idCita, $datos) {
        $pdo = $this->conexion->getConexion();
        
        // Verificar si ya existe
        $existente = $this->obtenerPorCita($idCita);
        
        if ($existente) {
            // Actualizar
            $sql = "UPDATE expediente_cita SET motivo = ?, diagnostico = ?, 
                    tratamiento = ?, observacion = ? WHERE idCita = ?";
        } else {
            // Insertar
            $sql = "INSERT INTO expediente_cita (motivo, diagnostico, tratamiento, observacion, idCita) 
                    VALUES (?, ?, ?, ?, ?)";
        }
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $datos['motivo'],
            $datos['diagnostico'],
            $datos['tratamiento'],
            $datos['observacion'],
            $idCita
        ]);
    }

    public function obtenerDatosCita($idCita) {
        $pdo = $this->conexion->getConexion();
        
        $sql = "SELECT c.*, CONCAT(u.nombre, ' ', u.aPaterno, ' ', u.aMaterno) as nombre_completo 
                FROM citas c 
                JOIN usuarios u ON c.idUsuario = u.idUsuario 
                WHERE c.idCita = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idCita]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>