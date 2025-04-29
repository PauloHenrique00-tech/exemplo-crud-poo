<?php
function formatarPreco(float $valor):string {
    return "R$ " .number_format($valor, 2, ",", ".");
}