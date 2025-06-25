<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casos Clinicos</title>
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

        h2 {
            color: black;
            font-weight: bold;
            font-size: 30px;

        }

        /* Menu */
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
            margin-top: 30px;
            padding: 10px;
        }


        .image-section {
            width: 90%;
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
            margin-top: 40px;
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

        /* Estilos para la sección de créditos */
        .creditos-footer {
            background-color: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem 0;
            text-align: center;
            color: white;
        }

        .copyright {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            font-weight: 500;
            color: white;
        }

        .creditos-list {
            list-style: none;
            padding: 0;
            margin: 0 auto;
            max-width: 800px;
            font-size: 0.8rem;
        }

        .creditos-list li {
            margin-bottom: 0.5rem;
            display: inline-block;
            padding: 0 15px;
            position: relative;
        }

        .creditos-list li:not(:last-child):after {
            content: "•";
            position: absolute;
            right: -5px;
            color: rgba(255, 255, 255, 0.5);
        }

        .creditos-list i {
            margin-right: 5px;
            color: #a8f0eb;
            font-size: 0.9rem;
        }

        .creditos-list a {
            color: #a8f0eb;
            text-decoration: none;
            transition: color 0.3s;
        }

        .creditos-list a:hover {
            color: white;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .creditos-list li {
                display: block;
                padding: 5px 0;
            }

            .creditos-list li:after {
                display: none;
            }
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
                        <a href="index.php">
                            <img src="/Imagenes/loogo.png" alt="Smile Line Odontología" title="© 2025 SmileLine - Imagen creada por nosotros">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="../index.php">Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="../public/promociones.php">Promociones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="../public/servicio.php">Servicios</a>
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
                <h2>Casos Clinicos</h2>
                <h4 class="text-muted">en Smile-Line</h4>
                <p>En la serie periapical completa realizada,
                    se observa un patrón de pérdida ósea horizontal generalizado y presencia de imágenes
                    compatibles con defectos intraóseos tipo cráter que se pueden observar sobre todo a nivel
                    de los dientes. </p>
                <p>Finalmente, el diagnostico Nos encontramos ante una periodontitis crónica avanzada
                    generalizada. Crónica porque la progresión de la enfermedad es lenta y no existe
                    agregación familiar. Avanzada por la presencia de pérdida del nivel de inserción mayores
                    o iguales a 5mm. Generalizada, ya que afecta a más del 30% de las localizaciones. </p>
            </div>
            <!-- Image Section -->
            <div class="col-md-6 text-center">
                <img src="/Imagenes/Imagen_2.png" class="image-section" alt="Dentist with a child" class="animate__animated animate__pulse animate__infinite">
            </div>
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
            <!-- Nueva fila: Créditos y derechos -->
            <div class="row mt-4">
                <div class="col-12">
                    <p class="copyright text-center">© 2025 SmileLine. Todos los derechos reservados.</p>
                    <ul class="creditos-list text-center">
                        <li><i class="fas fa-icons"></i> Íconos: Font Awesome 6.4.0 — © Fonticons, Inc. — Licencia CC BY 4.0 — <a href="https://fontawesome.com" target="_blank">fontawesome.com</a></li>
                        <li><i class="fas fa-font"></i> Fuente: "Poppins" — SIL Open Font License 1.1 — <a href="https://fonts.google.com/specimen/Poppins" target="_blank">fonts.google.com</a></li>
                        <li><i class="fas fa-image"></i> Imágenes: <a href="https://www.freepik.com" target="_blank">Freepik</a> — Uso comercial permitido</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../chatbot/index.php'; ?>
</body>

</html>