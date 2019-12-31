<?php
    include('./../db/conexionPDO.php');
    //Nombre del Tipo de Vendedor
    $varnomtipven = $_POST['strnomtipven'];
    echo 'Se recibio '.$varnomtipven;
    $insertTipVen = $conexion->prepare("INSERT INTO t00tipven (VNOMTIPVEN) VALUES (:varnomtipven)");
    $insertTipVen -> bindValue(':varnomtipven', $varnomtipven, PDO::PARAM_STR);
    $insertTipVen -> execute();
?>