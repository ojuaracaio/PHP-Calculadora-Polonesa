<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Notação Polonesa Inversa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
<body>
<row>
        <div class = "col-4 offset-4">
            <br>
        <form action="" method="POST">
        <div class="form-group">
          <label for="entrada"><b>Insira aqui a notação a ser calculada</b></label>
          <input type="text" class="form-control" name="entrada" placeholder="Use o formato A B C + + (equivalente a A+B+C)">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
      </form>
</row>
<row>
<div style="text-align:center" class = "col-4 offset-4">
<?php
require_once("pilha.php");
$pilha = new Pilha();
@$entrada = $_POST["entrada"];
$lista_operacoes = explode(" ", $entrada); //quebra a string pelos espaços
$digitado = "";

try {
foreach($lista_operacoes as $chave=>$valor) {
  if ($valor !== "" && $valor !== " ") { //ignora os espaços em branco adicionais
    if (is_numeric($valor)) {
      $pilha->empilhar($valor);
      $digitado = $digitado . $valor . " ";
    } else if($valor === "+") {
      $op1 = $pilha->desempilhar();
      $op2 = $pilha->desempilhar();
      $pilha->empilhar($op1 + $op2);
      $digitado = $digitado . $valor . " ";
    } else if($valor === "-") {
      $op1 = $pilha->desempilhar();
      $op2 = $pilha->desempilhar();
      $pilha->empilhar($op2 - $op1); //inverti eles aqui para calcular corretamente
      $digitado = $digitado . $valor . " ";
    } else if($valor === "*") {
      $op1 = $pilha->desempilhar();
      $op2 = $pilha->desempilhar();
      $pilha->empilhar($op1 * $op2);
      $digitado = $digitado . $valor . " ";
    } else if($valor === "/") {
      $op1 = $pilha->desempilhar();
      $op2 = $pilha->desempilhar();
      $pilha->empilhar($op2 / $op1);// aqui também
      $digitado = $digitado . $valor . " ";
    } else {
      throw new Exception("Valor inválido!");
    };

  };
  //echo "$valor<br>";
};
echo "<br><strong>A expressão digitada foi: </strong><br>", $digitado;
if ($pilha->tamanho() > 1) {
  echo "<br><strong>O resultado é: </strong><br>","Algum operador está faltando!";
} else{
echo "<br><strong>O resultado é: </strong><br>",$pilha->desempilhar();
};
} catch (Exception $e) {

    echo "<br><strong>Erro: </strong><br>",$e->getMessage();
  
};

//Apesar de não tratar todos os erros eu fico feliz que pelo menos funciona o básico =]

?>
</div>
</row>
</body>
</html>