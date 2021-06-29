<?php

namespace Estudos_TDD\Testes;

use PHPUnit\Framework\TestCase;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

//Arrange, Act, Assert

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
     * @dataProvider lutadorVitoriasInvalidasProvider
     * @dataProvider lutadorDerrotasInvalidasProvider
     * @dataProvider lutadorRankingInvalidoProvider
     */
    public function testDeveRetornarFalseLutadorComDadosInvalidos(Lutador $lutador)
    {
        $this->assertEquals(false, $this->crud->addLutador($lutador));
    }


    /**
     * @dataProvider valorLimiteNome5letrasProvider
     * @dataProvider valorLimiteZeroVitoriasProvider
     */
    public function testAnaliseDeValoresLimitesParaOsAtributosDoLutador(Lutador $lutador)
    {
        $this->assertEquals(false, $this->crud->addLutador($lutador));
    }

    /**
     * @dataProvider valorLimiteZeroDerrotasProvider
     */
    public function testAnaliseDeValorLimiteLutadorComZeroDerrotas(Lutador $lutador)
    {
        $this->assertEquals(true, $this->crud->addLutador($lutador));
    }

    /**
     * @dataProvider lutadorRankingCampeaoMinusculoProvider
     */
    public function testRankingLutadorCampeaoPassadoComLetraMinuscula(Lutador $lutador)
    {
        $this->assertEquals(true, $this->crud->addLutador($lutador));
    }

    /**
     * @dataProvider lutadorEmBrancoUninitialized
     */
    public function testLutadorVazioEmBranco(Lutador $lutador)
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
            'Lutador_NomeInválido' => [$lutador]
        ];
    }

    public function lutadorVitoriasInvalidasProvider()
    {
        $nome = 'Robert Whittaker';
        $vitorias = '-10';
        $derrotas = '1';
        $rank = '9';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_VitoriasInvalidas' => [$lutador]
        ];
    }

    public function lutadorDerrotasInvalidasProvider()
    {
        $nome = 'Robert Whittaker';
        $vitorias = '10';
        $derrotas = '-1';
        $rank = '9';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_DerrotasInvalidas' => [$lutador]
        ];
    }

    public function lutadorRankingInvalidoProvider()
    {
        $nome = 'Charles do Bronx';
        $vitorias = '10';
        $derrotas = '1';
        $rank = '15';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_RankInvalido' => [$lutador]
        ];
    }

    public function valorLimiteNome5letrasProvider()
    {
        $nome = 'Tobis';
        $vitorias = '10';
        $derrotas = '1';
        $rank = '6';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_Nome5Letras' => [$lutador]
        ];
    }

    public function valorLimiteZeroVitoriasProvider()
    {
        $nome = 'Jubileu Jones';
        $vitorias = '0';
        $derrotas = '1';
        $rank = '6';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_ZeroVitorias' => [$lutador]
        ];
    }

    public function valorLimiteZeroDerrotasProvider()
    {
        $nome = 'Neoni Jr';
        $vitorias = '30';
        $derrotas = '0';
        $rank = '1';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'Lutador_ZeroDerrotas' => [$lutador]
        ];
    }
    
    public function lutadorRankingCampeaoMinusculoProvider()
    {
        $nome = 'Toupeira Maluca';
        $vitorias = '3';
        $derrotas = '0';
        $rank = 'c';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'ranking_campeao_c_minusculo' => [$lutador]
        ];
    }

    public function lutadorEmBrancoUninitialized()
    {
        $nome = '';
        $vitorias = '';
        $derrotas = '';
        $rank = '';
        $estatisticas = new EstatisticasLutador($vitorias, $derrotas, $rank);
        $lutador = new Lutador($nome, $estatisticas);

        return [
            'LutadorVazio' => [$lutador]
        ];
    }
}

?>