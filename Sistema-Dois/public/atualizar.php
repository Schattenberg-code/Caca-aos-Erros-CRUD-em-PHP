<?php
include ("../infra/conexao.php");

if (isset($_POST['atualizar'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = 'UPDATE usuarios SET nome = ?, email = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssi", $nome, $email, $id);
    $stmt->execute();

    header('Location: index.php');
    exit;
}