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
-- Database: `kamavvve_grocery_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_city_area`
--

CREATE TABLE `admin_city_area` (
  `id` int(11) NOT NULL,
  `city_id` varchar(200) DEFAULT NULL,
  `city_name` text DEFAULT NULL,
  `service_status` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_city_area`
--

INSERT INTO `admin_city_area` (`id`, `city_id`, `city_name`, `service_status`, `created_at`, `updated_at`) VALUES
(1, '12345', 'jaipur', 'true', '2020-09-07 05:32:42', '2020-09-07 05:32:42'),
(2, '123456', 'kota', 'true', '2020-09-07 06:08:03', '2020-09-07 06:08:03'),
(3, '1234567', 'ajmer', 'true', '2020-09-07 06:08:31', '2020-09-07 06:08:31'),
(4, '12345678', 'pali', 'false', '2020-09-07 06:09:01', '2020-09-07 06:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_city_pincode`
--

CREATE TABLE `admin_city_pincode` (
  `id` int(11) NOT NULL,
  `pincode_id` varchar(200) DEFAULT NULL,
  `city_id` varchar(200) DEFAULT NULL,
  `pincode` int(50) DEFAULT NULL,
  `pin_service_state` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_city_pincode`
--

INSERT INTO `admin_city_pincode` (`id`, `pincode_id`, `city_id`, `pincode`, `pin_service_state`, `created_at`, `updated_at`) VALUES
(1, '123456', '12345', 1432, 'true', '2020-09-07 06:07:26', '2020-09-07 06:07:26'),
(2, '123456', '123456', 203019, 'true', '2020-09-07 06:11:54', '2020-09-07 06:11:54'),
(3, '1234567', '1234567', 302019, 'false', '2020-09-07 06:11:54', '2020-09-07 06:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product`
--

CREATE TABLE `admin_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `product_sku` varchar(200) DEFAULT NULL,
  `product_name` varchar(500) DEFAULT NULL,
  `product_category_id` varchar(500) DEFAULT NULL,
  `product_sub_category_id` varchar(500) DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `gallery_image` varchar(5000) DEFAULT NULL,
  `brand_id` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_product`
--

INSERT INTO `admin_product` (`id`, `product_id`, `product_sku`, `product_name`, `product_category_id`, `product_sub_category_id`, `featured_image`, `gallery_image`, `brand_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PR9277966', '9277966PR', 'Maggi', 'GH68814340779', 'RE75812496543', '', '', 'NI54031003772', 'test', '2020-09-08 06:35:10', '2020-09-08 06:35:10'),
(3, 'PR9277966', '9277966PR', 'Assam Tea', 'GH68814340779', 'SH75812496543', '', '', 'AS83661612353', 'test', '2020-09-08 06:36:57', '2020-09-08 06:36:57'),
(4, 'PR905574063', '905574063PR', 'Natural Mineral Water', 'PA68814340779', 'MA75812496543', '', '', 'NI54031003772', 'dvdfsd', '2020-09-08 06:42:02', '2020-09-08 06:42:02'),
(5, 'AS762310701', '762310701AS', 'Coffee', 'choose..', 'choose..', '', '', 'choose..', '', '2020-09-08 06:43:18', '2020-09-08 06:43:18'),
(6, 'PR354877186', '354877186PR', 'Bread - Sandwich', 'PA68814340779', 'SH75812496543', '', '', 'AS83661612353', 'test', '2020-09-08 06:44:12', '2020-09-08 06:44:12'),
(7, 'PR354877186', '354877186PR', 'Bread - Healthy Slice', 'CA26462897', 'choose..', '', '', 'NI54031003772', '', '2020-09-08 06:44:57', '2020-09-08 06:44:57'),
(8, 'PR236075990', '236075990PR', 'Organic - Brown Sugar', 'PA68814340779', 'MA75812496543', '', '', 'AS83661612353', 'test', '2020-09-08 06:46:10', '2020-09-08 06:46:10'),
(9, 'TE236075990', '236075990TE', 'Thumps-Up', 'PA68814340779', 'MA75812496543', '', '', 'AS83661612353', 'test', '2020-09-08 06:47:30', '2020-09-08 06:47:30'),
(10, 'TE236075990', '236075990TE', 'Tea Leaf', 'TE681634413', 'choose..', '', '', 'NI54031003772', 'mbbvnb', '2020-09-08 06:48:11', '2020-09-08 06:48:11'),
(11, 'DR915275971', '915275971DR', 'dry fruits', 'TE68814340779', 'MA75812496543', '', '', 'NI54031003772', 'tasfa', '2020-09-08 06:50:18', '2020-09-08 06:50:18'),
(12, 'PA419847057', '419847057PA', 'pasta', 'PA68814340779', 'RE75812496543', '', '', 'NI54031003772', 'asdasdasd', '2020-09-08 06:52:15', '2020-09-08 06:52:15'),
(13, 'TE419847057', '419847057TE', 'Tea Leafsdfsd', 'choose..', 'choose..', '', '', 'choose..', '', '2020-09-08 06:54:48', '2020-09-08 06:54:48'),
(14, 'JJ31998762', '31998762JJ', 'Coca Cola', '480540949', 'choose..', '', '', 'NI54031003772', 'mbbnm', '2020-09-08 07:27:52', '2020-09-08 07:27:52'),
(15, 'TE776256105', '776256105TE', 'Tea Leafd', 'TE68814340779', 'RE75812496543', '', '', 'AS83661612353', 'asfsfsdf', '2020-09-08 07:28:50', '2020-09-08 07:28:50'),
(16, 'CO638175293', '638175293CO', 'Raasna', 'PA68814340779', 'MA75812496543', '', '', 'NI54031003772', 'test', '2020-09-08 07:52:11', '2020-09-08 07:52:11'),
(17, '103160191TE', 'TE103160191', 'Pepsi', 'CA26462897', 'MA75812496543', '', '', 'AS83661612353', 'twest', '2020-09-11 05:46:27', '2020-09-11 05:46:27'),
(18, '955614787AS', 'AS955614787', 'asdfsf', 'TE751210964', 'choose..', '', '', 'AS83661612353', 'sdfsdfs', '2020-09-12 14:50:19', '2020-09-12 14:50:19'),
(19, '628038496KJ', 'KJ628038496', 'kjkjkjjkjjkl', 'TE290557609', 'TE908666908', '', '', 'TE282438256', 'kjhkjhkkjhkj', '2020-09-12 14:58:04', '2020-09-12 14:58:04'),
(20, '880498616DF', 'DF880498616', 'dfsfsdfsdfsdfsdf', 'TE751210964', 'TE908666908', '', '', 'TE282438256', 'zxdvzxgdfdfg', '2020-09-12 14:59:30', '2020-09-12 14:59:30'),
(21, '780841741KJ', 'KJ780841741', 'kjlkhkjjkjkl', 'TE751210964', 'TE908666908', '', '', 'NE148139106', 'ohhkhkjjk', '2020-09-12 15:02:22', '2020-09-12 15:02:22'),
(22, '49073819KJ', 'KJ49073819', 'kjbhjghjhjkkj', 'TE290557609', 'TE908666908', '', '', 'NE148139106', 'nnmnmm ', '2020-09-12 15:02:42', '2020-09-12 15:02:42'),
(23, '747560807AS', 'AS747560807', 'asdfasdfsdfasdfasdf', 'TE290557609', 'TE908666908', '', '', 'AS83661612353', 'asdfsdfsdf', '2020-09-13 09:59:39', '2020-09-13 09:59:39'),
(24, '252678286DS', 'DS252678286', 'dsdfasfsdfsd', 'TE290557609', 'TE908666908', '', '', 'AS83661612353', 'sdfsdfsdfsd', '2020-09-13 10:00:32', '2020-09-13 10:00:32'),
(25, '608681339AS', 'AS608681339', 'asdfsfsdfsd', 'TE751210964', 'TE908666908', '', '', 'NI54031003772', 'asfsfsdfsdf', '2020-09-13 10:08:02', '2020-09-13 10:08:02'),
(26, '229770420SD', 'SD229770420', 'sdfsdfsdfdf', 'TE751210964', 'TE908666908', '', '', 'NI54031003772', 'sfsdfsdfsdfsdf', '2020-09-13 10:08:49', '2020-09-13 10:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product_category`
--

CREATE TABLE `admin_product_category` (
  `id` int(11) NOT NULL,
  `product_category_id` varchar(100) NOT NULL,
  `product_category_name` text DEFAULT NULL,
  `category_featured_image` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_product_category`
--

INSERT INTO `admin_product_category` (`id`, `product_category_id`, `product_category_name`, `category_featured_image`, `created_at`, `updated_at`) VALUES
(22, 'SF471277707', 'sfasf', '', '2020-09-13 10:56:50', '2020-09-13 10:56:50'),
(23, 'PA904846129', 'pasta', 'C:\\fakepath\\201 (1).jpg', '2020-09-15 05:14:30', '2020-09-15 05:14:30'),
(24, 'RI904846129', 'rice', 'C:\\fakepath\\201.jpg', '2020-09-15 05:15:02', '2020-09-15 05:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product_inventary`
--

CREATE TABLE `admin_product_inventary` (
  `id` int(11) NOT NULL,
  `inventory_id` varchar(200) DEFAULT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `product_sku` varchar(200) DEFAULT NULL,
  `variant_id` varchar(200) DEFAULT NULL,
  `variant_sku` varchar(200) DEFAULT NULL,
  `unit_amount` varchar(100) DEFAULT NULL,
  `unit_type` varchar(100) DEFAULT NULL,
  `packaging_type` varchar(100) DEFAULT NULL,
  `mrp` varchar(200) DEFAULT NULL,
  `discount_type` varchar(200) DEFAULT NULL,
  `discount_amount` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_product_inventary`
--

INSERT INTO `admin_product_inventary` (`id`, `inventory_id`, `product_id`, `product_sku`, `variant_id`, `variant_sku`, `unit_amount`, `unit_type`, `packaging_type`, `mrp`, `discount_type`, `discount_amount`, `city`, `availability`, `created_at`, `updated_at`) VALUES
(1, NULL, 'CO638175293', '638175293CO', '64771036LI', 'LI64771036', '50', 'KG', 'single', '50', 'precentage', '10', 'jaipur', NULL, '2020-09-08 09:26:41', '2020-09-08 09:26:41'),
(2, NULL, 'TE776256105', '776256105TE', 'GM527984161', '527984161GM', '100', 'liter', 'multi', '510', 'flat discount', '50', 'kota', NULL, '2020-09-08 09:26:41', '2020-09-08 09:26:41'),
(3, 'FL71091956', 'CO638175293', '638175293CO', '64771036LI', 'LI64771036', '82', NULL, 'multi', '33', 'flat_discount', '00', 'kota', NULL, '2020-09-10 13:44:19', '2020-09-10 13:44:19'),
(4, 'CH71091956', 'CO638175293', '638175293CO', '64771036LI', 'LI64771036', '82', NULL, 'Choose...', '', 'Choose...', '', 'Choose...', NULL, '2020-09-10 13:44:32', '2020-09-10 13:44:32'),
(5, 'PR71091956', 'CO638175293', '638175293CO', '64771036LI', 'LI64771036', '82', NULL, 'multi', '500', 'precentage', '5', 'jaipur', NULL, '2020-09-10 13:45:54', '2020-09-10 13:45:54'),
(6, 'PR595487246', 'CO638175293', '638175293CO', '64771036LI', 'LI64771036', '82', NULL, 'multi', '50', 'precentage', '33', 'jaipur', NULL, '2020-09-11 06:02:21', '2020-09-11 06:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product_sub_category`
--

CREATE TABLE `admin_product_sub_category` (
  `id` int(11) NOT NULL,
  `product_category_id` varchar(500) DEFAULT NULL,
  `product_sub_category_id` varchar(500) DEFAULT NULL,
  `product_sub_category_name` varchar(255) DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_product_sub_category`
--

INSERT INTO `admin_product_sub_category` (`id`, `product_category_id`, `product_sub_category_id`, `product_sub_category_name`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 'GH68814340779', 'DI75812496543', 'Noddles', '', '2020-09-12 09:15:37', '2020-09-03 06:08:43'),
(2, 'GH68814340779', 'SH75812496543', 'Sarso Oil', '', '2020-09-12 09:15:54', '2020-09-03 06:09:04'),
(3, 'TE68814340779', 'MA75812496543', 'Veg Oil', '', '2020-09-12 09:16:10', '2020-09-03 06:09:55'),
(4, 'TE68814340779', 'RE75812496543', 'Premium Tea', '', '2020-09-12 09:16:24', '2020-09-03 06:10:17'),
(5, NULL, 'TE268693559', 'Cereals & Millets', NULL, '2020-09-12 09:18:11', '2020-09-07 16:23:30'),
(6, 'PA68814340779', 'TE236885759', 'Toor, Channa & Moong Dal', NULL, '2020-09-12 09:18:54', '2020-09-07 16:26:23'),
(7, 'GH68814340779', 'TE60073669', 'Basmati Rice', NULL, '2020-09-12 09:19:23', '2020-09-11 04:47:59'),
(10, 'TE290557609', 'TE908666908', 'testing', NULL, '2020-09-12 14:49:05', '2020-09-12 14:49:05'),
(12, 'RI904846129', 'BA511253840', 'basmti rice', NULL, '2020-09-15 05:15:32', '2020-09-15 05:15:32'),
(13, 'RI904846129', 'BL511253840', 'black rice', NULL, '2020-09-15 05:16:39', '2020-09-15 05:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product_variant`
--

CREATE TABLE `admin_product_variant` (
  `id` int(11) NOT NULL,
  `variant_id` varchar(500) DEFAULT NULL,
  `variant_sku` varchar(200) DEFAULT NULL,
  `product_sku` varchar(200) NOT NULL,
  `product_id` varchar(500) DEFAULT NULL,
  `unit_amount` varchar(200) DEFAULT NULL,
  `unit_type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_product_variant`
--

INSERT INTO `admin_product_variant` (`id`, `variant_id`, `variant_sku`, `product_sku`, `product_id`, `unit_amount`, `unit_type`, `created_at`, `updated_at`) VALUES
(6, '64771036LI', 'LI64771036', '638175293CO', 'CO638175293', '82', 'liter', '2020-09-08 07:54:02', '2020-09-08 07:54:02'),
(5, '64771036LI', '524771036TE', '638175293CO', 'CO638175293', '80', 'liter', '2020-09-08 07:52:27', '2020-09-08 07:52:27'),
(4, 'GM527984161', 'LI527984161', '776256105TE', 'TE776256105', '50', 'gm', '2020-09-08 07:48:58', '2020-09-08 07:48:58'),
(7, '73363094GM', 'GM73363094', 'TE103160191', '103160191TE', '50', 'gm', '2020-09-11 05:50:18', '2020-09-11 05:50:18'),
(8, '31926538LI', 'LI31926538', 'AS955614787', '955614787AS', '10', 'liter', '2020-09-12 14:50:33', '2020-09-12 14:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `brand_table`
--

CREATE TABLE `brand_table` (
  `id` int(11) NOT NULL,
  `brand_id` varchar(500) DEFAULT NULL,
  `brand_name` varchar(500) DEFAULT NULL,
  `brand_image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_table`
--

INSERT INTO `brand_table` (`id`, `brand_id`, `brand_name`, `brand_image`, `created_at`, `updated_at`) VALUES
(2, 'NI54031003772', 'Daawat', '', '2020-09-03 06:11:05', '2020-09-03 06:11:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_city_area`
--
ALTER TABLE `admin_city_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_city_pincode`
--
ALTER TABLE `admin_city_pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product`
--
ALTER TABLE `admin_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product_category`
--
ALTER TABLE `admin_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product_inventary`
--
ALTER TABLE `admin_product_inventary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product_sub_category`
--
ALTER TABLE `admin_product_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product_variant`
--
ALTER TABLE `admin_product_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_table`
--
ALTER TABLE `brand_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_city_area`
--
ALTER TABLE `admin_city_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_city_pincode`
--
ALTER TABLE `admin_city_pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_product`
--
ALTER TABLE `admin_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `admin_product_category`
--
ALTER TABLE `admin_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `admin_product_inventary`
--
ALTER TABLE `admin_product_inventary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_product_sub_category`
--
ALTER TABLE `admin_product_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin_product_variant`
--
ALTER TABLE `admin_product_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brand_table`
--
ALTER TABLE `brand_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
