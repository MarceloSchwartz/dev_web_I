<?php

session_start(); 

require_once 'src/auth.php';       
require_once 'src/funcoes.php';    

$message = '';
$error_message = '';

if (isset($_GET['msg'])) {
    $message = urldecode($_GET['msg']);
}

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
            $message = "<p class='msg-success'>Pergunta adicionada com sucesso!</p>";
        } else {
            $message = "<p class='msg-error'>Erro ao adicionar pergunta.</p>";
        }
    }

    if (isset($_POST['salvar_edicao'])) {
        $id_edicao = $_POST['id_pergunta'] ?? 0;
        $novo_texto = $_POST['texto_pergunta_edit'] ?? '';
        
        if (editar_pergunta($id_edicao, $novo_texto)) {
            $message = "<p class='msg-success'>Pergunta ID {$id_edicao} editada com sucesso!</p>";
            header('Location: admin.php?msg=' . urlencode($message));
            exit;
        } else {
            $message = "<p class='msg-error'>Erro ao editar pergunta.</p>";
        }
    }

    if (isset($_GET['action_pergunta'])) {
        $id = $_GET['id'] ?? 0;
        $id = (int)$id;

        if ($_GET['action_pergunta'] === 'delete' && $id > 0) {
            if (deletar_pergunta($id)) {
                 $message = "<p class='msg-success'>Pergunta deletada com sucesso!</p>";
            } else {
                 $message = "<p class='msg-error'>Erro ao deletar pergunta.</p>";
            }
        } elseif ($_GET['action_pergunta'] === 'toggle' && $id > 0) {
            $current_status = $_GET['status'] === 'ativo' ? 'inativo' : 'ativo';
            if (alternar_status_pergunta($id, $current_status)) {
                $message = "<p class='msg-success'>Status da pergunta alterado para '$current_status'!</p>";
            } else {
                 $message = "<p class='msg-error'>Erro ao alterar status.</p>";
            }
        }
        if (isset($message)) {
             header('Location: admin.php?msg=' . urlencode($message));
             exit;
        }
    }

    $pergunta_a_editar = null;
    if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
        $id_pergunta = (int)$_GET['id'];
        $pergunta_a_editar = obter_pergunta_por_id($id_pergunta); 
        
        if (!$pergunta_a_editar) {
            $message = "<p class='msg-error'>Pergunta não encontrada para edição.</p>";
        }
    }


    if (isset($_POST['adicionar_dispositivo'])) {
        $novo_nome = $_POST['nome_dispositivo'] ?? '';
        if (adicionar_dispositivo($novo_nome)) {
            $message = "<p class='msg-success'>Dispositivo/Setor adicionado com sucesso!</p>";
        } else {
            $message = "<p class='msg-error'>Erro ao adicionar Dispositivo/Setor.</p>";
        }
    }

    if (isset($_POST['salvar_edicao_dispositivo'])) {
        $id_edicao = $_POST['id_dispositivo_edit'] ?? 0;
        $novo_nome = $_POST['nome_dispositivo_edit'] ?? '';
        
        if (editar_dispositivo($id_edicao, $novo_nome)) {
            $message = "<p class='msg-success'>Dispositivo ID {$id_edicao} editado com sucesso!</p>";
            header('Location: admin.php?msg=' . urlencode($message));
            exit;
        } else {
            $message = "<p class='msg-error'>Erro ao editar dispositivo.</p>";
        }
    }

    if (isset($_GET['action_dispositivo'])) {
        $id = $_GET['id'] ?? 0;
        $id = (int)$id;

        if ($_GET['action_dispositivo'] === 'toggle' && $id > 0) {
            $current_status = $_GET['status'] === 'ativo' ? 'inativo' : 'ativo';
            if (alternar_status_dispositivo($id, $current_status)) {
                $message = "<p class='msg-success'>Status do dispositivo alterado para '$current_status'!</p>";
            } else {
                 $message = "<p class='msg-error'>Erro ao alterar status do dispositivo.</p>";
            }
        } elseif ($_GET['action_dispositivo'] === 'delete' && $id > 0) {
            if (deletar_dispositivo($id)) {
                 $message = "<p class='msg-success'>Dispositivo/Setor deletado com sucesso!</p>";
            } else {
                 $message = "<p class='msg-error'>Erro ao deletar dispositivo/setor. Pode haver avaliações associadas.</p>";
            }
        }
        if (isset($message)) {
             header('Location: admin.php?msg=' . urlencode($message));
             exit;
        }
    }

    $dispositivo_a_editar = null;
    if (isset($_GET['action']) && $_GET['action'] === 'edit_dispositivo' && isset($_GET['id'])) {
        $id_dispositivo = (int)$_GET['id'];
        $dispositivo_a_editar = obter_dispositivo_por_id($id_dispositivo); 
        
        if (!$dispositivo_a_editar) {
            $message = "<p class='msg-error'>Dispositivo/Setor não encontrado para edição.</p>";
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Dashboard</title>
    <link rel="stylesheet" href="css/styles_admin.css"> 
</head>
<body class="admin-body">
    
    <div class="header-admin">
        <h1>Painel Administrativo</h1>
        <div class="user-info">
            <p>Bem-vindo(a), <span class="user-highlight"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span></p>
            <a href="admin.php?action=logout" class="btn-logout">
                Sair
            </a>
        </div>
    </div>
    
    <small>Último acesso: <?php echo $_SESSION['ultimo_acesso']; ?></small>
    <hr>
    
    <?php echo $message; ?>

    <h2>Gerenciamento de Perguntas</h2>
    
    <?php if ($pergunta_a_editar): ?>
        <div class="edit-form-box">
            <h2>✏️ Editando Pergunta ID: <?php echo $pergunta_a_editar['id']; ?></h2>
            
            <form action="admin.php" method="post">
                <input type="hidden" name="id_pergunta" value="<?php echo $pergunta_a_editar['id']; ?>">
                <input type="hidden" name="salvar_edicao" value="1">
                
                <label for="texto_pergunta_edit" class="form-label">Novo Texto da Pergunta:</label><br>
                <textarea name="texto_pergunta_edit" id="texto_pergunta_edit" rows="3" class="form-input form-textarea" required><?php echo htmlspecialchars($pergunta_a_editar['texto']); ?></textarea>
                
                <button type="submit" class="btn btn-primary btn-edit-save" name="salvar_edicao_btn">Salvar Edição</button>
                <a href="admin.php" class="btn-cancel">Cancelar</a>
            </form>
        </div>
        <hr>
    <?php endif; ?>

    <fieldset class="admin-fieldset">
        <legend>Adicionar Nova Pergunta</legend>
        <form method="POST" action="admin.php">
            <label for="texto_pergunta">Texto da Pergunta:</label><br>
            <input type="text" id="texto_pergunta" name="texto_pergunta" size="80" class="form-input" required><br><br>
            <button type="submit" name="adicionar_pergunta" class="btn btn-primary">Cadastrar Pergunta</button>
        </form>
    </fieldset>
    
    <h3>Perguntas Cadastradas</h3>
    <table class="data-table">
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
                <tr><td colspan="5">Nenhuma pergunta cadastrada.</td></tr>
            <?php else: 
                foreach ($perguntas as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['texto']); ?></td> 
                    <td class="status-<?php echo $p['status']; ?>">
                        <?php echo ucfirst($p['status']); ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($p['data_criacao'])); ?></td> 
                    <td>
                        <a href="admin.php?action=edit&id=<?php echo $p['id']; ?>" class="action-link action-edit">
                            Editar
                        </a>
                        <a href="admin.php?action_pergunta=toggle&id=<?php echo $p['id']; ?>&status=<?php echo $p['status']; ?>" 
                           class="action-link action-toggle <?php echo $p['status'] === 'ativo' ? 'inativo' : 'ativo'; ?>">
                            <?php echo $p['status'] === 'ativo' ? 'Desativar' : 'Ativar'; ?>
                        </a>
                        <a href="admin.php?action_pergunta=delete&id=<?php echo $p['id']; ?>" 
                            class="action-link action-delete"
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
    
    <?php if ($dispositivo_a_editar): ?>
        <div class="edit-form-box">
            <h2>✏️ Editando Dispositivo/Setor ID: <?php echo $dispositivo_a_editar['id']; ?></h2>
            
            <form action="admin.php" method="post">
                <input type="hidden" name="id_dispositivo_edit" value="<?php echo $dispositivo_a_editar['id']; ?>">
                <input type="hidden" name="salvar_edicao_dispositivo" value="1">
                
                <label for="nome_dispositivo_edit" class="form-label">Novo Nome do Dispositivo/Setor:</label><br>
                <input type="text" name="nome_dispositivo_edit" id="nome_dispositivo_edit" 
                       class="form-input" value="<?php echo htmlspecialchars($dispositivo_a_editar['nome_dispositivo']); ?>" required>
                
                <button type="submit" class="btn btn-primary btn-edit-save" name="salvar_edicao_btn">Salvar Edição</button>
                <a href="admin.php" class="btn-cancel">Cancelar</a>
            </form>
        </div>
        <hr>
    <?php endif; ?>

    <fieldset class="admin-fieldset">
        <legend>Adicionar Novo Dispositivo/Setor</legend>
        <form method="POST" action="admin.php">
            <label for="nome_dispositivo">Nome do Setor/Dispositivo:</label><br>
            <input type="text" id="nome_dispositivo" name="nome_dispositivo" size="50" class="form-input" required><br><br>
            <button type="submit" name="adicionar_dispositivo" class="btn btn-primary">Cadastrar Dispositivo</button>
        </form>
    </fieldset>

    <h3>Dispositivos/Setores Cadastrados</h3>
    <table class="data-table">
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
                    <td><?php echo htmlspecialchars($d['nome_dispositivo']); ?></td>
                    <td class="status-<?php echo $d['status']; ?>">
                        <?php echo ucfirst($d['status']); ?>
                    </td>
                    <td>
                        <a href="admin.php?action=edit_dispositivo&id=<?php echo $d['id']; ?>" class="action-link action-edit">
                            Editar
                        </a>
                        <a href="admin.php?action_dispositivo=toggle&id=<?php echo $d['id']; ?>&status=<?php echo $d['status']; ?>"
                           class="action-link action-toggle <?php echo $d['status'] === 'ativo' ? 'inativo' : 'ativo'; ?>">
                            <?php echo $d['status'] === 'ativo' ? 'Desativar' : 'Ativar'; ?>
                        </a>
                        <a href="admin.php?action_dispositivo=delete&id=<?php echo $d['id']; ?>" 
                           class="action-link action-delete"
                           onclick="return confirm('Tem certeza que deseja DELETAR este dispositivo?');">
                            Deletar
                        </a>
                    </td>
                </tr>
            <?php endforeach; 
            endif; ?>
        </tbody>
    </table>

    <hr>

    <h2>Dashboard de Visualização das Avaliações</h2>

    <?php 
    $media_geral = calcular_media_geral();
    $total_avaliacoes = count_total_avaliacoes();
    $medias_por_dispositivo = calcular_media_por_dispositivo();
    $feedbacks = listar_feedbacks_textuais();

    $media_geral_float = str_replace(',', '.', $media_geral);
    $media_geral_class = '';
    if ($media_geral_float !== null) {
        if ($media_geral_float >= 7.0) {
            $media_geral_class = 'score-high';
        } elseif ($media_geral_float >= 5.0) {
            $media_geral_class = 'score-medium';
        } else {
            $media_geral_class = 'score-low';
        }
    }
    ?>

    <fieldset class="admin-fieldset">
        <legend>Resumo Geral</legend>
        <div class="dashboard-info">
            <div class="dashboard-card">
                <p>Total de Avaliações Registradas:</p>
                <p class="dashboard-number"><?php echo $total_avaliacoes; ?></p>
            </div>
            <div class="dashboard-card">
                <p>Média Geral de Satisfação:</p>
                <p class="dashboard-number <?php echo $media_geral_class; ?>">
                    <?php echo $media_geral !== null ? $media_geral : 'Erro (Sem Dados)'; ?>
                </p>
                <small>(escala de 0 a 10)</small>
            </div>
        </div>
    </fieldset>

    <h3>Média por Setor/Dispositivo</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Setor/Dispositivo</th>
                <th>Média de Satisfação (0-10)</th>
                <th>Total de Avaliações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($medias_por_dispositivo)): ?>
                <tr><td colspan="3">Nenhuma avaliação encontrada para calcular a média por setor.</td></tr>
            <?php else: 
                foreach ($medias_por_dispositivo as $m): 
                    $media_dispositivo_float = str_replace(',', '.', $m['media_dispositivo']);
                    $media_dispositivo_class = '';
                    if ($media_dispositivo_float >= 7.0) {
                        $media_dispositivo_class = 'score-high';
                    } elseif ($media_dispositivo_float >= 5.0) {
                        $media_dispositivo_class = 'score-medium';
                    } else {
                        $media_dispositivo_class = 'score-low';
                    }
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($m['nome_dispositivo']); ?></td>
                    <td class="dashboard-number-small <?php echo $media_dispositivo_class; ?>">
                        <?php echo $m['media_dispositivo']; ?>
                    </td>
                    <td><?php echo $m['total_avaliacoes']; ?></td>
                </tr>
            <?php endforeach; 
            endif; ?>
        </tbody>
    </table>
    
    <h3>Feedbacks Textuais Recentes (Comentários)</h3>
    <div class="feedback-box-container">
        <?php if (empty($feedbacks)): ?>
            <p>Nenhum feedback textual registrado.</p>
        <?php else: ?>
            <?php foreach ($feedbacks as $f): ?>
                <div class="feedback-box">
                    <p class="feedback-info">
                        <small>
                            <strong>Setor:</strong> <?php echo htmlspecialchars($f['nome_dispositivo']); ?> | 
                            <strong>Pergunta:</strong> <?php echo htmlspecialchars($f['pergunta_texto']); ?> | 
                            <strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($f['data_registro'])); ?>
                        </small>
                    </p>
                    <p class="feedback-text">"<?php echo nl2br(htmlspecialchars($f['feedback_textual'])); ?>"</p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>
<?php
} else {

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo</title>
    <link rel="stylesheet" href="css/styles_admin.css"> 
</head>
<body class="login-body">
    <div class="login-box">
        <h2 class="login-title">Login Administrativo</h2>
        <?php if ($error_message): ?>
            <p class="login-error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="admin.php">
            <label for="usuario" class="login-label">Usuário:</label>
            <input type="text" id="usuario" name="usuario" class="login-input" required>
            
            <label for="senha" class="login-label">Senha:</label>
            <input type="password" id="senha" name="senha" class="login-input" required>
            
            <button type="submit" name="acao" value="Login" class="login-button">Entrar</button>
        </form>
    </div>
</body>
</html>
<?php
}
?>