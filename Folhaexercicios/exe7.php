<?php

$carro = 22500.00; 
$parcelas = 60;
$valor_parcela = 489.65;

function calc_Juros($carro, $parcelas, $valor_parcela) {
    $total_pago = $parcelas * $valor_parcela;
    $juros = $total_pago - $carro;
    return $juros;
}

$juros = calc_Juros($carro, $parcelas, $valor_parcela);

echo "Valor do carro a vista: R$ " . number_format ($carro, 2, ".", "," ) . "<br>";
echo "Total de parcelas: " . number_format($parcelas, 2, ".", ",") . "<br>";
echo "Valor de cada parcela: R$ " . number_format($valor_parcela, 2, ".", ",") . "<br>";
echo "Total pago: R$ " . number_format($parcelas * $valor_parcela, 2, ".", ",") . "<br>";
echo "Valor total de juros: R$ " . number_format ($juros, 2, ".", ".");

?>
