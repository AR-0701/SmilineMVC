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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Horarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

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

        .schedule-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-container,
        .calendar-container {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #00A99D;
            outline: none;
        }

        .form-group input[readonly] {
            background-color: #f8f9fa;
        }

        .submit-btn {
            background-color: #00A99D;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 30px auto 0;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #008f8f;
        }

        /* Estilos del calendario - Versión más grande */
        #datepicker {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .ui-datepicker {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: none;
            font-size: 1.05rem;
            width: 100% !important;
        }

        .ui-datepicker-header {
            background: #00A99D;
            color: white;
            border-radius: 10px 10px 0 0;
            border: none;
            padding: 12px 0;
            font-size: 1.1rem;
        }

        .ui-datepicker-title {
            font-weight: 500;
        }

        .ui-datepicker-prev,
        .ui-datepicker-next {
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .ui-datepicker-calendar {
            width: 100%;
            margin: 0;
        }

        .ui-datepicker-calendar th {
            background: #f0f0f0;
            color: #333;
            padding: 10px;
            font-weight: 500;
        }

        .ui-datepicker-calendar td {
            padding: 5px;
        }

        .ui-datepicker-calendar td a {
            text-align: center;
            transition: all 0.3s;
            padding: 10px;
            display: block;
            border-radius: 6px;
            font-weight: 400;
        }

        .ui-datepicker-calendar td a:hover {
            background: #00A99D;
            color: white;
        }

        .ui-datepicker-calendar .ui-state-active {
            background: #00A99D;
            color: white;
            font-weight: 500;
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
                <a href="principalAdmin.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-menu-text">Inicio</span>
                </a>

                <a href="consultaCitasAdmin.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2m-4-4H9m4 0h4m-4 0v4m0 0H9m4 0h4" />
                    </svg>
                    <span class="sidebar-menu-text">Consultar Citas</span>
                </a>

                <a href="modificarHorarios.php" class="sidebar-menu-item active">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="sidebar-menu-text">Modificar Horarios</span>
                </a>

                <a href="verAsistentes.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="sidebar-menu-text">Ver Asistentes</span>
                </a>

                <a href="registrarAsistentes.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span class="sidebar-menu-text">Registrar Asistentes</span>

                </a>
                <a href="promocionesAdmin.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24" fill="none" stroke="#f3f1f1" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        <path d="M9.5 9h.01" />
                        <path d="M14.5 9h.01" />
                        <path d="M9.5 13a3.5 3.5 0 0 0 5 0" />
                    </svg>
                    <span class="sidebar-menu-text">ChatBot</span>
                </a>
                <a href="servicioAdmin.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4GuyTFeCP+5itCDCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrA3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEYrv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOf/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
                        alt="toothache--v1">
                    <span class="sidebar-menu-text">Servicios</span>
                </a>

                <a href="promocionesAdmin.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAnklEQVR4nO2TsQ2EMAxFGZGCEwXDQHlzHWIRGAOkhyJRpDgT25gCiS+liv1eYiVV9SYywAdYKeRWeMpVeH9SZxeghLsEQJvBhz/7EzC6BCV4SoIDP7PAMpY8KoEXrhJoxiIl1R99q1RQR8CBVipaboN7BWjhnhFhgWdNTSb5KuAb0KngWglX4CUJEXDpT+CZufEmMScXXtd8rDoU/ojsdG8Oel19OK4AAAAASUVORK5CYII="
                        alt="price-tag">
                    <span class="sidebar-menu-text">Promociones</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <a href="Logica/logout.php" class="logout-btn" title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- Contenido principal -->

    <div class="content-wrapper">
        <main class="main-content">
            <div class="page-header fade-in">
                <div class="page-title">
                    <h1>Modificar Horarios</h1>
                </div>
            </div>

            <div class="schedule-container fade-in delay-1">
                <div class="form-container fade-in delay-2">
                    <form id="formulario-horarios" action="../controladores/controladorModificar.php" method="POST">
                        <div class="form-group">
                            <label for="fechaSeleccionada">Fecha seleccionada:</label>
                            <input type="text" id="fechaSeleccionada" name="fechaSeleccionada" readonly>
                        </div>

                        <div class="form-group">
                            <label for="lista-horarios-apertura">Hora de apertura:</label>
                            <select id="lista-horarios-apertura" name="horariosIN" class="form-control">
                                <!-- Horarios dinámicos -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lista-horarios-cierre">Hora de cierre:</label>
                            <select id="lista-horarios-cierre" name="horariosCI" class="form-control">
                                <!-- Horarios dinámicos -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="disponibilidad">Estado:</label>
                            <select id="disponibilidad" name="disponibilidad" class="form-control">
                                <option value="disponible">Disponible</option>
                                <option value="ocupado">Ocupado</option>
                            </select>
                        </div>

                        <button type="submit" class="submit-btn">Guardar Cambios</button>
                    </form>
                </div>

                <div class="fade-in delay-3">
                    <div id="datepicker"></div>
                </div>
            </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function () {
            // Inicializar el datepicker
            $("#datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                onSelect: function (dateText) {
                    $("#fechaSeleccionada").val(dateText);
                    cargarHorariosDisponibles();
                }
            });

            // Función para cargar horarios (ejemplo)
            function cargarHorariosDisponibles() {
                $("#lista-horarios-apertura, #lista-horarios-cierre").empty();

                // Generar opciones de horario (de 8:00 AM a 8:00 PM cada 30 minutos)
                for (let h = 8; h <= 20; h++) {
                    for (let m = 0; m < 60; m += 30) {
                        const hora = `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
                        $("#lista-horarios-apertura").append(`<option value="${hora}">${hora}</option>`);
                        $("#lista-horarios-cierre").append(`<option value="${hora}">${hora}</option>`);
                    }
                }

                // Establecer valores por defecto (ejemplo: 9:00 - 18:00)
                $("#lista-horarios-apertura").val("09:00");
                $("#lista-horarios-cierre").val("18:00");
            }

            // Cargar horarios al iniciar (si hay fecha seleccionada)
            if ($("#fechaSeleccionada").val()) {
                cargarHorariosDisponibles();
            }
        });
    </script>
</body>

</html>