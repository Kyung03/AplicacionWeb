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
AND '$fecha_cierre 18:00:00' ORDER BY NumeroColada ";
//echo $query;
$result=mysqli_query($con,$query); 
$colada_dia=1;

$array_coladas[]        = 'NumeroColada' ;
$array_colada_dia[]     = 'Colada del dia' ;
$array_sellado[]        = 'TiempoDeSellado' ;
$array_armado[]         = 'TiempoDeArmado' ;
$array_apertura1[]      = 'Tiempo1Recargue' ;
$array_boveda1[]        = 'TiempoBovedaAbierta1rCarga' ;
$array_apertura2[]      = 'Tiempo2Recargue' ;
$array_boveda2[]        = 'TiempoBovedaAbierta2aCarga' ;
$array_apertura3[]      = 'Tiempo3Recargue' ;
$array_boveda3[]        = 'TiempoBovedaAbierta3aCarga' ;
$array_apertura4[]      = 'Tiempo4Recargue' ;
$array_boveda4[]        = 'TiempoBovedaAbierta4aCarga' ;
$array_vaciado[]        = 'TiempoVaciado1' ;
$array_especificaC1[]   = 'KwhEspecificaC1' ;
$array_especificaC2[]   = 'KwhEspecificaC2' ;
$array_especificaC3[]   = 'KwhEspecificaC3' ;
$array_especificaC4[]   = 'KwhEspecificaC4' ;
$todo;

while($mostrar=mysqli_fetch_array($result)){
    if(isset($mostrar['NumeroColada']) ){
        $array_coladas[]     = $mostrar['NumeroColada'];
        $array_colada_dia[]  = $colada_dia;
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
        $colada_dia++;
    }else{
         
    }
    
}
$todo[] = $array_coladas;           //  1
$todo[] = $array_colada_dia;        //  2
$todo[] = $array_sellado;           //  3
$todo[] = $array_armado;            //  4
$todo[] = $array_apertura1;         //  5
$todo[] = $array_boveda1;           //  6
$todo[] = $array_apertura2;         //  7
$todo[] = $array_boveda2;           //  8
$todo[] = $array_apertura3;         //  9
$todo[] = $array_boveda3;           //  10
$todo[] = $array_apertura4;         //  11
$todo[] = $array_boveda4;           //  12
$todo[] = $array_vaciado;           //  13
$todo[] = $array_especificaC1;      //  14
$todo[] = $array_especificaC2;      //  15
$todo[] = $array_especificaC3;      //  16
$todo[] = $array_especificaC4;      //  17
header("Content-Type: appliation/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; "."filename=tiempos_horno_".$fecha_inicio.".xls");
?>
<table border=1>
        <?php 
        
        if(empty($todo)){
            //echo "no hay coladas";
        }else{
            foreach($todo as $arrays){
                echo '<tr>';
                foreach($arrays as $dato){
                    echo '<td>'.$dato.'</td>';
                }
                echo '</tr>';
            }
        }
        ?>
</table>