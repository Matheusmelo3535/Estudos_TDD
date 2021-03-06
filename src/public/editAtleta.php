<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="imagem/png" href="../assets/images/ufc_logo.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&family=Vollkorn&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/Icons/css/all.css">
    <title>Editar Atleta |UFC</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 shadow">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../assets/images/ufc_logo.png" alt="" class="d-inline-block align-text-top ufc-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active header-links" aria-current="page" href="#">Rankings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link header-links" href="#">Notícias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link header-links" href="#">Eventos</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        </div>
        <div class="container form-background mb-5 mt-5">
            <div class="row mb-5">
                <div class="col text-center">
                    <h1>Editar Atleta</h1>
                </div>
            </div>
            <form class="form-add-atleta" action="editLutadorBD.php" method="POST" id = "formEditAtleta">
                <div class="container">
                    <?php 
                        require_once __DIR__ . '../../PdoSetup.php';
                        $id = $_GET['idEdit'];
                        $atletaEdit = $CrudLutador->getById($id);
                    ?>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 mb-3">
                            <label for="AtletaFormNome">Nome</label>
                            <input type="text" class="form-control borda-redonda" id="AtletaFormNome" name="nome" 
                            value="<?= $atletaEdit['nome'];?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="AtletaFormNome">Data de Nascimento</label>
                            <input type="date" class="form-control borda-redonda" id="AtletaFormDataNasc" name="data_nasc"
                            value="<?=$atletaEdit['data_nascimento'];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="AtletaFormRank">Rank</label>
                            <select class="form-select borda-redonda" aria-label="Escolha o Ranking" name="ranking">
                                <option selected value="<?= $atletaEdit["ranking"];?>"><?= $atletaEdit["ranking"];?></option>
                                <?php foreach ($rankingsDisponiveis as $rank): ?>
                                    <option value = <?=$rank?>><?=$rank?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="idDoLutador" id="hiddenField" value="<?= $atletaEdit["lutadorId"] ?>"/>
                    </div>
                    <div class="row d-flex justify-content-center mb-4">
                        <div class="col-md-2 mb-3">
                            <label for="AtletaFormVitorias">Vitórias</label>
                            <input type="number" class="form-control borda-redonda" id="AtletaformVitorias" name="vitorias"
                            value="<?= $atletaEdit['vitorias'];?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="AtletaformDerrotas">Derrotas</label>
                            <input type="number" class="form-control borda-redonda" id="AtletaformDerrotas" name="derrotas"
                            value="<?= $atletaEdit['derrotas'];?>">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-2 text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-lg borda-redonda add-atleta">Editar</button>
                        </div>
                        <div class="col-md-2 text-center mb-3">
                            <button type="button" class="btn btn-danger btn-lg borda-redonda cancel-atleta">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <p class="testando"></p>
    </main>
    <footer class="text-center">
        <div class="container p-3 d-flex justify-content-center align-items-center flex-column">
            <span>© 2021 Copyright UFC. Todos os direitos reservados.</span>
        </div>
    </footer>
    <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src='../assets/js/form.js'></script> -->

</body>

</html>