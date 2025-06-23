<?php
require_once '../modelo/Conexion.php';

class UsuarioModel
{
    private $conexion;

    public function __construct()
    {
        try {
            $db = new ConexionBD();
            $this->conexion = $db->getConexion();
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function registrarUsuario($datosUsuario)
    {
        try {
            // 1. Mapear el valor de género a los valores ENUM permitidos
            echo "el valor de género es: " . $datosUsuario;
            $genero = match (strtolower($datosUsuario['gender'])) {
                'male', 'masculino', 'm' => 'M',
                'female', 'femenino', 'f' => 'F',
                'other', 'otro', 'o' => 'O',
                default => 'O' 
            };

            // 2. Verificar si el email ya existe
            $consulta = $this->conexion->prepare("SELECT idUsuario FROM Usuarios WHERE email = :email");
            $consulta->bindParam(':email', $datosUsuario['email']);
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                return ['success' => false, 'message' => 'El correo electrónico ya está registrado'];
            }

            // 3. Hash de la contraseña
            $hashedPassword = password_hash($datosUsuario['password'], PASSWORD_BCRYPT);

            // 4. Insertar nuevo usuario
            $sql = "INSERT INTO Usuarios (nombre, aPaterno, aMaterno, fNacimiento, genero, email, password, idRol, estado)
                VALUES (:nombre, :aPaterno, :aMaterno, :fNacimiento, :genero, :email, :password, 3, 'activo')";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $datosUsuario['firstName']);
            $stmt->bindParam(':aPaterno', $datosUsuario['lastName']);
            $stmt->bindParam(':aMaterno', $datosUsuario['motherLastName']);
            $stmt->bindParam(':fNacimiento', $datosUsuario['birthdate']);
            $stmt->bindParam(':genero', $genero); 
            $stmt->bindParam(':email', $datosUsuario['email']);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Asistente registrado exitosamente'];
            } else {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Error al registrar: " . $errorInfo[2]);
            }
        } catch (PDOException $e) {
            throw new Exception("Error en la operación de base de datos: " . $e->getMessage());
        }
    }
}
