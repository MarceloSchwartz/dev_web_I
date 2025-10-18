<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Resultado</h1>

    <?php
    if (isset($_POST['v1'], $_POST['v2'], $_POST['v3'])) {
        $v1 = (float) $_POST['v1'];
        $v2 = (float) $_POST['v2'];
        $v3 = (float) $_POST['v3'];

        $soma = $v1 + $v2 + $v3;
        $mensagem = "A soma dos valores é: $soma";
        $cor = "";

        if ($v1 > 10) {
            $cor = "azul";
        } elseif ($v2 < $v3) {
            $cor = "verde";
        } elseif ($v3 < $v1 && $v3 < $v2) {
            $cor = "vermelho";
        }

        echo "<div class='resultado $cor'>$mensagem</div>";
    }
    ?>

</body>
</html>
