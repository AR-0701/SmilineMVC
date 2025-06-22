<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [1]; // Cliente
include '../controladores/ControladorUsuario.php';

$clienteLogueado = [
    'id' => $_SESSION['idUsuario'],
    'nombre' => $_SESSION['nombre'],
    'aMaterno' => $_SESSION['aMaterno'],
    'aPaterno' => $_SESSION['aPaterno'],
    'idRol' => $_SESSION['idRol']
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        padding-top: 30px;
          min-height: 100vh;
        margin: 0;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        width: 100%;
        max-width: 1200px;
        margin: 80px auto;
        padding: -4px;
        /*  ajustar el contenido de abajo*/
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    h1 {
        font-size: 2.8rem;
        font-weight: bold;
        color: black;
        text-align: center;
        margin-bottom: 20px;
        margin: 15px;
    }

    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(21, 21, 21, 0.1);
    }

    .card-header {
        background-color: #00A99D;
        ;
        color: #fff;
        font-weight: bold;
        font-size: 1.2rem;
        border-radius: 8px 8px 0 0;
    }

    .btn-primary {
        background-color: #00A99D;
        ;
        border-color: #00A99D;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #00837A;
        border-color: #00837A;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="Titulo modify-title">
            <h1 class="text-center">Agenda tu Cita</h1>
        </div>

        <!-- Agendar Cita -->
        <div class="card mb-4">
            <div class="card-header"></div>
            <div class="card-body">
                <form method="POST" action="../controladores/controladorClientes.php" id="agendarCitaForm">
                    <input type="hidden" name="accion" value="agendar"> <!-- 🔴 ESTE CAMPO ES CLAVE -->

                    <p><strong>ID Cliente:</strong> <?php echo htmlspecialchars($clienteLogueado['id']); ?></p>

                    <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($clienteLogueado['id']); ?>">

                    <div class="mb-3">
                        <label for="nombreCliente" class="form-label">Nombre del Cliente:</label>
                        <input type="text" class="form-control" id="nombreCliente"
                            value="<?php echo htmlspecialchars($clienteLogueado['nombre'] . ' ' . $clienteLogueado['aPaterno'] . ' ' . $clienteLogueado['aMaterno']); ?>"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <?php
                        $hoy = date('Y-m-d');
                        $manana = date('Y-m-d', strtotime($hoy . ' +1 day'));
                        $limite = date('Y-m-d', strtotime($hoy . ' +7 day'));
                        ?>
                        <input type="date" class="form-control" id="dia" name="dia" required
                            min="<?php echo $manana; ?>" max="<?php echo $limite; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora:</label>
                        <select class="form-select" id="hora" name="hora" required>
                            <?php
                            for ($hora = 9; $hora <= 21; $hora++) {
                                echo "<option value=\"$hora:00:00\">$hora:00</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Agendar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include '../chatbot/index.php'; ?>

</body>


</html>