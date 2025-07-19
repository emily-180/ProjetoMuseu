<?php
session_start();
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . '/controllers/MembroController.php';

$action = $_GET['action'] ?? 'listar';

$controller = new MembroController($pdo);

switch ($action) {
    case 'salvar':
        $controller->salvar();
        break;
    case 'exibirFormCadastro':
        $controller->exibirFormCadastro();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'atualizar':
        $controller->atualizar();
        break;
    case 'listar':
    default:
        $controller->listar();
        break;
}

