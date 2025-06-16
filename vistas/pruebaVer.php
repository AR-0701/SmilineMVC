<?php
// Verificar que las variables existan antes de usarlas
$nombreCompleto = isset($usuario['nombre']) ? 
    htmlspecialchars($paciente['nombre'].' '.$paciente['aPaterno'].' '.$paciente['aMaterno']) : 
    'Paciente no encontrado';
    
$idUsuario = isset($paciente['idUsuario']) ? htmlspecialchars($paciente['idUsuario']) : 'N/A';
$fNacimiento = isset($paciente['fNacimiento']) ? htmlspecialchars($paciente['fNacimiento']) : 'No especificada';
$genero = isset($paciente['genero']) ? htmlspecialchars($paciente['genero']) : 'No especificado';
?>

<div class="container historial-container">
    <div class="paciente-header">
        <h2>Historial Clínico</h2>
        <h3><?= $nombreCompleto ?></h3>
        <p>ID: <?= $idUsuario ?></p>
        <p>Fecha de Nacimiento: <?= $fNacimiento ?></p>
        <p>Género: <?= $genero ?></p>
    </div>
    
    <h4 class="mb-4">Registro de Consultas</h4>
    
    <?php if (empty($citas)): ?>
        <div class="alert alert-info">No hay citas registradas para este paciente.</div>
    <?php else: ?>
        <?php foreach ($citas as $cita): ?>
            <div class="cita-card">
                <div class="d-flex justify-content-between">
                    <h5>Cita del <?= htmlspecialchars($cita['dia']) ?> a las <?= htmlspecialchars($cita['hora']) ?></h5>
                    <a href="expediente.php?id=<?= $cita['idCita'] ?>" class="btn btn-sm btn-outline-primary">Ver/Editar</a>
                </div>
                
                <?php if (!empty($cita['motivo'])): ?>
                    <div class="mt-3">
                        <h6>Motivo:</h6>
                        <p><?= nl2br(htmlspecialchars($cita['motivo'])) ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($cita['diagnostico'])): ?>
                    <div class="mt-3">
                        <h6>Diagnóstico:</h6>
                        <p><?= nl2br(htmlspecialchars($cita['diagnostico'])) ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($cita['tratamiento'])): ?>
                    <div class="mt-3">
                        <h6>Tratamiento:</h6>
                        <p><?= nl2br(htmlspecialchars($cita['tratamiento'])) ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($cita['observacion'])): ?>
                    <div class="mt-3">
                        <h6>Observaciones:</h6>
                        <p><?= nl2br(htmlspecialchars($cita['observacion'])) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        
        <div class="text-center btn-descargar">
            <button class="btn btn-primary" onclick="generarPDF()">
                <i class="fas fa-download"></i> Descargar Historial Completo
            </button>
        </div>
    <?php endif; ?>
</div>