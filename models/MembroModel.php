<?php
class Membro
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function adicionar($dados)
    {
        $sql = "INSERT INTO membro (nome, email, senha, sobre, perfil) 
                VALUES (:nome, :email, :senha, :sobre, :perfil)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            ':sobre' => $dados['sobre'],
            ':perfil' => $dados['perfil']
        ]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM membro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM membro WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM membro WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM membro WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($dados)
    {
        $sql = "UPDATE membro SET nome = :nome, email = :email, sobre = :sobre, perfil = :perfil WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':sobre' => $dados['sobre'],
            ':perfil' => $dados['perfil'],
            ':id' => $dados['id']
        ]);
    }

    public function atualizarComSenha($dados)
{
    $sql = "UPDATE membro SET nome = :nome, email = :email, sobre = :sobre, perfil = :perfil, senha = :senha WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':nome' => $dados['nome'],
        ':email' => $dados['email'],
        ':sobre' => $dados['sobre'],
        ':perfil' => $dados['perfil'],
        ':senha' => $dados['senha'],
        ':id' => $dados['id']
    ]);
}

    
}
