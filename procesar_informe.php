<?php
include('conexionn.php'); 
include('funciones.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];


    $listarFechas = new listar_fechas($conexion);


    $resultados = $listarFechas->listarFechas($fecha_inicio, $fecha_fin);
}
?>

<!DOCTYPE html>
<html>
<head>
    
<title>Informe de Reservaciones por Fecha</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css\reporte.css">
    <style type="text/css">
        @media print {
            @page {
                size: landscape;
            }
           
        }
    </style>
</head>
<body>
<div class="container">

    <h1 class="mb-4">Informe de Reservaciones por Fecha de EvenGuat</h1>
<table class="user-table">
        <tr>
            <th>ID</th>
            <th>CUI</th>
            <th>MESAS</th>
            <th>SILLAS</th>
            <th>FECHA RESERVACION</th>
            <th>DIRECION DEL EVENTO</th>
            <th>TIPO EVENTO</th>
            <th>METODO PAGO</th>
            <th>TOTAL A PAGAR</th>
        </tr>

        <?php foreach ($resultados as $listarFechas) { ?>
            <tr>
                <td><?php echo $listarFechas['id']; ?></td>
                <td><?php echo $listarFechas['cui']; ?></td>
                <td><?php echo $listarFechas['mesas']; ?></td>
                <td><?php echo $listarFechas['sillas']; ?></td>
                <td><?php echo $listarFechas['fecha_reservacion']; ?></td>
                <td><?php echo $listarFechas['direccion_evento']; ?></td>
                <td><?php echo $listarFechas['tipo_evento_nombre']; ?></td>
                <td><?php echo $listarFechas['metodo_pago_nombre']; ?></td>
                <td><?php echo $listarFechas['total_pagar']; ?></td>

            </tr>
        <?php } ?>
    </table>

    <button onclick="imprimirInforme()" class="button">Imprimir Informe</button>

</div>

<script>
function imprimirInforme() {

    window.print();
}
</script>


</body>
</html>
