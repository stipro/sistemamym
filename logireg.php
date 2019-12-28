<?php
//////// CONEXION A LA BASE DE DATOS /////////
include('./db/conexionPDO.php');

//////////REGISTRO NUEVO USUARIO ////////////
if (isset($_POST['registrarse'])){ //// SI SE PRESIONA EL BOTÓN "REGISTRARSE" OCURRE LO SIGUIENTE 

 $usuario_reg=$_POST['usuario_reg'];
 $contrasena_reg=$_POST['contraseña_reg'];
 $contraseña_regconf=$_POST=['contraseña_regconf'];
 $email_reg=$_POST['email_reg'];


$existente = $conexion->query("SELECT * FROM usuarios where nombre='$usuario_reg' or email='$email_reg'"); /// COMPROBAR SI EL YA ESTA REGISTRADO
if ($existente->rowCount()>0) /// SI EXISTE ENTONCES EL MENSAJE SERÁ:
{
	$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	Nombre de <strong>Usuario y/o Email</strong> ya existente</div>';
}

else if ($contrasena_reg!=$contraseña_regconf) /// SI LAS CONTRASEÑAS NO COINCIDEN ENVIAR EL SIGUIENTE MENSAJE
{
	$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	Las contraseñas <strong>no coinciden</strong></div>';
}

else /// SI EL USUARIO NO EXISTE, NI EL EMAIL, Y LAS CONTRASEÑAS COINCIDEN ENTONCES PROCEDER A INSERTAR
{

try {

  $nuevoUsuario = $conexion -> prepare("INSERT INTO usuarios(nombre, contrasena, email) VALUES (:usuario_reg, :contrasena_reg, :email_reg)");
  $nuevoUsuario -> bindParam(':usuario_reg', $usuario_reg, PDO::PARAM_STR);
  $nuevoUsuario -> bindParam(':contrasena_reg', $contraseña_reg, PDO::PARAM_STR);
  $nuevoUsuario -> bindParam(':email_reg', $email_reg, PDO::PARAM_STR);

  $ejecutar= $nuevoUsuario -> execute(); 

} catch (PDOException $error) { /// MENSAJE POR SI SURGE ALGÚN ERROR
     print 'ERROR: '. $error->getMessage();
     $mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>ERROR AL REGISTRAR NUEVO USUARIO</strong></div>';
}
if($ejecutar) // MENSAJE DE EXITO
{
   $mensaje='<div class="alert alert-success alert-dismissable col-md-offset-4 col-md-3 text-center">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>NUEVO USUARIO REGISTRADO CORRECTAMENTE</strong></div>';
}
}
}

?>