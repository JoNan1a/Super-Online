<?php
if(isset($_POST['nombreArchivo'])){
    $nombreArchivo = $_POST['nombreArchivo'];

    $ruta = '../assets/json/' . $nombreArchivo;

    if(unlink($ruta)){ // unlink() elimina el archivo
        echo "Archivo JSON eliminado con éxito.";
    } else {
        echo "Error al eliminar el archivo JSON.";
    }
} else {
    echo "No se recibió el nombre del archivo a eliminar.";
}
?>
