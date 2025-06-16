document.addEventListener('DOMContentLoaded', function() {
    // Manejar botones de expediente en la tabla de citas
    document.querySelectorAll('.btn-expediente').forEach(btn => {
        btn.addEventListener('click', function() {
            const idCita = this.dataset.id;
            window.location.href = `expediente.php?id=${idCita}`;
        });
    });

    // Manejar botones de historial en la tabla de pacientes
    document.querySelectorAll('.btn-historial').forEach(btn => {
        btn.addEventListener('click', function() {
            const idUsuario = this.dataset.id;
            window.location.href = `historial.php?id=${idUsuario}`;
        });
    });

    // Función para generar PDF (simulada)
    window.generarPDF = function() {
        // Implementación real requeriría una librería como jsPDF o una llamada AJAX
        alert('Generando PDF del historial...');
        // window.location.href = `generar_pdf.php?id=${idUsuario}`;
    };
});