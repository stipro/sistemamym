<?php
include('../db/conexionPDO.php');
//
$qcol = $conexion->prepare("SELECT * FROM t002col");// OBTENER INFORMACIÓN DE USUARIO
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
                <div>
                <div class="contInpufc">
                <label>Vendedor</label>
                <select name="venMod" id="venMod">
                    <option value="" selected>Elige una Opción</option>';
                while ($mqcol = $qcol->fetch(PDO::FETCH_ASSOC)) 
                {
                    $vmmvendmodi.='<option data-value="'.$mqcol["NIDCOL"].'" value="'.$mqcol["NIDCOL"].'">'.$mqcol["VPNOCOL"].' '.$mqcol["VSNOCOL"].$mqcol["VAPACOL"].' '.$mqcol["VAMACOL"].'</option>';
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
                    <input class="imesven" type="month" name="mes" step="1" min="2015-12" max="2020-12" value="2019-01" >
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-coin-dollar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
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
    var vvenid = $(this).val();
    alert(vvenid);
});
$("#mdlVendModiconfirmar").click(function(){
    var fecha = $("iptvendat").val();
    //var fecha = $(".imesven").val();
    //var zona = $(this).data("value");
    alert("Eligio Zona: ..."+fecha);
    /*var vendedor = {
        "zona" : zona,
        "fecha" : fecha,
};
    alert("Eligio Zona: "+zona+"Fecha: "+fecha)
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "./cargardato.php",
        data: vendedor,
        beforeSend: function () {
            $("#respuesta").html("Procesando, espere por favor...");
        },
        success: function(data){
            $("#respuesta").html(data);
        }
    });
    */
});
</script>';
echo $vmmvendmodi;
?>