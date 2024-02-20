<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/inicioSesion.css">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="servidor/inicioSesion/inicioSesion.php" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>

            <input type="submit" class="login-button" value="Iniciar Sesión">
        </form>
        <div class="forgot-password">
            <a href="registro.php">Regístrate</a>
        </div>
    </div>
</body>

</html>