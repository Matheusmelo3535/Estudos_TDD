let rankingsDisponiveis = [1, 2, 3, 4 ,5 ,6 ,7 ,8 ,9 ,10 ,11, 12, 13, 14, 15];
let selectFormAtleta = document.querySelector('.form-select');
let formAddAtleta = document.querySelector('.form-add-atleta');
// addOptions(selectFormAtleta);

// function addOptions(selectForm)
// {
//     for(i = 0; i < rankingsDisponiveis.length; i++){
//         let option = document.createElement('option');
//         option.textContent = rankingsDisponiveis[i];
//         selectForm.append(option);  
//     }
    
// }


function getAtletaFromForm(form) {
    let novoAtleta = [];
    let ranking = $('select :selected');
    let nome = form.AtletaFormNome.value;
    let vitorias = form.AtletaformVitorias.value;
    let derrotas = form.AtletaformDerrotas.value;
    let dataNasc = form.AtletaFormDataNasc.value;
    novoAtleta.push(ranking.text(), nome, vitorias, derrotas, dataNasc);
    console.log(novoAtleta);
    return novoAtleta;
}

function validaDadosForm(atleta) {
    valido = true;
    atleta.forEach(atributo => {
        if (!atributo) {
            valido = false;
        }
    });
    return valido;
}

$(function() {
    
    $('.cancel-atleta').click(function(e) {
        e.preventDefault();
        window.location.href = "index.php";
    });

    $('.form-add-atleta').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'addLutador.php',
            data: $(this).serialize(),
            success: function(response)
            {
                console.log(response);
                let jsonDados = JSON.parse(response);
                console.log(jsonDados);
                
                if(jsonDados.success == 'Ok')
                {
                    alert('CADASTROU COM EXITO');
                }
                else {
                    alert('NÃO DEU CERTO');
                }
            }
        });
        
    })

})


