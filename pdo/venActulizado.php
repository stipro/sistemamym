<?php
    include('./../db/conexionPDO.php');
    $idven = $_POST['idven'];
    $nvenbru = $_POST['nvenbru'];
    $nnetcre = $_POST['nnetcre'];
    $nvennet = $_POST['nvennet'];
    $ncuota = $_POST['ncuota'];
    $nporcen = $_POST['nporcen'];
    $ntotcli = $_POST['ntotcli'];
    $ncobert = $_POST['ncobert'];
    $ncobrad = $_POST['ncobrad'];
    $ntipcob = $_POST['ntipcob'];
    $nmorosi = $_POST['nmorosi'];
    $nmoroso = $_POST['nmoroso'];

    $actualizarVen = $conexion->prepare("UPDATE t011avavendedor SET NVENBRU = :nvenbru, NNETCRE = :nnetcre, NVENNET = :nvennet, NCUOTA = :ncuota, NPORCEN = :nporcen, NTOTCLI = :ntotcli, NCOBERT = :ncobert, NCOBRAD = :ncobrad NTIPCOB = :ntipcob, NMOROSI = :nmorosi, NMOROSO = :nmoroso WHERE FIDVEN=:idven");
    $actualizarVen->bindParam(':nvenbru', $nvenbru, PDO::PARAM_STR);
    $actualizarVen->bindParam(':nnetcre', $nnetcre, PDO::PARAM_STR);
    $actualizarVen->bindParam(':nvennet', $nvennet, PDO::PARAM_STR);
    $actualizarVen->bindParam(':ncuota', $ncuota, PDO::PARAM_STR);
    $actualizarVen->bindParam(':nporcen', $nporcen, PDO::PARAM_STR);
    $actualizarVen->bindParam(':ntotcli', $ntotcli, PDO::PARAM_STR);
    $actualizarVen->bindParam(':ncobert', $ncobert, PDO::PARAM_STR);
    $actualizarVen->bindParam(':ncobrad', $ncobrad, PDO::PARAM_STR);
    $actualizarVen->bindParam(':ntipcob', $ntipcob, PDO::PARAM_STR);
    $actualizarVen->bindParam(':nmorosi', $nmorosi, PDO::PARAM_STR);
    $actualizarVen->bindParam(':nmoroso', $nmoroso, PDO::PARAM_STR);
    $actualizarVen->bindParam(':idven', $idven, PDO::PARAM_INT);
    $actualizarVen->execute();
?>