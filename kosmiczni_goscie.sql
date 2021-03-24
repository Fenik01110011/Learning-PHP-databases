-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2020, 23:30
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kosmiczni_goscie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `planety`
--

CREATE TABLE `planety` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `srednica` int(11) NOT NULL,
  `populacja` bigint(20) NOT NULL,
  `glowne_rasy` text COLLATE utf8_polish_ci NOT NULL,
  `dodatkowe_informacje` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `planety`
--

INSERT INTO `planety` (`id`, `nazwa`, `srednica`, `populacja`, `glowne_rasy`, `dodatkowe_informacje`) VALUES
(1, 'Ziemia', 12750, 7600000000, 'Człowiek', 'Mają już internet!'),
(2, 'Mars', 6800, 1000000, 'Marsianie', 'Tajne'),
(3, 'Wenus', 12000, 92000000, 'Sithowie', 'Przygotowania do starcia'),
(4, 'Jowisz', 140000, 241400000, 'Zabrakowie, Muunowie', 'Brak'),
(5, 'Saturn', 116500, 2973000, 'Ewoki', 'Praneta imprez');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przybysze`
--

CREATE TABLE `przybysze` (
  `id` int(11) NOT NULL,
  `rasa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `id_planety_pochodzenia` int(11) NOT NULL,
  `kod_identyfikacyjny` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `plec` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `wiek` int(11) NOT NULL,
  `imie_nazwisko_nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `id_statku` int(11) NOT NULL,
  `cel_pobytu` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `przybysze`
--

INSERT INTO `przybysze` (`id`, `rasa`, `id_planety_pochodzenia`, `kod_identyfikacyjny`, `plec`, `wiek`, `imie_nazwisko_nazwa`, `id_statku`, `cel_pobytu`) VALUES
(1, 'Człowiek', 1, '97062001470', 'mężczyzna', 22, 'Marcin Białecki', 1, 'wprowadzenie zmian na planecie'),
(2, 'Marsianin', 2, 'e63jh29314es', 'mężczyzna', 43, 'Andrzej Kosa', 2, 'wakacje'),
(3, 'Zabrakowie', 4, '2879093778233', 'inna', 32, 'Darth Plagueis', 3, 'zarobkowy'),
(4, 'Ewoki', 5, 'uyIDP44fsd21am', 'kobieta', 20, 'Chirpa', 5, 'znajomościowy'),
(5, 'Sithowie', 3, '294o0047w-91', 'kobieta', 23, 'Miarta Sek', 2, 'kontrwywiad');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statki_kosmiczne`
--

CREATE TABLE `statki_kosmiczne` (
  `id` int(11) NOT NULL,
  `model` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `predkosc_maksymalna` bigint(11) NOT NULL,
  `liczebnosc_zalogi` int(11) NOT NULL,
  `udzwig` int(11) NOT NULL,
  `rok_produkcji` int(11) NOT NULL,
  `id_kapitana_statku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `statki_kosmiczne`
--

INSERT INTO `statki_kosmiczne` (`id`, `model`, `nazwa`, `predkosc_maksymalna`, `liczebnosc_zalogi`, `udzwig`, `rok_produkcji`, `id_kapitana_statku`) VALUES
(1, 'YT-1300', 'Sokół Milenium', 200000, 20, 100000, 1970, 1),
(2, 'U-wing', 'Ultimo', 1090000, 8, 10000, 2000, 2),
(3, 'X-wing', 'Tornado', 29900800, 2, 5000, 2010, 3),
(4, 'TIE Interceptor', 'Zaćmienie', 21000000, 3, 20000, 2018, 5),
(5, 'Naboo N-1', 'Strzała', 1290000000, 1, 10000, 2019, 4);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `planety`
--
ALTER TABLE `planety`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przybysze`
--
ALTER TABLE `przybysze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `statki_kosmiczne`
--
ALTER TABLE `statki_kosmiczne`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `planety`
--
ALTER TABLE `planety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `przybysze`
--
ALTER TABLE `przybysze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `statki_kosmiczne`
--
ALTER TABLE `statki_kosmiczne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
