<?php
function filtrarCitasPorFecha($fecha)
{
    require_once '../modelo/Conexion.php';

    try {
        $conexionBD = new ConexionBD();
        $conexion = $conexionBD->getConexion();

        // Consulta para citas regulares y temporales
        $sql = "
            SELECT 
                citas.idCita, 
                CONCAT(usuarios.nombre, ' ', usuarios.aPaterno, ' ', usuarios.aMaterno) AS cliente,
                citas.dia,  
                citas.hora,
                'regular' AS tipo_cita
            FROM Citas citas
            INNER JOIN Usuarios usuarios ON citas.idUsuario = usuarios.idUsuario
            INNER JOIN Horarios horarios ON citas.idHorario = horarios.idHorario
            WHERE citas.dia = :fecha
            
            UNION ALL
            
            SELECT 
                id AS idCita,
                nombre AS cliente,
                dia,
                hora,
                'temporal' AS tipo_cita
            FROM citas_temporales
            WHERE dia = :fecha
            ORDER BY hora
        ";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($citas) > 0) {
            $hayTemporales = false;

            foreach ($citas as $fila) {
                $claseFila = ($fila['tipo_cita'] == 'temporal') ? 'class="cita-temporal"' : '';
                if ($fila['tipo_cita'] == 'temporal') $hayTemporales = true;

                echo "<tr $claseFila>";
                echo "<td>" . htmlspecialchars($fila['idCita']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['cliente']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['dia']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['hora']) . "</td>";

                echo "<td>
                                        <button class='action-btn btn-schedule' data-bs-toggle='modal' data-bs-target='#historialModal' title='Agregar Historial'>
                                            <i class='fa-solid fa-file-medical'></i>
                                        </button>
                                    </td>";



                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay citas para esta fecha.</td></tr>";
        }
    } catch (PDOException $e) {
        error_log("Error al consultar citas: " . $e->getMessage());
        echo "<tr><td colspan='5'>Error al consultar las citas. Verifica los logs.</td></tr>";
    }
}
