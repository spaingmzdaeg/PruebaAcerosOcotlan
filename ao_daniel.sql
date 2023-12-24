-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 02:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ao_daniel`
--

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rfc` varchar(255) NOT NULL,
  `departamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `departamento_id`) VALUES
(7, 'Perez', 'Torres', 'Juan', '412412412', 4),
(9, 'Morgan', 'Morgan', 'Arturo', '3213123123', 6),
(38, 'Bale', 'Bale', 'Gareth', 'dadasda', 4),
(40, 'Ronaldo', 'Dos Santos', 'Cristiano', '312312s', 4),
(41, 'Reus', 'Bale', 'Marco', 'dadasdsd', 5),
(42, 'Messi', 'Leonel', 'Cristiano', 'dasdasd', 5),
(43, 'Reus', 'Reus', 'Gareth', 'dasdas', 4),
(44, 'Ronaldo', 'Reus', 'Cristiano', 'asdasd', 5),
(45, 'Artiago', 'Lopez', 'Gerardo', '21312312', 5),
(46, 'Sal', 'Haaland', 'Gareth', '31231312', 5),
(47, 'Southgate', 'Southgate', 'Gareth', 'dasdadad', 5),
(48, 'Bale', 'bALEDASD', 'Gareth', 'DASDASD', 4),
(49, 'SANTOS', 'OROZCO', 'ROSA', 'DASDASDAS', 6),
(50, 'Dos Santos', 'Dos stantos', 'Giovanni', 'SDASDASD', 5),
(51, 'Parker', 'Parker', 'Peter', 'peter', 5),
(52, 'Bale', 'Bale', 'Cristiano', 'dasdas', 5),
(53, 'Bale', 'Bale', 'Cristiano', '231231', 4),
(54, 'Iniesta', 'Cesarino', 'Andres', 'dadkadasda', 5);

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES
(4, 'TI'),
(5, 'Contabilidad'),
(6, 'Cobranza');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
