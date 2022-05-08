<?php

//adicionando os dados manualmente. 
//Não utilizamos mais este arquivo porque coletamos os dados do Banco

include_once './classes/Autor.php';
include_once './classes/Editora.php';
include_once './classes/Estante.php';
include_once './classes/Livro.php';

$editora1 = new Editora(1, 'Editora 1', 'Gaspar', '11 3709-7350', 'editora1@gmail.com', 'www.editora1.com.br/');
$editora2 = new Editora(2, 'Editora 2', 'Gaspar', '47 3488-5130', 'editora2@gmail.com', 'www.editora2.com.br/');


$editoras = array($editora1, $editora2);


$autor1 = new Autor(1, 'Autor 1', 'autor1@gmail.com', 'www.autor1.com');
$autor2 = new Autor(2, 'Autor 2', 'autor2@gmail.com', 'www.autor2.com');
$autor3 = new Autor(3, 'Autor 3', 'autor3@gmail.com', 'www.autor3.com');

$autores = array($autor1, $autor2, $autor3);


$livro1 = new Livro(1, 'Livro 1', 62462615564, 542, 2007, 2, $editora1, array($autor2));
$livro2 = new Livro(2, 'Livro 2', 34265145826, 264, 2013, 4, $editora2, array($autor1, $autor3));
$livro3 = new Livro(3, 'Livro 3', 24521364651, 312, 2002, 1, $editora1, array($autor2));
$livro4 = new Livro(4, 'Livro 4', 64915124351, 754, 2019, 5, $editora2, array($autor3));
$livro5 = new Livro(5, 'Livro 5', 27543142513, 142, 2012, 3, $editora2, array($autor3, $autor2));

$estante = new Estante();
$estante->adicionar($livro1);
$estante->adicionar($livro2);
$estante->adicionar($livro3);
$estante->adicionar($livro4);
$estante->adicionar($livro5);

?>