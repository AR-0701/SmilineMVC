<?php
class ConexionBD
{
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $base_de_datos = "smileline";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->base_de_datos};charset=utf8",
                $this->usuario,
                $this->contraseña
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());   
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}

$c = new ConexionBD();
