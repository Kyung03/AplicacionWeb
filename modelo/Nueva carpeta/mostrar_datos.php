<?php
include('conexion.php');
$con=conectar();

$query = " SELECT * FROM datos WHERE `Fecha` = '$fecha' ";
//echo $query;
$result=mysqli_query($con,$query);
//$query2 = " SELECT fecha FROM datos ";
//$result2=mysqli_query($con,$query2); 
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
$array_ppp;
$array_ebts;
$array_hvaciado;
$array_endbrick;

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
    }else{
        echo "Ehh";
    }
    
}

?>