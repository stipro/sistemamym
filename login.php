<?php
include_once('./db/conexionPDO.php');
$usuario_log=$_POST['vusu'];// CONTENER EN UNA VARIABLE LO ESCRITO EN EL INPUT USUARIO_LOG
$contrasena_log=$_POST['vcla'];//CONTENER EN UNA VARIABLE LO ESCRITO EN EL INPUT CONTRASEÑA_LOG
//echo'Usuario es '.$usuario_log.'Clave es '.$contrasena_log;
$loginUsuario=$conexion->prepare("SELECT VNOMUSU, VCLAUSU FROM t001usu WHERE VNOMUSU=:usuario_log AND VCLAUSU=:contrasena_log");// BUSCAR EL USUARIO
$loginUsuario->bindParam(':usuario_log', $usuario_log, PDO::PARAM_STR);
$loginUsuario->bindParam(':contrasena_log', $contrasena_log, PDO::PARAM_STR);
$loginUsuario->execute();
if($loginUsuario->rowCount()>0)// SI LA QUERY ARROJA UN REGISTRO EXISTENTE...
{	
    //PARA REGISTRAR LA HORA Y ESTADO DE CONEXION
    /*
    date_default_timezone_set('America/Mexico_City');
    $ultimaCon=date('Y-M-D G:i:s');
    $actualizarUs=$conexion->prepare("UPDATE usuarios SET estado='conectado', time_login=:ultimaCon WHERE nombre=:usuario_log");
    $actualizarUs->bindParam(':ultimaCon', $ultimaCon, PDO::PARAM_STR);
	$actualizarUs->bindParam(':usuario_log', $usuario_log, PDO::PARAM_STR);
	$actualizarUs->execute();*/

	//header("Location: ./views/main.php");// ACCEDER AL INICIO

	$infoUsuario = $loginUsuario->fetch(PDO::FETCH_ASSOC);//GENERAR LA VARIABLE DE SESIÓN
	session_start();
    $_SESSION['nombre_usuario']=$infoUsuario['VNOMUSU'];
    echo $infoUsuario['VNOMUSU'];
}
else{
	echo $msgest='
    <div class="alerweb-erro">
        <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
        Datos <strong class="letrimpo">incorrectos</strong>, vuelva a intentarlo.
    </div>';
    //ALERTA DE QUE EL USUARIO NO ESTA REGISTRADO
}

?>