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
    <link rel="stylesheet" href="assets/css/estilosPrincipales.css">
    <title>Administración - Super Online</title>
</head>
<body>
<header>
    <div class="bienvenida">
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?> a Super Online</h1>
    </div>
    <nav>
        <a href="admin/productosCargados.php" class="prd-cargados">Mostrar Productos</a>
        <a href="servidor/inicioSesion/cierreSesion.php" class="cerrar-sesion">Cerrar sesión</a>
        
    </nav>
</header>

<main>
    <h1>Página de Administración</h1>
    <div class="opciones-admin">
        <!-- Botones para las opciones -->
        <button onclick="mostrarFormulario('agregarProducto')">Agregar Producto</button>
        <button onclick="mostrarFormulario('modificarProducto')">Modificar Producto</button>
        <button onclick="mostrarFormulario('eliminarProducto')">Eliminar Producto</button>
        <button onclick="mostrarFormulario('agregarSeccion')">Agregar Sección</button>
        
        <!-- Formulario para agregar producto -->
        <div id="agregarProducto" style="display: none;">
            <h3>Formulario para Agregar Producto</h3>
            <form id="formAgregarProducto">
                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
                </select><br><br>

                <!-- Agregar campo para seleccionar el tipo -->
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
                </select><br><br>

                <label for="nombre">Nombre del Producto:</label>
                <input type="text" name="nombre" id="nombre" required><br><br>

                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" required><br><br>

                <label for="precio">Precio:</label>
                <input type="text" name="precio" id="precio" required><br><br>

                <label for="imagen">URL de la Imagen:</label>
                <input type="text" name="imagen" id="imagen" required><br><br>

                <input type="button" value="Agregar Producto" onclick="agregarProducto()">
            </form>
        </div>

        <div id="modificarProducto" style="display: none">
        <h4>Modificar Producto</h4>
<form id="formModificarProducto">

<!-- Campo para ingresar el código del producto a modificar -->
<label for="codigoProductoModificar">Código del Producto:</label>
    <input type="text" id="codigoProductoModificar" name="codigoProductoModificar" required><br><br>

    <!-- Campo de selección de categoría -->
    <label for="categoriaModificar">Categoría:</label>
    <select name="categoriaModificar" id="categoriaModificar">
    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
    </select><br><br>

    <!-- Campo de selección de tipo -->
    <label for="tipoModificar">Tipo:</label>
    <select name="tipoModificar" id="tipoModificar">
    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
    </select><br><br>


    <!-- Campo para el nombre del producto -->
    <label for="nombreModificar">Nombre del Producto:</label>
    <input type="text" id="nombreModificar" name="nombreModificar" required><br><br>

    <!-- Campo para el precio del producto -->
    <label for="precioModificar">Precio:</label>
    <input type="number" id="precioModificar" name="precioModificar" step="0.01" required><br><br>

    <!-- Campo para la imagen del producto -->
    <label for="imagenModificar">URL de la Imagen:</label>
    <input type="text" id="imagenModificar" name="imagenModificar" required><br><br>

    <!-- Botón para enviar el formulario -->
    <input type="button" value="Modificar Producto" onclick="modificarProducto()">
</form>
    
    
    </div>


        <div id="eliminarProducto" style="display: none;">
    <h4>Eliminar Producto</h4>
    <form id="formEliminarProducto">
        <!-- Campo de selección de categoría -->
        <label for="categoriaEliminar">Categoría:</label>
        <select name="categoriaEliminar" id="categoriaEliminar">
                    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
        </select><br><br>

        <!-- Campo de selección de tipo -->
        <label for="tipoEliminar">Tipo:</label>
        <select name="tipoEliminar" id="tipoEliminar">
                    <option value="Bebidas">Bebidas</option>
                    <option value="Carnes">Carnes</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Golosinas">Golosinas</option>
                    <option value="Lacteos">Lácteos</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Panaderia">Panadería</option>
                    <option value="Pastas">Pastas</option>
        </select><br><br>

        <label for="codigoProductoEliminar">Código del Producto:</label>
        <input type="text" id="codigoProductoEliminar" name="codigoProductoEliminar" required><br><br>

        <input type="button" value="Eliminar Producto" onclick="eliminarProducto()">
    </form>
</div>

        

    </div>
</main>

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
                // Si la operación es exitosa, redirigir a la página de administración
                window.location.href = 'paginaAdmin.php';
            } else {
                // Si hay un error, mostrar un mensaje de error
                alert('Error al agregar el producto.');
            }
        };
        xhr.send(JSON.stringify(nuevoProducto));
    }



    function eliminarProducto() {
    // Obtener los datos del formulario
    var categoria = document.getElementById('categoriaEliminar').value;
    var tipo = document.getElementById('tipoEliminar').value;
    var codigoProducto = document.getElementById('codigoProductoEliminar').value;

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



function modificarProducto() {
    // Obtener los datos del formulario
    var codigoProducto = document.getElementById('codigoProductoModificar').value;
    var categoria = document.getElementById('categoriaModificar').value;
    var tipo = document.getElementById('tipoModificar').value;
    var nombre = document.getElementById('nombreModificar').value;
    var precio = parseFloat(document.getElementById('precioModificar').value);
    var imagen = document.getElementById('imagenModificar').value;

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
            // Si la operación es exitosa, redirigir a la página de administración
            window.location.href = 'paginaAdmin.php';
        } else {
            // Si hay un error, mostrar un mensaje de error
            alert('Error al modificar el producto.');
        }
    };
    xhr.send(JSON.stringify(productoModificado));
}


</script>

<script src="script.js"></script>

</body>
</html>
