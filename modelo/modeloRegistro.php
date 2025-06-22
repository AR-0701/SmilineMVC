<?php
include '../modelo/Conexion.php';
$_SESSION['idRol'] = "1";

$clienteLogueado = [
    'idRol' => $_SESSION['idRol']
];

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
        // Preparar consulta
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

        echo "<script>alert('Cliente registrado exitosamente');</script>";

        switch ($clienteLogueado['idRol']) {
            case 1:
                header("Location: ../public/login.php");
                break;
            case 2:
            case 3:
                header("Location: ../public/mostrarClientes.php");
                break;
            case 4:
                header("Location: ../public/mostrarClientesAd.php");
                break;
            default:
                header("Location: ../public/login.php");
                break;
        }
        exit;
    } catch (Exception $e) {
        echo "<script>
        alert('Error al registrar: " . $e->getMessage() . "');
        window.location.href = '../public/registroClienPrin.php';
    </script>";
    }
}
