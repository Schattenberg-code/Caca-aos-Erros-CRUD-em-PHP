<?php

include('../infra/conexao.php');

$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome, email) VALUES (?,?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $nome, $email);
$stmt->execute();

header("location: ../index.php");
