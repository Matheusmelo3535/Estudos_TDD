<?php

namespace TDD\Rankings_TDD\Model;
use Exception;


class Lutador
{
    private string $nome;
    private string $vitorias;
    private string $derrotas;
    private string $ranking;
    private $created;
    private $modified;
    private $deleted = false;
    
    
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

    public function getCreated()
    {
        return $this->created;
    }

    
    public function addLutador($nome, $vitorias, $derrotas, $ranking)
    {
        //refatorar aqui, criar funções para validar
        $rankingsDisponiveis = ['C', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
        if(is_string(trim($nome)) && strlen(trim($nome)) > 5 && (int)$vitorias > 0 && (int)$derrotas >= 0 && in_array($rankingsDisponiveis, $ranking)) {
            $this->nome = $nome;
            $this->vitorias = $vitorias;
            $this->derrotas = $derrotas;
            $this->ranking = $ranking;
            $this->created = date('d-m-Y', time());
            return $this;
        }
        throw new Exception('Dados inválidos');
    }
    
}




?>