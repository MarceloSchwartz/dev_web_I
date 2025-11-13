<?php

$pdo = getDbConnection();

$numero_pergunta = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 1;
$id_dispositivo = 1; 
$pergunta_id = null;
$opcoes_html = '';
$feedback_html = '';
$botao_texto = '';
$pergunta_titulo = 'Avaliação de Qualidade de Serviços';
$pergunta_texto = '';
$total_perguntas = 0; 

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

    $opcoes_html .= '<p>Escolha uma nota de 0 a 10:</p><div class="box">';
    for ($i = 0; $i <= 10; $i++) {
        $id_radio = 'n' . $i;
        $opcoes_html .= '<input type="radio" id="' . $id_radio . '" name="nota" value="' . $i . '" required>';
        $opcoes_html .= '<label for="' . $id_radio . '" id="box' . $i . '">' . $i . '</label>';
    }
    $opcoes_html .= '</div>';
    
    $botao_texto = ($numero_pergunta < $total_perguntas) ? 'Próxima Pergunta' : 'Finalizar Avaliação';

    if ($numero_pergunta == $total_perguntas) {
        $feedback_html = '
            <div class="blocoFinal" style="margin-top: 20px; width: 100%;">
                <h3>Feedback Adicional (Opcional):</h3>
                <textarea name="feedback_textual" rows="4" placeholder="Deixe um comentário opcional aqui..."></textarea>
            </div>
        ';
    }

} catch (PDOException $e) {
    error_log("Erro ao carregar perguntas: " . $e->getMessage());
    $pergunta_titulo = 'Erro';
    $pergunta_texto = 'Erro ao carregar perguntas. Tente novamente mais tarde.';
    $botao_texto = 'Recarregar';
}
?>