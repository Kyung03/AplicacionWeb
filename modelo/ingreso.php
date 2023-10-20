<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
require("tok.php");
$con = conectar();

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
$stmt = $con->prepare(" SELECT cod_usuario, nombre_usuario, contraseña_usuario, tipo_estado, tipo_usuario 
FROM estado e, clasificacion_usuario c, usuario u 
WHERE u.nombre_usuario = (?)
AND e.cod_estado = u.cod_estado 
AND c.cod_clasificacion = u.cod_clasificacion ");
$stmt->bind_param('s', $usuario);
$usuario = $params->usuario;
$contraseña = $params->password;
$stmt->execute();
$stmt->bind_result($USU_COD, $USUARIO, $USUCON, $USU_EST, $USU_TIP);

if( $stmt->fetch() !== null ){
    if( hash('sha256', $contraseña) == $USUCON){
        if($USU_EST == 'habilitado'){
            /**     CASOS    */
            switch($USU_TIP){
                case 'administrador':
                    if(llamar_sesion($USUARIO, conectar()) == null){
                        // INICIO DE SESION
                        session_start();
                        // CREACION DE TOKEN
                        $ID = session_id();
                        $TOKKEN = generar_token();
                        // ALMACENAMIENTO DE LA SESION
                        crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                        // variables de sesion 
                        $_SESSION['cod'] = $USU_COD;
                        $_SESSION['user'] = $USUARIO;
                        $_SESSION['token'] = llamar_token($USUARIO, conectar());
                        $_SESSION['tipo'] = $USU_TIP;
                        // mensajes    
                        $res = "3";
                        $mod = "adm";
                        $msj = "Ingreso exitoso, Usuario ".$USUARIO." de Administracion";
                        //      respuesta
                        $response->usuario  = $USUARIO;
                        $response->tipo     = $USU_TIP;
                        $response->tokken   = $TOKKEN;
                    }
                    // SESION EXISTENTE
                    else{
                        // SESION INTERRUMPIDA O CIERRE DE NAVEGADOR
                        if(llamar_token($USUARIO, conectar()) == null){
                            //
                            $res = "4";
                            $msj = "token nulo ADM";
                        }
                        /** SESION ACTIVA */
                        else {
                            if($params->verificacion){
                                $res = "4";
                                /** ELIMINACION DE LA SESION ANTERIOR */
                                eliminar_sesion($USUARIO, conectar() );
                                // NUEVO INICIO DE SESION
                                session_start();
                                //      creacion de token    
                                $ID = session_id();
                                $TOKKEN = generar_token();
                                // ALMACENAMIENTO DE LA SESION
                                crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                                //      variables de sesion 
                                $_SESSION['cod'] = $USU_COD;
                                $_SESSION['user'] = $USUARIO;
                                $_SESSION['token'] = llamar_token($USUARIO, conectar());
                                $_SESSION['tipo'] = $USU_TIP;
                                //      mensajes    
                                $mod = "adm";
                                $msj = "Nuevo ingreso realizado, Usuario ".$USUARIO;
                                //      respuesta
                                $response->usuario  = $USUARIO;
                                $response->tipo     = $USU_TIP;
                                $response->tokken   = $TOKKEN;
                            }else{
                                $res = "4";
                                $msj = "SESION ACTIVA ADM";
                            }
                        }
                    }
                    break;
                case 'eaf':
                    // SESION COMPLETAMENTE NUEVA
                    if(llamar_sesion($USUARIO, conectar()) == null){
                        // INICIO DE SESION
                        session_start();
                        //      creacion de token    
                        $ID = session_id();
                        $TOKKEN = generar_token();
                        // ALMACENAMIENTO DE LA SESION
                        crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                        //      variables de sesion 
                        $_SESSION['cod'] = $USU_COD;
                        $_SESSION['user'] = $USUARIO;
                        $_SESSION['token'] = llamar_token($USUARIO, conectar());
                        $_SESSION['tipo'] = $USU_TIP;
                        //      mensajes     
                        $res = "3";
                        $mod = "eaf";
                        $msj = "Ingreso exitoso, Usuario ".$USUARIO." de EAF";
                        //      respuesta
                        $response->usuario  = $USUARIO;
                        $response->tipo     = $USU_TIP;
                        $response->tokken   = $TOKKEN;
                    }
                    // SESION EXISTENTE
                    else{
                        // SESION INTERRUMPIDA O CIERRE DE NAVEGADOR
                        /** SESION ACTIVA */
                        if($params->verificacion){
                            $res = "4";
                            /** ELIMINACION DE LA SESION ANTERIOR */
                            eliminar_sesion($USUARIO, conectar() );
                            // NUEVO INICIO DE SESION
                            session_start();
                            //      creacion de token    
                            $ID = session_id();
                            $TOKKEN = generar_token();
                            // ALMACENAMIENTO DE LA SESION
                            crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                            //      variables de sesion 
                            $_SESSION['cod'] = $USU_COD;
                            $_SESSION['user'] = $USUARIO;
                            $_SESSION['token'] = llamar_token($USUARIO, conectar());
                            $_SESSION['tipo'] = $USU_TIP;
                            //      mensajes    
                            $mod = "eaf";
                            $msj = "Nuevo ingreso realizado, Usuario ".$USUARIO;
                            //      respuesta
                            $response->usuario  = $USUARIO;
                            $response->tipo     = $USU_TIP;
                            $response->tokken   = $TOKKEN;
                        }else{
                            $res = "4";
                            $msj = "SESION ACTIVA EAF";
                        }
                    }
                    break;
                case 'mcc':
                    if(llamar_sesion($USUARIO, conectar()) == null){
                        // INICIO DE SESION
                        session_start();
                        //      creacion de token    
                        $ID = session_id();
                        $TOKKEN = generar_token();
                        // ALMACENAMIENTO DE LA SESION
                        crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                        //      variables de sesion 
                        $_SESSION['cod'] = $USU_COD;
                        $_SESSION['user'] = $USUARIO;
                        $_SESSION['token'] = llamar_token($USUARIO, conectar());
                        $_SESSION['tipo'] = $USU_TIP;
                        //      mensajes     
                        $res = "3";
                        $mod = "mcc";
                        $msj = "Ingreso exitoso, Usuario ".$USUARIO." de MCC";
                        //      respuesta
                        $response->usuario  = $USUARIO;
                        $response->tipo     = $USU_TIP;
                        $response->tokken   = $TOKKEN;
                    }
                    // SESION EXISTENTE
                    else{
                        if($params->verificacion){
                            $res = "4";
                            /** ELIMINACION DE LA SESION ANTERIOR */
                            eliminar_sesion($USUARIO, conectar() );
                            // NUEVO INICIO DE SESION
                            session_start();
                            //      creacion de token    
                            $ID = session_id();
                            $TOKKEN = generar_token();
                            // ALMACENAMIENTO DE LA SESION
                            crear_sesion($USUARIO, $ID, $TOKKEN, conectar());
                            //      variables de sesion 
                            $_SESSION['cod'] = $USU_COD;
                            $_SESSION['user'] = $USUARIO;
                            $_SESSION['token'] = llamar_token($USUARIO, conectar());
                            $_SESSION['tipo'] = $USU_TIP;
                            //      mensajes    
                            $mod = "mcc";
                            $msj = "Nuevo ingreso realizado, Usuario ".$USUARIO;
                            //      respuesta
                            $response->usuario  = $USUARIO;
                            $response->tipo     = $USU_TIP;
                            $response->tokken   = $TOKKEN;
                        }else{
                            $res = "4";
                            $msj = "SESION ACTIVA MCC";
                        }
                    }
                    break;
            }
        }else{
            $res = "7";
            $msj = "Usuario Deshabilitado";
            $response->user = $USUARIO;
        }
    }else{
        $res = "8";
        $msj = "Credenciales incorrectas a";
    }
}else{
    $res = "8";
    $msj = "Credenciales incorrectas";
}
$response->resultado = $res;
$response->mensaje = $msj;
$response->modulo = $mod;
header('Content-Type: application/json');
echo json_encode($response);