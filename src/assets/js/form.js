let rankingsDisponiveis = ['11', '12', '13', '14', '15'];
let selectFormAtleta = document.querySelector('.form-select');
let formAddAtleta = document.querySelector('.form-add-atleta');
addOptions(selectFormAtleta);

function addOptions(selectForm)
{
    for(i = 0; i < rankingsDisponiveis.length; i++){
        let option = document.createElement('option');
        option.textContent = rankingsDisponiveis[i];
        selectForm.append(option);  
    }
    
}


function getAtletaFromForm(form) {
    let novoAtleta = [];
    let ranking = $('select :selected');
    let nome = form.AtletaFormNome.value;
    let vitorias = form.AtletaformVitorias.value;
    let derrotas = form.AtletaformDerrotas.value;
    novoAtleta.push(ranking.text(), nome, vitorias, derrotas);
    console.log(novoAtleta);
    return novoAtleta;
}

$(function() {
    
    $('.cancel-atleta').click(function(e) {
        e.preventDefault();
        window.location.href = "index.html";
    });

    $('.add-atleta').click(function(e) {
        e.preventDefault();
        let atletaNovo = getAtletaFromForm(formAddAtleta);
        let rankOcupado = false;
        lutadores.forEach(lutador => {
            if(lutador[0] == atletaNovo[0]){
                alert('Este rank está ocupado!');
                rankOcupado = true;
            }
            
        });
        if(!rankOcupado) {
            localStorage.setItem('novoAtleta', atletaNovo);
            alert('Atleta Cadastrado com êxito');
        }
        
         
    })

})


