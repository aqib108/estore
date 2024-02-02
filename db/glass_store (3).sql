-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2024 at 10:34 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.21

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
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origional_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
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
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Glass1', NULL, '<p>Hello glass 1</p>', 1, '2024-01-23 10:44:50', '2024-01-23 10:44:50'),
(2, 'fibar glass', NULL, '<p>A1 glass category</p>', 1, '2024-01-23 10:49:38', '2024-01-23 10:49:38'),
(3, 'fibr 21', NULL, '<p>hrlki</p>', 1, '2024-01-23 12:31:24', '2024-01-23 12:31:38'),
(4, 'Fibar optic', NULL, '<p>Test</p>', 1, '2024-01-24 12:36:43', '2024-01-24 12:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_bookings`
--

CREATE TABLE `issue_bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_bookings`
--

INSERT INTO `issue_bookings` (`id`, `name`, `phone`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dfds', 'dsdfedf', 'feefeq', NULL, '2024-01-26 14:55:55', '2024-01-26 14:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_feature` int(11) NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `sku`, `description`, `status`, `is_feature`, `price`, `created_at`, `updated_at`) VALUES
(4, 'Test offer', 'OFFER-1706109819', '<p>Test offer</p>', 1, 1, 20, '2024-01-24 10:23:39', '2024-01-24 10:23:39'),
(5, 'Test Offer 1', 'OFFER-1706110853', '<p>Test Offer</p>', 1, 1, 1000, '2024-01-24 10:40:53', '2024-01-24 10:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `offer_images`
--

CREATE TABLE `offer_images` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_images`
--

INSERT INTO `offer_images` (`id`, `offer_id`, `file_name`, `file_type`, `created_at`, `updated_at`) VALUES
(5, 4, 'images/offer-images/offer170629384265b3fa52578da.jpg', 'jpg', '2024-01-26 13:30:42', '2024-01-26 13:30:42'),
(6, 5, 'images/offer-images/offer170629388065b3fa781405e.jpg', 'jpg', '2024-01-26 13:31:20', '2024-01-26 13:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `billing_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country_id` int(11) DEFAULT NULL,
  `shipping_city_id` int(11) DEFAULT NULL,
  `shipping_country_id` int(11) DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_comment` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending,2=shipped,3=completed',
  `is_billing_address_is_shipping` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_city`, `billing_country_id`, `shipping_city_id`, `shipping_country_id`, `ip`, `receipt`, `billing_user_name`, `billing_email`, `billing_phone_number`, `billing_address`, `shipping_user_name`, `shipping_email`, `shipping_phone_number`, `shipping_address`, `shipment_amount`, `sub_total`, `grand_total`, `order_comment`, `status`, `is_billing_address_is_shipping`, `created_at`, `updated_at`) VALUES
(30, 4, 'Lahore', NULL, NULL, NULL, NULL, NULL, 'Muhammad Shahbaz', 'shahbaz.lgu@gmail.com', '0324234324', 'Lahore Punjab', NULL, NULL, NULL, NULL, NULL, '800', '800', 'My Order', 3, 0, '2024-01-26 19:16:53', '2024-01-27 04:27:47'),
(31, 4, 'Lahore', NULL, NULL, NULL, NULL, NULL, 'Muhammad Shahbaz', 'shahbaz.lgu@gmail.com', '0324234324', 'Lahore Punjab', NULL, NULL, NULL, NULL, NULL, '1000', '1000', 'my order 2', 3, 0, '2024-01-27 03:39:07', '2024-01-27 04:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `order_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=product,2=offer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `ip`, `user_id`, `product_id`, `quantity`, `unit_price`, `total`, `order_type`, `created_at`, `updated_at`) VALUES
(41, 30, NULL, 4, 3, 3, 100, 300, 1, '2024-01-26 19:16:53', '2024-01-26 19:16:53'),
(42, 30, NULL, 4, 7, 3, 20, 60, 1, '2024-01-26 19:16:53', '2024-01-26 19:16:53'),
(43, 31, NULL, 4, 5, 1, 1000, 1000, 2, '2024-01-27 03:39:07', '2024-01-27 03:39:07');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `product_images` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_feature` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `sku`, `price`, `product_images`, `status`, `is_feature`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'hello 123', 'best quailtuy', 'testku-12', 100, NULL, 1, 1, 1, '2024-01-24 05:15:17', '2024-01-24 07:03:41'),
(4, 'aqib', 'sdjajf', 'Pro-1706096728', 100, NULL, 1, 1, 3, '2024-01-24 06:45:28', '2024-01-24 07:00:07'),
(5, 'Azy', '<p><span style=\"color: rgb(136, 136, 136); font-family: Poppins-Regular; font-size: 14px;\">Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</span></p>', 'PRO-1706106905', 2000, NULL, 1, 0, 2, '2024-01-24 09:35:05', '2024-01-25 12:01:29'),
(6, 'test', '<p>xccd</p>', 'PRO-1706108544', 20, NULL, 1, 0, 2, '2024-01-24 10:02:24', '2024-01-24 10:02:24'),
(7, 'Test Produc6', '<p><span style=\"color: rgb(136, 136, 136); font-family: Poppins-Regular; font-size: 14px;\">Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</span></p>', 'PRO-1706110622', 20, NULL, 1, 0, 2, '2024-01-24 10:37:02', '2024-01-25 05:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `file_type`, `file_name`, `created_at`, `updated_at`) VALUES
(9, 7, 'jpg', 'images/products-images/product170611062265b12e9ed7059.jpg', '2024-01-24 10:37:02', '2024-01-24 10:37:02'),
(10, 7, 'jpg', 'images/products-images/product170611062265b12e9ed73d2.jpg', '2024-01-24 10:37:02', '2024-01-24 10:37:02'),
(11, 7, 'jpg', 'images/products-images/product170611070465b12ef001041.jpg', '2024-01-24 10:38:24', '2024-01-24 10:38:24'),
(17, 6, 'jpg', 'images/products-images/product170619716265b280aabe416.jpg', '2024-01-25 10:39:22', '2024-01-25 10:39:22'),
(18, 3, 'jpg', 'images/products-images/product170619718365b280bfe1baf.jpg', '2024-01-25 10:39:43', '2024-01-25 10:39:43'),
(19, 4, 'jpg', 'images/products-images/product170619720365b280d38c6b1.jpg', '2024-01-25 10:40:03', '2024-01-25 10:40:03'),
(20, 5, 'jpg', 'images/products-images/product170620208965b293e9de961.jpg', '2024-01-25 12:01:29', '2024-01-25 12:01:29'),
(21, 5, 'jpg', 'images/products-images/product170620208965b293e9dee85.jpg', '2024-01-25 12:01:29', '2024-01-25 12:01:29'),
(22, 5, 'jpg', 'images/products-images/product170620208965b293e9df2bc.jpg', '2024-01-25 12:01:29', '2024-01-25 12:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `right_ids` text COLLATE utf8mb4_unicode_ci,
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
  `id` int(11) NOT NULL,
  `option_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_name`, `option_value`) VALUES
(17, 'title', 'Halqa Noor Ul Iman'),
(18, 'email', 'Info@halqanooruliman.com'),
(19, 'phone', '(+18) 001234567_'),
(20, 'whatsapp', '(+18) 001234567_'),
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
(32, 'logo', 'images/logo/logo1670782560.png'),
(33, 'video', 'videos/video/video1671134562.mp4'),
(34, 'location_1', NULL),
(35, 'location_2', NULL),
(36, 'about', NULL),
(37, 'shipping_charges', '20');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf32_unicode_ci,
  `image` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `slider_logo` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` blob,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `slider_logo`, `content`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Fibaric Collection 2018', 'images/slider/slider1706912050.webp', NULL, NULL, 1, '2024-02-02 17:14:10', '2024-02-02 17:14:10'),
(13, 'Mirror New-Season', 'images/slider/slider1706912084.webp', NULL, NULL, 1, '2024-02-02 17:14:44', '2024-02-02 17:14:44'),
(14, 'Glass Collection 2018', 'images/slider/slider1706912142.webp', NULL, NULL, 1, '2024-02-02 17:15:42', '2024-02-02 17:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origional_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=in-active,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `origional_password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', NULL, '$2a$12$MO337APKd3z0hz11OE5P5O40lxZg6IW9cHAfsvDVWW7tflTm/DLBe', NULL, '3nwO0yZHQBupjiPojukO0eFQPvrBycTyFrRM10QDXptVgxRmj7ue1U7bbttE', 1, '2022-11-20 06:20:09', '2022-11-20 06:20:09'),
(3, 'aqib', 'aqib.mehmood@manafatech.com', NULL, '$2y$10$cmLq5Duc9s/hnl4efX9BZuponDg5Ve3yKR11k3XoZ74t0vcGUv.8S', NULL, NULL, 0, '2024-01-26 06:31:31', '2024-01-26 06:31:31'),
(4, 'Muhammad Shahbaz', 'shahbaz.lgu@gmail.com', NULL, '$2y$10$nbyWDLKgvFzDagdo03Zol.Nn7OCBonAtX5nOcP8Tv5Pwetmox0q6i', NULL, NULL, 0, '2024-01-26 16:14:23', '2024-01-26 16:14:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_bookings`
--
ALTER TABLE `issue_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer_images`
--
ALTER TABLE `offer_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
