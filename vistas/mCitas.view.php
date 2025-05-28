<?php
$_POST['accion'] = 'validarRol';
$_POST['roles'] = [3,4]; // asistente y administrador
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas</title>
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
            top: 24px;
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

        .button1 {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
            margin-top: 12px;
            margin-bottom: 15px;
            border-radius: 4px;

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

        .form {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 15px;
            margin-left: 90px;
            margin-top: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }

        .form:hover {
            background-color: #008f8f;
        }
    </style>
    <script>
        function eliminarCita(idCita) {
            if (!idCita || isNaN(idCita)) {
                alert('ID de cita no válido.');
                return;
            }

            if (confirm('¿Estás seguro de que deseas eliminar esta cita?')) {
                fetch('../controladores/eliminarCita.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `idCita=${encodeURIComponent(idCita)}`
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la solicitud al servidor.');
                        }
                        return response.text();
                    })
                    .then(data => {
                        alert(data);
                        location.reload(); // Recargar la página para reflejar los cambios
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un problema al eliminar la cita.');
                    });
            }
        }
    </script>

</head>

<body>
    <button class="menu-toggle" id="menuToggle">&#9776;</button>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="principalAsistentes.php">Principal</a></li>
            <li><a href="mostrarClientes.PHP">Ver clientes/Agendar</a></li>
            <li><a href="Servicio_Asis.php">Servicios</a></li>
            <li><a href="Promociones_Asis.php">Promociones</a></li>
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
                        <h1>Ver Citas</h1>
                    </div>
                </div>
            </div>
            <form id="dateForm">
                <div class="date-form-group">
                    <label for="fecha">Seleccionar Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>
                <button class="form" type="submit">Ver Citas</button>
            </form>

            <div class="table-container">
                <table id="table">
                    <thead>
                        <tr>
                            <th>ID Cita</th>
                            <th>Nombre del Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="citasTable">
                        <tr>
                            <td colspan="5">Seleccione una fecha para ver las citas.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    </main>

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
        document.getElementById("dateForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita que el formulario recargue la página.

            const fecha = document.getElementById("fecha").value;
            if (!fecha) {
                alert("Por favor, selecciona una fecha.");
                return;
            }

            fetch("../controladores/controladorAsistentes.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `fecha=${encodeURIComponent(fecha)}`
                })
                .then(response => {
                    if (!response.ok) throw new Error("Error en la respuesta del servidor.");
                    return response.text();
                })
                .then(html => {
                    document.getElementById("citasTable").innerHTML = html; // Actualiza la tabla.
                })
                .catch(error => {   
                    console.error("Error:", error);
                    alert("Hubo un problema al cargar las citas.");
                });
        });
    </script>

</body>

</html>