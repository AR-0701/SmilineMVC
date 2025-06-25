<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [1]; // Cliente
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
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        width: 80%;
        max-width: 1200px;
        margin: 15px auto;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    /* Menu */
    .navbar {
        background: linear-gradient(to right, #00C9FF, #00A99D);
        padding: 10px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .navbar-nav .nav-link {
        font-size: 1.2rem;
        color: black;
        font-weight: bold;
        text-align: center;
        margin: 0 10px;
        transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        transform: scale(1.1);
    }

    /* Icono Login */

    .user-menu {
        position: absolute;
        top: 40px;
        right: 10px;
        display: flex;
        align-items: center;
    }

    .user-icon {
        height: 70px;
        cursor: pointer;
        margin-right: 12px;
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

    /* Logo */

    .logo img {
        height: 120px;
    }

    /* Botones */

    .btn-custom {
        background-color: #00A99D;
        color: white;
        border: none;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-custom:hover {
        background-color: #00837A;
        color: white;
    }

    /* Imagen */

    .image-section {
        width: 100%;
        height: auto;
        padding: 0px 20px;
    }

    #animatedImage {
        animation-delay: 0.3s;
        animation-duration: 3s;
    }
</style>

<body>
    <div class="container">

        <header>
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#">
                        <img src="../Imagenes/loogo.png" alt="Smile Line Odontología" title="© 2025 SmileLine - Imagen creada por nosotros">
                    </a>
                </div>
                <div class="user-menu">
                    <img src="../Imagenes/User.png" class="user-icon" alt="Usuario">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <form id="logoutForm" action="../controladores/ControladorUsuario.php" method="post" style="display: none;">
                            <input type="hidden" name="accion" value="logout">
                        </form>
                        <a href="#" onclick="document.getElementById('logoutForm').submit();">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg  py-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" -bs-navbar-padding-x: 0;>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="../public/casosClinicosClie.php">Casos Clínicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="../public/promocionesClien.php">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="../public/servicioClien.php">Servicios</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            <section class="row my-5">
                <div class="col-md-6 d-flex justify-content-center align-items-center text-center">
                    <div>
                        <h2>¡Bienvenido!</h2>
                        <h4 class="text-muted">A Smile Line</h4>
                        <p>Sonríe con confianza, cuidamos de tu salud dental. Agenda tu cita en nuestro consultorio dental.</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <button class="btn btn-custom" onclick="location.href='../public/agendar.php'">Agendar</button>
                            <button class="btn btn-custom" onclick="location.href='../public/modificarCita.php'">Consultar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="../Imagenes/Cliente/Img_Principal.jpg" alt="Dentist with a child" 
                    class="img-fluid animate__animated animate__fadeInRight" id="animatedImage" title="Imagen obtenida de Freepik (uso libre comercial).">
                </div>

            </section>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userIcon = document.querySelector(".user-icon");
            const dropdownMenu = document.getElementById("dropdownMenu");

            userIcon.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animatedImage = document.getElementById("animatedImage");

            // Detecta el desplazamiento
            window.addEventListener("scroll", function() {
                const rect = animatedImage.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    animatedImage.classList.add("animate__fadeInRight");
                }
            });
        });
    </script>


</body>



</html>