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
    <link rel="stylesheet" href="assets/css/estilosPrincipales.css">
    <title>Inicio</title>
</head>
<body>
    <header>
        <div class="bienvenida">
            <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?> a Super Online</h1>
        </div>
        <nav>
        <a href="#" id="carrito-link">Carrito</a>
        <a href="servidor/inicioSesion/cierreSesion.php" class="cerrar-sesion">Cerrar sesión</a>
        </nav>
    </header>

    <!-- Contenedor del carrito style="display: none;" -->
    <div id="carrito-popup" style="display: none;">
        <p class="carrito-titulo">Carrito</p>
        <div id="carrito-contenido" style="max-height: 85%; overflow-y: auto;"></div>
    </div>


<main>
    <div class="categorias-container">
        <p class="nombre-categorias">Bebidas</p>
        <article class="article-categoria" id="Bebidas"></article>
        <p class="nombre-categorias">Carnes</p>
        <article class="article-categoria" id="Carnes"></article>
        <p class="nombre-categorias">Frutas</p>
        <article class="article-categoria" id="Frutas"></article>
        <p class="nombre-categorias">Golosinas</p>
        <article class="article-categoria" id="Golosinas"></article>
        <p class="nombre-categorias">Panadería</p>
        <article class="article-categoria" id="Panaderia"></article>
        <p class="nombre-categorias">Pastas</p>
        <article class="article-categoria" id="Pastas"></article>
        <p class="nombre-categorias">Limpieza</p>
        <article class="article-categoria" id="Limpieza"></article>
        <p class="nombre-categorias">Lacteos</p>
        <article class="article-categoria" id="Lacteos"></article>
    </div>
</main>

<footer>
    <p>&copy; SuperOnline Todos los derechos reservados.</p>
</footer>

    <script src="script.js"></script>
</body>
</html>


