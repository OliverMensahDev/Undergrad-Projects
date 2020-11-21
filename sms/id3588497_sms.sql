-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2017 at 06:55 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3588497_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessionmanager`
--
CREATE DATABASE  sms;
use sms;
CREATE TABLE `sessionmanager` (
  `msisdn` varchar(20) NOT NULL,
  `transaction_type` varchar(1000) DEFAULT NULL,
  `amount` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessionmanager`
--

INSERT INTO `sessionmanager` (`msisdn`, `transaction_type`, `amount`) VALUES
('1', 'phone', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `amount` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_number` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `date`, `phone_number`) VALUES
(1, '43', '2017-11-19 13:17:13', 544892841),
(2, '1', '2017-11-19 14:09:52', 544892841),
(3, '1', '2017-11-19 14:16:41', 544892841),
(4, '34', '2017-11-19 14:18:34', 544892841),
(5, '41', '2017-11-19 14:54:41', 544892841),
(6, '34', '2017-11-19 15:38:12', 544892841),
(7, '41', '2017-11-19 15:43:12', 544892841),
(8, '43', '2017-11-19 15:45:05', 544892841),
(9, '43', '2017-11-19 15:46:55', 544892841),
(10, '2', '2017-11-19 19:37:49', 244185893),
(11, '23', '2017-11-19 19:39:03', 544892841),
(12, '1', '2017-11-19 20:09:49', 555745457),
(13, '34', '2017-11-19 20:16:39', 555745457),
(14, '1', '2017-11-19 20:19:53', 555745457);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessionmanager`
--
ALTER TABLE `sessionmanager`
  ADD PRIMARY KEY (`msisdn`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
