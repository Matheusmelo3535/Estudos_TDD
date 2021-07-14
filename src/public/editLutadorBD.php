<?php
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\EstatisticasLutador;

require_once __DIR__ . '../../../vendor/autoload.php';
require_once __DIR__ . '../../PdoSetup.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $data_nasc = new DateTime($_POST["data_nasc"]);
    $rank = $_POST["ranking"];
    $vitorias = $_POST["vitorias"];
    $derrotas = $_POST["derrotas"];
    $id = $_POST['idDoLutador'];
    $lutador = new Lutador($id, $nome, $data_nasc);
    $estatisticas = new EstatisticasLutador(null, $vitorias, $derrotas, $rank);
    $lutador->setEstatisticas($estatisticas);
    var_dump($addNoBanco = $CrudLutador->editLutador($lutador));
    print_r($lutador);
}
?>