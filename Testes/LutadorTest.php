<?php

namespace Estudos_TDD\Testes;

use PHPUnit\Framework\TestCase;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

class LutadorTest extends TestCase
{
    private CrudLutador $crud;

    public function setUp(): void
    {
        $this->crud = new CrudLutador();
    }

    public function tearDown(): void
    {
        unset($this->crud);
    }

    /**
     * @dataProvider lutadorValidoProvider
     */
    public function testChecarInstanciaLutador(Lutador $lutador)
    {
        $this->assertEquals(true, $lutador instanceof Lutador);
    }

    /**
     * @dataProvider lutadorValidoProvider
     */
    public function testAdicionarLutadorComOsDadosValidos(Lutador $lutador)
    {

        $this->assertEquals(true, $this->crud->addLutador($lutador));
        $this->assertEquals('Matheuszera', $lutador->getNome());
    }

    /**
     * @dataProvider lutadorNomeInvalidoProvider
     */
    public function testDeveRetornarFalseLutadorComNomeInvalido(Lutador $lutador)
    {
        $this->assertEquals(false, $this->crud->addLutador($lutador));
    }


    






    public function lutadorValidoProvider()
    {
        $nome = 'Matheuszera';
        $vitorias = '100';
        $derrotas = '0';
        $rank = 'C';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_Válido' => [$lutador]
        ];
    }

    public function lutadorNomeInvalidoProvider()
    {
        $nome = 'M';
        $vitorias = '10';
        $derrotas = '1';
        $rank = '9';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_Inválido' => [$lutador]
        ];
    }
    
}






?>