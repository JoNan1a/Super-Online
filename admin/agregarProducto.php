<?php
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud como JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Obtener los datos del producto
    $categoria = $data['categoria'];
    $nombre = $data['nombre'];
    $tipo = $data['tipo'];
    $codigo = $data['codigo'];
    $precio = $data['precio'];
    $imagen = $data['imagen'];

    // Leer el archivo JSON correspondiente
    $rutaArchivo = '../assets/json/' . strtolower($categoria) . '.json';
    $contenidoJSON = file_get_contents($rutaArchivo);
    $productos = json_decode($contenidoJSON, true);

    // Agregar el nuevo producto al array
    $nuevoProducto = array(
        'nombre' => $nombre,
        'tipo' => $tipo,
        'codigo' => $codigo,
        'precio' => $precio,
        'img' => $imagen
    );
    // Verificar si la categoría ya existe en el archivo JSON
    if (!isset($productos[$categoria])) {
        // Si la categoría no existe, crear un nuevo array para esa categoría
        $productos[$categoria] = [];
    }
    // Agregar el nuevo producto a la categoría correspondiente
    $productos[$categoria][] = $nuevoProducto;

    // Guardar los datos actualizados en el archivo JSON
    file_put_contents($rutaArchivo, json_encode($productos, JSON_PRETTY_PRINT));

    // Responder con un código de estado 200 (OK)
    http_response_code(200);
} else {
    // Si la solicitud no es de tipo POST, responder con un código de estado 405 (Method Not Allowed)
    http_response_code(405);
}
?>