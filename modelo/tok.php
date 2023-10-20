<?php
function generar_token(){
    $str_result="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($str_result), 0, 10);
}

function crear_sesion($usuario, $ID, $token, $con){
    $stmt = $con->prepare("UPDATE usuario 
    SET token = (?),
    sesion_id = (?)
    WHERE nombre_usuario = (?); ");
    $stmt->bind_param('sss', $token_db, $sesion_db, $usuario_db);
    $token_db = $token;
    $sesion_db = $ID;
    $usuario_db = $usuario;
    $stmt->execute();
}

function llamar_sesion($usuario, $con){
    $stmt = $con->prepare(" SELECT sesion_id 
    FROM usuario 
    WHERE nombre_usuario = (?) ");
    $stmt->bind_param('s', $dato_db);
    $dato_db = $usuario;
    $stmt->execute();
    $stmt->bind_result( $SESION );
    $stmt->fetch();
    return $SESION;
}

function llamar_token($usuario, $con){
    $stmt = $con->prepare(" SELECT token 
    FROM usuario 
    WHERE nombre_usuario = (?) ");
    $stmt->bind_param('s', $dato_db);
    $dato_db = $usuario;
    $stmt->execute();
    $stmt->bind_result( $TOKEN );
    $stmt->fetch();
    return $TOKEN;
}

function limpiar_sesion($cod_usuario, $con){
    $stmt = $con->prepare(" UPDATE usuario 
    SET token = null,
    sesion_id = null
    WHERE cod_usuario = (?) ");
    $stmt->bind_param('s', $dato_db);
    $dato_db = $cod_usuario;
    $stmt->execute();
}

function eliminar_sesion($usuario, $con){
    session_id(llamar_sesion($usuario, $con ));
    session_start();
    unset($_SESSION['cod']);
    unset($_SESSION['user']);
    unset($_SESSION['tipo']);
    unset($_SESSION['token']);
    session_destroy();
}

?>