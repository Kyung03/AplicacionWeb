<?php
include('conexion.php');
$con=conectar();

$query = "INSERT INTO usuario (nombre_usuario, contraseña_usuario, tipo_usuario, fecha_creacion, estado_usuario)
VALUES ('$nombre', '$contraseña', '$tipo', sysdate(), 'activo' )";
echo $query;
$result=mysqli_query($con,$query);

header("Location:../controladores/controlador.php?task=mod_usuario")  ;

?>