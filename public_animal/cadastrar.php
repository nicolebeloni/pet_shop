<?php

include "../infra/conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
   $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];

    $sql = "INSERT INTO animal (nome,tipo,raca,idade) VALUES ('$nome','$tipo','$raca','$idade')";

    mysqli_query($conexao, $sql);

    header("Location: ../index.php");
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de animal</title>
</head>

<body>

    <h1>Cadastro de animal</h1>

    <form action="cadastrar_animal.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>Tipo:</label>
        <input type="text" name="tipo" required>

        <br><br>

        <label>Raça:</label>
        <input type="text" name="raca" required>

        <br><br>

        <label>Idade:</label>
        <input type="number" name="idade" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>

</html>