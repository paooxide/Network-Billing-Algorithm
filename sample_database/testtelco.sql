-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 05:44 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testtelco`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_customer`
--

CREATE TABLE IF NOT EXISTS `bill_customer` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `amount_to_bill` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_customer`
--

INSERT INTO `bill_customer` (`id`, `username`, `mobile_number`, `amount_to_bill`) VALUES
(1, 'a1', '08139755032', 1000),
(2, 'a2', '08139755033', 1000),
(3, 'a3', '08139755034', 1000),
(4, 'a5', '08139755036', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_customer`
--
ALTER TABLE `bill_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile_number` (`mobile_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_customer`
--
ALTER TABLE `bill_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
