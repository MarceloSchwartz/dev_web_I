<?php
    require_once('../exercicio_01/contato.php');
    require_once('../exercicio_01/endereco.php');
    require_once('../exercicio_01/pessoa.php');
    function criarFamiliar($nome, $sobrenome, $nasc, $rua, $cidade, $tel) {

        $end = new Endereco();
        $end->setLogradouro($rua);
        $end->setCidade($cidade);
        $end->setEstado("SC"); 
        $end->setBairro("Centro");
        $end->setCep("88000-000");


        $contato = new Contato();
        $contato->setTipo(1);
        $contato->setNome("Celular");
        $contato->setValor($tel);

        $p = new Pessoa();
        $p->setNome($nome);
        $p->setSobrenome($sobrenome);
        $p->setDataNascimento($nasc);
        $p->setEndereco($end);
        $p->setTelefone($contato);
        
        return $p;
    }


    $listaFamilia = []; 


    $pai = criarFamiliar("Homer", "Simpson", "1956-05-12", "Evergreen Terrace, 742", "Springfield", "(11) 99999-1111");
    $listaFamilia[] = $pai;


    $mae = criarFamiliar("Marge", "Simpson", "1960-10-01", "Evergreen Terrace, 742", "Springfield", "(11) 99999-2222");
    $listaFamilia[] = $mae; 

    $irmao = criarFamiliar("Bart", "Simpson", "2010-04-01", "Evergreen Terrace, 742", "Springfield", "(11) 99999-3333");
    $listaFamilia[] = $irmao; 


    $conteudoDoArquivo = "";

    $conteudoDoArquivo .= "RELATÓRIO DA FAMÍLIA\n";
    $conteudoDoArquivo .= "====================\n\n";

    foreach ($listaFamilia as $indice => $pessoa) {
        $conteudoDoArquivo .= "Membro " . ($indice + 1) . ":\n";
        $conteudoDoArquivo .= "Nome: " . $pessoa->getNomeCompleto() . "\n";
        $conteudoDoArquivo .= "Idade: " . $pessoa->getIdade() . " anos\n";
        $conteudoDoArquivo .= "Cidade: " . $pessoa->getEndereco()->getCidade() . "\n";
        $conteudoDoArquivo .= "Telefone: " . $pessoa->getTelefone()->getValor() . "\n";
        $conteudoDoArquivo .= "--------------------\n";
    }


    $nomeDoArquivo = "familia_dados.txt";


    if (file_put_contents($nomeDoArquivo, $conteudoDoArquivo)) {
        echo "<h3>Sucesso!</h3>";
        echo "O arquivo <strong>$nomeDoArquivo</strong> foi criado com os dados de " . count($listaFamilia) . " pessoas.";
    
        echo "<pre style='background: #f4f4f4; padding: 10px; border: 1px solid #ccc;'>";
        echo $conteudoDoArquivo;
        echo "</pre>";
    } else {
        echo "Erro ao gravar o arquivo.";
    }

    echo "<h3>Gerando Arquivo JSON...</h3>";

    $dadosParaSalvar = [];

    foreach ($listaFamilia as $pessoa) {
        $jsonString = $pessoa->toJson();
        
        $dadosParaSalvar[] = json_decode($jsonString);
    }

    $jsonFinal = json_encode($dadosParaSalvar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $nomeArquivo = 'familia.json';

    if (file_put_contents($nomeArquivo, $jsonFinal)) {
        echo "Sucesso! Arquivo <strong>$nomeArquivo</strong> gerado.<br>";
        echo "<pre> $jsonFinal </pre>";
    } else {
        echo "Erro ao salvar arquivo.";
    }
?>  