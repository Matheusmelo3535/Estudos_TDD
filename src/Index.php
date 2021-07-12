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
        require_once __DIR__.  '/Model/testando.php'; 
        $stmt = $Conn->query('SELECT COUNT(*) FROM Lutadores');
        $porPagina = 5;
        $totalLutadores = $stmt->fetchColumn();
        $totalPaginas = ceil($totalLutadores / $porPagina);
        $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
        $prev = $page - 1;
        $next = $page + 1;
        $paginationStart = ($page - 1) * $porPagina;
        $lutadores = $Conn->query("SELECT * FROM Lutadores LIMIT $paginationStart, $porPagina")->fetchAll();
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
    <?php echo $page; ?>
</html>