<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Estudos_TDD\Infra\ConnectionCreator;
use Estudos_TDD\Model\CrudLutador;
use Estudos_TDD\Repository\PdoLutadorRepository;
use Estudos_TDD\Model\Lutador;

$connection = ConnectionCreator::createConnection();
$LutadorRepository = new PdoLutadorRepository($connection);
$CrudLutador = new CrudLutador($LutadorRepository);
$rankingsDisponiveis = Lutador::RAKINGSVALIDOS;

?>