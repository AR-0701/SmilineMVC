<?php
require_once '../modelo/Conexion.php';
require_once '../modelo/modeloExpedientes.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';
$model = new ExpedienteModel();

try {
    switch ($action) {
        case 'getCitaData':
            $idCita = $_GET['idCita'] ?? 0;
            try {
                $citaData = $model->obtenerDatosCita($idCita);
                if ($citaData['success']) {
                    $expediente = $model->obtenerPorCita($idCita);
                    echo json_encode([
                        'success' => true,
                        'fecha' => $citaData['fecha'],
                        'expediente' => $expediente ?: null
                    ]);
                } else {
                    echo json_encode($citaData);
                }
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
            exit;
            break;

        case 'guardarExpediente':
            $data = json_decode(file_get_contents('php://input'), true);
            $idCita = $data['idCita'] ?? 0;
            $datosExpediente = $data['datos'] ?? [];

            try {
                $success = $model->guardar($idCita, $datosExpediente);
                echo json_encode([
                    'success' => $success,
                    'message' => $success ? 'Guardado correctamente' : 'Error al guardar'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
            exit;
            break;

        default:
            if (isset($_POST['fecha'])) {
                $fecha = $_POST['fecha'];
                $pdo = (new ConexionBD())->getConexion();

                $sql = "SELECT c.idCita, CONCAT(u.nombre, ' ', u.aPaterno, ' ', u.aMaterno) as nombre_cliente, 
                        c.fecha, c.hora 
                        FROM citas c 
                        JOIN usuarios u ON c.idUsuario = u.idUsuario 
                        WHERE c.fecha = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$fecha]);
                $citas = $stmt->fetchAll();

                if (empty($citas)) {
                    echo '<tr><td colspan="5">No hay citas para esta fecha.</td></tr>';
                } else {
                    foreach ($citas as $cita) {
                        echo "<tr>
                                <td>{$cita['idCita']}</td>
                                <td>{$cita['nombre_cliente']}</td>
                                <td>{$cita['fecha']}</td>
                                <td>{$cita['hora']}</td>
                                <td>
                                    <button class='btn btn-primary btn-sm' 
                                            onclick='abrirModalExpediente({$cita['idCita']})'>
                                        <i class='fas fa-file-medical'></i> Llenar Expediente
                                    </button>
                                </td>
                            </tr>";
                    }
                }
            }
            break;
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
