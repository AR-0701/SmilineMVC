<?php
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../controladores/RecuperarHandler.php" method="POST">
    <input type="hidden" name="token" value="<?= $token ?>">
    <label>Nueva contraseña:</label>
    <input type="password" name="nuevaPass" required>
    <input type="submit" name="cambiar" value="Cambiar contraseña">
</form>

</body>
</html>
