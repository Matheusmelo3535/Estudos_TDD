<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Infra\ConnectionCreator;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;
use Estudos_TDD\Repository\PdoLutadorRepository;


$Conn = ConnectionCreator::createConnection();
$pdo = new PdoLutadorRepository($Conn);
$crudLutador = new CrudLutador($pdo);
$est = new EstatisticasLutador(null, 45, 6, '5');
$lutador = new Lutador(null, 'NAO TO', new DateTime());
$lutador->setEstatisticas($est);
// $pdo->insert($lutador);


var_dump($crudLutador->addLutador($lutador));











// try {
// $pdo = ConnectionCreator::createConnection();
// $LutadorRepository = new PdoLutadorRepository($pdo);
// print_r($LutadorRepository->listall());
// $pdo->beginTransaction();

// $est = new EstatisticasLutador(null, '300', '0', '2');
// $date = new DateTime('1990-10-10');
// $lutador = new Lutador(null, 'Matheus fera de bauru', $date);
// $lutador->setEstatisticas($est);

// $LutadorRepository ->save($lutador);
// $pdo->commit();

// } catch(PDOException $e) {
//     echo $e->getMessage();
//     $pdo->rollBack();
// }



?>