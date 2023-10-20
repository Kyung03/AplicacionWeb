<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();

$consulta = "SELECT e.numero_col, e.dia_col, e.peso_tl, m.cantlingote, m.pesoacero
FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
WHERE concat(`fecha_col`,' ',`hora_col`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ;";

$consulta_2 = "SELECT COUNT(e.numero_col), MAX(e.numero_col), SUM(e.peso_tl)
FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
WHERE concat(`fecha_col`,' ',`hora_col`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ;";

function consulta_2($consulta_reporte, $fecha, $con){
    $stmt = $con->prepare($consulta_reporte);
    $array_aux = [];
    $stmt->bind_param('ss', $fecha_inicio, $fecha_final);
    $fecha_inicio = $fecha;
    $fecha_final = $fecha;
    $stmt->execute();
    $stmt->bind_result(
        $cant_colada,         //1
        $last_colada,         //1
        $sum_peso,         //1
    );
    while($stmt->fetch()){
        $array_aux[]        = $cant_colada;
        $array_aux[]        = $last_colada;
        $array_aux[]        = $sum_peso;
    }
    $stmt->close();
    return $array_aux;
}

function consulta($consulta_reporte, $fecha, $con){
    $stmt = $con->prepare($consulta_reporte);
    $array = [];
    $array_aux = [];
    $array_aux2 = [];
    $array_aux3 = [];
    $array_aux4 = [];
    $array_aux5 = [];
    $stmt->bind_param('ss', $fecha_inicio, $fecha_final);
    $fecha_inicio = $fecha;
    $fecha_final = $fecha;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_tonChatarra,    //7
        $db_lingote,        //29
        $db_pacero,         //30
    );
    while($stmt->fetch()){
        $array_aux[]        = $db_colada;
        $array_aux2[]            = $db_dia;
        $array_aux3[]    = $db_tonChatarra;    //6
        if($db_lingote == null)  $array_aux4[] = 0;
        else  $array_aux4[] = Round($db_lingote,2);
        if($db_pacero == null)  $array_aux5[] = 0;
        else  $array_aux5[] = Round($db_pacero,2);
    }
    $array[] = $array_aux;
    $array[] = $array_aux2;
    $array[] = $array_aux3;
    $array[] = $array_aux4;
    $array[] = $array_aux5;
    $stmt->close();
    return $array;
}
$retorno = [];
$retorno_2 = [];
$fecha_hoy = date('Y-m-d');
$fecha_ayer = date('Y-m-d', strtotime('-1 day'));
foreach($params as $fechas){
    $retorno[] = consulta($consulta, $fechas, $con);
    
}
$retorno_2[] = consulta_2($consulta_2, $fecha_hoy, $con);
$retorno_2[] = consulta_2($consulta_2, $fecha_ayer, $con);

$response->datos = $retorno;
$response->grafica = $retorno_2;


header('Content-Type: application/json');
echo json_encode($response);