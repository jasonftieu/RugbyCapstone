-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2018 at 04:32 AM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OURugby`
--

-- --------------------------------------------------------

--
-- Table structure for table `Button`
--

CREATE TABLE `Button` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NAME` char(20) DEFAULT NULL,
  `STATUS` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Button`
--

INSERT INTO `Button` (`ID`, `NAME`, `STATUS`) VALUES
(1, 'Play', b'0'),
(2, 'Pause', b'0'),
(3, 'Reset', b'0'),
(4, 'New', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Operator`
--

CREATE TABLE `Operator` (
  `ID` int(10) UNSIGNED NOT NULL,
  `LOGIN` char(20) NOT NULL,
  `PASSPHRASE` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Operator`
--

INSERT INTO `Operator` (`ID`, `LOGIN`, `PASSPHRASE`) VALUES
(1, 'admin', 'OURugbyTeam'),
(2, 'phi9575', 'MinhDepTrai09');

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE `Score` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TEAM` char(20) DEFAULT NULL,
  `POINT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Score`
--

INSERT INTO `Score` (`ID`, `TEAM`, `POINT`) VALUES
(1, 'Home', 0),
(2, 'Away', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `Time` (
  `ID` int(10) UNSIGNED NOT NULL,
  `PERIOD` char(20) NOT NULL,
  `MINUTE` int(11) NOT NULL,
  `SECOND` int(11) NOT NULL,
  `STATUS` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Time`
--

INSERT INTO `Time` (`ID`, `PERIOD`, `MINUTE`, `SECOND`, `STATUS`) VALUES
(1, '1st', 40, 0, b'1'),
(2, '2nd', 40, 0, b'0'),
(3, 'OT', 10, 0, b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Button`
--
ALTER TABLE `Button`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Operator`
--
ALTER TABLE `Operator`
  ADD PRIMARY KEY (`ID`,`LOGIN`);

--
-- Indexes for table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Time`
--
ALTER TABLE `Time`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Button`
--
ALTER TABLE `Button`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Operator`
--
ALTER TABLE `Operator`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Score`
--
ALTER TABLE `Score`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Time`
--
ALTER TABLE `Time`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
