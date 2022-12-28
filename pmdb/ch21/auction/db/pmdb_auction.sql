-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 07:44 AM
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
-- Database: `pmdb_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` mediumint(8) UNSIGNED NOT NULL,
  `item_id` mediumint(8) UNSIGNED NOT NULL,
  `bid_price` int(10) UNSIGNED NOT NULL,
  `bid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `member_id`, `item_id`, `bid_price`, `bid_date`) VALUES
(1, 5, 5, 1550000, '2019-05-24'),
(2, 5, 3, 5050, '2019-05-24'),
(3, 5, 4, 30001, '2019-05-24'),
(4, 1, 5, 1555000, '2019-05-24'),
(5, 1, 2, 9099, '2019-05-24'),
(6, 1, 3, 5555, '2019-05-24'),
(7, 2, 1, 1100000, '2019-05-24'),
(9, 2, 1, 1190000, '2019-05-24'),
(11, 4, 4, 33000, '2019-05-24'),
(12, 4, 1, 1200000, '2019-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `member_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `detail` text NOT NULL,
  `start_price` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `img_files` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `member_id`, `name`, `detail`, `start_price`, `start_date`, `end_date`, `img_files`) VALUES
(1, 1, 'à¸£à¸–à¸¢à¸™à¸•à¹Œ Jaguar XJS', 'à¹à¸¡à¹‰à¸ˆà¸°à¸œà¹ˆà¸²à¸™à¸¡à¸²à¸™à¸²à¸™à¸«à¸¥à¸²à¸¢à¸ªà¸´à¸šà¸›à¸µ à¹à¸•à¹ˆ Jaguar XJS à¸¢à¸±à¸‡à¸„à¸‡à¸„à¸§à¸²à¸¡à¸„à¸¥à¸²à¸ªà¸ªà¸´à¸à¸ªà¸§à¸¢à¸‡à¸²à¸¡à¸—à¸¸à¸à¸¡à¸¸à¸¡à¸¡à¸­à¸‡ à¹€à¸›à¹‡à¸™à¸£à¸¸à¹ˆà¸™à¸«à¸²à¸¢à¸²à¸à¸—à¸µà¹ˆà¸„à¸§à¸£à¸„à¹ˆà¸²à¹à¸à¹ˆà¸à¸²à¸£à¸ªà¸°à¸ªà¸¡ à¸ªà¸²à¸¡à¸²à¸£à¸–à¸§à¸´à¹ˆà¸‡à¹à¸¥à¸°à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¹„à¸”à¹‰à¸•à¸²à¸¡à¸›à¸à¸•à¸´ à¹€à¸«à¸¥à¸·à¸­à¹€à¸žà¸µà¸¢à¸‡à¸„à¸±à¸™à¹€à¸”à¸µà¸¢à¸§à¹€à¸—à¹ˆà¸²à¸™à¸±à¹‰à¸™', 1000000, '2019-05-24', '2029-12-31', '1-1.jpg,1-2.jpg,1-3.jpg'),
(2, 5, 'à¸à¸µà¸•à¹‰à¸²à¸£à¹Œà¹„à¸Ÿà¸Ÿà¹‰à¸² Fender', 'à¹€à¸«à¸¡à¸²à¸°à¸ªà¸³à¸«à¸£à¸±à¸šà¸œà¸¹à¹‰à¸•à¹‰à¸­à¸‡à¸à¸²à¸£à¸à¸µà¸•à¹‰à¸²à¸£à¹Œà¹„à¸Ÿà¸Ÿà¹‰à¸²à¸£à¸°à¸”à¸±à¸š Professional à¹ƒà¸«à¹‰à¹€à¸ªà¸µà¸¢à¸‡à¸—à¸µà¹ˆà¸«à¸™à¸±à¸à¹à¸™à¹ˆà¸™ à¸—à¸£à¸‡à¸žà¸¥à¸±à¸‡ à¹€à¸›à¹‡à¸™à¸—à¸µà¹ˆà¸™à¸´à¸¢à¸¡à¸‚à¸­à¸‡à¸™à¸±à¸à¸à¸µà¸•à¸²à¸£à¹Œà¸£à¸°à¸”à¸±à¸šà¸¡à¸·à¸­à¸­à¸²à¸Šà¸µà¸žà¸—à¸±à¹ˆà¸§à¹‚à¸¥à¸ à¸›à¸±à¸ˆà¸ˆà¸¸à¸šà¸±à¸™à¹€à¸›à¹‡à¸™à¸­à¸µà¸à¸£à¸¸à¹ˆà¸™à¸—à¸µà¹ˆà¸«à¸²à¸‹à¸·à¹‰à¸­à¹„à¸”à¹‰à¸¢à¸²à¸à¸¡à¸²à¸', 9000, '2019-05-24', '2025-10-31', '2-1.jpg,2-2.jpg,2-3.jpg'),
(3, 4, 'à¹„à¸¡à¹‰à¹à¸à¸°à¸ªà¸¥à¸±à¸', 'à¸—à¸³à¸ˆà¸²à¸à¹„à¸¡à¹‰à¹€à¸™à¸·à¹‰à¸­à¹à¸‚à¹‰à¸‡à¸ˆà¸²à¸à¸›à¹ˆà¸²à¸¥à¸¶à¸à¹à¸–à¸šà¸¥à¸¸à¹ˆà¸¡à¹à¸¡à¹ˆà¸™à¹‰à¸³à¸­à¸°à¹€à¸¡à¸‹à¸­à¸™ à¹à¸à¸°à¸ªà¸¥à¸±à¸à¹‚à¸”à¸¢à¸¨à¸´à¸¥à¸›à¸´à¸™à¹€à¸­à¸à¸‚à¸­à¸‡à¹‚à¸¥à¸ à¸¡à¸µà¸„à¸§à¸²à¸¡à¸›à¸£à¸°à¸“à¸µà¸• à¸ªà¸§à¸¢à¸‡à¸²à¸¡ à¹à¸¥à¸°à¹€à¸›à¹‡à¸™à¹€à¸­à¸à¸¥à¸±à¸à¸©à¸“à¹Œ à¹„à¸¡à¹ˆà¸ªà¸²à¸¡à¸²à¸£à¸–à¸«à¸²à¸‹à¸·à¹‰à¸­à¹„à¸”à¹‰à¸ˆà¸²à¸à¸—à¸µà¹ˆà¹ƒà¸” ', 5000, '2019-05-24', '2030-04-30', '3-1.jpg,3-2.jpg'),
(4, 2, 'à¸§à¸±à¸•à¸–à¸¸à¹‚à¸šà¸£à¸²à¸“', 'à¸‚à¸¸à¸”à¸žà¸šà¸ˆà¸²à¸à¹ƒà¸•à¹‰à¸”à¸´à¸™à¸¥à¸¶à¸ 1000 à¹€à¸¡à¸•à¸£ à¸—à¸µà¹ˆà¸¢à¸±à¸‡à¸„à¸‡à¸ªà¸ à¸²à¸žà¹€à¸”à¸´à¸¡à¹€à¸à¸·à¸­à¸š 100% à¹€à¸›à¹‡à¸™à¸§à¸±à¸•à¸–à¸¸à¹‚à¸šà¸£à¸²à¸“à¸—à¸µà¹ˆà¸—à¸£à¸‡à¸„à¸¸à¸“à¸„à¹ˆà¸² à¹€à¸«à¸¡à¸²à¸°à¸ªà¸³à¸«à¸£à¸±à¸šà¸™à¸±à¸à¸ªà¸°à¸ªà¸¡à¸œà¸¹à¹‰à¸Šà¸·à¹ˆà¸™à¸Šà¸­à¸šà¸¨à¸´à¸¥à¸›à¸°à¹ƒà¸™à¸¢à¸¸à¸„à¸à¹ˆà¸­à¸™à¸›à¸£à¸°à¸§à¸±à¸•à¸´à¸¨à¸²à¸ªà¸•à¸£à¹Œ', 30000, '2019-05-24', '2025-05-24', '4-1.jpg,4-2.jpg,4-3.jpg'),
(5, 3, 'Benz 500SL', 'à¸£à¸–à¹€à¸šà¸™à¸‹à¹Œà¸£à¸¸à¹ˆà¸™à¸¢à¸­à¸”à¸®à¸´à¸•à¹ƒà¸™à¸­à¸”à¸µà¸•à¸—à¸µà¹ˆà¸¢à¸±à¸‡à¸„à¸‡à¸„à¸§à¸²à¸¡à¸„à¸¥à¸²à¸ªà¸ªà¸´à¸„à¸¡à¸²à¸–à¸¶à¸‡à¸›à¸±à¸ˆà¸ˆà¸¸à¸šà¸±à¸™ à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸—à¸¸à¸à¸­à¸¢à¹ˆà¸²à¸‡à¸¢à¸±à¸‡à¸­à¸¢à¸¹à¹ˆà¸„à¸£à¸šà¹ƒà¸™à¸ªà¸ à¸²à¸žà¹€à¸”à¸´à¸¡à¸—à¸±à¹‰à¸‡à¸«à¸¡à¸” à¸ªà¸§à¸¢à¸‡à¸²à¸¡ à¸—à¸£à¸‡à¸„à¸¸à¸“à¸„à¹ˆà¸² à¹„à¸£à¹‰à¸—à¸µà¹ˆà¸•à¸´ à¹à¸¥à¸°à¸”à¸¹à¸«à¸£à¸¹à¸«à¸£à¸²à¸­à¸¢à¹ˆà¸²à¸‡à¸¡à¸µà¸£à¸°à¸”à¸±à¸š', 1500000, '2019-05-24', '2028-03-31', '5-1.jpg,5-2.jpg,5-3.jpg'),
(7, 5, 'à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸±à¸‡à¸„à¹‚à¸¥à¸', 'à¸›à¸£à¸°à¸•à¸´à¸¡à¸²à¸à¸£à¸£à¸¡à¸Šà¸´à¹‰à¸™à¹€à¸­à¸ à¸—à¸µà¹ˆà¸ªà¸§à¸¢à¸‡à¸²à¸¡à¹ƒà¸™à¸—à¸¸à¸à¸¡à¸¸à¸¡à¸¡à¸­à¸‡ à¸›à¸£à¸°à¸”à¸±à¸šà¸›à¸£à¸°à¸”à¸²à¸”à¹‰à¸§à¸¢à¸¥à¸§à¸”à¸¥à¸²à¸¢à¸—à¸µà¹ˆà¸¡à¸µà¸§à¸´à¸ˆà¸´à¸•à¸£à¸šà¸£à¸£à¸ˆà¸‡ à¸™à¹ˆà¸²à¸«à¸¥à¸‡à¹„à¸«à¸¥ à¸‹à¸¶à¹ˆà¸‡à¸¡à¸µà¹€à¸žà¸µà¸¢à¸‡à¸œà¸¹à¹‰à¹€à¸”à¸µà¸¢à¸§à¹€à¸—à¹ˆà¸²à¸™à¸±à¹‰à¸™à¸—à¸µà¹ˆà¸¡à¸µà¹‚à¸­à¸à¸²à¸ªà¹„à¸”à¹‰à¸„à¸£à¸­à¸šà¸„à¸£à¸­à¸‡', 3000, '2019-05-24', '2028-09-30', '7-1.jpg,7-2.jpg,7-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `firstname`, `lastname`, `address`, `phone`) VALUES
(1, 'banchar_pa@yahoo.com', '12345', 'Banchar', 'Developerthai', 'à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž à¸›à¸£à¸°à¹€à¸—à¸¨à¹„à¸—à¸¢', '089123xxxx'),
(2, 'one@twothree.com', '12345', 'à¸«à¸™à¸¶à¹ˆà¸‡', 'à¸ªà¸­à¸‡à¸ªà¸²à¸¡', '1/23 à¸­.à¹€à¸¡à¸·à¸­à¸‡ à¸Šà¸¥à¸šà¸¸à¸£à¸µ', '099876xxxx'),
(3, 'malee@meela.com', '12345', 'à¸¡à¸²à¸¥à¸µ', 'à¸¡à¸µà¸¥à¸²', '999 à¸­.à¸›à¸²à¸à¹€à¸à¸£à¹‡à¸” à¸™à¸™à¸—à¸šà¸¸à¸£à¸µ', '096543xxxx'),
(4, 'manee@meena.com', '12345', 'à¸¡à¸²à¸™à¸µ', 'à¸¡à¸µà¸™à¸²', '55/5 à¸­.à¹€à¸¡à¸·à¸­à¸‡ à¸‚à¸­à¸™à¹à¸à¹ˆà¸™', '098999xxxx'),
(5, 'singha@kanya.com', '12345', 'à¸ªà¸´à¸‡à¸«à¸²', 'à¸à¸±à¸™à¸¢à¸²', '999 à¸­.à¹€à¸¡à¸·à¸­à¸‡ à¸ªà¸´à¸‡à¸«à¹Œà¸šà¸¸à¸£à¸µ', '095678xxxx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
