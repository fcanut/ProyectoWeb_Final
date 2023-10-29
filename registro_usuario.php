<?php 
require 'funciones.php'; 
require 'conexionn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $correo_electronico = $_POST["correo_electronico"]; 
    $contrasena = $_POST["contrasena"];

 
    $funciones = new Usuario($conexion);

    if ($funciones->agregarUsuario($usuario, $correo_electronico, $contrasena)) {
 
        header("Location: login.html");
        exit();
    } else {
 
        echo "Error al agregar el usuario.";
    }
}
else {
    echo "Error al agregar el usuario.";
}
?>
