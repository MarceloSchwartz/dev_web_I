<?php 
    $connectionString = "host=localhost port=5432 dbname=local user=postgres password=123456";
    $connection = pg_connect($connectionString);

    if($connection){
        $result = pg_query($connection, 'SELECT * FROM TBPESSOA');

        if($result){
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
                echo "<td>". htmlspecialchars($row['pescodigo']) . "</td>";
                echo "<td>". htmlspecialchars($row['pesnome']) . "</td>";
                echo "<td>". htmlspecialchars($row['pessobrenome']) . "</td>";
                echo "<td>". htmlspecialchars($row['pesemail']) . "</td>";
                echo "<td>". htmlspecialchars($row['pespassword']) . "</td>";
                echo "<td>". htmlspecialchars($row['pescidade']) . "</td>";
                echo "<td>". htmlspecialchars($row['pesestado']) . "</td>";
                echo "</tr>";
                $row = pg_fetch_assoc($result);
            }
            echo "</table>";
        }
        

        echo "<a href='Exercicio_01.html'>RETORNAR</a>";
    }
?>