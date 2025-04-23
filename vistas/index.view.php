<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index-Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top, #13cdbd, #5a18ff);
            padding-top: 30px;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            width: 80%;
            max-width: 1200px;
            margin: 15px auto;
            padding: -4px;
            /*  ajustar el contenido de abajo*/
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .navbar-nav .nav-link {
            color: black;
            font-weight: bold;
            margin: 0 10px;
            transition: transform 0.3s ease;
            /* Transición para el color y la transformación */
        }

        .navbar-nav .nav-link:hover {
            transform: scale(1.1);
            /* Hace que el enlace crezca ligeramente en hover */
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
            /* O absolute si quieres que esté fijo */
            left: -17px;
            width: 112%;
            /* 20% más ancho que el contenedor */
            margin-top: -15px;
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
                                <a class="nav-link text-dark px-3" href="casosClinicos.php">Casos Clínicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="promociones.php">Promociones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="servicios.php">Servicios</a>
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
                <button class="btn btn-custom" onclick="location.href='login.php'">Iniciar Sesión</button>
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
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- iframe para cargar el chatbot sin duplicados -->
    <iframe src="http://localhost/Chatbot/index.php" style="
position: fixed;
    display: block;
    bottom: 20px;
    right: 20px;
    border: none;
    width: 350px;
    height: 550px;
    cursor: pointer;"> </iframe>
    <button onclick=leerTexto()>escucha</button>
</body>
<script>
    function leerTexto() {
        let texto = document.body.innerText;
        let voz = new SpeechSynthesisUtterance(texto);
        voz.lang = "es-ES";
        voz.text = texto;
        window.speechSynthesis.speak(voz);
    }
</script>
</script>

</html>