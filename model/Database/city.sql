-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2016 at 08:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city`
--

-- --------------------------------------------------------

--
-- Table structure for table `_cost`
--

CREATE TABLE `_cost` (
  `cost_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `full_laundry` float NOT NULL,
  `starch_iron` float NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_cost`
--

INSERT INTO `_cost` (`cost_id`, `item_name`, `full_laundry`, `starch_iron`, `category`) VALUES
(1, '2pcs Trouser Suit', 20.8, 11.7, 'Ladies'),
(2, '2pcs Skirt Suit', 15.6, 7.8, 'Ladies'),
(3, 'Jacket', 9.75, 5.2, 'Ladies'),
(4, 'Trousers', 9.1, 6.5, 'Ladies'),
(5, 'Jeans', 7.8, 3.9, 'Ladies'),
(6, 'White Shirt (Office Wear)', 7.15, 5.2, 'Ladies'),
(7, 'Coloured Shirt (Office Wear)', 6.5, 5.2, 'Ladies'),
(8, 'Both Up and Down of all sizes', 13, 9.75, 'Uniform'),
(9, 'Hospital Medical long dress', 13, 9.75, 'Uniform'),
(10, 'White Uniform', 10.4, 7.8, 'Uniform'),
(11, 'Winter Jacket', 39, 23.4, 'Uniform'),
(12, 'Coloured', 9.1, 6.5, 'Uniform'),
(13, 'Payjamas Suit', 7.8, 5.2, 'Uniform'),
(14, 'Brouse', 4.55, 3.25, 'Uniform'),
(15, 'Traditional Long Dress (Linen)', 14.3, 10.4, 'African Wear'),
(16, 'Traditional Dress (Tie and Dye)', 13, 9.1, 'African Wear'),
(17, 'Ladies Caftan (Linen)', 16.9, 11.7, 'African Wear'),
(18, 'Shirt Dress (Waxprint)', 9.1, 6.5, 'African Wear'),
(19, 'kente kaba and Slit (3pcs)', 19.5, 6.5, 'African Wear'),
(20, 'Kente kaba and Slit (2pcs0', 15.6, 6.24, 'African Wear'),
(21, 'kaba 3pcs (Wax Print)', 14.3, 5.85, 'African Wear'),
(22, 'Lond Dress (Sack Linen)', 14.3, 10.4, 'African Wear'),
(23, 'Long Dress (Non Linen Fabric)', 11.7, 7.8, 'African Wear'),
(24, 'Skirt and Top (Native /Local)', 11.7, 9.1, 'African Wear'),
(25, 'Trouser and Top', 15.6, 10.4, 'African Wear'),
(26, 'Agbada 3pcs Traditional', 28.6, 23.4, 'African Wear'),
(27, 'Short T & D (Traditional Wear Caftain)', 13, 7.8, 'African Wear'),
(28, 'Short Dress (Office wear)', 10.4, 6.24, 'African Wear'),
(29, 'Short Dress With Jacket', 15.6, 7.8, 'African Wear'),
(30, 'Suit 2pcs', 26, 18.2, 'Gents'),
(31, 'Suit 3pcs', 28.6, 19.5, 'Gents'),
(32, 'Safari/ Political Suit', 26, 18.2, 'Gents'),
(33, 'Jacket', 16.9, 11.7, 'Gents'),
(34, 'Cloured Shirt (Tie and Dye)', 7.15, 6.5, 'Gents'),
(35, 'White Shirt', 7.15, 5.85, 'Gents'),
(36, 'Linen Shirt (Jorom)', 8.45, 6.5, 'Gents'),
(37, 'Polo Shirt /Lactose', 5.2, 3.9, 'Gents'),
(38, 'T-Shirt and Round Necks', 5.2, 3.9, 'Gents'),
(39, 'Tie Service', 5.2, 3.25, 'Gents'),
(40, 'Trousers', 9.75, 7.8, 'Gents'),
(41, 'Shorts', 4.55, 3.25, 'Gents'),
(42, 'Jeans', 8.45, 4.55, 'Gents'),
(43, 'Sindlet', 3.25, 2.6, 'Gents'),
(44, 'Agbada 2pcs (Caftan)', 19.5, 14.3, 'Men African Wear'),
(45, 'Agbada 3pcs (Caftan)', 39, 28.6, 'Men African Wear'),
(46, 'Linen caftan Slim (T & D)', 19.5, 13, 'Men African Wear'),
(47, 'Linen Caftan Loose (T & D)', 19.5, 13, 'Men African Wear'),
(48, 'Caftan Top Only (Slim Fit)', 10.4, 7.8, 'Men African Wear'),
(49, 'Caftan Top Only Loose Fit', 11.05, 7.8, 'Men African Wear'),
(50, 'Senetor (Nigerian Wear)', 20.8, 15.6, 'Men African Wear'),
(51, 'Cardigan / Sweater', 7.8, 5.2, 'Men African Wear'),
(52, 'Smock', 13, 5.2, 'Men African Wear'),
(53, 'Kente Cloth  (Multi-coloured)', 52, 19.5, 'Men African Wear'),
(54, 'Traditional Cloth (men)', 19.5, 13, 'Men African Wear'),
(55, 'Bed Spread / Duvet', 23.4, 23.4, 'Others'),
(56, 'Bedsheet', 7.15, 3.9, 'Others'),
(57, 'Pillow Case', 1.95, 1.3, 'Others'),
(58, 'Teddy Bear', 9.1, 0, 'Others'),
(59, 'Curtain (Light with Linning)', 9.1, 7.8, 'Others'),
(60, 'Curtain (Heavy with Linning) ', 15.6, 9.1, 'Others'),
(61, 'Curtain  (Heavy without Linning)', 15.6, 9.1, 'Others'),
(62, 'Blanket', 11.7, 7.8, 'Others'),
(63, 'test', 9.1, 8.45, 'Men African Wear'),
(64, 'Fugu', 13, 19.5, 'Gents');

-- --------------------------------------------------------

--
-- Table structure for table `_orders`
--

CREATE TABLE `_orders` (
  `order_id` int(11) NOT NULL,
  `pick_up_day` varchar(10) NOT NULL,
  `delivery_day` varchar(10) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(6) NOT NULL,
  `service` varchar(30) NOT NULL,
  `item_names` varchar(200) NOT NULL,
  `item_quantities` varchar(100) NOT NULL,
  `total_cost` varchar(6) NOT NULL,
  `order_status` enum('In Process','Complete') NOT NULL DEFAULT 'In Process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_orders`
--

INSERT INTO `_orders` (`order_id`, `pick_up_day`, `delivery_day`, `date_posted`, `user_id`, `service`, `item_names`, `item_quantities`, `total_cost`, `order_status`) VALUES
(1, 'Wednesday', 'Saturday', '2016-03-26 16:25:37', 3, 'Pick up & Delivery', 'Jacket, Trousers', '1,2', '5400', 'Complete'),
(2, 'Wednesday', 'Friday', '2016-03-26 16:03:46', 4, 'Delivery', 'Short dress, White Uniform', '4,1', '200', 'Complete'),
(3, 'Monday', 'Friday', '2016-03-26 19:00:00', 4, 'Pick up ', 'Trousers,Shorts,Jeans,', '2,4,5,', '68', 'Complete'),
(4, 'Any Day', 'Wednesday', '2016-03-26 15:58:28', 4, 'Pick up ', 'Payjamas Suit,Ladies Caftan (Linen),Trouser and Top,Long Dress (Non Linen Fabric),', '1,1,2,3,', '76', 'Complete'),
(5, 'Wednesday', 'Saturday', '2016-03-26 19:12:52', 5, 'Pick up ', '2pcs Skirt Suit,Lond Dress (Sack Linen),Shorts,Bed Spread / Duvet,', '5,2,2,2,', '141', 'Complete'),
(6, 'Any Day', 'Any Day', '2016-03-26 19:16:35', 5, 'Pick up ', 'Brouse,Both Up and Down of all sizes,Trousers,', '10,5,2,', '111', 'Complete'),
(7, 'Monday', 'Friday', '2016-03-26 19:22:28', 5, 'Pick up ', 'Brouse,Skirt and Top (Native /Local),Jacket,', '1,2,3,', '76.5', 'In Process'),
(8, 'Monday', 'Wednesday', '2016-03-27 01:41:53', 9, 'Pick up Only', '2pcs Trouser Suit,Jacket,', '1,1,', '28.5', 'Complete'),
(9, 'Wednesday', 'Friday', '2016-03-27 01:44:29', 9, 'Pick up ', 'Payjamas Suit,Brouse,', '5,2,', '45', 'In Process'),
(11, 'Monday', 'Wednesday', '2016-03-29 21:07:15', 10, 'Pick up ', '2pcs Trouser Suit,2pcs Skirt Suit,', '1,1,', '32', 'Complete'),
(13, 'Tuesday', 'Thursday', '2016-03-29 22:25:48', 10, 'Pick up and Delivery', 'Long Dress (Non Linen Fabric),Short Dress (Office wear),', '2,4,', '60', 'In Process'),
(14, 'Tuesday', 'Thursday', '2016-04-09 15:23:59', 11, 'Pick up and Delivery', 'Jacket,White Uniform,Trouser and Top,', '2,1,4,', '79', 'Complete'),
(15, 'Monday', 'Monday', '2016-04-09 15:24:59', 11, 'Pick up and Delivery', 'White Shirt (Office Wear),Coloured Shirt (Office Wear),Trousers,', '5,1,1,', '45.5', 'In Process'),
(16, 'Monday', 'Monday', '2016-05-21 00:18:22', 4, 'Pick up and Delivery', '2pcs Skirt Suit,', '10,', '164', 'Complete'),
(17, 'Monday', 'Thursday', '2016-05-21 19:03:42', 4, 'Express', '2pcs Trouser Suit,', '1,', '31.20', 'In Process'),
(19, 'Monday', 'Thursday', '2016-05-21 22:35:44', 12, 'Express', '2pcs Skirt Suit,Jeans,Jacket,Jacket,', '5,1,1,1,', '216.45', 'In Process'),
(20, 'Tuesday', 'Friday', '2016-05-21 22:36:04', 12, 'Pick up Only', '2pcs Trouser Suit,', '2,', '41.6', 'In Process');

-- --------------------------------------------------------

--
-- Table structure for table `_student`
--

CREATE TABLE `_student` (
  `cost_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `full_laundry` float NOT NULL,
  `starch_iron` float NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_student`
--

INSERT INTO `_student` (`cost_id`, `item_name`, `full_laundry`, `starch_iron`, `category`) VALUES
(1, '2pcs Trouser Suit', 16, 9, 'Ladies'),
(2, '2pcs Skirt Suit', 12, 6, 'Ladies'),
(3, 'Jacket', 7.5, 4, 'Ladies'),
(4, 'Trousers', 7, 5, 'Ladies'),
(5, 'Jeans', 6, 3, 'Ladies'),
(6, 'White Shirt (Office Wear)', 5.5, 4, 'Ladies'),
(7, 'Coloured Shirt (Office Wear)', 5, 4, 'Ladies'),
(8, 'Both Up and Down of all sizes', 10, 7.5, 'Uniform'),
(9, 'Hospital Medical long dress', 10, 7.5, 'Uniform'),
(10, 'White Uniform', 8, 6, 'Uniform'),
(11, 'Winter Jacket', 30, 18, 'Uniform'),
(12, 'Coloured', 7, 5, 'Uniform'),
(13, 'Payjamas Suit', 6, 4, 'Uniform'),
(14, 'Brouse', 3.5, 2.5, 'Uniform'),
(15, 'Traditional Long Dress (Linen)', 11, 8, 'African Wear'),
(16, 'Traditional Dress (Tie and Dye)', 10, 7, 'African Wear'),
(17, 'Ladies Caftan (Linen)', 13, 9, 'African Wear'),
(18, 'Shirt Dress (Waxprint)', 7, 5, 'African Wear'),
(19, 'kente kaba and Slit (3pcs)', 15, 5, 'African Wear'),
(20, 'Kente kaba and Slit (2pcs0', 12, 4.8, 'African Wear'),
(21, 'kaba 3pcs (Wax Print)', 11, 4.5, 'African Wear'),
(22, 'Lond Dress (Sack Linen)', 11, 8, 'African Wear'),
(23, 'Long Dress (Non Linen Fabric)', 9, 6, 'African Wear'),
(24, 'Skirt and Top (Native /Local)', 9, 7, 'African Wear'),
(25, 'Trouser and Top', 12, 8, 'African Wear'),
(26, 'Agbada 3pcs Traditional', 22, 18, 'African Wear'),
(27, 'Short T & D (Traditional Wear Caftain)', 10, 6, 'African Wear'),
(28, 'Short Dress (Office wear)', 8, 4.8, 'African Wear'),
(29, 'Short Dress With Jacket', 12, 6, 'African Wear'),
(30, 'Suit 2pcs', 20, 14, 'Gents'),
(31, 'Suit 3pcs', 22, 15, 'Gents'),
(32, 'Safari/ Political Suit', 20, 14, 'Gents'),
(33, 'Jacket', 13, 9, 'Gents'),
(34, 'Cloured Shirt (Tie and Dye)', 5.5, 5, 'Gents'),
(35, 'White Shirt', 5.5, 4.5, 'Gents'),
(36, 'Linen Shirt (Jorom)', 6.5, 5, 'Gents'),
(37, 'Polo Shirt /Lactose', 4, 3, 'Gents'),
(38, 'T-Shirt and Round Necks', 4, 3, 'Gents'),
(39, 'Tie Service', 4, 2.5, 'Gents'),
(40, 'Trousers', 7.5, 6, 'Gents'),
(41, 'Shorts', 3.5, 2.5, 'Gents'),
(42, 'Jeans', 6.5, 3.5, 'Gents'),
(43, 'Sindlet', 2.5, 2, 'Gents'),
(44, 'Agbada 2pcs (Caftan)', 15, 11, 'Men African Wear'),
(45, 'Agbada 3pcs (Caftan)', 30, 22, 'Men African Wear'),
(46, 'Linen caftan Slim (T & D)', 15, 10, 'Men African Wear'),
(47, 'Linen Caftan Loose (T & D)', 15, 10, 'Men African Wear'),
(48, 'Caftan Top Only (Slim Fit)', 8, 6, 'Men African Wear'),
(49, 'Caftan Top Only Loose Fit', 8.5, 6, 'Men African Wear'),
(50, 'Senetor (Nigerian Wear)', 16, 12, 'Men African Wear'),
(51, 'Cardigan / Sweater', 6, 4, 'Men African Wear'),
(52, 'Smock', 10, 4, 'Men African Wear'),
(53, 'Kente Cloth  (Multi-coloured)', 40, 15, 'Men African Wear'),
(54, 'Traditional Cloth (men)', 15, 10, 'Men African Wear'),
(55, 'Bed Spread / Duvet', 18, 18, 'Others'),
(56, 'Bedsheet', 5.5, 3, 'Others'),
(57, 'Pillow Case', 1.5, 1, 'Others'),
(58, 'Teddy Bear', 7, 0, 'Others'),
(59, 'Curtain (Light with Linning)', 7, 6, 'Others'),
(60, 'Curtain (Heavy with Linning) ', 12, 7, 'Others'),
(61, 'Curtain  (Heavy without Linning)', 12, 7, 'Others'),
(62, 'Blanket', 9, 6, 'Others'),
(63, 'test', 7, 6.5, 'Men African Wear'),
(64, 'Fugu', 10, 15, 'Gents');

-- --------------------------------------------------------

--
-- Table structure for table `_system_users`
--

CREATE TABLE `_system_users` (
  `xx_user_id` int(6) NOT NULL,
  `xx_fname` varchar(10) NOT NULL,
  `xx_lname` varchar(10) NOT NULL,
  `xx_location` varchar(20) NOT NULL,
  `xx_house_no` varchar(10) NOT NULL,
  `xx_username` varchar(20) NOT NULL,
  `xx_user_email` varchar(30) NOT NULL,
  `xx_user_phone` varchar(12) NOT NULL,
  `xx_user_password` varchar(100) NOT NULL,
  `xx_user_type` enum('Admin','Regular') NOT NULL DEFAULT 'Regular',
  `xx_user_status` enum('Enabled','Disabled') NOT NULL DEFAULT 'Enabled',
  `xx_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `xx_password_reset_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_system_users`
--

INSERT INTO `_system_users` (`xx_user_id`, `xx_fname`, `xx_lname`, `xx_location`, `xx_house_no`, `xx_username`, `xx_user_email`, `xx_user_phone`, `xx_user_password`, `xx_user_type`, `xx_user_status`, `xx_created_on`, `xx_password_reset_code`) VALUES
(3, 'benson', 'wachira', 'Haatso', '34', 'ben', 'wbenmurimi@gmail.com', '233542615890', '7fe4771c008a22eb763df47d19e2c6aa', 'Admin', 'Enabled', '2016-03-13 13:25:06', ''),
(4, 'tester', 'tester', 'Pokuasi', '80', 'test', 'test@gmail.com', '233542614535', '098f6bcd4621d373cade4e832627b4f6', 'Regular', 'Enabled', '2016-03-13 13:30:10', ''),
(5, 'user one', 'last name', 'St John', '50', 'user', 'user@gmail.com', '0254787594', 'ee11cbb19052e40b07aac0ca060c23ee', 'Regular', 'Enabled', '2016-03-26 19:07:55', ''),
(9, 'george', 'mycal', 'Ashesi', 'b5', 'george', 'george@gmail.com', '233560223809', 'f96d61c6de3705ee8b92f65d9ddfd3cb', 'Regular', 'Enabled', '2016-03-27 01:38:31', ''),
(10, 'Ali', 'Seidu', 'Pokuasi', '10', 'ali', 'ali@gmail.com', '233547740491', '86318e52f5ed4801abe1d13d509443de', 'Regular', 'Enabled', '2016-03-29 20:58:03', ''),
(11, 'fridah', 'Karwitha', 'Pokuasi', '5', 'fridah', 'fridah@gmail.com', '233542615890', '60aa4e8df7dabe2f2946355566de436a', 'Regular', 'Enabled', '2016-04-09 15:00:25', ''),
(12, 'rudof', 'akrong', 'Haatso', '45', 'rudof', 'rudof@gmail.com', '0542615890', '7870ded76e4dcea49cb2ac22e8531321', 'Regular', 'Enabled', '2016-05-21 22:30:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `_tip`
--

CREATE TABLE `_tip` (
  `tip_id` int(11) NOT NULL,
  `tip_title` varchar(100) NOT NULL,
  `tip_desc` text NOT NULL,
  `tip_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_tip`
--

INSERT INTO `_tip` (`tip_id`, `tip_title`, `tip_desc`, `tip_date`) VALUES
(1, 'Test', 'Tip testing post', '2016-03-29 22:13:26'),
(2, 'Folding Your Trouser', 'To fold a trouser place it on a table or flat surface. Fold it three times and store in the locker', '2016-03-29 22:12:31'),
(3, 'Washing jeans', 'Sometimes it is very difficult to clean your dirty jeans. Dont worry, we are here to help', '2016-05-21 00:59:42'),
(7, 'Washing trousers', 'hey. Washing trousers is awesome', '2016-05-21 21:46:33'),
(8, 'hello', 'hello there', '2016-05-21 22:39:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_cost`
--
ALTER TABLE `_cost`
  ADD PRIMARY KEY (`cost_id`);

--
-- Indexes for table `_orders`
--
ALTER TABLE `_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `_system_users`
--
ALTER TABLE `_system_users`
  ADD PRIMARY KEY (`xx_user_id`);

--
-- Indexes for table `_tip`
--
ALTER TABLE `_tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_cost`
--
ALTER TABLE `_cost`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `_orders`
--
ALTER TABLE `_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `_system_users`
--
ALTER TABLE `_system_users`
  MODIFY `xx_user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `_tip`
--
ALTER TABLE `_tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
