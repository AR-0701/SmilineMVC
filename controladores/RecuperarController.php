<?php
require_once '../modelo/UsuarioModelo.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class RecuperarController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new UsuarioModelo();
    }

    public function enviarCorreoRecuperacion($email)
    {
        $usuario = $this->modelo->buscarPorEmail($email);
        if (!$usuario) {
            return "Correo no registrado.";
        }

        $token = bin2hex(random_bytes(16));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $this->modelo->guardarToken($email, $token, $expira);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'smilelineoficial@gmail.com'; // Cambiar
            $mail->Password = 'oalb znsk woow qxse'; // Cambiar
            $mail->SMTPSecure = 'tls';

            $mail->setFrom('smilelineoficial@gmail.com', 'SmileLine');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = '🔐 Recuperar tu contraseña - SmileLine';

            $token = bin2hex(random_bytes(16));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $this->modelo->guardarToken($email, $token, $expira);

            $link = "http://localhost:3000/public/resetear.php?token=" . $token;


            $mail->Body = "
                <h2>Hola, {$usuario['nombre']} {$usuario['aPaterno']}!</h2>
                <p>Haz clic en el siguiente enlace para restablecer tu contraseña. Este enlace expira en 1 hora:</p>
                <a href='$link'>$link</a>
                <p>Si no solicitaste esto, ignora este correo.</p>
            ";

            $mail->send();
            echo "Fecha actual del servidor: " . date('Y-m-d H:i:s');
            return "Correo enviado con éxito.";

        } catch (Exception $e) {
            return "Error al enviar el correo: " . $mail->ErrorInfo;
        }
    }

    public function cambiarPassword($token, $nuevaPass)
    {
        $usuario = $this->modelo->buscarPorToken($token);
        if (!$usuario) {
            return "Token inválido o expirado.";
        }

        $passwordHash = password_hash($nuevaPass, PASSWORD_BCRYPT);
        $this->modelo->actualizarPassword($usuario['idUsuario'], $passwordHash);
        return "Contraseña actualizada correctamente.";
    }
}
