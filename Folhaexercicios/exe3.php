<?php
    if (isset($_POST['lado'])) {
        $lado = $_POST['lado'];

        function calcularArea($lado) {
            return $lado * $lado;
        }

        $area = calcularArea($lado);
        echo "A área do quadrado de lado $lado é: $area metros quadrados.";
    }

?>
