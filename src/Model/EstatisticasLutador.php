<?php
namespace TDD\Rankings_TDD\Model;

class EstatisticasLutador
{
    private string $vitorias;
    private string $derrotas;
    private string $rank;
    
    public function getVitorias()
    {
        return $this->vitorias;
    }
    
    public function getDerrotas()
    {
        return $this->derrotas;
    }
    
    public function getRank()
    {
        return $this->rank;
    }
    
    public function setVitorias(string $vitorias)
    {
        $this->vitorias = $vitorias;
    }
    
    public function setDerrotas(string $derrotas)
    {
        $this->derrotas = $derrotas;
    }
    
    public function setRank(string $rank)
    {
        $this->rank = $rank;
    }
}




?>