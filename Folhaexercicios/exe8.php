<?php
    
if (isset($_POST['parcelas'])) {  
    
    $valor_avista = 8654;
    $parcelas = $_POST['parcelas'];

    if ($parcelas == 24) {
        $taxa = 1.5;
    } elseif ($parcelas == 36) {
        $taxa = 2.0;
    } elseif ($parcelas == 48) {
        $taxa = 2.5;
    } elseif ($parcelas == 60) {
        $taxa = 3.0;
    } 
    
    $juros = $valor_avista * ($taxa / 100) * $parcelas;

    $valor_total = $valor_avista + $juros;

    $valor_parcelas = $valor_total / $parcelas;

    echo "Valor à vista: R$ " . number_format ($valor_avista, 2, ",", ".") . "<br>";
    echo "Quantidade de parcelas: " . $parcelas . "<br>";
    echo "Taxa de juros: " . $taxa . "% ao mês<br>";
    echo "Valor total: R$ " . number_format($valor_total, 2, ",", ".")  . "<br>";
    echo "Valor de cada parcela: R$ " . number_format($valor_parcelas, 2, ',', '.') . "<br>";

} else {
    echo "Nenhuma opção selecionada.";
}

?>
