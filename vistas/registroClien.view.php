<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
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
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4GuyTHeCP+5itADCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrA3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEYrv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOf/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
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
                    <h1>Registro de Clientes</h1>
                </div>
            </div>

            <div class="card fade-in delay-1">

                <div class="card-body fade-in delay-2">
                    <!-- Mostrar mensaje de error si existe -->
                    <div id="errorMessage" class="alert alert-danger d-none" role="alert"></div>

                    <form id="registrationForm" method="POST" action="../controladores/controladorRegistros.php"
                        onsubmit="return validarFormulario()">
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <!-- Información de contacto -->
                                <div class="form-group">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" class="form-control-custom" id="email" name="email"
                                            placeholder="ejemplo@dominio.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="tel" class="form-control-custom" id="phone" name="phone"
                                            placeholder="Número de teléfono (10 dígitos)" pattern="[0-9]{10}"
                                            maxlength="10" required>
                                    </div>
                                    <div id="phoneError" class="invalid-feedback d-block"></div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" class="form-control-custom" id="password" name="password"
                                            placeholder="Crea una contraseña" required>
                                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" class="form-control-custom" id="confirmPassword"
                                            name="confirmPassword" placeholder="Repite tu contraseña" required>
                                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                                    </div>
                                    <div id="passwordError" class="invalid-feedback d-block"></div>
                                </div>

                                <!-- Checklist de contraseña -->
                                <div class="password-checklist">
                                    <p>La contraseña debe cumplir con:</p>
                                    <ul>
                                        <li id="check-length"><i class="far fa-circle"></i> Al menos 8 caracteres</li>
                                        <li id="check-uppercase"><i class="far fa-circle"></i> Al menos una letra
                                            mayúscula
                                        </li>
                                        <li id="check-number"><i class="far fa-circle"></i> Al menos un número</li>
                                        <li id="check-symbol"><i class="far fa-circle"></i> Al menos un símbolo</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <!-- Información personal -->
                                <div class="form-group">
                                    <label for="firstName" class="form-label">Nombre</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" class="form-control-custom" id="firstName" name="firstName"
                                            placeholder="Nombre(s)" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lastName" class="form-label">Apellido Paterno</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" class="form-control-custom" id="lastName" name="lastName"
                                            placeholder="Apellido paterno" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="motherLastName" class="form-label">Apellido Materno</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" class="form-control-custom" id="motherLastName"
                                            name="motherLastName" placeholder="Apellido materno" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="form-label">Género</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-venus-mars input-icon"></i>
                                        <select class="form-select-custom" id="gender" name="gender" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="male">Masculino</option>
                                            <option value="female">Femenino</option>
                                            <option value="other">Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-birthday-cake input-icon"></i>
                                        <input type="date" class="form-control-custom" id="birthdate" name="birthdate"
                                            required>
                                    </div>
                                    <div id="birthdateError" class="invalid-feedback d-block"></div>
                                </div>

                                <!-- Botón de registro -->
                                <button type="submit" class="btn-primary-custom" id="Registrar">
                                    <i class="fas fa-user-plus me-2"></i>Registrar Cliente
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Bootstrap JS Bundle with Popper -->
                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Mostrar/ocultar contraseña
                        const togglePassword = document.querySelector('#togglePassword');
                        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
                        const password = document.querySelector('#password');
                        const confirmPassword = document.querySelector('#confirmPassword');

                        if (togglePassword) {
                            togglePassword.addEventListener('click', function () {
                                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                password.setAttribute('type', type);
                                this.classList.toggle('fa-eye-slash');
                            });
                        }

                        if (toggleConfirmPassword) {
                            toggleConfirmPassword.addEventListener('click', function () {
                                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                                confirmPassword.setAttribute('type', type);
                                this.classList.toggle('fa-eye-slash');
                            });
                        }

                        // Validar criterios de la contraseña
                        const passwordInput = document.getElementById('password');
                        const criteria = {
                            length: document.getElementById('check-length'),
                            uppercase: document.getElementById('check-uppercase'),
                            number: document.getElementById('check-number'),
                            symbol: document.getElementById('check-symbol')
                        };

                        passwordInput.addEventListener('input', function () {
                            const value = passwordInput.value;

                            // Validar longitud
                            if (value.length >= 8) {
                                criteria.length.querySelector('i').className = 'fas fa-check-circle';
                                criteria.length.classList.add('valid');
                            } else {
                                criteria.length.querySelector('i').className = 'far fa-circle';
                                criteria.length.classList.remove('valid');
                            }

                            // Validar mayúscula
                            if (/[A-Z]/.test(value)) {
                                criteria.uppercase.querySelector('i').className = 'fas fa-check-circle';
                                criteria.uppercase.classList.add('valid');
                            } else {
                                criteria.uppercase.querySelector('i').className = 'far fa-circle';
                                criteria.uppercase.classList.remove('valid');
                            }

                            // Validar número
                            if (/\d/.test(value)) {
                                criteria.number.querySelector('i').className = 'fas fa-check-circle';
                                criteria.number.classList.add('valid');
                            } else {
                                criteria.number.querySelector('i').className = 'far fa-circle';
                                criteria.number.classList.remove('valid');
                            }

                            // Validar símbolo
                            if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
                                criteria.symbol.querySelector('i').className = 'fas fa-check-circle';
                                criteria.symbol.classList.add('valid');
                            } else {
                                criteria.symbol.querySelector('i').className = 'far fa-circle';
                                criteria.symbol.classList.remove('valid');
                            }
                        });

                        // Validar que las contraseñas coincidan
                        confirmPassword.addEventListener('input', function () {
                            if (password.value !== confirmPassword.value) {
                                document.getElementById('passwordError').textContent = 'Las contraseñas no coinciden';
                                confirmPassword.classList.add('is-invalid');
                            } else {
                                document.getElementById('passwordError').textContent = '';
                                confirmPassword.classList.remove('is-invalid');
                            }
                        });

                        // Validar fecha de nacimiento
                        document.getElementById('birthdate').addEventListener('change', function () {
                            const birthdate = new Date(this.value);
                            const today = new Date();
                            let age = today.getFullYear() - birthdate.getFullYear();
                            const monthDiff = today.getMonth() - birthdate.getMonth();

                            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                                age--;
                            }

                            if (age < 18) {
                                document.getElementById('birthdateError').textContent = 'El cliente debe ser mayor de 18 años';
                                this.classList.add('is-invalid');
                            } else {
                                document.getElementById('birthdateError').textContent = '';
                                this.classList.remove('is-invalid');
                            }
                        });

                        // Validar campo de teléfono (solo números y exactamente 10 dígitos)
                        const phoneInput = document.getElementById('phone');
                        const phoneError = document.getElementById('phoneError');

                        // Evitar que se ingresen caracteres no numéricos
                        phoneInput.addEventListener('input', function (e) {
                            this.value = this.value.replace(/[^0-9]/g, '');

                            // Validar longitud exacta de 10 dígitos
                            if (this.value.length > 10) {
                                this.value = this.value.slice(0, 10);
                            }

                            // Mostrar/ocultar mensaje de error
                            if (this.value.length !== 10 && this.value.length > 0) {
                                phoneError.textContent = 'El teléfono debe tener 10 dígitos';
                                this.classList.add('is-invalid');
                            } else {
                                phoneError.textContent = '';
                                this.classList.remove('is-invalid');
                            }
                        });

                        // Validar al perder el foco
                        phoneInput.addEventListener('blur', function () {
                            if (this.value.length !== 10 && this.value.length > 0) {
                                phoneError.textContent = 'El teléfono debe tener 10 dígitos';
                                this.classList.add('is-invalid');
                            }
                        });
                    });

                    // Validación final del formulario
                    function validarFormulario() {
                        const email = document.getElementById('email').value;
                        const password = document.getElementById('password').value;
                        const confirmPassword = document.getElementById('confirmPassword').value;
                        const phone = document.getElementById('phone').value;
                        const birthdate = document.getElementById('birthdate').value;
                        const errorMessage = document.getElementById('errorMessage');

                        // Validar email
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email)) {
                            errorMessage.textContent = 'Por favor, ingrese un correo electrónico válido.';
                            errorMessage.classList.remove('d-none');
                            return false;
                        }

                        // Validar teléfono
                        const phoneRegex = /^[0-9]{10}$/;
                        if (!phoneRegex.test(phone)) {
                            errorMessage.textContent = 'El teléfono debe tener exactamente 10 dígitos numéricos.';
                            errorMessage.classList.remove('d-none');
                            document.getElementById('phoneError').textContent = 'El teléfono debe tener 10 dígitos';
                            document.getElementById('phone').classList.add('is-invalid');
                            return false;
                        }

                        // Validar contraseñas coincidan
                        if (password !== confirmPassword) {
                            errorMessage.textContent = 'Las contraseñas no coinciden.';
                            errorMessage.classList.remove('d-none');
                            return false;
                        }

                        // Validar criterios de contraseña
                        const passwordChecklist = document.querySelectorAll('.password-checklist li.valid');
                        if (passwordChecklist.length < 4) {
                            errorMessage.textContent = 'La contraseña no cumple con todos los requisitos.';
                            errorMessage.classList.remove('d-none');
                            return false;
                        }

                        // Validar edad
                        const birthdateObj = new Date(birthdate);
                        const today = new Date();
                        let age = today.getFullYear() - birthdateObj.getFullYear();
                        const monthDiff = today.getMonth() - birthdateObj.getMonth();

                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdateObj.getDate())) {
                            age--;
                        }

                        if (age < 18) {
                            errorMessage.textContent = 'El cliente debe ser mayor de 18 años.';
                            errorMessage.classList.remove('d-none');
                            return false;
                        }

                        errorMessage.classList.add('d-none');
                        return true;
                    }
                </script>
</body>

</html>