<!-- Kauã de Albuquerque Almeida -->
<!-- app/views/usuario/criar.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Usuário</title>
    <link rel="stylesheet" href="/aula_mvc/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Criar Usuário</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?controller=usuario&action=criar">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

            <button type="submit">Salvar</button>
            <a href="index.php?controller=usuario&action=listar">Cancelar</a>
        </form>
    </div>
</body>
</html>