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
$Grado;
$Fundidor;
$JefeTurno;
$HoraInicio;  
$array_TiempoVaciado;
$Jornada; 
$array_PrograSmart;
$array_PrograDigit ;
$array_PesoCesta1;
$array_PesoCesta2;
$array_PesoCesta3;
$array_PesoCesta4;
$array_PesoCesta5;
$array_ColadasHorno;
$array_ColadasDelta;
$array_ColadasElec1;
$array_ColadasElect2;
$array_ColadasElect3;
$array_CalDolomitica;
$array_CalCalcitica;
$array_Kalister;
$array_Torta;
$array_TemperaturaCentro;
$array_TemperaturaEVT;
$array_TemperaturaPuerta;
$array_Temperatura12;
$array_Temperatura23;
$array_Temperatura31;
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
        $Grado[] = $mostrar['Grado'];
        $Fundidor[] = $mostrar['Fundidor'];
        $JefeTurno[] = $mostrar['JefeTurno'];
        $HoraInicio[] = $mostrar['HoraInicio'];  
        $array_TiempoVaciado[] = $mostrar['TiempoVaciado'];
        $Jornada[] = $mostrar['Jornada'];
        $array_PrograSmart[] = $mostrar['PrograSmart'];
        $array_PrograDigit [] = $mostrar['PrograDigit'];
        $array_PesoCesta1[] = $mostrar['PesoCesta1'];
        $array_PesoCesta2[] = $mostrar['PesoCesta2'];
        $array_PesoCesta3[] = $mostrar['PesoCesta3'];
        $array_PesoCesta4[] = $mostrar['PesoCesta4'];
        $array_PesoCesta5[] = $mostrar['PesoCesta5'];
        $array_ColadasHorno[] = $mostrar['ColadasHorno'];
        $array_ColadasDelta[] = $mostrar['ColadasDelta'];
        $array_ColadasElec1[] = $mostrar['ColadasElec1'];
        $array_ColadasElect2[] = $mostrar['ColadasElect2'];
        $array_ColadasElect3[] = $mostrar['ColadasElect3'];
        $array_CalDolomitica[] = $mostrar['CalDolomitica'];
        $array_CalCalcitica[] = $mostrar['CalCalcitica'];
        $array_Kalister[] = $mostrar['Kalister'];
        $array_Torta[] = $mostrar['Torta'];
        $array_TemperaturaCentro[] = $mostrar['TemperaturaCentro'];
        $array_TemperaturaEVT[] = $mostrar['TemperaturaEVT'];
        $array_TemperaturaPuerta[] = $mostrar['TemperaturaPuerta'];
        $array_Temperatura12[] = $mostrar['Temperatura12'];
        $array_Temperatura23[] = $mostrar['Temperatura23'];
        $array_Temperatura31[] = $mostrar['Temperatura31'];
    }else{
         
    }
    
}
$todo[] = $array_coladas;  
$todo[] = $array_recargues;
$todo[] = $array_oxlan;
$todo[] = $array_tonchatarra;
$todo[] = $array_m3;
$todo[] = $array_antracita;
$todo[] = $array_grafito;
$todo[] = $array_tcarbon;
$todo[] = $array_gasoleo;
$todo[] = $array_glp;
$todo[] = $array_oxigeno;
$todo[] = $array_espumante;
$todo[] = $array_kwhfusion;
$todo[] = $array_tfusion;
$todo[] = $array_kwhafino;
$todo[] = $array_tafino;
$todo[] = $array_ttotal;
$todo[] = $array_tonfusion ;
$todo[] = $array_tonafino ;
$todo[] = $array_poweron;
$todo[] = $array_poweroff;
$todo[] = $array_carbon;
$todo[] = $array_tempvacio;
$todo[] = $array_tminutos;
//$todo[] = $array_ppp;
//$todo[] = $array_ebts;
//$todo[] = $array_hvaciado;
$todo[] = $array_endbrick;
$todo[] = $Grado;//22
$todo[] = $Fundidor;//23
$todo[] = $JefeTurno;//24
$todo[] = $HoraInicio;//25
$todo[] = $array_TiempoVaciado; //22
$todo[] = $Jornada;//27
$todo[] = $array_PrograSmart;   //23
$todo[] = $array_PrograDigit;   //24
$todo[] = $array_PesoCesta1;    //25
$todo[] = $array_PesoCesta2;    //26
$todo[] = $array_PesoCesta3;    //27
$todo[] = $array_PesoCesta4;    //28
$todo[] = $array_PesoCesta5;    //29
$todo[] = $array_ColadasHorno;  //30
$todo[] = $array_ColadasDelta;  //31
$todo[] = $array_ColadasElec1;  //32
$todo[] = $array_ColadasElect2; //33
$todo[] = $array_ColadasElect3; //34
$todo[] = $array_CalDolomitica; //35
$todo[] = $array_CalCalcitica;  //36
$todo[] = $array_Kalister;      //37
$todo[] = $array_Torta;         //38
$todo[] = $array_TemperaturaCentro;//39
$todo[] = $array_TemperaturaEVT;//40
$todo[] = $array_TemperaturaPuerta;//41
$todo[] = $array_Temperatura12; //42
$todo[] = $array_Temperatura23; //43
$todo[] = $array_Temperatura31; //44
echo json_encode($todo);
?>