<?php
include('conexion.php');
$con=conectar();
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_cierre = $_POST['fecha_cierre'];
//$query = " SELECT * FROM datos WHERE `Fecha` = '$fecha' "; 
$query = "SELECT * FROM `datos` 
WHERE concat(`Fecha`,' ',`Hora`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB('$fecha_inicio', INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND '$fecha_cierre 18:00:00' ORDER BY NumeroColada ";
//echo $query;
$result=mysqli_query($con,$query); 
$array_coladas;
$array_recargues;
$array_oxlan;
$array_tonchatarra;
$array_m3;
$array_antracita;
$array_grafito;
$array_tcarbon;
$array_gasoleo;
$array_glp;
$array_oxigeno;
$array_espumante;
$array_kwhfusion;
$array_tfusion;
$array_kwhafino;
$array_tafino;
$array_ttotal;
$array_tonfusion;
$array_tonafino;
$array_poweron;
$array_poweroff;
$array_carbon;
$array_tempvacio;
$array_tminutos;
$array_ppp;
$array_ebts;
$array_hvaciado;
$array_endbrick;
$array_fecha;
$array_hora;
$todo;
while($mostrar=mysqli_fetch_array($result)){
    if(isset($mostrar['NumeroColada']) ){
        $array_coladas[]        = $mostrar['NumeroColada'];
        $array_recargues[]      = $mostrar['Recargues'];
        $array_oxlan[]          = $mostrar['OxigenoLanceado']; 
        $array_tonchatarra[]    = $mostrar['PesoTotal']; 
        $array_m3[]             = '';
        $array_antracita[]      = $mostrar['Antracita']; 
        $array_grafito[]        = $mostrar['Grafito']; 
        $array_tcarbon[]        = Round($mostrar['TotalCarbon'],2); 
        $array_gasoleo[]        = $mostrar['Gasoleo'];
        $array_glp[]            = $mostrar['GLP']; 
        $array_oxigeno[]        = $mostrar['Oxigeno']; 
        $array_espumante[]      = $mostrar['Espumante']; 
        $array_kwhfusion[]      = $mostrar['KWHFusion']; 
        $array_tfusion[]        = $mostrar['TiempoFusion']; 
        $array_kwhafino[]       = $mostrar['KWHAfino']; 
        $array_tafino[]         = $mostrar['TiempoAfino']; 
        $array_ttotal[]         = $mostrar['KWHTotal']; 
        $array_tonfusion[]      =  '';
        $array_tonafino[]       =  '';
        $array_poweron[]        = $mostrar['PowerON']; 
        $array_poweroff[]       = $mostrar['PowerOff']; 
        $array_carbon[]         = $mostrar['Carbon']; 
        $array_tempvacio[]      = $mostrar['TemperaturaFinal']; 
        $array_tminutos[]       = $mostrar['TiempoTotal']; 
        $array_endbrick[]       = $mostrar['EndBrick'];
        $array_fecha[]          = $mostrar['Fecha'];
        $array_hora[]           = $mostrar['Hora'];
    }else{
         
    }
    
}
$todo[] = $array_coladas;       //  0
$todo[] = $array_recargues;     //  1
$todo[] = $array_oxlan;         //  2
$todo[] = $array_tonchatarra;   //  3
$todo[] = $array_m3;            //  4
$todo[] = $array_antracita;     //  5
$todo[] = $array_grafito;       //  6
$todo[] = $array_tcarbon;       //  7
$todo[] = $array_gasoleo;       //  8
$todo[] = $array_glp;           //  9
$todo[] = $array_oxigeno;       //  10
$todo[] = $array_espumante;     //  11
$todo[] = $array_kwhfusion;     //  12
$todo[] = $array_tfusion;       //  13
$todo[] = $array_kwhafino;      //  14
$todo[] = $array_tafino;        //  15
$todo[] = $array_ttotal;        //  16
$todo[] = $array_tonfusion ;    //  17
$todo[] = $array_tonafino ;     //  18
$todo[] = $array_poweron;       //  19
$todo[] = $array_poweroff;      //  20
$todo[] = $array_carbon;        //  21
$todo[] = $array_tempvacio;     //  22
$todo[] = $array_tminutos;      //  23
//$todo[] = $array_ppp; 
//$todo[] = $array_ebts;
//$todo[] = $array_hvaciado;
$todo[] = $array_endbrick;      //  24
//$todo[] = $array_fecha;         //  25
//$todo[] = $array_hora;          //  26
echo json_encode($todo);
?>