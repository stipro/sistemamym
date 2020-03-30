<?php
    include_once("../db/conexionPDO.php");
    $idven = $_POST['idven'];//Obtengo el vendedor
    $fechselenor = $_POST['fecha'];//Obtengo la fecha
    //echo ' Vendedor '.$vendsele;
    $fechsele = str_replace("-","",$fechselenor);
    //var_dump($fechsele);
    //echo 'Fecha: '.$fechsele;
    //$cbbselecvenfar = $conexion->prepare("SELECT zona, vendedor, v_bruta,  n_credito, v_neta, cuota, porcentaje, t_clientes, cobertura, cobrado, t_x_cobrar, morosidad, moroso, fecha FROM `comisiones_mym`.`avavendedor` WHERE `zona`=:vendesele AND date_format(`fecha`, '%Y%m')='201906'");
    $cbbselecvenfar = $conexion->prepare("SELECT *
    FROM t011avavendedor
    WHERE FIDZON = :idven AND DATE_FORMAT(DFECREG, '%Y%m')=:fechsele
    ");// OBTENER INFORMACIÓN DE USUARIO
    $cbbselecvenfar->bindParam(':idven', $idven, PDO::PARAM_STR);
    $cbbselecvenfar->bindParam(':fechsele', $fechsele, PDO::PARAM_STR);
    $cbbselecvenfar->execute();
    $mostrarcbbselecvenfar = $cbbselecvenfar->fetch(PDO::FETCH_ASSOC);
    echo '
    <div class="iteCon">
        <label class="titCon" for="iptnvenbru">Venta Bruta</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptnvenbru" class="fechconsBusExci" type="text" name="" id="" placeholder="V. Bruta" value="'.$mostrarcbbselecvenfar['NVENBRU'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="iptnvenbru">Nota Credito</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptnnetcre" class="fechconsBusExci" type="text" name="" id="" placeholder="N. Credito" value="'.$mostrarcbbselecvenfar['NNETCRE'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="iptnvenbru">Venta Neta</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptnvennet" class="fechconsBusExci" type="text" name="" id="" placeholder="V. Neta" value="'.$mostrarcbbselecvenfar['NVENNET'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="iptnvenbru">Cuota</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptncuota" class="fechconsBusExci" type="text" name="" id="" placeholder="Cuota" value="'.$mostrarcbbselecvenfar['NCUOTA'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">%</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptnporcen" class="fechconsBusExci" type="text" name="" id="" placeholder="%e" value="'.$mostrarcbbselecvenfar['NPORCEN'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">Total Clientes</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptntotcli" class="fechconsBusExci" type="text" name="" id="" placeholder="T. Clientes" value="'.$mostrarcbbselecvenfar['NTOTCLI'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">Cobertura</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptncobert" class="fechconsBusExci" type="text" name="" id="" placeholder="Cobertura" value="'.$mostrarcbbselecvenfar['NCOBERT'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">Cobrado</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptncobrad" class="fechconsBusExci" type="text" name="" id="" placeholder="Cobrado" value="'.$mostrarcbbselecvenfar['NCOBRAD'].'">
        </div>
    </div>

    <div class="iteCon">
        <label class="titCon" for="">Total por Cobrar</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptntipcob" class="fechconsBusExci" type="text" name="" id="" placeholder="T. por Cobrar" value="'.$mostrarcbbselecvenfar['NTIPCOB'].'">
        </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">Morosidad</label>
        <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnmorosi" class="fechconsBusExci" type="text" name="" id="" placeholder="Morosidad" value="'.$mostrarcbbselecvenfar['NMOROSI'].'">
    </div>
    </div>
    <div class="iteCon">
        <label class="titCon" for="">Moroso</label>
        <div class="contInpufc">
            <i class="iconInpufc icon-coin-dollar"></i>
            <input id="iptnmoroso" class="fechconsBusExci" type="text" name="" id="" placeholder="Moroso" value="'.$mostrarcbbselecvenfar['NMOROSO'].'">
        </div>
    </div>
';
?>