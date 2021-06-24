<?php

namespace Estudos_TDD\Testes;

use PHPUnit\Framework\TestCase;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

class LutadorTest extends TestCase
{
    public function testblablabal()
    {
        $est = new EstatisticasLutador('100', '0', 'C');
        $lutador = new Lutador('Matheus', $est);
        $crud = new CrudLutador();
        $crud->addLutador($lutador);

        $this->assertEquals(true, $crud->addLutador($lutador));

    }
    
}

?>