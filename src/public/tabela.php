<div class="container mb-5" id = "tabelaRanking">
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
                                <a id="viewLutador" data-id =<?= $lutador['lutadorId']; ?> class="m-2 view btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="m-2 delete btn btn-danger" onClick="return confirm('Tem certeza que deseja excluir?')" 
                                href="deleteLutador.php?idDelete=<?= $lutador['lutadorId'];?>">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <a class="m-2 btn btn-success m-2 edit" href="editAtleta.php?idEdit=<?=$lutador['lutadorId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    </div>