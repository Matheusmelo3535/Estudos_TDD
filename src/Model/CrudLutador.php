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
        $NaoestaNoRanking = true;
        if (sizeof($this->TabelaLutadores) > 0) {
            foreach ($this->TabelaLutadores as $lutador) {
                if ($lutador->getNome() === $nomeLutador) {
                    $NaoestaNoRanking = false;
                    break;
                }
            }
        }
        return strlen(trim($nomeLutador)) > 5 && $NaoestaNoRanking;
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
        $nome = $lutador->getNome();
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

    public function readLutador(Lutador $lutador)
    {
        $lutadorEncontrado = '';
        foreach ($this->TabelaLutadores as $entidadeLutador) {
            if ($entidadeLutador->getNome() == $lutador->getNome()) {
                $lutadorEncontrado = $lutador;
                break;
            }
        }
        return $lutadorEncontrado;
    }
}
?>