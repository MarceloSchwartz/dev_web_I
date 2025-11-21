<?php

session_start(); 
require_once 'auth.php';       
require_once 'funcoes.php';    
require_once 'perguntas_admin.php'; 
require_once 'dispositivos.php';

$message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'Login') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (attempt_login($usuario, $senha)) {
        header('Location: admin.php');
        exit;
    } else {
        $error_message = 'Usuário ou senha inválidos.';
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

if (is_logged_in()) {
    
    $_SESSION['ultimo_acesso'] = date('d/m/Y H:i:s');

    if (isset($_POST['adicionar_pergunta'])) {
        $novo_texto = $_POST['texto_pergunta'] ?? '';
        if (adicionar_pergunta($novo_texto)) {
            $message = "<p style='color: green;'>Pergunta adicionada com sucesso!</p>";
        } else {
            $message = "<p style='color: red;'>Erro ao adicionar pergunta. Verifique o LOG de erro do PHP/PostgreSQL.</p>";
        }
    }

    if (isset($_GET['action_pergunta'])) {
        $id = $_GET['id'] ?? 0;
        $id = (int)$id;

        if ($_GET['action_pergunta'] === 'delete' && $id > 0) {
            if (deletar_pergunta($id)) {
                 $message = "<p style='color: green;'>Pergunta deletada com sucesso!</p>";
            } else {
                 $message = "<p style='color: red;'>Erro ao deletar pergunta.</p>";
            }
        } elseif ($_GET['action_pergunta'] === 'toggle' && $id > 0) {
            $current_status = $_GET['status'] === 'ativo' ? 'inativo' : 'ativo';
            if (alternar_status_pergunta($id, $current_status)) {
                $message = "<p style='color: green;'>Status da pergunta alterado para '$current_status'!</p>";
            } else {
                 $message = "<p style='color: red;'>Erro ao alterar status.</p>";
            }
        }
        if ($message) {
             header('Location: admin.php?msg=' . urlencode($message));
             exit;
        }
    }

    if (isset($_POST['adicionar_dispositivo'])) {
        $novo_nome = $_POST['nome_dispositivo'] ?? '';
        if (adicionar_dispositivo($novo_nome)) {
            $message = "<p style='color: green;'>Dispositivo/Setor adicionado com sucesso!</p>";
        } else {
            $message = "<p style='color: red;'>Erro ao adicionar Dispositivo/Setor. Verifique o LOG ou se o nome já existe.</p>";
        }
    }

    if (isset($_GET['action_dispositivo'])) {
        $id = $_GET['id'] ?? 0;
        $id = (int)$id;

        if ($_GET['action_dispositivo'] === 'toggle' && $id > 0) {
            $current_status = $_GET['status'] === 'ativo' ? 'inativo' : 'ativo';
            if (alternar_status_dispositivo($id, $current_status)) {
                $message = "<p style='color: green;'>Status do dispositivo alterado para '$current_status'!</p>";
            } else {
                $message = "<p style='color: red;'>Erro ao alterar status do dispositivo.</p>";
            }
        } elseif ($_GET['action_dispositivo'] === 'delete' && $id > 0) {
            if (deletar_dispositivo($id)) {
                $message = "<p style='color: green;'>Dispositivo/Setor deletado com sucesso!</p>";
            } else {
                $message = "<p style='color: red;'>Erro ao deletar dispositivo/setor. Pode haver avaliações associadas.</p>";
            }
        }

        if ($message) {
            header('Location: admin.php?msg=' . urlencode($message));
            exit;
        }
    }

    if (isset($_GET['msg'])) {
        $message = urldecode($_GET['msg']);
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        fieldset { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; }
        legend { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Painel Administrativo</h1>
    <p>Bem-vindo, **<?php echo $_SESSION['usuario']; ?>** | <a href="admin.php?action=logout">Sair</a></p>
    
    <small>
    </small>
    <hr>
    
    <h2>Gerenciamento de Perguntas</h2>
    <?php echo $message; ?>

    <fieldset>
        <legend>Adicionar Nova Pergunta</legend>
        <form method="POST" action="admin.php">
            <label for="texto_pergunta">Texto da Pergunta:</label><br>
            <input type="text" id="texto_pergunta" name="texto_pergunta" size="80" required><br><br>
            <button type="submit" name="adicionar_pergunta">Cadastrar Pergunta</button>
        </form>
    </fieldset>
    
    <h3>Perguntas Cadastradas</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Status</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $perguntas = listar_perguntas(); 
            if (empty($perguntas)): ?>
                <tr><td colspan="5">Nenhuma pergunta cadastrada. (Verifique as correções acima!)</td></tr>
            <?php else: 
                foreach ($perguntas as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['texto']; ?></td> 
                    <td style="color: <?php echo $p['status'] === 'ativo' ? 'green' : 'red'; ?>;">
                        <?php echo ucfirst($p['status']); ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($p['data_criacao'])); ?></td> 
                    <td>
                        <a href="admin.php?action_pergunta=toggle&id=<?php echo $p['id']; ?>&status=<?php echo $p['status']; ?>">
                            <?php echo $p['status'] === 'ativo' ? 'Desativar' : 'Ativar'; ?>
                        </a>
                        |
                        <a href="admin.php?action_pergunta=delete&id=<?php echo $p['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja DELETAR esta pergunta?');">
                            Deletar
                        </a>
                    </td>
                </tr>
            <?php endforeach; 
            endif; ?>
        </tbody>
    </table>
    
    <hr>
    
    <h2>Gerenciamento de Dispositivos/Setores</h2>
    
    <fieldset>
        <legend>Adicionar Novo Dispositivo/Setor</legend>
        <form method="POST" action="admin.php">
            <label for="nome_dispositivo">Nome do Setor/Dispositivo:</label><br>
            <input type="text" id="nome_dispositivo" name="nome_dispositivo" size="50" required><br><br>
            <button type="submit" name="adicionar_dispositivo">Cadastrar Dispositivo</button>
        </form>
    </fieldset>

    <h3>Dispositivos/Setores Cadastrados</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $dispositivos = listar_dispositivos(); 
            if (empty($dispositivos)): ?>
                <tr><td colspan="4">Nenhum dispositivo/setor cadastrado.</td></tr>
            <?php else: 
                foreach ($dispositivos as $d): ?>
                <tr>
                    <td><?php echo $d['id']; ?></td>
                    <td><?php echo $d['nome_dispositivo']; ?></td>
                    <td style="color: <?php echo $d['status'] === 'ativo' ? 'green' : 'red'; ?>;">
                        <?php echo ucfirst($d['status']); ?>
                    </td>
                    <td>
                        <a href="admin.php?action_dispositivo=toggle&id=<?php echo $d['id']; ?>&status=<?php echo $d['status']; ?>">
                            <?php echo $d['status'] === 'ativo' ? 'Desativar' : 'Ativar'; ?>
                        </a>
                         | 
                        <a href="admin.php?action_dispositivo=delete&id=<?php echo $d['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja DELETAR este dispositivo?');">
                            Deletar
                        </a>
                    </td>
                </tr>
            <?php endforeach; 
            endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php
} else {

}
?>