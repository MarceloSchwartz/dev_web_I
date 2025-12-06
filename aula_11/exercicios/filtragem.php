<?php 
    $connectionString = "host=localhost port=5432 dbname=local user=postgres password=123456";
    $connection = pg_connect($connectionString);

    if ($connection){
        $userInfo = $_POST['filtroInfo'];
        $sql = "SELECT * FROM TBPESSOA WHERE pesnome ILIKE $1";
        $filtrarValores = "%" . $userInfo . "%";
        $result = pg_query_params($connection, $sql, array($filtrarValores));

        if ($result){
                $nRow = pg_num_rows($result);

                if ($nRow > 0){
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Código</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Sobrenome</th>";
                    echo "<th>E-mail</th>";
                    echo "<th>Senha</th>";
                    echo "<th>Cidade</th>";
                    echo "<th>Estado</th>";
                    echo "</tr>";

                    while($row = pg_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>". $row['pescodigo'] . "</td>";
                        echo "<td>". $row['pesnome'] . "</td>";
                        echo "<td>". $row['pessobrenome'] . "</td>";
                        echo "<td>". $row['pesemail'] . "</td>";
                        echo "<td>". $row['pespassword'] . "</td>";
                        echo "<td>". $row['pescidade'] . "</td>";
                        echo "<td>". $row['pesestado'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "Nenhum resultado encontrado com o nome " . $userInfo;
                }
        }else{
            echo "Erro ao executar a consulta!";
        }
    
    echo "<a href='/Aula_11/Exercicios/Exercicio_01.html'>⬅️RETORNAR</a>";
    }else{
        echo "Não foi possível se conectar ao banco !";
    }
?>