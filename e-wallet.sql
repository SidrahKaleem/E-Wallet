-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 07:51 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-wallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_record`
--

CREATE TABLE `activation_record` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `activated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation_record`
--

INSERT INTO `activation_record` (`id`, `username`, `date`, `time`, `activated_by`) VALUES
(3, 'saadi', '03-27-16', '22:54:48', 'zeeshan'),
(4, 'shakir', '04-12-16', '16:26:18', 'zeeshan'),
(5, 'ham123', '04-19-16', '01:48:57', 'zeeshan'),
(6, 'saad', '04-19-16', '16:10:08', 'zeeshan'),
(7, 'Sidrah', '10-19-20', '08:59:18', 'accountant');

-- --------------------------------------------------------

--
-- Table structure for table `menu_tb`
--

CREATE TABLE `menu_tb` (
  `item_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_tb`
--

INSERT INTO `menu_tb` (`item_name`, `quantity`, `price`, `category`, `day`, `location`) VALUES
('Aloo Pratha', 'one', 20, 'breakfast', 'Saturday', 'hostel mess'),
('Beef Pulao', 'full plate', 70, 'dinner', 'Monday', 'college mess'),
('biryani', 'full plate', 50, 'lunch', 'Tuesday', 'hostel mess'),
('Chicken koofta', 'full plate', 55, 'lunch', 'Wednesday', 'college mess'),
('chinese rice', 'half plate', 30, 'dinner', 'Wednesday', 'hostel mess'),
('daal', 'half plate', 40, 'lunch', 'Monday', 'college mess'),
('Daal Chawal', 'full plate', 40, 'dinner', 'Monday', 'college mess'),
('Karri Pikora', 'full plate', 40, 'lunch', 'Sunday', 'college mess'),
('matan karahi', 'half plate', 60, 'dinner', 'Friday', 'college mess'),
('Poori Channa', 'full plate', 50, 'breakfast', 'Thursday', 'college mess');

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int(11) NOT NULL,
  `items` varchar(300) NOT NULL,
  `ordered_by` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'notserved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`order_id`, `items`, `ordered_by`, `day`, `date`, `time`, `order_status`) VALUES
(7, 'Poori Channa(2),', 'saadi', 'Thursday', '04-21-16', '05:06:36', 'notserved');

-- --------------------------------------------------------

--
-- Table structure for table `recharge_record`
--

CREATE TABLE `recharge_record` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT '',
  `accountant` varchar(255) NOT NULL,
  `amount_added` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recharge_record`
--

INSERT INTO `recharge_record` (`id`, `username`, `date`, `time`, `accountant`, `amount_added`) VALUES
(11, 'hhassan', '03-17-16', '', 'Zeeshan khan', 3200),
(12, 'ahamza', '03-18-16', '00:39:20', '', 1000),
(13, 'saadi', '03-27-16', '23:04:10', 'zeeshan', 1200),
(14, 'ahamza', '03-28-16', '01:50:14', 'zeeshan', 90),
(15, 'shakir', '04-12-16', '16:26:59', 'zeeshan', 1000),
(16, 'ham123', '04-19-16', '02:52:43', 'zeeshan', 870),
(17, 'ham123', '04-19-16', '02:57:49', 'zeeshan', -1700),
(18, 'ahamza', '04-19-16', '16:08:50', 'zeeshan', 1000),
(19, 'saadi', '04-21-16', '05:09:47', 'zeeshan', 1000),
(20, 'Sidrah', '10-19-20', '09:00:34', 'accountant', 5000),
(21, 'Sidrah', '10-19-20', '10:03:35', 'accountant', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper_tb`
--

CREATE TABLE `shopkeeper_tb` (
  `sk_name` varchar(255) NOT NULL,
  `sk_username` varchar(255) NOT NULL,
  `sk_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `duty_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeeper_tb`
--

INSERT INTO `shopkeeper_tb` (`sk_name`, `sk_username`, `sk_email`, `password`, `duty_area`) VALUES
('Akhtar Rasool', 'akhter', 'akhter@yahoo.com', 'akhter', 'Cafe'),
('Bashir', 'bashir', 'bashirkhan12@gmail.com', '123', 'Mess'),
('hamza', 'hamza', 'hamzasgd35@gmail.com', 'hamza', 'Cafe'),
('shopkeeper', 'shopkeeper', 'shopkeeper@gmail.com', 'shopkeeper', 'Mess');

-- --------------------------------------------------------

--
-- Table structure for table `specialusers`
--

CREATE TABLE `specialusers` (
  `count` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_record`
--

CREATE TABLE `user_record` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `shopkeeper` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_record`
--

INSERT INTO `user_record` (`id`, `username`, `item_name`, `price`, `shopkeeper`, `location`, `date`, `time`) VALUES
(1, 'ahamza', 'coke', 60, 'akhtar rasool', 'college mess', '25/10/2016', '12:20'),
(2, 'hhassan', 'biryani', 60, 'akhtar rasool', 'hostel mess', '15/11/2015', '02:20'),
(3, 'ahamza', 'daal', 40, 'arif khan', 'college mess', '25/12/2011', '10:20'),
(4, 'ahamza', 'Coke,Biryani,Salad', 90, 'hamza', 'college cafe', '03-28-16', '01:48:25'),
(5, 'ahamza', 'qourma', 1000, 'hamza', 'college cafe', '03-28-16', '02:00:45'),
(6, 'ham123', 'daal,rooti,tea', 70, 'shopkeeper', 'college cafe', '04-19-16', '02:50:54'),
(7, 'ahamza', 'chinese rice,coke,raita', 120, 'shopkeeper', 'college cafe', '04-19-16', '16:07:43'),
(8, 'saadi', ',Chicken koofta,chinese rice', 85, 'saadi', 'college cafe', '04-20-16', '02:57:52'),
(9, 'saadi', 'Chicken koofta,chinese rice,', 110, 'saadi', 'college cafe', '04-20-16', '03:00:34'),
(10, 'saadi', 'Chicken koofta,', 110, 'saadi', 'college cafe', '04-20-16', '03:11:23'),
(11, 'saadi', 'Chicken koofta,chinese rice,', 115, 'saadi', 'college cafe', '04-20-16', '03:13:04'),
(12, 'saadi', 'Chicken koofta,chinese rice,', 145, 'saadi', 'college cafe', '04-20-16', '04:13:16'),
(13, 'saadi', 'chinese rice,1', 30, 'saadi', 'college cafe', '04-20-16', '04:19:17'),
(14, 'saadi', 'Chicken koofta(1),', 55, 'saadi', 'college cafe', '04-20-16', '04:20:29'),
(15, 'saadi', 'Chicken koofta(1),chinese rice(2),', 115, 'saadi', 'college cafe', '04-20-16', '04:29:48'),
(16, 'saadi', 'Poori Channa(2),', 100, 'saadi', 'college cafe', '04-21-16', '05:06:36'),
(17, 'Sidrah', 'Biryani', 200, 'bashir', 'college cafe', '10-19-20', '09:11:29'),
(18, 'Sidrah', 'Biryani', 10000, 'shopkeeper', 'college cafe', '10-26-20', '17:41:39'),
(19, 'Sidrah', 'Biryani', 10000, 'shopkeeper', 'college cafe', '10-26-20', '17:44:45'),
(20, 'Sidrah', 'Biryani', 10000, 'shopkeeper', 'college cafe', '10-26-20', '17:45:44'),
(21, 'Sidrah', 'Biryani', 20000, 'shopkeeper', 'college cafe', '10-26-20', '17:47:17'),
(22, 'Sidrah', 'Biryani', 200, 'shopkeeper', 'college cafe', '10-27-20', '11:32:58'),
(23, 'Sidrah', 'Biryani', 100, 'shopkeeper', 'college cafe', '10-27-20', '11:37:53'),
(24, 'Sidrah', 'Biryani', 10000, 'shopkeeper', 'college cafe', '10-27-20', '11:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pin` int(4) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT 'customer',
  `status` varchar(255) NOT NULL DEFAULT 'notactive',
  `balance` int(10) NOT NULL DEFAULT '0',
  `join_date` varchar(255) NOT NULL,
  `picture` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `count` int(30) NOT NULL,
  `rank` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`full_name`, `username`, `email`, `password`, `pin`, `category`, `status`, `balance`, `join_date`, `picture`, `count`, `rank`) VALUES
('Accountant', 'accountant', 'zeeshan@namal.edu.pk', 'accountant', 1111, 'accountant', 'active', 0, '3/17/2016', 'default.jpg', 0, ''),
('Admin', 'admin', 'admin@namal.edu.pk', 'admin', 1111, 'admin', 'active', 0, '03/17/16', 'default.jpg', 0, ''),
('Aman Ullah', 'aman123', 'aman2000@namal.edu.pk', '123', 1111, 'customer', 'notactive', 0, '', 'default.jpg', 0, ''),
('Customer', 'customer', 'ali@gmail.com', 'customer', 1111, 'customer', 'active', 6880, '03-17-16', 'default.jpg', 32000, 'Silver'),
('faculty', 'faculty', 'saad2013@gmail.com', 'faculty', 1111, 'faculty', 'active', 2335, '03-27-16', 'default.jpg', 0, ''),
('hamza', 'ham123', 'hamzasgd35@gmail.com', 'ham123', 1212, 'customer', 'active', 300, '04-19-16', 'IMG_20141106_212321 (2).jpg', 0, ''),
('hammad', 'hhassan', 'hhassan2013@namal.edu.pk', '123', 1111, 'customer', 'active', 4200, '03-17-16', 'default.jpg', 0, ''),
('Saad', 'saad', 'saad2013@gmail.com', '123', 1111, 'customer', 'active', 1000, '04-19-16', 'default.jpg', 0, ''),
('Shakir', 'shakir', 'shakir2013@gmail.com', '123', 1111, 'student', 'active', 2000, '04-12-16', 'default.jpg', 0, ''),
('Sidrah', 'Sidrah', 'sidrahkaleem318@gmail.com', 'sid', 123, 'customer', 'active', 40000, '10-19-20', 'Screenshot (2).png', 31000, 'Silver');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `item` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`item`, `user`) VALUES
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('Poori Channa', 'customer'),
('biryani', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_record`
--
ALTER TABLE `activation_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_tb`
--
ALTER TABLE `menu_tb`
  ADD PRIMARY KEY (`item_name`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `recharge_record`
--
ALTER TABLE `recharge_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopkeeper_tb`
--
ALTER TABLE `shopkeeper_tb`
  ADD PRIMARY KEY (`sk_username`);

--
-- Indexes for table `user_record`
--
ALTER TABLE `user_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_record`
--
ALTER TABLE `activation_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recharge_record`
--
ALTER TABLE `recharge_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_record`
--
ALTER TABLE `user_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
