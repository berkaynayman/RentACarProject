-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 22 Haz 2021, 19:43:47
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rentacarproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admincars`
--

DROP TABLE IF EXISTS `admincars`;
CREATE TABLE IF NOT EXISTS `admincars` (
  `carid` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `carbrand` text NOT NULL,
  `carmodel` text NOT NULL,
  `carfuel` text NOT NULL,
  `carvites` text NOT NULL,
  `carcolor` text NOT NULL,
  `carplaque` text NOT NULL,
  `carprice` text NOT NULL,
  `carcase` int(1) NOT NULL DEFAULT '0',
  `carimage` text NOT NULL,
  PRIMARY KEY (`carid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admincars`
--

INSERT INTO `admincars` (`carid`, `adminid`, `carbrand`, `carmodel`, `carfuel`, `carvites`, `carcolor`, `carplaque`, `carprice`, `carcase`, `carimage`) VALUES
(16, 3, 'FIAT', 'Linea', 'Benzin', 'Otomatik', 'Turuncu', '06 BRKY 55', '220', 1, '3BerkayZNaymanaraba.png'),
(15, 2, 'FIAT', '500 Ailesi', 'Benzin', 'Manuel', 'Gri', '06 dd 99', '1220', 0, '2ErkinZCanlyaraba_2.png'),
(11, 2, 'Peugeot', '307', 'Benzin', 'Manuel', 'Yeşil', '10 EC 01', '230', 1, '2ErkinZCanlyaraba.png'),
(12, 2, 'Hyundai', 'A2', 'Benzin', 'Manuel', 'Gri', '10 EC 02', '300', 0, '2ErkinZCanlyaraba_1.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `adminnamesurname` text NOT NULL,
  `admintelephone` text NOT NULL,
  `adminemail` text NOT NULL,
  `adminpassword` text NOT NULL,
  `adminemailcheck` text NOT NULL,
  `adminactivation` text NOT NULL,
  `admincity` varchar(13) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`adminid`, `adminnamesurname`, `admintelephone`, `adminemail`, `adminpassword`, `adminemailcheck`, `adminactivation`, `admincity`) VALUES
(1, 'Hakan Çelik', '0555 1111 22 33', 'hakancelik@gmail.com', 'hakancelik', '1', '174-375', 'Ankara'),
(2, 'Erkin Canlı', '999 665 78 55', 'erkincanli@deneme.com', 'erkincanli', '1', '180-336', 'Kars'),
(3, 'Berkay Nayman', '0555 1234 5678', 'berkaynayman4@gmail.com', 'berkay', '1', '143-381', 'Kars');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customerid` int(11) NOT NULL AUTO_INCREMENT,
  `customernamesurname` text NOT NULL,
  `customertelephone` text NOT NULL,
  `customermail` text NOT NULL,
  `customerpassword` text NOT NULL,
  `customeremailcheck` text NOT NULL,
  `customeractivation` text NOT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`customerid`, `customernamesurname`, `customertelephone`, `customermail`, `customerpassword`, `customeremailcheck`, `customeractivation`) VALUES
(1, 'Berkayy', '545645645', 'berkaynayman4@gmail.com', 'berkay', '1', '112-399');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
