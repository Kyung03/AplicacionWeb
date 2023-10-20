<?php

$usuario="root";
$contraseña="Dpt.mcc2$4ceriA";
$servidor="localhost:3305";
$base_datos="aceria_db";
$con=mysqli_connect($servidor,$usuario,$contraseña,$base_datos) or die ("Error al conectar con la base de datos".mysqli_error());

//$usuario = "";
//$tipo = "";

class Result{}
$response = new Result();

$res = "";
$msj = "";
$tpo = "";
$mod = "";
$dato = "a";
$dato2 = "6";
try{
    actua($dato, $dato2, $con);
}catch(Exception $e){
    echo "error ".$e->getMessage();
}

function actua($dato, $dato2, $con){
    $stmt = $con->prepare(" UPDATE `aceria_db`.`eaf_col`
    SET `dia_col` = (?)
    WHERE `numero_col` = (?);");
    
    $stmt->bind_param('ss', $dato, $dato2);
    $stmt->execute();
    $stmt->close();
}

?>