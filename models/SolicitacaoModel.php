<?php
class SolicitacaoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorSituacao($situacao) {
        $sql = "SELECT s.id, s.data_acao AS data_visita, s.hora_acao AS hora_visita, s.situacao,
                       v.nome_escola AS escola, v.nome_responsavel AS responsavel,
                       m.nome AS nome_membro,
                       s.descricao
                FROM solicitacao s
                JOIN visitante v ON s.id_visitante = v.id
                LEFT JOIN membro m ON s.id_membro = m.id
                WHERE s.situacao = ?
                ORDER BY s.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$situacao]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarSituacao($id, $situacao) {
    $stmt = $this->pdo->prepare("UPDATE solicitacao SET situacao = ? WHERE id = ?");
    return $stmt->execute([$situacao, $id]);
}

public function atualizarSituacaoComDescricao($id, $situacao, $descricao, $membroId) {
    $sql = "UPDATE solicitacao SET situacao = ?, descricao = ?, id_membro = ? WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$situacao, $descricao, $membroId, $id]);
}


}
