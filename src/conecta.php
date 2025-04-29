<?php
/* Parâmetros de conexão em ambiente de desenvolvimento,
no nosso caso, o XAMPP */
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendas";

/* Configurações para conexão ao banco de dados */

/* Bloco try/catch
Passamos no try tudo que queremos que seja feito (as ações de config/conexão com o BD) */
try {
    // Criando conexão com o banco usando a classe PDO
    // PDO (PHP Data Object): classe para manipulação de banco de dados
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8",
        $usuario, $senha
    );

    /* Configurar PDO para lançar exceções/erros caso ocorram */
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $erro) {
    /* E colocamos no catch o que fazer CASO alguma ação no try FALHE.
    Neste caso, é gerada uma exceção/erro e exibimos a mensagem sobre ela */
    die( "Deu ruim: ".$erro->getMessage() );
}



