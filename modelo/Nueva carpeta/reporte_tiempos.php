<?php
include('conexion.php');
$con=conectar();
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_cierre = $_POST['fecha_cierre'];
//$query = " SELECT * FROM datos WHERE `Fecha` = '$fecha' "; 
$query = "SELECT NumeroColada, TiempoDeSellado , TiempoDeArmado, Tiempo1Recargue, TiempoBovedaAbierta1rCarga,
Tiempo2Recargue, TiempoBovedaAbierta2aCarga, Tiempo3Recargue , TiempoBovedaAbierta3aCarga,
Tiempo4Recargue, TiempoBovedaAbierta4aCarga, TiempoVaciado1,
KwhEspecificaC1, KwhEspecificaC2, KwhEspecificaC3, KwhEspecificaC4 
FROM `datos` 
WHERE concat(`Fecha`,' ',`Hora`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB('$fecha_inicio', INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND '$fecha_cierre 18:00:00'  ORDER BY NumeroColada";
//echo $query;
$result=mysqli_query($con,$query); 
$array_coladas;
$array_sellado;
$array_armado;
$array_apertura1;
$array_boveda1;
$array_apertura2;
$array_boveda2;
$array_apertura3;
$array_boveda3;
$array_apertura4;
$array_boveda4;
$array_vaciado;
$array_especificaC1;
$array_especificaC2;
$array_especificaC3;
$array_especificaC4;
$todo;

while($mostrar=mysqli_fetch_array($result)){
    if(isset($mostrar['NumeroColada']) ){
        $array_coladas[]     = $mostrar['NumeroColada'];
        $array_sellado[]     = Round($mostrar['TiempoDeSellado'],2);
        $array_armado[]      = Round($mostrar['TiempoDeArmado'],2);
        $array_apertura1[]   = Round($mostrar['Tiempo1Recargue'],2); 
        $array_boveda1[]     = Round($mostrar['TiempoBovedaAbierta1rCarga'],2); 
        $array_apertura2[]   = Round($mostrar['Tiempo2Recargue'],2); 
        $array_boveda2[]     = Round($mostrar['TiempoBovedaAbierta2aCarga'],2); 
        $array_apertura3[]   = Round($mostrar['Tiempo3Recargue'],2);
        $array_boveda3[]     = Round($mostrar['TiempoBovedaAbierta3aCarga'],2); 
        $array_apertura4[]   = Round($mostrar['Tiempo4Recargue'],2); 
        $array_boveda4[]     = Round($mostrar['TiempoBovedaAbierta4aCarga'],2); 
        $array_vaciado[]     = Round($mostrar['TiempoVaciado1'],2); 
        $array_especificaC1[]     = $mostrar['KwhEspecificaC1'];
        $array_especificaC2[]     = $mostrar['KwhEspecificaC2'];
        $array_especificaC3[]     = $mostrar['KwhEspecificaC3'];
        $array_especificaC4[]     = $mostrar['KwhEspecificaC4'];
    }else{
         
    }
    
}
$todo[] = $array_coladas;           //  0
$todo[] = $array_sellado;           //  1
$todo[] = $array_armado;            //  2
$todo[] = $array_apertura1;         //  3
$todo[] = $array_boveda1;           //  4
$todo[] = $array_apertura2;         //  5
$todo[] = $array_boveda2;           //  6
$todo[] = $array_apertura3;         //  7
$todo[] = $array_boveda3;           //  8
$todo[] = $array_apertura4;         //  9
$todo[] = $array_boveda4;           //  10
$todo[] = $array_vaciado;           //  11
$todo[] = $array_especificaC1;      //  12
$todo[] = $array_especificaC2;      //  13
$todo[] = $array_especificaC3;      //  14
$todo[] = $array_especificaC4;      //  15


echo json_encode($todo);
?>