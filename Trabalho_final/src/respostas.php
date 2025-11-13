<?php
require_once('conexao.php'); 

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data_registro = date('Y-m-d H:i:s'); 

    $numero_pergunta = filter_input(INPUT_POST, 'numero_pergunta', FILTER_VALIDATE_INT);
    $total_perguntas = filter_input(INPUT_POST, 'total_perguntas', FILTER_VALIDATE_INT);
    $id_dispositivo = filter_input(INPUT_POST, 'id_dispositivo', FILTER_VALIDATE_INT);

    $pergunta_id = filter_input(INPUT_POST, 'pergunta_id', FILTER_VALIDATE_INT);
    $nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT);
    $feedback_textual = filter_input(INPUT_POST, 'feedback_textual', FILTER_SANITIZE_SPECIAL_CHARS);
    $feedback_textual = $feedback_textual !== false ? $feedback_textual : null; 

    $is_nota_step = ($pergunta_id !== false && $pergunta_id !== null);
    $is_feedback_step = ($numero_pergunta == $total_perguntas + 1); 

    try {
        $pdo = getDbConnection(); 

        if ($is_nota_step) {
            $comando = "INSERT INTO avaliacoes (id_dispositivo, id_pergunta, resposta, data_registro, feedback_textual)
                        VALUES (:id_dispositivo, :id_pergunta, :resposta, :data_registro, NULL)";
            
            $stmt = $pdo->prepare($comando);
            $stmt->execute([
                ':id_dispositivo' => $id_dispositivo,
                ':id_pergunta' => $pergunta_id,
                ':resposta' => $nota,
                ':data_registro' => $data_registro 
            ]);
            
        } elseif ($is_feedback_step) {
             if (!empty($feedback_textual)) {
                 $comando = "INSERT INTO avaliacoes (id_dispositivo, id_pergunta, resposta, data_registro, feedback_textual)
                            VALUES (:id_dispositivo, NULL, NULL, :data_registro, :feedback_textual)";
                
                $stmt = $pdo->prepare($comando);
                $stmt->execute([
                    ':id_dispositivo' => $id_dispositivo,
                    ':data_registro' => $data_registro,
                    ':feedback_textual' => $feedback_textual 
                ]);
             }

        } 
        
        $proxima_pergunta = $numero_pergunta + 1;
        header("Location: index.php?pergunta=" . $proxima_pergunta);
        exit;

    } catch (PDOException $e) {
        error_log("Erro ao salvar a avaliação: " . $e->getMessage());
        die("Erro ao registrar sua avaliação. Tente novamente mais tarde.");
    }
} else {
    header("Location: index.php");
    exit;
}
?>