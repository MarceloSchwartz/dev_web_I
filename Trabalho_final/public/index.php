<?php

require_once('conexao.php'); 
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('respostas.php'); 
    exit;
}

require_once('perguntas.php'); 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pergunta_titulo; ?> (<?php echo $numero_pergunta; ?>/<?php echo $total_perguntas; ?>)</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h1><?php echo $pergunta_titulo; ?></h1> 
        
        <form action="index.php" method="post" id="avaliacaoForm"> 
            
            <p><?php echo htmlspecialchars($pergunta_texto); ?></p>
            
            <input type="hidden" name="pergunta_id" value="<?php echo $pergunta_id; ?>">
            <input type="hidden" name="numero_pergunta" value="<?php echo $numero_pergunta; ?>">
            <input type="hidden" name="id_dispositivo" value="<?php echo $id_dispositivo; ?>">
            <input type="hidden" name="total_perguntas" value="<?php echo $total_perguntas; ?>">
            
            <?php echo $opcoes_html;?>
            <?php echo $feedback_html;?>

            <button type="submit" id="botaoProx" style="margin-top: 30px; padding: 10px 20px;">
                <?php echo $botao_texto; ?>
            </button> 
        </form>
    </div>
    <footer>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</footer>

   <script src="script.js"></script>
</body>
</html>