-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 03:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodex`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresy`
--

CREATE TABLE `adresy` (
  `id` int(11) NOT NULL,
  `Miasto` text DEFAULT NULL,
  `Ulica` text DEFAULT NULL,
  `Nr_Domu_Mieszkania` int(11) DEFAULT NULL,
  `Kod_Pocztowy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dania`
--

CREATE TABLE `dania` (
  `id` int(11) NOT NULL,
  `Nazwa` text DEFAULT NULL,
  `Cena` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dania_w_restauracji_xd`
--

CREATE TABLE `dania_w_restauracji_xd` (
  `id_dwr` int(11) NOT NULL,
  `id_res` int(11) DEFAULT NULL,
  `id_Dania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formy_platnosci`
--

CREATE TABLE `formy_platnosci` (
  `id` int(11) NOT NULL,
  `Karta` int(11) DEFAULT NULL,
  `Paypal` int(11) DEFAULT NULL,
  `W_Naturze` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restauracje`
--

CREATE TABLE `restauracje` (
  `id` int(11) NOT NULL,
  `nazwa_restauracji` text DEFAULT NULL,
  `Miasto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `Imie` text DEFAULT NULL,
  `Nazwisko` text DEFAULT NULL,
  `Nazwa_Uzytkownika` text DEFAULT NULL,
  `email` text NOT NULL,
  `Haslo` text DEFAULT NULL,
  `Id_Zamowienia` int(11) DEFAULT NULL,
  `Adres` int(11) DEFAULT NULL,
  `Formy_Platnosci` int(11) DEFAULT NULL,
  `Administrator` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `Imie`, `Nazwisko`, `Nazwa_Uzytkownika`, `email`, `Haslo`, `Id_Zamowienia`, `Adres`, `Formy_Platnosci`, `Administrator`) VALUES
(11, '', '', 'tomasz', '', '$2y$10$fTVUqg/0ZczzQiCH5AGIQO4vFtH7iddNRq5EqDk33DEr5q64ruES2', NULL, NULL, NULL, 0),
(12, '', '', 'tomasz2', '', '$2y$10$f4rJmEHdVI5.bNiGb0CP2e/j80AdDr7XVapv3dRfyNQbQ./M9/wzm', NULL, NULL, NULL, 0),
(13, '', '', 'jasiu', 'tomaszglogowski@gmail.com', '$2y$10$qYQut/ZYLFiSrGRFVwM7bet5I3Jd5tKQDyL4WVCh.9Ma2qu5TFuK2', NULL, NULL, NULL, 0),
(14, '', '', 'jasiu007', 'tomaszglo@gmail.com', '$2y$10$r8NMUnd2yJWuQi4gIZ.lxuJjIhUaPsPIpqUVR.TpKQJTzbuReabdG', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_dan` int(11) DEFAULT NULL,
  `Cena` float DEFAULT NULL,
  `Adres` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  ADD PRIMARY KEY (`id_dwr`),
  ADD KEY `id_res` (`id_res`),
  ADD KEY `id_Dania` (`id_Dania`);

--
-- Indexes for table `formy_platnosci`
--
ALTER TABLE `formy_platnosci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restauracje`
--
ALTER TABLE `restauracje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_Zamowienia` (`Id_Zamowienia`),
  ADD KEY `Adres` (`Adres`),
  ADD KEY `Formy_Platnosci` (`Formy_Platnosci`);

--
-- Indexes for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dan` (`id_dan`),
  ADD KEY `Adres` (`Adres`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  MODIFY `id_dwr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formy_platnosci`
--
ALTER TABLE `formy_platnosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restauracje`
--
ALTER TABLE `restauracje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_1` FOREIGN KEY (`id_res`) REFERENCES `restauracje` (`id`),
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_2` FOREIGN KEY (`id_Dania`) REFERENCES `dania` (`id`);

--
-- Constraints for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`Id_Zamowienia`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_2` FOREIGN KEY (`Adres`) REFERENCES `adresy` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_3` FOREIGN KEY (`Formy_Platnosci`) REFERENCES `formy_platnosci` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_dan`) REFERENCES `dania_w_restauracji_xd` (`id_dwr`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`Adres`) REFERENCES `adresy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
