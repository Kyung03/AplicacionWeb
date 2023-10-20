<?php
//$codigo = $_GET["dato"];
include('conexion.php');
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];
//echo $fecha1;
$con=conectar();
//$query = " SELECT * FROM `datos` WHERE `Fecha` BETWEEN '$fecha_inicio' AND '$fecha_final' ";
$query = "SELECT * FROM `datos` 
WHERE concat(`Fecha`,' ',`Hora`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB('$fecha_inicio', INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND '$fecha_final 18:00:00'  ";
$result=mysqli_query($con,$query);
$array_coladas;
$array_recargues;
$array_oxlan;
$array_tonchatarra;
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
$array_poweron;
$array_poweroff;
$array_carbon;
$array_tempvacio;
$array_tminutos;
//$array_ppp;
//$array_ebts;
//$array_hvaciado;
$array_endbrick;
$array_TiempoVaciado;
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
//echo json_encode($query);
while($mostrar=mysqli_fetch_array($result)){
    if(isset($mostrar['NumeroColada']) ){
        $array_coladas[] = $mostrar['NumeroColada'];
        $array_recargues[] = $mostrar['Recargues'];
        $array_oxlan[] = $mostrar['OxigenoLanceado']; 
        $array_tonchatarra[] = $mostrar['PesoTotal']; 
        $array_antracita[] = $mostrar['Antracita']; 
        $array_grafito[] = $mostrar['Grafito']; 
        $array_tcarbon[] = Round($mostrar['TotalCarbon'],2); 
        $array_gasoleo[] = $mostrar['Gasoleo'];
        $array_glp[] = $mostrar['GLP']; 
        $array_oxigeno[] = $mostrar['Oxigeno']; 
        $array_espumante[] = $mostrar['Espumante']; 
        $array_kwhfusion[] = $mostrar['KWHFusion']; 
        $array_tfusion[] = $mostrar['TiempoFusion']; 
        $array_kwhafino[] = $mostrar['KWHAfino']; 
        $array_tafino[] = $mostrar['TiempoAfino']; 
        $array_ttotal[] = $mostrar['KWHTotal']; 
        $array_poweron[] = $mostrar['PowerON']; 
        $array_poweroff[] = $mostrar['PowerOff']; 
        $array_carbon[] = $mostrar['Carbon']; 
        $array_tempvacio[] = $mostrar['TemperaturaFinal']; 
        $array_tminutos[] = $mostrar['TiempoTotal']; 
        $array_endbrick[] = $mostrar['EndBrick'];
        $array_TiempoVaciado[] = $mostrar['TiempoVaciado'];
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
        //echo "Ehh";
    } 
}
$todo[] = $array_coladas;       //0
$todo[] = $array_recargues;     //1
$todo[] = $array_oxlan;         //2
$todo[] = $array_tonchatarra;   //3
$todo[] = $array_antracita;     //4
$todo[] = $array_grafito;       //5
$todo[] = $array_tcarbon;       //6
$todo[] = $array_gasoleo;       //7
$todo[] = $array_glp;           //8
$todo[] = $array_oxigeno;       //9
$todo[] = $array_espumante;     //10
$todo[] = $array_kwhfusion;     //11
$todo[] = $array_tfusion;       //12
$todo[] = $array_kwhafino;      //13
$todo[] = $array_tafino;        //14
$todo[] = $array_ttotal;        //15
$todo[] = $array_poweron;       //16
$todo[] = $array_poweroff;      //17
$todo[] = $array_carbon;        //18
$todo[] = $array_tempvacio;     //19
$todo[] = $array_tminutos;      //20
//$todo[] = $array_ppp;
//$todo[] = $array_ebts;
//$todo[] = $array_hvaciado;
$todo[] = $array_endbrick;      //21
$todo[] = $array_TiempoVaciado; //22
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
//echo json_encode($array_oxlan);
?>