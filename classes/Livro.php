<?php
include_once  'Autor.php';
include_once  'Editora.php';

class Livro{
  private $id;
  private $titulo;
  private $isbn;
  private $nPaginas;
  private $anoPublicacao;
  private $numEdicao;
  private $editora;
  private $autores;

  function __construct($id, $titulo, $isbn, $nPaginas, $anoPublicacao, $numEdicao, $editora, $autores){
    $this->id = $id;
    $this->titulo = $titulo;
    $this->isbn = $isbn;
    $this->nPaginas = $nPaginas;
    $this->anoPublicacao = $anoPublicacao;
    $this->numEdicao = $numEdicao;
    $this->editora = $editora;
    $this->autores = $autores;
  }

  public function getId(){
    return $this->id;
  }

  public function getTitulo(){
    return $this->titulo;
  }

  public function getIsbn(){
    return $this->isbn;
  }

  public function getnPaginas(){
    return $this->nPaginas;
  }

  public function getanoPublicacao(){
    return $this->anoPublicacao;
  }

  public function getnumEdicao(){
    return $this->numEdicao;
  }

  public function getEditora(){
    return $this->editora;
  }

  public function getAutores(){
    return $this->autores;
  }

  //esta função é necessária para o caso de houver varios autores para um livro
  //utiliza-se o array_push para adicionar ao array de autores o autor passado por parâmetro
  public function adicionarAutor($autor) {
    array_push($this->autores, $autor);
  }
}
