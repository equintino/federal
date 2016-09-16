-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2016 às 05:38
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinistro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jd_possivel`
--

CREATE TABLE `jd_possivel` (
  `SEGURADOS` varchar(35) DEFAULT NULL,
  `SINISTRO_POSSIVEL` varchar(10) DEFAULT NULL,
  `PARTE_CONTRARIA` varchar(53) DEFAULT NULL,
  `VALOR_PEDIDO` varchar(15) DEFAULT NULL,
  `HONORARIOS` varchar(11) DEFAULT NULL,
  `POSSIVEL` varchar(10) NOT NULL DEFAULT 'POSSIVEL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jd_possivel`
--

INSERT INTO `jd_possivel` (`SEGURADOS`, `SINISTRO_POSSIVEL`, `PARTE_CONTRARIA`, `VALOR_PEDIDO`, `HONORARIOS`, `POSSIVEL`) VALUES
('ADELINO TAVARES GUERRA FILHO', '', 'Benedita Alves guerra', 'R$ 12.800,20', '', 'POSSIVEL'),
('Ademar Tavares De Moura', '', 'Luzia Brasiliano Da Silva', 'R$ 4.287,52', '', 'POSSIVEL'),
('Alcy Souza Cardozo', '', 'Alcy Souza Cardozo', 'R$ 17.486,43', '', 'POSSIVEL'),
('Alexandro Garcia Duarte', '', 'Alexandro Garcia Duarte', 'R$ 25.000,00', '', 'POSSIVEL'),
('Alice Cristina Bastos Moraes', '', 'Thalita Bastos Moraes', 'R$ 41.455,61', '', 'POSSIVEL'),
('Altair De Oliveira Alves', '', 'Nair Manh?es Oliveira', 'R$ 40.000,00', '', 'POSSIVEL'),
('Angelo Savy Filho', '', 'RENATO FERRAZ SAMPAIO SALVY', 'R$ 5.743,81', '', 'POSSIVEL'),
('Anizia Leite de Melo', '', 'Solange Leite de Melo', 'R$ 11.997,08', '', 'POSSIVEL'),
('Antonia Seve de Azevedo', '', 'Josias Seve de Azevedo', 'R$ 17.255,36', '', 'POSSIVEL'),
('Antonio Carlos Silva Barros', '', 'Neuza Dionisio Do Couto', '', '', 'POSSIVEL'),
('Antonio Jurandir Gomes', '', 'Antonio Jurandir Gomes', 'R$ 109.949,40', '', 'POSSIVEL'),
('Antonio Xavier da Costa', '', 'Maria Luiza da Costa', 'R$ 7.321,64', '', 'POSSIVEL'),
('Aristides Alexandre Gomes', '', 'Maria Jose Gomes', 'R$ 12.588,38', 'R$ 1.258,83', 'POSSIVEL'),
('Atal? Figueiredo Bittencourt', '', 'Regina L?cia C?mara Torres', '', '', 'POSSIVEL'),
('Balbina Deluqui Moraleco', '', 'ELIANE Maria Deluqui Moraleco Ramos', 'R$ 10.000,00', '', 'POSSIVEL'),
('Carmelita Santos Monteiro Lopes', '', 'Carmelita Santos Monteiro Lopes', 'R$ 31.520,00', '', 'POSSIVEL'),
('CONCEI??O ESMENIA GUIMAR?ES', '', 'CONCEI??O ESMENIA GUIMAR?ES', 'R$ 1,00', '', 'POSSIVEL'),
('Danilo Guedes Romeu', '', 'Danilo Guedes Romeu', 'R$ 20.577,60', '', 'POSSIVEL'),
('Danos Materiais', '', 'Cristina Martins Knapp', 'R$ 32.000,00', '', 'POSSIVEL'),
('Danos Materiais', '', 'Meraline Targino de Lima', '400.000,00', '', 'POSSIVEL'),
('Djalma de Souza Goncalves', '', 'Djalma de Souza Goncalves', '', '', 'POSSIVEL'),
('Dolores Souza de Assis', '', 'Cristiano Souza de Assis', '', '', 'POSSIVEL'),
('Edgard Teixeira Da Silva', '', 'Maria Elena Dos Santos', '', '', 'POSSIVEL'),
('EDIMAR DE SOUZA SILVA', '', 'EDIMAR DE SOUZA SILVA', 'R$ 1,00', '', 'POSSIVEL'),
('Elisio Marra Neto', '', 'Elisio Marra Neto', 'R$ 26.492,50', '', 'POSSIVEL'),
('Emidio Soares Da Silva', '', 'Adalberto Soares Da Silva', '', '', 'POSSIVEL'),
('Estanislau Kerzella', '', 'Estanislau Kerzella', 'R$ 37.500,00', '', 'POSSIVEL'),
('Estelita Cunha Ramos', '', 'Estelita Cunha Ramos', 'R$ 15.760,00', '', 'POSSIVEL'),
('Eulogio Moreira Caldas', '', 'Mariluce Caldas Poli', 'R$ 25.000,00', '', 'POSSIVEL'),
('EVODES JOSE DA SILVA', '', 'ENEIAS RIBEIRO DA SILVA', 'R$ 2.799,18', '', 'POSSIVEL'),
('FORTUNE HOMSANI', '', 'FORTUNE HOMSANI', '', '', 'POSSIVEL'),
('Francisco Ferreira de Lima', '', 'Francisco Ferreira de Lima', 'R$ 1,00', '', 'POSSIVEL'),
('Gil Guedes da Fonseca', '', 'Espolio de Gil Guedes da Fonseca', '', '', 'POSSIVEL'),
('Gilzane Chagas Almeida', '', 'Gilzane Chagas Almeida', 'R$ 41,92', '', 'POSSIVEL'),
('Graziela Zacchi Felix', '', 'Graziela Zacchi Felix', 'R$ 100.000,00', '', 'POSSIVEL'),
('Helvio Santos Pompilio', '', 'Helvio Santos Pompilio', 'R$ 128.120,78', '', 'POSSIVEL'),
('Ismael Cirqueira dos Santos Filho', '', 'Deise de Jesus Bernardes', 'R$ 50.000,00', '', 'POSSIVEL'),
('Izabel Xavier De Moraes', '', 'Jessica Oliveira Moraes', 'R$ 20.000,00', '', 'POSSIVEL'),
('Jacira Guimar?es Maciel', '', 'Wagner Guimar?es Antunes Maciel', 'R$ 1,00', 'R$ 1,00', 'POSSIVEL'),
('Jair Amaro Luiz', '', 'Maria Santa Luiz', 'R$ 22.000,00', '', 'POSSIVEL'),
('JANDIRA DONATA SILVEIRA', '', 'OSCAR SEBASTI?O SILVEIRA', 'R$ 1,00', '', 'POSSIVEL'),
('JOAO ALAYR GUEDES', '', 'FABIANA GUEDES PACHECO', 'R$ 43,31', '', 'POSSIVEL'),
('Joao Batista da Silva', '', 'Joao Batista da Silva', 'R$ 1,00', '', 'POSSIVEL'),
('Joaquim S?rgio dos Santos', '', 'Maria do Livramento de Almeida', '', '', 'POSSIVEL'),
('JOIL CUNHA', '', 'JOIL CUNHA', 'R$ 6.950,29', '', 'POSSIVEL'),
('Jorge De Andrade', '', 'Nilzete Andr? de Andrade', 'R$ 41.207,07', '', 'POSSIVEL'),
('Jose Alves de Deus', '', 'Espolio de Jose Alves de Deus', '', '', 'POSSIVEL'),
('Jos? Antonio Gomide', '', 'Rosimeire Aparecida Camillo de Camargo', 'R$ 200.000,00', '', 'POSSIVEL'),
('Jos? Carlos de Azevedo', '', 'Jos? Carlos de Azevedo', 'R$ 1,00', '', 'POSSIVEL'),
('Jos? d Araujo', '', 'Jos? d Araujo', 'R$ 1,00', '', 'POSSIVEL'),
('Jos? Gouveia da Silva', '', 'Alzira Luiza da Silva', 'R$ 4.132,37', '', 'POSSIVEL'),
('Jos? Joaquim Cavalcante Dias', '', 'Maria Jose Cavalcante Dias', 'R$ 1,00', '', 'POSSIVEL'),
('Jos? Rodrigues Chaves', '', 'Jos? Rodrigues Chaves', 'R$ 20.000,00', '', 'POSSIVEL'),
('Jos? Vaz Ten?rio Filho', '', 'Regina Maria dos Santos Vaz Ten?rio', '', '', 'POSSIVEL'),
('Jose Zoia Da Silva', '', 'Regina Angelica Leite Zoia', 'R$ 16.147,17', '', 'POSSIVEL'),
('Lais Garcia Leal', '', 'Marcus Jose Garcia Leal', 'R$ 7.797,14', '', 'POSSIVEL'),
('Leonardo Rebelo da Silva', '', 'Leonardo Rebelo da Silva', '', '', 'POSSIVEL'),
('Lidio Lazaro Jesus Costa', '', 'Lidio Lazaro Jesus Costa', 'R$ 200.000,00', '', 'POSSIVEL'),
('Ludgero Jos? da Silva Junior', '', 'Ludgero Jos? da Silva Junior', 'R$ 1,00', '', 'POSSIVEL'),
('Marcos da Silva Nascimento', '', 'Marcos da Silva Nascimento', 'R$ 32.200,00', '', 'POSSIVEL'),
('Maria Aparecida Barz', '', 'Saide Barz Oliveira', '', '', 'POSSIVEL'),
('Maria Aparecida Siqueira de Santana', '', 'Associa??o Sergipana de Defesa do Consumidor ? ASDECO', 'R$ 180.000,00', '', 'POSSIVEL'),
('Maria Aparecida Sobral de Souza', '', 'Maria Aparecida Sobral de Souza', 'R$ 15.760,00', '', 'POSSIVEL'),
('Maria Claudiano da Silva Andrade', '', 'Ant?nio Mendes de Andrade', 'R$ 40.644,00', '', 'POSSIVEL'),
('Maria da Gl?ria Rodrigues Junqueira', '', 'Dolores Rodrigues Junqueira', 'R$ 4.461,01', '', 'POSSIVEL'),
('Maria das Gra?as da Costa', '', 'Valter Xavier de Oliveira', 'R$ 20.000,00', '', 'POSSIVEL'),
('Maria das Gra?as do Nascimento', '', 'Maria das Gra?as do Nascimento', 'R$ 10.000,00', 'R$ 1.000,00', 'POSSIVEL'),
('Maria de F?tima Albino Silva', '', 'Maria de F?tima Albino Silva', 'R$ 30.000,00', '', 'POSSIVEL'),
('Maria de Freitas Mattos', '', 'Maria de Freitas Mattos', 'R$ 31.520,00', '', 'POSSIVEL'),
('Maria do Carmo Machado', '', 'Maria do Carmo Machado', 'R$ 10.000,00', '', 'POSSIVEL'),
('Maria Fran?a Paiva', '', 'Maria Fran?a Paiva', 'R$ 129.640,00', '', 'POSSIVEL'),
('Maria Gon?alves Pacheco Da Rocha', '', 'Ronaldo Gon?alves Da Rocha', 'R$ 7.596,55', '', 'POSSIVEL'),
('Maria Jos? Araujo da Silva', '', 'Maria Jos? Araujo da Silva', 'R$ 15.760,00', '', 'POSSIVEL'),
('Maria Julia dias Ilario', '', 'Jimi Dias Ilario', '', '', 'POSSIVEL'),
('Maria Leonor Fernandes', '', 'Maria Leonor Fernandes', 'R$ 7.182,60', '', 'POSSIVEL'),
('Maria Pires Rodrigues', '', 'Maria Jos? Braga Vasconcelos', 'R$ 5.000,00', '', 'POSSIVEL'),
('Marlene Silvia Elger', '', 'Marlene Silvia Elger', 'R$ 76.563,69', '', 'POSSIVEL'),
('Minadar Pinheiro Aciole', '', 'Minadar Pinheiro Aciole', 'R$ 41.708,07', '', 'POSSIVEL'),
('Nair Veiga de Paula', '', 'larissa Gomes de Paula', 'R$ 15.012,68', '', 'POSSIVEL'),
('Petronio Magno Venancio Barros', '', 'Petronio Magno Venancio Barros', 'R$ 3.261,27', 'R$ 0,00', 'POSSIVEL'),
('Reginaldo Santos Vieira', '', 'Ros?ngela Lima Vieira', 'R$ 12.232,12', 'R$ 1.223,21', 'POSSIVEL'),
('Roberto da Silva', '', 'Ducilda de Freitas Aquinoe Silva', 'R$ 13.116,47', '', 'POSSIVEL'),
('Roberto Ruas da Silva', '', 'Clarice Maria de Oliveira Ruas', 'R$ 9.542,63', '', 'POSSIVEL'),
('Rubens Faria Leal', '', 'Luiz Claudio Da Cruz Leal', 'R$ 5.588,65', '', 'POSSIVEL'),
('Sebastiana Garcia Ferras', '', 'Ronaldo Ferraz Cardoso', 'R$ 20.000,00', '', 'POSSIVEL'),
('Sebasti?o Luiz Monteiro', '', 'Marlene Luiza da Silva', 'R$ 25.000,00', '', 'POSSIVEL'),
('Selma Dantas Reinaldo', '', '', 'R$ 19.440,41', '', 'POSSIVEL'),
('Severina Alves de Oliveira', '', 'Erilane Silva de Oliveira', 'R$ 40.000,00', '', 'POSSIVEL'),
('Tereza Cristina Rufino Cal', '', 'Tereza Cristina Rufino Cal', 'R$ 31.520,00', '', 'POSSIVEL'),
('Tiago Alves Ribeiro', '', 'Maria das Gra?as Mendes Ribeiro', 'R$ 1.000,00', '', 'POSSIVEL'),
('Valdomiro Pereira dos Santos', '', 'Aldemira Pereira da Silva', '', '', 'POSSIVEL'),
('Valmir Candido dos Anjos', '', 'Neusa Sotero de Souza', 'R$ 5.000,00', '', 'POSSIVEL'),
('Valtemir Souza da Silva', '', 'Virginia Caldeira Ramos da Silva', 'R$ 59.837,95', '', 'POSSIVEL'),
('Valter de Souza Temponi', '', 'Valter de Souza Temponi', 'R$ 1,00', '', 'POSSIVEL'),
('Vilma Rodrigues Varanda', '', 'Keyte Keller de Mesquita', 'R$ 42.126,89', '', 'POSSIVEL'),
('Waldir Rodrigues', '', 'Mario Jorge Allie', 'R$ 7.000,00', '', 'POSSIVEL'),
('Wellington de Paula Barros', '', 'Kelme de Barros', 'R$ 82.000,00', '', 'POSSIVEL'),
('', '', 'Edgar dos Santos de Jesus', 'R$ 90.000,00', '', 'POSSIVEL'),
('', '', 'Genesilda Maria de Jesus', 'R$ 242.000,00', '', 'POSSIVEL'),
('', '', 'Fernando Alves da Fonseca', 'R$ 20.000,00', '', 'POSSIVEL'),
('', '', 'Ricardo Braz', 'R$ 1.000,00', '', 'POSSIVEL'),
('', '', 'Amelia Nelita Martins', 'R$ 108,62', '', 'POSSIVEL'),
('', '', 'Maria de Lourdes Pinto', 'R$ 1,00', '', 'POSSIVEL'),
('', '', 'Santa Lorenzon', 'R$ 1,00', '', 'POSSIVEL'),
('', '', 'Aurea Rodrigues Leonel', 'R$ 100.000,00', '', 'POSSIVEL'),
('', '', 'PEDRO LU?S DA SILVA PINTO', 'R$ 149.032,96', '', 'POSSIVEL'),
('', '', 'Jose Heleno Lopes Viana', 'R$ 2.242,21', '', 'POSSIVEL'),
('', '', 'MARTONE COSTA MACIEL', '', '', 'POSSIVEL'),
('', '', 'Francisco Ignacio de Oliveira Neto', 'R$ 5.500,00', '', 'POSSIVEL'),
('', '', 'Maria Tereza Menezes Barbosa', 'R$ 22.692,60', '', 'POSSIVEL'),
('', '', 'Jairo Oliveira da Silva', 'R$ 35.000,00', '', 'POSSIVEL'),
('', '', 'Laurentino Felix Milhomens', 'R$ 19.354,18', '', 'POSSIVEL'),
('', '', 'Maria Aparecida Pereira Lima', 'R$ 3.000,00', '', 'POSSIVEL'),
('', '', '', '', '', 'POSSIVEL'),
('', '', '', '', '', 'POSSIVEL'),
('', '', '', 'R$ 3.463.633,32', 'R$ 3.483,04', 'POSSIVEL');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
