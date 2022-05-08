<?php
include_once "./database/consultaSQL.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos/detalhes.css">
  <title>Editora</title>
</head>

<body>
  <h1>Detalhes da Editora</h1>
  <div class="conteudo">
    <?php
    if (isset($_GET['idEditora'])) { //verificando se o idEditora foi passado pela URL
      $idEditora = $_GET['idEditora']; //atribuindo o valor do id na variável $idEditora
      $editora = getEditoraById($idEditora); //passando o id para a função getEditoraById para consultar os dados no banco

      if ($editora != null) { //se o retorno da função for diferente de null, imprime os dados da editora na página:
        echo "<p><strong>Nome:</strong> " . $editora->getNome() . "</p>";
        echo "<p><strong>Cidade:</strong> " . $editora->getCidade() . "</p>";
        echo "<p><strong>Telefone:</strong> " . $editora->getTelefone() . "</p>";
        echo "<p><strong>Email:</strong> " . $editora->getEmail() . "</p>";
        echo "<p><strong>Website:</strong> " . $editora->getWebsite() . "</p>";
      } else {
        echo "<br>";
        echo "Não existe uma editora com esse Id"; //se não, exibe mensagem de erro
        echo "<br>";
      }
    }
    ?>
    <a class="botao" href="EstanteVirtual.php">Voltar</a> <!-- botão para voltar à estante virtual -->
  </div>
</body>

</html>