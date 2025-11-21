<?php

require_once 'conexao.php'; 
require_once 'funcoes.php'; 

function listar_dispositivos() {
    global $pdo;
    if (!$pdo) { return []; }
    
    $sql = "SELECT id, nome_dispositivo, status FROM dispositivos ORDER BY nome_dispositivo ASC";

    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        error_log("Erro ao listar dispositivos: " . $e->getMessage());
        return [];
    }
}

function adicionar_dispositivo($nome) {
    global $pdo;
    if (!$pdo) { return false; } 
    
    $nome_sanitizado = sanitize_input($nome);

    $sql = "INSERT INTO dispositivos (nome_dispositivo, status) VALUES (:nome, 'ativo')"; // status default 'ativo'

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['nome' => $nome_sanitizado]);
    } catch (PDOException $e) {
        error_log("Erro ao adicionar dispositivo: " . $e->getMessage());
        return false;
    }
}

function alternar_status_dispositivo($id, $novo_status) {
    global $pdo;
    if (!$pdo) { return false; } 
    
    $id = (int)$id; 
    $novo_status = in_array($novo_status, ['ativo', 'inativo']) ? $novo_status : 'ativo';

    $sql = "UPDATE dispositivos SET status = :status WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['status' => $novo_status, 'id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao alternar status do dispositivo: " . $e->getMessage());
        return false;
    }
}

function deletar_dispositivo($id) {
    global $pdo;
    if (!$pdo) { return false; } 

    $id = (int)$id; 
    $sql = "DELETE FROM dispositivos WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao deletar dispositivo: " . $e->getMessage());
        return false;
    }
}
?>