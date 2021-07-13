<?php

namespace Estudos_TDD\Model;
use DateTime;
use Estudos_TDD\Repository\PdoLutadorRepository;

class CrudLutador
{
    private PdoLutadorRepository $pdoLutador;

    public function __construct(PdoLutadorRepository $pdo)
    {
        $this->pdoLutador = $pdo;
    }
    
    private array $TabelaLutadores = [];

    public function getTabelaLutadores()
    {
        return $this->TabelaLutadores;
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
    
    public function validaRanking(string $rank)
    {
        return in_array(strtoupper($rank), Lutador::rankingsValidos);
    }
    
    public function validaDuplicidade(Lutador $lutador)
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
            'rank' => $this->validaRanking($rank)
        ];

        foreach ($validacaoDados as $atributoLutador){
           if (!$atributoLutador){
                $valido = false;
                
           }
        }
        if ($acao === 'add' && $valido) {
            $valido = $this->validaDuplicidade($lutador);
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
    
    public function buscaIndexLutadorPeloNome(string $nome, array $array)
    {
        return array_search($nome, array_column($array, 'nome'));
    }

    public function readLutador(string $nomeLutador)
    {
        $lutadorEncontado = '';
        $indexLutador = $this->buscaIndexLutadorPeloNome($nomeLutador, $this->TabelaLutadores);
        if ($indexLutador) {
            $lutadorEncontado = $this->TabelaLutadores[$indexLutador];
        }
        return $lutadorEncontado;
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

    public function editLutador(string $nomeLutador, EstatisticasLutador $novosDados)
    {
        $editadoComExito = false;
        $buscaLutador = $this->readLutador($nomeLutador);
        if ($buscaLutador) {
            $validaDados = $this->validacaoAntesDeSalvar(new Lutador(null, 'Validacao', new DateTime()), 'edit');
            if ($validaDados) {
                $editadoComExito = true;
                $estatisticasEdit = $buscaLutador->getEstatisticas();
                $estatisticasEdit->setVitorias($novosDados->getVitorias());
                $estatisticasEdit->setDerrotas($novosDados->getDerrotas());
                $estatisticasEdit->setRank($novosDados->getRank());
            }
        }
        return $editadoComExito;
    }
    
    public function deleteLutador(string $nomeLutador)
    {
        $exlusaoComExito = false;
        $pegaIndexLutador = $this->buscaIndexLutadorPeloNome($nomeLutador, $this->TabelaLutadores);
        if ($pegaIndexLutador){
            unset($this->TabelaLutadores[$pegaIndexLutador]);
            $exlusaoComExito = true;
            
        }
        return $exlusaoComExito;
    }
    
    public function funcaoListTeste(): array
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