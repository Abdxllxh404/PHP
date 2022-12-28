-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 07:45 AM
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
-- Database: `pmdb_wish_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'onetwothree@example.com', '123', 'à¸«à¸™à¸¶à¹ˆà¸‡', 'à¸ªà¸­à¸‡à¸ªà¸²à¸¡'),
(2, 'fourfive@xxx.com', '456', 'à¸ªà¸µà¹ˆ', 'à¸«à¹‰à¸²à¸«à¸'),
(3, 'six78@yyy.com', '678', 'six', 'seven8'),
(4, 'banchar_pa@yahoo.com', '12345', 'à¸šà¸±à¸à¸Šà¸²', 'à¸«à¹‰à¸²à¸«à¹‰à¸²à¸«à¹‰à¸²');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `detail` text NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `remain` smallint(5) UNSIGNED NOT NULL,
  `img_file` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `detail`, `price`, `remain`, `img_file`) VALUES
(1, 'à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§ Long Sleeve', 'à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§ Long Sleeve à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¹€à¸™à¸·à¹‰à¸­à¸œà¹‰à¸²à¸Šà¸™à¸´à¸”à¸žà¸´à¹€à¸¨à¸©à¸‹à¸¶à¹ˆà¸‡à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¸£à¸¹à¹‰à¸ªà¸¶à¸à¸­à¸šà¸­à¸¸à¹ˆà¸™à¸à¸²à¸¢ à¸„à¸¥à¸²à¸¢à¸„à¸§à¸²à¸¡à¸«à¸™à¸²à¸§à¹€à¸¢à¹‡à¸™ à¹„à¸¡à¹ˆà¸—à¸³à¹ƒà¸«à¹‰à¸œà¸´à¸§à¹à¸«à¹‰à¸‡à¸•à¸¶à¸‡ à¸«à¸²à¸à¸„à¸¸à¸“à¸à¸³à¸¥à¸±à¸‡à¸¡à¸­à¸‡à¸«à¸²à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§à¸à¸±à¸™à¸«à¸™à¸²à¸§à¸—à¸µà¹ˆà¸¡à¸µà¸„à¸¸à¸“à¸ à¸²à¸žà¸”à¸µà¹€à¸¢à¸µà¹ˆà¸¢à¸¡à¹ƒà¸™à¸£à¸²à¸„à¸²à¸¢à¹ˆà¸­à¸¡à¹€à¸¢à¸²à¸§à¹Œ Long Sleeve à¸„à¸·à¸­à¸„à¸³à¸•à¸­à¸šà¸ªà¸¸à¸”à¸—à¹‰à¸²à¸¢', 1000, 20, '1.jpg'),
(2, 'à¸à¸²à¸‡à¹€à¸à¸‡ Bermuda', 'à¸à¸²à¸‡à¹€à¸à¸‡à¸ªà¹„à¸•à¸¥à¹Œà¹€à¸šà¸­à¸£à¹Œà¸¡à¸´à¸§à¸”à¹‰à¸² à¹ƒà¸«à¹‰à¸„à¸§à¸²à¸¡à¸£à¸¹à¹‰à¸ªà¸¶à¸à¸›à¸¥à¸­à¸”à¹‚à¸›à¸£à¹ˆà¸‡à¹‚à¸¥à¹ˆà¸‡à¸ªà¸šà¸²à¸¢à¹€à¸«à¸¡à¸·à¸­à¸™à¸­à¸¢à¸¹à¹ˆà¸šà¸™à¹€à¸à¸²à¸°à¸à¸¥à¸²à¸‡à¸—à¸°à¹€à¸¥ à¸—à¸µà¹ˆà¹‚à¸­à¸šà¸¥à¹‰à¸­à¸¡à¹„à¸›à¸”à¹‰à¸§à¸¢à¸—à¹‰à¸­à¸‡à¸Ÿà¹‰à¸²à¹à¸¥à¸°à¸œà¸·à¸™à¸™à¹‰à¸³à¸­à¸±à¸™à¸à¸§à¹‰à¸²à¸‡à¹„à¸à¸¥ à¸ˆà¸™à¸­à¸¢à¸²à¸à¹ƒà¸ªà¹ˆà¸à¸²à¸‡à¹€à¸à¸‡à¸•à¸±à¸§à¸™à¸µà¹‰à¹„à¸›à¹à¸•à¸°à¸‚à¸­à¸šà¸Ÿà¹‰à¸²', 800, 10, '2.jpg'),
(3, 'à¸à¸£à¸°à¹€à¸›à¹‹à¸² à¸«à¸¥à¸¸à¸¢à¸ªà¹Œ à¸§à¸´à¸•à¸•à¹Šà¸­à¸‡', 'à¸–à¹‰à¸²à¸„à¸¸à¸“à¹„à¸”à¹‰à¸ªà¸±à¸¡à¸œà¸±à¸ªà¸à¸±à¸šà¸à¸£à¸°à¹€à¸›à¹‹à¸² à¸«à¸¥à¸¸à¸¢à¸ªà¹Œ à¸§à¸´à¸•à¸•à¹Šà¸­à¸‡ à¸„à¸¸à¸“à¸ˆà¸°à¸—à¸£à¸²à¸šà¹„à¸”à¹‰à¸—à¸±à¸™à¸—à¸µà¸§à¹ˆà¸²à¸—à¸³à¹„à¸¡ à¹à¸šà¸£à¸™à¸”à¹Œà¹€à¸™à¸¡à¸™à¸µà¹‰ à¸ˆà¸¶à¸‡à¹€à¸›à¹‡à¸™à¸„à¸§à¸²à¸¡à¹ƒà¸à¹ˆà¸à¸±à¸™à¸‚à¸­à¸‡à¸œà¸¹à¹‰à¸«à¸à¸´à¸‡à¸—à¸±à¹ˆà¸§à¹‚à¸¥à¸ à¸”à¹‰à¸§à¸¢à¹€à¸­à¸à¸¥à¸±à¸à¸©à¸“à¹Œà¸—à¸µà¹ˆà¹‚à¸”à¸”à¹€à¸”à¹ˆà¸™à¹€à¸«à¸™à¸·à¸­à¹ƒà¸„à¸£ à¸ªà¸§à¸¢à¸šà¸²à¸”à¹ƒà¸ˆà¹ƒà¸™à¸—à¸¸à¸à¸¡à¸¸à¸¡à¸¡à¸­à¸‡ à¸£à¸­à¸„à¸¸à¸“à¸¡à¸²à¸ˆà¸±à¸šà¸ˆà¸­à¸‡à¹€à¸›à¹‡à¸™à¹€à¸ˆà¹‰à¸²à¸‚à¸­à¸‡à¹à¸¥à¹‰à¸§à¸§à¸±à¸™à¸™à¸µà¹‰', 30000, 3, '3.jpg'),
(4, 'à¸«à¸¡à¸§à¸ Hattrick', 'à¹€à¸›à¹‡à¸™à¸«à¸¡à¸§à¸à¸—à¸µà¹ˆà¸ªà¸²à¸¡à¸²à¸£à¸–à¸›à¹‰à¸­à¸‡à¸à¸±à¸™à¹à¸ªà¸‡à¹à¸”à¸”à¹„à¸”à¹‰à¸”à¸µà¹€à¸¢à¸µà¹ˆà¸¢à¸¡ à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¸§à¸±à¸ªà¸”à¸¸à¸˜à¸£à¸£à¸¡à¸Šà¸²à¸•à¸´ à¸£à¸°à¸šà¸²à¸¢à¸­à¸²à¸à¸²à¸¨à¹„à¸”à¹‰à¸”à¸µ à¸Šà¹ˆà¸§à¸¢à¸¥à¸”à¹‚à¸¥à¸à¸£à¹‰à¸­à¸™', 490, 0, '4.jpg'),
(5, 'à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸à¸µà¸¬à¸² à¸™à¸²à¸¢à¸à¸µà¹‰ NKX', 'à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸ªà¸³à¸«à¸£à¸±à¸šà¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆà¸‚à¸“à¸°à¹€à¸¥à¹ˆà¸™à¸à¸µà¸¬à¸² à¸žà¸·à¹‰à¸™à¸™à¸´à¹ˆà¸¡ à¹„à¸¡à¹ˆà¸›à¸§à¸”à¹€à¸¡à¸·à¹ˆà¸­à¸¢à¸‚à¹‰à¸­à¹€à¸—à¹‰à¸² à¸—à¸™à¸—à¸²à¸™à¸•à¹ˆà¸­à¸—à¸¸à¸à¸ªà¸ à¸²à¸žà¸žà¸·à¹‰à¸™à¸œà¸´à¸§ à¸£à¸­à¸‡à¸£à¸±à¸šà¸™à¹‰à¸³à¸«à¸™à¸±à¸à¹„à¸”à¹‰à¸–à¸¶à¸‡ 500 à¸à¸´à¹‚à¸¥à¸à¸£à¸±à¸¡', 2000, 1, '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `member_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `member_id`, `product_id`) VALUES
(6, 4, 1),
(8, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
