<?php
require 'funciones.php';
require 'conexionn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cui = $_POST["codigo_cliente"];
    $mesas = $_POST["mesas_necesarias"];
    $sillas = $_POST["sillas_necesarias"];
    $fecha_reservacion = $_POST["fecha_evento"];
    $direccion_evento = $_POST["direccion_evento"];
    $tipo_evento = $_POST["tipo_evento"];
    $metodo_pago = $_POST["metodo_pago"];
    $color_evento = $_POST["color_evento"];
    error_log($color_evento);

    


    $funciones = new reservacion($conexion);

    if ($funciones->agregarReservacion($cui, $mesas, $sillas, $fecha_reservacion, $direccion_evento, $tipo_evento, $metodo_pago, $color_evento)) {

        header("Location: reservacion.php");
    } else {

        echo "Error al agregar la Reservacion.";
    }
}
else {
    echo "Error al agregar la Reservacion.";
}

?>


