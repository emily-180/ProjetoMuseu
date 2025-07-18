<?php
date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/AgendamentoModel.php';

class AgendamentoController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvar()
    {
        $erros = [];
        $dados = $_POST;

        // Validações simples
        if (empty($dados['telefone_escola'])) {
            $erros['telefone_escola'] = 'O telefone é obrigatório.';
        }
        if (empty($dados['nome_responsavel'])) {
            $erros['nome_responsavel'] = 'O nome do responsável é obrigatório.';
        }
        if (empty($dados['nome_escola'])) {
            $erros['nome_escola'] = 'O nome da escola é obrigatório.';
        }
        if (empty($dados['data_pretendida'])) {
            $erros['data_pretendida'] = 'A data é obrigatória.';
        } elseif (strtotime($dados['data_pretendida']) < strtotime('today')) {
            $erros['data_pretendida'] = 'A data não pode ser anterior a hoje.';
        }
        if (empty($dados['hora_pretendida'])) {
            $erros['hora_pretendida'] = 'O horário é obrigatório.';
        }
        if (empty($dados['quantidade_alunos'])) {
            $erros['quantidade_alunos'] = 'Quantidade de alunos obrigatória.';
        }
        if (empty($dados['telefone_responsavel'])) {
            $erros['telefone_responsavel'] = 'Telefone do responsável é obrigatório.';
        }
        if (empty($dados['perfil_alunos'])) {
            $erros['perfil_alunos'] = 'Perfil dos alunos é obrigatório.';
        }

        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /ProjetoMuseu/views/agendamento.php');
            exit();
        }

        try {
            $visita = new AgendamentoModel($this->pdo);
            $id_visitante = $visita->cadastrarVisitante($dados);
            $visita->criarSolicitacao($id_visitante);

            $_SESSION['sucesso'] = "Solicitação realizada com sucesso!";
            header('Location: /ProjetoMuseu/views/agendamento.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function consultar() {
    $agendamentoModel = new AgendamentoModel($this->pdo);
    $visitas = $agendamentoModel->listarTodos();
    return $visitas;
  }
}
