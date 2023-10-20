<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();

$consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.m3_lan, 
e.ton_fusion, e.ton_afino, 
m.horat, m.fechat, m.cantlingote, m.pesoacero, m.peso1
FROM `eaf_col` e left JOIN mcc_col m ON  e.numero_col = m.numero_col
WHERE concat(`fecha_col`,' ',`hora_col`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ;";

if(isset($params->fecha1) && isset($params->fecha2) ){
    $stmt = $con->prepare($consulta_reporte);
    
    $stmt->bind_param('ss', $fecha_inicio, $fecha_final);
    $fecha_inicio = $params->fecha1;
    $fecha_final = $params->fecha2;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4

        $db_m3_lan,       //5
        $db_ton_fusion,          //6
        $db_ton_afino,    //7

        //$db_cod_mcc,      //8
        $db_horat,        //9
        $db_fechat,        //10
        $db_cantlingote,        //11
        $db_pesoacero,            //12
        $db_peso1,        //13
        //$db_numero_col,      //14
    );
    while($stmt->fetch()){
        /**/
        $array = [];
        $array[] = $db_colada;        //1
        $array[] = $db_dia;
        $array[] = $db_fecha;         //2
        $array[] = $db_hora;          //3

        //$array[] = $db_m3_lan;       //4
        //$array[] = $db_ton_fusion;          //5
        //$array[] = $db_ton_afino;    //6
        
        //$array[] = $db_cod_mcc;      //8
        $array[] = $db_horat;        //9
        $array[] = $db_fechat;        //10
        $array[] = $db_cantlingote;        //11
        $array[] = $db_pesoacero;            //12
        $array[] = $db_peso1;        //13
        //$array[] = $db_numero_col;      //14
        
        /*
        $response->coladas[]        = $db_colada;
        $response->dia[]            = $db_dia;
        $response->fecha[]          = date("d/m/Y", strtotime($db_fecha));         //2
        $response->hora[]           = $db_hora;          //3
        $response->recargue[]       = $db_recargue;       //4
        $response->oxlan[]          = $db_oxlan;          //5
        $response->tonChatarra[]    = $db_tonChatarra;    //6
        if($db_m3 == null)  $response->m3[] = 0;
        else  $response->m3[] = Round($db_m3,2);
        //$response->m3[]             = $db_m3;
        $response->antracita[]      = $db_antracita;      //8
        $response->grafito[]        = $db_grafito;        //9
        $response->tcarbon[]        = Round($db_tcarbon,2);        //10
        $response->gasoleo[]        = $db_gasoleo;        //11
        $response->glp[]            = $db_glp;            //12
        $response->oxigeno[]        = $db_oxigeno;        //13
        $response->espumante[]      = $db_espumante;      //14
        $response->fusion[]         = $db_fusion;         //15
        $response->tfusion[]        = $db_tfusion;        //16
        $response->afino[]          = $db_afino;          //17
        $response->tafino[]         = $db_tafino;         //18
        $response->ttotal[]         = $db_ttotal;         //19
        if($db_tonf == null)  $response->tonfusion[] = 0;
        else  $response->tonfusion[] = Round($db_tonf,2);
        //$response->tonfusion[]      = $db_tonf;
        if($db_tona == null)  $response->tonafino[] = 0;
        else  $response->tonafino[] = Round($db_tona,2);
        //$response->tonafino[]       = $db_tona;
        $response->on[]             = $db_on;             //22
        $response->off[]            = $db_off;            //23
        $response->carbon[]         = $db_carbon;         //24
        $response->tempVaciado[]    = $db_tempVaciado;    //25
        $response->tminutos[]       = $db_tminutos;       //26
        $response->endbrick[]       = $db_endbrick;       //27
        if($db_lingote == null)  $response->lingotes[] = 0;
        else  $response->lingotes[] = Round($db_lingote,2);
        //$response->lingotes[]       = $db_lingote;       //26
        if($db_pacero == null)  $response->pesoAcero[] = 0;
        else  $response->pesoAcero[] = Round($db_pacero,2);
        //$response->pesoAcero[]      = $db_pacero;       //27
        
        */
        $response->colada[]         = $array;
        //$response->resul            = 1;
        
    }
}else{
    //
}
header('Content-Type: application/json');
echo json_encode($response);