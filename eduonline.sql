-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 10:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@admin.com', '$2y$10$q6JElQSjpgw3pH58.ixFi.4UhKJYQoTEiGzYRXV/StzsVEQItqsHW', '49mTHGXcJGRtMMqaYAkh9OU2JvFzORrZdqNXFQeQ6xmpbSeKV6yvVXQnkS0D', '2019-02-07 11:51:32', '2019-06-21 12:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `role_id`, `admin_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `circle_news`
--

CREATE TABLE `circle_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `circle_news`
--

INSERT INTO `circle_news` (`id`, `heading`, `description`, `file`, `created_at`, `updated_at`) VALUES
(3, 'Open Knowledge', 'Free learning,Anywhere,Anytime', 'online-education-jpeg_1557329073.jpg', '2019-03-14 12:57:28', '2019-05-08 10:54:33'),
(4, 'Quick response', 'Quicker Feedback from Page.', 'quick_response_service_care_quality_business-512_1557328942.png', '2019-03-14 12:58:28', '2019-05-08 10:52:41'),
(5, 'Earning', 'New way of income', 'word-writing-text-make-money-online-business-concept-for-obtain-cash-earning-it-or-by-making-profit-using-internet-multiple-layer-of-blank-sheets-col-RK92C5_1557330007.jpg', '2019-03-14 12:59:52', '2019-05-08 11:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `user_type`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'jjgkjhgkjh', 24, 'teacher', 1, '2019-06-22 04:45:35', '2019-06-22 04:45:35'),
(2, ',nm', 24, 'teacher', 1, '2019-06-22 04:45:52', '2019-06-22 04:45:52'),
(3, 'sdfsdf', 1, 'student', 1, '2019-06-22 04:47:28', '2019-06-22 04:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `like` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_06_023521_create_admins_table', 1),
(4, '2017_03_06_053834_create_admin_role_table', 1),
(5, '2018_03_06_023523_create_roles_table', 1),
(6, '2019_02_02_051848_create_students_table', 1),
(7, '2019_02_18_190948_create_posts_table', 2),
(8, '2019_02_25_180427_create_postfiles_table', 3),
(9, '2019_03_01_102508_create_comments_table', 4),
(10, '2019_03_14_124311_create_slides_table', 5),
(11, '2019_03_14_165128_create_circle_news_table', 6),
(12, '2019_03_14_193118_create_square_news_table', 7),
(13, '2019_03_14_195111_create_square_news_table', 8),
(14, '2019_05_05_195214_create_rating_infos_table', 9),
(15, '2019_05_08_113831_create_likes_table', 10),
(16, '2019_05_10_104652_create_rating_infos_table', 11),
(17, '2019_05_12_094513_add_total_likes_to_posts', 12),
(18, '2019_05_12_101616_add_available_balance_to_users', 13),
(19, '2019_05_12_125109_create_payment_requests_table', 14),
(20, '2019_06_19_141223_add_email_verified_at_and_idcard_to_students', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sandip.silwal.ss@gmail.com', '$2y$10$rFgVuk73VYYXaxzbTvF5RuE5G4rfD98hETlGAXk9Pah/cjXTt/dfa', '2019-06-06 11:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postfiles`
--

CREATE TABLE `postfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` float NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postfiles`
--

INSERT INTO `postfiles` (`id`, `file_name`, `file_type`, `file_size`, `post_id`, `created_at`, `updated_at`) VALUES
(1, '20171115eportfolios.jpg_1561196002.jpg', 'jpg', 0.104692, 1, '2019-06-22 03:48:22', '2019-06-22 03:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_likes` int(11) NOT NULL,
  `payed_upto` int(11) NOT NULL,
  `payable` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post_body`, `user_id`, `created_at`, `updated_at`, `total_likes`, `payed_upto`, `payable`) VALUES
(1, 'ererr', 'sdfgdsf', 24, '2019-06-22 03:48:22', '2019-06-22 03:48:22', 0, 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `rating_infos`
--

CREATE TABLE `rating_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating_action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_infos`
--

INSERT INTO `rating_infos` (`id`, `user_id`, `post_id`, `user_type`, `rating_action`, `created_at`, `updated_at`) VALUES
(1, 24, 1, 'teacher', 'like', '2019-06-22 04:45:41', '2019-06-22 04:45:41'),
(2, 1, 1, 'student', 'like', '2019-06-22 04:47:17', '2019-06-22 04:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super', '2019-02-07 11:51:32', '2019-02-07 11:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `heading`, `description`, `file`, `created_at`, `updated_at`) VALUES
(8, 'Online Education', '\"Digital Learning\"', 'on;ine_1557348763.jpg', '2019-03-16 06:36:22', '2019-05-12 22:02:47'),
(10, 'Earning', '\"income\"', '60make-money-online_1557330564.jpeg', '2019-05-08 11:19:24', '2019-05-12 22:03:00'),
(11, 'Quick response', '\"feedback\"', 'feedback_1557331276.jpg', '2019-05-08 11:31:16', '2019-05-12 22:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `square_news`
--

CREATE TABLE `square_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `square_news`
--

INSERT INTO `square_news` (`id`, `heading`, `description`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Online Education', 'Our digital education helps to learn anywhere,anytime.', '9_1552596189.jpg', '2019-03-14 14:47:06', '2019-05-08 11:54:33'),
(3, 'Designed for Student', 'We provide free and easy access for learning. Our interactive digital learning modules, educational videos and reference materials help students do research projects and promote the habit of independent inquiry.', '20171115eportfolios_1557719313.jpg', '2019-03-14 14:47:54', '2019-05-12 22:03:33'),
(4, 'Teachers', 'Teachers can benefit widely books, various teaching resources and educational materials in core subjects as well as various other. We also have plenty of reference materials professional development.', 'unhelpful-communications-professor-meme-blank_1557719331.jpg', '2019-03-14 15:00:38', '2019-05-12 22:03:51'),
(5, 'Earning', 'New way of income.Income is based on maximum likes on post', 'file_1557720182.png', '2019-05-12 22:18:02', '2019-05-12 22:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `student_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `faculty`, `program`, `profile_picture`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified_at`, `student_card`, `college`) VALUES
(1, 'Sandip Silwal', 'science_and_technology', 'bachelor_in_computer_engineering', '25788m_1561199514.jpg', 'sandip.silwal.ss@gmail.com', '$2y$10$aRLOOhXp7RvX2tX4r7/MkO6aK97orNUIVdp12NjHDlaqe03lK43o.', NULL, '2019-06-22 04:46:54', '2019-06-22 04:48:51', '2019-06-22 04:48:51', '20171115eportfolios_1561199514.jpg', 'Acme Engineering College'),
(2, 'Sudip gharti magar', 'science_and_technology', 'bachelor_in_computer_engineering', '25788m_1561276691.jpg', 'sudip.gm@gmail.com', '$2y$10$cs21YxfUFXXw6.jCmw5weOLP1YGYRRWBnzg7fTaLr9ovaQ3zEFH22', 'ABjJFKXrEk1oo7QSf42JjPXL4v0pB3b9jGoeQWpH5VfjXYom64XML9n68tNb', '2019-06-23 02:13:12', '2019-06-23 02:19:50', '2019-06-23 02:19:50', '468354308_1561276692.jpg', 'Acme Engineering College');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `engaged_college` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaching_faculty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaching_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizenship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available_balance` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `address`, `contact`, `email`, `email_verified_at`, `engaged_college`, `teaching_faculty`, `teaching_program`, `citizenship`, `teacher_card`, `profile_picture`, `verification`, `password`, `remember_token`, `created_at`, `updated_at`, `available_balance`) VALUES
(24, 'Sandip Silwal', 'sandiip.silwal', 'Gongabu, Kathmandu, Nepal', 9843180434, 'sandip.silwal.ss@gmail.com', '2019-06-22 03:50:51', 'Acme engineering college', 'science_and_technology', 'bachelor_in_computer_engineering', '20171115eportfolios_1561193867.jpg', '25788m_1561193867.jpg', '468354308_1561193867.jpg', 'done', '$2y$10$ihhrkhnWX9oy1fa/s81axePorVL7rV2G9SQGyhLlsOPDK7qClBks6', 'qgMhJVcTRaqhzyul56YRdNWR6cZeqO9XBhP1b1Ld7Ys34GeUgRmC0DZbsqtM', '2019-06-22 03:12:47', '2019-06-22 03:50:51', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_role_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `circle_news`
--
ALTER TABLE `circle_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `postfiles`
--
ALTER TABLE `postfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postfiles_post_id_foreign` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_teacher_id_foreign` (`user_id`);

--
-- Indexes for table `rating_infos`
--
ALTER TABLE `rating_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_infos_user_id_post_id_user_type_index` (`user_id`,`post_id`,`user_type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `square_news`
--
ALTER TABLE `square_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `circle_news`
--
ALTER TABLE `circle_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postfiles`
--
ALTER TABLE `postfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating_infos`
--
ALTER TABLE `rating_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `square_news`
--
ALTER TABLE `square_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `payment_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postfiles`
--
ALTER TABLE `postfiles`
  ADD CONSTRAINT `postfiles_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_teacher_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
