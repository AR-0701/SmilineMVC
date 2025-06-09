<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #E9ECEF;
        }

        .page-title h1 {
            color: #00A99D;
            font-weight: 600;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .page-title h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, #00A99D, #5a18ff);
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #00A99D;
            color: white;
            padding: 15px 25px;
            border-bottom: none;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #00A99D, #5a18ff);
        }

        .card-title {
            font-weight: 500;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
            border-bottom: #008f8f 2px solid;
        }

        .table thead th {
            background: #00A99D;
            color: rgb(6, 6, 6);
            padding: 15px;
            font-weight: 500;
            border: #f6fafa 1px solid;
            position: sticky;
            top: 0;
            z-index: 10;
            font-weight: bold;
        }

        .table tbody tr {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }

        .table tbody tr:hover {
            background-color: rgba(0, 201, 255, 0.05);
            transform: translateX(5px);
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #000;
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #00A99D;
            border-color: #00A99D;
        }

        .btn-primary:hover {
            background-color: #008f8f;
            border-color: #008f8f;
        }

        .btn-outline-primary {
            color: #00A99D;
            border-color: #00A99D;
        }

        .btn-outline-primary:hover {
            background-color: #00A99D;
            color: white;
        }

        /* Date Picker - Nuevos estilos para el formulario centrado */
        .date-form-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .date-form-group {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .date-form-group label {
            font-weight: 500;
            color: #00A99D;
            margin: 0;
            white-space: nowrap;
        }

        .date-form-group input {
            padding: 10px;
            border-radius: 8px;
            border: 3px solid #00A99D;
            transition: all 0.3s;
            height: 40px;
        }

        .date-form-group input:focus {
            border-color: #5a18ff;
            box-shadow: 0 0 0 0.25rem rgba(0, 169, 157, 0.25);
            outline: none;
        }

        .btn-form {
            padding: 10px 20px;
            background-color: #00A99D;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            height: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-form:hover {
            background-color: #008f8f;
            transform: translateY(-2px);
        }

        /* Action Buttons */


        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .content-wrapper {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .sidebar:hover {
                width: 180px;
            }

            .sidebar:hover~.content-wrapper {
                margin-left: 180px;
                width: calc(100% - 180px);
            }

            .date-form-group {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                width: 100%;
            }

            .date-form-group label {
                margin-bottom: 0;
            }

            .btn-form {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }



        /* citas temporales */


        .cita-temporal {
            background-color: #fffacd;
            /* Amarillo claro para diferenciar */
        }

        .button1 {
            background-color: #f44336;
            /* Rojo para eliminar */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button2 {
            background-color: #4CAF50;
            /* Verde para registrar */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }

        .button3 {
            background-color: #2196F3;
            /* Azul para registrar todas */
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Menú lateral -->
    <nav class="sidebar">
        <div class="sidebar-nav">
            <div class="sidebar-header">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABM0lEQVR4nO2WTW7CMBSELc5RCLBMt2VbFSFR6DJt7oBQL9nCAlqOVPShV3kRGZM4fuZnwUjexB577PiNx5hbAtABHoECKJ0m33IZEzhXH3izLQsh9IA1zVgB3Zp5JsDOw/sBxnU7XwcsXhVxdBLAJ7Cv4f0BS5+AnPYYeXZet3hVxIsroIgQ8O7M8duCu3UFlBECygp/GMHvpxQwj+C/phQwi+CPKQUMIvjTlAIGEfw09SVUOg/F5hxlOLYl1gQZ8+wzolWLxb9OGNGyQYT0LVzeP8Rew0V8Aw/mBMQkpM49vM3Rzl3Yk3jyPEzSPmwf6WOU2eqQ1gvh3GG0eUDFR5kHVHyUeUCdJ1AakdrIUFqx2srRP0YqvrgL4AZ+QXHtS5hfuww7mjyQJE+gzANJ8gTKPJAyD6TMAynzxMVwAPgNjwXKwalvAwAAAABJRU5ErkJggg=="
                    alt="external-application-user-interface-basic-anggara-glyph-anggara-putra">
                <span class="sidebar-logo-text">Smile Line</span>
            </div>

            <div class="sidebar-menu">
                <a href="principalAsistentes.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-menu-text">Inicio</span>
                </a>

                <a href="mostrarClientes.php" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="sidebar-menu-text">Pacientes</span>
                </a>

                <a href="mCitas.php" class="sidebar-menu-item active">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2m-4-4H9m4 0h4m-4 0v4m0 0H9m4 0h4" />
                    </svg>
                    <span class="sidebar-menu-text">Citas</span>
                </a>

                <a href="" class="sidebar-menu-item">
                    <svg class="sidebar-menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="sidebar-menu-text">Historiales</span>
                </a>

                <a href="Servicio_Asis.php" class="sidebar-menu-item">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO3WT4hNYRjH8WNMItGUjSQkpVlZzIiloklNQ7GwUJqVPwuJBTUShaRIFrKQhQzFDqVsUBZiWAwWNv4M+VeSKH/jo9e8J+9c0x3vGd2F/Da3nuf8ft97zj33ed6i+JeES9jYSGC7QXU0EjodOzEm1zgN+9GPZ7iDM9iNbTiKK3iCxziH5cPktGEzZo0EXIQ3eIUT6MHhGF7qHk7hGF4k9dNojjlLYi1kLa4HnIG3OI9JNb3m+K0/hn5Sn4jeBHww1seiNXyOdJdHMIAJda4JQV01tQC4FaFfws9TF1RjfoS9f2wY6l2X3G13jvFrluH3d6HUjhzjB2yqCO1IoFtzjA9xqCK0O4GuyTHeCP+5itADCbQtx7gdr9FUAVq+ve8xrsrcbM8ETsG36M17UmiKk6gn07cqebQbsqAx4CT6Mj1nE+jsKtCuaG5NanPwNNZfYl7Sa4mjMehmNjCZsc/TyRQ3TKkHuJz01ia99UVVGVxrQ3GmTsanGNqHTnzHzHjt9dgLg6VlNNC5MWgFliZ3sgvjIyAMg/lJr7cysOacczXu01KdsXcj7tiwU0stLEYrv5bw3ST45wkAx3Efn2P92qiBpXA7Ab4rzz3YYqiWFX9LWJkEX0zqC5J6f5WxWVdYjX2YOswU2hNOP/UT/qtonH4Arg46sVPur4QAAAAASUVORK5CYII="
                        alt="toothache--v1">
                    <span class="sidebar-menu-text">Servicios</span>
                </a>

                <a href="Promociones_Asis.php" class="sidebar-menu-item">
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

    <!-- Main Content -->
    <div class="content-wrapper">
        <main class="main-content">
            <div class="page-header fade-in">
                <div class="page-title">
                    <h1>Gestión de Citas</h1>
                </div>
            </div>

            <div class="card fade-in delay-1">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Listado de Citas</h3>
                    <a href="registroClien.php" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus"></i> Nuevo Cliente
                    </a>
                </div>
                <div class="card-body">
                    <div class="date-form-container fade-in delay-2">
                        <form id="dateForm" class="date-form-group">
                            <label for="fecha">Seleccionar Fecha:</label>
                            <input type="date" id="fecha" name="fecha" required>
                            <button class="btn-form" type="submit">
                                <i class="fas fa-search"></i> Buscar Citas
                            </button>
                        </form>
                    </div>

                    <div class="table-container fade-in delay-3">
                        <table class="table">
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
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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

        function eliminarCita(idCita) {
            if (!idCita || isNaN(idCita)) {
                alert('ID de cita no válido.');
                return;
            }

            if (confirm('¿Estás seguro de que deseas eliminar esta cita?')) {
                fetch("../controladores/eliminarCita.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `idCita=${encodeURIComponent(idCita)}`
                    })
                    .then(response => {
                        // Aunque haya redirección, muchos servidores devuelven 200 con contenido HTML
                        if (response.redirected) {
                            // Si hubo redirección, la eliminación fue exitosa
                            window.location.href = response.url; // Redirige a la página final
                            return;
                        }
                        return response.text(); // Si no hubo redirección, analiza el texto
                    })
                    .then(data => {
                        if (data && !data.includes('<')) { // Si devuelve texto plano (sin HTML)
                            alert(data); // Podría ser: "Error al eliminar la cita."
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un problema al eliminar la cita.');
                    });
            }
        }


    </script>
</body>

</html>