<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top, #13cdbd, #5a18ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        .login-container img {
            max-width: 150%;
            border-radius: 50%;
        }

        .form-container h4 {
            color: #00A99D;
        }

        .form-container button {
            background-color: #00A99D;
            color: white;
            border: none;
            margin-right: 50px;
            margin-left: 60px;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #007F74;
            color: white;
        }

        .error-message {
            color: #007F74;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #00A99D;
            color: white;
            border: none;
        }

        .btn:hover {
            background-color: #007F74;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            .btn {
                font-size: 14px;
            }

        }

        .error-message {
            color: red;
            /* Texto rojo */
            background-color: rgba(255, 0, 0, 0.1);
            /* Fondo suave rojo */
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Flecha de regreso -->
        <div class="back-arrow">
            <a href="index.php">
                <img src="/Imagenes/flecha.svg" alt="Regresar">
            </a>
        </div>
        <div class="row align-items-center justify-content-center">
            <!-- Imagen (oculta en pantallas pequeñas) -->
            <div class="col-md-6 d-none d-md-block text-center">
                <img src="/Imagenes/Imagen_Login.png" alt="Odontología" class="img-fluid">
            </div>

            <!-- Formulario -->
            <div class="col-md-6">
                <div class="login-container">
                    <div class="text-center mb-4">
                        <img src="/Imagenes/loogo.png" alt="Smile Line Odontología" style="max-width: 160px;">
                    </div>
                    <div class="form-container">
                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="error-message">
                                <?php
                                echo $_SESSION['error'];
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="/logica/consultaLogin.php" method="POST">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required>
                                <!-- Botón para mostrar/ocultar contraseña -->
                                <button type="button" class="btn position-absolute end-0 top-0 mt-2 me-2" id="togglePassword" style="border: none; background: none;">
                                    <i id="toggleIcon" class="fa-solid fa-eye" style="color:  #007F74; font-size: 1.2rem;"></i>
                                </button>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn w-100">Iniciar Sesión</button>
                                <button type="submit" formaction="registroClientesPrin.php" class="btn w-100">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Selecciona los elementos
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        // Agrega el evento de clic para alternar la visibilidad
        togglePassword.addEventListener('click', function() {
            // Cambia el tipo de input
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Cambia el ícono según la visibilidad
            if (type === 'password') {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        });
    </script>


</body>

</html>