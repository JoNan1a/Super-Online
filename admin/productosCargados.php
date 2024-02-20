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


</header>
<body>

<main>
    
<!-- Contenedor de categorías -->
<div class="categorias-container">
</div>


</main>


<script>
    function cargarProductos() {
        const url = '../assets/json/';
        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Parsear el HTML recibido para extraer los nombres de los archivos JSON
                const parser = new DOMParser();
                const htmlDoc = parser.parseFromString(data, 'text/html');
                const links = htmlDoc.querySelectorAll('a');
                const categorias = Array.from(links)
                    .filter(link => link.href.endsWith('.json'))
                    .map(link => link.textContent.replace('.json', ''));
                
                // Cargar los productos para cada categoría
                categorias.forEach(categoria => {
                    fetch(`${url}${categoria}.json`)
                        .then(response => response.json())
                        .then(productos => {
                            console.log(`Productos cargados (${categoria}):`, productos);
                            mostrarProductosEnHTML(categoria, productos);
                        })
                        .catch(error => {
                            console.error(`Error al cargar los productos (${categoria}):`, error);
                        });
                });
            })
            .catch(error => {
                console.error('Error al obtener la lista de archivos JSON:', error);
            });


    }

    function mostrarProductosEnHTML(categoria, productos) {
        const container = document.querySelector(".categorias-container");
    
        const categoriaTitulo = document.createElement("p");
        categoriaTitulo.classList.add("nombre-categorias");
        categoriaTitulo.textContent = categoria;
    
        const categoriaArticle = document.createElement("article");
        categoriaArticle.classList.add("article-categoria");
        categoriaArticle.id = categoria;
    
        // Verificar si hay productos para mostrar
        if (Array.isArray(productos[categoria]) && productos[categoria].length > 0) {
            productos[categoria].forEach(producto => {
                const card = document.createElement("div");
                card.classList.add("card");
    
                const contenidoCard = `
                    <img src="${producto.img}" alt="${producto.nombre}" class="card-imagen">
                    <div class="card-info">
                        <h3>${producto.nombre}</h3>
                        <p>Tipo de producto: ${producto.tipo}</p>
                        <p>Precio: $${producto.precio.toFixed(2)}</p>
                        <p>Codigo de producto: ${producto.codigo}</p>

                        

                    </div>
                `;
                card.innerHTML = contenidoCard;
                categoriaArticle.appendChild(card);


            });
        } else {
            console.warn(`No hay productos para mostrar en la categoría ${categoria}`);
        }
    
        container.appendChild(categoriaTitulo);
        container.appendChild(categoriaArticle);
    }
    






    
    cargarProductos();
</script>






</body>
</html>