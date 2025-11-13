<!-- Kauã de Albuquerque Almeida -->
<?php
// app/controllers/UsuarioController.php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    private $usuarioModel;
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->usuarioModel = new Usuario($pdo);
    }

    public function listar()
    {
        $dados = $this->usuarioModel->all();
        require __DIR__ . '/../views/usuario/listar.php';
    }

    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');

            $errors = [];
            if ($nome === '') $errors[] = 'O nome é obrigatório.';
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';

            if (empty($errors)) {
                if ($this->usuarioModel->criar($nome, $email)) {
                    $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Usuário adicionado com sucesso!'];
                } else {
                    $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Erro ao adicionar usuário.'];
                }
                header("Location: index.php?controller=usuario&action=listar");
                exit;
            }

            require __DIR__ . '/../views/usuario/criar.php';
            return;
        }

        require __DIR__ . '/../views/usuario/criar.php';
    }

    public function editar()
    {
        $id = (int)($_GET['id'] ?? 0);
        $usuario = $this->usuarioModel->find($id);
        if (!$usuario) {
            $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Usuário não encontrado.'];
            header("Location: index.php?controller=usuario&action=listar");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if ($this->usuarioModel->update($id, $nome, $email)) {
                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Usuário atualizado com sucesso!'];
            } else {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Erro ao atualizar usuário.'];
            }
            header("Location: index.php?controller=usuario&action=listar");
            exit;
        }

        require __DIR__ . '/../views/usuario/editar.php';
    }

    public function deletar()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0 && $this->usuarioModel->delete($id)) {
            $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Usuário excluído com sucesso!'];
        } else {
            $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Erro ao excluir usuário.'];
        }
        header("Location: index.php?controller=usuario&action=listar");
        exit;
    }
}
