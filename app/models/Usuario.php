<!-- Kauã de Albuquerque Almeida -->
<?php
// app/models/Usuario.php
require_once __DIR__ . '/../../config/database.php';

class Usuario
{
    private $conn;
    private $table = "usuarios";

    public function __construct(PDO $pdo = null)
    {
        if ($pdo instanceof PDO) {
            $this->conn = $pdo;
        } else {
            $db = new Database();
            $this->conn = $db->getConnection();
        }
    }

    public function all(): array
    {
        $stmt = $this->conn->query("SELECT id, nome, email, created_at FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT id, nome, email, created_at FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function criar(string $nome, string $email): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nome, email) VALUES (:nome, :email)");
        return $stmt->execute([':nome' => $nome, ':email' => $email]);
    }

    public function update(int $id, string $nome, string $email): bool
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nome = :nome, email = :email WHERE id = :id");
        return $stmt->execute([':nome' => $nome, ':email' => $email, ':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
