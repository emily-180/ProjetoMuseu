<?php
require_once __DIR__ . '/../models/MembroModel.php';
session_start();

class Autenticacao {
    private $membroModel;

    public function __construct($pdo) {
        $this->membroModel = new Membro($pdo);
    }

    public function login() {
        $erros = [];
        $erroLogin = '';
        $dados = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $dados['email'] = $email;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros['email'] = 'O e-mail informado é inválido.';
            }
            if (empty($senha)) {
                $erros['senha'] = 'A senha é obrigatória.';
            }

            if (empty($erros)) {
                $usuario = $this->membroModel->buscarPorEmail($email);

                if ($usuario && password_verify($senha, $usuario['senha'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['usuario_perfil'] = $usuario['perfil'];

                    header('Location: /ProjetoMuseu/routerAuth.php?page=gerencia');
                    exit;
                } else {
                    $erroLogin = 'E-mail ou senha incorretos.';
                }
            }
        }

        require __DIR__ . '/../views/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /ProjetoMuseu/routerAuth.php?page=login');
        exit;
    }
}
