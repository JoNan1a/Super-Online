<?php
// Verificar si se ha recibido el nombre del archivo a eliminar
if(isset($_POST['nombreArchivo'])){
    // Obtener y limpiar el nombre del archivo
    $nombreArchivo = htmlspecialchars($_POST['nombreArchivo']);

    // Construir la ruta completa del archivo
    $ruta = '../assets/json/' . $nombreArchivo;

    // Verificar si el archivo existe antes de intentar eliminarlo
    if(file_exists($ruta)){
        // Intentar eliminar el archivo
        if(unlink($ruta)){ // unlink() elimina el archivo
            // Si se elimina correctamente, mostrar un mensaje de éxito
            echo "Archivo JSON eliminado con éxito.";
        } else {
            // Si hay un error al eliminar el archivo, mostrar un mensaje de error
            echo "Error al eliminar el archivo JSON.";
        }
    } else {
        // Si el archivo no existe, mostrar un mensaje indicando que no se encontró
        echo "El archivo JSON no existe.";
    }
} else {
    // Si no se recibió el nombre del archivo a eliminar, mostrar un mensaje de error
    echo "No se recibió el nombre del archivo a eliminar.";
}
?>
