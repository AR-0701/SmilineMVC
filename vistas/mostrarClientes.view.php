<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [3]; // asistente
include '../controladores/ControladorUsuario.php';

$clienteLogueado = [
    'id' => $_SESSION['idUsuario'],
    'nombre' => $_SESSION['nombre'],
    'aMaterno' => $_SESSION['aMaterno'],
    'aPaterno' => $_SESSION['aPaterno'],
    'idRol' => $_SESSION['idRol']
];
$clientes = [];
include '../controladores/controladorVerClientes.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles */

        .sidebar {
            width: 80px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #00A99D;
            color: white;
            transition: width 0.3s;
            overflow: hidden;
            z-index: 1000;
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
        }

        .sidebar-logo-text {
            margin-left: 10px;
            font-weight: 700;
            white-space: nowrap;
            display: none;
        }

        .sidebar:hover .sidebar-logo-text {
            display: block;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
        }

        .sidebar-menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            white-space: nowrap;
        }

        .sidebar-menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar-menu-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .sidebar-menu-text {
            display: none;
        }

        .sidebar:hover .sidebar-menu-text {
            display: block;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .sidebar.collapsed .logout-btn {
            width: 45px;
            height: 45px;
        }


        .content-wrapper {
            margin-left: 80px;
            width: calc(100% - 80px);
            transition: margin-left 0.3s;
        }

        .sidebar:hover~.content-wrapper {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        .sidebar-menu-item img {
            width: 29px;
            height: 29px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .sidebar-menu-icon {
            width: 24px;
            height: 24px;
            margin-right: 15px;
            flex-shrink: 0;
        }


        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 100px;
            padding: 20px;
            transition: all 0.3s ease;
        }


        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #E9ECEF;
        }

        .page-title h1 {
            color: #00A99D;
            font-weight: 600;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .page-title h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, #00A99D, #5a18ff);
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #00A99D;
            color: white;
            padding: 15px 25px;
            border-bottom: none;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #00A99D, #5a18ff);
        }

        .card-title {
            font-weight: 500;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            text-align: center;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
            border-bottom: #008f8f 2px solid;
        }

        .table thead th {
            background: #00A99D;
            color: rgb(6, 6, 6);
            padding: 15px;
            font-weight: 500;
            border: #f6fafa 1px solid;
            position: sticky;
            top: 0;
            z-index: 10;
            font-weight: bold;
        }

        .table tbody tr {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            ;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 201, 255, 0.05);
            transform: translateX(5px);
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #000;
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }


        /* Button Styles */
        .btn-primary {
            background-color: #00A99D;
            border-color: #00A99D;
        }

        .btn-primary:hover {
            background-color: #008f8f;
            border-color: #008f8f;
        }

        .btn-outline-primary {
            color: #00A99D;
            border-color: #00A99D;
        }

        .btn-outline-primary:hover {
            background-color: #00A99D;
            color: white;
        }

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            padding-left: 45px;
            border-radius: 8px;
            border: 3px solid #008f8f;
            height: 45px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }

        .search-box input:focus {
            border-color: #5a18ff;
            border: 3px solid #5a18ff;
            box-shadow: 0 20px 20px rgba(0, 201, 255, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #00A99D;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
                /* más pequeño */
            }

            .content-wrapper {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .main-content {
                margin-left: 60px;
            }

            .sidebar:hover {
                width: 180px;
            }

            .sidebar:hover~.content-wrapper {
                margin-left: 180px;
                width: calc(100% - 180px);
            }
        }


        /* Action Buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 169, 157, 0.1);
            color: #00A99D;
            border: none;
            margin: 0 5px;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: #00A99D;
            color: white;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        #historialModal .table thead th {
            text-align: center;
            vertical-align: middle;
        }

        /* Modal Agendar Cita */
        .boton {
            background-color: #00A99D;
            border-color: #00A99D;
            color: white;
            padding: 0.70rem 1.2rem;
            font-size: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .boton:hover {
            background-color: #00837A;
            border-color: #00837A;
            color: white;
        }

        .boton:focus,
        .boton:active,
        .boton:focus:active {
            outline: none !important;
            box-shadow: none !important;
            background-color: #00837A !important;
            /* mismo color del hover */
            border-color: #00837A !important;
            color: white !important;
        }
    </style>
</head>

<body>

    <!-- Menú lateral -->
    <nav class="sidebar">
        <div class="sidebar-nav">
            <div class="sidebar-header">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABM0lEQVR4nO2WTW7CMBSELc5RCLBMt2VbFSFR6DJt7oBQL9nCAlqOVPShV3kRGZM4fuZnwUjexB577PiNx5hbAtABHoECKJ0m33IZEzhXH3izLQsh9IA1zVgB3Zp5JsDOw/sBxnU7XwcsXhVxdBLAJ7Cv4f0BS5+AnPYYeXZet3hVxIsroIgQ8O7M8duCu3UFlBECygp/GMHvpxQwj+C/phQwi+BPUwoYRPCz1JdQ6jwUm3OU4diWWBNkzLPPiFYtFv86YUTLBhHSt3B5/xB7DRTxDTyYExCTkTr38DZHO3dhT+LJ8xBJ+7B9oY9RZqtDWi+Ec4fR5gEVH2UeUPFR5gF1nkBpRGojQ2nFaitH/xip+OYugBv4BcW1L2F+7TLsaPJAkjyBMg8kyRMo80DKPHExHAB+w2OBcnDq2wAAAABJRU5ErkJggg=="
                    alt="external-application-user-interface-basic-anggara-glyph-anggara-putra">
                <span class="sidebar-logo-text">Smile Line</span>
            </div>

            <div class="sidebar-menu">
                <a href="../public/principalAsis.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-menu-text">Inicio</span>
                </a>

                <a href="../public/mostrarClientes.php" class="sidebar-menu-item active">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="sidebar-menu-text">Pacientes</span>
                </a>

                <a href="../public/mCitas.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2m-4-4H9m4 0h4m-4 0v4m0 0H9m4 0h4" />
                    </svg>
                    <span class="sidebar-menu-text">Citas</span>
                </a>

                <a href="../public/servicioAsis.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4GuyTFeCP+5itADCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrA3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEYrv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOf/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
                        alt="toothache--v1">
                    <span class="sidebar-menu-text">Servicios</span>
                </a>

                <a href="../public/promocionesAsis.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAnklEQVR4nO2TsQ2EMAxFGZGCEwXDQHlzHWIRGAOkhyJRpDgT25gCiS+liv1eYiVV9SYywAdYKeRWeMpVeH9SZxeghLsEQJvBhz/7EzC6BCV4SoIDP7PAMpY8KoEXrhJoxiIl1R99q1RQR8CBVipaboN7BWjhnhFhgWdNTSb5KuAb0KngWglX4CUJEXDpT+CZufEmMScXXtd8rDoU/ojsdG8Oel19OK4AAAAASUVORK5CYII="
                        alt="price-tag">
                    <span class="sidebar-menu-text">Promociones</span>
                </a>
            </div>


            <div class="sidebar-footer">
                <form id="logoutForm" action="../controladores/ControladorUsuario.php" method="post">
                    <input type="hidden" name="accion" value="logout">
                    <button type="submit" class="logout-btn" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header fade-in">
            <div class="page-title">
                <h1>Gestión de Clientes</h1>
            </div>
        </div>

        <div class="card fade-in delay-1">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Listado de Clientes</h3>
                <a href="../public/registroClien.php" class="btn btn-primary btn-sm float-end">
                    <i class="fas fa-plus"></i> Nuevo Cliente
                </a>
            </div>
            <div class="card-body">
                <div class="search-box fade-in delay-2">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, correo...">
                </div>

                <div class="table-container fade-in delay-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Correo Electrónico</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="clientTableBody">
                            <?php
                            foreach ($clientes as $cliente) { ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($cliente['idUsuario']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['aPaterno'] . ' ' . $cliente['aMaterno']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($cliente['email']); ?>
                                    </td>
                                    <td>
                                        <button type="button" class="action-btn btn-schedule agendarCitaBtn"
                                            data-id="<?php echo htmlspecialchars($cliente['idUsuario']); ?>"
                                            data-nombre="<?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['aPaterno'] . ' ' . $cliente['aMaterno']); ?>"
                                            data-bs-toggle="modal" data-bs-target="#modalAgendarCita">
                                            <i class="fas fa-calendar-plus"></i>
                                        </button>

                                        <button class="action-btn btn-schedule" data-bs-toggle="modal"
                                            data-bs-target="#historialModal" title="Ver Historial"
                                            data-id="<?php echo htmlspecialchars($cliente['idUsuario']); ?>">
                                            <i class="fa-solid fa-book-medical"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Agendar Cita -->
    <div class="modal fade" id="modalAgendarCita" tabindex="-1" aria-labelledby="modalAgendarCitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content p-3">
                <!-- Estilo de encabezado personalizado -->
                <div class="page-header d-flex justify-content-between align-items-center">
                    <div class="page-title">
                        <h1 id="modalAgendarCitaLabel" class="m-0">
                            <i class="fas fa-calendar-plus me-2"></i>Agendar cita
                        </h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Cuerpo del modal con el formulario -->
                <div class="modal-body">
                    <form method="POST" action="../controladores/controladorClientes.php" id="agendarCitaForm">
                        <input type="hidden" name="accion" value="agendar">
                        <input type="hidden" id="idUsuario" name="idUsuario">

                        <div class="mb-3">
                            <label for="dia" class="form-label">Fecha:</label>
                            <?php
                            $hoy = date('Y-m-d');
                            $manana = date('Y-m-d', strtotime($hoy . ' +1 day'));
                            $limite = date('Y-m-d', strtotime($hoy . ' +7 day'));
                            ?>
                            <input type="date" class="form-control" id="dia" name="dia" required min="<?php echo $manana; ?>" max="<?php echo $limite; ?>">
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

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn boton" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn boton">Agendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Historial-->
    <div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content p-3">
                <div class="page-header">
                    <div class="page-title">
                        <h1 id="historialModalLabel"><i class="fas fa-list me-2"></i>Historial odontologico</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Motivo</th>
                                    <th>Diagnóstico</th>
                                    <th>Tratamiento</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody id="historialTableBody">
                                <tr>
                                    <td colspan="5">Cargando historial...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Funcionalidad de  búsqueda
        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toLowerCase();
            var rows = document.querySelectorAll('#clientTableBody tr');
            rows.forEach(row => {
                var nombreCompleto = row.cells[1].innerText.toLowerCase();
                if (nombreCompleto.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Redirigir al hacer clic en el botón "Agendar Cita"
        document.querySelectorAll('.agendarCitaBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nombre = this.getAttribute('data-nombre');

                // Insertar en el formulario del modal
                document.getElementById('idUsuario').value = id;
                document.getElementById('modalAgendarCitaLabel').textContent = `Agendar cita para ${nombre}`;
            });
        });

        // Manejar clic en botón de historial
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-bs-target="#historialModal"]')) {
                const button = e.target.closest('[data-bs-target="#historialModal"]');
                const idUsuario = button.dataset.id;
                cargarHistorial(idUsuario);
            }
        });

        function cargarHistorial(idUsuario) {
            fetch(`../controladores/controladorHistorial.php?action=obtenerHistorial&idUsuario=${idUsuario}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.message);
                    }

                    const tbody = document.getElementById('historialTableBody');
                    tbody.innerHTML = '';

                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5">No hay registros de historial</td></tr>';
                        return;
                    }

                    data.data.forEach(registro => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${registro.fecha || ''}</td>
                    <td>${registro.motivo || ''}</td>
                    <td>${registro.diagnostico || ''}</td>
                    <td>${registro.tratamiento || ''}</td>
                    <td>${registro.observacion || ''}</td>
                `;
                        tbody.appendChild(row);
                    });

                    // Actualizar botón de descarga PDF
                    const modalTitle = document.getElementById('historialModalLabel');
                    modalTitle.innerHTML = `<i class="fas fa-list me-2"></i>Historial odontológico 
                                  <a href="../controladores/controladorHistorial.php?action=generarPDF&idUsuario=${idUsuario}" 
                                     class="btn btn-primary btn-sm ms-3">
                                     <i class="fas fa-file-pdf"></i> Descargar PDF
                                  </a>`;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar el historial: ' + error.message);
                });
        }
    </script>
</body>

</html>