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
    <title>UFC Rankings | TOP 15</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 shadow">
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
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="../assets/images/ufc-banner.jpg" class="d-block w-100 img-carousel" alt="...">
                <div class="carousel-caption d-md-block">
                    <h1>Dobronx vs Chandler</h1>
                    <h2>UFC 262</h2>
                    <h3>Confira nesse sabádo 15/05 </h3>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="5000">
                <img src="../assets/images/ufc-venum.jpg" class="d-block w-100 img-carousel" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mb-5">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center p-4">
                    <h1 class="title">Ranking dos Atletas</h1>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex">
                    <a class="add-atleta-link  me-2" href="formAtleta.php"><i class="fas fa-plus"></i></a>
                    <span>Adicionar Atleta</span>
                </div>
            </div>
        </div>
        <div class="container table-responsive">
            <?php
                require_once __DIR__. '/../PdoSetup.php';
                $dadosPaginacao = $CrudLutador->paginacaoLutadores();
                $qtdPorPagina = $dadosPaginacao['QtdPorPagina'];
                $totalPaginas = $dadosPaginacao['Paginas'];
                $offset = $dadosPaginacao['Offset'];
                $lutadores = $CrudLutador->getLutadoresComLimit($offset, $qtdPorPagina);   
            ?>
            <table class="table align-middle">
                <thead class="table-dark align-middle">
                    <tr>
                        <th>Posição</th>
                        <th>Nome</th>
                        <th>Vitórias</th>
                        <th>Derrotas</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lutadores as $lutador): ?>
                        <tr>
                            <td><?= $lutador['ranking']?></td>
                            <td><?= $lutador['nome'] ?></td>
                            <td><?= $lutador['vitorias']?></td>
                            <td><?= $lutador['derrotas']?></td>
                            <td>
                                <a class="m-2 view" href="viewAtleta.php?idEdit=<?= $lutador['lutadorId']?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php for($i = 1; $i <= $totalPaginas; $i++ ): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    </div>
    <footer class="text-center">
        <div class="container p-3 d-flex justify-content-center align-items-center flex-column">
            <span>© 2021 Copyright UFC. Todos os direitos reservados.</span>
        </div>
    </footer>
    <!-- <script src="../assets/js/jquery-3.5.1.slim.min.js"></script> -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../assets/js/paginacao.js"></script> -->
</body>

</html>