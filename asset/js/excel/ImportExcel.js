var cont = 1;
var jsontabla;
var exArchivo1;
var exArchivo2;
var vnomarchext;
var rptaRegTipo;

//Traemos datos de tipo de vendedor con ajax
$.ajax({
    //indico el url donde se enviara los datos
    url: './../pdo/tipo.php',
    //indico el metodo de envio, puede ser GET ó Post
    success: function (rptaReg) {
        //rptaReg.forEach(element => console.log(element));
        //var obj = JSON.parse(text); 
        jsrptaRegTipo = JSON.parse(rptaReg);
        //console.log(rptaRegTipo[1]["tipo"]);
        //console.log(jsrptaRegTipo);
    },
    error: function () {
        alert("error");
    }
});
//Convierte Excel en JSON
function ImportExcel()
{
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
    //Checks whether the file is a valid excel file
    //Comprueba si el archivo es un archivo de excel válido
    if (regex.test($("#excelFileImport").val().toLowerCase()))
    {
        var xlsxflag = false; //Flag for checking whether excel is .xls format or .xlsx format
        //Marca para verificar si Excel es formato .xls o formato .xlsx
        if ($("#excelFileImport").val().toLowerCase().indexOf(".xlsx") > 0)
        {
            xlsxflag = true;
        }
        //Checks whether the browser supports HTML5
        //Comprueba si el navegador soporta HTML5
        if (typeof (FileReader) != "undefined")
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                var data = e.target.result;
                //Converts the excel data in to object
                //Convierte los datos de Excel en objeto
                if (xlsxflag) 
                {
                    var workbook = XLSX.read(data, { type: 'binary' }); 
                } 
                else
                {
                    var workbook = XLS.read(data, { type: 'binary' });
                }
                //Gets all the sheetnames of excel in to a variable
                //Obtiene todos los nombres de hoja de Excel en una variable
                var sheet_name_list = workbook.SheetNames;  
                var cnt = 0;//This is used for restricting the script to consider only first sheet of excel
                //Esto se usa para restringir la secuencia de comandos para considerar solo la primera hoja de Excel
                sheet_name_list.forEach(function (y) 
                { //Iterate through all sheets
                //Iterar a través de todas las hojas
                //Convert the cell value to Json
                //Convertir el valor de la celda a Json
                    if (xlsxflag) 
                    {  
                        var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
                        //console.log(exceljson);  
                    }
                    else 
                    {  
                        var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                    }  
                    if (exceljson.length > 0 && cnt == 0) 
                    {
                        //console.log(exceljson);
                        //BindTable(exceljson, '#exceltable');
                        //console.log(exceljson);   
                        cnt++;
                        jsontabla = exceljson;
                    }  
                });
                //Visualizo la tabla
                $('#exceltable').show();  
            }  
            if (xlsxflag) 
            {//If excel file is .xlsx extension than creates a Array Buffer from excel
                //Si el archivo excel es una extensión .xlsx que crea un Array Buffer desde excel
                reader.readAsArrayBuffer($("#excelFileImport")[0].files[0]);  
            }
            else
            {  
                reader.readAsBinaryString($("#excelFileImport")[0].files[0]);  
            }  
        }  
        else 
        {  
            alert("Sorry! Your browser does not support HTML5!");  
        }  
    }  
    else 
    {
        console.log("Please upload a valid Excel file");
    }
    
}
//Se ejecuta la funcion cuando haiga un cambio en el input
$("#excelFileImport").change(function(e){
    ImportExcel()
    $("#ckxvistExcel").removeAttr("disabled")

});
//vnomarch=document.getElementById('image1').files[0].name;
//console.log(vnomarch);
//selecciono el input con el id excelfile
document.getElementById('excelFileImport').onchange = function ()
{
    //imprimimos la direccion del archivos
    //console.log(this.value);
    //caputaramos y lo mostramos en el label
    
    vnomarchext = document.getElementById('excelFileImport').files[0].name;
    //console.log(vnomarchext);
    document.getElementById('fichero').innerHTML = document.getElementById('excelFileImport').files[0].name;
}
//Esto es la el cuerpo de la tabla
function BindTable(jsondata, tableid) {//Function used to convert the JSON array to Html Table
    //Función utilizada para convertir la matriz JSON a tabla Html  
     var columns = BindTableHeader(jsondata, tableid); //Gets all the column headings of Excel
     //Obtiene todos los encabezados de columna de Excel.
     cont = 1;
     var bodytable$ = $('<tbody/>').addClass( "tbe-body" );
     var opttip$;
     
     
    //console.log(objtipoven);
     for (var i = 0; i < jsondata.length; i++) {  
         var row$ = $('<tr/>').addClass( "group-tbe-body" );
         var cellValue;
         for (var colIndex = 0; colIndex < columns.length; colIndex++) {  
            cellValue = jsondata[i][columns[colIndex]];
            var tipselec$ = $('<select/>').addClass( "select"+i ).attr("id","idselect"+i);
            //console.log(cellValue);
            if (cellValue === "") {
                //console.log(rptaRegTipo);
                for (var c = 0; c < jsrptaRegTipo.length; c++) {
                    //console.log(jsrptaRegTipo[i]["tipo"]);
                    objtipoven = jsrptaRegTipo[c]["tipo"];
                    objidtipoven = jsrptaRegTipo[c]["id"];
                    tipselec$.append($('<option/>').attr("id","fila"+i).attr("value",objidtipoven).html(objtipoven));
                }
                //console.log(i);
                row$.append(tipselec$);
                //row$.append($('<select/>').html(cellValue));
            }
            else{
                row$.append($('<td/>').addClass( "tbe-body-ele body"+cont ).html(cellValue));
            }
            
         }
         //row$.append(tipselec$);
         bodytable$.append(row$);  
     }
     //console.log(bodytable$);
     $(tableid).append(bodytable$);
}
//esto es la cabezera de la tabla
function BindTableHeader(jsondata, tableid) {
    //Function used to get all column names from JSON and bind the html table header
    //Función utilizada para obtener todos los nombres de columna de JSON y enlazar el encabezado de la tabla html
    var columnSet = [];
    var thead$ = $('<thead/>').addClass( "tbe-heah" );
    var headerTr$ = $('<tr/>').addClass( "group-tbe-head" );
    cadena = "TIPO";
    for (var i = 0; i < jsondata.length; i++) {
        jsondata[i][cadena]  = "";
        var rowHash = jsondata[i];
        for (var key in rowHash) {
            if (rowHash.hasOwnProperty(key)) {
                if ($.inArray(key, columnSet) == -1) {
                    //Adding each unique column names to a variable array 
                    //Agregando los nombres de cada columna única a una matriz variable 
                    columnSet.push(key);
                    headerTr$.append($('<th/>').addClass( "tbe-heah-ele head-"+cont).html(key));
                    //console.log(key);
                    cont = cont+1;
                }  
            }
        }
    } 
    thead$.append(headerTr$)
    $(tableid).append(thead$);  
    return columnSet;  
}
//click en boton REGISTRAR (EXCEL)
$('#btnReg').click(function()
{
    if (jsontabla){
        console.log('No vacio');
            //Recorre array y agrega valor al objeto TIPO
        for(var i = 0; i < jsontabla.length; i++){
            //Hacemos contar la variable con el tamaño y guardamos en una variable
            var idrec="#idselect"+i;
            //usamos la variable para capturar cada un select y guardamos en una variable
            var idtip = $(idrec).val();
            //usamos la variable para guardar el array con objetos mientrar recorremos con la i
            jsontabla[i]["TIPO"] = idtip;
            
        }
        console.log(jsontabla);
        //Obtengo Fecha del usuario año mes dia y hora GTM automaticamente
        var d = new Date();
        //Obtengo solo el dia
        var dusu = d.getDate();
        //Concateno el dia usuario mas año y mes ingresado por usuario
        var ifecregusuxlsx = $('#iptfreg').val()+'-'+dusu;
        //Obtener nombre
        var vnomarch = vnomarchext.split(".")[0];
        //console.log(vnomarch);
        //var nomtip = $("#idselect1 option:selected").text()
        $.ajax({
            //indico el url donde se enviara los datos
            url: './../pdo/excel.php',
            //indico el metodo de envio, puede ser GET ó Post
            type: 'POST',
            //indico que no se va guardar ningun tipo de informacion
            cache:false,
            //indicamos el dato que se va enviar// JSON.stringify convierte en texto
            data: {'dataexArchivo': JSON.stringify(jsontabla),ifecregusuxlsx, vnomarch},
            //contentType: "application/json; charset=utf-8",
            //indicamos que ejecutara cuando este correc
            success: function (data) {
                $('#resp').html(data);
            },
            error: function () {
                alert("error");
            }
        });
    }
    else{
        console.log('Vacio');

    }

});
//Envio array de objetos por ajax
