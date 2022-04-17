-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 12:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buddies`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `accessory_name` varchar(50) NOT NULL,
  `accessory_for` varchar(30) NOT NULL,
  `accessory_desc` varchar(300) NOT NULL,
  `accessory_price` varchar(30) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `accessory_name`, `accessory_for`, `accessory_desc`, `accessory_price`, `image`) VALUES
(2, 'Food', 'cat', 'bohot hard', '200', 'uploads/accessories/1582594300_file-20191114-26207-lray93.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_password`, `image`) VALUES
(1, 'Rakesh', 'rakesh@gmail.com', '123456', '');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = "Pet", 1 = "Accessory"',
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = "placed", 1 = "accepted", 2 = "dispatched", 3 = "cancelled", 4 = "received"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `address`, `date`, `status`) VALUES
(20, 8, 4, 'Rm no 202, Sadguru Nagar, Diva East, Mumbai, India, 400612', '2020-03-04 09:17:26', 4),
(23, 9, 4, 'Rm no 202, Sadguru Nagar, Diva East, Mumbai, India, 400612', '2020-03-04 09:17:26', 0),
(24, 6, 3, 'Rm no 202, Sadguru Nagar, Diva East, Mumbai, India, 400612', '2020-03-04 09:17:26', 4),
(29, 6, 4, 'Rm no 202, Sadguru Nagar, Diva East, Mumbai, India, 400612', '2020-03-05 11:58:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = "Pet", 1 = "Accessory"',
  `product_name` varchar(100) NOT NULL,
  `product_details` varchar(300) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `product_name`, `product_details`, `product_price`, `image`) VALUES
(6, 0, 'pet1', 'pet desc1', '500', 'uploads/1582860842_67586673.jpg'),
(7, 0, 'pet2', 'cute cat', '1000', 'uploads/1582860886_cat-pet-animal-domestic-104827.jpeg'),
(8, 0, 'pet3', 'bohot gussa', '700', 'uploads/1582860923_file-20191114-26207-lray93.jpg'),
(9, 1, 'accessory1', 'accs desc1', '200', 'uploads/accessories/1582861103_logo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `address`, `image`) VALUES
(3, 'Rakesh', 'Panigrahy', 'panigrahyrakesh143@gmail.com', '123456', '9769907119', 'Rm no 202, sadguru ngr, Diva east', ''),
(4, 'Anil', 'Mehta', 'test@gmail.com', '123456', '7718050901', 'Test 234, test nagar, Dombivli North, 400623', 'admin/uploads/profiles/1582817356_pic1.jpg'),
(5, 'Avaneesh', 'Tiwari', 'avaneesh@gmail.com', '123456', '1234567890', 'Rm no 100, Test nagar, Test, 400624', 'admin/uploads/profiles/1583167568_67586673.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
