<?php
//$fecha_excel = $_GET["dat"];
//$fecha_excel = $_POST['fecha'];
include('conexion.php');
$con=conectar();
//$query = " SELECT * FROM datos WHERE `Fecha` = '$fecha_excel'  ";
$query = "SELECT * FROM `datos` 
WHERE concat(`Fecha`,' ',`Hora`) 
BETWEEN (SELECT DATE_FORMAT(DATE_SUB('$fecha_inicio', INTERVAL 1 DAY), '%Y-%m-%d 22:00:00')) 
AND '$fecha_cierre 18:00:00'  ORDER BY NumeroColada";
$result2=mysqli_query($con,$query);
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
while($mostrar=mysqli_fetch_array($result2)){
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
}
header("Content-Type: appliation/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; "."filename=datos_horno_".$fecha_inicio.".xls");
?>
<table border=1>
    <tr>
        <th>Coladas del dia</th>
        <?php 
        $colada_dia=1;
        if(empty($array_coladas)){
            //echo "no hay coladas";
        }else{
            foreach($array_coladas as $dato){
                echo '<th>'.$colada_dia.'</th>';
                $colada_dia++;
            } 
        }
        ?>
    </tr>
    <tr>
        <th>No.Colada</th>
        <?php 
        if(empty($array_coladas)){
            //echo "no hay coladas";
        }else{
            foreach($array_coladas as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>
    <tr>
        <th>Recargues</th>
        <?php 
        if(empty($array_recargues)){
            //echo "no hay coladas";
        }else{
            foreach($array_recargues as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        } ?>
    </tr>
    <tr>
        <th>OxigenoLanceado</th>
        <?php 
        if(empty($array_oxlan)){
            //echo "no hay coladas";
        }else{
            foreach($array_oxlan as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>
    <tr>
        <th>PesoTotal(ton.chatarra)</th>
        <?php 
        if(empty($array_tonchatarra)){
            //echo "no hay coladas";
        }else{
            foreach($array_tonchatarra as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>
    <tr>
        <th>M3 lanceado/ton</th>
        <?php 
        if(empty($array_recargues)){
            //echo "no hay coladas";
        }else{
            foreach($array_recargues as $dato){
                echo '<th>'.''.'</th>';
            } 
        }
        ?>
    </tr> 
    <tr>
        <th>Antracita</th>
        <?php 
        if(empty($array_antracita)){
            //echo "no hay coladas";
        }else{
            foreach($array_antracita as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>Grafito</th>
        <?php 
        if(empty($array_grafito)){
            //echo "no hay coladas";
        }else{
            foreach($array_grafito as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>TotalCarbon</th>
        <?php 
        if(empty($array_tcarbon)){
            //echo "no hay coladas";
        }else{
            foreach($array_tcarbon as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>
    <tr>
        <th>Gasoleo</th>
        <?php 
        if(empty($array_gasoleo)){
            //echo "no hay coladas";
        }else{
            foreach($array_gasoleo as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>
    <tr>
        <th>GLP</th>
        <?php 
        if(empty($array_glp)){
            //echo "no hay coladas";
        }else{
            foreach($array_glp as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>Oxigeno</th>
        <?php 
        if(empty($array_oxigeno)){
            //echo "no hay coladas";
        }else{
            foreach($array_oxigeno as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>    
    <tr>
        <th>Espumante</th>
        <?php 
        if(empty($array_espumante)){
            //echo "no hay coladas";
        }else{
            foreach($array_espumante as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>    
    <tr>
        <th>KWHFusion</th>
        <?php 
        if(empty($array_kwhfusion)){
            //echo "no hay coladas";
        }else{
            foreach($array_kwhfusion as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>TiempoFusion</th>
        <?php 
        if(empty($array_tfusion)){
            //echo "no hay coladas";
        }else{
            foreach($array_tfusion as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>    
    <tr>
        <th>KWHAfino</th>
        <?php 
        if(empty($array_kwhafino)){
            //echo "no hay coladas";
        }else{
            foreach($array_kwhafino as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>TiempoAfino</th>
        <?php 
        if(empty($array_tafino)){
            //echo "no hay coladas";
        }else{
            foreach($array_tafino as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>KWHTotal</th>
        <?php 
        if(empty($array_ttotal)){
            //echo "no hay coladas";
        }else{
            foreach($array_ttotal as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>  
    <tr>
        <th>KWH/ton fusion</th>
        <?php 
        if(empty($array_recargues)){
            //echo "no hay coladas";
        }else{
            foreach($array_recargues as $dato){
                echo '<th>'.''.'</th>';
            }
        }
         ?>
    </tr>  
    <tr>
        <th>KWH/ton afino</th>
        <?php 
        if(empty($array_recargues)){
            //echo "no hay coladas";
        }else{
            foreach($array_recargues as $dato){
                echo '<th>'.''.'</th>';
            } 
        }
        ?>
    </tr>  
    <tr>
        <th>PowerON</th>
        <?php 
        if(empty($array_poweron)){
            //echo "no hay coladas";
        }else{
            foreach($array_poweron as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>PowerOff</th>
        <?php 
        if(empty($array_poweroff)){
            //echo "no hay coladas";
        }else{
            foreach($array_poweroff as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr>    
    <tr>
        <th>Carbon</th>
        <?php 
        if(empty($array_carbon)){
            //echo "no hay coladas";
        }else{
            foreach($array_carbon as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>    
    <tr>
        <th>TemperaturaFinal</th>
        <?php 
        if(empty($array_tempvacio)){
            //echo "no hay coladas";
        }else{
            foreach($array_tempvacio as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>    
    <tr>
        <th>TiempoTotal</th>
        <?php 
        if(empty($array_tminutos)){
            //echo "no hay coladas";
        }else{
            foreach($array_tminutos as $dato){
                echo '<th>'.$dato.'</th>';
            }
        }
         ?>
    </tr>
    <tr>
        <th>EndBrick</th>
        <?php 
        if(empty($array_endbrick)){
            //echo "no hay coladas";
        }else{
            foreach($array_endbrick as $dato){
                echo '<th>'.$dato.'</th>';
            } 
        }
        ?>
    </tr> 
</table>