-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Cze 2023, 15:29
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `foodex`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `id` int(11) NOT NULL,
  `Miasto` text DEFAULT NULL,
  `Ulica` text DEFAULT NULL,
  `Nr_Domu_Mieszkania` int(11) DEFAULT NULL,
  `Kod_Pocztowy` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `adresy`
--

INSERT INTO `adresy` (`id`, `Miasto`, `Ulica`, `Nr_Domu_Mieszkania`, `Kod_Pocztowy`, `id_user`) VALUES
(46, 'tak', 'tak', 42, 44, 14),
(47, 'Gliwce-', 'tomasz', 3, 44, 14),
(48, 'Gliwice', 'Tak', 42, 44, 14),
(49, 'tak', 'tak', 42, 42, 14),
(50, 'jas', 'jasiowa', 1, 0, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy_uzytkownicy`
--

CREATE TABLE `adresy_uzytkownicy` (
  `id` int(11) NOT NULL,
  `id_adresu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `adresy_uzytkownicy`
--

INSERT INTO `adresy_uzytkownicy` (`id`, `id_adresu`, `id_user`) VALUES
(1, 46, 14),
(2, 47, 14),
(3, 48, 14),
(4, 49, 14),
(5, 50, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania`
--

CREATE TABLE `dania` (
  `id` int(11) NOT NULL,
  `Nazwa` text DEFAULT NULL,
  `Cena` float DEFAULT NULL,
  `w_kaloryczna` int(11) NOT NULL,
  `alergeny` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dania`
--

INSERT INTO `dania` (`id`, `Nazwa`, `Cena`, `w_kaloryczna`, `alergeny`, `src`) VALUES
(1, 'Spaghetti Bolognese', 12.99, 800, 'Gluten, Jaja', './img/pasta.jpg'),
(2, 'Grilled Salmon', 15.5, 600, 'Ryby', './img/salamon.jpg'),
(3, 'Chicken Tikka Masala', 10.99, 700, 'Mleko', './img/chicken.jpg'),
(4, 'Margherita Pizza', 9.75, 550, 'Gluten, Laktoza', './img/pizzaser.jpg'),
(5, 'Caesar Salad', 8.99, 400, 'Jaja, Laktoza', './img/cezar.jpg'),
(6, 'Beef Stir-Fry', 13.25, 750, 'Soja', './img/beef.jpg'),
(7, 'Mushroom Risotto', 11.5, 600, 'Gluten', './img/ryz.jpg'),
(8, 'Lemon Herb Roast Chicken', 14.99, 850, 'Brak', './img/kurczak.jpg'),
(9, 'Vegan Buddha Bowl', 12.5, 500, 'Orzechy', './img/salatka.jpg'),
(10, 'Shrimp Pad Thai', 13.99, 650, 'Orzechy, Kraby', './img/padthai.jpg'),
(11, 'Spinach and Chicken Breast', 11.75, 600, 'Mleko', './img/szpinak.jpg'),
(12, 'Vegetable Curry', 9.5, 550, 'Brak', './img/curry.jpg'),
(13, 'BBQ Ribs', 16.99, 900, 'Soja', './img/bbq.jpg'),
(14, 'Eggplant Parmesan', 10.5, 500, 'Gluten, Jaja', './img/eggplant.jpg'),
(15, 'Tiramisu', 7.99, 450, 'Jaja, Kawa', './img/tiramisu.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania_w_restauracji_xd`
--

CREATE TABLE `dania_w_restauracji_xd` (
  `id_dwr` int(11) NOT NULL,
  `id_res` int(11) DEFAULT NULL,
  `id_Dania` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `formy_platnosci`
--

CREATE TABLE `formy_platnosci` (
  `id` int(11) NOT NULL,
  `Karta` int(11) DEFAULT NULL,
  `Paypal` int(11) DEFAULT NULL,
  `W_Naturze` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restauracje`
--

CREATE TABLE `restauracje` (
  `id` int(11) NOT NULL,
  `nazwa_restauracji` text DEFAULT NULL,
  `Miasto` text DEFAULT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `restauracje`
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
-- Struktura tabeli dla tabeli `uzytkownicy`
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
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `Imie`, `Nazwisko`, `Nazwa_Uzytkownika`, `email`, `Haslo`, `Id_Zamowienia`, `Adres`, `Formy_Platnosci`, `Administrator`) VALUES
(11, '', '', 'tomasz', '', '$2y$10$fTVUqg/0ZczzQiCH5AGIQO4vFtH7iddNRq5EqDk33DEr5q64ruES2', NULL, NULL, NULL, 0),
(12, '', '', 'tomasz2', '', '$2y$10$f4rJmEHdVI5.bNiGb0CP2e/j80AdDr7XVapv3dRfyNQbQ./M9/wzm', NULL, NULL, NULL, 0),
(13, '', '', 'jasiu', 'tomaszglogowski@gmail.com', '$2y$10$qYQut/ZYLFiSrGRFVwM7bet5I3Jd5tKQDyL4WVCh.9Ma2qu5TFuK2', NULL, NULL, NULL, 0),
(14, 'Tomasza', 'test', 'jasiu007', 'tomaszglo@gmail.com', '$2y$10$mJhDDLo7Ku3yAEvw3jAkQOeC.zzLS/3RH0Sfm7sbkwz.WMmBou0Y2', NULL, NULL, NULL, 0),
(15, '', '', 'ToZiomek', 'tomaszglock@gmail.com', '$2y$10$dxoOhCkHppSQSSipXn0yhOs8Ejk30Ziup.eKsvRoa7prrbIjT2lhK', NULL, NULL, NULL, 0),
(16, '', '', 'kubus', 'kuba@k.pl', '$2y$10$qh0B1n5AktQOKG9NdkGxBO0YPJLKghxkha.9JpQo0w2vHk8BTk.pm', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_dan`, `Cena`, `Adres`, `id_adresu`, `ilosc_dan`, `id_restauracji`, `id_user`, `status`) VALUES
(18, NULL, 12.99, NULL, 3, 1, 0, 14, 'nowe'),
(19, NULL, 15.5, NULL, 0, 1, 0, 14, 'nowe'),
(20, NULL, 15.5, NULL, 5, 1, 0, 16, 'nowe');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_adresu` (`id`),
  ADD KEY `fk_adresy_uzytkownicy_adresy` (`id_adresu`),
  ADD KEY `fk_adresy_uzytkownicy_uzytkownicy` (`id_user`);

--
-- Indeksy dla tabeli `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  ADD PRIMARY KEY (`id_dwr`),
  ADD KEY `id_res` (`id_res`),
  ADD KEY `id_Dania` (`id_Dania`);

--
-- Indeksy dla tabeli `formy_platnosci`
--
ALTER TABLE `formy_platnosci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- Indeksy dla tabeli `restauracje`
--
ALTER TABLE `restauracje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_Zamowienia` (`Id_Zamowienia`),
  ADD KEY `Formy_Platnosci` (`Formy_Platnosci`),
  ADD KEY `uzytkownicy_ibfk_2` (`Adres`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adresy`
--
ALTER TABLE `adresy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT dla tabeli `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  MODIFY `id_dwr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `formy_platnosci`
--
ALTER TABLE `formy_platnosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `restauracje`
--
ALTER TABLE `restauracje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adresy_uzytkownicy`
--
ALTER TABLE `adresy_uzytkownicy`
  ADD CONSTRAINT `fk_adresy_uzytkownicy_adresy` FOREIGN KEY (`id_adresu`) REFERENCES `adresy` (`id`),
  ADD CONSTRAINT `fk_adresy_uzytkownicy_uzytkownicy` FOREIGN KEY (`id_user`) REFERENCES `uzytkownicy` (`id`);

--
-- Ograniczenia dla tabeli `dania_w_restauracji_xd`
--
ALTER TABLE `dania_w_restauracji_xd`
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_1` FOREIGN KEY (`id_res`) REFERENCES `restauracje` (`id`),
  ADD CONSTRAINT `dania_w_restauracji_xd_ibfk_2` FOREIGN KEY (`id_Dania`) REFERENCES `dania` (`id`);

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `koszyk_ibfk_2` FOREIGN KEY (`produkt_id`) REFERENCES `dania` (`id`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`Id_Zamowienia`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_2` FOREIGN KEY (`Adres`) REFERENCES `adresy` (`id`),
  ADD CONSTRAINT `uzytkownicy_ibfk_3` FOREIGN KEY (`Formy_Platnosci`) REFERENCES `formy_platnosci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
