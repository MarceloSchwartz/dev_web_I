==================================================
GUIA RÁPIDO DE INSTALAÇÃO E EXECUÇÃO DO PROJETO
==================================================

PROJETO: Sistema de Avaliação de Qualidade de Serviços
DISCIPLINA: Programação Web 1
ALUNO: Marcelo Schwartz

--------------------------------------------------
1. REQUISITOS NECESSÁRIOS
--------------------------------------------------
- Servidor Web (Xampp/Apache)
- PHP 7.4+
    - Extensões PHP: php-pgsql e php-pdo
- Banco de Dados PostgreSQL 9.x+

--------------------------------------------------
2. ESTRUTURA E CONFIGURAÇÃO DE ARQUIVOS
--------------------------------------------------
1. Coloque os arquivos do projeto (index.php, admin.php, src/, css/, js/) no diretório raiz do seu servidor web (ex: htdocs).
2. Verifique o arquivo 'conexao.php' na raiz do projeto. As credenciais de banco de dados estão configuradas como:
   - Host: localhost
   - DBName: avaliacao
   - User: postgres
   - Password: 1234
   
   SE NECESSÁRIO, ALTERE O USUÁRIO/SENHA EM 'conexao.php' PARA AS SUAS CREDENCIAIS LOCAIS.

--------------------------------------------------
3. CONFIGURAÇÃO DO BANCO DE DADOS
--------------------------------------------------
1. Certifique-se de que o PostgreSQL está rodando.
2. Crie um banco de dados vazio chamado 'avaliacao'.
3. Execute o script de criação de tabelas e dados iniciais. O script está disponível em:
   -> /sql/setup.sql 

   Comando Sugerido (no terminal, após criar o banco):
   psql -U postgres -d avaliacao -f /caminho/do/seu/projeto/sql/setup.sql

--------------------------------------------------
4. ACESSO AO SISTEMA
--------------------------------------------------
1. Formulário de Avaliação (Front-end):
   URL: http://localhost/index.php

2. Painel Administrativo (Retaguarda):
   URL: http://localhost/admin.php
   Credenciais de Teste:
     - Usuário: admin
     - Senha: 123456 (conforme inserido no script SQL)

==================================================