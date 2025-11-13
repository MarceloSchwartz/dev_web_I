<?php
require_once('conexao.php'); 

date_default_timezone_set('America/Sao_Paulo');

function exibirPaginaAtual() { 
    $pdo = getDbConnection();

    $numero_pergunta = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 1;
    $id_dispositivo = 1; 

    try {
        $query = $pdo->prepare("SELECT id, texto FROM perguntas ORDER BY id ASC");
        $query->execute();
        $perguntas = $query->fetchAll(PDO::FETCH_ASSOC);

        $total_perguntas = count($perguntas);
        $total_etapas = $total_perguntas + 1; 

        if ($numero_pergunta > $total_etapas) { 
            header("Location: agradecimento.html");
            exit;
        }

        $pergunta_id = null;
        $pergunta_titulo = 'Avaliação de Qualidade de Serviços';
        $pergunta_texto = '';
        $opcoes_html = '';
        $feedback_html = '';
        $botao_texto = '';

        if ($numero_pergunta <= $total_perguntas) {
            $pergunta_atual = $perguntas[$numero_pergunta - 1];
            $pergunta_id = $pergunta_atual['id'];
            $pergunta_texto = $pergunta_atual['texto'];

            $opcoes_html .= '<p>Escolha uma nota de 0 a 10:</p><div class="box">';
            for ($i = 0; $i <= 10; $i++) {
                $id_radio = 'n' . $i;
                $opcoes_html .= '<input type="radio" id="' . $id_radio . '" name="nota" value="' . $i . '">';
                $opcoes_html .= '<label for="' . $id_radio . '" id="box' . $i . '">' . $i . '</label>';
            }
            $opcoes_html .= '</div>';
            $botao_texto = 'Próxima Pergunta';
            
        } else {
            $pergunta_titulo = 'Passo Final: Feedback Opcional'; 
            $pergunta_texto = 'Se desejar, utilize o campo abaixo para deixar um comentário ou sugestão adicional (opcional):';
            
            $feedback_html = '
                <div class="blocoFinal">
                    <textarea name="feedback_textual" rows="6" placeholder="Seu feedback é opcional, mas valioso."></textarea>
                </div>
            ';
            $botao_texto = 'Finalizar Avaliação';
        }

    } catch (PDOException $e) {
        error_log("Erro ao carregar perguntas: " . $e->getMessage());
        die("Erro ao carregar perguntas. Tente novamente mais tarde.");
    }

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $pergunta_titulo; ?> (<?php echo $numero_pergunta; ?>/<?php echo $total_etapas; ?>)</title>
        <link rel="stylesheet" href="style.css"> 
    </head>
    <body>
        <div class="container">
            <h1><?php echo $pergunta_titulo; ?></h1> 
            
            <form action="index.php" method="post" id="avaliacaoForm"> 
                
                <p><?php echo htmlspecialchars($pergunta_texto); ?></p>
                
                <input type="hidden" name="pergunta_id" value="<?php echo $pergunta_id; ?>">
                <input type="hidden" name="numero_pergunta" value="<?php echo $numero_pergunta; ?>">
                <input type="hidden" name="total_perguntas" value="<?php echo $total_perguntas; ?>">
                <input type="hidden" name="id_dispositivo" value="<?php echo $id_dispositivo; ?>">
                
                <?php echo $opcoes_html; ?>
                <?php echo $feedback_html; ?>

                <button type="submit" id="botaoProx">
                    <?php echo $botao_texto; ?>
                </button> 
            </form>
        </div>

        <footer>
            <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
        </footer>

       <script src="script.js"></script>
    </body>
    </html>
    <?php
    echo ob_get_clean();
}
?>