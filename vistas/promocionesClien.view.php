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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        margin: 1px auto;
        padding: -4px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .navbar {
        background: linear-gradient(to right, #00C9FF, #00A99D);
        padding: 10px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar .nav-link {
        color: black !important;
        transition: color 0.3s ease;
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


    .logo img {
        height: 120px;
    }


    .main-content {
        margin-top: 20px;
        padding: 20px;
    }

    .carousel-inner img {
        max-height: 400px;
        object-fit: contain;
        transition: transform 0.5s ease;

    }

    .carousel-item:hover img {
        transform: scale(1.03);
    }

    .carousel-indicators [data-bs-target] {
        background-color: #00A99D;
    }

    .custom-icon {
        background-color: #00a99d;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }



    footer {
        background-color: #00A99D;
        color: white;
        padding: 15px;
        position: relative;
        left: -20px;
        width: 112%;
        margin-top: 5px;
        border-radius: 0 0 15px 15px;
        text-align: left;
    }

    .footer-icon {
        width: 40px;
        height: auto;
    }

    .footer-link {
        color: white;
        text-decoration: none;
    }

    .footer-link:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="container">

        <header>
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="../public/inicioClientes.php">
                        <img src="../Imagenes/loogo.png" alt="Smile Line Odontología">
                    </a>
                </div>
                <img src="../Imagenes/User.png" class="user-icon" alt="Usuario">
                <div class="dropdown-menu" id="dropdownMenu">
                    <form id="logoutForm" action="../controladores/ControladorUsuario.php" method="post" style="display: none;">
                        <input type="hidden" name="accion" value="logout">
                    </form>
                    <a href="#" onclick="document.getElementById('logoutForm').submit();">Cerrar sesión</a>
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
                        <a class="nav-link text-dark px-3" href="../public/inicioClientes.php">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="../public/casosClinicosClie.php">Casos Clinicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="../public/servicioClien.php">Servicios</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            <!-- Inicio del cuerpo -->
            <!-- Carrusel mejorado -->
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/Imagenes/Promociones/1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/3.png" class="d-block w-100" alt="...">
                    </div>
                    <!-- Puedes seguir agregando más imágenes aquí -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon custom-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon custom-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
            <!-- Fin del carrusel -->

        </main>
        <!-- Footer -->
        <footer>
            <div class="row">
                <!-- Columna 1: Ubicación -->
                <div class="col-md-4 d-flex align-items-start">
                    <img src="/Imagenes/icon1.png" alt="Ubicación" class="footer-icon">
                    <div class="ms-2">
                        <h6>Ubicación:</h6>
                        <p>Circuito 7 H. Cocoyoc MZ 88 LOTE 8-B, Ex. Hacienda Santa Inés, 55796, México, México.</p>
                    </div>
                </div>
                <!-- Columna 2: Contacto -->
                <div class="col-md-4 d-flex align-items-start">
                    <img src="/Imagenes/icon2.svg" alt="Contacto" class="footer-icon">
                    <div class="ms-2">
                        <h6>Contacto:</h6>
                        <p>Tel: 55-12-47-02-06</p>
                        <h6>Correo:</h6>
                        <p>smileline@gmail.com</p>
                    </div>
                </div>
                <!-- Columna 3: Síguenos -->
                <div class="col-md-4">
                    <h6>Síguenos:</h6>
                    <div class="d-flex align-items-center">
                        <img src="/Imagenes/icon3.png" alt="Facebook" class="footer-icon">
                        <a href="https://www.facebook.com" class="footer-link ms-2">Facebook</a>
                    </div>
                    <div class="d-flex align-items-center mt-2">
                        <img src="/Imagenes/icon4.png" alt="Instagram" class="footer-icon">
                        <a href="https://www.instagram.com" class="footer-link ms-2">Instagram</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
    <?php include '../chatbot/index.php'; ?>

</body>

</html>