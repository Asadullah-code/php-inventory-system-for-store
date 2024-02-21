-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 07:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'Toshiba', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Cell', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contaminated_plants`
--

CREATE TABLE `contaminated_plants` (
  `contaminated_id` int(11) NOT NULL,
  `contaminated_date` date NOT NULL,
  `product_id` bigint(11) NOT NULL,
  `operator_number` varchar(50) NOT NULL,
  `contaminated_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contaminated_plants`
--

INSERT INTO `contaminated_plants` (`contaminated_id`, `contaminated_date`, `product_id`, `operator_number`, `contaminated_quantity`) VALUES
(36, '2024-02-15', 17, '001', 50),
(37, '2024-02-15', 18, '002', 50),
(38, '2024-02-15', 19, '003', 50),
(39, '2024-02-15', 17, '001', 20),
(40, '2024-02-16', 18, '003', 20),
(41, '2024-02-20', 39, '002', 200);

-- --------------------------------------------------------

--
-- Table structure for table `edit_pdetail`
--

CREATE TABLE `edit_pdetail` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `product_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edit_pdetail`
--

INSERT INTO `edit_pdetail` (`id`, `product_id`, `product_name`, `quantity`, `product_date`) VALUES
(34, '17', 'Toshiba', 5000.00, '2024-02-18'),
(35, '17', 'Toshiba', -2000.00, '2024-02-18'),
(36, '17', 'Toshiba', 3000.00, '2024-02-18'),
(37, '29', 'velvet', 150.00, '2024-02-18'),
(38, '29', 'velvet', 50.00, '2024-02-18'),
(39, '29', 'velvet', 5700.00, '2024-02-18'),
(40, '17', 'Toshiba', 82000.00, '2024-02-18'),
(41, '17', 'Toshiba', -10000.00, '2024-02-21'),
(42, '29', 'velvet', 3000.00, '2024-02-22'),
(43, '17', 'Toshiba', -70000.00, '2024-02-19'),
(44, '17', 'Toshiba', -5000.00, '2024-02-19'),
(59, '', 'velvet', 100.00, '2024-02-10'),
(60, '37', 'velvet', 200.00, '2024-02-10'),
(61, '37', 'velvet', 200.00, '2024-02-12'),
(62, '37', 'velvet', 200.00, '2024-02-14'),
(63, '', 'jack', 100.00, '2024-02-10'),
(64, '38', 'jack', 200.00, '2024-02-12'),
(65, '38', 'jack', 0.00, '2024-02-12'),
(66, '38', 'jack', 300.00, '2024-02-12'),
(67, '', 'hello', 200.00, '2024-02-10'),
(68, '39', 'hello', 100.00, '2024-02-10'),
(69, '39', 'hello', 300.00, '2024-02-13'),
(70, '', 'asasd', 5.00, '2024-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `operator_id` int(11) NOT NULL,
  `operator_date` date NOT NULL,
  `operator_number` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `operator_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`operator_id`, `operator_date`, `operator_number`, `product_name`, `operator_quantity`) VALUES
(21, '2024-02-15', '001', 'Toshiba', 50),
(22, '2024-02-15', '002', 'Nike', 50),
(23, '2024-02-15', '003', 'alocasia ', 50),
(24, '2024-02-15', '003', 'alocasia ', 50),
(25, '2024-02-15', '001', 'Nike', 40),
(26, '2024-02-15', '003', 'Toshiba', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `client_address` varchar(250) NOT NULL,
  `client_email` varchar(200) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `shipping` int(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `phytosanitary` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `invNum` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `client_address`, `client_email`, `sub_total`, `vat`, `total_amount`, `shipping`, `discount`, `phytosanitary`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`, `invNum`) VALUES
(58, '2024-02-14', 'Asad', '0343434', 'asadullah lahore', 'asad@gmail.com', '850.00', '47.50', '99.68', 100, '0', '45', '997.50', '997.50', '0.00', 1, 2, 3, '4.68', 1, 1, ''),
(59, '2024-02-14', 'asd', '5434', 'lahore', 'asadullah@gmail.com', '75.00', '4.50', '99.50', 20, '0', '40', '99.50', '5', '94.50', 1, 2, 7, '4.50', 1, 1, ''),
(60, '2024-02-14', 'asadullah', '85685096', 'gujranwala', 'ahmad@gmail.com', '200.00', '10.00', '220.00', 10, '0', '50', '220.00', '10', '210.00', 1, 2, 4, '10.00', 1, 1, ''),
(61, '2024-02-20', 'asad', '56455', 'asad', 'asad@gmail.com', '54.00', '0.00', '63.00', 9, '9', '9', '54.00', '9', '45.00', 2, 2, 5, '0.00', 1, 1, 'SE589'),
(62, '2024-02-21', 'hosh', '857384', 'lahore', 'hosh@gmail.com', '70.00', '3.50', '73.50', 0, '0', '0', '73.50', '73.50', '0.00', 1, 1, 2, '3.50', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0,
  `product_price_type` varchar(1000) DEFAULT 'rate'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`, `product_price_type`) VALUES
(86, 59, 18, '1', '35', '35.00', 1, 'wholesale'),
(87, 60, 19, '3', '50', '150.00', 1, 'thb'),
(90, 58, 17, '1', '55', '55.00', 1, 'rate'),
(91, 58, 28, '10', '25', '250.00', 1, 'rate'),
(92, 58, 39, '10', '50', '500.00', 1, 'rate'),
(93, 61, 18, '1', '45', '45.00', 1, 'rate'),
(95, 62, 18, '2', '35', '70.00', 1, 'wholesale');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_date` date DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `wholesale` varchar(255) NOT NULL,
  `thb` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_date`, `product_name`, `quantity`, `rate`, `wholesale`, `thb`, `active`, `status`) VALUES
(17, '2024-02-19', 'Toshiba', '5000', '55', '45', '35', 1, 1),
(18, '2024-02-11', 'Nike', '996', '45', '35', '25', 1, 1),
(19, '2024-02-13', 'alocasia ', '50', '20', '10', '50', 1, 1),
(26, '2024-02-16', 'asadullah', '8', '8', '8', '8', 2, 2),
(27, '2024-02-16', 'han', '555', '5', '5', '5', 1, 1),
(28, '2024-02-18', 'frydek', '8879', '25', '20', '100', 1, 1),
(29, '2024-02-22', 'velvet', '9000', '20', '10', '100', 2, 2),
(30, '2024-02-19', 'monstera', '1500', '10', '15', '10', 2, 2),
(31, '2024-02-20', 'asad', '2000', '55', '55', '55', 2, 2),
(32, '2024-02-19', 'abd', '555', '5', '5', '5', 2, 2),
(33, '2024-02-20', 'Dilanga ', '1500', '55', '45', '35', 2, 2),
(34, '2024-02-14', 'dm', '600', '10', '10', '10', 2, 2),
(35, '2024-02-19', 'ikram', '55', '5', '5', '5', 2, 2),
(36, '2024-02-01', 'dilanga', '55', '55', '55', '55', 2, 2),
(37, '2024-02-14', 'velvet', '700', '10', '20', '30', 1, 1),
(38, '2024-02-12', 'jack', '600', '10', '10', '10', 1, 1),
(39, '2024-02-13', 'hello', '391', '50', '50', '50', 1, 1),
(40, '2024-02-21', 'asasd', '5', '5', '5', '5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Super Admin', NULL, '2023-08-03 05:22:41', '2023-08-03 05:22:41'),
(2, 'user', 'user', 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1),
(11, 'cefipa', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'joxuleliqe@mailinator.com', 2),
(13, 'user@web.com', 'e10adc3949ba59abbe56e057f20f883e', 'user@web.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `contaminated_plants`
--
ALTER TABLE `contaminated_plants`
  ADD PRIMARY KEY (`contaminated_id`);

--
-- Indexes for table `edit_pdetail`
--
ALTER TABLE `edit_pdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`operator_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contaminated_plants`
--
ALTER TABLE `contaminated_plants`
  MODIFY `contaminated_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `edit_pdetail`
--
ALTER TABLE `edit_pdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
