<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./../asset/js/baseJquery.js" type="text/javascript"></script>
</head>
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
echo ' otro///';
//var_dump($nomarchivos);
//echo json_encode($archivos);
//var_dump($tamarchivos);
*/


//var_dump($tamarchivos);
/*
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
      $tamarchivos = filesize("../archivos/".$archivo);
      echo "última modificación " . date ("m/d/y H:i:s.", filemtime("../archivos/".$archivo));
      echo 'Tamaño ['.$tamarchivos.'] ';
      echo $archivo ."<br />";
      //var_dump($archivo)."<br />";
    }
    closedir($directorio);
}*/
$directorio = opendir("../archivos");//ruta actual
$cdi=0;
    $vmvsarchivos = '
    <!-- MODAL VISUALIZACION CARPETA-->
    <div id="MdlCtdrVSArchivos" class="modal">
        <div id="MdlContdVSArchivos" class="flex">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <h2>VISUALIZACION DE ARCHIVOS SUBIDOS</h2>
                    <span class="close" id="closeCarpeta">&times;</span>
                </div>
                <!--Contido del Modal-->
                <div class="modal-body" style="overflow:auto;">
                    <div class="cont-exceltable">
                        <table class="table-arch-subi">
                        <thead>
                            <tr>
                                <th width="7%">#</th>
                                <th width="23.3%">Nombre del Archivo</th>
                                <th width="23.3%">Tamaño</th>
                                <th width="23.3%">Ult. Modificación</th>
                                <th width="13%">Descargar</th>
                                <th width="10%">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        '; while ($archivo = readdir($directorio)){ 
                            $cdi++;
                            $vmvsarchivos .='
                            <tr>
                                <th scope="row">'.$cdi.'</th>
                                    '; 
                                    if(is_dir($archivo))//verificamos si es o no un directorio
                                    { 
                                        $vmvsarchivos .='<td>['.$archivo .']</td><td></td><td></td>'; //de ser un directorio lo envolvemos entre corchetes
                                    }
                                    else
                                    {
                                        $tamarchivos = filesize("../archivos/".$archivo);
                                        $vmvsarchivos .='<td>'.$archivo .'</td>';
                                        $vmvsarchivos .='<td>['.$tamarchivos.']</td>';
                                        $vmvsarchivos .='<td>'.date ("m/d/y H:i:s.", filemtime("../archivos/".$archivo)).'</td>';
                                        $vmvsarchivos .='<td><a title="Descargar Archivo" href="subidas/" style="color: blue; font-size:18px;"> <span class="icon-download" aria-hidden="true"></span> </a></td>
                                                         <td><a title="Eliminar Archivo" style="color: red; font-size:18px;"> <span class="icon-bin" aria-hidden="true"></span> </a></td>';                                    
                                        //var_dump($archivo)."<br />";
                                    }
                                    //closedir($directorio); 
                                    $vmvsarchivos .='
                                </th>
                            </tr>
                            ';} $vmvsarchivos .='
                        </tbody>
                    </table>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mdlfleft">
                        </div>
                        <div class="mdlfrigh">
                            <button id="btnVSAchivoscancelar" class="btn btnCan">Cancelar</button>
                            <button id="btnVSAchivosconfirmar" class="btn btnReg">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
    echo $vmvsarchivos;
?>