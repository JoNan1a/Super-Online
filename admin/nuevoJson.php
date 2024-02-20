<?php
if(isset($_POST['nombreArchivo']) && isset($_POST['nombreCategoria'])){
    $nombreArchivo = $_POST['nombreArchivo'] . '.json';
    $nombreCategoria = $_POST['nombreCategoria'];

    $datos = array(
        $nombreCategoria => array()
    );

    $jsonString = json_encode($datos);

    $ruta = '../assets/json/' . $nombreArchivo; // Ruta donde se guardará el archivo

    if(file_put_contents($ruta, $jsonString)){
        echo "Archivo JSON creado con éxito.";
    } else {
        echo "Error al crear el archivo JSON.";
    }
} else {
    echo "No se recibieron datos del formulario.";
}
?>