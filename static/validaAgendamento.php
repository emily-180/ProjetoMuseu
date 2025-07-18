<?php
require_once __DIR__ . '/../config/conexao.php';       // Inclui conexão
require_once __DIR__ . '/../controllers/AgendamentoController.php';  // Inclui controller

$controller = new AgendamentoController($pdo);
$controller->salvar();
