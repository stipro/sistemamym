<?php
/*
 session_start();
 if(empty($_SESSION['nombre_usuario']))
 {
 header('Location: ../index.php');
 }
 //echo $_SESSION['nombre_usuario'];
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./../asset/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
        <link rel="stylesheet" href="../asset/css/noti.css">
        <link rel="stylesheet" href="../asset/icon/icon.css"><!--font-->
        <link rel="stylesheet" href="../asset/css/modal.css">
        <link rel="stylesheet" href="../asset/css/grid-list.css">
        <link rel="stylesheet" href="../asset/css/base.css">
    </head>
    <?php include('tipven.php');
    ?>
    <body>
        <header class="grupBarra">
            <ul id="grupContBarra" class="grupContBarra">
                <li class="grupContLi">
                    <a class="iconCont-menu" href="main.php">
                        <span class="iconItem-menu icon-house "></span>
                        <span class="iconLetr-menu">Inicio</span>
                    </a>
                </li>
                <!--MENU-->
                <li class="grupContLi" id="menuComi">
                    <a class="iconCont-menu" href="comision.php">
                        <span class="iconItem-menu icon-comisiones "></span>
                        <span class="iconLetr-menu">Comisiones</span>
                        <span class="icon-circle-down"></span>
                     </a>
                     <!--SUBMENU
                     <ul class="" id="submenuComi">
						<li><a href="#">SubElemento #1 <span class="icon-dot"></span></a></li>
						<li><a href="#">SubElemento #2 <span class="icon-dot"></span></a></li>
						<li><a href="#">SubElemento #3 <span class="icon-dot"></span></a></li>
					</ul>-->
                </li>
                <li class="grupContLi">
                    <a class="iconCont-menu" href="#">
                        <span class="iconItem-menu icon-sunat-ose "></span>
                        <span class="iconLetr-menu">Sunat/OSE</span>
                        <span class="icon-circle-down"></span>
                    </a>
                </li>
                <li class="grupContLi">
                    <a class="iconCont-menu" href="checklist.html">
                        <span class="iconItem-menu icon-cheklist "></span>
                        <span class="iconLetr-menu">Cheklist</span>
                        <span class="icon-circle-down"></span>
                    </a>
                </li>
                <li class="grupContLi">
                    <a class="iconCont-menu" href="#">
                        <span class="iconItem-menu icon-inventario"></span>
                        <span class="iconLetr-menu">Inventario</span>
                        <span class="icon-circle-down"></span>
                    </a>
                </li>
                <li class="grupContLi">
                    <a class="iconCont-menu" href="#">
                        <span class="iconItem-menu icon-atencion"></span>
                        <span class="iconLetr-menu">Atencion</span>
                        <span class="icon-circle-down"></span>
                    </a>
                </li>
                <!--
                <li class="submenu">
                    <a href="#"><span class="icon-rocket"></span>Proyectos<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="#">SubElemento #1 <span class="icon-dot"></span></a></li>
                        <li><a href="#">SubElemento #2 <span class="icon-dot"></span></a></li>
                        <li><a href="#">SubElemento #3 <span class="icon-dot"></span></a></li>
                    </ul>
                </li>-->
			</ul>
            <div class="TopMenContenedor" id="">
                <div href="" class="ico-inicio icon-izq" id="btn_main" onClick="cambiarClase()">
                    <div class="iconContinicio">
                        <span id="home" class="icon icon-menu"></span>
                    </div>
                </div>
                <div class="grupOpti">
                    <a href="" class="ico-retro iconItemOpti icon-izq">
                        <div class="iconContOpi">
                            <span class="icon icon-reply"></span>
                        </div>                        
                    </a>
                    <a href="" class="ico-not iconItemOpti icon-izq">
                        <div class="iconContOpi">
                            <span class="icon icon-bell"></span>
                        </div>                    
                    </a>
                    <a href="" class="img-mym iconItemOpti hidden-M">
                        <div class="iconContOpi">
                            <img class="fa fa-bars" width="150" height="50" alt="Logo">
                        </div>                    
                    </a>
                    <a  href="" id="PantCompleta" class="ico-enlar iconItemOpti icon-der">
                        <div class="iconContOpi">
                            <span id="icon-enlarge2" class="icon icon-enlarge2"></span>
                        </div>                    
                    </a>
                    <a  href="" class="ico-bus iconItemOpti icon-der" id="buscador">
                        <div class="iconContOpi">
                            <span class="icon icon-user"></span>
                        </div>                    
                    </a>
                    <a href="../logout.php" class="ico-exit iconItemOpti icon-der">
                        <div class="iconContOpi">
                            <span class="icon icon-exit"></span>
                        </div>                    
                    </a>
                </div>
            </div>
        </header>
        <div class="contModu heatConModu">
            <ul class="heatul">
                <li class="heatItem"><a class="heatContItem" href=""><span class="iconHea icon-plus"></span></a></li>
                <li class="heatItem"><a class="heatContItem" href=""><span class="iconHea icon-search"></span></a></li>
            </ul>
            <!--  MENU GRID - LIST -->
            <a class="show-list"><i class="fa icon-list1"></i></a>
            <a class="hide-list"><i class="fa icon-grid"></i></a>
        </div>
        <div class="contModu">
        <?php global $msgest; echo $msgest; ?>
            <header class="letrModu">
                <h1>TITULO DEL MODULO</h1>
            </header>
            <!-- CONTENEDOR GRID - LIST -->
            <div class="container">
                <div class="box"></div>
                <div class="box"></div>
                <div class="box"></div>
                <div class="box"></div>
                <div class="box"></div>
                <div class="box"></div>
                <div class="box"></div>
            </div>
        </div>
        <!-- MODAL SUBIR EXCEL-->
        <div class="modal" id="mdliteSubExci" >
            <div class="flex" id="mdlconSubExci">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2 class="mdlhTitu">IMPORTACIÓN DE LOS ARCHIVOS XLSX</h2>
                        <span class="close" id="mdlcerSubExci">&times;</span>
                    </div>
                    <!--Contenido del Modal-->
                    <div class="modal-body">
                        <label id="conticonSubExcl" class="conticonSubExcl">
                            <img class="icoSubExc" src="../asset/svg/sobresalir.svg" alt="Icono Excel">
                            <!--<span class="exc-letra">Importar Archivo</span>-->
                            <!--<input type="file" id="excelfile" value="image1" name="excelfile" multiple="multiple"/>-->
                            <form id="" class="fsubiarchivo" action="herramientas/php/cargar_archivo.php" method="post" enctype="multipart/form-data">
                                <div>
                                    <input type="file" id="excelFileImport" value="image1" name="excelfile" multiple="multiple"/>
                                    </label>
                                </div>                                    
                                <button id="btn-subir-archivo" class="btn btn-confirmar" type="submit">Cargar Fichero</button>
                            </form>  
                        </label>
                        <label id="fichero" for="exfi2" class="letSubExc">Importar Archivo</label>
                        <div id="aletipvenvacio" class="alerweb-erro" style="display:none">
                            <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
                            No se puede mostrar excel, <strong class="letrimpo">No hay datos en Tipos para Vendedor</strong>, Por favor, Registre Datos.
                            <button id="mdliagrTipven" class="btnReg">Tipo Vendedor</button>
                        </div>

                        <div class="cont-exceltable">
                            <table id="exceltable" class="excel-tabla"></table>
                        </div>
                        <label class="tituInpfc" for="">Seleccione Año y Mes</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-calendar"></i>
                            <!--<input type="text"> Año -->
                            <input id="iptfreg" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese Año-Mes" value="2019-01">
                        </div>
                        <div id="resp" class="resp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <progress id="pgssubirAhs" class="pgssubirAhs" value="0" max="100"></progress>
                        <div class="mdlfleft">
                            <input id="ckxvistExcel" type="checkbox" name="" id="" class="iconfootSubExci icon-eye-hidden" disabled>
                            <button id="btnsubirAhs">Subir Archivo</button>
                        </div>
                        <div class="mdlfrigh">
                            <button id="btnCan" class="btn btnCan">Cancelar</button>
                            <button id="btnReg" class="btn btnReg">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./../asset/js/modal.js" type="text/javascript"></script>
        <script src="./../asset/js/excel/ImportExcel.js" type="text/javascript"></script>
        <script src="./../asset/js/base.js" type="text/javascript"></script>
        <script src="./../asset/js/baseJquery.js" type="text/javascript"></script>
        <script src="./../asset/js/grid-list.js" type="text/javascript"></script>
        
    </body>
</html>