<?php
include('../modelo/Conexion.php');

function modificarHorario($horaApertura, $horaCierre, $disponibilidad, $dia)
{
    try {
        $conexionObj = new ConexionBD();
        $conexion = $conexionObj->getConexion();

        $query = "UPDATE Horarios 
                  SET hApertura = :apertura, hCierre = :cierre, disponibilidad = :dispo 
                  WHERE dia = :dia";

        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':apertura', $horaApertura);
        $stmt->bindParam(':cierre', $horaCierre);
        $stmt->bindParam(':dispo', $disponibilidad);
        $stmt->bindParam(':dia', $dia);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error al ejecutar la consulta.";
        }
    } catch (Exception $e) {
        return "Error de conexión o ejecución: " . $e->getMessage();
    }
}
?>
