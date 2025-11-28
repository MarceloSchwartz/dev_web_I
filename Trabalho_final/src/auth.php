<?php
require_once '../conexao.php'; 
require_once 'funcoes.php'; 

function attempt_login($usuario, $senha) {

    $pdo = getDbConnection(); 
    
    $usuario_sanitizado = sanitize_input($usuario); 

    $sql = "SELECT id, username FROM admin_users WHERE username = :usuario AND password = :senha"; 

    try {

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuario' => $usuario_sanitizado,
            'senha' => $senha 
        ]); 
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['usuario'] = $user['username']; 
            $_SESSION['logged_in'] = true;

            $_SESSION['inicio_sessao'] = date('d/m/Y H:i:s');
            $_SESSION['ultimo_acesso'] = $_SESSION['inicio_sessao'];

            return true; 
        }
        return false;

    } catch (PDOException $e) {
        error_log("Erro de Autenticação: " . $e->getMessage());
        return false;
    }
}

function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function logout() {
    session_unset(); 
    session_destroy(); 
    header('Location: admin.php');
    exit;
}
?>