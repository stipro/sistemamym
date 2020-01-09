$(document).ready(function(){
    //click en boton REGISTRAR (EXCEL)
    $('#btnAchivossubir').click(function()
    {
        $.ajax({
            //indico el url donde se enviara los datos
            url: './../pdo/mostrarArchivos.php',
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
});