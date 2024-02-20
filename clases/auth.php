<?php
//Conexión a la base de datos
include "Conexion.php";

// Definición de la clase Auth, que se encarga de la autenticación de usuarios
class Auth extends Conexion{
    
    // Método para registrar un nuevo usuario en la base de datos
    public function registrar($usuario, $contrasena){
        // Conecta a la base de datos
        $conexion = parent::conectar();
        // Prepara la consulta SQL para insertar el usuario y contraseña en la tabla de usuarios
        $sql = "INSERT INTO usuarios (usuario,contraseña) 
                VALUES (?,?)";
        // Prepara la consulta SQL
        $query = $conexion->prepare($sql);
        // Vincula los parámetros de usuario y contraseña a la consulta
        $query-> bind_param('ss',$usuario,$contrasena);
        // Ejecuta la consulta y devuelve true si se ejecuta correctamente, false si hay algún error
        return $query->execute();
    }

   // Método para iniciar sesión de un usuario
public function iniciarSesion($usuario, $contrasena){
    // Conecta a la base de datos
    $conexion = parent::conectar();
    
    // Verifica si el usuario intenta iniciar sesión como administrador
    if ($usuario === 'admin' && $contrasena === 'adminGOD') {
        // Si el usuario y la contraseña coinciden con el admin, establece una variable de sesión para el admin
        $_SESSION['usuario'] = $usuario;
        // Devuelve true indicando que la sesión se inició correctamente para el admin
        return true;
    }

    // Consulta SQL para seleccionar la contraseña del usuario proporcionado
    $sql = "SELECT contraseña FROM usuarios WHERE usuario = ?";
    // Prepara la consulta SQL
    $query = $conexion->prepare($sql);
    // Vincula los parámetros de usuario a la consulta
    $query->bind_param('s', $usuario);
    // Ejecuta la consulta
    $query->execute();
    // Obtiene el resultado de la consulta
    $resultado = $query->get_result();

    // Verifica si se encontró un usuario con ese nombre
    if ($resultado->num_rows === 1) {
        // Obtiene la contraseña del resultado de la consulta
        $contrasenaExistente = $resultado->fetch_assoc()['contraseña'];

        // Verifica si la contraseña proporcionada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $contrasenaExistente)) {
            // Si la verificación es exitosa, establece una variable de sesión para el usuario
            $_SESSION['usuario'] = $usuario;
            // Devuelve true indicando que la sesión se inició correctamente para el usuario normal
            return true;
        }
    }

    // Si la autenticación falla, devuelve false
    return false;
}
}
?>