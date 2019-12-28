<?php
include('./logireg.php');
//include('./login.php');
session_start();
//COMPROBAR SESSION
if(isset($_SESSION['nombre_usuario'])) { 
    echo'Si inicio Session';   
	header("Location: ./views/main.php");// ACCEDER AL INICIO
}
else{
    $msgest='
    <div class="alerweb">
        <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
        Aun <strong class="letrimpo">No Inicio Sessión</strong>, intentarlo.
    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./asset/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./asset/icon/icon.css"><!--font-->
    <link rel="stylesheet" href="./asset/css/noti.css">
    <link rel="stylesheet" href="./asset/css/base.css">
    <title>Document</title>
</head>
<body>
    <div class="ptapcl">
        <div id="rpta">
            <?php global $msgest;echo $msgest; ?>
        </div>
        <div class="logcont">
            <div class="loghead">
                <img class="iisot" src="./asset/img/isotipo2.png" alt="" srcset="">
                <!--<span class="isot"></span>-->
                <h1 class="nemp">M&M PRODUCTOS MEDICOS Y FARMACEUTICOS E.I.R.L</h1>
                <h2 class="tituhead">INICIAR SESSIÓN</h2>
            </div>
            <div class="logbody">
                <div class="iptcont">
                    <i class="ipticon icon-user"></i>
                    <input id="logusu" class="iptusu iptbase" placeholder="Usuario" type="text" name="" id="" required>
                </div>
                <div class="iptcont">
                    <i class="ipticon icon-key"></i>
                    <input id="logcla" class="iptbase" placeholder="Clave" type="password" name="" id="" required>
                </div>
                <div class="iptconticon">
                    <input id="btnlogi" class="btnReg" type="button" value="Ingresar">
                    <input id="btnlimp" class="btnCan" type="button" value="Limpiar">
                </div>
            </div>
        </div>
    </div>
    <script src="./asset/js/base.js"></script>
</body>
</html>