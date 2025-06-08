<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar Clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <style>
body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        padding-top: 3px;
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

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 0;
        border-bottom: 2px solid #00b3b3;
    }

    .user-menu {
        position: absolute;
        top: 33px;
        right: 10px;
        display: flex;
        align-items: center;
    }

    .user-icon {
        height: 70px;
        cursor: pointer;
        margin-right: 20px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 70px;
        right: 0;
        text-align: center;
        background-color: #06a1a9;

    }

    .dropdown-menu a {
        display: block;
        padding: 2px;
        text-decoration: none;
        color: black;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .dropdown-menu a:hover {
        transform: scale(1.1);
    }

    .dropdown-menu.show {
        display: block;
    }

    .logo img {
        height: 110px;
    }


    .form-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 50px;
        /* Agrega un poco de espacio interno alrededor del formulario */
        border-radius: 5px;
        /* Agrega un borde redondeado al formulario */
        font-family: Calibri, sans-serif;
        /* Aplica la fuente Calibri al formulario */

    }

    .form-left,
    .form-right {
        flex: 1 1 45%;
        margin-bottom: 10px;
        padding: 30px;
        border-radius: 5px;
        font-family: Calibri, sans-serif;
    }

    .form-group {
        position: relative;
    }

    .form-group i {
        position: absolute;
        left: -45px;
        top: 40%;
        transform: translateY(-50%);
        font-size: 20px;
        /* Ajusta el tamaño del ícono según sea necesario */
    }

    .form-group input {
        width: calc(100% - 20px);
        padding-left: 20%;
        /* Puedes ajustar este valor según tus necesidades */
        padding-right: 10%;
        /* Puedes ajustar este valor según tus necesidades */
    }


    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group input[type="tel"],
    .form-group select,
    .form-group input[type="date"] {
        width: 100%;
        /* Ancho del 100% del contenedor */
        max-width: 480px;
        /* Longitud máxima de 300px */
        padding: 10px;
        margin-bottom: 10px;
        /* Agrega un poco de espacio entre los campos de entrada */
        border-radius: 5px;
        border: 2px solid #00b3b3;
        /* Agregar borde alrededor de los campos de entrada */
    }

    .form-group select {
        appearance: none;
        /* Para eliminar los estilos de selección del navegador */
        -webkit-appearance: none;
        /* Para navegadores WebKit (Chrome, Safari, etc.) */
        -moz-appearance: none;
        /* Para navegadores basados en Mozilla (Firefox) */
    }

    .button-modify {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .button-modify button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #00A99D;
        color: white;
        font-size: 16px;
        margin-top: -80px;
        /* Margen superior */
        margin-bottom: 20px;
        /* Margen inferior */

    }

    .button-modify button:hover {
        background-color: #008f8f;
    }

    .password-checklist {
        margin-top: 2px;
        font-size: 15px;
    }

    .password-checklist ul {
        list-style: none;
        padding: 0;
    }

    .password-checklist .valid {
        color: gray;
    }

    .password-checklist .valid.checked {
        color: #008f8f;
        font-weight: bold;
    }

    .modify-title {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        margin: 20px 0;
        color:#008f8f;
    }
</style>


    <body>
        <div class="container">
        <header>
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#">
                        <img src="imagenes/loogo.png" alt="Smile Line Odontología">
                    </a>
                </div>
                <div class="user-menu">
                    <img src="imagenes/User.png" class="user-icon" alt="Usuario">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="Logica/logout.php">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </header>
            <main class="main">
                <div class="about">
                    <div class="text-content">
                        <div class="Titulo modify-title">
                            <h1>Registrar Clientes</h1>
                        </div>
                    </div>
                </div>

                <!-- Mostrar mensaje de error si existe -->

                <div style="color: red; text-align: center; margin-bottom: 10px;">
                </div>

                <form id="registrationForm" method="POST" action="logica/registro.php" onsubmit="return validarFormulario()">
                    <div class="form-container">
                        <!-- Lado izquierdo -->
                        <div class="form-left">
                            <div class="form-group">
                                <i class="fa-solid fa-envelope" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="email" id="email" name="email" placeholder="Correo Electronico" required>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-lock" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="password-checklist">
                                <p>La contraseña debe cumplir con:</p>
                                <ul>
                                    <li id="check-length" class="valid"> Al menos 8 caracteres</li>
                                    <li id="check-uppercase" class="valid"> Al menos una letra mayúscula</li>
                                    <li id="check-number" class="valid"> Al menos un número</li>
                                    <li id="check-symbol" class="valid"> Al menos un símbolo</li>
                                </ul>
                            </div>

                            <div class="form-group">
                                <i class="fa-solid fa-lock" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar Contraseña" required>
                            </div>
                            <div id="passwordError" style="color: red; text-align: center; margin-bottom: 10px;"></div>
                            <div class="form-group">
                                <i class="fa-solid fa-phone" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="tel" id="phone" name="phone" placeholder="Telefono" required>
                            </div>
                        </div>
                        <!-- Lado derecho -->
                        <div class="form-right">
                            <div class="form-group">
                                <i class="fa-solid fa-user" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="text" id="firstName" name="firstName" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-user" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="text" id="lastName" name="lastName" placeholder="Apellido Paterno" required>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-user" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="text" id="motherLastName" name="motherLastName" placeholder="Apellido Materno" required>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-venus-mars" style="color: #00b3b3; font-size: 30px;"></i>
                                <select id="gender" name="gender" required>
                                <option value="" disabled selected></option>
                                    <option value="male">Masculino</option>
                                    <option value="female">Femenino</option>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-cake-candles" style="color: #00b3b3; font-size: 30px;"></i>
                                <input type="date" id="birthdate" name="birthdate" required>
                            </div>
                            <div id="birthdateError" style="color: red; text-align: center; margin-bottom: 10px;"></div>
                        </div>
                    </div>
                    <!-- Button modify -->
                    <div class="button-modify">
                        <button id="Registrar" type="submit">Registrar</button>
                    </div>
                </form>
            </main>
            <footer>
                <!-- Footer content -->
            </footer>
        </div>
        <script>
            // Mostrar/Ocultar contraseña
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.querySelector('.toggle-password');
                const passwordInput = document.getElementById('password');
                if (togglePassword) {
                    togglePassword.addEventListener('click', function() {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        this.classList.toggle('fa-eye-slash');
                    });
                }

                // Validar criterios de la contraseña
                const passwordInputField = document.getElementById('password');
                const criteria = {
                    length: document.getElementById('check-length'),
                    uppercase: document.getElementById('check-uppercase'),
                    number: document.getElementById('check-number'),
                    symbol: document.getElementById('check-symbol'),
                };

                passwordInputField.addEventListener('input', function() {
                    const value = passwordInputField.value;

                    // Validar longitud mínima de 8 caracteres
                    if (value.length >= 8) {
                        criteria.length.classList.add('checked');
                    } else {
                        criteria.length.classList.remove('checked');
                    }

                    // Validar al menos una letra mayúscula
                    if (/[A-Z]/.test(value)) {
                        criteria.uppercase.classList.add('checked');
                    } else {
                        criteria.uppercase.classList.remove('checked');
                    }

                    // Validar al menos un número
                    if (/\d/.test(value)) {
                        criteria.number.classList.add('checked');
                    } else {
                        criteria.number.classList.remove('checked');
                    }

                    // Validar al menos un símbolo
                    if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
                        criteria.symbol.classList.add('checked');
                    } else {
                        criteria.symbol.classList.remove('checked');
                    }
                });
            });
            // Validación final del formulario
            function validarFormulario() {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const birthdate = document.getElementById('birthdate').value;

                // Validar el formato del email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert("Por favor, ingresa un correo electrónico válido.");
                    return false; // Cancelar el envío
                }

                // Validar que el usuario sea mayor de 18 años
                const birthdateObj = new Date(birthdate);
                const today = new Date();
                const age = today.getFullYear() - birthdateObj.getFullYear();
                const monthDifference = today.getMonth() - birthdateObj.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdateObj.getDate())) {
                    age--;
                }
                if (age < 18) {
                    alert("Debes ser mayor de 18 años para registrarte.");
                    return false; // Cancelar el envío
                }

                // Validar que las contraseñas coincidan
                if (password !== confirmPassword) {
                    alert("Las contraseñas no coinciden.");
                    return false;
                }

                // Validar que se cumplan todos los criterios de la contraseña
                const passwordChecklist = document.querySelectorAll('.password-checklist .valid');
                const allCriteriaMet = Array.from(passwordChecklist).every(item => item.classList.contains('checked'));
                if (!allCriteriaMet) {
                    alert("Por favor, cumple con todos los criterios de la contraseña.");
                    return false;
                }
                return true;
            }
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userIcon = document.querySelector(".user-icon");
            const dropdownMenu = document.getElementById("dropdownMenu");

            userIcon.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });
        });
    </script>
    <?php include 'chatbot/index.php'; ?>


    </body>

    </html>