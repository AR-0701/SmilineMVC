<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top, #13cdbd, #5a18ff);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
        }

        .login-image {
            background: url('../Imagenes/Imagen_Login.jpg') no-repeat center center ;
            background-size: cover;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            min-height: 500px;
        }

        .btn1 {
            background-color: #00A99D;
            color: white;
            border: none;
            margin: 20px;
        }

        .btn1:hover {
            background-color: #007F74;
            color: white;
        }

        .link-verde {
            color: #007F74;
            font-weight: 600;
        }

        h3 {
            color: #007F74;
        }

        .modal-title {
            text-align: center;
            font-size: 25px;
            color: #007F74;
        }


        .label .form-label {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="card login-card overflow-hidden">
        <div class="row g-0">
            <!-- Imagen -->
            <div class="col-md-6 d-none d-md-block login-image" title="Imagen obtenida de Freepik (uso libre comercial)."></div>
            <!-- Formulario -->
            <div class="col-md-6 bg-white p-5">
                <h3 class="text-center mb-4 fw-bold">Iniciar Sesión</h3>
                <div class="form-container">
                    <!-- Mostrar mensaje de error si existe -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="error-message">
                            <?php
                            echo $_SESSION['error'];
                            ?>
                        </div>
                    <?php endif; ?>
                    <form id="loginForm">
                        <div class="mb-4">
                            <label for="email" class="form-label fs-6 fw-semibold">Correo electrónico</label>
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                placeholder="ejemplo@correo.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fs-6 fw-semibold">Contraseña</label>
                            <div class="input-group input-group-lg">
                                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">👁️</button>
                            </div>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn1 btn-lg">Ingresar</button>
                        </div>
                        <p class="text-center fs-6 mt-3 mb-0">
                            <a href="#" class="link-verde" data-bs-toggle="modal" data-bs-target="#modalRecuperar">¿Olvidaste tu contraseña?</a>
                            <br>
                            ¿No tienes cuenta?
                            <a class="link-verde" href="../public/registroClienPrin.php">Regístrate</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const passwordInput = document.getElementById("password");
            const togglePassword = document.getElementById("togglePassword");

            togglePassword.addEventListener("click", () => {
                const type = passwordInput.type === "password" ? "text" : "password";
                passwordInput.type = type;
                togglePassword.textContent = type === "password" ? "👁️" : "🙈";
            });
        </script>

        <!-- Modal Recuperar Contraseña -->
        <div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="modalRecuperarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header text-center">
                        <h5 class="modal-title fw-bold" id="modalRecuperarLabel">Recuperar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formRecuperar">
                            <div class="label mb-3">
                                <label for="emailRec" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="emailRec" name="email" placeholder="tu@email.com" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn1 btn-lg">Enviar enlace</button>
                            </div>
                        </form>
                        <div id="mensajeRecuperacion" class="text-success text-center mt-3 fw-semibold"></div>
                    </div>
                </div>
            </div>
        </div>

</body>
<script>
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append("accion", "login");

        fetch("../controladores/ControladorUsuario.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                console.log("Respuesta del servidor:", text);
                let data = JSON.parse(text);
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al procesar la solicitud.");
            });
    });
</script>
<script>
    document.getElementById("formRecuperar").addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("solicitar", "true");

        fetch("../controladores/RecuperarHandler.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(res => {
                document.getElementById("mensajeRecuperacion").innerText = res;
            })
            .catch(error => {
                document.getElementById("mensajeRecuperacion").innerText = "Hubo un error al enviar el correo.";
                console.error("Error:", error);
            });
    });
</script>


</html>