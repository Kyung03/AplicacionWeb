<?php
include('conexion.php');
$con=conectar();

$query = " SELECT  nombre_usuario, tipo_usuario, fecha_creacion, estado_usuario
FROM usuario  ";
//echo $query;
$result=mysqli_query($con,$query);
$result2=mysqli_query($con,$query);
$array_codigo;
$array_nombre;
$array_tipo;
$array_fecha;
$array_estado;
while($mostrar=mysqli_fetch_array($result)){
    //$array_codigo[] = $mostrar['codigo_usuario'];
    $array_nombre[] = $mostrar['nombre_usuario'];
    $array_tipo[] = $mostrar['tipo_usuario'];
    $array_fecha[] = $mostrar['fecha_creacion'];
    $array_estado[] = $mostrar['estado_usuario'];
    
}

?>