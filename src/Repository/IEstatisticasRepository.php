<?php

namespace Estudos_TDD\Repository;

use Estudos_TDD\Model\EstatisticasLutador;


interface IEstatisticasRepository
{
    public function save(EstatisticasLutador $estatisticas, int $idLutador): bool;
    
}

?>