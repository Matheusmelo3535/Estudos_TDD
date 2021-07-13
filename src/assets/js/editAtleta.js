$(function () {
    let formEdit = document.querySelector('.form-edit-atleta')
    if(localStorage.getItem('lutadorEdit')){
        let data = localStorage.getItem('lutadorEdit');
        let atletaEdit = data.split(',');
        let select = document.querySelector('.form-select');
        let option = document.createElement('option');
        option.textContent = atletaEdit[0];
        option.setAttribute('selected',true);
        select.append(option);
        let nomeInput = $('#AtletaFormNome');
        nomeInput.val(atletaEdit[1]);
        let vitoriaInput = $('#AtletaformVitorias');
        vitoriaInput.val(atletaEdit[2]);
        let derrotaInput = $('#AtletaformDerrotas');
        derrotaInput.val(atletaEdit[3]);
        

    }
    
    $('.alterar-atleta').click(function(e) {
        e.preventDefault();
        let atletaNovoEdit = getAtletaFromForm(formEdit);
        localStorage.setItem('atletaNovoEdit', atletaNovoEdit);
        alert('Atleta atualizado com êxito!');
        window.location.href = "index.html"

    });
});


