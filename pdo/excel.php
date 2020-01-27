<?php
include('./../db/conexionPDO.php');
try
{
    //Fecha del Servidor
    $fecha = date("Y.m.d");
    //Fecha conbinada
    $fecusu= $_POST['ifecregusuxlsx'];
    //Nombre del archivo
    $vnomarch = $_POST['vnomarch'];
    //convertimos en json
    $tabla = json_decode($_POST['dataexArchivo'], true);
    //contamos cuanto es el tamaño del array o json
    $cantidadtabla = count($tabla);
    //Variable para los duplicados
    $duplicadosCol = 0;
    //Se separa el dia mes año
    list($frdanio, $frdmes, $frddia) = explode("-",$fecusu);
    $arrayvendedorid = [];
    //Se compara el nombre del archivo
    if($vnomarch == "AVANCEVENDEDOR")
    {
        //echo 'Archivo Admitido '.$vnomarch.' ';
        //echo $frdmes;
        //var_dump($tabla);
        $c=0;
        foreach ($tabla as $clave) 
        {
            $vendeDato = explode(" ", $clave["VENDEDOR"]);
            $venzon = trim($clave["ZONA"]);
            $ventipId = $clave["TIPO"];
            $arrayval = [];
            //var_dump($clave["VENDEDOR"]);
            $num=count($vendeDato);
            switch ($num)
            {          
            case 1:
                break;
            case 2:
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "PNombre" => $vendeDato[1]];
                $papellido = $vendeDato[0];
                $pnombre = $vendeDato[1];
                $c++;
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE a.VPNOCOL=:pnombre AND a.VAPACOL=:papellido");
                $existenteCol->bindValue(':papellido',$papellido);
                $existenteCol->bindValue(':pnombre',$pnombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                $zonasql = $resexistenteCol['NZON'];
                if ($resexistenteCol == FALSE){
                    //INSERTA COLABORADORES
                    $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VPNOCOL) VALUES (:papellido, :pnombre )");
                    $insertCol -> bindValue(':papellido', $papellido, PDO::PARAM_STR);
                    $insertCol -> bindValue(':pnombre', $pnombre, PDO::PARAM_STR);
                    $insertCol -> execute();
                    //OOBTENGO ID DE LA INSERTACIÓN
                    $lastcolIdsql = $conexion->lastInsertId();
                    //INSERTA VENDEDOR
                    $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                    $insertVen -> bindValue(':lastcolIdsql', $lastcolIdsql, PDO::PARAM_STR);
                    $insertVen -> bindValue(':ventipId', $ventipId, PDO::PARAM_STR);
                    $insertVen -> execute();
                    $lastvenIdsql = $conexion->lastInsertId();
                    array_push($arrayval,$lastvenIdsql,$venzon);
                    array_push($arrayvendedorid,$arrayval);
                    unset($arrayval);
                }
                if ($zonasql == null){
                    if($zonasql == $venzon){
                        echo 'Es igual el dato zona en EXCEL y MYSQL';
                    }
                    else{
                        //INSERTAR  ZONA
                        $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                        $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                        $insertZon -> execute();
                        $lastzonIdsql = $conexion->lastInsertId();
                        //UNION VENDEDOR CON ZONA
                        $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                        $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                        $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                        $insertVenZona -> execute();
                    }
                }
                break;
            case 3:                
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "SApellido" => $vendeDato[1], "PNombre" => $vendeDato[2]];
                $papellido = $vendeDato[0];
                $sapellido = $vendeDato[1];
                $pnombre = $vendeDato[2];
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE a.VPNOCOL = :pnombre AND a.VAPACOL = :papellido AND a.VAMACOL = :sapellido");
                $existenteCol->bindValue(':papellido',$papellido);
                $existenteCol->bindValue(':sapellido',$sapellido);
                $existenteCol->bindValue(':pnombre',$pnombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                $zonasql = $resexistenteCol['NZON'];
                if ($resexistenteCol == FALSE)
                {
                    //INSERTA COLABORADORES
                    $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VAMACOL, VPNOCOL) VALUES (:papellido, :sapellido, :pnombre)");
                    $insertCol -> bindValue(':papellido', $papellido, PDO::PARAM_STR);
                    $insertCol -> bindValue(':sapellido', $sapellido, PDO::PARAM_STR);
                    $insertCol -> bindValue(':pnombre', $pnombre, PDO::PARAM_STR);
                    $insertCol -> execute();
                    //OBTENGO ID DE LA INSERTACIÓN
                    $lastcolIdsql = $conexion->lastInsertId();
                    //INSERTA VENDEDOR
                    $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                    $insertVen -> bindValue(':lastcolIdsql', $lastcolIdsql, PDO::PARAM_STR);
                    $insertVen -> bindValue(':ventipId', $ventipId, PDO::PARAM_STR);
                    $insertVen -> execute();
                    $lastvenIdsql = $conexion->lastInsertId();
                    array_push($arrayval,$lastvenIdsql,$venzon);
                    array_push($arrayvendedorid,$arrayval);
                    unset($arrayval);
                }
                if ($zonasql == null){
                    if($zonasql == $venzon){
                        echo 'Es igual el dato zona en EXCEL y MYSQL';
                    }
                    else{
                        //INSERTAR  ZONA
                        $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                        $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                        $insertZon -> execute();
                        $lastzonIdsql = $conexion->lastInsertId();
                        //UNION VENDEDOR CON ZONA
                        $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                        $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                        $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                        $insertVenZona -> execute();
                    }
                }
                break;
            case 4:
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "SApellido" => $vendeDato[1], "PNombre" => $vendeDato[2], "SNombre" => $vendeDato[3]];
                $papellido = $vendeDato[0];
                $sapellido = $vendeDato[1];
                $pnombre = $vendeDato[2];
                $snombre = $vendeDato[3];
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NIDZON, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE a.VAPACOL = :papellido AND a.VAMACOL = :sapellido AND a.VPNOCOL = :pnombre AND a.VSNOCOL = :snombre");
                $existenteCol->bindValue(':papellido',$papellido);
                $existenteCol->bindValue(':sapellido',$sapellido);
                $existenteCol->bindValue(':pnombre',$pnombre);
                $existenteCol->bindValue(':snombre',$snombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                $zonasql = $resexistenteCol['NZON'];
                $idcolsql = $resexistenteCol['NIDCOL'];
                if ($resexistenteCol == FALSE){
                    //INSERTA COLABORADORES  
                    $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VAMACOL, VPNOCOL, VSNOCOL) VALUES (:papellido, :sapellido, :pnombre, :snombre)");
                    $insertCol -> bindValue(':papellido', $papellido, PDO::PARAM_STR);
                    $insertCol -> bindValue(':sapellido', $sapellido, PDO::PARAM_STR);
                    $insertCol -> bindValue(':pnombre', $pnombre, PDO::PARAM_STR);
                    $insertCol -> bindValue(':snombre', $snombre, PDO::PARAM_STR);
                    $insertCol -> execute();
                    //OBTENGO ID DE LA INSERTACIÓN
                    $lastcolIdsql = $conexion->lastInsertId();
                    //INSERTA VENDEDOR
                    $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                    $insertVen -> bindValue(':lastcolIdsql', $lastcolIdsql, PDO::PARAM_STR);
                    $insertVen -> bindValue(':ventipId', $ventipId, PDO::PARAM_STR);
                    $insertVen -> execute();
                    $lastvenIdsql = $conexion->lastInsertId();
                    array_push($arrayval,$lastvenIdsql,$venzon);
                    array_push($arrayvendedorid,$arrayval);
                    unset($arrayval);    
                }
                echo 'Es igual el dato zona en EXCEL ('.$venzon.') y MYSQL('.$zonasql.') </br>';
                    if($zonasql == $venzon){
                        echo 'Son iguales';
                    }
                    else{
                        echo ' id Colaborador es '.$idcolsql.'!!! y ZONA'.$zonasql.'</br>';
                        var_dump($idcolsql);
                        //INSERTAR  ZONA
                        $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                        $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                        $insertZon -> execute();
                        $lastzonIdsql = $conexion->lastInsertId();
                        //UNION VENDEDOR CON ZONA
                        $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                        $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                        $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                        $insertVenZona -> execute();
                    }
                break;
            case 5:
                //echo "Hay muchas palabras, verifique ";
                break;
            }
        }
        //var_dump($arrayvendedorid);
        
        $fregavaven = $conexion->prepare("SELECT  DISTINCT DFECREG FROM t011avavendedor WHERE MONTH(DFECREG)=:frdmes");// OBTENER FECHA RE REGISTRO XLSX
        $fregavaven->bindValue(':frdmes',$frdmes);
        $fregavaven->execute();
        $dfregavaven = $fregavaven->fetch(PDO::FETCH_ASSOC);
        //var_dump($dfregavaven["DFECREG"]);
        //Comprobar si hay registro con el mes
        if(is_null($dfregavaven["DFECREG"]))
        {
            //Inserta dato del excel con su id del vendedor
            $impExcel = $conexion -> prepare("INSERT INTO t011avavendedor (FIDZON, NVENBRU, NNETCRE, NVENNET, NCUOTA, NPORCEN, NTOTCLI, NCOBERT, NCOBRAD, NTIPCOB, NMOROSI, NMOROSO, DFECREG) 
            VALUES (:selection_1,:selection_2,:selection_3,:selection_4,:selection_5,:selection_6,:selection_7,:selection_8,:selection_9,:selection_10,:selection_11,:selection_12,:selection_13)");
            foreach ($tabla as $k => $row)
            {
                //CONSULTA COLABORADOR PARA SACAR ID VENDEDOR
                $excevenzon =trim($row['ZONA']) ;
                $existenteVenId = $conexion->prepare("SELECT NIDZON FROM tzona WHERE NZON=:excevenzon");
                $existenteVenId->bindValue(':excevenzon',$excevenzon);
                $existenteVenId->execute();
                $resexistenteVenId = $existenteVenId->fetch();
                $zonIdsql = (int)$resexistenteVenId['NIDZON'];
                    if($zonIdsql == FALSE){
                        echo'no hay dato';
                    }
                    else{
                    //$venZonsql = $resexistenteVenId['NZONVEN'];
                    //$venZonsql = str_pad($resexistenteVenId['NZONVEN'], 3, "0", STR_PAD_LEFT);
                    /*
                    echo 'ZONA SQL: ';
                    var_dump($venZonsql);
                    echo '</br>';
                    echo 'Zona Excel: ';
                    var_dump($dosvenzon);
                    echo '</br>';
                    */

                    $impExcel -> bindParam(':selection_1', $zonIdsql, PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_2', $row["V.BRUTA"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_3', $row["N.CREDITO"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_4', $row["V.NETA"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_5', $row["CUOTA"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_6', $row["%"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_7', $row["T.CLIENTES"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_8', $row["COBERTURA"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_9', $row["COBRADO"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_10', $row["T.XCOBRAR"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_11', $row["MOROSIDAD(%)"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_12', $row["MOROSO"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_13', $fecusu, PDO::PARAM_STR);
                    $ejecutar = $impExcel -> execute();
                
                }
            }
        }
        else{
            echo '
            <div class="alerweb-erro">
                <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
                No se puede registrar, <strong class="letrimpo">ya hay registros con el Mes '.$frdmes.'</strong>, vuelva a intentarlo.
            </div>';
        }
    }
    elseif($vnomarch == "SALIDASCONDICIONVENTA")
    {
        echo 'Archivo Admitido '.$vnomarch;
        //var_dump($tabla);
        foreach ($tabla as $clave) 
        {
            $vendeDato = explode(" ", $clave["Vendedor"]);
            $venzon = $clave["Zona"];
            $ventipId = $clave["TIPO"];
            //var_dump($clave["VENDEDOR"]);
            $num=count($vendeDato);
            switch ($num)
            {          
            case 1:
                break;
            case 2:
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "PNombre" => $vendeDato[1]];
                $papellido = $vendeDato[0];
                $pnombre = $vendeDato[1];
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE a.VAPACOL=:papellido AND a.VPNOCOL=:pnombre");
                $existenteCol->bindParam(':papellido',$papellido);
                $existenteCol->bindParam(':pnombre',$pnombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                $zonasql = $resexistenteCol['NZON'];
            if ($resexistenteCol == FALSE)
            {
                //INSERTA COLABORADORES
                $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VPNOCOL) VALUES (:papellido, :pnombre )");
                $insertCol -> bindParam(':papellido', $papellido, PDO::PARAM_STR);
                $insertCol -> bindParam(':pnombre', $pnombre, PDO::PARAM_STR);
                $insertCol -> execute();
                //OOBTENGO ID DE LA INSERTACIÓN
                $lastcolIdsql = $conexion->lastInsertId();
                //INSERTA VENDEDOR
                $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                $insertVen -> bindParam(':lastcolIdsql', $lastcolIdsql, PDO::PARAM_STR);
                $insertVen -> bindParam(':ventipId', $ventipId, PDO::PARAM_STR);
                $insertVen -> execute();
            }
            if ($zonasql == null){
                if($zonasql == $venzon){
                    echo 'Es igual el dato zona en EXCEL y MYSQL';
                }
                else{
                    //INSERTAR  ZONA
                    $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                    $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                    //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                    //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                    $insertZon -> execute();
                    $lastzonIdsql = $conexion->lastInsertId();
                    //UNION VENDEDOR CON ZONA
                    $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                    $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                    $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                    $insertVenZona -> execute();
                }
            }
                break;
            case 3:
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "SApellido" => $vendeDato[1], "PNombre" => $vendeDato[2]];
                $papellido = $vendeDato[0];
                $sapellido = $vendeDato[1];
                $pnombre = $vendeDato[2];
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE VAPACOL=:papellido AND VAMACOL=:sapellido AND VPNOCOL=:pnombre");
                $existenteCol->bindParam(':papellido',$papellido);
                $existenteCol->bindParam(':sapellido',$sapellido);
                $existenteCol->bindParam(':pnombre',$pnombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                $zonasql = $resexistenteCol['NZON'];
            if ($resexistenteCol == FALSE)
            {
                //INSERTA COLABORADORES
                $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VAMACOL, VPNOCOL) VALUES (:papellido, :sapellido, :pnombre )");
                $insertCol -> bindParam(':papellido', $papellido, PDO::PARAM_STR);
                $insertCol -> bindParam(':sapellido', $sapellido, PDO::PARAM_STR);
                $insertCol -> bindParam(':pnombre', $pnombre, PDO::PARAM_STR);
                $insertCol -> execute();
                //OBTENGO ID DE LA INSERTACIÓN
                $lastcolIdsql = $conexion->lastInsertId();
                //INSERTA VENDEDOR
                $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                $insertVen -> bindParam(':lastcolIdsql', $lastcolIdsql, PDO::PARAM_STR);
                $insertVen -> bindParam(':ventipId', $ventipId, PDO::PARAM_STR);
                $insertVen -> execute();
            }
            if ($zonasql == null){
                if($zonasql == $venzon){
                    echo 'Es igual el dato zona en EXCEL y MYSQL';
                }
                else{
                    //INSERTAR  ZONA
                    $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                    $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                    //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                    //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                    $insertZon -> execute();
                    $lastzonIdsql = $conexion->lastInsertId();
                    //UNION VENDEDOR CON ZONA
                    $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                    $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                    $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                    $insertVenZona -> execute();
                }
            }
                break;
            case 4:
                $arrayvendedor[] = ["PApellido" => $vendeDato[0], "SApellido" => $vendeDato[1], "PNombre" => $vendeDato[2], "SNombre" => $vendeDato[3]];
                $papellido = $vendeDato[0];
                $sapellido = $vendeDato[1];
                $pnombre = $vendeDato[2];
                $snombre = $vendeDato[3];
                //CONSULTA COLABORADOR
                $existenteCol = $conexion->prepare("SELECT a.*, b.*, tvz.*, tz.NZON
                FROM t002col AS a 
                LEFT JOIN t00ven AS b
                ON a.NIDCOL = b.FIDCOL
                LEFT JOIN tven_zon AS tvz
                ON tvz.FIDVEN = b.NIDVEN
                LEFT JOIN tzona AS tz
                ON tz.NIDZON = tvz.FIDZON
                WHERE VAPACOL=:papellido AND VAMACOL=:sapellido AND VPNOCOL=:pnombre AND VSNOCOL=:snombre");
                $existenteCol->bindParam(':papellido',$papellido);
                $existenteCol->bindParam(':sapellido',$sapellido);
                $existenteCol->bindParam(':pnombre',$pnombre);
                $existenteCol->bindParam(':snombre',$snombre);
                $existenteCol->execute();
                $resexistenteCol = $existenteCol->fetch();
                if ($resexistenteCol == FALSE)
                {
                    //INSERTA COLABORADORES
                    $insertCol = $conexion->prepare("INSERT INTO t002col (VAPACOL, VAMACOL, VPNOCOL, VSNOCOL) VALUES (:papellido, :sapellido, :pnombre, :snombre)");
                    $insertCol -> bindParam(':papellido', $papellido, PDO::PARAM_STR);
                    $insertCol -> bindParam(':sapellido', $sapellido, PDO::PARAM_STR);
                    $insertCol -> bindParam(':pnombre', $pnombre, PDO::PARAM_STR);
                    $insertCol -> bindParam(':snombre', $snombre, PDO::PARAM_STR);
                    $insertCol -> execute();
                    //OBTENGO ID DE LA INSERTACIÓN
                    $lastcolIdsql = $conexion->lastInsertId();
                    //CONSULTA COLABORADOR PARA SACAR ID
                    //INSERTA VENDEDOR
                    $insertVen = $conexion->prepare("INSERT INTO t00ven (FIDCOL, FIDTIPVEN) VALUES (:lastcolIdsql, :ventipId)");
                    $insertVen -> bindParam(':venzon', $venzon, PDO::PARAM_STR);
                    $insertVen -> bindParam(':ventipId', $ventipId, PDO::PARAM_STR);
                    $insertVen -> execute();
                }
                if ($zonasql == null){
                    if($zonasql == $venzon){
                        echo 'Es igual el dato zona en EXCEL y MYSQL';
                    }
                    else{
                        //INSERTAR  ZONA
                        $insertZon = $conexion->prepare("INSERT INTO tzona (NZON) VALUES (:venzon)");
                        $insertZon -> bindValue(':venzon', $venzon, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':ndis', $ndis, PDO::PARAM_STR);
                        //$insertZon -> bindValue(':vnomzom', $vnomzom, PDO::PARAM_STR);
                        $insertZon -> execute();
                        $lastzonIdsql = $conexion->lastInsertId();
                        //UNION VENDEDOR CON ZONA
                        $insertVenZona = $conexion->prepare("INSERT INTO tven_zon (FIDVEN, FIDZON) VALUES (:lastvenIdsql, :lastzonIdsql )");
                        $insertVenZona -> bindValue(':lastvenIdsql', $lastvenIdsql, PDO::PARAM_STR);
                        $insertVenZona -> bindValue(':lastzonIdsql', $lastzonIdsql, PDO::PARAM_STR);
                        $insertVenZona -> execute();
                    }
                }
                break;
            case 5:
                //echo "Hay muchas palabras, verifique ";
                break;
            }
        }
        $fregavaven = $conexion->prepare("SELECT  DISTINCT DFECREG FROM t021salconventa WHERE MONTH(DFECREG)=:frdmes");// OBTENER FECHA RE REGISTRO XLSX
        $fregavaven->bindValue(':frdmes',$frdmes);
        $fregavaven->execute();
        $dfregavaven = $fregavaven->fetch(PDO::FETCH_ASSOC);
        if(is_null($dfregavaven["DFECREG"]))
        {
            echo'No hay registro con esta fecha, se procede a registrar';
            $impExcel = $conexion -> prepare("INSERT INTO t021salconventa (FIDVEN, NCENT, NCRE,  NLET, NTOT, DFECREG) VALUES (:selection_1,:selection_2,:selection_3,:selection_4,:selection_5,:fecusu)");     
            foreach ($tabla as $k => $row)
            {
                //CONSULTA COLABORADOR PARA SACAR ID VENDEDOR
                $excevenzon =trim($row['Zona']) ;
                $existenteVenId = $conexion->prepare("SELECT NIDZON FROM tzona WHERE NZON=:excevenzon");
                $existenteVenId->bindValue(':excevenzon',$excevenzon);
                $existenteVenId->execute();
                $resexistenteVenId = $existenteVenId->fetch();
                $zonIdsql = (int)$resexistenteVenId['NIDZON'];
                if($zonIdsql == FALSE){
                    echo'no hay dato';
                }
                else{
                    $impExcel -> bindParam(':selection_1', $zonIdsql, PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_2', $row["C/Entrega"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_3', $row["Credito"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_4', $row["Letra"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':selection_5', $row["Total"], PDO::PARAM_STR);
                    $impExcel -> bindParam(':fecusu', $fecusu, PDO::PARAM_STR);
                    $ejecutar = $impExcel -> execute();
                }
            }
        }
        else{
            echo ' 
            <div class="alerweb-erro">
                <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
                No se puede registrar, <strong class="letrimpo">ya hay registros con el Mes '.$frdmes.'</strong>, vuelva a intentarlo.
            </div>';
        }
    }
    elseif(empty($_POST['dataexArchivo']))
    {
        echo'Archivo No Seleccionado
        <div class="alerweb-erro">
            <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
            Archivo, <strong class="letrimpo"> No Selecciónado</strong>, vuelva a intentarlo.
        </div>';
    }
    else{
        echo '
        <div class="alerweb-erro">
            <a href="#" class="clos" data-dismiss="alert" aria-label="close">&times;</a>
            No se seleccionó, <strong class="letrimpo">archivo admitido</strong>, por favor verificar el nombre del archivo.
        </div>';
    }
} 
catch (PDOException $error) /// MENSAJE POR SI SURGE ALGÚN ERROR
{ 
print 'ERROR: '. $error->getMessage();
$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>ERROR AL REGISTRAR DATOS</strong></div>';
}
/*
if($ejecutar) // MENSAJE DE EXITO
{
 echo 'se registro correctamente excel';
}*/

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./../asset/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../asset/css/base.css">
        <link rel="stylesheet" href="../asset/css/tabla.css">
        <link rel="stylesheet" href="../asset/css/noti.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <script src="../asset/js/modal.js"></script>
    <script src="./../asset/js/baseJquery.js" type="text/javascript"></script>
</body>
</html>