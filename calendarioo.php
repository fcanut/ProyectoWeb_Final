<?php
include('conexionn.php');
$consulta = "SELECT * FROM reservacion";
$resultado = mysqli_query($conexion, $consulta);

$eventos = array();
while ($diaEvento = mysqli_fetch_array($resultado)) {
    $eventos[] = $diaEvento;
}

$mes = isset($_GET['mes']) ? $_GET['mes'] : date("n");
$anio = isset($_GET['anio']) ? $_GET['anio'] : date("Y");

$meses = array(
    1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
    5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
    9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
);

$nombreMes = $meses[$mes];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="css/calendario.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .highlighted {
            background-color: red; /* Reemplaza 'YourColor' con el color deseado */
        }

        table {
            width: 100%;
        }

        table th {
            background-color: #YourHeaderColor; /* Reemplaza 'YourHeaderColor' con el color deseado para los encabezados */
            color: white;
        }
    </style>
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
            <li class="rssfeed"><a href="tipo_evento.html" title="Mis Eventos"></a></li>
            <li class="podcasts"><a href="tipo_pago.html" title="Mis Metodos de Cobro"></a></li>
            <li class="reportes"><a href="reporte_reservaciones.php" title="Reporte"></a></li>

        </ul>
        
    <h2 class="header-text">Calendario de <?php echo $nombreMes; ?> <?php echo $anio; ?></h2>

    <button class="arrow-button custom-button" onclick="window.location.href='?mes=<?php echo ($mes == 1) ? 12 : ($mes - 1); ?>&anio=<?php echo ($mes == 1) ? ($anio - 1) : $anio; ?>'">&lt;</button>

    <button class="arrow-button custom-button" onclick="window.location.href='?mes=<?php echo ($mes == 12) ? 1 : ($mes + 1); ?>&anio=<?php echo ($mes == 12) ? ($anio + 1) : $anio; ?>'">&gt;</button>
  
    <form class="select-form" method="GET">
        <label for="mes">Mes:</label>
        <select id="mes" name="mes">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i' " . ($mes == $i ? 'selected' : '') . ">" . $meses[$i] . "</option>";
            }
            ?>
        </select>
        <label for "anio">Año:</label>
        <select id="anio" name="anio">
            <?php
            $anioActual = date("Y");
            for ($i = $anioActual - 10; $i <= $anioActual + 10; $i++) {
                echo "<option value='$i' " . ($anio == $i ? 'selected' : '') . ">$i</option>";
            }
            ?>
        </select>
        <button type="submit" class="button">Seleccionar</button>
    </form>
    <table>
        <tr>
            <?php
            $diasSemana = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

            foreach ($diasSemana as $dia) {
                echo "<th>$dia</th>";
            }
            ?>
        </tr>
        <tr>
            <?php
            $primerDia = mktime(0, 0, 0, $mes, 1, $anio);
            $numDias = date("t", $primerDia);
            $diaSemana = date("w", $primerDia);

            for ($i = 0; $i < $diaSemana; $i++) {
                echo "<td></td>";
            }

            for ($diaActual = 1; $diaActual <= $numDias; $diaActual++) {
                $colorClass = '';
                $dia = '';

                // Verifica si el día tiene una reservación
                foreach ($eventos as $evento) {
                    $fechaEvento = strtotime($evento['fecha_reservacion']);
                    $diaEvento = date("j", $fechaEvento);
                    $mesEvento = date("n", $fechaEvento);
                    $anioEvento = date("Y", $fechaEvento);

                    if ($diaActual == $diaEvento && $mes === $mesEvento && $anio === $anioEvento) {
                        $colorClass = $evento['color_evento'];
                        break;
                    }
                }

                echo '<td class="date-cell" style="background-color: '. $colorClass . '"><a href="javascript:void(0);" onclick="openModal(\'reservacion.php?fecha=' . sprintf("%04d-%02d-%02d", $anio, $mes, $diaActual) . '\')">' . $diaActual . '</a></td>';

                if (($diaActual + $diaSemana) % 7 == 0) {
                    echo '</tr><tr>';
                }
            }

            $diasRestantes = 7 - (($diaSemana + $diaActual - 1) % 7);
            for ($i = 0; $i < $diasRestantes; $i++) {
                echo "<td></td>";
            }
            ?>
        </tr>
    </table>

    <script>
        $(function () {
            $('#navigation a').stop().animate({ 'marginLeft': '-85px' }, 1000);

            $('#navigation > li').hover(
                function () {
                    $('a', $(this)).stop().animate({ 'marginLeft': '-2px' }, 200);
                },
                function () {
                    $('a', $(this)).stop().animate({ 'marginLeft': '-85px' }, 200);
                }
            );
        });
    </script>

<script>
    function openModal(url, modalId) {
  
    var modalDiv = document.createElement('div');
    modalDiv.className = 'modal';
    modalDiv.id = modalId;  

 
    var closeButton = document.createElement('button');
    closeButton.className = 'close-button';
    closeButton.innerHTML = 'X';
    closeButton.onclick = function() {
        document.body.removeChild(modalDiv);
    };
    modalDiv.appendChild(closeButton);

 
    var iframe = document.createElement('iframe');
    iframe.src = url;
    modalDiv.appendChild(iframe);


    document.body.appendChild(modalDiv);
}
function closeModal() {

    window.opener.closeWindowModal();

    window.close();}
</script>


</body>

</html>