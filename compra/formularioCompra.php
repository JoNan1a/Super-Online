<?php 
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilosPrincipales.css">
    <title>Inicio</title>
</head>

<body>
    <header>
        <div class="bienvenida">
            <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?> a Super Online</h1>
        </div>
        <nav>
            <a href="../inicio.php">Inicio</a>
            <a href="servidor/inicioSesion/cierreSesion.php" class="cerrar-sesion">Cerrar sesión</a>
        </nav>
    </header>

    <main class="mainFormulario">
        <div class="formulario">
            <h1>Formulario de Envío</h1>
            <form id="formulario-compra" action="confirmacionCompra.php" method="post">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="campo">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="campo">
                    <label for="mail">Correo Electrónico:</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div class="campo">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="campo">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" required>
                </div>
                <div class="boton">
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </main>



    <footer>
        <p>&copy; SuperOnline Todos los derechos reservados.</p>
    </footer>

    <script src="../script.js"></script>
</body>

</html>