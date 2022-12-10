-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2022 at 06:51 PM
-- Server version: 5.7.33
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halqa_e_noor`
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
(2, 1, 'abcd', 'xyz', 'admi', 'admin@admin.com', '34334', '$2y$10$zHm1D5gWHsuMhwM9icwXKeTe5eWxGU5RQ2qmFVysjGCVm6Xs8auRa', '12345678', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `is_root` tinyint(4) NOT NULL DEFAULT '0',
  `in_header` tinyint(4) NOT NULL DEFAULT '0',
  `in_footer` tinyint(4) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `description` text COLLATE utf32_unicode_ci,
  `image` varchar(100) COLLATE utf32_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`, `is_root`, `in_header`, `in_footer`, `position`, `description`, `image`, `parent_id`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kessie Morris', 'Autem eaque unde acc', 0, 1, 1, 52, 'Odit dicta ducimus', NULL, NULL, 'Cupiditate iure prae', 'Corporis impedit ex', 'Culpa facilis quis', 1, '2022-11-30 13:07:29', '2022-11-30 13:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2022-11-30 13:11:55', '2022-11-30 13:11:55'),
(3, 1, 1, '2022-12-06 13:37:36', '2022-12-06 13:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `ceo_messages`
--

CREATE TABLE `ceo_messages` (
  `id` int(11) NOT NULL,
  `message_title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `message` blob,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `ceo_messages`
--

INSERT INTO `ceo_messages` (`id`, `message_title`, `image`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Consectetur pariatur', 'images/ceo-message/ceo-message1669572895.jpg', 0x7b22656e223a2251756920647563696d75732c20706c61636561742e222c227572223a2251756920647563696d75732c20706c61636561742e222c226172223a2251756920647563696d75732c20706c61636561742e227d, 1, '2022-11-27 13:09:48', '2022-11-27 13:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `system_view_status` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `course_id`, `title`, `content`, `file`, `url`, `system_view_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"en\":\"Adipisci voluptate p\",\"ur\":\"Iste optio deserunt\",\"ar\":\"Est ad animi sit e\"}', '{\"en\":\"some text here\",\"ur\":\"some text here\",\"ar\":\"some text here\"}', 'files/classess/classess1669836833.pdf', 'https://sweetalert.js.org/guides/#installation', 0, 1, '2022-11-30 14:33:53', '2022-11-30 14:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_records`
--

CREATE TABLE `contact_records` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` blob,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` blob,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `contact_records`
--

INSERT INTO `contact_records` (`id`, `email`, `name`, `message`, `subject`, `note`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mexwell050@gmail.com', 'Ahamd', 0x7364766664666766686a68676664736173646676626e6a6867666a6b6a6664, 'zxsfbcsdjbfkls', NULL, NULL, 1, '2022-09-09 15:18:09', '2022-09-09 15:18:09'),
(2, 'judo@mailinator.com', 'Lani Ingram', 0x506f7373696d757320667567612052657072, 'Incididunt vitae lab', NULL, NULL, 1, '2022-09-12 14:54:05', '2022-09-12 14:54:05'),
(4, 'qapuruty@mailinator.com', 'Wendy Love', 0x4172636869746563746f207361657065206574, 'Qui officia architec', NULL, NULL, 1, '2022-09-13 13:25:40', '2022-09-13 13:25:40'),
(5, 'mexwell050@gmail.com', 'Ahamd', 0x7a66676768676664736463, 'dffgdf', NULL, NULL, 1, '2022-09-15 11:30:34', '2022-09-15 11:30:34'),
(6, 'alihatanveer.arhamsoft@gmail.com', 'Aliha Tanveer', 0x74657374696e6720313233, 'Registration Issue', NULL, NULL, 1, '2022-09-21 14:09:20', '2022-09-21 14:09:20'),
(7, 'shahbaz.arhamsoft@gmail.com', 'Muhammad Shahbaz', 0x74726574726574, 'text', NULL, NULL, 0, '2022-09-21 19:21:38', '2022-12-06 13:35:06'),
(8, 'shahbaz.arhamsoft@gmail.com', 'Muhammad Shahbaz', 0x6572747279747279, 'text', NULL, '03174424091', 1, '2022-09-21 19:24:36', '2022-09-21 19:24:36'),
(9, 'shahbaz.arhamsoft@gmail.com', 'Muhammad Shahbaz', 0x7472797279, 'ertret', NULL, '03174424091', 1, '2022-09-21 19:26:04', '2022-09-21 19:26:04'),
(10, 'shahbaz.arhamsoft@gmail.com', 'Muhammad Shahbaz', 0x7472757475, 'reytry', NULL, '03174424091', 2, '2022-09-21 19:26:54', '2022-09-21 19:30:17'),
(11, 'alihatanveer.arhamsoft@gmail.com', 'Aliha Tanveer', 0x4920616d20666163696e67206973737565207768696c6520726567697374726174696f6e20706c656173652068656c70, 'Registration Issue', NULL, '03114052383', 2, '2022-09-23 14:14:03', '2022-09-23 14:14:44'),
(13, 'mexwell050@gmail.com', 'Bond007', 0x74657374, 'qaiser', NULL, NULL, 1, '2022-09-28 18:31:07', '2022-09-28 18:31:07'),
(14, 'mexwell050@gmail.com', 'Bond007', 0x7a76736664, 'qwerxSZcz', NULL, '03347801021', 2, '2022-09-28 18:32:07', '2022-09-29 12:05:15'),
(16, 'alihatanveer2@yahoo.com', 'Aliha Yahoo', 0x4920616d20756e61626c6520746f206c6f6720696e20746f206d79206163636f756e742e20506c656173652068656c70206d65206f75742e, 'Unable to login', NULL, NULL, 1, '2022-10-11 15:32:05', '2022-10-11 15:32:05'),
(17, 'saadshaheen112233@gmail.com', 'saad', 0x6173646673616466, 'fdsafds', NULL, NULL, 1, '2022-10-11 19:34:33', '2022-10-11 19:34:33'),
(18, 'suca@mailinator.com', 'Sierra Bruce', 0x4465626974697320717569732076656c69742072, 'Fugiat voluptas aut', NULL, NULL, 1, '2022-10-11 19:40:18', '2022-10-11 19:40:18'),
(19, 'alihatanveer.arhamsoft@gmail.com', 'Aliha Tanveer perfecto', 0x506c6561736520726573706f6e736520746f206d7920717565727920617320736f6f6e20617320706f737369626c652e, 'unable to donate as a guest user', NULL, '03114052383', 1, '2022-10-12 12:10:00', '2022-10-12 12:10:00'),
(21, 'zyxyba@mailinator.com', 'Quin Gonzalez', 0x4c61626f72696f73616d206170657269616d, 'Aliqua Nisi laborio', NULL, '+1 (673) 394-6469', 1, '2022-10-12 12:42:19', '2022-10-12 12:42:19'),
(22, 'jokixunuxe@mailinator.com', 'Dexter West', 0x43756c7061206d6f6c65737469616520726563, 'Deserunt exercitatio', NULL, '+1 (162) 916-2023', 1, '2022-10-12 12:42:45', '2022-10-12 12:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `description` blob,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"en\":\"Muhammad Shahbaz\",\"ur\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627 \\u0645\\u0648\\u0627\\u062f\",\"ar\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627 \\u0645\\u0648\\u0627\\u062f\"}', 0x7b22656e223a224d7568616d6d6164205368616862617a222c227572223a225c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c7530363266222c226172223a225c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c7530363266227d, 1, '2022-11-26 12:10:07', '2022-11-26 12:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `file`, `url`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"en\":\"Imani Lindsey\",\"ur\":\"Yoko Gill\",\"ar\":\"Carolyn Patel\"}', '{\"en\":\"Some text here\",\"ur\":\"Some text here\",\"ar\":\"Some text here\"}', 'department-image1670352276.png', 'Non et amet pariatu', 1, '2022-12-06 13:44:36', '2022-12-06 13:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` blob,
  `price` double(8,2) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=featured,0=no featured',
  `donation_type` tinyint(4) DEFAULT NULL COMMENT '1=public,2=private',
  `status` tinyint(4) DEFAULT NULL COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `title`, `description`, `price`, `file`, `is_featured`, `donation_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Quo doloremque amet\",\"ur\":\"Ex veniam anim unde\",\"ar\":\"Ut reprehenderit ni\"}', 0x7b22656e223a2253697420706572666572656e64697320647563692e222c227572223a2253697420706572666572656e64697320647563692e222c226172223a2253697420706572666572656e64697320647563692e227d, 15.00, 'images/donation/donation1669577465.png', 1, 1, 1, '2022-11-27 14:31:05', '2022-11-30 14:39:00'),
(2, '{\"en\":\"Ducimus ullamco ips\",\"ur\":\"Tempore sunt et omn\",\"ar\":\"Natus non fugit vol\"}', 0x7b22656e223a2253504d45222c227572223a22417373756d656e646120657863657074757269202e222c226172223a22417373756d656e646120657863657074757269202e227d, 200.00, 'images/donation/donation1669578257.png', 0, 2, 1, '2022-11-27 14:44:17', '2022-11-30 14:39:00');

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
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short_name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'https://www.kindpng.com/picc/m/59-598788_uk-flag-icon-english-language-flag-icon-hd.png', 1, '2022-11-21 19:15:43', '2022-11-21 19:15:43'),
(2, 'Urdu', 'ur', 'https://cdn.pixabay.com/photo/2013/07/13/14/16/pakistan-162383_960_720.png', 1, '2022-11-21 19:15:43', '2022-11-21 19:15:43'),
(3, 'Arabic', 'ar', 'https://cdn.britannica.com/79/5779-004-DC479508/Flag-Saudi-Arabia.jpg', 1, '2022-11-21 19:15:43', '2022-11-21 19:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `file_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_thumb_nail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` blob,
  `description` blob,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`id`, `type_id`, `file_title`, `file`, `title`, `img_thumb_nail`, `content`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'some text here', 'storage/lib-files/i0wQxP_03bb61f3daabeeec6a6372c936118846.jpg', NULL, NULL, NULL, 0x736f6d6520746578742068657265, 1, '2022-11-26 14:48:59', '2022-11-26 15:43:54'),
(2, 2, 'یہاں کچھ متن', 'storage/lib-files/Every programming tutorial_5f14de45e42966fe7f0942a2bdba8fa3.mp4', NULL, 'images/lib_images_thumb/library1669494014.png', NULL, 0xdb8cdb81d8a7daba20daa9da86dabe20d985d8aad986, 1, '2022-11-26 15:04:49', '2022-11-26 15:53:25'),
(3, 1, 'یہاں کچھ متن', 'storage/lib-files/kama-sutra-urge-deodorant-for-men-150ml_eee2f43763433741978dc91bd0fa0050.jpg', NULL, NULL, NULL, 0xdb8cdb81d8a7daba20daa9da86dabe20d985d8aad986, 1, '2022-11-26 15:50:35', '2022-11-26 15:50:48'),
(4, 2, 'یہاں کچھ متن', 'storage/lib-files/how we write-review code in big tech companies_54218970c40808e6f310755c8ff5b45c.mp4', NULL, 'images/lib_images_thumb/library1669495987.jpg', NULL, 0xdb8cdb81d8a7daba20daa9da86dabe20d985d8aad986, 1, '2022-11-26 15:52:45', '2022-11-26 15:53:25'),
(5, 3, 'یہاں کچھ متن', 'storage/lib-files/file_example_MP3_1MG_2eaab3e43442c3e5e1b9d3cbbd56f543.mp3', NULL, NULL, NULL, 0xdb8cdb81d8a7daba20daa9da86dabe20d985d8aad986, 1, '2022-11-26 15:56:14', '2022-11-26 15:56:25'),
(6, 4, 'یہاں کچھ متن', 'storage/lib-files/CamScanner 09-14-2021 16.05_66493905411ea6c960b8282bd8685a6b.pdf', NULL, NULL, NULL, 0xdb8cdb81d8a7daba20daa9da86dabe20d985d8aad986, 1, '2022-11-26 15:57:10', '2022-11-26 15:57:25'),
(7, 2, NULL, 'storage/lib-files/Every programming tutorial_d74656818103b091779f6a1939df4ff5.mp4', NULL, NULL, NULL, NULL, 1, '2022-11-30 14:36:44', '2022-11-30 14:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `library_types`
--

CREATE TABLE `library_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `content` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `library_types`
--

INSERT INTO `library_types` (`id`, `title`, `icon`, `status`, `content`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Image\",\"ur\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\",\"ar\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\"}', NULL, 1, 0x7b22656e223a223c703e736f6d65207465787420686572653c5c2f703e222c227572223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e222c226172223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e227d, NULL, '2022-11-26 15:50:48'),
(2, '{\"en\":\"Video\",\"ur\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\",\"ar\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\"}', NULL, 1, 0x7b22656e223a223c703e736f6d65207465787420666f7220766964656f3c5c2f703e222c227572223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e222c226172223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e227d, NULL, '2022-11-26 15:53:25'),
(3, '{\"en\":\"Audio\",\"ur\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\",\"ar\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\"}', NULL, 1, 0x7b22656e223a223c703e736f6d65207465787420666f7220617564696f3c5c2f703e222c227572223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e222c226172223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e227d, NULL, '2022-11-26 15:56:25'),
(4, '{\"en\":\"Book\",\"ur\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\",\"ar\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\"}', NULL, 1, 0x7b22656e223a223c703e536f6d65207465787420666f7220626f6f6b3c5c2f703e222c227572223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e222c226172223a223c703e5c75303663635c75303663315c75303632375c7530366261205c75303661395c75303638365c7530366265205c75303634355c75303632615c75303634363c62723e3c5c2f703e227d, NULL, '2022-11-26 15:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) UNSIGNED NOT NULL,
  `location_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` blob,
  `location_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_address`, `description`, `location_link`, `featured`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"en\":\"In blanditiis volupt\",\"ur\":\"Nulla ad veniam rei\",\"ar\":\"Voluptatem similique\"}', 0x7b22656e223a22506c616365617420726572756d20766f6c7570222c227572223a22506c616365617420726572756d20766f6c7570222c226172223a22506c616365617420726572756d20766f6c7570227d, 'Placeat rerum volup', 0, 1, '2022-11-29 13:40:13', '2022-11-29 13:40:13'),
(3, '{\"en\":\"some text here\",\"ur\":\"\\u06a9\\u0686\\u06be \\u0645\\u062a\\u0646 \\u06cc\\u06c1\\u0627\\u06ba\",\"ar\":\"\\u06a9\\u0686\\u06be \\u0645\\u062a\\u0646 \\u06cc\\u06c1\\u0627\\u06ba\"}', 0x7b22656e223a223c703e536f6d65207465787420686572653c62723e3c5c2f703e222c227572223a223c703e536f6d65207465787420686572653c62723e3c5c2f703e222c226172223a223c703e536f6d65207465787420686572653c62723e3c5c2f703e227d, 'Some text here', 1, 1, '2022-12-06 13:43:41', '2022-12-06 13:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) UNSIGNED NOT NULL,
  `magazine_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` blob,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`id`, `magazine_category_id`, `title`, `description`, `file`, `thumbnail_image`, `status`, `created_at`, `updated_at`) VALUES
(15, 7, '{\"en\":\"Some text here\",\"ur\":\"\\u06a9\\u0686\\u06be \\u0645\\u062a\\u0646 \\u06cc\\u06c1\\u0627\\u06ba\",\"ar\":\"\\u06a9\\u0686\\u06be \\u0645\\u062a\\u0646 \\u06cc\\u06c1\\u0627\\u06ba\"}', 0x7b22656e223a22536f6d6520746578742068657265222c227572223a225c75303661395c75303638365c7530366265205c75303634355c75303632615c7530363436205c75303663635c75303663315c75303632375c7530366261222c226172223a225c75303661395c75303638365c7530366265205c75303634355c75303632615c7530363436205c75303663635c75303663315c75303632375c7530366261227d, 'files/magazine/magazine1669664612.pdf', 'images/magazine/magazine1669664612.webp', 1, '2022-11-28 14:43:32', '2022-11-28 14:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `magazine_categories`
--

CREATE TABLE `magazine_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magazine_categories`
--

INSERT INTO `magazine_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(9, '{\"en\":\"Victoria Bowers\",\"ur\":\"Hayden Sosa\",\"ar\":\"Morgan Vaughn\"}', 1, '2022-12-06 13:35:34', '2022-12-06 13:35:34');

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
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_subscriptions`
--

CREATE TABLE `new_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `new_subscriptions`
--

INSERT INTO `new_subscriptions` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'alihatanveer.arhamsoft@gmail.com', 1, '2022-09-09 15:31:54', '2022-09-09 15:31:54'),
(3, 'test@test.com', 1, '2022-09-14 22:27:26', '2022-09-14 22:27:26'),
(5, 'shahbaz.arhamsoft@gmail.com', 1, '2022-09-15 11:20:56', '2022-09-15 11:20:56'),
(6, 'admin@arhamsoft.com', 1, '2022-09-21 14:05:32', '2022-09-21 14:05:32'),
(8, 'jesa@mailinator.com', 1, '2022-09-22 14:08:13', '2022-09-22 14:08:13'),
(9, 'maria@gmail.com', 1, '2022-10-19 17:37:13', '2022-10-19 17:37:13'),
(25, 'ارحم سافٹ ویئر', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf32_unicode_ci,
  `description` blob,
  `meta_title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `in_header` tinyint(4) NOT NULL DEFAULT '0',
  `in_footer` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf32_unicode_ci,
  `description` blob,
  `meta_title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `slider_post` tinyint(4) NOT NULL DEFAULT '0',
  `feature` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `theme_image` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_feature_images`
--

CREATE TABLE `post_feature_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `post_feature_images`
--

INSERT INTO `post_feature_images` (`id`, `post_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 'feature-1669831073.png', '2022-11-30 12:56:49', '2022-11-30 12:57:53'),
(2, 3, 'feature-1669831894.jpg', '2022-11-30 13:11:34', '2022-11-30 13:11:34'),
(3, 1, 'feature-1670351856.png', '2022-12-06 13:37:36', '2022-12-06 13:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_theme_images`
--

CREATE TABLE `post_theme_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `post_theme_images`
--

INSERT INTO `post_theme_images` (`id`, `post_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 'theme-1669831073.jpg', '2022-11-30 12:56:49', '2022-11-30 12:57:53'),
(2, 3, 'theme-1669831894.jpg', '2022-11-30 13:11:34', '2022-11-30 13:11:34'),
(3, 1, 'theme-1670351856.png', '2022-12-06 13:37:36', '2022-12-06 13:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `id` int(11) NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'admin', NULL, 0, NULL, '2022-11-20 06:24:47', '2022-11-20 06:24:47');

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
(1, 'title', 'Duis reprehenderit o'),
(2, 'email', 'keselatyn@mailinator.com'),
(3, 'phone', '(+15) 655338908_'),
(4, 'whatsapp', '(+92) 3435445655'),
(5, 'address_english', 'Voluptatem omnis do'),
(6, 'address_urdu', 'Voluptatem aut deser'),
(7, 'address_arabic', 'Rerum laborum Accus'),
(8, 'opening_time', '23:40'),
(9, 'play_store', 'https://www.tubohipuqosy.me'),
(10, 'app_store', 'https://www.zofen.me'),
(11, 'facebook', 'https://www.jozujiko.com'),
(12, 'linkedin', 'https://www.subinofu.cm'),
(13, 'pinterest', 'https://www.kofyluqewesyxub.co.uk'),
(14, 'twitter', 'https://www.qizifecoky.info'),
(15, 'youtube', 'https://www.fimysi.us'),
(16, 'logo', 'images/logo/logo1669574672.png');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` blob,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `content`, `status`, `created_at`, `updated_at`) VALUES
(5, '{\"en\":\"Muhammad Shahbaz\",\"ur\":\"\\u0634\\u06c1\\u0628\\u0627\\u0632\",\"ar\":\"\\u0634\\u06c1\\u0628\\u0627\\u0632\"}', 'slider-image1669139379.jpg', 0x7b22656e223a223c703e536f6d652074657874206865726520656e676c69736820757064617465643c5c2f703e222c227572223a223c703e536f6d65207465787420686572652075726475266e6273703b3c7370616e207374796c653d5c22666f6e742d73697a653a203172656d3b5c223e757064617465643c5c2f7370616e3e3c62723e3c5c2f703e222c226172223a223c703e536f6d652074657874206865726520617261626963266e6273703b3c7370616e207374796c653d5c22666f6e742d73697a653a203172656d3b5c223e757064617465643c5c2f7370616e3e3c62723e3c5c2f703e227d, 1, '2022-11-22 12:12:07', '2022-11-22 12:49:39'),
(6, '{\"en\":\"New data\",\"ur\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627\",\"ar\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627\"}', 'slider-image1669139807.jpg', 0x7b22656e223a223c703e6e6577206461746120636f6e74656e743c5c2f703e222c227572223a223c70726520636c6173733d5c2274772d646174612d746578742074772d746578742d6c617267652074772d74615c2220646174612d706c616365686f6c6465723d5c225472616e736c6174696f6e5c222069643d5c2274772d7461726765742d746578745c22206469723d5c2272746c5c22207374796c653d5c22756e69636f64652d626964693a2069736f6c6174653b20666f6e742d73697a653a20323870783b206c696e652d6865696768743a20333270783b206261636b67726f756e642d636f6c6f723a20726762283234382c203234392c20323530293b20626f726465723a206e6f6e653b2070616464696e673a2032707820302e3134656d20327078203070783b20706f736974696f6e3a2072656c61746976653b206d617267696e2d746f703a202d3270783b206d617267696e2d626f74746f6d3a202d3270783b20726573697a653a206e6f6e653b20666f6e742d66616d696c793a20696e68657269743b206f766572666c6f773a2068696464656e3b20746578742d616c69676e3a2072696768743b2077696474683a203237302e30323170783b2077686974652d73706163653a207072652d777261703b206f766572666c6f772d777261703a20627265616b2d776f72643b20636f6c6f723a207267622833322c2033332c203336293b5c223e3c7370616e20636c6173733d5c225932495146635c22206c616e673d5c2275725c223e5c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c75303632663c5c2f7370616e3e3c5c2f7072653e222c226172223a223c70726520636c6173733d5c2274772d646174612d746578742074772d746578742d6c617267652074772d74615c2220646174612d706c616365686f6c6465723d5c225472616e736c6174696f6e5c222069643d5c2274772d7461726765742d746578745c22206469723d5c2272746c5c22207374796c653d5c22756e69636f64652d626964693a2069736f6c6174653b20666f6e742d73697a653a20323870783b206c696e652d6865696768743a20333270783b206261636b67726f756e642d636f6c6f723a20726762283234382c203234392c20323530293b20626f726465723a206e6f6e653b2070616464696e673a2032707820302e3134656d20327078203070783b20706f736974696f6e3a2072656c61746976653b206d617267696e2d746f703a202d3270783b206d617267696e2d626f74746f6d3a202d3270783b20726573697a653a206e6f6e653b20666f6e742d66616d696c793a20696e68657269743b206f766572666c6f773a2068696464656e3b20746578742d616c69676e3a2072696768743b2077696474683a203237302e30323170783b2077686974652d73706163653a207072652d777261703b206f766572666c6f772d777261703a20627265616b2d776f72643b20636f6c6f723a207267622833322c2033332c203336293b5c223e3c7370616e20636c6173733d5c225932495146635c22206c616e673d5c2275725c223e5c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c75303632663c5c2f7370616e3e3c5c2f7072653e227d, 1, '2022-11-22 12:56:47', '2022-11-22 12:56:47'),
(7, '{\"en\":\"Image\",\"ur\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\",\"ar\":\"\\u062a\\u0635\\u0648\\u06cc\\u0631\"}', 'slider-image1669487619.png', 0x7b22656e223a223c646976207374796c653d5c22636f6c6f723a20726762283231322c203231322c20323132293b206261636b67726f756e642d636f6c6f723a207267622833302c2033302c203330293b20666f6e742d66616d696c793a20436f6e736f6c61732c202671756f743b436f7572696572204e65772671756f743b2c206d6f6e6f73706163653b20666f6e742d73697a653a20313470783b206c696e652d6865696768743a20313970783b2077686974652d73706163653a207072653b5c223e3c7370616e207374796c653d5c22636f6c6f723a20236365393137383b5c223e6e61762d69636f6e203c5c2f7370616e3e3c5c2f6469763e222c227572223a223c646976207374796c653d5c22636f6c6f723a20726762283231322c203231322c20323132293b206261636b67726f756e642d636f6c6f723a207267622833302c2033302c203330293b20666f6e742d66616d696c793a20436f6e736f6c61732c202671756f743b436f7572696572204e65772671756f743b2c206d6f6e6f73706163653b20666f6e742d73697a653a20313470783b206c696e652d6865696768743a20313970783b2077686974652d73706163653a207072653b5c223e3c7370616e207374796c653d5c22636f6c6f723a20236365393137383b5c223e6e61762d69636f6e203c5c2f7370616e3e3c5c2f6469763e222c226172223a223c646976207374796c653d5c22636f6c6f723a20726762283231322c203231322c20323132293b206261636b67726f756e642d636f6c6f723a207267622833302c2033302c203330293b20666f6e742d66616d696c793a20436f6e736f6c61732c202671756f743b436f7572696572204e65772671756f743b2c206d6f6e6f73706163653b20666f6e742d73697a653a20313470783b206c696e652d6865696768743a20313970783b2077686974652d73706163653a207072653b5c223e3c7370616e207374796c653d5c22636f6c6f723a20236365393137383b5c223e6e61762d69636f6e203c5c2f7370616e3e3c5c2f6469763e227d, 1, '2022-11-26 13:33:39', '2022-12-06 13:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `message` blob,
  `image` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `message`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Cameron Albert\",\"ur\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627 \\u0645\\u0648\\u0627\\u062f\",\"ar\":\"\\u0646\\u06cc\\u0627 \\u0688\\u06cc\\u0679\\u0627 \\u0645\\u0648\\u0627\\u062f\"}', 0x7b22656e223a22436f72706f7269732071756165726174207574222c227572223a225c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c7530363266222c226172223a225c75303634365c75303663635c7530363237205c75303638385c75303663635c75303637395c7530363237205c75303634355c75303634385c75303632375c7530363266227d, 'testimonial-image1669485488.png', 1, '2022-11-26 12:58:08', '2022-11-26 12:58:51');

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
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$zHm1D5gWHsuMhwM9icwXKeTe5eWxGU5RQ2qmFVysjGCVm6Xs8auRa', NULL, NULL, 0, '2022-11-20 06:20:09', '2022-11-20 06:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf32_unicode_ci,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

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
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ceo_messages`
--
ALTER TABLE `ceo_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_records`
--
ALTER TABLE `contact_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_types`
--
ALTER TABLE `library_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazine_categories`
--
ALTER TABLE `magazine_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_feature_images`
--
ALTER TABLE `post_feature_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_theme_images`
--
ALTER TABLE `post_theme_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ceo_messages`
--
ALTER TABLE `ceo_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_records`
--
ALTER TABLE `contact_records`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `library_types`
--
ALTER TABLE `library_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `magazine_categories`
--
ALTER TABLE `magazine_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_feature_images`
--
ALTER TABLE `post_feature_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_theme_images`
--
ALTER TABLE `post_theme_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
