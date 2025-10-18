<?php
$pastas = array(
    "bsn" => array(
        "3a Fase" => array("desenWeb", "bancoDados 1", "engSoft 1"),
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