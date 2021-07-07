<?php

namespace Estudos_TDD\Model;
use DateTime;
use DateTimeInterface;

class Lutador 
{
    public string $nome;
    private ?int $id; 
    private EstatisticasLutador $estatisticas;
    private DateTimeInterface $data_nascimento;
    private DateTimeInterface $created;
    private DateTimeInterface $modified;
    private DateTimeInterface $deleted;
    const rankingsValidos = ['C','1','2','3','4','5','6','7','8','9','10'];
    
    public function __construct(?int $id, string $nome, DateTimeInterface $data_nascimento)
    {
        $this->nome = $nome;
        $this->id = $id;
        $this->data_nascimento = $data_nascimento;
    }
    
    public function getEstatisticas()
    {
        return $this->estatisticas;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getDataNasc()
    {
        return $this->data_nascimento;
    }
    
    public function setEstatisticas(EstatisticasLutador $estatisticas)
    {
        $this->estatisticas = $estatisticas;
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
    
    public function setDataNasc(DateTime $data_nasc)
    {
        $this->data_nascimento = $data_nasc;
    }
}

?>