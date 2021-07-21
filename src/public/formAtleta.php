<div id= "formAtletaAdd">
    <div class="container form-background mb-5 mt-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h1>Adicione um novo Atleta</h1>
            </div>
        </div>
        <form class="form-add-atleta" action="addLutador.php" method="POST">
            <div class="container">
                <?php
                require_once __DIR__ . '../../PdoSetup.php';
                ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 mb-3">
                        <label for="AtletaFormNome">Nome</label>
                        <input type="text" class="form-control borda-redonda" id="AtletaFormNome" name="nome">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AtletaFormNome">Data de Nascimento</label>
                        <input type="date" class="form-control borda-redonda" id="AtletaFormDataNasc" name="data_nasc">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="AtletaFormRank">Rank</label>
                        <select class="form-select borda-redonda" aria-label="Escolha o Ranking" name="ranking">
                            <?php foreach ($rankingsDisponiveis as $rank) : ?>
                                <option value=<?= $rank ?>><?= $rank ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-4">
                    <div class="col-md-2 mb-3">
                        <label for="AtletaFormVitorias">Vitórias</label>
                        <input type="number" class="form-control borda-redonda" id="AtletaformVitorias" name="vitorias">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AtletaformDerrotas">Derrotas</label>
                        <input type="number" class="form-control borda-redonda" id="AtletaformDerrotas" name="derrotas">
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-2 text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-lg borda-redonda add-atleta">Adicionar</button>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <button type="button" class="btn btn-danger btn-lg borda-redonda cancel-atleta">Limpar</button>
                    </div>
                </div>
            </div>
            <ul id="validacaoAtleta"></ul>
        </form>
    </div>
</div>