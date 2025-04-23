<?php
$rolesPermitidos = [1,3,4]; // rol Cliente, Asistente y Admin
include 'logica/validarLogin.php';
include 'logica/conexion.php';

// Datos del cliente logueado
$clienteLogueado = [
    'id' => $_SESSION['idUsuario'],
    'nombre' => $_SESSION['nombre'],
    'aMaterno' => $_SESSION['aMaterno'],
    'aPaterno' => $_SESSION['aPaterno'],
    'idRol' => $_SESSION['idRol']
];

// Consultar citas pendientes para el cliente
// Consultar citas pendientes para el cliente desde hoy en adelante
$query = "SELECT Citas.idCita, Citas.dia, Horarios.hApertura, Horarios.hCierre 
          FROM Citas 
          JOIN Horarios ON Citas.idHorario = Horarios.idHorario
          WHERE Citas.idUsuario = ? 
          AND Citas.estado = 'pendiente' 
          AND Citas.dia >= CURDATE()";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $clienteLogueado['id']);
$stmt->execute();
$result = $stmt->get_result();


// Guardar resultados en un arreglo
$citasPendientes = [];
while ($row = $result->fetch_assoc()) {
    $citasPendientes[] = $row;
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        padding-top: 50px;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        width: 100%;
        max-width: 1200px;
        margin: 52px auto;
        padding: -8px;
        /*  ajustar el contenido de abajo*/
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    /* Estilo de la tabla */
    .table-container {
        width: 100%;
        overflow-x: auto;
        margin-top: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #00A99D;
        text-align: center;
    }

    table th {
        background-color: #00A99D;
    }

    tr.selected {
        background-color: #00A99D;
    }

    .button1 button {
        padding: 10px 20px;
        background-color: #00A99D;
        color: black;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-left: 20px;
        margin-top: -90px;
        margin-bottom: 15px;
    }

    .button1 button:hover {
        background-color: #008f8f;
    }

    .main {
        flex: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;

    }

    .main .about {
        margin-bottom: 20px;
    }

    .main .delete-form {
        margin-bottom: 20px;
    }

    .main .delete-form-group {
        display: flex;
        flex-direction: row;
        /* Cambiado a 'row' para alinear horizontalmente */
        align-items: center;
        /* Alinea verticalmente en el centro */
        margin-bottom: 10px;
    }

    .main .delete-form-group label {
        margin-bottom: 0;
        /* Remueve el margen inferior para alinear con el input */
        font-size: 20px;
        margin-right: 10px;
        /* Añade un margen derecho para separar el label del input */
    }

    .main .delete-form-group input {
        padding: 8px;
        width: 100px;
        max-width: 100%;
    }

    .main button {
        padding: 10px 20px;
        background-color: #00A99D;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-left: 70px;
        margin-top: 12px;
        margin-bottom: 15px;
    }

    .main button:hover {
        background-color: #00837A;
    }

    input[type="date"] {
        width: 40%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
    }

    h1 {
        font-size: 2.8rem;
        font-weight: bold;
        color: black;
        text-align: center;
        margin-bottom: 20px;
        margin: 15px;
    }

</style>

<body>
    <div class="container">
        <header>
            <!-- Encabezado de la página -->
        </header>
        <main class="main">
            <div class="about">
                <div class="text-content">
                    <div class="Titulo modify-title">
                        <h1>Consultar Citas</h1>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nombreCompleto">Nombre completo:</label>
                <input type="text" id="nombreCompleto" name="nombreCompleto"
                    value="<?php echo htmlspecialchars($clienteLogueado['nombre'] . ' ' . $clienteLogueado['aPaterno'] . ' ' . $clienteLogueado['aMaterno']); ?>"
                    readonly>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Cita</th>
                            <th>Fecha</th>
                            <th>Hora de Apertura</th>
                            <th>Hora de Cierre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($citasPendientes) > 0): ?>
                            <?php foreach ($citasPendientes as $cita): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($cita['idCita']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['dia']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['hApertura']); ?></td>
                                    <td><?php echo htmlspecialchars($cita['hCierre']); ?></td>
                                    <td>
                                        <form action="logica/eliminarCita.php" method="POST">
                                            <input type="hidden" name="idCita" value="<?php echo htmlspecialchars($cita['idCita']); ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No hay citas pendientes.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <footer>
        </footer>
    </div>
</body>

</html>