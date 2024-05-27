-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 07:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tri_fixing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_type`
--

CREATE TABLE `admin_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT 0,
  `isDelete` int(11) DEFAULT 0,
  `adate` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_by_type` int(11) DEFAULT 0,
  `modified_by` text DEFAULT NULL,
  `modified_by_type` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_type`
--

INSERT INTO `admin_type` (`id`, `name`, `department_id`, `isDelete`, `adate`, `created_by`, `created_by_type`, `modified_by`, `modified_by_type`, `created_date`, `modified_date`) VALUES
(1, 'Admin', 0, 0, '2022-09-06 18:35:13', 1, 0, NULL, NULL, NULL, NULL),
(2, 'Sub User', 0, 0, '2022-09-06 18:35:19', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_login`
--

CREATE TABLE `application_login` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0=Super Admin,1=Major Admin',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `forgot_pass_string` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(250) DEFAULT NULL,
  `isDelete` int(11) DEFAULT 0,
  `adate` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_by_type` int(11) DEFAULT 0,
  `modified_by` text DEFAULT NULL,
  `modified_by_type` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_login`
--

INSERT INTO `application_login` (`id`, `name`, `type`, `username`, `password`, `email`, `phone`, `forgot_pass_string`, `last_login`, `last_ip`, `isDelete`, `adate`, `created_by`, `created_by_type`, `modified_by`, `modified_by_type`, `created_date`, `modified_date`) VALUES
(1, 'admin', 1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'makwanajaydip153@gmail.com', '9723037928', '1c0c6fef16542d9397', '2024-03-12 11:47:03', '192.168.1.29', 0, '2022-09-06 18:37:25', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `id` int(11) NOT NULL,
  `notification_product_expiry` int(11) DEFAULT NULL,
  `error_reporting` int(11) DEFAULT 0,
  `client_name` varchar(150) DEFAULT NULL,
  `client_tagline` varchar(150) DEFAULT NULL,
  `client_email` varchar(150) DEFAULT NULL,
  `client_contact_number_1` varchar(150) DEFAULT NULL,
  `client_contact_number_2` varchar(150) DEFAULT NULL,
  `client_landline` varchar(150) DEFAULT NULL,
  `client_company_name` varchar(150) DEFAULT NULL,
  `client_address1` varchar(150) DEFAULT NULL,
  `client_address2` varchar(150) DEFAULT NULL,
  `client_street` varchar(150) DEFAULT NULL,
  `client_city` varchar(150) DEFAULT NULL,
  `client_pincode` varchar(150) DEFAULT NULL,
  `client_state` varchar(150) DEFAULT NULL,
  `client_country` varchar(150) DEFAULT NULL,
  `settings_invoice_logo` text DEFAULT NULL,
  `settings_invoice_logo_align` varchar(150) DEFAULT NULL,
  `invoice_term_condition` text DEFAULT NULL,
  `credit_note_term_condition` text DEFAULT NULL,
  `customer_term_condition` text DEFAULT NULL,
  `from_name` varchar(150) DEFAULT NULL,
  `from_email` varchar(150) DEFAULT NULL,
  `default_cc` varchar(150) DEFAULT NULL,
  `default_bcc` varchar(150) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `isDelete` tinyint(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `category_id`, `brand_name`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(6, 7, 'Sumsung', 'service_category_image_496e3d.png', 0, 1, '2023-08-05 11:27:44'),
(8, 7, 'Apple', 'brand_image_d1b25a.png', 0, 1, '2023-08-11 11:41:42'),
(9, 7, 'xiaomi (Mi)', 'brand_image_f79b0b.png', 0, 1, '2023-08-16 16:12:32'),
(10, 7, 'Oppo', 'brand_image_c38bc7.png', 0, 1, '2023-08-16 16:41:43'),
(11, 7, 'Realme', 'brand_image_cc3d60.png', 0, 1, '2023-08-16 16:47:44'),
(12, 7, 'huawei', 'brand_image_8ca706.png', 0, 1, '2023-08-16 17:29:11'),
(14, 5, 'sumsung', 'brand_image_6be892.jpg', 0, 1, '2023-08-17 12:29:19'),
(16, 5, 'Apple', 'brand_image_d186ab.jpg', 0, 1, '2023-08-17 18:58:44'),
(17, 5, 'xiaomi (Mi)', 'brand_image_175045.jpg', 0, 1, '2023-08-18 10:17:46'),
(18, 5, 'Oppo', 'brand_image_ce8857.jpg', 0, 1, '2023-08-18 10:31:11'),
(19, 5, 'Realme', 'brand_image_610cac.jpg', 0, 1, '2023-08-18 10:43:35'),
(20, 5, 'huawei', 'brand_image_fb3292.jpg', 0, 1, '2023-08-18 11:39:27'),
(21, 2, 'sumsung', 'brand_image_727ba7.jpg', 0, 1, '2023-08-18 12:29:51'),
(22, 2, 'Apple', 'brand_image_86de60.jpg', 0, 1, '2023-08-19 15:48:40'),
(23, 2, 'xiaomi (Mi)', 'brand_image_d5d3de.jpg', 0, 1, '2023-08-19 16:09:28'),
(24, 2, 'Oppo', 'brand_image_a19da8.jpg', 0, 1, '2023-08-19 16:28:25'),
(25, 2, 'Realme', 'brand_image_afb198.jpg', 0, 1, '2023-08-23 11:41:51'),
(26, 2, 'Huawei', 'brand_image_e860d3.jpg', 0, 1, '2023-08-23 12:23:46'),
(28, 2, 'oneplus', 'brand_image_906801.jpg', 0, 1, '2023-09-11 15:49:24'),
(29, 2, 'google', 'brand_image_b43625.jpg', 0, 1, '2023-09-11 16:24:38'),
(30, 2, 'vivo', 'brand_image_487557.jpg', 0, 1, '2023-09-11 16:29:23'),
(31, 7, 'google', 'brand_image_cd0cb7.jpg', 0, 1, '2023-09-11 16:50:03'),
(32, 7, 'vivo', 'brand_image_61bd48.jpg', 0, 1, '2023-09-11 17:02:51'),
(33, 7, 'oneplus', 'brand_image_7e2537.jpg', 0, 1, '2023-09-11 17:03:15'),
(34, 5, 'vivo', 'brand_image_3501f6.jpg', 0, 1, '2023-09-11 17:12:02'),
(35, 5, 'oneplus', 'brand_image_942a55.jpg', 0, 1, '2023-09-11 17:15:20'),
(36, 5, 'google', 'brand_image_3c55c4.jpg', 0, 1, '2023-09-11 17:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `isDelete` tinyint(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `image_path`, `description`, `isDelete`, `isActive`, `created_date`) VALUES
(2, 'Smartphone Repairs', 'service_image_dbafba.png', 'The smartphone repair service for iPhone, Samsung, Nokia, HTC, Nexus & Sony.', 0, 1, '2023-08-02 16:49:04'),
(5, 'Tablet & iPad Repairs', 'service_image_3c7fb9.png', 'Expert repairs for all leading brands of tablets & portable devices.', 0, 1, '2023-08-02 16:48:18'),
(7, 'Watch Repairs', 'category_image_514b43.png', 'Expert repairs for all leading brands of watch.', 0, 1, '2023-08-17 10:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `device_problem`
--

CREATE TABLE `device_problem` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(255) DEFAULT NULL,
  `modal_id` int(255) DEFAULT NULL,
  `device_problem_type_id` int(255) NOT NULL,
  `device_problem_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `device_problem`
--

INSERT INTO `device_problem` (`id`, `category_id`, `brand_id`, `modal_id`, `device_problem_type_id`, `device_problem_name`, `amount`, `isDelete`, `isActive`, `created_date`) VALUES
(39, 2, 21, 309, 1, 'Screen Replacement', 100, 0, 1, '2024-02-06 07:13:34'),
(42, 2, 21, 309, 1, 'Rear Glass Replacement', 150, 0, 1, '2024-02-06 07:44:07'),
(43, 2, 21, 309, 1, 'OS Restore', 400, 0, 1, '2024-02-06 09:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `device_problem_type`
--

CREATE TABLE `device_problem_type` (
  `id` int(11) NOT NULL,
  `device_problem_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `device_problem_type`
--

INSERT INTO `device_problem_type` (`id`, `device_problem_type_name`, `isDelete`, `isActive`, `created_date`) VALUES
(1, 'Regular', 0, 1, '2023-08-03 06:51:30'),
(2, 'Standard', 0, 1, '2023-08-03 06:55:11'),
(3, 'Premium', 0, 1, '2023-08-03 06:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_slug` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `isDelete` int(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_slug`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(1, '_1', 'cat_image_519f96.png', 0, 1, '2023-08-02 17:03:42'),
(2, '_2', 'cat_image_15dbec.png', 0, 1, '2023-08-02 17:04:34'),
(3, '_3', 'cat_image_23ff97.png', 0, 1, '2023-08-02 17:04:52'),
(4, '_4', 'cat_image_ede5d3.png', 0, 1, '2023-08-02 17:05:09'),
(5, '_5', 'cat_image_275762.png', 0, 1, '2023-08-02 17:05:23'),
(6, '_6', 'cat_image_42b0fd.png', 0, 1, '2023-08-02 17:30:16'),
(7, '_7', 'cat_image_fa7e17.png', 0, 1, '2023-08-02 17:29:31'),
(8, '_8', 'cat_image_50734c.png', 1, 1, '2023-09-29 16:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `subject` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `phone`, `message`, `isDelete`, `isActive`, `created_date`) VALUES
(1, 'makwana jaydip', 'makwanajaydip@gmail.com', '', '1234567898', 'test', 0, 1, '2023-08-16 11:38:57'),
(2, 'test  test', 'test@gmail.com', '', '9898989898', 'testing messges', 1, 1, '2023-08-16 11:41:39'),
(3, 'abc  dfg', 'abc@gmail.com', '', '1234567898', 'test abcd\n', 1, 1, '2023-08-16 15:58:51'),
(4, 'makwana jaydip', 'makwanajaydip@gmail.com', '', '1234567890', 'test', 0, 1, '2023-08-23 12:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `modal`
--

CREATE TABLE `modal` (
  `id` bigint(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `modal_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `isDelete` tinyint(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modal`
--

INSERT INTO `modal` (`id`, `category_id`, `brand_id`, `modal_name`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(1, 7, 6, 'Galaxy Watch6 Classic', 'cat_image_a09392.png', 0, 1, '2023-08-05 11:28:31'),
(2, 7, 6, 'Galaxy Watch6', 'cat_image_dc1e58.png', 0, 1, '2023-08-05 11:29:26'),
(3, 7, 6, 'Galaxy Watch5 Pro', 'cat_image_c2b6f1.png', 0, 1, '2023-08-05 11:30:25'),
(4, 7, 6, 'Galaxy Watch5', 'cat_image_d5ceed.png', 0, 1, '2023-08-05 11:31:14'),
(5, 7, 6, 'Galaxy Watch4 Classic', 'cat_image_22b9e1.png', 0, 1, '2023-08-05 11:32:35'),
(6, 7, 6, 'Galaxy Watch4', 'cat_image_ba2098.png', 0, 1, '2023-08-05 11:33:21'),
(7, 7, 6, 'Galaxy Watch3', 'cat_image_65bf7b.png', 0, 1, '2023-08-05 11:54:24'),
(8, 7, 6, 'Galaxy Watch Active2', 'cat_image_45052d.png', 0, 1, '2023-08-05 11:57:40'),
(9, 7, 6, 'Galaxy Watch Active2 Aluminum', 'cat_image_7e037b.png', 0, 1, '2023-08-05 11:59:14'),
(10, 7, 6, 'Galaxy Watch Active', 'cat_image_03c071.png', 0, 1, '2023-08-07 16:55:16'),
(11, 7, 6, 'Galaxy Watch', 'cat_image_fcf565.png', 0, 1, '2023-08-07 16:56:28'),
(12, 7, 6, 'Gear S3 classic', 'cat_image_165b02.png', 0, 1, '2023-08-07 16:58:38'),
(13, 7, 6, 'Gear S3 frontier', 'cat_image_49ce18.png', 0, 1, '2023-08-07 16:58:56'),
(14, 7, 6, 'Gear S3 frontier LTE', 'cat_image_6b59dc.png', 0, 1, '2023-08-07 16:59:16'),
(15, 7, 6, 'Gear S2 classic 3G', 'cat_image_117bf9.png', 0, 1, '2023-08-07 17:00:44'),
(16, 7, 6, 'Gear S2 classic', 'cat_image_b80175.png', 0, 1, '2023-08-07 17:01:52'),
(17, 7, 6, 'Gear S2', 'cat_image_b3f575.png', 0, 1, '2023-08-07 17:02:07'),
(18, 7, 6, 'Gear S2 3G', 'cat_image_2e1823.png', 0, 1, '2023-08-07 17:02:22'),
(19, 7, 6, 'Gear S', 'cat_image_8bec10.png', 0, 1, '2023-08-07 17:05:13'),
(20, 7, 6, 'Gear 2 Neo', 'cat_image_7f0ddd.png', 0, 1, '2023-08-07 17:05:28'),
(21, 7, 6, 'Gear Live', 'cat_image_4f3834.png', 0, 1, '2023-08-07 17:05:48'),
(22, 7, 6, 'Gear 2', 'cat_image_28706b.png', 0, 1, '2023-08-07 17:06:20'),
(23, 7, 6, 'Galaxy Gear', 'cat_image_0b1005.png', 0, 1, '2023-08-07 17:06:35'),
(24, 7, 8, 'Watch Ultra', 'cat_image_2415ca.png', 0, 1, '2023-08-11 11:43:29'),
(25, 7, 8, 'Watch Series 8', 'cat_image_ae8655.png', 0, 1, '2023-08-11 11:44:02'),
(26, 7, 8, 'Watch Series 8 Aluminum', 'cat_image_20619c.png', 0, 1, '2023-08-11 11:44:38'),
(27, 7, 8, 'Watch SE (2022)', 'cat_image_a29c3f.png', 0, 1, '2023-08-11 11:45:08'),
(28, 7, 8, 'Watch Edition Series 7', 'cat_image_1eb908.png', 0, 1, '2023-08-11 11:46:50'),
(29, 7, 8, 'Watch Series 7', 'cat_image_01b85c.png', 0, 1, '2023-08-11 11:46:30'),
(30, 7, 8, 'Watch Series 7 Aluminum', 'cat_image_7acc27.png', 0, 1, '2023-08-11 11:47:34'),
(31, 7, 8, 'Watch SE', 'cat_image_51d023.png', 0, 1, '2023-08-11 12:12:57'),
(32, 7, 8, 'Watch Series 6 Aluminum', 'cat_image_9fc4b1.png', 0, 1, '2023-08-11 12:13:28'),
(33, 7, 8, 'Watch Series 6', 'cat_image_fedb8c.png', 0, 1, '2023-08-11 12:14:47'),
(34, 7, 8, 'Watch Edition Series 6', 'cat_image_db55e7.png', 0, 1, '2023-08-11 12:15:19'),
(35, 7, 8, 'Watch Edition Series 5', 'cat_image_9f85d1.png', 0, 1, '2023-08-11 12:15:53'),
(36, 7, 8, 'Watch Series 5', 'cat_image_79a5de.png', 0, 1, '2023-08-11 12:16:14'),
(37, 7, 8, 'Watch Series 5 Aluminum', 'cat_image_3665d0.png', 0, 1, '2023-08-11 12:16:38'),
(38, 7, 8, 'Watch Series 4', 'cat_image_8b9cc2.png', 0, 1, '2023-08-11 12:19:25'),
(39, 7, 8, 'Watch Series 4 Aluminum', 'cat_image_e1928b.png', 0, 1, '2023-08-11 12:19:49'),
(40, 7, 8, 'Watch Edition Series 3', 'cat_image_00989d.png', 0, 1, '2023-08-11 12:20:57'),
(41, 7, 8, 'Watch Series 3', 'cat_image_da04fa.png', 0, 1, '2023-08-11 12:21:56'),
(42, 7, 8, 'Watch Series 3 Aluminum', 'cat_image_16f053.png', 0, 1, '2023-08-11 12:22:57'),
(43, 7, 8, 'Watch Edition Series 2 42mm', 'cat_image_63adc2.png', 0, 1, '2023-08-11 12:28:35'),
(44, 7, 8, 'Watch Edition Series 2 38mm', 'cat_image_8822e8.png', 0, 1, '2023-08-11 12:28:52'),
(45, 7, 8, 'Watch Series 2 42mm', 'cat_image_f5f5e2.png', 0, 1, '2023-08-11 12:29:11'),
(46, 7, 8, 'Watch Series 2 38mm', 'cat_image_4b4bb8.png', 0, 1, '2023-08-11 12:37:11'),
(47, 7, 8, 'Watch Series 2 Aluminum 42mm', 'cat_image_ed4263.png', 0, 1, '2023-08-11 12:37:28'),
(48, 7, 8, 'Watch Series 1 Aluminum 42mm', 'cat_image_5483de.png', 0, 1, '2023-08-11 12:38:11'),
(49, 7, 8, 'Watch Series 2 Aluminum 38mm', 'cat_image_bd757f.png', 0, 1, '2023-08-11 12:38:57'),
(50, 7, 8, 'Watch Series 1 Aluminum 38mm', 'cat_image_c06460.png', 0, 1, '2023-08-11 12:39:11'),
(51, 7, 8, 'Watch Edition 42mm (1st gen)', 'cat_image_b08007.png', 0, 1, '2023-08-11 12:41:23'),
(52, 7, 8, 'Watch Edition 38mm (1st gen)', 'cat_image_9a9542.png', 0, 1, '2023-08-11 12:41:40'),
(53, 7, 8, 'Watch 42mm (1st gen)', 'cat_image_327358.png', 0, 1, '2023-08-11 12:41:56'),
(54, 7, 8, 'Watch 38mm (1st gen)', 'cat_image_a68305.png', 0, 1, '2023-08-11 12:42:11'),
(55, 7, 8, 'Watch Sport 42mm (1st gen)', 'cat_image_041f93.png', 0, 1, '2023-08-11 12:42:30'),
(56, 7, 8, 'Watch Sport 38mm (1st gen)', 'cat_image_8fb422.png', 0, 1, '2023-08-11 12:42:44'),
(57, 7, 9, 'Redmi Watch 3 Active', 'cat_image_92eaf6.png', 0, 1, '2023-08-16 16:14:13'),
(58, 7, 9, 'Redmi Watch 3', 'cat_image_c55731.png', 0, 1, '2023-08-16 16:14:46'),
(59, 7, 9, 'Watch S2', 'cat_image_a1d0bc.png', 0, 1, '2023-08-16 16:15:10'),
(60, 7, 9, 'Watch S1 Pro', 'cat_image_e1df5f.png', 0, 1, '2023-08-16 16:15:57'),
(61, 7, 9, 'Poco Watch', 'cat_image_e32952.png', 0, 1, '2023-08-16 16:16:54'),
(62, 7, 9, 'Watch S1 Active', 'cat_image_2aceed.png', 0, 1, '2023-08-16 16:22:33'),
(63, 7, 9, 'Redmi Watch 2 Lite', 'cat_image_8e4fa9.png', 0, 1, '2023-08-16 16:23:04'),
(64, 7, 9, 'Redmi Watch 2', 'cat_image_c9a9c5.png', 0, 1, '2023-08-16 16:23:30'),
(65, 7, 9, 'Watch Color 2', 'cat_image_9a1dbb.png', 0, 1, '2023-08-16 16:23:48'),
(66, 7, 9, 'Mi Watch Revolve Active', 'cat_image_91b438.png', 0, 1, '2023-08-16 16:24:13'),
(67, 7, 9, 'Mi Watch Lite', 'cat_image_b1b14b.png', 0, 1, '2023-08-16 16:24:33'),
(68, 7, 9, 'Redmi Watch', 'cat_image_fc3e7b.png', 0, 1, '2023-08-16 16:24:57'),
(69, 7, 9, 'Mi Watch Color Sports', 'cat_image_c38a7b.png', 0, 1, '2023-08-16 16:25:22'),
(70, 7, 9, 'Mi Watch', 'cat_image_5c0223.png', 0, 1, '2023-08-16 16:25:51'),
(71, 7, 9, 'Mi Watch Revolve', 'cat_image_bff808.png', 0, 1, '2023-08-16 16:26:12'),
(72, 7, 9, 'Watch Color', 'cat_image_a97acc.png', 0, 1, '2023-08-16 16:26:36'),
(73, 7, 9, 'Mi Watch (China)', 'cat_image_ce7aee.png', 0, 1, '2023-08-16 16:26:57'),
(74, 7, 10, 'Watch 3 Pro', 'cat_image_1fe906.png', 0, 1, '2023-08-16 16:43:32'),
(75, 7, 10, 'Watch 3', 'cat_image_431b4a.png', 0, 1, '2023-08-16 16:44:07'),
(76, 7, 10, 'Watch 2', 'cat_image_b8637e.png', 0, 1, '2023-08-16 16:44:52'),
(77, 7, 11, 'Watch 3 Pro', 'cat_image_a8a026.png', 0, 1, '2023-08-16 16:51:10'),
(78, 7, 11, 'Watch 3', 'cat_image_d97da5.png', 0, 1, '2023-08-16 16:53:45'),
(79, 7, 11, 'TechLife Watch R100', 'cat_image_5782e3.png', 0, 1, '2023-08-16 16:54:10'),
(80, 7, 11, 'TechLife Watch S100', 'cat_image_6d9de8.png', 0, 1, '2023-08-16 16:54:44'),
(81, 7, 11, 'Watch T1', 'cat_image_90163b.png', 0, 1, '2023-08-16 16:55:08'),
(82, 7, 11, 'Watch 2 Pro', 'cat_image_c68633.png', 0, 1, '2023-08-16 16:55:50'),
(83, 7, 11, 'Watch 2', 'cat_image_fe7108.png', 0, 1, '2023-08-16 16:56:23'),
(84, 7, 11, 'Watch S Pro', 'cat_image_34eaf7.png', 0, 1, '2023-08-16 16:57:06'),
(85, 7, 11, 'Watch S', 'cat_image_68343c.png', 0, 1, '2023-08-16 16:57:25'),
(86, 7, 11, 'Watch', 'cat_image_573637.png', 0, 1, '2023-08-16 16:57:48'),
(87, 7, 12, 'Watch 4 Pro', 'cat_image_ebcb3a.png', 0, 1, '2023-08-16 17:30:01'),
(88, 7, 12, 'Watch 4', 'cat_image_e51989.png', 0, 1, '2023-08-16 17:30:29'),
(89, 7, 12, 'Watch Ultimate', 'cat_image_d69c56.png', 0, 1, '2023-08-16 17:31:02'),
(90, 7, 12, 'Watch Buds', 'cat_image_6334cb.png', 0, 1, '2023-08-16 17:31:22'),
(91, 7, 12, 'Watch GT 3 SE', 'cat_image_fe76bc.png', 0, 1, '2023-08-16 17:31:51'),
(92, 7, 12, 'Watch GT Cyber', 'cat_image_507d8f.png', 0, 1, '2023-08-16 17:32:10'),
(93, 7, 12, 'Watch GT 3 Porsche Design', 'cat_image_c62565.png', 0, 1, '2023-08-16 17:32:32'),
(94, 7, 12, 'Watch GT 3 Pro', 'cat_image_7e5e75.png', 0, 1, '2023-08-16 17:32:58'),
(95, 7, 12, 'Watch D', 'cat_image_c40bd4.png', 0, 1, '2023-08-16 17:33:16'),
(96, 7, 12, 'Watch GT Runner', 'cat_image_2d0732.png', 0, 1, '2023-08-16 17:33:38'),
(97, 7, 12, 'Watch Fit mini', 'cat_image_438d31.png', 0, 1, '2023-08-16 17:33:55'),
(98, 7, 12, 'Watch GT 3', 'cat_image_f600e5.png', 0, 1, '2023-08-16 17:34:13'),
(99, 7, 12, 'Watch 3 Pro', 'cat_image_136587.png', 0, 1, '2023-08-16 17:35:10'),
(100, 7, 12, 'Watch 3', 'cat_image_1a83c4.png', 0, 1, '2023-08-16 17:35:31'),
(101, 7, 12, 'Watch Fit Elegant', 'cat_image_a973b1.png', 0, 1, '2023-08-16 17:35:49'),
(102, 7, 12, 'Watch GT 2 Porsche Design', 'cat_image_5476e7.png', 0, 1, '2023-08-16 17:36:18'),
(103, 7, 12, 'Watch GT 2 Pro', 'cat_image_4a27d6.png', 0, 1, '2023-08-16 17:36:41'),
(104, 7, 12, 'Watch Fit', 'cat_image_17b510.png', 0, 1, '2023-08-16 17:37:08'),
(105, 7, 12, 'Children\'s Watch 4X', 'cat_image_08b3a8.png', 0, 1, '2023-08-16 17:37:43'),
(106, 7, 12, 'Watch GT 2e', 'cat_image_55103e.png', 0, 1, '2023-08-16 17:38:03'),
(107, 7, 12, 'Watch GT 2', 'cat_image_25cbaa.png', 0, 1, '2023-08-16 17:38:23'),
(108, 7, 12, 'Watch Magic', 'cat_image_819491.png', 0, 1, '2023-08-16 17:38:43'),
(109, 7, 12, 'Watch GT', 'cat_image_49b6c9.png', 0, 1, '2023-08-16 17:39:10'),
(110, 7, 12, 'Watch 2 2018', 'cat_image_43ccf5.png', 0, 1, '2023-08-16 17:39:33'),
(111, 7, 12, 'Watch 2 Pro', 'cat_image_e82e90.png', 0, 1, '2023-08-16 17:39:56'),
(112, 7, 12, 'Watch 2 Classic', 'cat_image_86a16c.png', 0, 1, '2023-08-16 17:40:11'),
(113, 7, 12, 'Watch 2', 'cat_image_4118d0.png', 0, 1, '2023-08-16 17:40:31'),
(114, 7, 12, 'Watch', 'cat_image_087962.png', 0, 1, '2023-08-16 17:40:51'),
(115, 5, 14, 'Galaxy Tab S9 Ultra', 'samsung-galaxy-tab-s9-ultra-5gbf.jpg', 0, 1, '2023-08-17 12:30:25'),
(116, 5, 14, 'Galaxy Tab S9+', 'samsung-galaxy-tab-s9-plus-5g2c.jpg', 0, 1, '2023-08-17 12:32:13'),
(117, 5, 14, 'Galaxy Tab S9', 'samsung-galaxy-tab-s9-5gdb.jpg', 0, 1, '2023-08-17 12:32:37'),
(118, 5, 14, 'Galaxy Tab A7 10.4 (2022)', 'samsung-galaxy-tab-a7-104-20201f.jpg', 0, 1, '2023-08-17 12:42:52'),
(119, 5, 14, 'Galaxy Tab Active4 Pro', 'samsung-galaxy-tab-active4-pro90.jpg', 0, 1, '2023-08-17 12:44:02'),
(120, 5, 14, 'Galaxy Tab S6 Lite (2022)', 'galaxy-tab-s6-lite-2022-lte-sm-p619-27.jpg', 0, 1, '2023-08-17 15:59:55'),
(121, 5, 14, 'Galaxy Tab S8 Ultra', 'samsung-galaxy-tab-s8-ultra1a.jpg', 0, 1, '2023-08-17 16:01:54'),
(122, 5, 14, 'Galaxy Tab S8+', 'samsung-galaxy-tab-s8-plus05.jpg', 0, 1, '2023-08-17 16:02:15'),
(123, 5, 14, 'Galaxy Tab S8', 'samsung-galaxy-tab-s82e.jpg', 0, 1, '2023-08-17 16:02:35'),
(124, 5, 14, 'Galaxy Tab A8 10.5 (2021)', 'samsung-galaxy-tab-a8-105-2021-newb3.jpg', 0, 1, '2023-08-17 16:04:32'),
(125, 5, 14, 'Galaxy Tab A7 Lite', 'samsung-galaxy-tab-a7-lited6.jpg', 0, 1, '2023-08-17 16:04:56'),
(126, 5, 14, 'Galaxy Tab S7 FE', 'samsung-galaxy-tab-s7-fe27.jpg', 0, 1, '2023-08-17 16:05:19'),
(127, 5, 14, 'Galaxy Tab Active3', 'samsung-galaxy-tab-active3f0.jpg', 0, 1, '2023-08-17 16:05:35'),
(128, 5, 14, 'Galaxy Tab A7 10.4 (2020)', 'samsung-galaxy-tab-a7-104-202095.jpg', 0, 1, '2023-08-17 16:06:04'),
(129, 5, 14, 'Galaxy Tab S7+', 'samsung-galaxy-tab-s7-plus17b.jpg', 0, 1, '2023-08-17 16:06:30'),
(130, 5, 14, 'Galaxy Tab S7', 'samsung-galaxy-tab-s7-1fd.jpg', 0, 1, '2023-08-17 16:06:51'),
(131, 5, 14, 'Galaxy Tab A 8.4 (2020)', 'samsung-galaxy-tab-a-84-2020c0.jpg', 0, 1, '2023-08-17 16:08:16'),
(132, 5, 14, 'Galaxy Tab S6 Lite', 'galaxy-tab-s6-lite3f.jpg', 0, 1, '2023-08-17 16:08:55'),
(133, 5, 14, 'Galaxy Tab S6 5G', 'samsung-galaxy-tab-s6-5g-sm-t866ndd.jpg', 0, 1, '2023-08-17 16:09:14'),
(134, 5, 14, 'Galaxy Tab Active Pro', 'samsung-galaxy-tab-active-pro-sm-t54799.jpg', 0, 1, '2023-08-17 16:09:31'),
(135, 5, 14, 'Galaxy Tab S6', 'samsung-galaxy-tab-s62d.jpg', 0, 1, '2023-08-17 16:09:48'),
(136, 5, 14, 'Galaxy Tab A 8.0 (2019)', 'samsung-galaxy-tab-a-80-2019-r47.jpg', 0, 1, '2023-08-17 16:10:08'),
(137, 5, 14, 'Galaxy Tab S5e', 'samsung-galaxy-tab-s5e-sm-t72517.jpg', 0, 1, '2023-08-17 16:10:26'),
(138, 5, 14, 'Galaxy Tab A 10.1 (2019)', 'samsung-galaxy-tab-a-101-2019b6.jpg', 0, 1, '2023-08-17 16:11:21'),
(139, 5, 14, 'Galaxy Tab A 8.0 & S Pen (2019)', 'samsung-galaxy-tab-a-80-2019-rc7.jpg', 0, 1, '2023-08-17 16:12:10'),
(140, 5, 14, 'Galaxy Tab Advanced2', 'samsung-galaxy-tab-advanced2-sm-t58308.jpg', 0, 1, '2023-08-17 16:12:32'),
(141, 5, 14, 'Galaxy Tab A 8.0 (2018)', 'samsung-galaxy-tab-a-80-2019-ra2.jpg', 0, 1, '2023-08-17 16:13:15'),
(142, 5, 14, 'Galaxy Tab S4 10.5', 'samsung-galaxy-tab-s4-2018-r9f.jpg', 0, 1, '2023-08-17 16:13:58'),
(143, 5, 14, 'Galaxy Tab A 10.5', 'samsung-galaxy-tab-a-105-54.jpg', 0, 1, '2023-08-17 16:20:23'),
(144, 5, 14, 'Galaxy Tab Active 2', 'samsung-galaxy-tab-active290.jpg', 0, 1, '2023-08-17 16:21:03'),
(145, 5, 14, 'Galaxy Tab A 8.0 (2017)', 'samsung-galaxy-tab-a-8-0-2017-t385-sm-t38533.jpg', 0, 1, '2023-08-17 16:21:19'),
(146, 5, 14, 'Galaxy Tab S3 9.7', 'samsung-galaxy-tab-s3-97-sm-t8259d.jpg', 0, 1, '2023-08-17 16:21:33'),
(147, 5, 14, 'Galaxy Tab J', 'samsung-galaxy-tab-advanced2-sm-t58326.jpg', 0, 1, '2023-08-17 16:22:21'),
(148, 5, 14, 'Galaxy Tab A 10.1 (2016)', 'samsung-galaxy-tab-a-101-201601.jpg', 0, 1, '2023-08-17 16:22:46'),
(149, 5, 14, 'Galaxy Tab A 7.0 (2016)', 'samsung-galaxy-tab-a-70-2016-cb.jpg', 0, 1, '2023-08-17 16:22:59'),
(150, 5, 14, 'Galaxy Tab E 8.0', 'samsung-galaxy-tab-e-80a1.jpg', 0, 1, '2023-08-17 16:23:13'),
(151, 5, 14, 'Galaxy Tab S2 9.7', 'samsung-galaxy-tab-s2-97d1.jpg', 0, 1, '2023-08-17 16:23:30'),
(152, 5, 14, 'Galaxy Tab S2 8.0', 'samsung-galaxy-tab-s2-80r1dd.jpg', 0, 1, '2023-08-17 16:23:46'),
(153, 5, 14, 'Galaxy Tab 4 10.1 (2015)', 'samsung-galaxy-tab-4-101-2015a0.jpg', 0, 1, '2023-08-17 16:31:35'),
(154, 5, 14, 'Galaxy Tab E 9.6', 'samsung-galaxy-tab-e-sm-t56152.jpg', 0, 1, '2023-08-17 16:38:48'),
(155, 5, 14, 'Galaxy Tab 3 V', 'samsung-galaxy-tab-3-v5a.jpg', 0, 1, '2023-08-17 16:38:59'),
(156, 5, 14, 'Galaxy Tab A 9.7 & S Pen', 'samsung-galaxy-tab-a-and-s-penc8.jpg', 0, 1, '2023-08-17 16:39:11'),
(157, 5, 14, 'Galaxy Tab A 9.7', 'samsung-galaxy-tab-a-and-s-pen02.jpg', 0, 1, '2023-08-17 16:39:21'),
(158, 5, 14, 'Galaxy Tab A 8.0 & S Pen (2015)', 'samsung-galaxy-tab-a-80a0.jpg', 0, 1, '2023-08-17 16:39:31'),
(159, 5, 14, 'Galaxy Tab A 8.0 (2015)', 'samsung-galaxy-tab-a-80-p3559a.jpg', 0, 1, '2023-08-17 16:39:41'),
(160, 5, 14, 'Galaxy Tab 3 Lite 7.0 VE', 'samsung-galaxy-tab-3-lite (1)b1.jpg', 0, 1, '2023-08-17 16:39:59'),
(161, 5, 14, 'Galaxy Tab Active LTE', 'samsung-galaxy-tab-activef5.jpg', 0, 1, '2023-08-17 16:40:12'),
(162, 5, 14, 'Galaxy Tab Active', 'samsung-galaxy-tab-active12.jpg', 0, 1, '2023-08-17 16:40:21'),
(163, 5, 14, 'Galaxy Tab 4 8.0 (2015)', 'samsung-galaxy-tab-4-80 (1)63.jpg', 0, 1, '2023-08-17 16:40:34'),
(164, 5, 14, 'Galaxy Tab S 8.4 LTE', 'samsung-galaxy-tab-s-8.486.jpg', 0, 1, '2023-08-17 16:40:46'),
(165, 5, 14, 'Galaxy Tab S 8.4', 'samsung-galaxy-tab-s-8.423.jpg', 0, 1, '2023-08-17 16:40:55'),
(166, 5, 14, 'Galaxy Tab S 10.5 LTE', 'samsung-galaxy-tab-s-10585.jpg', 0, 1, '2023-08-17 16:41:05'),
(167, 5, 14, 'Galaxy Tab S 10.5', 'samsung-galaxy-tab-s-10506.jpg', 0, 1, '2023-08-17 16:41:14'),
(168, 5, 14, 'Galaxy Tab 4 7.0', 'samsung-galaxy-tab-4-1015e.jpg', 0, 1, '2023-08-17 16:41:42'),
(169, 5, 14, 'Galaxy Tab 4 7.0 3G', 'samsung-galaxy-tab-4-1012c.jpg', 0, 1, '2023-08-17 16:41:51'),
(170, 5, 14, 'Galaxy Tab 4 7.0 LTE', 'samsung-galaxy-tab-4-101b4.jpg', 0, 1, '2023-08-17 16:42:01'),
(171, 5, 14, 'Galaxy Tab 4 8.0', 'samsung-galaxy-tab-4-8023.jpg', 0, 1, '2023-08-17 16:42:17'),
(172, 5, 14, 'Galaxy Tab 4 8.0 3G', 'samsung-galaxy-tab-4-80b6.jpg', 0, 1, '2023-08-17 16:42:31'),
(173, 5, 14, 'Galaxy Tab 4 8.0 LTE', 'samsung-galaxy-tab-4-80eb.jpg', 0, 1, '2023-08-17 16:42:37'),
(174, 5, 14, 'Galaxy Tab 4 10.1', 'samsung-galaxy-tab-4-10121.jpg', 0, 1, '2023-08-17 16:42:48'),
(175, 5, 14, 'Galaxy Tab 4 10.1 3G', 'samsung-galaxy-tab-4-10164.jpg', 0, 1, '2023-08-17 16:43:01'),
(176, 5, 14, 'Galaxy Tab 4 10.1 LTE', 'samsung-galaxy-tab-4-101d0.jpg', 0, 1, '2023-08-17 16:43:16'),
(177, 5, 14, 'Galaxy Tab 3 Lite 7.0 3G', 'samsung-galaxy-tab-3-lite3a.jpg', 0, 1, '2023-08-17 16:43:26'),
(178, 5, 14, 'Galaxy Tab 3 Lite 7.0', 'samsung-galaxy-tab-3-lite-3ge2.jpg', 0, 1, '2023-08-17 16:43:39'),
(179, 5, 14, 'Galaxy Tab Pro 12.2 LTE', 'samsung-tab-pro-12217.jpg', 0, 1, '2023-08-17 16:43:53'),
(180, 5, 14, 'Galaxy Tab Pro 12.2 3G', 'samsung-tab-pro-122da.jpg', 0, 1, '2023-08-17 16:44:02'),
(181, 5, 14, 'Galaxy Tab Pro 12.2', 'samsung-tab-pro-12236.jpg', 0, 1, '2023-08-17 16:44:18'),
(182, 5, 14, 'Galaxy Tab Pro 10.1 LTE', 'samsung-tab-pro-101f5.jpg', 0, 1, '2023-08-17 16:44:30'),
(183, 5, 14, 'Galaxy Tab Pro 10.1', 'samsung-tab-pro-101fa.jpg', 0, 1, '2023-08-17 16:44:41'),
(184, 5, 14, 'Galaxy Tab Pro 8.4 3G/LTE', 'samsung-tab-pro-844e.jpg', 0, 1, '2023-08-17 16:44:51'),
(185, 5, 14, 'Galaxy Tab Pro 8.4', 'samsung-tab-pro-84d2.jpg', 0, 1, '2023-08-17 16:45:06'),
(186, 5, 14, 'Galaxy Tab 3 8.0', 'samsung-galaxy-tab-3-80-ofic27.jpg', 0, 1, '2023-08-17 16:51:21'),
(187, 5, 14, 'Galaxy Tab 3 10.1 P5220', 'samsung-galaxy-tab-3-101-p5200ed.jpg', 0, 1, '2023-08-17 16:51:35'),
(188, 5, 14, 'Galaxy Tab 3 10.1 P5200', 'samsung-galaxy-tab-3-101-p520067.jpg', 0, 1, '2023-08-17 16:51:50'),
(189, 5, 14, 'Galaxy Tab 3 10.1 P5210', 'samsung-galaxy-tab-3-101-p520094.jpg', 0, 1, '2023-08-17 16:52:00'),
(190, 5, 14, 'Galaxy Tab 3 7.0 WiFi', 'samsung-galaxy-tab-3-70-3g44.jpg', 0, 1, '2023-08-17 16:52:22'),
(191, 5, 14, 'Galaxy Tab 3 7.0', 'samsung-galaxy-tab-3-70-3gfe.jpg', 0, 1, '2023-08-17 16:52:33'),
(192, 5, 14, 'Ativ Tab P8510', 'samsung-ativ-tabf6.jpg', 0, 1, '2023-08-17 16:52:43'),
(193, 5, 14, 'Galaxy Tab 2 7.0 I705', 'samsung-galaxy-tab-2-sch-i70560.jpg', 0, 1, '2023-08-17 16:52:52'),
(194, 5, 14, 'Galaxy Tab 2 10.1 CDMA', 'samsung-galaxy-tab-2-101d7.jpg', 0, 1, '2023-08-17 16:53:11'),
(195, 5, 14, 'Galaxy Tab 2 10.1 P5110', 'samsung-galaxy-tab-2-10126.jpg', 0, 1, '2023-08-17 16:53:20'),
(196, 5, 14, 'Galaxy Tab 2 10.1 P5100', 'samsung-galaxy-tab-2-1014a.jpg', 0, 1, '2023-08-17 16:53:31'),
(197, 5, 14, 'Galaxy Tab 2 7.0 P3110', 'samsung-galaxy-tab-2f1.jpg', 0, 1, '2023-08-17 16:53:43'),
(198, 5, 14, 'Galaxy Tab 2 7.0 P3100', 'samsung-galaxy-tab-2f8.jpg', 0, 1, '2023-08-17 16:53:56'),
(199, 5, 16, 'iPad Pro 12.9 (2022)', 'apple-ipad-pro-129-202240.jpg', 0, 1, '2023-08-17 19:00:10'),
(200, 5, 16, 'iPad Pro 11 (2022)', 'apple-ipad-pro-11-2022a6.jpg', 0, 1, '2023-08-17 19:02:11'),
(201, 5, 16, 'iPad (2022)', 'apple-ipad-10-2022c1.jpg', 0, 1, '2023-08-17 19:02:53'),
(202, 5, 16, 'iPad Air (2022)', 'apple-ipad-air-2022-newfe.jpg', 0, 1, '2023-08-17 19:03:11'),
(203, 5, 16, 'iPad mini (2021)', 'apple-ipad-mini-20217d.jpg', 0, 1, '2023-08-17 19:03:26'),
(204, 5, 16, 'iPad 10.2 (2021)', 'apple-ipad-102-2021-7b.jpg', 0, 1, '2023-08-17 19:03:37'),
(205, 5, 16, 'iPad Pro 12.9 (2021)', 'apple-ipad-pro-129-2021b2.jpg', 0, 1, '2023-08-17 19:03:48'),
(206, 5, 16, 'iPad Pro 11 (2021)', 'apple-ipad-pro-11-20213c.jpg', 0, 1, '2023-08-17 19:04:03'),
(207, 5, 16, 'iPad Air (2020)', 'apple-ipad-air4-20200c.jpg', 0, 1, '2023-08-17 19:04:17'),
(208, 5, 16, 'iPad 10.2 (2020)', 'apple-ipad8-102-inches-202021.jpg', 0, 1, '2023-08-17 19:04:27'),
(209, 5, 16, 'iPad Pro 12.9 (2020)', 'apple-ipad-pro-12-2020a8.jpg', 0, 1, '2023-08-17 19:04:37'),
(210, 5, 16, 'iPad Pro 11 (2020)', 'apple-ipad-pro-11-202091.jpg', 0, 1, '2023-08-17 19:04:47'),
(211, 5, 16, 'iPad 10.2 (2019)', 'apple-ipad7-102-inchesec.jpg', 0, 1, '2023-08-17 19:05:00'),
(212, 5, 16, 'iPad Air (2019)', 'apple-ipad-air3-20198a.jpg', 0, 1, '2023-08-17 19:05:13'),
(213, 5, 16, 'iPad mini (2019)', 'apple-ipad-mini-2019c1.jpg', 0, 1, '2023-08-17 19:05:23'),
(214, 5, 16, 'iPad Pro 12.9 (2018)', 'apple-ipad-pro-129-201826.jpg', 0, 1, '2023-08-17 19:05:35'),
(215, 5, 16, 'iPad Pro 11 (2018)', 'apple-ipad-pro-11-20189a.jpg', 0, 1, '2023-08-17 19:05:46'),
(216, 5, 16, 'iPad 9.7 (2018)', 'apple-ipad-97-201828.jpg', 0, 1, '2023-08-17 19:05:57'),
(217, 5, 16, 'iPad Pro 12.9 (2017)', 'apple-ipad-pro-129-201711.jpg', 0, 1, '2023-08-17 19:10:42'),
(218, 5, 16, 'iPad Pro 10.5 (2017)', 'apple-ipad-pro-105-20175b.jpg', 0, 1, '2023-08-17 19:10:52'),
(219, 5, 16, 'iPad 9.7 (2017)', 'apple-ipad-97-201727.jpg', 0, 1, '2023-08-17 19:11:02'),
(220, 5, 16, 'iPad Pro 9.7 (2016)', 'apple-ipad-pro-9788.jpg', 0, 1, '2023-08-17 19:11:14'),
(221, 5, 16, 'iPad Pro 12.9 (2015)', 'apple-ipad-pro-2b.jpg', 0, 1, '2023-08-17 19:11:28'),
(222, 5, 16, 'iPad mini 4 (2015)', 'ipad-mini-4186.jpg', 0, 1, '2023-08-17 19:11:39'),
(223, 5, 16, 'iPad Air 2', 'apple-ipad-air-2-new68.jpg', 0, 1, '2023-08-17 19:11:53'),
(224, 5, 16, 'iPad mini 3', 'apple-ipad-mini-3-new3a.jpg', 0, 1, '2023-08-17 19:12:04'),
(225, 5, 16, 'iPad Air', 'apple-ipad-air68.jpg', 0, 1, '2023-08-17 19:12:15'),
(226, 5, 16, 'iPad mini 2', 'apple-ipad-mini29b.jpg', 0, 1, '2023-08-17 19:12:24'),
(227, 5, 16, 'iPad mini Wi-Fi', 'apple-ipad-mini-final31.jpg', 0, 1, '2023-08-17 19:12:41'),
(228, 5, 16, 'iPad mini Wi-Fi + Cellular', 'apple-ipad-3-new (3)64.jpg', 0, 1, '2023-08-17 19:12:55'),
(229, 5, 16, 'iPad 4 Wi-Fi', 'apple-ipad-3-new (1)50.jpg', 0, 1, '2023-08-17 19:13:06'),
(230, 5, 16, 'iPad 4 Wi-Fi + Cellular', 'apple-ipad-3-new35.jpg', 0, 1, '2023-08-17 19:13:18'),
(231, 5, 16, 'iPad 3 Wi-Fi + Cellular', 'apple-ipad-3-newb9.jpg', 0, 1, '2023-08-17 19:13:30'),
(232, 5, 16, 'iPad 3 Wi-Fi', 'apple-ipad-3-new26.jpg', 0, 1, '2023-08-17 19:13:40'),
(233, 5, 16, 'iPad 2 Wi-Fi + 3G', 'apple-ipad2-new (2)f2.jpg', 0, 1, '2023-08-17 19:13:50'),
(234, 5, 16, 'iPad 2 Wi-Fi', 'apple-ipad2-new (1)8d.jpg', 0, 1, '2023-08-17 19:14:01'),
(235, 5, 16, 'iPad 2 CDMA', 'apple-ipad2-new41.jpg', 0, 1, '2023-08-17 19:14:10'),
(236, 5, 16, 'iPad Wi-Fi + 3G', 'apple-ipad-original27.jpg', 0, 1, '2023-08-17 19:14:20'),
(237, 5, 16, 'iPad Wi-Fi', 'apple-ipad-original8e.jpg', 0, 1, '2023-08-17 19:14:32'),
(238, 5, 17, 'Pad 6 Pro', 'xiaomi-pad6-pro48.jpg', 0, 1, '2023-08-18 10:18:51'),
(239, 5, 17, 'Pad 6', 'xiaomi-pad612.jpg', 0, 1, '2023-08-18 10:19:09'),
(240, 5, 17, 'Redmi Pad', 'xiaomi-redmi-pad72.jpg', 0, 1, '2023-08-18 10:22:38'),
(241, 5, 17, 'Pad 5 Pro 12.4', 'xiaomi-mi-pad-5-pro-124b3.jpg', 0, 1, '2023-08-18 10:24:47'),
(242, 5, 17, 'Pad 5 Pro', 'xiaomi-pad-5-proc6.jpg', 0, 1, '2023-08-18 10:24:59'),
(243, 5, 17, 'Pad 5', 'xiaomi-pad-546.jpg', 0, 1, '2023-08-18 10:25:11'),
(244, 5, 17, 'Mi Pad 4 Plus', 'xiaomi-mi-pad-4-plus73.jpg', 0, 1, '2023-08-18 10:25:21'),
(245, 5, 17, 'Mi Pad 4', 'cat_image_acc4bd.jpg', 0, 1, '2023-08-18 10:25:47'),
(246, 5, 17, 'Mi Pad 3', 'xiaomi-mi-pad-3-152.jpg', 0, 1, '2023-08-18 10:25:58'),
(247, 5, 17, 'Mi Pad 2', 'xiaomi-mi-pad-22d.jpg', 0, 1, '2023-08-18 10:26:18'),
(248, 5, 17, 'Mi Pad 7.9', 'xiaomi-mi-pad-79de.jpg', 0, 1, '2023-08-18 10:26:31'),
(249, 5, 18, 'Pad 2', 'oppo-pad2-92.jpg', 0, 1, '2023-08-18 10:31:41'),
(250, 5, 18, 'Pad Air', 'oppo-pad-airca.jpg', 0, 1, '2023-08-18 10:31:59'),
(251, 5, 18, 'Pad', 'oppo-pad4f.jpg', 0, 1, '2023-08-18 10:32:11'),
(252, 5, 19, 'Pad 2', 'realme-pad22f.jpg', 0, 1, '2023-08-18 10:44:39'),
(253, 5, 19, 'Pad X', 'realme-pad-xf3.jpg', 0, 1, '2023-08-18 10:45:22'),
(254, 5, 19, 'Pad Mini', 'realme-pad-mini6a.jpg', 0, 1, '2023-08-18 10:47:02'),
(255, 5, 20, 'MatePad 11.5', 'huawei-matepad-1150b.jpg', 0, 1, '2023-08-18 11:39:52'),
(256, 5, 20, 'MatePad Air', 'huawei-matepad-air0e.jpg', 0, 1, '2023-08-18 11:40:40'),
(257, 5, 20, 'MatePad 11 (2023)', 'huawei-matepad-11-2023d1.jpg', 0, 1, '2023-08-18 11:40:48'),
(258, 5, 20, 'MatePad C5e', 'huawei-matepad-se (1)23.jpg', 0, 1, '2023-08-18 11:41:32'),
(259, 5, 20, 'MatePad Pro 11 (2022)', 'huawei-matepad-pro-11-2022-ofic79.jpg', 0, 1, '2023-08-18 11:41:47'),
(260, 5, 20, 'MatePad 10.4 (2022)', 'huawei-matepad-104-20222c.jpg', 0, 1, '2023-08-18 11:41:58'),
(261, 5, 20, 'Mate Xs 2', 'huawei-mate-xs-220.jpg', 0, 1, '2023-08-18 11:42:11'),
(262, 5, 20, 'MatePad SE', 'huawei-matepad-se5a.jpg', 0, 1, '2023-08-18 11:42:24'),
(263, 5, 20, 'MatePad Pro 12.6 (2021)', 'huawei-matepad-pro-126-2021-new3b.jpg', 0, 1, '2023-08-18 11:42:35'),
(264, 5, 20, 'MatePad Pro 10.8 (2021)', 'huawei-matepad-pro-108-2021-new3c.jpg', 0, 1, '2023-08-18 11:42:45'),
(265, 5, 20, 'MatePad 11 (2021)', 'huawei-matepad-11-202193.jpg', 0, 1, '2023-08-18 11:43:01'),
(266, 5, 20, 'MatePad T 10', 'huawei-t105f.jpg', 0, 1, '2023-08-18 11:43:14'),
(267, 5, 20, 'MatePad 5G', 'huawei-matepad-5ge2.jpg', 0, 1, '2023-08-18 11:43:22'),
(268, 5, 20, 'MatePad 10.8', 'huawei-matepad-10899.jpg', 0, 1, '2023-08-18 11:43:31'),
(269, 5, 20, 'MatePad T 10s', 'huawei-enjoy-tablet269.jpg', 0, 1, '2023-08-18 11:43:54'),
(270, 5, 20, 'Enjoy Tablet 2', 'huawei-enjoy-tablet267.jpg', 0, 1, '2023-08-18 11:44:33'),
(271, 5, 20, 'MatePad T8', 'huawei-mediapad-t8a7.jpg', 0, 1, '2023-08-18 12:01:22'),
(272, 5, 20, 'MatePad 10.4', 'huawei-matepad-10.40d.jpg', 0, 1, '2023-08-18 12:01:31'),
(273, 5, 20, 'MatePad Pro 10.8 5G (2019)', 'huawei-matepad-pro (1)85.jpg', 0, 1, '2023-08-18 12:01:42'),
(274, 5, 20, 'Mate Xs', 'huawei-mate-xs-e0.jpg', 0, 1, '2023-08-18 12:01:54'),
(275, 5, 20, 'MatePad Pro 10.8 (2019)', 'huawei-matepad-pro31.jpg', 0, 1, '2023-08-18 12:02:07'),
(276, 5, 20, 'Mate X', 'cat_image_8db543.jpg', 0, 1, '2023-08-18 12:04:35'),
(277, 5, 20, 'MediaPad M6 10.8', 'huawei-mediapad-m6-1085f.jpg', 0, 1, '2023-08-18 12:03:19'),
(278, 5, 20, 'MediaPad M6 Turbo 8.4', 'huawei-mediapad-m6-turbo09.jpg', 0, 1, '2023-08-18 12:03:31'),
(279, 5, 20, 'MediaPad M6 8.4', 'cat_image_c1808e.jpg', 0, 1, '2023-08-18 12:04:45'),
(280, 5, 20, 'MediaPad M5 Lite 8', 'huawei-mediapad-m5-lite-8-inch9e.jpg', 0, 1, '2023-08-18 12:03:56'),
(281, 5, 20, 'MediaPad T5', 'huawei-mediapad-t58f.jpg', 0, 1, '2023-08-18 12:05:20'),
(282, 5, 20, 'MediaPad M5 lite', 'huawei-mediapad-m5-litecd.jpg', 0, 1, '2023-08-18 12:05:30'),
(283, 5, 20, 'MediaPad M5 10 (Pro)', 'huawei-mediapad-m5-10 (1)d1.jpg', 0, 1, '2023-08-18 12:05:40'),
(284, 5, 20, 'MediaPad M5 10', 'huawei-mediapad-m5-1082.jpg', 0, 1, '2023-08-18 12:05:54'),
(285, 5, 20, 'MediaPad M5 8', 'huawei-mediapad-m5-85c.jpg', 0, 1, '2023-08-18 12:06:05'),
(286, 5, 20, 'MediaPad M3 Lite 8', 'huawei-mediapad-m3-8-lite2f.jpg', 0, 1, '2023-08-18 12:06:56'),
(287, 5, 20, 'MediaPad T3 10', 'huawei-mediapad-t3-10cd.jpg', 0, 1, '2023-08-18 12:07:08'),
(288, 5, 20, 'MediaPad M3 Lite 10', 'huawei-mediapad-m3-10-litea0.jpg', 0, 1, '2023-08-18 12:07:17'),
(289, 5, 20, 'MediaPad T3 8.0', 'huawei-mediapad-t3-8b0.jpg', 0, 1, '2023-08-18 12:07:27'),
(290, 5, 20, 'MediaPad T3 7.0', 'huawei-mediapad-t3-7-7c.jpg', 0, 1, '2023-08-18 12:07:37'),
(291, 5, 20, 'MediaPad M3 8.4', 'huawei-mediapad-t3-8ce.jpg', 0, 1, '2023-08-18 12:08:16'),
(292, 5, 20, 'MediaPad T2 10.0 Pro', 'huawei-mediapad-t2-10-proc5.jpg', 0, 1, '2023-08-18 12:08:29'),
(293, 5, 20, 'MediaPad T2 7.0 Pro', 'huawei-mediapad-t2-probc.jpg', 0, 1, '2023-08-18 12:09:05'),
(294, 5, 20, 'MediaPad T2 7.0', 'huawei-mediapad-t22d.jpg', 0, 1, '2023-08-18 12:09:16'),
(295, 5, 20, 'MediaPad T1 7.0 Plus', 'huawei-mediapad-t1-70 (1)59.jpg', 0, 1, '2023-08-18 12:09:26'),
(296, 5, 20, 'MediaPad M2 7.0', 'huawei-mediapad-m2-70ac.jpg', 0, 1, '2023-08-18 12:09:38'),
(297, 5, 20, 'MediaPad M2 10.0', 'huawei-mediapad-m2-10-1c.jpg', 0, 1, '2023-08-18 12:09:48'),
(298, 5, 20, 'MediaPad M2 8.0', 'huawei-mediapad-m2fe.jpg', 0, 1, '2023-08-18 12:09:58'),
(299, 5, 20, 'MediaPad X2', 'Huawei-MediaPad-X271.jpg', 0, 1, '2023-08-18 12:10:09'),
(300, 5, 20, 'MediaPad T1 10', 'huawei-mediapad-t1-105e.jpg', 0, 1, '2023-08-18 12:10:17'),
(301, 5, 20, 'MediaPad T1 8.0', 'Huawei-Honor-Tablet115.jpg', 0, 1, '2023-08-18 12:10:35'),
(302, 5, 20, 'MediaPad T1 7.0', 'huawei-mediapad-t1-701f.jpg', 0, 1, '2023-08-18 12:10:51'),
(303, 5, 20, 'MediaPad 10 Link+', 'Huawei-MediaPad-101-Link-plus4a.jpg', 0, 1, '2023-08-18 12:11:02'),
(304, 5, 20, 'MediaPad M1', 'huawei-mediapad-m1f7.jpg', 0, 1, '2023-08-18 12:11:08'),
(305, 5, 20, 'MediaPad X1', 'huawei-mediapad-x1-newce.jpg', 0, 1, '2023-08-18 12:11:17'),
(306, 5, 20, 'MediaPad 7 Youth2', 'huawei-mediapad-7-youth223.jpg', 0, 1, '2023-08-18 12:11:26'),
(307, 5, 20, 'MediaPad 7 Youth', 'huawei-mediapad-7-youth5b.jpg', 0, 1, '2023-08-18 12:11:34'),
(308, 5, 20, 'MediaPad 7 Vogue', 'huawei-mediapad-7-vogue79.jpg', 0, 1, '2023-08-18 12:11:43'),
(309, 2, 21, 'Galaxy Z Fold5', 'samsung-galaxy-z-fold5-5g89.jpg', 0, 1, '2023-08-18 13:03:06'),
(310, 2, 21, 'Galaxy M34 5G', 'samsung-galaxy-m54-5g.jpg', 0, 1, '2023-08-18 13:06:20'),
(311, 2, 21, 'galaxy a01', 'samsung-galaxy-a01.jpg', 0, 1, '2023-08-19 15:20:16'),
(312, 2, 21, 'galaxy a01core sm a013', 'samsung-galaxy-a01core-sm-a013.jpg', 0, 1, '2023-08-19 15:20:16'),
(313, 2, 21, 'galaxy a02', 'samsung-galaxy-a02.jpg', 0, 1, '2023-08-19 15:20:16'),
(314, 2, 21, 'galaxy a02s sm a025 new', 'samsung-galaxy-a02s-sm-a025-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(315, 2, 21, 'galaxy a03 core', 'samsung-galaxy-a03-core.jpg', 0, 1, '2023-08-19 15:20:16'),
(316, 2, 21, 'galaxy a03', 'samsung-galaxy-a03.jpg', 0, 1, '2023-08-19 15:20:16'),
(317, 2, 21, 'galaxy a03s', 'samsung-galaxy-a03s.jpg', 0, 1, '2023-08-19 15:20:16'),
(318, 2, 21, 'galaxy a04', 'samsung-galaxy-a04.jpg', 0, 1, '2023-08-19 15:20:16'),
(319, 2, 21, 'galaxy a04e', 'samsung-galaxy-a04e.jpg', 0, 1, '2023-08-19 15:20:16'),
(320, 2, 21, 'galaxy a04s', 'samsung-galaxy-a04s.jpg', 0, 1, '2023-08-19 15:20:16'),
(321, 2, 21, 'galaxy a10', 'samsung-galaxy-a10.jpg', 0, 1, '2023-08-19 15:20:16'),
(322, 2, 21, 'galaxy a10e sm a102u', 'samsung-galaxy-a10e-sm-a102u.jpg', 0, 1, '2023-08-19 15:20:16'),
(323, 2, 21, 'galaxy a10s', 'samsung-galaxy-a10s.jpg', 0, 1, '2023-08-19 15:20:16'),
(324, 2, 21, 'galaxy a11', 'samsung-galaxy-a11.jpg', 0, 1, '2023-08-19 15:20:16'),
(325, 2, 21, 'galaxy a12 nacho', 'samsung-galaxy-a12-nacho.jpg', 0, 1, '2023-08-19 15:20:16'),
(326, 2, 21, 'galaxy a12 sm a125', 'samsung-galaxy-a12-sm-a125.jpg', 0, 1, '2023-08-19 15:20:16'),
(327, 2, 21, 'galaxy a13 5g ', 'samsung-galaxy-a13-5g-.jpg', 0, 1, '2023-08-19 15:20:16'),
(328, 2, 21, 'galaxy a13 a137', 'samsung-galaxy-a13-a137.jpg', 0, 1, '2023-08-19 15:20:16'),
(329, 2, 21, 'galaxy a13', 'samsung-galaxy-a13.jpg', 0, 1, '2023-08-19 15:20:16'),
(330, 2, 21, 'galaxy a14 4g', 'samsung-galaxy-a14-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(331, 2, 21, 'galaxy a14 5g', 'samsung-galaxy-a14-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(332, 2, 21, 'galaxy a2 core sm a260f', 'samsung-galaxy-a2-core-sm-a260f.jpg', 0, 1, '2023-08-19 15:20:16'),
(333, 2, 21, 'galaxy a20', 'samsung-galaxy-a20.jpg', 0, 1, '2023-08-19 15:20:16'),
(334, 2, 21, 'galaxy a20e', 'samsung-galaxy-a20e.jpg', 0, 1, '2023-08-19 15:20:16'),
(335, 2, 21, 'galaxy a20s sm a207', 'samsung-galaxy-a20s-sm-a207.jpg', 0, 1, '2023-08-19 15:20:16'),
(336, 2, 21, 'galaxy a21 r', 'samsung-galaxy-a21-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(337, 2, 21, 'galaxy a21s ', 'samsung-galaxy-a21s-.jpg', 0, 1, '2023-08-19 15:20:16'),
(338, 2, 21, 'galaxy a22 5g', 'samsung-galaxy-a22-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(339, 2, 21, 'galaxy a22', 'samsung-galaxy-a22.jpg', 0, 1, '2023-08-19 15:20:16'),
(340, 2, 21, 'galaxy a23 5g', 'samsung-galaxy-a23-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(341, 2, 21, 'galaxy a23', 'samsung-galaxy-a23.jpg', 0, 1, '2023-08-19 15:20:16'),
(342, 2, 21, 'galaxy a24 4g 2', 'samsung-galaxy-a24-4g-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(343, 2, 21, 'galaxy a3 2016', 'samsung-galaxy-a3-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(344, 2, 21, 'galaxy a3 2017', 'samsung-galaxy-a3-2017.jpg', 0, 1, '2023-08-19 15:20:16'),
(345, 2, 21, 'galaxy a30', 'samsung-galaxy-a30.jpg', 0, 1, '2023-08-19 15:20:16'),
(346, 2, 21, 'galaxy a30s', 'samsung-galaxy-a30s.jpg', 0, 1, '2023-08-19 15:20:16'),
(347, 2, 21, 'galaxy a31', 'samsung-galaxy-a31.jpg', 0, 1, '2023-08-19 15:20:16'),
(348, 2, 21, 'galaxy a32 4g new', 'samsung-galaxy-a32-4g-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(349, 2, 21, 'galaxy a32 5g', 'samsung-galaxy-a32-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(350, 2, 21, 'galaxy a33 5g', 'samsung-galaxy-a33-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(351, 2, 21, 'galaxy a34', 'samsung-galaxy-a34.jpg', 0, 1, '2023-08-19 15:20:16'),
(352, 2, 21, 'galaxy a40', 'samsung-galaxy-a40.jpg', 0, 1, '2023-08-19 15:20:16'),
(353, 2, 21, 'galaxy a41', 'samsung-galaxy-a41.jpg', 0, 1, '2023-08-19 15:20:16'),
(354, 2, 21, 'galaxy a42 5g', 'samsung-galaxy-a42-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(355, 2, 21, 'galaxy a5 2016', 'samsung-galaxy-a5-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(356, 2, 21, 'galaxy a5 2017 new', 'samsung-galaxy-a5-2017-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(357, 2, 21, 'galaxy a50 sm a505f ds', 'samsung-galaxy-a50-sm-a505f-ds.jpg', 0, 1, '2023-08-19 15:20:16'),
(358, 2, 21, 'galaxy a50s', 'samsung-galaxy-a50s.jpg', 0, 1, '2023-08-19 15:20:16'),
(359, 2, 21, 'galaxy a51 5g uw', 'samsung-galaxy-a51-5g-uw.jpg', 0, 1, '2023-08-19 15:20:16'),
(360, 2, 21, 'galaxy a51 5g', 'samsung-galaxy-a51-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(361, 2, 21, 'galaxy a51 sm a515', 'samsung-galaxy-a51-sm-a515.jpg', 0, 1, '2023-08-19 15:20:16'),
(362, 2, 21, 'galaxy a52 4g', 'samsung-galaxy-a52-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(363, 2, 21, 'galaxy a52 5g', 'samsung-galaxy-a52-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(364, 2, 21, 'galaxy a52s 5g', 'samsung-galaxy-a52s-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(365, 2, 21, 'galaxy a53 5g ', 'samsung-galaxy-a53-5g-.jpg', 0, 1, '2023-08-19 15:20:16'),
(366, 2, 21, 'galaxy a54', 'samsung-galaxy-a54.jpg', 0, 1, '2023-08-19 15:20:16'),
(367, 2, 21, 'galaxy a6 2018 ', 'samsung-galaxy-a6-2018-.jpg', 0, 1, '2023-08-19 15:20:16'),
(368, 2, 21, 'galaxy a6 plus 2018 ', 'samsung-galaxy-a6-plus-2018-.jpg', 0, 1, '2023-08-19 15:20:16'),
(369, 2, 21, 'galaxy a60 ', 'samsung-galaxy-a60-.jpg', 0, 1, '2023-08-19 15:20:16'),
(370, 2, 21, 'galaxy a6s ', 'samsung-galaxy-a6s-.jpg', 0, 1, '2023-08-19 15:20:16'),
(371, 2, 21, 'galaxy a7 2016', 'samsung-galaxy-a7-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(372, 2, 21, 'galaxy a7 2017', 'samsung-galaxy-a7-2017.jpg', 0, 1, '2023-08-19 15:20:16'),
(373, 2, 21, 'galaxy a7 sm a750f', 'samsung-galaxy-a7-sm-a750f.jpg', 0, 1, '2023-08-19 15:20:16'),
(374, 2, 21, 'galaxy a70', 'samsung-galaxy-a70.jpg', 0, 1, '2023-08-19 15:20:16'),
(375, 2, 21, 'galaxy a70s ', 'samsung-galaxy-a70s-.jpg', 0, 1, '2023-08-19 15:20:16'),
(376, 2, 21, 'galaxy a71 5g uw', 'samsung-galaxy-a71-5g-uw.jpg', 0, 1, '2023-08-19 15:20:16'),
(377, 2, 21, 'galaxy a71 5g', 'samsung-galaxy-a71-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(378, 2, 21, 'galaxy a71', 'samsung-galaxy-a71.jpg', 0, 1, '2023-08-19 15:20:16'),
(379, 2, 21, 'galaxy a72 4g', 'samsung-galaxy-a72-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(380, 2, 21, 'galaxy a73 5g', 'samsung-galaxy-a73-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(381, 2, 21, 'galaxy a8 ', 'samsung-galaxy-a8-.jpg', 0, 1, '2023-08-19 15:20:16'),
(382, 2, 21, 'galaxy a8 2016r1 ', 'samsung-galaxy-a8-2016r1-.jpg', 0, 1, '2023-08-19 15:20:16'),
(383, 2, 21, 'galaxy a8 a530f', 'samsung-galaxy-a8-a530f.jpg', 0, 1, '2023-08-19 15:20:16'),
(384, 2, 21, 'galaxy a8 a9 star', 'samsung-galaxy-a8-a9-star.jpg', 0, 1, '2023-08-19 15:20:16'),
(385, 2, 21, 'galaxy a8 ds', 'samsung-galaxy-a8-ds.jpg', 0, 1, '2023-08-19 15:20:16'),
(386, 2, 21, 'galaxy a8 plus a730f', 'samsung-galaxy-a8-plus-a730f.jpg', 0, 1, '2023-08-19 15:20:16'),
(387, 2, 21, 'galaxy a80 ', 'samsung-galaxy-a80-.jpg', 0, 1, '2023-08-19 15:20:16'),
(388, 2, 21, 'galaxy a8s ', 'samsung-galaxy-a8s-.jpg', 0, 1, '2023-08-19 15:20:16'),
(389, 2, 21, 'galaxy a9 2018', 'samsung-galaxy-a9-2018.jpg', 0, 1, '2023-08-19 15:20:16'),
(390, 2, 21, 'galaxy a9 pro1', 'samsung-galaxy-a9-pro1.jpg', 0, 1, '2023-08-19 15:20:16'),
(391, 2, 21, 'galaxy a90 5g', 'samsung-galaxy-a90-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(392, 2, 21, 'galaxy ace 2', 'samsung-galaxy-ace-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(393, 2, 21, 'galaxy ace 3', 'samsung-galaxy-ace-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(394, 2, 21, 'galaxy ace 4', 'samsung-galaxy-ace-4.jpg', 0, 1, '2023-08-19 15:20:16'),
(395, 2, 21, 'galaxy ace advance s6800', 'samsung-galaxy-ace-advance-s6800.jpg', 0, 1, '2023-08-19 15:20:16'),
(396, 2, 21, 'galaxy ace duos gsm', 'samsung-galaxy-ace-duos-gsm.jpg', 0, 1, '2023-08-19 15:20:16'),
(397, 2, 21, 'galaxy ace duos sch i589', 'samsung-galaxy-ace-duos-sch-i589.jpg', 0, 1, '2023-08-19 15:20:16'),
(398, 2, 21, 'galaxy ace ii x', 'samsung-galaxy-ace-ii-x.jpg', 0, 1, '2023-08-19 15:20:16'),
(399, 2, 21, 'galaxy ace nxt sm g313h', 'samsung-galaxy-ace-nxt-sm-g313h.jpg', 0, 1, '2023-08-19 15:20:16'),
(400, 2, 21, 'galaxy ace plus', 'samsung-galaxy-ace-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(401, 2, 21, 'galaxy ace style lte', 'samsung-galaxy-ace-style-lte.jpg', 0, 1, '2023-08-19 15:20:16'),
(402, 2, 21, 'galaxy alpha', 'samsung-galaxy-alpha.jpg', 0, 1, '2023-08-19 15:20:16'),
(403, 2, 21, 'galaxy ancora', 'samsung-galaxy-ancora.jpg', 0, 1, '2023-08-19 15:20:16'),
(404, 2, 21, 'galaxy appeal', 'samsung-galaxy-appeal.jpg', 0, 1, '2023-08-19 15:20:16'),
(405, 2, 21, 'Galaxy Attain 4G', 'Samsung-Galaxy-Attain-4G.jpg', 0, 1, '2023-08-19 15:20:16'),
(406, 2, 21, 'galaxy avant', 'samsung-galaxy-avant.jpg', 0, 1, '2023-08-19 15:20:16'),
(407, 2, 21, 'galaxy axiom sch r830', 'samsung-galaxy-axiom-sch-r830.jpg', 0, 1, '2023-08-19 15:20:16'),
(408, 2, 21, 'galaxy beam 2012', 'samsung-galaxy-beam-2012.jpg', 0, 1, '2023-08-19 15:20:16'),
(409, 2, 21, 'galaxy beam2 g3858', 'samsung-galaxy-beam2-g3858.jpg', 0, 1, '2023-08-19 15:20:16'),
(410, 2, 21, 'galaxy c5 pro sm c5010', 'samsung-galaxy-c5-pro-sm-c5010.jpg', 0, 1, '2023-08-19 15:20:16'),
(411, 2, 21, 'galaxy c5r3', 'samsung-galaxy-c5r3.jpg', 0, 1, '2023-08-19 15:20:16'),
(412, 2, 21, 'galaxy c7 2017', 'samsung-galaxy-c7-2017.jpg', 0, 1, '2023-08-19 15:20:16'),
(413, 2, 21, 'galaxy c7 pro', 'samsung-galaxy-c7-pro.jpg', 0, 1, '2023-08-19 15:20:16'),
(414, 2, 21, 'galaxy c7', 'samsung-galaxy-c7.jpg', 0, 1, '2023-08-19 15:20:16'),
(415, 2, 21, 'galaxy c9 pro ', 'samsung-galaxy-c9-pro-.jpg', 0, 1, '2023-08-19 15:20:16'),
(416, 2, 21, 'galaxy camera 2', 'samsung-galaxy-camera-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(417, 2, 21, 'galaxy camera new', 'samsung-galaxy-camera-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(418, 2, 21, 'galaxy chat gt b5330', 'samsung-galaxy-chat-gt-b5330.jpg', 0, 1, '2023-08-19 15:20:16'),
(419, 2, 21, 'galaxy core 2', 'samsung-galaxy-core-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(420, 2, 21, 'galaxy core advance', 'samsung-galaxy-core-advance.jpg', 0, 1, '2023-08-19 15:20:16'),
(421, 2, 21, 'galaxy core gt i8260', 'samsung-galaxy-core-gt-i8260.jpg', 0, 1, '2023-08-19 15:20:16'),
(422, 2, 21, 'galaxy core lite lte1', 'samsung-galaxy-core-lite-lte1.jpg', 0, 1, '2023-08-19 15:20:16'),
(423, 2, 21, 'galaxy core lte', 'samsung-galaxy-core-lte.jpg', 0, 1, '2023-08-19 15:20:16'),
(424, 2, 21, 'galaxy core plus', 'samsung-galaxy-core-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(425, 2, 21, 'galaxy core prime', 'samsung-galaxy-core-prime.jpg', 0, 1, '2023-08-19 15:20:16'),
(426, 2, 21, 'galaxy discover', 'samsung-galaxy-discover.jpg', 0, 1, '2023-08-19 15:20:16'),
(427, 2, 21, 'galaxy e5', 'samsung-galaxy-e5.jpg', 0, 1, '2023-08-19 15:20:16'),
(428, 2, 21, 'galaxy e7', 'samsung-galaxy-e7.jpg', 0, 1, '2023-08-19 15:20:16'),
(429, 2, 21, 'galaxy exhibit t599', 'samsung-galaxy-exhibit-t599.jpg', 0, 1, '2023-08-19 15:20:16'),
(430, 2, 21, 'galaxy express 2 lte', 'samsung-galaxy-express-2-lte.jpg', 0, 1, '2023-08-19 15:20:16'),
(431, 2, 21, 'galaxy express i437', 'samsung-galaxy-express-i437.jpg', 0, 1, '2023-08-19 15:20:16'),
(432, 2, 21, 'galaxy express prime', 'samsung-galaxy-express-prime.jpg', 0, 1, '2023-08-19 15:20:16'),
(433, 2, 21, 'galaxy express', 'samsung-galaxy-express.jpg', 0, 1, '2023-08-19 15:20:16'),
(434, 2, 21, 'galaxy f02s', 'samsung-galaxy-f02s.jpg', 0, 1, '2023-08-19 15:20:16'),
(435, 2, 21, 'galaxy f04 new', 'samsung-galaxy-f04-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(436, 2, 21, 'galaxy f12', 'samsung-galaxy-f12.jpg', 0, 1, '2023-08-19 15:20:16'),
(437, 2, 21, 'galaxy f13', 'samsung-galaxy-f13.jpg', 0, 1, '2023-08-19 15:20:16'),
(438, 2, 21, 'galaxy f14', 'samsung-galaxy-f14.jpg', 0, 1, '2023-08-19 15:20:16'),
(439, 2, 21, 'galaxy f22', 'samsung-galaxy-f22.jpg', 0, 1, '2023-08-19 15:20:16'),
(440, 2, 21, 'galaxy f34', 'samsung-galaxy-f34.jpg', 0, 1, '2023-08-19 15:20:16'),
(441, 2, 21, 'galaxy f41 sm f415fds', 'samsung-galaxy-f41-sm-f415fds.jpg', 0, 1, '2023-08-19 15:20:16'),
(442, 2, 21, 'galaxy f42 5g', 'samsung-galaxy-f42-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(443, 2, 21, 'galaxy f52 5g', 'samsung-galaxy-f52-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(444, 2, 21, 'galaxy f54 5g', 'samsung-galaxy-f54-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(445, 2, 21, 'galaxy f62', 'samsung-galaxy-f62.jpg', 0, 1, '2023-08-19 15:20:16'),
(446, 2, 21, 'galaxy fame lite s6790', 'samsung-galaxy-fame-lite-s6790.jpg', 0, 1, '2023-08-19 15:20:16'),
(447, 2, 21, 'galaxy fold 5g', 'samsung-galaxy-fold-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(448, 2, 21, 'galaxy fold', 'samsung-galaxy-fold.jpg', 0, 1, '2023-08-19 15:20:16'),
(449, 2, 21, 'galaxy folder SM G150', 'samsung-galaxy-folder-SM-G150.jpg', 0, 1, '2023-08-19 15:20:16'),
(450, 2, 21, 'galaxy folder2 g165', 'samsung-galaxy-folder2-g165.jpg', 0, 1, '2023-08-19 15:20:16'),
(451, 2, 21, 'galaxy frame', 'samsung-galaxy-frame.jpg', 0, 1, '2023-08-19 15:20:16'),
(452, 2, 21, 'galaxy fresh s7390', 'samsung-galaxy-fresh-s7390.jpg', 0, 1, '2023-08-19 15:20:16'),
(453, 2, 21, 'galaxy golden', 'samsung-galaxy-golden.jpg', 0, 1, '2023-08-19 15:20:16'),
(454, 2, 21, 'galaxy gran prime duos tv sm g530bt', 'samsung-galaxy-gran-prime-duos-tv-sm-g530bt.jpg', 0, 1, '2023-08-19 15:20:16'),
(455, 2, 21, 'galaxy grand 2', 'samsung-galaxy-grand-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(456, 2, 21, 'galaxy grand gt i9080', 'samsung-galaxy-grand-gt-i9080.jpg', 0, 1, '2023-08-19 15:20:16'),
(457, 2, 21, 'galaxy grand max', 'samsung-galaxy-grand-max.jpg', 0, 1, '2023-08-19 15:20:16'),
(458, 2, 21, 'galaxy grand neo', 'samsung-galaxy-grand-neo.jpg', 0, 1, '2023-08-19 15:20:16'),
(459, 2, 21, 'galaxy grand prime sm g530h', 'samsung-galaxy-grand-prime-sm-g530h.jpg', 0, 1, '2023-08-19 15:20:16'),
(460, 2, 21, 'galaxy i8250', 'samsung-galaxy-i8250.jpg', 0, 1, '2023-08-19 15:20:16'),
(461, 2, 21, 'galaxy j max3', 'samsung-galaxy-j-max3.jpg', 0, 1, '2023-08-19 15:20:16'),
(462, 2, 21, 'galaxy j', 'samsung-galaxy-j.jpg', 0, 1, '2023-08-19 15:20:16'),
(463, 2, 21, 'galaxy j1 2016', 'samsung-galaxy-j1-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(464, 2, 21, 'galaxy j1 ace', 'samsung-galaxy-j1-ace.jpg', 0, 1, '2023-08-19 15:20:16'),
(465, 2, 21, 'galaxy j1 nxt', 'samsung-galaxy-j1-nxt.jpg', 0, 1, '2023-08-19 15:20:16'),
(466, 2, 21, 'galaxy j1 sm j100h1', 'samsung-galaxy-j1-sm-j100h1.jpg', 0, 1, '2023-08-19 15:20:16'),
(467, 2, 21, 'galaxy j2 2016 new', 'samsung-galaxy-j2-2016-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(468, 2, 21, 'galaxy j2 2017 j200g', 'samsung-galaxy-j2-2017-j200g.jpg', 0, 1, '2023-08-19 15:20:16'),
(469, 2, 21, 'galaxy j2 2018 sm j250 ', 'samsung-galaxy-j2-2018-sm-j250-.jpg', 0, 1, '2023-08-19 15:20:16'),
(470, 2, 21, 'galaxy j2 core 2020', 'samsung-galaxy-j2-core-2020.jpg', 0, 1, '2023-08-19 15:20:16'),
(471, 2, 21, 'galaxy j2 core', 'samsung-galaxy-j2-core.jpg', 0, 1, '2023-08-19 15:20:16'),
(472, 2, 21, 'galaxy j2 prime 2016', 'samsung-galaxy-j2-prime-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(473, 2, 21, 'galaxy j2', 'samsung-galaxy-j2.jpg', 0, 1, '2023-08-19 15:20:16'),
(474, 2, 21, 'galaxy j3 2017', 'samsung-galaxy-j3-2017.jpg', 0, 1, '2023-08-19 15:20:16'),
(475, 2, 21, 'galaxy j3 2017r1', 'samsung-galaxy-j3-2017r1.jpg', 0, 1, '2023-08-19 15:20:16'),
(476, 2, 21, 'galaxy j3 2018', 'samsung-galaxy-j3-2018.jpg', 0, 1, '2023-08-19 15:20:16'),
(477, 2, 21, 'galaxy j3 emerge ', 'samsung-galaxy-j3-emerge-.jpg', 0, 1, '2023-08-19 15:20:16'),
(478, 2, 21, 'galaxy j3', 'samsung-galaxy-j3.jpg', 0, 1, '2023-08-19 15:20:16'),
(479, 2, 21, 'galaxy j4 core sm g410g', 'samsung-galaxy-j4-core-sm-g410g.jpg', 0, 1, '2023-08-19 15:20:16'),
(480, 2, 21, 'galaxy j4 j400', 'samsung-galaxy-j4-j400.jpg', 0, 1, '2023-08-19 15:20:16'),
(481, 2, 21, 'galaxy j4 plus sm j415f', 'samsung-galaxy-j4-plus-sm-j415f.jpg', 0, 1, '2023-08-19 15:20:16'),
(482, 2, 21, 'galaxy j5 2016r', 'samsung-galaxy-j5-2016r.jpg', 0, 1, '2023-08-19 15:20:16'),
(483, 2, 21, 'galaxy j5 2017 sm j530', 'samsung-galaxy-j5-2017-sm-j530.jpg', 0, 1, '2023-08-19 15:20:16'),
(484, 2, 21, 'galaxy j5 prime', 'samsung-galaxy-j5-prime.jpg', 0, 1, '2023-08-19 15:20:16'),
(485, 2, 21, 'galaxy j5 sm j500f', 'samsung-galaxy-j5-sm-j500f.jpg', 0, 1, '2023-08-19 15:20:16'),
(486, 2, 21, 'galaxy j6 j600', 'samsung-galaxy-j6-j600.jpg', 0, 1, '2023-08-19 15:20:16'),
(487, 2, 21, 'galaxy j6 plus sm j610f', 'samsung-galaxy-j6-plus-sm-j610f.jpg', 0, 1, '2023-08-19 15:20:16'),
(488, 2, 21, 'galaxy j7 2016', 'samsung-galaxy-j7-2016.jpg', 0, 1, '2023-08-19 15:20:16'),
(489, 2, 21, 'galaxy j7 2017 sm j730f', 'samsung-galaxy-j7-2017-sm-j730f.jpg', 0, 1, '2023-08-19 15:20:16'),
(490, 2, 21, 'galaxy j7 2018', 'samsung-galaxy-j7-2018.jpg', 0, 1, '2023-08-19 15:20:16'),
(491, 2, 21, 'galaxy j7 duo sm j720f', 'samsung-galaxy-j7-duo-sm-j720f.jpg', 0, 1, '2023-08-19 15:20:16'),
(492, 2, 21, 'galaxy j7 j700f', 'samsung-galaxy-j7-j700f.jpg', 0, 1, '2023-08-19 15:20:16'),
(493, 2, 21, 'galaxy j7 max', 'samsung-galaxy-j7-max.jpg', 0, 1, '2023-08-19 15:20:16'),
(494, 2, 21, 'galaxy j7 nxt sm j701fds', 'samsung-galaxy-j7-nxt-sm-j701fds.jpg', 0, 1, '2023-08-19 15:20:16'),
(495, 2, 21, 'galaxy j7 prime', 'samsung-galaxy-j7-prime.jpg', 0, 1, '2023-08-19 15:20:16'),
(496, 2, 21, 'galaxy j7 prime2', 'samsung-galaxy-j7-prime2.jpg', 0, 1, '2023-08-19 15:20:16'),
(497, 2, 21, 'galaxy j7 pro', 'samsung-galaxy-j7-pro.jpg', 0, 1, '2023-08-19 15:20:16'),
(498, 2, 21, 'galaxy j7 v 2017', 'samsung-galaxy-j7-v-2017.jpg', 0, 1, '2023-08-19 15:20:16'),
(499, 2, 21, 'galaxy j8 j800', 'samsung-galaxy-j8-j800.jpg', 0, 1, '2023-08-19 15:20:16'),
(500, 2, 21, 'galaxy k zoom new', 'samsung-galaxy-k-zoom-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(501, 2, 21, 'galaxy light', 'samsung-galaxy-light.jpg', 0, 1, '2023-08-19 15:20:16'),
(502, 2, 21, 'galaxy lightray 4g', 'samsung-galaxy-lightray-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(503, 2, 21, 'galaxy m pro b7800', 'samsung-galaxy-m-pro-b7800.jpg', 0, 1, '2023-08-19 15:20:16'),
(504, 2, 21, 'galaxy m style', 'samsung-galaxy-m-style.jpg', 0, 1, '2023-08-19 15:20:16'),
(505, 2, 21, 'galaxy m01', 'samsung-galaxy-m01.jpg', 0, 1, '2023-08-19 15:20:16'),
(506, 2, 21, 'galaxy m01s m017f', 'samsung-galaxy-m01s-m017f.jpg', 0, 1, '2023-08-19 15:20:16'),
(507, 2, 21, 'galaxy m02', 'samsung-galaxy-m02.jpg', 0, 1, '2023-08-19 15:20:16'),
(508, 2, 21, 'galaxy m02s', 'samsung-galaxy-m02s.jpg', 0, 1, '2023-08-19 15:20:16'),
(509, 2, 21, 'galaxy m04 ', 'samsung-galaxy-m04-.jpg', 0, 1, '2023-08-19 15:20:16'),
(510, 2, 21, 'galaxy m10 m105f', 'samsung-galaxy-m10-m105f.jpg', 0, 1, '2023-08-19 15:20:16'),
(511, 2, 21, 'galaxy m10s m107f', 'samsung-galaxy-m10s-m107f.jpg', 0, 1, '2023-08-19 15:20:16'),
(512, 2, 21, 'galaxy m11 sm m115', 'samsung-galaxy-m11-sm-m115.jpg', 0, 1, '2023-08-19 15:20:16'),
(513, 2, 21, 'galaxy m12', 'samsung-galaxy-m12.jpg', 0, 1, '2023-08-19 15:20:16'),
(514, 2, 21, 'galaxy m13 4g india', 'samsung-galaxy-m13-4g-india.jpg', 0, 1, '2023-08-19 15:20:16'),
(515, 2, 21, 'galaxy m13 5g', 'samsung-galaxy-m13-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(516, 2, 21, 'galaxy m13', 'samsung-galaxy-m13.jpg', 0, 1, '2023-08-19 15:20:16'),
(517, 2, 21, 'galaxy m14 5g sm m146', 'samsung-galaxy-m14-5g-sm-m146.jpg', 0, 1, '2023-08-19 15:20:16'),
(518, 2, 21, 'galaxy m20 m205f', 'samsung-galaxy-m20-m205f.jpg', 0, 1, '2023-08-19 15:20:16'),
(519, 2, 21, 'galaxy m21 2021', 'samsung-galaxy-m21-2021.jpg', 0, 1, '2023-08-19 15:20:16'),
(520, 2, 21, 'galaxy m21', 'samsung-galaxy-m21.jpg', 0, 1, '2023-08-19 15:20:16'),
(521, 2, 21, 'galaxy m21s', 'samsung-galaxy-m21s.jpg', 0, 1, '2023-08-19 15:20:16'),
(522, 2, 21, 'galaxy m22 ', 'samsung-galaxy-m22-.jpg', 0, 1, '2023-08-19 15:20:16'),
(523, 2, 21, 'galaxy m23', 'samsung-galaxy-m23.jpg', 0, 1, '2023-08-19 15:20:16'),
(524, 2, 21, 'galaxy m30 ', 'samsung-galaxy-m30-.jpg', 0, 1, '2023-08-19 15:20:16'),
(525, 2, 21, 'galaxy m30s ', 'samsung-galaxy-m30s-.jpg', 0, 1, '2023-08-19 15:20:16'),
(526, 2, 21, 'galaxy m31 sm m315f', 'samsung-galaxy-m31-sm-m315f.jpg', 0, 1, '2023-08-19 15:20:16'),
(527, 2, 21, 'galaxy m31s', 'samsung-galaxy-m31s.jpg', 0, 1, '2023-08-19 15:20:16'),
(528, 2, 21, 'galaxy m32 5g ', 'samsung-galaxy-m32-5g-.jpg', 0, 1, '2023-08-19 15:20:16'),
(529, 2, 21, 'galaxy m32 5g new', 'samsung-galaxy-m32-5g-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(530, 2, 21, 'galaxy m32', 'samsung-galaxy-m32.jpg', 0, 1, '2023-08-19 15:20:16'),
(531, 2, 21, 'galaxy m33', 'samsung-galaxy-m33.jpg', 0, 1, '2023-08-19 15:20:16'),
(532, 2, 21, 'galaxy m34 5g', 'samsung-galaxy-m34-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(533, 2, 21, 'galaxy m40 m405f', 'samsung-galaxy-m40-m405f.jpg', 0, 1, '2023-08-19 15:20:16'),
(534, 2, 21, 'galaxy m42', 'samsung-galaxy-m42.jpg', 0, 1, '2023-08-19 15:20:16'),
(535, 2, 21, 'galaxy m51', 'samsung-galaxy-m51.jpg', 0, 1, '2023-08-19 15:20:16'),
(536, 2, 21, 'galaxy m53 5g', 'samsung-galaxy-m53-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(537, 2, 21, 'galaxy m54 5g', 'samsung-galaxy-m54-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(538, 2, 21, 'galaxy m62', 'samsung-galaxy-m62.jpg', 0, 1, '2023-08-19 15:20:16'),
(539, 2, 21, 'a3', 'samsung-a3.jpg', 0, 1, '2023-08-19 15:20:16'),
(540, 2, 21, 'a5', 'samsung-a5.jpg', 0, 1, '2023-08-19 15:20:16'),
(541, 2, 21, 'a7', 'samsung-a7.jpg', 0, 1, '2023-08-19 15:20:16'),
(542, 2, 21, 'ace style', 'samsung-ace-style.jpg', 0, 1, '2023-08-19 15:20:16'),
(543, 2, 21, 'admire', 'samsung-admire.jpg', 0, 1, '2023-08-19 15:20:16'),
(544, 2, 21, 'array sph m390', 'samsung-array-sph-m390.jpg', 0, 1, '2023-08-19 15:20:16'),
(545, 2, 21, 'ativ odyssey new', 'samsung-ativ-odyssey-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(546, 2, 21, 'ativ s neo i800', 'samsung-ativ-s-neo-i800.jpg', 0, 1, '2023-08-19 15:20:16'),
(547, 2, 21, 'ativ s new', 'samsung-ativ-s-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(548, 2, 21, 'ativ se', 'samsung-ativ-se.jpg', 0, 1, '2023-08-19 15:20:16'),
(549, 2, 21, 'c3312 duos ofic', 'samsung-c3312-duos-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(550, 2, 21, 'c3322', 'samsung-c3322.jpg', 0, 1, '2023-08-19 15:20:16'),
(551, 2, 21, 'c3350', 'samsung-c3350.jpg', 0, 1, '2023-08-19 15:20:16'),
(552, 2, 21, 'c3520', 'samsung-c3520.jpg', 0, 1, '2023-08-19 15:20:16'),
(553, 2, 21, 'c3560', 'samsung-c3560.jpg', 0, 1, '2023-08-19 15:20:16'),
(554, 2, 21, 'c3780', 'samsung-c3780.jpg', 0, 1, '2023-08-19 15:20:16'),
(555, 2, 21, 'c3782 evan duos', 'samsung-c3782-evan-duos.jpg', 0, 1, '2023-08-19 15:20:16');
INSERT INTO `modal` (`id`, `category_id`, `brand_id`, `modal_name`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(556, 2, 21, 'c414', 'samsung-c414.jpg', 0, 1, '2023-08-19 15:20:16'),
(557, 2, 21, 'c6712 star ii duos new', 'samsung-c6712-star-ii-duos-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(558, 2, 21, 'captivate glide', 'samsung-captivate-glide.jpg', 0, 1, '2023-08-19 15:20:16'),
(559, 2, 21, 'ch@t 527', 'samsung-ch@t-527.jpg', 0, 1, '2023-08-19 15:20:16'),
(560, 2, 21, 'champ 2', 'samsung-champ-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(561, 2, 21, 'champ neo duos gt c3262', 'samsung-champ-neo-duos-gt-c3262.jpg', 0, 1, '2023-08-19 15:20:16'),
(562, 2, 21, 'character r640', 'samsung-character-r640.jpg', 0, 1, '2023-08-19 15:20:16'),
(563, 2, 21, 'chat 333', 'samsung-chat-333.jpg', 0, 1, '2023-08-19 15:20:16'),
(564, 2, 21, 'chat E2222', 'samsung-chat-E2222.jpg', 0, 1, '2023-08-19 15:20:16'),
(565, 2, 21, 'chat gt s3570', 'samsung-chat-gt-s3570.jpg', 0, 1, '2023-08-19 15:20:16'),
(566, 2, 21, 'chrono', 'samsung-chrono.jpg', 0, 1, '2023-08-19 15:20:16'),
(567, 2, 21, 'comment 2 r390c', 'samsung-comment-2-r390c.jpg', 0, 1, '2023-08-19 15:20:16'),
(568, 2, 21, 'conquer 4g', 'samsung-conquer-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(569, 2, 21, 'convoy 2', 'samsung-convoy-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(570, 2, 21, 'dart', 'samsung-dart.jpg', 0, 1, '2023-08-19 15:20:16'),
(571, 2, 21, 'doubletime', 'samsung-doubletime.jpg', 0, 1, '2023-08-19 15:20:16'),
(572, 2, 21, 'duos tv i6712', 'samsung-duos-tv-i6712.jpg', 0, 1, '2023-08-19 15:20:16'),
(573, 2, 21, 'e1050', 'samsung-e1050.jpg', 0, 1, '2023-08-19 15:20:16'),
(574, 2, 21, 'e1182 ofic', 'samsung-e1182-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(575, 2, 21, 'e1190', 'samsung-e1190.jpg', 0, 1, '2023-08-19 15:20:16'),
(576, 2, 21, 'e1200 pusha black', 'samsung-e1200-pusha-black.jpg', 0, 1, '2023-08-19 15:20:16'),
(577, 2, 21, 'e1207t', 'samsung-e1207t.jpg', 0, 1, '2023-08-19 15:20:16'),
(578, 2, 21, 'e1230', 'samsung-e1230.jpg', 0, 1, '2023-08-19 15:20:16'),
(579, 2, 21, 'e1232b', 'samsung-e1232b.jpg', 0, 1, '2023-08-19 15:20:16'),
(580, 2, 21, 'e2232 ofic', 'samsung-e2232-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(581, 2, 21, 'e2600', 'samsung-e2600.jpg', 0, 1, '2023-08-19 15:20:16'),
(582, 2, 21, 'epic touch', 'samsung-epic-touch.jpg', 0, 1, '2023-08-19 15:20:16'),
(583, 2, 21, 'exhibit 4g', 'samsung-exhibit-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(584, 2, 21, 'exhibit ii 4g', 'samsung-exhibit-ii-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(585, 2, 21, 'exhilarate', 'samsung-exhilarate.jpg', 0, 1, '2023-08-19 15:20:16'),
(586, 2, 21, 'focus 2', 'samsung-focus-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(587, 2, 21, 'focus flash', 'samsung-focus-flash.jpg', 0, 1, '2023-08-19 15:20:16'),
(588, 2, 21, 'focus s', 'samsung-focus-s.jpg', 0, 1, '2023-08-19 15:20:16'),
(589, 2, 21, 'freeform iii', 'samsung-freeform-iii.jpg', 0, 1, '2023-08-19 15:20:16'),
(590, 2, 21, 'G3812B Galaxy S3 Slim', 'Samsung-G3812B-Galaxy-S3-Slim.jpg', 0, 1, '2023-08-19 15:20:16'),
(591, 2, 21, 'galaxy mega 2 r', 'samsung-galaxy-mega-2-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(592, 2, 21, 'galaxy mega 5 8', 'samsung-galaxy-mega-5-8.jpg', 0, 1, '2023-08-19 15:20:16'),
(593, 2, 21, 'galaxy mega 6 3', 'samsung-galaxy-mega-6-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(594, 2, 21, 'galaxy mini 2 s6500 ofic', 'samsung-galaxy-mini-2-s6500-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(595, 2, 21, 'galaxy music', 'samsung-galaxy-music.jpg', 0, 1, '2023-08-19 15:20:16'),
(596, 2, 21, 'galaxy nexus i515', 'samsung-galaxy-nexus-i515.jpg', 0, 1, '2023-08-19 15:20:16'),
(597, 2, 21, 'galaxy nexus new', 'samsung-galaxy-nexus-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(598, 2, 21, 'galaxy nexus tellus', 'samsung-galaxy-nexus-tellus.jpg', 0, 1, '2023-08-19 15:20:16'),
(599, 2, 21, 'galaxy note 101 2014 new', 'samsung-galaxy-note-101-2014-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(600, 2, 21, 'galaxy note 101 lte n8020', 'samsung-galaxy-note-101-lte-n8020.jpg', 0, 1, '2023-08-19 15:20:16'),
(601, 2, 21, 'galaxy note 101 n8000', 'samsung-galaxy-note-101-n8000.jpg', 0, 1, '2023-08-19 15:20:16'),
(602, 2, 21, 'galaxy note 3', 'samsung-galaxy-note-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(603, 2, 21, 'galaxy note 4 cdma', 'samsung-galaxy-note-4-cdma.jpg', 0, 1, '2023-08-19 15:20:16'),
(604, 2, 21, 'galaxy note 4 duos sm n9100', 'samsung-galaxy-note-4-duos-sm-n9100.jpg', 0, 1, '2023-08-19 15:20:16'),
(605, 2, 21, 'galaxy note 4 new', 'samsung-galaxy-note-4-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(606, 2, 21, 'galaxy note 8 sm n950', 'samsung-galaxy-note-8-sm-n950.jpg', 0, 1, '2023-08-19 15:20:16'),
(607, 2, 21, 'galaxy note 80 n5100', 'samsung-galaxy-note-80-n5100.jpg', 0, 1, '2023-08-19 15:20:16'),
(608, 2, 21, 'galaxy note 80 n5110', 'samsung-galaxy-note-80-n5110.jpg', 0, 1, '2023-08-19 15:20:16'),
(609, 2, 21, 'galaxy note edge1', 'samsung-galaxy-note-edge1.jpg', 0, 1, '2023-08-19 15:20:16'),
(610, 2, 21, 'galaxy note fe1', 'samsung-galaxy-note-fe1.jpg', 0, 1, '2023-08-19 15:20:16'),
(611, 2, 21, 'galaxy note ii cdma', 'samsung-galaxy-note-ii-cdma.jpg', 0, 1, '2023-08-19 15:20:16'),
(612, 2, 21, 'galaxy note ii n7100 new', 'samsung-galaxy-note-ii-n7100-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(613, 2, 21, 'galaxy note lte new', 'samsung-galaxy-note-lte-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(614, 2, 21, 'galaxy note t mobile sgh t879', 'samsung-galaxy-note-t-mobile-sgh-t879.jpg', 0, 1, '2023-08-19 15:20:16'),
(615, 2, 21, 'galaxy note', 'samsung-galaxy-note.jpg', 0, 1, '2023-08-19 15:20:16'),
(616, 2, 21, 'galaxy note10 ', 'samsung-galaxy-note10-.jpg', 0, 1, '2023-08-19 15:20:16'),
(617, 2, 21, 'galaxy note10 plus ', 'samsung-galaxy-note10-plus-.jpg', 0, 1, '2023-08-19 15:20:16'),
(618, 2, 21, 'galaxy note20 5g r', 'samsung-galaxy-note20-5g-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(619, 2, 21, 'galaxy note20 ultra ', 'samsung-galaxy-note20-ultra-.jpg', 0, 1, '2023-08-19 15:20:16'),
(620, 2, 21, 'galaxy note5', 'samsung-galaxy-note5.jpg', 0, 1, '2023-08-19 15:20:16'),
(621, 2, 21, 'galaxy note7 usa', 'samsung-galaxy-note7-usa.jpg', 0, 1, '2023-08-19 15:20:16'),
(622, 2, 21, 'galaxy note7', 'samsung-galaxy-note7.jpg', 0, 1, '2023-08-19 15:20:16'),
(623, 2, 21, 'galaxy note9 r1', 'samsung-galaxy-note9-r1.jpg', 0, 1, '2023-08-19 15:20:16'),
(624, 2, 21, 'galaxy on5', 'samsung-galaxy-on5.jpg', 0, 1, '2023-08-19 15:20:16'),
(625, 2, 21, 'galaxy on6 2018', 'samsung-galaxy-on6-2018.jpg', 0, 1, '2023-08-19 15:20:16'),
(626, 2, 21, 'galaxy on7 ', 'samsung-galaxy-on7-.jpg', 0, 1, '2023-08-19 15:20:16'),
(627, 2, 21, 'galaxy on7 2016 g6100 c', 'samsung-galaxy-on7-2016-g6100-c.jpg', 0, 1, '2023-08-19 15:20:16'),
(628, 2, 21, 'galaxy player 70 plus YP GB70ED', 'samsung-galaxy-player-70-plus-YP-GB70ED.jpg', 0, 1, '2023-08-19 15:20:16'),
(629, 2, 21, 'galaxy pocket 2', 'samsung-galaxy-pocket-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(630, 2, 21, 'galaxy pocket duos s5302', 'samsung-galaxy-pocket-duos-s5302.jpg', 0, 1, '2023-08-19 15:20:16'),
(631, 2, 21, 'galaxy pocket neo', 'samsung-galaxy-pocket-neo.jpg', 0, 1, '2023-08-19 15:20:16'),
(632, 2, 21, 'galaxy pocket', 'samsung-galaxy-pocket.jpg', 0, 1, '2023-08-19 15:20:16'),
(633, 2, 21, 'galaxy pop plus s5570i', 'samsung-galaxy-pop-plus-s5570i.jpg', 0, 1, '2023-08-19 15:20:16'),
(634, 2, 21, 'galaxy pop shv e220', 'samsung-galaxy-pop-shv-e220.jpg', 0, 1, '2023-08-19 15:20:16'),
(635, 2, 21, 'galaxy premier i9260 new', 'samsung-galaxy-premier-i9260-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(636, 2, 21, 'galaxy prevail 2', 'samsung-galaxy-prevail-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(637, 2, 21, 'galaxy q', 'samsung-galaxy-q.jpg', 0, 1, '2023-08-19 15:20:16'),
(638, 2, 21, 'galaxy quantum 2 sm a826s', 'samsung-galaxy-quantum-2-sm-a826s.jpg', 0, 1, '2023-08-19 15:20:16'),
(639, 2, 21, 'galaxy reverb m950', 'samsung-galaxy-reverb-m950.jpg', 0, 1, '2023-08-19 15:20:16'),
(640, 2, 21, 'galaxy round', 'samsung-galaxy-round.jpg', 0, 1, '2023-08-19 15:20:16'),
(641, 2, 21, 'galaxy rugby pro i547', 'samsung-galaxy-rugby-pro-i547.jpg', 0, 1, '2023-08-19 15:20:16'),
(642, 2, 21, 'galaxy rush sph m830', 'samsung-galaxy-rush-sph-m830.jpg', 0, 1, '2023-08-19 15:20:16'),
(643, 2, 21, 'galaxy s 4 i9500 black mist', 'samsung-galaxy-s-4-i9500-black-mist.jpg', 0, 1, '2023-08-19 15:20:16'),
(644, 2, 21, 'galaxy s advance', 'samsung-galaxy-s-advance.jpg', 0, 1, '2023-08-19 15:20:16'),
(645, 2, 21, 'galaxy s blaze 4g', 'samsung-galaxy-s-blaze-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(646, 2, 21, 'Galaxy S Duos 2 GT S7582', 'Samsung-Galaxy-S-Duos-2-GT-S7582.jpg', 0, 1, '2023-08-19 15:20:16'),
(647, 2, 21, 'galaxy s duos s7562', 'samsung-galaxy-s-duos-s7562.jpg', 0, 1, '2023-08-19 15:20:16'),
(648, 2, 21, 'galaxy s ii 4g new', 'samsung-galaxy-s-ii-4g-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(649, 2, 21, 'galaxy s ii duos', 'samsung-galaxy-s-ii-duos.jpg', 0, 1, '2023-08-19 15:20:16'),
(650, 2, 21, 'galaxy s ii hd lte', 'samsung-galaxy-s-ii-hd-lte.jpg', 0, 1, '2023-08-19 15:20:16'),
(651, 2, 21, 'galaxy s ii lte i727r rogers', 'samsung-galaxy-s-ii-lte-i727r-rogers.jpg', 0, 1, '2023-08-19 15:20:16'),
(652, 2, 21, 'galaxy s ii lte', 'samsung-galaxy-s-ii-lte.jpg', 0, 1, '2023-08-19 15:20:16'),
(653, 2, 21, 'galaxy s ii plus i9105p ofic', 'samsung-galaxy-s-ii-plus-i9105p-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(654, 2, 21, 'galaxy s ii skyrocket hd new', 'samsung-galaxy-s-ii-skyrocket-hd-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(655, 2, 21, 'galaxy s ii skyrocket', 'samsung-galaxy-s-ii-skyrocket.jpg', 0, 1, '2023-08-19 15:20:16'),
(656, 2, 21, 'galaxy s iii att', 'samsung-galaxy-s-iii-att.jpg', 0, 1, '2023-08-19 15:20:16'),
(657, 2, 21, 'galaxy s iii mini i8190', 'samsung-galaxy-s-iii-mini-i8190.jpg', 0, 1, '2023-08-19 15:20:16'),
(658, 2, 21, 'galaxy s iii tmobile', 'samsung-galaxy-s-iii-tmobile.jpg', 0, 1, '2023-08-19 15:20:16'),
(659, 2, 21, 'galaxy s light luxury', 'samsung-galaxy-s-light-luxury.jpg', 0, 1, '2023-08-19 15:20:16'),
(660, 2, 21, 'galaxy s relay 4g', 'samsung-galaxy-s-relay-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(661, 2, 21, 'galaxy s x t989d', 'samsung-galaxy-s-x-t989d.jpg', 0, 1, '2023-08-19 15:20:16'),
(662, 2, 21, 'galaxy s10 5g', 'samsung-galaxy-s10-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(663, 2, 21, 'galaxy s10 plus new', 'samsung-galaxy-s10-plus-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(664, 2, 21, 'galaxy s10', 'samsung-galaxy-s10.jpg', 0, 1, '2023-08-19 15:20:16'),
(665, 2, 21, 'galaxy s10e', 'samsung-galaxy-s10e.jpg', 0, 1, '2023-08-19 15:20:16'),
(666, 2, 21, 'galaxy s20 ', 'samsung-galaxy-s20-.jpg', 0, 1, '2023-08-19 15:20:16'),
(667, 2, 21, 'galaxy s20 fe 4g', 'samsung-galaxy-s20-fe-4g.jpg', 0, 1, '2023-08-19 15:20:16'),
(668, 2, 21, 'galaxy s20 fe 5g', 'samsung-galaxy-s20-fe-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(669, 2, 21, 'galaxy s20 plus', 'samsung-galaxy-s20-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(670, 2, 21, 'galaxy s20 ultra ', 'samsung-galaxy-s20-ultra-.jpg', 0, 1, '2023-08-19 15:20:16'),
(671, 2, 21, 'galaxy s21 5g r', 'samsung-galaxy-s21-5g-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(672, 2, 21, 'galaxy s21 fe 5g', 'samsung-galaxy-s21-fe-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(673, 2, 21, 'galaxy s21 plus 5g ', 'samsung-galaxy-s21-plus-5g-.jpg', 0, 1, '2023-08-19 15:20:16'),
(674, 2, 21, 'galaxy s21 ultra 5g ', 'samsung-galaxy-s21-ultra-5g-.jpg', 0, 1, '2023-08-19 15:20:16'),
(675, 2, 21, 'galaxy s22 5g', 'samsung-galaxy-s22-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(676, 2, 21, 'galaxy s22 plus 5g', 'samsung-galaxy-s22-plus-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(677, 2, 21, 'galaxy s22 ultra 5g', 'samsung-galaxy-s22-ultra-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(678, 2, 21, 'galaxy s23 5g', 'samsung-galaxy-s23-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(679, 2, 21, 'galaxy s23 plus 5g', 'samsung-galaxy-s23-plus-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(680, 2, 21, 'galaxy s23 ultra 5g', 'samsung-galaxy-s23-ultra-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(681, 2, 21, 'galaxy s3 mini value edition i8200', 'samsung-galaxy-s3-mini-value-edition-i8200.jpg', 0, 1, '2023-08-19 15:20:16'),
(682, 2, 21, 'galaxy s4 mini I9190 ofic', 'samsung-galaxy-s4-mini-I9190-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(683, 2, 21, 'galaxy s4 mini plus gt i9195i', 'samsung-galaxy-s4-mini-plus-gt-i9195i.jpg', 0, 1, '2023-08-19 15:20:16'),
(684, 2, 21, 'galaxy s4 verizon', 'samsung-galaxy-s4-verizon.jpg', 0, 1, '2023-08-19 15:20:16'),
(685, 2, 21, 'galaxy s4 zoom', 'samsung-galaxy-s4-zoom.jpg', 0, 1, '2023-08-19 15:20:16'),
(686, 2, 21, 'galaxy s5 active', 'samsung-galaxy-s5-active.jpg', 0, 1, '2023-08-19 15:20:16'),
(687, 2, 21, 'galaxy s5 cdma1', 'samsung-galaxy-s5-cdma1.jpg', 0, 1, '2023-08-19 15:20:16'),
(688, 2, 21, 'galaxy s5 g900f', 'samsung-galaxy-s5-g900f.jpg', 0, 1, '2023-08-19 15:20:16'),
(689, 2, 21, 'galaxy s5 lte a', 'samsung-galaxy-s5-lte-a.jpg', 0, 1, '2023-08-19 15:20:16'),
(690, 2, 21, 'galaxy s5 mini duos', 'samsung-galaxy-s5-mini-duos.jpg', 0, 1, '2023-08-19 15:20:16'),
(691, 2, 21, 'galaxy s5 mini', 'samsung-galaxy-s5-mini.jpg', 0, 1, '2023-08-19 15:20:16'),
(692, 2, 21, 'galaxy s5 neo', 'samsung-galaxy-s5-neo.jpg', 0, 1, '2023-08-19 15:20:16'),
(693, 2, 21, 'galaxy s5 sm g9009', 'samsung-galaxy-s5-sm-g9009.jpg', 0, 1, '2023-08-19 15:20:16'),
(694, 2, 21, 'galaxy s5 sport', 'samsung-galaxy-s5-sport.jpg', 0, 1, '2023-08-19 15:20:16'),
(695, 2, 21, 'galaxy s6 active', 'samsung-galaxy-s6-active.jpg', 0, 1, '2023-08-19 15:20:16'),
(696, 2, 21, 'galaxy s6 cdma', 'samsung-galaxy-s6-cdma.jpg', 0, 1, '2023-08-19 15:20:16'),
(697, 2, 21, 'galaxy s6 edge cdma', 'samsung-galaxy-s6-edge-cdma.jpg', 0, 1, '2023-08-19 15:20:16'),
(698, 2, 21, 'galaxy s6 edge plus', 'samsung-galaxy-s6-edge-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(699, 2, 21, 'galaxy s6 edge', 'samsung-galaxy-s6-edge.jpg', 0, 1, '2023-08-19 15:20:16'),
(700, 2, 21, 'galaxy s6', 'samsung-galaxy-s6.jpg', 0, 1, '2023-08-19 15:20:16'),
(701, 2, 21, 'galaxy s7  ', 'samsung-galaxy-s7--.jpg', 0, 1, '2023-08-19 15:20:16'),
(702, 2, 21, 'galaxy s7 active', 'samsung-galaxy-s7-active.jpg', 0, 1, '2023-08-19 15:20:16'),
(703, 2, 21, 'galaxy s7 edge ', 'samsung-galaxy-s7-edge-.jpg', 0, 1, '2023-08-19 15:20:16'),
(704, 2, 21, 'galaxy s7 edge usa', 'samsung-galaxy-s7-edge-usa.jpg', 0, 1, '2023-08-19 15:20:16'),
(705, 2, 21, 'galaxy s7 usa', 'samsung-galaxy-s7-usa.jpg', 0, 1, '2023-08-19 15:20:16'),
(706, 2, 21, 'galaxy s8 ', 'samsung-galaxy-s8-.jpg', 0, 1, '2023-08-19 15:20:16'),
(707, 2, 21, 'galaxy s8 active', 'samsung-galaxy-s8-active.jpg', 0, 1, '2023-08-19 15:20:16'),
(708, 2, 21, 'galaxy s8 plus ', 'samsung-galaxy-s8-plus-.jpg', 0, 1, '2023-08-19 15:20:16'),
(709, 2, 21, 'galaxy s9 ', 'samsung-galaxy-s9-.jpg', 0, 1, '2023-08-19 15:20:16'),
(710, 2, 21, 'galaxy s9 plus blue', 'samsung-galaxy-s9-plus-blue.jpg', 0, 1, '2023-08-19 15:20:16'),
(711, 2, 21, 'galaxy sii att', 'samsung-galaxy-sii-att.jpg', 0, 1, '2023-08-19 15:20:16'),
(712, 2, 21, 'galaxy sii tmobile', 'samsung-galaxy-sii-tmobile.jpg', 0, 1, '2023-08-19 15:20:16'),
(713, 2, 21, 'galaxy siii verizon', 'samsung-galaxy-siii-verizon.jpg', 0, 1, '2023-08-19 15:20:16'),
(714, 2, 21, 'galaxy star 2 plus sm g350e', 'samsung-galaxy-star-2-plus-sm-g350e.jpg', 0, 1, '2023-08-19 15:20:16'),
(715, 2, 21, 'galaxy star 2', 'samsung-galaxy-star-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(716, 2, 21, 'Galaxy Star Pro s7262', 'Samsung-Galaxy-Star-Pro-s7262.jpg', 0, 1, '2023-08-19 15:20:16'),
(717, 2, 21, 'galaxy star s5280', 'samsung-galaxy-star-s5280.jpg', 0, 1, '2023-08-19 15:20:16'),
(718, 2, 21, 'galaxy star trios s5283', 'samsung-galaxy-star-trios-s5283.jpg', 0, 1, '2023-08-19 15:20:16'),
(719, 2, 21, 'galaxy stellar sch i200', 'samsung-galaxy-stellar-sch-i200.jpg', 0, 1, '2023-08-19 15:20:16'),
(720, 2, 21, 'galaxy stratosphere II', 'samsung-galaxy-stratosphere-II.jpg', 0, 1, '2023-08-19 15:20:16'),
(721, 2, 21, 'galaxy trend duos ii s7572', 'samsung-galaxy-trend-duos-ii-s7572.jpg', 0, 1, '2023-08-19 15:20:16'),
(722, 2, 21, 'galaxy v 2014', 'samsung-galaxy-v-2014.jpg', 0, 1, '2023-08-19 15:20:16'),
(723, 2, 21, 'galaxy v plus sm g318', 'samsung-galaxy-v-plus-sm-g318.jpg', 0, 1, '2023-08-19 15:20:16'),
(724, 2, 21, 'galaxy v1', 'samsung-galaxy-v1.jpg', 0, 1, '2023-08-19 15:20:16'),
(725, 2, 21, 'galaxy victory 4g lte sph l300', 'samsung-galaxy-victory-4g-lte-sph-l300.jpg', 0, 1, '2023-08-19 15:20:16'),
(726, 2, 21, 'galaxy view', 'samsung-galaxy-view.jpg', 0, 1, '2023-08-19 15:20:16'),
(727, 2, 21, 'galaxy view2 sm t927  ', 'samsung-galaxy-view2-sm-t927--.jpg', 0, 1, '2023-08-19 15:20:16'),
(728, 2, 21, 'galaxy w', 'samsung-galaxy-w.jpg', 0, 1, '2023-08-19 15:20:16'),
(729, 2, 21, 'galaxy win i8552', 'samsung-galaxy-win-i8552.jpg', 0, 1, '2023-08-19 15:20:16'),
(730, 2, 21, 'GALAXY Win Pro G3812', 'Samsung-GALAXY-Win-Pro-G3812.jpg', 0, 1, '2023-08-19 15:20:16'),
(731, 2, 21, 'galaxy xcover 2', 'samsung-galaxy-xcover-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(732, 2, 21, 'galaxy xcover 3 new', 'samsung-galaxy-xcover-3-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(733, 2, 21, 'galaxy xcover 3 SM G389F', 'samsung-galaxy-xcover-3-SM-G389F.jpg', 0, 1, '2023-08-19 15:20:16'),
(734, 2, 21, 'galaxy xcover 4s sm g398', 'samsung-galaxy-xcover-4s-sm-g398.jpg', 0, 1, '2023-08-19 15:20:16'),
(735, 2, 21, 'galaxy xcover 5', 'samsung-galaxy-xcover-5.jpg', 0, 1, '2023-08-19 15:20:16'),
(736, 2, 21, 'galaxy xcover fieldpro sm g889f', 'samsung-galaxy-xcover-fieldpro-sm-g889f.jpg', 0, 1, '2023-08-19 15:20:16'),
(737, 2, 21, 'galaxy xcover pro ', 'samsung-galaxy-xcover-pro-.jpg', 0, 1, '2023-08-19 15:20:16'),
(738, 2, 21, 'galaxy xcover', 'samsung-galaxy-xcover.jpg', 0, 1, '2023-08-19 15:20:16'),
(739, 2, 21, 'galaxy xcover4 g390f ', 'samsung-galaxy-xcover4-g390f-.jpg', 0, 1, '2023-08-19 15:20:16'),
(740, 2, 21, 'galaxy xcover6 pro r', 'samsung-galaxy-xcover6-pro-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(741, 2, 21, 'galaxy y duos', 'samsung-galaxy-y-duos.jpg', 0, 1, '2023-08-19 15:20:16'),
(742, 2, 21, 'galaxy y plus gt s5303', 'samsung-galaxy-y-plus-gt-s5303.jpg', 0, 1, '2023-08-19 15:20:16'),
(743, 2, 21, 'galaxy y pro b5510', 'samsung-galaxy-y-pro-b5510.jpg', 0, 1, '2023-08-19 15:20:16'),
(744, 2, 21, 'galaxy y pro duos', 'samsung-galaxy-y-pro-duos.jpg', 0, 1, '2023-08-19 15:20:16'),
(745, 2, 21, 'galaxy y s5360', 'samsung-galaxy-y-s5360.jpg', 0, 1, '2023-08-19 15:20:16'),
(746, 2, 21, 'galaxy young 2 sm g130', 'samsung-galaxy-young-2-sm-g130.jpg', 0, 1, '2023-08-19 15:20:16'),
(747, 2, 21, 'galaxy young ss', 'samsung-galaxy-young-ss.jpg', 0, 1, '2023-08-19 15:20:16'),
(748, 2, 21, 'galaxy z flip 01', 'samsung-galaxy-z-flip-01.jpg', 0, 1, '2023-08-19 15:20:16'),
(749, 2, 21, 'galaxy z flip 5g mystic bronze', 'samsung-galaxy-z-flip-5g-mystic-bronze.jpg', 0, 1, '2023-08-19 15:20:16'),
(750, 2, 21, 'galaxy z flip3 5g', 'samsung-galaxy-z-flip3-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(751, 2, 21, 'galaxy z flip4 5g', 'samsung-galaxy-z-flip4-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(752, 2, 21, 'galaxy z flip5 5g', 'samsung-galaxy-z-flip5-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(753, 2, 21, 'galaxy z fold2 5g', 'samsung-galaxy-z-fold2-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(754, 2, 21, 'galaxy z fold3 5g', 'samsung-galaxy-z-fold3-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(755, 2, 21, 'galaxy z fold4', 'samsung-galaxy-z-fold4.jpg', 0, 1, '2023-08-19 15:20:16'),
(756, 2, 21, 'galaxy z fold5 5g', 'samsung-galaxy-z-fold5-5g.jpg', 0, 1, '2023-08-19 15:20:16'),
(757, 2, 21, 'google nexus 10 new', 'samsung-google-nexus-10-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(758, 2, 21, 'gravity q', 'samsung-gravity-q.jpg', 0, 1, '2023-08-19 15:20:16'),
(759, 2, 21, 'gravity smart', 'samsung-gravity-smart.jpg', 0, 1, '2023-08-19 15:20:16'),
(760, 2, 21, 'gravity txt', 'samsung-gravity-txt.jpg', 0, 1, '2023-08-19 15:20:16'),
(761, 2, 21, 'gt c3590', 'samsung-gt-c3590.jpg', 0, 1, '2023-08-19 15:20:16'),
(762, 2, 21, 'gt e1260b', 'samsung-gt-e1260b.jpg', 0, 1, '2023-08-19 15:20:16'),
(763, 2, 21, 'gt e1272', 'samsung-gt-e1272.jpg', 0, 1, '2023-08-19 15:20:16'),
(764, 2, 21, 'gt e1282t', 'samsung-gt-e1282t.jpg', 0, 1, '2023-08-19 15:20:16'),
(765, 2, 21, 'gt e2262', 'samsung-gt-e2262.jpg', 0, 1, '2023-08-19 15:20:16'),
(766, 2, 21, 'gt e2350b', 'samsung-gt-e2350b.jpg', 0, 1, '2023-08-19 15:20:16'),
(767, 2, 21, 'gt s5611', 'samsung-gt-s5611.jpg', 0, 1, '2023-08-19 15:20:16'),
(768, 2, 21, 'guru music 2', 'samsung-guru-music-2.jpg', 0, 1, '2023-08-19 15:20:16'),
(769, 2, 21, 'guru plus', 'samsung-guru-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(770, 2, 21, 'i9001 galaxy s plus', 'samsung-i9001-galaxy-s-plus.jpg', 0, 1, '2023-08-19 15:20:16'),
(771, 2, 21, 'i9100g galaxy s ii', 'samsung-i9100g-galaxy-s-ii.jpg', 0, 1, '2023-08-19 15:20:16'),
(772, 2, 21, 'i9103 galaxy r', 'samsung-i9103-galaxy-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(773, 2, 21, 'i9295 galaxy s4 active ofic', 'samsung-i9295-galaxy-s4-active-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(774, 2, 21, 'i9300 galaxy s iii ofic', 'samsung-i9300-galaxy-s-iii-ofic.jpg', 0, 1, '2023-08-19 15:20:16'),
(775, 2, 21, 'i9300l galaxy s3 neo', 'samsung-i9300l-galaxy-s3-neo.jpg', 0, 1, '2023-08-19 15:20:16'),
(776, 2, 21, 'i9301l galaxy s3 neo', 'samsung-i9301l-galaxy-s3-neo.jpg', 0, 1, '2023-08-19 15:20:16'),
(777, 2, 21, 'i9500 fraser', 'samsung-i9500-fraser.jpg', 0, 1, '2023-08-19 15:20:16'),
(778, 2, 21, 'illusion sch i110 verizon', 'samsung-illusion-sch-i110-verizon.jpg', 0, 1, '2023-08-19 15:20:16'),
(779, 2, 21, 'intensity iii u485', 'samsung-intensity-iii-u485.jpg', 0, 1, '2023-08-19 15:20:16'),
(780, 2, 21, 'm370', 'samsung-m370.jpg', 0, 1, '2023-08-19 15:20:16'),
(781, 2, 21, 'manhattan gt e3300', 'samsung-manhattan-gt-e3300.jpg', 0, 1, '2023-08-19 15:20:16'),
(782, 2, 21, 'metro 312', 'samsung-metro-312.jpg', 0, 1, '2023-08-19 15:20:16'),
(783, 2, 21, 'metro 360', 'samsung-metro-360.jpg', 0, 1, '2023-08-19 15:20:16'),
(784, 2, 21, 'metro e2202', 'samsung-metro-e2202.jpg', 0, 1, '2023-08-19 15:20:16'),
(785, 2, 21, 'metro gt e2252', 'samsung-metro-gt-e2252.jpg', 0, 1, '2023-08-19 15:20:16'),
(786, 2, 21, 'note pro 122', 'samsung-note-pro-122.jpg', 0, 1, '2023-08-19 15:20:16'),
(787, 2, 21, 'omnia m', 'samsung-omnia-m.jpg', 0, 1, '2023-08-19 15:20:16'),
(788, 2, 21, 'omnia w i8350', 'samsung-omnia-w-i8350.jpg', 0, 1, '2023-08-19 15:20:16'),
(789, 2, 21, 'proclaim s720', 'samsung-proclaim-s720.jpg', 0, 1, '2023-08-19 15:20:16'),
(790, 2, 21, 'r680 repp', 'samsung-r680-repp.jpg', 0, 1, '2023-08-19 15:20:16'),
(791, 2, 21, 'rex 60 c3312', 'samsung-rex-60-c3312.jpg', 0, 1, '2023-08-19 15:20:16'),
(792, 2, 21, 'rex 70 s3802', 'samsung-rex-70-s3802.jpg', 0, 1, '2023-08-19 15:20:16'),
(793, 2, 21, 'rex 80 s5222', 'samsung-rex-80-s5222.jpg', 0, 1, '2023-08-19 15:20:16'),
(794, 2, 21, 'rex 90 s5292', 'samsung-rex-90-s5292.jpg', 0, 1, '2023-08-19 15:20:16'),
(795, 2, 21, 'rugby iii', 'samsung-rugby-iii.jpg', 0, 1, '2023-08-19 15:20:16'),
(796, 2, 21, 'rugby smart', 'samsung-rugby-smart.jpg', 0, 1, '2023-08-19 15:20:16'),
(797, 2, 21, 's2 tv', 'samsung-s2-tv.jpg', 0, 1, '2023-08-19 15:20:16'),
(798, 2, 21, 's3770', 'samsung-s3770.jpg', 0, 1, '2023-08-19 15:20:16'),
(799, 2, 21, 's5292 star deluxe duos new', 'samsung-s5292-star-deluxe-duos-new.jpg', 0, 1, '2023-08-19 15:20:16'),
(800, 2, 21, 'S5367 Galaxy Y TV', 'Samsung-S5367-Galaxy-Y-TV.jpg', 0, 1, '2023-08-19 15:20:16'),
(801, 2, 21, 's5380 wave y', 'samsung-s5380-wave-y.jpg', 0, 1, '2023-08-19 15:20:16'),
(802, 2, 21, 's5610', 'samsung-s5610.jpg', 0, 1, '2023-08-19 15:20:16'),
(803, 2, 21, 's7250 wave m', 'samsung-s7250-wave-m.jpg', 0, 1, '2023-08-19 15:20:16'),
(804, 2, 21, 'star 3 duos', 'samsung-star-3-duos.jpg', 0, 1, '2023-08-19 15:20:16'),
(805, 2, 21, 'star 3', 'samsung-star-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(806, 2, 21, 'stratosphere', 'samsung-stratosphere.jpg', 0, 1, '2023-08-19 15:20:16'),
(807, 2, 21, 'transfix r730', 'samsung-transfix-r730.jpg', 0, 1, '2023-08-19 15:20:16'),
(808, 2, 21, 'Transform Ultra', 'Samsung-Transform-Ultra.jpg', 0, 1, '2023-08-19 15:20:16'),
(809, 2, 21, 'trender for sprint amethyst color', 'samsung-trender-for-sprint-amethyst-color.jpg', 0, 1, '2023-08-19 15:20:16'),
(810, 2, 21, 'u380 brightside', 'samsung-u380-brightside.jpg', 0, 1, '2023-08-19 15:20:16'),
(811, 2, 21, 'w999', 'samsung-w999.jpg', 0, 1, '2023-08-19 15:20:16'),
(812, 2, 21, 'wave 3', 'samsung-wave-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(813, 2, 21, 'xcover 3', 'samsung-xcover-3.jpg', 0, 1, '2023-08-19 15:20:16'),
(814, 2, 21, 'z 1', 'samsung-z-1.jpg', 0, 1, '2023-08-19 15:20:16'),
(815, 2, 21, 'Z', 'Samsung-Z.jpg', 0, 1, '2023-08-19 15:20:16'),
(816, 2, 21, 'z2', 'samsung-z2.jpg', 0, 1, '2023-08-19 15:20:16'),
(817, 2, 21, 'z3', 'samsung-z3.jpg', 0, 1, '2023-08-19 15:20:16'),
(818, 2, 21, 'z4', 'samsung-z4.jpg', 0, 1, '2023-08-19 15:20:16'),
(819, 2, 21, 'galaxy note10 lite r', 'sasmung-galaxy-note10-lite-r.jpg', 0, 1, '2023-08-19 15:20:16'),
(820, 2, 21, 'galaxy s10 lite', 'sasmung-galaxy-s10-lite-.jpg', 0, 1, '2023-08-19 15:20:16'),
(821, 2, 22, 'iphone 11 pro max ', 'apple-iphone-11-pro-max-.jpg', 0, 1, '2023-08-19 15:51:24'),
(822, 2, 22, 'iphone 11 pro', 'apple-iphone-11-pro.jpg', 0, 1, '2023-08-19 15:51:24'),
(823, 2, 22, 'iphone 11', 'apple-iphone-11.jpg', 0, 1, '2023-08-19 15:51:24'),
(824, 2, 22, 'iphone 12 mini', 'apple-iphone-12-mini.jpg', 0, 1, '2023-08-19 15:51:24'),
(825, 2, 22, 'iphone 12 pro  ', 'apple-iphone-12-pro--.jpg', 0, 1, '2023-08-19 15:51:24'),
(826, 2, 22, 'iphone 12 pro max ', 'apple-iphone-12-pro-max-.jpg', 0, 1, '2023-08-19 15:51:24'),
(827, 2, 22, 'iphone 12', 'apple-iphone-12.jpg', 0, 1, '2023-08-19 15:51:24'),
(828, 2, 22, 'iphone 13 mini', 'apple-iphone-13-mini.jpg', 0, 1, '2023-08-19 15:51:24'),
(829, 2, 22, 'iphone 13 pro max', 'apple-iphone-13-pro-max.jpg', 0, 1, '2023-08-19 15:51:24'),
(830, 2, 22, 'iphone 13 pro', 'apple-iphone-13-pro.jpg', 0, 1, '2023-08-19 15:51:24'),
(831, 2, 22, 'iphone 13', 'apple-iphone-13.jpg', 0, 1, '2023-08-19 15:51:24'),
(832, 2, 22, 'iphone 14 plus', 'apple-iphone-14-plus.jpg', 0, 1, '2023-08-19 15:51:24'),
(833, 2, 22, 'iphone 14 pro max ', 'apple-iphone-14-pro-max-.jpg', 0, 1, '2023-08-19 15:51:24'),
(834, 2, 22, 'iphone 14 pro', 'apple-iphone-14-pro.jpg', 0, 1, '2023-08-19 15:51:24'),
(835, 2, 22, 'iphone 14', 'apple-iphone-14.jpg', 0, 1, '2023-08-19 15:51:24'),
(836, 2, 22, 'iphone 3gs ofic', 'apple-iphone-3gs-ofic.jpg', 0, 1, '2023-08-19 15:51:24'),
(837, 2, 22, 'iphone 4 ofic final', 'apple-iphone-4-ofic-final.jpg', 0, 1, '2023-08-19 15:51:24'),
(838, 2, 22, 'iphone 4s new', 'apple-iphone-4s-new.jpg', 0, 1, '2023-08-19 15:51:24'),
(839, 2, 22, 'iphone 5 ofic', 'apple-iphone-5-ofic.jpg', 0, 1, '2023-08-19 15:51:24'),
(840, 2, 22, 'iphone 5c new2', 'apple-iphone-5c-new2.jpg', 0, 1, '2023-08-19 15:51:24'),
(841, 2, 22, 'iphone 5s ofic', 'apple-iphone-5s-ofic.jpg', 0, 1, '2023-08-19 15:51:24'),
(842, 2, 22, 'iphone 5se ofic', 'apple-iphone-5se-ofic.jpg', 0, 1, '2023-08-19 15:51:24'),
(843, 2, 22, 'iphone 6 4', 'apple-iphone-6-4.jpg', 0, 1, '2023-08-19 15:51:24'),
(844, 2, 22, 'iphone 6 plus2', 'apple-iphone-6-plus2.jpg', 0, 1, '2023-08-19 15:51:24'),
(845, 2, 22, 'iphone 6s plus', 'apple-iphone-6s-plus.jpg', 0, 1, '2023-08-19 15:51:24'),
(846, 2, 22, 'iphone 6s1', 'apple-iphone-6s1.jpg', 0, 1, '2023-08-19 15:51:24'),
(847, 2, 22, 'iphone 7 plus r2', 'apple-iphone-7-plus-r2.jpg', 0, 1, '2023-08-19 15:51:24'),
(848, 2, 22, 'iphone 7r4', 'apple-iphone-7r4.jpg', 0, 1, '2023-08-19 15:51:24'),
(849, 2, 22, 'iphone 8 new', 'apple-iphone-8-new.jpg', 0, 1, '2023-08-19 15:51:24'),
(850, 2, 22, 'iphone 8 plus new', 'apple-iphone-8-plus-new.jpg', 0, 1, '2023-08-19 15:51:24'),
(851, 2, 22, 'iphone se 2020', 'apple-iphone-se-2020.jpg', 0, 1, '2023-08-19 15:51:24'),
(852, 2, 22, 'iphone se 2022', 'apple-iphone-se-2022.jpg', 0, 1, '2023-08-19 15:51:24'),
(853, 2, 22, 'iphone x', 'apple-iphone-x.jpg', 0, 1, '2023-08-19 15:51:24'),
(854, 2, 22, 'iphone xr new', 'apple-iphone-xr-new.jpg', 0, 1, '2023-08-19 15:51:24'),
(855, 2, 22, 'iphone xs max new1', 'apple-iphone-xs-max-new1.jpg', 0, 1, '2023-08-19 15:51:24'),
(856, 2, 22, 'iphone xs new', 'apple-iphone-xs-new.jpg', 0, 1, '2023-08-19 15:51:24'),
(857, 2, 22, 'iphone3g', 'apple-iphone3g.jpg', 0, 1, '2023-08-19 15:51:24'),
(858, 2, 22, 'iphone4 cdma', 'apple-iphone4-cdma.jpg', 0, 1, '2023-08-19 15:51:24'),
(859, 2, 23, 'poco m2 pro', 'poco-m2-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(860, 2, 23, 'redmi note 12 4g', 'redmi-note-12-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(861, 2, 23, 'redmi note 12 5g international', 'redmi-note-12-5g-international.jpg', 0, 1, '2023-08-19 16:09:53'),
(862, 2, 23, 'smartphone', 'smartphone.jpg', 0, 1, '2023-08-19 16:09:53'),
(863, 2, 23, '11 lite 5g ne', 'xiaomi-11-lite-5g-ne.jpg', 0, 1, '2023-08-19 16:09:53'),
(864, 2, 23, '11i hypercharge', 'xiaomi-11i-hypercharge.jpg', 0, 1, '2023-08-19 16:09:53'),
(865, 2, 23, '11i', 'xiaomi-11i.jpg', 0, 1, '2023-08-19 16:09:53'),
(866, 2, 23, '11t pro', 'xiaomi-11t-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(867, 2, 23, '11t', 'xiaomi-11t.jpg', 0, 1, '2023-08-19 16:09:53'),
(868, 2, 23, '12 lite 5g new', 'xiaomi-12-lite-5g-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(869, 2, 23, '12 pro dimensity', 'xiaomi-12-pro-dimensity.jpg', 0, 1, '2023-08-19 16:09:53'),
(870, 2, 23, '12 pro', 'xiaomi-12-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(871, 2, 23, '12', 'xiaomi-12.jpg', 0, 1, '2023-08-19 16:09:53'),
(872, 2, 23, '12s pro', 'xiaomi-12s-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(873, 2, 23, '12s ultra', 'xiaomi-12s-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(874, 2, 23, '12s', 'xiaomi-12s.jpg', 0, 1, '2023-08-19 16:09:53'),
(875, 2, 23, '12t ', 'xiaomi-12t-.jpg', 0, 1, '2023-08-19 16:09:53'),
(876, 2, 23, '12t pro ', 'xiaomi-12t-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(877, 2, 23, '12x', 'xiaomi-12x.jpg', 0, 1, '2023-08-19 16:09:53'),
(878, 2, 23, '13 lite', 'xiaomi-13-lite.jpg', 0, 1, '2023-08-19 16:09:53'),
(879, 2, 23, '13 pro black', 'xiaomi-13-pro-black.jpg', 0, 1, '2023-08-19 16:09:53'),
(880, 2, 23, '13 red', 'xiaomi-13-red.jpg', 0, 1, '2023-08-19 16:09:53'),
(881, 2, 23, '13 ultra', 'xiaomi-13-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(882, 2, 23, 'a1', 'xiaomi-a1.jpg', 0, 1, '2023-08-19 16:09:53'),
(883, 2, 23, 'black shark 2', 'xiaomi-black-shark-2.jpg', 0, 1, '2023-08-19 16:09:53'),
(884, 2, 23, 'black shark 3 pro', 'xiaomi-black-shark-3-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(885, 2, 23, 'black shark 3', 'xiaomi-black-shark-3.jpg', 0, 1, '2023-08-19 16:09:53'),
(886, 2, 23, 'black shark 3s', 'xiaomi-black-shark-3s.jpg', 0, 1, '2023-08-19 16:09:53'),
(887, 2, 23, 'black shark 4 pro', 'xiaomi-black-shark-4-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(888, 2, 23, 'black shark 4', 'xiaomi-black-shark-4.jpg', 0, 1, '2023-08-19 16:09:53'),
(889, 2, 23, 'black shark 4s pro', 'xiaomi-black-shark-4s-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(890, 2, 23, 'black shark 4s', 'xiaomi-black-shark-4s.jpg', 0, 1, '2023-08-19 16:09:53'),
(891, 2, 23, 'black shark 5 ', 'xiaomi-black-shark-5-.jpg', 0, 1, '2023-08-19 16:09:53'),
(892, 2, 23, 'black shark 5 pro', 'xiaomi-black-shark-5-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(893, 2, 23, 'black shark 5 rs', 'xiaomi-black-shark-5-rs.jpg', 0, 1, '2023-08-19 16:09:53'),
(894, 2, 23, 'black shark', 'xiaomi-black-shark.jpg', 0, 1, '2023-08-19 16:09:53'),
(895, 2, 23, 'black shark2 pro ', 'xiaomi-black-shark2-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(896, 2, 23, 'black shark2', 'xiaomi-black-shark2.jpg', 0, 1, '2023-08-19 16:09:53'),
(897, 2, 23, 'civi 1s', 'xiaomi-civi-1s.jpg', 0, 1, '2023-08-19 16:09:53'),
(898, 2, 23, 'civi 3', 'xiaomi-civi-3.jpg', 0, 1, '2023-08-19 16:09:53'),
(899, 2, 23, 'civi', 'xiaomi-civi.jpg', 0, 1, '2023-08-19 16:09:53'),
(900, 2, 23, 'civi2', 'xiaomi-civi2.jpg', 0, 1, '2023-08-19 16:09:53'),
(901, 2, 23, 'Hongmi Redmi 1s', 'Xiaomi-Hongmi-Redmi-1s.jpg', 0, 1, '2023-08-19 16:09:53'),
(902, 2, 23, 'hongmi', 'xiaomi-hongmi.jpg', 0, 1, '2023-08-19 16:09:53'),
(903, 2, 23, 'mi 10 5g', 'xiaomi-mi-10-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(904, 2, 23, 'mi 10 pro 5g', 'xiaomi-mi-10-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(905, 2, 23, 'mi 10 youth 5g ', 'xiaomi-mi-10-youth-5g-.jpg', 0, 1, '2023-08-19 16:09:53'),
(906, 2, 23, 'mi 10i 5g', 'xiaomi-mi-10i-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(907, 2, 23, 'mi 10s', 'xiaomi-mi-10s.jpg', 0, 1, '2023-08-19 16:09:53'),
(908, 2, 23, 'mi 10t 5g ', 'xiaomi-mi-10t-5g-.jpg', 0, 1, '2023-08-19 16:09:53'),
(909, 2, 23, 'mi 10t 5g pro', 'xiaomi-mi-10t-5g-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(910, 2, 23, 'mi 10t lite ', 'xiaomi-mi-10t-lite-.jpg', 0, 1, '2023-08-19 16:09:53'),
(911, 2, 23, 'mi 11 lite 4g', 'xiaomi-mi-11-lite-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(912, 2, 23, 'mi 11 lite 5g', 'xiaomi-mi-11-lite-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(913, 2, 23, 'mi 11 pro 5g', 'xiaomi-mi-11-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(914, 2, 23, 'mi 11i 5g', 'xiaomi-mi-11i-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(915, 2, 23, 'mi 4 lte', 'xiaomi-mi-4-lte.jpg', 0, 1, '2023-08-19 16:09:53'),
(916, 2, 23, 'mi 4', 'xiaomi-mi-4.jpg', 0, 1, '2023-08-19 16:09:53'),
(917, 2, 23, 'mi 4c', 'xiaomi-mi-4c.jpg', 0, 1, '2023-08-19 16:09:53'),
(918, 2, 23, 'mi 4s', 'xiaomi-mi-4s.jpg', 0, 1, '2023-08-19 16:09:53'),
(919, 2, 23, 'mi 5', 'xiaomi-mi-5.jpg', 0, 1, '2023-08-19 16:09:53'),
(920, 2, 23, 'mi 5c', 'xiaomi-mi-5c.jpg', 0, 1, '2023-08-19 16:09:53'),
(921, 2, 23, 'mi 5s plus', 'xiaomi-mi-5s-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(922, 2, 23, 'mi 5s1', 'xiaomi-mi-5s1.jpg', 0, 1, '2023-08-19 16:09:53'),
(923, 2, 23, 'mi 6 plus', 'xiaomi-mi-6-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(924, 2, 23, 'mi 6', 'xiaomi-mi-6.jpg', 0, 1, '2023-08-19 16:09:53'),
(925, 2, 23, 'mi 8 lite ', 'xiaomi-mi-8-lite-.jpg', 0, 1, '2023-08-19 16:09:53'),
(926, 2, 23, 'mi 8 pro ', 'xiaomi-mi-8-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(927, 2, 23, 'mi 9 ', 'xiaomi-mi-9-.jpg', 0, 1, '2023-08-19 16:09:53'),
(928, 2, 23, 'mi 9 explore', 'xiaomi-mi-9-explore.jpg', 0, 1, '2023-08-19 16:09:53'),
(929, 2, 23, 'mi 9 pro 5g', 'xiaomi-mi-9-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(930, 2, 23, 'mi 9 pro', 'xiaomi-mi-9-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(931, 2, 23, 'mi 9 se', 'xiaomi-mi-9-se.jpg', 0, 1, '2023-08-19 16:09:53'),
(932, 2, 23, 'mi 9t', 'xiaomi-mi-9t.jpg', 0, 1, '2023-08-19 16:09:53'),
(933, 2, 23, 'mi a1', 'xiaomi-mi-a1.jpg', 0, 1, '2023-08-19 16:09:53'),
(934, 2, 23, 'mi a2 ', 'xiaomi-mi-a2-.jpg', 0, 1, '2023-08-19 16:09:53'),
(935, 2, 23, 'mi a2 lite', 'xiaomi-mi-a2-lite.jpg', 0, 1, '2023-08-19 16:09:53'),
(936, 2, 23, 'mi a3', 'xiaomi-mi-a3.jpg', 0, 1, '2023-08-19 16:09:53'),
(937, 2, 23, 'mi cc9 ', 'xiaomi-mi-cc9-.jpg', 0, 1, '2023-08-19 16:09:53'),
(938, 2, 23, 'mi cc9 pro ', 'xiaomi-mi-cc9-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(939, 2, 23, 'mi cc9e ', 'xiaomi-mi-cc9e-.jpg', 0, 1, '2023-08-19 16:09:53'),
(940, 2, 23, 'mi max ', 'xiaomi-mi-max-.jpg', 0, 1, '2023-08-19 16:09:53'),
(941, 2, 23, 'mi max2', 'xiaomi-mi-max2.jpg', 0, 1, '2023-08-19 16:09:53'),
(942, 2, 23, 'mi max3 ', 'xiaomi-mi-max3-.jpg', 0, 1, '2023-08-19 16:09:53'),
(943, 2, 23, 'mi mix 2s', 'xiaomi-mi-mix-2s.jpg', 0, 1, '2023-08-19 16:09:53'),
(944, 2, 23, 'mi mix 4', 'xiaomi-mi-mix-4.jpg', 0, 1, '2023-08-19 16:09:53'),
(945, 2, 23, 'mi mix alpha', 'xiaomi-mi-mix-alpha.jpg', 0, 1, '2023-08-19 16:09:53'),
(946, 2, 23, 'mi mix fold', 'xiaomi-mi-mix-fold.jpg', 0, 1, '2023-08-19 16:09:53'),
(947, 2, 23, 'mi mix2 new', 'xiaomi-mi-mix2-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(948, 2, 23, 'mi mix3', 'xiaomi-mi-mix3.jpg', 0, 1, '2023-08-19 16:09:53'),
(949, 2, 23, 'mi note 10 lite ', 'xiaomi-mi-note-10-lite-.jpg', 0, 1, '2023-08-19 16:09:53'),
(950, 2, 23, 'mi note10 ', 'xiaomi-mi-note10-.jpg', 0, 1, '2023-08-19 16:09:53'),
(951, 2, 23, 'mi note2 ', 'xiaomi-mi-note2-.jpg', 0, 1, '2023-08-19 16:09:53'),
(952, 2, 23, 'mi note3 ', 'xiaomi-mi-note3-.jpg', 0, 1, '2023-08-19 16:09:53'),
(953, 2, 23, 'mi1', 'xiaomi-mi1.jpg', 0, 1, '2023-08-19 16:09:53'),
(954, 2, 23, 'mi10 lite 5g', 'xiaomi-mi10-lite-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(955, 2, 23, 'mi10 ultra', 'xiaomi-mi10-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(956, 2, 23, 'mi11 ultra 5g k1', 'xiaomi-mi11-ultra-5g-k1.jpg', 0, 1, '2023-08-19 16:09:53'),
(957, 2, 23, 'mi11', 'xiaomi-mi11.jpg', 0, 1, '2023-08-19 16:09:53'),
(958, 2, 23, 'mi11x pro', 'xiaomi-mi11x-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(959, 2, 23, 'mi11x', 'xiaomi-mi11x.jpg', 0, 1, '2023-08-19 16:09:53'),
(960, 2, 23, 'mi2', 'xiaomi-mi2.jpg', 0, 1, '2023-08-19 16:09:53'),
(961, 2, 23, 'mi2a', 'xiaomi-mi2a.jpg', 0, 1, '2023-08-19 16:09:53'),
(962, 2, 23, 'mi2s', 'xiaomi-mi2s.jpg', 0, 1, '2023-08-19 16:09:53'),
(963, 2, 23, 'mi3', 'xiaomi-mi3.jpg', 0, 1, '2023-08-19 16:09:53'),
(964, 2, 23, 'mi4i', 'xiaomi-mi4i.jpg', 0, 1, '2023-08-19 16:09:53'),
(965, 2, 23, 'mi8 explore ', 'xiaomi-mi8-explore-.jpg', 0, 1, '2023-08-19 16:09:53'),
(966, 2, 23, 'mi8 se', 'xiaomi-mi8-se.jpg', 0, 1, '2023-08-19 16:09:53'),
(967, 2, 23, 'mi8', 'xiaomi-mi8.jpg', 0, 1, '2023-08-19 16:09:53'),
(968, 2, 23, 'miplay', 'xiaomi-miplay.jpg', 0, 1, '2023-08-19 16:09:53'),
(969, 2, 23, 'mix ', 'xiaomi-mix-.jpg', 0, 1, '2023-08-19 16:09:53'),
(970, 2, 23, 'mix fold 2', 'xiaomi-mix-fold-2.jpg', 0, 1, '2023-08-19 16:09:53'),
(971, 2, 23, 'mix fold3 ', 'xiaomi-mix-fold3-.jpg', 0, 1, '2023-08-19 16:09:53'),
(972, 2, 23, 'note 11 pro plus 5g', 'xiaomi-note-11-pro-plus-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(973, 2, 23, 'note 2015', 'xiaomi-note-2015.jpg', 0, 1, '2023-08-19 16:09:53'),
(974, 2, 23, 'note pro2', 'xiaomi-note-pro2.jpg', 0, 1, '2023-08-19 16:09:53'),
(975, 2, 23, 'poco c3', 'xiaomi-poco-c3.jpg', 0, 1, '2023-08-19 16:09:53'),
(976, 2, 23, 'poco c31', 'xiaomi-poco-c31.jpg', 0, 1, '2023-08-19 16:09:53'),
(977, 2, 23, 'poco c40', 'xiaomi-poco-c40.jpg', 0, 1, '2023-08-19 16:09:53'),
(978, 2, 23, 'poco c50', 'xiaomi-poco-c50.jpg', 0, 1, '2023-08-19 16:09:53'),
(979, 2, 23, 'poco c51', 'xiaomi-poco-c51.jpg', 0, 1, '2023-08-19 16:09:53'),
(980, 2, 23, 'poco c55', 'xiaomi-poco-c55.jpg', 0, 1, '2023-08-19 16:09:53'),
(981, 2, 23, 'poco f2 pro', 'xiaomi-poco-f2-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(982, 2, 23, 'poco f3 gt', 'xiaomi-poco-f3-gt.jpg', 0, 1, '2023-08-19 16:09:53'),
(983, 2, 23, 'poco f3', 'xiaomi-poco-f3.jpg', 0, 1, '2023-08-19 16:09:53'),
(984, 2, 23, 'poco f4 5g ', 'xiaomi-poco-f4-5g-.jpg', 0, 1, '2023-08-19 16:09:53'),
(985, 2, 23, 'poco f4 gt', 'xiaomi-poco-f4-gt.jpg', 0, 1, '2023-08-19 16:09:53'),
(986, 2, 23, 'poco f5 2', 'xiaomi-poco-f5-2.jpg', 0, 1, '2023-08-19 16:09:53'),
(987, 2, 23, 'poco f5 pro 2', 'xiaomi-poco-f5-pro-2.jpg', 0, 1, '2023-08-19 16:09:53'),
(988, 2, 23, 'poco m2 mzb9921in', 'xiaomi-poco-m2-mzb9921in.jpg', 0, 1, '2023-08-19 16:09:53'),
(989, 2, 23, 'poco m2 reloaded', 'xiaomi-poco-m2-reloaded.jpg', 0, 1, '2023-08-19 16:09:53'),
(990, 2, 23, 'poco m3 ', 'xiaomi-poco-m3-.jpg', 0, 1, '2023-08-19 16:09:53'),
(991, 2, 23, 'poco m3 pro 4g', 'xiaomi-poco-m3-pro-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(992, 2, 23, 'poco m3 pro 5g', 'xiaomi-poco-m3-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(993, 2, 23, 'poco m4 5g global', 'xiaomi-poco-m4-5g-global.jpg', 0, 1, '2023-08-19 16:09:53'),
(994, 2, 23, 'poco m4 5g', 'xiaomi-poco-m4-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(995, 2, 23, 'poco m4 pro 5g', 'xiaomi-poco-m4-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(996, 2, 23, 'poco m4 pro', 'xiaomi-poco-m4-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(997, 2, 23, 'poco m5', 'xiaomi-poco-m5.jpg', 0, 1, '2023-08-19 16:09:53'),
(998, 2, 23, 'poco m5s', 'xiaomi-poco-m5s.jpg', 0, 1, '2023-08-19 16:09:53'),
(999, 2, 23, 'poco m6 pro', 'xiaomi-poco-m6-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1000, 2, 23, 'poco x2', 'xiaomi-poco-x2.jpg', 0, 1, '2023-08-19 16:09:53'),
(1001, 2, 23, 'poco x3 nfc', 'xiaomi-poco-x3-nfc.jpg', 0, 1, '2023-08-19 16:09:53'),
(1002, 2, 23, 'poco x3 pro ', 'xiaomi-poco-x3-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1003, 2, 23, 'poco x3', 'xiaomi-poco-x3.jpg', 0, 1, '2023-08-19 16:09:53'),
(1004, 2, 23, 'poco x4 gt', 'xiaomi-poco-x4-gt.jpg', 0, 1, '2023-08-19 16:09:53'),
(1005, 2, 23, 'poco x4 pro', 'xiaomi-poco-x4-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1006, 2, 23, 'poco x5 5g', 'xiaomi-poco-x5-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1007, 2, 23, 'poco x5 pro 5g', 'xiaomi-poco-x5-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1008, 2, 23, 'pocophone f1 ', 'xiaomi-pocophone-f1-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1009, 2, 23, 'redmi 10 ', 'xiaomi-redmi-10-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1010, 2, 23, 'redmi 10 5g', 'xiaomi-redmi-10-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1011, 2, 23, 'redmi 10 india', 'xiaomi-redmi-10-india.jpg', 0, 1, '2023-08-19 16:09:53'),
(1012, 2, 23, 'redmi 10 power ', 'xiaomi-redmi-10-power-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1013, 2, 23, 'redmi 10a', 'xiaomi-redmi-10a.jpg', 0, 1, '2023-08-19 16:09:53'),
(1014, 2, 23, 'redmi 10c', 'xiaomi-redmi-10c.jpg', 0, 1, '2023-08-19 16:09:53'),
(1015, 2, 23, 'redmi 10x 4g', 'xiaomi-redmi-10x-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1016, 2, 23, 'redmi 10x 5g', 'xiaomi-redmi-10x-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1017, 2, 23, 'redmi 10x pro 5g', 'xiaomi-redmi-10x-pro-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1018, 2, 23, 'redmi 11 prime 4g', 'xiaomi-redmi-11-prime-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1019, 2, 23, 'redmi 11a r', 'xiaomi-redmi-11a-r.jpg', 0, 1, '2023-08-19 16:09:53'),
(1020, 2, 23, 'redmi 12 ', 'xiaomi-redmi-12-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1021, 2, 23, 'redmi 12 5g ', 'xiaomi-redmi-12-5g-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1022, 2, 23, 'redmi 12c', 'xiaomi-redmi-12c.jpg', 0, 1, '2023-08-19 16:09:53'),
(1023, 2, 23, 'redmi 2 prime ', 'xiaomi-redmi-2-prime-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1024, 2, 23, 'redmi 2', 'xiaomi-redmi-2.jpg', 0, 1, '2023-08-19 16:09:53'),
(1025, 2, 23, 'redmi 3 ', 'xiaomi-redmi-3-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1026, 2, 23, 'redmi 3 pro ', 'xiaomi-redmi-3-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1027, 2, 23, 'redmi 3s', 'xiaomi-redmi-3s.jpg', 0, 1, '2023-08-19 16:09:53'),
(1028, 2, 23, 'redmi 3x', 'xiaomi-redmi-3x.jpg', 0, 1, '2023-08-19 16:09:53'),
(1029, 2, 23, 'redmi 4 prime ', 'xiaomi-redmi-4-prime-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1030, 2, 23, 'redmi 4 prime new', 'xiaomi-redmi-4-prime-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(1031, 2, 23, 'redmi 4a ', 'xiaomi-redmi-4a-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1032, 2, 23, 'redmi 4x', 'xiaomi-redmi-4x.jpg', 0, 1, '2023-08-19 16:09:53'),
(1033, 2, 23, 'redmi 5 plus', 'xiaomi-redmi-5-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(1034, 2, 23, 'redmi 5', 'xiaomi-redmi-5.jpg', 0, 1, '2023-08-19 16:09:53'),
(1035, 2, 23, 'redmi 5a', 'xiaomi-redmi-5a.jpg', 0, 1, '2023-08-19 16:09:53'),
(1036, 2, 23, 'redmi 6', 'xiaomi-redmi-6.jpg', 0, 1, '2023-08-19 16:09:53'),
(1037, 2, 23, 'redmi 6a', 'xiaomi-redmi-6a.jpg', 0, 1, '2023-08-19 16:09:53'),
(1038, 2, 23, 'redmi 7', 'xiaomi-redmi-7.jpg', 0, 1, '2023-08-19 16:09:53'),
(1039, 2, 23, 'redmi 7a mzb8008in', 'xiaomi-redmi-7a-mzb8008in.jpg', 0, 1, '2023-08-19 16:09:53'),
(1040, 2, 23, 'redmi 8', 'xiaomi-redmi-8.jpg', 0, 1, '2023-08-19 16:09:53'),
(1041, 2, 23, 'redmi 8a dual', 'xiaomi-redmi-8a-dual.jpg', 0, 1, '2023-08-19 16:09:53'),
(1042, 2, 23, 'redmi 8a', 'xiaomi-redmi-8a.jpg', 0, 1, '2023-08-19 16:09:53'),
(1043, 2, 23, 'redmi 9 activ', 'xiaomi-redmi-9-activ.jpg', 0, 1, '2023-08-19 16:09:53'),
(1044, 2, 23, 'redmi 9 india', 'xiaomi-redmi-9-india.jpg', 0, 1, '2023-08-19 16:09:53'),
(1045, 2, 23, 'redmi 9 power', 'xiaomi-redmi-9-power.jpg', 0, 1, '2023-08-19 16:09:53'),
(1046, 2, 23, 'redmi 9', 'xiaomi-redmi-9.jpg', 0, 1, '2023-08-19 16:09:53'),
(1047, 2, 23, 'redmi 9a 1', 'xiaomi-redmi-9a-1.jpg', 0, 1, '2023-08-19 16:09:53'),
(1048, 2, 23, 'redmi 9a sport', 'xiaomi-redmi-9a-sport.jpg', 0, 1, '2023-08-19 16:09:53'),
(1049, 2, 23, 'redmi 9c ', 'xiaomi-redmi-9c-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1050, 2, 23, 'redmi 9i sport', 'xiaomi-redmi-9i-sport.jpg', 0, 1, '2023-08-19 16:09:53'),
(1051, 2, 23, 'redmi a1 plus new', 'xiaomi-redmi-a1-plus-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(1052, 2, 23, 'redmi a2 ', 'xiaomi-redmi-a2-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1053, 2, 23, 'redmi a2 plus', 'xiaomi-redmi-a2-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(1054, 2, 23, 'redmi go', 'xiaomi-redmi-go.jpg', 0, 1, '2023-08-19 16:09:53'),
(1055, 2, 23, 'redmi k20pro ', 'xiaomi-redmi-k20pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1056, 2, 23, 'redmi k30 5g racing edition1', 'xiaomi-redmi-k30-5g-racing-edition1.jpg', 0, 1, '2023-08-19 16:09:53'),
(1057, 2, 23, 'redmi k30 5g', 'xiaomi-redmi-k30-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1058, 2, 23, 'redmi k30 pro zoom', 'xiaomi-redmi-k30-pro-zoom.jpg', 0, 1, '2023-08-19 16:09:53'),
(1059, 2, 23, 'redmi k30 pro', 'xiaomi-redmi-k30-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1060, 2, 23, 'redmi k30 ultra', 'xiaomi-redmi-k30-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(1061, 2, 23, 'redmi k30', 'xiaomi-redmi-k30.jpg', 0, 1, '2023-08-19 16:09:53'),
(1062, 2, 23, 'redmi k30i 5g ', 'xiaomi-redmi-k30i-5g-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1063, 2, 23, 'redmi k40 gaming', 'xiaomi-redmi-k40-gaming.jpg', 0, 1, '2023-08-19 16:09:53'),
(1064, 2, 23, 'redmi k40 pro plus', 'xiaomi-redmi-k40-pro-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(1065, 2, 23, 'redmi k40 pro', 'xiaomi-redmi-k40-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1066, 2, 23, 'redmi k40', 'xiaomi-redmi-k40.jpg', 0, 1, '2023-08-19 16:09:53'),
(1067, 2, 23, 'redmi k40s', 'xiaomi-redmi-k40s.jpg', 0, 1, '2023-08-19 16:09:53'),
(1068, 2, 23, 'redmi k50 gaming', 'xiaomi-redmi-k50-gaming.jpg', 0, 1, '2023-08-19 16:09:53'),
(1069, 2, 23, 'redmi k50 pro', 'xiaomi-redmi-k50-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1070, 2, 23, 'redmi k50 ultra', 'xiaomi-redmi-k50-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(1071, 2, 23, 'redmi k50', 'xiaomi-redmi-k50.jpg', 0, 1, '2023-08-19 16:09:53'),
(1072, 2, 23, 'redmi k50i 5g', 'xiaomi-redmi-k50i-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1073, 2, 23, 'redmi k60 pro', 'xiaomi-redmi-k60-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1074, 2, 23, 'redmi k60 ultra', 'xiaomi-redmi-k60-ultra.jpg', 0, 1, '2023-08-19 16:09:53'),
(1075, 2, 23, 'redmi k60', 'xiaomi-redmi-k60.jpg', 0, 1, '2023-08-19 16:09:53'),
(1076, 2, 23, 'redmi k60e', 'xiaomi-redmi-k60e.jpg', 0, 1, '2023-08-19 16:09:53'),
(1077, 2, 23, 'redmi note 10 lite', 'xiaomi-redmi-note-10-lite.jpg', 0, 1, '2023-08-19 16:09:53'),
(1078, 2, 23, 'redmi note 10 pro china new', 'xiaomi-redmi-note-10-pro-china-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(1079, 2, 23, 'redmi note 10t 5g', 'xiaomi-redmi-note-10t-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1080, 2, 23, 'redmi note 11 4g', 'xiaomi-redmi-note-11-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1081, 2, 23, 'redmi note 11 global', 'xiaomi-redmi-note-11-global.jpg', 0, 1, '2023-08-19 16:09:53'),
(1082, 2, 23, 'redmi note 11 pro 5g global', 'xiaomi-redmi-note-11-pro-5g-global.jpg', 0, 1, '2023-08-19 16:09:53'),
(1083, 2, 23, 'redmi note 11 pro global', 'xiaomi-redmi-note-11-pro-global.jpg', 0, 1, '2023-08-19 16:09:53'),
(1084, 2, 23, 'redmi note 11e pro', 'xiaomi-redmi-note-11e-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1085, 2, 23, 'redmi note 11e', 'xiaomi-redmi-note-11e.jpg', 0, 1, '2023-08-19 16:09:53'),
(1086, 2, 23, 'redmi note 11r', 'xiaomi-redmi-note-11r.jpg', 0, 1, '2023-08-19 16:09:53'),
(1087, 2, 23, 'redmi note 11s 5g', 'xiaomi-redmi-note-11s-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1088, 2, 23, 'redmi note 11s global', 'xiaomi-redmi-note-11s-global.jpg', 0, 1, '2023-08-19 16:09:53'),
(1089, 2, 23, 'redmi note 11se', 'xiaomi-redmi-note-11se.jpg', 0, 1, '2023-08-19 16:09:53'),
(1090, 2, 23, 'redmi note 11t 5g', 'xiaomi-redmi-note-11t-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1091, 2, 23, 'redmi note 11t pro plus', 'xiaomi-redmi-note-11t-pro-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(1092, 2, 23, 'redmi note 11t pro', 'xiaomi-redmi-note-11t-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1093, 2, 23, 'redmi note 12 5g', 'xiaomi-redmi-note-12-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1094, 2, 23, 'redmi note 12 pro 4g', 'xiaomi-redmi-note-12-pro-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1095, 2, 23, 'redmi note 12 pro discovery explorer', 'xiaomi-redmi-note-12-pro-discovery-explorer.jpg', 0, 1, '2023-08-19 16:09:53'),
(1096, 2, 23, 'redmi note 12 pro plus', 'xiaomi-redmi-note-12-pro-plus.jpg', 0, 1, '2023-08-19 16:09:53'),
(1097, 2, 23, 'redmi note 12 pro speed', 'xiaomi-redmi-note-12-pro-speed.jpg', 0, 1, '2023-08-19 16:09:53'),
(1098, 2, 23, 'redmi note 12 pro', 'xiaomi-redmi-note-12-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1099, 2, 23, 'redmi note 12 turbo', 'xiaomi-redmi-note-12-turbo.jpg', 0, 1, '2023-08-19 16:09:53'),
(1100, 2, 23, 'redmi note 12r pro ', 'xiaomi-redmi-note-12r-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1101, 2, 23, 'redmi note 12r', 'xiaomi-redmi-note-12r.jpg', 0, 1, '2023-08-19 16:09:53'),
(1102, 2, 23, 'redmi note 12s', 'xiaomi-redmi-note-12s.jpg', 0, 1, '2023-08-19 16:09:53'),
(1103, 2, 23, 'redmi note 12t pro', 'xiaomi-redmi-note-12t-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1104, 2, 23, 'redmi note 2  ', 'xiaomi-redmi-note-2--.jpg', 0, 1, '2023-08-19 16:09:53'),
(1105, 2, 23, 'redmi note 3', 'xiaomi-redmi-note-3.jpg', 0, 1, '2023-08-19 16:09:53'),
(1106, 2, 23, 'redmi note 4 sn', 'xiaomi-redmi-note-4-sn.jpg', 0, 1, '2023-08-19 16:09:53'),
(1107, 2, 23, 'redmi note 4', 'xiaomi-redmi-note-4.jpg', 0, 1, '2023-08-19 16:09:53'),
(1108, 2, 23, 'redmi note 4g', 'xiaomi-redmi-note-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1109, 2, 23, 'redmi note 4x', 'xiaomi-redmi-note-4x.jpg', 0, 1, '2023-08-19 16:09:53'),
(1110, 2, 23, 'redmi note 5 ai dual camera', 'xiaomi-redmi-note-5-ai-dual-camera.jpg', 0, 1, '2023-08-19 16:09:53'),
(1111, 2, 23, 'redmi note 5 pro', 'xiaomi-redmi-note-5-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1112, 2, 23, 'redmi note 5a', 'xiaomi-redmi-note-5a.jpg', 0, 1, '2023-08-19 16:09:53'),
(1113, 2, 23, 'redmi note 5as', 'xiaomi-redmi-note-5as.jpg', 0, 1, '2023-08-19 16:09:53'),
(1114, 2, 23, 'redmi note 6 pro r', 'xiaomi-redmi-note-6-pro-r.jpg', 0, 1, '2023-08-19 16:09:53'),
(1115, 2, 23, 'redmi note 7 pro', 'xiaomi-redmi-note-7-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1116, 2, 23, 'redmi note 7', 'xiaomi-redmi-note-7.jpg', 0, 1, '2023-08-19 16:09:53'),
(1117, 2, 23, 'redmi note 7s', 'xiaomi-redmi-note-7s.jpg', 0, 1, '2023-08-19 16:09:53'),
(1118, 2, 23, 'redmi note 8 1', 'xiaomi-redmi-note-8-1.jpg', 0, 1, '2023-08-19 16:09:53'),
(1119, 2, 23, 'redmi note 8 pro ', 'xiaomi-redmi-note-8-pro-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1120, 2, 23, 'redmi note 8t', 'xiaomi-redmi-note-8t.jpg', 0, 1, '2023-08-19 16:09:53'),
(1121, 2, 23, 'redmi note 9 5g', 'xiaomi-redmi-note-9-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1122, 2, 23, 'redmi note 9 pro global ', 'xiaomi-redmi-note-9-pro-global-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1123, 2, 23, 'redmi note 9 pro max', 'xiaomi-redmi-note-9-pro-max.jpg', 0, 1, '2023-08-19 16:09:53'),
(1124, 2, 23, 'redmi note 9 pro', 'xiaomi-redmi-note-9-pro.jpg', 0, 1, '2023-08-19 16:09:53');
INSERT INTO `modal` (`id`, `category_id`, `brand_id`, `modal_name`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(1125, 2, 23, 'redmi note 9', 'xiaomi-redmi-note-9.jpg', 0, 1, '2023-08-19 16:09:53'),
(1126, 2, 23, 'redmi note 9t 5g', 'xiaomi-redmi-note-9t-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1127, 2, 23, 'redmi note new', 'xiaomi-redmi-note-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(1128, 2, 23, 'redmi note prime ', 'xiaomi-redmi-note-prime-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1129, 2, 23, 'redmi note10  ', 'xiaomi-redmi-note10--.jpg', 0, 1, '2023-08-19 16:09:53'),
(1130, 2, 23, 'redmi note10 5g', 'xiaomi-redmi-note10-5g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1131, 2, 23, 'redmi note10 pro india', 'xiaomi-redmi-note10-pro-india.jpg', 0, 1, '2023-08-19 16:09:53'),
(1132, 2, 23, 'redmi note10 pro', 'xiaomi-redmi-note10-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1133, 2, 23, 'redmi note10s', 'xiaomi-redmi-note10s.jpg', 0, 1, '2023-08-19 16:09:53'),
(1134, 2, 23, 'redmi note11 pro plus new', 'xiaomi-redmi-note11-pro-plus-new.jpg', 0, 1, '2023-08-19 16:09:53'),
(1135, 2, 23, 'redmi note11 pro', 'xiaomi-redmi-note11-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1136, 2, 23, 'redmi note11', 'xiaomi-redmi-note11.jpg', 0, 1, '2023-08-19 16:09:53'),
(1137, 2, 23, 'redmi note8 2021', 'xiaomi-redmi-note8-2021.jpg', 0, 1, '2023-08-19 16:09:53'),
(1138, 2, 23, 'redmi note9 4g', 'xiaomi-redmi-note9-4g.jpg', 0, 1, '2023-08-19 16:09:53'),
(1139, 2, 23, 'redmi note9 pro', 'xiaomi-redmi-note9-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1140, 2, 23, 'redmi pro', 'xiaomi-redmi-pro.jpg', 0, 1, '2023-08-19 16:09:53'),
(1141, 2, 23, 'redmi s2 ', 'xiaomi-redmi-s2-.jpg', 0, 1, '2023-08-19 16:09:53'),
(1142, 2, 23, 'redmi y3', 'xiaomi-redmi-y3.jpg', 0, 1, '2023-08-19 16:09:53'),
(1143, 2, 23, 'a1 5g new', 'oppo-a1-5g-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1144, 2, 23, 'a1 pro', 'oppo-a1-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1145, 2, 23, 'a1', 'oppo-a1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1146, 2, 23, 'a11k', 'oppo-a11k.jpg', 0, 1, '2023-08-19 16:29:26'),
(1147, 2, 23, 'a11s', 'oppo-a11s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1148, 2, 23, 'a12', 'oppo-a12.jpg', 0, 1, '2023-08-19 16:29:26'),
(1149, 2, 23, 'a12e', 'oppo-a12e.jpg', 0, 1, '2023-08-19 16:29:26'),
(1150, 2, 23, 'a15', 'oppo-a15.jpg', 0, 1, '2023-08-19 16:29:26'),
(1151, 2, 23, 'a15s', 'oppo-a15s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1152, 2, 23, 'a16', 'oppo-a16.jpg', 0, 1, '2023-08-19 16:29:26'),
(1153, 2, 23, 'a16k', 'oppo-a16k.jpg', 0, 1, '2023-08-19 16:29:26'),
(1154, 2, 23, 'a17', 'oppo-a17.jpg', 0, 1, '2023-08-19 16:29:26'),
(1155, 2, 23, 'a17k', 'oppo-a17k.jpg', 0, 1, '2023-08-19 16:29:26'),
(1156, 2, 23, 'a1k', 'oppo-a1k.jpg', 0, 1, '2023-08-19 16:29:26'),
(1157, 2, 23, 'a1x ', 'oppo-a1x-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1158, 2, 23, 'a3', 'oppo-a3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1159, 2, 23, 'a31 01', 'oppo-a31-01.jpg', 0, 1, '2023-08-19 16:29:26'),
(1160, 2, 23, 'a31', 'oppo-a31.jpg', 0, 1, '2023-08-19 16:29:26'),
(1161, 2, 23, 'a32', 'oppo-a32.jpg', 0, 1, '2023-08-19 16:29:26'),
(1162, 2, 23, 'a33', 'oppo-a33.jpg', 0, 1, '2023-08-19 16:29:26'),
(1163, 2, 23, 'a36', 'oppo-a36.jpg', 0, 1, '2023-08-19 16:29:26'),
(1164, 2, 23, 'a37', 'oppo-a37.jpg', 0, 1, '2023-08-19 16:29:26'),
(1165, 2, 23, 'a39', 'oppo-a39.jpg', 0, 1, '2023-08-19 16:29:26'),
(1166, 2, 23, 'a3s', 'oppo-a3s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1167, 2, 23, 'a5 2020', 'oppo-a5-2020.jpg', 0, 1, '2023-08-19 16:29:26'),
(1168, 2, 23, 'a5', 'oppo-a5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1169, 2, 23, 'a52', 'oppo-a52.jpg', 0, 1, '2023-08-19 16:29:26'),
(1170, 2, 23, 'a53 2020', 'oppo-a53-2020.jpg', 0, 1, '2023-08-19 16:29:26'),
(1171, 2, 23, 'a53 5g', 'oppo-a53-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1172, 2, 23, 'a53', 'oppo-a53.jpg', 0, 1, '2023-08-19 16:29:26'),
(1173, 2, 23, 'a53s 5g', 'oppo-a53s-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1174, 2, 23, 'a54 5g', 'oppo-a54-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1175, 2, 23, 'a54', 'oppo-a54.jpg', 0, 1, '2023-08-19 16:29:26'),
(1176, 2, 23, 'a55 4g 1', 'oppo-a55-4g-1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1177, 2, 23, 'a55 5g', 'oppo-a55-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1178, 2, 23, 'a55s 5g', 'oppo-a55s-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1179, 2, 23, 'a56 5g', 'oppo-a56-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1180, 2, 23, 'a56s', 'oppo-a56s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1181, 2, 23, 'a57 4g', 'oppo-a57-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1182, 2, 24, 'a57 5g', 'oppo-a57-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1183, 2, 24, 'a57', 'oppo-a57.jpg', 0, 1, '2023-08-19 16:29:26'),
(1184, 2, 24, 'a57s', 'oppo-a57s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1185, 2, 24, 'a58 4g', 'oppo-a58-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1186, 2, 24, 'a58', 'oppo-a58.jpg', 0, 1, '2023-08-19 16:29:26'),
(1187, 2, 24, 'a58x', 'oppo-a58x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1188, 2, 24, 'a59', 'oppo-a59.jpg', 0, 1, '2023-08-19 16:29:26'),
(1189, 2, 24, 'a5s r', 'oppo-a5s-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1190, 2, 24, 'a7', 'oppo-a7.jpg', 0, 1, '2023-08-19 16:29:26'),
(1191, 2, 24, 'a71 ', 'oppo-a71-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1192, 2, 24, 'a71 2018', 'oppo-a71-2018.jpg', 0, 1, '2023-08-19 16:29:26'),
(1193, 2, 24, 'a72 5g', 'oppo-a72-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1194, 2, 24, 'a72', 'oppo-a72.jpg', 0, 1, '2023-08-19 16:29:26'),
(1195, 2, 24, 'a73 5g ', 'oppo-a73-5g-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1196, 2, 24, 'a73', 'oppo-a73.jpg', 0, 1, '2023-08-19 16:29:26'),
(1197, 2, 24, 'a74 5g', 'oppo-a74-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1198, 2, 24, 'a77 ', 'oppo-a77-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1199, 2, 24, 'a77 4g', 'oppo-a77-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1200, 2, 24, 'a77 5g', 'oppo-a77-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1201, 2, 24, 'a77 sn', 'oppo-a77-sn.jpg', 0, 1, '2023-08-19 16:29:26'),
(1202, 2, 24, 'a77s', 'oppo-a77s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1203, 2, 24, 'a78 4g', 'oppo-a78-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1204, 2, 24, 'a7n', 'oppo-a7n.jpg', 0, 1, '2023-08-19 16:29:26'),
(1205, 2, 24, 'a7x ', 'oppo-a7x-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1206, 2, 24, 'a8 ', 'oppo-a8-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1207, 2, 24, 'a83', 'oppo-a83.jpg', 0, 1, '2023-08-19 16:29:26'),
(1208, 2, 24, 'a9 2020 ', 'oppo-a9-2020-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1209, 2, 24, 'a9', 'oppo-a9.jpg', 0, 1, '2023-08-19 16:29:26'),
(1210, 2, 24, 'a91', 'oppo-a91.jpg', 0, 1, '2023-08-19 16:29:26'),
(1211, 2, 24, 'a92 ', 'oppo-a92-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1212, 2, 24, 'a92s', 'oppo-a92s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1213, 2, 24, 'a93 ', 'oppo-a93-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1214, 2, 24, 'a93 5g', 'oppo-a93-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1215, 2, 24, 'a93s 5g', 'oppo-a93s-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1216, 2, 24, 'a94 5g', 'oppo-a94-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1217, 2, 24, 'a95 5g', 'oppo-a95-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1218, 2, 24, 'a95', 'oppo-a95.jpg', 0, 1, '2023-08-19 16:29:26'),
(1219, 2, 24, 'a96 new', 'oppo-a96-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1220, 2, 24, 'a96', 'oppo-a96.jpg', 0, 1, '2023-08-19 16:29:26'),
(1221, 2, 24, 'a97 5g', 'oppo-a97-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1222, 2, 24, 'a98 5g', 'oppo-a98-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1223, 2, 24, 'f1 plus', 'oppo-f1-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1224, 2, 24, 'f1', 'oppo-f1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1225, 2, 24, 'f11 ', 'oppo-f11-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1226, 2, 24, 'f11 pro ', 'oppo-f11-pro-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1227, 2, 24, 'f15 cph2001', 'oppo-f15-cph2001.jpg', 0, 1, '2023-08-19 16:29:26'),
(1228, 2, 24, 'f17 pro   ', 'oppo-f17-pro---.jpg', 0, 1, '2023-08-19 16:29:26'),
(1229, 2, 24, 'f17', 'oppo-f17.jpg', 0, 1, '2023-08-19 16:29:26'),
(1230, 2, 24, 'f19 pro plus r', 'oppo-f19-pro-plus-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1231, 2, 24, 'f19 pro r', 'oppo-f19-pro-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1232, 2, 24, 'f19', 'oppo-f19.jpg', 0, 1, '2023-08-19 16:29:26'),
(1233, 2, 24, 'f19s', 'oppo-f19s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1234, 2, 24, 'f1s', 'oppo-f1s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1235, 2, 24, 'f23 5g', 'oppo-f23-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1236, 2, 24, 'f3 plus', 'oppo-f3-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1237, 2, 24, 'f5 youth a73 new', 'oppo-f5-youth-a73-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1238, 2, 24, 'f7 ', 'oppo-f7-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1239, 2, 24, 'f7 yough 5', 'oppo-f7-yough-5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1240, 2, 24, 'f9', 'oppo-f9.jpg', 0, 1, '2023-08-19 16:29:26'),
(1241, 2, 24, 'find 5 mini', 'oppo-find-5-mini.jpg', 0, 1, '2023-08-19 16:29:26'),
(1242, 2, 24, 'find 5', 'oppo-find-5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1243, 2, 24, 'find 7 new', 'oppo-find-7-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1244, 2, 24, 'find muse', 'oppo-find-muse.jpg', 0, 1, '2023-08-19 16:29:26'),
(1245, 2, 24, 'find n', 'oppo-find-n.jpg', 0, 1, '2023-08-19 16:29:26'),
(1246, 2, 24, 'find n2 5g', 'oppo-find-n2-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1247, 2, 24, 'find n2 flip', 'oppo-find-n2-flip.jpg', 0, 1, '2023-08-19 16:29:26'),
(1248, 2, 24, 'find x lamborgini edition', 'oppo-find-x-lamborgini-edition.jpg', 0, 1, '2023-08-19 16:29:26'),
(1249, 2, 24, 'find x', 'oppo-find-x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1250, 2, 24, 'find x2 lite', 'oppo-find-x2-lite.jpg', 0, 1, '2023-08-19 16:29:26'),
(1251, 2, 24, 'find x2 neo', 'oppo-find-x2-neo.jpg', 0, 1, '2023-08-19 16:29:26'),
(1252, 2, 24, 'find x2 pro', 'oppo-find-x2-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1253, 2, 24, 'find x2', 'oppo-find-x2.jpg', 0, 1, '2023-08-19 16:29:26'),
(1254, 2, 24, 'find x3 pro', 'oppo-find-x3-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1255, 2, 24, 'find x5 lite', 'oppo-find-x5-lite.jpg', 0, 1, '2023-08-19 16:29:26'),
(1256, 2, 24, 'find x5 pro', 'oppo-find-x5-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1257, 2, 24, 'find x5', 'oppo-find-x5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1258, 2, 24, 'find x6 pro', 'oppo-find-x6-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1259, 2, 24, 'find x6', 'oppo-find-x6.jpg', 0, 1, '2023-08-19 16:29:26'),
(1260, 2, 24, 'finder', 'oppo-finder.jpg', 0, 1, '2023-08-19 16:29:26'),
(1261, 2, 24, 'joy plus', 'oppo-joy-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1262, 2, 24, 'joy', 'oppo-joy.jpg', 0, 1, '2023-08-19 16:29:26'),
(1263, 2, 24, 'joy3', 'oppo-joy3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1264, 2, 24, 'k1 ', 'oppo-k1-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1265, 2, 24, 'k10 ', 'oppo-k10-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1266, 2, 24, 'k10 5g ', 'oppo-k10-5g-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1267, 2, 24, 'k10 pro ', 'oppo-k10-pro-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1268, 2, 24, 'k10', 'oppo-k10.jpg', 0, 1, '2023-08-19 16:29:26'),
(1269, 2, 24, 'k10x ', 'oppo-k10x-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1270, 2, 24, 'k11 5g', 'oppo-k11-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1271, 2, 24, 'k11x', 'oppo-k11x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1272, 2, 24, 'k3', 'oppo-k3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1273, 2, 24, 'k5', 'oppo-k5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1274, 2, 24, 'k7 5g', 'oppo-k7-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1275, 2, 24, 'k7x', 'oppo-k7x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1276, 2, 24, 'k9 pro', 'oppo-k9-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1277, 2, 24, 'k9', 'oppo-k9.jpg', 0, 1, '2023-08-19 16:29:26'),
(1278, 2, 24, 'k9s r', 'oppo-k9s-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1279, 2, 24, 'k9x', 'oppo-k9x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1280, 2, 24, 'mirror 3', 'oppo-mirror-3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1281, 2, 24, 'mirror 5s', 'oppo-mirror-5s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1282, 2, 24, 'n1 mini1', 'oppo-n1-mini1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1283, 2, 24, 'n1', 'oppo-n1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1284, 2, 24, 'n3 new1', 'oppo-n3-new1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1285, 2, 24, 'neo 5', 'oppo-neo-5.jpg', 0, 1, '2023-08-19 16:29:26'),
(1286, 2, 24, 'neo 5s', 'oppo-neo-5s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1287, 2, 24, 'neo 7', 'oppo-neo-7.jpg', 0, 1, '2023-08-19 16:29:26'),
(1288, 2, 24, 'neo', 'oppo-neo.jpg', 0, 1, '2023-08-19 16:29:26'),
(1289, 2, 24, 'neo3', 'oppo-neo3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1290, 2, 24, 'R1 R829T', 'Oppo-R1-R829T.jpg', 0, 1, '2023-08-19 16:29:26'),
(1291, 2, 24, 'r11', 'oppo-r11.jpg', 0, 1, '2023-08-19 16:29:26'),
(1292, 2, 24, 'r11s plus', 'oppo-r11s-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1293, 2, 24, 'r11s r', 'oppo-r11s-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1294, 2, 24, 'r15 ', 'oppo-r15-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1295, 2, 24, 'r15 dme', 'oppo-r15-dme.jpg', 0, 1, '2023-08-19 16:29:26'),
(1296, 2, 24, 'r15x', 'oppo-r15x.jpg', 0, 1, '2023-08-19 16:29:26'),
(1297, 2, 24, 'r17 ', 'oppo-r17-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1298, 2, 24, 'r17 pro', 'oppo-r17-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1299, 2, 24, 'r1c new', 'oppo-r1c-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1300, 2, 24, 'r1s', 'oppo-r1s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1301, 2, 24, 'r3', 'oppo-r3.jpg', 0, 1, '2023-08-19 16:29:26'),
(1302, 2, 24, 'r5 new1', 'oppo-r5-new1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1303, 2, 24, 'r5s', 'oppo-r5s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1304, 2, 24, 'r601', 'oppo-r601.jpg', 0, 1, '2023-08-19 16:29:26'),
(1305, 2, 24, 'r7 new', 'oppo-r7-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1306, 2, 24, 'r7 plus', 'oppo-r7-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1307, 2, 24, 'r7s', 'oppo-r7s.jpg', 0, 1, '2023-08-19 16:29:26'),
(1308, 2, 24, 'r811 real', 'oppo-r811-real.jpg', 0, 1, '2023-08-19 16:29:26'),
(1309, 2, 24, 'r815t', 'oppo-r815t.jpg', 0, 1, '2023-08-19 16:29:26'),
(1310, 2, 24, 'r817 real', 'oppo-r817-real.jpg', 0, 1, '2023-08-19 16:29:26'),
(1311, 2, 24, 'r819', 'oppo-r819.jpg', 0, 1, '2023-08-19 16:29:26'),
(1312, 2, 24, 'r9', 'oppo-r9.jpg', 0, 1, '2023-08-19 16:29:26'),
(1313, 2, 24, 'r9s ', 'oppo-r9s-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1314, 2, 24, 'reno 10x zoom', 'oppo-reno-10x-zoom.jpg', 0, 1, '2023-08-19 16:29:26'),
(1315, 2, 24, 'reno 2f', 'oppo-reno-2f.jpg', 0, 1, '2023-08-19 16:29:26'),
(1316, 2, 24, 'reno 4f', 'oppo-reno-4f.jpg', 0, 1, '2023-08-19 16:29:26'),
(1317, 2, 24, 'reno 5 4g', 'oppo-reno-5-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1318, 2, 24, 'reno 5k', 'oppo-reno-5k.jpg', 0, 1, '2023-08-19 16:29:26'),
(1319, 2, 24, 'reno 6z ', 'oppo-reno-6z-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1320, 2, 24, 'reno 8 lite', 'oppo-reno-8-lite.jpg', 0, 1, '2023-08-19 16:29:26'),
(1321, 2, 24, 'reno a', 'oppo-reno-a.jpg', 0, 1, '2023-08-19 16:29:26'),
(1322, 2, 24, 'reno ace', 'oppo-reno-ace.jpg', 0, 1, '2023-08-19 16:29:26'),
(1323, 2, 24, 'reno ace2 new', 'oppo-reno-ace2-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1324, 2, 24, 'reno z', 'oppo-reno-z.jpg', 0, 1, '2023-08-19 16:29:26'),
(1325, 2, 24, 'reno1', 'oppo-reno1.jpg', 0, 1, '2023-08-19 16:29:26'),
(1326, 2, 24, 'reno10 international', 'oppo-reno10-international.jpg', 0, 1, '2023-08-19 16:29:26'),
(1327, 2, 24, 'reno10 pro international', 'oppo-reno10-pro-international.jpg', 0, 1, '2023-08-19 16:29:26'),
(1328, 2, 24, 'reno10 pro plus', 'oppo-reno10-pro-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1329, 2, 24, 'reno10 pro', 'oppo-reno10-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1330, 2, 24, 'reno10', 'oppo-reno10.jpg', 0, 1, '2023-08-19 16:29:26'),
(1331, 2, 24, 'reno2', 'oppo-reno2.jpg', 0, 1, '2023-08-19 16:29:26'),
(1332, 2, 24, 'reno2z 2f', 'oppo-reno2z-2f.jpg', 0, 1, '2023-08-19 16:29:26'),
(1333, 2, 24, 'reno3 ', 'oppo-reno3-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1334, 2, 24, 'reno3 lte r', 'oppo-reno3-lte-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1335, 2, 24, 'reno3 pro ', 'oppo-reno3-pro-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1336, 2, 24, 'reno3 pro 5g ', 'oppo-reno3-pro-5g-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1337, 2, 24, 'reno3 vitality edition pclm50', 'oppo-reno3-vitality-edition-pclm50.jpg', 0, 1, '2023-08-19 16:29:26'),
(1338, 2, 24, 'reno4 5g', 'oppo-reno4-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1339, 2, 24, 'reno4 lite', 'oppo-reno4-lite.jpg', 0, 1, '2023-08-19 16:29:26'),
(1340, 2, 24, 'reno4 pro 5g', 'oppo-reno4-pro-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1341, 2, 24, 'reno4 pro', 'oppo-reno4-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1342, 2, 24, 'reno4 se ', 'oppo-reno4-se-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1343, 2, 24, 'reno4', 'oppo-reno4.jpg', 0, 1, '2023-08-19 16:29:26'),
(1344, 2, 24, 'reno5 5g', 'oppo-reno5-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1345, 2, 24, 'reno5 f cph2217', 'oppo-reno5-f-cph2217.jpg', 0, 1, '2023-08-19 16:29:26'),
(1346, 2, 24, 'reno5 pro 5g ', 'oppo-reno5-pro-5g-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1347, 2, 24, 'reno5 pro plus 5g', 'oppo-reno5-pro-plus-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1348, 2, 24, 'reno6 4g', 'oppo-reno6-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1349, 2, 24, 'reno6 5g', 'oppo-reno6-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1350, 2, 24, 'reno6 lite', 'oppo-reno6-lite.jpg', 0, 1, '2023-08-19 16:29:26'),
(1351, 2, 24, 'reno6 pro 5g', 'oppo-reno6-pro-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1352, 2, 24, 'reno6 pro plus', 'oppo-reno6-pro-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1353, 2, 24, 'reno7 4g', 'oppo-reno7-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1354, 2, 24, 'reno7 pro r', 'oppo-reno7-pro-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1355, 2, 24, 'reno7 r', 'oppo-reno7-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1356, 2, 24, 'reno7 se r', 'oppo-reno7-se-r.jpg', 0, 1, '2023-08-19 16:29:26'),
(1357, 2, 24, 'reno7 z 5g', 'oppo-reno7-z-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1358, 2, 24, 'reno7', 'oppo-reno7.jpg', 0, 1, '2023-08-19 16:29:26'),
(1359, 2, 24, 'reno8  ', 'oppo-reno8--.jpg', 0, 1, '2023-08-19 16:29:26'),
(1360, 2, 24, 'reno8 ', 'oppo-reno8-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1361, 2, 24, 'reno8 4g', 'oppo-reno8-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1362, 2, 24, 'reno8 pro ', 'oppo-reno8-pro-.jpg', 0, 1, '2023-08-19 16:29:26'),
(1363, 2, 24, 'reno8 pro', 'oppo-reno8-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1364, 2, 24, 'reno8 t 4g', 'oppo-reno8-t-4g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1365, 2, 24, 'reno8 t', 'oppo-reno8-t.jpg', 0, 1, '2023-08-19 16:29:26'),
(1366, 2, 24, 'reno8', 'oppo-reno8.jpg', 0, 1, '2023-08-19 16:29:26'),
(1367, 2, 24, 'reno8z 5g', 'oppo-reno8z-5g.jpg', 0, 1, '2023-08-19 16:29:26'),
(1368, 2, 24, 'reno9 pro plus', 'oppo-reno9-pro-plus.jpg', 0, 1, '2023-08-19 16:29:26'),
(1369, 2, 24, 'reno9 pro', 'oppo-reno9-pro.jpg', 0, 1, '2023-08-19 16:29:26'),
(1370, 2, 24, 'reno9', 'oppo-reno9.jpg', 0, 1, '2023-08-19 16:29:26'),
(1371, 2, 24, 't29', 'oppo-t29.jpg', 0, 1, '2023-08-19 16:29:26'),
(1372, 2, 24, 'u3 new', 'oppo-u3-new.jpg', 0, 1, '2023-08-19 16:29:26'),
(1373, 2, 24, 'u701 ulike', 'oppo-u701-ulike.jpg', 0, 1, '2023-08-19 16:29:26'),
(1374, 2, 24, 'u705t', 'oppo-u705t.jpg', 0, 1, '2023-08-19 16:29:26'),
(1375, 2, 24, 'yoyo', 'oppo-yoyo.jpg', 0, 1, '2023-08-19 16:29:26'),
(1376, 2, 25, '10 5g', 'realme-10-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1377, 2, 25, '10 pro plus', 'realme-10-pro-plus.jpg', 0, 1, '2023-08-23 12:20:50'),
(1378, 2, 25, '10 pro', 'realme-10-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1379, 2, 25, '10', 'realme-10.jpg', 0, 1, '2023-08-23 12:20:50'),
(1380, 2, 25, '10s 5g', 'realme-10s-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1381, 2, 25, '10t', 'realme-10t.jpg', 0, 1, '2023-08-23 12:20:50'),
(1382, 2, 25, '11 4g ', 'realme-11-4g-.jpg', 0, 1, '2023-08-23 12:20:50'),
(1383, 2, 25, '11 5g tw', 'realme-11-5g-tw.jpg', 0, 1, '2023-08-23 12:20:50'),
(1384, 2, 25, '11 pro plus', 'realme-11-pro-plus.jpg', 0, 1, '2023-08-23 12:20:50'),
(1385, 2, 25, '11 pro', 'realme-11-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1386, 2, 25, '11', 'realme-11.jpg', 0, 1, '2023-08-23 12:20:50'),
(1387, 2, 25, '3', 'realme-3.jpg', 0, 1, '2023-08-23 12:20:50'),
(1388, 2, 25, '3i', 'realme-3i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1389, 2, 25, '3pro', 'realme-3pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1390, 2, 25, '5 pro rmx1971', 'realme-5-pro-rmx1971.jpg', 0, 1, '2023-08-23 12:20:50'),
(1391, 2, 25, '5', 'realme-5.jpg', 0, 1, '2023-08-23 12:20:50'),
(1392, 2, 25, '5i', 'realme-5i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1393, 2, 25, '5s', 'realme-5s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1394, 2, 25, '6 pro', 'realme-6-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1395, 2, 25, '6', 'realme-6.jpg', 0, 1, '2023-08-23 12:20:50'),
(1396, 2, 25, '6i india', 'realme-6i-india.jpg', 0, 1, '2023-08-23 12:20:50'),
(1397, 2, 25, '6i', 'realme-6i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1398, 2, 25, '6s', 'realme-6s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1399, 2, 25, '7 5g', 'realme-7-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1400, 2, 25, '7 pro', 'realme-7-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1401, 2, 25, '7', 'realme-7.jpg', 0, 1, '2023-08-23 12:20:50'),
(1402, 2, 25, '7i global', 'realme-7i-global.jpg', 0, 1, '2023-08-23 12:20:50'),
(1403, 2, 25, '7i', 'realme-7i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1404, 2, 25, '8 5g ', 'realme-8-5g-.jpg', 0, 1, '2023-08-23 12:20:50'),
(1405, 2, 25, '8 pro ofic', 'realme-8-pro-ofic.jpg', 0, 1, '2023-08-23 12:20:50'),
(1406, 2, 25, '8', 'realme-8.jpg', 0, 1, '2023-08-23 12:20:50'),
(1407, 2, 25, '8i', 'realme-8i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1408, 2, 25, '8s 5g', 'realme-8s-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1409, 2, 25, '9 4g', 'realme-9-4g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1410, 2, 25, '9 5g global ', 'realme-9-5g-global-.jpg', 0, 1, '2023-08-23 12:20:50'),
(1411, 2, 25, '9 5g speed edition', 'realme-9-5g-speed-edition.jpg', 0, 1, '2023-08-23 12:20:50'),
(1412, 2, 25, '9 5g', 'realme-9-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1413, 2, 25, '9 pro plus', 'realme-9-pro-plus.jpg', 0, 1, '2023-08-23 12:20:50'),
(1414, 2, 25, '9 pro', 'realme-9-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1415, 2, 25, '9i 5g r', 'realme-9i-5g-r.jpg', 0, 1, '2023-08-23 12:20:50'),
(1416, 2, 25, '9i r1', 'realme-9i-r1.jpg', 0, 1, '2023-08-23 12:20:50'),
(1417, 2, 25, 'c11 2021', 'realme-c11-2021.jpg', 0, 1, '2023-08-23 12:20:50'),
(1418, 2, 25, 'c11', 'realme-c11.jpg', 0, 1, '2023-08-23 12:20:50'),
(1419, 2, 25, 'c12', 'realme-c12.jpg', 0, 1, '2023-08-23 12:20:50'),
(1420, 2, 25, 'c15 r1', 'realme-c15-r1.jpg', 0, 1, '2023-08-23 12:20:50'),
(1421, 2, 25, 'c15q', 'realme-c15q.jpg', 0, 1, '2023-08-23 12:20:50'),
(1422, 2, 25, 'c17', 'realme-c17.jpg', 0, 1, '2023-08-23 12:20:50'),
(1423, 2, 25, 'c2', 'realme-c2.jpg', 0, 1, '2023-08-23 12:20:50'),
(1424, 2, 25, 'c20 r1', 'realme-c20-r1.jpg', 0, 1, '2023-08-23 12:20:50'),
(1425, 2, 25, 'c21', 'realme-c21.jpg', 0, 1, '2023-08-23 12:20:50'),
(1426, 2, 25, 'c21y', 'realme-c21y.jpg', 0, 1, '2023-08-23 12:20:50'),
(1427, 2, 25, 'c25', 'realme-c25.jpg', 0, 1, '2023-08-23 12:20:50'),
(1428, 2, 25, 'c25s', 'realme-c25s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1429, 2, 25, 'c25y', 'realme-c25y.jpg', 0, 1, '2023-08-23 12:20:50'),
(1430, 2, 25, 'c2s', 'realme-c2s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1431, 2, 25, 'c3 2020', 'realme-c3-2020.jpg', 0, 1, '2023-08-23 12:20:50'),
(1432, 2, 25, 'c30  ', 'realme-c30--.jpg', 0, 1, '2023-08-23 12:20:50'),
(1433, 2, 25, 'c30s', 'realme-c30s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1434, 2, 25, 'c31', 'realme-c31.jpg', 0, 1, '2023-08-23 12:20:50'),
(1435, 2, 25, 'c33', 'realme-c33.jpg', 0, 1, '2023-08-23 12:20:50'),
(1436, 2, 25, 'c35', 'realme-c35.jpg', 0, 1, '2023-08-23 12:20:50'),
(1437, 2, 25, 'c53 india', 'realme-c53-india.jpg', 0, 1, '2023-08-23 12:20:50'),
(1438, 2, 25, 'c53', 'realme-c53.jpg', 0, 1, '2023-08-23 12:20:50'),
(1439, 2, 25, 'c55', 'realme-c55.jpg', 0, 1, '2023-08-23 12:20:50'),
(1440, 2, 25, 'gt 5g', 'realme-gt-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1441, 2, 25, 'gt master explorer', 'realme-gt-master-explorer.jpg', 0, 1, '2023-08-23 12:20:50'),
(1442, 2, 25, 'gt master', 'realme-gt-master.jpg', 0, 1, '2023-08-23 12:20:50'),
(1443, 2, 25, 'gt neo flash edition', 'realme-gt-neo-flash-edition.jpg', 0, 1, '2023-08-23 12:20:50'),
(1444, 2, 25, 'gt neo', 'realme-gt-neo.jpg', 0, 1, '2023-08-23 12:20:50'),
(1445, 2, 25, 'gt neo2', 'realme-gt-neo2.jpg', 0, 1, '2023-08-23 12:20:50'),
(1446, 2, 25, 'gt neo2t', 'realme-gt-neo2t.jpg', 0, 1, '2023-08-23 12:20:50'),
(1447, 2, 25, 'gt neo3 new', 'realme-gt-neo3-new.jpg', 0, 1, '2023-08-23 12:20:50'),
(1448, 2, 25, 'gt neo5 240w', 'realme-gt-neo5-240w.jpg', 0, 1, '2023-08-23 12:20:50'),
(1449, 2, 25, 'gt neo5 se', 'realme-gt-neo5-se.jpg', 0, 1, '2023-08-23 12:20:50'),
(1450, 2, 25, 'gt neo5', 'realme-gt-neo5.jpg', 0, 1, '2023-08-23 12:20:50'),
(1451, 2, 25, 'gt2 master explorer', 'realme-gt2-master-explorer.jpg', 0, 1, '2023-08-23 12:20:50'),
(1452, 2, 25, 'gt2 pro', 'realme-gt2-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1453, 2, 25, 'gt2', 'realme-gt2.jpg', 0, 1, '2023-08-23 12:20:50'),
(1454, 2, 25, 'narzo 10', 'realme-narzo-10.jpg', 0, 1, '2023-08-23 12:20:50'),
(1455, 2, 25, 'narzo 10a', 'realme-narzo-10a.jpg', 0, 1, '2023-08-23 12:20:50'),
(1456, 2, 25, 'narzo 20 pro', 'realme-narzo-20-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1457, 2, 25, 'narzo 20', 'realme-narzo-20.jpg', 0, 1, '2023-08-23 12:20:50'),
(1458, 2, 25, 'narzo 20a', 'realme-narzo-20a.jpg', 0, 1, '2023-08-23 12:20:50'),
(1459, 2, 25, 'narzo 30 5g', 'realme-narzo-30-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1460, 2, 25, 'narzo 30 pro', 'realme-narzo-30-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1461, 2, 25, 'narzo 30', 'realme-narzo-30.jpg', 0, 1, '2023-08-23 12:20:50'),
(1462, 2, 25, 'narzo 30a', 'realme-narzo-30a.jpg', 0, 1, '2023-08-23 12:20:50'),
(1463, 2, 25, 'narzo 50 5g', 'realme-narzo-50-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1464, 2, 25, 'narzo 50 pro 5g', 'realme-narzo-50-pro-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1465, 2, 25, 'narzo 50', 'realme-narzo-50.jpg', 0, 1, '2023-08-23 12:20:50'),
(1466, 2, 25, 'narzo 50a prime', 'realme-narzo-50a-prime.jpg', 0, 1, '2023-08-23 12:20:50'),
(1467, 2, 25, 'narzo 50a', 'realme-narzo-50a.jpg', 0, 1, '2023-08-23 12:20:50'),
(1468, 2, 25, 'narzo 50i prime', 'realme-narzo-50i-prime.jpg', 0, 1, '2023-08-23 12:20:50'),
(1469, 2, 25, 'narzo 50i', 'realme-narzo-50i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1470, 2, 25, 'narzo indonesia', 'realme-narzo-indonesia.jpg', 0, 1, '2023-08-23 12:20:50'),
(1471, 2, 25, 'narzo n53', 'realme-narzo-n53.jpg', 0, 1, '2023-08-23 12:20:50'),
(1472, 2, 25, 'narzo n55', 'realme-narzo-n55.jpg', 0, 1, '2023-08-23 12:20:50'),
(1473, 2, 25, 'narzo60 5g', 'realme-narzo60-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1474, 2, 25, 'narzo60 pro 5g', 'realme-narzo60-pro-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1475, 2, 25, 'neo 3 gt', 'realme-neo-3-gt.jpg', 0, 1, '2023-08-23 12:20:50'),
(1476, 2, 25, 'q2 pro', 'realme-q2-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1477, 2, 25, 'q2', 'realme-q2.jpg', 0, 1, '2023-08-23 12:20:50'),
(1478, 2, 25, 'q3 pro carnival edition', 'realme-q3-pro-carnival-edition.jpg', 0, 1, '2023-08-23 12:20:50'),
(1479, 2, 25, 'q3 pro', 'realme-q3-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1480, 2, 25, 'q3', 'realme-q3.jpg', 0, 1, '2023-08-23 12:20:50'),
(1481, 2, 25, 'q3i', 'realme-q3i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1482, 2, 25, 'q3s', 'realme-q3s.jpg', 0, 1, '2023-08-23 12:20:50'),
(1483, 2, 25, 'q5 pro', 'realme-q5-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1484, 2, 25, 'q5', 'realme-q5.jpg', 0, 1, '2023-08-23 12:20:50'),
(1485, 2, 25, 'q5i', 'realme-q5i.jpg', 0, 1, '2023-08-23 12:20:50'),
(1486, 2, 25, 'u1', 'realme-u1.jpg', 0, 1, '2023-08-23 12:20:50'),
(1487, 2, 25, 'v11 5g', 'realme-v11-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1488, 2, 25, 'v11 s 5g', 'realme-v11-s-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1489, 2, 25, 'v13 5g', 'realme-v13-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1490, 2, 25, 'v15 5g', 'realme-v15-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1491, 2, 25, 'v20', 'realme-v20.jpg', 0, 1, '2023-08-23 12:20:50'),
(1492, 2, 25, 'v23', 'realme-v23.jpg', 0, 1, '2023-08-23 12:20:50'),
(1493, 2, 25, 'v25', 'realme-v25.jpg', 0, 1, '2023-08-23 12:20:50'),
(1494, 2, 25, 'v3', 'realme-v3.jpg', 0, 1, '2023-08-23 12:20:50'),
(1495, 2, 25, 'v30', 'realme-v30.jpg', 0, 1, '2023-08-23 12:20:50'),
(1496, 2, 25, 'v5', 'realme-v5.jpg', 0, 1, '2023-08-23 12:20:50'),
(1497, 2, 25, 'x', 'realme-x.jpg', 0, 1, '2023-08-23 12:20:50'),
(1498, 2, 25, 'x2 pro', 'realme-x2-pro.jpg', 0, 1, '2023-08-23 12:20:50'),
(1499, 2, 25, 'x3 superzoom', 'realme-x3-superzoom.jpg', 0, 1, '2023-08-23 12:20:50'),
(1500, 2, 25, 'x3', 'realme-x3.jpg', 0, 1, '2023-08-23 12:20:50'),
(1501, 2, 25, 'x50 5g ', 'realme-x50-5g-.jpg', 0, 1, '2023-08-23 12:20:50'),
(1502, 2, 25, 'x50 5g eu', 'realme-x50-5g-eu.jpg', 0, 1, '2023-08-23 12:20:50'),
(1503, 2, 25, 'x50 pro 5g ', 'realme-x50-pro-5g-.jpg', 0, 1, '2023-08-23 12:20:50'),
(1504, 2, 25, 'x50 pro player edition', 'realme-x50-pro-player-edition.jpg', 0, 1, '2023-08-23 12:20:50'),
(1505, 2, 25, 'x50m 5g', 'realme-x50m-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1506, 2, 25, 'x7 5g', 'realme-x7-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1507, 2, 25, 'x7 india', 'realme-x7-india.jpg', 0, 1, '2023-08-23 12:20:50'),
(1508, 2, 25, 'x7 max 5g', 'realme-x7-max-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1509, 2, 25, 'x7 pro 5g', 'realme-x7-pro-5g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1510, 2, 25, 'x7 pro ultra', 'realme-x7-pro-ultra.jpg', 0, 1, '2023-08-23 12:20:50'),
(1511, 2, 25, 'xt 730g', 'realme-xt-730g.jpg', 0, 1, '2023-08-23 12:20:50'),
(1512, 2, 25, 'xt', 'realme-xt.jpg', 0, 1, '2023-08-23 12:20:50'),
(1513, 2, 25, 'c3 3cameras', 'realme-c3-3cameras.jpg', 0, 1, '2023-08-23 12:20:50'),
(1514, 2, 26, 'ascend g615', 'ascend-g615.jpg', 0, 1, '2023-08-23 12:32:49'),
(1515, 2, 26, 'nova 10z', 'huavei-nova-10z.jpg', 0, 1, '2023-08-23 12:32:49'),
(1516, 2, 26, 'ascend g525', 'huawei-ascend-g525.jpg', 0, 1, '2023-08-23 12:32:49'),
(1517, 2, 26, 'ascend g620s', 'huawei-ascend-g620s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1518, 2, 26, 'ascend g628r', 'huawei-ascend-g628r.jpg', 0, 1, '2023-08-23 12:32:49'),
(1519, 2, 26, 'ascend g630', 'huawei-ascend-g630.jpg', 0, 1, '2023-08-23 12:32:49'),
(1520, 2, 26, 'ascend g7', 'huawei-ascend-g7.jpg', 0, 1, '2023-08-23 12:32:49'),
(1521, 2, 26, 'ascend g700', 'huawei-ascend-g700.jpg', 0, 1, '2023-08-23 12:32:49'),
(1522, 2, 26, 'ascend g740', 'huawei-ascend-g740.jpg', 0, 1, '2023-08-23 12:32:49'),
(1523, 2, 26, 'ascend mate2', 'huawei-ascend-mate2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1524, 2, 26, 'ascend mate7', 'huawei-ascend-mate7.jpg', 0, 1, '2023-08-23 12:32:49'),
(1525, 2, 26, 'ascend p2', 'huawei-ascend-p2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1526, 2, 26, 'ascend p6 ofic', 'huawei-ascend-p6-ofic.jpg', 0, 1, '2023-08-23 12:32:49'),
(1527, 2, 26, 'ascend p6s', 'huawei-ascend-p6s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1528, 2, 26, 'ascend p7 mini', 'huawei-ascend-p7-mini.jpg', 0, 1, '2023-08-23 12:32:49'),
(1529, 2, 26, 'ascend p7 new', 'huawei-ascend-p7-new.jpg', 0, 1, '2023-08-23 12:32:49'),
(1530, 2, 26, 'ascend p7 sapphire edition', 'huawei-ascend-p7-sapphire-edition.jpg', 0, 1, '2023-08-23 12:32:49'),
(1531, 2, 26, 'Ascend W2', 'Huawei-Ascend-W2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1532, 2, 26, 'ascend y210d', 'huawei-ascend-y210d.jpg', 0, 1, '2023-08-23 12:32:49'),
(1533, 2, 26, 'ascend y220', 'huawei-ascend-y220.jpg', 0, 1, '2023-08-23 12:32:49'),
(1534, 2, 26, 'ascend y221', 'huawei-ascend-y221.jpg', 0, 1, '2023-08-23 12:32:49'),
(1535, 2, 26, 'ascend y300', 'huawei-ascend-y300.jpg', 0, 1, '2023-08-23 12:32:49'),
(1536, 2, 26, 'ascend y330', 'huawei-ascend-y330.jpg', 0, 1, '2023-08-23 12:32:49'),
(1537, 2, 26, 'ascend y511', 'huawei-ascend-y511.jpg', 0, 1, '2023-08-23 12:32:49'),
(1538, 2, 26, 'ascend y520', 'huawei-ascend-y520.jpg', 0, 1, '2023-08-23 12:32:49'),
(1539, 2, 26, 'ascend y540', 'huawei-ascend-y540.jpg', 0, 1, '2023-08-23 12:32:49'),
(1540, 2, 26, 'ascend y550', 'huawei-ascend-y550.jpg', 0, 1, '2023-08-23 12:32:49'),
(1541, 2, 26, 'ascend y600', 'huawei-ascend-y600.jpg', 0, 1, '2023-08-23 12:32:49'),
(1542, 2, 26, 'enjoy 10 e', 'huawei-enjoy-10-e.jpg', 0, 1, '2023-08-23 12:32:49'),
(1543, 2, 26, 'enjoy 10 plus', 'huawei-enjoy-10-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1544, 2, 26, 'enjoy 10', 'huawei-enjoy-10.jpg', 0, 1, '2023-08-23 12:32:49'),
(1545, 2, 26, 'enjoy 10s', 'huawei-enjoy-10s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1546, 2, 26, 'enjoy 20 plus', 'huawei-enjoy-20-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1547, 2, 26, 'enjoy 20 pro', 'huawei-enjoy-20-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1548, 2, 26, 'enjoy 20 se', 'huawei-enjoy-20-se.jpg', 0, 1, '2023-08-23 12:32:49'),
(1549, 2, 26, 'enjoy 20', 'huawei-enjoy-20.jpg', 0, 1, '2023-08-23 12:32:49'),
(1550, 2, 26, 'enjoy 20e', 'huawei-enjoy-20e.jpg', 0, 1, '2023-08-23 12:32:49'),
(1551, 2, 26, 'enjoy 5', 'huawei-enjoy-5.jpg', 0, 1, '2023-08-23 12:32:49'),
(1552, 2, 26, 'enjoy 5s', 'huawei-enjoy-5s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1553, 2, 26, 'enjoy 6', 'huawei-enjoy-6.jpg', 0, 1, '2023-08-23 12:32:49'),
(1554, 2, 26, 'enjoy 60', 'huawei-enjoy-60.jpg', 0, 1, '2023-08-23 12:32:49'),
(1555, 2, 26, 'enjoy 60x', 'huawei-enjoy-60x.jpg', 0, 1, '2023-08-23 12:32:49'),
(1556, 2, 26, 'enjoy 6s', 'huawei-enjoy-6s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1557, 2, 26, 'enjoy 7 plus new', 'huawei-enjoy-7-plus-new.jpg', 0, 1, '2023-08-23 12:32:49'),
(1558, 2, 26, 'enjoy 9', 'huawei-enjoy-9.jpg', 0, 1, '2023-08-23 12:32:49'),
(1559, 2, 26, 'enjoy 9e2', 'huawei-enjoy-9e2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1560, 2, 26, 'enjoy tablet2', 'huawei-enjoy-tablet2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1561, 2, 26, 'enjoy z 5g', 'huawei-enjoy-z-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1562, 2, 26, 'g3621', 'huawei-g3621.jpg', 0, 1, '2023-08-23 12:32:49'),
(1563, 2, 26, 'g535', 'huawei-g535.jpg', 0, 1, '2023-08-23 12:32:49'),
(1564, 2, 26, 'g610s', 'huawei-g610s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1565, 2, 26, 'g6153', 'huawei-g6153.jpg', 0, 1, '2023-08-23 12:32:49'),
(1566, 2, 26, 'g7 plus', 'huawei-g7-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1567, 2, 26, 'g730', 'huawei-g730.jpg', 0, 1, '2023-08-23 12:32:49'),
(1568, 2, 26, 'g8 ', 'huawei-g8-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1569, 2, 26, 'g9 plus', 'huawei-g9-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1570, 2, 26, 'gx1', 'huawei-gx1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1571, 2, 26, 'h881c ascend plus', 'huawei-h881c-ascend-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1572, 2, 26, 'honor 4a', 'huawei-honor-4a.jpg', 0, 1, '2023-08-23 12:32:49'),
(1573, 2, 26, 'Honor Tablet1', 'Huawei-Honor-Tablet1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1574, 2, 26, 'mate 10 lite', 'huawei-mate-10-lite.jpg', 0, 1, '2023-08-23 12:32:49'),
(1575, 2, 26, 'mate 20 ', 'huawei-mate-20-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1576, 2, 26, 'mate 20 lite r1', 'huawei-mate-20-lite-r1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1577, 2, 26, 'mate 20 pro 1', 'huawei-mate-20-pro-1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1578, 2, 26, 'mate 20 rs porsche design red', 'huawei-mate-20-rs-porsche-design-red.jpg', 0, 1, '2023-08-23 12:32:49'),
(1579, 2, 26, 'mate 20x ', 'huawei-mate-20x-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1580, 2, 26, 'mate 20x 5g ', 'huawei-mate-20x-5g-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1581, 2, 26, 'mate 30 rs porsche design', 'huawei-mate-30-rs-porsche-design.jpg', 0, 1, '2023-08-23 12:32:49'),
(1582, 2, 26, 'mate 40', 'huawei-mate-40.jpg', 0, 1, '2023-08-23 12:32:49'),
(1583, 2, 26, 'mate 50 pro', 'huawei-mate-50-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1584, 2, 26, 'mate 50 rs porsche design', 'huawei-mate-50-rs-porsche-design.jpg', 0, 1, '2023-08-23 12:32:49'),
(1585, 2, 26, 'mate 50', 'huawei-mate-50.jpg', 0, 1, '2023-08-23 12:32:49'),
(1586, 2, 26, 'mate 50e', 'huawei-mate-50e.jpg', 0, 1, '2023-08-23 12:32:49'),
(1587, 2, 26, 'mate 8r1', 'huawei-mate-8r1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1588, 2, 26, 'mate 9 porshe ', 'huawei-mate-9-porshe-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1589, 2, 26, 'mate 9 pro', 'huawei-mate-9-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1590, 2, 26, 'mate 9', 'huawei-mate-9.jpg', 0, 1, '2023-08-23 12:32:49'),
(1591, 2, 26, 'mate rs porsche design 1', 'huawei-mate-rs-porsche-design-1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1592, 2, 26, 'mate s  ', 'huawei-mate-s--.jpg', 0, 1, '2023-08-23 12:32:49'),
(1593, 2, 26, 'mate x ', 'huawei-mate-x-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1594, 2, 26, 'mate x2 new', 'huawei-mate-x2-new.jpg', 0, 1, '2023-08-23 12:32:49'),
(1595, 2, 26, 'mate x3', 'huawei-mate-x3.jpg', 0, 1, '2023-08-23 12:32:49'),
(1596, 2, 26, 'mate xs ', 'huawei-mate-xs-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1597, 2, 26, 'mate xs 2', 'huawei-mate-xs-2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1598, 2, 26, 'mate10 ', 'huawei-mate10-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1599, 2, 26, 'mate10 porshe design ', 'huawei-mate10-porshe-design-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1600, 2, 26, 'mate10 pro', 'huawei-mate10-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1601, 2, 26, 'mate30 ', 'huawei-mate30-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1602, 2, 26, 'mate30 5g', 'huawei-mate30-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1603, 2, 26, 'mate30 pro ', 'huawei-mate30-pro-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1604, 2, 26, 'mate30 pro 5g', 'huawei-mate30-pro-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1605, 2, 26, 'mate40 pro plus', 'huawei-mate40-pro-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1606, 2, 26, 'mate40 pro', 'huawei-mate40-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1607, 2, 26, 'mate40 rs', 'huawei-mate40-rs.jpg', 0, 1, '2023-08-23 12:32:49'),
(1608, 2, 26, 'nexus 6p ', 'huawei-nexus-6p-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1609, 2, 26, 'nova 10 pro', 'huawei-nova-10-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1610, 2, 26, 'nova 10', 'huawei-nova-10.jpg', 0, 1, '2023-08-23 12:32:49'),
(1611, 2, 26, 'nova 11i', 'huawei-nova-11i.jpg', 0, 1, '2023-08-23 12:32:49'),
(1612, 2, 26, 'nova 2 plus', 'huawei-nova-2-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1613, 2, 26, 'nova 2', 'huawei-nova-2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1614, 2, 26, 'nova 2s', 'huawei-nova-2s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1615, 2, 26, 'nova 3i', 'huawei-nova-3i.jpg', 0, 1, '2023-08-23 12:32:49'),
(1616, 2, 26, 'nova 4 ', 'huawei-nova-4-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1617, 2, 26, 'nova 4e ', 'huawei-nova-4e-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1618, 2, 26, 'nova 5 ', 'huawei-nova-5-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1619, 2, 26, 'nova 5 pro new', 'huawei-nova-5-pro-new.jpg', 0, 1, '2023-08-23 12:32:49'),
(1620, 2, 26, 'nova 5i pro', 'huawei-nova-5i-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1621, 2, 26, 'nova 5t', 'huawei-nova-5t.jpg', 0, 1, '2023-08-23 12:32:49'),
(1622, 2, 26, 'nova 5z', 'huawei-nova-5z.jpg', 0, 1, '2023-08-23 12:32:49'),
(1623, 2, 26, 'nova 6 5g', 'huawei-nova-6-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1624, 2, 26, 'nova 6 se', 'huawei-nova-6-se.jpg', 0, 1, '2023-08-23 12:32:49'),
(1625, 2, 26, 'nova 6', 'huawei-nova-6.jpg', 0, 1, '2023-08-23 12:32:49'),
(1626, 2, 26, 'nova 8 5g', 'huawei-nova-8-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1627, 2, 26, 'nova 8 pro 5g', 'huawei-nova-8-pro-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1628, 2, 26, 'nova 8 se youth', 'huawei-nova-8-se-youth.jpg', 0, 1, '2023-08-23 12:32:49'),
(1629, 2, 26, 'nova 8 se', 'huawei-nova-8-se.jpg', 0, 1, '2023-08-23 12:32:49'),
(1630, 2, 26, 'nova 8', 'huawei-nova-8.jpg', 0, 1, '2023-08-23 12:32:49'),
(1631, 2, 26, 'nova 8i', 'huawei-nova-8i.jpg', 0, 1, '2023-08-23 12:32:49'),
(1632, 2, 26, 'nova 9 5g', 'huawei-nova-9-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1633, 2, 26, 'nova 9 pro 5g ', 'huawei-nova-9-pro-5g-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1634, 2, 26, 'nova 9 se', 'huawei-nova-9-se.jpg', 0, 1, '2023-08-23 12:32:49'),
(1635, 2, 26, 'nova plus', 'huawei-nova-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1636, 2, 26, 'nova y60', 'huawei-nova-y60.jpg', 0, 1, '2023-08-23 12:32:49'),
(1637, 2, 26, 'nova y61', 'huawei-nova-y61.jpg', 0, 1, '2023-08-23 12:32:49'),
(1638, 2, 26, 'nova y70 plus', 'huawei-nova-y70-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1639, 2, 26, 'nova y71', 'huawei-nova-y71.jpg', 0, 1, '2023-08-23 12:32:49'),
(1640, 2, 26, 'nova y90', 'huawei-nova-y90.jpg', 0, 1, '2023-08-23 12:32:49'),
(1641, 2, 26, 'nova y91', 'huawei-nova-y91.jpg', 0, 1, '2023-08-23 12:32:49'),
(1642, 2, 26, 'nova', 'huawei-nova.jpg', 0, 1, '2023-08-23 12:32:49'),
(1643, 2, 26, 'nova10 se', 'huawei-nova10-se.jpg', 0, 1, '2023-08-23 12:32:49'),
(1644, 2, 26, 'nova10 yough', 'huawei-nova10-yough.jpg', 0, 1, '2023-08-23 12:32:49'),
(1645, 2, 26, 'nova11 pro', 'huawei-nova11-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1646, 2, 26, 'nova11 ultra', 'huawei-nova11-ultra.jpg', 0, 1, '2023-08-23 12:32:49'),
(1647, 2, 26, 'nova11', 'huawei-nova11.jpg', 0, 1, '2023-08-23 12:32:49'),
(1648, 2, 26, 'nova3', 'huawei-nova3.jpg', 0, 1, '2023-08-23 12:32:49'),
(1649, 2, 26, 'nova7 5g', 'huawei-nova7-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1650, 2, 26, 'nova7 pro 5g', 'huawei-nova7-pro-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1651, 2, 26, 'nova7 se new', 'huawei-nova7-se-new.jpg', 0, 1, '2023-08-23 12:32:49'),
(1652, 2, 26, 'p smart ', 'huawei-p-smart-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1653, 2, 26, 'p smart 2019', 'huawei-p-smart-2019.jpg', 0, 1, '2023-08-23 12:32:49'),
(1654, 2, 26, 'p smart 2020 ', 'huawei-p-smart-2020-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1655, 2, 26, 'p smart 2021', 'huawei-p-smart-2021.jpg', 0, 1, '2023-08-23 12:32:49'),
(1656, 2, 26, 'p smart plus 2019 starlight blue', 'huawei-p-smart-plus-2019-starlight-blue.jpg', 0, 1, '2023-08-23 12:32:49'),
(1657, 2, 26, 'p smart z ', 'huawei-p-smart-z-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1658, 2, 26, 'p10 ', 'huawei-p10-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1659, 2, 26, 'p10 lite', 'huawei-p10-lite.jpg', 0, 1, '2023-08-23 12:32:49'),
(1660, 2, 26, 'p10 plus r1', 'huawei-p10-plus-r1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1661, 2, 26, 'p20 ', 'huawei-p20-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1662, 2, 26, 'p20 lite ', 'huawei-p20-lite-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1663, 2, 26, 'p20 lite 2019 ', 'huawei-p20-lite-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1664, 2, 26, 'p20 pro ', 'huawei-p20-pro-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1665, 2, 26, 'p30 lite ', 'huawei-p30-lite-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1666, 2, 26, 'p30 lite new edition', 'huawei-p30-lite-new-edition.jpg', 0, 1, '2023-08-23 12:32:49'),
(1667, 2, 26, 'p30 pro new edition', 'huawei-p30-pro-new-edition.jpg', 0, 1, '2023-08-23 12:32:49'),
(1668, 2, 26, 'p30 pro', 'huawei-p30-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1669, 2, 26, 'p30', 'huawei-p30.jpg', 0, 1, '2023-08-23 12:32:49'),
(1670, 2, 26, 'p40 4g', 'huawei-p40-4g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1671, 2, 26, 'p40 lite 5g', 'huawei-p40-lite-5g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1672, 2, 26, 'p40 lite', 'huawei-p40-lite.jpg', 0, 1, '2023-08-23 12:32:49'),
(1673, 2, 26, 'p40 pro plus', 'huawei-p40-pro-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1674, 2, 26, 'p40 pro', 'huawei-p40-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1675, 2, 26, 'p40', 'huawei-p40.jpg', 0, 1, '2023-08-23 12:32:49'),
(1676, 2, 26, 'p50 pocket', 'huawei-p50-pocket.jpg', 0, 1, '2023-08-23 12:32:49'),
(1677, 2, 26, 'p50 pro', 'huawei-p50-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1678, 2, 26, 'p50', 'huawei-p50.jpg', 0, 1, '2023-08-23 12:32:49'),
(1679, 2, 26, 'p50e', 'huawei-p50e.jpg', 0, 1, '2023-08-23 12:32:49'),
(1680, 2, 26, 'p60 art', 'huawei-p60-art.jpg', 0, 1, '2023-08-23 12:32:49'),
(1681, 2, 26, 'p60 pro', 'huawei-p60-pro.jpg', 0, 1, '2023-08-23 12:32:49'),
(1682, 2, 26, 'p60', 'huawei-p60.jpg', 0, 1, '2023-08-23 12:32:49'),
(1683, 2, 26, 'p8 lite 2017', 'huawei-p8-lite-2017.jpg', 0, 1, '2023-08-23 12:32:49'),
(1684, 2, 26, 'p8 lite1', 'huawei-p8-lite1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1685, 2, 26, 'p8 max', 'huawei-p8-max.jpg', 0, 1, '2023-08-23 12:32:49'),
(1686, 2, 26, 'p8', 'huawei-p8.jpg', 0, 1, '2023-08-23 12:32:49'),
(1687, 2, 26, 'p9 lite r1', 'huawei-p9-lite-r1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1688, 2, 26, 'p9 plus', 'huawei-p9-plus.jpg', 0, 1, '2023-08-23 12:32:49'),
(1689, 2, 26, 'p9r2', 'huawei-p9r2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1690, 2, 26, 'pocket s', 'huawei-pocket-s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1691, 2, 26, 'premia 4g', 'huawei-premia-4g.jpg', 0, 1, '2023-08-23 12:32:49'),
(1692, 2, 26, 'snapto1', 'huawei-snapto1.jpg', 0, 1, '2023-08-23 12:32:49'),
(1693, 2, 26, 't10', 'huawei-t10.jpg', 0, 1, '2023-08-23 12:32:49'),
(1694, 2, 26, 'u8687 cronos', 'huawei-u8687-cronos.jpg', 0, 1, '2023-08-23 12:32:49'),
(1695, 2, 26, 'y max ars l22', 'huawei-y-max-ars-l22.jpg', 0, 1, '2023-08-23 12:32:49'),
(1696, 2, 26, 'y3 2', 'huawei-y3-2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1697, 2, 26, 'y3 2017 ', 'huawei-y3-2017-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1698, 2, 26, 'y3 2018', 'huawei-y3-2018.jpg', 0, 1, '2023-08-23 12:32:49'),
(1699, 2, 26, 'y300 fire', 'huawei-y300-fire.jpg', 0, 1, '2023-08-23 12:32:49'),
(1700, 2, 26, 'y320', 'huawei-y320.jpg', 0, 1, '2023-08-23 12:32:49'),
(1701, 2, 26, 'y360 ', 'huawei-y360-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1702, 2, 26, 'y5 2', 'huawei-y5-2.jpg', 0, 1, '2023-08-23 12:32:49'),
(1703, 2, 26, 'y5 2017', 'huawei-y5-2017.jpg', 0, 1, '2023-08-23 12:32:49'),
(1704, 2, 26, 'y5 2019', 'huawei-y5-2019.jpg', 0, 1, '2023-08-23 12:32:49'),
(1705, 2, 26, 'y5 prime 2018 ', 'huawei-y5-prime-2018-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1706, 2, 26, 'y530', 'huawei-y530.jpg', 0, 1, '2023-08-23 12:32:49'),
(1707, 2, 26, 'y560', 'huawei-y560.jpg', 0, 1, '2023-08-23 12:32:49'),
(1708, 2, 26, 'y5p', 'huawei-y5p.jpg', 0, 1, '2023-08-23 12:32:49'),
(1709, 2, 26, 'y6 2017', 'huawei-y6-2017.jpg', 0, 1, '2023-08-23 12:32:49'),
(1710, 2, 26, 'y6 2018', 'huawei-y6-2018.jpg', 0, 1, '2023-08-23 12:32:49'),
(1711, 2, 26, 'y6 2019 ', 'huawei-y6-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1712, 2, 26, 'y6 ii compact', 'huawei-y6-ii-compact.jpg', 0, 1, '2023-08-23 12:32:49'),
(1713, 2, 26, 'y6 prime 2018', 'huawei-y6-prime-2018.jpg', 0, 1, '2023-08-23 12:32:49'),
(1714, 2, 26, 'y6 pro 2017 p9 lite mini', 'huawei-y6-pro-2017-p9-lite-mini.jpg', 0, 1, '2023-08-23 12:32:49'),
(1715, 2, 26, 'y6 pro 2019 ', 'huawei-y6-pro-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1716, 2, 26, 'y625', 'huawei-y625.jpg', 0, 1, '2023-08-23 12:32:49'),
(1717, 2, 26, 'y635 0', 'huawei-y635-0.jpg', 0, 1, '2023-08-23 12:32:49'),
(1718, 2, 26, 'y6p', 'huawei-y6p.jpg', 0, 1, '2023-08-23 12:32:49'),
(1719, 2, 26, 'y6s', 'huawei-y6s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1720, 2, 26, 'y7 prime 2018', 'huawei-y7-prime-2018.jpg', 0, 1, '2023-08-23 12:32:49'),
(1721, 2, 26, 'y7 prime 2019', 'huawei-y7-prime-2019.jpg', 0, 1, '2023-08-23 12:32:49'),
(1722, 2, 26, 'y7 pro 2018 ', 'huawei-y7-pro-2018-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1723, 2, 26, 'y7 pro 2019 ', 'huawei-y7-pro-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1724, 2, 26, 'y71', 'huawei-y71.jpg', 0, 1, '2023-08-23 12:32:49'),
(1725, 2, 26, 'y7p ', 'huawei-y7p-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1726, 2, 26, 'y8', 'huawei-y8s.png', 0, 1, '2023-08-23 12:32:49'),
(1727, 2, 26, 'y9 2018 ', 'huawei-y9-2018-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1728, 2, 26, 'y9 2019 ', 'huawei-y9-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1729, 2, 26, 'y9 prime 2019 ', 'huawei-y9-prime-2019-.jpg', 0, 1, '2023-08-23 12:32:49'),
(1730, 2, 26, 'y9a', 'huawei-y9a.jpg', 0, 1, '2023-08-23 12:32:49'),
(1731, 2, 26, 'y9s', 'huawei-y9s.jpg', 0, 1, '2023-08-23 12:32:49'),
(1732, 2, 28, '10 pro', 'oneplus-10-pro.jpg', 0, 1, '2023-09-11 16:19:26'),
(1733, 2, 28, '10r', 'oneplus-10r.jpg', 0, 1, '2023-09-11 16:19:26'),
(1734, 2, 28, '10t 5g', 'oneplus-10t-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1735, 2, 28, '11', 'oneplus-11.jpg', 0, 1, '2023-09-11 16:19:26'),
(1736, 2, 28, '3 ', 'oneplus-3-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1737, 2, 28, '3t ', 'oneplus-3t-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1738, 2, 28, '5', 'oneplus-5.jpg', 0, 1, '2023-09-11 16:19:26'),
(1739, 2, 28, '5t', 'oneplus-5t.jpg', 0, 1, '2023-09-11 16:19:26'),
(1740, 2, 28, '6 red', 'oneplus-6-red.jpg', 0, 1, '2023-09-11 16:19:26'),
(1741, 2, 28, '6t mclaren edition', 'oneplus-6t-mclaren-edition.jpg', 0, 1, '2023-09-11 16:19:26'),
(1742, 2, 28, '6t thunder purple', 'oneplus-6t-thunder-purple.jpg', 0, 1, '2023-09-11 16:19:26'),
(1743, 2, 28, '7  ', 'oneplus-7--.jpg', 0, 1, '2023-09-11 16:19:26'),
(1744, 2, 28, '7 pro r1', 'oneplus-7-pro-r1.jpg', 0, 1, '2023-09-11 16:19:26'),
(1745, 2, 28, '7t ', 'oneplus-7t-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1746, 2, 28, '7t pro 5g mclaren edition ', 'oneplus-7t-pro-5g-mclaren-edition-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1747, 2, 28, '7t pro', 'oneplus-7t-pro.jpg', 0, 1, '2023-09-11 16:19:26'),
(1748, 2, 28, '8 5g t mobile', 'oneplus-8-5g-t-mobile.jpg', 0, 1, '2023-09-11 16:19:26'),
(1749, 2, 28, '8 5g uw', 'oneplus-8-5g-uw.jpg', 0, 1, '2023-09-11 16:19:26'),
(1750, 2, 28, '8 pro', 'oneplus-8-pro.jpg', 0, 1, '2023-09-11 16:19:26'),
(1751, 2, 28, '8', 'oneplus-8.jpg', 0, 1, '2023-09-11 16:19:26'),
(1752, 2, 28, '8t', 'oneplus-8t.jpg', 0, 1, '2023-09-11 16:19:26'),
(1753, 2, 28, '9 ', 'oneplus-9-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1754, 2, 28, '9 pro ', 'oneplus-9-pro-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1755, 2, 28, '9 rt r', 'oneplus-9-rt-r.jpg', 0, 1, '2023-09-11 16:19:26'),
(1756, 2, 28, '9r', 'oneplus-9r.jpg', 0, 1, '2023-09-11 16:19:26'),
(1757, 2, 28, 'ace 2 pro', 'oneplus-ace-2-pro.jpg', 0, 1, '2023-09-11 16:19:26'),
(1758, 2, 28, 'ace 2v', 'oneplus-ace-2v.jpg', 0, 1, '2023-09-11 16:19:26'),
(1759, 2, 28, 'ace race', 'oneplus-ace-race.jpg', 0, 1, '2023-09-11 16:19:26'),
(1760, 2, 28, 'ace', 'oneplus-ace.jpg', 0, 1, '2023-09-11 16:19:26'),
(1761, 2, 28, 'ace2', 'oneplus-ace2.jpg', 0, 1, '2023-09-11 16:19:26'),
(1762, 2, 28, 'nord 2 5g new', 'oneplus-nord-2-5g-new.jpg', 0, 1, '2023-09-11 16:19:26'),
(1763, 2, 28, 'nord 2t', 'oneplus-nord-2t.jpg', 0, 1, '2023-09-11 16:19:26'),
(1764, 2, 28, 'nord 3r', 'oneplus-nord-3r.jpg', 0, 1, '2023-09-11 16:19:26'),
(1765, 2, 28, 'nord ce 2 5g', 'oneplus-nord-ce-2-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1766, 2, 28, 'nord ce 2 lite 5g 0', 'oneplus-nord-ce-2-lite-5g-0.jpg', 0, 1, '2023-09-11 16:19:26'),
(1767, 2, 28, 'nord ce 3 lite ', 'oneplus-nord-ce-3-lite-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1768, 2, 28, 'nord ce 5g', 'oneplus-nord-ce-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1769, 2, 28, 'nord ce3 5g', 'oneplus-nord-ce3-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1770, 2, 28, 'nord n10 5g ', 'oneplus-nord-n10-5g-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1771, 2, 28, 'nord n100 ', 'oneplus-nord-n100-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1772, 2, 28, 'nord n20 5g ', 'oneplus-nord-n20-5g-.jpg', 0, 1, '2023-09-11 16:19:26'),
(1773, 2, 28, 'nord n20 se', 'oneplus-nord-n20-se.jpg', 0, 1, '2023-09-11 16:19:26'),
(1774, 2, 28, 'nord n200 5g', 'oneplus-nord-n200-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1775, 2, 28, 'nord n30 5g', 'oneplus-nord-n30-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1776, 2, 28, 'nord n300 5g', 'oneplus-nord-n300-5g.jpg', 0, 1, '2023-09-11 16:19:26'),
(1777, 7, 33, 'nord watch', 'oneplus-nord-watch.jpg', 0, 1, '2023-09-11 16:19:26'),
(1778, 2, 28, 'nord', 'oneplus-nord.jpg', 0, 1, '2023-09-11 16:19:26');
INSERT INTO `modal` (`id`, `category_id`, `brand_id`, `modal_name`, `image_path`, `isDelete`, `isActive`, `created_date`) VALUES
(1779, 2, 28, 'one', 'oneplus-one.jpg', 0, 1, '2023-09-11 16:19:26'),
(1780, 5, 35, 'pad', 'oneplus-pad.jpg', 0, 1, '2023-09-11 16:19:26'),
(1781, 2, 28, 'two', 'oneplus-two.jpg', 0, 1, '2023-09-11 16:19:26'),
(1782, 7, 33, 'watch', 'oneplus-watch.jpg', 0, 1, '2023-09-11 16:19:26'),
(1783, 2, 28, 'x', 'oneplus-x.jpg', 0, 1, '2023-09-11 16:19:26'),
(1784, 2, 29, 'pixel 2', 'google-pixel-2.jpg', 0, 1, '2023-09-11 16:26:37'),
(1785, 2, 29, 'pixel 3 ', 'google-pixel-3-.jpg', 0, 1, '2023-09-11 16:26:37'),
(1786, 2, 29, 'pixel 3a xl ', 'google-pixel-3a-xl-.jpg', 0, 1, '2023-09-11 16:26:37'),
(1787, 2, 29, 'pixel 3a', 'google-pixel-3a.jpg', 0, 1, '2023-09-11 16:26:37'),
(1788, 2, 29, 'pixel 3xl ', 'google-pixel-3xl-.jpg', 0, 1, '2023-09-11 16:26:37'),
(1789, 2, 29, 'pixel 4 r1', 'google-pixel-4-r1.jpg', 0, 1, '2023-09-11 16:26:37'),
(1790, 2, 29, 'pixel 4a 5g', 'google-pixel-4a-5g.jpg', 0, 1, '2023-09-11 16:26:37'),
(1791, 2, 29, 'pixel 4a', 'google-pixel-4a.jpg', 0, 1, '2023-09-11 16:26:37'),
(1792, 2, 29, 'pixel 5 5g', 'google-pixel-5-5g.jpg', 0, 1, '2023-09-11 16:26:37'),
(1793, 2, 29, 'pixel 5a 5g', 'google-pixel-5a-5g.jpg', 0, 1, '2023-09-11 16:26:37'),
(1794, 2, 29, 'pixel 6 pro', 'google-pixel-6-pro.jpg', 0, 1, '2023-09-11 16:26:37'),
(1795, 2, 29, 'pixel 6', 'google-pixel-6.jpg', 0, 1, '2023-09-11 16:26:37'),
(1796, 2, 29, 'pixel 6a', 'google-pixel-6a.jpg', 0, 1, '2023-09-11 16:26:37'),
(1797, 2, 29, 'pixel 7a', 'google-pixel-7a.jpg', 0, 1, '2023-09-11 16:26:37'),
(1798, 5, 36, 'pixel c  ', 'google-pixel-c--.jpg', 0, 1, '2023-09-11 16:26:37'),
(1799, 2, 29, 'pixel fold', 'google-pixel-fold.jpg', 0, 1, '2023-09-11 16:26:37'),
(1800, 5, 36, 'pixel tablet 1', 'google-pixel-tablet-1.jpg', 0, 1, '2023-09-11 16:26:37'),
(1801, 7, 31, 'pixel watch ', 'google-pixel-watch-.jpg', 0, 1, '2023-09-11 16:26:37'),
(1802, 2, 29, 'pixel xl', 'google-pixel-xl.jpg', 0, 1, '2023-09-11 16:26:37'),
(1803, 2, 29, 'pixel xl2 ', 'google-pixel-xl2-.jpg', 0, 1, '2023-09-11 16:26:37'),
(1804, 2, 29, 'pixel', 'google-pixel.jpg', 0, 1, '2023-09-11 16:26:37'),
(1805, 2, 29, 'pixel7 new', 'google-pixel7-new.jpg', 0, 1, '2023-09-11 16:26:37'),
(1806, 2, 29, 'pixel7 pro new', 'google-pixel7-pro-new.jpg', 0, 1, '2023-09-11 16:26:37'),
(1807, 2, 30, 'iqoo 11s', 'iqoo-11s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1808, 2, 30, 'iqoo neo 7 pro 1', 'iqoo-neo-7-pro-1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1809, 2, 30, 'iqoo neo8 pro', 'iqoo-neo8-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1810, 2, 30, 'iqoo z7s', 'iqoo-z7s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1811, 2, 30, 'viv0 y02', 'viv0-y02.jpg', 0, 1, '2023-09-11 16:33:45'),
(1812, 2, 30, 'iqoo 3 5g', 'vivo-iqoo-3-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1813, 2, 30, 'iqoo 5 5g', 'vivo-iqoo-5-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1814, 2, 30, 'iqoo 5 pro', 'vivo-iqoo-5-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1815, 2, 30, 'iqoo 7 india ', 'vivo-iqoo-7-india-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1816, 2, 30, 'iqoo 7', 'vivo-iqoo-7.jpg', 0, 1, '2023-09-11 16:33:45'),
(1817, 2, 30, 'iqoo 8 pro  ', 'vivo-iqoo-8-pro--.jpg', 0, 1, '2023-09-11 16:33:45'),
(1818, 2, 30, 'iqoo 8', 'vivo-iqoo-8.jpg', 0, 1, '2023-09-11 16:33:45'),
(1819, 2, 30, 'iqoo 9 global', 'vivo-iqoo-9-global.jpg', 0, 1, '2023-09-11 16:33:45'),
(1820, 2, 30, 'iqoo 9 pro global', 'vivo-iqoo-9-pro-global.jpg', 0, 1, '2023-09-11 16:33:45'),
(1821, 2, 30, 'iqoo 9 se', 'vivo-iqoo-9-se.jpg', 0, 1, '2023-09-11 16:33:45'),
(1822, 2, 30, 'iqoo 9', 'vivo-iqoo-9.jpg', 0, 1, '2023-09-11 16:33:45'),
(1823, 2, 30, 'iqoo 9t 5g', 'vivo-iqoo-9t-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1824, 2, 30, 'iqoo neo 5s ', 'vivo-iqoo-neo-5s-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1825, 2, 30, 'iqoo neo 5se', 'vivo-iqoo-neo-5se.jpg', 0, 1, '2023-09-11 16:33:45'),
(1826, 2, 30, 'iqoo neo 855 racing', 'vivo-iqoo-neo-855-racing.jpg', 0, 1, '2023-09-11 16:33:45'),
(1827, 2, 30, 'iqoo neo 855', 'vivo-iqoo-neo-855.jpg', 0, 1, '2023-09-11 16:33:45'),
(1828, 2, 30, 'iqoo neo', 'vivo-iqoo-neo.jpg', 0, 1, '2023-09-11 16:33:45'),
(1829, 2, 30, 'iqoo neo3', 'vivo-iqoo-neo3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1830, 2, 30, 'iqoo neo5', 'vivo-iqoo-neo5.jpg', 0, 1, '2023-09-11 16:33:45'),
(1831, 2, 30, 'iqoo neo6 r', 'vivo-iqoo-neo6-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(1832, 2, 30, 'iqoo neo6 se', 'vivo-iqoo-neo6-se.jpg', 0, 1, '2023-09-11 16:33:45'),
(1833, 2, 30, 'iqoo neo6', 'vivo-iqoo-neo6.jpg', 0, 1, '2023-09-11 16:33:45'),
(1834, 2, 30, 'iqoo neo7 se', 'vivo-iqoo-neo7-se.jpg', 0, 1, '2023-09-11 16:33:45'),
(1835, 2, 30, 'iqoo neo7', 'vivo-iqoo-neo7.jpg', 0, 1, '2023-09-11 16:33:45'),
(1836, 2, 30, 'iqoo neo8', 'vivo-iqoo-neo8.jpg', 0, 1, '2023-09-11 16:33:45'),
(1837, 5, 34, 'iqoo pad', 'vivo-iqoo-pad.jpg', 0, 1, '2023-09-11 16:33:45'),
(1838, 2, 30, 'iqoo pro 5g', 'vivo-iqoo-pro-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1839, 2, 30, 'iqoo pro', 'vivo-iqoo-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1840, 2, 30, 'iqoo u1', 'vivo-iqoo-u1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1841, 2, 30, 'iqoo u1x', 'vivo-iqoo-u1x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1842, 2, 30, 'iqoo u3', 'vivo-iqoo-u3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1843, 2, 30, 'iqoo u3x 5g', 'vivo-iqoo-u3x-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1844, 2, 30, 'iqoo u3x standard', 'vivo-iqoo-u3x-standard.jpg', 0, 1, '2023-09-11 16:33:45'),
(1845, 2, 30, 'iqoo u5', 'vivo-iqoo-u5.jpg', 0, 1, '2023-09-11 16:33:45'),
(1846, 2, 30, 'iqoo u5e', 'vivo-iqoo-u5e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1847, 2, 30, 'iqoo u5x', 'vivo-iqoo-u5x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1848, 2, 30, 'iqoo u6 r', 'vivo-iqoo-u6-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(1849, 2, 30, 'iqoo z1 5g', 'vivo-iqoo-z1-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1850, 2, 30, 'iqoo z1x 5g1', 'vivo-iqoo-z1x-5g1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1851, 2, 30, 'iqoo z5', 'vivo-iqoo-z5.jpg', 0, 1, '2023-09-11 16:33:45'),
(1852, 2, 30, 'iqoo z5x', 'vivo-iqoo-z5x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1853, 2, 30, 'iqoo z6 44w', 'vivo-iqoo-z6-44w.jpg', 0, 1, '2023-09-11 16:33:45'),
(1854, 2, 30, 'iqoo z6 china', 'vivo-iqoo-z6-china.jpg', 0, 1, '2023-09-11 16:33:45'),
(1855, 2, 30, 'iqoo z6 lite 5g', 'vivo-iqoo-z6-lite-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1856, 2, 30, 'iqoo z6 pro', 'vivo-iqoo-z6-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1857, 2, 30, 'iqoo z6', 'vivo-iqoo-z6.jpg', 0, 1, '2023-09-11 16:33:45'),
(1858, 2, 30, 'iqoo z6x', 'vivo-iqoo-z6x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1859, 2, 30, 'iqoo z7 cn', 'vivo-iqoo-z7-cn.jpg', 0, 1, '2023-09-11 16:33:45'),
(1860, 2, 30, 'iqoo z7 in', 'vivo-iqoo-z7-in.jpg', 0, 1, '2023-09-11 16:33:45'),
(1861, 2, 30, 'iqoo z7i', 'vivo-iqoo-z7i.jpg', 0, 1, '2023-09-11 16:33:45'),
(1862, 2, 30, 'iqoo z7x', 'vivo-iqoo-z7x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1863, 2, 30, 'iqoo', 'vivo-iqoo.jpg', 0, 1, '2023-09-11 16:33:45'),
(1864, 2, 30, 'iqoo10 pro', 'vivo-iqoo10-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1865, 2, 30, 'iqoo10', 'vivo-iqoo10.jpg', 0, 1, '2023-09-11 16:33:45'),
(1866, 2, 30, 'iqoo11 pro', 'vivo-iqoo11-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1867, 2, 30, 'iqoo11', 'vivo-iqoo11.jpg', 0, 1, '2023-09-11 16:33:45'),
(1868, 2, 30, 'max plus', 'vivo-max-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1869, 2, 30, 'neo5 lite', 'vivo-neo5-lite.jpg', 0, 1, '2023-09-11 16:33:45'),
(1870, 2, 30, 'nex 3s 5g', 'vivo-nex-3s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1871, 2, 30, 'nex r1', 'vivo-nex-r1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1872, 2, 30, 'nex s', 'vivo-nex-s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1873, 2, 30, 'nex2 ', 'vivo-nex2-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1874, 2, 30, 'nex3 5g', 'vivo-nex3-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1875, 2, 30, 'nex3', 'vivo-nex3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1876, 5, 34, 'pad', 'vivo-pad.jpg', 0, 1, '2023-09-11 16:33:45'),
(1877, 5, 34, 'pad2', 'vivo-pad2.jpg', 0, 1, '2023-09-11 16:33:45'),
(1878, 2, 30, 'qoo z3', 'vivo-qoo-z3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1879, 2, 30, 's1 pro global', 'vivo-s1-pro-global.jpg', 0, 1, '2023-09-11 16:33:45'),
(1880, 2, 30, 's1 pro', 'vivo-s1-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1881, 2, 30, 's1 v1907', 'vivo-s1-v1907.jpg', 0, 1, '2023-09-11 16:33:45'),
(1882, 2, 30, 's1', 'vivo-s1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1883, 2, 30, 's10 pro', 'vivo-s10-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1884, 2, 30, 's10e', 'vivo-s10e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1885, 2, 30, 's12 pro', 'vivo-s12-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1886, 2, 30, 's12', 'vivo-s12.jpg', 0, 1, '2023-09-11 16:33:45'),
(1887, 2, 30, 's15 pro', 'vivo-s15-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1888, 2, 30, 's15', 'vivo-s15.jpg', 0, 1, '2023-09-11 16:33:45'),
(1889, 2, 30, 's15e', 'vivo-s15e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1890, 2, 30, 's16 pro', 'vivo-s16-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1891, 2, 30, 's16', 'vivo-s16.jpg', 0, 1, '2023-09-11 16:33:45'),
(1892, 2, 30, 's16e', 'vivo-s16e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1893, 2, 30, 's17 pro', 'vivo-s17-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1894, 2, 30, 's17', 'vivo-s17.jpg', 0, 1, '2023-09-11 16:33:45'),
(1895, 2, 30, 's17e', 'vivo-s17e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1896, 2, 30, 's17t', 'vivo-s17t.jpg', 0, 1, '2023-09-11 16:33:45'),
(1897, 2, 30, 's5', 'vivo-s5.jpg', 0, 1, '2023-09-11 16:33:45'),
(1898, 2, 30, 's6 5g', 'vivo-s6-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1899, 2, 30, 's7', 'vivo-s7.jpg', 0, 1, '2023-09-11 16:33:45'),
(1900, 2, 30, 's7e 5g', 'vivo-s7e-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1901, 2, 30, 's9', 'vivo-s9.jpg', 0, 1, '2023-09-11 16:33:45'),
(1902, 2, 30, 's9e', 'vivo-s9e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1903, 2, 30, 't1 5g 778g', 'vivo-t1-5g-778g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1904, 2, 30, 't1 5g', 'vivo-t1-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1905, 2, 30, 't1 sndrgn680', 'vivo-t1-sndrgn680.jpg', 0, 1, '2023-09-11 16:33:45'),
(1906, 2, 30, 't1', 'vivo-t1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1907, 2, 30, 't1x 4g', 'vivo-t1x-4g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1908, 2, 30, 't1x india', 'vivo-t1x-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(1909, 2, 30, 't1x', 'vivo-t1x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1910, 2, 30, 't2 india', 'vivo-t2-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(1911, 2, 30, 't2', 'vivo-t2.jpg', 0, 1, '2023-09-11 16:33:45'),
(1912, 2, 30, 't2x india ', 'vivo-t2x-india-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1913, 2, 30, 't2x', 'vivo-t2x.jpg', 0, 1, '2023-09-11 16:33:45'),
(1914, 2, 30, 'u10 ', 'vivo-u10-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1915, 2, 30, 'u20', 'vivo-u20.jpg', 0, 1, '2023-09-11 16:33:45'),
(1916, 2, 30, 'u3', 'vivo-u3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1917, 2, 30, 'v1 max', 'vivo-v1-max.jpg', 0, 1, '2023-09-11 16:33:45'),
(1918, 2, 30, 'v1', 'vivo-v1.jpg', 0, 1, '2023-09-11 16:33:45'),
(1919, 2, 30, 'v11 pro 2', 'vivo-v11-pro-2.jpg', 0, 1, '2023-09-11 16:33:45'),
(1920, 2, 30, 'v11i ', 'vivo-v11i-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1921, 2, 30, 'v15 pro', 'vivo-v15-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1922, 2, 30, 'v15', 'vivo-v15.jpg', 0, 1, '2023-09-11 16:33:45'),
(1923, 2, 30, 'v17 india', 'vivo-v17-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(1924, 2, 30, 'v17 neo', 'vivo-v17-neo.jpg', 0, 1, '2023-09-11 16:33:45'),
(1925, 2, 30, 'v17 pro r', 'vivo-v17-pro-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(1926, 2, 30, 'v17', 'vivo-v17.jpg', 0, 1, '2023-09-11 16:33:45'),
(1927, 2, 30, 'v19 dual selfie', 'vivo-v19-dual-selfie.jpg', 0, 1, '2023-09-11 16:33:45'),
(1928, 2, 30, 'v19', 'vivo-v19.jpg', 0, 1, '2023-09-11 16:33:45'),
(1929, 2, 30, 'v20 new', 'vivo-v20-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(1930, 2, 30, 'v20 pro', 'vivo-v20-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1931, 2, 30, 'v20se', 'vivo-v20se.jpg', 0, 1, '2023-09-11 16:33:45'),
(1932, 2, 30, 'v21 5g', 'vivo-v21-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1933, 2, 30, 'v21', 'vivo-v21.jpg', 0, 1, '2023-09-11 16:33:45'),
(1934, 2, 30, 'v21e 5g', 'vivo-v21e-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1935, 2, 30, 'v21e', 'vivo-v21e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1936, 2, 30, 'v23 5g', 'vivo-v23-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1937, 2, 30, 'v23 pro', 'vivo-v23-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1938, 2, 30, 'v23e', 'vivo-v23e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1939, 2, 30, 'v25 ', 'vivo-v25-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1940, 2, 30, 'v25 pro', 'vivo-v25-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1941, 2, 30, 'v25', 'vivo-v25.jpg', 0, 1, '2023-09-11 16:33:45'),
(1942, 2, 30, 'v25e', 'vivo-v25e.jpg', 0, 1, '2023-09-11 16:33:45'),
(1943, 2, 30, 'v27 pro', 'vivo-v27-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1944, 2, 30, 'v27', 'vivo-v27.jpg', 0, 1, '2023-09-11 16:33:45'),
(1945, 2, 30, 'v29 lite', 'vivo-v29-lite.jpg', 0, 1, '2023-09-11 16:33:45'),
(1946, 2, 30, 'v3', 'vivo-v3.jpg', 0, 1, '2023-09-11 16:33:45'),
(1947, 2, 30, 'v5 lite', 'vivo-v5-lite.jpg', 0, 1, '2023-09-11 16:33:45'),
(1948, 2, 30, 'v5 plus', 'vivo-v5-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1949, 2, 30, 'v5', 'vivo-v5.jpg', 0, 1, '2023-09-11 16:33:45'),
(1950, 2, 30, 'v5s', 'vivo-v5s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1951, 2, 30, 'v7 plus', 'vivo-v7-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1952, 2, 30, 'v7', 'vivo-v7.jpg', 0, 1, '2023-09-11 16:33:45'),
(1953, 2, 30, 'v9 ', 'vivo-v9-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1954, 7, 32, 'watch 2020', 'vivo-watch-2020.jpg', 0, 1, '2023-09-11 16:33:45'),
(1955, 7, 32, 'watch2', 'vivo-watch2.jpg', 0, 1, '2023-09-11 16:33:45'),
(1956, 2, 30, 'x flip', 'vivo-x-flip.jpg', 0, 1, '2023-09-11 16:33:45'),
(1957, 2, 30, 'x fold plus', 'vivo-x-fold-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1958, 2, 30, 'x fold', 'vivo-x-fold.jpg', 0, 1, '2023-09-11 16:33:45'),
(1959, 2, 30, 'x fold2', 'vivo-x-fold2.jpg', 0, 1, '2023-09-11 16:33:45'),
(1960, 2, 30, 'x note', 'vivo-x-note.jpg', 0, 1, '2023-09-11 16:33:45'),
(1961, 2, 30, 'x20 plus ud', 'vivo-x20-plus-ud.jpg', 0, 1, '2023-09-11 16:33:45'),
(1962, 2, 30, 'x20 plus', 'vivo-x20-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1963, 2, 30, 'x20', 'vivo-x20.jpg', 0, 1, '2023-09-11 16:33:45'),
(1964, 2, 30, 'x21', 'vivo-x21.jpg', 0, 1, '2023-09-11 16:33:45'),
(1965, 2, 30, 'x21i ', 'vivo-x21i-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1966, 2, 30, 'x21ud', 'vivo-x21ud.jpg', 0, 1, '2023-09-11 16:33:45'),
(1967, 2, 30, 'x23', 'vivo-x23.jpg', 0, 1, '2023-09-11 16:33:45'),
(1968, 2, 30, 'x27 ', 'vivo-x27-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1969, 2, 30, 'x27 pro', 'vivo-x27-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1970, 2, 30, 'x30 pro', 'vivo-x30-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1971, 2, 30, 'x30', 'vivo-x30.jpg', 0, 1, '2023-09-11 16:33:45'),
(1972, 2, 30, 'x3s', 'vivo-x3s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1973, 2, 30, 'x5 max platinum edition', 'vivo-x5-max-platinum-edition.jpg', 0, 1, '2023-09-11 16:33:45'),
(1974, 2, 30, 'x5 max', 'vivo-x5-max.jpg', 0, 1, '2023-09-11 16:33:45'),
(1975, 2, 30, 'x5 pro', 'vivo-x5-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1976, 2, 30, 'x50 4g', 'vivo-x50-4g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1977, 2, 30, 'x50 lite', 'vivo-x50-lite.jpg', 0, 1, '2023-09-11 16:33:45'),
(1978, 2, 30, 'x50 pro ', 'vivo-x50-pro-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1979, 2, 30, 'x50 pro plus', 'vivo-x50-pro-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1980, 2, 30, 'x50', 'vivo-x50.jpg', 0, 1, '2023-09-11 16:33:45'),
(1981, 2, 30, 'x50e 5g', 'vivo-x50e-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1982, 2, 30, 'x51 5g', 'vivo-x51-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(1983, 2, 30, 'x5v', 'vivo-x5v.jpg', 0, 1, '2023-09-11 16:33:45'),
(1984, 2, 30, 'x6 ', 'vivo-x6-.jpg', 0, 1, '2023-09-11 16:33:45'),
(1985, 2, 30, 'x60 global new', 'vivo-x60-global-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(1986, 2, 30, 'x60 pro global new', 'vivo-x60-pro-global-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(1987, 2, 30, 'x60 pro plus', 'vivo-x60-pro-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1988, 2, 30, 'x60 pro', 'vivo-x60-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1989, 2, 30, 'x60', 'vivo-x60.jpg', 0, 1, '2023-09-11 16:33:45'),
(1990, 2, 30, 'x60s', 'vivo-x60s.jpg', 0, 1, '2023-09-11 16:33:45'),
(1991, 2, 30, 'x60t', 'vivo-x60t.jpg', 0, 1, '2023-09-11 16:33:45'),
(1992, 2, 30, 'x6s plus', 'vivo-x6s-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1993, 2, 30, 'x7 plus', 'vivo-x7-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1994, 2, 30, 'x7', 'vivo-x7.jpg', 0, 1, '2023-09-11 16:33:45'),
(1995, 2, 30, 'x70 pro plus', 'vivo-x70-pro-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(1996, 2, 30, 'x70 pro r', 'vivo-x70-pro-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(1997, 2, 30, 'x70', 'vivo-x70.jpg', 0, 1, '2023-09-11 16:33:45'),
(1998, 2, 30, 'x80 pro', 'vivo-x80-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(1999, 2, 30, 'x80', 'vivo-x80.jpg', 0, 1, '2023-09-11 16:33:45'),
(2000, 2, 30, 'x9 ', 'vivo-x9-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2001, 2, 30, 'x9 plus', 'vivo-x9-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(2002, 2, 30, 'x90 pro plus', 'vivo-x90-pro-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(2003, 2, 30, 'x90 pro', 'vivo-x90-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(2004, 2, 30, 'x90', 'vivo-x90.jpg', 0, 1, '2023-09-11 16:33:45'),
(2005, 2, 30, 'x90s', 'vivo-x90s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2006, 2, 30, 'x9s plus r', 'vivo-x9s-plus-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(2007, 2, 30, 'xplay 3s', 'vivo-xplay-3s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2008, 2, 30, 'xplay 7 r', 'vivo-xplay-7-r.jpg', 0, 1, '2023-09-11 16:33:45'),
(2009, 2, 30, 'xplay5 elite', 'vivo-xplay5-elite.jpg', 0, 1, '2023-09-11 16:33:45'),
(2010, 2, 30, 'xplay5', 'vivo-xplay5.jpg', 0, 1, '2023-09-11 16:33:45'),
(2011, 2, 30, 'xplay6', 'vivo-xplay6.jpg', 0, 1, '2023-09-11 16:33:45'),
(2012, 2, 30, 'xshot', 'vivo-xshot.jpg', 0, 1, '2023-09-11 16:33:45'),
(2013, 2, 30, 'y01', 'vivo-y01.jpg', 0, 1, '2023-09-11 16:33:45'),
(2014, 2, 30, 'y02s', 'vivo-y02s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2015, 2, 30, 'y02t', 'vivo-y02t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2016, 2, 30, 'y100', 'vivo-y100.jpg', 0, 1, '2023-09-11 16:33:45'),
(2017, 2, 30, 'y11 2019', 'vivo-y11-2019.jpg', 0, 1, '2023-09-11 16:33:45'),
(2018, 2, 30, 'y11', 'vivo-y11.jpg', 0, 1, '2023-09-11 16:33:45'),
(2019, 2, 30, 'y11s', 'vivo-y11s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2020, 2, 30, 'y12', 'vivo-y12.jpg', 0, 1, '2023-09-11 16:33:45'),
(2021, 2, 30, 'y12s', 'vivo-y12s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2022, 2, 30, 'y15 new', 'vivo-y15-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(2023, 2, 30, 'y15', 'vivo-y15.jpg', 0, 1, '2023-09-11 16:33:45'),
(2024, 2, 30, 'y15s new', 'vivo-y15s-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(2025, 2, 30, 'y15s', 'vivo-y15s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2026, 2, 30, 'y16', 'vivo-y16.jpg', 0, 1, '2023-09-11 16:33:45'),
(2027, 2, 30, 'y17', 'vivo-y17.jpg', 0, 1, '2023-09-11 16:33:45'),
(2028, 2, 30, 'y19', 'vivo-y19.jpg', 0, 1, '2023-09-11 16:33:45'),
(2029, 2, 30, 'y1s', 'vivo-y1s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2030, 2, 30, 'y20 2021', 'vivo-y20-2021.jpg', 0, 1, '2023-09-11 16:33:45'),
(2031, 2, 30, 'y20', 'vivo-y20.jpg', 0, 1, '2023-09-11 16:33:45'),
(2032, 2, 30, 'y20g', 'vivo-y20g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2033, 2, 30, 'y20s', 'vivo-y20s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2034, 2, 30, 'y21 ', 'vivo-y21-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2035, 2, 30, 'y21s', 'vivo-y21s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2036, 2, 30, 'y22 2022', 'vivo-y22-2022.jpg', 0, 1, '2023-09-11 16:33:45'),
(2037, 2, 30, 'y22', 'vivo-y22.jpg', 0, 1, '2023-09-11 16:33:45'),
(2038, 2, 30, 'y22s', 'vivo-y22s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2039, 2, 30, 'y25', 'vivo-y25.jpg', 0, 1, '2023-09-11 16:33:45'),
(2040, 2, 30, 'y27', 'vivo-y27.jpg', 0, 1, '2023-09-11 16:33:45'),
(2041, 2, 30, 'y28', 'vivo-y28.jpg', 0, 1, '2023-09-11 16:33:45'),
(2042, 2, 30, 'y3 64 4', 'vivo-y3-64-4.jpg', 0, 1, '2023-09-11 16:33:45'),
(2043, 2, 30, 'y3 standard', 'vivo-y3-standard.jpg', 0, 1, '2023-09-11 16:33:45'),
(2044, 2, 30, 'y30 china', 'vivo-y30-china.jpg', 0, 1, '2023-09-11 16:33:45'),
(2045, 2, 30, 'y30', 'vivo-y30.jpg', 0, 1, '2023-09-11 16:33:45'),
(2046, 2, 30, 'y30g', 'vivo-y30g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2047, 2, 30, 'y31 2021', 'vivo-y31-2021.jpg', 0, 1, '2023-09-11 16:33:45'),
(2048, 2, 30, 'y31', 'vivo-y31.jpg', 0, 1, '2023-09-11 16:33:45'),
(2049, 2, 30, 'y31s 5g', 'vivo-y31s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2050, 2, 30, 'y32', 'vivo-y32.jpg', 0, 1, '2023-09-11 16:33:45'),
(2051, 2, 30, 'y33e', 'vivo-y33e.jpg', 0, 1, '2023-09-11 16:33:45'),
(2052, 2, 30, 'y33s 5g', 'vivo-y33s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2053, 2, 30, 'y33s', 'vivo-y33s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2054, 2, 30, 'y33t', 'vivo-y33t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2055, 2, 30, 'y35 2022', 'vivo-y35-2022.jpg', 0, 1, '2023-09-11 16:33:45'),
(2056, 2, 30, 'y35 5g', 'vivo-y35-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2057, 2, 30, 'y35 plus', 'vivo-y35-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(2058, 2, 30, 'y35', 'vivo-y35.jpg', 0, 1, '2023-09-11 16:33:45'),
(2059, 2, 30, 'y36 5g', 'vivo-y36-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2060, 2, 30, 'y36 india', 'vivo-y36-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(2061, 2, 30, 'y36', 'vivo-y36.jpg', 0, 1, '2023-09-11 16:33:45'),
(2062, 2, 30, 'y37', 'vivo-y37.jpg', 0, 1, '2023-09-11 16:33:45'),
(2063, 2, 30, 'y3s 2021', 'vivo-y3s-2021.jpg', 0, 1, '2023-09-11 16:33:45'),
(2064, 2, 30, 'y3s', 'vivo-y3s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2065, 2, 30, 'y50', 'vivo-y50.jpg', 0, 1, '2023-09-11 16:33:45'),
(2066, 2, 30, 'y50t', 'vivo-y50t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2067, 2, 30, 'y51 2020 dec', 'vivo-y51-2020-dec.jpg', 0, 1, '2023-09-11 16:33:45'),
(2068, 2, 30, 'y51 2020', 'vivo-y51-2020.jpg', 0, 1, '2023-09-11 16:33:45'),
(2069, 2, 30, 'y51', 'vivo-y51.jpg', 0, 1, '2023-09-11 16:33:45'),
(2070, 2, 30, 'y51s', 'vivo-y51s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2071, 2, 30, 'y52 5g', 'vivo-y52-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2072, 2, 30, 'y52 t1', 'vivo-y52-t1.jpg', 0, 1, '2023-09-11 16:33:45'),
(2073, 2, 30, 'y52s 5g', 'vivo-y52s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2074, 2, 30, 'y52t', 'vivo-y52t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2075, 2, 30, 'y53', 'vivo-y53.jpg', 0, 1, '2023-09-11 16:33:45'),
(2076, 2, 30, 'y53i ', 'vivo-y53i-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2077, 2, 30, 'y53s 4g', 'vivo-y53s-4g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2078, 2, 30, 'y53s', 'vivo-y53s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2079, 2, 30, 'y54s 5g', 'vivo-y54s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2080, 2, 30, 'y55 5g', 'vivo-y55-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2081, 2, 30, 'y55 pk', 'vivo-y55-pk.jpg', 0, 1, '2023-09-11 16:33:45'),
(2082, 2, 30, 'y55l 1603', 'vivo-y55l-1603.jpg', 0, 1, '2023-09-11 16:33:45'),
(2083, 2, 30, 'y55s 5g', 'vivo-y55s-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2084, 2, 30, 'y55s', 'vivo-y55s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2085, 2, 30, 'y56 5g', 'vivo-y56-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2086, 2, 30, 'y5s', 'vivo-y5s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2087, 2, 30, 'y65', 'vivo-y65.jpg', 0, 1, '2023-09-11 16:33:45'),
(2088, 2, 30, 'y67', 'vivo-y67.jpg', 0, 1, '2023-09-11 16:33:45'),
(2089, 2, 30, 'y69', 'vivo-y69.jpg', 0, 1, '2023-09-11 16:33:45'),
(2090, 2, 30, 'y70s', 'vivo-y70s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2091, 2, 30, 'y70t', 'vivo-y70t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2092, 2, 30, 'y71 ', 'vivo-y71-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2093, 2, 30, 'y71t', 'vivo-y71t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2094, 2, 30, 'y72 5g india', 'vivo-y72-5g-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(2095, 2, 30, 'y72', 'vivo-y72.jpg', 0, 1, '2023-09-11 16:33:45'),
(2096, 2, 30, 'y72t', 'vivo-y72t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2097, 2, 30, 'y73s', 'vivo-y73s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2098, 2, 30, 'y73t', 'vivo-y73t.jpg', 0, 1, '2023-09-11 16:33:45'),
(2099, 2, 30, 'y75', 'vivo-y75.jpg', 0, 1, '2023-09-11 16:33:45'),
(2100, 2, 30, 'y75s', 'vivo-y75s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2101, 2, 30, 'y76 5g', 'vivo-y76-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2102, 2, 30, 'y76s', 'vivo-y76s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2103, 2, 30, 'y77 5g china', 'vivo-y77-5g-china.jpg', 0, 1, '2023-09-11 16:33:45'),
(2104, 2, 30, 'y77 5g', 'vivo-y77-5g.jpg', 0, 1, '2023-09-11 16:33:45'),
(2105, 2, 30, 'y77e', 'vivo-y77e.jpg', 0, 1, '2023-09-11 16:33:45'),
(2106, 2, 30, 'y78 global', 'vivo-y78-global.jpg', 0, 1, '2023-09-11 16:33:45'),
(2107, 2, 30, 'y78 plus', 'vivo-y78-plus.jpg', 0, 1, '2023-09-11 16:33:45'),
(2108, 2, 30, 'y78', 'vivo-y78.jpg', 0, 1, '2023-09-11 16:33:45'),
(2109, 2, 30, 'y81', 'vivo-y81.jpg', 0, 1, '2023-09-11 16:33:45'),
(2110, 2, 30, 'y81i', 'vivo-y81i.jpg', 0, 1, '2023-09-11 16:33:45'),
(2111, 2, 30, 'y83 new', 'vivo-y83-new.jpg', 0, 1, '2023-09-11 16:33:45'),
(2112, 2, 30, 'y83 pro', 'vivo-y83-pro.jpg', 0, 1, '2023-09-11 16:33:45'),
(2113, 2, 30, 'y89', 'vivo-y89.jpg', 0, 1, '2023-09-11 16:33:45'),
(2114, 2, 30, 'y90', 'vivo-y90.jpg', 0, 1, '2023-09-11 16:33:45'),
(2115, 2, 30, 'y91', 'vivo-y91.jpg', 0, 1, '2023-09-11 16:33:45'),
(2116, 2, 30, 'y91i ', 'vivo-y91i-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2117, 2, 30, 'y91i dual camera', 'vivo-y91i-dual-camera.jpg', 0, 1, '2023-09-11 16:33:45'),
(2118, 2, 30, 'y93 india', 'vivo-y93-india.jpg', 0, 1, '2023-09-11 16:33:45'),
(2119, 2, 30, 'y93', 'vivo-y93.jpg', 0, 1, '2023-09-11 16:33:45'),
(2120, 2, 30, 'y95 ', 'vivo-y95-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2121, 2, 30, 'y97', 'vivo-y97.jpg', 0, 1, '2023-09-11 16:33:45'),
(2122, 2, 30, 'y9s', 'vivo-y9s.jpg', 0, 1, '2023-09-11 16:33:45'),
(2123, 2, 30, 'z1 lite ', 'vivo-z1-lite-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2124, 2, 30, 'z1a', 'vivo-z1a.jpg', 0, 1, '2023-09-11 16:33:45'),
(2125, 2, 30, 'z1i ', 'vivo-z1i-.jpg', 0, 1, '2023-09-11 16:33:45'),
(2126, 2, 30, 'z1x', 'vivo-z1x.jpg', 0, 1, '2023-09-11 16:33:45'),
(2127, 2, 30, 'z3', 'vivo-z3.jpg', 0, 1, '2023-09-11 16:33:45'),
(2128, 2, 30, 'z3i', 'vivo-z3i.jpg', 0, 1, '2023-09-11 16:33:45'),
(2129, 2, 30, 'z3x', 'vivo-z3x.jpg', 0, 1, '2023-09-11 16:33:45'),
(2130, 2, 30, 'z5', 'vivo-z5.jpg', 0, 1, '2023-09-11 16:33:45'),
(2131, 2, 30, 'z5i', 'vivo-z5i.jpg', 0, 1, '2023-09-11 16:33:45'),
(2132, 2, 30, 'z5x 2020', 'vivo-z5x-2020.jpg', 0, 1, '2023-09-11 16:33:45'),
(2133, 2, 30, 'z5x', 'vivo-z5x.jpg', 0, 1, '2023-09-11 16:33:45'),
(2134, 2, 30, 'z6 5g', 'vivo-z6-5g.jpg', 0, 1, '2023-09-11 16:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `percentage` float NOT NULL,
  `offers_name` varchar(500) DEFAULT NULL,
  `is_first_order` int(11) NOT NULL DEFAULT 0,
  `isDelete` tinyint(11) DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `code`, `percentage`, `offers_name`, `is_first_order`, `isDelete`, `isActive`, `created_date`) VALUES
(3, 'FIRST50', 50, 'get 50% off your first order', 1, 0, 1, '2023-10-04 11:15:32'),
(5, 'HDFC20', 20, 'HDFC Bank Credit Card 20% off', 0, 0, 1, '2023-09-29 11:38:51'),
(6, 'SBI10', 10, 'SBI Bank Credit Card 10% off', 0, 0, 1, '2023-09-29 11:40:07'),
(7, 'AXIS5', 5, 'Axis Bank Credit Card 5% off', 0, 0, 1, '2023-10-04 11:15:17'),
(9, 'FIRST40', 40, 'get 40% off your first order', 1, 0, 1, '2023-11-22 07:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `modal_id` int(11) NOT NULL,
  `device_problem_id` varchar(255) DEFAULT NULL,
  `user_address_id` int(255) NOT NULL,
  `offer_code` varchar(500) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `order_pdf` varchar(255) NOT NULL,
  `status` tinyint(11) NOT NULL COMMENT '0=Pending,1=Accept,2=payment,3=Reject ',
  `sub_total` float(10,2) NOT NULL,
  `tax_amount` float(10,2) NOT NULL,
  `offer_amount` float(10,2) DEFAULT NULL,
  `grand_total` float(10,2) NOT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `vendor_id`, `category_id`, `brand_id`, `modal_id`, `device_problem_id`, `user_address_id`, `offer_code`, `image_path`, `order_pdf`, `status`, `sub_total`, `tax_amount`, `offer_amount`, `grand_total`, `razorpay_payment_id`, `tracking_id`, `isDelete`, `isActive`, `created_date`) VALUES
(604, 147, 120, 2, 21, 309, '', 75, NULL, 'Array', '', 1, 150.00, 15.00, 0.00, 165.00, NULL, 'abcd12345', 0, 1, '2024-02-06 09:29:02'),
(605, 147, 120, 2, 21, 309, '', 75, NULL, 'Array', '', 1, 750.00, 75.00, 0.00, 825.00, NULL, 'abcd12345', 0, 1, '2024-02-07 05:14:33'),
(606, 147, 120, 2, 21, 309, '', 75, NULL, 'Array', '', 0, 200.00, 20.00, 0.00, 220.00, NULL, 'abcd12345', 0, 1, '2024-02-08 05:45:28'),
(607, 147, 120, 2, 21, 309, '', 75, NULL, 'Array', '', 1, 250.00, 25.00, 0.00, 275.00, NULL, 'abcd12345', 0, 1, '2024-03-12 05:56:43'),
(608, 149, 121, 2, 21, 309, '', 56, 'FIRST50', 'problem_image_067102.jpg', 'invoice-608.pdf', 2, 250.00, 25.00, 125.00, 150.00, 'COD', 'abcd12345', 0, 1, '2024-03-18 11:50:06'),
(609, 149, 121, 2, 21, 309, '', 56, '', 'problem_image_125755.jpg', 'invoice-609.pdf', 1, 650.00, 25.00, 0.00, 715.00, NULL, 'abcd12345', 0, 1, '2024-03-18 11:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_problem_image`
--

CREATE TABLE `order_problem_image` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_problem_image`
--

INSERT INTO `order_problem_image` (`id`, `image_path`, `order_id`, `isActive`, `isDelete`, `created_date`) VALUES
(1296, 'problem_image_094913.jpg', 604, 1, 0, '2024-02-06 09:29:02'),
(1297, 'problem_image_302404.jpg', 605, 1, 0, '2024-02-07 05:14:33'),
(1298, 'problem_image_641612.jpg', 606, 1, 0, '2024-02-08 05:45:28'),
(1299, 'problem_image_140858.jpg', 607, 1, 0, '2024-03-12 05:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `page_admin_right`
--

CREATE TABLE `page_admin_right` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `view_flag` int(11) DEFAULT 0,
  `insert_flag` int(11) DEFAULT 0,
  `update_flag` int(11) DEFAULT 0,
  `delete_flag` int(11) DEFAULT 0,
  `isDelete` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT 1,
  `created_by_type` int(11) DEFAULT 0,
  `modified_by` text DEFAULT NULL,
  `modified_by_type` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_admin_right`
--

INSERT INTO `page_admin_right` (`id`, `page_id`, `admin_id`, `view_flag`, `insert_flag`, `update_flag`, `delete_flag`, `isDelete`, `created_by`, `created_by_type`, `modified_by`, `modified_by_type`, `created_date`, `modified_date`) VALUES
(7, 404, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(8, 405, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(17, 479, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(20, 406, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(21, 492, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(35, 506, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(36, 507, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(37, 508, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(38, 509, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(39, 510, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(40, 511, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(41, 512, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(42, 513, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(43, 514, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(44, 515, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(45, 516, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(46, 517, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(47, 518, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(48, 519, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(49, 520, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(50, 521, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(51, 522, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(52, 524, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(53, 525, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(54, 526, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(55, 527, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(56, 528, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(57, 529, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(58, 530, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL),
(59, 531, 1, 1, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_table`
--

CREATE TABLE `page_table` (
  `id` int(11) NOT NULL,
  `page_title` varchar(1000) DEFAULT NULL,
  `page_slug` varchar(100) DEFAULT NULL,
  `page_count` int(11) DEFAULT 0,
  `page_urls` text DEFAULT NULL,
  `isActive` int(11) DEFAULT 1,
  `isDelete` int(11) DEFAULT 0,
  `adate` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_by_type` int(11) DEFAULT 0,
  `modified_by` text DEFAULT NULL,
  `modified_by_type` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_table`
--

INSERT INTO `page_table` (`id`, `page_title`, `page_slug`, `page_count`, `page_urls`, `isActive`, `isDelete`, `adate`, `created_by`, `created_by_type`, `modified_by`, `modified_by_type`, `created_date`, `modified_date`) VALUES
(400, 'Dashboard Page', 'dashboard', 1, 'dashboard.php', 0, 0, '2017-04-25 00:00:00', 1, 0, '1,1', '0,0', '0000-00-00 00:00:00', '2017-04-25 13:05:02,2017-04-25 13:05:21'),
(401, 'My Account Page', 'my_account', 1, 'my_account.php', 1, 0, '2017-04-25 00:00:00', 1, 0, '', '', '0000-00-00 00:00:00', ''),
(402, 'Login Page', 'login', 1, 'index.php', 1, 0, '2017-04-25 12:14:12', 1, 0, '', '', '2017-04-25 12:14:12', ''),
(403, 'Logout Page', 'logout', 1, 'logout.php', 1, 0, '2017-04-25 12:14:48', 1, 0, '1', '0', '2017-04-25 12:14:48', '2017-04-25 12:15:28'),
(404, '(Special Page) Add Right to Admin Type Page', 'manage_admin_type', 3, 'admin_type_manage.php,admin_type_crud.php,admin_type_get_ajax.php', 1, 0, '2017-04-25 12:15:52', 1, 0, '', '', '2017-04-25 12:15:52', ''),
(405, 'Pages', 'app_pages', 3, 'manage_page_table.php,ajax_get_page_table.php,add_page_table.php', 1, 0, '2017-04-25 12:17:05', 1, 0, '', '', '2017-04-25 12:17:05', ''),
(406, 'Admins', 'page_admin', 3, 'system_user_manage.php,system_user_get_ajax.php,syatem_user_crud.php', 1, 0, '2017-04-25 12:26:18', 1, 0, '', '', '2017-04-25 12:26:18', ''),
(479, 'user page', 'page_user', 3, 'user_crud.php,user_get_ajax.php,user_manage.php', 1, 0, '2019-10-02 13:01:43', 1, 0, NULL, NULL, NULL, NULL),
(492, 'Banner Page', 'page_banner', 3, 'banner_manage.php,banner_crud.php,banner_get_ajax.php', 1, 0, '2022-08-18 18:26:15', 1, 0, NULL, NULL, NULL, NULL),
(506, 'Settings Page', 'page_settings', 3, 'settings_manage.php,settings_crud.php,settings_get_ajax.php', 1, 0, '2022-08-30 12:59:52', 1, 0, NULL, NULL, NULL, NULL),
(507, 'Gallery Page', 'page_gallery', 3, 'gallery_manage.php,gallery_crud.php,gallery_get_ajax.php', 1, 1, '2022-09-01 12:22:34', 1, 0, NULL, NULL, NULL, NULL),
(508, 'Inquiry Page', 'page_inquiry', 3, 'inquiry_get_ajax.php,inquiry_crud.php,inquiry_manage.php', 1, 0, '2022-09-07 11:10:58', 1, 0, NULL, NULL, NULL, NULL),
(509, 'Department Page', 'page_department', 3, 'department_manage.php,department_crud.php,department_get_ajax.php', 1, 0, '2022-09-08 10:07:20', 1, 0, NULL, NULL, NULL, NULL),
(510, 'Faq Page', 'page_faq', 3, 'faq_manage.php,faq_crud.php,faq_get_ajax.php', 1, 0, '2022-09-08 10:07:55', 1, 0, NULL, NULL, NULL, NULL),
(511, 'Query Page', 'page_query', 3, 'query_manage.php,query_get_Ajax.php,query_crud.php', 1, 0, '2022-09-30 10:05:28', 1, 0, NULL, NULL, NULL, NULL),
(512, 'Plan Page', 'page_plan', 3, 'plan_Crud.php,plan_get_ajax.php,plan_manage.php', 1, 0, '2022-09-30 10:08:23', 1, 0, NULL, NULL, NULL, NULL),
(513, 'Subsciption Page', 'page_subscription', 3, 'subscription_manage.php,subscription_crud.php,subscription_get_ajax.php', 1, 0, '2022-09-30 10:10:48', 1, 0, NULL, NULL, NULL, NULL),
(514, 'Vendor Page', 'page_vendor', 3, 'vendor_manage.php,vendor_crud.php,vendor_get_ajax.php', 1, 0, '2022-12-14 15:50:05', 1, 0, NULL, NULL, NULL, NULL),
(515, 'Nearby Location Page', 'page_nearby_location', 3, 'nearby_location_manage.php,nearby_location_crud.php,nearby_location_get_ajax.php', 1, 0, '2022-12-14 15:51:26', 1, 0, NULL, NULL, NULL, NULL),
(516, 'Terms Page', 'page_terms', 3, 'terms_manage.php,terms_crud.php,terms_get_ajax.php', 1, 0, '2022-12-14 15:53:04', 1, 0, NULL, NULL, NULL, NULL),
(517, 'Category Page', 'page_category', 3, 'category_manage.php,category_get_ajax.php4,category_crud.php', 1, 1, '2023-02-22 11:18:15', 1, 0, NULL, NULL, NULL, NULL),
(518, 'Popup Page', 'page_popup', 3, 'popup_manage.php,popup_get_ajax.php,popup_crud.php', 1, 0, '2023-02-22 14:47:51', 1, 0, NULL, NULL, NULL, NULL),
(520, 'Product Page', 'page_product', 3, 'page_crud.php,product_get_ajax.php,product_manage.php', 1, 0, '2023-02-23 12:36:26', 1, 0, NULL, NULL, NULL, NULL),
(521, 'Gallery Page', 'page_gallery', 3, 'gallery_manage.php,gallery_get_ajax.php,gallery_crud.php', 1, 0, '2023-02-23 19:10:34', 1, 0, NULL, NULL, NULL, NULL),
(522, 'Blog Page', 'page_blog', 3, 'blog_get_ajax.php,blog_crud.php,blog_manage.php', 1, 0, '2023-02-24 14:46:22', 1, 0, NULL, NULL, NULL, NULL),
(523, 'UserInquiry Page', 'page_userinquiry', 3, 'userinquiry_get_ajax.php,userinquiry_crud.php,userinquiry_manage.php', 1, 0, '2023-03-13 12:36:55', 1, 0, NULL, NULL, NULL, NULL),
(525, 'category Page', 'page_category', 3, 'category_crud.php,category_get_ajax.php,category_manage.php', 1, 0, '2023-08-02 12:36:49', 1, 0, NULL, NULL, NULL, NULL),
(526, 'Brand Page', 'page_brand', 3, 'brand_crud.php,brand_get_ajax.php,brand_manage.php', 1, 0, '2023-08-02 14:46:18', 1, 0, NULL, NULL, NULL, NULL),
(527, 'Modal Page', 'page_modal', 3, 'modal_crud.php,modal_get_ajax.php,modal_manage.php', 1, 0, '2023-08-02 15:52:53', 1, 0, NULL, NULL, NULL, NULL),
(528, 'Device_problem Page', 'page_device_problem', 3, 'device_problem_crud.php,device_problem_get_ajax.php,device_problem_manage.php', 1, 0, '2023-08-03 12:01:02', 1, 0, NULL, NULL, NULL, NULL),
(529, 'Offer Page', 'page_offer', 3, 'offers_crud,offers_get_ajax,offers_manage', 1, 0, '2023-09-29 15:31:05', 1, 0, NULL, NULL, NULL, NULL),
(530, 'Sub_device_problem Page', 'page_sub_device_problem', 3, 'sub_device_problem_crud.php,sub_device_problem_get_ajax.php,sub_device_problem_manage.php', 1, 0, '2023-12-18 10:36:52', 1, 0, NULL, NULL, NULL, NULL),
(531, 'Orders Page', 'page_orders', 3, 'orders_get_ajax,orders_manage,orders_crud', 1, 0, '2024-01-24 15:46:49', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ltime` datetime DEFAULT NULL,
  `attempts` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `adate` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT 1,
  `created_by_type` int(11) DEFAULT 0,
  `modified_by` text DEFAULT NULL,
  `modified_by_type` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_device_problem`
--

CREATE TABLE `sub_device_problem` (
  `id` int(11) NOT NULL,
  `device_problem_id` int(11) DEFAULT NULL,
  `device_problem_type_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(255) DEFAULT NULL,
  `modal_id` int(255) DEFAULT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_device_problem`
--

INSERT INTO `sub_device_problem` (`id`, `device_problem_id`, `device_problem_type_id`, `amount`, `category_id`, `brand_id`, `modal_id`, `isDelete`, `isActive`, `created_date`) VALUES
(25, 39, 1, 100, NULL, NULL, NULL, 0, 1, '2024-02-06 07:13:34'),
(28, 42, 1, 150, NULL, NULL, NULL, 0, 1, '2024-02-06 07:44:07'),
(31, 39, 2, 200, NULL, NULL, NULL, 0, 1, '2024-02-06 09:17:51'),
(32, 39, 3, 300, NULL, NULL, NULL, 0, 1, '2024-02-06 09:18:13'),
(33, 42, 2, 350, NULL, NULL, NULL, 0, 1, '2024-02-06 09:28:15'),
(34, 43, 1, 400, NULL, NULL, NULL, 0, 1, '2024-02-06 09:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_path` text NOT NULL,
  `reset_token` varchar(500) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `device_type` tinyint(11) NOT NULL DEFAULT 0 COMMENT '0=android,1=ios',
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `phone`, `password`, `image_path`, `reset_token`, `device_token`, `device_type`, `isDelete`, `isActive`, `last_login`, `created_date`) VALUES
(147, 'makwana kanaiya', 'makwanajaydip153@gmail.com', '9723037928', '827ccb0eea8a706c4c34a16891f84e7b', 'user_profile_26b4d7.jpg', '48aacabf3f649d4eac2191f0689f7832703d20a13506838f7bd8c3d2aad9b5a2', '', 0, 0, 1, '2023-10-30 11:22:19', '2023-12-12 10:56:46'),
(149, 'demo', 'demo@gmail.com', '8866079842', 'e10adc3949ba59abbe56e057f20f883e', 'user_image_209284.jpg', NULL, '4eae35e4000d4b4a', 0, 0, 1, '2023-11-01 16:22:47', '2023-11-01 16:22:47'),
(150, 'makwana', 'makwana@gmail.com', '9999999999', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, '', 0, 0, 1, '2023-11-02 11:12:55', '2023-11-02 11:12:55'),
(151, '', '', '', '827ccb0eea8a706c4c34a16891f84e7b', 'user_image_9e36db.jpg', NULL, NULL, 0, 0, 1, '2023-11-21 14:50:06', '2023-11-21 14:50:06'),
(152, 'demo15sdfsd', 'sdsdasdd@yopmail.com', '1234567890', '86f95d28663acdfa55d2c8ed6beb9445', '', NULL, NULL, 0, 0, 1, '2023-12-07 19:22:26', '2023-12-07 19:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address`, `zipcode`, `isDelete`, `isActive`, `created_date`) VALUES
(75, 147, 'SANTORINI SQUARE, Prernatirth Derasar Rd, near Abhishree Complex, Jodhpur Village, Ahmedabad, Gujarat 380015', '380015', 0, 1, '2023-10-30 09:27:15'),
(76, 149, 'Ahmedabad', '380015', 0, 1, '2023-11-01 10:53:13'),
(77, 150, 'surat gujarat', '380001', 0, 1, '2023-11-02 05:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_device_problem`
--

CREATE TABLE `user_device_problem` (
  `id` int(11) NOT NULL,
  `device_probem_id` int(11) NOT NULL,
  `sub_device_problem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_device_problem`
--

INSERT INTO `user_device_problem` (`id`, `device_probem_id`, `sub_device_problem_id`, `user_id`, `vendor_id`, `order_id`, `isActive`, `isDelete`, `created_date`) VALUES
(1344, 39, 31, 147, 120, 605, 1, 0, '2024-02-07 05:14:33'),
(1345, 42, 28, 147, 120, 605, 1, 0, '2024-02-07 05:14:33'),
(1346, 43, 34, 147, 120, 605, 1, 0, '2024-02-07 05:14:33'),
(1348, 42, 28, 147, 120, 604, 1, 0, '2024-02-07 07:45:28'),
(1353, 39, 31, 147, 120, 606, 1, 0, '2024-02-08 06:33:46'),
(1354, 39, 25, 147, 120, 607, 1, 0, '2024-03-12 05:56:43'),
(1355, 42, 28, 147, 120, 607, 1, 0, '2024-03-12 05:56:43'),
(1356, 39, 0, 149, 121, 608, 1, 0, '2024-03-18 11:50:06'),
(1357, 42, 0, 149, 121, 608, 1, 0, '2024-03-18 11:50:06'),
(1359, 39, 0, 149, 121, 609, 1, 0, '2024-03-18 11:51:33'),
(1360, 42, 0, 149, 121, 609, 1, 0, '2024-03-18 11:51:33'),
(1361, 43, 0, 149, 121, 609, 1, 0, '2024-03-18 11:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`id`, `order_id`, `user_id`, `vendor_id`, `rating`, `review`, `isDelete`, `isActive`, `created_date`) VALUES
(125, 601, 147, 120, 4, 'EWEFREWFWE', 0, 1, '2024-02-02 11:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(10) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `shop_name` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_path` text NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `device_type` tinyint(11) NOT NULL DEFAULT 0 COMMENT '0=android,1=ios',
  `reset_token` varchar(500) NOT NULL,
  `mon_fri_opentime` time NOT NULL,
  `mon_fri_closetime` time NOT NULL,
  `satur_opentime` time NOT NULL,
  `satur_closetime` time NOT NULL,
  `sun_opentime` time NOT NULL,
  `sun_closetime` time NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor_name`, `email`, `phone`, `shop_name`, `address`, `latitude`, `longitude`, `zipcode`, `password`, `image_path`, `device_token`, `device_type`, `reset_token`, `mon_fri_opentime`, `mon_fri_closetime`, `satur_opentime`, `satur_closetime`, `sun_opentime`, `sun_closetime`, `isDelete`, `isActive`, `last_login`, `created_date`) VALUES
(120, 'makwana jaydip', 'jaydip.tritechno@gmail.com', '9924638285', 'jaydip mobile repair', 'ahmedabad', 23.0216238, 72.5797068, '380001', '827ccb0eea8a706c4c34a16891f84e7b', 'vendor_profile_4cf63e.jpg', '', 0, '', '02:00:00', '09:00:00', '10:00:00', '05:00:00', '10:00:00', '05:00:00', 0, 1, '2023-10-30 11:14:26', '2024-02-02 17:23:17'),
(121, 'Tri Fixing', 'tri_fixing@yopmail.com', '9638076248', 'trifixing mobile repair 1', 'Ahmedabad', 23.022505, 72.5713621, '380015', 'e10adc3949ba59abbe56e057f20f883e', '', '4eae35e4000d4b4a', 0, '', '18:10:00', '17:20:00', '18:20:00', '19:20:00', '20:20:00', '21:20:00', 0, 1, '2023-11-01 16:20:02', '2023-11-01 16:20:02'),
(122, 'bha', 'bha@gmail.com', '9876543210', 'bha mobile repair', 'ahmedabad', 23.0216238, 72.5797068, '', '827ccb0eea8a706c4c34a16891f84e7b', 'vendor_profile_191e7e.jpg', '', 0, '', '01:00:00', '05:03:00', '02:04:00', '06:06:00', '01:00:00', '05:00:00', 0, 1, '2023-11-29 12:39:08', '2023-11-29 13:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_review`
--

CREATE TABLE `vendor_review` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  `isDelete` tinyint(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_type`
--
ALTER TABLE `admin_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_login`
--
ALTER TABLE `application_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_problem`
--
ALTER TABLE `device_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_problem_type`
--
ALTER TABLE `device_problem_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_problem_image`
--
ALTER TABLE `order_problem_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_admin_right`
--
ALTER TABLE `page_admin_right`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_table`
--
ALTER TABLE `page_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_device_problem`
--
ALTER TABLE `sub_device_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_device_problem`
--
ALTER TABLE `user_device_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_review`
--
ALTER TABLE `vendor_review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application_login`
--
ALTER TABLE `application_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `device_problem`
--
ALTER TABLE `device_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `device_problem_type`
--
ALTER TABLE `device_problem_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modal`
--
ALTER TABLE `modal`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2135;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `order_problem_image`
--
ALTER TABLE `order_problem_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1300;

--
-- AUTO_INCREMENT for table `page_admin_right`
--
ALTER TABLE `page_admin_right`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `page_table`
--
ALTER TABLE `page_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=532;

--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_device_problem`
--
ALTER TABLE `sub_device_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user_device_problem`
--
ALTER TABLE `user_device_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1362;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `vendor_review`
--
ALTER TABLE `vendor_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
