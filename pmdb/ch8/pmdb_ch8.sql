-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 08:58 AM
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
-- Database: `pmdb_ch8`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'female',
  `position` varchar(30) NOT NULL,
  `salary` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `gender`, `position`, `salary`, `email`, `birthday`) VALUES
(1, 'John', 'male', 'Manager', 50000, 'john@hotmail.com', '1980-10-20'),
(2, 'Jane', 'female', 'Accountant', 30000, 'jane@yahoo.com', '1985-01-31'),
(3, 'Jill', 'female', 'Accountant', 25000, 'jill@example.com', '1988-05-31'),
(4, 'Jack', 'male', 'Sales', 30000, 'jack@test.com', '1990-12-01'),
(5, 'Jenny', 'female', 'Sales', 25000, 'janny@hotmail.com', '1992-02-14'),
(6, 'Jennifer', 'female', 'Secretary', 20000, 'jennifer@gmail.com', '1992-10-01'),
(7, 'Jim', 'male', 'Programmer', 35000, 'jim@yahoo.com', '1980-04-30'),
(8, 'Jason', 'male', 'Programmer', 40000, 'jason@test.com', '2000-10-01'),
(9, 'Joey', 'male', 'engineer', 50000, 'joey@xxx.com', '2002-02-20'),
(10, 'Joey2', 'male', 'Driver', 10000, 'joey2@test.com', '2004-02-20'),
(11, 'Julia', 'female', 'marketing', 20000, 'julia@test.com', '2005-10-10'),
(12, 'Jessie', 'female', 'Accoutant', 40000, 'js@test.com', '2000-10-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
