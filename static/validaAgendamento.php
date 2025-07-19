<?php
require_once __DIR__ . '/../config/conexao.php';       
require_once __DIR__ . '/../controllers/AgendamentoController.php';  

$controller = new AgendamentoController($pdo);
$controller->salvar();
