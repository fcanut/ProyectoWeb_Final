<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('funciones.php');
include('conexionn.php');

$evento = new listarme_eventos($conexion);
$funciones = $evento->listarEventos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reservaciones</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8"/>
        <script type="text/javascript" src="jquery-1.3.2.js"></script>
    <link rel="stylesheet" type="text/css" href="css/listar_reservas.css">
</head>
<body>
<div class="header"></div>
        <div class="scroll"></div>
        <ul id="navigation">
             <li class="home"><a href="menu.html" title="Principal"></a></li>
            <li class="photos"><a href="http://localhost:8081/adventure-master/listar_cliente.php" title="Mis Clientes"></a></li>
            <li class="about"><a href="http://localhost:8081/adventure-master/reservacion.php" title="Nueva Reservacion"></a></li>
            <li class="calendario"><a href="calendarioo.php" title="Calendario"></a></li>
            <li class="search"><a href="listar_reservaciones.php" title="Lista de Reservaciones"></a></li>
            <li class="rssfeed"><a href="mostrar_evento.php" title="Mis Eventos"></a></li>
			<li class="podcasts"><a href="mostrar_cobro.php" title="Mis Metodos de Cobro"></a></li>
            <li class="reportes"><a href="reporte_reservaciones.php" title="Reporte"></a></li>

        </ul>
<div class="container">
    <h1>Lista de Reservaciones</h1>

    
    <table class="user-table">
        <tr>
            <th>Cliente</th>
            <th>Sillas</th>
            <th>Mesas</th>
            <th>Evento</th>
            <th>Tipo de cobro</th>
            <th>Cantidad de Cobro</th>
            <th>Telefono</th>
            <th>Correo Electrónico</th>
        </tr>

        <?php foreach ($funciones as $evento) { ?>
            <tr>
                <td><?php echo $evento['cui_nombre_apellido']; ?></td>
                <td><?php echo $evento['sillas']; ?></td>
                <td><?php echo $evento['mesas']; ?></td>
                <td><?php echo $evento['nombre_evento']; ?></td>
                <td><?php echo $evento['nombre_cobro']; ?></td>
                <td><?php echo $evento['total_pagar']; ?></td>
                <td><?php echo $evento['telefono']; ?></td>
                <td><?php echo $evento['correo_electronico']; ?></td>

              
            </tr>
        <?php } ?>
    </table>
    
    <script type="text/javascript">
            $(function() {
                $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

                $('#navigation > li').hover(
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
                    },
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
                    }
                );
            });
        </script>
</body>
</html>
