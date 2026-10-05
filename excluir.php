<?php
session_start();
require 'config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $_SESSION['mensagem'] = 'Brinquedo não encontrado.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: index.php');
    exit;
}

try {
    $sql = 'DELETE FROM brinquedos WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Brinquedo excluído com sucesso!';
        $_SESSION['tipo_mensagem'] = 'success';
    } else {
        $_SESSION['mensagem'] = 'Brinquedo não encontrado.';
        $_SESSION['tipo_mensagem'] = 'error';
    }

    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['mensagem'] = 'Ocorreu um erro ao realizar a operação.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: index.php');
    exit;
}
