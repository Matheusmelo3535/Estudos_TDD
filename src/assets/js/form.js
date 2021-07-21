let rankingsDisponiveis = [1, 2, 3, 4 ,5 ,6 ,7 ,8 ,9 ,10 ,11, 12, 13, 14, 15];
let selectFormAtleta = document.querySelector('.form-select');
let formAddAtleta = document.querySelector('.form-add-atleta');

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
    UlError.innerHTML = "";
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
                        bootbox.alert("Lutador ou rank já existentes.");
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
    let data = this.dataset.id;
    $('#contentAjax').load('viewAtleta.php?idView='+ data);
});


$(document).on("click", '#deleteLutador', function(e) {
    e.preventDefault();
    let data = this.dataset.id;
    bootbox.confirm("Tem certeza que deseja excluir esse Atleta?", function(result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: 'deleteLutador.php',
                data: {idDelete:data},
                success: function(response) {
                    let responseData = JSON.parse(response);
        
                    if (responseData.success === 'Ok') {
                        bootbox.alert('Exclusão realizada com êxito');
                        $('#contentAjax').load('tabela.php');
                    }
                    else{
                        bootbox.alert("Não foi possível excluir");
                    }
                }
            });
        }else{
            bootbox.alert('Não foi excluido');
        }
    });
})


