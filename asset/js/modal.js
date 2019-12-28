
/*function sliderButtonsClick(){
    document.getElementById('#mdliagrTipven').style.opacity=1;
}

document.getElementById('#resp').addEventListener("click", sliderButtonsClick);
*/
function cambiarClase(){
    let siteNav = document.getElementById('grupContBarra');
        siteNav.classList.toggle('grupContBarra-open');
}
    // MODAL IMPORTAR //
    let letmodaliteSubExci = document.getElementById('mdliteSubExci');
    let letmodalcontSubExci = document.getElementById('mdlconSubExci');
    let letabrirSubExc = document.getElementById('mdlSubExc');
    let letcerrarSubExc = document.getElementById('mdlcerSubExci');

    letabrirSubExc.addEventListener('click', function(){
        letmodaliteSubExci.style.display = 'block';
    });

    letcerrarSubExc.addEventListener('click', function(){
        letmodaliteSubExci.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == letmodalcontSubExci){
            letmodaliteSubExci.style.display = 'none';
        }
    });
/*
    // MODAL AGREGAR TIPO DE VENDEDOR //
    let letmodaliteTipven = document.getElementById('mdliteTipven');
    let letmodalcontTipven = document.getElementById('mdlconTipven');
    let letiagrTipven = document.getElementById('mdliagrTipven');
    let letcerrarTipven = document.getElementById('mdlceriTipven');

    letiagrTipven.addEventListener('click', function(){
        letmodaliteTipven.style.display = 'block';
    });

    letcerrarTipven.addEventListener('click', function(){
        letmodaliteTipven.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == letmodalcontTipven){
            letmodaliteTipven.style.display = 'none';
        }
    });*/
    /*
    // MODAL VISTA IMPRESIÓN //
    let letmodalitemVisImpi = document.getElementById('mdliteVisImpi');
    let letmodalcontVisImpi = document.getElementById('mdlconVisImpi');
    let letabrirVisImpi = document.getElementById('mdlVisImp');
    let letcerrarVisImpi = document.getElementById('mdlcerVisImpi');

    letabrirVisImpi.addEventListener('click', function(){
        letmodalitemVisImpi.style.display = 'block';
    });

    letcerrarVisImpi.addEventListener('click', function(){
        letmodalitemVisImpi.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == letmodalcontVisImpi){
            letmodalitemVisImpi.style.display = 'none';
        }
    });
    
    // MODAL VISTA ARCHIVOS //
    let letmodalitemVisArci = document.getElementById('mdliteVisArci');
    let letmodalcontVisArci = document.getElementById('mdlconVisArci');
    let letabrirVisArci = document.getElementById('mdlVisArch');
    let letcerrarVisArci = document.getElementById('mdlcerVisArci');
    
    letabrirVisArci.addEventListener('click', function(){
        letmodalitemVisArci.style.display = 'block';
    });
    letcerrarVisArci.addEventListener('click', function(){
        letmodalitemVisArci.style.display = 'none';
    });
    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == letmodalcontVisArci){
            letmodalitemVisArci.style.display = 'none';
        }
    });*/