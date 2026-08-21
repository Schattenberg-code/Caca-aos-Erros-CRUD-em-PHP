<?php

include('../infra/conexao.php');

    $id = $_GET['excluir'];


$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("location: ../index.php");
