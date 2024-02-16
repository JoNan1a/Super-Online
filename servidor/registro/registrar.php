<?php 
    include "../../clases/auth.php";

    $usuario = $_POST['usuario'];
    $contrasena = password_hash( $_POST['contrasena'],PASSWORD_DEFAULT);

    $Auth = new Auth();

    if($Auth -> registrar($usuario,$contrasena)){
        header("location:../../index.php");
        
    }else{
        echo "Eror en el registro";
    }
?>