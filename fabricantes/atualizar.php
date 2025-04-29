<?php
require_once "../src/funcoes-fabricantes.php";

/* Obtendo o valor do parâmetro via URL */
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

/* Chamando a função para carregar os dados de um fabricante */
$fabricante = listarUmFabricante($conexao, $id);

/* Verificando se o formulário de atualização foi acionado */
if(isset($_POST['atualizar'])){
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    
    /* Exercício! Implemente a função para atualizar o nome do fabricante */
    atualizarFabricante($conexao, $id, $nome);
    
    header("location:visualizar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes - Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-2 shadow-lg rounded pb-1">
        <h1><a class="btn btn-outline-dark" href="visualizar.php">&lt; Voltar</a> Fabricantes | SELECT/UPDATE</h1>
        <hr>

        <form action="" method="post" class="w-25">
            <!-- Campo oculto (hidden): o formulário/servidor "sabe"
            do valor, mas não mostra para o usuário -->
            <input type="hidden" name="id" value="<?=$fabricante['id']?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input value="<?=$fabricante['nome']?>" 
                class="form-control" required type="text" name="nome" id="nome">
            </div>
            <button class="btn btn-warning" type="submit" name="atualizar">
                Atualizar fabricante</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>