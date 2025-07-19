<?php
session_start();
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . '/controllers/SolicitacaoController.php';

$action = $_GET['action'] ?? 'index';

$controller = new SolicitacaoController();

switch ($action) {
    case 'index':
        $controller->index();
        break;

    case 'atualizar':
    $controller->atualizarSituacao();
    break;
    
    default:
        echo "Ação inválida em routerSolicitacao.";
        break;
}
