-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2023 at 05:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is2109_library_reformed`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `name`, `author`, `price`, `year`, `status`) VALUES
(1, 'Hath pana', 'Munidasa Kumarathunga', 600, 1977, 'available'),
(2, 'Madol Doova', 'Martin Wickramasinghe', 2000, 1960, 'available'),
(3, 'Famous Five', 'Enyd Blyton', 1000, 2002, 'available'),
(4, 'Sherlock Holmes stories', 'Conon Doyle', 1500, 1905, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `borrowingID` int(11) NOT NULL,
  `bookID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `borrowing_date` date DEFAULT NULL,
  `returning_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`borrowingID`, `bookID`, `userID`, `borrowing_date`, `returning_date`) VALUES
(1, 1, 3, '2022-11-27', '2022-11-27'),
(2, 1, 4, '2022-11-27', '2022-11-28'),
(3, 3, 6, '2022-11-28', '2022-11-28'),
(4, 2, 6, '2022-11-28', '2022-11-28'),
(5, 4, 6, '2023-01-17', '2023-01-26'),
(7, 4, 3, '2023-01-15', '2023-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `contact_no` varchar(30) DEFAULT NULL,
  `membershipID` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `active_status` varchar(20) DEFAULT NULL,
  `email_OTP` varchar(100) DEFAULT NULL,
  `email_verification` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `first_name`, `last_name`, `email`, `DOB`, `city`, `contact_no`, `membershipID`, `password`, `active_status`, `email_OTP`, `email_verification`) VALUES
(1, 'Library', 'Admin', 'admin.readingclub@gmail.com', '2000-09-01', 'Colombo 12', '94 123 654 777', '63ab0ae72e7d9.jpeg', 'df50b96841e37e8efd4142dbdd20780e9ad12f44', 'enable', NULL, 1),
(3, 'Thejana', 'Akmeemana', 'thejanaakmeemanax@gmail.com', '2000-09-26', 'Colombo 99', '94 774 719 095', '63ab0b3d5eb26.jpeg', 'ef92b22e9f407f6a0d09941d453fc730003f8578', 'enable', NULL, 1),
(4, 'Sunil A', 'Perera', 'sunilperera@gmail.com', '2000-09-05', 'Colombo 99', '94 774 719 999', '63ab0cd8da45f.jpeg', '8d4f09017285e3f482e24e3e2039fabc0fcf193f', 'disable', NULL, NULL),
(6, 'Gayan', 'Perera', 'gayanperera@gmail.com', '2016-12-28', 'Galle', '94 321 768 943', '63abefde28e64.jpeg', '5128e9320bd8805837cdafba99cce0c74cba3fa0', 'enable', NULL, 1),
(7, 'Thejana', 'Akmeemana', 'thejanaakmeemanay@gmail.com', '2016-12-28', 'Colombo', '94 123 543 642', '63ac5ac90e463.jpeg', '18621f2d207f8b08858dbe15fb35e618fa856f6a', 'enable', '6c2c0dd720122c343c8f033f89490798', 1),
(12, 'Thejana ', 'Akmeemana A', 'thejanaakmeemana@gmail.com', '2017-01-15', 'Colombo', '94 123 842 492', '63c3c22a37f9c.jpeg', 'b152e0571953eee3150e9400a67a8ccd9ffd5a75', NULL, '441d53e127817783f466f1b5aaf4666e3e99b4b5', 1),
(13, 'Thejana', 'Akmeemana', '2020is001@stu.ucsc.cmb.ac.lk', '2017-01-15', 'Colombo', '94 345 654 654', '63c3d32b91380.jpeg', 'b152e0571953eee3150e9400a67a8ccd9ffd5a75', 'enable', '832addbc1e931fe4e09d33ff89b7d9d0b227ef30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`borrowingID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `borrowingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `book` (`bookID`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
