<?php
session_start();

$mensagem = $_SESSION['mensagem'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem'] ?? 'error';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar brinquedo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar brinquedo</h1>

        <?php if (!empty($mensagem)) : ?>
            <div class="mensagem <?php echo $tipoMensagem == 'error' ? 'erro' : 'sucesso'; ?>">
                <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form action="salvar.php" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" maxlength="100" required>

            <label>Categoria</label>
            <input type="text" name="categoria" maxlength="50" required>

            <label>Faixa etária</label>
            <input type="text" name="faixa_etaria" maxlength="30" required>

            <label>Preço</label>
            <input type="number" name="preco" step="0.01" min="0" required>

            <label>Quantidade em estoque</label>
            <input type="number" name="estoque" min="0" required>

            <div class="botoes">
                <button type="submit" class="botao">Salvar</button>
                <a href="index.php" class="botao botao-cinza">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>
