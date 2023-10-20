<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
require("tok.php");
$con = conectar();

class Result{}
$response = new Result();
/*
$response->usuario = $params->usuario_p; 
$response->nombre = $params->nombre_p; 
$response->apellido = $params->apellido_p; 
$response->clave = $params->clave_nueva_p; 
$response->clave_rep = $params->clave_rep_p; 
$response->us_bool = $params->usuario_bool_p; 
$response->clave_bool = $params->clave_bool_p; 
*/
$query = " UPDATE usuario
SET nombre_usuario = (?)
WHERE `nombre_usuario` = (?); ";

$stmt = $con->prepare($query);
$stmt->bind_param('ss', $usuario_db, $usuario_ant); 
$usuario_db = $params->usuario_p;
$usuario_ant = $params->usuario_ant;
$stmt->execute();

$query_ver = " SELECT nombre_usuario FROM usuario
WHERE nombre_usuario = (?); ";

$stmt_ver = $con->prepare($query_ver);
$stmt_ver->bind_param('s', $usuario_db); 
$usuario_db = $params->usuario_p;
$stmt_ver->execute();

$stmt_ver->bind_result($USUARIO);
//$stmt_ver->fetch();

if( $stmt_ver->fetch() !== null ){
    $response->mensaje = "VALIDO"; 
    $response->resultado = '1'; 
    $response->usuario = $USUARIO;
}else{
    $response->mensaje = "INVALIDO";
    $response->resultado = '0';
}
/*
function mod_clave(){

}
if(isset($params->usuario_p)){
    //
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $clave_db, $usuario_db);
    $clave_db = $params->clave_p;
    $usuario_db = $params->usuario_p;
    $stmt->execute();
    $stmt->bind_result($USU_COD, $USUARIO);
    $stmt->fetch();
    if( $stmt->fetch() !== null ){
        $msj = "VALIDO"; 
        $response->resultado = '1'; 
    }else{
        $msj = "INVALIDO";
        $response->resultado = '0';
    }
    $response->mensaje = $msj;
}else{
    $msj = "ERROR VERIFICACION";
    $response->resultado = '0';
    $response->mensaje = $msj;
}
*/
header('Content-Type: application/json');
echo json_encode($response);