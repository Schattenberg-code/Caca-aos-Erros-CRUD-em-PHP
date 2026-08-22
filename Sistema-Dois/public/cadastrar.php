<?php
include ("../infra/conexao.php");

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = 'INSERT INTO produtos (nome, categoria, preco, estoque) VALUES (?,?,?,?)';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssdi", $nome, $categoria, $preco, $estoque);
    $stmt->execute();

    header('Location: ../index.php');
    exit;
}