<?php

class Conexion{

    public $servidor = 'localhost';
    public $usuario = 'root';
    public $contrasena = '';
    public $database = 'superonline';
    public $port = 3306;

    public function conectar(){
        return mysqli_connect(
            $this -> servidor,
            $this->usuario,
            $this->contrasena,
            $this->database,
            $this->port

        );
    }
}
?>