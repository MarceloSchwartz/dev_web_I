<?php
if (isset($_POST['altTR']) && isset($_POST['baseTR'])) {
    $altTR = $_POST['altTR'];
    $baseTR = $_POST['baseTR'];

    function calcularAreaTrianguloRetangulo($altTR, $baseTR) {
        return ($altTR * $baseTR) / 2;
    }

    $area = calcularAreaTrianguloRetangulo($altTR, $baseTR);
    echo "A área do triângulo retângulo de altura $altTR e base $baseTR é $area metros quadrados.";
}
?>