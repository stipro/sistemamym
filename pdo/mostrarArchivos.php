<?php
//MOSTRAR ARCHIVOS
/*
$directorio_escaneado = scandir('../archivos');
$archivos = array();
foreach ($directorio_escaneado as $item) {
   if ($item != '.' and $item != '..') {
      //$archivos[] = $item;
      $archivos[] = filemtime($dir . '/' . $file);
   }
}
*/
/*
$dir='../archivos';
//$directorio_escaneado = scandir('../archivos');
$archivos = array();
$nomarchivos = array();
//$tamarchivos = array();
foreach (scandir($dir) as $item) {
   if ($item != '.' and $item != '..') {
      //$archivos[] = $item;
      $archivos[] = filemtime($dir . '/' . $item);
      $nomarchivos[] = $item;
      $tamarchivos = filesize('./'.$item);
      var_dump($tamarchivos);
   }
}
*/
/*
$dir = "../archivos";
 
// Abre un directorio conocido, y procede a leer el contenido
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {

            if ($file != "." && $file != "..") {
               echo "filename: $file : filetype: ". filetype($dir . $file)."</br>";
           }
        }
        closedir($dh);
    }
}
echo ' otro///';*/
//var_dump($nomarchivos);
//echo json_encode($archivos);
//var_dump($tamarchivos);
$directorio = opendir("../archivos");//ruta actual
$tamarchivos = filesize("../archivos");

//var_dump($tamarchivos);

while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
      $tamarchivos = filesize("../archivos/".$archivo);
      echo "La última modificación de $archivo fue: " . date ("m/d/y H:i:s.", filemtime("../archivos/".$archivo));
      echo 'Tamaño es: ['.$tamarchivos.'] ';
      echo $archivo ."<br />";
      //var_dump($archivo)."<br />";
    }
}

?>