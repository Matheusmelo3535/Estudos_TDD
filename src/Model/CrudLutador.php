<?php

namespace Estudos_TDD\Model;
use DateTime;
use DateTimeZone;

class CrudLutador
{
    private array $TabelaLutadores = [];

    public function getTabelaLutadores()
    {
        return $this->TabelaLutadores;
    }
    
    public function validaNome(string $nomeLutador) 
    {
        return strlen(trim($nomeLutador)) > 5;
    }
    
    public function validaVitorias(string $vitoriasLutador)
    {
        return strlen(trim($vitoriasLutador)) > 0 && $vitoriasLutador > 0;
    }
    
    public function validaDerrotas(string $derrotasLutador)
    {
        return strlen(trim($derrotasLutador)) > 0 && $derrotasLutador >= 0;
    }
    
    public function validaRanking(string $rank)
    {
        return strlen(trim($rank)) > 0 && in_array(strtoupper($rank), Lutador::rankingsValidos);
    }

    public function validacaoAntesDeSalvar(Lutador $lutador)
    {
        $valido = true;
        $nome = $lutador->nome;
        $vitorias = $lutador->getEstatisticas()->getVitorias();
        $derrotas = $lutador->getEstatisticas()->getDerrotas();
        $rank = $lutador->getEstatisticas()->getRank();
        $validacao = [
            'nome' => $this->validaNome($nome),
            'vitorias' => $this->validaVitorias($vitorias),
            'derrotas' => $this->validaDerrotas($derrotas),
            'rank' => $this->validaRanking($rank)
        ];

        foreach ($validacao as $atributoLutador){
           if (!$atributoLutador){
                $valido = false;
                
           }
        }
        return $valido;
    }

    public function addLutador(Lutador $lutador)
    {
        $validacao = $this->validacaoAntesDeSalvar($lutador);
        if ($validacao){
            $dataCriacao = new DateTime('NOW');
            $dataCriacao->setTimezone(new DateTimeZone('America/Sao_Paulo'));
            $lutador->setCreated($dataCriacao);
            array_push($this->TabelaLutadores, $lutador);
        }
        return $validacao; 
    }
    
    public function buscaIndexLutadorPeloNome(string $nome, array $array)
    {
        return array_search($nome, array_column($array, 'nome'));
    }

    public function readLutador(string $nomeLutador)
    {
        $lutadorEncontado = '';
        $indexLutador = $this->buscaIndexLutadorPeloNome($nomeLutador, $this->TabelaLutadores);
        if ($indexLutador) {
            $lutadorEncontado = $this->TabelaLutadores[$indexLutador];
        }
        return $lutadorEncontado;
    }

    public function editLutador(string $nomeLutador, EstatisticasLutador $novosDados)
    {
        $editadoComExito = false;
        $buscaLutador = $this->readLutador($nomeLutador);
        if ($buscaLutador) {
            $validaDados = $this->validacaoAntesDeSalvar(new Lutador('Validacao', $novosDados));
            if ($validaDados) {
                $editadoComExito = true;
                $estatisticasEdit = $buscaLutador->getEstatisticas();
                $estatisticasEdit->setVitorias($novosDados->getVitorias());
                $estatisticasEdit->setDerrotas($novosDados->getDerrotas());
                $estatisticasEdit->setRank($novosDados->getRank());
            }
        }
        return $editadoComExito;
    }
    
    public function deleteLutador(string $nomeLutador)
    {
        $exlusaoComExito = false;
        $pegaIndexLutador = $this->buscaIndexLutadorPeloNome($nomeLutador, $this->TabelaLutadores);
        if ($pegaIndexLutador){
            unset($this->TabelaLutadores[$pegaIndexLutador]);
            $exlusaoComExito = true;
            
        }
        return $exlusaoComExito;
    }
}
?>