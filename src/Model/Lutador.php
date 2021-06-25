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

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function setModified(DateTime $modified)
    {
        $this->modified = $modified;
    }

    public function setDeleted(DateTime $deleted)
    {
       $this->deleted = $deleted;
    }
}

?>