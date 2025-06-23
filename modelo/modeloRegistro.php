<?php
include '../modelo/Conexion.php';

session_start();
$idRol = isset($_SESSION['idRol']) ? $_SESSION['idRol'] : null;

// Función para determinar la página de redirección según el rol
function getRedirectPage($idRol)
{
    if ($idRol == 3) { // Asistente
        return '../public/principalAsis.php';
    } elseif ($idRol == 4) { // Administrador
        return '../public/mostrarClientesAd.php';
    } else { // Usuario no autenticado u otros roles
        return '../public/login.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db = new ConexionBD();
        $conexion = $db->getConexion();

        // Obtener datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $phone = $_POST['phone'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $motherLastName = $_POST['motherLastName'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];

        // Validaciones básicas
        if (!in_array($gender, ['M', 'F', 'Otro'])) {
            throw new Exception("El valor del género es inválido.");
        }

        if ($password !== $confirmPassword) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Verificar si el correo ya existe
        $consulta = $conexion->prepare("SELECT idUsuario FROM Usuarios WHERE email = :email");
        $consulta->bindParam(':email', $email);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            throw new Exception("El correo electrónico ya está registrado.");
        }

        // Insertar nuevo usuario
        $sql = "INSERT INTO Usuarios (nombre, aPaterno, aMaterno, fNacimiento, genero, email, password, idRol, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, 1, 'activo')";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            $firstName,
            $lastName,
            $motherLastName,
            $birthdate,
            $gender,
            $email,
            $hashedPassword
        ]);

        echo "<script>
            alert('Cliente registrado exitosamente');
            window.location.href = '" . getRedirectPage($idRol) . "';
        </script>";
        
        exit;
    } catch (Exception $e) {
        $redirectPage = getRedirectPage($idRol);
        echo "<script>
        alert('Error al registrar: " . addslashes($e->getMessage()) . "');
        window.location.href = '$redirectPage';
        </script>";
    }
}
