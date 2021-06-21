<?php

namespace TDD\Rankings_TDD\Model;

class Lutador
{
    private string $nome;
    private string $vitorias;
    private string $derrotas;
    private string $ranking;
    
    
    // public function __construct($nome, $vitorias, $derrotas, $ranking)
    // {
    //     $this->nome = $nome;
    //     $this->$vitorias = $vitorias;
    //     $this->derrotas = $derrotas;
    //     $this->ranking = $ranking;
    // }
    
    public function getNome()
    {
        return $this->nome;
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
    
    public function addLutador($nome, $vitorias, $derrotas, $ranking)
    {
        if(is_string($nome) && strlen($nome) > 5) {
            $this->nome = $nome;
            $this->vitorias = $vitorias;
            $this->derrotas = $derrotas;
            $this->ranking = $ranking;
            return $this;
        }
    }
    
}




?>