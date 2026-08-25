<?php

include "../infra/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: listar_usuarios.php");
    exit;
} else {
    echo "Erro ao excluir o usuário.";
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);

?>