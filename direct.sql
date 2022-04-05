-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05/04/2022 às 17:25
-- Versão do servidor: 10.5.13-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u465894981_direct`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `container`
--

CREATE TABLE `container` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `container`
--

INSERT INTO `container` (`id`, `cliente`, `numero`, `tipo`, `status`, `categoria`) VALUES
(3, 'Cliente Teste 3', 'TEST123T123', '20', 'Cheio', 'Importação'),
(6, 'Cliente Teste 5', 'TEST1234567', '40', 'Cheio', 'Exportação'),
(7, 'Cliente1', 'TEST1234567', '40', 'Cheio', 'Exportação'),
(8, 'Cliente Final', 'TEST1234567', '40', 'Cheio', 'Exportação'),
(9, 'Cliente Teste 5', 'TEST5236897', '20', 'Cheio', 'Importação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dhinicio` datetime NOT NULL,
  `dhfim` datetime NOT NULL,
  `idcontainer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `movimentacao`
--

INSERT INTO `movimentacao` (`id`, `tipo`, `dhinicio`, `dhfim`, `idcontainer`) VALUES
(14, 'Gate Out', '2022-04-23 22:15:00', '2022-04-09 21:14:00', 3),
(16, 'Descarga', '2022-04-13 00:24:00', '2022-04-18 01:25:00', 1),
(17, 'Gate In', '2022-04-13 00:24:00', '2022-04-18 01:25:00', 1),
(18, 'Pesagem', '2022-04-23 22:15:00', '2022-04-09 21:14:00', 3),
(19, 'Reposicionamento', '2022-04-13 22:32:00', '2022-04-11 21:31:00', 4),
(20, 'Gate In', '2022-04-12 00:47:00', '2022-04-12 01:48:00', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel`) VALUES
(1, 'Aministrador', 'teste@teste.com.br', '1234', 'User');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `container`
--
ALTER TABLE `container`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
