<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreArchivo = $_POST['nombreArchivo'];
    $nombreCategoria = $_POST['nombreCategoria'];

    // Validar que los datos no estén vacíos
    if (!empty($nombreArchivo) && !empty($nombreCategoria)) {
        // Estructura inicial del JSON
        $estructuraJson = json_encode([$nombreCategoria => []], JSON_PRETTY_PRINT);

        // Ruta del archivo JSON
        $rutaArchivo = '../assets/json/' . $nombreArchivo . '.json';

        // Guardar el JSON inicial en el archivo
        file_put_contents($rutaArchivo, $estructuraJson);

        // Redirigir a la página de administración con un mensaje de éxito
        header("Location: paginaAdmin.php?mensaje=JSON creado exitosamente");
        exit;
    } else {
        // Si los datos están vacíos, redirigir con un mensaje de error
        header("Location: paginaAdmin.php?error=Debe completar todos los campos");
        exit;
    }
} else {
    // Si no es una solicitud POST, redirigir con un mensaje de error
    header("Location: paginaAdmin.php?error=Acceso no permitido");
    exit;
}
?>

