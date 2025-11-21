<?php
date_default_timezone_set('America/Sao_Paulo');

function getDbConnection() {
    $host = "localhost";
    $dbname = "avaliacao";
    $user = "postgres";
    $password = "1234";

    try {
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch(PDOException $e) {
        error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
        die("Não foi possível conectar ao banco de dados. Por favor, tente novamente mais tarde.");
    }
}

$pdo = getDbConnection();
?>