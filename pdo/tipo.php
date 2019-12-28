<?php
  //CONSULTA LA TABLA TIPO
  include("./../db/conexionPDO.php");
  $constipven = $conexion->prepare("SELECT  id,tipo, COUNT(*) as total  FROM (SELECT NIDTIPVEN AS id, VNOMTIPVEN AS tipo FROM t00tipven)tbl_tmp GROUP BY tipo, id");// OBTENER LOS TIPOS DE VENDEDOR
  $constipven->execute();
  $favarcotipven = $constipven->fetchAll(PDO::FETCH_ASSOC);
  $fvarcotipven = $constipven->fetch(PDO::FETCH_ASSOC);
  echo json_encode($favarcotipven);
  //INSERTACIÓN DE REGISTRO DE TABLA TIPO
  //MODIFICACIÓN DE REGISTRO DE TABLA TIPO
  //ELIMINACIÓN DE REGISTRO DE TABLA TIPO
?>