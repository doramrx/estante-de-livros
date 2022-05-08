<?php
include_once "database.php";
include_once "./classes/Autor.php";
include_once "./classes/Editora.php";
include_once "./classes/Livro.php";
include_once "./classes/Estante.php";


//função chamada no arquivo: detalhesAutor.php
function getAutorById($id)
{
	global $conn; //chama variavel de conexão com o banco, utiliza-se a palavra global para esta variável ser acessada.
	              //como o $conn não foi criado nesta função nem neste arquivo, precisa ser usado o termo na frente 'global'

	//variável query guarda String com consulta ao Banco de dados
	$query = "SELECT codigo, nome, email, website FROM autor WHERE codigo = ?"; //utilizamos o '?' onde o $id será identificado

	//inicia-se a variável $stmt com a conexão com o banco de dados e
	//utilizando o prepare() para preparar o $query (instruções SQL) no banco
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id); // o bind_param recebe como argumento uma referência 'i', indicando que o valor a ser passado é um inteiro ($id)
	$stmt->execute(); //executando o $stmt com o execute();
	$result = $stmt->get_result(); //$stmt pega o resultado da consulta pelo get_result() e atribuí à variável result o resultado

	//verificando se o número de linhas do $result é maior que Zero, ou seja, retornou pelo menos 1 ou mais linhas
	if ($result->num_rows > 0) {
		$dadosAutor = $result->fetch_assoc(); //cria-se a variável que armazena os dados das linhas ($dadosAutor)
		//utiliza-se o fetch_assoc() para dar a cada indice do array o nome da coluna referente

		//instanciamos o objeto autor passando os indices de cada coluna para o array dadosAutor
		$autor = new Autor(
			$dadosAutor["codigo"],
			$dadosAutor["nome"],
			$dadosAutor["email"],
			$dadosAutor["website"]
		);

		return $autor; //retorna objeto autor
	} else {
		return null; //ou retorna null caso não haja nenhum resultado para o id passado
	}
}

//função chamada no arquivo: detalhesEditora.php
function getEditoraById($id)
{
	global $conn; //chama variavel de conexão com o banco, utiliza-se a palavra global para esta variável ser acessada.
				  //como o $conn não foi criado nesta função nem neste arquivo, precisa ser usado o termo na frente 'global'

	//variável query guarda String com consulta ao Banco de dados
	$query = "SELECT codigo, nome, cidade, telefone, email, website FROM editora WHERE codigo = ?"; //utilizamos o '?' onde o $id será identificado

	//inicia-se a variável $stmt com a conexão com o banco de dados e
	//utilizando o prepare() para preparar o $query (instruções SQL) no banco
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id); // o bind_param recebe como argumento uma referência 'i', indicando que o valor a ser passado é um inteiro ($id)
	$stmt->execute(); //executando o $stmt com o execute();
	$result = $stmt->get_result(); //$stmt pega o resultado da consulta pelo get_result() e atribuí à variável result o resultado

	//verificando se o número de linhas do $result é maior que Zero, ou seja, retornou pelo menos 1 ou mais linhas
	if ($result->num_rows > 0) { 
		$dadosEditora = $result->fetch_assoc(); //cria-se a variável que armazena os dados das linhas ($dadosEditora) 
		//utiliza-se o fetch_assoc() para dar a cada indice do array o nome da coluna referente

		//instanciamos o objeto editora passando os indices de cada coluna para o array dadosEditora
		$editora = new Editora(
			$dadosEditora["codigo"],
			$dadosEditora["nome"],
			$dadosEditora["cidade"],
			$dadosEditora["telefone"],
			$dadosEditora["email"],
			$dadosEditora["website"]
		);

		return $editora; //retorna objeto editora
	} else {
		return null; //ou retorna null caso não haja nenhum resultado para o id passado
	}
}

//função chamada no arquivo: detalhesLivro.php
function getLivroById($id)
{
	global $conn;//chama variavel de conexão com o banco, utiliza-se a palavra global para esta variável ser acessada.
				 //como o $conn não foi criado nesta função nem neste arquivo, precisa ser usado o termo na frente 'global'

	//variável query guarda String com consulta ao Banco de dados
	$query = "SELECT 
	 				 (liv.codigo) cod_livro, 
					 liv.titulo,
					 liv.isbn,
					 liv.numpaginas,
					 liv.numEdicao,
					 liv.anopublicacao,
					 (liv.cod_editora) cod_editora,
					 (edi.nome) nome_editora,
					 (liv_aut.cod_autor) cod_autor,
					 (aut.nome) nome_autor
					 FROM livro liv
					 JOIN editora edi ON edi.codigo = liv.cod_editora
					 JOIN livro_autor liv_aut ON liv_aut.codi_livro = liv.codigo
					 JOIN autor aut ON aut.codigo = liv_aut.cod_autor 
					 WHERE liv.codigo = ?";  //utilizamos o '?' onde o $id será identificado

	//apelidei a tabela Livro de liv, Editora de edi, livro_autor de liv_aut e autor de aut
	//nomeei a coluna codigo de cada tabela para codigo_<nome-tabela>
	//nomeei a coluna nome de cada tabela para nome_<nome-tabela>
	//utilizei o Join para juntar as tabelas editora, livro_autor e autor na tabela livro, por meio de seus codigos.


	//inicia-se a variável $stmt com a conexão com o banco de dados e
	//utilizando o prepare() para preparar o $query (instruções SQL) no banco
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $id); // o bind_param recebe como argumento uma referência 'i', indicando que o valor a ser passado é um inteiro ($id)
	$stmt->execute(); //executando o $stmt com o execute();
	$result = $stmt->get_result(); // $stmt pega o resultado da consulta pelo get_result() e atribui à variável result o resultado

	//verificando se o número de linhas do $result é maior que Zero, ou seja, retornou pelo menos 1 ou mais linhas
	if ($result->num_rows > 0) {
		$dadosLivro = $result->fetch_all(MYSQLI_ASSOC); //cria-se a variável que armazena os dados das linhas ($dadosLivro) 
		//utiliza-se o fetch_all(MYSQLI_ASSOC) para dar a cada indice do array o nome da coluna referente

		//print_r($dadosLivro);
		
		$editora = new Editora(
			$dadosLivro[0]['cod_editora'],
			$dadosLivro[0]['nome_editora'],
			null,
			null,
			null,
			null
		);

		$listaAutoresDoLivro = array();

		foreach ($dadosLivro as $dadosAutor) {
			$autor = new Autor(
				$dadosAutor['cod_autor'],
				$dadosAutor['nome_autor'],
				null,
				null
			);
			array_push($listaAutoresDoLivro, $autor);
		}

		$livro = new Livro(
			$dadosLivro[0]['cod_livro'],
			$dadosLivro[0]['titulo'],
			$dadosLivro[0]['isbn'],
			$dadosLivro[0]['numpaginas'],
			$dadosLivro[0]['anopublicacao'],
			$dadosLivro[0]['numEdicao'],
			$editora,
			$listaAutoresDoLivro
		);

		return $livro;
	} else {
		return null;
	}
}

//função chamada no arquivo principal: EstanteVirtual.php
function getEstanteVirtual()
{
	global $conn; //chama variavel de conexão com o banco, utiliza-se a palavra global para esta variável ser acessada.
	              //como o $conn não foi criado nesta função nem neste arquivo, precisa ser usado o termo na frente 'global'

	//variável query guarda String com consulta ao Banco de dados
	$query = "SELECT 
			  	(liv.codigo) cod_livro,
			  	liv.titulo,
					liv.isbn,
					liv.numpaginas,
					liv.numEdicao,
					liv.anopublicacao,
					(liv.cod_editora) cod_editora,
					(edi.nome) nome_editora,
					(liv_aut.cod_autor) cod_autor,
					(aut.nome) nome_autor
					FROM livro liv
					JOIN editora edi ON edi.codigo = liv.cod_editora
					JOIN livro_autor liv_aut ON liv_aut.codi_livro = liv.codigo
					JOIN autor aut ON aut.codigo = liv_aut.cod_autor";

	//apelidei a tabela Livro de liv, Editora de edi, livro_autor de liv_aut e autor de aut
	//nomeei a coluna codigo de cada tabela para codigo_<nome-tabela>
	//nomeei a coluna nome de cada tabela para nome_<nome-tabela>
	//utilizei o Join para juntar as tabelas editora, livro_autor e autor na tabela livro, por meio de seus codigos.

	//inicia-se a variável $stmt com a conexão com o banco de dados e
	//utilizando o prepare() para preparar o $query (instruções SQL) no banco
	$stmt = $conn->prepare($query);
	$stmt->execute(); //executando o $stmt com o execute();
	$result = $stmt->get_result(); // $stmt pega o resultado da consulta pelo get_result() e atribui à variável result o resultado

	//verificando se o número de linhas do $result é maior que Zero, ou seja, retornou pelo menos 1 ou mais linhas
	if ($result->num_rows > 0) {
		$dadosLivros = $result->fetch_all(MYSQLI_ASSOC); //cria-se a variável que armazena os dados das linhas ($dadosLivros) 
		              //utiliza-se o fetch_all(MYSQLI_ASSOC) para dar a cada indice do array o nome da coluna referente
		
		//está variável será importante para verificar se o próximo livro a ser impresso será diferente ou igual o ultimo impresso,
		//se for igual signigica que há duas rows com o mesmo livro com autores diferentes. Queremos juntar esta row em uma só
		//atribuímos o valor -1 para cair na primeira condição if, levando em consideração que a primeira posição é 0 (primeiro livro a ser impresso).
		$idUltimoLivro = -1;

		$estanteLivros = new Estante(); //instanciamos o objeto estante

		foreach ($dadosLivros as $dadosLivro) { //utiliza-se o laço de repetição foreach para percorrer $dadosLivros separadamente como dados de livro

			if ($idUltimoLivro != $dadosLivro["cod_livro"]) { //verifica-se se o ultimo livro impresso é diferente do que está sendo lido agora

				$idUltimoLivro = $dadosLivro["cod_livro"]; //se sim, atribuimos o id desse novo livro na variável que guarda o ultimo id 

				//instanciamos o objeto editora com o codigo e o nome passados pelos dados do livro
				$editora = new Editora(
					$dadosLivro["cod_editora"],
					$dadosLivro["nome_editora"],
					null,
					null,
					null,
					null
				);
				//instanciamos o objeto autor com o codigo e o nome passados pelos dados do livro
				$autor = new Autor(
					$dadosLivro["cod_autor"],
					$dadosLivro["nome_autor"],
					null,
					null
				);

				//instanciamos o objeto livro com o codigo e o nome passados pelos dados do livro
				//adicionamos a variavel do objeto editora e o array de objetos autor, pois um livro pode ter varios autores
				$livro = new Livro(
					$dadosLivro["cod_livro"],
					$dadosLivro["titulo"],
					null,
					null,
					null,
					null,
					$editora,
					array($autor)
				);

				$estanteLivros->adicionar($livro); //usamos o método adicionar() para colocar este livro dentro da estante

			} else { //caso o novo livro seja o mesmo que o último lido, entra na condição else

				//coletamos o indice do ultimo livro pelo método obterQuantidade() -1, pois o indice começa em 0, ou seja, 
				//se a lista de livros tiver 3 elementos, o ultimo estará na posição 2 (0, 1, 2) 
				$indiceUltimoLivroInserido = $estanteLivros->obterQuantidade() - 1;

				//instanciamos mais um objeto autor para o livro
				$autor = new Autor(
					$dadosLivro["cod_autor"],
					$dadosLivro["nome_autor"],
					null,
					null
				);

				//utilizamos o método adicionarAutor() passando o novo autor criado
				//utilizamos o médoto pegarLivro() passando como parametro o indice do ultimo livro
				$estanteLivros->pegarLivro($indiceUltimoLivroInserido)->adicionarAutor($autor);
			}
		}
	}
	//a função retorna o objeto estante
	return $estanteLivros;
}
