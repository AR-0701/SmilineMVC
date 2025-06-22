<?php
require_once '../modelo/Conexion.php';
require_once '../modelo/modeloExpedientes.php';
require_once '../vendor/autoload.php'; // Para Dompdf

$action = $_GET['action'] ?? '';
$model = new ExpedienteModel();

switch ($action) {
    case 'obtenerHistorial':
        $idUsuario = $_GET['idUsuario'] ?? 0;
        header('Content-Type: application/json');

        try {
            $historial = $model->obtenerHistorialUsuario($idUsuario);
            echo json_encode(['success' => true, 'data' => $historial]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;

    case 'generarPDF':
        $idUsuario = $_GET['idUsuario'] ?? 0;

        try {
            $historial = $model->obtenerHistorialUsuario($idUsuario);
            $datosUsuario = $model->obtenerDatosUsuario($idUsuario);

            // Generar HTML para el PDF
            $html = generarHTMLPDF($datosUsuario, $historial);

            // Configurar Dompdf
            $dompdf = new Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Descargar el PDF
            $dompdf->stream("historial_odontologico_{$idUsuario}.pdf", [
                "Attachment" => true
            ]);
            exit;
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
}

function generarHTMLPDF($usuario, $historial)
{
    $nombreCompleto = htmlspecialchars($usuario['nombre']) . ' ' .
        htmlspecialchars($usuario['aPaterno']) . ' ' .
        htmlspecialchars($usuario['aMaterno']);

    $html = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Historial Odontológico - ' . $nombreCompleto . '</title>
        <style>
            body { font-family: Arial, sans-serif; }
            h1 { color: #2c3e50; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h1>Historial Odontológico</h1>
        <h2>Paciente: ' . $nombreCompleto . '</h2>
        <h3>Fecha de generación: ' . date('d/m/Y') . '</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Diagnóstico</th>
                    <th>Tratamiento</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($historial as $registro) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($registro['fecha']) . '</td>
                    <td>' . htmlspecialchars($registro['motivo']) . '</td>
                    <td>' . htmlspecialchars($registro['diagnostico']) . '</td>
                    <td>' . htmlspecialchars($registro['tratamiento']) . '</td>
                    <td>' . htmlspecialchars($registro['observacion']) . '</td>
                </tr>';
    }

    $html .= '</tbody>
        </table>
    </body>
    </html>';

    return $html;
}
