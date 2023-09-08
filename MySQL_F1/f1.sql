-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2023 at 12:24 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f1`
--

-- --------------------------------------------------------

--
-- Table structure for table `pilote`
--

CREATE TABLE `pilote` (
  `id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Nationalite` varchar(50) NOT NULL,
  `Equipe` varchar(50) NOT NULL,
  `Img` varchar(1500) NOT NULL,
  `Numero` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `pilote`
--

INSERT INTO `pilote` (`id`, `Nom`, `Nationalite`, `Equipe`, `Img`, `Numero`) VALUES
(1, 'Lando Norris', 'Britannique', 'McLaren-Mercedes', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Lando_Norris%2C_British_GP_2022_%2852382611003%29_%28cropped%29.jpg/330px-Lando_Norris%2C_British_GP_2022_%2852382611003%29_%28cropped%29.jpg', 4),
(2, 'Valtteri Bottas', 'Finlandais', 'Alfa Romeo-Ferrari', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Valtteri_Bottas_at_the_2022_Austrian_Grand_Prix.jpg/330px-Valtteri_Bottas_at_the_2022_Austrian_Grand_Prix.jpg', 77),
(3, 'Max Verstappen', 'Néerlandais', 'Red Bull Racing-Honda RBPT', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Max_Verstappen_2017_Malaysia_3_%28cropped%29.jpg/330px-Max_Verstappen_2017_Malaysia_3_%28cropped%29.jpg', 1),
(4, 'Alex Albon', 'Thaïlandais', 'Williams-Racing', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Alex_albon_%2851383514844%29_%28cropped%29.jpg/330px-Alex_albon_%2851383514844%29_%28cropped%29.jpg', 23);

-- --------------------------------------------------------

--
-- Table structure for table `usagers`
--

CREATE TABLE `usagers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `ip` varchar(1024) NOT NULL,
  `machine` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `usagers`
--

INSERT INTO `usagers` (`id`, `username`, `email`, `password`, `ip`, `machine`) VALUES
(1, 'maath3211', 'mathys.l.lessard@gmail.com', '153fa238cec90e5a24b85a79109f91ebe68ca481', '206.167.139.192', 'Inconnu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pilote`
--
ALTER TABLE `pilote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usagers`
--
ALTER TABLE `usagers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pilote`
--
ALTER TABLE `pilote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usagers`
--
ALTER TABLE `usagers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
