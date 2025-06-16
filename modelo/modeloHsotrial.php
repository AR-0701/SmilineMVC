<?php
require_once '../modelo/Conexion.php';

class HistorialModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionBD();
    }

    public function obtenerPaciente($idUsuario) {
        $pdo = $this->conexion->getConexion();
        
        $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUsuario]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCitasConExpedientes($idUsuario) {
        $pdo = $this->conexion->getConexion();
        
        $sql = "SELECT c.idCita, c.dia, c.hora, e.motivo, e.diagnostico, 
                       e.tratamiento, e.observacion 
                FROM citas c 
                LEFT JOIN expediente_cita e ON c.idCita = e.idCita 
                WHERE c.idUsuario = ? 
                ORDER BY c.dia DESC, c.hora DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUsuario]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>