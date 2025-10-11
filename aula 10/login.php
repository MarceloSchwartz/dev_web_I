<?php
session_start();

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['senha'] = $_POST['senha'];
    $_SESSION['inicio_sessao'] = date('d/m/Y H:i:s');
    $_SESSION['ultimo_acesso'] = $_SESSION['inicio_sessao'];
}

if (isset($_SESSION['usuario']) && isset($_SESSION['senha']) && isset($_SESSION['inicio_sessao'])) {
    $_SESSION['ultimo_acesso'] = date('d/m/Y H:i:s');

    echo "Usuário: " . $_SESSION['usuario'] . " já está logado.<br>";
    echo "Senha: " . $_SESSION['senha'] . "<br>";
    echo "Início da Sessão: " . $_SESSION['inicio_sessao'] . "<br>";
    echo "Último Acesso: " . $_SESSION['ultimo_acesso'] . "<br>";

    echo "Tempo de sessão: " . (strtotime($_SESSION['ultimo_acesso']) - strtotime($_SESSION['inicio_sessao'])) . " segundos.<br>";
} else {
    echo "Preencha o formulário de login.<br>";
}
?>