<?php
require_once 'conecta.php';

function listarProdutos(PDO $conexao):array {
    //$sql = "SELECT * FROM produtos";
    $sql = "SELECT 
                produtos.id, produtos.nome AS produto, 
                produtos.preco, produtos.quantidade, 
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
    PDO $conexao, string $nome, float $preco, 
    int $quantidade, int $idfabricante, string $descricao
    ):void {
    $sql = "INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) VALUES(:nome, :preco, :quantidade, :fabricante_id, :descricao)";

    try {
        $consulta = $conexao-> prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $idfabricante, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir: ".$erro->getMessage());
    }
}


function listarUmProduto(PDO $conexao, int $id ):array {
    $sql = "SELECT * FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();

        /* Usamos o fetch para garantir o retorno
        de um único array associativo com o resultado */
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar produto: ".$erro->getMessage());
    }
}

function atualizarProduto(
    PDO $conexao, int $id, string $nome, string $descricao, float $preco, int $quantidade, int $fabricante_id):void {

    $sql = "UPDATE produtos 
            SET nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao, fabricante_id = :fabricante_id 
            WHERE id = :id";

    

    try { 

        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $fabricante_id, PDO::PARAM_INT);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao atualizar produto: ".$erro->getMessage());
    }
}

function excluirProduto(PDO $conexao, int $id):void {
    $sql = "DELETE FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao excluir produto: ".$erro->getMessage());
    }
}