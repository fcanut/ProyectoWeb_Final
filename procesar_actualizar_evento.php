<?php
require 'conexionn.php';
require 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $costo = $_POST["costo"];
    $estado = $_POST["estado"];
    
    $event = new MisEventos($conexion);

    if ($event->actualizarEvento($id, $nombre, $costo, $estado)) {
 
        header("Location: mostrar_evento.php");
        exit();
    } else {
  
        echo "Error al actualizar el evento.";
    }
} else {

    header("Location: mostrar_evento.php");
    exit();
}
?>