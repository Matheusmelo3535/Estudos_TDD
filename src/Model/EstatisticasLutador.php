<?php

namespace Estudos_TDD\Model;

class EstatisticasLutador
{
    private ?int $id;
    private int $vitorias;
    private int $derrotas;
    private string $rank;

    public function __construct(?int $id, int $vitorias, int $derrotas, string $rank)
    {
        $this->id = $id;
        $this->vitorias = $vitorias;
        $this->derrotas = $derrotas;
        $this->rank = $rank;
    }

    public function getId()
    {
        return $this->id;
    }
    
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