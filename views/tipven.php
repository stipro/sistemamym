<!--REGISTRO TIPO DE VENDEDOR-->
<div class="modal" id="mdliteTipven" style="z-index:2;">
    <div class="flex" id="mdlconTipven">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2 class="mdlhTitu">AGREGAR TIPO (VENDEDOR)</h2>
                <span class="close" id="mdlceriTipven">&times;</span>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="ajaxrestipven" class="resp"></div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-calendar"></i>
                    <input id="iptnomtipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="">
                </div>
                <div class="contInpufc">
                    <i class="iconInpufc icon-calendar"></i>
                    <input id="iptdestipven" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese Descripcion" value="">
                </div>
            </div>
            <div class="modal-footer">
                <div class="mdlfleft">
                    <input id="" type="button" value="Ver Tipo" name="" id="" class="iconfootSubExci icon-eye-hidden">
                </div>
                <div class="mdlfrigh">
                    <button id="btncantipven" class="btn btnCan">Cancelar</button>
                    <button id="btnregtipven" class="btn btnReg">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>