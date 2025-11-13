<?php
require_once('conexao.php'); 

date_default_timezone_set('America/Sao_Paulo');
$pdo = getDbConnection();

$numero_pergunta = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 1;
$id_dispositivo = 1; 

try {
    $query = $pdo->prepare("SELECT id, texto FROM perguntas ORDER BY id ASC");
    $query->execute();
    $perguntas = $query->fetchAll(PDO::FETCH_ASSOC);

    $total_perguntas = count($perguntas);

    if ($numero_pergunta > $total_perguntas) {
        header("Location: agradecimento.html");
        exit;
    }

    $pergunta_atual = $perguntas[$numero_pergunta - 1];
    $pergunta_id = $pergunta_atual['id'];
    $pergunta_texto = $pergunta_atual['texto'];

} catch (PDOException $e) {
    error_log("Erro ao carregar perguntas: " . $e->getMessage());
    die("Erro ao carregar perguntas. Tente novamente mais tarde.");
}

$opcoes = '';
for ($i = 0; $i <= 10; $i++) {
    $id_radio = 'n' . $i;
    $opcoes .= '<input type="radio" id="' . $id_radio . '" name="nota" value="' . $i . '">';
    $opcoes .= '<label for="' . $id_radio . '" id="box' . $i . '">' . $i . '</label>';
}

$botao_texto = ($numero_pergunta < $total_perguntas) ? 'Próxima Pergunta' : 'Finalizar Avaliação';
$feedback_html = '';

if ($numero_pergunta == $total_perguntas) {
    $feedback_html = '
        <div class="blocoFinal" style="margin-top: 20px; width: 100%;">
            <h3>Feedback Adicional (Opcional):</h3>
            <textarea name="feedback_textual" rows="4" placeholder="Deixe um comentário opcional aqui..."></textarea>
        </div>
    ';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação (<?php echo $numero_pergunta; ?>/<?php echo $total_perguntas; ?>)</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h1>Avaliação de Qualidade de Serviços</h1>
        
        <form action="salvar.php" method="post" id="avaliacaoForm">
            
            <p><?php echo htmlspecialchars($pergunta_texto); ?></p>
            <p>Escolha uma nota de 0 a 10:</p>

            <input type="hidden" name="pergunta_id" value="<?php echo $pergunta_id; ?>">
            <input type="hidden" name="numero_pergunta" value="<?php echo $numero_pergunta; ?>">
            <input type="hidden" name="id_dispositivo" value="<?php echo $id_dispositivo; ?>">

            <div class="box">
                <?php echo $opcoes; ?>
            </div>
            
            <?php echo $feedback_html; ?>

            <button type="submit" id="botaoProx" style="margin-top: 30px; padding: 10px 20px;">
                <?php echo $botao_texto; ?>
            </button> 
        </form>
    </div>
    <footer>Sua avaliação espontânea é
anônima, nenhuma informação pessoal é solicitada ou armazenada.</footer>

    <script src="script.js"></script>
</body>
</html>