<?php
date_default_timezone_set('America/Sao_Paulo');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/AgendamentoModel.php';
require_once __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

class AgendamentoController
{
    private $pdo;
    private $env;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->env = $this->carregarEnv(__DIR__ . '/../.env');
    }

    private function carregarEnv($path)
    {
        if (!file_exists($path)) return [];
        $linhas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $vars = [];

        foreach ($linhas as $linha) {
            if (str_starts_with(trim($linha), '#') || !str_contains($linha, '=')) continue;
            list($chave, $valor) = explode('=', $linha, 2);
            $vars[trim($chave)] = trim($valor);
        }

        return $vars;
    }

    public function salvar()
    {
        session_start();
        $erros = [];
        $dados = $_POST;

        // Validações
        if (empty($dados['telefone_escola'])) $erros['telefone_escola'] = 'O telefone é obrigatório.';
        if (empty($dados['nome_responsavel'])) $erros['nome_responsavel'] = 'O nome do responsável é obrigatório.';
        if (empty($dados['nome_escola'])) $erros['nome_escola'] = 'O nome da escola é obrigatório.';
        if (empty($dados['data_pretendida'])) $erros['data_pretendida'] = 'A data é obrigatória.';
        elseif (strtotime($dados['data_pretendida']) < strtotime('today')) $erros['data_pretendida'] = 'A data não pode ser anterior a hoje.';
        if (empty($dados['hora_pretendida'])) $erros['hora_pretendida'] = 'O horário é obrigatório.';
        if (empty($dados['quantidade_alunos'])) $erros['quantidade_alunos'] = 'Quantidade de alunos obrigatória.';
        if (empty($dados['telefone_responsavel'])) $erros['telefone_responsavel'] = 'Telefone do responsável é obrigatório.';
        if (empty($dados['perfil_alunos'])) $erros['perfil_alunos'] = 'Perfil dos alunos é obrigatório.';

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

            // 🔔 Enviar e-mail de confirmação aqui
            $this->enviarEmailConfirmacao($dados);

            $_SESSION['sucesso'] = "Solicitação realizada com sucesso!";
            header('Location: /ProjetoMuseu/views/agendamento.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    private function enviarEmailConfirmacao($dados)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $this->env['GMAIL_USER'] ?? '';
            $mail->Password = $this->env['GMAIL_PASS'] ?? '';
            $mail->setFrom($this->env['GMAIL_USER'] ?? '', 'Museu');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->addAddress($dados['email_responsavel'], $dados['nome_responsavel']);
            $mail->Subject = 'Confirmação de Solicitação de Visita';

            $mail->Body = "Olá {$dados['nome_responsavel']},\n\n"
                        . "Recebemos sua solicitação de visita ao Museu!\n\n"
                        . "📅 Data pretendida: {$dados['data_pretendida']}\n"
                        . "🕒 Horário pretendido: {$dados['hora_pretendida']}\n"
                        . "🏫 Escola: {$dados['nome_escola']}\n"
                        . "👥 Número de visitantes: {$dados['quantidade_alunos']}\n\n"
                        . "Nossa equipe irá entrar em contato para confirmar o agendamento.\n\n"
                        . "Atenciosamente,\n"
                        . "Equipe do Museu";

            $mail->send();
        } catch (Exception $e) {
            error_log("Erro ao enviar email de confirmação: {$mail->ErrorInfo}");
        }
    }

    public function consultar()
    {
        $agendamentoModel = new AgendamentoModel($this->pdo);
        return $agendamentoModel->listarTodos();
    }
}
