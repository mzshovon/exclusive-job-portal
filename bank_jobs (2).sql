-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 06:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Title in English',
  `title_bn` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Title in Bengali',
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description in English',
  `description_bn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description in Bengali',
  `is_active` smallint(6) NOT NULL DEFAULT 0 COMMENT 'If 1 will show the about us section',
  `type` smallint(6) NOT NULL COMMENT '1= About us, 2= About Exams, 3= About Rules',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Store the base path of images',
  `image_position` varchar(122) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Store image position of the section',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title_en`, `title_bn`, `description_en`, `description_bn`, `is_active`, `type`, `image_path`, `image_position`, `created_by`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'শিরোনাম সাহসী হওয়া উচিত', NULL, '<div class=\"tw-ta-container F0azHf tw-lfl\" id=\"tw-target-text-container\" tabindex=\"0\" style=\"overflow: hidden; position: relative; outline: 0px; color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 0px; background-color: rgb(248, 249, 250);\"><pre class=\"tw-data-text tw-text-large tw-ta\" data-placeholder=\"অনুবাদ\" id=\"tw-target-text\" dir=\"ltr\" style=\"unicode-bidi: isolate; font-size: 24px; line-height: 32px; background-color: transparent; border: none; padding: 2px 0.14em 2px 0px; position: relative; margin-top: -2px; margin-bottom: -2px; resize: none; font-family: inherit; overflow: hidden; width: 270px; white-space: pre-wrap; overflow-wrap: break-word;\"><span class=\"Y2IQFc\" lang=\"bn\">এর পরের ঘটনা নিয়ে আমাদের মাথা ঘামাতে হবে না</span></pre><div><span class=\"Y2IQFc\" lang=\"bn\"><br></span></div></div><div class=\"tw-target-rmn tw-ta-container F0azHf tw-nfl\" id=\"tw-target-rmn-container\" style=\"overflow: hidden; position: relative; outline: 0px; color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 0px; background-color: rgb(248, 249, 250);\"></div>', 1, 1, 'public/dist/img/about/About Us/1650828458.png', '2', 1, 1, '::1', '2022-04-24 13:27:38', '2022-04-29 12:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_answer` int(11) NOT NULL DEFAULT 0,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `name`, `is_answer`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, '<p>test</p>', 1, NULL, 1, 1, NULL, NULL),
(8, '<p>tes1</p>', 1, NULL, 1, 1, NULL, NULL),
(9, '<p>test2</p>', 1, NULL, 1, 1, NULL, NULL),
(10, '<p>test1</p>', 1, NULL, 1, 1, '2022-07-17 12:37:25', '2022-07-17 12:37:25'),
(11, '<p>test3</p>', 1, NULL, 1, 1, '2022-07-17 12:37:25', '2022-07-17 12:37:25'),
(12, '<p>test1</p>', 1, NULL, 1, 1, '2022-07-17 12:37:48', '2022-07-17 12:37:48'),
(13, '<p>test3</p>', 1, NULL, 1, 1, '2022-07-17 12:37:48', '2022-07-17 12:37:48'),
(14, '_1', 1, NULL, 1, 1, '2022-07-17 13:11:28', '2022-07-17 13:11:28'),
(15, '_1', 1, NULL, 1, 1, '2022-07-17 13:12:46', '2022-07-17 13:12:46'),
(16, '_1', 1, NULL, 1, 1, '2022-07-17 13:15:56', '2022-07-17 13:15:56'),
(17, '_2', 1, NULL, 1, 1, '2022-07-17 13:15:56', '2022-07-17 13:15:56'),
(18, '_1', 1, NULL, 1, 1, '2022-07-17 13:17:54', '2022-07-17 13:17:54'),
(19, '_2', 1, NULL, 1, 1, '2022-07-17 13:17:54', '2022-07-17 13:17:54'),
(20, '<p>test</p>', 1, NULL, 1, 1, '2022-07-17 13:22:27', '2022-07-17 13:22:27'),
(21, '<p>test1</p>', 1, NULL, 1, 1, '2022-07-17 13:22:27', '2022-07-17 13:22:27'),
(22, '<p>test</p>', 1, NULL, 1, 1, '2022-07-17 13:30:22', '2022-07-17 13:30:22'),
(23, '<p>test</p>', 1, NULL, 1, 1, '2022-07-17 13:32:14', '2022-07-17 13:32:14'),
(24, '<p>test1</p>', 1, NULL, 1, 1, '2022-07-17 13:32:14', '2022-07-17 13:32:14'),
(25, '<p>test<br></p>', 1, NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12'),
(26, '<p>test<br></p>', 1, NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12'),
(27, '<p>test<br></p>', 1, NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12'),
(28, '<p>Bangla test 1</p>', 1, NULL, 1, 1, '2022-07-20 12:23:19', '2022-07-21 11:11:46'),
(29, '<p>Bangla test 2</p>', 1, NULL, 1, 1, '2022-07-20 12:23:19', '2022-07-21 11:11:46'),
(30, '<p>end<br></p>', 1, NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02'),
(31, '<p>start</p>', 1, NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02'),
(32, '<p>middle</p>', 1, NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02'),
(33, '<p>bottom</p>', 1, NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02'),
(34, '<p>test</p>', 1, NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03'),
(35, '<p>test</p>', 1, NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03'),
(36, '<p>tes</p>', 1, NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03'),
(37, '<p>vxcvxc</p>', 1, NULL, 1, 1, '2022-07-20 12:39:12', '2022-07-20 12:39:12'),
(38, '<p>xcvxcv</p>', 1, NULL, 1, 1, '2022-07-20 12:39:12', '2022-07-20 12:39:12'),
(39, '<p>Bangla test 3&nbsp;</p>', 1, NULL, 1, 1, '2022-07-20 12:39:57', '2022-07-21 11:11:46'),
(40, '<p>Bangla test 4</p>', 1, NULL, 1, 1, '2022-07-20 12:39:57', '2022-07-21 11:11:46'),
(41, '<p>sdfsd</p>', 1, NULL, 1, 1, '2022-07-20 13:00:45', '2022-07-20 13:00:45'),
(42, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-07-20 13:00:45', '2022-07-20 13:00:45'),
(43, '<p>let there be begin</p>', 1, NULL, 1, 1, '2022-07-20 13:00:45', '2022-08-01 02:25:33'),
(44, '<p>Bangla test</p>', 1, NULL, 1, 1, '2022-07-21 11:09:20', '2022-07-21 11:09:20'),
(45, '<p>Bangla test 1</p>', 1, NULL, 1, 1, '2022-07-21 11:09:20', '2022-07-21 11:09:20'),
(46, '<p>Bangla test 2</p>', 1, NULL, 1, 1, '2022-07-21 11:09:20', '2022-07-21 11:09:20'),
(47, '<p>Bangla test 3</p>', 1, NULL, 1, 1, '2022-07-21 11:09:20', '2022-07-21 11:09:20'),
(48, '<p>Bangla test 2</p>', 1, NULL, 1, 1, '2022-07-21 11:09:45', '2022-07-21 11:09:45'),
(49, '<p>sdfsdfsdf</p>', 1, NULL, 1, 1, '2022-07-21 11:09:45', '2022-07-21 11:09:45'),
(50, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-07-21 11:09:45', '2022-07-21 11:09:45'),
(51, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-07-21 11:09:45', '2022-07-21 11:09:45'),
(52, '<p>test</p>', 1, NULL, 1, 1, '2022-07-22 00:23:02', '2022-07-22 00:23:02'),
(53, '<p>Cumilla</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(54, '<p>Chattogram</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(55, '<p>Dhaka</p>', 1, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(56, '<p>Khulna</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(57, '<p>tsse</p>', 1, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(58, '<p>sttts</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(59, '<p>stst</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(60, '<p>stst</p>', 0, NULL, 1, 1, '2022-07-22 00:23:58', '2022-08-01 02:37:07'),
(61, '<p>test1<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(62, '<p>test1<br></p>', 1, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(63, '<p>test1<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(64, '<p>test1<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(65, '<p>test2<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(66, '<p>test2<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(67, '<p>test2<br></p>', 0, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(68, '<p>test2<br></p>', 1, NULL, 1, 1, '2022-07-22 00:24:40', '2022-08-01 02:37:07'),
(69, '<p>test3</p>', 1, NULL, 1, 1, '2022-07-30 23:49:49', '2022-07-31 02:46:51'),
(70, '<p>test2</p>', 1, NULL, 1, 1, '2022-07-30 23:49:49', '2022-07-30 23:49:49'),
(71, '<p>Alfred Novel</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(72, '<p>Jim Carrie</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(73, '<p>Michael robartson</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(74, '<p>Mark brownie</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(75, '<p>One</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(76, '<p>Two</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(77, '<p>Three</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(78, '<p>Four</p>', 0, NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18'),
(79, '<p>o</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(80, '<p>q</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(81, '<p>d</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(82, '<p>f</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(83, '<p>y</p>', 1, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(84, '<p>afsfasf</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(85, '<p>fghghfgh</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(86, '<p>fghfghgh</p>', 1, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(87, '<p>yututyu</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(88, '<p>yutyutyu</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(89, '<p>tyutyut</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(90, '<p>dfdfgdfgfg</p>', 0, NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:36:27'),
(91, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(92, '<p>dsfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(93, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(94, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(95, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(96, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(97, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(98, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(99, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(100, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(101, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(102, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(103, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(104, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(105, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(106, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(107, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(108, '<p>sdfsdf</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(109, '<p>dgdfgfgfg</p>', 0, NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:13:10'),
(110, '<p>sdfsdfs</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(111, '<p>sdfsdfsd</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(112, '<p>sdfsdfs</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(113, '<p>sdfsdfsd</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(114, '<p>sdfsdf</p>', 1, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(115, '<p>ghjghj</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(116, '<p>ghjghjm</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(117, '<p>yeetr</p>', 1, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(118, '<p>ghjghj</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(119, '<p>uikyu</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(120, '<p>syte</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(121, '<p>kyukyuk</p>', 0, NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17'),
(122, '<p>English</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(123, '<p>Asam</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(124, '<p>Pusto</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(125, '<p>Bangla</p>', 1, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(126, '<p>23rd october</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(127, '<p>21st March</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(128, '<p>30th August</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(129, '<p>21st January</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(130, '<p>Donald Trump</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(131, '<p>Monmohan Singh</p>', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(132, '<p>Mohammad Ali Jinnah</p>', 1, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(133, '', 0, NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47'),
(134, '<p>11th August</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(135, '<p>21st February</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(136, '<p>26th March</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(137, '<p>16th December</p>', 1, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(138, '<p>None of above</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(139, '<p>23rd March</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(140, '<p>21st February</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(141, '<p>25th March</p>', 1, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(142, '<p>25th May</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(143, '<p>16th December</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(144, '<p>14th December</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21'),
(145, '<p>None of the above</p>', 0, NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `answer_question`
--

CREATE TABLE `answer_question` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answer_question`
--

INSERT INTO `answer_question` (`question_id`, `answer_id`) VALUES
(19, 16),
(20, 17),
(21, 18),
(22, 19),
(23, 20),
(24, 21),
(26, 23),
(27, 24),
(28, 25),
(29, 26),
(30, 27),
(31, 28),
(32, 29),
(33, 30),
(34, 31),
(35, 32),
(36, 33),
(37, 34),
(38, 35),
(39, 36),
(40, 37),
(41, 38),
(42, 39),
(43, 40),
(44, 41),
(45, 42),
(46, 43),
(47, 52),
(48, 53),
(48, 54),
(48, 55),
(48, 56),
(49, 57),
(49, 58),
(49, 59),
(49, 60),
(50, 61),
(50, 62),
(50, 63),
(50, 64),
(51, 65),
(51, 66),
(51, 67),
(51, 68),
(52, 69),
(53, 70),
(54, 71),
(54, 72),
(54, 73),
(54, 74),
(55, 75),
(55, 76),
(55, 77),
(55, 78),
(56, 79),
(56, 80),
(56, 81),
(56, 82),
(56, 83),
(57, 84),
(57, 85),
(57, 86),
(57, 87),
(57, 88),
(57, 89),
(57, 90),
(58, 91),
(58, 92),
(58, 93),
(58, 94),
(58, 95),
(59, 96),
(59, 97),
(59, 98),
(59, 99),
(59, 100),
(59, 101),
(60, 102),
(60, 103),
(60, 104),
(60, 105),
(60, 106),
(60, 107),
(60, 108),
(60, 109),
(61, 110),
(61, 111),
(61, 112),
(61, 113),
(61, 114),
(62, 115),
(62, 116),
(62, 117),
(62, 118),
(62, 119),
(62, 120),
(62, 121),
(63, 122),
(63, 123),
(63, 124),
(63, 125),
(64, 126),
(64, 127),
(64, 128),
(64, 129),
(65, 130),
(65, 131),
(65, 132),
(65, 133),
(66, 134),
(66, 135),
(66, 136),
(66, 137),
(66, 138),
(67, 139),
(67, 140),
(67, 141),
(67, 142),
(67, 143),
(67, 144),
(67, 145);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` bigint(25) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `seen`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'আমি জানতে চাই স্বাধীনতা দিবস আসলে কবে ঘোষণা করা হয়', 0, 16, 1, '2022-08-07 18:39:30', '2022-08-10 12:03:51'),
(5, 'আমি জানতে চাই স্বাধীনতা দিবস আসলে কবে ', 0, 2, 2, '2022-08-08 11:21:47', '2022-08-10 10:05:04'),
(6, '<p>test</p>', 0, 1, 1, '2022-08-10 10:46:57', '2022-08-10 12:03:45'),
(7, '<p>There are no argument but independence date declared in 16th december</p>', 0, 1, 1, '2022-08-10 10:51:04', '2022-08-10 12:03:37'),
(8, '<p>Hello there</p>', 0, 1, 1, '2022-08-10 12:00:41', '2022-08-10 12:03:31'),
(9, '<p>I want to make friends</p>', 0, 1, 1, '2022-08-10 12:01:08', '2022-08-10 12:03:19'),
(10, '<p>Comments should be over soon</p>', 0, 1, 1, '2022-08-10 12:01:52', '2022-08-10 12:03:25'),
(11, '<p>I want to mark read as comment</p>', 0, 1, 1, '2022-08-11 01:11:58', '2022-08-11 01:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `comment_question`
--

CREATE TABLE `comment_question` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_question`
--

INSERT INTO `comment_question` (`question_id`, `comment_id`) VALUES
(65, 1),
(65, 5),
(65, 6),
(65, 7),
(65, 8),
(65, 9),
(65, 10),
(65, 11);

-- --------------------------------------------------------

--
-- Table structure for table `comment_reply`
--

CREATE TABLE `comment_reply` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `reply_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_reply`
--

INSERT INTO `comment_reply` (`comment_id`, `reply_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '#FFF',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `exam_type` int(11) NOT NULL COMMENT '1=Online Test, 2= IQ Test',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `icon`, `color`, `description`, `start_date`, `end_date`, `start_time`, `end_time`, `duration`, `exam_type`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(2, 'Online test (Bangla)', NULL, NULL, '<ul><li>test1</li><li>test2</li></ul>', '2022-07-29', '2022-08-03', NULL, NULL, 40, 1, 1, 1, '2022-07-30 08:26:20', '2022-08-10 12:04:34', 1),
(3, 'IQ Test', NULL, '#8C5F5F', '<ul><li>test1</li><li>test2</li><li>etst3</li></ul>', '2022-07-31', '2022-07-31', NULL, NULL, 50, 2, 1, 1, '2022-07-30 12:31:00', '2022-08-05 04:44:07', 1),
(4, 'National Mourn Day Contest', NULL, '#807474', '<ul><li>hello</li><li>hithere</li></ul>', '2022-08-05', '2022-08-05', '13:00:00', '20:00:00', 40, 2, 1, 1, '2022-08-05 00:47:56', '2022-08-05 00:47:56', 1),
(5, 'International Mother Language Day Contest', NULL, '#CBCBCB', '<p>tetwwere</p>', '2022-08-01', '2022-08-01', '00:01:00', '23:59:00', 40, 1, 1, 1, '2022-08-05 00:53:45', '2022-08-05 00:53:45', 0),
(6, 'Independence day test', NULL, '#29716E', '<ol><li>16th december</li><li>16th december</li></ol>', '2022-12-15', '2022-12-16', '00:01:00', '23:58:00', 40, 1, 1, 1, '2022-08-05 02:13:24', '2022-08-05 02:13:24', 0),
(8, 'OOP Aptitude Test', NULL, '#B28787', '<p>teste</p>', '2022-08-05', '2022-08-05', NULL, NULL, 40, 1, 1, 1, '2022-08-05 06:27:54', '2022-08-05 06:27:54', 1),
(9, 'test', NULL, NULL, '<ul><li>1</li></ul>', '2022-08-06', '2022-08-06', NULL, NULL, 40, 1, 1, 1, '2022-08-06 01:47:56', '2022-08-06 01:47:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`exam_id`, `question_id`) VALUES
(3, 52),
(3, 53),
(5, 63),
(5, 64),
(5, 65),
(6, 66),
(6, 67);

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject`
--

CREATE TABLE `exam_subject` (
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_subject`
--

INSERT INTO `exam_subject` (`exam_id`, `subject_id`) VALUES
(2, 1),
(4, 6),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Title in English',
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Title in Bengali',
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description in English',
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Description in Bengali',
  `is_active` smallint(6) NOT NULL DEFAULT 0 COMMENT 'If 1 will show the faq section',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title_en`, `title_bn`, `description_en`, `description_bn`, `is_active`, `created_by`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'আমাদের অ্যাপ কি?', NULL, '<h6><span style=\"font-family: arial, sans-serif; font-size: 24px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\"><b>আমাদের অ্যাপ পাবলিক ব্যাঙ্কের চাকরির ইন্টারভিউতে অংশগ্রহণের আগে ব্যাঙ্কের চাকরির প্রস্তুতির কাজ করে।</b></span></h6>', 1, 1, 1, '::1', '2022-04-30 03:40:50', '2022-04-30 03:45:51'),
(3, NULL, 'tests', NULL, '<p>stest</p>', 1, 1, 1, '::1', '2022-07-20 12:31:13', '2022-07-20 12:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bn',
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `code`, `status`, `language`, `duration`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 'Hello there, we are from exclusive bd job preparation and will be launching at 21st may, 2022', 'BD-EXCLSV-SMS-7', 1, 'en', '2', 1, 1, '2022-08-06 09:42:44', '2022-08-06 12:32:22'),
(7, 'testes', 'gdfg-ed-5646', 1, 'en', '30', 1, 1, '2022-08-06 09:46:14', '2022-08-06 12:04:42'),
(9, 'hello new comers', 'BD-EXCLSV-SMS-7', 1, 'bn', '3', 1, 1, '2022-08-07 06:00:00', '2022-08-07 06:00:00'),
(10, 'vsdfsdf', 'BD-EXCLSV-SMS-9', 1, 'en', '0', 1, 1, '2022-08-07 06:01:07', '2022-08-07 06:01:07'),
(11, 'test', 'BD-EXCLSV-SMS-10', 1, 'en', '0', 1, 1, '2022-08-07 06:01:45', '2022-08-07 06:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `message_user`
--

CREATE TABLE `message_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_user`
--

INSERT INTO `message_user` (`user_id`, `message_id`) VALUES
(50, 6),
(50, 7),
(54, 6),
(54, 7),
(56, 6),
(56, 7);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_02_26_070957_laratrust_setup_tables', 2),
(5, '2022_03_12_053735_add_is_active_to_users_table', 3),
(6, '2022_03_12_073529_add_mobile_to_users_table', 4),
(7, '2022_03_12_083523_add_address_to_users_table', 5),
(8, '2022_04_18_154617_create_about_us_table', 6),
(9, '2022_04_18_154738_create_user_images_table', 6),
(10, '2022_04_18_161502_create_about_exams_table', 7),
(11, '2022_04_18_162301_create_abouts_table', 8),
(12, '2022_04_18_162740_create_faqs_table', 9),
(13, '2022_04_19_173644_create_user_profiles_table', 10),
(14, '2022_04_19_174728_create_user_education_profiles_table', 10),
(15, '2022_04_19_175848_create_app_setup_tables', 11),
(16, '2022_04_20_061040_create_questions_and_answers_table', 12),
(17, '2022_04_20_062020_create_notifications_table', 13),
(18, '2022_04_30_170557_add_ip_to_user_profiles', 14),
(19, '2022_06_25_150918_add_new_price_and_old_price_and_about_and_reference_link_to_packages', 15),
(20, '2022_06_25_151429_add_user_reference_to_packages', 16),
(21, '2022_06_25_151705_add_status_to_packages', 17),
(22, '2022_06_27_082531_add_status_to_sections', 18),
(23, '2022_06_28_185948_add_status_to_models', 19),
(24, '2022_06_28_190049_model_questions_and_subject_questions_add', 20),
(25, '2022_06_28_191542_push_notifications_and_messages', 21),
(26, '2022_06_29_165125_add_status_to_subjects', 22),
(27, '2022_07_01_075926_create_table_exams', 23),
(28, '2022_07_02_144033_add_mark_and_positive_mark_and_type_to_questions', 24),
(29, '2022_07_17_191443_rename_table', 25),
(30, '2022_07_17_192410_rename_table_question_subject', 26),
(31, '2022_07_22_115717_alter_model_subject_and_model_question_table', 27),
(32, '2022_07_22_123153_alter_models_tables', 28),
(33, '2022_07_29_063251_create_exams_table', 29),
(34, '2022_07_30_141306_add_status_column_table_exams', 30),
(35, '2022_07_30_142445_alter_table_name_from_exam_subjects_to_exam_subject', 31),
(36, '2022_07_30_142833_alter_table_name_from_exam_questions_to_exam_question', 32),
(37, '2022_08_05_151747_create_model_package_table', 33),
(38, '2022_08_05_163314_alter_model_package_table', 34),
(39, '2022_08_05_163459_alter_package_model_sets_table', 35),
(40, '2022_08_05_172708_create_model_package_table', 36),
(41, '2022_08_06_113636_add_duration_to_package_table', 37),
(42, '2022_08_06_154118_alter_message_users_table_to_message_user_table', 38),
(43, '2022_08_07_060708_alter_user_notifications_to_notification_user_table', 39),
(45, '2022_08_07_060820_alter_user_notifications_to_push_notification_user_table', 40),
(46, '2022_08_07_153933_create_comment_reply_table', 41),
(47, '2022_08_07_170224_alter_replys_table_to_replies_table', 42),
(48, '2022_08_07_170455_alter_reply_comment_table_to_comment_reply_table', 43);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFF',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `title`, `icon`, `color`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'লিখিত প্রস্তুতি', 'public/dist/img/model//1656443468.png', '#863AD9', '<p>test</p>', 1, 1, '2022-06-28 13:11:08', '2022-07-28 22:56:49', 1),
(2, 'ভাইভা প্রস্তুতি', 'public/dist/img/model//1658499319.png', '#654747', '<p>test</p>', 1, 1, '2022-07-22 08:15:19', '2022-07-28 22:57:41', 1),
(3, '2022 সালের প্রশ্ন', 'public/dist/img/model//1659588049.jpg', '#117FC2', '<ul><li>teste</li><li>testetse</li><li>testseteset&nbsp;</li><li>testesetsertset</li></ul>', 1, 1, '2022-08-03 22:40:49', '2022-08-03 22:40:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_sets_package`
--

CREATE TABLE `model_sets_package` (
  `model_sets_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_sets_package`
--

INSERT INTO `model_sets_package` (`model_sets_id`, `package_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_sets_question`
--

CREATE TABLE `model_sets_question` (
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_sets_subject`
--

CREATE TABLE `model_sets_subject` (
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_sets_subject`
--

INSERT INTO `model_sets_subject` (`model_id`, `subject_id`) VALUES
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(1, 4),
(3, 4),
(3, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFF',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `old_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `reference_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `duration` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `icon`, `color`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `about`, `new_price`, `old_price`, `reference_link`, `status`, `duration`) VALUES
(1, 'Exclusive job preparation', 'public/dist/img/package/1/1656309326.jpg', '#3D419A', '<p>test</p>', 1, 1, '2022-06-26 22:46:52', '2022-08-06 05:58:29', '<ol><li>test</li><li>test</li><li>test</li></ol>', '599.99', '799.99', 'www.exclusivejobpreparationbd.com', 1, 180),
(2, 'New package', 'public/dist/img/package//1656305273.jpg', '#AE6A6A', '<p>test</p>', 1, 1, '2022-06-26 22:47:53', '2022-08-06 05:58:26', '<ul><li>test</li><li>test</li><li>test</li></ul>', '399.99', '599.99', 'www.exclusivejobpreparationbd.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package_sections`
--

CREATE TABLE `package_sections` (
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_users`
--

CREATE TABLE `package_users` (
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(2, 'users-read', 'Read Users', 'Read Users', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(3, 'users-update', 'Update Users', 'Update Users', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(5, 'payments-create', 'Create Payments', 'Create Payments', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(6, 'payments-read', 'Read Payments', 'Read Payments', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(7, 'payments-update', 'Update Payments', 'Update Payments', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(9, 'invoice-create', 'Create Invoice', 'Create Invoice', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(10, 'invoice-read', 'Read Invoice', 'Read Invoice', '2022-02-26 01:31:28', '2022-02-26 01:31:28'),
(11, 'invoice-update', 'Update Invoice', 'Update Invoice', '2022-02-26 01:31:28', '2022-02-26 01:31:28'),
(12, 'invoice-delete', 'Delete Invoice', 'Delete Invoice', '2022-02-26 01:31:28', '2022-02-26 01:31:28'),
(13, 'profile-read', 'Read Profile', 'Read Profile', '2022-02-26 01:31:28', '2022-02-26 01:31:28'),
(14, 'profile-update', 'Update Profile', 'Update Profile', '2022-02-26 01:31:28', '2022-02-26 01:31:28'),
(15, 'project-create', 'Create Project', 'Create Project', '2022-02-26 01:31:29', '2022-02-26 01:31:29'),
(16, 'project-read', 'Read Project', 'Read Project', '2022-02-26 01:31:29', '2022-02-26 01:31:29'),
(17, 'project-update', 'Update Project', 'Update Project', '2022-02-26 01:31:29', '2022-02-26 01:31:29'),
(18, 'project-delete', 'Delete Project', 'Delete Project', '2022-02-26 01:31:29', '2022-02-26 01:31:29'),
(24, 'permission-create', 'Create Permission', 'Able to create permission', '2022-06-25 04:31:47', '2022-06-25 04:31:47'),
(25, 'permission-edit', 'Edit Permission', 'Able to edit permission', '2022-06-25 04:32:05', '2022-06-25 04:32:05'),
(26, 'permission-delete', 'Delete Permission', 'Able to delete permission', '2022-06-25 04:32:49', '2022-06-25 04:32:49'),
(27, 'permission-read', 'Read Permission', 'Able to view permission', '2022-06-25 04:33:06', '2022-06-25 04:33:06'),
(28, 'admin-add', 'Add Admin', 'Able to add admin', '2022-06-25 04:38:48', '2022-06-25 04:38:48'),
(29, 'admin-update', 'Update Admin', 'Able to update admin', '2022-06-25 04:39:42', '2022-06-25 04:39:42'),
(30, 'admin-read', 'Read Admin', 'Able to view admin', '2022-06-25 04:39:55', '2022-06-25 04:39:55'),
(31, 'admin-delete', 'Delete Admin', 'Able to activate and deactivate admins', '2022-06-25 04:40:22', '2022-06-25 04:40:22'),
(32, 'package-delete', 'Delete Package', 'Able to delete  packages', '2022-06-27 00:11:06', '2022-06-27 00:11:06'),
(33, 'package-create', 'Create Package', 'Able to create package', '2022-06-27 00:11:19', '2022-06-27 00:11:19'),
(34, 'package-edit', 'Edit Package', 'Able to edit packages', '2022-06-27 00:11:31', '2022-06-27 00:11:31'),
(35, 'package-read', 'Read Package', 'Able to view packages', '2022-06-27 00:12:44', '2022-06-27 00:12:44'),
(37, 'section-create', 'Create Section', 'Able to create section', '2022-06-27 03:22:41', '2022-06-27 03:22:41'),
(38, 'section-update', 'Update Section', 'Able to update section', '2022-06-27 03:23:15', '2022-06-27 03:23:15'),
(39, 'section-read', 'Read Section', 'Able to view section', '2022-06-27 03:23:39', '2022-06-27 03:23:39'),
(40, 'section-delete', 'Delete Section', 'Able to delete section', '2022-06-27 03:24:08', '2022-06-27 03:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 16),
(2, 1),
(2, 2),
(2, 16),
(3, 1),
(3, 16),
(4, 1),
(4, 16),
(5, 1),
(5, 16),
(6, 1),
(6, 16),
(7, 1),
(7, 16),
(8, 1),
(8, 16),
(9, 1),
(9, 2),
(9, 16),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 16),
(11, 1),
(11, 2),
(11, 16),
(12, 1),
(12, 2),
(12, 16),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 16),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 16),
(15, 1),
(15, 16),
(16, 1),
(16, 2),
(16, 3),
(16, 16),
(17, 1),
(17, 2),
(17, 16),
(18, 1),
(18, 16),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(30, 2),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(2, 39, 'App\\Models\\User'),
(4, 39, 'App\\Models\\User'),
(5, 39, 'App\\Models\\User'),
(6, 39, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `push_notifications`
--

CREATE TABLE `push_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `token_used` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `success_rate` bigint(20) UNSIGNED NOT NULL DEFAULT 100,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bn',
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `push_notifications`
--

INSERT INTO `push_notifications` (`id`, `subject`, `code`, `status`, `token_used`, `success_rate`, `language`, `duration`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'BD-EXCLSV-PUSH-1', 1, 0, 0, 'en', '60', 1, 1, '2022-08-07 06:02:01', '2022-08-07 09:33:55'),
(2, 'We are launching new package', 'BD-EXCLSV-PUSH-1', 0, 0, 0, 'bn', '20', 1, 1, '2022-08-07 09:31:14', '2022-08-07 09:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_user`
--

CREATE TABLE `push_notification_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `push_notification_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `push_notification_user`
--

INSERT INTO `push_notification_user` (`user_id`, `push_notification_id`) VALUES
(50, 1),
(50, 2),
(54, 1),
(54, 2),
(56, 1),
(56, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mark` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `negative_mark` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `type` bigint(20) UNSIGNED NOT NULL COMMENT '1 = MCQ, 2 = WRITTEN',
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `mark`, `negative_mark`, `type`, `status`) VALUES
(10, 'test', NULL, 1, 1, NULL, NULL, 1, 0, 1, 1),
(11, 'tes1', NULL, 1, 1, NULL, NULL, 1, 0, 1, 1),
(12, 'test2', NULL, 1, 1, NULL, NULL, 1, 0, 1, 1),
(13, 'test', NULL, 1, 1, '2022-07-17 12:37:25', '2022-07-17 12:37:25', 1, 0, 1, 1),
(14, 'test2', NULL, 1, 1, '2022-07-17 12:37:25', '2022-07-17 12:37:25', 1, 0, 1, 1),
(15, 'test', NULL, 1, 1, '2022-07-17 12:37:48', '2022-07-17 12:37:48', 1, 0, 1, 1),
(16, 'test2', NULL, 1, 1, '2022-07-17 12:37:48', '2022-07-17 12:37:48', 1, 0, 1, 1),
(17, '_1', NULL, 1, 1, '2022-07-17 13:11:28', '2022-07-17 13:11:28', 1, 0, 1, 1),
(18, '_1', NULL, 1, 1, '2022-07-17 13:12:46', '2022-07-17 13:12:46', 1, 0, 1, 1),
(19, '_1', NULL, 1, 1, '2022-07-17 13:15:56', '2022-07-17 13:15:56', 1, 0, 1, 1),
(20, '_2', NULL, 1, 1, '2022-07-17 13:15:56', '2022-07-17 13:15:56', 1, 0, 1, 1),
(21, '_1', NULL, 1, 1, '2022-07-17 13:17:54', '2022-07-17 13:17:54', 1, 0, 1, 1),
(22, '_2', NULL, 1, 1, '2022-07-17 13:17:54', '2022-07-17 13:17:54', 1, 0, 1, 1),
(23, 'test', NULL, 1, 1, '2022-07-17 13:22:27', '2022-07-17 13:22:27', 1, 0, 1, 1),
(24, 'test1', NULL, 1, 1, '2022-07-17 13:22:27', '2022-07-17 13:22:27', 1, 0, 1, 1),
(25, 'test', NULL, 1, 1, '2022-07-17 13:30:22', '2022-07-17 13:30:22', 1, 0, 1, 1),
(26, 'test', NULL, 1, 1, '2022-07-17 13:32:14', '2022-07-17 13:32:14', 1, 0, 1, 1),
(27, 'test1', NULL, 1, 1, '2022-07-17 13:32:14', '2022-07-17 13:32:14', 1, 0, 1, 1),
(28, 'test', NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12', 1, 0, 2, 1),
(29, 'test', NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12', 1, 0, 2, 1),
(30, 'test', NULL, 1, 1, '2022-07-17 13:35:12', '2022-07-17 13:35:12', 1, 0, 2, 1),
(31, 'Bangla test', NULL, 1, 1, '2022-07-20 12:23:19', '2022-07-21 11:09:20', 1, 0, 2, 1),
(32, 'Bangla test 1', NULL, 1, 1, '2022-07-20 12:23:19', '2022-07-21 11:09:20', 1, 0, 2, 1),
(33, 'end', NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02', 1, 0, 2, 1),
(34, 'start', NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02', 1, 0, 2, 1),
(35, 'middle', NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02', 1, 0, 2, 1),
(36, 'bottom', NULL, 1, 1, '2022-07-20 12:36:02', '2022-07-20 12:36:02', 1, 0, 2, 1),
(37, 'test', NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03', 1, 0, 2, 1),
(38, 'test', NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03', 1, 0, 2, 1),
(39, 'tes', NULL, 1, 1, '2022-07-20 12:37:03', '2022-07-20 12:37:03', 1, 0, 2, 1),
(40, 'cvxcv', NULL, 1, 1, '2022-07-20 12:39:12', '2022-07-20 12:39:12', 1, 0, 2, 1),
(41, 'xvxcv', NULL, 1, 1, '2022-07-20 12:39:12', '2022-07-20 12:39:12', 1, 0, 2, 1),
(42, 'Bangla test 2', NULL, 1, 1, '2022-07-20 12:39:57', '2022-07-21 11:09:20', 1, 0, 2, 1),
(43, 'Bangla test 3', NULL, 1, 1, '2022-07-20 12:39:57', '2022-07-21 11:09:20', 1, 0, 2, 1),
(44, 'sfdf', NULL, 1, 1, '2022-07-20 13:00:45', '2022-07-20 13:00:45', 1, 0, 2, 1),
(45, 'sdfsdf', NULL, 1, 1, '2022-07-20 13:00:45', '2022-07-20 13:00:45', 1, 0, 2, 1),
(46, 'sdfs', NULL, 1, 1, '2022-07-20 13:00:45', '2022-07-20 13:00:45', 1, 0, 2, 1),
(47, 'test', NULL, 1, 1, '2022-07-22 00:23:02', '2022-07-22 00:23:02', 1, 0, 1, 1),
(48, 'What is the capital city of bangladesh?', NULL, 1, 1, '2022-07-22 00:23:58', '2022-07-22 05:52:36', 1, 0, 1, 1),
(49, 'etst', NULL, 1, 1, '2022-07-22 00:23:58', '2022-07-22 00:23:58', 1, 0, 1, 1),
(50, 'test1', NULL, 1, 1, '2022-07-22 00:24:40', '2022-07-22 00:24:40', 1, 0, 1, 0),
(51, 'test2', NULL, 1, 1, '2022-07-22 00:24:40', '2022-07-22 00:24:40', 1, 0, 1, 0),
(52, 'test', NULL, 1, 1, '2022-07-30 23:49:49', '2022-07-30 23:49:49', 1, 0, 2, 1),
(53, 'test2', NULL, 1, 1, '2022-07-30 23:49:49', '2022-07-30 23:49:49', 1, 0, 2, 1),
(54, 'Its all about life. Which novel is this?', NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18', 1, 0, 1, 1),
(55, 'The Antraunot theory?', NULL, 1, 1, '2022-08-02 11:29:18', '2022-08-02 11:29:18', 1, 0, 1, 1),
(56, 'Hello', NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:35:55', 1, 0, 1, 1),
(57, 'Hi there', NULL, 1, 1, '2022-08-02 11:35:55', '2022-08-02 11:35:55', 1, 0, 1, 1),
(58, 'test1', 'The answer contains the history', 1, 1, '2022-08-02 23:55:50', '2022-08-05 23:10:00', 1, 0, 1, 1),
(59, 'fsdfsdf', NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-02 23:55:50', 1, 0, 1, 1),
(60, 'Testdfgdfg', NULL, 1, 1, '2022-08-02 23:55:50', '2022-08-02 23:55:50', 1, 0, 1, 1),
(61, 'ssdfsdf', NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17', 1, 0, 1, 1),
(62, 'ghjgjghjgh', NULL, 1, 1, '2022-08-02 23:59:17', '2022-08-02 23:59:17', 1, 0, 1, 1),
(63, 'What is our mother tongue?', NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47', 1, 0, 1, 0),
(64, 'When international mother language celebrated?', NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47', 1, 0, 1, 0),
(65, 'Who said \"Urdu will be mother language of east pakistan\"?', NULL, 1, 1, '2022-08-05 00:56:47', '2022-08-05 00:56:47', 1, 0, 1, 0),
(66, 'When our independence day is celebrated?', NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:15:59', 1, 0, 1, 0),
(67, 'When pakistan raid us severly?', NULL, 1, 1, '2022-08-05 02:15:59', '2022-08-05 02:15:59', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_subject`
--

CREATE TABLE `question_subject` (
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_subject`
--

INSERT INTO `question_subject` (`subject_id`, `question_id`) VALUES
(1, 31),
(1, 32),
(1, 42),
(1, 43),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(4, 44),
(4, 45),
(4, 46),
(5, 54),
(5, 55),
(6, 56),
(6, 57),
(7, 58),
(7, 59),
(7, 60),
(8, 61),
(8, 62);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reply` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `reply`, `other`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'প্রকৃত স্বাধীনতা দিবস 15 ই ডিসেম্বর, 1971 সালে ঘোষিত হয়', NULL, 18, 18, NULL, NULL),
(2, 'প্রকৃত স্বাধীনতা দিবস 15 ই ডিসেম্বর, 1971', NULL, 54, 54, NULL, NULL),
(3, 'Is there any argue happend here?', NULL, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', 'Superadmin', '2022-02-26 01:31:27', '2022-02-26 01:31:27'),
(2, 'admin', 'Admin', 'Admin', '2022-02-26 01:31:30', '2022-02-26 01:31:30'),
(3, 'vendor', 'Vendor', 'Vendor', '2022-02-26 01:31:30', '2022-02-26 01:31:30'),
(4, 'customer', 'Customer', 'Customer', '2022-02-26 01:31:31', '2022-02-26 01:31:31'),
(16, 'creator', 'Creator', 'Has permission everything', '2022-03-11 07:51:24', '2022-03-11 07:51:24'),
(26, 'app user', 'App user', 'App users can use the app', '2022-04-17 09:36:13', '2022-04-17 09:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User'),
(4, 15, 'App\\Models\\User'),
(4, 16, 'App\\Models\\User'),
(4, 18, 'App\\Models\\User'),
(4, 19, 'App\\Models\\User'),
(4, 20, 'App\\Models\\User'),
(4, 24, 'App\\Models\\User'),
(4, 28, 'App\\Models\\User'),
(4, 29, 'App\\Models\\User'),
(4, 33, 'App\\Models\\User'),
(4, 34, 'App\\Models\\User'),
(4, 35, 'App\\Models\\User'),
(4, 36, 'App\\Models\\User'),
(3, 37, 'App\\Models\\User'),
(2, 49, 'App\\Models\\User'),
(26, 50, 'App\\Models\\User'),
(26, 54, 'App\\Models\\User'),
(26, 55, 'App\\Models\\User'),
(26, 56, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFF',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `icon`, `color`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Job preparation for bcs', 'public/dist/img/section//1656344827.jpg', '#E96464', '<p>testt</p>', 1, 1, '2022-06-27 09:47:07', '2022-06-27 09:50:32', 0),
(2, 'Written Exam', 'public/dist/img/section//1656344916.png', '#442386', '<p>test</p>', 1, 1, '2022-06-27 09:48:36', '2022-06-27 09:50:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section_models`
--

CREATE TABLE `section_models` (
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFF',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `icon`, `color`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Bangal 1st paper', 'public/dist/img/subject//1656563853.jpg', '#903636', '<p>Test</p>', 1, 1, '2022-06-29 22:37:33', '2022-08-06 02:03:32', 0),
(2, 'Bangla 2nd paper', 'public/dist/img/subject/2/1656564671.jpg', '#B82D2D', '<p>Test</p>', 1, 1, '2022-06-29 22:50:29', '2022-06-29 22:59:53', 0),
(3, 'English 1st paper', NULL, '#A62222', '<p>test</p>', 1, 1, '2022-07-20 12:46:12', '2022-07-20 12:46:58', 0),
(4, 'English 2nd paprer', NULL, '#6B2ECE', '<p>test</p>', 1, 1, '2022-07-20 12:47:21', '2022-07-20 12:47:21', 1),
(5, 'Math', 'public/dist/img/subject//1658502730.png', '#3C5ECC', '<p>Test</p>', 1, 1, '2022-07-22 09:12:10', '2022-07-22 09:12:10', 1),
(6, 'General Knowledge', NULL, '#A83333', '<p>test</p>', 1, 1, '2022-08-02 11:34:41', '2022-08-02 11:34:41', 1),
(7, 'Math 1st Paper', 'public/dist/img/subject//1659506073.jpg', '#3F99D0', '<p>Hello</p>', 1, 1, '2022-08-02 23:54:33', '2022-08-02 23:54:33', 1),
(8, 'Math 2nd Paper', 'public/dist/img/subject//1659506271.png', '#84EB6C', '<p>teste</p>', 1, 1, '2022-08-02 23:57:51', '2022-08-02 23:59:40', 0),
(9, 'test', NULL, '#8E5050', '<p>sdfsdfs</p>', 1, 1, '2022-08-05 08:17:59', '2022-08-05 08:17:59', 1);

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_active`, `mobile`, `address`) VALUES
(1, 'zaman shovon', 'zaman.shovon33@gmail.com', NULL, '$2y$10$LAMQ09I6rYdLNSKjOu6lJezkq.w0KULghdU.122Oa8mV5NjotBpda', NULL, '2022-02-26 01:03:54', '2022-06-25 08:27:30', 1, NULL, NULL),
(2, 'rahat alam', 'rahat@gmail.com', NULL, '$2y$10$LAMQ09I6rYdLNSKjOu6lJezkq.w0KULghdU.122Oa8mV5NjotBpda', NULL, '2022-02-26 06:19:35', '2022-06-25 08:27:36', 1, '013-12225478', 'return'),
(15, 'leza', 'liza@gmail.com', NULL, '$2y$10$.7D9j1r1nfNbTHu69QZHiuEGA6HnV9iBSbOqx.aAbl5fJN9hWyBLa', NULL, '2022-02-26 09:23:29', '2022-06-25 07:37:23', 0, NULL, NULL),
(16, 'nazia', 'nazia@gmail.com', NULL, '$2y$10$VdpNDpvRuQP7/x4YhMmhlOtBu7wF2RdS/nxi7M8v.S0vC.2jxAVKe', NULL, '2022-02-26 09:24:00', '2022-06-25 07:37:34', 0, NULL, NULL),
(18, 'afif', 'afif@gmail.com', NULL, '$2y$10$F6SVmbuQnQO1hzMI6Pw7meJGsmtW8t9li2ePUCjSzMaEpC5/PnMqS', NULL, '2022-02-26 09:25:35', '2022-06-25 08:27:40', 1, NULL, NULL),
(34, 'Md. Moniruzzaman Shovon', 'admin@promote-up.com', NULL, '$2y$10$OqHoVxd2ZVuEGrZ3mPP5jOgZEUeTs/t5AGN2XnInAt05olKVO.x3W', NULL, '2022-02-26 10:05:02', '2022-06-25 08:27:45', 0, NULL, NULL),
(35, 'nishan', 'nishan@gmail.com', NULL, '$2y$10$0TP1SpaUIjsSwRz6vd.Bg.77H.POT7zIiJ5IoeziTlWI6MAL7GXdq', NULL, '2022-02-26 10:51:12', '2022-02-26 10:51:12', 1, NULL, NULL),
(36, 'zaman shovon', 'zama@gmail.com', NULL, '$2y$10$05nu2Pe9eL7mREI7QzY1nO/AA5mr7jO31vwTfh3OYBrV1RU4uaaBG', NULL, '2022-02-26 10:59:58', '2022-06-25 07:35:30', 0, NULL, NULL),
(37, 'sufian tarek', 'sufian@gmail.com', NULL, '$2y$10$v/D6uckBptJUMMkXlAMwWu2Gq5wjJAPAAOTUpkUqwuG8RamIyOgnS', NULL, '2022-02-26 11:00:27', '2022-02-26 11:00:27', 0, NULL, NULL),
(39, 'zaman shovon', 'zaman@etoss.com', NULL, '$2y$10$fFbxvz8mMbMkDLuRbJpwcOi2iDGxHvttabkek75TT8gpYisCAmUs2', NULL, '2022-03-12 11:25:37', '2022-06-25 04:30:03', 0, '019-39504445', 'shanir akhra, Dhaka-1236\r\nNikunju-2,Dhaka'),
(49, 'Md. Moniruzzaman Shovon', 'admin@etoss.com', NULL, '$2y$10$QFvh.nND9kdsbKwQtygYWeBNZBpyOAuXgry/xWDQuARTFV/ZWtv7.', NULL, '2022-03-12 11:40:37', '2022-06-25 04:29:07', 1, '515-63415465', 'House no:95, Shuhrawardy Avenue, Baridhara Diplomatic Zone, Dhaka-1212'),
(50, 'nahid', 'nahid@gmail.com', NULL, '$2y$10$7QfomP9YgHmWOqa9bXfsu.ydegOalctPVwi/P7U4aBuIsY5Qr34Z6', NULL, '2022-04-17 09:37:33', '2022-07-22 10:27:48', 0, '013-62558965', 'Here nahid can open the app and get the push notification'),
(54, 'ahad', 'ahad@gmail.com', NULL, '$2y$10$./56n4JEpj/jMXNTBULdjO38Cku8JIPFvAkiomBnSZYZLgRH3i2gS', NULL, '2022-04-20 08:44:48', '2022-06-25 08:38:22', 0, '013-69874569', 'test'),
(56, 'zaman shovon', 'teststt@etoss.com', NULL, '$2y$10$6WV8kMKT9SrT8a3vJxbDQOk5fICEj85MhBrcDxKRy3hFSNz/EBYoW', NULL, '2022-04-22 01:17:14', '2022-06-28 01:44:00', 1, '03698741123', 'shanir akhra, Dhaka-1236\r\nNikunju-2,Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `user_education_profiles`
--

CREATE TABLE `user_education_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passing_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgpa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_exams`
--

CREATE TABLE `user_exams` (
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Store the base path of images',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `image_path`, `user_id`, `created_by`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(3, 'public/dist/img/54/1650465888.png', 54, 1, 1, '::1', '2022-04-20 08:44:48', '2022-04-20 08:44:48'),
(5, 'public/dist/img/56/1650611834.png', 56, 1, 1, '::1', '2022-04-22 01:17:14', '2022-04-22 01:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sex` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packages` bigint(20) UNSIGNED DEFAULT NULL,
  `coin` decimal(18,2) UNSIGNED DEFAULT NULL,
  `score` decimal(18,2) UNSIGNED DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `sex`, `blood_group`, `packages`, `coin`, `score`, `date_of_birth`, `created_by`, `updated_by`, `created_at`, `updated_at`, `ip_address`) VALUES
(1, 50, 'Male', 'A+', 1, '10.00', '0.00', '1997-12-01', 1, 1, NULL, NULL, '172.32.12.28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abouts_created_by_foreign` (`created_by`),
  ADD KEY `abouts_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_created_by_foreign` (`created_by`),
  ADD KEY `answers_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `answer_question`
--
ALTER TABLE `answer_question`
  ADD PRIMARY KEY (`answer_id`,`question_id`),
  ADD KEY `question_answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_created_by_foreign` (`created_by`),
  ADD KEY `comments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `comment_question`
--
ALTER TABLE `comment_question`
  ADD PRIMARY KEY (`question_id`,`comment_id`),
  ADD KEY `comment_question_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD PRIMARY KEY (`comment_id`,`reply_id`),
  ADD KEY `reply_comment_reply_id_foreign` (`reply_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_title_unique` (`title`),
  ADD KEY `exams_created_by_foreign` (`created_by`),
  ADD KEY `exams_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`question_id`,`exam_id`),
  ADD KEY `exam_questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `exam_subject`
--
ALTER TABLE `exam_subject`
  ADD PRIMARY KEY (`subject_id`,`exam_id`),
  ADD KEY `exam_subjects_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_created_by_foreign` (`created_by`),
  ADD KEY `faqs_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `messages_subject_unique` (`subject`),
  ADD KEY `messages_created_by_foreign` (`created_by`),
  ADD KEY `messages_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `message_user`
--
ALTER TABLE `message_user`
  ADD PRIMARY KEY (`user_id`,`message_id`),
  ADD KEY `user_messages_message_id_foreign` (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `models_title_unique` (`title`),
  ADD KEY `models_created_by_foreign` (`created_by`),
  ADD KEY `models_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `model_sets_package`
--
ALTER TABLE `model_sets_package`
  ADD PRIMARY KEY (`model_sets_id`,`package_id`),
  ADD KEY `model_sets_package_package_id_foreign` (`package_id`);

--
-- Indexes for table `model_sets_question`
--
ALTER TABLE `model_sets_question`
  ADD PRIMARY KEY (`model_id`,`question_id`),
  ADD KEY `model_questions_question_id_foreign` (`question_id`);

--
-- Indexes for table `model_sets_subject`
--
ALTER TABLE `model_sets_subject`
  ADD PRIMARY KEY (`subject_id`,`model_id`),
  ADD KEY `model_subjects_model_id_foreign` (`model_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_created_by_foreign` (`created_by`),
  ADD KEY `notifications_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_title_unique` (`title`),
  ADD KEY `packages_created_by_foreign` (`created_by`),
  ADD KEY `packages_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `package_sections`
--
ALTER TABLE `package_sections`
  ADD PRIMARY KEY (`package_id`,`section_id`),
  ADD KEY `package_sections_section_id_foreign` (`section_id`);

--
-- Indexes for table `package_users`
--
ALTER TABLE `package_users`
  ADD PRIMARY KEY (`package_id`,`user_id`),
  ADD KEY `package_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `push_notifications`
--
ALTER TABLE `push_notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `push_notifications_subject_unique` (`subject`),
  ADD KEY `push_notifications_created_by_foreign` (`created_by`),
  ADD KEY `push_notifications_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `push_notification_user`
--
ALTER TABLE `push_notification_user`
  ADD PRIMARY KEY (`user_id`,`push_notification_id`),
  ADD KEY `user_notifications_push_notification_id_foreign` (`push_notification_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_created_by_foreign` (`created_by`),
  ADD KEY `questions_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `question_subject`
--
ALTER TABLE `question_subject`
  ADD PRIMARY KEY (`subject_id`,`question_id`),
  ADD KEY `subject_questions_question_id_foreign` (`question_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replys_created_by_foreign` (`created_by`),
  ADD KEY `replys_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_title_unique` (`title`),
  ADD KEY `sections_created_by_foreign` (`created_by`),
  ADD KEY `sections_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `section_models`
--
ALTER TABLE `section_models`
  ADD PRIMARY KEY (`model_id`,`section_id`),
  ADD KEY `section_models_section_id_foreign` (`section_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_title_unique` (`title`),
  ADD KEY `subjects_created_by_foreign` (`created_by`),
  ADD KEY `subjects_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_education_profiles`
--
ALTER TABLE `user_education_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_education_profiles_created_by_foreign` (`created_by`),
  ADD KEY `user_education_profiles_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `user_exams`
--
ALTER TABLE `user_exams`
  ADD PRIMARY KEY (`user_id`,`exam_id`),
  ADD KEY `user_exams_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_images_user_id_foreign` (`user_id`),
  ADD KEY `user_images_created_by_foreign` (`created_by`),
  ADD KEY `user_images_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`),
  ADD KEY `user_profiles_created_by_foreign` (`created_by`),
  ADD KEY `user_profiles_updated_by_foreign` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `push_notifications`
--
ALTER TABLE `push_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_education_profiles`
--
ALTER TABLE `user_education_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abouts`
--
ALTER TABLE `abouts`
  ADD CONSTRAINT `abouts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `abouts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answer_question`
--
ALTER TABLE `answer_question`
  ADD CONSTRAINT `question_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_question`
--
ALTER TABLE `comment_question`
  ADD CONSTRAINT `comment_question_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD CONSTRAINT `reply_comment_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_comment_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `replies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_subject`
--
ALTER TABLE `exam_subject`
  ADD CONSTRAINT `exam_subjects_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faqs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `message_user`
--
ALTER TABLE `message_user`
  ADD CONSTRAINT `user_messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `models_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_sets_package`
--
ALTER TABLE `model_sets_package`
  ADD CONSTRAINT `model_sets_package_model_sets_id_foreign` FOREIGN KEY (`model_sets_id`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `model_sets_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_sets_question`
--
ALTER TABLE `model_sets_question`
  ADD CONSTRAINT `model_questions_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `model_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_sets_subject`
--
ALTER TABLE `model_sets_subject`
  ADD CONSTRAINT `model_subjects_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `model_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `packages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_sections`
--
ALTER TABLE `package_sections`
  ADD CONSTRAINT `package_sections_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_sections_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_users`
--
ALTER TABLE `package_users`
  ADD CONSTRAINT `package_users_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `push_notifications`
--
ALTER TABLE `push_notifications`
  ADD CONSTRAINT `push_notifications_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `push_notifications_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `push_notification_user`
--
ALTER TABLE `push_notification_user`
  ADD CONSTRAINT `user_notifications_push_notification_id_foreign` FOREIGN KEY (`push_notification_id`) REFERENCES `push_notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_subject`
--
ALTER TABLE `question_subject`
  ADD CONSTRAINT `subject_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replys_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replys_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_models`
--
ALTER TABLE `section_models`
  ADD CONSTRAINT `section_models_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `section_models_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subjects_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_education_profiles`
--
ALTER TABLE `user_education_profiles`
  ADD CONSTRAINT `user_education_profiles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_profiles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_exams`
--
ALTER TABLE `user_exams`
  ADD CONSTRAINT `user_exams_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_exams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `user_images_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_images_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_profiles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
