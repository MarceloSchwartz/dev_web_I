<?php

require_once 'conexao.php'; 
require_once 'funcoes.php'; 

function listar_perguntas() {
    global $pdo;
    if (!$pdo) { return []; }

    $sql = "SELECT id, texto, status, data_criacao FROM perguntas ORDER BY id DESC";

    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        error_log("Erro ao listar perguntas: " . $e->getMessage());
        return [];
    }
}

function adicionar_pergunta($texto, $status = 'ativo') {
    global $pdo;
    if (!$pdo) { return false; } 
    
    $texto_sanitizado = sanitize_input($texto);

    $sql = "INSERT INTO perguntas (texto, status, data_criacao) VALUES (:texto, :status, NOW())";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['texto' => $texto_sanitizado, 'status' => $status]); 
    } catch (PDOException $e) {
        error_log("Erro ao adicionar pergunta: " . $e->getMessage());
        return false;
    }
}

function alternar_status_pergunta($id, $novo_status) {
    global $pdo;
    if (!$pdo) { return false; } 
    
    $id = (int)$id; 
    $novo_status = in_array($novo_status, ['ativo', 'inativo']) ? $novo_status : 'ativo';

    $sql = "UPDATE perguntas SET status = :status WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['status' => $novo_status, 'id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao alternar status da pergunta: " . $e->getMessage());
        return false;
    }
}

function deletar_pergunta($id) {
    global $pdo;
    if (!$pdo) { return false; } 
    
    $id = (int)$id; 

    $sql = "DELETE FROM perguntas WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao deletar pergunta: " . $e->getMessage());
        return false;
    }
}
?>