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

    // Puedes reemplazar esto con el logo en base64 de tu empresa o una URL
    $logoEmpresa = '../imagenes/loogo.png';

    $html = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Historial Odontológico - ' . $nombreCompleto . '</title>
        <style>
            @page { margin: 2cm; }
            body { 
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 12px;
                color: #333;
                line-height: 1.4;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #2c3e50;
                padding-bottom: 15px;
            }
            .logo {
                height: 80px;
            }
            .titulo {
                color: #2c3e50;
                text-align: center;
                margin: 10px 0;
            }
            h1 {
                font-size: 18px;
                margin: 5px 0;
            }
            h2 {
                font-size: 16px;
                margin: 5px 0;
                color: #2c3e50;
            }
            .datos-paciente {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
                border: 1px solid #dee2e6;
            }
            .datos-paciente p {
                margin: 5px 0;
            }
            .registro {
                margin-bottom: 25px;
                page-break-inside: avoid;
            }
            .fecha-consulta {
                font-weight: bold;
                color: #2c3e50;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                margin-bottom: 10px;
            }
            .campo {
                margin-bottom: 10px;
            }
            .campo-titulo {
                font-weight: bold;
                color: #495057;
                margin-bottom: 3px;
            }
            .campo-valor {
                padding-left: 15px;
                text-align: justify;
            }
            .footer {
                margin-top: 30px;
                padding-top: 10px;
                border-top: 1px solid #ddd;
                font-size: 10px;
                text-align: center;
                color: #6c757d;
            }
        </style>
    </head>
    <body>
        <!-- Encabezado con logo -->
        <div class="header">
            <img src="' . $logoEmpresa . '" class="logo" alt="Logo Smile Line">
            <div>
                <h1>Smile Line - Clínica Dental</h1>
                <p>Calle Principal #123, Ciudad</p>
                <p>Teléfono: (555) 123-4567</p>
            </div>
        </div>
        
        <!-- Título principal -->
        <div class="titulo">
            <h1>HISTORIAL ODONTOLÓGICO</h1>
            <p>Fecha de generación: ' . date('d/m/Y H:i') . '</p>
        </div>
        
        <!-- Datos del paciente -->
        <div class="datos-paciente">
            <h2>DATOS DEL PACIENTE</h2>
            <p><strong>Nombre completo:</strong> ' . $nombreCompleto . '</p>
            <p><strong>Fecha de nacimiento:</strong> ' . (!empty($usuario['fNacimiento']) ? date('d/m/Y', strtotime($usuario['fNacimiento'])) : 'No registrada') . '</p>
            <p><strong>Correo electrónico:</strong> ' . htmlspecialchars($usuario['email'] ?? 'No registrado') . '</p>
        </div>
        
        <!-- Historial de consultas -->
        <h2>REGISTRO DE CONSULTAS</h2>';

    foreach ($historial as $registro) {
        $html .= '
        <div class="registro">
            <div class="fecha-consulta">Consulta del ' . htmlspecialchars($registro['fecha']) . '</div>
            
            <div class="campo">
                <div class="campo-titulo">Motivo de la consulta:</div>
                <div class="campo-valor">' . nl2br(htmlspecialchars($registro['motivo'])) . '</div>
            </div>
            
            <div class="campo">
                <div class="campo-titulo">Diagnóstico:</div>
                <div class="campo-valor">' . nl2br(htmlspecialchars($registro['diagnostico'])) . '</div>
            </div>
            
            <div class="campo">
                <div class="campo-titulo">Tratamiento realizado:</div>
                <div class="campo-valor">' . nl2br(htmlspecialchars($registro['tratamiento'])) . '</div>
            </div>
            
            <div class="campo">
                <div class="campo-titulo">Observaciones:</div>
                <div class="campo-valor">' . nl2br(htmlspecialchars($registro['observacion'])) . '</div>
            </div>
        </div>';
    }

    $html .= '
        <!-- Pie de página -->
        <div class="footer">
            <p>Smile Line © ' . date('Y') . ' - Todos los derechos reservados</p>
            <p>Documento generado electrónicamente - válido sin firma</p>
        </div>
    </body>
    </html>';

    return $html;
}
