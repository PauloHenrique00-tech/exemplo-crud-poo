<?php
function formatarPreco( float $valor ):string {
    $precoFormatado = "R$ " .number_format($valor, 2, ",", ".");
    return $precoFormatado;
}