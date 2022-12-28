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
-- Database: `pmdb_score_ball`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `match_date` date NOT NULL,
  `team1` varchar(150) NOT NULL,
  `team2` varchar(150) NOT NULL,
  `team1_goals` tinyint(3) NOT NULL,
  `team2_goals` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `match_date`, `team1`, `team2`, `team1_goals`, `team2_goals`) VALUES
(1, '2019-12-30', 'à¸­à¸²à¸£à¹Œà¹€à¸‹à¸™à¸­à¸¥', 'à¹€à¸Šà¸¥à¸‹à¸µ', 2, 2),
(2, '2019-12-30', 'à¸ªà¹€à¸›à¸­à¸£à¹Œ', 'à¹à¸¡à¸™à¸‹à¸´à¸•à¸µà¹‰', 4, 3),
(3, '2019-12-30', 'à¸šà¸²à¹€à¸¥à¸™à¹€à¸‹à¸µà¸¢', 'à¹à¸­à¸•à¹€à¸¥à¸•à¸´à¹‚à¸ à¸¡à¸²à¸”à¸£à¸´à¸”', 1, 3),
(4, '2019-12-30', 'à¹‚à¸£à¸¡à¸²', 'à¸›à¸²à¸£à¹Œà¸¡à¸²', 5, 0),
(5, '2019-12-31', 'à¸”à¸­à¸£à¹Œà¸—à¸¡à¸¸à¸™à¸”à¹Œ', 'à¸Šà¸²à¸¥à¹€à¸', 10, 5),
(6, '2019-12-31', 'à¸­à¸´à¸™à¹€à¸•à¸­à¸£à¹Œà¸¡à¸´à¸¥à¸²à¸™', 'à¸™à¸²à¹‚à¸›à¸¥à¸µ', 0, 0),
(7, '2020-01-01', 'à¸šà¸²à¸£à¹Œà¹€à¸¢à¸´à¸™', 'à¹„à¸¥à¸›à¹Œà¸‹à¸´à¸', -1, -1),
(8, '2020-01-01', 'à¸¢à¸¹à¹€à¸§à¸™à¸•à¸¸à¸ª', 'à¸¡à¸´à¸¥à¸²à¸™', -1, -1),
(9, '2020-01-01', 'à¸šà¸²à¸£à¹Œà¸‹à¸²', 'à¹€à¸£à¸­à¸±à¸¥à¸¡à¸²à¸”à¸£à¸´à¸”', -1, -1),
(10, '2020-01-01', 'à¸¥à¸´à¹€à¸§à¸­à¸£à¹Œà¸žà¸¹à¸¥', 'à¹à¸¡à¸™à¸¢à¸¹', -1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `logo_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `country`, `logo_file`) VALUES
(1, 'à¸­à¸²à¸£à¹Œà¹€à¸‹à¸™à¸­à¸¥', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '1.png'),
(2, 'à¹€à¸Šà¸¥à¸‹à¸µ', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '2.png'),
(3, 'à¹à¸¡à¸™à¸¢à¸¹', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '3.png'),
(4, 'à¸šà¸²à¸£à¹Œà¸‹à¸²', 'à¸ªà¹€à¸›à¸™', '4.png'),
(5, 'à¹€à¸£à¸­à¸±à¸¥à¸¡à¸²à¸”à¸£à¸´à¸”', 'à¸ªà¹€à¸›à¸™', '5.png'),
(6, 'à¸¥à¸´à¹€à¸§à¸­à¸£à¹Œà¸žà¸¹à¸¥', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '6.png'),
(7, 'à¸ªà¹€à¸›à¸­à¸£à¹Œ', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '7.png'),
(8, 'à¹à¸¡à¸™à¸‹à¸´à¸•à¸µà¹‰', 'à¸­à¸±à¸‡à¸à¸¤à¸©', '8.png'),
(9, 'à¸šà¸²à¹€à¸¥à¸™à¹€à¸‹à¸µà¸¢', 'à¸ªà¹€à¸›à¸™', '9.png'),
(10, 'à¹€à¸‹à¸šà¸µà¸¢à¸²', 'à¸ªà¹€à¸›à¸™', '10.png'),
(11, 'à¹à¸­à¸•à¹€à¸¥à¸•à¸´à¹‚à¸ à¸¡à¸²à¸”à¸£à¸´à¸”', 'à¸ªà¹€à¸›à¸™', '11.png'),
(12, 'à¸¢à¸¹à¹€à¸§à¸™à¸•à¸¸à¸ª', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '12.png'),
(13, 'à¸™à¸²à¹‚à¸›à¸¥à¸µ', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '13.png'),
(14, 'à¹‚à¸£à¸¡à¸²', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '14.png'),
(15, 'à¸¡à¸´à¸¥à¸²à¸™', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '15.png'),
(16, 'à¸¥à¸²à¸‹à¸´à¹‚à¸­', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '16.png'),
(17, 'à¸­à¸´à¸™à¹€à¸•à¸­à¸£à¹Œà¸¡à¸´à¸¥à¸²à¸™', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '17.png'),
(18, 'à¸›à¸²à¸£à¹Œà¸¡à¸²', 'à¸­à¸´à¸•à¸²à¸¥à¸µ', '18.png'),
(19, 'à¸šà¸²à¸£à¹Œà¹€à¸¢à¸´à¸™', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '19.png'),
(20, 'à¸”à¸­à¸£à¹Œà¸—à¸¡à¸¸à¸™à¸”à¹Œ', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '20.png'),
(21, 'à¹„à¸¥à¸›à¹Œà¸‹à¸´à¸', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '21.png'),
(22, 'à¹€à¸¥à¹€à¸§à¸­à¸£à¹Œà¸„à¸¹à¹€à¸‹à¹ˆà¸™', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '22.png'),
(23, 'à¸Šà¸²à¸¥à¹€à¸', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '23.png'),
(24, 'à¸®à¸±à¸™à¹‚à¸™à¹€à¸§à¸­à¸£à¹Œ', 'à¹€à¸¢à¸­à¸£à¸¡à¸±à¸™', '24.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
