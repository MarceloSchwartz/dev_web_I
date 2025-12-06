<?php 
    //Incluindo o arquivo classe Pessoa
    require_once "pessoa.php";

    //Instânciando a classe Pessoa
    $pessoa = new Pessoa();
    $pessoa->getNome("Mateus");
    $pessoa->getSobreNome("Oliveira");

    echo $pessoa->getNomeCompleto();

    
?>