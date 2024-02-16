<?php 
session_start();

// Verifica si hay una sesión de usuario iniciada y si el usuario no es un administrador
if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin'){
    // Si no es un administrador, redirige a la página de inicio de sesión
    header("location:index.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilosPrincipales.css">
    <title>Administración - Super Online</title>
</head>
<header>
    <div class="bienvenida">
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?> a Super Online</h1>
    </div>
    <nav>
        <a href="../paginaAdmin.php">Administración de productos</a>

        <a href="../servidor/inicioSesion/cierreSesion.php" class="cerrar-sesion">Cerrar sesión</a>
    </nav>

    <div class="botonera-categorias">
    <button onclick="navegarACategoria('Bebidas')">Bebidas</button>
    <button onclick="navegarACategoria('Carnes')">Carnes</button>
    <button onclick="navegarACategoria('Frutas')">Frutas</button>
    <button onclick="navegarACategoria('Golosinas')">Golosinas</button>
    <button onclick="navegarACategoria('Panadería')">Panadería</button>
    <button onclick="navegarACategoria('Pastas')">Pastas</button>
    <button onclick="navegarACategoria('Limpieza')">Limpieza</button>
    <button onclick="navegarACategoria('Lácteos')">Lácteos</button>
</div>
</header>
<body>

<main>
    
<!-- Contenedor de categorías -->
<div class="categorias-container">
    <!-- Bebidas -->
    <p class="nombre-categorias">Bebidas</p>
    <article class="article-categoria" id="Bebidas"></article>

    <!-- Carnes -->
    <p class="nombre-categorias">Carnes</p>
    <article class="article-categoria" id="Carnes"></article>

    <!-- Frutas -->
    <p class="nombre-categorias">Frutas</p>
    <article class="article-categoria" id="Frutas"></article>

    <!-- Golosinas -->
    <p class="nombre-categorias">Golosinas</p>
    <article class="article-categoria" id="Golosinas"></article>

    <!-- Panadería -->
    <p class="nombre-categorias">Panadería</p>
    <article class="article-categoria" id="Panaderia"></article>

    <!-- Pastas -->
    <p class="nombre-categorias">Pastas</p>
    <article class="article-categoria" id="Pastas"></article>

    <!-- Limpieza -->
    <p class="nombre-categorias">Limpieza</p>
    <article class="article-categoria" id="Limpieza"></article>

    <!-- Lácteos -->
    <p class="nombre-categorias">Lácteos</p>
    <article class="article-categoria" id="Lacteos"></article>
</div>


</main>


<script>
        // Función para cargar productos
        function cargarProductos() {
        const categorias = [
            "Bebidas",
            "Carnes",
            "Frutas",
            "Golosinas",
            "Panaderia",
            "Pastas",
            "Limpieza",
            "Lacteos",
        ];

        categorias.forEach((categoria) => {
            fetch(`../assets/json/${categoria}.json`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(`Productos cargados (${categoria}):`, data);

                    if (data[categoria] && Array.isArray(data[categoria])) {
                        const categoriaArticle = document.getElementById(categoria);

                        data[categoria].forEach((producto) => {
                            const card = document.createElement("div");
                            card.classList.add("card");

                            const contenidoCard = `
                                <img src="${producto.img}" alt="${producto.nombre}" class="card-imagen">
                                <div class="card-info">
                                    <h3>${producto.nombre}</h3>
                                    <p>${producto.tipo}</p>
                                    <p>Precio: $${producto.precio.toFixed(2)}</p>
                                    
                                </div>
                            `;

                            card.innerHTML = contenidoCard;
                            categoriaArticle.appendChild(card);

                            
                        });
                    } else {
                        console.error(
                            `Error al cargar los productos (${categoria}): El archivo JSON no tiene la estructura esperada.`
                        );
                    }
                })
                .catch((error) => {
                    console.error(`Error al cargar los productos (${categoria}):`, error);
                });
        });
    }
    cargarProductos();

    function navegarACategoria(categoria) {
        // Encontrar el elemento <p> con la clase "nombre-categorias" y el texto de la categoría deseada
        var elementosCategorias = document.getElementsByClassName('nombre-categorias');
        for (var i = 0; i < elementosCategorias.length; i++) {
            var nombreCategoria = elementosCategorias[i].textContent;
            if (nombreCategoria === categoria) {
                // Hacer scroll hasta el elemento encontrado
                elementosCategorias[i].scrollIntoView({ behavior: 'smooth' });
                break;
            }
        }
    }
</script>



</body>
</html>