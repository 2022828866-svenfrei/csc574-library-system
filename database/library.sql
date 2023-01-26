-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 04:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID`, `Name`, `Category`, `PublishDate`, `Author`, `Description`, `ISBNNumber`, `Image`, `PublishPlace`, `Price`) VALUES
(1, 'Book 1', 'Drama', '2022-08-03', 'Sven', 'Desc.', '913939', 'Book 1.jpg', 'Switzerland', '150'),
(4, 'Power Parenting: Motivasi Anak Pintar', 'General', '2023-01-23', 'Tengku Asmadi', 'Setiap ibu bapa', '9789830976099', 'Power Parenting: Motivasi Anak Pintar.jpg', 'Selangor', '35'),
(5, 'Amalan Ibu Mengandung', 'General', '2023-01-03', 'Dato’ Siti Nor Bahyah Mahamood', 'Kehamilan adalah satu keistimewa hanya milik kaum wanita. Hamil bukan satu bebanan tetapi satu harapan, kesabaran dan kebahagiaan bagi seorang ibu. Allah menjanjikan pahala yang berlipat ganda bagi seorang ibu yang hamil. Sahabat Rasulullah saw dalam keadaan sangat miskin dan papa sekalipun, tetap berkeinginan mempunyai anak yang ramai. Buku ini mengandungi amalan dan petua yang bersandarkan daripada al-Quran, hadis dan pendapat ulama termasuk juga daripada pemerhatian orang soleh dan panduan daripada ilmu perubatan, rawatan perbidanan dan pemakanan moden. Semua panduan disertakan gambar warna penuh fotografi, lukisan, carta, jadual dan info grafik untuk menerangan kaedah yang paling tepat supaya mudah difahami dan diamalkan.', '978-967-481-791-6', 'Amalan Ibu Mengandung.jpg', 'Selangor', '25'),
(6, 'test', 'test2', '2023-01-26', 'test5', 'test3', 'test6', 'test.jpg', 'test4', '25'),
(7, 'Mrs Jay', 'General', '2023-01-11', 'Dato’ Siti Nor Bahyah Mahamood', ',,,\"\"\"\"', '9789671754382', 'Mrs Jay.jpg', 'Indonesia', '28');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `ID` int(11) NOT NULL,
  `BookFK` int(11) NOT NULL,
  `UserFK` int(11) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `IsBillSettled` tinyint(1) NOT NULL COMMENT '0 - Unpaid, 1 - Paid; ',
  `Status` varchar(1) NOT NULL COMMENT 'B - borrowed; R - Returned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`ID`, `BookFK`, `UserFK`, `FromDate`, `ToDate`, `IsBillSettled`, `Status`) VALUES
(1, 1, 11, '2022-12-01', '2023-01-01', 0, 'R'),
(6, 6, 16, '2023-01-15', '2023-01-17', 0, 'R'),
(7, 4, 16, '2023-01-26', '2023-01-31', 0, 'B'),
(9, 5, 17, '2023-01-09', '2023-01-24', 0, 'B'),
(10, 4, 17, '2023-01-16', '2023-01-23', 0, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `ID` int(11) NOT NULL,
  `BorrowFK` int(11) NOT NULL,
  `LateDay` int(11) NOT NULL,
  `Penalty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`ID`, `BorrowFK`, `LateDay`, `Penalty`) VALUES
(53, 1, 24, 12),
(54, 6, 8, 4),
(55, 7, 4, 0),
(56, 9, 2, 1),
(57, 10, 3, 1.5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(16, 'frei-sven@bluewin.ch', 'test', 'Nelkenweg', 8360, 'Thurgau', 'Sven Frei', 2022828867, 0),
(17, 'arifazman011@gmail.com', 'aaa', 'Astaka', 41050, 'Selangor', 'Arif Azman', 2021619936, 1);

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
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BorrowFK` (`BorrowFK`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
