-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 29 mrt 2023 om 12:41
-- Serverversie: 5.7.31
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examendag3`
--
CREATE DATABASE IF NOT EXISTS `examendag3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `examendag3`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Baan`
--

DROP TABLE IF EXISTS `Baan`;
CREATE TABLE IF NOT EXISTS `Baan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nummer` int(11) NOT NULL,
  `HeeftHek` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Baan`
--

INSERT INTO `Baan` (`Id`, `Nummer`, `HeeftHek`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Openingstijd`
--

DROP TABLE IF EXISTS `Openingstijd`;
CREATE TABLE IF NOT EXISTS `Openingstijd` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DagNaam` varchar(40) NOT NULL,
  `BeginTijd` time NOT NULL,
  `EindTijd` time NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Openingstijd`
--

INSERT INTO `Openingstijd` (`Id`, `DagNaam`, `BeginTijd`, `EindTijd`) VALUES
(1, 'Maandag', '14:00:00', '22:00:00'),
(2, 'Dinsdag', '14:00:00', '22:00:00'),
(3, 'Woensdag', '14:00:00', '22:00:00'),
(4, 'Donderdag', '14:00:00', '22:00:00'),
(5, 'Vrijdagmiddag', '14:00:00', '18:00:00'),
(6, 'Vrijdagavond', '18:00:00', '24:00:00'),
(7, 'Zaterdagmiddag', '14:00:00', '18:00:00'),
(8, 'Zaterdagavond', '18:00:00', '24:00:00'),
(9, 'Zondagmiddag', '14:00:00', '18:00:00'),
(10, 'Zondagavond', '18:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PakketOptie`
--

DROP TABLE IF EXISTS `PakketOptie`;
CREATE TABLE IF NOT EXISTS `PakketOptie` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(40) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `PakketOptie`
--

INSERT INTO `PakketOptie` (`Id`, `Naam`) VALUES
(1, 'Snackpakketbasis'),
(2, 'Snackpakketluxe'),
(3, 'Kinderpartij'),
(4, 'Vrijgezellenfeest');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Persoon`
--

DROP TABLE IF EXISTS `Persoon`;
CREATE TABLE IF NOT EXISTS `Persoon` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TypePersoonId` int(11) NOT NULL,
  `Voornaam` varchar(51) NOT NULL,
  `Tussenvoegsel` varchar(25) DEFAULT NULL,
  `Achternaam` varchar(55) NOT NULL,
  `Roepnaam` varchar(51) NOT NULL,
  `IsVolwassen` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `TypePersoon` (`TypePersoonId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Persoon`
--

INSERT INTO `Persoon` (`Id`, `TypePersoonId`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Roepnaam`, `IsVolwassen`) VALUES
(1, 1, 'Mazin', NULL, 'Jamil', 'Mazin', 1),
(2, 1, 'Arjan', 'de', 'Ruijter', 'Arjan', 1),
(3, 1, 'Hans', NULL, 'Odijk', 'Hans', 1),
(4, 1, 'Dennis', 'van', 'Wakeren', 'Dennis', 1),
(5, 2, 'Wilco', 'Van de', 'Grift', 'Wilco', 1),
(6, 3, 'Tom', NULL, 'Sanders', 'Tom', 0),
(7, 3, 'Andrew', NULL, 'Sanders', 'Andrew', 0),
(8, 3, 'Julian', NULL, 'Kaldenheuvel', 'Julian', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Reservering`
--

DROP TABLE IF EXISTS `Reservering`;
CREATE TABLE IF NOT EXISTS `Reservering` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PersoonId` int(11) NOT NULL,
  `OpeningstijdId` int(11) NOT NULL,
  `TariefId` int(11) NOT NULL,
  `BaanId` int(11) NOT NULL,
  `PakketOptieId` int(11) DEFAULT NULL,
  `ReseveringStatusId` int(11) NOT NULL,
  `Reseveringsnummer` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `AantalUren` tinyint(4) NOT NULL,
  `BeginTijd` time NOT NULL,
  `EindTijd` time NOT NULL,
  `AantalVolwassen` tinyint(4) NOT NULL,
  `AantalKinderen` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `PersoonId` (`PersoonId`),
  KEY `OpeningstijdId` (`OpeningstijdId`),
  KEY `PakketOptieId` (`PakketOptieId`),
  KEY `ReseveringsStatusId` (`ReseveringStatusId`),
  KEY `BaanId` (`BaanId`),
  KEY `TariefId` (`TariefId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Reservering`
--

INSERT INTO `Reservering` (`Id`, `PersoonId`, `OpeningstijdId`, `TariefId`, `BaanId`, `PakketOptieId`, `ReseveringStatusId`, `Reseveringsnummer`, `Datum`, `AantalUren`, `BeginTijd`, `EindTijd`, `AantalVolwassen`, `AantalKinderen`) VALUES
(1, 1, 2, 1, 8, 1, 1, 2022122001, '2022-12-20', 1, '15:00:00', '16:00:00', 4, 2),
(2, 2, 2, 1, 2, 3, 1, 2022122002, '2022-12-20', 1, '17:00:00', '18:00:00', 4, NULL),
(3, 3, 7, 2, 3, 1, 1, 2022122003, '2022-12-24', 2, '16:00:00', '18:00:00', 4, NULL),
(4, 1, 2, 1, 2, NULL, 1, 2022122004, '2022-12-27', 2, '17:00:00', '19:00:00', 2, NULL),
(5, 4, 3, 1, 4, 4, 1, 2022122005, '2022-12-28', 1, '14:00:00', '15:00:00', 3, NULL),
(6, 5, 10, 3, 5, 4, 1, 2022122006, '2022-12-28', 2, '19:00:00', '21:00:00', 2, NULL),
(7, 1, 1, 1, 4, 1, 1, 2022122007, '2023-01-02', 2, '14:00:00', '16:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ReserveringStatus`
--

DROP TABLE IF EXISTS `ReserveringStatus`;
CREATE TABLE IF NOT EXISTS `ReserveringStatus` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(40) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ReserveringStatus`
--

INSERT INTO `ReserveringStatus` (`Id`, `Naam`) VALUES
(1, 'Bevestigd'),
(2, 'Geannuleerd'),
(3, 'Inbehandeling');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Tarief`
--

DROP TABLE IF EXISTS `Tarief`;
CREATE TABLE IF NOT EXISTS `Tarief` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Eenheid` varchar(15) NOT NULL,
  `Prijs` decimal(4,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Tarief`
--

INSERT INTO `Tarief` (`Id`, `Eenheid`, `Prijs`) VALUES
(1, 'Uur', '24.00'),
(2, 'Uur', '28.00'),
(3, 'Uur', '33.50');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TypePersoon`
--

DROP TABLE IF EXISTS `TypePersoon`;
CREATE TABLE IF NOT EXISTS `TypePersoon` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `TypePersoon`
--

INSERT INTO `TypePersoon` (`Id`, `Naam`) VALUES
(1, 'Klant'),
(2, 'Medewerker'),
(3, 'Gast');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Persoon`
--
ALTER TABLE `Persoon`
  ADD CONSTRAINT `TypePersoon` FOREIGN KEY (`TypePersoonId`) REFERENCES `TypePersoon` (`Id`);

--
-- Beperkingen voor tabel `Reservering`
--
ALTER TABLE `Reservering`
  ADD CONSTRAINT `BaanId` FOREIGN KEY (`BaanId`) REFERENCES `Baan` (`Id`),
  ADD CONSTRAINT `OpeningstijdId` FOREIGN KEY (`OpeningstijdId`) REFERENCES `Openingstijd` (`Id`),
  ADD CONSTRAINT `PakketOptieId` FOREIGN KEY (`PakketOptieId`) REFERENCES `PakketOptie` (`Id`),
  ADD CONSTRAINT `PersoonId` FOREIGN KEY (`PersoonId`) REFERENCES `Persoon` (`Id`),
  ADD CONSTRAINT `ReseveringsStatusId` FOREIGN KEY (`ReseveringStatusId`) REFERENCES `ReserveringStatus` (`Id`),
  ADD CONSTRAINT `TariefId` FOREIGN KEY (`TariefId`) REFERENCES `Tarief` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
