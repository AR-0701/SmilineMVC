<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [3]; // asistente
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Inicio</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #e0f7fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .main-container {
        background-color: white;
        border-radius: 10px;
        width: 90%;
        max-width: 1200px;
        margin: 30px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .logo img {
        height: 100px;
    }


    .welcome-content {
        padding: 20px;
        flex: 1;
    }

    h2 {
        color: #00A99D;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 60px;
        text-align: center;
    }

    #nombreCliente {
        font-size: 1.2rem;
        margin-bottom: 15px;
        border: 2px solid #00A99D;
        border-radius: 5px;
        padding: 8px 15px;
        color: #333;
        text-align: center;
    }

    .slogan {
        font-style: italic;
        color: #06a1a9;
        font-weight: 500;
        text-align: center;
    }

    .welcome-section {
        padding: 20px 0;
        min-height: auto;
    }

    /* Texto centrado en móvil, alineado a la izquierda en desktop */
    .welcome-content {
        padding: 20px !important;
    }

    /* Imagen oculta en móvil y ajuste de tamaño en desktop */
    .welcome-image img {
        max-height: 400px;
        width: auto;
        object-fit: contain;
    }

    /* Ajuste para el título en móvil */
    h2 {
        font-size: 2.5rem !important;
    }

    @media (min-width: 768px) {
        .welcome-content {
            padding: 55px !important;
        }

        h2 {
            font-size: 60px !important;
        }

        .welcome-image img {
            max-height: 500px;
            width: 200%;
        }
    }

    /* Estilos para el menú lateral */


    .sidebar {
        width: 80px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background-color: #00A99D;
        color: white;
        transition: width 0.3s;
        overflow: hidden;
        z-index: 1000;
    }

    .sidebar:hover {
        width: 220px;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-logo {
        width: 40px;
        height: 40px;
    }

    .sidebar-logo-text {
        margin-left: 10px;
        font-weight: 700;
        white-space: nowrap;
        display: none;
    }

    .sidebar:hover .sidebar-logo-text {
        display: block;
    }

    .sidebar-menu {
        flex: 1;
        padding: 20px 0;
    }

    .sidebar-menu-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s;
        white-space: nowrap;
    }

    .sidebar-menu-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar-menu-item.active {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar-menu-icon {
        width: 24px;
        height: 24px;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .sidebar-menu-text {
        display: none;
    }

    .sidebar:hover .sidebar-menu-text {
        display: block;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 20px;
        display: flex;
        justify-content: center;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    }

    .logout-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .sidebar.collapsed .logout-btn {
        width: 45px;
        height: 45px;
    }


    .content-wrapper {
        margin-left: 80px;
        width: calc(100% - 80px);
        transition: margin-left 0.3s;
    }

    .sidebar:hover~.content-wrapper {
        margin-left: 220px;
        width: calc(100% - 220px);
    }

    .sidebar-menu-item img {
        width: 29px;
        height: 29px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .sidebar-menu-icon {
        width: 24px;
        height: 24px;
        margin-right: 15px;
        flex-shrink: 0;
    }
</style>

<body>
    <!-- Menú lateral -->
    <nav class="sidebar">
        <div class="sidebar-nav">
            <div class="sidebar-header">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABM0lEQVR4nO2WTW7CMBSELc5RCLBMt2VbFSFR6DJt7oBQL9nCAlqOVPShV3kRGZM4fuZnwUjexB577PiNx5hbAtABHoECKJ0m33IZEzhXH3izLQsh9IA1zVgB3Zp5JsDOw/sBxnU7XwcsXhVxdBLAJ7Cv4f0BS5+AnPYYeXZet3hVxIsroIgQ8O7M8duCu3UFlBECygp/GMHvpxQwj+C/phQwi+BPUwoYRPCz1JdQ6jwUm3OU4diWWBNkzLPPiFYtFv86YUTLBhHSt3B5/xB7DRTxDTyYExCTkTr38DZHO3dhT+LJ8xBJ+7B9oY9RZqtDWi+Ec4fR5gEVH2UeUPFR5gF1nkBpRGojQ2nFaitH/xip+OYugBv4BcW1L2F+7TLsaPJAkjyBMg8kyRMo80DKPHExHAB+w2OBcnDq2wAAAABJRU5ErkJggg=="
                    alt="external-application-user-interface-basic-anggara-glyph-anggara-putra">
                <span class="sidebar-logo-text">Smile Line</span>
            </div>

            <div class="sidebar-menu">
                <a href="../public/principalAsis.php" class="sidebar-menu-item active">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-menu-text">Inicio</span>
                </a>

                <a href="../public/mostrarClientes.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="sidebar-menu-text">Pacientes</span>
                </a>

                <a href="../public/mCitas.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2m-4-4H9m4 0h4m-4 0v4m0 0H9m4 0h4" />
                    </svg>
                    <span class="sidebar-menu-text">Citas</span>
                </a>

                <a href="../public/servicioAsis.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4GuyTFeCP+5itADCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrA3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEYrv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOf/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
                        alt="toothache--v1">
                    <span class="sidebar-menu-text">Servicios</span>
                </a>

                <a href="../public/promocionesAsis.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAnklEQVR4nO2TsQ2EMAxFGZGCEwXDQHlzHWIRGAOkhyJRpDgT25gCiS+liv1eYiVV9SYywAdYKeRWeMpVeH9SZxeghLsEQJvBhz/7EzC6BCV4SoIDP7PAMpY8KoEXrhJoxiIl1R99q1RQR8CBVipaboN7BWjhnhFhgWdNTSb5KuAb0KngWglX4CUJEXDpT+CZufEmMScXXtd8rDoU/ojsdG8Oel19OK4AAAAASUVORK5CYII="
                        alt="price-tag">
                    <span class="sidebar-menu-text">Promociones</span>
                </a>
            </div>


            <div class="sidebar-footer">
               <form id="logoutForm" action="../controladores/ControladorUsuario.php" method="post">
                    <input type="hidden" name="accion" value="logout">
                    <button type="submit" class="logout-btn" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="main-container">
            <header class="mb-4">
                <div class="logo">
                    <a href="#">
                        <img src="../Imagenes/loogo.png" alt="Smile Line Odontología">
                    </a>
                </div>
            </header>

            <main>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Contenido de texto (centrado en móvil, izquierda en desktop) -->
                        <div class="col-12 col-md-6 text-center text-md-start welcome-content">
                            <h2>¡Bienvenido!</h2>
                            <input type="text" class="form-control" id="nombreCliente"
                                value="<?php echo htmlspecialchars($clienteLogueado['nombre'] . ' ' . $clienteLogueado['aPaterno'] . ' ' . $clienteLogueado['aMaterno']); ?>"
                                disabled>
                            <p class="slogan">"Transformando Sonrisas"</p>
                        </div>
                        <div class=" welcome-image col-md-6 col-lg-6 col-sm-12">
                            <img src="../Imagenes/co.png" alt="Dentist with a child"
                                class="img-fluid animate__animated animate__fadeInRight" id="animatedImage">
                        </div>

                        </section>
            </main>
        </div>
    </div>
</body>

</html>