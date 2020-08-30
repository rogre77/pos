-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 09:51 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `pcode` varchar(15) NOT NULL,
  `pdesc` varchar(100) NOT NULL,
  `unitprice` decimal(12,2) NOT NULL,
  `bulkprice` decimal(12,2) NOT NULL,
  `bulkqty` int(10) NOT NULL,
  `instock` int(12) NOT NULL,
  `category_id` int(10) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pcode`, `pdesc`, `unitprice`, `bulkprice`, `bulkqty`, `instock`, `category_id`, `brand`, `created`) VALUES
(1, 'A', 'Apple', '1.25', '3.00', 3, 99, 1, 'Brand of apples', '2020-08-19 00:00:00'),
(3, 'B', 'Banana', '4.25', '0.00', 0, 99, 1, 'Brand of bananas', '2020-08-19 00:00:00'),
(4, 'C', 'Chocolate Milk', '1.00', '5.00', 6, 9999, 2, 'Meadow Fresh', '2020-08-26 00:00:00'),
(5, 'D', 'Pen', '0.75', '0.00', 0, 10001, 4, 'BIC', '2020-08-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shopcart`
--

CREATE TABLE `shopcart` (
  `pcode` varchar(15) NOT NULL,
  `pdesc` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `unitprice` decimal(12,2) NOT NULL,
  `bulkprice` decimal(12,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `bulk_quantity` int(10) NOT NULL,
  `unit_total_amt` decimal(12,2) NOT NULL,
  `bulk_total_amt` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopcart`
--

INSERT INTO `shopcart` (`pcode`, `pdesc`, `brand`, `category_id`, `unitprice`, `bulkprice`, `quantity`, `bulk_quantity`, `unit_total_amt`, `bulk_total_amt`) VALUES
('A', 'Apple', 'Brand of apples', '1', '1.25', '3.00', 2, 3, '2.50', '0.00'),
('B', 'Banana', 'Brand of bananas', '1', '4.25', '0.00', 1, 0, '4.25', '0.00'),
('C', 'Chocolate Milk', 'Meadow Fresh', '2', '1.00', '5.00', 2, 6, '2.00', '0.00'),
('D', 'Pen', 'BIC', '4', '0.75', '0.00', 1, 0, '0.75', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pcode` (`pcode`);

--
-- Indexes for table `shopcart`
--
ALTER TABLE `shopcart`
  ADD PRIMARY KEY (`pcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
