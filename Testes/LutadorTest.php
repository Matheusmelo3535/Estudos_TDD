<?php

namespace Estudos_TDD\Testes;

use PHPUnit\Framework\TestCase;
use Estudos_TDD\Model\EstatisticasLutador;
use Estudos_TDD\Model\Lutador;
use Estudos_TDD\Model\CrudLutador;

class LutadorTest extends TestCase
{
    /**
     * @dataProvider lutadorValidoProvider
     */
    public function testChecarInstanciaLutador(Lutador $lutador)
    {
        $this->assertEquals(true, $lutador instanceof Lutador);
    }

    public function testAdicionarLutadorComOsDadosValidos()
    {}









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
    
}






?>