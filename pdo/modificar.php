<?php
include('./../db/conexionPDO.php');
//SELECT * FROM t002col
$qcol = $conexion->prepare("SELECT a.*, c.NZON, b.*, f.NIDCOL, f.VPNOCOL, f.VSNOCOL, f.VAPACOL, f.VAMACOL
FROM t00ven AS a
INNER JOIN t002col AS f
ON f.NIDCOL = a.FIDCOL
INNER JOIN tasi_ven_zon AS b
ON a.NIDVEN = b.FIDVEN
INNER JOIN tzona AS c 
ON c.NIDZON = b.FIDZON");// OBTENER INFORMACIÓN DE USUARIO
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
                <div class="iteCon">
                    <label class="titCon">Ingrese Fecha</label>
                    <div class="contInpufc">
                        <i class="iconInpufc icon-calendar"></i>
                        <input id="iptvendat" class="fechconsBusExci"  type="month" name="mes" step="1" min="2015-12" max="2020-12" value="2019-01" >
                    </div>
                </div>
                <div class="iteCon">
                    <label class="titCon">Vendedor</label>
                    <select name="venMod" id="venMod">
                        <option value="" selected>Elige una Opción</option>';
                        while ($mqcol = $qcol->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $vmmvendmodi.='<option data-value="'.$mqcol["NIDVEN"].'" value="'.$mqcol["NIDVEN"].'">'.$mqcol["VPNOCOL"].' '.$mqcol["VSNOCOL"].' '.$mqcol["VAPACOL"].' '.$mqcol["VAMACOL"].' ( ZONA '.$mqcol['NZON'].')</option>';
                        }
                        $vmmvendmodi.='
                    </select>
                    <!--<select>
                        <option value="" selected>Elige una Opción</option>
                        <option value="saab">Saab</option>
                        <option value="vw">VW</option>
                        <option value="audi">Audi</option>
                    </select>-->
                </div>
                <div class="iteCon">
                    <h2> ZONA : '.$mqcol['NZON'].'</h2>
                </div>
                <div id="resvenDato" class="conCon">
                    <div class="iteCon">
                        <label class="titCon" for="iptnvenbru">Venta Bruta</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnvenbru" class="fechconsBusExci" type="text" name="" id="" placeholder="V. Bruta" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Nota Credito</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnnetcre" class="fechconsBusExci" type="text" name="" id="" placeholder="N. Credito" value="">
                        </div>
                    </div>                    
                    <div class="iteCon">
                        <label class="titCon" for="">Venta Neta</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnvennet" class="fechconsBusExci" type="text" name="" id="" placeholder="V. Neta" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Cuota</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptncuota" class="fechconsBusExci" type="text" name="" id="" placeholder="Cuota" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">%</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnporcen" class="fechconsBusExci" type="text" name="" id="" placeholder="%" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Total Clientes</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptntotcli" class="fechconsBusExci" type="text" name="" id="" placeholder="T. Clientes" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Cobertura</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptncobert" class="fechconsBusExci" type="text" name="" id="" placeholder="Cobertura" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Cobrado</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptncobrad" class="fechconsBusExci" type="text" name="" id="" placeholder="Cobrado" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Total por Cobrar</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptntipcob" class="fechconsBusExci" type="text" name="" id="" placeholder="T. por Cobrar" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Morosidad</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnmorosi" class="fechconsBusExci" type="text" name="" id="" placeholder="Morosidad" value="">
                        </div>
                    </div>
                    <div class="iteCon">
                        <label class="titCon" for="">Moroso</label>
                        <div class="contInpufc">
                            <i class="iconInpufc icon-coin-dollar"></i>
                            <input id="iptnmoroso" class="fechconsBusExci" type="text" name="" id="" placeholder="Moroso" value="">
                        </div>
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