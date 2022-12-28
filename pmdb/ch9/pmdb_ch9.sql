-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 07:42 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmdb_ch9`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `address` text,
  `email` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `address`, `email`, `birthday`) VALUES
(1, 'à¸ªà¸¡à¸Šà¸²à¸¢ à¸žà¸²à¸¢à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸‚à¸¸à¸™à¹€à¸—à¸µà¸¢à¸™ à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž', 'somchai@example.com', '1975-01-10'),
(2, 'à¸ªà¸¡à¸«à¸à¸´à¸‡ à¸¢à¸´à¸‡à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸šà¸±à¸§à¸—à¸­à¸‡ à¸™à¸™à¸—à¸šà¸¸à¸£à¸µ', 'somying@example.com', '1976-10-01'),
(3, 'à¸ªà¸¡à¸¨à¸£à¸µ à¸‚à¸µà¹ˆà¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸¥à¸°à¸¡à¸¸à¸‡ à¸Šà¸¥à¸šà¸¸à¸£à¸µ', 'somsri@example.com', '1977-12-21'),
(4, 'à¸ªà¸¡à¸¨à¸±à¸à¸”à¸´à¹Œ à¸£à¸±à¸à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸žà¸¥à¸µ à¸ªà¸¡à¸¸à¸—à¸£à¸›à¸£à¸²à¸à¸²à¸£', 'somsak@example.com', '1978-11-11'),
(5, 'à¸ªà¸¡à¸«à¸§à¸±à¸‡ à¸™à¸±à¹ˆà¸‡à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸›à¸°à¸­à¸´à¸™à¸—à¸£à¹Œ à¸­à¸¢à¸¸à¸˜à¸¢à¸²', 'somwang@example.com', '1979-10-10'),
(6, 'à¸ªà¸¡à¸žà¸£ à¸™à¸­à¸™à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸£à¸°à¸ˆà¸±à¸™à¸—à¸£à¹Œ à¸ªà¸´à¸‡à¸«à¹Œà¸šà¸¸à¸£à¸µ', 'somporn@example.com', '1980-03-30'),
(7, 'à¸ªà¸¡à¸›à¸­à¸‡ à¸¡à¸­à¸‡à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¸›à¸°à¸à¸‡ à¸‰à¸°à¹€à¸Šà¸´à¸‡à¹€à¸—à¸£à¸²', 'sompongmong@example.com', '1981-02-20'),
(8, 'à¸ªà¸¡à¸žà¸‡à¸©à¹Œ à¸¥à¸‡à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¹€à¸¥à¸™ à¸™à¸„à¸£à¸›à¸à¸¡', 'sompong@example.com', '1982-06-06'),
(9, 'à¸ªà¸¡à¸žà¸¥  à¸‚à¸™à¹€à¹€à¸£à¸·à¸­', 'à¸šà¸²à¸‡à¹à¸ž à¸£à¸²à¸Šà¸šà¸¸à¸£à¸µ', 'somphol@example.com', '1980-09-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
