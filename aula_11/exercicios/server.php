<?php
$nomeArquivo = "pessoas.json";

$novaPessoa = [
    "nome" => $_POST['nome'],
    "sobrenome" => $_POST['sobrenome'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha'], 
    'cidade' => $_POST['cidade'],
    'estado' => $_POST['estado'],
];

if (file_exists($nomeArquivo)) {
    $dadosArquivo = file_get_contents($nomeArquivo);
    
    $listaPessoas = json_decode($dadosArquivo, true);

    if (!is_array($listaPessoas)) {
        $listaPessoas = [];
    }
} else {
    $listaPessoas = [];
}

$listaPessoas[] = $novaPessoa;


$dadosCodificados = json_encode($listaPessoas, JSON_PRETTY_PRINT);

if (file_put_contents($nomeArquivo, $dadosCodificados)) {
    echo "Pessoa salva com sucesso!";
    echo '<br><a href="Exercicio_03.html">Voltar ao formulário</a>';
} else {
    echo "Erro ao salvar os dados no arquivo.";
}

?>