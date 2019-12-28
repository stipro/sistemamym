$('#ckxvistExcel').click(function()
{
    comprueba();
    //checkbox.addEventListener("change", comprueba, false);
    
    /*
      function on(){
        console.log("Hemos pulsado en on");
      }
      
      function off(){
        console.log("Hemos pulsado en off");
      }*/
});
var checkbox = document.getElementById('ckxvistExcel');
function comprueba()
{
  if(checkbox.checked){
    BindTable(jsontabla, '#exceltable');
    $('#exceltable').show();
  }else{
    $("#exceltable").empty();
  }
}