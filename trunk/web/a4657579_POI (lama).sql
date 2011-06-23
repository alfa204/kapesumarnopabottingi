
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2011 at 03:35 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a4657579_POI`
--

-- --------------------------------------------------------

--
-- Table structure for table `DYNAMICTEXT_Table`
--

CREATE TABLE `DYNAMICTEXT_Table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poi_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `text` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `DYNAMICTEXT_Table`
--


-- --------------------------------------------------------

--
-- Table structure for table `OBJECT_Table`
--

CREATE TABLE `OBJECT_Table` (
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
-- Dumping data for table `OBJECT_Table`
--

INSERT INTO `OBJECT_Table` VALUES(1, '3', 'http://layertesting.vacau.com/object/', 'kosan_full.png', 'kosan_reduced.png', 'kosan_icon.png', 50.00000);

-- --------------------------------------------------------

--
-- Table structure for table `POI_Table`
--

CREATE TABLE `POI_Table` (
  `id` varchar(255) NOT NULL,
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
-- Dumping data for table `POI_Table`
--

INSERT INTO `POI_Table` VALUES('1', 'The Location of the Layar Office', 'The Layar Office', 52.3741180000, 4.9342500000, 'http://custom.layar.nl/Layar_banner_icon.png', '1019DW Amsterdam', 'distance:%distance%', 'Rietlandpark 301', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('2', 'Lokasi Sumarno Pabottingi', 'Kantor SP', -6.1923830000, 106.8376840000, 'http://layertesting.vacau.com/image/SP.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini 5 No 12', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('3', 'Kosan Akbar DAnang', 'Kos Akbar Danang', -6.1874390000, 106.8367450000, 'http://custom.layar.nl/Layar_banner_icon.png', '1019DW Amsterdam', 'distance:%distance%', 'Rietlandpark 301', 1, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '2');
INSERT INTO `POI_Table` VALUES('4', 'Monumen Nasional Jakarta', 'Monas', -6.1751760000, 106.8271910000, 'http://layertesting.vacau.com/image/Monas.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Medan Merdeka', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('5', 'Stasiun Gambir ', 'Stasiun Gambir', -6.1765630000, 106.8308170000, 'http://layertesting.vacau.com/image/GAMBIR.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Medan Merdeka Timur', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('6', 'Hotel Green Alia Cikini', 'Hotel Green Alia Cikini', -6.1924360000, 106.8381240000, 'http://layertesting.vacau.com/image/GRENALIACIKINI.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini Raya No.46', 2, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '2');
INSERT INTO `POI_Table` VALUES('7', 'Hotel Sofyan Cikini', 'Hotel Sofyan Cikini', -6.1920310000, 106.8391220000, 'http://layertesting.vacau.com/image/SOFYANCIKINI.jpg', 'Jakarta Pusat', 'distance:%distance%', 'alan Cikini Raya No. 79 ', 2, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '2');
INSERT INTO `POI_Table` VALUES('8', 'Taman Ismail Marzuki', 'Taman Ismail Marzuki', -6.1899830000, 106.8391330000, 'http://layertesting.vacau.com/image/TIM.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Cikini Raya 73', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('9', 'Taman Menteng (update lagi)', 'Taman Menteng', -6.1962760000, 106.8296000000, 'http://layertesting.vacau.com/image/TAMANMENTENG.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl, Raya HOS Cokroaminoto', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');
INSERT INTO `POI_Table` VALUES('10', 'Museum Joeang 45', 'Museum Joeang 45', -6.1861220000, 106.8365420000, 'http://layertesting.vacau.com/image/MUSEUMJOEANG.jpg', 'Jakarta Pusat', 'distance:%distance%', 'Jl. Menteng Raya', 0, 1, NULL, NULL, 0.0000000000, 0, 0, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `TRANSFORM_Table`
--

CREATE TABLE `TRANSFORM_Table` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `poiID` varchar(255) NOT NULL,
  `rel` tinyint(1) DEFAULT '0',
  `angle` decimal(5,2) DEFAULT '0.00',
  `scale` decimal(12,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `TRANSFORM_Table`
--

INSERT INTO `TRANSFORM_Table` VALUES(4, '3', 1, 30.00, 2.00);
