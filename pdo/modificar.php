<?php
include('./../db/conexionPDO.php');
//SELECT * FROM t002col
$qcol = $conexion->prepare("SELECT a.*, b.NIDVEN
                            FROM t002col a
                            INNER JOIN t00ven b
                            ON a.NIDCOL = b.FIDCOL");// OBTENER INFORMACIÓN DE USUARIO
//$qcol->setFetchMode(PDO::FETCH_ASSOC);
$qcol->execute();
// v(VARIABLE),m(MODAL), modi(ACCIÓN),
$vmmvendmodi='
<head>
    <script src="./../asset/js/baseJquery.js" type="text/javascript"></script>
</head>
<!-- MODAL VISUALIZACION CARPETA-->
<!-- id [mdl (modal), Accion] -->
<div id="mdlVendModi" class="modal">
    <div id="MdlContdVSArchivos" class="flex">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>MODIFICACION DATOS DE VENDEDOR</h2>
                <span class="close" id="closeCarpeta">&times;</span>
            </div>
            <!--Contido del Modal-->
            <div class="modal-body" style="overflow:auto;">
                <div class="contInpufc">
                <label>Vendedor</label>
                <select name="venMod" id="venMod">
                    <option value="" selected>Elige una Opción</option>';
                while ($mqcol = $qcol->fetch(PDO::FETCH_ASSOC)) 
                {
                    $vmmvendmodi.='<option data-value="'.$mqcol["NIDVEN"].'" value="'.$mqcol["NIDVEN"].'">'.$mqcol["VPNOCOL"].' '.$mqcol["VSNOCOL"].$mqcol["VAPACOL"].' '.$mqcol["VAMACOL"].'</option>';
                }
                $vmmvendmodi.='</select>
                    <!--<select>
                        <option value="" selected>Elige una Opción</option>
                        <option value="saab">Saab</option>
                        <option value="vw">VW</option>
                        <option value="audi">Audi</option>
                    </select>-->
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-calendar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="date" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-calendar"></i>
                    <input id="iptvendat" class="fechconsBusExci"  type="month" name="mes" step="1" min="2015-12" max="2020-12" value="2019-01" >
                </div>
                <div id="resvenDato">
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnvenbru" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnnetcre" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnvennet" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptncuota" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnporcen" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptntotcli" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptncobert" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptncobrad" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptntipcob" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnmorosi" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-coin-dollar"></i>
                        <input id="iptnmoroso" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mdlfleft">
                </div>
                <div class="mdlfrigh">
                    <button id="mdlVendModicancelar" class="btn btnCan">Cancelar</button>
                    <button id="mdlVendModiconfirmar" class="btn btnReg">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$("select#venMod").on("change",function(){
    var idven = $(this).val();
    var fecha = $("#iptvendat").val();
    var vendedor = {
        "idven" : idven,
        "fecha" : fecha,
    };
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "./../pdo/venCargardato.php",
        data: vendedor,
        beforeSend: function () {
            $("#resvenDato").html("Procesando, espere por favor...");
        },
        success: function(data){
            $("#resvenDato").html(data);
        }
    });
});
$("#mdlVendModiconfirmar").click(function(){
    var idven = $("#venMod option:selected").val();
    // ---- ///
    var nvenbru = $("#iptnvenbru").val();
    var nnetcre = $("#iptnnetcre").val();
    var nvennet = $("#iptnvennet").val();
    var ncuota = $("#iptncuota").val();
    var nporcen = $("#iptnporcen").val();
    var ntotcli = $("#iptntotcli").val();
    var ncobert = $("#iptncobert").val();
    var ncobrad = $("#iptncobrad").val();
    var ntipcob = $("#iptntipcob").val();
    var nmorosi = $("#iptnmorosi").val();
    var nmoroso = $("#iptnmoroso").val();

    //var zona = $(this).data("value");
    //alert("Eligio Zona: "+zona+"con la fecha: "+fecha);
    var vendedor = {
        "idven" : idven,
        "nvenbru" : nvenbru,
        "nnetcre" : nnetcre,
        "nvennet" : nvennet,
        "ncuota" : ncuota,
        "nporcen" : nporcen,
        "ntotcli" : ntotcli,
        "ncobert" : ncobert,
        "ncobrad" : ncobrad,
        "ntipcob" : ntipcob,
        "nmorosi" : nmorosi,
        "nmoroso" : nmoroso,
    };
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "./../pdo/venActulizado.php",
        data: vendedor,
        beforeSend: function () {
            $("#resvenDato").html("Procesando, espere por favor...");
        },
        success: function(data){
            $("#resvenDato").html(data);
        }
    });
});
</script>';
echo $vmmvendmodi;
?>