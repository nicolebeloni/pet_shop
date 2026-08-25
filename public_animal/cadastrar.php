<?php

include "../infra/conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome,email) VALUES ('$nome','$email')";

mysqli_query($conexao, $sql);

header("Location: ../index.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>

    <h1>Cadastro de Usuário</h1>

    <form action="cadastrar_usuario.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>

</html>