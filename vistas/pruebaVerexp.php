<?php include '../../header.php'; ?>

<div class="container expediente-container">
    <h2 class="text-center mb-4">Expediente Clínico</h2>
    
    <div class="paciente-info">
        <h4>Paciente: <?= htmlspecialchars($cita['nombre_completo']) ?></h4>
        <p>Cita ID: <?= htmlspecialchars($idCita) ?></p>
        <p>Fecha: <?= htmlspecialchars($cita['dia']) ?></p>
        <p>Hora: <?= htmlspecialchars($cita['hora']) ?></p>
    </div>
    
    <?php if (isset($_GET['guardado'])): ?>
        <div class="alert alert-success">Expediente guardado correctamente.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Error al guardar el expediente.</div>
    <?php endif; ?>
    
    <form method="POST" action="expediente.php?action=guardar">
        <input type="hidden" name="idCita" value="<?= $idCita ?>">
        
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo de la consulta:</label>
            <textarea class="form-control" id="motivo" name="motivo" required><?= 
                htmlspecialchars($expediente['motivo']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico:</label>
            <textarea class="form-control" id="diagnostico" name="diagnostico"><?= 
                htmlspecialchars($expediente['diagnostico']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="tratamiento" class="form-label">Tratamiento:</label>
            <textarea class="form-control" id="tratamiento" name="tratamiento"><?= 
                htmlspecialchars($expediente['tratamiento']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="observacion" class="form-label">Observaciones:</label>
            <textarea class="form-control" id="observacion" name="observacion"><?= 
                htmlspecialchars($expediente['observacion']) ?></textarea>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Guardar Expediente</button>
            <a href="mCitas.php" class="btn btn-secondary">Volver a Citas</a>
        </div>
    </form>
</div>

<?php include '../../footer.php'; ?>