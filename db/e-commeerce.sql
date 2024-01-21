-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commeerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->active , 1->deactive',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `image`, `created_at`, `updated_at`, `slug`, `description`, `status`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(2, 0, 'Electronic', '1702403301microscope-1.webp', '2023-12-12 11:24:06', '2023-12-12 12:18:21', 'electronic', 'test', '0', 'test', 'test', 'test'),
(3, 2, 'mobile', '1702403811PC.jpg', '2023-12-12 12:26:51', '2023-12-12 12:26:51', 'mobile', 'test', '0', 'test', 'test', 'test'),
(4, 2, 'test', '1702792019microscope-1.webp', '2023-12-17 00:16:59', '2023-12-17 00:16:59', 'test', 'fefe', '0', 'fefefefe', 'test', 'fefe'),
(5, 2, 'test', '1703940343group_photo_2.webp', '2023-12-30 07:15:44', '2024-01-12 10:58:55', 'test', 'tet', '0', 'tet', 'test', 'tet'),
(9, 2, 'tv', '1703943024cbct-1.webp', '2023-12-30 08:00:24', '2024-01-12 10:58:50', 'tv', 'test', '0', 'test', 'tsrt', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_11_070055_create_categories_table', 2),
(6, '2023_12_11_070839_create_categories_fields', 2),
(7, '2023_12_12_181724_create_product_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `small_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `original_price` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `trending` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->active , 1->deactive',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `tax`, `trending`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'test', 'test', '123', '123', '1703493484cbct-1.webp', NULL, NULL, '0', '0', 'test', 'test', 'test', '2023-12-25 03:08:04', '2023-12-25 03:08:04'),
(2, 2, NULL, 'test', 'test', '123', '1000', '1703493662group_photo_2.webp', NULL, NULL, '0', '0', 'test', 'tesst', 'test', '2023-12-25 03:11:02', '2023-12-25 03:11:02'),
(3, 4, NULL, 'test', 'test', '12', '12', '1703494124microscope-1.webp', '11', '12', '1', '0', 'test', 'test', 'test', '2023-12-25 03:18:44', '2023-12-25 03:18:44'),
(4, 4, 'test', 'test', 'test', '12', '12', '1703494295microscope-1.webp', '11', '12', '1', '0', 'test', 'test', 'test', '2023-12-25 03:21:35', '2023-12-25 03:21:35'),
(5, NULL, 'test1111', 'test11111', 'test1111', '12111', '12111', 'http://localhost/ecommerce-app/storage/images/product/1703941960edge-pro-1.webp', '11', '12111', '1', '0', 'test111', 'test111', 'test111', '2023-12-25 03:22:00', '2023-12-30 07:42:40'),
(6, 4, 'washing machine', 'this good  washing machine', 'this good  washing machine', '17000', '20000', 'http://localhost/ecommerce-app/storage/images/product/1703940995RegencyStyleShop (5).png', '12', '12.6', '1', '0', 'test', 'test description', 'test', '2023-12-30 07:26:35', '2023-12-30 07:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `user_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT 'admin-2,user-1',
  `email` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `user_type`, `email`, `profile_pic`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'kathan', '1234567890', '1', 'kathan.sinontechs@gmail.com', 'images/NahElfupTAXCkBDKDpu0E4DFHZ1qjVRieTOADur4.png', NULL, '$2y$10$vY2HryvYaMYpQThqWfouM.6S4CNLP0vl39B7h7QIPrWJ41OiSwD5K', NULL, '2023-12-10 09:14:20', '2023-12-10 09:14:20'),
(5, 'tee', '1234567890', '1', 'testsx@gmail.com', '1702219746RegencyStyleShop (2).png', NULL, '$2y$10$dWRrSY2fGBxuod6lYG0D5uD1MBeU9O3RMISNytN/i12KPuKLu5n8e', NULL, '2023-12-10 09:19:06', '2023-12-10 09:19:06'),
(6, 'kathan', '1234567890', '1', 'kathan742@gmail.com', '1702228689icons8-registration-48.png', NULL, '$2y$10$HP0f2LzA6iTxLDxlgODbXer7oj772aKbiovIYYvCxufetLLKs..1u', NULL, '2023-12-10 11:48:09', '2023-12-10 11:48:09'),
(7, 'admin', '911234567891', '2', 'admin@gmail.com', NULL, NULL, '$2y$10$zk5bvjj0M67UkyAQORcnIOE07nSk2t6zCxOhlTRNgVgDa6zebsNcK', NULL, '2023-12-12 11:09:11', '2023-12-12 11:09:11');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
