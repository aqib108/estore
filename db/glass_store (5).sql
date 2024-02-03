-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2024 at 11:34 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glass_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `role_id` int DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origional_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `first_name`, `last_name`, `title`, `email`, `phone`, `password`, `origional_password`, `remember_token`, `dob`, `profile`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Super', 'Admin', 'admi', 'admin@admin.com', '34334', '$2y$10$zHm1D5gWHsuMhwM9icwXKeTe5eWxGU5RQ2qmFVysjGCVm6Xs8auRa', '12345678', 'DF78UioSy0d3u4KuqJpxJEUbi8MURYxSRcMmW7vymtTRYwH2K02ufCIB0CgA', NULL, 'images/profile/profile1706018053.jpg', 1, NULL, '2024-01-23 12:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'شطب', NULL, '<p>Hello glass 1</p>', 1, '2024-01-23 10:44:50', '2024-01-27 02:14:39'),
(2, 'دوبل فيتراج', NULL, '<p>A1 glass category</p>', 1, '2024-01-23 10:49:38', '2024-01-27 02:15:55'),
(3, 'جلخ', NULL, '<p>hrlki</p>', 1, '2024-01-23 12:31:24', '2024-01-27 02:16:42'),
(4, 'شطب', NULL, '<p>Test</p>', 1, '2024-01-24 12:36:43', '2024-01-27 02:17:22'),
(5, 'Securit', NULL, '<p>Securit category</p>', 1, '2024-01-27 01:08:24', '2024-01-27 01:08:24'),
(6, 'Securit Accessory', NULL, '<p>Securit Accessory category<br></p>', 1, '2024-01-27 01:09:45', '2024-01-27 01:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `email`, `description`, `created_at`, `updated_at`) VALUES
(1, 'aqib.mehmood@manafatech.com', 'hello', '2024-01-27 14:53:33', '2024-01-27 14:53:33'),
(2, 'aqib.mehmood@manafatech.com', 'dd', '2024-01-27 14:54:57', '2024-01-27 14:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_bookings`
--

CREATE TABLE `issue_bookings` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issue_bookings`
--

INSERT INTO `issue_bookings` (`id`, `name`, `phone`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dfds', 'dsdfedf', 'feefeq', NULL, '2024-01-26 14:55:55', '2024-01-26 14:55:55'),
(2, 'aqib', '03067728835', 'Test kocatun', 'dfsd', '2024-01-27 14:59:44', '2024-01-27 14:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `is_feature` int NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  `tax` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `sku`, `description`, `status`, `is_feature`, `price`, `tax`, `discount`, `created_at`, `updated_at`) VALUES
(5, 'Securit Accessory', 'OFFER-1706110853', '<p>Test Offer</p>', 1, 1, 1000, 0, 0, '2024-01-24 10:40:53', '2024-01-27 01:52:54'),
(7, 'ChamFering', 'OFFER-1706338413', '<p>ChamFering</p>', 1, 1, 85, 0, 0, '2024-01-27 01:53:33', '2024-01-27 01:53:33'),
(8, 'Securit', 'OFFER-1706338512', '<p>Securit</p>', 1, 1, 90, 0, 0, '2024-01-27 01:55:12', '2024-01-27 01:55:12'),
(9, 'New Year Offer', 'OFFER-1706940229', '<p>Hello new year offer</p>', 1, 1, 120, 3, 5, '2024-02-03 01:03:49', '2024-02-03 01:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `offer_images`
--

CREATE TABLE `offer_images` (
  `id` int NOT NULL,
  `offer_id` int NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offer_images`
--

INSERT INTO `offer_images` (`id`, `offer_id`, `file_name`, `file_type`, `created_at`, `updated_at`) VALUES
(10, 9, 'images/offer-images/offer170694022965bdd74512287.jpg', 'jpg', '2024-02-03 01:03:49', '2024-02-03 01:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `billing_city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country_id` int DEFAULT NULL,
  `shipping_city_id` int DEFAULT NULL,
  `shipping_country_id` int DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=pending,2=shipped,3=completed',
  `is_billing_address_is_shipping` tinyint NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_city`, `billing_country_id`, `shipping_city_id`, `shipping_country_id`, `ip`, `receipt`, `billing_user_name`, `billing_email`, `billing_phone_number`, `billing_address`, `shipping_user_name`, `shipping_email`, `shipping_phone_number`, `shipping_address`, `shipment_amount`, `sub_total`, `grand_total`, `order_comment`, `status`, `is_billing_address_is_shipping`, `created_at`, `updated_at`) VALUES
(31, 3, 'Lahore', NULL, NULL, NULL, NULL, NULL, 'aqib', 'aqib.mehmood@manafatech.com', '0302929299', 'Lahore gourmant road', NULL, NULL, NULL, NULL, NULL, '90', '100', 'Please delivered on time', 1, 0, '2024-01-27 03:37:50', '2024-01-27 03:37:50'),
(32, 3, 'Lahore', NULL, NULL, NULL, NULL, NULL, 'aqib', 'aqib.mehmood@manafatech.com', '09287734455', 'Lahore gullberg', NULL, NULL, NULL, NULL, NULL, '40', '40', 'Hello its orer', 2, 0, '2024-01-27 13:23:07', '2024-01-27 13:23:07'),
(33, 3, 'Lahore', NULL, NULL, NULL, NULL, NULL, 'aqib', 'aqib.mehmood@manafatech.com', '0393993339', 'Lahore libarty', NULL, NULL, NULL, NULL, NULL, '270', '270', NULL, 3, 0, '2024-01-27 13:27:04', '2024-01-27 13:27:04'),
(34, 4, 'lahore', NULL, NULL, NULL, NULL, NULL, 'aqib mehmood', 'aqib.mehmood@manafatech.com', '022333333', 'Lahore libarty', NULL, NULL, NULL, NULL, NULL, '235.2', '235.2', 'sas', 1, 0, '2024-02-03 01:21:09', '2024-02-03 01:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit_price` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `order_type` tinyint NOT NULL DEFAULT '0' COMMENT '1=product,2=offer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `ip`, `user_id`, `product_id`, `quantity`, `unit_price`, `total`, `order_type`, `created_at`, `updated_at`) VALUES
(41, 30, NULL, 4, 3, 3, 100, 300, 1, '2024-01-26 19:16:53', '2024-01-26 19:16:53'),
(42, 30, NULL, 4, 7, 3, 20, 60, 1, '2024-01-26 19:16:53', '2024-01-26 19:16:53'),
(43, 31, NULL, 3, 3, 2, 100, 200, 1, '2024-01-27 03:37:50', '2024-01-27 03:37:50'),
(44, 31, NULL, 3, 5, 2, 1000, 2000, 2, '2024-01-27 03:37:50', '2024-01-27 03:37:50'),
(45, 31, NULL, 3, 4, 1, 100, 100, 1, '2024-01-27 03:37:50', '2024-01-27 03:37:50'),
(46, 32, NULL, 3, 6, 2, 20, 40, 1, '2024-01-27 13:23:07', '2024-01-27 13:23:07'),
(47, 33, NULL, 3, 8, 3, 90, 270, 2, '2024-01-27 13:27:04', '2024-01-27 13:27:04'),
(48, 34, NULL, 4, 9, 2, 118, 235, 2, '2024-02-03 01:21:09', '2024-02-03 01:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `tax` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `product_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `is_feature` int NOT NULL DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `sku`, `price`, `tax`, `discount`, `product_images`, `status`, `is_feature`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'الأنصار', '<font color=\"#b2b2b2\" face=\"Poppins-Regular\"><span style=\"font-size: 18px; background-color: rgb(34, 34, 34);\">hello</span></font>', 'testku-12', 100, 5, 2, NULL, 1, 1, 1, '2024-01-24 05:15:17', '2024-02-03 00:11:28'),
(4, 'aqib', 'sdjajf', 'Pro-1706096728', 100, 1, 2, NULL, 1, 1, 3, '2024-01-24 06:45:28', '2024-01-24 07:00:07'),
(5, 'Azy', '<p><span style=\"color: rgb(136, 136, 136); font-family: Poppins-Regular; font-size: 14px;\">Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</span></p>', 'PRO-1706106905', 2000, 0, 0, NULL, 1, 1, 2, '2024-01-24 09:35:05', '2024-02-03 00:22:00'),
(6, 'test', '<p>xccd</p>', 'PRO-1706108544', 20, 0, 0, NULL, 1, 1, 2, '2024-01-24 10:02:24', '2024-02-03 00:21:58'),
(7, 'Test Produc6', '<p><span style=\"color: rgb(136, 136, 136); font-family: Poppins-Regular; font-size: 14px;\">Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</span></p>', 'PRO-1706110622', 20, 0, 0, NULL, 1, 1, 2, '2024-01-24 10:37:02', '2024-02-03 00:21:55'),
(8, 'معجم الرياض للغة العربية المعاصرة', '<p><span style=\"color: rgb(0, 0, 204); font-family: &quot;Times New Roman&quot;, Arial; font-size: 19.2px; text-indent: -16px;\">معجم الرياض للغة العربية المعاصرة</span></p>', 'PRO-1706937648', 230, 7, 10, NULL, 1, 1, 2, '2024-02-03 00:20:48', '2024-02-03 00:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `file_type`, `file_name`, `created_at`, `updated_at`) VALUES
(23, 8, 'jpg', 'images/products-images/product170693767565bdcd4b8f6c8.jpg', '2024-02-03 00:21:15', '2024-02-03 00:21:15'),
(24, 8, 'jpg', 'images/products-images/product170693767565bdcd4b8fa28.jpg', '2024-02-03 00:21:15', '2024-02-03 00:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `right_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `right_ids`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'admin', NULL, 1, NULL, '2022-11-20 06:24:47', '2022-11-20 06:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `option_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_name`, `option_value`) VALUES
(17, 'title', 'Creative Glass'),
(18, 'email', 'aliossman@hotmail.com'),
(19, 'phone', '0383182778819132'),
(20, 'whatsapp', '0383182778819132'),
(21, 'about_en', 'We devotedly operate with a synergistic approach and core of setting a benchmark of excellence and perfection in providing enterprise-grade custom software solutions to meet your digital branding needs in any industry.'),
(22, 'about_ur', 'Ú©Ø³ÛŒ Ø¨Ú¾ÛŒ ØµÙ†Ø¹Øª Ù…ÛŒÚº Ø¢Ù¾ Ú©ÛŒ ÚˆÛŒØ¬ÛŒÙ¹Ù„ Ø¨Ø±Ø§Ù†ÚˆÙ†Ú¯ Ú©ÛŒ Ø¶Ø±ÙˆØ±ÛŒØ§Øª Ú©Ùˆ Ù¾ÙˆØ±Ø§ Ú©Ø±Ù†Û’ Ú©Û’ Ù„ÛŒÛ’ Ø§Ù†Ù¹Ø±Ù¾Ø±Ø§Ø¦Ø² Ú¯Ø±ÛŒÚˆ Ú©Ø³Ù¹Ù… Ø³ÙˆÙÙ¹ ÙˆÛŒØ¦Ø± Ú©Û’ Ø­Ù„ ÙØ±Ø§ÛÙ… Ú©Ø±Ù†Û’ Ù…ÛŒÚº Ø§ÛŒÚ© ÛÙ… Ø¢ÛÙ†Ú¯ÛŒ Ú©Û’ Ù†Ù‚Ø·Û Ù†Ø¸Ø± Ø§ÙˆØ± Ø¹Ù…Ø¯Ú¯ÛŒ Ø§ÙˆØ± Ú©Ù…Ø§Ù„ Ú©Ø§ Ù…Ø¹ÛŒØ§Ø± Ù‚Ø§Ø¦Ù… Ú©Ø±Ù†Û’ Ú©Û’ Ù„ÛŒÛ’ Ù„Ú¯Ù† Ø³Û’ Ú©Ø§Ù… Ú©Ø±ÛŒÚºÛ”'),
(23, 'about_ar', 'ØªØ¹Ù…Ù„ e Ø¨ØªÙƒØ±ÙŠØ³ Ù…Ø¹ Ù†Ù‡Ø¬ ØªØ¢Ø²Ø±ÙŠ ÙˆØ¬ÙˆÙ‡Ø± Ù„ÙˆØ¶Ø¹ Ù…Ø¹ÙŠØ§Ø± Ù„Ù„ØªÙ…ÙŠØ² ÙˆØ§Ù„ÙƒÙ…Ø§Ù„ ÙÙŠ ØªÙˆÙÙŠØ± Ø­Ù„ÙˆÙ„ Ø¨Ø±Ù…Ø¬ÙŠØ© Ù…Ø®ØµØµØ© Ø¹Ù„Ù‰ Ù…Ø³ØªÙˆÙ‰ Ø§Ù„Ù…Ø¤Ø³Ø³Ø§Øª Ù„ØªÙ„Ø¨ÙŠØ© Ø§Ø­ØªÙŠØ§Ø¬Ø§Øª Ø¹Ù„Ø§Ù…ØªÙƒ Ø§Ù„ØªØ¬Ø§Ø±ÙŠØ© Ø§Ù„Ø±Ù‚Ù…ÙŠØ© ÙÙŠ Ø£ÙŠ ØµÙ†Ø§Ø¹Ø©.'),
(24, 'opening_time', '23:15'),
(25, 'play_store', 'https://www.fimysi.us'),
(26, 'app_store', 'https://www.fimysi.us'),
(27, 'facebook', 'https://www.jozujiko.com'),
(28, 'linkedin', 'https://www.subinofu.cm'),
(29, 'pinterest', 'https://www.kofyluqewesyxub.co.uk'),
(30, 'twitter', 'https://www.qizifecoky.info'),
(31, 'youtube', 'https://www.fimysi.us'),
(32, 'logo', 'images/logo/logo1706386105.jpg'),
(33, 'video', 'videos/video/video1671134562.mp4'),
(34, 'location_1', 'البقاع - الأنصار - الشارع الرئيسي'),
(35, 'location_2', NULL),
(36, 'about', NULL),
(37, 'shipping_charges', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `name` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci,
  `image` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `slider_logo` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` blob,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `slider_logo`, `content`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Accessary Glass', 'images/slider/slider1706912050.webp', NULL, NULL, 1, '2024-02-02 12:14:10', '2024-02-02 23:43:01'),
(13, 'Mirror New-Season', 'images/slider/slider1706912084.webp', NULL, NULL, 1, '2024-02-02 12:14:44', '2024-02-02 12:14:44'),
(14, 'Glass Collection 2024', 'images/slider/slider1706912142.webp', NULL, NULL, 1, '2024-02-02 12:15:42', '2024-02-02 23:42:41'),
(15, 'New Session', 'images/slider/slider1706935311.webp', NULL, NULL, 1, '2024-02-02 23:41:51', '2024-02-02 23:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `origional_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=in-active,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `origional_password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', NULL, '$2a$12$MO337APKd3z0hz11OE5P5O40lxZg6IW9cHAfsvDVWW7tflTm/DLBe', NULL, '3nwO0yZHQBupjiPojukO0eFQPvrBycTyFrRM10QDXptVgxRmj7ue1U7bbttE', 1, '2022-11-20 06:20:09', '2022-11-20 06:20:09'),
(3, 'aqib123', 'aqib.mehmood@manafatech.com', NULL, '$2y$10$cmLq5Duc9s/hnl4efX9BZuponDg5Ve3yKR11k3XoZ74t0vcGUv.8S', NULL, NULL, 0, '2024-01-26 06:31:31', '2024-01-27 14:35:49'),
(4, 'aqib mehmood', 'aqib@test.com', NULL, '$2y$10$HGTxIvigValwZrU0rfYW0eDLfqBB3XGebA9Ek0DNZJ7uPky47RnD.', NULL, NULL, 0, '2024-02-03 01:13:41', '2024-02-03 01:13:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issue_bookings`
--
ALTER TABLE `issue_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_images`
--
ALTER TABLE `offer_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_billing_city_id_index` (`billing_city`),
  ADD KEY `orders_billing_country_id_index` (`billing_country_id`),
  ADD KEY `orders_shipping_city_id_index` (`shipping_city_id`),
  ADD KEY `orders_shipping_country_id_index` (`shipping_country_id`),
  ADD KEY `orders_ip_index` (`ip`),
  ADD KEY `orders_receipt_index` (`receipt`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `order_items_order_id_index` (`order_id`) USING BTREE,
  ADD KEY `order_items_ip_index` (`ip`) USING BTREE,
  ADD KEY `order_items_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `order_items_product_id_index` (`product_id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_bookings`
--
ALTER TABLE `issue_bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offer_images`
--
ALTER TABLE `offer_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
