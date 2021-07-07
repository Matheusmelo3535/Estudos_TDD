<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Infra\ConnectionCreator;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;
use Estudos_TDD\Repository\PdoLutadorRepository;

$est = new EstatisticasLutador(7, '49', '3', '7');

$date = new DateTime('1995-01-03');


$lutador = new Lutador(7, 'Atleta novo alterado', $date);
$lutador->setEstatisticas($est);


$pdo = ConnectionCreator::createConnection();

$LutadorRepository = new PdoLutadorRepository($pdo);
$LutadorRepository ->remove($lutador);






?>