-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 01, 2021 at 11:44 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grafik`
--

-- --------------------------------------------------------

--
-- Table structure for table `akceptaction`
--

CREATE TABLE `akceptaction` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `grupaZawodowa` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blokada`
--

CREATE TABLE `blokada` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daneDni`
--

CREATE TABLE `daneDni` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `typeDay` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupyZawodowe`
--

CREATE TABLE `grupyZawodowe` (
  `id` int(11) NOT NULL,
  `Etykieta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupyZawodowe`
--

INSERT INTO `grupyZawodowe` (`id`, `Etykieta`) VALUES
(1, 'Stażysta'),
(2, 'Pomoc Apteczna'),
(3, 'Technik farmaceutyczny'),
(4, 'Magister Farmacji');

-- --------------------------------------------------------

--
-- Table structure for table `logLogowan`
--

CREATE TABLE `logLogowan` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passwordReset`
--

CREATE TABLE `passwordReset` (
  `id` int(11) NOT NULL,
  `kod` text NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `typyDni`
--

CREATE TABLE `typyDni` (
  `id` int(11) NOT NULL,
  `etykieta` text COLLATE utf8mb4_polish_ci NOT NULL,
  `kod` text COLLATE utf8mb4_polish_ci NOT NULL,
  `kolor` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `typyDni`
--

INSERT INTO `typyDni` (`id`, `etykieta`, `kod`, `kolor`) VALUES
(1, 'Rano', 'R', '#ee0000'),
(2, 'Rano 7', 'R 7', '#aa0000'),
(3, 'Popołudnie', 'P', '#00ddff'),
(4, 'Popołudnie 9', 'P 9', '#00ffff'),
(6, 'Opieka nad dzieckiem', 'O', '#ccff00'),
(7, 'Urlop', 'U', '#00ff00'),
(8, 'Urlop Szkoleniowy', 'Us', '#00ffaa'),
(9, 'Sobota 6h', '6', '#ff00ff'),
(10, 'Sobota 9h', '9', '#ff00bb');

-- --------------------------------------------------------

--
-- Table structure for table `uprawnieniaDniDlaGrup`
--

CREATE TABLE `uprawnieniaDniDlaGrup` (
  `id` int(11) NOT NULL,
  `grupa` int(11) NOT NULL,
  `typDnia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uprawnieniaDniDlaGrup`
--

INSERT INTO `uprawnieniaDniDlaGrup` (`id`, `grupa`, `typDnia`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(6, 1, 6),
(7, 1, 7),
(8, 1, 9),
(9, 1, 10),
(10, 2, 1),
(11, 2, 2),
(12, 2, 3),
(13, 2, 4),
(15, 2, 6),
(16, 2, 7),
(17, 2, 9),
(18, 2, 10),
(19, 3, 1),
(20, 3, 2),
(21, 3, 3),
(22, 3, 4),
(24, 3, 6),
(25, 3, 7),
(26, 3, 9),
(27, 3, 10),
(28, 4, 1),
(29, 4, 2),
(30, 4, 3),
(31, 4, 4),
(33, 4, 6),
(34, 4, 7),
(35, 4, 8),
(36, 4, 9),
(37, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `grupaZawodowa` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usersTableRow`
--

CREATE TABLE `usersTableRow` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akceptaction`
--
ALTER TABLE `akceptaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blokada`
--
ALTER TABLE `blokada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daneDni`
--
ALTER TABLE `daneDni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupyZawodowe`
--
ALTER TABLE `grupyZawodowe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logLogowan`
--
ALTER TABLE `logLogowan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwordReset`
--
ALTER TABLE `passwordReset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typyDni`
--
ALTER TABLE `typyDni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uprawnieniaDniDlaGrup`
--
ALTER TABLE `uprawnieniaDniDlaGrup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersTableRow`
--
ALTER TABLE `usersTableRow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akceptaction`
--
ALTER TABLE `akceptaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blokada`
--
ALTER TABLE `blokada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daneDni`
--
ALTER TABLE `daneDni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grupyZawodowe`
--
ALTER TABLE `grupyZawodowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logLogowan`
--
ALTER TABLE `logLogowan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordReset`
--
ALTER TABLE `passwordReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typyDni`
--
ALTER TABLE `typyDni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uprawnieniaDniDlaGrup`
--
ALTER TABLE `uprawnieniaDniDlaGrup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersTableRow`
--
ALTER TABLE `usersTableRow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;