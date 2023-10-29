<?php
include('conexionn.php');

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$consulta = "SELECT * FROM registro_usuario WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resp = $conexion->query($consulta);

if($resp->num_rows > 0) {
  
    header('Location: menu.html');
} else {
  
    $error_message = "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
    header('Location: login.html?error=' . urlencode($error_message));
}
?>
