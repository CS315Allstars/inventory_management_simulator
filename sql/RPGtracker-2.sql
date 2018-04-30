-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2018 at 08:56 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RPGtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `userName` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `accID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userName`, `password`, `accID`) VALUES
('macortes', '1234', 1),
('marcoTEST', 'password', 2);

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `charID` int(11) NOT NULL,
  `charName` varchar(10) NOT NULL,
  `partyID` int(10) NOT NULL,
  `accID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`charID`, `charName`, `partyID`, `accID`) VALUES
(1, 'testChar1', 1, 1),
(18, 'dfvdf', 1, 1),
(19, 'fdsdf', 1, 1),
(21, 'marco', 3, 2),
(23, 'marco3', 3, 2),
(24, 'marco', 1, 2),
(25, 'macropolo', 1, 2),
(27, '4/18TEST', 2, 2),
(29, 'marco', 1, 1),
(32, '123', 1, 2),
(33, '111', 1, 1),
(34, 'e', 1, 1),
(35, 'chartest4/', 136, 2),
(36, 'chartest4/', 136, 2),
(37, 'fdsdf', 136, 2);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL,
  `thumbnail` text NOT NULL,
  `itemName` text NOT NULL,
  `itemWeight` int(11) NOT NULL,
  `itemValue` int(11) NOT NULL,
  `itemType` text NOT NULL,
  `charID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES
(1, '', 'Wooden Sword', 3, 1, 'Weapon', 1),
(3, '', 'Steel Sword', 5, 15, 'Weapon', 1),
(6, '', 'AR-Pistol', 8, 600, 'Firearm', 18),
(8, '', 'NAME', 11111, 111111, 'TYPE', 1),
(11, '', '', 0, 0, '', 1),
(12, '', '', 0, 0, '', 1),
(13, '', 'jjjj', 111, 111, 'qqq', 1),
(21, '', '', 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `partyID` int(11) NOT NULL,
  `partyName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`partyID`, `partyName`) VALUES
(1, 'testParty1\r\n'),
(2, 'Party number 1'),
(3, 'Test Party # 2'),
(4, 'More party testing'),
(136, 'test4/24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `ID` (`accID`),
  ADD KEY `accID` (`accID`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`charID`),
  ADD KEY `charID` (`charID`),
  ADD KEY `partyID` (`partyID`),
  ADD KEY `accID` (`accID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `charID` (`charID`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`partyID`),
  ADD KEY `partyID` (`partyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `charID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `partyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `account` (`accID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`partyID`) REFERENCES `party` (`partyID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`charID`) REFERENCES `characters` (`charID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
