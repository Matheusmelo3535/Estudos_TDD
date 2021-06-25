<?php

namespace Estudos_TDD\Model;
use DateTime;
use DateTimeZone;

class CrudLutador
{
    public function validaNome(string $nomeLutador) 
    {
        return isset($nomeLutador) && strlen(trim($nomeLutador)) > 5;
    }
    
    public function validaVitorias(string $vitoriasLutador)
    {
        return isset($vitoriasLutador) && $vitoriasLutador > 0;
    }
    
    public function validaDerrotas(string $derrotasLutador)
    {
        return isset($derrotasLutador) && $derrotasLutador >= 0;
    }
    
    public function validaRanking(string $rank)
    {
        return in_array(strtoupper($rank), Lutador::rankingsValidos);
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
        }
        return $validacao; 
    }
}
?>