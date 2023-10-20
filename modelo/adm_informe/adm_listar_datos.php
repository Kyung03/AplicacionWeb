<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();
$columnas = "    numero_col, 
dia_col, 
fecha_col, 
hora_col, 
recargues, 
ox_lanceado, 
peso_tl, 
m3_lan,
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
ton_fusion,
ton_afino,
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
especifica_c4";
//  COLADA, DIA Y FECHA
if( $params->numColada_bool_p == true && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == true ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00'))
    AND numero_col = (?)
    AND dia_col = (?) ;" );
    
    $stmt->bind_param('ssss', $fecha, $fecha, $numero, $dia);
    $dia = $params->coladaDia_p; 
    $numero = $params->numColada_p; 
    $fecha = $params->fecha_p; 
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  COLADA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == false ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE numero_col = (?)  ; ");
    
    $stmt->bind_param('s', $numero ); 
    $numero = $params->numColada_p;  
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  DIA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == false ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE  dia_col = (?) ; ");
    
    $stmt->bind_param('s', $dia);
    $dia = $params->coladaDia_p; 
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  FECHA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == true ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ;"); 
    
    $stmt->bind_param('ss', $fecha, $fecha); 
    $fecha = $params->fecha_p; 
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  COLADA, DIA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == false ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE numero_col = (?)
    AND dia_col = (?)  ; ");
    
    $stmt->bind_param('ss', $numero, $dia);
    $dia = $params->coladaDia_p; 
    $numero = $params->numColada_p;  
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  COLADA, FECHA
if($params->numColada_bool_p == true && $params->diaColada_bool_p  == false &&
$params->fecha_bool_p == true ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE numero_col = (?) 
    AND concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ; ");
    
    $stmt->bind_param('sss', $numero, $fecha, $fecha);
    $numero = $params->numColada_p; 
    $fecha = $params->fecha_p; 
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
//  DIA, FECHA
if($params->numColada_bool_p == false && $params->diaColada_bool_p  == true &&
$params->fecha_bool_p == true ){
    $stmt = $con->prepare("SELECT ".$columnas." FROM `eaf_col` 
    WHERE dia_col = (?) 
    AND concat(`fecha_col`,' ',`hora_col`) 
    BETWEEN (SELECT DATE_FORMAT(DATE_SUB((?), INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
    AND (SELECT DATE_FORMAT((?), '%Y-%m-%d 18:00:00')) ; ");
    
    $stmt->bind_param('sss', $dia, $fecha, $fecha);
    $dia = $params->coladaDia_p; 
    $fecha = $params->fecha_p; 
    $stmt->execute();
    $stmt->bind_result(
        $db_colada,         //1
        $db_dia,            //2
        $db_fecha,          //3
        $db_hora,           //4
        $db_recargue,       //5
        $db_oxlan,          //6
        $db_tonChatarra,    //7
        $db_m3,
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
        $db_tonFusion,
        $db_tonaAfino,
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
    );
    while($stmt->fetch()){
        $array = [];
        $array[]  = $db_colada;                      //0
        $array[] = $db_dia;                          //1
        $array[] = $db_fecha;                        //2
        $array[] = $db_hora;                         //3
        $array[] = $db_recargue;                     //4
        $array[]  = $db_oxlan;                       //5
        $array[] = $db_tonChatarra;                  //6
        $array[] = $db_m3;
        $array[] = $db_antracita;                    //8
        $array[] = $db_grafito;                      //9
        $array[] = $db_tcarbon;                      //10
        $array[] = $db_gasoleo;                      //11
        $array[] = $db_glp;                          //12
        $array[] = $db_oxigeno;                      //13
        $array[] = $db_espumante;                    //14
        $array[] = $db_fusion;                       //15
        $array[] = $db_tfusion;                      //16
        $array[] = $db_afino;                        //17
        $array[] = $db_tafino;                       //18
        $array[] = $db_ttotal;                       //19
        $array[] = $db_tonFusion;
        $array[] = $db_tonaAfino;
        $array[] = $db_on;                           //22
        $array[] = $db_off;                          //23
        $array[] = $db_carbon;                       //24
        $array[] = $db_temp_final;                   //25
        $array[] = $db_tmp_total;                    //26
        $array[] = $db_endbrick;                     //27

        $array[] = $db_grado;                        //1
        $array[] = $db_fundidor;                     //2
        $array[] = $db_jefe;                         //3
        $array[] = $db_hr_inicio;                    //4
        $array[] = $db_temp_vaciado;                 //5
        $array[] = $db_jornada;                      //6
        $array[] = $db_pgr_smart;                    //7
        $array[] = $db_pgr_digit;                    //8
        $array[] = $db_peso_cesta1;                  //9
        $array[] = $db_peso_cesta2;                  //10
        $array[] = $db_peso_cesta3;                  //11
        $array[] = $db_peso_cesta4;                  //12
        $array[] = $db_peso_cesta5;                  //13
        $array[] = $db_col_horno;                    //15
        $array[] = $db_col_delta;                    //16
        $array[] = $db_col_elect1;                   //17
        $array[] = $db_col_elect2;                   //18
        $array[] = $db_col_elect3;                   //19
        $array[] = $db_caldolomitica;                //20
        $array[] = $db_calcalcitica;                 //21
        $array[] = $db_kalister;                     //22
        $array[] = $db_torta;                        //23
        $array[] = $db_temp_centro;                  //24
        $array[] = $db_temp_evt;                     //25
        $array[] = $db_temp_puerta;                  //22
        $array[] = $db_temp12;                       //23
        $array[] = $db_temp23;                       //24
        $array[] = $db_temp31;                       //25

        $array[] = Round($db_tmp_sellado,2);      //5
        $array[] = Round($db_tmp_armado,2);       //6
        $array[] = Round($db_tmp_recargue_1,2);   //7
        $array[] = Round($db_tmp_bov_1r_carga,2); //8
        $array[] = Round($db_tmp_recargue_2,2);   //9
        $array[] = Round($db_tmp_bov_2a_carga,2); //10
        $array[] = Round($db_tmp_recargue_3,2);   //11
        $array[] = Round($db_tmp_bov_3r_carga,2); //12
        $array[] = Round($db_tmp_recargue_4,2);   //13
        $array[] = Round($db_tmp_bov_4a_carga,2); //14
        $array[] = $db_especifica_c1;             //15
        $array[] = $db_especifica_c2;             //16
        $array[] = $db_especifica_c3;             //17
        $array[] = $db_especifica_c4;             //18

        $response->colada[] = $array;
    }
}
header('Content-Type: application/json');
echo json_encode($response);