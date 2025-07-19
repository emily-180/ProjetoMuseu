<?php
require_once './config/conexao.php';
require_once './models/SolicitacaoModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './lib/PHPMailer/src/Exception.php';
require './lib/PHPMailer/src/PHPMailer.php';
require './lib/PHPMailer/src/SMTP.php';

class SolicitacaoController {

    private $env;

    public function __construct() {
        $this->env = $this->carregarEnv(__DIR__ . '/../.env');
    }

    private function carregarEnv($path) {
        if (!file_exists($path)) {
            throw new Exception(".env não encontrado no caminho: $path");
        }

        $linhas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $vars = [];
        foreach ($linhas as $linha) {
            if (strpos(trim($linha), '#') === 0) continue;
            if (strpos($linha, '=') === false) continue;
            list($chave, $valor) = explode('=', $linha, 2);
            $vars[trim($chave)] = trim($valor);
        }
        return $vars;
    }

    public function index() {
        $model = new SolicitacaoModel($GLOBALS['pdo']);
        $situacoes = ['Nova', 'Em análise', 'Agendado', 'Concluído', 'Recusado'];
        $dados = [];

        foreach ($situacoes as $situacao) {
            $dados[$situacao] = $model->buscarPorSituacao($situacao);
        }

        $abaAtiva = $_GET['aba'] ?? 'Nova';

        require './views/gerenciamento/solicitacoes.php';
    }

    public function atualizarSituacao() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $situacao = $_POST['situacao'];
            $descricao = $_POST['descricao'] ?? '';
            $membroId = $_SESSION['usuario_id'] ?? null;

            if (!$membroId) {
                die('Usuário não autenticado.');
            }

            $situacoes_validas = ['Nova', 'Em análise', 'Agendado', 'Concluído', 'Recusado'];
            if (!in_array($situacao, $situacoes_validas)) {
                die('Situação inválida.');
            }

            $model = new SolicitacaoModel($GLOBALS['pdo']);
            $model->atualizarSituacaoComDescricao($id, $situacao, $descricao, $membroId);

            // Busca e-mail do visitante
            $sql = "SELECT v.email_responsavel AS email, v.nome_responsavel AS nome 
                    FROM solicitacao s
                    JOIN visitante v ON s.id_visitante = v.id
                    WHERE s.id = ?";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->execute([$id]);
            $dadosVisitante = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dadosVisitante) {
                $email = $dadosVisitante['email'];
                $nome = $dadosVisitante['nome'];

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

                    $mail->addAddress($email, $nome);
                    $mail->Subject = 'Atualização de Solicitação';
                    $mail->Body = "Olá $nome,\n\nSua solicitação foi atualizada para a situação: $situacao." .
                        ($situacao === 'Recusado' && $descricao ? "\n\nMotivo da recusa: $descricao" : '') .
                        "\n\nAtenciosamente,\nEquipe do Museu";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Erro ao enviar email: {$mail->ErrorInfo}");
                }
            }

            // Redireciona com aba ativa correta
            header("Location: /ProjetoMuseu/routerSolicitacao.php?action=index&aba=" . urlencode($situacao));
            exit();
        }
    }
}
