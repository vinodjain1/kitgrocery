-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2020 at 02:34 AM
-- Server version: 10.3.24-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamavvve_gorcery_supplier`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_product`
--

CREATE TABLE `supplier_product` (
  `id` int(11) NOT NULL,
  `supplier_product_id` varchar(100) DEFAULT NULL,
  `supplier_id` varchar(200) DEFAULT NULL,
  `product_category_id` varchar(200) DEFAULT NULL,
  `product_sub_category_id` varchar(200) DEFAULT NULL,
  `brand_id` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `product_sku` varchar(200) DEFAULT NULL,
  `variant_sku` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `additional_note` varchar(200) DEFAULT NULL,
  `product_quantity` varchar(200) DEFAULT NULL,
  `expiry_date` varchar(200) DEFAULT NULL,
  `mrp` varchar(200) DEFAULT NULL,
  `discount_type` varchar(200) DEFAULT NULL,
  `discount_amount` varchar(200) DEFAULT NULL,
  `selling_price` varchar(200) DEFAULT NULL,
  `total_quantity_offered` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_product`
--

INSERT INTO `supplier_product` (`id`, `supplier_product_id`, `supplier_id`, `product_category_id`, `product_sub_category_id`, `brand_id`, `city`, `product_sku`, `variant_sku`, `product_name`, `description`, `additional_note`, `product_quantity`, `expiry_date`, `mrp`, `discount_type`, `discount_amount`, `selling_price`, `total_quantity_offered`, `created_at`, `updated_at`) VALUES
(1, NULL, 'LO661168737', 'SF471277707', NULL, NULL, NULL, '776256105TE', '776256105TE', 'Tea Leaf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-14 11:24:41', '2020-09-14 11:24:41'),
(2, '637749597', 'LO661168737', 'SF471277707', 'choose..', 'NI54031003772', NULL, '776256105TE', '776256105TE', 'test', 'sdfsdfsdfsdf', 'test', '34', '2020-09-09', '50', 'flat_price', '0', '50', '34', '2020-09-14 11:29:03', '2020-09-14 11:29:03'),
(3, '637749597', 'LO661168737', 'SF471277707', 'choose..', 'NI54031003772', NULL, '776256105TE', '776256105TE', 'asdfsf', 'fsdfsdfsdfs', NULL, NULL, NULL, '33', 'flat_price', '4', '400', '34', '2020-09-14 11:39:30', '2020-09-14 11:39:30'),
(4, '725515636', 'LO661168737', 'SF471277707', 'choose..', 'NI54031003772', NULL, '776256105TE', '776256105TE', 'testasfsdf', 'asdfsadfsdf', NULL, NULL, '2020-10-02', '33', 'no_discount', '4', '50', '34', '2020-09-14 12:00:30', '2020-09-14 12:00:30'),
(5, '381746654', 'LO661168737', 'SF471277707', 'choose..', 'NI54031003772', NULL, '776256105TE', '776256105TE', 'test', 'sdfsdfsdfsdf', 'test', '34', '', '33', 'no_discount', '', '520', '50KG', '2020-09-14 12:03:50', '2020-09-14 12:03:50'),
(6, NULL, NULL, 'rice', 'black rice', 'Daawat', NULL, '776256105TE', '776256105TE', 'test', 'sdfsdfsdfsdf', 'test', '', '', '50', 'no_discount', '', '45', '50KG', '2020-09-15 05:18:44', '2020-09-15 05:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_detail`
--

CREATE TABLE `tbl_account_detail` (
  `id` int(11) NOT NULL,
  `supplier_id` varchar(200) NOT NULL DEFAULT '0',
  `account_id` varchar(200) DEFAULT NULL,
  `shop_id` varchar(200) NOT NULL DEFAULT '0',
  `bank_name` varchar(500) NOT NULL DEFAULT '0',
  `account_type` varchar(100) NOT NULL DEFAULT '0',
  `account_number` varchar(100) NOT NULL DEFAULT '0',
  `ifsc_code` varchar(50) NOT NULL DEFAULT '0',
  `pan_number` varchar(100) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account_detail`
--

INSERT INTO `tbl_account_detail` (`id`, `supplier_id`, `account_id`, `shop_id`, `bank_name`, `account_type`, `account_number`, `ifsc_code`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 'MI509866483', 'SB187001766', 'RA51256766', 'SBB', 'current', '01236547892', 'ICICI006776', '012584', '2020-09-08 02:20:56', '2020-09-08 02:20:56'),
(2, 'LO661168737', 'IC904789285', 'GA908042242', 'icici', 'current', '0123654789', 'ICICI00677', '012365', '2020-09-14 08:22:00', '2020-09-14 08:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_detail`
--

CREATE TABLE `tbl_shop_detail` (
  `id` int(11) NOT NULL,
  `supplier_id` varchar(200) DEFAULT NULL,
  `shop_id` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `shop_name` varchar(500) DEFAULT NULL,
  `gst_number` varchar(50) DEFAULT NULL,
  `reg_number` varchar(100) DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `pin_code` varchar(50) DEFAULT NULL,
  `shop_type` varchar(500) DEFAULT NULL,
  `week_off` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shop_detail`
--

INSERT INTO `tbl_shop_detail` (`id`, `supplier_id`, `shop_id`, `city`, `shop_name`, `gst_number`, `reg_number`, `category`, `pin_code`, `shop_type`, `week_off`, `address`, `created_at`, `updated_at`) VALUES
(2, 'LO661168737 ', 'GA908042242', NULL, 'gasdfsdfsdf', '34342324', '3453454', 'ewrwerwe', '3443', 'dairy', 'thrusday', '34343', '2020-09-14 07:56:07', '2020-09-14 07:56:07'),
(3, 'LO661168737 ', 'TE321436742', NULL, 'test', '12312312312', '12312321323123', 'erwererwe', '223423423423', 'grocery', 'firday', '254 Agrwal Fram Jaipur, 24', '2020-09-14 12:26:35', '2020-09-14 12:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_join_date` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_detail`
--
ALTER TABLE `tbl_account_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shop_detail`
--
ALTER TABLE `tbl_shop_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supplier_product`
--
ALTER TABLE `supplier_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_account_detail`
--
ALTER TABLE `tbl_account_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_shop_detail`
--
ALTER TABLE `tbl_shop_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
