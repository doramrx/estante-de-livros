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
  <title>Autor</title>
</head>
<body>
  <h1>Detalhes do Autor</h1>
  <div class="conteudo">      
    <?php
       if(isset($_GET['idAutor'])){ //verificando se o idAutor foi passado pela URL
        $idAutor = $_GET['idAutor']; //atribuindo o valor do id na variável $idAutor
        $autor = getAutorById($idAutor); //passando o id para a função getAutorById para consultar os dados no banco

        if($autor != null){ //se o retorno da função for diferente de null, imprime os dados do autor na página:
          echo "<p><strong>Nome:</strong> " . $autor->getNome() . "</p>";
          echo "<p><strong>Email:</strong> " . $autor->getEmail() . "</p>";
          echo "<p><strong>Website:</strong> " . $autor->getWebsite() . "</p>"; 
        }else{
          echo "<br>";
          echo "Não existe um autor com esse Id"; //se não, exibe mensagem de erro
          echo "<br>";
        }
      }
    ?>
    <a class="botao" href="EstanteVirtual.php">Voltar</a> <!-- botão para voltar à estante virtual -->
    </div>
</body>
</html>