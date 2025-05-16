<?php

use ExemploCrud\Helpers\Utils;
use ExemploCrud\Models\Produto;
use ExemploCrud\Services\FabricanteServico;
use ExemploCrud\Services\ProdutoServico;

require_once "../vendor/autoload.php";

$fabricanteServico = new FabricanteServico();
$produtoServico = new ProdutoServico();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$produtoDados = $produtoServico->buscarPorId($id);
$listaDeFabricantes = $fabricanteServico->listarTodos();


//Utils::dump($produtoDados);

if (isset($_POST["atualizar"])) { // 

    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_NUMBER_INT);
    $fabricante_id = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);

    $produto = new Produto($nome, $preco, $quantidade, $fabricante_id, $descricao, $id);
    $produtoServico->atualizar($produto);
    
    header("location:visualizar.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-2 shadow-lg rounded pb-1">
        <h1><a class="btn btn-outline-dark" href="visualizar.php">&lt; Voltar</a> Produtos | SELECT/UPDATE</h1>
        <hr>

        <form action="" method="post" class="w-50">
            <input type="hidden" name="id" value="<?= $produtoDados['id'] ?>">
            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>
                <input value="<?= $produtoDados['nome'] ?>"
                    class="form-control" type="text" name="nome" id="nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="preco">Preço:</label>
                <input value="<?= $produtoDados['preco'] ?>"
                    class="form-control" type="number" min="10" max="10000" step="0.01" name="preco" id="preco" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="quantidade">Quantidade:</label>
                <input value="<?= $produtoDados['quantidade'] ?>"
                    class="form-control" type="number" min="1" max="100" name="quantidade" id="quantidade" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="fabricante">Fabricante:</label>
                <select class="form-select" name="fabricante" id="fabricante" required>
                    <option value=""></option>

                    <!-- Algoritmo para seleção do fabricante do produto que será editado

            Se a FK da tabela produtos for igual a PK da tabela fabricantes, ou seja, se o ID do fabricante do produto for igual ao id do fabricante, então coloque o atributo "selected" no <option>
            correspondente. -->

                    <?php foreach ($listaDeFabricantes as $fabricante): ?>
                        <option
                            <?php if ($produtoDados['fabricante_id'] === $fabricante['id']) echo " selected " ?>
                            value="<?= $fabricante['id'] ?>">
                            <?= $fabricante['nome'] ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição:</label> <br>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="3"><?= $produtoDados['descricao'] ?></textarea>
            </div>
            <button class="btn btn-warning" type="submit" name="atualizar">Atualizar produto</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>