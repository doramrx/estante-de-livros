<?php

class Editora{
  private $id;
  private $nome;
  private $cidade;
  private $telefone;
  private $email;
  private $website;

  function __construct($id, $nome, $cidade, $telefone, $email, $website){
    $this->id = $id;
    $this->nome = $nome;
    $this->cidade = $cidade;
    $this->telefone = $telefone;
    $this->email = $email;
    $this->website = $website;
  }
  
  //NÃO PRECISAMOS DAS FUNÇÕES SETTERS, POIS UTILIZAMOS O SQL PARA PEGAR OS DADOS.
  // public function setId($id){
  //   $this->id=$id;
  // }
  // public function setNome($nome){
  //   $this->nome=$nome;
  // }
  // public function setCidade($cidade){
  //   $this->cidade = $cidade;
  // }
  // public function setEmail($email){
  //   $this->email=$email;
  // }
  // public function setWebsite($website){
  //   $this->website=$website;
  // }

  public function getId(){
    return $this->id;
  }

  public function getNome(){
    return $this->nome;
  }
  public function getCidade(){
    return $this->cidade;
  }
  public function getTelefone(){
    return $this->telefone;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getWebsite(){
    return $this->website;
  }

}

?>