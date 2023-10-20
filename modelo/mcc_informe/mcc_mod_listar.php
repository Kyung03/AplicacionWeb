<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();
//  COLADA, DIA Y FECHA
if( $params->numColada_bool_p == true && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == true ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE m.numero_col = (?)
    AND dia_col = (?)
    AND  concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')); "; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('ssss', $colada, $dia, $fecha, $fecha );
    $colada = $params->numColada_p;
    $dia = $params->coladaDia_p;
    $fecha = $params->fecha_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  COLADA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == false ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE m.numero_col = (?)  "; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('s', $colada );
    $colada = $params->numColada_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  DIA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == false ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE dia_col = (?) ; "; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('s', $dia );
    $dia = $params->coladaDia_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha; 
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat; 
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  FECHA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == true ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ;"; 
    

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('ss', $fecha, $fecha2 );
    $fecha = $params->fecha_p;
    $fecha2 = $params->fecha_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        //$db_m3_lan,
        //$db_ton_fusion,
        //$db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino; 
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  COLADA, DIA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == false ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE m.numero_col = (?)
    AND dia_col = (?) ; "; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('ss', $colada, $dia );
    $colada = $params->numColada_p;
    $dia = $params->coladaDia_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  COLADA, FECHA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == true ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE m.numero_col = (?) 
    AND concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) "; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('sss', $colada, $fecha, $fecha2 );
    $colada = $params->numColada_p; 
    $fecha = $params->fecha_p;
    $fecha2 = $params->fecha_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
//  DIA, FECHA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == true ){
    $consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
    e.ton_fusion, e.ton_afino, 
    m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
    FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
    WHERE concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) 
    AND dia_col = (?) ;"; 

    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('sss', $fecha, $fecha2, $dia );
    $dia = $params->coladaDia_p;
    $fecha = $params->fecha_p;
    $fecha2 = $params->fecha_p;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,
        $db_dia,
        $db_fecha,
        $db_hora,
        $db_m3_lan,
        $db_ton_fusion,
        $db_ton_afino,
        $db_horat,
        $db_fechat,
        $db_cantlingote,
        $db_pesoacero,
        $db_peso1
    );
    while($stmt->fetch()){
        $array = [];
        $array[] = $db_colada;
        $array[] = $db_dia;
        $array[] = $db_fecha;
        $array[] = $db_hora;
        //$array[] = $db_m3_lan;
        //$array[] = $db_ton_fusion;
        //$array[] = $db_ton_afino;
        $array[] = $db_horat;
        $array[] = $db_fechat;
        $array[] = $db_cantlingote;
        $array[] = $db_pesoacero;
        $array[] = $db_peso1;
        $response->colada[] = $array;
    }
} 
header('Content-Type: application/json');
echo json_encode($response);