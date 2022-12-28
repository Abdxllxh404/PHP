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
-- Database: `pmdb_car_at_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_advert`
--

CREATE TABLE `car_advert` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `seller_id` mediumint(9) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `engine` smallint(5) UNSIGNED NOT NULL,
  `color` varchar(100) NOT NULL,
  `transmission` varchar(100) NOT NULL,
  `more_options` text NOT NULL,
  `registration` varchar(100) NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `advert_text` text NOT NULL,
  `date_posted` date NOT NULL,
  `img_files` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_advert`
--

INSERT INTO `car_advert` (`id`, `seller_id`, `brand_name`, `model`, `year`, `engine`, `color`, `transmission`, `more_options`, `registration`, `price`, `advert_text`, `date_posted`, `img_files`) VALUES
(1, 1, 'Honda', 'CR-V', 2019, 2400, 'à¹€à¸‡à¸´à¸™', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸„à¸£à¸šà¸—à¸±à¹‰à¸‡à¸«à¸¡à¸”', '', 1300000, 'à¸ªà¸ à¸²à¸ž 99.99% à¸§à¸´à¹ˆà¸‡à¹€à¸žà¸µà¸¢à¸‡ 1000 à¸à¸´à¹‚à¸¥ ', '2019-05-19', '1-1.jpg,1-2.jpg,1-3.jpg,1-4.jpg'),
(2, 1, 'Toyota', 'Fortuner', 2018, 2800, 'à¸™à¹‰à¸³à¸•à¸²à¸¥', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸–à¸¸à¸‡à¸¥à¸¡à¸£à¸­à¸šà¸„à¸±à¸™, ABS, à¹„à¸Ÿà¸•à¸±à¸”à¸«à¸¡à¸­à¸, à¸¯à¸¥à¸¯', '', 1200000, 'à¸ªà¸ à¸²à¸žà¹€à¸«à¸¡à¸·à¸­à¸™à¹ƒà¸«à¸¡à¹ˆ à¸¥à¹‰à¸²à¸‡à¹€à¸à¸·à¸­à¸šà¸—à¸¸à¸à¸§à¸±à¸™ à¸£à¸±à¸à¸¢à¸´à¹ˆà¸‡à¸à¸§à¹ˆà¸²à¸¥à¸¹à¸à¹à¸¥à¸°à¹€à¸¡à¸µà¸¢ à¸£à¸²à¸„à¸²à¸•à¹ˆà¸­à¸£à¸­à¸‡à¹„à¸”à¹‰', '2019-05-19', '2-1.jpg,2-2.jpg,2-3.jpg'),
(3, 2, 'Toyota', 'Yaris', 2019, 1200, 'à¹à¸”à¸‡', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´ CVT', 'à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸„à¸£à¸š', '', 555555, 'à¹„à¸¡à¹ˆà¸‹à¸·à¹‰à¸­à¸–à¸·à¸­à¸§à¹ˆà¸²à¸žà¸¥à¸²à¸”', '2019-05-19', '3-1.jpg,3-2.png,3-3.png,3-4.png'),
(4, 3, 'Honda', 'City', 2017, 1500, 'à¹€à¸‡à¸´à¸™', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸¯à¸¥à¸¯', '', 650000, 'à¹„à¸¡à¹ˆà¹€à¸„à¸¢à¸Šà¸™ à¹„à¸¡à¹ˆà¹€à¸„à¸¢à¸‹à¹ˆà¸­à¸¡ à¹„à¸¡à¹ˆà¹€à¸„à¸¢à¹€à¸„à¸¥à¸¡ à¹„à¸¡à¹ˆà¹€à¸„à¸¢...', '2019-05-19', '4-1.jpg,4-2.jpg,4-3.jpg,4-4.jpg'),
(5, 4, 'Toyota', 'Corolla Altis', 2018, 1800, 'à¸™à¹‰à¸³à¸•à¸²à¸¥', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸¡à¸²à¸£à¸à¸²à¸™à¸„à¸£à¸šà¸—à¸±à¹‰à¸‡à¸«à¸¡à¸”', '', 750000, 'à¸ªà¸§à¸¢à¸à¸§à¹ˆà¸²à¸™à¸²à¸‡à¸Ÿà¹‰à¸² à¹„à¸¡à¹ˆà¹€à¸„à¸¢à¹€à¸à¸´à¸”à¸­à¸¸à¸šà¸±à¸•à¸´à¹€à¸«à¸•', '2019-05-19', '5-1.jpg,5-2.jpg,5-3.jpg,5-4.jpg'),
(6, 3, 'Toyota', 'Fortuner', 2018, 2400, 'à¸”à¸³', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸„à¸£à¸šà¸£à¸­à¸šà¸„à¸±à¸™', '', 1000000, 'à¸ªà¸§à¸¢à¹„à¸£à¹‰à¸—à¸µà¹ˆà¸•à¸´ à¹„à¸¡à¹ˆà¹€à¸„à¸¢à¸‹à¹ˆà¸­à¸¡ à¸ªà¸ à¸²à¸žà¹€à¸”à¸´à¸¡à¹†', '2019-05-19', '6-1.jpg,6-2.jpg,6-3.jpg'),
(7, 5, 'Honda', 'Civic', 2019, 1800, 'à¹à¸”à¸‡', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸–à¸¸à¸‡à¸¥à¸¡, à¹„à¸Ÿà¸•à¸±à¸”à¸«à¸¡à¸­à¸, à¸¯à¸¥à¸¯', '', 890000, 'à¸£à¸µà¸šà¹€à¸¥à¸¢ à¸”à¸µà¸à¸§à¹ˆà¸²à¸™à¸µà¹‰à¹„à¸¡à¹ˆà¸¡à¸µà¸­à¸µà¸à¹à¸¥à¹‰à¸§ à¸£à¸²à¸„à¸²à¸„à¸¸à¸¢à¸à¸±à¸™à¹„à¸”à¹‰', '2019-05-19', '7-1.jpg,7-2.jpg,7-3.jpg'),
(8, 6, 'Toyota', 'Camry', 2018, 2500, 'à¸”à¸³', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸­à¸¸à¸›à¸à¸£à¸“à¹Œà¸„à¸£à¸šà¸£à¸­à¸šà¸„à¸±à¸™', '', 1234000, 'à¸£à¸–à¸ªà¸§à¸¢à¸—à¸µà¹ˆà¸ªà¸¸à¸”à¹ƒà¸™à¸£à¸¸à¹ˆà¸™ à¸•à¹‰à¸­à¸‡à¸à¸²à¸£à¸‚à¸²à¸¢à¸”à¹ˆà¸§à¸™ à¸£à¸²à¸„à¸²à¸•à¹ˆà¸­à¸£à¸­à¸‡à¹„à¸”à¹‰', '2019-05-20', '8-1.jpg,8-2.jpg,8-3.jpg'),
(9, 7, 'Honda', 'CR-V', 2018, 2400, 'à¹€à¸‚à¸µà¸¢à¸§', 'à¸­à¸±à¸•à¹‚à¸™à¸¡à¸±à¸•à¸´', 'à¸–à¸¸à¸‡à¸¥à¸¡à¸£à¸­à¸šà¸„à¸±à¸™, à¹„à¸Ÿà¸•à¸±à¸”à¸«à¸¡à¸­à¸, à¹€à¸šà¸£à¸„ ABS à¸¯à¸¥à¸¯', '', 1200000, 'à¸ªà¸ à¸²à¸žà¹€à¸à¸·à¸­à¸š 100% à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¸™à¹‰à¸­à¸¢à¸¡à¸²à¸ à¸‚à¸²à¸¢à¸–à¸¹à¸à¹€à¸«à¸¡à¸·à¸­à¸™à¹„à¸”à¹‰à¹€à¸›à¸¥à¹ˆà¸²', '2019-05-20', '9-1.jpg,9-2.jpg,9-3.jpg,9-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_brand`
--

CREATE TABLE `car_brand` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `models` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_brand`
--

INSERT INTO `car_brand` (`id`, `brand_name`, `models`) VALUES
(1, 'BMW', '3 Series,4 Series,5 Series,6 Series,7 Series,8 Series,M Series,X Series'),
(2, 'Benz', 'C Class,E Class,S Class,CLA,CLS,GLA,GLC,GLC'),
(3, 'Honda', 'Accord,Brio,B-RV,City,Civic,CR-V,HR-V,Jazz,Mobilio'),
(4, 'Mazda', 'Mazda2,Mazda3,CX-3,CX-5,BT-50'),
(5, 'Mitshubishi', 'Lancer,Pajero,Triton,Mirage,Attrage,Xpander'),
(6, 'Nissan', 'Almera,Frontier,March,Navara,Note,Sylphy,Terra,Teana,X-Trail,Urvan'),
(7, 'Toyota', 'Avanza,CH-R,Camry,Corolla Altis,Fortuner,Vios,Yaris,Revo,Vigo,Innova,Commutor'),
(8, 'MG', 'MG3,MG5,MG6,MG GS,MG ZS'),
(9, 'Suzuki', 'Ciaz,Swift,Vitara,Ertiga,Caribian'),
(10, 'Isuzu', 'Dragon,D-Max,Mu-X,Mu-7'),
(11, 'Ford', 'Ranger,Focus,Everest,EcoSport,Fiesta,Escape,Escort,Festiva,Mustang'),
(12, 'Chevrolet', 'Corolado,Captiva,Cruze,Trailblazer'),
(13, 'Subaru', 'Forester,Impreza,XV,Legacy'),
(14, 'Land Rover', 'Discovery,Evoque,Range Rover,Freelander');

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
  `phone` varchar(50) NOT NULL,
  `province` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `firstname`, `lastname`, `phone`, `province`) VALUES
(1, 'banchar_pa@yahoo.com', '12345', 'Banchar', 'Developerthai', '099999', 'ï»¿à¸à¸£à¸¸à¸‡à¹€à¸—à¸žà¸¡à¸«à¸²à¸™à¸„à¸£\r\n'),
(2, 'onetwothree@example.com', '123', 'à¸«à¸™à¸¶à¹ˆà¸‡', 'à¸ªà¸­à¸‡à¸ªà¸²à¸¡', '012345xxxx', 'à¸™à¸„à¸£à¸£à¸²à¸Šà¸ªà¸µà¸¡à¸²\r\n'),
(3, 'elon@musk.com', 'elon', 'Elon', 'Musk', '08811122xx', 'ï»¿à¸à¸£à¸¸à¸‡à¹€à¸—à¸žà¸¡à¸«à¸²à¸™à¸„à¸£'),
(4, 'manee@meena.com', 'manee', 'à¸¡à¸²à¸™à¸µ', 'à¸¡à¸µà¸™à¸²', '09987654xx', 'à¹€à¸Šà¸µà¸¢à¸‡à¹ƒà¸«à¸¡à¹ˆ\r\n'),
(5, 'malee@meela', 'malee', 'à¸¡à¸²à¸¥à¸µ', 'à¸¡à¸µà¸¥à¸²', '0998877xxx', 'à¸ à¸¹à¹€à¸à¹‡à¸•\r\n'),
(6, 'somchai@example.com', 'somchai', 'à¸ªà¸¡à¸Šà¸²à¸¢', 'à¸žà¸²à¸¢à¹€à¸£à¸·à¸­', '08765432xx', 'à¸‚à¸­à¸™à¹à¸à¹ˆà¸™\r\n'),
(7, 'somying@test.com', 'somying', 'à¸ªà¸¡à¸«à¸à¸´à¸‡', 'à¸¢à¸´à¸‡à¹€à¸£à¸·à¸­', '09876543xx', 'à¸Šà¸¥à¸šà¸¸à¸£à¸µ\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_advert`
--
ALTER TABLE `car_advert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_brand`
--
ALTER TABLE `car_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_advert`
--
ALTER TABLE `car_advert`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `car_brand`
--
ALTER TABLE `car_brand`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
