<?php
$rolesPermitidos = [4]; // rol Admin
include 'logica/validarLogin.php';
$clientes = [];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            height: 120px;
        }

        .main {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .main .about {
            margin-bottom: 20px;
        }

        .main .delete-form {
            margin-bottom: 20px;
        }

        .main .delete-form-group {
            display: flex;
            flex-direction: row;
            /* Cambiado a 'row' para alinear horizontalmente */
            align-items: center;
            /* Alinea verticalmente en el centro */
            margin-bottom: 10px;
        }

        .main .delete-form-group label {
            margin-bottom: 0;
            /* Remueve el margen inferior para alinear con el input */
            font-size: 20px;
            margin-right: 10px;
            /* Añade un margen derecho para separar el label del input */
        }

        .main .delete-form-group input {
            padding: 8px;
            width: 100px;
            max-width: 100%;
        }

        .main button {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 70px;
            margin-top: 12px;
            margin-bottom: 15px;
        }

        .main button:hover {
            background-color: #008f8f;
        }

        input[type="date"] {
            width: 40%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }

        /* Estilo de la tabla */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #00A99D;
            text-align: center;
        }

        table th {
            background-color: #00A99D;
        }

        tr.selected {
            background-color: #00A99D;
        }

        .button1 button {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 2px;
            margin-top: -80px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .button1 button:hover {
            background-color: #008f8f;
        }

        /* Estilos para la barra de búsqueda */
        .search-container {
            margin-bottom: 20px;

        }

        .search-input {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border: 1px solid #008f8f;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body>
    <button class="menu-toggle" id="menuToggle">&#9776;</button>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="principalAdmin.php">Principal</a></li>
            <li><a href="mCitasAd.php">Consulta del registro de citas</a></li>
            <li><a href="mHorario.php">Modificar Horarios</a></li>
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

        <main class="main">
            <div class="about">
                <div class="text-content">
                    <div class="Titulo modify-title">
                        <h1>Ver Clientes</h1>
                    </div>
                </div>
            </div>
            <div class="button1">
                <a href="registroClientess.php">
                    <button type="button">Registrar Nuevo Cliente</button>
                </a>
            </div>

            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Buscar por nombre...">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        <?php
                        include 'logica/verClie.php';
                        foreach ($clientes as $cliente) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cliente['idc']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['aPaterno'] . ' ' . $cliente['aMaterno']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                                <button class="agendarCitaBtn btn btn-primary"
                                    data-id="<?php echo htmlspecialchars($cliente['idc']); ?>"
                                    data-nombre="<?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['aPaterno'] . ' ' . $cliente['aMaterno']); ?>">
                                    Agendar Cita
                                </button>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
        <footer>
            <!-- Contenido del pie de página -->
        </footer>
    </div>

    <script>
        // Funcionalidad de búsqueda
        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toLowerCase();
            var rows = document.querySelectorAll('#clientTableBody tr');
            rows.forEach(row => {
                var nombreCompleto = row.cells[1].innerText.toLowerCase();
                if (nombreCompleto.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Redirigir al hacer clic en el botón "Agendar Cita"
        document.querySelectorAll('.agendarCitaBtn').forEach(button => {
            button.addEventListener('click', function() {
                var idCli = this.getAttribute('data-id');
                console.log('ID Cliente: ', idCli); // Depuración
                if (idCli ) {
                    var url = `agendaradyasis.php?id=${idCli}`;
                    window.location.href = url;
                } else {
                    console.error("ID Cliente o Nombre no encontrado.");
                }
            });
        });
    </script>

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
    <?php include 'chatbot/index.php'; ?>
</body>

</html>