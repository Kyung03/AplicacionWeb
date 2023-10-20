<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
require("../tok.php");
$con = conectar();

class Result{}
$response = new Result();

if($params->mov_p){
    // INGRESAR DATOS
     $query = " INSERT INTO `aceria_db`.`mcc_col`
     ( 
     `horat`,
     `fechat`,
     `cantlingote`,
     `pesoacero`,
     `peso1`,
     `numero_col`)
     VALUES
     ( 
      (?),
      (?),
      (?),
      (?),
      (?),
      (?) ); ";

$stmt = $con->prepare($query);
$stmt->bind_param('ssssss', $horat_db, $fechat_ant, $ling_db, $acero_db, $peso1_db, $colada_ant); 
$horat_db = $params->horat_p;
$fechat_ant = $params->fechat_p;
$ling_db = $params->ling_p;
$acero_db = $params->acero_p;
$peso1_db = $params->peso_p;
$colada_ant = $params->colada_p;

$stmt->execute();
$stmt->close();

$response->mensaje = "INGRESADO"; 
$response->resultado = '1'; 
    
}else{
    //  ACTUALIZAR DATOS
    $query_act = " UPDATE `aceria_db`.`mcc_col`
    SET
    `horat` = (?),
    `fechat` = (?),
    `cantlingote` = (?),
    `pesoacero` = (?),
    `peso1` = (?)
    WHERE `numero_col` = (?) ; ";

$stmt_act = $con->prepare($query_act);
$stmt_act->bind_param('ssssss', $horat_db, $fechat_ant, $ling_db, $acero_db, $peso1_db, $colada_ant); 
$horat_db = $params->horat_p;
$fechat_ant = $params->fechat_p;
$ling_db = $params->ling_p;
$acero_db = $params->acero_p;
$peso1_db = $params->peso_p;
$colada_ant = $params->colada_p;

$stmt_act->execute();
$stmt_act->close();

$response->mensaje = "MODIFICADO"; 
$response->resultado = '2'; 
}
header('Content-Type: application/json');
echo json_encode($response);