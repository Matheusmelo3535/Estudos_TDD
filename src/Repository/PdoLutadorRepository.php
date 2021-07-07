<?php

namespace Estudos_TDD\Repository;


use Estudos_TDD\Model\Lutador;
use PDO;
use DateTime;


class PdoLutadorRepository implements ILutadorRepository
{
    private PDO $conexao;
    
    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }
    public function save(Lutador $lutador): bool
    {
        return true;
    }
    
    public function listAll(): array
    {
        $array = ['oi'];
        return $array;
    }
    
    public function listById()
    {
        return 'oi';
    }
    
    public function remove(Lutador $lutador): bool
    {
        return true;
    }
    
    public function insert(Lutador $lutador): bool
    {
        $sqlInsert = 'INSERT INTO Lutadores (nome, data_nascimento, created) 
                      VALUES (:nome, :data_nascimento, :created);';
                      
        $stmt = $this->conexao->prepare($sqlInsert);
        $dateTimeAtual = new DateTime();
        $dta_formatado = $dateTimeAtual->format('Y-m-d H:i:s');
        $data_nasc_formatada = $lutador->getDataNasc()->format('Y-m-d H:i:s');
        $exito = $stmt->execute([
            ':nome' => $lutador->nome,
            ':data_nascimento' => $data_nasc_formatada,
            ':created' => $dta_formatado
        ]);
        
        return $exito;
    }
    
    // public function update(Lutador $lutador): bool
    // {
    //     $sqlUpdate = 'UPDATE Lutadores l, Estatisticas e 
    //                   SET l.nome = :nome, l.data_nascimento = :data_nascimento, '
        
        
    // }
}


?>