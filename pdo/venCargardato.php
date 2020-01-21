<?php
    include_once("../db/conexionPDO.php");
    $idven = $_POST['idven'];//Obtengo el vendedor
    $fechselenor = $_POST['fecha'];//Obtengo la fecha
    //echo ' Vendedor '.$vendsele;
    $fechsele = str_replace("-","",$fechselenor);
    //var_dump($fechsele);
    //echo 'Fecha: '.$fechsele;
    //$cbbselecvenfar = $conexion->prepare("SELECT zona, vendedor, v_bruta,  n_credito, v_neta, cuota, porcentaje, t_clientes, cobertura, cobrado, t_x_cobrar, morosidad, moroso, fecha FROM `comisiones_mym`.`avavendedor` WHERE `zona`=:vendesele AND date_format(`fecha`, '%Y%m')='201906'");
    $cbbselecvenfar = $conexion->prepare("SELECT b.*
    FROM t00ven a 
    INNER JOIN t011avavendedor b
    ON a.NIDVEN = b.FIDVEN
    WHERE b.FIDVEN = :idven AND DATE_FORMAT(b.DFECREG, '%Y%m')=:fechsele
    ");// OBTENER INFORMACIÓN DE USUARIO
    $cbbselecvenfar->bindParam(':idven', $idven, PDO::PARAM_STR);
    $cbbselecvenfar->bindParam(':fechsele', $fechsele, PDO::PARAM_STR);
    $cbbselecvenfar->execute();
    $mostrarcbbselecvenfar = $cbbselecvenfar->fetch(PDO::FETCH_ASSOC);
    echo '
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnvenbru" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NVENBRU'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnnetcre" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NNETCRE'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnvennet" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NVENNET'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptncuota" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NCUOTA'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnporcen" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NPORCEN'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptntotcli" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NTOTCLI'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptncobert" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NCOBERT'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptncobrad" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NCOBRAD'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptntipcob" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NTIPCOB'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnmorosi" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NMOROSI'].'">
    </div>
    <div class="contInpufc">
        <i class="iconInpufc icon-coin-dollar"></i>
        <input id="iptnmoroso" class="fechconsBusExci" type="text" name="" id="" placeholder="Ingrese nombre" value="'.$mostrarcbbselecvenfar['NMOROSO'].'">
    </div>
';
?>