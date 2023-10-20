 
<?php
function conectar2(){
    $usuario="usuario_emp";
    $contraseña="3mpl34do.2022";
    $servidor="192.168.0.170:3305";
    $base_datos="aceria_db";
    $con=mysqli_connect($servidor,$usuario,$contraseña,$base_datos) or 
    die ("Error al conectar con la base de datos".mysqli_error());
    return $con;
} 

function conectar(){
    $usuario="root";
    $contraseña="Dpt.mcc2$4ceriA";
    $servidor="localhost:3305";
    $base_datos="aceria_db";
    $con=mysqli_connect($servidor,$usuario,$contraseña,$base_datos) or 
    die ("Error al conectar con la base de datos".mysqli_error());
    return $con;
} 
?>
