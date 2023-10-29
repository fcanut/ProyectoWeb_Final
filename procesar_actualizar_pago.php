<?php
require 'conexionn.php';
require 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $estado = $_POST["estado"];
    
    $cobro = new cobro($conexion);

    if ($cobro->actualizarCobro($id, $nombre, $estado)) {

        header("Location: mostrar_cobro.php");
        exit();
    } else {

        echo "Error al actualizar el cobro.";
    }
} else {

    header("Location: mostrar_cobro.php");
    exit();
}
?>
