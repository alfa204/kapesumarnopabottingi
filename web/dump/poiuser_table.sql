-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2011 at 11:23 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
