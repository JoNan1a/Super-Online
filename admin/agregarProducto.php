<?php
// Verificar si se han recibido los datos del formulario y si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud como JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que se hayan recibido todos los datos necesarios y que no estén vacíos
    if (
        isset($data['categoria']) && !empty($data['categoria']) &&
        isset($data['nombre']) && !empty($data['nombre']) &&
        isset($data['tipo']) && !empty($data['tipo']) &&
        isset($data['codigo']) && !empty($data['codigo']) &&
        isset($data['precio']) && !empty($data['precio']) &&
        isset($data['imagen']) && !empty($data['imagen'])
    ) {
        // Obtener los datos del producto
        $categoria = htmlspecialchars($data['categoria']);
        $nombre = htmlspecialchars($data['nombre']);
        $tipo = htmlspecialchars($data['tipo']);
        $codigo = htmlspecialchars($data['codigo']);
        $precio = floatval($data['precio']); // Convertir a flotante para mayor seguridad
        $imagen = htmlspecialchars($data['imagen']);

        // Leer el archivo JSON correspondiente y verificar que existe
        $rutaArchivo = '../assets/json/' . strtolower($categoria) . '.json';
        if (file_exists($rutaArchivo)) {
            $contenidoJSON = file_get_contents($rutaArchivo);

            // Verificar si el contenido del archivo es válido JSON
            if ($contenidoJSON !== false) {
                // Decodificar el JSON
                $productos = json_decode($contenidoJSON, true);
                
                // Verificar si se pudo decodificar el JSON correctamente
                if ($productos !== null) {
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
                    if (file_put_contents($rutaArchivo, json_encode($productos, JSON_PRETTY_PRINT))) {
                        // Responder con un código de estado 200 (OK)
                        http_response_code(200);
                        exit();
                    }
                }
            }
        }
    }

    // Si los datos son incorrectos o si ocurre algún error, responder con un código de estado 400 (Bad Request)
    http_response_code(400);
} else {
    // Si la solicitud no es de tipo POST, responder con un código de estado 405 (Method Not Allowed)
    http_response_code(405);
}
?>
