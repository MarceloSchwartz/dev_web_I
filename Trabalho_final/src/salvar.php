<?php

require_once('conexao.php'); 

date_default_timezone_set('America/Sao_Paulo');

$pergunta_id = filter_input(INPUT_POST, 'pergunta_id', FILTER_VALIDATE_INT);
$nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT);
$numero_pergunta = filter_input(INPUT_POST, 'numero_pergunta', FILTER_VALIDATE_INT);
$id_dispositivo = filter_input(INPUT_POST, 'id_dispositivo', FILTER_VALIDATE_INT);

$feedback_textual = filter_input(INPUT_POST, 'feedback_textual', FILTER_SANITIZE_SPECIAL_CHARS);
$feedback_textual = $feedback_textual !== false ? $feedback_textual : null; 

if ($pergunta_id === false || $nota === false || $numero_pergunta === false || $id_dispositivo === false) {
    die("Erro de dados: ID da pergunta, nota ou número de sequência inválido.");
}

$data_registro = date('Y-m-d H:i:s'); 

try {
    $pdo = getDbConnection(); 
    
    $comando = "INSERT INTO avaliacoes (id_dispositivo, id_pergunta, resposta, data_registro, feedback_textual)
                VALUES (:id_dispositivo, :id_pergunta, :resposta, :data_registro, :feedback_textual)";
    
    $stmt = $pdo->prepare($comando);
    $stmt->execute([
        ':id_dispositivo' => $id_dispositivo,
        ':id_pergunta' => $pergunta_id,
        ':resposta' => $nota,
        ':data_registro' => $data_registro, 
        ':feedback_textual' => $feedback_textual 
    ]);

    $proxima_pergunta = $numero_pergunta + 1;
    header("Location: index.php?pergunta=" . $proxima_pergunta);
    exit;

} catch (PDOException $e) {
    error_log("Erro ao salvar a avaliação: " . $e->getMessage());
    die("Erro ao registrar sua avaliação. Tente novamente mais tarde.");
}
?>