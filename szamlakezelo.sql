-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Jan 24. 14:44
-- Kiszolgáló verziója: 10.1.35-MariaDB
-- PHP verzió: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szamlakezelo`
--
CREATE DATABASE IF NOT EXISTS `szamlakezelo` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `szamlakezelo`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fizetesimod`
--

CREATE TABLE `fizetesimod` (
  `fizetesmod` varchar(33) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `fizetesimod`
--

INSERT INTO `fizetesimod` (`fizetesmod`) VALUES
('átutalás');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `partner`
--

CREATE TABLE `partner` (
  `id` int(30) NOT NULL,
  `cegnev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `adoszam` int(20) NOT NULL,
  `kapcsolattarto` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` int(20) NOT NULL,
  `megjegyzes` varchar(40) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `partner`
--

INSERT INTO `partner` (`id`, `cegnev`, `cim`, `adoszam`, `kapcsolattarto`, `telefonszam`, `megjegyzes`) VALUES
(1, 'Axial kft.', 'Budapest Tordai utca 14', 1213141515, 'Tóth István', 305676215, 'Hivjon elotte'),
(2, 'Feher es tarsa kft.', 'Budapest Rino utca 14', 1213141515, 'Galamb József', 305676215, 'Hivjon elotte'),
(3, 'Galvan kft.', 'Brüsszeli körút 18.', 121231, 'Zsifrai Ádám', 309445628, 'Kapucsengő 18'),
(4, 'Harvest kft.', 'Szeged Párizsi körút 18.', 121231, 'Gere János', 309445628, 'csörgessen meg'),
(5, 'NLG Zrt.', 'Pécs Mező utca 11.', 121231, 'Kovács József', 309445628, 'hétvégén foglalt'),
(6, 'Gere kft.', 'Budapest Illés út 43.', 121231, 'Tóth József', 309445628, 'csak délelőtt'),
(9, 'Azori kft.', 'Budapest Takács utca 4.', 121231, 'Tóth József', 309445628, ''),
(12, 'Mácsai kft.', 'Debrecen Vágó utca 5..', 3235153, 'Fehér Péter', 304585695, '8-10-ig'),
(38, 'Greensoft kft.', 'Szeged Rigó utca 12', 1254564, 'Beke József', 702512025, 'feb 15-ig szabadságon');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szamla`
--

CREATE TABLE `szamla` (
  `szamlasorszam` int(20) NOT NULL,
  `kiallitasi_datum` date NOT NULL,
  `fizetesi_hatarido` date NOT NULL,
  `fizetesi_mod` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `netto_osszeg` int(30) NOT NULL,
  `brutto_osszeg` int(30) NOT NULL,
  `felrogzitesi_datum` date NOT NULL,
  `fizetve` date DEFAULT NULL,
  `fizetett_osszeg` int(30) DEFAULT NULL,
  `szamlatulajdonos` int(50) DEFAULT NULL,
  `szamlaszam` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szamla`
--

INSERT INTO `szamla` (`szamlasorszam`, `kiallitasi_datum`, `fizetesi_hatarido`, `fizetesi_mod`, `netto_osszeg`, `brutto_osszeg`, `felrogzitesi_datum`, `fizetve`, `fizetett_osszeg`, `szamlatulajdonos`, `szamlaszam`) VALUES
(1, '2019-11-06', '2019-12-26', 'átutalás', 100000, 127000, '2019-12-01', '2019-12-04', 127000, 1, ''),
(2, '2019-11-19', '2020-01-22', 'átutalás', 11000, 132000, '2019-12-03', NULL, NULL, 6, ''),
(3, '2019-11-19', '2020-01-16', 'átutalás', 10000, 12700, '2019-12-03', '2019-12-06', 11000, 4, ''),
(17, '2019-12-13', '2019-12-04', 'átutalás', 10000, 12700, '2019-12-13', '2019-12-08', 17000, 2, ''),
(23, '2019-12-11', '2019-12-12', 'átutalás', 5000, 5125, '2019-12-12', '2019-12-05', NULL, NULL, ''),
(25, '2019-12-05', '2019-12-13', 'átutalás', 2500, 3175, '2019-12-05', '2019-12-26', 2500, 9, ''),
(27, '2019-12-07', '2019-12-27', 'átutalás', 1000, 1270, '2019-12-07', '2019-12-20', 1250, NULL, ''),
(28, '2019-12-07', '2019-12-07', 'átutalás', 2000, 2540, '2019-12-07', '2019-12-20', 2540, 4, ''),
(36, '2020-01-01', '2020-01-10', 'átutalás', 20000, 25400, '2020-01-23', NULL, NULL, 5, '21FDS22S'),
(39, '2020-01-02', '2020-01-30', 'átutalás', 123500, 156845, '2020-01-23', NULL, NULL, 9, '25FS23546'),
(40, '2020-01-02', '2020-01-30', 'átutalás', 123500, 156845, '2020-01-23', NULL, NULL, 12, '25FS23546'),
(48, '2020-01-03', '2020-01-31', 'átutalás', 50000, 63500, '2020-01-24', NULL, NULL, 38, '2GH125D2'),
(49, '2020-01-03', '2020-01-31', 'átutalás', 40000, 50800, '2020-01-24', NULL, NULL, 38, '2GH125D2');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `felhasznalonev`, `jelszo`) VALUES
(1, 'admin', 'admin');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `fizetesimod`
--
ALTER TABLE `fizetesimod`
  ADD PRIMARY KEY (`fizetesmod`);

--
-- A tábla indexei `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cegnev` (`cegnev`);

--
-- A tábla indexei `szamla`
--
ALTER TABLE `szamla`
  ADD PRIMARY KEY (`szamlasorszam`),
  ADD KEY `fizetesi_mod` (`fizetesi_mod`),
  ADD KEY `szamlatulajdonos` (`szamlatulajdonos`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT a táblához `szamla`
--
ALTER TABLE `szamla`
  MODIFY `szamlasorszam` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `szamla`
--
ALTER TABLE `szamla`
  ADD CONSTRAINT `szamla_ibfk_2` FOREIGN KEY (`fizetesi_mod`) REFERENCES `fizetesimod` (`fizetesmod`),
  ADD CONSTRAINT `szamla_ibfk_3` FOREIGN KEY (`szamlatulajdonos`) REFERENCES `partner` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
