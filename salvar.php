<?php
session_start();
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $_SESSION['mensagem'] = 'Ocorreu um erro ao realizar a operação.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: index.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$faixa_etaria = trim($_POST['faixa_etaria'] ?? '');
$preco = trim($_POST['preco'] ?? '');
$estoque = trim($_POST['estoque'] ?? '');

if ($nome == '' || $categoria == '' || $faixa_etaria == '' || $preco == '' || $estoque == '') {
    $_SESSION['mensagem'] = 'Preencha todos os campos.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: cadastrar.php');
    exit;
}

if (!is_numeric($preco) || $preco < 0) {
    $_SESSION['mensagem'] = 'O preço deve ser válido e maior ou igual a zero.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: cadastrar.php');
    exit;
}

if (!ctype_digit((string) $estoque) || $estoque < 0) {
    $_SESSION['mensagem'] = 'O estoque deve ser um número inteiro maior ou igual a zero.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: cadastrar.php');
    exit;
}

try {
    $sql = 'INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, estoque)
            VALUES (:nome, :categoria, :faixa_etaria, :preco, :estoque)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':categoria' => $categoria,
        ':faixa_etaria' => $faixa_etaria,
        ':preco' => $preco,
        ':estoque' => $estoque
    ]);

    $_SESSION['mensagem'] = 'Brinquedo cadastrado com sucesso!';
    $_SESSION['tipo_mensagem'] = 'success';
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['mensagem'] = 'Ocorreu um erro ao realizar a operação.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: cadastrar.php');
    exit;
}
