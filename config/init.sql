-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bdmuseu
DROP DATABASE IF EXISTS `bdmuseu`;
CREATE DATABASE IF NOT EXISTS `bdmuseu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdmuseu`;

-- Copiando estrutura para tabela bdmuseu.membro
DROP TABLE IF EXISTS `membro`;
CREATE TABLE IF NOT EXISTS `membro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `perfil` enum('Monitor(a)','Professor(a)','Coordenador(a) do Museu') NOT NULL,
  `sobre` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdmuseu.membro: ~1 rows (aproximadamente)
DELETE FROM `membro`;
INSERT INTO `membro` (`id`, `nome`, `senha`, `email`, `perfil`, `sobre`) VALUES
	(1, 'Administrador', 'museu2014@', 'museu@gmail.com', 'Coordenador(a) do Museu', 'ADM');

-- Copiando estrutura para tabela bdmuseu.solicitacao
DROP TABLE IF EXISTS `solicitacao`;
CREATE TABLE IF NOT EXISTS `solicitacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_acao` date NOT NULL,
  `hora_acao` time NOT NULL,
  `situacao` enum('Nova','Em análise','Agendado','Concluído','Recusado') NOT NULL DEFAULT 'Nova',
  `descricao` text DEFAULT NULL,
  `id_visitante` int(11) NOT NULL,
  `id_membro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_visitante` (`id_visitante`),
  KEY `id_membro` (`id_membro`),
  CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`id_visitante`) REFERENCES `visitante` (`id`),
  CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`id_membro`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdmuseu.solicitacao: ~0 rows (aproximadamente)
DELETE FROM `solicitacao`;

-- Copiando estrutura para tabela bdmuseu.visitante
DROP TABLE IF EXISTS `visitante`;
CREATE TABLE IF NOT EXISTS `visitante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone_escola` varchar(20) NOT NULL,
  `nome_escola` varchar(200) NOT NULL,
  `nome_responsavel` varchar(200) NOT NULL,
  `telefone_responsavel` varchar(20) NOT NULL,
  `email_responsavel` varchar(150) NOT NULL,
  `quantidade_alunos` int(11) NOT NULL,
  `perfil_alunos` varchar(200) NOT NULL,
  `data_pretendida` date NOT NULL,
  `hora_pretendida` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela bdmuseu.visitante: ~0 rows (aproximadamente)
DELETE FROM `visitante`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
