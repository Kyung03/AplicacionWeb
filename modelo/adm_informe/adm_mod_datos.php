<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();

function act_dato($dato, $colada, $columna, $con, $cod_usuario_in){
    bit_mod($columna, $dato, 'Modificacion de dato', $cod_usuario_in, $colada, $con);
    $query_act = " UPDATE `aceria_db`.`eaf_col`
    SET ".$columna." = (?) WHERE `numero_col` = (?) ; ";

    $stmt_act = $con->prepare($query_act);
    $stmt_act->bind_param('ss', $db_dato, $db_colada);
    $db_dato = $dato;
    $db_colada = $colada;
    $stmt_act->execute();
    $stmt_act->close();
}

function bit_mod($colm_mod_in, $dato_nue_in, $desc_mod_in, $cod_usuario_in, $numero_col_in, $con){
    $query_usu = " SELECT cod_usuario FROM usuario WHERE nombre_usuario = (?) ";
    $stmt_usu = $con->prepare($query_usu);
    $stmt_usu->bind_param('s', $usuario);
    $usuario = $cod_usuario_in;
    $stmt_usu->execute();
    $stmt_usu->bind_result($USU_COD);
    if( $stmt_usu->fetch() !== null ){}
    $stmt_usu->close();
    

    $query_act = " CALL bit_mod_SP( (?), (?), (?), (?), (?) );";
    $stmt_act = $con->prepare($query_act);
    $stmt_act->bind_param('sssii', $colm_mod, $dato_nue, $desc_mod, $cod_usuario, $numero_col);
    $colm_mod = $colm_mod_in;
    $dato_nue = $dato_nue_in;
    $desc_mod = $desc_mod_in;
    $cod_usuario = $USU_COD;
    $numero_col = $numero_col_in;
    $stmt_act->execute();
    $stmt_act->close();
}

$columna = "";
$numColada = 0;
$array_titulos;
$array_datos;
$array_mod =  $params->col_mod;  
$r = 0;

foreach ($array_mod as $dato){
    try{
        switch($dato->titulo){
            case 'dia':
                $columna = "dia_col";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'fecha':
                $columna = "fecha_col";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'hora':
                $columna = "hora_col";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'recargue':
                $columna = "recargues";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'oxlan':
                $columna = "ox_lanceado";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tonChatarra':
                $columna = "peso_tl";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'm3':
                $columna = "m3_lan";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'antracita':
                $columna = "antracita";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'grafito':
                $columna = "grafito";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tcarbon':
                $columna = "tl_carbon";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'gasoleo':
                $columna = "gasoleo";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'glp':
                $columna = "glp";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'oxigeno':
                $columna = "oxigeno";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'espumante':
                $columna = "espumante";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'fusion':
                $columna = "fusion";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tfusion':
                $columna = "tmp_fusion";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'afino':
                $columna = "afino";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tafino':
                $columna = "tmp_afino";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'ttotal':
                $columna = "kw_total";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tonfusion':
                $columna = "ton_fusion";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tonafino':
                $columna = "ton_afino";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'on':
                $columna = "power_on";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'off':
                $columna = "power_off";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'carbon':
                $columna = "carbon";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tempFinal':
                $columna = "temp_final";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tminutos':
                $columna = "tmp_total";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'endbrick':
                $columna = "endbrick";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            
            case 'cod_grado':
                $columna = "";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'cod_fundidor':
                $columna = "";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'cod_jefe':
                $columna = "";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'hr_inicio':
                $columna = "hr_inicio";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp_vaciado':
                $columna = "temp_vaciado";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'cod_jornada':
                $columna = "";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'pgr_smart':
                $columna = "pgr_smart";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'pgr_digit':
                $columna = "pgr_digit";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'peso_cesta1':
                $columna = "peso_cesta1";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'peso_cesta2':
                $columna = "peso_cesta2";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'peso_cesta3':
                $columna = "peso_cesta3";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'peso_cesta4':
                $columna = "peso_cesta4";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'peso_cesta5':
                $columna = "peso_cesta5";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'col_horno':
                $columna = "col_horno";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'col_delta':
                $columna = "col_delta";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'col_elect1':
                $columna = "col_elect1";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'col_elect2':
                $columna = "col_elect2";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'col_elect3':
                $columna = "col_elect3";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'caldolomitica':
                $columna = "caldolomitica";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'calcalcitica':
                $columna = "calcalcitica";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'kalister':
                $columna = "kalister";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'torta':
                $columna = "torta";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp_centro':
                $columna = "temp_centro";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp_evt':
                $columna = "temp_evt";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp_puerta':
                $columna = "temp_puerta";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp12':
                $columna = "temp12";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp23':
                $columna = "temp23";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'temp31':
                $columna = "temp31";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            
            case 'tmp_sellado':
                $columna = "tmp_sellado";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_armado':
                $columna = "tmp_armado";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_recargue_1':
                $columna = "tmp_recargue_1";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_bov_1r_carga':
                $columna = "tmp_bov_1r_carga";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_recargue_2':
                $columna = "tmp_recargue_2";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_bov_2a_carga':
                $columna = "tmp_bov_2a_carga";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_recargue_3':
                $columna = "tmp_recargue_3";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_bov_3r_carga':
                $columna = "tmp_bov_3r_carga";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_recargue_4':
                $columna = "tmp_recargue_4";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'tmp_bov_4a_carga':
                $columna = "tmp_bov_4a_carga";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'especifica_c1':
                $columna = "especifica_c1";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'especifica_c2':
                $columna = "especifica_c2";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'especifica_c3':
                $columna = "especifica_c3";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
            case 'especifica_c4':
                $columna = "especifica_c4";
                act_dato($dato->dato, $params->numColada, $columna, $con, $params->usuario);
            break;
        }
        $r = 1;
    }catch(Exception $e){
        $response->error = "Error: ".$e;
        $r = 0;
    }
}
$response->resul = $r;  
header('Content-Type: application/json');
echo json_encode($response);