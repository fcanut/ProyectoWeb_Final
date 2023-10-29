<?php
require 'conexionn.php';
require 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cui"])) {
    $id = $_POST["cui"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo_electronico"];
    $telefono = $_POST["telefono"];
    $sexo = $_POST["sexo"];
    
    $client = new MisCliente($conexion);

    if ($client->actualizarCliente($id, $nombre, $apellido, $correo, $telefono, $sexo)) {

        header("Location: listar_cliente.php");
        exit();
    } else {

        echo "Error al actualizar el cliente.";
    }
} else {
 
    header("Location: listar_cliente.php");
    exit();
}
?>