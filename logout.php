<?php include('./db/conexionPDO.php');
session_start();
if(!empty($_SESSION['nombre_usuario'])){
    $_SESSION['nombre_usuario'];
    session_unset(); //LIMPIAR VARIABLES DE SESIÓN    
    session_destroy();//DESTRUIR LA SESIÓN
    header("Location:index.php");
}
else{
    header("Location:index.php");
}
?>