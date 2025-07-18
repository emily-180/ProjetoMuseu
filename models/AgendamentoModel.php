<?php
class AgendamentoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarVisitante($dados)
    {
        $sql = "INSERT INTO visitante (telefone_escola, nome_escola, nome_responsavel, telefone_responsavel, email_responsavel, quantidade_alunos, perfil_alunos, data_pretendida, hora_pretendida)
                VALUES (:telefone_escola, :nome_escola, :nome_responsavel, :telefone_responsavel, :email_responsavel, :quantidade_alunos, :perfil_alunos, :data_pretendida, :hora_pretendida)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    public function criarSolicitacao($id_visitante)
    {
        $data = date('Y-m-d');
        $hora = date('H:i:s');

        $sql = "INSERT INTO solicitacao (id_visitante, situacao, data_acao, hora_acao, id_membro)
                VALUES (:id_visitante, :situacao, :data_acao, :hora_acao, :id_membro)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_visitante' => $id_visitante,
            ':situacao' => 'Nova',
            ':data_acao' => $data,
            ':hora_acao' => $hora,
            ':id_membro' => null
        ]);
    }

    public function listarTodos() {
    $stmt = $this->pdo->prepare("SELECT * FROM visitante ORDER BY data_pretendida ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
