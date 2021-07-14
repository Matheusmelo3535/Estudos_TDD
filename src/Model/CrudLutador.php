<?php

namespace Estudos_TDD\Model;
use Estudos_TDD\Repository\PdoLutadorRepository;
use Estudos_TDD\Model\Lutador;

class CrudLutador
{
    private PdoLutadorRepository $pdoLutador;

    public function __construct(PdoLutadorRepository $pdo)
    {
        $this->pdoLutador = $pdo;
    }
     
    public function validaNome(string $nomeLutador) 
    {
        return strlen(trim($nomeLutador)) > 5;
    }
    
    public function validaVitorias(int $vitoriasLutador)
    {
        return $vitoriasLutador > 0;
    }
    
    public function validaDerrotas(int $derrotasLutador)
    {
        return $derrotasLutador >= 0;
    }
    
    public function validaRankingPermitido(string $rank)
    {

        return in_array(strtoupper($rank), Lutador::RAKINGSVALIDOS);
    }

    public function validaRankingDisponivel(string $rank)
    {
        $buscaNoBanco = $this->pdoLutador->isRankNotAvaible($rank);
        $avaible = true;
        if ($buscaNoBanco)
        {
            $avaible = false;
        }
        return $avaible;
    }
    
    public function validaDuplicidadeNome(Lutador $lutador)
    {
       return $this->pdoLutador->verificaSeJaExisteBD($lutador);
    }

    public function validacaoAntesDeSalvar(Lutador $lutador, string $acao)
    {
        $valido = true;
        $nome = $lutador->nome;
        $vitorias = $lutador->getEstatisticas()->getVitorias();
        $derrotas = $lutador->getEstatisticas()->getDerrotas();
        $rank = $lutador->getEstatisticas()->getRank();
        $validacaoDados = [
            'nome' => $this->validaNome($nome),
            'vitorias' => $this->validaVitorias($vitorias),
            'derrotas' => $this->validaDerrotas($derrotas),
            'rank' => $this->validaRankingPermitido($rank),
        ];

        foreach ($validacaoDados as $atributoLutador){
           if (!$atributoLutador){
                $valido = false;
                
           }
        }
        if ($acao === 'add' && $valido) {
            $nomeNaoExisteNoBD = $this->validaDuplicidadeNome($lutador);
            $rankingDisponivel = $this->validaRankingDisponivel($rank);
            if (!$nomeNaoExisteNoBD || !$rankingDisponivel) {
                $valido = false;
            }
        }
        return $valido;
    }

    public function addLutador(Lutador $lutador)
    {
        $validaDados = $this->validacaoAntesDeSalvar($lutador,'add');
        $saveNoBanco = false;
        if ($validaDados){
            $saveNoBanco = $this->pdoLutador->save($lutador);
            
        }
        return $saveNoBanco; 
    }
    

    public function paginacaoLutadores()
    {
        $pagina = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
        $porPagina = 5;
        $totalLutadores = $this->pdoLutador->QtdLutadores();
        $totalPaginas = ceil($totalLutadores / $porPagina);
        $paginationStart = ($pagina - 1) * $porPagina;

        return ['Paginas'=> $totalPaginas, 'Offset' => $paginationStart, 'QtdPorPagina' => $porPagina];
    }

    public function getLutadoresComLimit($offset, $qtdPorPagina)
    {
        $lutadores = $this->pdoLutador->listLutadoresWithLimit($offset, $qtdPorPagina);
        return $lutadores;
    }

    public function editLutador(Lutador $lutador)
    {
        $editadoComExito = false;
        $validaDadosLutador = $this->validacaoAntesDeSalvar($lutador, 'edit');
        if ($validaDadosLutador) {
            $editadoComExito = $this->pdoLutador->save($lutador);
        }
        return $editadoComExito;
    }
    
    public function deleteLutador(int $id)
    {
        $exlusaoComExito = $this->pdoLutador->remove($id);
        return $exlusaoComExito;
    }
    
    public function getAll(): array
    {
        return $this->pdoLutador->listAll();
    }
    
    public function getById(int $id)
    {
        $lutador = $this->pdoLutador->listById($id);
        return $lutador;
    }
}
?>