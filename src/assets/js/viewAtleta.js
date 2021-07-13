$(document).ready(function(){
    let title = $('.title-atleta-nome');
    let nomeAtleta = $('.info-atleta-nome');
    let rankAtleta = $('.info-atleta-rank');
    let vitoriasAtleta = $('.info-atleta-vitorias');
    let derrotasAtleta = $('.info-atleta-derrotas'); 
    if(localStorage.getItem('lutadorview')){            
        let data = localStorage.getItem('lutadorview');
        let arraydata = data.split(',');
        title.append(arraydata[1]);
        nomeAtleta.append($("<h5>").append(arraydata[1]));
        rankAtleta.append($("<h5>").append(arraydata[0]));
        vitoriasAtleta.append($("<h5>").append(arraydata[2]));
        derrotasAtleta.append($("<h5>").append(arraydata[3]));
        
       
    }
});