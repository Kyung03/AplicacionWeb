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
if(isset($params->clave_p)){
    //
    $stmt = $con->prepare(" SELECT cod_usuario, nombre_usuario, contraseña_usuario
    FROM usuario 
    WHERE nombre_usuario = (?) ;" );
    $stmt->bind_param('s', $usuario_db);
    $clave_db = $params->clave_p;
    $usuario_db = $params->usuario_p;
    $stmt->execute();
    $stmt->bind_result($USU_COD, $USUARIO, $USUCON);
    $stmt->fetch();
    if( hash('sha256', $clave_db) == $USUCON){
        if(isset($USUARIO)){
            $msj = "VALIDA"; 
            $response->resultado = '1'; 
        }else{
            $msj = "INVALIDA";
            $response->resultado = '0';
        }
        $response->mensaje = $msj;
    }
}else{
    $msj = "ERROR VERIFICACION";
    $response->resultado = '0';
    $response->mensaje = $msj;
}
header('Content-Type: application/json');
echo json_encode($response);

