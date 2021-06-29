<?php


require __DIR__.'/../../vendor/autoload.php';

use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

$e = new EstatisticasLutador('100', '0', 'C');
$l = new Lutador('Matheuszera', $e);
$c = new CrudLutador();
$c->addLutador($l);

$teste = ['Oi','aa'];


function retornaTestinho($teste)
{
    $found = null;
    foreach($teste as $testinho)
    {
        if ($testinho == 'Tchau') {
            $found = $testinho;
        }
    }
    return $found;
}

$retornoEsperado = retornaTestinho($teste);
//if(!isset($retornoEspero))
var_dump($retornoEsperado);

?>