<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("../conexion.php");
$con = conectar();
class Result{}
$response = new Result();

function consulta($query, $con){
    $array = [];
    $stmt = $con->prepare($query);
    $stmt->execute();
    $stmt->bind_result( $db_dato );
    while($stmt->fetch()){ 
        $array[] = $db_dato; 
    }
    return $array;
}

$consulta_grado = " SELECT cod_grado FROM aceria_db.grado; ";
$consulta_fundidor = " SELECT cod_fundidor FROM aceria_db.fundidor; ";
$consulta_jefe_turno = " SELECT cod_jefe FROM aceria_db.jefe_turno; ";
$consulta_jornada = " SELECT cod_jornada FROM aceria_db.jornada; ";

$response->grado[] = consulta($consulta_grado, $con);
$response->fundidor[] = consulta($consulta_fundidor, $con);
$response->jefe_turno[] = consulta($consulta_jefe_turno, $con);
$response->jornada[] = consulta($consulta_jornada, $con);

header('Content-Type: application/json');
echo json_encode($response);