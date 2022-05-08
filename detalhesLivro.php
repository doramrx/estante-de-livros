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
  <title>Detalhes</title>
</head>
<body>
  <h1>Detalhes do Livro</h1>
  <div class="conteudo">
    <?php

    if(isset($_GET['idLivro'])){ //verificando se o idLivro foi passado pela URL
      $idLivro = $_GET['idLivro']; //atribuindo o valor do id na variável $idLivro

      $livro = getLivroById($idLivro); //passando o id para a função getLivroById para consultar os dados no banco

      //imprimimos os dados coletados
      echo "<p><strong>ISBN:</strong> " . $livro->getIsbn() . "</p>";
      echo "<p><strong>Título:</strong> " . $livro->getTitulo() . "</p>";
      echo "<p><strong>Num. Páginas:</strong> " . $livro->getnPaginas() . "</p>";
      echo "<p><strong>Edição:</strong> " . $livro->getnumEdicao(). "</p>";
      echo "<p><strong>Ano:</strong> " . $livro->getanoPublicacao() . "</p>";
      echo "<p>";
      //link para a página de detalhes da editora
      echo "<strong>Editora: </strong>";
      echo "<a href='http://localhost:8080/ExerciciosPPI2/EstantedeLivros/detalhesEditora.php?idEditora=" . $livro->getEditora()->getId() . "'>";
      echo $livro->getEditora()->getNome();
      echo "</a>";
      echo "</p>";
      echo "<p><strong>Autor(es):</strong> </p>";
      echo "<p>";
      // echo "<ul type='none'>";
      foreach($livro->getAutores() as $autor){ //percorrendo o array de autores do livro para imprimir sepacadamente cada um
        // echo "<li>";
        
        //link para a página de detalhes do autor
        echo "<a href='http://localhost:8080/ExerciciosPPI2/EstantedeLivros/detalhesAutor.php?idAutor=" . $autor->getId() . "'>"  . $autor->getNome() . "; </a>";
        // echo "</li>";
      }
      echo "</p>";
      // echo "</ul>";
    }
    ?>
      <a class="botao" href="EstanteVirtual.php">Voltar</a> <!-- botão para voltar à estante virtual -->
  </div>
</body>
</html>