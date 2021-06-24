<?php
namespace TDD\Rankings_TDD\Model;
use DateTime;
use Exception;
use TDD\Rankings_TDD\Model\EstatisticasLutador;

class Lutador 
{
    private string $nome;
    private EstatisticasLutador $estatisticas;
    private DateTime $created;
    private DateTime $modified;
    private DateTime $deleted;
    const rankingsValidos = ['C','1','2','3','4','5','6','7','8','9','10'];
    
    public function __construct(EstatisticasLutador $estatisticas)
    {
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
    
    public function validaEstatisticaLutador($vitorias, $derrotas, $ranking)
    {
        
        if ((int)$vitorias > 0 && (int)$derrotas >= 0 && in_array($ranking, self::rankingsValidos)) {
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
        
        if ($this->validacaoAntesDeSalvar($nome, $vitorias, $derrotas, $ranking) && isset($this->created)) {
            $this->modified = date('d-m-Y', time());
            return $this;
        }
        throw new Exception('Dados inválidos');
        
    }

    public function deleteLutador()
    {
        if (isset($this->created)) {
            $this->deleted = true;
            return;
        }
        throw new Exception('Exclusão inválida!');
    }
}