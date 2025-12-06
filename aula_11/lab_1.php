<?php 
    $connectionString = "host=localhost port=5432 dbname=local user=postgres password=123456";
    $connection = pg_connect($connectionString);

    if($connection){
        echo "Database conectado com sucesso!";
        echo "<br>";

        $result = pg_query($connection, "SELECT COUNT(*) AS QTDTABS FROM tbpessoa");
        
        if($result){
            $row = pg_fetch_assoc($result);
            echo "Quantidade de tabelas no database " . $row['qtdtabs'];
        }else{
            echo "Erro ao executar a consulta";
        }

        $aDadosPessoa = array('João', 'Silva', 'joao@unidavi.edu.br', '123456' ,'São Paulo','SP');

        $resultInsert = pg_query_params($connection, 'INSERT INTO TBPESSOA (pesnome, pessobrenome, pesemail, pespassword, pescidade, pesestado)  VALUES ($1, $2, $3, $4, $5, $6)', $aDadosPessoa);
        if($resultInsert){
            echo "<br>";
            echo "Dados Inseridos!";
        }else{
            echo "Erro ao inserir!";
        };
    }else{
        echo "Erro ao conectar ao Database";   
    }
?>