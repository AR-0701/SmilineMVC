<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../controladores/RecuperarHandler.php" method="POST">
        <label>Correo:</label>
        <input type="email" name="email" required>
        <input type="submit" name="solicitar" value="Enviar enlace">
    </form>

</body>
</html>