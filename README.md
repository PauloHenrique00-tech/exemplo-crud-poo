# exemplo-crud-php
 Atividades de programação CRUD com PHP procedural

Exercício 01 (27/03/2025)
Na pasta src crie um arquivo chamado funcoes-utilitarias.php
Dentro deste arquivo programe uma função chamada formatarPreco e faça as ações necessárias para ela receber um valor e retorná-lo formatado em reais.
Use esta função para formatar o preço de cada produto exibido na página produtos/visualizar.php

Exercício/Desafio 02 (27/03/2025)
Pense (e implemente) uma forma de trazer na página produtos/visualizar.php o total de cada produto, ou seja, multiplicando preco por quantidade.
Dicas: dá pra fazer de forma direta na saída, ou via operações no comando SQL, ou usando uma nova função etc.

Exercício 3 (01/04/2025)

Em produtos/visualizar.php, para cada Produto exibido na tela, adicione um link dinâmico para a página atualizar.php passando o id do produto como parâmetro de URL.

Em produtos/atualizar.php faça a programação necessária para capturar/sanitizar o valor do parâmetro id vindo da URL.

Em funcoes-produtos.php programe uma função chamada listarUmProduto que receba o id do produto a ser consultado e retorne um array associativo com os dados de um produto.

Em produtos/atualizar.php faça a programação necessária para chamar a função listarUmProduto e, após receber os dados de retorno dela, exiba os valores nos campos nome, preço, quantidade e descricao.

Obs.: por enquanto, não se preocupe em mostrar qual o fabricante do produto selecionado.

Exercício 04 (04/04/2025)
Faça a programação necessária para a ação de atualizar um produto.

O que precisa (não necessariamente nessa ordem):

Em produtos/atualizar.php (ações parecidas com o que foi feito ao inserir):
Detectar quando o formulário é acionado
Capturar/sanitizar os dados do formulário
Chamar a função atualizarProduto e passar os dados para ela
Redirecionar para a página visualizar.php
Em funcoes-produtos.php:
Criar a função atualizarProduto
Fazer com que esta função receba os parâmetros necessários para executar o UPDATE: conexao, id do produto, preço, quantidade, descricao e fabricante do produto

Exercício 05 (04/04/2025)
Faça a programação necessária para a ação de excluir um produto.