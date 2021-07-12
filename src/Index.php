<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP no html</title>
</head>
<body>
    <?php 
        require_once __DIR__ . '/PdoSetup.php';
        $dadosPaginacao = $CrudLutador->paginacaoLutadores();
        $qtdPorPagina = $dadosPaginacao['QtdPorPagina'];
        $totalPaginas = $dadosPaginacao['Paginas'];
        $offset = $dadosPaginacao['Offset'];
        $lutadores = $CrudLutador->getLutadoresComLimit($offset, $qtdPorPagina);                
    ?>
    <table>
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lutadores as $lutador): ?>
            <tr>
                <th scope="row"><?php echo $lutador['id']; ?></th>
                <td><?php echo $lutador['nome']; ?></td>
                <td><?php echo $lutador['data_nascimento']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <ul>
        <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
            <li>
                <a href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
            </li>
        <?php } ?>
    </ul>

</html>