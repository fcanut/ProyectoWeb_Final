
<!DOCTYPE html>
<html>
<head>

    <title>Informe de Reservaciones por Fecha</title>
    <script type="text/javascript" src="jquery-1.3.2.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css\reporte.css">
    <link rel="stylesheet" href="css\style.css">
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
            <li class="podcasts"><a href="reporte_reservaciones.php" title="Reporte"></a></li>


        </ul>

    <div class="container mt-5">
        <h1 class="mb-4">Informe de Reservaciones por Fecha de EvenGuat</h1>
        <form action="procesar_informe.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" class="form-control" name="fecha_inicio">
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input type="date" class="form-control" name="fecha_fin">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Generar Informe</button>
            
        </form>
    </div>


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

