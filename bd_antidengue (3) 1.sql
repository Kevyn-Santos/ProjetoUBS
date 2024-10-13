-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/10/2024 às 02:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_antidengue`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acesso`
--

CREATE TABLE `acesso` (
  `idacesso` int(11) NOT NULL,
  `idunidade` int(11) NOT NULL,
  `idenfermeiro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `acesso`
--

INSERT INTO `acesso` (`idacesso`, `idunidade`, `idenfermeiro`) VALUES
(5, 2, 3),
(6, 3, 3),
(7, 4, 4),
(8, 5, 4),
(9, 4, 6),
(10, 3, 6),
(11, 5, 6),
(12, 2, 6),
(13, 4, 9),
(14, 3, 10),
(15, 5, 13),
(16, 4, 13),
(17, 6, 14),
(18, 4, 15),
(19, 5, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `enfermeiro`
--

CREATE TABLE `enfermeiro` (
  `idenfermeiro` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `idFuncao` int(11) NOT NULL,
  `coren` varchar(20) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivelAcesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enfermeiro`
--

INSERT INTO `enfermeiro` (`idenfermeiro`, `nome`, `idFuncao`, `coren`, `login`, `senha`, `nivelAcesso`) VALUES
(1, 'André Lima', 3, '1234', 'andre', 'andre123', 1),
(2, 'Joao', 1, '4444', 'joao', '1234', 2),
(3, 'Maria', 2, '1960', 'mariag', '102030', 2),
(4, 'Laura Campos', 1, '95319', 'laura', 'alora', 2),
(5, 'Judite', 3, '5005', 'juditeL', '5006', 2),
(6, 'Coral', 2, '9840', 'coral12', 'coral111', 1),
(7, 'werwer', 1, '556677', 'wrwre', 'yuuuuu', 2),
(8, 'Helio', 2, '1961', 'helio', 'helio1', 2),
(9, 'Daiane', 1, '3322', 'daia', 'daia1', 2),
(10, 'Coralina', 1, '9876', 'coralina11', 'coralina222', 2),
(11, 'parabolica', 2, '33355', 'parabo', '123', 1),
(12, 'griff', 1, '5543', 'griff', '123', 2),
(13, 'flop', 3, '0908', 'flop', '123', 2),
(14, 'eeee', 1, '223322', 'eee', '123', 1),
(15, 'lucas', 1, '12333', 'lucas', '102030', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcoes`
--

CREATE TABLE `funcoes` (
  `idFuncao` int(11) NOT NULL,
  `funcao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcoes`
--

INSERT INTO `funcoes` (`idFuncao`, `funcao`) VALUES
(1, 'Enfermeiro'),
(2, 'Gerente UBS'),
(3, 'Vigilância Epidemiológica');

-- --------------------------------------------------------

--
-- Estrutura para tabela `municipio`
--

CREATE TABLE `municipio` (
  `codMunicipio` int(11) NOT NULL,
  `nomeCidade` varchar(30) NOT NULL,
  `codIbge` int(11) NOT NULL,
  `codUf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `municipio`
--

INSERT INTO `municipio` (`codMunicipio`, `nomeCidade`, `codIbge`, `codUf`) VALUES
(1, 'Caieiras', 3509007, 1),
(2, 'Franco da Rocha', 3516408, 1),
(3, 'Mairiporã', 3528502, 1),
(4, 'Francisco Morato', 3516309, 1),
(5, 'Cajamar', 3509205, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `nome_paciente` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` char(11) NOT NULL,
  `nome_mae` varchar(100) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `numero_cartao_sus` varchar(40) NOT NULL,
  `idade` int(11) NOT NULL,
  `semanas_gestacional` varchar(30) DEFAULT NULL,
  `gestante` tinyint(1) NOT NULL,
  `raca_cor` varchar(20) NOT NULL,
  `escolaridade` varchar(80) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `logradouro` varchar(110) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `ponto_referencia` varchar(300) DEFAULT NULL,
  `municipio_residencia` varchar(100) NOT NULL,
  `uf` char(2) NOT NULL,
  `distrito` varchar(120) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `zona` varchar(40) DEFAULT NULL,
  `geo_campo_1` varchar(125) DEFAULT NULL,
  `geo_campo_2` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipounidade`
--

CREATE TABLE `tipounidade` (
  `idTipoUnidade` int(11) NOT NULL,
  `tipoUnidade` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipounidade`
--

INSERT INTO `tipounidade` (`idTipoUnidade`, `tipoUnidade`) VALUES
(1, 'UBS'),
(2, 'UPA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `uf`
--

CREATE TABLE `uf` (
  `codUf` int(11) NOT NULL,
  `sigla` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `uf`
--

INSERT INTO `uf` (`codUf`, `sigla`) VALUES
(1, 'SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidadedesaude`
--

CREATE TABLE `unidadedesaude` (
  `idunidade` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `endereco` varchar(80) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `idTipoUnidade` int(11) NOT NULL,
  `codMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidadedesaude`
--

INSERT INTO `unidadedesaude` (`idunidade`, `nome`, `endereco`, `telefone`, `idTipoUnidade`, `codMunicipio`) VALUES
(2, 'UBS Centro', 'Rua do centro - 232', '1144445555', 1, 2),
(3, 'UBS Monte Verde', 'Est. Mun. Etorre Palma - 131', '(11) 4800-7596', 1, 2),
(4, 'UBS Pinheiros', 'Rua Luiza Rizzo Pesente - 261', '(11) 4445 1795', 1, 1),
(5, 'UPA Francisco Morato', 'Rua Gregório Gomes da Silva - 265', '(11) 44882776', 2, 4),
(6, 'teste', 'testes', '123123123', 1, 5),
(7, 'UBS Nova Era', 'AV ENG GINO DARTORA - S/n - JD Nova Era', '(11) 44421556', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`idacesso`),
  ADD KEY `fk_idEnfermeiro` (`idenfermeiro`),
  ADD KEY `fk_idUnidade` (`idunidade`);

--
-- Índices de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD PRIMARY KEY (`idenfermeiro`),
  ADD UNIQUE KEY `coren` (`coren`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_funcoes` (`idFuncao`);

--
-- Índices de tabela `funcoes`
--
ALTER TABLE `funcoes`
  ADD PRIMARY KEY (`idFuncao`);

--
-- Índices de tabela `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`codMunicipio`),
  ADD KEY `fk_uf` (`codUf`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `tipounidade`
--
ALTER TABLE `tipounidade`
  ADD PRIMARY KEY (`idTipoUnidade`);

--
-- Índices de tabela `uf`
--
ALTER TABLE `uf`
  ADD PRIMARY KEY (`codUf`);

--
-- Índices de tabela `unidadedesaude`
--
ALTER TABLE `unidadedesaude`
  ADD PRIMARY KEY (`idunidade`),
  ADD KEY `fk_idTipoUnidade` (`idTipoUnidade`),
  ADD KEY `fk_municipio` (`codMunicipio`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acesso`
--
ALTER TABLE `acesso`
  MODIFY `idacesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  MODIFY `idenfermeiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `funcoes`
--
ALTER TABLE `funcoes`
  MODIFY `idFuncao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `municipio`
--
ALTER TABLE `municipio`
  MODIFY `codMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipounidade`
--
ALTER TABLE `tipounidade`
  MODIFY `idTipoUnidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `uf`
--
ALTER TABLE `uf`
  MODIFY `codUf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `unidadedesaude`
--
ALTER TABLE `unidadedesaude`
  MODIFY `idunidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `acesso`
--
ALTER TABLE `acesso`
  ADD CONSTRAINT `fk_idEnfermeiro` FOREIGN KEY (`idenfermeiro`) REFERENCES `enfermeiro` (`idenfermeiro`),
  ADD CONSTRAINT `fk_idUnidade` FOREIGN KEY (`idunidade`) REFERENCES `unidadedesaude` (`idunidade`);

--
-- Restrições para tabelas `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD CONSTRAINT `fk_funcoes` FOREIGN KEY (`idFuncao`) REFERENCES `funcoes` (`idFuncao`);

--
-- Restrições para tabelas `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_uf` FOREIGN KEY (`codUf`) REFERENCES `uf` (`codUf`);

--
-- Restrições para tabelas `unidadedesaude`
--
ALTER TABLE `unidadedesaude`
  ADD CONSTRAINT `fk_idTipoUnidade` FOREIGN KEY (`idTipoUnidade`) REFERENCES `tipounidade` (`idTipoUnidade`),
  ADD CONSTRAINT `fk_municipio` FOREIGN KEY (`codMunicipio`) REFERENCES `municipio` (`codMunicipio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
