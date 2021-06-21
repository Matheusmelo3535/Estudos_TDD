<?php

namespace TDD\Rankings_TDD\Testes;

use PHPUnit\Framework\TestCase;
use TDD\Rankings_TDD\Model\Lutador;

class LutadorTest extends TestCase
{
    private $lutador;

    protected function setUp(): void
    {
        
        $this->lutador = new Lutador();
        
    }

    public function testDeveAdicionarUmLutadorComOsDadosValidos()
    {
        $this->lutador->addLutador('Matheus', '1', '0', '1');

        self::assertEquals('Matheus', $this->lutador->getNome());
        self::assertEquals(date('d-m-Y', time()), $this->lutador->getCreated());
    }

    
    public function testNaoDeveAdicionarLutadorComNomeInvalido()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('joj              ', '10', '2', '5');
    
    }

    public function testNaoDeveAdicionarLutadorComVitoriasInvalida()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('Jon Jones', '-29', '0','C');

    }

    public function testNaoDeveAdicionarLutadorComDerrotasInvalida()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('Bigalow', '30', '-5', '1');
    }

    


    
}



?>