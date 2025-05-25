<?php
$rolesPermitidos = [1]; // rol Cliente
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
    <title>Clientes</title>
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
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .navbar {
        background: linear-gradient(to right, #00C9FF, #00A99D);
        /* Degradado */
        padding: 10px 0;
        /* Ajusta el espaciado vertical */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Sombra para resaltar */
    }

    .navbar .nav-link {
        color: black !important;
        /* Asegúrate de que los enlaces sean visibles */
        transition: color 0.3s ease;
    }

    .navbar-nav {
        display: flex;
        justify-content: center;
        /* Centrar horizontalmente los enlaces */
        width: 100%;
        /* Asegura que ocupe todo el espacio del contenedor */
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

    .image-section {
        width: 100%;
        height: auto;
        padding: 0px 20px;
    }

    #animatedImage {
        animation-delay: 0.3s;
        /* Retraso de 0.5 segundos antes de iniciar */
        animation-duration: 3s;
        /* Duración de 2 segundos para que sea más suave */
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

        <nav class="navbar navbar-expand-lg  py-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" -bs-navbar-padding-x: 0;>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="casosClinicos_C.php">Casos Clínicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="Promociones_C.php">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark px-3" href="Servicios_C.php">Servicios</a>
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
                            <button class="btn btn-custom" onclick="location.href='agendar.php'">Agendar</button>
                            <button class="btn btn-custom" onclick="location.href='modificarCita.php'">Consultar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="imagenes/Cliente/Img_Principal.jpg" alt="Dentist with a child" class="img-fluid animate__animated animate__fadeInRight" id="animatedImage">
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
<iframe src="http://localhost/Chatbot/index.php" style="
position: fixed;
    display: block;
    bottom: 20px;
    right: 20px;
    border: none;
    width: 350px;
    height: 550px;
    cursor: pointer;"> </iframe>
</body>


</html>