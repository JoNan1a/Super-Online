<?php 
session_start();


// Verifica si hay una sesión de usuario iniciada y si el usuario no es un administrador
if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin'){
    // Si no es un admin
    header("location:index.php");
    exit; 
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilosPrincipales.css">
    <style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: 23px;
    }
    </style>
    <title>Administración - Super Online</title>
</head>

<body>
    <header>
        <div class="bienvenida">
            <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?> a Super Online</h1>
        </div>
        <nav>
            <a href="servidor/inicioSesion/cierreSesion.php" class="cerrar-sesion">Cerrar sesión</a>

        </nav>
    </header>

    <main>
        <h1>Página de Administración</h1>
        <div class="containerAdmin">
            <div class="opciones-admin">
                <button style="margin-top:10px;" onclick="mostrarFormulario('agregarProducto')">Agregar
                    Producto</button>
                <button onclick="mostrarFormulario('modificarProducto')">Modificar Producto</button>
                <button onclick="mostrarFormulario('eliminarProducto')">Eliminar Producto</button>
                <button onclick="mostrarFormulario('agregarSeccion')">Agregar Sección</button>
                <button onclick="mostrarFormulario('eliminarSeccion')">Eliminar seccion</button>

                <!-- Formulario para agregar producto -->
                <div id="agregarProducto" style="display: none;">
                    <h2>Formulario para Agregar Producto</h2>
                    <form id="formAgregarProducto">
                        <p>ATENCIÓN! Las categorías y el tipo de producto deben coincidir</p>

                        <label for="categoria">Categoría:</label>
                        <select name="categoria" id="categoria" required>
                        </select><br><br>

                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo" required>
                        </select><br><br>

                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" name="nombre" id="nombre" required><br><br>

                        <p style="border-bottom: 2px solid red;">Por favor, antes de agregar un nuevo código, asegúrate
                            de verificar que no esté actualmente en uso en el buscador por código.</p>
                        <label for="codigo">Código:</label>
                        <input type="number" name="codigo" id="codigo" oninput="javascript: if (this.value.length > 7) this.value = this.value.slice(0, 7);">


                        <label for="precio">Precio:</label>
                        <input type="number" name="precio" id="precio" required min="0"><br><br>

                        <label for="imagen">URL de la Imagen:</label>
                        <input type="text" name="imagen" id="imagen" required><br><br>

                        <input type="button" value="Agregar Producto" onclick="agregarProducto()">
                    </form>
                </div>
                <!-- Formulario para modificar producto -->
                <div id="modificarProducto" style="display: none">
                    <h3>Modificar Producto</h3>
                    <form id="formModificarProducto">
                        <p>ATENCION! Las categorias y el tipo de producto deben ser coincidir</p>
                        <!-- Campo para ingresar el código del producto a modificar -->
                        <label for="codigoProductoModificar">Código del Producto:</label>
                        <input type="number" id="codigoProductoModificar" name="codigoProductoModificar" oninput="javascript: if (this.value.length > 7) this.value = this.value.slice(0, 7);">
                        <br><br><br>


                        <!-- Campo de selección de categoría -->
                        <label for="categoriaModificar">Categoría:</label>
                        <select name="categoriaModificar" id="categoriaModificar">
                        </select><br><br>

                        <!-- Campo de selección de tipo -->
                        <label for="tipoModificar">Tipo:</label>
                        <select name="tipoModificar" id="tipoModificar">
                        </select><br><br>


                        <!-- Campo para el nombre del producto -->
                        <label for="nombreModificar">Nombre del Producto:</label>
                        <input type="text" id="nombreModificar" name="nombreModificar" required><br><br>

                        <!-- Campo para el precio del producto -->
                        <label for="precioModificar">Precio:</label>
                        <input type="number" id="precioModificar" name="precioModificar" required min="0"><br><br>

                        <!-- Campo para la imagen del producto -->
                        <label for="imagenModificar">URL de la Imagen:</label>
                        <input type="text" id="imagenModificar" name="imagenModificar" required><br><br>

                        <!-- Botón para enviar el formulario -->
                        <input type="button" value="Modificar Producto" onclick="modificarProducto()">
                    </form>


                </div>

                <!-- Formulario para eliminar producto -->
                <div id="eliminarProducto" style="display: none;">
                    <h4>Eliminar Producto</h4>
                    <p>ATENCION! Las categorias y el tipo de producto deben ser coincidir</p>
                    <form id="formEliminarProducto">

                        <label for="categoriaEliminar">Categoría:</label>
                        <select name="categoriaEliminar" id="categoriaEliminar">
                        </select><br><br>


                        <label for="tipoEliminar">Tipo:</label>
                        <select name="tipoEliminar" id="tipoEliminar">
                        </select><br><br>

                        <label for="codigoProductoEliminar">Código del Producto:</label>
                        <input type="number" id="codigoProductoEliminar" name="codigoProductoEliminar" required
                            maxlength="7" pattern="[0-9]*"><br><br>

                        <input type="button" value="Eliminar Producto" onclick="eliminarProducto()">
                    </form>
                </div>

                <!-- Formulario para agregar categoria de producto-->
                <div id="agregarSeccion">
                    <h5>Crear nueva categoria de producto</h5>
                    <p>ATENCION! El nombre del archivo y de la categoria deben coincidir</p>
                    <form id="crearArchivoForm">
                        <label for="nombreArchivo">Nombre del archivo (sin extensión):</label><br>
                        <input type="text" id="nombreArchivo" name="nombreArchivo"><br>
                        <label for="nombreCategoria">Nombre de la categoría:</label><br>
                        <input type="text" id="nombreCategoria" name="nombreCategoria"><br><br>
                        <button type="submit">Crear Archivo JSON</button>
                    </form>
                </div>

                <!-- Formulario para eliminar categoria de producto-->
                <div id="eliminarSeccion">
                    <h6>Eliminar una categoría de producto</h6>
                    <select name="eliminarArchivo" id="eliminarArchivo">
                    </select><br><br>
                    <button id="eliminarArchivoBtn">Eliminar Archivo JSON</button>
                </div>

            </div>

            <!-- Filtar por codigo de producto -->
            <div class="filtroCodigo" style="display: flex; flex-direction: column; align-items: center;">
                <input type="text" id="codigoBusqueda" placeholder="Buscar por código..." style="margin-bottom: 10px;">
                <button class="filtrarProducto" style="margin-bottom: 10px;">Buscar código</button>
                <div class="categorias-container" style="overflow-y: auto; max-height: 600px;"></div>
            </div>

        </div>


    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
    function mostrarFormulario(idFormulario) {
        // Ocultar todos los formularios
        var formularios = document.querySelectorAll('.opciones-admin > div');
        formularios.forEach(function(formulario) {
            formulario.style.display = 'none';
        });

        // Mostrar el formulario seleccionado
        var formularioSeleccionado = document.getElementById(idFormulario);
        formularioSeleccionado.style.display = 'block';
    }

    function agregarProducto() {
        // Obtener los datos del formulario
        var categoria = document.getElementById('categoria').value;
        var tipo = document.getElementById('tipo').value; // Obtener el tipo seleccionado
        var nombre = document.getElementById('nombre').value;
        var codigo = document.getElementById('codigo').value;
        var precio = parseFloat(document.getElementById('precio').value); // Convertir a float
        var imagen = document.getElementById('imagen').value;

        // Validar que todos los campos estén completos
        if (categoria === '' || tipo === '' || nombre === '' || codigo === '' || precio === '' || isNaN(precio) ||
            imagen === '') {
            alert('Por favor complete todos los campos correctamente.');
            return;
        }

        // Crear un objeto con los datos del producto
        var nuevoProducto = {
            categoria: categoria,
            tipo: tipo,
            nombre: nombre,
            codigo: codigo,
            precio: precio,
            imagen: imagen
        };

        // Enviar los datos al servidor usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin/agregarProducto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Si la operación es exitosa, recargar la página
                location.reload();
            } else {
                // Si hay un error, mostrar un mensaje de error
                alert('Error al agregar el producto.');
            }
        };
        xhr.send(JSON.stringify(nuevoProducto));
    }


    function modificarProducto() {
        // Obtener los datos del formulario
        var codigoProducto = document.getElementById('codigoProductoModificar').value;
        var categoria = document.getElementById('categoriaModificar').value;
        var tipo = document.getElementById('tipoModificar').value;
        var nombre = document.getElementById('nombreModificar').value;
        var precio = parseFloat(document.getElementById('precioModificar').value);
        var imagen = document.getElementById('imagenModificar').value;

        // Validar que todos los campos estén completos
        if (codigoProducto === '' || categoria === '' || tipo === '' || nombre === '' || precio === '' || isNaN(
                precio) || imagen === '') {
            alert('Por favor complete todos los campos correctamente.');
            return;
        }

        // Crear un objeto con los datos del producto a modificar
        var productoModificado = {
            codigoProductoModificar: codigoProducto,
            categoriaModificar: categoria,
            tipoModificar: tipo,
            nombreModificar: nombre,
            precioModificar: precio,
            imagenModificar: imagen
        };

        // Enviar los datos al servidor usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin/modificarProducto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Si la operación es exitosa, recargar la página
                location.reload();
            } else {
                // Si hay un error, mostrar un mensaje de error
                alert('Error al modificar el producto.');
            }
        };
        xhr.send(JSON.stringify(productoModificado));
    }



    function eliminarProducto() {
        // Obtener los datos del formulario
        var categoria = document.getElementById('categoriaEliminar').value;
        var tipo = document.getElementById('tipoEliminar').value;
        var codigoProducto = document.getElementById('codigoProductoEliminar').value;

        // Validar que todos los campos estén completos
        if (categoria === '' || tipo === '' || codigoProducto === '') {
            alert('Por favor complete todos los campos correctamente.');
            return;
        }

        // Crear un objeto con los datos del producto a eliminar
        var productoEliminar = {
            categoria: categoria,
            tipo: tipo,
            codigoProducto: codigoProducto
        };

        // Enviar los datos al servidor usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin/eliminarProducto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Si la operación es exitosa, recargar la página para actualizar la lista de productos
                location.reload();
            } else {
                // Si hay un error, mostrar un mensaje de error
                alert('Error al eliminar el producto.');
            }
        };
        xhr.send(JSON.stringify(productoEliminar));
    }

    // Función para cargar los productos
    function cargarProductos() {
        const url = "assets/json/";
        console.log("Cargando productos desde:", url);

        fetch(url)
            .then((response) => response.text())
            .then((data) => {
                console.log("Datos recibidos:", data);

                // Parsear el HTML recibido para extraer los nombres de los archivos JSON
                const parser = new DOMParser();
                const htmlDoc = parser.parseFromString(data, "text/html");
                const links = htmlDoc.querySelectorAll("a");
                const categorias = Array.from(links)
                    .filter((link) => link.href.endsWith(".json"))
                    .map((link) => link.textContent.replace(".json", ""));

                // Cargar los productos para cada categoría
                categorias.forEach((categoria) => {
                    fetch(`${url}${categoria}.json`)
                        .then((response) => response.json())
                        .then((productos) => {
                            mostrarProductosEnHTML(categoria, productos);
                        })
                        .catch((error) => {
                            console.error(`Error al cargar los productos (${categoria}):`, error);
                        });
                });
            })
            .catch((error) => {
                console.error("Error al obtener la lista de archivos JSON:", error);
            });
    }

    // Función para mostrar los productos en el HTML
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
            productos[categoria].forEach((producto) => {
                // Crear la tarjeta de producto
                const card = document.createElement("div");
                card.classList.add("card");

                // Crear el contenido de la tarjeta
                let contenidoCard = `
                <img src="${producto.img}" alt="${producto.nombre}" class="card-imagen">
                <div class="card-info">
                    <h3>${producto.nombre}</h3>
                    <p>Tipo del producto: ${producto.tipo}</p>
                    <p>Codigo del producto: ${producto.codigo}</p>
            `;

                // Agregar el campo "precio" solo si no es nulo
                if (producto.precio !== null && typeof producto.precio !== 'undefined') {
                    contenidoCard += `<p>Precio: $${producto.precio.toFixed(2)}</p>`;
                }

                // Agregar el contenido a la tarjeta y la tarjeta al artículo de la categoría
                card.innerHTML = contenidoCard;
                categoriaArticle.appendChild(card);
            });
        } else {
            console.warn(`No hay productos para mostrar en la categoría ${categoria}`);
        }

        // Agregar el título de la categoría y el artículo al contenedor principal
        container.appendChild(categoriaTitulo);
        container.appendChild(categoriaArticle);
    }

    // Función para buscar productos por código
    function buscarPorCodigo() {
        // Obtener el valor del código de búsqueda del input
        const codigoBusqueda = document.getElementById("codigoBusqueda").value.trim().toLowerCase();

        // Obtener  los elementos de "article-categoria"
        const categorias = document.querySelectorAll(".article-categoria");

        categorias.forEach(categoria => {
            // Obtener todos los elementos hijos
            const productos = categoria.querySelectorAll(".card");

            productos.forEach(producto => {
                // Obtener el código del producto actual
                const codigoProducto = producto.querySelector("p:nth-child(3)").textContent
                    .toLowerCase();

                // Mostrar u ocultar el producto según si coincide con el código de búsqueda
                if (codigoProducto.includes(codigoBusqueda)) {
                    producto.style.display = "block";
                } else {
                    producto.style.display = "none";
                }
            });
        });
    }

    // Agregar un evento de clic al botón de búsqueda
    document.querySelector(".filtrarProducto").addEventListener("click", buscarPorCodigo);

    // Agregar un evento de entrada al input para detectar cambios en su valor
    document.getElementById("codigoBusqueda").addEventListener("input", function() {
        const codigoBusqueda = this.value.trim()
            .toLowerCase(); // Obtener el valor del código de búsqueda y limpiarlo

        // Si el valor del código de búsqueda está vacío
        if (codigoBusqueda === "") {
            // Restablecer la visualización de todos los productos
            const productos = document.querySelectorAll(".card");
            productos.forEach(producto => {
                producto.style.display = "block"; // Mostrar todos los productos
            });
        }
    });

    // Cargar los productos al cargar la página
    window.addEventListener("load", cargarProductos);




    // Agregar nuevo archivo json
    $(document).ready(function() {
        $('#crearArchivoForm').submit(function(e) {
            e.preventDefault();

            var nombreArchivo = $('#nombreArchivo').val();
            var nombreCategoria = $('#nombreCategoria').val();

            // Validar que ambos campos no estén vacíos
            if (nombreArchivo.trim() !== '' && nombreCategoria.trim() !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'admin/nuevoJson.php',
                    data: {
                        nombreArchivo: nombreArchivo,
                        nombreCategoria: nombreCategoria
                    },
                    success: function(response) {
                        alert(response); // Mostrar mensaje de éxito o error
                        location
                            .reload(); // Actualizar la página después de agregar el archivo JSON
                    }
                });
            } else {
                alert('Por favor, rellene ambos campos.');
            }
        });
    });

    // Eliminar archivo json
    $(document).ready(function() {
        // Manejar el evento de clic en el botón de eliminar
        $('#eliminarArchivoBtn').click(function() {
            var nombreArchivo = $('#eliminarArchivo').val();

            // Agregar la extensión .json al nombre del archivo
            nombreArchivo += '.json';

            // Comprobar si se ha seleccionado un archivo
            if (nombreArchivo != '') {
                // Confirmar la eliminación con el usuario
                var confirmacion = confirm('¿Estás seguro de eliminar la categoría ' + nombreArchivo +
                    '?');

                if (confirmacion) {
                    $.ajax({
                        type: 'POST',
                        url: 'admin/eliminarJson.php',
                        data: {
                            nombreArchivo: nombreArchivo
                        },
                        success: function(response) {
                            alert(response); // Mostrar mensaje de éxito o error
                            location
                                .reload(); // Actualizar la página después de eliminar el archivo JSON
                        }
                    });
                } else {
                    alert('Operación cancelada.');
                }
            } else {
                alert('Por favor, seleccione una categoría para eliminar.');
            }
        });
    });

    //Mostrar dinamicamente las opciones
    const url = 'assets/json/';

    // Lista de archivos JSON en la carpeta
    function obtenerArchivosJSON() {
        return fetch(url)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDoc = parser.parseFromString(data, 'text/html');
                const links = Array.from(htmlDoc.querySelectorAll('a'));
                return links
                    .filter(link => link.href.endsWith('.json'))
                    .map(link => link.textContent.replace('.json', ''));
            });
    }

    function cargarOpcionesSelects() {
        const selectores = ['categoria', 'eliminarArchivo', 'tipo', 'categoriaModificar', 'tipoModificar',
            'categoriaEliminar',
            'tipoEliminar'
        ];
        selectores.forEach(selector => {
            const select = document.getElementById(selector);
            obtenerArchivosJSON()
                .then(archivos => {
                    archivos.forEach(archivo => {
                        const option = document.createElement('option');
                        option.value = archivo;
                        option.textContent = archivo;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error(`Error al cargar opciones para ${selector}:`, error));
        });
    }

    // Función para actualizar el tipo automáticamente cuando se selecciona una categoría
    function actualizarTipo(categoria, tipoInput) {
        tipoInput.value = categoria;
    }
    // Agregar evento change a los selectores de categoría
    document.getElementById('categoria').addEventListener('change', function() {
        const categoriaSeleccionada = this.value;
        const tipoInput = document.getElementById('tipo');
        actualizarTipo(categoriaSeleccionada, tipoInput);
    });

    document.getElementById('categoriaModificar').addEventListener('change', function() {
        const categoriaSeleccionada = this.value;
        const tipoModificar = document.getElementById('tipoModificar');
        actualizarTipo(categoriaSeleccionada, tipoModificar);
    });

    document.getElementById('categoriaEliminar').addEventListener('change', function() {
        const categoriaSeleccionada = this.value;
        const tipoEliminar = document.getElementById('tipoEliminar');
        actualizarTipo(categoriaSeleccionada, tipoEliminar);
    });


    cargarOpcionesSelects();
    </script>
    <script src="script.js"></script>

</body>

</html>