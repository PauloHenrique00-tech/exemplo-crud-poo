<?php
namespace ExemploCrud\Helpers;

use Throwable;

final class Utils {
    /* Usando construtor privado e vazio bloqueamos a criação de objeto/instância */
    private function __construct() { }

    public static function dump(mixed $dados):void {
        echo "<pre>".var_dump($dados)."</pre>";
    }
}