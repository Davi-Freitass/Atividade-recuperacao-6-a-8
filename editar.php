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
    $sql = 'SELECT * FROM brinquedos WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $brinquedo = $stmt->fetch();

    if (!$brinquedo) {
        $_SESSION['mensagem'] = 'Brinquedo não encontrado.';
        $_SESSION['tipo_mensagem'] = 'error';
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['mensagem'] = 'Ocorreu um erro ao realizar a operação.';
    $_SESSION['tipo_mensagem'] = 'error';
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar brinquedo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar brinquedo</h1>

        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $brinquedo['id']; ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($brinquedo['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>Categoria</label>
            <input type="text" name="categoria" value="<?php echo htmlspecialchars($brinquedo['categoria'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>Faixa etária</label>
            <input type="text" name="faixa_etaria" value="<?php echo htmlspecialchars($brinquedo['faixa_etaria'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>Preço</label>
            <input type="number" name="preco" step="0.01" min="0" value="<?php echo htmlspecialchars($brinquedo['preco'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>Quantidade em estoque</label>
            <input type="number" name="estoque" min="0" value="<?php echo htmlspecialchars($brinquedo['estoque'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <div class="botoes">
                <button type="submit" class="botao">Atualizar</button>
                <a href="index.php" class="botao botao-cinza">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
