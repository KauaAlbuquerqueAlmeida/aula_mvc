<!-- Kauã de Albuquerque Almeida -->
<?php
session_start();
require_once __DIR__ . '/config/database.php';

// sanitize controller/action parameters
$controller = preg_replace('/[^a-z0-9_]/i', '', $_GET['controller'] ?? 'usuario');
$action = preg_replace('/[^a-z0-9_]/i', '', $_GET['action'] ?? 'listar');

$controllerFile = __DIR__ . '/app/controllers/' . ucfirst($controller) . 'Controller.php';

if (!file_exists($controllerFile)) {
    header("HTTP/1.1 404 Not Found");
    echo "Controller not found.";
    exit;
}

require_once $controllerFile;
$controllerClass = ucfirst($controller) . 'Controller';

if (!class_exists($controllerClass)) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "Controller class not found.";
    exit;
}

$database = new Database();
$pdo = $database->getConnection();

$controllerObj = new $controllerClass($pdo);

if (!method_exists($controllerObj, $action)) {
    header("HTTP/1.1 404 Not Found");
    echo "Action not found.";
    exit;
}

$controllerObj->$action();
