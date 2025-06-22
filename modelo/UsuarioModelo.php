<?php
require_once '../modelo/Conexion.php';

class UsuarioModelo
{
    private $conexion;

    public function __construct()
    {
        $bd = new ConexionBD();
        $this->conexion = $bd->getConexion();
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function guardarToken($email, $token, $expira)
    {
        $sql = "UPDATE usuarios SET token_recuperacion = ?, token_expira = ? WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$token, $expira, $email]);
    }

    public function buscarPorToken($token)
    {
        $sql = "SELECT * FROM Usuarios WHERE token_recuperacion = ? AND token_expira > NOW() LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$token]);
        return $stmt->fetch();
    }


    public function actualizarPassword($idUsuario, $nuevaPassword)
    {
        $sql = "UPDATE usuarios SET password = ?, token_recuperacion = NULL, token_expira = NULL WHERE idUsuario = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$nuevaPassword, $idUsuario]);
    }
}
