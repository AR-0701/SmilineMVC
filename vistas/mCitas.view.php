<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [3, 4]; // asistente y administrador
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
    <title>Ver Citas</title>
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

        /* Date Picker - Nuevos estilos para el formulario centrado */
        .date-form-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .date-form-group {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .date-form-group label {
            font-weight: 500;
            color: #00A99D;
            margin: 0;
            white-space: nowrap;
        }

        .date-form-group input {
            padding: 10px;
            border-radius: 8px;
            border: 3px solid #00A99D;
            transition: all 0.3s;
            height: 40px;
        }

        .date-form-group input:focus {
            border-color: #5a18ff;
            box-shadow: 0 0 0 0.25rem rgba(0, 169, 157, 0.25);
            outline: none;
        }

        .btn-form {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            height: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-form:hover {
            background-color: #008f8f;
            transform: translateY(-2px);
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .content-wrapper {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .sidebar:hover {
                width: 180px;
            }

            .sidebar:hover~.content-wrapper {
                margin-left: 180px;
                width: calc(100% - 180px);
            }

            .date-form-group {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                width: 100%;
            }

            .date-form-group label {
                margin-bottom: 0;
            }

            .btn-form {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

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

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
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

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #343a40;
            font-size: 22px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #00A99D;
            font-size: 1.6rem;
            z-index: 4;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 15px 12px 50px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: #00A99D;
            box-shadow: 0 0 0 0.25rem rgba(0, 169, 157, 0.25);
            outline: none;
        }

        .form-select-custom {
            width: 100%;
            padding: 12px 15px 12px 50px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            appearance: none;
            background-color: white;
        }

        .form-select-custom:focus {
            border-color: #00A99D;
            box-shadow: 0 0 0 0.25rem rgba(0, 169, 157, 0.25);
            outline: none;
        }

        .password-checklist {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            border: 1px solid #e9ecef;
        }

        .password-checklist p {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 10px;
        }

        .password-checklist ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .password-checklist li {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .password-checklist li i {
            margin-right: 8px;
            font-size: 0.8rem;
        }

        .password-checklist li.valid {
            color: #00A99D;
        }

        .password-checklist li.valid i {
            color: #00A99D;
        }

        .btn-primary-custom {
            background-color: #00A99D;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: white;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary-custom:hover {
            background-color: #008f8f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 169, 157, 0.3);
            color: white;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 5;
        }

        .is-invalid {
            border-color: #00756d !important;
        }

        .invalid-feedback {
            color: #00756d;
            font-size: 1.0rem;
            margin-top: 0.25rem;
        }

        /* Ajuste específico cuando el ícono está con textarea */
        .textarea-icon .input-icon {
            top: 15px;
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
                <a href="../public/principalAdmin.php" class="sidebar-menu-item active">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-menu-text">Inicio</span>
                </a>

                <a href="../public/mostrarClientes.php" class="sidebar-menu-item">
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

                <div class="sidebar-footer">
                    <form id="logoutForm" action="../controladores/ControladorUsuario.php" method="post" style="display: none;">
                        <input type="hidden" name="accion" value="logout">
                    </form>
                    <a href="#" onclick="document.getElementById('logoutForm').submit();" class="logout-btn" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
    </nav>



    <!-- Main Content -->
    <div class="content-wrapper">
        <main class="main-content">
            <div class="page-header fade-in">
                <div class="page-title">
                    <h1>Consultar Citas</h1>
                </div>
            </div>

            <div class="card fade-in delay-1">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Listado de Citas</h3>
                </div>
                <div class="card-body">
                    <div class="date-form-container fade-in delay-2">
                        <form id="dateForm" class="date-form-group">
                            <label for="fecha">Seleccionar Fecha:</label>
                            <input type="date" id="fecha" name="fecha" required>
                            <button class="btn-form" type="submit">
                                <i class="fas fa-search"></i> Buscar Citas
                            </button>
                        </form>
                    </div>

                    <div class="table-container fade-in delay-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Cita</th>
                                    <th>Nombre del Cliente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="citasTable">
                                <tr>
                                    <td colspan="5">Seleccione una fecha para ver las citas.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content p-3">

                <!-- Encabezado estilo "page-header" -->
                <div class="page-header">
                    <div class="page-title">
                        <h1 id="historialModalLabel"><i class="fas fa-list me-2"></i>Formulario de Identificación</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="form-label">ID de Cita</label>
                            <input type="text" class="form-control-custom" id="idCitaDebug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="form-label">Fecha</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-calendar-days input-icon"></i>
                                <input type="text" class="form-control-custom" id="Fecha" name="Fecha" required>
                            </div>
                        </div>

                        <div class="form-group textarea-icon">
                            <label class="form-label">Motivo de la cita</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-calendar-check input-icon"></i>
                                <textarea id="motivo" name="motivo" rows="4" class="form-control-custom"
                                    placeholder="Escriba el motivo..."></textarea>
                            </div>
                        </div>

                        <div class="form-group textarea-icon">
                            <label class="form-label">Diagnóstico</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-person-dots-from-line input-icon"></i>
                                <textarea id="diagnostico" name="diagnostico" rows="4" class="form-control-custom"
                                    placeholder="Escriba el diagnóstico..."></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-notes-medical input-icon"></i>
                                <select class="form-select-custom" id="tratamiento" name="tratamiento" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option>Tratamientos Preventivos</option>
                                    <option>Tratamientos Restaurativos</option>
                                    <option>Endodoncia</option>
                                    <option>Tratamientos Periodontales</option>
                                    <option>Ortodoncia</option>
                                    <option>Cirugía Oral</option>
                                    <option>Implantología</option>
                                    <option>Prótesis Dental</option>
                                    <option>Odontopediatría</option>
                                    <option>Estética Dental</option>
                                    <option>Odontología General</option>
                                    <option>Otros</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group textarea-icon">
                            <label class="form-label">Observación</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-magnifying-glass input-icon"></i>
                                <textarea id="observacion" name="observacion" rows="4" class="form-control-custom"
                                    placeholder="Escriba una observación..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary-custom">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cierre de Modal -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("dateForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const fecha = document.getElementById("fecha").value;
            if (!fecha) {
                alert("Por favor, selecciona una fecha.");
                return;
            }

            fetch("../controladores/controladorAsistentes.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `fecha=${encodeURIComponent(fecha)}`
                })
                .then(response => {
                    if (!response.ok) throw new Error("Error en la respuesta del servidor.");
                    return response.text();
                })
                .then(html => {
                    document.getElementById("citasTable").innerHTML = html;
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Hubo un problema al cargar las citas.");
                });
        });

        // Función para abrir el modal y precargar datos
        function abrirModalExpediente(idCita) {
            console.log("ID de cita recibido:", idCita);
            document.getElementById('idCitaDebug').value = idCita;

            fetch(`../controladores/controladorExpediente.php?action=getCitaData&idCita=${idCita}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error("Error del servidor:", data.message);
                        alert("Error: " + data.message);
                        return;
                    }

                    console.log("Datos de la cita:", data);
                    document.getElementById('Fecha').value = data.fecha;

                    if (data.expediente) {
                        document.getElementById('motivo').value = data.expediente.motivo || '';
                        document.getElementById('diagnostico').value = data.expediente.diagnostico || '';
                        document.getElementById('tratamiento').value = data.expediente.tratamiento || '';
                        document.getElementById('observacion').value = data.expediente.observacion || '';
                    } else {
                        // Limpia el formulario si no hay expediente
                        document.getElementById('motivo').value = '';
                        document.getElementById('diagnostico').value = '';
                        document.getElementById('tratamiento').value = '';
                        document.getElementById('observacion').value = '';
                    }

                    const modal = new bootstrap.Modal(document.getElementById('historialModal'));
                    modal.show();
                    document.querySelector('#historialModal form').dataset.idCita = idCita;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los datos de la cita');
                });
        }

        // Guardar datos del expediente al enviar formulario
        document.querySelector('#historialModal form').addEventListener('submit', function(event) {
            event.preventDefault();

            const idCita = this.dataset.idCita;
            const formData = {
                motivo: document.getElementById('motivo').value,
                diagnostico: document.getElementById('diagnostico').value,
                tratamiento: document.getElementById('tratamiento').value,
                observacion: document.getElementById('observacion').value
            };

            fetch('../controladores/controladorExpediente.php?action=guardarExpediente', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        idCita: idCita,
                        datos: formData
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Expediente guardado correctamente');

                        // Cerrar el modal de forma segura
                        const modalEl = document.getElementById('historialModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();

                        //  Solución: eliminar backdrop manualmente
                        document.body.classList.remove('modal-open');
                        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());

                        // (Opcional) Limpiar el formulario
                        modalEl.querySelector('form').reset();

                    } else {
                        alert('Error al guardar: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al guardar el expediente');
                });
        });

        // También asegura limpieza del backdrop al cerrar cualquier modal
        document.addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        });
    </script>

</body>

</html>