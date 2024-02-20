<?php
// Verificar si se han recibido los datos del formulario y si no están vacíos
if(isset($_POST['nombreArchivo']) && !empty($_POST['nombreArchivo']) && isset($_POST['nombreCategoria']) && !empty($_POST['nombreCategoria'])){
    // Limpiar y preparar los datos del formulario
    $nombreArchivo = htmlspecialchars($_POST['nombreArchivo']) . '.json';
    $nombreCategoria = htmlspecialchars($_POST['nombreCategoria']);

    // Crear un array de datos con la estructura deseada
    $datos = array(
        $nombreCategoria => array()
    );

    // Convertir el array de datos a formato JSON
    $jsonString = json_encode($datos);

    // Construir la ruta completa donde se guardará el archivo JSON
    $ruta = '../assets/json/' . $nombreArchivo;

    // Intentar escribir el contenido JSON en el archivo
    if(file_put_contents($ruta, $jsonString)){
        // Si se escribe correctamente, mostrar un mensaje de éxito
        echo "Archivo JSON creado con éxito.";
    } else {
        // Si hay un error al crear el archivo, mostrar un mensaje de error
        echo "Error al crear el archivo JSON.";
    }
} else {
    // Si no se reciben datos válidos del formulario, mostrar un mensaje de error
    echo "No se recibieron datos válidos del formulario.";
}
?>
