-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2024 às 19:28
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
-- Banco de dados: `labnorte`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `beneficiarios`
--

CREATE TABLE `beneficiarios` (
  `NOME` varchar(50) NOT NULL,
  `CPF` varchar(11) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `DATA_CONSULTA` date DEFAULT NULL,
  `HORA_CONSULTA` time DEFAULT NULL,
  `OBSERVACAO` varchar(150) DEFAULT NULL,
  `consulta` varchar(50) DEFAULT NULL,
  `valor_consulta` varchar(50) DEFAULT NULL,
  `status_consulta` enum('realizada','cancelada','nao_realizada') DEFAULT 'nao_realizada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `beneficiarios`
--

INSERT INTO `beneficiarios` (`NOME`, `CPF`, `EMAIL`, `TELEFONE`, `DATA_CONSULTA`, `HORA_CONSULTA`, `OBSERVACAO`, `consulta`, `valor_consulta`, `status_consulta`) VALUES
('Ellen', ' 0234521362', '', '6668855', '2024-11-29', '20:45:00', 'nenhuma', 'Consulta', '250.00', 'cancelada'),
('Ellen', '02345213622', '', '111165554', '2024-11-20', '17:00:00', 'nenhuma', 'Risco Cirúrgico, Teste Ergométrico', '500.00', 'realizada'),
('Felipe Bentes Dos Santos', '032.123.434', 'felipebentes@gmail.com', '(93)1929129292', '2024-11-12', '20:13:00', 'Depressão, ansiedade, anemia, fimose, disfunção eretil, gonorreia, HIV', NULL, NULL, 'realizada'),
('Gabriela Galucio Cardoso', '041.122.567', 'gabigalucio@gmail.com', '(93)984398252', '2024-11-12', '19:57:00', 'Dor de cabeça, dor no pé, garganta, preguiça, exaustão, depressão.', NULL, NULL, 'nao_realizada'),
('Leticia Canto', '12345678911', '', '999999999', '2025-02-10', '21:00:00', 'nada', NULL, NULL, 'realizada'),
('marcos hugo', '12456324', 'marcos720lima@yahoo.com', '6668855', '2024-10-23', '02:17:00', 'nenhuma', NULL, NULL, 'realizada'),
('felipe souza', '124568932', 'marcos720lima@outlook.com', '992345631', '2024-10-21', '01:34:00', 'nenhuma', NULL, NULL, 'nao_realizada'),
('Kelly', '14563896243', '', '112335468', '2024-11-18', '19:35:00', 'nenhuma', 'Consulta, Mapa 24 Horas', '400.00', 'realizada'),
('everton', '25641623488', 'mmail@mail.com', '1112223344', '2024-10-16', '10:51:00', 'nenhuma', NULL, NULL, 'nao_realizada'),
('Ellen', '02345213622', '', '1112223344', '2024-11-19', '20:46:00', 'nenhuma', 'Consulta, Risco Cirúrgico', '500.00', 'realizada'),
('Ellen', '02345213622', '', '6668855', '2024-12-17', '20:45:00', 'nenhuma', 'Consulta, Mapa 24 Horas', '400.00', 'realizada'),
('Ana Liz', '456317893', '', '1236589477', '2024-11-23', '08:00:00', 'Hipertenso', 'Consulta', '250.00', 'nao_realizada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `data_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `nome_usuario`, `data_login`) VALUES
(1, 'Pablo_Rangel', '2024-11-17 18:54:23'),
(2, 'Kelly', '2024-11-17 19:04:51'),
(3, 'Pablo_Rangel', '2024-11-17 19:10:38'),
(4, 'Kelly', '2024-11-17 19:28:23'),
(5, 'Pablo_Rangel', '2024-11-17 19:51:43'),
(6, 'Pablo_Rangel', '2024-11-17 22:03:55'),
(7, 'Kelly', '2024-11-17 22:25:50'),
(8, 'Pablo_Rangel', '2024-11-17 22:26:54'),
(9, 'Kelly', '2024-11-17 22:40:04'),
(10, 'Pablo_Rangel', '2024-11-18 23:53:28'),
(11, 'Pablo_Rangel', '2024-11-19 00:38:53'),
(12, 'Kelly', '2024-11-19 02:48:40'),
(13, 'Pablo_Rangel', '2024-11-19 02:55:06'),
(14, 'Pablo_Rangel', '2024-11-20 18:21:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `perfil`) VALUES
(1, 'Pablo_Rangel', 'prangel@email.com', '12345', 'admin'),
(2, 'Kelly', 'kelly@email.com', 'senha1234', 'usuario'),
(5, 'Leticia', 'letcanto@gmail.com', '123456', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD UNIQUE KEY `unique_consulta` (`DATA_CONSULTA`,`HORA_CONSULTA`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
