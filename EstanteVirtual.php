<?php
include_once "./database/consultaSQL.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos/style.css">
  <title>Estante Virtual</title>
</head>
<body>
    <h1>Estante Virtual</h1>
    <section class="container">
      <table>
        <thead>
          <tr>
            <th>Nome Livro</th>
            <th>Nome Autor</th>
            <th>Nome Editora</th>
            <th>Detalhes</th>
          </tr>
        </thead>
        <tbody>
        <?php
          //criamos uma variável que chama função getEstanteVirtual, que retorna um objeto do tipo Estante
          $estante = getEstanteVirtual();

          //laço for para ler os livros armazenados na estante
          for ($i = 0; $i < $estante->obterQuantidade(); $i++) { //enquanto $i for menor que a quantidade de livros na estante
            $livro = $estante->pegarLivro($i); //variável $livro usa o método pegarLivro pelo indice que está sendo lido 

            echo "<tr>";
            echo "<td>" . $livro->getTitulo() . "</td>";
            echo "<td>";
            foreach ($livro->getAutores() as $autor) { //laço foreach para pegar o array de autores do livro e ler cada um separadamente
              echo "<p>" . $autor->getNome() . "</p>";
            }
            echo "</td>";
            echo "<td>";
            echo "<p>";
            echo "<a href='http://localhost:8080/ExerciciosPPI2/EstantedeLivros/detalhesEditora.php?idEditora=" . $livro->getEditora()->getId() . "'>"; //imprime nome da editora linkando a página de detalhes da editora
            echo $livro->getEditora()->getNome();
            echo "</a>";
            echo "</p>";
            echo "</td>";
            echo "<td>";
            echo "<a href='detalhesLivro.php?idLivro=" . $livro->getId() . "'>"; //link para a página de detalhes do livro, passando o id do livro 
            echo "<img src='./icon/lupa.png' alt='Detalhes' />";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </section>
</body>
</html>