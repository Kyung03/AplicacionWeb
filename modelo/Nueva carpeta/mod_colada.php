<?php
include('conexion.php');
$con=conectar();
$task =  $_GET["task"];

switch($task){
    case 'consulta': 
        //$datos = json_decode($_POST['colada']);
        $colada = json_decode($_POST['colada']);
        $query = "SELECT * 
        FROM datos
        WHERE NumeroColada = $colada";
        //echo $query;
        $result=mysqli_query($con,$query);
        while($mostrar=mysqli_fetch_array($result)){
            if(isset($mostrar['NumeroColada']) ){
                $coladas = $mostrar['NumeroColada'];
                $recargues = $mostrar['Recargues'];
                $oxlan = $mostrar['OxigenoLanceado']; 
                $tonchatarra = $mostrar['PesoTotal']; 
                $antracita = $mostrar['Antracita']; 
                $grafito = $mostrar['Grafito']; 
                $tcarbon = Round($mostrar['TotalCarbon'],2); 
                $gasoleo = $mostrar['Gasoleo'];
                $glp = $mostrar['GLP']; 
                $oxigeno = $mostrar['Oxigeno']; 
                $espumante = $mostrar['Espumante']; 
                $kwhfusion = $mostrar['KWHFusion']; 
                $tfusion = $mostrar['TiempoFusion']; 
                $kwhafino = $mostrar['KWHAfino']; 
                $tafino = $mostrar['TiempoAfino']; 
                $ttotal = $mostrar['KWHTotal']; 
                $poweron = $mostrar['PowerON']; 
                $poweroff = $mostrar['PowerOff']; 
                $carbon = $mostrar['Carbon']; 
                $tempvacio = $mostrar['TemperaturaFinal']; 
                $tminutos = $mostrar['TiempoTotal']; 
                $endbrick = $mostrar['EndBrick'];
        
                $Grado = $mostrar['Grado'];
                $Fundidor = $mostrar['Fundidor'];
                $JefeTurno = $mostrar['JefeTurno'];
                $HoraInicio = $mostrar['HoraInicio'];
                $TiempoVaciado = $mostrar['TiempoVaciado'];
                $Jornada = $mostrar['Jornada'];
                $PrograSmart= $mostrar['PrograSmart'];
                $PrograDigit= $mostrar['PrograDigit'];
                $PesoCesta1= $mostrar['PesoCesta1'];
                $PesoCesta2= $mostrar['PesoCesta2'];
                $PesoCesta3= $mostrar['PesoCesta3'];
                $PesoCesta4= $mostrar['PesoCesta4'];
                $PesoCesta5= $mostrar['PesoCesta5'];
                $ColadasHorno= $mostrar['ColadasHorno'];
                $ColadasDelta= $mostrar['ColadasDelta'];
                $ColadasElec1= $mostrar['ColadasElec1'];
                $ColadasElect2= $mostrar['ColadasElect2'];
                $ColadasElect3= $mostrar['ColadasElect3'];
                $CalDolomitica= $mostrar['CalDolomitica'];
                $CalCalcitica= $mostrar['CalCalcitica'];
                $Kalister= $mostrar['Kalister'];
                $Torta= $mostrar['Torta'];
                $TemperaturaCentro= $mostrar['TemperaturaCentro'];
                $TemperaturaEVT= $mostrar['TemperaturaEVT'];
                $TemperaturaPuerta= $mostrar['TemperaturaPuerta'];
                $Temperatura12= $mostrar['Temperatura12'];
                $Temperatura23= $mostrar['Temperatura23'];
                $Temperatura31= $mostrar['Temperatura31'];
        
                $codigo = $mostrar['codigo_colada'];
                $fecha = $mostrar['Fecha'];
                $hora = $mostrar['Hora'];
            }else{
                echo "No hay datos";
            }
        }
        $array[] = $coladas;//0
        $array[] = $recargues;//1
        $array[] = $oxlan;//2
        $array[] = $tonchatarra;//3
        $array[] = $antracita;//4
        $array[] = $grafito;//5
        $array[] = $tcarbon;//6
        $array[] = $gasoleo;//7
        $array[] = $glp;//8
        $array[] = $oxigeno;//9
        $array[] = $espumante;//10
        $array[] = $kwhfusion;//11
        $array[] = $tfusion;//12
        $array[] = $kwhafino;//13
        $array[] = $tafino;//14
        $array[] = $ttotal;//15
        $array[] = $poweron;//16
        $array[] = $poweroff;//17
        $array[] = $carbon;//18
        $array[] = $tempvacio;//19
        $array[] = $tminutos;//20
        $array[] = $endbrick; //21
        $array[] = $Grado;//22
        $array[] = $Fundidor;//23
        $array[] = $JefeTurno;//24
        $array[] = $HoraInicio;//25
        $array[] = $TiempoVaciado;//26
        $array[] = $Jornada;//27
        $array[] = $PrograSmart;//28
        $array[] = $PrograDigit;//29
        $array[] = $PesoCesta1;//30
        $array[] = $PesoCesta2;//31
        $array[] = $PesoCesta3;//32
        $array[] = $PesoCesta4;//33
        $array[] = $PesoCesta5;//34
        $array[] = $ColadasHorno;//35
        $array[] = $ColadasDelta;//36
        $array[] = $ColadasElec1;//37
        $array[] = $ColadasElect2;//38
        $array[] = $ColadasElect3;//39
        $array[] = $CalDolomitica;//40
        $array[] = $CalCalcitica;//41
        $array[] = $Kalister;//42
        $array[] = $Torta;//43
        $array[] = $TemperaturaCentro;//44
        $array[] = $TemperaturaEVT;//45
        $array[] = $TemperaturaPuerta;//46
        $array[] = $Temperatura12;//47
        $array[] = $Temperatura23;//48
        $array[] = $Temperatura31;//49
        $array[] = $codigo;//50
        $array[] = $fecha;//51
        $array[] = $hora;//52
        echo json_encode($array);

    break;
    case 'actualizar':
        $colada = json_decode($_POST['colada']);
        $string_modificados = json_decode($_POST['string_modificados']);
        $datos_concant='';
        $i=0;
        foreach($string_modificados as $dato){
            if($i <= $string_modificados){
                if($datos_concant==''){
                    $datos_concant = $datos_concant.$dato;
                }else{
                    $datos_concant = $datos_concant.', '.$dato;
                }
            }else{
                $datos_concant = $datos_concant.$dato;
            }
            $i++;
        }
        $query = "UPDATE datos SET  $datos_concant WHERE NumeroColada = $colada";
        echo json_encode($query);
        $result=mysqli_query($con,$query);
    break;
    case 'num_colada':
        $query = "SELECT NumeroColada 
        FROM datos ";
        //echo json_encode($query);
        $result=mysqli_query($con,$query);
        $coladas;
        while($mostrar=mysqli_fetch_array($result)){
            if(isset($mostrar['NumeroColada']) ){
                $coladas[] = $mostrar['NumeroColada'];
            }else{
                echo "No hay datos";
            }
        }
        $array[] = $coladas;//0
        echo json_encode($coladas);
    break;
}

//$result=mysqli_query($con,$query);

//header("Location:../controladores/controlador.php?task=mod_usuario")  ;

?>