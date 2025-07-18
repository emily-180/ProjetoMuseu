<?php
require_once __DIR__ . '/../models/MembroModel.php';

class MembroController
{
    private $pdo;
    private $membroModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->membroModel = new Membro($pdo);
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
            exit;
        }

        $erros = [];
        $dados = $_POST;

        if (empty($dados['nome'])) {
            $erros['nome'] = 'O nome é obrigatório.';
        }
        if (empty($dados['email'])) {
            $erros['email'] = 'O email é obrigatório.';
        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = 'Email inválido.';
        }
        if (!preg_match('/[A-Za-z]/', $dados['senha']) ||
            !preg_match('/[0-9]/', $dados['senha']) ||
            !preg_match('/[^A-Za-z0-9]/', $dados['senha'])) {
            $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
        }
        if (empty($dados['sobre'])) {
            $erros['sobre'] = 'O campo "Sobre" é obrigatório.';
        }
        if (empty($dados['perfil'])) {
            $erros['perfil'] = 'O perfil é obrigatório.';
        }

        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /ProjetoMuseu/views/membro/cadastraMembro.php');
            exit();
        }

        try {
            $this->membroModel->adicionar($dados);
            $_SESSION['sucesso'] = 'Membro adicionado com sucesso!';
            header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
            exit();
        } catch (PDOException $e) {
            $_SESSION['erros']['geral'] = 'Erro ao salvar: ' . $e->getMessage();
            $_SESSION['dados'] = $dados;
            header('Location: /ProjetoMuseu/views/membro/cadastraMembro.php');
            exit();
        }
    }

    public function listar()
    {
       /* if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }*/

        $membros = $this->membroModel->listar();
        require __DIR__ . '/../views/membro/listaMembro.php';
    }

    public function exibirFormCadastro()
    {
        /*if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }*/

        $erros = $_SESSION['erros'] ?? [];
        $dados = $_SESSION['dados'] ?? [];
        unset($_SESSION['erros'], $_SESSION['dados']);

        require __DIR__ . '/../views/membro/cadastraMembro.php';
    }

}
