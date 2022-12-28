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
-- Database: `pmdb_simple_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `member_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`member_id`, `product_id`, `quantity`) VALUES
(1, 1, 2),
(1, 5, 1);

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
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `firstname`, `lastname`, `address`, `phone`) VALUES
(1, 'banchar_pa@yahoo.com', '12345', 'Banchar', 'Developerthai', 'à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž à¸›à¸£à¸°à¹€à¸—à¸¨à¹„à¸—à¸¢', '089xxxxxxxx'),
(2, 'manee@meena.com', '12345', 'à¸¡à¸²à¸™à¸µ', 'à¸¡à¸µà¸™à¸²', 'à¸­.à¹€à¸¡à¸·à¸­à¸‡ à¹€à¸Šà¸µà¸¢à¸‡à¹ƒà¸«à¸¡à¹ˆ', '099123xxxx');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` mediumint(8) UNSIGNED NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(150) NOT NULL,
  `payment` varchar(250) NOT NULL,
  `pay_status` set('pending','paid') NOT NULL,
  `order_date` date NOT NULL,
  `bank_transfer` varchar(250) NOT NULL,
  `date_transfer` date NOT NULL,
  `time_transfer` time NOT NULL,
  `delivery` set('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `firstname`, `lastname`, `address`, `phone`, `payment`, `pay_status`, `order_date`, `bank_transfer`, `date_transfer`, `time_transfer`, `delivery`) VALUES
(2, 1, 'Banchar', 'Developerthai', 'à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž à¸›à¸£à¸°à¹€à¸—à¸¨à¹„à¸—à¸¢', '089xxxxxxxx', 'bank_transfer', 'pending', '2019-05-30', '', '0001-01-11', '00:00:00', 'no'),
(3, 2, 'à¸¡à¸²à¸™à¸µ', 'à¸¡à¸µà¸™à¸²', 'à¸­.à¹€à¸¡à¸·à¸­à¸‡ à¹€à¸Šà¸µà¸¢à¸‡à¹ƒà¸«à¸¡à¹ˆ', '099123xxxx', 'cod', 'pending', '2019-05-31', '', '0000-00-00', '00:00:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(3, 2, 1, 1),
(4, 2, 5, 1),
(5, 3, 9, 1);

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
  `delivery_cost` mediumint(8) UNSIGNED NOT NULL,
  `img_files` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `detail`, `price`, `remain`, `delivery_cost`, `img_files`) VALUES
(1, 'à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§ Long Sleeve', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§ Long Sleeve à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¹€à¸™à¸·à¹‰à¸­à¸œà¹‰à¸²à¸Šà¸™à¸´à¸”à¸žà¸´à¹€à¸¨à¸©à¸‹à¸¶à¹ˆà¸‡à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¸£à¸¹à¹‰à¸ªà¸¶à¸à¸­à¸šà¸­à¸¸à¹ˆà¸™à¸à¸²à¸¢ à¸„à¸¥à¸²à¸¢à¸„à¸§à¸²à¸¡à¸«à¸™à¸²à¸§à¹€à¸¢à¹‡à¸™ à¹„à¸¡à¹ˆà¸—à¸³à¹ƒà¸«à¹‰à¸œà¸´à¸§à¹à¸«à¹‰à¸‡à¸•à¸¶à¸‡ à¸«à¸²à¸à¸„à¸¸à¸“à¸à¸³à¸¥à¸±à¸‡à¸¡à¸­à¸‡à¸«à¸²à¹€à¸ªà¸·à¹‰à¸­à¹à¸‚à¸™à¸¢à¸²à¸§à¸à¸±à¸™à¸«à¸™à¸²à¸§à¸—à¸µà¹ˆà¸¡à¸µà¸„à¸¸à¸“à¸ à¸²à¸žà¸”à¸µà¹€à¸¢à¸µà¹ˆà¸¢à¸¡à¹ƒà¸™à¸£à¸²à¸„à¸²à¸¢à¹ˆà¸­à¸¡à¹€à¸¢à¸²à¸§à¹Œ Long Sleeve à¸„à¸·à¸­à¸„à¸³à¸•à¸­à¸šà¸ªà¸¸à¸”à¸—à¹‰à¸²à¸¢</span></p>', 1099, 10, 50, '1-1.png,1-2.png'),
(2, 'à¸à¸£à¸°à¹€à¸›à¹‹à¸² FireWallet', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸à¸£à¸°à¹€à¸›à¹‹à¸² FireWallet à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¸«à¸™à¸±à¸‡à¹à¸—à¹‰ 100% à¸”à¹‰à¸§à¸¢à¸„à¸¸à¸“à¸ªà¸¡à¸šà¸±à¸•à¸´à¸žà¸´à¹€à¸¨à¸©à¸‚à¸­à¸‡à¸à¸£à¸°à¹€à¸›à¹‹à¸² à¸‹à¸¶à¹ˆà¸‡à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¹€à¸‡à¸´à¸™à¸‚à¸­à¸‡à¸„à¸¸à¸“à¹„à¸¡à¹ˆà¸£à¸±à¹ˆà¸§à¹„à¸«à¸¥ à¹à¸–à¸¡à¸¢à¸±à¸‡à¹„à¸«à¸¥à¸¡à¸²à¹€à¸—à¸¡à¸²à¸ˆà¸™à¸¥à¹‰à¸™à¸—à¸°à¸¥à¸±à¹ˆà¸  à¸­à¸²à¸ˆà¸à¸¥à¸²à¸¢à¹€à¸›à¹‡à¸™à¹€à¸¨à¸£à¸©à¸à¸µà¹„à¸”à¹‰à¹ƒà¸™à¸žà¸£à¸´à¸šà¸•à¸² à¹„à¸¡à¹ˆà¹€à¸Šà¸·à¹ˆà¸­à¸­à¸¢à¹ˆà¸²à¸¥à¸šà¸«à¸¥à¸¹à¹ˆ</span></p>', 500, 20, 20, '2-1.png,2-2.png'),
(3, 'à¹€à¸ªà¸·à¹‰à¸­à¹€à¸Šà¸´à¹‰à¸• xMen', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸ªà¸·à¹‰à¸­à¹€à¸Šà¸´à¹‰à¸•à¸—à¸µà¹ˆà¸–à¸¹à¸à¸­à¸­à¸à¹à¸šà¸šà¸¡à¸²à¸ªà¸³à¸«à¸£à¸±à¸šà¸œà¸¹à¹‰à¸Šà¸²à¸¢à¸¡à¸µà¸ªà¹„à¸•à¸¥à¹Œà¸­à¸¢à¹ˆà¸²à¸‡à¸„à¸¸à¸“ à¸”à¹‰à¸§à¸¢à¸à¸²à¸£à¸­à¸­à¸à¹à¸šà¸šà¸‚à¸­à¸‡à¸”à¸µà¹„à¸‹à¹€à¸™à¸­à¸£à¹Œà¸Šà¸·à¹ˆà¸­à¸”à¸±à¸‡ à¸žà¸£à¹‰à¸­à¸¡à¸”à¹‰à¸§à¸¢à¸„à¸¸à¸“à¸ªà¸¡à¸šà¸•à¸´à¸‚à¸­à¸‡à¹€à¸™à¸·à¹‰à¸­à¸œà¹‰à¸²à¸—à¸µà¹ˆà¸–à¸¹à¸à¸„à¸±à¸”à¸ªà¸£à¸£à¸¡à¸²à¹€à¸›à¹‡à¸™à¸­à¸¢à¹ˆà¸²à¸‡à¸”à¸µ  à¸‹à¸¶à¹ˆà¸‡à¹„à¸¡à¹ˆà¸§à¹ˆà¸²à¸„à¸¸à¸“à¸ˆà¸°à¹€à¸›à¹‡à¸™à¸œà¸¹à¹‰à¸Šà¸²à¸¢à¹à¸šà¸šà¹„à¸«à¸™ à¹€à¸ªà¸·à¹‰à¸­ xMen à¸à¹‡à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¹‚à¸”à¸”à¹€à¸”à¹ˆà¸™à¹€à¸«à¸™à¸·à¸­à¸à¸§à¹ˆà¸²à¹ƒà¸„à¸£à¹† </span></p>', 300, 20, 30, '3-1.png,3-2.png'),
(4, 'à¸à¸²à¸‡à¹€à¸à¸‡ Denim Jean', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸”à¹‰à¸§à¸¢à¹€à¸­à¸à¸¥à¸±à¸à¸©à¸“à¹Œà¸­à¸±à¸™à¹€à¸›à¹‡à¸™à¹€à¸­à¸à¸ªà¸´à¸—à¸˜à¸´à¹Œà¹€à¸‰à¸žà¸²à¸° à¸ˆà¸²à¸à¸‡à¸²à¸™à¸”à¸µà¹„à¸‹à¸™à¹Œà¸—à¸µà¹ˆà¸¥à¸°à¹€à¸¡à¸µà¸¢à¸”à¸¥à¸°à¹„à¸¡ à¸œà¸ªà¸²à¸™à¸à¸±à¸šà¸à¸£à¸£à¸¡à¸§à¸´à¸˜à¸µà¸à¸²à¸£à¸œà¸¥à¸´à¸•à¸—à¸µà¹ˆà¸ªà¸¸à¸”à¹à¸ªà¸™à¸ˆà¸°à¸›à¸£à¸°à¸“à¸µà¸•à¹ƒà¸™à¸—à¸¸à¸à¸‚à¸±à¹‰à¸™à¸•à¸­à¸™ à¸ˆà¸¶à¸‡à¸—à¸³à¹ƒà¸«à¹‰ Denim Jean à¸à¸¥à¸²à¸¢à¹€à¸›à¹‡à¸™à¸«à¸™à¸¶à¹ˆà¸‡à¹ƒà¸™à¸„à¸§à¸²à¸¡à¹ƒà¸à¹ˆà¸à¸±à¸™à¸‚à¸­à¸‡à¸¡à¸§à¸¥à¸¡à¸™à¸¸à¸©à¸¢à¸Šà¸²à¸•à¸´</span></p>', 999, 5, 100, '4-1.png,4-2.png'),
(5, 'à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸ªà¹„à¸•à¸¥à¹Œ Mexican', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸›à¹‡à¸™à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸ªà¸²à¸£à¸žà¸±à¸”à¸›à¸£à¸°à¹‚à¸¢à¸Šà¸™à¹Œà¹ƒà¸ªà¹ˆà¹„à¸›à¹„à¸”à¹‰à¸—à¸¸à¸à¸—à¸µà¹ˆà¸—à¸µà¹ˆà¸•à¹‰à¸­à¸‡à¸à¸²à¸£ à¸¡à¸µà¸™à¹‰à¸³à¸«à¸™à¸±à¸à¹€à¸šà¸² à¸™à¸¸à¹ˆà¸¡à¸ªà¸šà¸²à¸¢à¸à¹ˆà¸²à¹€à¸—à¹‰à¸² à¹€à¸à¸²à¸°à¸žà¸·à¹‰à¸™à¹€à¸›à¹‡à¸™à¹€à¸¢à¸µà¹ˆà¸¢à¸¡ à¹à¸¥à¸°à¸«à¸¢à¸¸à¸”à¹„à¸”à¹‰à¸­à¸¢à¹ˆà¸²à¸‡à¸¡à¸±à¹ˆà¸™à¹ƒà¸ˆ à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¹‚à¸¥à¸”à¹à¸¥à¹ˆà¸™à¹„à¸›à¸–à¸¶à¸‡à¸ˆà¸¸à¸”à¸«à¸¡à¸²à¸¢à¹„à¸”à¹‰à¸­à¸¢à¹ˆà¸²à¸‡à¸›à¸¥à¸­à¸”à¸ à¸±à¸¢</span></p>', 790, 5, 50, '5-1.png,5-2.png'),
(6, 'à¹€à¸ªà¸·à¹‰à¸­ V-Shirt', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸›à¹‡à¸™à¹€à¸ªà¸·à¹‰à¸­à¹€à¸Šà¸´à¹‰à¸•à¸ªà¸³à¸«à¸£à¸±à¸šà¸žà¸§à¸à¹€à¸£à¸²à¸—à¸¸à¸à¸„à¸™ à¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆà¹„à¸”à¹‰à¸—à¸¸à¸à¸—à¸µà¹ˆà¸—à¸¸à¸à¹€à¸§à¸¥à¸²à¸—à¸¸à¸à¸ªà¸ à¸²à¸žà¸”à¸´à¸™à¸Ÿà¹‰à¸²à¸­à¸²à¸à¸²à¸¨à¹à¸¥à¸°à¸—à¸¸à¸à¸ à¸¹à¸¡à¸´à¸ à¸²à¸„  à¸Šà¹ˆà¸§à¸¢à¹€à¸ªà¸£à¸´à¸¡à¸ªà¸£à¹‰à¸²à¸‡à¸„à¸§à¸²à¸¡à¹‚à¸”à¸”à¹€à¸”à¹ˆà¸™à¸­à¸±à¸™à¸›à¹‡à¸™à¹€à¸­à¸à¸¥à¸±à¸à¸©à¸“à¹Œà¹à¸à¹ˆà¸œà¸¹à¹‰à¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆ à¹€à¸¥à¸·à¸­à¸à¹ƒà¸Šà¹‰à¸Šà¸µà¸§à¸´à¸•à¹€à¸›à¹‡à¸™à¹ƒà¸™à¹à¸šà¸šà¸‚à¸­à¸‡à¸•à¸±à¸§à¹€à¸­à¸‡ à¹€à¸¥à¸·à¸­à¸à¹ƒà¸™à¸ªà¸´à¹ˆà¸‡à¸—à¸µà¹ˆà¹€à¸›à¹‡à¸™à¸•à¸±à¸§à¸‚à¸­à¸‡à¸•à¸±à¸§à¹€à¸­à¸‡ à¹€à¸¥à¸·à¸­à¸ V-Shirt</span></p>', 499, 0, 40, '6-1.png,6-2.png'),
(7, 'à¸à¸£à¸°à¹€à¸›à¹‹à¸²à¸«à¸™à¸±à¸‡ Messenger Bag', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¸«à¸™à¸±à¸‡à¹à¸—à¹‰à¸—à¸µà¹ˆà¹„à¸”à¹‰à¸«à¸²à¸¢à¸²à¸ à¸”à¹‰à¸§à¸¢à¸à¸£à¸£à¸¡à¸§à¸´à¸˜à¸µà¸à¸²à¸£à¸œà¸¥à¸´à¸•à¸­à¸±à¸™à¸—à¸±à¸™à¸ªà¸¡à¸±à¸¢ à¹ƒà¸ªà¹ˆà¹ƒà¸ˆà¹ƒà¸™à¸—à¸¸à¸à¸£à¸²à¸¢à¸¥à¸°à¹€à¸­à¸µà¸¢à¸” à¸ˆà¸¶à¸‡à¸£à¸±à¸šà¸£à¸­à¸‡à¹„à¸”à¹‰à¸§à¹ˆà¸²à¸à¸£à¸°à¹€à¸›à¹‹à¸²à¹ƒà¸šà¸™à¸µà¹‰à¸‚à¸­à¸‡à¸—à¹ˆà¸²à¸™à¸ˆà¸°à¸ªà¸§à¸¢à¹€à¸”à¹ˆà¸™à¹€à¸«à¸™à¸·à¸­à¹ƒà¸„à¸£ à¸ªà¸²à¸¡à¸²à¸£à¸–à¸™à¸³à¹„à¸›à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¹„à¸”à¹‰à¸ªà¸²à¸£à¸žà¸±à¸”à¸›à¸£à¸°à¹‚à¸¢à¸Šà¸™à¹Œ</span></p>', 5000, 2, 100, '7-1.png'),
(8, 'à¸«à¸¡à¸§à¸ Hattrick', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸›à¹‡à¸™à¸«à¸¡à¸§à¸à¸—à¸µà¹ˆà¸ªà¸²à¸¡à¸²à¸£à¸–à¸›à¹‰à¸­à¸‡à¸à¸±à¸™à¹à¸ªà¸‡à¹à¸”à¸”à¹„à¸”à¹‰à¸”à¸µà¹€à¸¢à¸µà¹ˆà¸¢à¸¡ à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¸§à¸±à¸ªà¸”à¸¸à¸˜à¸£à¸£à¸¡à¸Šà¸²à¸•à¸´ à¸£à¸°à¸šà¸²à¸¢à¸­à¸²à¸à¸²à¸¨à¹„à¸”à¹‰à¸”à¸µ à¸Šà¹ˆà¸§à¸¢à¸¥à¸”à¹‚à¸¥à¸à¸£à¹‰à¸­à¸™ </span></p>', 400, 8, 40, '8-1.png'),
(9, 'à¹€à¸ªà¸·à¹‰à¸­ G-Shirt', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸à¸²à¸£à¸œà¸ªà¸²à¸™à¸à¸±à¸™à¸­à¸¢à¹ˆà¸²à¸‡à¸¥à¸‡à¸•à¸±à¸§à¸£à¸°à¸«à¸§à¹ˆà¸²à¸‡à¹à¸™à¸§à¸„à¸´à¸”à¹ƒà¸™à¸à¸²à¸£à¸­à¸­à¸à¹à¸šà¸šà¸­à¸±à¸™à¸§à¸´à¸ˆà¸´à¸•à¸£à¸‡à¸”à¸‡à¸²à¸¡à¸•à¸£à¸°à¸à¸²à¸£à¸•à¸²à¸à¸±à¸šà¹€à¸—à¸„à¹‚à¸™à¹‚à¸¥à¸¢à¸µà¸à¸²à¸£à¸œà¸¥à¸´à¸•à¸”à¹‰à¸§à¸¢à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ˆà¸±à¸à¸£à¸—à¸µà¹ˆà¸¥à¹‰à¸³à¸ªà¸¡à¸±à¸¢ à¹€à¸žà¸·à¹ˆà¸­à¹ƒà¸«à¹‰à¹„à¸”à¹‰à¸¡à¸²à¸‹à¸¶à¹ˆà¸‡à¹€à¸ªà¸·à¹‰à¸­à¸—à¸µà¹ˆà¹„à¸®à¹€à¸—à¸„à¹à¸¥à¸°à¸ªà¸§à¸¢à¸‡à¸²à¸¡ à¸ˆà¸¶à¸‡à¹€à¸›à¹‡à¸™à¹€à¸ªà¸·à¹‰à¸­à¹€à¸Šà¸´à¹‰à¸•à¸—à¸µà¹ˆà¹€à¸«à¸¡à¸²à¸°à¸ªà¸¡à¸—à¸µà¹ˆà¸ªà¸¸à¸”à¸ªà¸³à¸«à¸£à¸±à¸šà¸„à¸¸à¸“à¸ªà¸¸à¸ à¸²à¸žà¸ªà¸•à¸£à¸µà¹ƒà¸™à¸¢à¸¸à¸„ 3G à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆà¹€à¸žà¸·à¹ˆà¸­à¸à¹‰à¸²à¸§à¸‚à¹‰à¸²à¸¡à¹„à¸›à¸ªà¸¹à¹ˆ Generation à¹ƒà¸«à¸¡à¹ˆà¹„à¸”à¹‰à¸­à¸¢à¹ˆà¸²à¸‡à¹€à¸•à¹‡à¸¡à¸ à¸²à¸„à¸ à¸¹à¸¡à¸´</span></p>', 500, 5, 50, '9-1.png,9-2.png,9-3.png,9-4.png'),
(10, 'à¸à¸²à¸‡à¹€à¸à¸‡ Knitting Trouser', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¹€à¸›à¹‡à¸™à¸à¸²à¸‡à¹€à¸à¸‡à¸—à¸µà¹ˆà¹€à¸«à¸¡à¸²à¸°à¸à¸±à¸šà¸ªà¸²à¸§à¸¢à¸¸à¸„à¹ƒà¸«à¸¡à¹ˆ à¹„à¸¡à¹ˆà¸§à¹ˆà¸²à¸ˆà¸°à¹€à¸›à¹‡à¸™à¸§à¸±à¸™à¸™à¸±à¹‰à¸™ à¸§à¸±à¸™à¸™à¸µà¹‰ à¸§à¸±à¸™à¸«à¸™à¹‰à¸² à¸«à¸£à¸·à¸­à¸§à¸±à¸™à¹„à¸«à¸™à¹†à¸‚à¸­à¸‡à¹€à¸”à¸·à¸­à¸™ à¸à¸²à¸‡à¹€à¸à¸‡ Knitting Trouser à¸à¹‡à¸ˆà¸°à¸—à¸³à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¸£à¸¹à¹‰à¸ªà¸¶à¸à¸ªà¸šà¸²à¸¢à¹à¸¥à¸°à¸¡à¸±à¹ˆà¸™à¹ƒà¸ˆà¸•à¸¥à¸­à¸”à¹€à¸§à¸¥à¸²à¸—à¸µà¹ˆà¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆ à¸­à¸¢à¹ˆà¸²à¸‡à¸—à¸µà¹ˆà¹„à¸¡à¹ˆà¹€à¸„à¸¢à¹€à¸›à¹‡à¸™à¸¡à¸²à¸à¹ˆà¸­à¸™</span></p>', 800, 8, 80, '10-1.png,10-2.png'),
(11, 'à¸à¸£à¸°à¹€à¸›à¹‹à¸² Flower Bag', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸à¸£à¸°à¹€à¸›à¹‹à¸² Flower Bag à¸™à¸­à¸à¸ˆà¸²à¸à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹à¸šà¸à¸£à¸±à¸šà¸ªà¸±à¸¡à¸ à¸²à¸£à¸°à¸‚à¸­à¸‡à¸„à¸¸à¸“à¹€à¸­à¸²à¹„à¸§à¹‰à¹à¸¥à¹‰à¸§ à¸”à¸­à¸à¹„à¸¡à¹‰à¸«à¸¥à¸²à¸à¸«à¸¥à¸²à¸¢à¸ªà¸µà¸ªà¸±à¸™à¸šà¸™à¸•à¸±à¸§à¸à¸£à¸°à¹€à¸›à¹‹à¸²à¸¢à¸±à¸‡à¸Šà¹ˆà¸§à¸¢à¹€à¸žà¸´à¹ˆà¸¡à¸„à¸§à¸²à¸¡à¹‚à¸”à¸”à¹€à¸”à¹ˆà¸™ à¸šà¹ˆà¸‡à¸šà¸­à¸à¸–à¸¶à¸‡à¸£à¸ªà¸™à¸´à¸¢à¸¡à¸­à¸¢à¹ˆà¸²à¸‡à¸¡à¸µà¸£à¸°à¸”à¸±à¸šà¹ƒà¸™à¸•à¸±à¸§à¸„à¸¸à¸“ à¹€à¸›à¹‡à¸™à¸„à¸§à¸²à¸¡à¸ªà¸§à¸¢à¸‡à¸²à¸¡à¸—à¸µà¹ˆà¸¡à¸²à¸žà¸£à¹‰à¸­à¸¡à¸à¸±à¸šà¸„à¸¸à¸“à¸›à¸£à¸°à¹‚à¸¢à¸Šà¸™à¹Œà¸­à¸±à¸™à¸¡à¸µà¸„à¸¸à¸“à¸„à¹ˆà¸²à¸—à¸µà¹ˆà¸„à¸¸à¸“à¸„à¸¹à¹ˆà¸„à¸§à¸£</span></p>', 750, 7, 75, '11-1.png,11-2.png,11-3.png'),
(12, 'à¸Šà¸¸à¸”à¸ªà¸²à¸§à¹€à¸‹à¹‡à¸à¸‹à¸µà¹ˆ', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸ªà¸³à¸«à¸£à¸±à¸šà¸ªà¸²à¸§à¹†à¸‚à¸µà¹‰à¸£à¹‰à¸­à¸™à¸—à¸µà¹ˆà¸•à¹‰à¸­à¸‡à¸à¸²à¸£à¹‚à¸Šà¸§à¹Œà¸„à¸§à¸²à¸¡à¹€à¸‹à¹‡à¸à¸‹à¸µà¹ˆà¸žà¸­à¸›à¸£à¸°à¸¡à¸²à¸“ à¹ƒà¸ªà¹ˆà¹à¸¥à¹‰à¸§à¸”à¸¹à¹‚à¸”à¸”à¹€à¸”à¹ˆà¸™à¸ªà¸²à¸¡à¸²à¸£à¸–à¸ªà¸°à¸à¸”à¸—à¸¸à¸à¸ªà¸²à¸¢à¸•à¸²à¹ƒà¸«à¹‰à¸«à¸±à¸™à¸¡à¸²à¸¡à¸­à¸‡à¸„à¸¸à¸“ à¸œà¸¥à¸´à¸•à¸ˆà¸²à¸à¹€à¸™à¸·à¹‰à¸­à¸œà¹‰à¸²à¹€à¸à¸£à¸”à¹€à¸­ à¹ƒà¸ªà¹ˆà¹à¸¥à¹‰à¸§à¸£à¸±à¸šà¸£à¸­à¸‡à¸§à¹ˆà¸²à¹„à¸¡à¹ˆà¹€à¸à¸´à¸”à¸­à¸²à¸à¸²à¸£à¸„à¸±à¸™!</span></p>', 1500, 15, 50, '12-1.png,12-2.png'),
(13, 'à¸à¸²à¸‡à¹€à¸à¸‡à¸§à¹ˆà¸²à¸¢à¸™à¹‰à¸³à¸Šà¸²à¸¢ Swimmen', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸ªà¸³à¸«à¸£à¸±à¸šà¸—à¹ˆà¸²à¸™à¸Šà¸²à¸¢à¸—à¸µà¹ˆà¸•à¹‰à¸­à¸‡à¸à¸²à¸£à¸à¸²à¸‡à¹€à¸à¸‡à¸§à¹ˆà¸²à¸¢à¸™à¹‰à¸³à¸—à¸µà¹ˆà¸¡à¸µà¸„à¸¸à¸“à¸ à¸²à¸žà¹€à¸«à¸™à¸·à¸­à¸£à¸²à¸„à¸² à¹€à¸£à¸²à¸‚à¸­à¹à¸™à¸°à¸™à¸³à¸à¸²à¸‡à¹€à¸à¸‡ Swimmen à¸”à¹‰à¸§à¸¢à¸„à¸¸à¸“à¸ªà¸¡à¸šà¸±à¸•à¸´à¸žà¸´à¹€à¸¨à¸©à¸‚à¸­à¸‡ Swimmen à¸ˆà¸°à¸Šà¹ˆà¸§à¸¢à¹ƒà¸«à¹‰à¸—à¹ˆà¸²à¸™à¸§à¹ˆà¸²à¸¢à¸™à¹‰à¸³à¹„à¸”à¹‰à¸­à¸¢à¹ˆà¸²à¸‡à¸„à¸¥à¹ˆà¸­à¸‡à¹à¸„à¸¥à¹ˆà¸§ à¸§à¹ˆà¸­à¸‡à¹„à¸§ à¸à¸§à¹ˆà¸²à¸à¸²à¸‡à¹€à¸à¸‡à¸—à¸±à¹ˆà¸§à¹„à¸›à¸–à¸¶à¸‡ 50% </span></p>', 599, 9, 60, '13-1.png,13-2.png'),
(14, 'à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸à¸µà¸¬à¸² à¸™à¸²à¸¢à¸à¸µà¹‰ NKX', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸£à¸­à¸‡à¹€à¸—à¹‰à¸²à¸ªà¸³à¸«à¸£à¸±à¸šà¸ªà¸§à¸¡à¹ƒà¸ªà¹ˆà¸‚à¸“à¸°à¹€à¸¥à¹ˆà¸™à¸à¸µà¸¬à¸² à¸žà¸·à¹‰à¸™à¸™à¸´à¹ˆà¸¡ à¹„à¸¡à¹ˆà¸›à¸§à¸”à¹€à¸¡à¸·à¹ˆà¸­à¸¢à¸‚à¹‰à¸­à¹€à¸—à¹‰à¸² à¸—à¸™à¸—à¸²à¸™à¸•à¹ˆà¸­à¸—à¸¸à¸à¸ªà¸ à¸²à¸žà¸žà¸·à¹‰à¸™à¸œà¸´à¸§ à¸£à¸­à¸‡à¸£à¸±à¸šà¸™à¹‰à¸³à¸«à¸™à¸±à¸à¹„à¸”à¹‰à¸–à¸¶à¸‡ 200 à¸à¸´à¹‚à¸¥à¸à¸£à¸±à¸¡</span></p>', 1200, 12, 100, '14-1.png'),
(15, 'à¸à¸²à¸‡à¹€à¸à¸‡ Bermuda', '<p><span style=\"display: inline !important; float: none; background-color: transparent; color: rgb(44, 67, 89); font-family: Tahoma; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;\">à¸à¸²à¸‡à¹€à¸à¸‡à¸ªà¹„à¸•à¸¥à¹Œà¹€à¸šà¸­à¸£à¹Œà¸¡à¸´à¸§à¸”à¹‰à¸² à¹ƒà¸«à¹‰à¸„à¸§à¸²à¸¡à¸£à¸¹à¹‰à¸ªà¸¶à¸à¸›à¸¥à¸­à¸”à¹‚à¸›à¸£à¹ˆà¸‡à¹‚à¸¥à¹ˆà¸‡à¸ªà¸šà¸²à¸¢à¹€à¸«à¸¡à¸·à¸­à¸™à¸­à¸¢à¸¹à¹ˆà¸šà¸™à¹€à¸à¸²à¸°à¸à¸¥à¸²à¸‡à¸—à¸°à¹€à¸¥ à¸—à¸µà¹ˆà¹‚à¸­à¸šà¸¥à¹‰à¸­à¸¡à¹„à¸›à¸”à¹‰à¸§à¸¢à¸—à¹‰à¸­à¸‡à¸Ÿà¹‰à¸²à¹à¸¥à¸°à¸œà¸·à¸™à¸™à¹‰à¸³à¸­à¸±à¸™à¸à¸§à¹‰à¸²à¸‡à¹„à¸à¸¥ à¸ˆà¸™à¸­à¸¢à¸²à¸à¹ƒà¸ªà¹ˆà¸à¸²à¸‡à¹€à¸à¸‡à¸•à¸±à¸§à¸™à¸µà¹‰à¹„à¸›à¹à¸•à¸°à¸‚à¸­à¸šà¸Ÿà¹‰à¸²</span></p>', 650, 0, 60, '15-1.png,15-2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`member_id`,`product_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
