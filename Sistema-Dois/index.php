<?php
include ("infra/conexao.php");
$sql = "SELECT id, nome, categoria, preco, estoque
        FROM produtos
        ORDER BY id DESC";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>CRUD de Produtos</title>

</head>

<body>

    <h1>Cadastro de Produtos</h1>


    <!-- ------------------------------
         FORMULÁRIO DE CADASTRO
    ------------------------------ -->

    <form action="public/cadastrar.php" method="POST">

        <label>Nome:</label>

        <input
            type="text"
            name="nome"
            required
        >

        <br><br>

        <label>Categoria:</label>

        <input
            type="text"
            name="categoria"
            required
        >

        <br><br>

        <label>Preço:</label>

        <input
            type="number"
            step="0.01"
            name="preco"
            required
        >

        <br><br>

        <label>Estoque:</label>

        <input
            type="number"
            name="estoque"
            required
        >

        <br><br>

        <button type="submit" name="cadastrar">
            Cadastrar Produto
        </button>

    </form>


    <br>


    <!-- ------------------------------
         LISTAGEM
    ------------------------------ -->

    <h2>Produtos cadastrados</h2>

    <table border="1" cellpadding="5">

        <tr>

            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>

        </tr>

        <?php while ($produto = $resultado->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?= $produto['id'] ?>
                </td>

                <td>
                    <?= $produto['nome'] ?>
                </td>

                <td>
                    <?= $produto['categoria'] ?>
                </td>

                <td>
                    R$ <?= number_format($produto["preco"], 2, ',', '.') ?>
                </td>

                <td>
                    <?= $produto['estoque'] ?>
                </td>

                <td>

                    <a href="public/excluir.php?excluir=<?= $produto['id'] ?>">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>