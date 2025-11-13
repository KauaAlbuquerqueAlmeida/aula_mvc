<!-- Kauã de Albuquerque Almeida -->
<!-- app/views/usuario/listar.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="/aula_mvc/assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Usuários Cadastrados</h1>
        <a href="index.php?controller=usuario&action=criar" class="button">Novo Usuário</a>

        <?php if (!empty($dados)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['nome']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td>
                                <a href="index.php?controller=usuario&action=editar&id=<?= $u['id'] ?>">Editar</a> |
                                <a href="index.php?controller=usuario&action=deletar&id=<?= $u['id'] ?>" onclick="return confirm('Confirma exclusão?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum usuário cadastrado.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (!empty($_SESSION['alert'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['alert']['type'] ?>',
                title: '<?= $_SESSION['alert']['msg'] ?>',
                confirmButtonColor: '#3085d6',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    <?php unset($_SESSION['alert']);
    endif; ?>
</body>

</html>