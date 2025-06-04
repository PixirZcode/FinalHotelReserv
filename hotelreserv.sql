-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2022 at 04:36 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelreserv`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Books_ID` int(11) NOT NULL,
  `Room_num` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Check_in` date NOT NULL,
  `Check_out` date NOT NULL,
  `Book_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Member_ID` int(11) NOT NULL,
  `Firstname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Lastname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Tel` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Bank` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` int(11) NOT NULL,
  `DatePay` timestamp NOT NULL,
  `Bk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` int(10) NOT NULL,
  `TypeR` varchar(15) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `Price`, `TypeR`, `Status`) VALUES
('0001', 3000, 'เตียงคู่', 0),
('0002', 3400, 'เตียงเดี่ยว', 0),
('0003', 2500, 'เตียงเดี่ยว', 0),
('0004', 3700, 'เตียงเดี่ยว', 0),
('0005', 2800, 'เตียงคู่', 0),
('0006', 2700, 'เตียงเดี่ยว', 0),
('0007', 4200, 'เตียงคู่', 0),
('0008', 4000, 'เตียงคู่', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Books_ID`),
  ADD KEY `FK_id` (`Book_user`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Member_ID`),
  ADD KEY `FK` (`userid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `FK_pay_bid` (`Bk_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Books_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Member_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_id` FOREIGN KEY (`Book_user`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `FK` FOREIGN KEY (`userid`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_pay_bid` FOREIGN KEY (`Bk_id`) REFERENCES `book` (`Books_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
