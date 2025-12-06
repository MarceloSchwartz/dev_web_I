<?php 
    require_once('contato.php');
    require_once('endereco.php');
    require_once('pessoa.php');

    echo "<h3>Execução do Exercício 1</h3>";


    $meuEndereco = new Endereco();
    $meuEndereco->setLogradouro("Rua das Flores");
    $meuEndereco->setBairro("Centro");
    $meuEndereco->setCidade("Rio do Sul");
    $meuEndereco->setEstado("SC");
    $meuEndereco->setCep("89160-000");

    $meuContato = new Contato();
    $meuContato->setTipo(1); 
    $meuContato->setNome("WhatsApp");
    $meuContato->setValor("(47) 99999-8888");


    $eu = new Pessoa();
    $eu->inicializaClasse(); 

    $eu->setNome("Mateus");      
    $eu->setSobrenome("Oliveira");   
    $eu->setDataNascimento("1995-10-25");
    $eu->setCpfcnpj("123.456.789-00");
    $eu->setTipo(1); 


    $eu->setEndereco($meuEndereco);
    $eu->setTelefone($meuContato);

    echo "<hr>";
    echo "<strong>Nome Completo:</strong> " . $eu->getNomeCompleto() . "<br>";
    echo "<strong>Idade:</strong> " . $eu->getIdade() . " anos<br>";
    echo "<strong>CPF:</strong> " . $eu->getCpfcnpj() . "<br>";

    echo "<strong>Cidade:</strong> " . $eu->getEndereco()->getCidade() . "/" . $eu->getEndereco()->getEstado() . "<br>";

    echo "<strong>Contato:</strong> " . $eu->getTelefone()->getValor();
?>