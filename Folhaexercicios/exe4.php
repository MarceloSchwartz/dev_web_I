<?php
        if (isset($_POST['alt']) && (isset($_POST['base']))){
            $alt = $_POST['alt'];
            $base = $_POST['base'];

            function calcularAreaRetangulo ($alt, $base) {
                return $alt * $base;
            }

            $area = calcularAreaRetangulo($alt, $base);

            $mensagem = "A àrea do retangulo de lado $alt base $base é $area metros quadrados.";

            if ($area > 10 ) {
                echo "<h1>$mensagem</h1>";
            }else {
                echo "<h3>$mensagem</h3>";
            }
        }
?>

