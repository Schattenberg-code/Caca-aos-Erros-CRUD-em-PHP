# Análise e Correção de Problemas

## Descrição do repositório

Este repositório apresenta a análise e correção de problemas encontrados em um sistema desenvolvido em PHP. Foram identificados erros de sintaxe, erros de execução e uma falha relacionada à validação dos dados inseridos pelo usuário.

---

## 1. Erro de Sintaxe

**Erro encontrado:**

> Havia a falta de um ponto e vírgula no arquivo `conexao.php`.

**Código:**

```text
$host = 'localhost';
$user = 'root';
$password = "";
$database = 'crud_aula';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error) <----------- ERRO
}
```

**Correção:**

> Foi adicionado o ponto e vírgula no local correto.

---

## 2. Erro de Sintaxe

**Erro encontrado:**

> Havia a falta de um ponto e vírgula no arquivo `editar.php`.

**Código:**

```text
if (isset($_POST['editar'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = 'UPDATE usuarios SET nome = ?, email = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssi", $nome, $email, $id)  <---------------- ERRO
    $stmt->execute();

    header('Location: index.php');
    exit;
}
```

**Correção:**

> Foi adicionado o ponto e vírgula no local correto.

---

## 3. Erro de Execução

**Erro encontrado:**

> Não havia um botão que levasse ao arquivo de edição.

**Código:**

```text
<td>
    <a href="index.php?excluir=<?= $usuario['id'] ?>">
        Excluir
    </a>
</td>
```

**Correção:**

> Foi adicionado o botão para acessar o arquivo de edição.

```text
<td>
    <a href="editar.php?id=<?= $usuario['id'] ?>">
        Editar
    </a>
</td>
```

---

## Falha de Segurança

**Falha encontrada:**

> Não havia uma validação adequada dos dados inseridos pelo usuário, como a verificação do e-mail.

**Código:**

```text
<?php

include('../infra/conexao.php');

$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $nome, $email);
$stmt->execute();

header("location: ../index.php");
```

**Correção:**

> Foi adicionado um método de verificação do e-mail antes de realizar o cadastro.

