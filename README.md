# Análise e Correção de Problemas

## Descrição dos repositórios

Este trabalho apresenta a análise e correção de problemas encontrados em dois sistemas desenvolvidos em PHP. Foram identificados erros relacionados à sintaxe conexão com o banco de dados, utilização de `bind_param()`, exclusão e atualização de registros, além de problemas na utilização das variáveis de conexão.

---

# Sistema Um

## 1. Erros de Sintaxe

**Erros encontrados:**

> Foram encontrados dois erros de sintaxe causados pela falta de ponto e vírgula (`;`). Um deles estava no arquivo `conexao.php` e o outro no arquivo `editar.php`.

**Código:**

```text
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error) <----
}
```

```text
$stmt->bind_param("ssi", $nome, $email, $id)  <----
    $stmt->execute();
```

**Correção:**

> Foi adicionado o ponto e vírgula no local correto.

**Código corrigido:**

```text
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
```

```text
$stmt->bind_param("ssi", $nome, $email, $id);
    $stmt->execute();
```

---

## 2. Erro de Execução

**Erro encontrado:**

> Não havia um botão ou link para acessar a página de edição dos usuários.

**Código:**

```text
<td>
    <a href="index.php?excluir=<?= $usuario['id'] ?>">
        Excluir
    </a>
</td>
```

**Correção:**

> Foi adicionado um botão/link para acessar o arquivo `editar.php`, permitindo que o usuário seja editado.

**Código corrigido:**

```text
<td>
    <a href="public/excluir.php?excluir=<?= $usuario['id'] ?>">Excluir</a>
    <a href="public/editarUsuario.php?id=<?= $usuario['id'] ?>">
        Editar
    </a>
</td>
```

---

## 3. Falha de Segurança

**Falha encontrada:**

> O sistema não possuía uma garantia de que o valor informado no campo de e-mail realmente correspondia a um endereço de e-mail válido.

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

> Foi adicionada uma validação para verificar se o e-mail informado possui um formato válido antes de realizar o cadastro.

**Código corrigido:**

```text
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('Erro no cadastro: informe um email válido.');
        window.location.href = '../index.php';
    </script>";
    die();
}
```

---

# Sistema Dois

## 1. Erro no Cadastro

**Erro encontrado:**

> No cadastro de produtos, o `bind_param()` estava utilizando `ssiis`, contendo cinco tipos para apenas quatro valores. Além disso, a ordem dos tipos estava incorreta.

**Código:**

<img width="493" height="366" alt="image" src="https://github.com/user-attachments/assets/e6e402c2-cc38-41de-9eb0-5b7dd34728f9" />

**Correção:**

> A ordem e a quantidade dos tipos foram corrigidas. O correto é utilizar `ssdi`, correspondendo aos quatro valores enviados.

**Código corrigido:**

```text
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
```

---

## 2. Erro ao Excluir

**Erro encontrado:**

> No comando de exclusão, o tipo "string" utilizado no `bind_param()` para a variável `$id` estava incorreto.

**Código:**

<img width="527" height="414" alt="image" src="https://github.com/user-attachments/assets/0c58a5e1-4d92-491d-9e95-cd801fb955b2" />

**Correção:**

> O tipo de `$id` foi alterado para `i` no `bind_param()`.

**Código corrigido:**

```text
<?php
include ("../infra/conexao.php");

if (isset($_GET['excluir'])) {

    $id = $_GET['excluir'];

    $sql = 'DELETE FROM produtos WHERE id = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: ../index.php');
    exit;
}
```

---

## 3. Erro na Atualização

**Erro encontrado:**

> O `bind_param()` da atualização estava incorreto e o código estava tentando atualizar o campo `estoque` e `id`, mesmo que esses campos não devessem serem alterados nessa operação.

**Código:**

<img width="369" height="274" alt="image" src="https://github.com/user-attachments/assets/2a577194-6ca9-42cc-a7ce-1278cae0df4a" />

**Correção:**

> O `bind_param()` foi corrigido e o campo `estoque` foi removido da operação de atualização.

**Código corrigido:**

```text
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

    header('Location: ../index.php');
    exit;
}
```

---

## 4. Erro no `index.php`

**Erro encontrado:**

> O arquivo `index.php` estava utilizando uma variável de conexão diferente da variável definida no arquivo de conexão.

**Código:**

```text
<img width="378" height="55" alt="image" src="https://github.com/user-attachments/assets/36a1d116-d418-4360-913c-6bd66a5cad93" />
```

**Correção:**

> A variável utilizada no `index.php` foi ajustada para utilizar corretamente `conn`, que é a variável responsável pela conexão com o banco de dados.

**Código corrigido:**

```text
$resultado = $conn->query($sql);
```

---

# Relatório Final

Durante a análise dos dois sistemas, foram encontrados erros de sintaxe, problemas relacionados às variáveis de conexão, utilização incorreta do `bind_param()` e problemas nas operações de cadastro, exclusão, busca e atualização.

Também foram identificadas falhas de validação dos dados fornecidos pelo usuário, principalmente em relação ao campo de e-mail. As correções realizadas tiveram como objetivo fazer com que os sistemas funcionassem corretamente e apresentassem uma validação básica dos dados antes de serem enviados ao banco de dados.

