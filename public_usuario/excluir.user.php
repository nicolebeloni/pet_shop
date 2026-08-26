<?php

require_once '../config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die('Cliente inválido.');
}

try {

    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;

} catch (PDOException $e) {

    die(
        'Não foi possível excluir o cliente. ' .
        'Verifique se ele possui animais cadastrados.'
    );
}