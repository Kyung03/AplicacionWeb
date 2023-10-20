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

$query_datos = " SELECT cod_usuario, nombre_usuario, contraseña_usuario
FROM usuario
WHERE nombre_usuario = (?); ";

$stmt_datos = $con->prepare($query_datos);
$stmt_datos->bind_param('s', $usuario_ant); 
$usuario_ant = $params->usuario_ant;
$stmt_datos->execute();

$stmt_datos->bind_result($codigo, $usuario, $clave);

if( $stmt_datos->fetch() !== null ){
    $CODIGO = $codigo;
    $USUARIO = $usuario;
    $CLAVE = $clave;
}
$stmt_datos->close();

/*
$datos = "contraseña_usuario = (?) ";

$query = " UPDATE usuario
SET ".$datos." WHERE cod_usuario = ".$CODIGO ;
if($params->usuario_bool_p){
    $datos .= ", nombre_usuario = (?)";
}
*/
if(!$params->usuario_bool_p){
    $query = " UPDATE usuario
    SET contraseña_usuario = (?), nombre_usuario = (?) WHERE cod_usuario = ".$CODIGO ;
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $clave_db, $usuario_db);
    $clave_db = hash('sha256', $params->clave_nueva_p);
    $usuario_db = $params->usuario_p;
    $stmt->execute();
    $stmt->close();

    $query_ver = " SELECT nombre_usuario, contraseña_usuario 
    FROM usuario
    WHERE cod_usuario = (?); ";
    
    $stmt_ver = $con->prepare($query_ver);
    $stmt_ver->bind_param('s', $CODIGO); 
    $stmt_ver->execute();
    
    $stmt_ver->bind_result($USUARIO_ver, $CLAVE_ver);
    if( $stmt_ver->fetch() !== null ){
        if( $CLAVE_ver == hash('sha256', $params->clave_nueva_p) ){
            $response->mensaje = "VALIDO"; 
            $response->resultado = '1'; 
            $response->usuario = $USUARIO_ver;
        }else{
            $response->mensaje = "ERROR"; 
            $response->resultado = '3'; 
        } 
    }else{
        $response->mensaje = "INVALIDO";
        $response->resultado = '0';
    }
}else{
    $query = " UPDATE usuario
    SET contraseña_usuario = (?) WHERE cod_usuario = ".$CODIGO ;
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $clave_db);
    $clave_db = hash('sha256', $params->clave_nueva_p);
    $stmt->execute();

    $query_ver = " SELECT contraseña_usuario 
    FROM usuario
    WHERE cod_usuario = (?); ";
    
    $stmt_ver = $con->prepare($query_ver);
    $stmt_ver->bind_param('s', $CODIGO); 
    $stmt_ver->execute();
    
    $stmt_ver->bind_result($CLAVE_ver);
    if( $stmt_ver->fetch() !== null ){
        if( $CLAVE_ver == hash('sha256', $params->clave_nueva_p) ){
            $response->mensaje = "VALIDO"; 
            $response->resultado = '2'; 
        }else{
            $response->mensaje = "ERROR"; 
            $response->resultado = '3'; 
        }
    }else{
        $response->mensaje = "INVALIDO";
        $response->resultado = '0';
    }
}
header('Content-Type: application/json');
echo json_encode($response);