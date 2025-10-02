<?php // PRATICA 1

define("NOME_CONST", "Marcelo");
define("SOBRENOME_CONST", "Schwartz");

$NOME = NOME_CONST . " " . SOBRENOME_CONST;

echo "Nome completo: " . $NOME;

?>

<hr>

<?php // PRATICA 2

$SALARIO1 = 1000;
$SALARIO2 = 2000;

$SALARIO2 = $SALARIO1;

$SALARIO2 ++;

$SALARIO1 = $SALARIO1 + ($SALARIO1 * 0.10); 

echo "Valor Salário 1: " . $SALARIO1 . "  Valor Salário 2: " . $SALARIO2;

?>

<hr>

<?php // PRATICA 3

$SALARIO1 = 1000;
$SALARIO2 = 2000;

$SALARIO2 = $SALARIO1;

$SALARIO2 ++;

$SALARIO1 = $SALARIO1 + ($SALARIO1 * 0.10);

if ($SALARIO1 > $SALARIO2) {
    echo "Salário 1 é maior que Salário 2";
} elseif ($SALARIO2 < $SALARIO1) {
    echo "Salário 2 é maior ou igual a Salário 1";
} else {
    echo "Salários são iguais";
}

?>

<hr>

<?php // PRATICA 4

$SALARIO1 = 1000;
$SALARIO2 = 2000;

$SALARIO2 = $SALARIO1;

$SALARIO2 ++;

$SALARIO1 = $SALARIO1 + ($SALARIO1 * 0.10); 

for ($i = 0; $i < 100; $i++) {
   $SALARIO1++;
   
   if ($i == 50) {
       break;
   }      
} 

if ($SALARIO1 < $SALARIO2) {
    echo "Valor Salário 1: " . $SALARIO1 . " é menor que Valor Salário 2: " . $SALARIO2;
} else {
    echo "Valor Salário 1: " . $SALARIO1 . ",Valor Salário 2: " . $SALARIO2;
}

?>

<hr>

<?php // TESTE

    $idade = array("João" => "35", "Maria" => "37", "José" => "43");
foreach($idade as $chave => $valor) {
echo "Chave=" . $chave . ", Valor=" . $valor;
echo "<br>";
}

?>

<hr>

<?php // PRATICA 5

    $disciplina = array("Prog. Web I", "Prog. Web II", "Banco de Dados I", "Banco de Dados II");
    $professores = array("Marco", "Cleber", "Julian", "Carlos");

    for ($i = 0; $i < count($disciplina); $i++) {
        echo "Disciplina: " . $disciplina[$i] . " - Professor: " . $professores[$i];
        echo "<br>";
    }

?>

<hr>

<html> 
<body>
    <table border="1">
        <tr>
            <th>Disciplina</th>
            <th>Faltas</th>
            <th>Média</th>
        </tr>
        <?php
        // PRATICA 6
        $boletim = array(
            array("disciplina" => "Matematica", "Faltas" => 5, "Média" => 8.5),
            array("disciplina" => "Portugues", "Faltas" => 2, "Média" => 9),
            array("disciplina" => "Geografia", "Faltas" => 10, "Média" => 6),
            array("disciplina" => "Educaçao Fisica", "Faltas" => 2, "Média" => 8)
        );

        foreach ($boletim as $linha) {
            echo "<tr>";
            echo "<td>" . $linha['disciplina'] . "</td>";
            echo "<td>" . $linha['Faltas'] . "</td>";
            echo "<td>" . $linha['Média'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
