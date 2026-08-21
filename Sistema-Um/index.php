<?php
include('infra/conexao.php');

$sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main>
        <h1>Cadastro de Usuários</h1>

        <form action="public/cadastrar.php" method="POST">

            <Label for="nome">Nome</Label>
            <input type="text" name="nome">

            <br><br>

            <Label for="email">Email</Label>
            <input type="text" name="email">

            <div>
                <button type="submit">Cadastrar</button>
            </div>

        </form>

        <h2>Usuários cadastrados</h2>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>

            <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                <tr>

                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>

                    <td>
                        <a href="public/excluir.php?excluir=<?= $usuario['id'] ?>">Excluir</a>
                        <a href="public/editarUsuario.php?id=<?= $usuario['id'] ?>">
                            Editar
                        </a>
                    </td>
                </tr>

            <?php } ?>
        </table>
    </main>
</body>

</html>