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

            // Primero obtener el idUsuario asociado a la cita
            $sqlUsuario = "SELECT idUsuario FROM citas WHERE idCita = ?";
            $stmtUsuario = $pdo->prepare($sqlUsuario);
            $stmtUsuario->execute([$idCita]);
            $idUsuario = $stmtUsuario->fetchColumn();

            if (!$idUsuario) {
                throw new Exception("No se encontró el usuario asociado a esta cita");
            }

            // Verificar si ya existe expediente
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

            // Guardar en consultas (incluyendo el idUsuario)
            $sqlConsulta = "INSERT INTO consultas (idCita, idUsuario, realizada) 
                        VALUES (?, ?, 1)
                        ON DUPLICATE KEY UPDATE realizada = 1";
            $stmtConsulta = $pdo->prepare($sqlConsulta);
            $stmtConsulta->execute([$idCita, $idUsuario]);

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
                c.dia AS fecha,
                c.Hora AS hora,
                CONCAT(u.nombre, ' ', u.aPaterno, ' ', u.aMaterno) AS nombre_completo 
            FROM citas c 
            JOIN usuarios u ON c.idUsuario = u.idUsuario 
            WHERE c.idCita = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idCita]);

        $cita = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cita) {
            return ['success' => false, 'message' => 'Cita no encontrada'];
        }

        return [
            'success' => true,
            'fecha' => $cita['fecha'],
            'nombre_completo' => $cita['nombre_completo'],
            // Agrega otros campos necesarios
        ];
    }
    public function obtenerHistorialUsuario($idUsuario)
    {
        $pdo = $this->conexion->getConexion();

        $sql = "SELECT 
                ec.*,
                c.dia AS fecha
            FROM expediente_cita ec
            JOIN citas c ON ec.idCita = c.idCita
            WHERE c.idUsuario = ?
            ORDER BY c.dia DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDatosUsuario($idUsuario)
    {
        $pdo = $this->conexion->getConexion();

        $sql = "SELECT nombre, aPaterno, aMaterno, email, fNacimiento 
            FROM usuarios 
            WHERE idUsuario = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
