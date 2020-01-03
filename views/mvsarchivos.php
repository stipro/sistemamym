<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./../asset/js/baseJquery.js" type="text/javascript"></script>
</head>
<?php
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
                <div class="modal-body">
                    <table class="table-arch-subi">
                        <thead>
                            <tr>
                                <th width="7%">#</th>
                                <th width="70%">Nombre del Archivo</th>
                                <th width="13%">Descargar</th>
                                <th width="10%">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <tr>
                                <th scope="row">xD</th>
                                    <td>xD</td>
                                    <td><a title="Descargar Archivo" href="subidas/" style="color: blue; font-size:18px;"> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a></td>
                                    <td><a title="Eliminar Archivo" style="color: red; font-size:18px;" onclick=""> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a></td>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="modal-footer">
                        <div class="mdlfleft">
                            <button id="btnAchivossubir" class="btn btnReg">Subir Archivo</button>
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