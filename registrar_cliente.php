<?php 
require 'funciones.php'; 
require 'conexionn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cui = $_POST["cui"];
    $nombre = $_POST["nombre"]; 
    $apellido = $_POST["apellido"];
    $correo_electronico = $_POST["correo_electronico"];
    $telefono = $_POST["telefono"];
    $sexo = $_POST["sexo"];


    $funciones = new clientes($conexion);

    if ($funciones->agregarCliente($cui, $nombre, $apellido, $correo_electronico, $telefono, $sexo)) {

        header("Location: listar_cliente.php");
        exit();
    } else {

        echo "Error al agregar el usuario.";
    }
}
else {
    echo "Error al agregar el usuario.";
}
?>
