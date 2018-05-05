-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2018 at 12:46 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpgtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `userName` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `accID` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`accID`),
  UNIQUE KEY `userName` (`userName`),
  KEY `ID` (`accID`),
  KEY `accID` (`accID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userName`, `password`, `accID`) VALUES
('macortes', '1234', 1),
('marcoTEST', 'password', 2),
('claude', 'claude', 3);

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `charID` int(11) NOT NULL AUTO_INCREMENT,
  `charName` varchar(10) NOT NULL,
  `partyID` int(10) NOT NULL,
  `accID` int(10) NOT NULL,
  PRIMARY KEY (`charID`),
  KEY `charID` (`charID`),
  KEY `partyID` (`partyID`),
  KEY `accID` (`accID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`charID`, `charName`, `partyID`, `accID`) VALUES
(1, 'gimli', 40, 1),
(16, 'legolas', 40, 1),
(17, 'Aragorn', 40, 1),
(18, '2pac', 40, 2),
(19, '2chainz', 40, 2),
(20, '2dodoodoo', 40, 2),
(21, '3iscompany', 40, 3),
(22, '3birds', 40, 3),
(26, 'sheilfdog', 44, 1),
(27, 'hydro', 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` text,
  `itemName` text NOT NULL,
  `itemWeight` int(11) NOT NULL,
  `itemValue` int(11) NOT NULL,
  `itemType` text NOT NULL,
  `charID` int(10) NOT NULL,
  PRIMARY KEY (`itemID`),
  KEY `charID` (`charID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES
(17, '', 'iron ingot', 5, 50, 'Misc', 1),
(18, '', 'sword', 7, 20, 'Weapon', 19),
(19, '', 'Shield', 10, 50, 'Armor', 17),
(20, '', 'Shield', 10, 50, 'Armor', 18),
(21, '', 'Shield', 10, 50, 'Armor', 22),
(22, '', 'Shield', 10, 50, 'Armor', 21),
(23, '', 'Bow', 2, 100, 'Weapon', 16),
(24, '', 'Food', 20, 20, 'Misc', 20),
(25, '', 'Talons', 4, 8, 'Weapon', 22),
(26, '', 'Chain', 20, 10, 'Weapon', 19),
(27, '', 'Chain', 20, 10, 'Weapon', 19),
(28, '', 'Dwarven Plate', 100, 1000, 'Armor', 1),
(29, '', 'Orc Jerkin', 2, 10, 'Armor', 1),
(30, '', 'Troll Hide Boots', 2, 100, 'Armor', 1),
(31, '', 'Grick Eyes', 3, 99, 'Misc', 1),
(32, '', 'Orc Teeth', 1, 5, 'Misc', 1),
(33, '', 'Troll Rubber', 7, 33, 'Misc', 1),
(34, '', 'Dwarven Axe', 2, 200, 'Weapon', 1),
(35, '', 'Crossbow', 10, 75, 'Weapon', 1),
(36, '', 'Pickaxe', 5, 12, 'Weapon', 1),
(37, '', 'Bark', 2, 10, 'Misc', 1),
(41, NULL, 'Healing Potion', 1, 50, 'Consumable', 1),
(42, NULL, 'Knife', 2, 4, 'Weapon', 16),
(43, NULL, 'collar', 2, 9001, 'Armor', 26),
(45, NULL, 'freeze ray', 50, 2000, 'Weapon', 27);

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

DROP TABLE IF EXISTS `party`;
CREATE TABLE IF NOT EXISTS `party` (
  `partyID` int(11) NOT NULL AUTO_INCREMENT,
  `partyName` text NOT NULL,
  PRIMARY KEY (`partyID`),
  KEY `partyID` (`partyID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`partyID`, `partyName`) VALUES
(40, 'Fellowship of the Ring'),
(41, 'newnew'),
(42, 'Lucis Party'),
(43, 'joes party'),
(44, 'Jiff Party'),
(45, 'party'),
(48, 'Noon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`partyID`) REFERENCES `party` (`partyID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`accID`) REFERENCES `account` (`accID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`charID`) REFERENCES `characters` (`charID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
