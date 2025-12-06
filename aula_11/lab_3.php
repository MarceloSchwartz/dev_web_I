<?php 
    define('arquivo', 'dados.txt');
    define('arquivo2', 'dados.txt');

    if(file_exists(arquivo)){
        echo "<br>";
        echo "Arquivo Encontrado";
        $conteudo = file_get_contents(arquivo);
        echo "----------------------<br>";
        echo nl2br($conteudo);

        file_put_contents(arquivo2, serialize($conteudo), FILE_APPEND);
        echo "Conteúdo gravado com sucesso";
    }else{
        echo "Arquivo não encontrado";
    }
?>