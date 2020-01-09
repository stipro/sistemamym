$(document).ready(function(){
    //click en boton REGISTRAR (EXCEL)
    $('#btnregtipven').click(function()
    {
        console.log('Se preciono registrar');
        var strnomtipven = $('#iptnomtipven').val();

            //var nomtip = $("#idselect1 option:selected").text()
            $.ajax({
                //indico el url donde se enviara los datos
                url: './../pdo/regtipo.php',
                //indico el metodo de envio, puede ser GET ó Post
                type: 'POST',
                //indico que no se va guardar ningun tipo de informacion
                cache:false,
                //indicamos el dato que se va enviar// JSON.stringify convierte en texto
                data: {strnomtipven},
                //contentType: "application/json; charset=utf-8",
                //indicamos que ejecutara cuando este correc
                success: function (data) {
                    $('#ajaxrestipven').html(data);
                },
                error: function () {
                    alert("error");
                }
            });
    });
    //BOTONES INFERIORES
    $("#btnCan").click(function () {
        //$("#exceltable").empty();
        $("#mdliteTipven").css("display", "none");
    })
    $('#mdliagrTipven').click(function(){
        $("#mdliteTipven").css("display", "block");
    });
    //Cerrar Modal
    $('#btncantipven').click(function(){
        $("#mdliteTipven").css("display", "none");
    });
    //Modal
    //click en boton REGISTRAR (EXCEL)
    $('#mdlVisImp').click(function()
    {
        //var nomtip = $("#idselect1 option:selected").text()
        $.ajax({
            //indico el url donde se enviara los datos
            url: './../pdo/mostrarArchivos.php',
            //indico el metodo de envio, puede ser GET ó Post
            type: 'POST',
            //indico que no se va guardar ningun tipo de informacion
            cache:false,
            //indicamos el dato que se va enviar// JSON.stringify convierte en texto
            data: {},
            //contentType: "application/json; charset=utf-8",
            //indicamos que ejecutara cuando este correc
            success: function (data) {
                $('#Modals').html(data);
                $("#MdlCtdrVSArchivos").css("display", "block");
            },
            error: function () {
                alert("error");
            }
        });       
    });
    //Cerrar Modal
    $('#btnVSAchivoscancelar').click(function(){
        console.log('Btn cancelar');
        $("#MdlCtdrVSArchivos").css("display", "none");
    });
    //Subir Archivos >> https://gist.github.com/umidjons/6173837
    $( '#btnsubirAhs' ).on( 'click', function ()
    {
        //Obtengo Fecha del usuario año mes dia y hora GTM automaticamente
        var d = new Date();
        //Obtengo solo el dia
        var dusu = d.getDate();
        //Concateno el dia usuario mas año y mes ingresado por usuario
        var ifecregusuxlsx = $('#iptfreg').val()+'-'+dusu;
        var file = $( '#excelFileImport' ).get( 0 ).files[0],
        formData = new FormData();
        
        //partarchi.append( 'file', file );
        
        formData.append( 'file', file );
        formData.append( 'ifecregusuxlsx', ifecregusuxlsx );
        //formData.append( ifecregusuxlsx );
        console.log( formData );
        $.ajax( {
            url        : './../pdo/subirArchivos.php',
            type       : 'POST',
            contentType: false,
            cache      : false,
            processData: false,
            data       : formData,//formData,ifecregusuxlsx,
            xhr        : function ()
            {
                var jqXHR = null;
                if ( window.ActiveXObject )
                {
                    jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                }
                else
                {
                    jqXHR = new window.XMLHttpRequest();
                }
                //Upload progress
                jqXHR.upload.addEventListener( "progress", function ( evt )
                {
                        if ( evt.lengthComputable )
                        {
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with upload progress
                            console.log( 'Porcentaje Subida', percentComplete );
                            $("#pgssubirAhs").attr("value",percentComplete);
                        }
                    }, false );
                    //Download progress
                    jqXHR.addEventListener( "progress", function ( evt )
                    {
                        if ( evt.lengthComputable )
                        {
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                            //Do something with download progress
                            console.log( 'Porcentaje Descargada', percentComplete );
                        }
                    }, false );
                    return jqXHR;
                },
            success    : function ( data )
            {
                //Do something success-ish
                console.log( 'Completed.' );
            }
        } );
    } );
    ///
});
