    <div class="container border-bottom mt-5">
        <?php
        require_once __DIR__ . '/../PdoSetup.php';
        $idFromGet = $_GET['idView'];
        $lutador = $CrudLutador->getById($idFromGet);
        ?>
        <div class="row mb-5">
            <div class="col text-center">
                <h1>Conheça o Atleta</h1>
            </div>
        </div>
        <div class="row mb-5 justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="info-atleta-nome text-center d-flex flex-column view-do-atleta">
                    <h4>Nome</h4>
                    <h5><?= $lutador['nome']; ?></h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-atleta-rank text-center d-flex flex-column view-do-atleta">
                    <h4>Ranking</h4>
                    <h5><?= $lutador['ranking']; ?></h5>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 info-atleta-vitorias text-center d-flex flex-column view-do-atleta">
                <h4>Vitórias</h4>
                <h5><?= $lutador['vitorias']; ?></h5>
            </div>
            <div class="col-md-4 info-atleta-derrotas text-center d-flex flex-column view-do-atleta">
                <h4>Derrotas</h4>
                <h5><?= $lutador['derrotas']; ?></h5>
            </div>
        </div>
        <div class="col-md-2 text-center mb-3">
            <a href="index.php" type="button" class="btn btn-primary btn-lg borda-redonda cancel-atleta">Voltar</a>
        </div>
    </div>