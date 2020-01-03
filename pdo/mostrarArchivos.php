<?php
//MOSTRAR ARCHIVOS
$directorio_escaneado = scandir('../archivos');
$archivos = array();
foreach ($directorio_escaneado as $item) {
   if ($item != '.' and $item != '..') {
      $archivos[] = $item;
   }
}
echo json_encode($archivos);
?>