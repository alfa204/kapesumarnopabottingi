-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2011 at 11:37 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dynamictext_table`
--

DROP TABLE IF EXISTS `dynamictext_table`;
CREATE TABLE IF NOT EXISTS `dynamictext_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poi_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `text` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `isapproved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dynamictext_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `object_table`
--

DROP TABLE IF EXISTS `object_table`;
CREATE TABLE IF NOT EXISTS `object_table` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `poiID` varchar(255) NOT NULL,
  `baseURL` varchar(255) NOT NULL,
  `full` varchar(255) NOT NULL,
  `reduced` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `size` float(15,5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `object_table`
--

INSERT INTO `object_table` (`ID`, `poiID`, `baseURL`, `full`, `reduced`, `icon`, `size`) VALUES
(1, '3', 'http://layertesting.vacau.com/object/', 'kosan_full.png', 'kosan_reduced.png', 'kosan_icon.png', 50.00000);

-- --------------------------------------------------------

--
-- Table structure for table `poiapproval_table`
--

DROP TABLE IF EXISTS `poiapproval_table`;
CREATE TABLE IF NOT EXISTS `poiapproval_table` (
  `userid` int(11) NOT NULL,
  `attribution` varchar(150) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `lat` decimal(20,10) NOT NULL,
  `lon` decimal(20,10) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tagline` varchar(150) DEFAULT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_reduced` varchar(255) DEFAULT NULL,
  `image_icon` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poiapproval_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `poiuser_table`
--

DROP TABLE IF EXISTS `poiuser_table`;
CREATE TABLE IF NOT EXISTS `poiuser_table` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `statusAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poiuser_table`
--

INSERT INTO `poiuser_table` (`userid`, `name`, `username`, `password`, `email`, `statusAdmin`) VALUES
(1, 'Akbar Gumbira', 'bigHappy', 'tes', 'gum@gum.com', 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `poi_table`
--

DROP TABLE IF EXISTS `poi_table`;
CREATE TABLE IF NOT EXISTS `poi_table` (
  `id` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `attribution` varchar(150) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `lat` decimal(20,10) NOT NULL,
  `lon` decimal(20,10) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `line4` varchar(150) DEFAULT NULL,
  `line3` varchar(150) DEFAULT NULL,
  `line2` varchar(150) DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `dimension` int(1) DEFAULT '1',
  `alt` int(10) DEFAULT NULL,
  `relativeAlt` int(10) DEFAULT NULL,
  `distance` decimal(20,10) NOT NULL,
  `inFocus` tinyint(1) DEFAULT '0',
  `doNotIndex` tinyint(1) DEFAULT '0',
  `showSmallBiw` tinyint(1) DEFAULT '1',
  `showBiwOnClick` tinyint(1) DEFAULT '1',
  `Checkbox` enum('1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poi_table`
--

INSERT INTO `poi_table` (`id`, `userid`, `attribution`, `title`, `lat`, `lon`, `imageURL`, `line4`, `line3`, `line2`, `type`, `dimension`, `alt`, `relativeAlt`, `distance`, `inFocus`, `doNotIndex`, `showSmallBiw`, `showBiwOnClick`, `Checkbox`) VALUES
('1', 0, 'The Location of the Layar Office', 'The Layar Office', '52.3741180000', '4.9342500000', 'http://custom.layar.nl/Layar_banner_icon.png', '1019DW Amsterdam', 'distance:%distance%', 'Rietlandpark 301', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('2', 0, 'Lokasi Sumarno Pabottingi', 'Kantor SP', '-6.1923830000', '106.8376840000', 'http://layertesting.vacau.com/image/SP.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini 5 No 12', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('3', 0, 'Kosan Akbar DAnang', 'Kos Akbar Danang', '-6.1874390000', '106.8367450000', 'http://custom.layar.nl/Layar_banner_icon.png', '1019DW Amsterdam', 'distance:%distance%', 'Rietlandpark 301', 1, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2'),
('4', 0, 'Monumen Nasional Jakarta', 'Monas', '-6.1751760000', '106.8271910000', 'http://layertesting.vacau.com/image/Monas.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Medan Merdeka', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('5', 0, 'Stasiun Gambir ', 'Stasiun Gambir', '-6.1765630000', '106.8308170000', 'http://layertesting.vacau.com/image/GAMBIR.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Medan Merdeka Timur', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('6', 0, 'Hotel Green Alia Cikini', 'Hotel Green Alia Cikini', '-6.1924360000', '106.8381240000', 'http://layertesting.vacau.com/image/GRENALIACIKINI.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini Raya No.46', 2, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2'),
('7', 0, 'Hotel Sofyan Cikini', 'Hotel Sofyan Cikini', '-6.1920310000', '106.8391220000', 'http://layertesting.vacau.com/image/SOFYANCIKINI.jpg', 'Jakarta Pusat', 'distance:%distance%', 'alan Cikini Raya No. 79 ', 2, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2'),
('8', 0, 'Taman Ismail Marzuki', 'Taman Ismail Marzuki', '-6.1899830000', '106.8391330000', 'http://layertesting.vacau.com/image/TIM.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini Raya 73', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('9', 0, 'Taman Menteng (update lagi)', 'Taman Menteng', '-6.1962760000', '106.8296000000', 'http://layertesting.vacau.com/image/TAMANMENTENG.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl, Raya HOS Cokroaminoto', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1'),
('10', 0, 'Museum Joeang 45', 'Museum Joeang 45', '-6.1861220000', '106.8365420000', 'http://layertesting.vacau.com/image/MUSEUMJOEANG.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Menteng Raya', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `transform_table`
--

DROP TABLE IF EXISTS `transform_table`;
CREATE TABLE IF NOT EXISTS `transform_table` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `poiID` varchar(255) NOT NULL,
  `rel` tinyint(1) DEFAULT '0',
  `angle` decimal(5,2) DEFAULT '0.00',
  `scale` decimal(12,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transform_table`
--

INSERT INTO `transform_table` (`ID`, `poiID`, `rel`, `angle`, `scale`) VALUES
(4, '3', 1, '30.00', '2.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
