<?php
require_once './config/conexao.php';
require_once './models/SolicitacaoModel.php';

class SolicitacaoController {
    public function index() {
        // session_start();
        // if (!isset($_SESSION['usuario_id'])) {
        //     header('Location: login');
        //     exit();
        // }

      $model = new SolicitacaoModel($GLOBALS['pdo']); // ✅ certo!

        $situacoes = ['Nova', 'Em análise', 'Agendado', 'Concluído'];
        $dados = []; // <- importante! esse nome combina com o da view

        foreach ($situacoes as $situacao) {
            $dados[$situacao] = $model->buscarPorSituacao($situacao);
        }

        require './views/gerenciamento/solicitacoes.php';
    }

    // controllers/SolicitacaoController.php
public function atualizarSituacao() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $situacao = $_POST['situacao'];

        $situacoes_validas = ['Nova', 'Em análise', 'Agendado', 'Concluído'];
        if (!in_array($situacao, $situacoes_validas)) {
            die('Situação inválida.');
        }

        require_once __DIR__ . '/../models/SolicitacaoModel.php';
        $model = new SolicitacaoModel($GLOBALS['pdo']);
        $model->atualizarSituacao($id, $situacao);

        header("Location: /ProjetoMuseu/routerSolicitacao.php?action=index");
        exit();
    }
}

}
