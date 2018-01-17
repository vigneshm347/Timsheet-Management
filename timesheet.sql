-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2018 at 06:03 AM
-- Server version: 10.1.25-MariaDB
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
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `cis_subjects`
--

CREATE TABLE `cis_subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cis_subjects`
--

INSERT INTO `cis_subjects` (`id`, `subject_name`) VALUES
(2, 'Advanced Operating System'),
(1, 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `new_user`
--

CREATE TABLE `new_user` (
  `Sno` int(10) UNSIGNED NOT NULL,
  `User_Type` varchar(20) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `User_ID` varchar(30) NOT NULL,
  `UPassword` varchar(60) NOT NULL,
  `Gender` varchar(7) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Semester` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_user`
--

INSERT INTO `new_user` (`Sno`, `User_Type`, `First_Name`, `Last_Name`, `User_ID`, `UPassword`, `Gender`, `Email`, `Semester`) VALUES
(28, 'Student', 'Vignesh', 'Manvasagam', '75860579', '8af433519d6e385e89bb280f8002f2b2', 'Male', 'vmanivas@umich.edu', 'Fall'),
(29, 'Instructor', 'Test', 'Input', '12345678', '098f6bcd4621d373cade4e832627b4f6', 'Male', 'test@gmail.com', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `professor_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `professor_name`) VALUES
(2, 'Anys Bacha'),
(1, 'Kiumi Akingbehin'),
(3, 'Raed Almomani');

-- --------------------------------------------------------

--
-- Table structure for table `student_entry`
--

CREATE TABLE `student_entry` (
  `Sno` int(10) UNSIGNED NOT NULL,
  `User_ID` int(10) UNSIGNED NOT NULL,
  `FromTime` varchar(10) NOT NULL,
  `ToTime` varchar(10) NOT NULL,
  `ADate` date NOT NULL,
  `SubName` varchar(100) DEFAULT NULL,
  `StaffName` varchar(45) DEFAULT NULL,
  `ClassType` varchar(10) DEFAULT NULL,
  `Remarks` varchar(200) DEFAULT NULL,
  `Others` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_entry`
--

INSERT INTO `student_entry` (`Sno`, `User_ID`, `FromTime`, `ToTime`, `ADate`, `SubName`, `StaffName`, `ClassType`, `Remarks`, `Others`) VALUES
(11, 75860579, '19:00', '20:02', '2017-12-12', 'Software Engineering', 'Kiumi Akingbehin', 'In-class', 'Test', 'Input'),
(12, 75860579, '15:00', '17:00', '2017-12-11', 'Advanced Operating System', 'Raed Almomani', 'lab', 'Test number two', 'Validating'),
(13, 75860579, '16:00', '19:00', '2017-12-05', 'Advanced Operating System', 'Anys Bacha', 'Lab', 'sample', 'Data');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cis_subjects`
--
ALTER TABLE `cis_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject` (`subject_name`);

--
-- Indexes for table `new_user`
--
ALTER TABLE `new_user`
  ADD PRIMARY KEY (`Sno`),
  ADD UNIQUE KEY `User_ID` (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `names` (`professor_name`);

--
-- Indexes for table `student_entry`
--
ALTER TABLE `student_entry`
  ADD PRIMARY KEY (`Sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cis_subjects`
--
ALTER TABLE `cis_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `new_user`
--
ALTER TABLE `new_user`
  MODIFY `Sno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_entry`
--
ALTER TABLE `student_entry`
  MODIFY `Sno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
