<!-- Kauã de Albuquerque Almeida -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="/aula_mvc/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>

        <form method="post" action="index.php?controller=usuario&action=editar&id=<?= $usuario['id'] ?>">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" type="text" 
                   value="<?= htmlspecialchars($usuario['nome']) ?>" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" 
                   value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <button type="submit">Salvar Alterações</button>
            <a href="index.php?controller=usuario&action=listar">Cancelar</a>
        </form>
    </div>
</body>
</html>