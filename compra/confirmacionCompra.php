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
        <main class="containerConfirmacion">
        <div>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombre = $_POST["nombre"];
                    $apellido = $_POST["apellido"];
                    $mail = $_POST["mail"];
                    $direccion = $_POST["direccion"];
                    $ciudad = $_POST["ciudad"];

                    // Mensaje de confirmación
                    echo "<h1>Gracias por tu compra, $nombre !</h1>";
                    echo "<p>El producto será enviado a la siguiente dirección:</p>";
                    echo "<p>$direccion, $ciudad</p>";
                    echo "<p>Recibirás tu pedido en un plazo de 2 a 6 días.</p>";
                    echo "<p>Para cualquier duda o inconveniente, contáctanos a suupermonline@gmail.com</p>";
                } else {
                    // Si se intenta acceder directamente a esta página sin enviar el formulario
                    echo "<h1>Debes completar el formulario</h1>";
                }
            ?>
        </div>
            </main>


<footer>
<p>&copy; SuperOnline Todos los derechos reservados.</p>
</footer>

    <script src="script.js"></script>
</body>
</html>
