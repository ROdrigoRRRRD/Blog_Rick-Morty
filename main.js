var tarjeta = document.querySelectorAll(".characters_card");
let info = document.querySelectorAll(".characters_Inf");


var tamaño_Tarjetas = tarjeta.length;
var tamaño_Info = info.length;

for(var i = 0; i < tamaño_Tarjetas; i++){
    tarjeta[i].addEventListener('click', evento =>{
        info[i].style.display = 'inline';
    })
}