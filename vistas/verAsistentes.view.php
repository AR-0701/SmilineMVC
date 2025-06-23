    <?php
    $_POST['accion'] = 'validarRol';
    $_POST['roles'] = [4]; // asistente
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
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consulta de Asistentes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #e0f7fa;
                margin: 0;
                padding: 0;
            }

            /* Estilos para el menú lateral */


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
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
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
        </style>
    </head>

    <body>

        <!-- Menú lateral -->
        <nav class="sidebar">
            <div class="sidebar-nav">
                <div class="sidebar-header">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABM0lEQVR4nO2WTW7CMBSELc5RCLBMt2VbFSFR6DJt7oBQL9nCAlqOVPShV3kRGZM4fuZnwUjexB577PiNx5hbAtABHoECKJ0m33IZEzhXH3izLQsh9IA1zVgB3Zp5JsDOw/sBxnU7XwcsXhVxdBLAJ7Cv4f0BS5+AnPYYeXZet3hVxIsroIgQ8O7M8duCu3UFlBECygp/GMHvpxQwj+C/phQwi+CPUwoYRPCz1JdQ6jwUm3OU4diWWBNkzLPPiFYtFv86YUTLBhHSt3B5/xB7DRTxDTyYExCTkTr38DZHO3dhT+LJ8xBJ+7B9oY9RZqtDWi+Ec4fR5gEVH2UeUPFR5gF1nkBpRGojQ2nFaitH/xip+OYugBv4BcW1L2F+7TLsaPJAkjyBMg8kyRMo80DKPHExHAB+w2OBcnDq2wAAAABJRU5ErkJggg=="
                        alt="external-application-user-interface-basic-anggara-glyph-anggara-putra">
                    <span class="sidebar-logo-text">Smile Line</span>
                </div>

                <div class="sidebar-menu">
                    <a href="../public/principalAdmin.php" class="sidebar-menu-item">
                        <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="sidebar-menu-text">Inicio</span>
                    </a>

                    <a href="../public/mCitasAdmin.php" class="sidebar-menu-item">
                        <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2m-4-4H9m4 0h4m-4 0v4m0 0H9m4 0h4" />
                        </svg>
                        <span class="sidebar-menu-text">Consultar Citas</span>
                    </a>

                    <a href="../public/mHorario.php" class="sidebar-menu-item">
                        <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="sidebar-menu-text">Modificar Horarios</span>
                    </a>

                    <a href="../public/verAsistentes.php" class="sidebar-menu-item active">
                        <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="sidebar-menu-text">Ver Asistentes</span>
                    </a>

                    <a href="../public/registroAsis.php" class="sidebar-menu-item">
                        <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="sidebar-menu-text">Registrar Asistentes</span>
                    </a>

                    <a href="../public/servicioAdmin.php" class="sidebar-menu-item">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4EuyTFeCP+5itCDCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrA3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEarv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOf/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
                            alt="toothache--v1">
                        <span class="sidebar-menu-text">Servicios</span>
                    </a>

                    <a href="../public/promocionesAdmin.php" class="sidebar-menu-item">
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
                    <h1>Gestión de Asistentes</h1>
                </div>
            </div>

            <div class="card fade-in delay-1">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list"></i> Listado de Asistentes</h3>
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
                                </tr>
                            </thead>
                            <tbody id="clientTableBody">
                                <?php
                                include '../modelo/modeloVerAsis.php';
                                if (!isset($clientes) || !is_array($clientes)) {
                                    $clientes = [];
                                }
                                foreach ($clientes as $cliente) { ?>
                                    <tr>
                                        <td>
                                            <?php echo htmlspecialchars($cliente['idc']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['aPaterno'] . ' ' . $cliente['aMaterno']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($cliente['correo']); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                // Espera que el documento esté completamente cargado
                document.addEventListener('DOMContentLoaded', function() {
                    const input = document.getElementById('searchInput');
                    const tableBody = document.getElementById('clientTableBody');
                    const rows = tableBody.getElementsByTagName('tr');

                    input.addEventListener('keyup', function() {
                        const filtro = input.value.toLowerCase();

                        Array.from(rows).forEach(row => {
                            const textoFila = row.textContent.toLowerCase();
                            row.style.display = textoFila.includes(filtro) ? '' : 'none';
                        });
                    });
                });
            </script>

    </body>

    </html>