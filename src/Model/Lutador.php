<?php

namespace Estudos_TDD\Model;



use DateTime;


class Lutador 
{
    private string $nome;
    private EstatisticasLutador $estatisticas;
    private DateTime $created;
    private DateTime $modified;
    private DateTime $deleted;
    const rankingsValidos = ['C','1','2','3','4','5','6','7','8','9','10'];
    
    public function __construct(string $nome, EstatisticasLutador $estatisticas)
    {
        $this->nome = $nome;
        $this->estatisticas = $estatisticas;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getEstatisticas()
    {
        return $this->estatisticas;
    }
    
    public function getVitorias()
    {
        return $this->vitorias;
    }
    
    public function getDerrotas()
    {
        return $this->derrotas;
    }
    
    public function getRanking()
    {
        return $this->ranking;
    }

    public function getCreated()
    {
        return $this->created;
    }
    
    public function getModified()
    {
        return $this->modified;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }
    
}

?>