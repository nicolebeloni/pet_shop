<?php

require_once 'database/db.sql';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die('Animal inválido.');
}

$stmt = $pdo->prepare("
    SELECT *
    FROM animais
    WHERE id = ?
");

$stmt->execute([$id]);

$animal = $stmt->fetch();

if (!$animal) {
    die('Animal não encontrado.');
}

$stmt = $pdo->query("
    SELECT id, nome
    FROM clientes
    ORDER BY nome
");

$clientes = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $especie = trim($_POST['especie']);
    $raca = trim($_POST['raca']);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);
    $cliente_id = filter_input(
        INPUT_POST,
        'cliente_id',
        FILTER_VALIDATE_INT
    );

    if (
        $nome === '' ||
        $especie === '' ||
        $idade === false ||
        $idade < 0 ||
        $cliente_id === false
    ) {
        die('Preencha corretamente os campos.');
    }

    $stmt = $pdo->prepare("
        UPDATE animais
        SET
            nome = ?,
            especie = ?,
            raca = ?,
            idade = ?,
            cliente_id = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $nome,
        $especie,
        $raca,
        $idade,
        $cliente_id,
        $id
    ]);

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar animal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h1>Editar animal</h1>

    <form method="POST">

        <label>Nome:</label>
        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($animal['nome']) ?>"
            required
        >

        <label>Espécie:</label>
        <input
            type="text"
            name="especie"
            value="<?= htmlspecialchars($animal['especie']) ?>"
            required
        >

        <label>Raça:</label>
        <input
            type="text"
            name="raca"
            value="<?= htmlspecialchars($animal['raca']) ?>"
        >

        <label>Idade:</label>
        <input
            type="number"
            name="idade"
            min="0"
            value="<?= $animal['idade'] ?>"
            required
        >

        <label>Responsável:</label>

        <select name="cliente_id" required>

            <?php foreach ($clientes as $cliente): ?>

                <option
                    value="<?= $cliente['id'] ?>"
                    <?= $cliente['id'] == $animal['cliente_id']
                        ? 'selected'
                        : '' ?>
                >
                    <?= htmlspecialchars($cliente['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

        <button type="submit">
            Salvar alterações
        </button>

    </form>

    <a href="index.php">Voltar</a>

</div>

</body>
</html>
