<?php
// Verificar si se han recibido los datos del formulario y si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud como JSON y decodificarlo
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que se hayan recibido todos los datos necesarios y que no estén vacíos
    if (
        isset($data['codigoProductoModificar']) && !empty($data['codigoProductoModificar']) &&
        isset($data['categoriaModificar']) && !empty($data['categoriaModificar']) &&
        isset($data['tipoModificar']) && !empty($data['tipoModificar']) &&
        isset($data['nombreModificar']) && !empty($data['nombreModificar']) &&
        isset($data['precioModificar']) && !empty($data['precioModificar']) &&
        isset($data['imagenModificar']) && !empty($data['imagenModificar'])
    ) {
        // Obtener y limpiar los datos del formulario
        $codigoProducto = htmlspecialchars($data['codigoProductoModificar']);
        $categoria = htmlspecialchars($data['categoriaModificar']);
        $tipo = htmlspecialchars($data['tipoModificar']);
        $nombre = htmlspecialchars($data['nombreModificar']);
        $precio = floatval($data['precioModificar']); // Convertir a flotante para mayor seguridad
        $imagen = htmlspecialchars($data['imagenModificar']);

        // Construir la ruta del archivo JSON correspondiente
        $rutaArchivo = '../assets/json/' . strtolower($categoria) . '.json';

        // Verificar si el archivo existe antes de intentar leerlo
        if (file_exists($rutaArchivo)) {
            // Leer el contenido del archivo JSON y decodificarlo
            $contenidoJSON = file_get_contents($rutaArchivo);
            $productos = json_decode($contenidoJSON, true);

            // Verificar si se pudo decodificar el JSON correctamente
            if ($productos !== null) {
                // Buscar el producto por su código
                $productoEncontrado = false;
                foreach ($productos[$categoria] as &$producto) {
                    if ($producto['codigo'] === $codigoProducto) {
                        // Actualizar los datos del producto
                        $producto['tipo'] = $tipo;
                        $producto['nombre'] = $nombre;
                        $producto['precio'] = $precio;
                        $producto['img'] = $imagen;
                        $productoEncontrado = true;
                        break;
                    }
                }

                // Verificar si se encontró el producto y se actualizó
                if ($productoEncontrado) {
                    // Guardar los datos actualizados en el archivo JSON
                    if (file_put_contents($rutaArchivo, json_encode($productos, JSON_PRETTY_PRINT))) {
                        // Responder con un código de estado 200 (OK)
                        http_response_code(200);
                    } else {
                        // Responder con un código de estado 500 (Internal Server Error) si hay un error al escribir en el archivo
                        http_response_code(500);
                    }
                } else {
                    // Responder con un código de estado 404 (Not Found) si no se encontró el producto
                    http_response_code(404);
                }
            } else {
                // Responder con un código de estado 500 (Internal Server Error) si hay un error al decodificar el JSON
                http_response_code(500);
            }
        } else {
            // Responder con un código de estado 404 (Not Found) si no se encuentra el archivo JSON
            http_response_code(404);
        }
    } else {
        // Responder con un código de estado 400 (Bad Request) si faltan datos en la solicitud
        http_response_code(400);
    }
} else {
    // Si la solicitud no es de tipo POST, responder con un código de estado 405 (Method Not Allowed)
    http_response_code(405);
}
?>
