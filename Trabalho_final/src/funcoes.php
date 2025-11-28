<?php


function sanitize_input($data) {

    return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
}


function listar_perguntas() {
    $pdo = getDbConnection(); 
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

function obter_pergunta_por_id($id) {
    $pdo = getDbConnection(); 
    if (!$pdo) { return null; }
    $id = (int)$id;

    $sql = "SELECT id, texto, status FROM perguntas WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao obter pergunta por ID: " . $e->getMessage());
        return null;
    }
}

function adicionar_pergunta($texto, $status = 'ativo') {
    $pdo = getDbConnection();
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

function editar_pergunta($id, $novo_texto) {
    $pdo = getDbConnection(); 
    if (!$pdo) { return false; }

    $id = (int)$id;
    $novo_texto_sanitizado = sanitize_input($novo_texto);
    
    $sql = "UPDATE perguntas SET texto = :texto WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['texto' => $novo_texto_sanitizado, 'id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao editar pergunta: " . $e->getMessage());
        return false;
    }
}

function alternar_status_pergunta($id, $novo_status) {
    $pdo = getDbConnection(); 
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
    $pdo = getDbConnection(); 
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

function obter_perguntas_ativas() {
    $pdo = getDbConnection(); 
    if (!$pdo) { return []; }
    $sql = "SELECT id, texto FROM perguntas WHERE status = 'ativo' ORDER BY id ASC";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao obter perguntas ativas: " . $e->getMessage());
        return [];
    }
}

function listar_dispositivos() {
    $pdo = getDbConnection();
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
    $pdo = getDbConnection();
    if (!$pdo) { return false; } 
    $nome_sanitizado = sanitize_input($nome);
    $sql = "INSERT INTO dispositivos (nome_dispositivo, status) VALUES (:nome, 'ativo')"; 
    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['nome' => $nome_sanitizado]);
    } catch (PDOException $e) {
        error_log("Erro ao adicionar dispositivo: " . $e->getMessage());
        return false;
    }
}


function obter_dispositivo_por_id($id) {
    $pdo = getDbConnection();
    if (!$pdo) { return null; }
    $id = (int)$id;

    $sql = "SELECT id, nome_dispositivo, status FROM dispositivos WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao obter dispositivo por ID: " . $e->getMessage());
        return null;
    }
}

function editar_dispositivo($id, $novo_nome) {
    $pdo = getDbConnection();
    if (!$pdo) { return false; }

    $id = (int)$id;
    $novo_nome_sanitizado = sanitize_input($novo_nome);
    
    $sql = "UPDATE dispositivos SET nome_dispositivo = :nome WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['nome' => $novo_nome_sanitizado, 'id' => $id]);
    } catch (PDOException $e) {
        error_log("Erro ao editar dispositivo: " . $e->getMessage());
        return false;
    }
}


function alternar_status_dispositivo($id, $novo_status) {
    $pdo = getDbConnection();
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
    $pdo = getDbConnection();
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


function count_total_avaliacoes() {
    $pdo = getDbConnection();
    if (!$pdo) { return 0; }
    $sql = "SELECT COUNT(id) AS total FROM avaliacoes";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Erro ao contar avaliações: " . $e->getMessage());
        return 0;
    }
}

function calcular_media_geral() {
    $pdo = getDbConnection();
    if (!$pdo) { return null; } 
    $sql = "SELECT AVG(resposta) AS media FROM avaliacoes";
    try {
        $stmt = $pdo->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return number_format((float)$resultado['media'], 2, ',', '.'); 
    } catch (PDOException $e) {
        error_log("Erro ao calcular média geral: " . $e->getMessage());
        return null;
    }
}

function calcular_media_por_dispositivo() {
    $pdo = getDbConnection();
    if (!$pdo) { return []; } 
    $sql = "SELECT 
                d.nome_dispositivo, 
                AVG(a.resposta) AS media_dispositivo,
                COUNT(a.id) AS total_avaliacoes
            FROM avaliacoes a
            JOIN dispositivos d ON a.id_dispositivo = d.id
            GROUP BY d.nome_dispositivo
            ORDER BY media_dispositivo DESC";
    try {
        $stmt = $pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as &$res) {
            $res['media_dispositivo'] = number_format((float)$res['media_dispositivo'], 2, ',', '.');
        }
        return $resultados;
    } catch (PDOException $e) {
        error_log("Erro ao calcular média por dispositivo: " . $e->getMessage());
        return [];
    }
}

function listar_feedbacks_textuais() {
    $pdo = getDbConnection();
    if (!$pdo) { return []; } 
    $sql = "SELECT 
                a.feedback_textual, 
                a.data_registro, 
                d.nome_dispositivo,
                p.texto AS pergunta_texto 
            FROM avaliacoes a
            JOIN dispositivos d ON a.id_dispositivo = d.id
            JOIN perguntas p ON a.id_pergunta = p.id
            WHERE a.feedback_textual IS NOT NULL AND a.feedback_textual != ''
            ORDER BY a.data_registro DESC";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao listar feedbacks: " . $e->getMessage());
        return [];
    }
}

function salvar_avaliacao($id_dispositivo, $pergunta_id, $nota, $feedback_textual) {
    $pdo = getDbConnection();
    if (!$pdo) { return false; }

    $data_registro = date('Y-m-d H:i:s'); 
    
    $comando = "INSERT INTO avaliacoes (id_dispositivo, id_pergunta, resposta, data_registro, feedback_textual)
                VALUES (:id_dispositivo, :id_pergunta, :resposta, :data_registro, :feedback_textual)";
    
    try {
        $stmt = $pdo->prepare($comando);
        return $stmt->execute([
            ':id_dispositivo' => $id_dispositivo,
            ':id_pergunta' => $pergunta_id,
            ':resposta' => $nota,
            ':data_registro' => $data_registro, 
            ':feedback_textual' => $feedback_textual 
        ]);
    } catch (PDOException $e) {
        error_log("Erro ao salvar avaliação: " . $e->getMessage());
        return false;
    }
}
?>