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
if(isset($params->fecha1) && isset($params->fecha2) ){
    $stmt = $con->prepare("SELECT 
    numero_col, 
    dia_col, 
    fecha_col, 
    hora_col,
    tmp_sellado, 
    tmp_armado, 
    tmp_recargue_1, 
    tmp_bov_1r_carga, 
    tmp_recargue_2, 
    tmp_bov_2a_carga, 
    tmp_recargue_3, 
    tmp_bov_3r_carga, 
    tmp_recargue_4, 
    tmp_bov_4a_carga, 
    especifica_c1, 
    especifica_c2, 
    especifica_c3, 
    especifica_c4
    FROM `eaf_col` 
    WHERE concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?),'%Y-%m-%d 18:00:00' ))
    ORDER BY numero_col");
    
    $stmt->bind_param('ss', $fecha_inicio, $fecha_final);
    $fecha_inicio = $params->fecha1;
    $fecha_final = $params->fecha2;
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,
        $db_fecha,          //2
        $db_hora,           //3
        $db_tmp_sellado,       //4
        $db_tmp_armado,          //5
        $db_tmp_recargue_1,    //6
        $db_tmp_bov_1r_carga,      //8
        $db_tmp_recargue_2,        //9
        $db_tmp_bov_2a_carga,        //10
        $db_tmp_recargue_3,        //11
        $db_tmp_bov_3r_carga,            //12
        $db_tmp_recargue_4,        //13
        $db_tmp_bov_4a_carga,      //14
        $db_especifica_c1,         //15
        $db_especifica_c2,        //16
        $db_especifica_c3,          //17
        $db_especifica_c4,         //18
    );
    while($stmt->fetch()){

        $response->coladas[]           = $db_colada;                    //1
        $response->dia_col[]           = $db_dia;                       //2
        $response->fecha[]             = date("d/m/Y", strtotime($db_fecha)); //3
        $response->hora[]              = $db_hora;                      //4
        $response->tmp_sellado[]       = Round($db_tmp_sellado,2);      //5
        $response->tmp_armado[]        = Round($db_tmp_armado,2);       //6
        $response->tmp_recargue_1[]    = Round($db_tmp_recargue_1,2);   //7
        $response->tmp_bov_1r_carga[]  = Round($db_tmp_bov_1r_carga,2); //8
        $response->tmp_recargue_2[]    = Round($db_tmp_recargue_2,2);   //9
        $response->tmp_bov_2a_carga[]  = Round($db_tmp_bov_2a_carga,2); //10
        $response->tmp_recargue_3[]    = Round($db_tmp_recargue_3,2);   //11
        $response->tmp_bov_3r_carga[]  = Round($db_tmp_bov_3r_carga,2); //12
        $response->tmp_recargue_4[]    = Round($db_tmp_recargue_4,2);   //13
        $response->tmp_bov_4a_carga[]  = Round($db_tmp_bov_4a_carga,2); //14
        $response->especifica_c1[]     = $db_especifica_c1;             //15
        $response->especifica_c2[]     = $db_especifica_c2;             //16
        $response->especifica_c3[]     = $db_especifica_c3;             //17
        $response->especifica_c4[]     = $db_especifica_c4;             //18
    }
}else{
    //
}
header('Content-Type: application/json');
echo json_encode($response);