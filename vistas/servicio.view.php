<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
            margin-top: 25px;
            padding: 250px;
        }

        .card {
            background: #e8e8ec0f;
            border: none;
            border-radius: 15px;
            padding: 20px;
        }

        .card:hover {
            transform: translateY(-15px);
        }

        .card img {
            width: 100%;
            height: 100%;
            margin-bottom: 15px;
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
                                <a class="nav-link text-dark px-3" href="../index.php">Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="../public/casosClinicos.php">Casos Clínicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3" href="../public/promociones.php">Promociones</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Inicio del cuerpo -->
        <!-- Servicios -->
        <main>
        <div class="row text-center">

            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se1.png" alt="Limpieza" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>


            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se2.png" alt="Endodoncia" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>


            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se3.png" alt="Resinas" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>


            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se4.png" alt="Blanqueamiento" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>

        </div>

        <div class="row text-center mt-4">

            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se5.png" alt="Extracciones" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>

            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se6.png" alt="Cirugía" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>

            <div class="col-md-3 animate__animated animate__zoomIn">
                <div class="card">
                    <img src="/Imagenes/Se7.png" alt="Brackets" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>

            <div class="col-md-3">
                <div class="card animate__animated animate__zoomIn">
                    <img src="/Imagenes/Se8.png" alt="General" class="animate__animated animate__pulse animate__infinite">
                </div>
            </div>
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