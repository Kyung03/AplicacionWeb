<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();
if(isset($params->fecha1) && isset($params->fecha2) ){
    $stmt = $con->prepare("SELECT 
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
    endbrick, 
    cod_grado, 
    cod_fundidor, 
    cod_jefe, 
    hr_inicio, 
    temp_vaciado, 
    cod_jornada, 
    pgr_smart, 
    pgr_digit, 
    peso_cesta1, 
    peso_cesta2, 
    peso_cesta3, 
    peso_cesta4, 
    peso_cesta5, 
    col_horno, 
    col_delta, 
    col_elect1, 
    col_elect2, 
    col_elect3, 
    caldolomitica, 
    calcalcitica, 
    kalister, 
    torta, 
    temp_centro, 
    temp_evt, 
    temp_puerta, 
    temp12, 
    temp23, 
    temp31, 
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
    especifica_c4,
    m3_lan,
    ton_fusion,
    ton_afino
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
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        // m3
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
        // ton fusion
        // ton afino
        $db_on,             //20
        $db_off,            //21
        $db_carbon,         //22
        $db_temp_final,    //23
        $db_tmp_total,       //24
        $db_endbrick,        //25

        $db_grado,         //1
        $db_fundidor,            //2
        $db_jefe,          //3
        $db_hr_inicio,           //4
        $db_temp_vaciado,       //5
        $db_jornada,          //6
        $db_pgr_smart,    //7
        $db_pgr_digit,      //8
        $db_peso_cesta1,        //9
        $db_peso_cesta2,        //10
        $db_peso_cesta3,        //11
        $db_peso_cesta4,            //12
        $db_peso_cesta5,        //13
        $db_col_horno,         //15
        $db_col_delta,        //16
        $db_col_elect1,          //17
        $db_col_elect2,         //18
        $db_col_elect3,         //19
        $db_caldolomitica,             //20
        $db_calcalcitica,            //21
        $db_kalister,         //22
        $db_torta,    //23
        $db_temp_centro,       //24
        $db_temp_evt,        //25
        $db_temp_puerta,         //22
        $db_temp12,    //23
        $db_temp23,       //24
        $db_temp31,        //25

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
        $db_m3,             //26
        $db_tonf,           //27
        $db_tona,           //28
    );
    while($stmt->fetch()){
        $response->coladas[]        = $db_colada;                       //
        $response->dia[]            = $db_dia;                          //
        $response->fecha[]          = date("d/m/Y", strtotime($db_fecha));                        //2
        $response->hora[]           = $db_hora;                         //3
        $response->recargue[]       = $db_recargue;                     //4
        $response->oxlan[]          = $db_oxlan;                        //5
        $response->tonChatarra[]    = $db_tonChatarra;                  //6
        if($db_m3 == null)  $response->m3[] = 0;
        else  $response->m3[] = Round($db_m3,2);
        $response->antracita[]      = $db_antracita;                    //8
        $response->grafito[]        = $db_grafito;                      //9
        $response->tcarbon[]        = $db_tcarbon;                      //10
        $response->gasoleo[]        = $db_gasoleo;                      //11
        $response->glp[]            = $db_glp;                          //12
        $response->oxigeno[]        = $db_oxigeno;                      //13
        $response->espumante[]      = $db_espumante;                    //14
        $response->fusion[]         = $db_fusion;                       //15
        $response->tfusion[]        = $db_tfusion;                      //16
        $response->afino[]          = $db_afino;                        //17
        $response->tafino[]         = $db_tafino;                       //18
        $response->ttotal[]         = $db_ttotal;                       //19
        if($db_tonf == null)  $response->tonfusion[] = 0;
        else  $response->tonfusion[] = Round($db_tonf,2);
        if($db_tona == null)  $response->tonafino[] = 0;
        else  $response->tonafino[] = Round($db_tona,2);
        $response->on[]             = $db_on;                           //22
        $response->off[]            = $db_off;                          //23
        $response->carbon[]         = $db_carbon;                       //24
        $response->tempVaciado[]    = $db_temp_final;                  //25
        $response->tminutos[]       = $db_tmp_total;                     //26
        $response->endbrick[]       = $db_endbrick;                     //27

        $response->cod_grado[]      = $db_grado;                        //1
        $response->cod_fundidor[]   = $db_fundidor;                     //2
        $response->cod_jefe[]       = $db_jefe;                         //3
        $response->hr_inicio[]      = $db_hr_inicio;                    //4
        $response->temp_vaciado[]   = $db_temp_vaciado;                 //5
        $response->cod_jornada[]    = $db_jornada;                      //6
        $response->pgr_smart[]      = $db_pgr_smart;                    //7
        $response->pgr_digit[]      = $db_pgr_digit;                    //8
        $response->peso_cesta1[]    = $db_peso_cesta1;                  //9
        $response->peso_cesta2[]    = $db_peso_cesta2;                  //10
        $response->peso_cesta3[]    = $db_peso_cesta3;                  //11
        $response->peso_cesta4[]    = $db_peso_cesta4;                  //12
        $response->peso_cesta5[]    = $db_peso_cesta5;                  //13
        $response->col_horno[]      = $db_col_horno;                    //15
        $response->col_delta[]      = $db_col_delta;                    //16
        $response->col_elect1[]     = $db_col_elect1;                   //17
        $response->col_elect2[]     = $db_col_elect2;                   //18
        $response->col_elect3[]     = $db_col_elect3;                   //19
        $response->caldolomitica[]  = $db_caldolomitica;                //20
        $response->calcalcitica[]   = $db_calcalcitica;                 //21
        $response->kalister[]       = $db_kalister;                     //22
        $response->torta[]          = $db_torta;                        //23
        $response->temp_centro[]    = $db_temp_centro;                  //24
        $response->temp_evt[]       = $db_temp_evt;                      //25
        $response->temp_puerta[]    = $db_temp_puerta;                  //22
        $response->temp12[]         = $db_temp12;                       //23
        $response->temp23[]         = $db_temp23;                       //24
        $response->temp31[]         = $db_temp31;                       //25

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