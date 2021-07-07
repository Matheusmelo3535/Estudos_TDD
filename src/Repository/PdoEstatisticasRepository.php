<?php

namespace Estudos_TDD\Repository;


use Estudos_TDD\Model\EstatisticasLutador;
use PDO;

class PdoEstatisticasRepository implements IEstatisticasRepository
{

    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao = $conexao;
    }
    public function save(EstatisticasLutador $estatisticas, int $idLutador):bool
    {
        if ($estatisticas->getId() === null)
        {
            return $this->insert($estatisticas, $idLutador);
        }
        
    }

    public function insert(EstatisticasLutador $estatisticas, int $idLutador): bool
    {
        $sqlInsert = 'INSERT INTO estatisticas (vitorias, derrotas, ranking, lutador_id) 
                      VALUES (:vitorias,:derrotas,:ranking, :lutador_id);';
        $stmt = $this->conexao->prepare($sqlInsert);
        $stmtRetorno = $stmt->execute([
            ':vitorias' => $estatisticas->getVitorias(),
            ':derrotas' => $estatisticas->getDerrotas(),
            ':ranking' => $estatisticas->getRank(),
            ':lutador_id' => $idLutador,
        ]);
        
        return $stmtRetorno;
    }

}


?>