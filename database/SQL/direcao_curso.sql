-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Mar-2020 às 14:16
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `direcao_de_curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `data_nascimento` date NOT NULL,
  `numero` int(2) NOT NULL,
  `nacionalidade` varchar(25) NOT NULL,
  `morada` varchar(25) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `id_turma` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `nome`, `data_nascimento`, `numero`, `nacionalidade`, `morada`, `email`, `fotografia`, `id_turma`, `uuid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ana Gomes', '2004-07-03', 1, 'Portuguesa', 'Rua Vale Formoso', 'anaformoso@gmail.com', '1583767304_Aluna.jpg', 1, '5a6d8182-b519-42a9-9159-14d4c4d40b26', '2020-03-09 15:21:44', '2020-03-09 15:21:44', NULL),
(2, 'Bruno Oliveira', '2004-08-07', 2, 'Portuguesa', 'Rua Portas Água', 'brunooliveira@gmail.com', '1583767587_Aluno.png', 1, 'dd873029-8390-4f1f-8024-37bf4a48d488', '2020-03-09 15:26:27', '2020-03-09 15:26:27', NULL),
(3, 'Diogo Andrade', '2004-06-05', 3, 'Portuguesa', 'Rua do Além', 'diogoandrade@gmail.com', '1583770143_Aluno.png', 1, '55220bbd-13ef-4ec4-a902-c2eace6bebbf', '2020-03-09 16:09:03', '2020-03-09 16:09:03', NULL),
(4, 'Eduardo Garcia', '2004-12-09', 4, 'Portuguesa', 'Rua da Portela', 'eduardogarcia@gmail.com', '1583770190_Aluno.png', 1, '019db94c-62f1-408b-a5ff-db77747db028', '2020-03-09 16:09:50', '2020-03-09 16:09:50', NULL),
(5, 'Fábio Martins', '2004-02-12', 5, 'Portuguesa', 'Rua Mouco', 'fabiomartins@gmail.com', '1583770282_Aluno.png', 1, '4c9aca84-dba4-4964-9f81-8afb8ced5a72', '2020-03-09 16:11:22', '2020-03-09 16:11:22', NULL),
(6, 'André Gonçalves', '2003-02-05', 1, 'Portuguesa', 'Rua Francelos', 'andregoncalves@gmail.com', '1583770455_Aluno.png', 2, '955d2314-5352-4592-a066-c426dc1284dd', '2020-03-09 16:14:15', '2020-03-09 16:14:15', NULL),
(7, 'Bernardo Silva', '2003-04-08', 2, 'Portuguesa', 'Rua Viscondessa', 'bernardosilva@gmail.com', '1583770543_Aluno.png', 2, '16783deb-b203-40a7-a91f-a942057aa8b0', '2020-03-09 16:15:43', '2020-03-09 16:15:43', NULL),
(8, 'Cláudia Nunes', '2003-12-03', 3, 'Portuguesa', 'Rua Machado', 'claudianunes@gmail.com', '1583770621_Aluna.jpg', 2, 'b0eb106e-1559-4793-8dcc-1bd7105c3763', '2020-03-09 16:17:01', '2020-03-09 16:17:01', NULL),
(9, 'Daniel Pacheco', '2003-01-07', 4, 'Portuguesa', 'Rua Combatentes', 'danielpacheco@gmail.com', '1583770698_Aluno.png', 2, '14ff1a41-4c7c-414a-b79a-6533841702a4', '2020-03-09 16:18:18', '2020-03-09 16:18:18', NULL),
(10, 'Emanuel Xavier', '2003-04-03', 5, 'Portuguesa', 'Rua da Madeira', 'emanuelxavier@gmail.com', '1583770773_Aluno.png', 2, 'ddcb14d0-65c4-469e-ac93-3f6a67fabc60', '2020-03-09 16:19:33', '2020-03-09 16:19:33', NULL),
(11, 'Alexandre Teixeira', '2002-07-04', 1, 'Portuguesa', 'Rua da Silva', 'alexandret@gmail.com', '1583772458_Aluno.png', 3, '6b7b93d9-f1f4-4845-a842-93135ab03830', '2020-03-09 16:47:38', '2020-03-09 16:47:38', NULL),
(12, 'Carlos Silva', '2002-06-12', 2, 'Portuguesa', 'Rua do Soldado', 'carlossilva@gmail.com', '1583772527_Aluno.png', 3, '8a1f0404-eb79-4b9e-8944-eb2a7fc21bdb', '2020-03-09 16:48:47', '2020-03-09 16:48:47', NULL),
(13, 'Diana Rosario', '2002-02-05', 3, 'Portuguesa', 'Rua da Capela', 'dianarosario@gmail.com', '1583772606_Aluna.jpg', 3, 'f9463b03-e5d3-41ea-9857-46e17fbc8e02', '2020-03-09 16:50:06', '2020-03-09 16:50:06', NULL),
(14, 'Francisco Morais', '2002-05-08', 4, 'Portuguesa', 'Rua Beloura', 'franciscomorais@gmail.com', '1583772685_Aluno.png', 3, '2557db77-036f-46c5-8cf2-31c55d551c56', '2020-03-09 16:51:25', '2020-03-09 16:51:25', NULL),
(15, 'Guilherme Torres', '2002-12-09', 5, 'Portuguesa', 'Rua Coutinho', 'guilhermetorres@gmail.com', '1583772770_Aluno.png', 3, '03da507b-434e-42fd-89aa-f284be6293ef', '2020-03-09 16:52:50', '2020-03-09 16:52:50', NULL),
(16, 'Adriana Silva', '2004-02-05', 1, 'Portuguesa', 'Rua Cerdeira', 'adrianasilva@gmail.com', '1583772942_Aluna.jpg', 4, '348c25cd-5ae3-4f43-9ef3-662a0e838b3e', '2020-03-09 16:55:43', '2020-03-09 16:55:43', NULL),
(17, 'Beatriz Araújo', '2004-10-21', 2, 'Portuguesa', 'Rua da Costa', 'beatrizaraujo@gmail.com', '1583773009_Aluna.jpg', 4, '19916033-2fac-4526-8233-d29f2f3e88e5', '2020-03-09 16:56:49', '2020-03-09 16:56:49', NULL),
(18, 'César Paiva', '2004-06-27', 3, 'Portuguesa', 'Rua da Rainha', 'cesarpaiva@gmail.com', '1583773069_Aluno.png', 4, '5636df7d-6fbf-430b-a349-8fc401b906cb', '2020-03-09 16:57:49', '2020-03-09 16:57:49', NULL),
(19, 'Daniel Fernandes', '2004-09-25', 4, 'Portuguesa', 'Rua Guerreiro', 'danielfernandes@gmail.com', '1583773151_Aluno.png', 4, 'a63c6774-ccee-412d-b569-62a1f4bffe36', '2020-03-09 16:59:11', '2020-03-09 16:59:11', NULL),
(20, 'Eduardo Silva', '2004-02-12', 5, 'Portuguesa', 'Rua Oliveira', 'eduardosilva@gmail.com', '1583773223_Aluno.png', 4, 'cfda0c68-8db0-43bf-afe5-5dbedb10a711', '2020-03-09 17:00:23', '2020-03-09 17:00:23', NULL),
(21, 'Alice Ramos', '2003-04-21', 1, 'Portuguesa', 'Rua Varzim', 'aliceramos@gmail.com', '1583773388_Aluna.jpg', 5, '95ebd6b7-f183-4361-b1ad-d505970a41c5', '2020-03-09 17:03:08', '2020-03-09 17:03:08', NULL),
(22, 'Cristiano Oliveira', '2003-11-09', 2, 'Portuguesa', 'Rua Marinha', 'cristianooliveira@gmail.com', '1583773610_Aluno.png', 5, '48eb0f36-26ae-47f4-904c-36909d511e22', '2020-03-09 17:06:50', '2020-03-09 17:06:50', NULL),
(23, 'Danilo Pereira', '2003-03-22', 3, 'Portuguesa', 'Rua Tapada', 'danilopereira@gmail.com', '1583773667_Aluno.png', 5, '83be05b3-d90a-4c39-bec8-102bfc0b0503', '2020-03-09 17:07:47', '2020-03-09 17:07:47', NULL),
(24, 'Eduarda Gonçalves', '2003-06-27', 4, 'Portuguesa', 'Rua Cacilda', 'eduardagoncalves@gmail.com', '1583774150_Aluna.jpg', 5, '29ba3be5-8a51-471c-be0f-becf5886c431', '2020-03-09 17:15:50', '2020-03-09 17:15:50', NULL),
(25, 'Filipa Alves', '2003-07-24', 5, 'Portuguesa', 'Rua Poço', 'filipaalves@gmail.com', '1583774238_Aluna.jpg', 5, '168dc429-b3d9-4ee0-815c-cae83cd0e37b', '2020-03-09 17:17:18', '2020-03-09 17:17:18', NULL),
(26, 'Artur Figueiredo', '2002-03-07', 1, 'Portuguesa', 'Rua Alto', 'arturfigueiredo@gmail.com', '1583774405_Aluno.png', 6, '7ad633ee-e510-4f17-933f-f75b5de76349', '2020-03-09 17:20:05', '2020-03-09 17:20:05', NULL),
(27, 'Bianca de Lima', '2002-01-02', 2, 'Portuguesa', 'Rua Marquês', 'biancalima@gmail.com', '1583774468_Aluna.jpg', 6, '53e4ab49-ca34-4502-b780-86a4a79fd75f', '2020-03-09 17:21:08', '2020-03-09 17:21:08', NULL),
(28, 'Carolina Silva', '2002-11-04', 3, 'Portuguesa', 'Rua Tomar', 'carolinasilva@gmail.com', '1583774606_Aluna.jpg', 6, '6e1d439c-2096-4f10-bd11-cf1067550cbf', '2020-03-09 17:23:26', '2020-03-09 17:23:26', NULL),
(29, 'Débora Freitas', '2002-01-07', 4, 'Portuguesa', 'Rua Camões', 'deborafreitas@gmail.com', '1583774658_Aluna.jpg', 6, 'cdb09e6a-0aa4-4935-bae5-a8125d0afec2', '2020-03-09 17:24:18', '2020-03-09 17:24:18', NULL),
(30, 'Hugo Lobo', '2002-12-05', 5, 'Portuguesa', 'Rua Pero Vaz', 'hugolobo@gmail.com', '1583774734_Aluno.png', 6, 'cef4ba09-5cee-471a-a80f-3159738ce8c0', '2020-03-09 17:25:34', '2020-03-09 17:25:34', NULL),
(31, 'Adriana Abreu', '2004-07-02', 1, 'portuguesa', 'Rua Santo António', 'adrianaabreu@gmail.com', '1583838007_Aluna.jpg', 7, '96e72be5-f9cc-4983-b7a9-361389815784', '2020-03-10 11:00:07', '2020-03-10 11:00:07', NULL),
(32, 'Jéssica Tavares', '2004-12-09', 2, 'portuguesa', 'Rua Real', 'jessicatavares@gmail.com', '1583838065_Aluna.jpg', 7, '8067f10f-e0fe-4fdf-80c4-8da77fc98b8a', '2020-03-10 11:01:05', '2020-03-10 11:01:05', NULL),
(33, 'Leonor Magalhães', '2004-01-08', 3, 'portuguesa', 'Rua Moreira', 'leonormagalhaes@gmail.com', '1583838133_Aluna.jpg', 7, 'de344c67-fb94-40eb-8702-f8579bdc560e', '2020-03-10 11:02:13', '2020-03-10 11:02:13', NULL),
(34, 'Mariana Lima', '2004-05-04', 4, 'portuguesa', 'Rua Canaveses', 'marianalima@gmail.com', '1583838208_Aluna.jpg', 7, '21882477-0c24-4515-bbc7-182e78b9125b', '2020-03-10 11:03:28', '2020-03-10 11:03:28', NULL),
(35, 'Violeta Gomes', '2004-12-12', 5, 'portuguesa', 'Rua Sacavem', 'violetagomes@gmail.com', '1583838336_Aluna.jpg', 7, '4c79734b-71de-4674-b493-ee4ee49881fd', '2020-03-10 11:05:36', '2020-03-10 11:05:36', NULL),
(36, 'Joana Almeida', '2003-01-06', 1, 'portuguesa', 'Rua valbom', 'joanaalmeida@gmail.com', '1583838922_Aluna.jpg', 8, 'f1f41f9e-2b1a-4eff-9bbd-88a7fe275e18', '2020-03-10 11:15:22', '2020-03-10 11:15:22', NULL),
(37, 'Luisa Pereira', '2003-06-23', 2, 'portuguesa', 'Rua vitoria', 'luisapereira@gmail.com', '1583838992_Aluna.jpg', 8, 'fa9475b4-f82c-446e-be09-14f9a476f811', '2020-03-10 11:16:33', '2020-03-10 11:16:33', NULL),
(38, 'Matilde Sousa', '2003-11-27', 3, 'portuguesa', 'Rua Vendas Novas', 'matildesousa@gmail.com', '1583839057_Aluna.jpg', 8, 'a0e3db95-7d98-46ac-99e3-1561511a0533', '2020-03-10 11:17:37', '2020-03-10 11:17:37', NULL),
(39, 'Vanessa Nogueria', '2003-12-07', 5, 'portuguesa', 'Rua Paredes', 'vanessanogueira@gmail.com', '1583839145_Aluna.jpg', 8, '7afbda89-9c45-4945-aa1b-267a320b02fa', '2020-03-10 11:19:05', '2020-03-10 11:19:05', NULL),
(40, 'Vânia Silva', '2003-04-12', 4, 'portuguesa', 'Rua Cartaxo', 'vaniasilva@gmail.com', '1583839268_Aluna.jpg', 8, '9ff5b5fd-c5b0-4a53-a63c-785b4ce28387', '2020-03-10 11:21:08', '2020-03-10 11:21:08', NULL),
(41, 'Ariana Fonseca', '2002-02-21', 1, 'portuguesa', 'Rua Teixeira', 'arianafonseca@gmail.com', '1583839361_Aluna.jpg', 9, 'c6172505-99ee-4f49-9515-d74b4f6bd28e', '2020-03-10 11:22:41', '2020-03-10 11:22:41', NULL),
(42, 'Mafalda Cruz', '2002-07-29', 2, 'portuguesa', 'Rua Oliveira', 'mafaldacruz@gmail.com', '1583839465_Aluna.jpg', 9, '7213c8f1-558a-48f7-94d9-24535769d3d7', '2020-03-10 11:24:25', '2020-03-10 11:24:25', NULL),
(43, 'Mara Faria', '2002-04-30', 3, 'portuguesa', 'Rua Gouveia', 'marafaria@gmail.com', '1583839517_Aluna.jpg', 9, 'a38fde5e-f78f-4d7e-ac1d-f6110a9f96c5', '2020-03-10 11:25:17', '2020-03-10 11:25:17', NULL),
(44, 'Tatiana Amorim', '2002-04-01', 4, 'portuguesa', 'Rua da Silva', 'tatianaamorim@gmail.com', '1583839831_Aluna.jpg', 9, '6ad2bde1-e552-4e0b-9080-04ace47fec85', '2020-03-10 11:30:31', '2020-03-10 11:30:31', NULL),
(45, 'Rita Mota', '2002-01-11', 5, 'portuguesa', 'Rua Sequeira', 'ritamota@gmail.com', '1583839876_Aluna.jpg', 9, '178db77e-1f4d-407c-9ede-22ddb3ca1c37', '2020-03-10 11:31:16', '2020-03-10 11:31:16', NULL),
(46, 'David Santos', '2004-03-07', 1, 'portuguesa', 'Rua Angra', 'davidsantos@gmail.com', '1583839985_Aluno.png', 10, '64c018f1-4fe1-44fd-bd5e-14e786a9432e', '2020-03-10 11:33:05', '2020-03-10 11:33:05', NULL),
(47, 'Filipe Carvalho', '2004-06-04', 2, 'portuguesa', 'Rua Heroísmo', 'filipecarvalho@gmail.com', '1583840693_Aluno.png', 10, '89758024-69a8-4d28-bec0-ecf86e30477f', '2020-03-10 11:44:53', '2020-03-10 11:44:53', NULL),
(48, 'Martim Vaz', '2004-01-01', 3, 'portuguesa', 'Rua Ílhavo', 'martimvaz@gmail.com', '1583840755_Aluno.png', 10, 'cb79979c-a39c-4518-94b4-6cc4ea50d3be', '2020-03-10 11:45:55', '2020-03-10 11:45:55', NULL),
(49, 'Miguel Campos', '2004-01-04', 4, 'portuguesa', 'Rua Odivelas', 'miguelcampos@gmail.com', '1583840796_Aluno.png', 10, 'a6c19021-74bc-4c7d-8974-5544d74f09fd', '2020-03-10 11:46:36', '2020-03-10 11:46:36', NULL),
(50, 'Santiago Moura', '2004-12-21', 5, 'portuguesa', 'Rua Cartaxo', 'santiagomoura@gmail.com', '1583840834_Aluno.png', 10, 'e0c88c83-8429-41b0-b309-09b230ca9897', '2020-03-10 11:47:14', '2020-03-10 11:47:14', NULL),
(51, 'Gabriel Soares', '2003-01-07', 1, 'portuguesa', 'Rua Sebastiao', 'gabrielsoares@gmail.com', '1583841717_Aluno.png', 11, '3d1ebbaa-5cee-4dfd-96b9-13d7294e9410', '2020-03-10 12:01:57', '2020-03-10 12:01:57', NULL),
(52, 'Lisandro Faria', '2003-02-06', 2, 'portuguesa', 'Rua Lima', 'lisandrofaria@gmail.com', '1583841766_Aluno.png', 11, '66d57bc5-b759-447f-a699-428410861636', '2020-03-10 12:02:46', '2020-03-10 12:02:46', NULL),
(53, 'Marcos Lopes', '2003-12-09', 3, 'portuguesa', 'Rua Tavares', 'marcoslopes@gmail.com', '1583841834_Aluno.png', 11, '28be3626-8b74-4a92-8beb-fa2f8c065574', '2020-03-10 12:03:54', '2020-03-10 12:03:54', NULL),
(54, 'Martim Barros', '2003-10-14', 4, 'portuguesa', 'Rua Seia', 'martimbarros@gmail.com', '1583841900_Aluno.png', 11, '79dc2683-a61c-4ff7-8ac8-7baf8ad9b565', '2020-03-10 12:05:00', '2020-03-10 12:05:00', NULL),
(55, 'Sebastião Andrade', '2003-01-05', 5, 'portuguesa', 'Rua Abreu', 'sebastiaoandrade@gmail.com', '1583841973_Aluno.png', 11, '32905c49-de60-4d50-8999-9a7932465cd2', '2020-03-10 12:06:13', '2020-03-10 12:06:13', NULL),
(56, 'Duarte Rocha', '2002-01-06', 1, 'portuguesa', 'Rua Macedo', 'duarterocha@gmail.com', '1583842100_Aluno.png', 12, '0d0e4253-725d-4c80-ab31-7da371d23f3e', '2020-03-10 12:08:20', '2020-03-10 12:08:20', NULL),
(57, 'Flávio Vieira', '2002-09-06', 2, 'portuguesa', 'Rua brito', 'flaviovieira@gmail.com', '1583842136_Aluno.png', 12, '898c7f6d-7418-44ab-a238-2035248a864a', '2020-03-10 12:08:56', '2020-03-10 12:08:56', NULL),
(58, 'Gil Araújo', '2002-12-08', 3, 'portuguesa', 'Rua Amaral', 'gilaraujo@gmail.com', '1583842212_Aluno.png', 12, 'd65d2351-207d-4e4c-9ada-13111fe0b9ca', '2020-03-10 12:10:12', '2020-03-10 12:10:12', NULL),
(59, 'Martim Leal', '2002-01-07', 4, 'portuguesa', 'Rua Ponta', 'martimleal@gmail.com', '1583842277_Aluno.png', 12, 'f7620fd0-ab72-4bff-900f-d29c717104ae', '2020-03-10 12:11:17', '2020-03-10 12:11:17', NULL),
(60, 'Salvador Monteiro', '2002-12-09', 5, 'portuguesa', 'Rua Soares', 'salvadormonteiro@gmail.com', '1583842319_Aluno.png', 12, '4f654a83-019d-41a6-894c-6561653c192a', '2020-03-10 12:11:59', '2020-03-10 12:11:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anos_letivos`
--

CREATE TABLE `anos_letivos` (
  `id_ano_letivo` int(11) NOT NULL,
  `ano` varchar(255) NOT NULL,
  `ativo` varchar(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anos_letivos`
--

INSERT INTO `anos_letivos` (`id_ano_letivo`, `ano`, `ativo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2019/2020', 'sim', '2020-03-09 10:55:04', '2020-03-09 10:55:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(11) NOT NULL,
  `licao` int(11) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas_alunos`
--

CREATE TABLE `aulas_alunos` (
  `id_aa` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id_avaliacao` bigint(11) NOT NULL,
  `nota` float NOT NULL,
  `id_criterio` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes_criterios`
--

CREATE TABLE `avaliacoes_criterios` (
  `id_ac` int(11) NOT NULL,
  `id_avaliacao` int(11) NOT NULL,
  `id_criterio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `criterios`
--

CREATE TABLE `criterios` (
  `id_criterio` int(11) NOT NULL,
  `designacao` varchar(255) NOT NULL,
  `percentagem` float NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `ficha_informativa` varchar(255) DEFAULT NULL,
  `id_ano_letivo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nome`, `designacao`, `ficha_informativa`, `id_ano_letivo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GPSI', 'Gestão e Programação de Sistemas Informáticos', NULL, 1, '2020-03-09 10:57:04', '2020-03-09 10:57:04', NULL),
(2, 'Turismo', 'Turismo', NULL, 1, '2020-03-09 10:57:25', '2020-03-09 10:57:25', NULL),
(3, 'AS', 'Auxiliar de Saúde', NULL, 1, '2020-03-09 10:57:43', '2020-03-09 10:57:43', NULL),
(4, 'EAC', 'Eletrónica, Automação e Computadores', NULL, 1, '2020-03-09 10:59:28', '2020-03-09 10:59:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos_disciplinas`
--

CREATE TABLE `cursos_disciplinas` (
  `id_cd` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos_disciplinas`
--

INSERT INTO `cursos_disciplinas` (`id_cd`, `id_curso`, `id_disciplina`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-03-09 11:14:28', '2020-03-09 11:14:28'),
(2, 2, 1, '2020-03-09 11:14:28', '2020-03-09 11:14:28'),
(3, 3, 1, '2020-03-09 11:14:28', '2020-03-09 11:14:28'),
(4, 4, 1, '2020-03-09 11:14:28', '2020-03-09 11:14:28'),
(5, 1, 2, '2020-03-09 11:18:30', '2020-03-09 11:18:30'),
(6, 4, 2, '2020-03-09 11:18:30', '2020-03-09 11:18:30'),
(7, 2, 3, '2020-03-09 11:19:30', '2020-03-09 11:19:30'),
(8, 3, 3, '2020-03-09 11:19:30', '2020-03-09 11:19:30'),
(9, 1, 4, '2020-03-09 11:20:29', '2020-03-09 11:20:29'),
(10, 2, 4, '2020-03-09 11:20:29', '2020-03-09 11:20:29'),
(11, 3, 4, '2020-03-09 11:20:29', '2020-03-09 11:20:29'),
(12, 4, 4, '2020-03-09 11:20:29', '2020-03-09 11:20:29'),
(13, 1, 5, '2020-03-09 11:21:55', '2020-03-09 11:21:55'),
(14, 2, 5, '2020-03-09 11:21:55', '2020-03-09 11:21:55'),
(15, 3, 5, '2020-03-09 11:21:55', '2020-03-09 11:21:55'),
(16, 4, 5, '2020-03-09 11:21:55', '2020-03-09 11:21:55'),
(17, 1, 6, '2020-03-09 11:22:57', '2020-03-09 11:22:57'),
(18, 2, 6, '2020-03-09 11:22:57', '2020-03-09 11:22:57'),
(19, 3, 6, '2020-03-09 11:22:57', '2020-03-09 11:22:57'),
(20, 4, 6, '2020-03-09 11:22:57', '2020-03-09 11:22:57'),
(21, 1, 7, '2020-03-09 11:24:41', '2020-03-09 11:24:41'),
(22, 4, 7, '2020-03-09 11:24:41', '2020-03-09 11:24:41'),
(23, 2, 8, '2020-03-09 11:25:46', '2020-03-09 11:25:46'),
(24, 3, 9, '2020-03-09 11:33:25', '2020-03-09 11:33:25'),
(25, 1, 10, '2020-03-09 11:34:23', '2020-03-09 11:34:23'),
(26, 4, 10, '2020-03-09 11:34:23', '2020-03-09 11:34:23'),
(27, 3, 11, '2020-03-09 11:35:19', '2020-03-09 11:35:19'),
(28, 2, 12, '2020-03-09 11:36:14', '2020-03-09 11:36:14'),
(29, 1, 13, '2020-03-09 11:37:24', '2020-03-09 11:37:24'),
(30, 1, 14, '2020-03-09 11:37:59', '2020-03-09 11:37:59'),
(31, 1, 15, '2020-03-09 11:38:31', '2020-03-09 11:38:31'),
(32, 1, 16, '2020-03-09 11:41:03', '2020-03-09 11:41:03'),
(33, 2, 17, '2020-03-09 11:42:00', '2020-03-09 11:42:00'),
(34, 2, 18, '2020-03-09 11:43:06', '2020-03-09 11:43:06'),
(35, 2, 19, '2020-03-09 11:43:45', '2020-03-09 11:43:45'),
(36, 2, 20, '2020-03-09 11:44:44', '2020-03-09 11:44:44'),
(37, 2, 21, '2020-03-09 11:46:16', '2020-03-09 11:46:16'),
(38, 3, 22, '2020-03-09 11:49:50', '2020-03-09 11:49:50'),
(39, 3, 23, '2020-03-09 11:50:17', '2020-03-09 11:50:17'),
(40, 3, 24, '2020-03-09 11:51:10', '2020-03-09 11:51:10'),
(41, 3, 25, '2020-03-09 11:52:03', '2020-03-09 11:52:03'),
(42, 3, 26, '2020-03-09 11:53:10', '2020-03-09 11:53:10'),
(43, 4, 27, '2020-03-09 11:53:56', '2020-03-09 11:53:56'),
(44, 4, 28, '2020-03-09 11:54:22', '2020-03-09 11:54:22'),
(45, 4, 29, '2020-03-09 11:54:52', '2020-03-09 11:54:52'),
(46, 4, 30, '2020-03-09 11:55:35', '2020-03-09 11:55:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos_users`
--

CREATE TABLE `cursos_users` (
  `id_cu` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos_users`
--

INSERT INTO `cursos_users` (`id_cu`, `id_curso`, `id_user`, `created_at`, `updated_at`) VALUES
(2, 1, 4, '2020-03-11 11:44:33', '2020-03-11 11:44:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id_disciplina` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `numero_aulas` int(11) DEFAULT NULL,
  `uuid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id_disciplina`, `designacao`, `numero_aulas`, `uuid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Português', 320, '5d6e9f30-9da4-4850-babb-0cf0e6c5803e', '2020-03-09 11:14:28', '2020-03-09 11:14:28', NULL),
(2, 'Inglês', 220, '1a10b7b8-7e79-4c8f-98c5-778aa44d9ce9', '2020-03-09 11:18:30', '2020-03-09 11:18:30', NULL),
(3, 'Espanhol', 220, 'efc6d741-0a07-4e89-8487-3450505d2860', '2020-03-09 11:19:30', '2020-03-09 11:19:30', NULL),
(4, 'Área de Integração', 220, 'e2d1a4f1-6266-441d-94ec-083da2c6b064', '2020-03-09 11:20:29', '2020-03-09 11:20:29', NULL),
(5, 'TIC', 100, '0e7b9f29-f1c9-4025-81a4-106ba0a27457', '2020-03-09 11:21:54', '2020-03-09 11:21:54', NULL),
(6, 'Educação Física', 140, '726cee7d-577c-4819-b0e8-0ec4b675bcbe', '2020-03-09 11:22:57', '2020-03-09 11:22:57', NULL),
(7, 'Matemática Informática', 300, '90107ff8-7a55-483d-97cb-3a168d8a5a7f', '2020-03-09 11:24:41', '2020-03-09 11:48:04', NULL),
(8, 'Matemática Turismo', 100, '34493c20-a876-475f-8e95-814972ef16e5', '2020-03-09 11:25:46', '2020-03-09 11:48:26', NULL),
(9, 'Matemática Auxiliar de Saúde', 200, '6cfa3e97-df33-4de5-a9d7-4d152b694f92', '2020-03-09 11:33:25', '2020-03-09 11:48:43', NULL),
(10, 'Física e Química Informática', 200, 'b0edeac0-f03c-481e-9d4b-59c782497139', '2020-03-09 11:34:23', '2020-03-09 11:49:11', NULL),
(11, 'Física e Química Auxiliar de Saúde', 150, '39d2e63d-e1ed-44cb-8088-4aa270952400', '2020-03-09 11:35:19', '2020-03-09 11:49:25', NULL),
(12, 'Geografia', 200, 'dad642a5-fdcb-4260-9b89-f28762dccb68', '2020-03-09 11:36:13', '2020-03-09 11:36:13', NULL),
(13, 'Sistemas Operativos', 131, '544e3072-0af2-4fb7-a466-4c10d3c2ca7b', '2020-03-09 11:37:24', '2020-03-09 11:37:24', NULL),
(14, 'Arquitetura de Computadores', 138, '2a97bcd9-6b74-41d3-8512-b7dad7ccd294', '2020-03-09 11:37:59', '2020-03-09 11:37:59', NULL),
(15, 'Redes de Comunicação', 235, 'a6a16277-1b09-4181-b7c4-8795a535f7c7', '2020-03-09 11:38:31', '2020-03-09 11:38:31', NULL),
(16, 'Programação e Sistemas de Informação', 596, 'd76d3aac-6674-468f-af9a-92527623d92e', '2020-03-09 11:41:03', '2020-03-09 11:41:03', NULL),
(17, 'História da Cultura e das Artes', 200, 'c5f9c3cc-5e0c-483d-867d-44a97cd8a392', '2020-03-09 11:42:00', '2020-03-09 11:42:00', NULL),
(18, 'Comunicar em espanhol', 180, 'c1a08bb8-8549-4637-8c89-27f1948cb089', '2020-03-09 11:43:06', '2020-03-09 11:43:06', NULL),
(19, 'Informação e Animação Turística', 350, 'c833a0e0-ac19-48b1-bbad-a49f90e9fe9e', '2020-03-09 11:43:45', '2020-03-09 11:43:45', NULL),
(20, 'Comunicação em Acolhimento Turístico', 230, '52ab4f89-3394-45d4-b00b-5e7ce526a254', '2020-03-09 11:44:44', '2020-03-09 11:44:44', NULL),
(21, 'Operações Técnicas em Empresas Turísticas', 340, 'b18429cb-89d9-47e9-b435-cd29ace2fabe', '2020-03-09 11:46:16', '2020-03-09 11:46:16', NULL),
(22, 'Biologia', 150, '04973360-1d33-4d6a-984e-3cba9c2be550', '2020-03-09 11:49:50', '2020-03-09 11:49:50', NULL),
(23, 'Saúde', 300, '3570d7b7-b50e-4647-ab1d-7c31609e4481', '2020-03-09 11:50:17', '2020-03-09 11:50:17', NULL),
(24, 'Gestão e Organização dos Serviços de Saúde', 125, '68b4a986-3cab-4452-ad62-bcba8463d521', '2020-03-09 11:51:10', '2020-03-09 11:51:10', NULL),
(25, 'Higiene, Segurança e Cuidados Gerais', 525, '1c2f6a15-532c-4776-880d-dabbd638fb4d', '2020-03-09 11:52:03', '2020-03-09 11:52:03', NULL),
(26, 'Comunicação e Relações Interpessoais', 150, 'f382014d-4aeb-4429-9abf-c711a573a2a9', '2020-03-09 11:53:10', '2020-03-09 11:53:10', NULL),
(27, 'Eletricidade e eletrónica', 292, 'ac001a03-eedb-4ca5-9743-ee5eba500bd6', '2020-03-09 11:53:55', '2020-03-09 11:53:55', NULL),
(28, 'Sistemas Digitais', 212, '2167f167-5c23-4045-909d-84855fc666a4', '2020-03-09 11:54:22', '2020-03-09 11:54:22', NULL),
(29, 'Tecnologias Aplicadas', 200, '86573ddf-cac5-4b19-8e82-f42ac6368ab0', '2020-03-09 11:54:52', '2020-03-09 11:54:52', NULL),
(30, 'Automação e Computadores', 396, '52b31d1c-fa61-4d45-9536-e9c3a7f322f4', '2020-03-09 11:55:35', '2020-03-09 11:55:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas_alunos`
--

CREATE TABLE `disciplinas_alunos` (
  `id_da` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas_turmas`
--

CREATE TABLE `disciplinas_turmas` (
  `id_dt` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplinas_turmas`
--

INSERT INTO `disciplinas_turmas` (`id_dt`, `id_disciplina`, `id_turma`, `created_at`, `updated_at`) VALUES
(1, 16, 1, '2020-03-11 12:10:34', '2020-03-11 12:10:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas_users`
--

CREATE TABLE `disciplinas_users` (
  `id_ud` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplinas_users`
--

INSERT INTO `disciplinas_users` (`id_ud`, `id_user`, `id_disciplina`, `created_at`, `updated_at`) VALUES
(1, 7, 16, '2020-03-10 12:13:37', '2020-03-10 12:13:37'),
(2, 6, 1, '2020-03-10 12:13:53', '2020-03-10 12:13:53'),
(3, 5, 14, '2020-03-10 12:14:23', '2020-03-10 12:14:23'),
(4, 4, 16, '2020-03-10 12:14:38', '2020-03-10 12:14:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faltas`
--

CREATE TABLE `faltas` (
  `id_falta` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `numero` int(50) NOT NULL,
  `designacao` varchar(250) NOT NULL,
  `num_aulas` int(11) NOT NULL,
  `ficha_informativa` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `numero`, `designacao`, `num_aulas`, `ficha_informativa`, `uuid`, `ano`, `id_disciplina`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Uniao Europeia', 32, NULL, '7388fb80-1c6a-4db0-bbd0-7ccdfcb09e05', 10, 4, '2020-03-09 12:09:53', '2020-03-09 12:09:53', NULL),
(2, 2, 'Comunicação', 28, NULL, '1f6a34e1-5f8e-4c11-875a-0aa2bde93be5', 11, 4, '2020-03-09 12:10:53', '2020-03-09 12:11:26', NULL),
(3, 3, 'Família', 20, NULL, '5ce194f0-168e-4f52-937e-f29491d00dda', 12, 4, '2020-03-09 12:12:05', '2020-03-09 15:11:34', '2020-03-09 15:11:34'),
(4, 1, 'Hardware', 35, NULL, '97b98a88-be87-4c3e-8e00-7f782742e854', 10, 14, '2020-03-09 12:12:44', '2020-03-09 12:12:44', NULL),
(5, 2, 'Sistemas Lógicos', 25, NULL, '815af129-6172-4523-863c-85a11d76bff5', 11, 14, '2020-03-09 12:13:00', '2020-03-09 12:13:00', NULL),
(6, 1, 'Sistemas Elétricos', 30, NULL, 'b37df25e-c834-417a-9327-2e1c19ec1ea7', 10, 30, '2020-03-09 12:14:58', '2020-03-09 12:14:58', NULL),
(7, 2, 'Sistemas Computacionais', 35, NULL, '856c9efe-c40b-4f7a-9910-51a07b580481', 11, 30, '2020-03-09 12:15:26', '2020-03-09 12:15:26', NULL),
(8, 3, 'Sistemas Automatizados', 22, NULL, 'a3988a1e-cdbe-4aef-a7f0-a62e5b2569c5', 12, 30, '2020-03-09 12:16:03', '2020-03-09 12:16:03', NULL),
(9, 1, 'Células', 24, NULL, 'd26ecc85-ea8d-47d7-8f8f-3719c5ec4a9a', 10, 22, '2020-03-09 12:16:40', '2020-03-09 12:16:40', NULL),
(10, 2, 'ADN', 34, NULL, '57ce906e-6cee-4d07-8aa3-1292522be3c0', 11, 22, '2020-03-09 12:17:03', '2020-03-09 12:17:03', NULL),
(11, 3, 'Seres Vivos', 20, NULL, '8e211cad-533f-4ace-9f6e-8fc3ccfa822b', 12, 22, '2020-03-09 12:17:29', '2020-03-09 12:17:29', NULL),
(12, 1, 'Comunicação', 26, NULL, '7beb78db-7e89-4d3f-babe-0e9c13ea876b', 10, 26, '2020-03-09 12:17:55', '2020-03-09 12:17:55', NULL),
(13, 2, 'Relações Interpessoais', 33, NULL, '6d645594-be3f-4804-af0a-3f59a15f98f8', 11, 26, '2020-03-09 12:18:13', '2020-03-09 12:18:13', NULL),
(14, 3, 'Sistemas de Comunicação', 23, NULL, 'd3f57cb3-287e-412e-8550-0f050e8a7417', 12, 26, '2020-03-09 12:18:51', '2020-03-09 12:18:51', NULL),
(15, 1, 'Comunicação', 32, NULL, '17ce03de-5337-4def-bbb3-98113ccc82ef', 10, 20, '2020-03-09 12:19:09', '2020-03-09 12:19:09', NULL),
(16, 2, 'Acolhimento Turistico', 21, NULL, '21a13e5d-5c75-43a0-aecf-6f90ce250a9a', 11, 20, '2020-03-09 12:19:33', '2020-03-09 12:19:33', NULL),
(17, 3, 'Sistemas Turisticos', 35, NULL, '7e7373f4-b398-4704-af4a-80aae7ae02aa', 12, 20, '2020-03-09 12:20:04', '2020-03-09 12:20:04', NULL),
(18, 1, 'Meio Ambiente', 33, NULL, 'b9af8f89-da7b-4d6c-9fff-5d355cd71779', 10, 18, '2020-03-09 12:20:46', '2020-03-09 12:20:46', NULL),
(19, 2, 'Alimentação', 25, NULL, 'b3de9273-3e75-441f-ae25-e01220652db8', 11, 18, '2020-03-09 12:21:19', '2020-03-09 12:21:19', NULL),
(20, 3, 'Desportos', 24, NULL, '0f6d6e32-96d1-4bd3-8ab7-975024862edb', 12, 18, '2020-03-09 12:22:11', '2020-03-09 12:22:11', NULL),
(21, 1, 'Ginástica', 20, NULL, 'f4e3d707-58be-488a-870d-04150bf00c1f', 10, 6, '2020-03-09 14:42:01', '2020-03-09 14:42:01', NULL),
(22, 2, 'Atletismo', 23, NULL, '4f071047-38fb-4866-9532-b3762bd9381e', 11, 6, '2020-03-09 14:42:19', '2020-03-09 14:42:19', NULL),
(23, 3, 'Futebol', 32, NULL, '86481d36-0429-4976-8162-a0046b2052a8', 12, 6, '2020-03-09 14:42:33', '2020-03-09 14:42:33', NULL),
(24, 1, 'Eletricidade', 24, NULL, '1f704d9c-505d-4faf-88a7-afe466c5c1a4', 10, 27, '2020-03-09 14:44:01', '2020-03-09 14:44:01', NULL),
(25, 2, 'Eletrónica', 35, NULL, '7e71b0f0-d42c-45e0-8951-c422c3e59ec0', 11, 27, '2020-03-09 14:44:16', '2020-03-09 14:44:16', NULL),
(26, 3, 'Robôs', 22, NULL, 'dafb96aa-fa22-4fc9-b0e6-81ca4acfbf28', 12, 27, '2020-03-09 14:44:27', '2020-03-09 14:44:27', NULL),
(27, 1, 'Musica', 24, NULL, '5fc2b8bc-7c91-4587-8546-905579f46664', 10, 3, '2020-03-09 14:45:02', '2020-03-09 14:45:02', NULL),
(28, 2, 'Desporto', 31, NULL, '2aa0ff2f-e540-4bf7-830b-717762e9b1e2', 11, 3, '2020-03-09 14:45:18', '2020-03-09 14:45:18', NULL),
(29, 3, 'Meio Ambiente', 23, NULL, 'b0b1b29d-e3c0-4b6d-88d3-4a31916fa894', 12, 3, '2020-03-09 14:45:39', '2020-03-09 14:45:39', NULL),
(30, 1, 'Soluções', 27, NULL, '3504f4a5-1b9e-4f9b-8c99-e7e26f5a36ec', 10, 11, '2020-03-09 14:47:05', '2020-03-09 14:47:05', NULL),
(31, 2, 'Átomos', 23, NULL, 'fa4d966a-487c-40a8-b3bd-042f8324799e', 11, 11, '2020-03-09 14:47:30', '2020-03-09 14:47:30', NULL),
(32, 3, 'Células', 32, NULL, 'f3d06914-10fd-4127-a6b2-367ea353f5a2', 12, 11, '2020-03-09 14:48:11', '2020-03-09 14:48:11', NULL),
(33, 1, 'Átomos', 24, NULL, '8264e792-990d-49cb-b2c4-2c5232b57540', 10, 10, '2020-03-09 14:48:25', '2020-03-09 14:48:25', NULL),
(34, 2, 'Soluções', 21, NULL, 'edfe8944-a185-4dc3-909b-c7ebefde42a9', 11, 10, '2020-03-09 14:48:57', '2020-03-09 14:48:57', NULL),
(35, 3, 'Leis de Newton', 35, NULL, 'ea836955-dd4c-4bf6-9284-60aa8a3e5895', 12, 10, '2020-03-09 14:50:40', '2020-03-09 14:50:40', NULL),
(36, 1, 'União Europeia', 23, NULL, 'f6fd93c1-f08f-4661-a1ef-d5a7151df519', 10, 12, '2020-03-09 14:51:06', '2020-03-09 14:51:06', NULL),
(37, 2, 'Turismo', 28, NULL, 'f80bee80-5f5d-4715-ba25-9a70b6f2dc05', 11, 12, '2020-03-09 14:51:27', '2020-03-09 14:51:27', NULL),
(38, 3, 'Continentes', 22, NULL, 'c239e761-7c4c-4975-a46e-369733159b63', 12, 12, '2020-03-09 14:52:27', '2020-03-09 14:52:27', NULL),
(39, 1, 'Gestão', 22, NULL, '8d2f09dc-2484-43b6-9100-b68dfac1e5f7', 10, 24, '2020-03-09 14:53:01', '2020-03-09 14:53:01', NULL),
(40, 2, 'Organização', 32, NULL, 'd3526339-9b99-436f-8532-2563f56c2c90', 11, 24, '2020-03-09 14:53:29', '2020-03-09 14:53:29', NULL),
(41, 3, 'Saúde', 21, NULL, '7f4d57d5-dd92-49f8-896f-b5c8157f3942', 12, 24, '2020-03-09 14:53:41', '2020-03-09 14:53:41', NULL),
(42, 1, 'Higiene', 26, NULL, 'd66db66f-0e9b-4edd-bbfc-def1b9757779', 10, 25, '2020-03-09 14:54:46', '2020-03-09 14:54:46', NULL),
(43, 2, 'Segurança', 31, NULL, '26963ac6-d17d-4944-bbca-2ac7975ebc23', 11, 25, '2020-03-09 14:54:59', '2020-03-09 14:54:59', NULL),
(44, 3, 'Cuidados Gerais', 33, NULL, '719b56c4-5d80-43d0-b494-d8f276c69f0c', 12, 25, '2020-03-09 14:55:14', '2020-03-09 14:55:14', NULL),
(45, 1, 'História', 30, NULL, 'b8cc1432-5046-4abb-a80c-7df0f1fb6c21', 10, 17, '2020-03-09 14:55:38', '2020-03-09 14:55:38', NULL),
(46, 2, 'Culturas', 23, NULL, '6c4f804f-49e1-4785-afd0-9c3b8aa9abf0', 11, 17, '2020-03-09 14:55:54', '2020-03-09 14:55:54', NULL),
(47, 3, 'Artes', 21, NULL, 'f02fca7f-9f4e-4a1a-9c86-130322fff849', 12, 17, '2020-03-09 14:56:06', '2020-03-09 14:56:06', NULL),
(48, 1, 'Informação', 25, NULL, '1ba28133-fb10-47c4-9210-eb5791a8b107', 10, 19, '2020-03-09 14:56:25', '2020-03-09 14:56:25', NULL),
(49, 2, 'Animação', 33, NULL, '2c15b5fb-0ed7-43b7-9c91-e360c0c68802', 11, 19, '2020-03-09 14:56:38', '2020-03-09 14:56:38', NULL),
(50, 3, 'Turístico', 22, NULL, 'bd18c4c4-5329-44c4-a9c7-bd815f142c3e', 12, 19, '2020-03-09 14:56:54', '2020-03-09 14:56:54', NULL),
(51, 1, 'Meio Ambiente', 32, NULL, 'e05fc748-1d0d-473a-b2e3-d6d1ef830708', 10, 2, '2020-03-09 14:57:07', '2020-03-09 14:57:07', NULL),
(52, 2, 'Desporto', 21, NULL, '18b530a4-0998-4ddf-8aaf-37315b4334fe', 11, 2, '2020-03-09 14:57:18', '2020-03-09 14:57:18', NULL),
(53, 3, 'Música', 34, NULL, '1a493f43-803f-491f-8e93-8470d7fff178', 12, 2, '2020-03-09 14:57:30', '2020-03-09 15:12:20', '2020-03-09 15:12:20'),
(54, 1, 'Polígonos', 22, NULL, 'cc7db750-9572-4ea2-8e19-a522e02648fc', 10, 9, '2020-03-09 14:57:50', '2020-03-09 14:57:50', NULL),
(55, 2, 'Matrizes', 33, NULL, '27ae40d2-21d0-45af-9b22-350ba102e448', 11, 9, '2020-03-09 14:58:10', '2020-03-09 14:58:10', NULL),
(56, 3, 'Teoremas', 24, NULL, 'ff736cfc-eb5a-49de-a201-291e4f35b4fa', 12, 9, '2020-03-09 14:58:29', '2020-03-09 14:58:29', NULL),
(57, 1, 'Polígonos', 23, NULL, 'efb151fb-3ad5-4b6b-b02f-8184ae17b426', 10, 7, '2020-03-09 14:58:45', '2020-03-09 14:58:45', NULL),
(58, 2, 'Funções', 31, NULL, 'c5d6e91a-33e2-4b92-b121-50f6f6b04621', 11, 7, '2020-03-09 14:58:57', '2020-03-09 14:58:57', NULL),
(59, 3, 'Matrizes', 29, NULL, '280d542e-7c69-40e7-ab5c-2d2fa188be6d', 12, 7, '2020-03-09 14:59:08', '2020-03-09 14:59:08', NULL),
(60, 1, 'Funções', 23, NULL, 'fcdf0ec4-31cf-4dfd-8781-d629d0f4238c', 10, 8, '2020-03-09 14:59:24', '2020-03-09 14:59:24', NULL),
(61, 2, 'Polígonos', 23, NULL, '0c7a5a3d-8d76-4db7-9611-ea6d34a3160c', 11, 8, '2020-03-09 14:59:35', '2020-03-09 14:59:35', NULL),
(62, 3, 'Matrizes', 31, NULL, '3d1c7ed0-d82a-4337-ae47-e287324b9f5e', 12, 8, '2020-03-09 14:59:46', '2020-03-09 14:59:46', NULL),
(63, 1, 'Operações', 32, NULL, '1b83ea2e-6c90-4eb0-946b-c9512edc0436', 10, 21, '2020-03-09 15:00:19', '2020-03-09 15:00:19', NULL),
(64, 2, 'Técnicas', 23, NULL, 'bec5a74c-9f5e-40a2-98cf-8d405e350dc8', 11, 21, '2020-03-09 15:00:33', '2020-03-09 15:00:33', NULL),
(65, 3, 'Empresas', 31, NULL, '996ea953-c32c-4bff-b555-7eec850f574c', 12, 21, '2020-03-09 15:00:46', '2020-03-09 15:00:46', NULL),
(66, 1, 'Poemas', 23, NULL, '13d8b6a7-f1e4-473a-a11c-9f376069f0c7', 10, 1, '2020-03-09 15:01:03', '2020-03-09 15:01:03', NULL),
(67, 2, 'Fernando Pessoa', 32, NULL, '3a81d9e0-3313-4b16-9464-cacdf1ef62c8', 11, 1, '2020-03-09 15:02:10', '2020-03-09 15:02:10', NULL),
(68, 3, 'Lusíadas', 36, NULL, '80b0c895-c222-4d27-91fc-bcc60152316e', 12, 1, '2020-03-09 15:02:25', '2020-03-09 15:02:25', NULL),
(69, 1, 'Orientação dos Objetos', 22, NULL, 'ed9136ee-3545-4105-8eb4-94ea2183311a', 10, 16, '2020-03-09 15:03:12', '2020-03-09 15:03:12', NULL),
(70, 2, 'Visual Studio C#', 23, NULL, '541a7bcc-a51b-4171-a2b0-b6d86ef696f8', 11, 16, '2020-03-09 15:03:56', '2020-03-09 15:03:56', NULL),
(71, 3, 'Photoshop', 26, NULL, '9037a808-3f42-401a-a143-354b682affaa', 12, 16, '2020-03-09 15:04:23', '2020-03-09 15:04:23', NULL),
(72, 1, 'Rede Lan', 21, NULL, 'a4e51b0f-beb3-4779-8cb3-db9d062fc174', 10, 15, '2020-03-09 15:04:46', '2020-03-09 15:04:46', NULL),
(73, 2, 'Comunicação', 21, NULL, 'ed6ee732-6563-4e06-9f21-34fa16751bf9', 11, 15, '2020-03-09 15:05:29', '2020-03-09 15:05:29', NULL),
(74, 3, 'Website HTML, PHP', 32, NULL, 'ed2f6098-41e3-4d0b-aa81-848e7b21fa59', 12, 15, '2020-03-09 15:05:48', '2020-03-09 15:05:48', NULL),
(75, 1, 'Segurança', 23, NULL, '483f4ccd-be54-4e7b-868a-7882868cf66e', 10, 23, '2020-03-09 15:06:58', '2020-03-09 15:06:58', NULL),
(76, 2, 'Cuidados Gerais', 32, NULL, '353d8424-c88d-4b25-90a1-e7cb3fb566aa', 11, 23, '2020-03-09 15:07:35', '2020-03-09 15:07:35', NULL),
(77, 3, 'Ambiente', 31, NULL, '84e71eb6-715e-400f-9e4e-d09adb8f1687', 12, 23, '2020-03-09 15:08:00', '2020-03-09 15:08:00', NULL),
(78, 1, 'Circuitos', 32, NULL, '71bb949d-7a5f-42df-86d7-530e51f2d2c0', 10, 28, '2020-03-09 15:08:34', '2020-03-09 15:08:34', NULL),
(79, 2, 'Eletrônica', 27, NULL, 'b467c958-f7f6-4589-9e0a-fc2c8d2c0ce2', 11, 28, '2020-03-09 15:08:49', '2020-03-09 15:08:49', NULL),
(80, 3, 'Corrente Elétrica', 21, NULL, '4544b526-5151-43a3-9fc1-14f66e63f5be', 12, 28, '2020-03-09 15:09:10', '2020-03-09 15:09:10', NULL),
(81, 1, 'Sistema Servidor', 23, NULL, '7746d2e7-c5da-4332-ab94-5c813fae4356', 10, 13, '2020-03-09 15:09:30', '2020-03-09 15:09:30', NULL),
(82, 2, 'Sistema Cliente', 31, NULL, '147804ca-b65a-48fc-90a0-8d9bff42c230', 11, 13, '2020-03-09 15:09:44', '2020-03-09 15:09:44', NULL),
(83, 3, 'Ubunto', 31, NULL, '11410ffd-d2a7-494c-9c14-d7c9129efdbd', 12, 13, '2020-03-09 15:09:59', '2020-03-09 15:09:59', NULL),
(84, 1, 'Corrente', 23, NULL, '7baaade9-0d60-424a-b415-0d5f2b7f3a6a', 10, 29, '2020-03-09 15:10:43', '2020-03-09 15:10:43', NULL),
(85, 2, 'Transformadores', 22, NULL, '596f9f1d-b914-44a7-b013-37da818f84b9', 11, 29, '2020-03-09 15:11:00', '2020-03-09 15:11:00', NULL),
(86, 3, 'Circuitos', 21, NULL, '8dfc6a6b-24d7-412b-9d06-f8174da12e18', 12, 29, '2020-03-09 15:11:16', '2020-03-09 15:11:16', NULL),
(87, 3, 'Família', 26, NULL, '1b9653c3-57d7-468a-a423-326c992f9c9e', 12, 4, '2020-03-09 15:12:02', '2020-03-09 15:12:02', NULL),
(88, 1, 'Website', 40, NULL, 'a490348a-fad9-4322-879c-ace0e9a7fe58', 10, 5, '2020-03-09 15:12:49', '2020-03-09 15:13:03', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos_alunos`
--

CREATE TABLE `modulos_alunos` (
  `id_ma` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id_turma` int(11) NOT NULL,
  `turma` varchar(5) NOT NULL,
  `ano` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `turma`, `ano`, `id_curso`, `uuid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'I', 10, 1, '4a7e6e26-7a22-49e9-bacf-dbedc8fbdfe5', '2020-03-05 14:52:27', '2020-03-05 14:52:27', NULL),
(2, 'I', 11, 1, 'eeb5ad85-938c-4cb2-a6df-a2ea51c39505', '2020-03-05 14:53:59', '2020-03-05 14:53:59', NULL),
(3, 'I', 12, 1, '13abc96c-52d9-4e8f-aee5-af03fb328985', '2020-03-05 14:54:14', '2020-03-05 14:54:14', NULL),
(4, 'T', 10, 2, 'bd202032-1864-4383-931a-d70b6298ebb3', '2020-03-05 14:55:05', '2020-03-05 14:55:05', NULL),
(5, 'T', 11, 2, 'b2ec4b5f-fc44-45c5-9988-4e1835cd2222', '2020-03-05 14:55:14', '2020-03-05 14:55:14', NULL),
(6, 'T', 12, 2, '823db760-c565-4ce5-86ff-e98368c0017e', '2020-03-05 14:55:23', '2020-03-05 14:55:23', NULL),
(7, 'AS', 10, 3, 'b424b148-001c-49e0-a932-7c9f47f7d37c', '2020-03-05 14:55:46', '2020-03-05 14:55:46', NULL),
(8, 'AS', 11, 3, '2df8b38d-ec95-4ee0-b1ba-d2ba8f84ad72', '2020-03-05 14:57:58', '2020-03-05 14:57:58', NULL),
(9, 'AS', 12, 3, '3dfc4d57-d50a-4444-b514-5462974c3241', '2020-03-05 14:58:08', '2020-03-05 14:58:08', NULL),
(10, 'EAC', 10, 4, '859c92aa-26a6-4ebe-97d9-cedd719a4913', '2020-03-05 14:58:18', '2020-03-05 14:58:18', NULL),
(11, 'EAC', 11, 4, 'e6112908-3dab-4907-8f28-3eb4335cd9a3', '2020-03-05 14:58:27', '2020-03-05 14:58:27', NULL),
(12, 'EAC', 12, 4, 'eb63832d-aa12-4bad-9e99-62904aa278bc', '2020-03-05 14:58:36', '2020-03-05 14:58:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas_disciplinas_users`
--

CREATE TABLE `turmas_disciplinas_users` (
  `id_tdu` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turmas_disciplinas_users`
--

INSERT INTO `turmas_disciplinas_users` (`id_tdu`, `id_turma`, `id_disciplina`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, '2020-03-09 11:15:27', '2020-03-11 10:54:23'),
(2, 2, 1, 6, '2020-03-09 11:15:35', '2020-03-11 10:55:15'),
(3, 3, 1, 0, '2020-03-09 11:15:39', '2020-03-09 11:15:39'),
(4, 4, 1, 0, '2020-03-09 11:15:53', '2020-03-09 11:15:53'),
(5, 5, 1, 0, '2020-03-09 11:15:57', '2020-03-09 11:15:57'),
(6, 6, 1, 0, '2020-03-09 11:16:01', '2020-03-09 11:16:01'),
(7, 7, 1, 0, '2020-03-09 11:16:05', '2020-03-09 11:16:05'),
(9, 8, 1, 0, '2020-03-09 11:16:10', '2020-03-09 11:16:10'),
(10, 9, 1, 0, '2020-03-09 11:16:14', '2020-03-09 11:16:14'),
(11, 10, 1, 0, '2020-03-09 11:16:18', '2020-03-09 11:16:18'),
(12, 11, 1, 0, '2020-03-09 11:16:22', '2020-03-09 11:16:22'),
(13, 12, 1, 0, '2020-03-09 11:16:38', '2020-03-09 11:16:38'),
(14, 1, 2, 0, '2020-03-09 11:18:34', '2020-03-09 11:18:34'),
(15, 2, 2, 0, '2020-03-09 11:18:39', '2020-03-09 11:18:39'),
(17, 10, 2, 0, '2020-03-09 11:19:01', '2020-03-09 11:19:01'),
(18, 11, 2, 0, '2020-03-09 11:19:07', '2020-03-09 11:19:07'),
(19, 11, 2, 0, '2020-03-09 11:19:07', '2020-03-09 11:19:07'),
(20, 4, 3, 0, '2020-03-09 11:19:35', '2020-03-09 11:19:35'),
(21, 5, 3, 0, '2020-03-09 11:19:41', '2020-03-09 11:19:41'),
(22, 7, 3, 0, '2020-03-09 11:19:45', '2020-03-09 11:19:45'),
(24, 8, 3, 0, '2020-03-09 11:19:49', '2020-03-09 11:19:49'),
(25, 1, 4, 0, '2020-03-09 11:20:34', '2020-03-09 11:20:34'),
(26, 2, 4, 0, '2020-03-09 11:20:37', '2020-03-09 11:20:37'),
(27, 3, 4, 0, '2020-03-09 11:20:40', '2020-03-09 11:20:40'),
(30, 5, 4, 0, '2020-03-09 11:20:48', '2020-03-09 11:20:48'),
(31, 6, 4, 0, '2020-03-09 11:20:51', '2020-03-09 11:20:51'),
(32, 7, 4, 0, '2020-03-09 11:20:55', '2020-03-09 11:20:55'),
(33, 8, 4, 0, '2020-03-09 11:20:59', '2020-03-09 11:20:59'),
(34, 9, 4, 0, '2020-03-09 11:21:06', '2020-03-09 11:21:06'),
(35, 10, 4, 0, '2020-03-09 11:21:11', '2020-03-09 11:21:11'),
(36, 11, 4, 0, '2020-03-09 11:21:15', '2020-03-09 11:21:15'),
(37, 12, 4, 0, '2020-03-09 11:21:19', '2020-03-09 11:21:19'),
(39, 4, 5, 0, '2020-03-09 11:22:14', '2020-03-09 11:22:14'),
(40, 7, 5, 0, '2020-03-09 11:22:19', '2020-03-09 11:22:19'),
(42, 1, 6, 0, '2020-03-09 11:23:04', '2020-03-09 11:23:04'),
(43, 3, 6, 0, '2020-03-09 11:23:08', '2020-03-09 11:23:08'),
(44, 2, 6, 0, '2020-03-09 11:23:11', '2020-03-09 11:23:11'),
(45, 4, 6, 0, '2020-03-09 11:23:16', '2020-03-09 11:23:16'),
(47, 5, 6, 0, '2020-03-09 11:23:20', '2020-03-09 11:23:20'),
(48, 6, 6, 0, '2020-03-09 11:23:23', '2020-03-09 11:23:23'),
(49, 7, 6, 0, '2020-03-09 11:23:28', '2020-03-09 11:23:28'),
(50, 8, 6, 0, '2020-03-09 11:23:37', '2020-03-09 11:23:37'),
(51, 9, 6, 0, '2020-03-09 11:23:42', '2020-03-09 11:23:42'),
(53, 10, 6, 0, '2020-03-09 11:23:46', '2020-03-09 11:23:46'),
(54, 11, 6, 0, '2020-03-09 11:23:50', '2020-03-09 11:23:50'),
(55, 12, 6, 0, '2020-03-09 11:23:55', '2020-03-09 11:23:55'),
(56, 1, 7, 0, '2020-03-09 11:24:45', '2020-03-09 11:24:45'),
(57, 2, 7, 0, '2020-03-09 11:24:49', '2020-03-09 11:24:49'),
(58, 3, 7, 0, '2020-03-09 11:24:53', '2020-03-09 11:24:53'),
(59, 10, 7, 0, '2020-03-09 11:24:58', '2020-03-09 11:24:58'),
(60, 11, 7, 0, '2020-03-09 11:25:03', '2020-03-09 11:25:03'),
(61, 12, 7, 0, '2020-03-09 11:25:08', '2020-03-09 11:25:08'),
(62, 4, 8, 0, '2020-03-09 11:25:52', '2020-03-09 11:25:52'),
(63, 5, 8, 0, '2020-03-09 11:25:57', '2020-03-09 11:25:57'),
(64, 6, 8, 0, '2020-03-09 11:26:03', '2020-03-09 11:26:03'),
(65, 6, 8, 0, '2020-03-09 11:26:03', '2020-03-09 11:26:03'),
(67, 7, 9, 0, '2020-03-09 11:33:30', '2020-03-09 11:33:30'),
(68, 8, 9, 0, '2020-03-09 11:33:34', '2020-03-09 11:33:34'),
(69, 9, 9, 0, '2020-03-09 11:33:38', '2020-03-09 11:33:38'),
(70, 1, 10, 0, '2020-03-09 11:34:27', '2020-03-09 11:34:27'),
(71, 2, 10, 0, '2020-03-09 11:34:32', '2020-03-09 11:34:32'),
(72, 3, 10, 0, '2020-03-09 11:34:37', '2020-03-09 11:34:37'),
(73, 10, 10, 0, '2020-03-09 11:34:41', '2020-03-09 11:34:41'),
(74, 11, 10, 0, '2020-03-09 11:34:46', '2020-03-09 11:34:46'),
(75, 12, 10, 0, '2020-03-09 11:34:51', '2020-03-09 11:34:51'),
(76, 7, 11, 0, '2020-03-09 11:35:25', '2020-03-09 11:35:25'),
(77, 8, 11, 0, '2020-03-09 11:35:29', '2020-03-09 11:35:29'),
(78, 9, 11, 0, '2020-03-09 11:35:33', '2020-03-09 11:35:33'),
(79, 4, 12, 0, '2020-03-09 11:36:19', '2020-03-09 11:36:19'),
(80, 5, 12, 0, '2020-03-09 11:36:23', '2020-03-09 11:36:23'),
(81, 6, 12, 0, '2020-03-09 11:36:26', '2020-03-09 11:36:26'),
(82, 1, 13, 0, '2020-03-09 11:37:29', '2020-03-09 11:37:29'),
(83, 2, 13, 0, '2020-03-09 11:37:34', '2020-03-09 11:37:34'),
(84, 3, 13, 0, '2020-03-09 11:37:37', '2020-03-09 11:37:37'),
(85, 1, 14, 5, '2020-03-09 11:38:02', '2020-03-11 10:54:52'),
(86, 2, 14, 5, '2020-03-09 11:38:06', '2020-03-11 10:55:32'),
(88, 1, 15, 0, '2020-03-09 11:38:42', '2020-03-09 11:38:42'),
(91, 3, 15, 0, '2020-03-09 11:38:51', '2020-03-09 11:38:51'),
(92, 1, 16, 4, '2020-03-09 11:41:07', '2020-03-11 11:00:45'),
(95, 3, 16, 0, '2020-03-09 11:41:14', '2020-03-09 11:41:14'),
(98, 5, 17, 0, '2020-03-09 11:42:11', '2020-03-09 11:42:11'),
(99, 6, 17, 0, '2020-03-09 11:42:15', '2020-03-09 11:42:15'),
(100, 4, 18, 0, '2020-03-09 11:43:11', '2020-03-09 11:43:11'),
(101, 5, 18, 0, '2020-03-09 11:43:17', '2020-03-09 11:43:17'),
(102, 6, 18, 0, '2020-03-09 11:43:21', '2020-03-09 11:43:21'),
(103, 4, 19, 0, '2020-03-09 11:43:50', '2020-03-09 11:43:50'),
(104, 5, 19, 0, '2020-03-09 11:43:54', '2020-03-09 11:43:54'),
(105, 6, 19, 0, '2020-03-09 11:43:58', '2020-03-09 11:43:58'),
(106, 4, 20, 0, '2020-03-09 11:44:48', '2020-03-09 11:44:48'),
(107, 5, 20, 0, '2020-03-09 11:44:53', '2020-03-09 11:44:53'),
(108, 6, 20, 0, '2020-03-09 11:44:56', '2020-03-09 11:44:56'),
(109, 4, 21, 0, '2020-03-09 11:46:20', '2020-03-09 11:46:20'),
(110, 5, 21, 0, '2020-03-09 11:46:24', '2020-03-09 11:46:24'),
(111, 6, 21, 0, '2020-03-09 11:46:30', '2020-03-09 11:46:30'),
(112, 7, 22, 0, '2020-03-09 11:49:54', '2020-03-09 11:49:54'),
(113, 8, 22, 0, '2020-03-09 11:49:58', '2020-03-09 11:49:58'),
(114, 9, 22, 0, '2020-03-09 11:50:02', '2020-03-09 11:50:02'),
(115, 7, 23, 0, '2020-03-09 11:50:21', '2020-03-09 11:50:21'),
(116, 8, 23, 0, '2020-03-09 11:50:25', '2020-03-09 11:50:25'),
(117, 9, 23, 0, '2020-03-09 11:50:29', '2020-03-09 11:50:29'),
(118, 7, 24, 0, '2020-03-09 11:51:14', '2020-03-09 11:51:14'),
(120, 8, 24, 0, '2020-03-09 11:51:18', '2020-03-09 11:51:18'),
(121, 9, 24, 0, '2020-03-09 11:51:23', '2020-03-09 11:51:23'),
(122, 7, 25, 0, '2020-03-09 11:52:07', '2020-03-09 11:52:07'),
(123, 8, 25, 0, '2020-03-09 11:52:11', '2020-03-09 11:52:11'),
(125, 9, 25, 0, '2020-03-09 11:52:15', '2020-03-09 11:52:15'),
(126, 7, 26, 0, '2020-03-09 11:53:17', '2020-03-09 11:53:17'),
(128, 8, 26, 0, '2020-03-09 11:53:22', '2020-03-09 11:53:22'),
(129, 9, 26, 0, '2020-03-09 11:53:26', '2020-03-09 11:53:26'),
(130, 10, 27, 0, '2020-03-09 11:54:00', '2020-03-09 11:54:00'),
(131, 11, 27, 0, '2020-03-09 11:54:03', '2020-03-09 11:54:03'),
(132, 12, 27, 0, '2020-03-09 11:54:07', '2020-03-09 11:54:07'),
(133, 10, 28, 0, '2020-03-09 11:54:26', '2020-03-09 11:54:26'),
(134, 11, 28, 0, '2020-03-09 11:54:31', '2020-03-09 11:54:31'),
(135, 12, 28, 0, '2020-03-09 11:54:34', '2020-03-09 11:54:34'),
(137, 10, 29, 0, '2020-03-09 11:54:57', '2020-03-09 11:54:57'),
(138, 11, 29, 0, '2020-03-09 11:55:01', '2020-03-09 11:55:01'),
(139, 12, 29, 0, '2020-03-09 11:55:05', '2020-03-09 11:55:05'),
(140, 10, 30, 0, '2020-03-09 11:55:39', '2020-03-09 11:55:39'),
(141, 11, 30, 0, '2020-03-09 11:55:43', '2020-03-09 11:55:43'),
(142, 12, 30, 0, '2020-03-09 11:55:48', '2020-03-09 11:55:48'),
(143, 2, 16, 4, '2020-03-12 12:08:43', '2020-03-12 12:10:51'),
(144, 2, 15, 0, '2020-03-12 12:10:28', '2020-03-12 12:10:28'),
(151, 10, 5, 0, '2020-03-12 12:50:42', '2020-03-12 12:50:42'),
(152, 4, 4, 0, '2020-03-12 12:54:01', '2020-03-12 12:54:01'),
(153, 4, 17, 0, '2020-03-12 12:55:01', '2020-03-12 12:55:01'),
(155, 1, 5, 0, '2020-03-12 13:12:15', '2020-03-12 13:12:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas_modulos`
--

CREATE TABLE `turmas_modulos` (
  `id_tm` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas_users`
--

CREATE TABLE `turmas_users` (
  `id_tu` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turmas_users`
--

INSERT INTO `turmas_users` (`id_tu`, `id_turma`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2020-03-11 12:16:04', '2020-03-11 12:16:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotografia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente' COMMENT 'superadmin/admin/professor/pendente',
  `dark_mode` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `fotografia`, `email_verified_at`, `password`, `tipo_user`, `dark_mode`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, ' ', 'asdasdasfhid@mail.com', NULL, NULL, 'dqw789er28#!\"3r23$#$&QEWAaasd', '', NULL, NULL, NULL, NULL, NULL),
(1, 'Admin', 'admin@mail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'admin', NULL, NULL, '2019-12-04 11:21:06', '2019-12-04 11:21:06', NULL),
(2, 'SuperAdmin', 'superadmin@gmail.com', NULL, NULL, '$2y$10$KWbQk9kZaj4chPeg6m8ReuHdzmkWWfqnyM56ibdW.wZEEyanLxA1a', 'superadmin', 's', NULL, '2019-12-04 17:08:03', '2020-03-12 11:15:15', NULL),
(3, 'Roberto', 'roberto@gmail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'pendente', NULL, NULL, '2019-12-04 11:21:06', '2020-03-02 08:00:07', NULL),
(4, 'Anselmo', 'anselmo@gmail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'professor', 's', NULL, '2019-12-04 11:21:06', '2020-03-04 11:51:38', NULL),
(5, 'Marta', 'marta@gmail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'professor', NULL, NULL, '2019-12-04 11:21:06', NULL, NULL),
(6, 'Carla', 'carla@gmail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'professor', NULL, NULL, '2019-12-04 11:21:06', NULL, NULL),
(7, 'Silvia', 'silvia@gmail.com', NULL, NULL, '$2y$10$y04w82B/Xg2FEpmEPU2hO.loKDK8saqieEydaOAO.iR2IjCbwtxKy', 'professor', NULL, NULL, '2019-12-04 11:21:06', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices para tabela `anos_letivos`
--
ALTER TABLE `anos_letivos`
  ADD PRIMARY KEY (`id_ano_letivo`);

--
-- Índices para tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`);

--
-- Índices para tabela `aulas_alunos`
--
ALTER TABLE `aulas_alunos`
  ADD PRIMARY KEY (`id_aa`);

--
-- Índices para tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`);

--
-- Índices para tabela `avaliacoes_criterios`
--
ALTER TABLE `avaliacoes_criterios`
  ADD PRIMARY KEY (`id_ac`);

--
-- Índices para tabela `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`id_criterio`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `cursos_disciplinas`
--
ALTER TABLE `cursos_disciplinas`
  ADD PRIMARY KEY (`id_cd`);

--
-- Índices para tabela `cursos_users`
--
ALTER TABLE `cursos_users`
  ADD PRIMARY KEY (`id_cu`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id_disciplina`);

--
-- Índices para tabela `disciplinas_alunos`
--
ALTER TABLE `disciplinas_alunos`
  ADD PRIMARY KEY (`id_da`);

--
-- Índices para tabela `disciplinas_turmas`
--
ALTER TABLE `disciplinas_turmas`
  ADD PRIMARY KEY (`id_dt`);

--
-- Índices para tabela `disciplinas_users`
--
ALTER TABLE `disciplinas_users`
  ADD PRIMARY KEY (`id_ud`);

--
-- Índices para tabela `faltas`
--
ALTER TABLE `faltas`
  ADD PRIMARY KEY (`id_falta`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Índices para tabela `modulos_alunos`
--
ALTER TABLE `modulos_alunos`
  ADD PRIMARY KEY (`id_ma`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id_turma`);

--
-- Índices para tabela `turmas_disciplinas_users`
--
ALTER TABLE `turmas_disciplinas_users`
  ADD PRIMARY KEY (`id_tdu`);

--
-- Índices para tabela `turmas_modulos`
--
ALTER TABLE `turmas_modulos`
  ADD PRIMARY KEY (`id_tm`);

--
-- Índices para tabela `turmas_users`
--
ALTER TABLE `turmas_users`
  ADD PRIMARY KEY (`id_tu`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `anos_letivos`
--
ALTER TABLE `anos_letivos`
  MODIFY `id_ano_letivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aulas_alunos`
--
ALTER TABLE `aulas_alunos`
  MODIFY `id_aa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id_avaliacao` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacoes_criterios`
--
ALTER TABLE `avaliacoes_criterios`
  MODIFY `id_ac` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id_criterio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cursos_disciplinas`
--
ALTER TABLE `cursos_disciplinas`
  MODIFY `id_cd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `cursos_users`
--
ALTER TABLE `cursos_users`
  MODIFY `id_cu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `disciplinas_alunos`
--
ALTER TABLE `disciplinas_alunos`
  MODIFY `id_da` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `disciplinas_turmas`
--
ALTER TABLE `disciplinas_turmas`
  MODIFY `id_dt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `disciplinas_users`
--
ALTER TABLE `disciplinas_users`
  MODIFY `id_ud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `faltas`
--
ALTER TABLE `faltas`
  MODIFY `id_falta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `modulos_alunos`
--
ALTER TABLE `modulos_alunos`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `turmas_disciplinas_users`
--
ALTER TABLE `turmas_disciplinas_users`
  MODIFY `id_tdu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de tabela `turmas_modulos`
--
ALTER TABLE `turmas_modulos`
  MODIFY `id_tm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas_users`
--
ALTER TABLE `turmas_users`
  MODIFY `id_tu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
