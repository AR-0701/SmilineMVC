    <?php
    $_POST['accion'] = 'validarRol';
    $_POST['roles'] = [4]; // asistente
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
        <title>Modificar horario</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(to top, #13cdbd, #5a18ff);
                padding-top: 3px;
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
                left: -270px;
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
                transition: transform 0.3s ease;
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
                height: 110px;
            }

            .main {
                padding: 10px 0;
            }

            .about h1 {
                text-align: center;
                font-size: 43px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .schedule-container {
                display: flex;
                flex-wrap: wrap;
            }

            .form-container {
                flex: 1;
                padding: 15px;
                background-color: #fff;
                margin-right: 20px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-size: 19px;
                margin-bottom: 10px;
            }

            .form-group input[type="text"] {
                width: 100%;
                padding: 8px;
                border: 2px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 13px;
            }

            .button-group {
                margin-top: 20px;
                text-align: center;
                Margin-left: 30%;
            }

            .button-group button {
                padding: 10px 20px;
                margin-right: 10px;
                cursor: pointer;
                font-weight: bold;
                background-color: #00A99D;
                color: #fff;
                border: none;
                border-radius: 3px;
                font-size: 19px;
                margin-left: 18%;
            }

            .button-group button:hover {
                background-color: #008f8f;
            }

            .calendar-container {
                flex: 1;
                padding: 20px;
                background-color: #ffff;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #datepicker {
                padding: 8px;
                border-radius: 3px;
                box-sizing: border-box;
                font-size: 14px;
                width: 100%;
                max-width: 300px;
                /* Ajustar el ancho máximo según sea necesario */
            }

            #fechaSeleccionada {
                margin-top: 10px;
                padding: 8px;
                border: 2px solid #ddd;
                border-radius: 3px;
                font-size: 19px;
                text-align: center;
                width: 25%;
                box-sizing: border-box;
            }

            .bete button {
                text-align: center;
                margin-top: 20px;
            }

            .bete button {
                padding: 10px 20px;
                margin-right: 10px;
                cursor: pointer;
                font-weight: bold;
                background-color: #00A99D;
                border: none;
                border-radius: 3px;
                font-size: 14px;
                margin-left: 40%;
            }

            .button-modify button:hover {
                background-color: #008f8f;
            }

            /* Contenedor principal del calendario */
            .ui-datepicker {
                border-radius: 10px;
                /* Bordes redondeados */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                /* Sombra */
                font-family: 'Arial', sans-serif;
                color: #333;
                margin-top: 10px;
                /* Separación del input */
                width: 120%;
            }

            /* Cabecera del calendario */
            .ui-datepicker-header {
                background: #ffffff;
                /* Fondo de la cabecera */
                color: black;
                /* Texto blanco */
                padding: 10px 5px;
                font-weight: bold;
                text-align: center;
                font-size: 16px;

            }

            /* Botones de navegación */
            .ui-datepicker-prev,
            .ui-datepicker-next {
                cursor: pointer;
                width: 30px;
                height: 30px;
                background: white;
                /* Fondo blanco */
                border-radius: 50%;
                /* Botón redondo */
                border-color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: background-color 0.3s, color 0.3s;
            }

            .ui-datepicker-prev:hover,
            .ui-datepicker-next:hover {
                background: white;
                /* Fondo al pasar el cursor */
                color: #ffffff;
                /* Color del ícono al pasar el cursor */
            }

            /* Días de la semana */
            .ui-datepicker thead {
                background: #00A99D;
                /* Fondo */
                color: #ffffff;
                /* Texto blanco */
                font-weight: bold;
                font-size: 14px;
            }

            /* Días del mes */
            .ui-datepicker-calendar td {
                padding: 4px;
                text-align: center;
                border-radius: 5px;
                /* Bordes redondeados */
                transition: background-color 0.3s, color 0.3s;
            }

            .ui-datepicker-calendar td:hover {
                background: #13cdbd;
                /* Fondo al pasar el cursor */
                color: white;
                /* Texto blanco */
            }

            /* Día seleccionado */
            .ui-datepicker-calendar .ui-state-active {
                background: #00b3b3;
                /* Fondo rojo */
                color: white;
                /* Texto blanco */
                font-weight: bold;
            }

            /* Días deshabilitados */
            .ui-datepicker-calendar .ui-state-disabled {
                color: #ccc;
                /* Texto gris */
                pointer-events: none;
                /* Sin interacción */
            }

            /* Estilo general del texto */
            .ui-datepicker select {
                background: #ffffff;
                /* Fondo select */
                color: #333;
                /* Texto */
                border: 1px solid #13cdbd;
                border-radius: 5px;
                padding: 5px;
                font-size: 14px;
            }
        </style>
    </head>

    <body>
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <div class="sidebar" id="sidebar">
            <ul>
                <li><a href="principalAdmin.php">Principal</a></li>
                <li><a href="mCitasAd.php">Consulta del registro de citas</a></li>
                <li><a href="registroAsistentes.php">Registrar Asistentes</a></li>
                <li><a href="verAsistentes.php">Ver Asistentes</a></li>
                <li><a href="ServicioAdmin.php">Servicios</a></li>
                <li><a href="PromocionesAdmin.php">Promociones</a></li>
            </ul>
        </div>

        <div class="container">
            <header>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="#">
                            <img src="../Imagenes/loogo.png" alt="Smile Line Odontología">
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


            <main class="main">
                <section class="about">
                    <h1>Modificar Horario</h1>
                </section>
                <div class="schedule-container">
                    <div class="form-container">
                        <form id="formulario-horarios" action="../controladores/controladorModificar.php" method="POST">
                            <div class="form-group">
                                <label for="fechaSeleccionada">Fecha seleccionada:</label>
                                <input type="text" id="fechaSeleccionada" name="fechaSeleccionada" readonly>
                            </div>
                            <div class="form-group">
                                <label for="lista-horarios-apertura">Hora de apertura:</label>
                                <select id="lista-horarios-apertura" name="horariosIN">
                                    <!-- Horarios dinámicos -->

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lista-horarios-cierre">Hora de cierre:</label>
                                <select id="lista-horarios-cierre" name="horariosCI">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="disponibilidad">Estado:</label>
                                <select id="disponibilidad" name="disponibilidad">
                                    <option value="disponible">Disponible</option>
                                    <option value="ocupado">Ocupado</option>
                                </select>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </div>
                        </form>
                    </div>
                    <div class="calendar-container">
                        <div id="datepicker"></div>
                    </div>
                </div>
            </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../js/script.js"></script>
        <script>
            document.addEventListener("DOMConten    tLoaded", function() {
                var menuToggle = document.getElementById("menuToggle");
                var sidebar = document.getElementById("sidebar");
                var menuVisible = false;

                menuToggle.addEventListener("click", function() {
                    if (!menuVisible) {
                        sidebar.style.left = "0";
                        menuToggle.style.left = "250px";
                        menuVisible = true;
                    } else {
                        sidebar.style.left = "-250px";
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
            $(document).ready(function() {
                $("#datepicker").datepicker();
            });
        </script>
        <?php include 'chatbot/index.php'; ?>

    </body>

    </html>