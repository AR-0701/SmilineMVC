<?php
require_once 'Conexion.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $conexion = new ConexionBD();
        $this->db = $conexion->getConexion();
    }

    public function autenticar($email, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }
}
