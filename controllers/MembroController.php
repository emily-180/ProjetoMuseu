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
       if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }

        $membros = $this->membroModel->listar();
        require __DIR__ . '/../views/membro/listaMembro.php';
    }

    public function exibirFormCadastro()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }

        $erros = $_SESSION['erros'] ?? [];
        $dados = $_SESSION['dados'] ?? [];
        unset($_SESSION['erros'], $_SESSION['dados']);

        require __DIR__ . '/../views/membro/cadastraMembro.php';
    }

    public function excluir()
    {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] !== 'Coordenador(a) do Museu') {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $this->membroModel->excluir($id);
                $_SESSION['sucesso'] = 'Membro excluído com sucesso.';
            } catch (PDOException $e) {
                $_SESSION['sucesso'] = 'Erro ao excluir membro: ' . $e->getMessage();
            }
        }

        header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
        exit;
    }

    public function editar()
{
    if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
    }
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['erro'] = 'ID do membro não informado.';
        header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
        exit();
    }

    $membro = $this->membroModel->buscarPorId($id);

    if (!$membro) {
        $_SESSION['erro'] = 'Membro não encontrado.';
        header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
        exit();
    }

    require __DIR__ . '/../views/membro/editaMembro.php';
}

public function atualizar()
{
    $dados = $_POST;
    $erros = [];

    if (empty($dados['id']) || empty($dados['nome']) || empty($dados['email']) || empty($dados['sobre']) || empty($dados['perfil'])) {
        $erros['geral'] = 'Preencha todos os campos obrigatórios.';
    }

    if (!empty($dados['senha_atual']) || !empty($dados['nova_senha']) || !empty($dados['confirmar_senha'])) {
        $usuario = $this->membroModel->buscarPorId($dados['id']);

        if (!password_verify($dados['senha_atual'] ?? '', $usuario['senha'])) {
            $erros['senha_atual'] = 'Senha atual incorreta.';
        }

        if (empty($dados['nova_senha']) || strlen($dados['nova_senha']) < 6) {
            $erros['nova_senha'] = 'A nova senha deve ter pelo menos 6 caracteres.';
        }

        if ($dados['nova_senha'] !== $dados['confirmar_senha']) {
            $erros['confirmar_senha'] = 'As senhas não coincidem.';
        }
    }

    if (!empty($erros)) {
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
        header("Location: /ProjetoMuseu/routerMembro.php?action=editar&id=" . $dados['id']);
        exit();
    }

    try {
        if (!empty($dados['nova_senha'])) {
            $dados['senha'] = password_hash($dados['nova_senha'], PASSWORD_DEFAULT);
            $this->membroModel->atualizarComSenha($dados);
        } else {
            $this->membroModel->atualizar($dados);
        }

        $_SESSION['sucesso'] = 'Membro atualizado com sucesso!';
    } catch (PDOException $e) {
        $_SESSION['erro'] = 'Erro ao atualizar membro: ' . $e->getMessage();
    }

    header('Location: /ProjetoMuseu/routerMembro.php?action=listar');
    exit();
}


}
