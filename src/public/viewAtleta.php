<html lang="en">
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
    <title class="title-atleta-nome">UFC | </title>
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
    <div class="container border-bottom">
        <?php 
            require_once __DIR__. '/../PdoSetup.php';
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
                    <h5><?=$lutador['nome'];?></h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-atleta-rank text-center d-flex flex-column view-do-atleta">
                    <h4>Ranking</h4>
                    <h5><?=$lutador['ranking'];?></h5>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 info-atleta-vitorias text-center d-flex flex-column view-do-atleta">
                <h4>Vitórias</h4>
                <h5><?=$lutador['vitorias'];?></h5>
            </div>
            <div class="col-md-4 info-atleta-derrotas text-center d-flex flex-column view-do-atleta">
                <h4>Derrotas</h4>
                <h5><?=$lutador['derrotas'];?></h5>
            </div>
        </div>
        <div class="col-md-2 text-center mb-3">
            <a href="index.php" type="button" class="btn btn-primary btn-lg borda-redonda cancel-atleta">Voltar</a>
        </div>
    </div>
    <footer class="text-center">
        <div class="container p-3 d-flex justify-content-center align-items-center flex-column">
            <span>© 2021 Copyright UFC. Todos os direitos reservados.</span>
        </div>
    </footer>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>