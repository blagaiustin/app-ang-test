-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 09:59 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `Utilizator` varchar(4095) NOT NULL DEFAULT '',
  `Parola` varchar(4095) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `Utilizator`, `Parola`) VALUES
(1, 'admin', '12345'),
(2, 'maria', '54321');

-- --------------------------------------------------------

--
-- Table structure for table `elevi`
--

CREATE TABLE `elevi` (
  `id` int(11) NOT NULL,
  `nume` varchar(4095) NOT NULL DEFAULT '',
  `prenume` varchar(4095) NOT NULL DEFAULT '',
  `clasa` varchar(4095) NOT NULL DEFAULT '',
  `romana` varchar(4095) NOT NULL DEFAULT '',
  `mate` varchar(4095) NOT NULL DEFAULT '',
  `engleza` varchar(4095) NOT NULL DEFAULT '',
  `informatica` varchar(4095) NOT NULL DEFAULT '',
  `biologie` varchar(4095) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elevi`
--

INSERT INTO `elevi` (`id`, `nume`, `prenume`, `clasa`, `romana`, `mate`, `engleza`, `informatica`, `biologie`) VALUES
(1, 'Blaga', 'Iustin', 'a 12-a C', '8', '9', '7', '9', '8'),
(2, 'Amarandei', 'Andrei', 'a 10-a A', '7', '7', '9', '6', '10'),
(3, 'Atasiei', 'George', 'a 9-a B', '6', '7', '6', '8', '9'),
(4, 'Revenco', 'Daniel', 'a 12-a C', '5', '7', '7', '8', '5'),
(5, 'Nita', 'Alina', 'a 12-a A', '7', '8', '10', '8', '6'),
(6, 'Cartas', 'Alina', 'a 11-a B', '9', '9', '8', '10', '8'),
(7, 'Panfil', 'Cosmin', 'a 11-a A', '7', '7', '9', '8', '10'),
(8, 'Tapceanu', 'Corina', 'a 9-a A', '7', '6', '6', '9', '10'),
(9, 'Sima', 'Ioana', 'a 9-a C', '7', '7', '6', '10', '8'),
(10, 'Olinici', 'Bogdan', 'a 9-a A', '5', '4', '8', '8', '7'),
(11, 'Blajut', 'Alina', 'a 10-a B', '5', '7', '4', '8', '8'),
(12, 'Mariuta', 'Ciprian', 'a 12-a B', '4', '8', '8', '7', '8'),
(13, 'Totdirascu', 'Ilie', 'a 10-a C', '6', '5', '8', '4', '7'),
(14, 'Petrica', 'Ionut', 'a 11-a B', '7', '7', '10', '6', '6'),
(15, 'Teacu', 'Cosmin', 'a 12-a C', '9', '10', '10', '10', '10'),
(16, 'Blaga', 'Victor', 'a 12-a B', '8', '2', '', '5', '9');

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

CREATE TABLE `profesori` (
  `id` int(11) NOT NULL,
  `nume` varchar(4095) NOT NULL DEFAULT '',
  `prenume` varchar(4095) NOT NULL DEFAULT '',
  `clasa` varchar(4095) NOT NULL DEFAULT '',
  `materie` varchar(4095) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`id`, `nume`, `prenume`, `clasa`, `materie`) VALUES
(1, 'Popescu', 'Ion', 'a 10-a B, a 11-a A, a 9-a A    ', 'matematica'),
(2, 'Petrescu', 'Adrian', 'a 11-a C, a 12-a A, a 12-a C ', 'romana'),
(3, 'Lazarescu', 'Mara', 'a 9-a A, a 9-a B, a 9-a C, a 11-a B, a 10-a C', 'engleza'),
(4, 'Tudose', 'Cip', 'a 12-a A, a 12-a B, a 9-a C, a 11-a B', 'informatica'),
(5, 'Adochitei', 'Marcel', 'a 10-a C, a 9-a B, a 10-a B, a 11-a A', 'biologie'),
(6, 'Constantin', 'Maria', 'a 11-a A, a 10-a A, a 12-a B', 'matematica');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elevi`
--
ALTER TABLE `elevi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `elevi`
--
ALTER TABLE `elevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profesori`
--
ALTER TABLE `profesori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
