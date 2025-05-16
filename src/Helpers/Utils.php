<?php
namespace ExemploCrud\Helpers;

use Throwable;

final class Utils {
    /* Usando construtor privado e vazio bloqueamos a criação de objeto/instância */
    private function __construct() { }

    public static function dump(mixed $dados):void {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }
   public static function formatarPreco(float $valor):string {
    return "R$ " .number_format($valor, 2, ",", ".");
    }
}

public static function registrarLog(Throwable $e): void
    {
        date_default_timezone_set('America/Sao_Paulo');

        $mensagem = "[" . date("Y-m-d H:i:s") . "]\n" .
            "Arquivo: " . $e->getFile() . "\n" .
            "Linha: " . $e->getLine() . "\n" .
            "Mensagem: " . $e->getMessage() . "\n\n";


        file_put_contents(__DIR__ . '/../../logs/erros.log', $mensagem, FILE_APPEND);
    }