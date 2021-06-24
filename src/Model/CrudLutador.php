<?php
namespace TDD\Rankings_TDD\Model;
use TDD\Rankings_TDD\Model\Lutador;

class CrudLutador
{
    public function validaNomeLutador(string $nomeLutador) 
    {
        return isset($nomeLutador) && strlen(trim($nomeLutador)) > 5;
    }
    
    public function validaVitoriasLutador(string $vitoriasLutador)
    {
        return isset($vitoriasLutador) && $vitoriasLutador > 0;
    }
    
    public function validaDerrotasLutador(string $derrotasLutador)
    {
        return isset($derrotasLutador) && $derrotasLutador >= 0;
    }
    
    public function validaRankingLutador(Lutador $lutador)
    {
        return $lutador->getEstatisticas()['ranking'];
    }
    
}

?>