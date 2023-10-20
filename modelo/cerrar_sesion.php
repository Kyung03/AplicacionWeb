<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$json = file_get_contents('php://input');
$params = json_decode($json);
require("conexion.php");
require("tok.php");

if(!isset($params)){
    echo 'vacio';
}else{
    session_id(llamar_sesion($params->usuario, conectar()));
    session_start();
    
    class Result{}
    $response = new Result();
    if(!isset($_SESSION['user'])){
        //$_SESSION['user'] = 'aaa';
    }
    else{
        limpiar_sesion($_SESSION['cod'],conectar());
        unset($_SESSION['cod']);
        unset($_SESSION['user']);
        unset($_SESSION['tipo']);
        unset($_SESSION['token']);
        session_destroy();
        $response->msj = '0';//$_SESSION['user'];//$params->usuario; //
        //$response->token = $_SESSION['token'];
        echo json_encode($response);
        
       // header("location: ../index.php");
    }
}