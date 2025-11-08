<?php // pratica 1 

$notas = [8, 7.5, 9, 6, 7]; 
$faltas = [0, 1, 0, 1, 0, 0, 1, 0, 0, 0]; 


function calcularMedia($notas) {
    $soma = 0;
    $quantidade = count($notas);
    
    for ($i = 0; $i < $quantidade; $i++) {
        $soma += $notas[$i];
    }

    $media = $soma / $quantidade;
    return $media;
}

function verificarAprovacaoNota($media) {
    if ($media >= 7) {
        return "Aprovado por nota";
    } else {
        return "Reprovado por nota";
    }
}


function calcularFrequencia($faltas) {
    $totalAulas = count($faltas);
    $faltasTotais = 0;

    for ($i = 0; $i < $totalAulas; $i++) {
        if ($faltas[$i] == 1) {
            $faltasTotais++;
        }
    }

    $frequencia = (($totalAulas - $faltasTotais) / $totalAulas) * 100;
    return $frequencia;
}


function verificarAprovacaoFrequencia($frequencia) {
    if ($frequencia >= 70) {
        return "Aprovado por frequência";
    } else {
        return "Reprovado por frequência";
    }
}

$media = calcularMedia($notas);
$statusNota = verificarAprovacaoNota($media);

$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoFrequencia($frequencia);

echo "Média das notas: " . number_format($media, 2) . "<br>";
echo "Status por nota: " . $statusNota . "<br><br>";

echo "Frequência: " . number_format($frequencia, 2) . "%<br>";
echo "Status por frequência: " . $statusFrequencia . "<br><br>";

if ($media >= 7 && $frequencia >= 70) {
    echo "<strong>Resultado Final: APROVADO</strong>";
} else {
    echo "<strong>Resultado Final: REPROVADO</strong>";
}
?>

<hr>

<?php // pratica 2
$pastas = array(
    "bsn" => array(
        "3a Fase" => array("desenvWeb", "bancoDados 1", "engSoft 1"),
        "4a Fase" => array("Intro Web", "bancoDados 2", "engSoft 2")
    )
);

function mostrarArvore($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {

        if (is_array($valor)) {
            echo str_repeat("-", $nivel) . " " . $chave . "<br>";
            mostrarArvore($valor, $nivel + 1);
        } 

        else {
            echo str_repeat("-", $nivel) . " " . $valor . "<br>";
        }
    }
}

mostrarArvore($pastas);
?>


<hr>

<?php // pratica 3

define("VALOR", 200);
define("DESCONTO", 15);

function calcularValorFinal($valor, $desconto) {
    if (!is_numeric($valor) || !is_numeric($desconto)) {
        throw new Exception("Os parâmetros devem ser numéricos.");
    }

    if ($valor < 0 || $desconto < 0) {
        throw new Exception("Os valores não podem ser negativos.");
    }

    if ($desconto > 100) {
        throw new Exception("O desconto não pode ser maior que 100%.");
    }

    $valorFinal = $valor - ($valor * ($desconto / 100));
    return $valorFinal;
}

try {
    $valor = VALOR;
    $desconto = DESCONTO;

    $resultado = calcularValorFinal($valor, $desconto);

    echo "<h3>Resultado:</h3>";
    echo "Valor original: R$ " . number_format($valor, 2, ',', '.') . "<br>";
    echo "Desconto: " . number_format($desconto, 2, ',', '.') . "%<br>";
    echo "<strong>Valor final: R$ " . number_format($resultado, 2, ',', '.') . "</strong>";
}
catch (Exception $e) {
    echo "<strong>Erro:< /strong> " . $e->getMessage();
}

?>


