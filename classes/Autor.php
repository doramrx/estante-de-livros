<?php

class Autor
{
  private $id;
  private $nome;
  private $email;
  private $website;

  function __construct($id, $nome, $email, $website)
  {
    $this->id = $id;
    $this->nome = $nome;
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
  public function getEmail(){
    return $this->email;
  }
  public function getWebsite(){
    return $this->website;
  }
}
