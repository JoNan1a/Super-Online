<?php 
session_start();
include "../../clases/auth.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$Auth = new Auth();

if($Auth->iniciarSesion($usuario,$contrasena)){
    // Redirige al usuario a la página de inicio normal si no es admin
    if ($usuario !== 'admin') {
        header("location:../../inicio.php");
        exit; // Salimos del script para evitar que se ejecute el código siguiente
    }
    // Si es admin, redirige a la página de administración
    header("location:../../paginaAdmin.php");
    exit; // Salimos del script para evitar que se ejecute el código siguiente
} else {
    echo "Nombre de usuario o contraseña incorrectos";
}
?>