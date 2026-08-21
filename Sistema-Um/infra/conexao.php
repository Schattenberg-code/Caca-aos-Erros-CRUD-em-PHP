<?php

$host = "localhost";
$user = "root";
$password = "root";
$database = "crud_aula";

$conexao = new mysqli($host, $user, $password, $database);

if ($conexao->connect_error){
    die("Erro de conexão: " . $conexao->connect_error);
}
