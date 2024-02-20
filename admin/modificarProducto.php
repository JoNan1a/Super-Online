<?php
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud como JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Obtener los datos del producto a modificar
    $codigoProducto = $data['codigoProductoModificar'];
    $categoria = $data['categoriaModificar'];
    $tipo = $data['tipoModificar'];
    $nombre = $data['nombreModificar'];
    $precio = $data['precioModificar'];
    $imagen = $data['imagenModificar'];

    // Leer el archivo JSON correspondiente
    $rutaArchivo = '../assets/json/' . strtolower($categoria) . '.json';
    $contenidoJSON = file_get_contents($rutaArchivo);
    $productos = json_decode($contenidoJSON, true);

    // Buscar el producto por su código
    $productoEncontrado = false;
    foreach ($productos[$categoria] as &$producto) {
        if ($producto['codigo'] === $codigoProducto) {
            $producto['nombre'] = $nombre;
            $producto['tipo'] = $tipo;
            $producto['precio'] = $precio;
            $producto['img'] = $imagen;
            $productoEncontrado = true;
            break;
        }
    }

    // Verificar si se encontró el producto
    if ($productoEncontrado) {
        // Guardar los datos actualizados en el archivo JSON
        file_put_contents($rutaArchivo, json_encode($productos, JSON_PRETTY_PRINT));
        // Responder con un código de estado 200 (OK)
        http_response_code(200);
    } else {
        // Responder con un código de estado 404 (Not Found) si no se encontró el producto
        http_response_code(404);
    }
} else {
    // Si la solicitud no es de tipo POST, responder con un código de estado 405 (Method Not Allowed)
    http_response_code(405);
}
?>