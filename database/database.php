<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estante";

// Criando a conexão com o banco com o mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Checando a conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>