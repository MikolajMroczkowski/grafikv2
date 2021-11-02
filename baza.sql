-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 02, 2021 at 12:13 AM
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

--
-- Dumping data for table `daneDni`
--

INSERT INTO `daneDni` (`id`, `user`, `typeDay`, `date`) VALUES
(61, 1, 1, '2021-12-03'),
(63, 1, 10, '2021-12-18'),
(64, 1, 10, '2021-12-11'),
(65, 1, 9, '2021-12-04'),
(66, 1, 3, '2021-12-06'),
(67, 1, 4, '2021-12-07'),
(68, 1, 3, '2021-12-08'),
(72, 1, 8, '2021-12-17'),
(74, 1, 9, '2021-12-25'),
(75, 1, 8, '2021-12-16'),
(78, 1, 1, '2021-12-10'),
(79, 1, 7, '2021-12-27'),
(80, 1, 7, '2021-12-28'),
(81, 1, 7, '2021-12-29'),
(82, 1, 3, '2021-12-30'),
(83, 1, 4, '2021-12-31'),
(84, 1, 1, '2021-12-24'),
(85, 1, 2, '2021-12-22'),
(86, 1, 1, '2021-12-23'),
(87, 1, 1, '2021-12-21'),
(89, 1, 3, '2021-12-15'),
(90, 1, 1, '2021-12-14'),
(91, 1, 2, '2021-12-13'),
(92, 1, 6, '2021-12-20'),
(93, 1, 7, '2021-12-01');

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
  `wiersz` int(11) NOT NULL
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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