<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bdMuseu';

try {
    $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8"; 
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar tabela membro
    $sql = "
        CREATE TABLE IF NOT EXISTS membro (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(200) NOT NULL,
            senha VARCHAR(200) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            perfil ENUM('Monitor(a)', 'Professor(a)', 'Coordenador(a) do Museu') NOT NULL,
            sobre TEXT NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'membro' criada com sucesso (ou já existia).<br>";

    // Criar tabela visitante
    $sql = "
        CREATE TABLE IF NOT EXISTS visitante (
            id INT AUTO_INCREMENT PRIMARY KEY,
            telefone_escola VARCHAR(20) NOT NULL,
            nome_escola VARCHAR(200) NOT NULL,
            nome_responsavel VARCHAR(200) NOT NULL,
            telefone_responsavel VARCHAR(20) NOT NULL,
            email_responsavel VARCHAR(150) NOT NULL,
            quantidade_alunos INT NOT NULL,
            perfil_alunos VARCHAR(200) NOT NULL,
            data_pretendida DATE NOT NULL,
            hora_pretendida TIME NOT NULL
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'visitante' criada com sucesso (ou já existia).<br>";

    // Criar tabela solicitacao
    $sql = "
        CREATE TABLE IF NOT EXISTS solicitacao (
            id INT AUTO_INCREMENT PRIMARY KEY,
            data_acao DATE NOT NULL,
            hora_acao TIME NOT NULL,
            situacao ENUM('Nova', 'Em análise', 'Agendado', 'Concluído', 'Recusado') NOT NULL DEFAULT 'Nova',
            descricao TEXT,
            id_visitante INT NOT NULL,
            id_membro INT NULL,
            FOREIGN KEY (id_visitante) REFERENCES visitante(id),
            FOREIGN KEY (id_membro) REFERENCES membro(id)
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'solicitacao' criada com sucesso (ou já existia).<br>";

} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}
?>
