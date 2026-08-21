<?php

include("../infra/conexao.php");

if (!isset($_GET["id"]) || filter_var($_GET["id"], FILTER_VALIDATE_INT) === false) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    header("Location: ../index.php");
    exit;
}

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
        <h1>Cadastro Editar usuario</h1>

        <form action="editar.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $usuario["id"] ?>">
            <Label for="nome">Nome</Label>
            <input type="text" name="nome" value="<?php echo $usuario["nome"] ?>">

            <br><br>

            <Label for="email">Email</Label>
            <input type="text" name="email" value="<?php echo $usuario["email"] ?>">

            <div>
                <button type="submit">Cadastrar</button>
            </div>

        </form>
     </main>

</body>
</html>