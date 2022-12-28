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
-- Database: `pmdb_jobs_resume`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `apply_for_positions` text NOT NULL,
  `resume_file` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `firstname`, `lastname`, `apply_for_positions`, `resume_file`) VALUES
(4, 'à¸¡à¸µà¸™à¸²', 'à¹€à¸¡à¸©à¸²', 'à¸šà¸±à¸à¸Šà¸µ:::à¸à¸²à¸£à¸•à¸¥à¸²à¸”', '4.pdf'),
(5, 'à¸ªà¸´à¸‡à¸«à¸²', 'à¸à¸±à¸™à¸¢à¸²', 'à¹‚à¸›à¸£à¹à¸à¸£à¸¡à¹€à¸¡à¸­à¸£à¹Œ', '5.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `position` varchar(150) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `qualifications` text NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `position`, `quantity`, `description`, `qualifications`, `date_posted`) VALUES
(1, 'à¹‚à¸›à¸£à¹à¸à¸£à¸¡à¹€à¸¡à¸­à¸£à¹Œ', '3', 'à¸žà¸±à¸’à¸™à¸²à¹à¸­à¸› Web App à¹à¸¥à¸° Mobile App', 'à¹€à¸žà¸¨à¸Šà¸²à¸¢à¸«à¸£à¸·à¸­à¸«à¸à¸´à¸‡ à¸­à¸²à¸¢à¸¸ 25 à¸›à¸µà¸‚à¸¶à¹‰à¸™à¹„à¸›:::à¸ªà¸²à¸¡à¸²à¸£à¸–à¸žà¸±à¸’à¸™à¸² Web App à¸”à¹‰à¸§à¸¢ PHP, Bootstrap, JavaScript, jQuery, HTML5, CSS3 à¹à¸¥à¸°à¸­à¸·à¹ˆà¸™à¹† à¸—à¸µà¹ˆà¹€à¸à¸µà¹ˆà¸¢à¸§à¸‚à¹‰à¸­à¸‡:::à¸ªà¸²à¸¡à¸²à¸£à¸–à¸žà¸±à¸’à¸™à¸² Native Mobile App à¸šà¸™à¸£à¸°à¸šà¸š Android à¸”à¹‰à¸§à¸¢ Java à¹à¸¥à¸°/à¸«à¸£à¸·à¸­ Kotlin:::à¸ªà¸²à¸¡à¸²à¸£à¸–à¸žà¸±à¸’à¸™à¸² Native Mobile App à¸šà¸™à¸£à¸°à¸šà¸š iOS à¸”à¹‰à¸§à¸¢à¸ à¸²à¸©à¸² Swift:::à¸›à¸£à¸°à¸ªà¸šà¸à¸²à¸£à¸“à¹Œà¸—à¸³à¸‡à¸²à¸™ 2 - 3 à¸›à¸µà¸‚à¸¶à¹‰à¸™à¹„à¸›', '2019-03-31'),
(2, 'à¸šà¸±à¸à¸Šà¸µ', '2', 'à¸£à¸±à¸šà¸œà¸´à¸”à¸Šà¸­à¸šà¸‡à¸²à¸™à¸”à¹‰à¸²à¸™à¸šà¸±à¸à¸Šà¸µà¸‚à¸­à¸‡à¸šà¸£à¸´à¸©à¸±à¸—', 'à¹€à¸žà¸¨à¸«à¸à¸´à¸‡ à¸­à¸²à¸¢à¸¸ 25 à¸›à¸µà¸‚à¸¶à¹‰à¸™à¹„à¸›:::à¸›à¸£à¸´à¸à¸²à¸•à¸£à¸µ-à¹‚à¸— à¸ªà¸²à¸‚à¸²à¸šà¸±à¸à¸Šà¸µ:::à¸¡à¸µà¸›à¸£à¸°à¸ªà¸šà¸à¸²à¸£à¸“à¹Œà¸”à¹‰à¸²à¸™à¸šà¸±à¸à¸Šà¸µ 3 à¸›à¸µà¸‚à¸¶à¹‰à¸™à¹„à¸›:::à¸ªà¸²à¸¡à¸²à¸£à¸–à¸—à¸³à¸‡à¸²à¸™à¸¥à¹ˆà¸§à¸‡à¹€à¸§à¸¥à¸²à¹„à¸”à¹‰', '2019-03-31'),
(3, 'à¸à¸²à¸£à¸•à¸¥à¸²à¸”', 'à¸«à¸¥à¸²à¸¢à¸­à¸±à¸•à¸£à¸²', 'à¸£à¸±à¸šà¸œà¸´à¸”à¸Šà¸­à¸šà¸‡à¸²à¸™à¸”à¹‰à¸²à¸™à¸à¸²à¸£à¸‚à¸²à¸¢ à¹à¸¥à¸°à¸à¸²à¸£à¸•à¸¥à¸²à¸”', 'à¹„à¸¡à¹ˆà¸ˆà¸³à¸à¸±à¸”à¹€à¸žà¸¨ à¸­à¸²à¸¢à¸¸ 20 à¸›à¸µà¸‚à¸¶à¹‰à¸™à¹„à¸›:::à¸§à¸¸à¸’à¸´ à¸›à¸§à¸ª. - à¸›à¸£à¸´à¸à¸à¸²à¸•à¸£à¸µà¸—à¸¸à¸à¸ªà¸²à¸‚à¸²:::à¸¡à¸µà¸›à¸£à¸°à¸ªà¸šà¸à¸²à¸£à¸“à¹Œà¸‚à¸²à¸¢ 1 - 5 à¸›à¸µ:::à¸«à¸²à¸à¸¡à¸µà¸£à¸–à¸¢à¸™à¸•à¹Œà¸ªà¹ˆà¸§à¸™à¸•à¸±à¸§à¸žà¸£à¹‰à¸­à¸¡à¹ƒà¸šà¸‚à¸±à¸šà¸‚à¸µà¹ˆ à¸ˆà¸°à¸žà¸´à¸ˆà¸²à¸£à¸“à¸²à¹€à¸›à¹‡à¸™à¸žà¸´à¹€à¸¨à¸©', '2019-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
