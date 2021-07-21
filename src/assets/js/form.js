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
    let novoAtleta = {
        rank : $('select :selected'),
        nome : form.AtletaFormNome.value,
        vitorias : form.AtletaformVitorias.value,
        derrotas : form.AtletaformDerrotas.value,
        dataNasc : form.AtletaFormDataNasc.value,
    };
    return novoAtleta;
}

function validaNomeForm(nome) {
    return typeof nome === 'string' && nome.length > 5;
}

function validaVitoriasForm(vitorias) {
    return vitorias > 0;
}

function validaDerrotasForm(derrotas) {
    let derrotasInt = parseInt(derrotas);
    return  derrotasInt === 0 || derrotasInt > 0;
}

function validaDadosForm(atleta) {
    let erros = [];
    if (!validaNomeForm(atleta.nome)) {
        erros.push('Nome inválido');
    }
    if (!validaVitoriasForm(atleta.vitorias)) {
        erros.push('Vitórias inválidas');
    }
    if (!validaDerrotasForm(atleta.derrotas)) {
        erros.push('Derrotas inválidas');
    }
    return erros;
}

function exibeErros(erros) {
    var UlError = document.querySelector("#validacaoAtleta");
        erros.forEach(erro => {
            var LiError = document.createElement("li");
            LiError.textContent = erro;
            LiError.classList.add("form-atleta-invalido")
            UlError.appendChild(LiError);
        });

}


$(document).ajaxStop(function() {
    
    $('.cancel-atleta').click(function(e) {
        e.preventDefault();
        $('.form-add-atleta').trigger("reset");
    });
    
    // $('.form-add-atleta').submit(function(e) {
    //     e.preventDefault();
    //     e.stopImmediatePropagation();
    //     let validacao = validaDadosForm(getAtletaFromForm(this));
    //     console.log(validacao);
    //     if (validacao) {
    //         $.ajax({
    //             type: "POST",
    //             url: 'addLutador.php',
    //             data: $(this).serialize(),
    //             success: function(response)
    //             {
    //                 let jsonDados = JSON.parse(response);
                    
    //                 if(jsonDados.success == 'Ok')
    //                 {
    //                     $('#contentAjax').load('tabela.php');
    //                 }
    //                 else {
    //                     alert('Não foi possível adicionar.');
    //                 }
    //             }
    //         });
    //     }
    //     else {
    //         alert('Não envie campos em branco.');
    //     }
    // })
});


$(function() {
    
    $('.add-atleta-link').click(function(e) {
        e.preventDefault();
        $('#contentAjax').load('formAtleta.php');
    });
    
})


//event delegation para elementos criados dinamicamente, caso contratrario não irá funcionar.
$(document).on("submit", '.form-add-atleta', function(e) { 
        e.preventDefault();
        // e.stopImmediatePropagation();
        let validacao = validaDadosForm(getAtletaFromForm(this));
        console.log(validacao);
        if (validacao.length == 0) {
            $.ajax({
                type: "POST",
                url: 'addLutador.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    let jsonDados = JSON.parse(response);
                    
                    if(jsonDados.success == 'Ok')
                    {
                        $('#contentAjax').load('tabela.php');
                    }
                    else {
                        alert('Não foi possível adicionar.');
                    }
                }
            });
        }
        else {
            exibeErros(validacao);
        }
});

$(document).on("click", '#viewLutador', function(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'viewAtleta.php',
        data: {
            idView: this.dataset.id
        },
        success: function(response) {
           console.log(this);
            
        }
        
    });
});


