<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /ProjetoMuseu/routerAuth.php?page=login');
    exit;
}

$controller = $_GET['controller'] ?? 'agendamento';
$action = $_GET['action'] ?? 'consultar';

$controllerClass = ucfirst($controller) . 'Controller';

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../controllers/' . $controllerClass . '.php';

$instancia = new $controllerClass($pdo);

$dados = $instancia->$action();

if ($controller === 'agendamento' && $action === 'consultar') {
    $visitas = $dados;
    require __DIR__ . '/../agendamento/consultar.php';
}
?>
