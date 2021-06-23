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
    
    public function getModified()
    {
        return $this->modified;
    }
    
    public function validaEstatisticaLutador($vitorias, $derrotas, $ranking)
    {
        $rankingsValidos = ['C','1','2','3','4','5','6','7','8','9','10'];
        if ((int)$vitorias > 0 && (int)$derrotas >= 0 && in_array($ranking, $rankingsValidos)) {
            return true;
        }
        return false;
    }
    
    public function validaNomeLutador($nome)
    {
        if (is_string(trim($nome)) && strlen(trim($nome)) > 5) {
            return true;
        }
        return false;
    }
    
    public function validacaoAntesDeSalvar($nome, $vitorias, $derrotas, $ranking)
    {
        if ($this->validaNomeLutador($nome) && $this->validaEstatisticaLutador($vitorias, $derrotas, $ranking)) {
            $this->nome = $nome;
            $this->vitorias = $vitorias;
            $this->derrotas = $derrotas;
            $this->ranking = $ranking;
            return true;
        }
        return false;
        
    }
    public function addLutador($nome, $vitorias, $derrotas, $ranking)
    {
        if ($this->validacaoAntesDeSalvar($nome, $vitorias, $derrotas, $ranking)) {
            $this->created = date('d-m-Y', time());
            return $this;
        }
        throw new Exception('Dados inválidos');
    }
    
    public function editLutador($nome, $vitorias, $derrotas, $ranking)
    {
        if ($this->validacaoAntesDeSalvar($nome, $vitorias, $derrotas, $ranking)) {
            $this->modified = date('d-m-Y', time());
            return $this;
        }
        throw new Exception('Não foi possível editar, dados inválidos');
        
    }
    
}




?>