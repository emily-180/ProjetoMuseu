<?php

$controller = $_GET['controller'] ?? 'agendamento';
$action = $_GET['action'] ?? 'consultar';

$controllerClass = ucfirst($controller) . 'Controller';

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../controllers/' . $controllerClass . '.php';

$instancia = new $controllerClass($pdo);

// ⚠️ Salva o retorno da action
$dados = $instancia->$action();

if ($controller === 'agendamento' && $action === 'consultar') {
    $visitas = $dados;
    require __DIR__ . '/../agendamento/consultar.php';
}
?>
