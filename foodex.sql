-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 11:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `Kod_Pocztowy` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresy`
--

INSERT INTO `adresy` (`id`, `Miasto`, `Ulica`, `Nr_Domu_Mieszkania`, `Kod_Pocztowy`, `id_user`) VALUES
(46, 'tak', 'tak', 42, 44, 14),
(47, 'Gliwce-', 'tomasz', 3, 44, 14),
(48, 'Gliwice', 'Tak', 42, 44, 14),
(49, 'tak', 'tak', 42, 42, 14);

-- --------------------------------------------------------

--
-- Table structure for table `adresy_uzytkownicy`
--

CREATE TABLE `adresy_uzytkownicy` (
  `id` int(11) NOT NULL,
  `id_adresu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adresy_uzytkownicy`
--

INSERT INTO `adresy_uzytkownicy` (`id`, `id_adresu`, `id_user`) VALUES
(1, 46, 14),
(2, 47, 14),
(3, 48, 14),
(4, 49, 14);

-- --------------------------------------------------------

--
-- Table structure for table `dania`
--

CREATE TABLE `dania` (
  `id` int(11) NOT NULL,
  `Nazwa` text DEFAULT NULL,
  `Cena` float DEFAULT NULL,
  `w_kaloryczna` int(11) NOT NULL,
  `alergeny` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dania`
--

INSERT INTO `dania` (`id`, `Nazwa`, `Cena`, `w_kaloryczna`, `alergeny`) VALUES
(1, 'Spaghetti Bolognese', 12.99, 800, 'Gluten, Jaja'),
(2, 'Grilled Salmon', 15.5, 600, 'Ryby'),
(3, 'Chicken Tikka Masala', 10.99, 700, 'Mleko'),
(4, 'Margherita Pizza', 9.75, 550, 'Gluten, Laktoza'),
(5, 'Caesar Salad', 8.99, 400, 'Jaja, Laktoza'),
(6, 'Beef Stir-Fry', 13.25, 750, 'Soja'),
(7, 'Mushroom Risotto', 11.5, 600, 'Gluten'),
(8, 'Lemon Herb Roast Chicken', 14.99, 850, 'Brak'),
(9, 'Vegan Buddha Bowl', 12.5, 500, 'Orzechy'),
(10, 'Shrimp Pad Thai', 13.99, 650, 'Orzechy, Kraby'),
(11, 'Spinach and Feta Stuffed Chicken Breast', 11.75, 600, 'Mleko'),
(12, 'Vegetable Curry', 9.5, 550, 'Brak'),
(13, 'BBQ Ribs', 16.99, 900, 'Soja'),
(14, 'Eggplant Parmesan', 10.5, 500, 'Gluten, Jaja'),
(15, 'Tiramisu', 7.99, 450, 'Jaja, Kawa');

-- --------------------------------------------------------

--
-- Table structure for table `dania_w_restauracji_xd`
--

CREATE TABLE `dania_w_restauracji_xd` (
  `id_dwr` int(11) NOT NULL,
  `id_res` int(11) DEFAULT NULL,
  `id_Dania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formy_platnosci`
--

CREATE TABLE `formy_platnosci` (
  `id` int(11) NOT NULL,
  `Karta` int(11) DEFAULT NULL,
  `Paypal` int(11) DEFAULT NULL,
  `W_Naturze` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koszyk`
--

CREATE TABLE `koszyk` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restauracje`
--

CREATE TABLE `restauracje` (
  `id` int(11) NOT NULL,
  `nazwa_restauracji` text DEFAULT NULL,
  `Miasto` text DEFAULT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restauracje`
--

INSERT INTO `restauracje` (`id`, `nazwa_restauracji`, `Miasto`, `lat`, `lng`) VALUES
(1, 'Kulinarny Krąg', 'Warszawa', 52.2297, 21.0122),
(2, 'Smakowita Kraina', 'Kraków', 50.0647, 19.945),
(3, 'Morskie Delikatesy', 'Gdańsk', 54.352, 18.6466),
(4, 'Wrocławskie Kąski', 'Wrocław', 51.1079, 17.0385),
(5, 'Poznańska Trucizna', 'Poznań', 52.4064, 16.9252),
(6, 'Smakoszów Szczyt', 'Zakopane', 49.2993, 19.9496),
(7, 'Smaki Wiecznego Miasto', 'Lublin', 51.2465, 22.5684),
(8, 'Toruńska Wytwornia Smaków', 'Toruń', 53.0138, 18.5981),
(9, 'Kulinarna Przystań', 'Szczecin', 53.4289, 14.553),
(10, 'Restauracja Białostocka', 'Białystok', 53.1325, 23.1688);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `Imie`, `Nazwisko`, `Nazwa_Uzytkownika`, `email`, `Haslo`, `Id_Zamowienia`, `Adres`, `Formy_Platnosci`, `Administrator`) VALUES
(11, '', '', 'tomasz', '', '$2y$10$fTVUqg/0ZczzQiCH5AGIQO4vFtH7iddNRq5EqDk33DEr5q64ruES2', NULL, NULL, NULL, 0),
(12, '', '', 'tomasz2', '', '$2y$10$f4rJmEHdVI5.bNiGb0CP2e/j80AdDr7XVapv3dRfyNQbQ./M9/wzm', NULL, NULL, NULL, 0),
(13, '', '', 'jasiu', 'tomaszglogowski@gmail.com', '$2y$10$qYQut/ZYLFiSrGRFVwM7bet5I3Jd5tKQDyL4WVCh.9Ma2qu5TFuK2', NULL, NULL, NULL, 0),
(14, 'Tomasza', 'test', 'jasiu007', 'tomaszglo@gmail.com', '$2y$10$mJhDDLo7Ku3yAEvw3jAkQOeC.zzLS/3RH0Sfm7sbkwz.WMmBou0Y2', NULL, NULL, NULL, 0),
(15, '', '', 'ToZiomek', 'tomaszglock@gmail.com', '$2y$10$dxoOhCkHppSQSSipXn0yhOs8Ejk30Ziup.eKsvRoa7prrbIjT2lhK', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_dan` int(11) DEFAULT NULL,
  `Cena` float DEFAULT NULL,
  `Adres` int(11) DEFAULT NULL,
  `id_adresu` int(11) DEFAULT NULL,
  `ilosc_dan` int(11) NOT NULL,
  `id_restauracji` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_dan`, `Cena`, `Adres`, `id_adresu`, `ilosc_dan`, `id_restauracji`, `id_user`, `status`) VALUES
(18, NULL, 12.99, NULL, 3, 1, 0, 14, 'nowe'),
(19, NULL, 15.5, NULL, 0, 1, 0, 14, 'nowe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_adresu` (`id`),
  ADD KEY `fk_adresy_uzytkownicy_adresy` (`id_adresu`),
  ADD KEY `fk_adresy_uzytkownicy_uzytkownicy` (`id_user`);

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
-- Indexes for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `produkt_id` (`produkt_id`);

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
  ADD KEY `Formy_Platnosci` (`Formy_Platnosci`),
  ADD KEY `uzytkownicy_ibfk_2` (`Adres`);

--
-- Indexes for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `restauracje`
--
ALTER TABLE `restauracje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  ADD CONSTRAINT `fk_adresy_uzytkownicy_adresy` FOREIGN KEY (`id_adresu`) REFERENCES `adresy` (`id`),
  ADD CONSTRAINT `fk_adresy_uzytkownicy_uzytkownicy` FOREIGN KEY (`id_user`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_1` FOREIGN KEY (`id_res`) REFERENCES `restauracje` (`id`),
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_2` FOREIGN KEY (`id_Dania`) REFERENCES `dania` (`id`);

--
-- Constraints for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `koszyk_ibfk_2` FOREIGN KEY (`produkt_id`) REFERENCES `dania` (`id`);

--
-- Constraints for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`Id_Zamowienia`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_2` FOREIGN KEY (`Adres`) REFERENCES `adresy` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_3` FOREIGN KEY (`Formy_Platnosci`) REFERENCES `formy_platnosci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
