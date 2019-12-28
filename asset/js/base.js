/*
//LIMPIAR INPUTS
// Creamos variable que almacenara el ID a borrar
var inputfocused = "";

// Le añadimos función de borrar al botón
//Pones el ID del input
document.getElementById("btnlimp").onclick = limpiaCampo;

// En este caso concreto seleccionamos todos los input text y password
// para una selección más precisa se puede usa una clase
// para una selección más general, se puede usar solo 'input'
var elements = document.querySelectorAll("input[type='text'],input[type='password']");
// Por cada input field le añadimos una funcion 'onFocus'
for (var i = 0; i < elements.length; i++) {
  elements[i].addEventListener("focus", function() {
    // Guardamos la ID del elemento al que hacemos 'focus'
    inputfocused = this;
  });
}

function limpiaCampo() {
  //Utilizamos el elemento al que hacemos focus para borrar el campo.
  inputfocused.value = "";
}
*/
//INICIAR SESSIÓN
$('#btnlogi').click(function(){
  var ivusu = $('#logusu').val();
  var ivcla = $('#logcla').val();
  //console.log('usuario es : '+ivusu+' clave es: '+ivcla);
  var dusu = {
    "vusu" : ivusu,
    "vcla" : ivcla,};
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "./login.php",
    data: dusu,
    beforeSend: function () {
    $("#rpta").html("Procesando, espere por favor...");
    },
    success: function(data){
      /*
      console.log(data);
      pruebass=data.toString();
      console.log(pruebass);*/
      $('#rpta').html(data);
      
      if(data === 1){
        console.log("EmpName no está definido");
      } else {
        window.location.href = "./views/main.php";
      }
      //window.location.href = "https://www.bufa.es";
      //$('#rpta').html(data);
    }
  });
})

