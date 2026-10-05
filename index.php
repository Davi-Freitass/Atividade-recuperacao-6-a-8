<?php
session_start();
require 'config/database.php';

$mensagem = $_SESSION['mensagem'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem'] ?? 'success';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);

try {
    $sql = 'SELECT * FROM brinquedos ORDER BY id';
    $resultado = $pdo->query($sql);
    $brinquedos = $resultado->fetchAll();
} catch (PDOException $e) {
    $brinquedos = [];
    $erro = 'Ocorreu um erro ao realizar a operação.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão de Brinquedos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sistema de Gestão de Brinquedos</h1>

        <?php if (!empty($mensagem)) : ?>
            <div class="mensagem <?php echo $tipoMensagem == 'error' ? 'erro' : 'sucesso'; ?>">
                <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($erro)) : ?>
            <div class="mensagem erro"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <div class="topo">
            <h2>Lista de brinquedos</h2>
            <a href="cadastrar.php" class="botao">Cadastrar brinquedo</a>
        </div>

        <?php if (empty($brinquedos)) : ?>
            <p>Nenhum brinquedo cadastrado.</p>
        <?php else : ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Faixa etária</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($brinquedos as $brinquedo) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($brinquedo['id']); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['nome']); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['faixa_etaria']); ?></td>
                        <td>R$ <?php echo number_format($brinquedo['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['estoque']); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $brinquedo['id']; ?>" class="botao botao-pequeno">Editar</a>
                            <a href="excluir.php?id=<?php echo $brinquedo['id']; ?>" class="botao botao-danger" onclick="return confirm('Deseja realmente excluir este brinquedo?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
