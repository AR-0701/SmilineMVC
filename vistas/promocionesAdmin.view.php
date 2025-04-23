<?php
$rolesPermitidos = [4]; // rol Admin
include 'logica/validarLogin.php';
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
    <title>Principal-Asistentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<style>
    body {
        background: linear-gradient(to top, #13cdbd, #5a18ff);
        padding-top: 50px;
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
        padding: 10px 0;
        border-bottom: 2px solid #00b3b3;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: -250px;
        width: 250px;
        height: 100%;
        background: linear-gradient(to bottom, #00C9FF, #00A99D);
        transition: all 0.3s ease;
        z-index: 9999;
        color: #000;
        padding: 10px;
    }

    .sidebar ul {
        padding: 0;
    }

    .sidebar ul li {
        list-style-type: none;
        padding: 20px 10px;
        border-bottom: 5px solid #00A99D;
    }

    .sidebar ul li a {
        color: black;
        text-decoration: none;
        font-weight: bold;

    }

    .menu-toggle {
        position: fixed;
        top: 0px;
        left: 1px;
        cursor: pointer;
        z-index: 10000;
        background: linear-gradient(to bottom, #00C9FF, #00A99D);
        border: none;
        padding: 10px 15px;
        color: black;
        font-size: 20px;
    }

    .menu-toggle:hover {
        background: linear-gradient(to bottom, #662D91, #00C9FF, #00A99D);
    }


    .user-menu {
        position: absolute;
        top: 24px;
        right: 10px;
        display: flex;
        align-items: center;
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
        height: 120px;
    }

    .main-content {
        margin-top: 20px;
        padding: 20px;
    }

    .carousel-item img {
        max-height: 400px;
        /* Ajusta según el tamaño deseado */
        width: auto;
        object-fit: contain;
        margin: auto;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #009999;

        border-radius: 2%;
        /* Opcional: agrega un diseño más elegante */
        width: 40px;
        /* Tamaño opcional */
        height: 40px;
        /* Tamaño opcional */
    }

    .carousel-control-prev,
    .carousel-control-next {
        opacity: 1;
        /* Asegúrate de que no se vea transparente */
    }

    footer {
        background-color: #00A99D;
        color: white;
        padding: 15px;
        position: relative;
        /* O absolute si quieres que esté fijo */
        left: -20px;
        width: 112%;
        /* 20% más ancho que el contenedor */
        margin-top: 5px;
        border-radius: 0 0 15px 15px;
        /* Bordes redondeados opcionales */
        text-align: left;
    }

    .footer-icon {
        width: 40px;
        /* Tamaño uniforme para las imágenes */
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

    <button class="menu-toggle" id="menuToggle">&#9776;</button>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="principalAdmin.php">Principal</a></li>
            <li><a href="mostrarClientesAd.php">Ver clientes/Agendar</a></li>
            <li><a href="mCitasAd.php">Consulta del registro de citas</a></li>
            <li><a href="mHorario.php">Modificar Horarios</a></li>
            <li><a href="registroAsistentes.php">Registrar Asistentes</a></li>
            <li><a href="verAsistentes.php">Ver Asistentes</a></li>
            <li><a href="ServicioAdmin.php">Servicios</a></li>
        </ul>
    </div>

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


        <main>
            <!-- Inicio del cuerpo -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/4.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/5.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/6.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/7.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/Imagenes/Promociones/8.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

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
                        <img src="imagenes/icon3.png" alt="Facebook" class="footer-icon">
                        <a href="https://www.facebook.com" class="footer-link ms-2">Facebook</a>
                    </div>
                    <div class="d-flex align-items-center mt-2">
                        <img src="imagenes/icon4.png" alt="Instagram" class="footer-icon">
                        <a href="https://www.instagram.com" class="footer-link ms-2">Instagram</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var menuToggle = document.getElementById("menuToggle");
            var sidebar = document.getElementById("sidebar");
            var menuVisible = false;

            menuToggle.addEventListener("click", function() {
                if (!menuVisible) {
                    sidebar.style.left = "0";
                    menuToggle.style.left = "250px";
                    menuVisible = true;
                } else {
                    sidebar.style.left = "-300px";
                    menuToggle.style.left = "1px";
                    menuVisible = false;
                }
            });
        });
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