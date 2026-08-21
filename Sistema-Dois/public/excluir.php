<?php
include ("../infra/conexao.php");

if (isset($_GET['excluir'])) {

    $id = $_GET['excluir'];

    $sql = 'DELETE FROM produtos WHERE id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: index.php');
    exit;
}