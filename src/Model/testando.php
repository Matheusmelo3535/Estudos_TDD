<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

$e = new EstatisticasLutador('100', '0', 'C');
$l1 = new Lutador('Matheuszera', $e);
$l2 = new Lutador('Matheuszinho', $e);
$l3 = new Lutador('Bigalow', $e);
$c = new CrudLutador();
$c->addLutador($l1);
$c->addLutador($l2);
$c->addLutador($l3);
$novaEstatisticas = new EstatisticasLutador('10', '5', '1');


echo $c->editLutador('Bigalow', $novaEstatisticas);
$tabela = $c->getTabelaLutadores();





?>