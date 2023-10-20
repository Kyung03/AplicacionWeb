<?php
include('conexion.php');
$con=conectar();

$query = " SELECT NumeroColada 
FROM datos "; 
$result=mysqli_query($con,$query);
//$query2 = " SELECT fecha FROM datos ";
//$result2=mysqli_query($con,$query2); 
$array_coladas; 

while($mostrar=mysqli_fetch_array($result)){
    if(isset($mostrar['NumeroColada']) ){
        $array_coladas[] = $mostrar['NumeroColada']; 
        //echo $mostrar['NumeroColada'];
    }else{
        echo "Vacio";
    } 
}

?>