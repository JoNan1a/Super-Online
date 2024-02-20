<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Registro</title>
    <link rel="stylesheet" type="text/css" href="assets/css/registro.css">
</head>

<body>
    <div class="container">
        <p class="titulo">Super Online</p>
        <form action="servidor/registro/registrar.php" method="POST">
            <h2 class="tituloRegistro">Registrarse</h2>
            <div class="campo">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required autofocus>
            </div>

            <div class="campo">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <div class="boton">
                <input type="submit" value="Registrar">
            </div>
        </form>

        <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión</a></p>
    </div>
</body>

</html>