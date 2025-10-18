<?php
$valor_moto = 8654;

$parcelas_opcoes = [24, 36, 48, 60];
$juros_inicial = 0.02; 
$incremento_juros = 0.003; 

echo "<h2>Valores das parcelas da moto</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Parcelas</th><th>Juros (%)</th><th>Montante (R$)</th><th>Parcela (R$)</th></tr>";

foreach ($parcelas_opcoes as $index => $t) {
    $juros = $juros_inicial + ($index * $incremento_juros);
    
    $montante = $valor_moto * pow(1 + $juros, $t);
    
    $parcela = $montante / $t;
    
    $montante = number_format($montante, 2, ',', '.');
    $parcela = number_format($parcela, 2, ',', '.');
    $juros_percent = $juros * 100;

    echo "<tr>";
    echo "<td>$t</td>";
    echo "<td>$juros_percent%</td>";
    echo "<td>R$ $montante</td>";
    echo "<td>R$ $parcela</td>";
    echo "</tr>";
}

echo "</table>";
?>
