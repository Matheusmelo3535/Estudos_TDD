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
    
    /**
     * @dataProvider lutadorProvider
     */
    public function testLutadorDeveSerEditadoCorretamente(Lutador $lutadorData)
    {
        $lutadorData->editLutador('Matheuszera', '30', '0', '1');
        
        self::assertEquals(date('d-m-Y', time()), $lutadorData->getModified());
        self::assertEquals('Matheuszera',$lutadorData->getNome());
    }

    /**
     * @dataProvider lutadorProviderUninitialized
     */
    public function testLutadorNaoPodeSerEditadoCasoObjetoEstejaVazio(Lutador $lutadorData)
    {
        $this->expectExceptionMessage('Dados inválidos');
        $lutadorData->editLutador('Matheuszera', '30', '0', '1');
        
        
    }

    /**
     * @dataProvider lutadorProvider
     */
    public function testLutadorDeveSerDeletadoCorretamente(Lutador $lutadorData)
    {
        $lutadorData->deleteLutador();

        self::assertEquals(true, $lutadorData->getDeleted());
    }

    /**
     * @dataProvider lutadorProviderUninitialized
     */
    public function testLutadorNaoDeveSerDeletadoCasoObjetoEstejaVazio(Lutador $lutadorData)
    {
        $this->expectExceptionMessage('Exclusão inválida!');
        $lutadorData->deleteLutador();
    }

    public function lutadorProvider()
    {
        $lutadorData = new Lutador();
        $lutadorData->addLutador('Robert Whittaker', '28', '4', 'C');
        return [
           'LutadorNormal' => [$lutadorData]
        ];
    }

    public function lutadorProviderUninitialized()
    {
        $lutadorData = new Lutador();
        return [
            'LutadorUninitialized' => [$lutadorData]
        ];
    }
    

    
}



?>