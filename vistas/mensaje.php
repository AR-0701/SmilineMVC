<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            text-align: center;
        }
        .modal h2 {
            margin-top: 0;
            color: #333;
        }
        .modal p {
            color: #555;
            margin: 10px 0 20px;
        }
        .modal button {
            background-color: #13cdbd;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .modal button:hover {
            background-color: #10b2a5;
        }
    </style>
</head>
<body>

    <!-- Modal Overlay -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <h2 id="modalTitle"></h2>
            <p id="modalMessage"></p>
            <button id="modalButton">Aceptar</button>
        </div>
    </div>

    <script>
        // Mostrar el modal con el mensaje correspondiente
        function showModal(title, message, redirectUrl) {
            const modalOverlay = document.getElementById('modalOverlay');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalButton = document.getElementById('modalButton');

            modalTitle.textContent = title;
            modalMessage.textContent = message;

            modalOverlay.style.display = 'flex';

            // Redireccionar al hacer clic en el botón
            modalButton.onclick = function () {
                window.location.href = redirectUrl;
            };
        }

        // Ejemplo de cómo llamar a la función desde PHP
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'no_horarios'): ?>
                showModal('Sin horarios disponibles', 'No hay horarios habilitados para el día seleccionado.', 'agendar.php');
            <?php elseif ($_GET['msg'] == 'cita_agendada'): ?>
                showModal('Cita agendada', 'Tu cita ha sido agendada exitosamente.', 'InicioClientes.php');
            <?php elseif ($_GET['msg'] == 'horario_ocupado'): ?>
                showModal('Horario ocupado', 'El horario seleccionado ya está ocupado. Por favor, elige otro.', 'agendar.php');
            <?php endif; ?>
        <?php endif; ?>
    </script>

</body>
</html>
