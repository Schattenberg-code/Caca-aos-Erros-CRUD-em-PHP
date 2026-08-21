<?php
include ("infra/conexao.php");

$sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuários</title>
</head>

<body>

    <h1>Cadastro de Usuários</h1>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>E-mail:</label>
        <input type="email" name="email" required>
        <br><br>

        <button type="submit" name="cadastrar">
            Cadastrar
        </button>

    </form>

    <h2>Usuários Cadastrados</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        <?php while ($usuario = $resultado->fetch_assoc()) { ?>
            <tr>

                <td>
                    <?= $usuario['id'] ?>
                </td>

                <td>
                    <?= $usuario['nome'] ?>
                </td>

                <td>
                    <?= $usuario['email'] ?>
                </td>

                <td>
                    <a href="index.php?excluir=<?= $usuario['id'] ?>">
                        Excluir
                    </a>
                </td>

            </tr>
        <?php } ?>

    </table>

</body>

</html>