-- phpMyAdmin SQL Dump
-- version 5.1.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2021 at 10:16 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grafikTest`
--

-- --------------------------------------------------------

--
-- Table structure for table `akceptaction`
--

CREATE TABLE `akceptaction` (
  `id` int NOT NULL,
  `user` text NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `grupaZawodowa` int NOT NULL,
  `isAdmin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blokada`
--

CREATE TABLE `blokada` (
  `id` int NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daneDni`
--

CREATE TABLE `daneDni` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `typeDay` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupyZawodowe`
--

CREATE TABLE `grupyZawodowe` (
  `id` int NOT NULL,
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
  `id` int NOT NULL,
  `user` int NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passwordReset`
--

CREATE TABLE `passwordReset` (
  `id` int NOT NULL,
  `kod` text NOT NULL,
  `user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `token` text NOT NULL,
  `grupaZawodowa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typyDni`
--

CREATE TABLE `typyDni` (
  `id` int NOT NULL,
  `etykieta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `kod` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `kolor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL
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
  `id` int NOT NULL,
  `grupa` int NOT NULL,
  `typDnia` int NOT NULL
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
  `id` int NOT NULL,
  `user` text NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `grupaZawodowa` int NOT NULL,
  `isAdmin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usersTableRow`
--

CREATE TABLE `usersTableRow` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `wiersz` int NOT NULL
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
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blokada`
--
ALTER TABLE `blokada`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daneDni`
--
ALTER TABLE `daneDni`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grupyZawodowe`
--
ALTER TABLE `grupyZawodowe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logLogowan`
--
ALTER TABLE `logLogowan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordReset`
--
ALTER TABLE `passwordReset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typyDni`
--
ALTER TABLE `typyDni`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uprawnieniaDniDlaGrup`
--
ALTER TABLE `uprawnieniaDniDlaGrup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersTableRow`
--
ALTER TABLE `usersTableRow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
