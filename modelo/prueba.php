<?php

$usuario="root";
$contraseña="Dpt.mcc2$4ceriA";
$servidor="localhost:3305";
$base_datos="aceria_db";
$con=mysqli_connect($servidor,$usuario,$contraseña,$base_datos) or die ("Error al conectar con la base de datos".mysqli_error());

//$usuario = "";
//$tipo = "";

class Result{}
$response = new Result();

$res = "";
$msj = "";
$tpo = "";
$mod = "";
/** parametros a enviar
 *  resultado
 *  mensaje
 *  usuario
 *  tipo
 *  tokken
 */
$stmt = $con->prepare(" SELECT cod_usuario, nombre_usuario, contraseña_usuario, e.tipo_estado, c.tipo_usuario, salt_usuario
FROM estado e, clasificacion_usuario c, usuario u 
WHERE u.nombre_usuario = (?) 
AND e.cod_estado = u.cod_estado 
AND c.cod_clasificacion = u.cod_clasificacion ");
//AND u.contraseña_usuario = (?) 
$stmt->bind_param('s', $usuario);

$usuario = "kleea";//$params->usuario;
$contraseña = "123";//$params->password;

$stmt->execute();

$stmt->bind_result($cod_usuario, $nombre_usuario, $clave_usuario, $tipo_estado, $tipo_usuario, $salt_usuario);

//while ($stmt->fetch()) {
    //$stmt->fetch();
    if($stmt->fetch() !== null ){
        
        echo 'codigo: '.$cod_usuario.'-';
        echo 'usuario: '.$nombre_usuario.'-';
        echo 'clave: '.$clave_usuario.'-';
        echo 'estado: '.$tipo_estado.'-';
        echo 'tipo: '.$tipo_usuario.'-';
        echo 'salt: '.$salt_usuario.'-';
        echo '\n';
        var_dump($clave_usuario);
        $hash = hash_pbkdf2("sha1", $contraseña, $salt_usuario, 1000, 32, true);
        echo $hash;
    }else{
        echo 'no hay nada';
    }
    
//    }
    // Cerramos la sentencia preparada
    $stmt->close();
/*
$consulta = "SELECT cod_usuario, nombre_usuario, tipo_estado, tipo_usuario 
FROM estado e, clasificacion_usuario c, usuario u 
WHERE u.nombre_usuario = ('$params->usuario') 
AND u.contraseña_usuario = ('$params->password') 
AND e.cod_estado = u.cod_estado 
AND c.cod_clasificacion = u.cod_clasificacion ";
*/

//$result=mysqli_query($con,$consulta);
//$mostrar=mysqli_fetch_array($result);

function legacyHashCheck($hash, $password){
    $raw = base64_decode($hash);
    $salt = substr($raw, 1, 16);
    $payload = substr($raw, 17, 32);
    $check = hash_pbkdf2('sha1', $password, $salt, 1000, 32, true); 
    return $payload === $check; 
}
?>