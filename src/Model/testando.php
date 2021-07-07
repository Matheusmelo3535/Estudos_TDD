<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Infra\ConnectionCreator;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;
use Estudos_TDD\Repository\PdoLutadorRepository;

$est = new EstatisticasLutador('101', '0', 'C');

$date = new DateTime('2000-01-01');
$result = $date->format('Y-m-d H:i:s');
var_dump($result);
$lutador = new Lutador(null, 'Jorge', $result);
$lutador->setEstatisticas($est);


$pdo = ConnectionCreator::createConnection();

$LutadorRepository = new PdoLutadorRepository($pdo);

$testando = $LutadorRepository->insert($lutador);





?>