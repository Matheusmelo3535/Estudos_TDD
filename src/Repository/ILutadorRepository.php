<?php

namespace Estudos_TDD\Repository;
use Estudos_TDD\Model\Lutador;

interface ILutadorRepository
{
    public function save(Lutador $lutador): bool;
    public function remove(Lutador $lutador): bool;
    public function listAll(): array;
    public function listById();
    
    
}

?>