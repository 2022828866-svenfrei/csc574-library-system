-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 05:11 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `PublishDate` date NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `ISBNNumber` varchar(100) NOT NULL,
  `Image` text NOT NULL,
  `PublishPlace` varchar(100) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID`, `Name`, `Category`, `PublishDate`, `Author`, `Description`, `ISBNNumber`, `Image`, `PublishPlace`, `Price`) VALUES
(1, 'Book 1', 'Drama', '2022-08-03', 'Sven', 'Desc.', '913939', '', 'Switzerland', '100'),
(2, 'Book 2', 'Thriller', '2022-05-03', 'Fredson', 'Desc.', '2133', '', 'Switzerland', '100');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `ID` int(11) NOT NULL,
  `BookFK` int(11) NOT NULL,
  `UserFK` int(11) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `IsBillSettled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`ID`, `BookFK`, `UserFK`, `FromDate`, `ToDate`, `IsBillSettled`) VALUES
(1, 1, 11, '2022-12-01', '2023-01-01', 1),
(2, 2, 11, '2022-09-01', '2022-11-02', 1),
(6, 1, 16, '0000-00-00', '0000-00-00', 0),
(7, 1, 16, '2023-01-26', '2023-01-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `Zip` int(11) NOT NULL,
  `State` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `UitmID` int(11) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Email`, `Password`, `Street`, `Zip`, `State`, `FullName`, `UitmID`, `IsAdmin`) VALUES
(1, '2022828866@my', 'Test123', 'Jalan abc', 400000, 'Selangor', 'Sven Frei', 0, 0),
(2, '2022828866@my.my', 'test', 'Jalan abc', 400000, 'Selangor', 'Sven Frei', 0, 0),
(3, '2022828866@student.uitm.edu.my', 'Test123', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(4, '2022828866@student.uitm.edu.myy', 'Test', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(6, '2022828866@student.uitm.edu.myyy', 'Test', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(8, '2022828866@test.my', 'Test', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(11, 'test@me.my', 'test', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(13, 'test@student.uitm.edu.myy', 'test', 'Jalan abc', 400000, 'Selangor', 'Sven', 0, 0),
(16, 'frei-sven@bluewin.ch', 'test', 'Nelkenweg', 8360, 'Thurgau', 'Sven Frei', 2022828867, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BookFK` (`BookFK`),
  ADD KEY `UserFK` (`UserFK`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`BookFK`) REFERENCES `book` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`UserFK`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
