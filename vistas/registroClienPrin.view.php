<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        overflow-x: hidden;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        width: 80%;
        max-width: 1200px;
        margin: 15px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .logo img {
        height: 110px;
        margin-bottom: -20px;
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
        margin-bottom: 10px;
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


    .modify-title {
        text-align: center;
        font-size: 3rem;
        font-weight: bold;
        color: #008f8f;
        margin-bottom: 30px;
    }
</style>


<body>
    <div class="container">
        <header>
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#">
                        <img src="../Imagenes/loogo.png" alt="Smile Line Odontología">
                    </a>
        </header>

        <h1 class="modify-title">Registro</h1>
        <!-- Mostrar mensaje de error si existe -->

        <div style="color:#008f8f; text-align: center; margin-bottom: 10px;">
        </div>

        <form id="registrationForm" method="POST" action="../controladores/controladorRegistros.php"
            onsubmit="return validarFormulario()">
            <div class="row">
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
                                placeholder="Número de teléfono (10 dígitos)" pattern="[0-9]{10}" maxlength="10"
                                required>
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
                            <li id="check-length"><i class="far fa-circle valid"></i> Al menos 8 caracteres</li>
                            <li id="check-uppercase"><i class="far fa-circle valid"></i> Al menos una letra mayúscula</li>
                            <li id="check-number"><i class="far fa-circle valid"></i> Al menos un número</li>
                            <li id="check-symbol"><i class="far fa-circle valid"></i> Al menos un símbolo</li>
                        </ul>
                    </div>
                </div>
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
                            <input type="text" class="form-control-custom" id="motherLastName" name="motherLastName"
                                placeholder="Apellido materno" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Género</label>
                        <div class="input-group-custom">
                            <i class="fas fa-venus-mars input-icon"></i>
                            <select class="form-select-custom" id="gender" name="gender" required>
                                <option value="" selected disabled>Seleccione una opción</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="O">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                        <div class="input-group-custom">
                            <i class="fas fa-birthday-cake input-icon"></i>
                            <input type="date" class="form-control-custom" id="birthdate" name="birthdate" required>
                        </div>
                        <div id="birthdateError" class="invalid-feedback d-block"></div>
                    </div>
                    <!-- Campo oculto para indicar tipo de registro -->
                    <input type="hidden" name="tipoFormulario" value="cliente">

                    <!-- Botón de registro -->
                    <button type="submit" class="btn-primary-custom" id="Registrar">
                        <i class="fas fa-user-plus me-2"></i>Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar contraseña
            const togglePassword = document.querySelector('#togglePassword');
            const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
            const password = document.querySelector('#password');
            const confirmPassword = document.querySelector('#confirmPassword');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            }

            if (toggleConfirmPassword) {
                toggleConfirmPassword.addEventListener('click', function() {
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

            passwordInput.addEventListener('input', function() {
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
            confirmPassword.addEventListener('input', function() {
                if (password.value !== confirmPassword.value) {
                    document.getElementById('passwordError').textContent = 'Las contraseñas no coinciden';
                    confirmPassword.classList.add('is-invalid');
                } else {
                    document.getElementById('passwordError').textContent = '';
                    confirmPassword.classList.remove('is-invalid');
                }
            });

            // Validar fecha de nacimiento
            document.getElementById('birthdate').addEventListener('change', function() {
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
            phoneInput.addEventListener('input', function(e) {
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
            phoneInput.addEventListener('blur', function() {
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