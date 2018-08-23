-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2018 at 10:54 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `applicationId` int(11) NOT NULL,
  `internId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`applicationId`, `internId`, `studentId`, `time`) VALUES
(1, 1, 1, '2018-08-22 18:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `employerId` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `companyName` varchar(128) DEFAULT NULL,
  `postedCount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`employerId`, `email`, `password`, `companyName`, `postedCount`) VALUES
(1, 'employer@employer.com', '$2y$12$eBbQ7xbI/d7cn.Iq.zCX4enagqe/7TXd7cfxMLxd.sypYcr0wp6LK', 'sample pvt ltd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `internId` int(11) NOT NULL,
  `profile` varchar(64) NOT NULL,
  `employerId` int(11) NOT NULL,
  `description` text NOT NULL,
  `requirement` text NOT NULL,
  `applicationCount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`internId`, `profile`, `employerId`, `description`, `requirement`, `applicationCount`) VALUES
(1, 'Sample Profile', 1, 'sample profile is open for every aspiring student in the field of sample', 'requirement :\r\nbtech(comp)\r\nmin 5 cgpa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstName` varchar(32) DEFAULT NULL,
  `lastName` varchar(32) DEFAULT NULL,
  `institue` varchar(128) DEFAULT NULL,
  `profile` varchar(64) DEFAULT NULL,
  `appliedCount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `email`, `password`, `firstName`, `lastName`, `institue`, `profile`, `appliedCount`) VALUES
(1, 'sample@sample.com', '$2y$11$WTs.aI0ECPAdWz8Hxmb.L.SHMmD/7s1M8UX3qHILbYgkJcj2V8qe6', 'Sample', 'Student', 'Sample technological University', 'Sample Profile', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`applicationId`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`employerId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`internId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `applicationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `employerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `internId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
