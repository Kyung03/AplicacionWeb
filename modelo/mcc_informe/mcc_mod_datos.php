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
$fechat_ant = date("Y-m-d", strtotime($params->fechat_p));//date("d/m/Y", strtotime($params->fechat_p));
$ling_db = $params->ling_p;
$acero_db = $params->acero_p;
$peso1_db = $params->peso_p;
$colada_ant = $params->colada_p;

$stmt_act->execute();
$stmt_act->close();

$response->mensaje = "MODIFICADO"; 
$response->resultado = '2';  
header('Content-Type: application/json');
echo json_encode($response);