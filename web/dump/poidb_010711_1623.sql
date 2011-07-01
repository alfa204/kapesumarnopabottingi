-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2011 at 05:23 PM
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
-- Table structure for table `action_table`
--

CREATE TABLE IF NOT EXISTS `action_table` (
  `poiID` varchar(255) NOT NULL,
  `label` varchar(30) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `autoTriggerRange` int(10) DEFAULT NULL,
  `autoTriggerOnly` tinyint(1) DEFAULT NULL,
  `ID` int(10) NOT NULL,
  `contentType` varchar(255) DEFAULT 'application/vnd.layar.internal',
  `method` enum('GET','POST') DEFAULT 'GET',
  `activityType` int(2) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `closeBiw` tinyint(1) DEFAULT '0',
  `showActivity` tinyint(1) DEFAULT '1',
  `activityMessage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action_table`
--

INSERT INTO `action_table` (`poiID`, `label`, `uri`, `autoTriggerRange`, `autoTriggerOnly`, `ID`, `contentType`, `method`, `activityType`, `params`, `closeBiw`, `showActivity`, `activityMessage`) VALUES
('3', 'Call', '+6285624545876', NULL, NULL, 1, 'application/vnd.layar.internal', 'GET', 4, NULL, 0, 1, NULL),
('3', 'Show Details', 'http://testinglayer.sx33.net/Layar/showdetails.php', NULL, NULL, 2, 'text/html', 'GET', 1, NULL, 1, 1, 'Loading POI''s details');

-- --------------------------------------------------------

--
-- Table structure for table `poilayar_table`
--

CREATE TABLE IF NOT EXISTS `poilayar_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tagline` varchar(150) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `lat` decimal(20,10) NOT NULL,
  `lon` decimal(20,10) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `baseURL` varchar(255) NOT NULL,
  `imageFull` varchar(255) NOT NULL,
  `imageReduced` varchar(255) DEFAULT NULL,
  `imageIcon` varchar(255) DEFAULT NULL,
  `icon_wiki` varchar(255) DEFAULT NULL,
  `size` float(15,5) NOT NULL,
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
  `kategori` enum('1','2') NOT NULL DEFAULT '1',
  `deskripsi` varchar(300) DEFAULT NULL,
  `rel` tinyint(1) DEFAULT '0',
  `angle` decimal(5,2) DEFAULT '0.00',
  `scale` decimal(12,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `poilayar_table`
--

INSERT INTO `poilayar_table` (`id`, `tagline`, `title`, `lat`, `lon`, `imageURL`, `baseURL`, `imageFull`, `imageReduced`, `imageIcon`, `icon_wiki`, `size`, `line4`, `line3`, `line2`, `type`, `dimension`, `alt`, `relativeAlt`, `distance`, `inFocus`, `doNotIndex`, `showSmallBiw`, `showBiwOnClick`, `kategori`, `deskripsi`, `rel`, `angle`, `scale`) VALUES
(1, 'The Location of the Layar Office', 'The Layar Office', '52.3741180000', '4.9342500000', 'Layar_banner_icon.png', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', '1019DW Amsterdam', 'Rietlandpark 301', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(2, 'Lokasi Sumarno Pabottingi', 'Kantor SP', '-6.1923830000', '106.8376840000', 'SP.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Cikini 5 No 12', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(3, 'Kosan Akbar DAnang', 'Kos Akbar Danang', '-6.1874390000', '106.8367450000', 'Layar_banner_icon.png', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', '1019DW Amsterdam', 'Rietlandpark 301', 1, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2', 'Kosannya panas dan kipas anginnya sama sekali tidak membantu.', 0, '0.00', '1.00'),
(4, 'Monumen Nasional Jakarta', 'Monas', '-6.1751760000', '106.8271910000', 'Monas.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Medan Merdeka', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(5, 'Stasiun Gambir ', 'Stasiun Gambir', '-6.1765630000', '106.8308170000', 'GAMBIR.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Medan Merdeka Timur', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(6, 'Hotel Green Alia Cikini', 'Hotel Green Alia Cikini', '-6.1924360000', '106.8381240000', 'GRENALIACIKINI.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Cikini Raya No.46', 2, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2', NULL, 0, '0.00', '1.00'),
(7, 'Hotel Sofyan Cikini', 'Hotel Sofyan Cikini', '-6.1920310000', '106.8391220000', 'SOFYANCIKINI.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'alan Cikini Raya No. 79 ', 2, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '2', NULL, 0, '0.00', '1.00'),
(8, 'Taman Ismail Marzuki', 'Taman Ismail Marzuki', '-6.1899830000', '106.8391330000', 'TIM.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Cikini Raya 73', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(9, 'Taman Menteng (update lagi)', 'Taman Menteng', '-6.1962760000', '106.8296000000', 'TAMANMENTENG.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl, Raya HOS Cokroaminoto', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00'),
(10, 'Museum Joeang 45', 'Museum Joeang 45', '-6.1861220000', '106.8365420000', 'MUSEUMJOEANG.jpg', '', '', NULL, NULL, NULL, 0.00000, 'distance:%distance%', 'Jakarta Pusat', 'Jl. Menteng Raya', 0, 1, NULL, NULL, '0.0000000000', 0, 0, 1, 1, '1', NULL, 0, '0.00', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `poiuser_table`
--

CREATE TABLE IF NOT EXISTS `poiuser_table` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `statusAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `poiuser_table`
--

INSERT INTO `poiuser_table` (`userid`, `name`, `username`, `password`, `email`, `statusAdmin`) VALUES
(1, 'Akbar Gumbira', 'bigHappy', 'tes', 'gum@gum.com', 0),
(2, 'admin', 'admin', 'admin', 'admin@admin.com', 1),
(3, 'Danang Tri', 'danang', 'danang', 'danang@danan.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poi_table`
--

CREATE TABLE IF NOT EXISTS `poi_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `lat` decimal(20,10) NOT NULL,
  `lon` decimal(20,10) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_reduced` varchar(255) DEFAULT NULL,
  `image_icon` varchar(255) DEFAULT NULL,
  `image_wiki` varchar(255) NOT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `kategori` enum('1','2') NOT NULL DEFAULT '1',
  `status` enum('1','2','3') NOT NULL DEFAULT '3',
  `message` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `poi_table`
--

INSERT INTO `poi_table` (`id`, `userid`, `title`, `lat`, `lon`, `imageURL`, `address`, `phone`, `email`, `image_full`, `image_reduced`, `image_icon`, `image_wiki`, `deskripsi`, `kategori`, `status`, `message`) VALUES
(1, 3, 'Meja Saya', '-6.1923810000', '106.8376750000', 'Layar_banner_icon.png', 'Jl Cikini Raya 5 No. 12, Jakarta Pusat', '+62887881781', 'the.end.4ever@gmail.com', 'Layar_banner_icon.png', NULL, NULL, '', NULL, '1', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tagline_table`
--

CREATE TABLE IF NOT EXISTS `tagline_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poi_id` int(11) NOT NULL,
  `text` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tagline_table`
--

INSERT INTO `tagline_table` (`id`, `poi_id`, `text`, `start_date`, `end_date`, `status`) VALUES
(1, 5, 'lalilulelo', '2011-06-28', '2011-06-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `waktutayang_table`
--

CREATE TABLE IF NOT EXISTS `waktutayang_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poi_id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `waktutayang_table`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
