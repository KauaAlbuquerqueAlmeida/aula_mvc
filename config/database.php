<!-- Kauã de Albuquerque Almeida -->
<?php
// config/database.php
class Database
{
    private $host = "localhost";
    private $dbname = "mvc_aula";
    private $user = "root";
    private $pass = "";

    public function getConnection(): PDO
    {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            return $conn;
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
}
