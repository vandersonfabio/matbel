-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Abr-2019 às 15:45
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_matbel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arma`
--

CREATE TABLE `arma` (
  `id` int(11) NOT NULL,
  `numeroSerie` varchar(50) NOT NULL,
  `idSituacao` int(11) NOT NULL,
  `idModelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `arma`
--

INSERT INTO `arma` (`id`, `numeroSerie`, `idSituacao`, `idModelo`) VALUES
(1, 'fdgdfg4788484gf', 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `calibre`
--

CREATE TABLE `calibre` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `calibre`
--

INSERT INTO `calibre` (`id`, `descricao`, `isActive`) VALUES
(1, '.40', 1),
(2, '.380', 1),
(3, '5.56', 1),
(4, '7.62', 1),
(5, '9mm', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cautela`
--

CREATE TABLE `cautela` (
  `id` int(11) NOT NULL,
  `data` varchar(10) NOT NULL,
  `validade` varchar(10) DEFAULT NULL,
  `qtdMunicao` int(11) NOT NULL,
  `qtdCarregador` int(11) NOT NULL,
  `observavao` int(11) NOT NULL,
  `isOpen` tinyint(1) NOT NULL DEFAULT '1',
  `idArma` int(11) NOT NULL,
  `idRequerente` int(11) NOT NULL,
  `idSignatario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`id`, `descricao`, `isActive`) VALUES
(1, 'Taurus', 1),
(2, 'Imbel', 0),
(3, 'Glock', 1),
(4, 'CBC', 1),
(5, 'Beretta', 1),
(6, 'Smith & Wesson', 1),
(7, 'Magnum', 1),
(8, 'Colt', 1),
(9, 'Winchesterrrrr', 0),
(10, 'FAMAE', 1),
(11, 'Imbel', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `comprimentoCano` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `idTipo` int(11) NOT NULL,
  `idFabricante` int(11) NOT NULL,
  `idCalibre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `descricao`, `comprimentoCano`, `isActive`, `idTipo`, `idFabricante`, `idCalibre`) VALUES
(1, 'PT-100', 6, 1, 1, 1, 1),
(2, 'FM45677', 29, 1, 4, 10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `policial`
--

CREATE TABLE `policial` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `matricula` varchar(11) NOT NULL,
  `cpf` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

CREATE TABLE `situacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situacao`
--

INSERT INTO `situacao` (`id`, `descricao`, `isActive`) VALUES
(4, 'Operacional', 1),
(5, 'Em manutenção', 1),
(6, 'À disposição da Justiça', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `descricao`, `isActive`) VALUES
(1, 'Pistola', 1),
(2, 'Carabina', 0),
(3, 'Taser', 1),
(4, 'Fuzil', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_arma_modelo` (`idModelo`),
  ADD KEY `fk_arma_situacao` (`idSituacao`);

--
-- Indexes for table `calibre`
--
ALTER TABLE `calibre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cautela`
--
ALTER TABLE `cautela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cautela_arma` (`idArma`),
  ADD KEY `fk_cautela_requerente` (`idRequerente`);

--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modelo_tipo` (`idTipo`),
  ADD KEY `fk_modelo_fabricante` (`idFabricante`),
  ADD KEY `fk_modelo_calibre` (`idCalibre`);

--
-- Indexes for table `policial`
--
ALTER TABLE `policial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `situacao`
--
ALTER TABLE `situacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arma`
--
ALTER TABLE `arma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calibre`
--
ALTER TABLE `calibre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cautela`
--
ALTER TABLE `cautela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `policial`
--
ALTER TABLE `policial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `situacao`
--
ALTER TABLE `situacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `arma`
--
ALTER TABLE `arma`
  ADD CONSTRAINT `fk_arma_modelo` FOREIGN KEY (`idModelo`) REFERENCES `modelo` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_arma_situacao` FOREIGN KEY (`idSituacao`) REFERENCES `situacao` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cautela`
--
ALTER TABLE `cautela`
  ADD CONSTRAINT `fk_cautela_arma` FOREIGN KEY (`idArma`) REFERENCES `arma` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cautela_requerente` FOREIGN KEY (`idRequerente`) REFERENCES `policial` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_modelo_calibre` FOREIGN KEY (`idCalibre`) REFERENCES `calibre` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modelo_fabricante` FOREIGN KEY (`idFabricante`) REFERENCES `fabricante` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modelo_tipo` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
