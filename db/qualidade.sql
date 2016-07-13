-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/04/2016 às 23:30
-- Versão do servidor: 5.6.15-log
-- Versão do PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `qualidade`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `rnc`
--

CREATE TABLE IF NOT EXISTS `rnc` (
  `numero` int(5) unsigned zerofill NOT NULL,
  `abertura` date NOT NULL,
  `retorno` date NOT NULL,
  `origem` varchar(100) NOT NULL,
  `tipoacao` varchar(100) NOT NULL,
  `processo` varchar(100) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `detalhamento` text NOT NULL,
  `causas` text NOT NULL,
  `imediata` text NOT NULL,
  `corretiva` text NOT NULL,
  `responsavel_implementacao` varchar(100) NOT NULL,
  `eliminacao` date NOT NULL,
  `eliminacao_novo` date NOT NULL,
  `registro_eficacia` text NOT NULL,
  `eficaz` varchar(1) NOT NULL,
  `eficaz_data` date NOT NULL,
  `novo_rnc` int(11) NOT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `rnc`
--

INSERT INTO `rnc` (`numero`, `abertura`, `retorno`, `origem`, `tipoacao`, `processo`, `responsavel`, `detalhamento`, `causas`, `imediata`, `corretiva`, `responsavel_implementacao`, `eliminacao`, `eliminacao_novo`, `registro_eficacia`, `eficaz`, `eficaz_data`, `novo_rnc`, `obs`) VALUES
(01816, '2016-04-06', '2016-04-11', '', '', 'TI / QUALIDADE', 'EDMILSON MESSIAS QUINTINO', 'Criar um Sistema de abertura de RNC para facilitar o acesso aos colaboradores e assim o procedimento ser mais eficaz.', 'Mais controle do procedimento de Ações corretivas e preventivas.', '', 'Elaborar um sistema online para abertura de RNC', 'EDMILSON MESSIAS QUINTINO', '2016-05-31', '0000-00-00', '', '', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `priority` int(1) NOT NULL DEFAULT '2',
  `created_on` datetime NOT NULL,
  `due_on` datetime NOT NULL,
  `last_modified_on` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `comment` text,
  `status` enum('PENDENTE','FEITO','VENCIDO') NOT NULL DEFAULT 'PENDENTE',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`),
  KEY `due_on` (`due_on`),
  KEY `status` (`status`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Fazendo dump de dados para tabela `todo`
--

INSERT INTO `todo` (`id`, `priority`, `created_on`, `due_on`, `last_modified_on`, `title`, `description`, `comment`, `status`, `deleted`) VALUES
(1, 2, '2011-10-20 11:00:00', '2011-10-20 11:00:00', '2015-10-20 00:00:00', 'Clean the house', 'Clean the whole house, ideally including garden.', NULL, 'PENDENTE', 0),
(2, 2, '2011-09-02 18:24:00', '2011-10-07 08:26:49', '2016-04-21 05:22:47', 'Cut the lawn', 'Cut the lawn around the house.', 'hoje', 'PENDENTE', 0),
(3, 3, '2011-09-15 09:30:00', '2011-10-19 10:25:00', '2012-01-01 00:00:00', 'Buy a car', 'Choose the best car to buy and simply buy it.', 'New BMW bought.', 'FEITO', 0),
(4, 3, '2011-09-27 17:33:00', '2011-10-11 13:48:00', '2011-11-01 00:00:00', 'Open a new bank account', NULL, 'Not needed.', 'FEITO', 0),
(5, 1, '2010-08-12 08:17:00', '2011-10-07 08:06:40', '2010-09-01 00:00:00', 'Finish all the exams', NULL, NULL, 'VENCIDO', 0),
(6, 2, '2011-10-02 10:38:36', '2011-10-03 13:26:48', '2011-10-04 12:00:00', 'Send a letter to my sister', 'Send a letter to my sister with important information about what needs to be done.', 'Letter not needed, I called her.', 'VENCIDO', 0),
(7, 1, '2010-04-07 17:28:52', '2010-05-12 11:47:00', '2016-04-20 01:09:54', 'Book air tickets', 'Book air tickets to Canary Islands, for 3 people.', 'comento', 'PENDENTE', 1),
(8, 2, '2011-10-07 10:44:47', '2011-10-24 10:46:14', '2011-11-01 00:00:00', 'Pay electricity bills', 'Pay electricity bills for the house.', 'Paid.', 'VENCIDO', 0),
(9, 1, '2016-04-20 01:10:48', '2016-04-21 01:15:00', '2016-04-20 01:10:48', 'Testando', 'Vou testar amanhã', '', 'VENCIDO', 0),
(10, 2, '2016-04-21 05:24:17', '2016-04-22 00:00:00', '2016-04-21 18:30:44', 'Novo rnc', 'vamos ver como fica', '', 'PENDENTE', 1),
(11, 1, '2016-04-21 18:09:37', '2016-04-22 00:00:00', '2016-04-21 22:56:45', 'estou testando', 'Estou testando a mensagem após salvar', 'sem comentários', 'PENDENTE', 1),
(12, 3, '2016-04-21 18:22:14', '2016-04-22 00:00:00', '2016-04-21 18:28:38', 'o que é isso?', 'ddddd', 'estou comentando', 'PENDENTE', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
