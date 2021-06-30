<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

$e = new EstatisticasLutador('100', '0', 'C');
$l = new Lutador('Matheuszera', $e);
$c = new CrudLutador();
$c->addLutador($l);
$l2 = new Lutador('Matheuszera2', $e);
$c->addLutador($l2);





?>