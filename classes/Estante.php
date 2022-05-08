<?php

class Estante{
  private $listaLivros = array(); //criando a lista de livros em array.


  //função para adicionar um novo livro no array lista de livros
  public function adicionar($umLivro){ //passando um livro como parâmetro
    if($umLivro instanceof Livro){ //verifica se a variável passada é uma instância da classe Livro
      array_push($this->listaLivros, $umLivro); //array_push serve para juntar itens em array, primeiro parâmetro ($this->listaLivros) 
                                                // é o array que possui os itens 
    }                                           //segundo parâmetro ($umLivro) é o item a ser adicionado no array.
  }

  //função para obter o tamanho da lista, quantos livros a lista possui
  public function obterQuantidade(){
    return sizeof($this->listaLivros); //sizeof conta o número de elementos contidos no array
  }
  //função para pegar um livro especifico da lista
  public function pegarLivro($posicao){
    if($posicao < $this->obterQuantidade() && $posicao >= 0){ //verificando se a posição é válida (deve ser menor que o numero de elementos e maior ou igual a 0)
      return $this->listaLivros[$posicao];                    // a função retorna um elemento livro contido na lista de livros de acordo com a posição solicitada
    }else{
      return -1;  //se não, retorna -1, para indicar q a posição passada não existe
    }
  }

}
