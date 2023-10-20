<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();
//$fecha1 = '2022/09/25';
//$fecha2 = '2022/09/27';
$query_sin_mcc = "SELECT 
numero_col, 
dia_col, 
fecha_col, 
hora_col, 
recargues, 
ox_lanceado, 
peso_tl, 
antracita, 
grafito, 
tl_carbon, 
gasoleo, 
glp, 
oxigeno, 
espumante, 
fusion, 
tmp_fusion, 
afino, 
tmp_afino, 
kw_total, 
power_on, 
power_off, 
carbon, 
temp_final, 
tmp_total, 
endbrick 
FROM `eaf_col` 
WHERE concat(`fecha_col`,' ',`hora_col`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND (SELECT DATE_FORMAT((?),'%Y-%m-%d 18:00:00' ))
ORDER BY numero_col";

$consulta_reporte = "SELECT e.numero_col, e.dia_col, e.fecha_col, e.hora_col, e.recargues, 
e.ox_lanceado, e.peso_tl, e.antracita, e.grafito, e.tl_carbon, e.gasoleo, 
e.glp, e.oxigeno, e.espumante, e.fusion, e.tmp_fusion, e.afino, 
e.tmp_afino, e.kw_total, e.power_on, e.power_off, e.carbon, e.temp_final, 
e.tmp_total, e.endbrick, e.m3_lan, e.ton_fusion, e.ton_afino, 
m.cantlingote, m.pesoacero
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
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_antracita,      //8
        $db_grafito,        //9
        $db_tcarbon,        //10
        $db_gasoleo,        //11
        $db_glp,            //12
        $db_oxigeno,        //13
        $db_espumante,      //14
        $db_fusion,         //15
        $db_tfusion,        //16
        $db_afino,          //17
        $db_tafino,         //18
        $db_ttotal,         //19
        $db_on,             //20
        $db_off,            //21
        $db_carbon,         //22
        $db_tempVaciado,    //23
        $db_tminutos,       //24
        $db_endbrick,       //25
        $db_m3,             //26
        $db_tonf,           //27
        $db_tona,           //28
        $db_lingote,        //29
        $db_pacero,         //30
    );
    while($stmt->fetch()){
        /*
        $array = [];
        $array[]         = $db_colada;        //1
        $array[]            = $db_dia;
        $array[]          = $db_fecha;         //2
        $array[]           = $db_hora;          //3
        $array[]       = $db_recargue;       //4
        $array[]          = $db_oxlan;          //5
        $array[]    = $db_tonChatarra;    //6
        $array[]             = '';
        $array[]      = $db_antracita;      //8
        $array[]        = $db_grafito;        //9
        $array[]        = $db_tcarbon;        //10
        $array[]        = $db_gasoleo;        //11
        $array[]            = $db_glp;            //12
        $array[]        = $db_oxigeno;        //13
        $array[]      = $db_espumante;      //14
        $array[]         = $db_fusion;         //15
        $array[]        = $db_tfusion;        //16
        $array[]          = $db_afino;          //17
        $array[]         = $db_tafino;         //18
        $array[]         = $db_ttotal;         //19
        $array[]      =  '';
        $array[]       =  '';
        $array[]             = $db_on;             //22
        $array[]            = $db_off;            //23
        $array[]         = $db_carbon;         //24
        $array[]    = $db_tempVaciado;    //25
        $array[]       = $db_tminutos;       //26
        $array[]       = $db_endbrick;        //27
        */

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
        /*
        $response->colada[]         = $array;
        $response->resul            = 1;
        */
    }
}else{
    //
}
header('Content-Type: application/json');
echo json_encode($response);