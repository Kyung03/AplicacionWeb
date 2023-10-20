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
if(isset($params->sesion)){
    //
    $stmt = $con->prepare(" SELECT cod_usuario, nombre_usuario, 
    cod_estado, cod_clasificacion, token, sesion_id 
    FROM usuario 
    WHERE token = (?) ");
    $stmt->bind_param('s', $token_db);
    $token_db = $params->sesion;
    $stmt->execute();
    $stmt->bind_result($USU_COD, $USUARIO, $USU_EST, $USU_TIP, $TOKEN, $SESION);
    $stmt->fetch();
    if(isset($TOKEN)){
        session_id(llamar_sesion($USUARIO, conectar()));
        session_start();
        //$msj = ""; 
        $response->usuario = $_SESSION['user'];
        $response->token = $_SESSION['token'];
        $response->tipo = $_SESSION['tipo'];

        switch($USU_TIP){
            case '1':
                $response->resultado = '1';
                $response->url = "adm";
            break;
            case '2':
                $response->resultado = '1';
                $response->url = "adm";
            break;
            case '3':
                $response->resultado = '1';
                $response->url = "eaf";
            break;
            case '4':
                $response->resultado = '1';
                $response->url = "mcc";
            break;
        }
    }else{
        //$msj = "sesion no iniciada 1";
        $response->resultado = '2';
    }
    //$response->mensaje = $msj;
}else{
    //$msj = "sesion no iniciada 2";
    $response->resultado = '3';
    //$response->mensaje = $msj;
}
header('Content-Type: application/json');
echo json_encode($response);