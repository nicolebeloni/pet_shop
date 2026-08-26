<?php

include "../infra/conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE usuarios 
            SET nome = ?, email = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $nome,
        $email,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: listar_usuarios.php");
        exit;
    } else {
        echo "Erro ao editar o usuário.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>

<body>

    <h1>Editar Usuário</h1>

    <form method="POST">

        <label>Nome:</label>
        <input
            type="text"
            name="nome"
            value="<?php echo htmlspecialchars($usuario['nome']); ?>"
            required
        >

        <br><br>

        <label>Email:</label>
        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($usuario['email']); ?>"
            required
        >

        <br><br>

        <button type="submit">
            Salvar alterações
        </button>

    </form>

    <br>

    <a href="listar_usuarios.php">Voltar</a>

</body>

</html>
