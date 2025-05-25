<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index-Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding: -4px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .navbar-nav .nav-link {
            color: black;
            font-weight: bold;
            margin: 0 10px;
            transition: transform 0.3s ease;
          font-size: 1.2rem;
        }

        .navbar-nav .nav-link:hover {
            transform: scale(1.1);
        }
        .logo img {
            height: 90px;
        }

        .main-content {
            margin-top: -30px;
            padding: 10px;
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
            width: 80%;
            height: auto;
            padding: 0px 20px;
        }

        footer {
            background-color: #00A99D;
            color: white;
            padding: 15px;
            position: relative;
            left: -17px;
            width: 112%;
            margin-top: -15px;
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

        /* Estilo para el modal */
        .modal-content {
            background: white;
        }

        .texto-opciones {
            font-size: 25px;
            color: #6916e5;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        /* Botones con imagen */
        .image-button img {
            transition: transform 0.2s;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .image-button img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <!-- Inicio del Container -->
    <div class="container">
        <!-- Logo y menu -->
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="logo">
                        <a href="#">
                            <img src="/Imagenes/loogo.png" alt="Smile Line Odontología">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="public/casosClinicos.php">Casos Clínicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="public/promociones.php">Promociones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="public/servicio.php">Servicios</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Inicio del cuerpo -->
        <div class="main-content row align-items-center">
            <!-- Text Section -->
            <div class="col-md-6">
                <h2 class="display-5">SMILE LINE</h2>
                <h4 class="text-muted">Transformando sonrisas</h4>
                <p>El consultorio SMILE LINE ofrece sus servicios de calidad con el objetivo de satisfacer y mantener
                    una buena comunicación con nuestros clientes.</p>
                <button class="btn btn-custom" onclick="location.href='public/login.php'">Iniciar Sesión</button>
            </div>
            <!-- Image Section -->
            <div class="col-md-6 text-center">
                <img src="/Imagenes/Imagen_1.png" class="image-section" alt="Dentist with a child">
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <!-- Columna 1: Ubicación -->
                <div class="col-md-4 d-flex align-items-start">
                    <img src="/Imagenes/icon1.png" alt="Ubicación" class="footer-icon ">
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
    </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="texto-opciones">¿Quieres activar el modo especial para que sea más fácil de navegar?</p>
                    <div class="row justify-content-center g-3">
                        <div class="col-6 col-md-5 image-button">
                            <button type="button" class="btn btn-light p-0 border-0" onclick="accionBoton1()">
                                <img src="../Imagenes/1.png" alt="Botón 1" class="img-fluid">
                            </button>
                        </div>
                        <div class="col-6 col-md-5 image-button">
                            <button type="button" class="btn btn-light p-0 border-0" onclick="accionBoton2()">
                                <img src="../Imagenes/2.png" alt="Botón 2" class="img-fluid">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar automáticamente el modal si no está ?modal=false en la URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('modal') !== 'false') {
                var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                    backdrop: 'static',
                    keyboard: false
                });
                myModal.show();
            }
        });

        function accionBoton1() {
            // Recarga la misma página con ?modal=false
            window.location.href = window.location.pathname + "?modal=false";
        }

        function accionBoton2() {
            // Redirige a la versión inclusiva
            window.location.href = "../inclusivo/inclusiva2.html";
        }
    </script>


</body>


</html>