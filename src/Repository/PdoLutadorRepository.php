<?php

namespace Estudos_TDD\Repository;


use Estudos_TDD\Model\Lutador;
use PDO;
use DateTime;
use Estudos_TDD\Repository\PdoEstatisticasRepository;
use Estudos_TDD\Model\EstatisticasLutador;
use PDOStatement;

class PdoLutadorRepository implements ILutadorRepository
{
    private PDO $conexao;
    
    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }
    public function save(Lutador $lutador): bool
    {
        if ($lutador->getId() === null) {
            return $this->insert($lutador);
        }
        return $this->update($lutador);
    }
    
    public function listAll(): array
    {
        $array = [];
        $stmt = $this->conexao->query('SELECT * FROM Lutadores l INNER JOIN Estatisticas e ON l.id = e.lutador_id');
        return $array;
    }

    public function hydrateLutadorList(PDOStatement $stmt) : array
    {
        return $lutadorDados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        // foreach ($lutadorDados as $lutadorDado) {
        //     $lutador = new Lutador(
        //         $lutadorDado['id'],
        //         $lutadorDado['nome'],
        //         $lutadorDado['data_nascimento'],
        //     );
        //     $estatisticas = new EstatisticasLutador(
        //         $lutadorDado['']
        //     );

        // }
    }
    
    public function listById()
    {
        return 'oi';
    }
    
    public function remove(Lutador $lutador): bool
    {
        $stmt = $this->conexao->prepare('DELETE FROM lutadores WHERE id = :id');
        $stmtRetorno = $stmt->execute([
            ':id' => $lutador->getId(),
        ]);
        
        return $stmtRetorno;

    }
    
    public function insert(Lutador $lutador): bool
    {
        $sqlInsert = 'INSERT INTO Lutadores (nome, data_nascimento, created) 
                      VALUES (:nome, :data_nascimento, :created);';
                      
        $stmt = $this->conexao->prepare($sqlInsert);
        $dateTimeAtual = new DateTime();
        $dta_formatado = $dateTimeAtual->format('Y-m-d');
        $data_nasc_formatada = $lutador->getDataNasc()->format('Y-m-d H:i:s');
        $stmtRetorno = $stmt->execute([
            ':nome' => $lutador->nome,
            ':data_nascimento' => $data_nasc_formatada,
            ':created' => $dta_formatado,
        ]);
        
        $lastId = $this->conexao->lastInsertId();
        $estatisticas = $lutador->getEstatisticas();
        $estatisticasPdoRep = new PdoEstatisticasRepository($this->conexao);
        $estatisticasPdoRep->save($estatisticas, $lastId);

        return $stmtRetorno;
    }
    
    public function update(Lutador $lutador): bool
    {
        $sqlUpdate = 'UPDATE Lutadores l, Estatisticas e 
                      SET l.nome = :nome, l.data_nascimento = :data_nascimento, l.modified = :modified,
                          e.vitorias = :vitorias, e.derrotas = :derrotas, e.ranking = :ranking
                      WHERE l.id = e.lutador_id AND l.id = :id;';

        $stmt = $this->conexao->prepare($sqlUpdate);
        $dateTimeAtual = new DateTime();
        $dta_formatado = $dateTimeAtual->format('Y-m-d');
        $data_nasc_formatada = $lutador->getDataNasc()->format('Y-m-d H:i:s');
        $stmtRetorno = $stmt->execute([
            ':nome' => $lutador->nome,
            ':data_nascimento' => $data_nasc_formatada,
            ':modified' => $dta_formatado,
            ':vitorias' => $lutador->getEstatisticas()->getVitorias(),
            ':derrotas' => $lutador->getEstatisticas()->getDerrotas(),
            ':ranking' => $lutador->getEstatisticas()->getRank(),
            ':id' => $lutador->getId(),
        ]);
        
        return $stmtRetorno;
    }
}


?>