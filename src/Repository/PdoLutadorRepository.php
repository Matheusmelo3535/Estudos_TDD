<?php

namespace Estudos_TDD\Repository;


use Estudos_TDD\Model\Lutador;
use PDO;
use DateTime;
use PDOStatement;
use Estudos_TDD\Model\EstatisticasLutador;
use PDOException;

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
    
    public function verificaSeJaExisteBD(Lutador $lutador) : bool
    {
        $NaoExiste = true;
        $nomeLutador = $lutador->nome;
        $stmtSearch = $this->conexao->query("SELECT * FROM lutadores WHERE nome = '$nomeLutador' ;");
        $resultado = $stmtSearch->fetchAll();
        if ($resultado) {
            $NaoExiste = false;
        }
        return $NaoExiste;
    }
    
    public function listAll(): array
    {
        $stmt = $this->conexao->query('SELECT l.id as idDoLutador, l.nome,l.data_nascimento, l.created, 
                            l.modified, e.id as estId, 
                            e.vitorias, e.derrotas, e.ranking 
                            FROM lutadores l INNER JOIN estatisticas e ON l.id = e.lutador_id;');

        return $this->hydrateLutadorList($stmt);
    }

    public function hydrateLutadorList(PDOStatement $stmt) : array
    {
        $lutadorDados = $stmt->fetchAll();
        $lutadorListaObj = [];
        foreach ($lutadorDados as $lutadorDado) {
            $lutador = new Lutador(
                $lutadorDado['idDoLutador'],
                $lutadorDado['nome'],
                new DateTime($lutadorDado['data_nascimento']),
            );
            $estatisticas = new EstatisticasLutador(
                $lutadorDado['estId'],
                $lutadorDado['vitorias'],
                $lutadorDado['derrotas'],
                $lutadorDado['ranking'],
            );

            if($lutadorDado['created'] !== null)
            {
                $created = new DateTime($lutadorDado['created']);
                $lutador->setCreated($created);
            }
            if($lutadorDado['modified'] !== null)
            {
                $modified = new DateTime($lutadorDado['modified']);
                $lutador->setModified($modified);
            }
            
            $lutador->setEstatisticas($estatisticas);
            $lutadorListaObj[] = $lutador;
        }
        return $lutadorListaObj;
    }
    
    public function listById(int $id)
    {
        $stmt = $this->conexao->query(
            "SELECT l.id as lutadorId, l.nome, e.ranking, e.vitorias, e.derrotas FROM lutadores l
            INNER JOIN estatisticas e ON l.id = e.lutador_id WHERE l.id = '$id';");
        $lutadorFound = $stmt->fetch();
        return $lutadorFound;
    }
    public function remove(Lutador $lutador): bool
    {
        $stmt = $this->conexao->prepare('DELETE FROM lutadores WHERE id = :id;');
        $removeInBd = $stmt->execute([
            ':id' => $lutador->getId(),
        ]);
        
        return $removeInBd;

    }

    public function listLutadoresWithLimit($offset, $qtdPorPagina)
    {
        return $this->conexao->query(
            "SELECT e.ranking, l.nome, e.vitorias, e.derrotas, l.id as lutadorId FROM Lutadores l 
            INNER JOIN Estatisticas e 
            ON l.id = e.lutador_id LIMIT $offset, $qtdPorPagina;")->fetchAll();
    }

    public function QtdLutadores()
    {
        $stmt = $this->conexao->query('SELECT COUNT(*) FROM lutadores;');
        $totalDeLutadores = $stmt->fetchColumn();
        return $totalDeLutadores;
    }
    
    public function insert(Lutador $lutador): bool
    {
        try{
            $this->conexao->beginTransaction();
            $sqlInsertLutadores = 'INSERT INTO Lutadores (nome, data_nascimento, created) 
                        VALUES (:nome, :data_nascimento, :created);';
                        
            $stmt = $this->conexao->prepare($sqlInsertLutadores);
            $dateTimeAtual = new DateTime();
            $dta_formatado = $dateTimeAtual->format('Y-m-d');
            $data_nasc_formatada = $lutador->getDataNasc()->format('Y-m-d H:i:s');
            $insertInBdLutador = $stmt->execute([
                ':nome' => $lutador->nome,
                ':data_nascimento' => $data_nasc_formatada,
                ':created' => $dta_formatado,
            ]);
            
            $lastId = $this->conexao->lastInsertId();
            $estatisticas = $lutador->getEstatisticas();
            
            $sqlInsertEstatisticas = 'INSERT INTO estatisticas (vitorias, derrotas, ranking, lutador_id) 
                        VALUES (:vitorias,:derrotas,:ranking, :lutador_id);';
            $stmt = $this->conexao->prepare($sqlInsertEstatisticas);
            $insertInBdEstatisticas = $stmt->execute([
                ':vitorias' => $estatisticas->getVitorias(),
                ':derrotas' => $estatisticas->getDerrotas(),
                ':ranking' => $estatisticas->getRank(),
                ':lutador_id' => $lastId,
            ]);
            $this->conexao->commit();
        }catch(PDOException $e) {
            echo $e->getMessage();
            $this->conexao->rollBack();
        }
        return $insertInBdLutador && $insertInBdEstatisticas;
    }
    
    public function update(Lutador $lutador): bool
    {
        $sqlUpdate = 'UPDATE Lutadores, Estatisticas e INNER JOIN Lutadores l ON l.id = e.lutador_id
                      SET l.nome = :nome, l.data_nascimento = :data_nascimento, l.modified = :modified,
                          e.vitorias = :vitorias, e.derrotas = :derrotas, e.ranking = :ranking
                      WHERE l.id = :id;';
                      
        $stmt = $this->conexao->prepare($sqlUpdate);
        $dateTimeAtual = new DateTime();
        $dta_formatado = $dateTimeAtual->format('Y-m-d');
        $data_nasc_formatada = $lutador->getDataNasc()->format('Y-m-d H:i:s');
        $updateInBd = $stmt->execute([
            ':nome' => $lutador->nome,
            ':data_nascimento' => $data_nasc_formatada,
            ':modified' => $dta_formatado,
            ':vitorias' => $lutador->getEstatisticas()->getVitorias(),
            ':derrotas' => $lutador->getEstatisticas()->getDerrotas(),
            ':ranking' => $lutador->getEstatisticas()->getRank(),
            ':id' => $lutador->getId(),
        ]);
        
        return $updateInBd;
    }
    
}


?>