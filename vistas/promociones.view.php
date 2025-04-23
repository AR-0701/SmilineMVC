<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
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
                                <a class="nav-link text-dark px-3" href="index.php">Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="casosClinicos.php">Casos Clínicos</a>
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

</body>

</html>