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
        $this->lutador->addLutador('Matheus', '10', '0', '1');

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
    
    public function testNaoDeveAdicionarLutadorComAtributosNulos()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador(null, null, null, null);
    }
    
    public function testNaoDeveAdicionarLutadorComStringVazia()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('','','','');
    }

    public function testNaoDeveAdicionarLutadorComRankingInvalidoValorLimite11()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('Tobias Maluco', '50', '5', '11');
    }
    
    public function testNaoDeveAdicionarLutadorComRankingInvalidoValorLimite0()
    {
        $this->expectExceptionMessage('Dados inválidos');
        $this->lutador->addLutador('Tobias Maluco', '50', '5', '0');
    }
    
    public function testLutadorDeveSerEditadoCorretamente()
    {
        $this->lutador->addLutador('Jon Jones','29', '0', 'C');
        $this->lutador->editLutador('Matheuszera', '30', '0', '1');
        
        self::assertEquals('Matheuszera',$this->lutador->getNome());
        self::assertEquals(date('d-m-Y', time()), $this->lutador->getModified());
    }

    
}



?>