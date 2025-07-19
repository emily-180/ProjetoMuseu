<?php
session_start();

// Conexão com o banco
require_once __DIR__ . '/config/conexao.php';

// Controller de solicitações
require_once __DIR__ . '/controllers/SolicitacaoController.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /ProjetoMuseu/routerAuth.php?page=login');
    exit();
}

// Ação vinda da URL (ex: ?action=atualizar)
$action = $_GET['action'] ?? 'index';

// Instancia o controller
$controller = new SolicitacaoController();

// Roteia a ação
switch ($action) {
    case 'index':
        $controller->index(); // Exibe a tela com as abas
        break;

    case 'atualizar':
        $controller->atualizarSituacao(); // Atualiza a situação e envia email
        break;
    
    default:
        echo "❌ Ação inválida em routerSolicitacao.";
        break;
}
