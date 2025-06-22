<?php
require_once '../modelo/Conexion.php';

class ExpedienteModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    public function obtenerPorCita($idCita)
    {
        $pdo = $this->conexion->getConexion();

        $sql = "SELECT * FROM expediente_cita WHERE idCita = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idCita]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($idCita, $datos)
    {
        $pdo = $this->conexion->getConexion();

        try {
            $pdo->beginTransaction();

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
            $success = $stmt->execute([
                $datos['motivo'],
                $datos['diagnostico'],
                $datos['tratamiento'],
                $datos['observacion'],
                $idCita
            ]);

            // También marcar la consulta como realizada
            $sqlConsulta = "INSERT INTO consultas (idCita, realizada) VALUES (?, 1)
                            ON DUPLICATE KEY UPDATE realizada = 1";
            $stmtConsulta = $pdo->prepare($sqlConsulta);
            $stmtConsulta->execute([$idCita]);

            $pdo->commit();
            return $success;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function obtenerDatosCita($idCita)
    {
        $pdo = $this->conexion->getConexion();

        $sql = "SELECT 
                c.idCita,
                c.dia AS fecha,  // Usamos 'dia' como fecha
                c.Hora AS hora,
                c.estado,
                CONCAT(u.nombre, ' ', u.aPaterno, ' ', u.aMaterno) as nombre_completo 
            FROM citas c 
            JOIN usuarios u ON c.idUsuario = u.idUsuario 
            WHERE c.idCita = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idCita]);

        $cita = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }

        return $cita;
    }
}
