<?php
require_once "conecta.php";

function listarProdutos(PDO $conexao):array {
    // $sql = "SELECT * FROM produtos";
    $sql = "SELECT 
                produtos.id, produtos.nome AS produto, 
                produtos.preco, produtos.quantidade,
                (produtos.preco * produtos.quantidade) AS total,
                fabricantes.nome AS fabricante
            FROM produtos INNER JOIN fabricantes
            ON produtos.fabricante_id = fabricantes.id
            ORDER BY produto";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar produtos: ".$erro->getMessage());
    }
}


function inserirProduto( 
    PDO $conexao, string $valorNome, float $valorPreco,
    int $valorQuantidade, int $idFabricante, string $valorDescricao  
    ):void {

        $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade, fabricante_id)
                VALUES(:nome, :descricao, :preco, :quantidade, :fabricante_id)";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $valorNome, PDO::PARAM_STR);
        $consulta->bindValue(":descricao", $valorDescricao, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $valorPreco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $valorQuantidade, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $idFabricante, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir produto: ".$erro->getMessage());
    }              
}

function listarUmProduto(PDO $conexao, int $idProduto):array {
    $sql = "SELECT * FROM produtos WHERE id = :id";
 
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar produto: ".$erro->getMessage());
    }   
}


function atualizarProduto(
    PDO $conexao, 
    int $idProduto, 
    string $nomeProduto, 
    float $precoProduto, 
    int $qtdProduto, 
    int $idFabricante, 
    string $descricaoProduto
    ): void {

    $sql = "UPDATE produtos SET
                nome = :nome, 
                preco = :preco, 
                quantidade = :quantidade, 
                fabricante_id = :fabricante_id, 
                descricao = :descricao
            WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nomeProduto, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $precoProduto, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $qtdProduto, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $idFabricante, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricaoProduto, PDO::PARAM_STR);
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao atualizar produto: ".$erro->getMessage());
    }
}

function excluirProduto(PDO $conexao, int $idProduto):void {
    $sql = "DELETE FROM produtos WHERE id = :id";
    
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao excluir produto: ".$erro->getMessage());
    }
}