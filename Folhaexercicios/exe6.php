<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Feira</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .verde { color: green; font-weight: bold; }
        .vermelho { color: red; font-weight: bold; }
        .azul { color: blue; font-weight: bold; }
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid ; padding: 8px; text-align: left; }
    </style>
</head>
<body>

<h1>Resultado da Compra</h1>

<?php
    $dinheiro_disponivel = 50.00;

    $itens = [
        "Maçã" => $_POST["preco_maca"] * $_POST["qtd_maca"],
        "Melancia" => $_POST["preco_melancia"] * $_POST["qtd_melancia"],
        "Laranja" => $_POST["preco_laranja"] * $_POST["qtd_laranja"],
        "Repolho" => $_POST["preco_repolho"] * $_POST["qtd_repolho"],
        "Cenoura" => $_POST["preco_cenoura"] * $_POST["qtd_cenoura"],
        "Batatinha" => $_POST["preco_batatinha"] * $_POST["qtd_batatinha"],
    ];

    $total = array_sum($itens);

    echo "<table>";
    echo "<tr><th>Produto</th><th>Valor Gasto (R$)</th></tr>";
    foreach ($itens as $produto => $valor) {
        echo "<tr><td>$produto</td><td>R$ " . number_format($valor, 2, ',', '.') . "</td></tr>";
    }
    echo "<tr><th>Total</th><th>R$ " . number_format($total, 2, ',', '.') . "</th></tr>";
    echo "</table><br>";

    if ($total > $dinheiro_disponivel) {
        $dif = $total - $dinheiro_disponivel;
        echo "<p class='vermelho'>Joãozinho gastou R$ " . number_format($dif, 2, ',', '.') . " a mais do que tinha!</p>";
    } elseif ($total < $dinheiro_disponivel) {
        $dif = $dinheiro_disponivel - $total;
        echo "<p class='azul'>Joãozinho ainda pode gastar R$ " . number_format($dif, 2, ',', '.') . ".</p>";
    } else {
        echo "<p class='verde'>Joãozinho gastou exatamente R$ 50,00. O saldo foi totalmente utilizado!</p>";
    }
?>

</body>
</html>
