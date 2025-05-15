<?php
namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\conexaoBD;
use ExemploCrud\Models\Produto;
use PDO;
use Throwable;

final class ProdutoServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = conexaoBD::getConexao();
    }

    public function listarTodos(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY nome";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar produtos: " . $erro->getMessage());
        }
    }

    public function inserir(Produto $produto): void
    {
        $sql = "INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) VALUES(:nome, :preco, :quantidade, :fabricante_id, :descricao)";
        try {
             $consulta = $this->conexao-> prepare($sql);
        $consulta->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
        $consulta->bindValue(":preco", $produto->getPreco(), PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $produto->getFabricanteId(), PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
        $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir: " . $erro->getMessage());
        }
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $erro) {
           throw new Exception("Erro ao carregar produto: " . $erro->getMessage());
        }
    }

    public function atualizar(Produto $produto):void 
    {
         $sql = "UPDATE produtos SET nome = :nome WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":id", $produto->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar produto: ".$erro->getMessage());
        }
    }

    public function excluir(int $id):void {
    $sql = "DELETE FROM produtos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao excluir produto: ".$erro->getMessage());
        }
    }
}