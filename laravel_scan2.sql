-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 05:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_scan2`
--

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
(4, '2024_05_14_073240_add_student_details_to_users_table', 1),
(5, '2024_05_14_102752_add_is_admin_to_users_table', 2),
(6, '2024_05_29_054600_add_pending_to_users_table', 3),
(7, '2024_05_29_060140_create_pending_users_table', 4),
(9, '2024_05_29_065450_create_pending_users_table', 5),
(10, '2024_05_29_084252_add_section_to_users_table', 6),
(11, '2024_05_29_100642_add_last_login_at_to_users_table', 7),
(13, '2024_05_29_113109_add_last_login_and_last_logout_to_users_table', 8);

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
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pending_users`
--

INSERT INTO `pending_users` (`id`, `name`, `email`, `password`, `student_id`, `department`, `year_level`, `section`, `created_at`, `updated_at`) VALUES
(16, 'Jack Hernandez', 'jackhernandez_21ur9112@psu.edu.ph', '$2y$10$4AOM7gJaU3.n9LZ00aDM8egtGJg/oNM2zRtiFxCvCo5.cSxfsm9ce', '21-UR-9112', 'BSMATH', '2', '2A', '2024-05-30 17:48:06', '2024-05-30 17:48:06'),
(19, 'Rebecca Kim', 'rebeccakim_21ur0771@psu.edu.ph', '$2y$10$Zwu1YO2vigdLFu.NE2DB/u29N2qWKbDGLEWbm4hO6X.wlQa.l9e7O', '21-UR-0771', 'BSMATH', '2', '2B', '2024-05-30 18:37:23', '2024-05-30 18:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `year_level` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `pending` tinyint(1) NOT NULL DEFAULT 1,
  `section` varchar(255) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `student_id`, `department`, `year_level`, `is_admin`, `pending`, `section`, `last_login_at`, `last_logout_at`) VALUES
(1, 'Elijah Venisse Tabalba', 'etabalba_21ur0167@psu.edu.ph', NULL, '$2y$10$.baTU23pLm.x0KqCzSKnveFg1UsdBvU.KiCKeJ55nYiSaWMmiyfGy', NULL, '2024-05-14 00:36:29', '2024-05-14 08:16:03', '21-UR-0167', 'BSIT', '4', 0, 1, '3A', '2016-05-10 20:22:13', '2020-05-12 20:22:13'),
(5, 'Judy Ann Flores', 'jflores_21ur0115@psu.edu.ph', NULL, '$2y$10$szfNyE0tjgWXBU.za13J7eOFDcSYNF4Q8L.p1TZZEeYInOkLWgoQm', NULL, '2024-05-14 07:01:29', '2024-05-30 05:39:24', '21-UR-0115', 'BSIT', '3', 0, 1, '3A', '2024-05-30 05:39:24', '2024-05-30 05:39:24'),
(8, 'Hera Fragrance Narcizaa', 'hnarciza_21ur0116@psu.edu.ph', NULL, '$2y$10$hgRo.pSiV9f0wHAoE8uhQeZLgESTGAAorwBPiAn5ROmOIjN3IY9my', NULL, '2024-05-15 04:18:04', '2024-05-15 04:18:28', '21-UR-0166', 'BSMATH', '1', 0, 1, '4B', '2014-02-10 20:22:51', NULL),
(11, 'joreson biag', 'jbiag_21ur0169@psu.edu.ph', NULL, '$2y$10$hlyXdzATmcEu8/ZE89HY4ezVBa6VyQZ/r/tM8Ew9pfVRl9CV5GlkK', NULL, '2024-05-28 23:09:35', '2024-05-29 08:35:14', '21-UR-0169', 'BSIT', '2', 0, 1, '3A', '2024-03-13 08:35:14', '2024-05-29 08:35:14'),
(12, 'Joanna Marie Areniego', 'areniego_21ur001@psu.edu.ph', NULL, '$2y$10$MvHllOGUhIey.cWmeQxSvOISR67kDp2kDg5vtA.VPx0Z5Bp1Cl.4q', NULL, '2024-05-29 01:34:14', '2024-05-30 04:45:39', '21-UR-001', 'BSMATH', '2', 0, 1, '3A', '2024-05-30 04:45:39', '2024-05-30 04:45:39'),
(16, 'kimiiii', 'kimii_21ur01612@psu.edu.ph', NULL, '$2y$10$4zIhQg0fQm2dEY8BxebghuQJZ6kTNir9o2DEt/X9BxeTgZ6PiKg3C', NULL, '2024-05-29 05:07:04', '2024-05-29 05:07:04', '21-UR-01612', 'BSIT', '4', 0, 1, 'A', NULL, NULL),
(18, 'Admin', 'admin@gmail.com', NULL, '$2y$10$YtKTXA3VTtL38fmkbkUPMenN3J65ntVWjdqzI2WFkpg/O2f0ELP6C', NULL, NULL, '2024-05-30 19:17:37', NULL, NULL, NULL, 1, 1, NULL, '2024-05-30 19:17:36', '2024-05-30 19:17:37'),
(19, 'Elijahhhh Tabaaaaaaaa', 'kimii_21ur016157@psu.edu.ph', NULL, '$2y$10$U6X5z.yGHlx52tU3tXDb..IbFrd2h28wmK5pIQU9nBPosTNsV4CYy', NULL, '2024-05-29 09:12:31', '2024-05-29 09:30:08', '21-UR-01617', 'BSIT', '1', 0, 1, '3A', '2024-05-29 09:30:08', '2024-05-29 09:30:08'),
(24, 'Elijah Soriano', 'etabalba_21ur0160@psu.edu.ph', NULL, '$2y$10$9e1QL4QA.sIJboUyvvMbbeoIvmdbSJnoaZUmzEym5MJS53sWwyD7O', NULL, '2024-05-29 11:24:23', '2024-05-29 11:42:25', '21-UR-0130', 'BSIT', '1st year', 0, 1, 'A', '2024-05-29 11:42:25', '2024-05-29 11:42:25'),
(25, 'John Doe', 'johndoe_21ur0151@psu.edu.ph', NULL, '$2y$10$KM6KpqqBFXTzgtG8Mj0RWObksaXebfcVT10jhVPHgvlz5IJGdnk..', NULL, '2024-05-29 11:24:23', '2024-05-29 18:54:47', '21-UR-0161', 'BSIT', '1', 0, 1, 'A', NULL, NULL),
(26, 'Jane Smith', 'janesmith_21ur0162@psu.edu.ph', NULL, '$2y$10$9HIrmGxadbx.Tofp9i.dDuhKRvU2nz7opUSVQNSNknBS48b.lTdZi', NULL, '2024-05-29 11:24:23', '2024-05-29 11:24:23', '21-UR-0162', 'BSIT', '1st year', 0, 1, 'A', '2020-04-12 20:23:09', '2022-08-16 20:23:09'),
(27, 'Alice Johnson', 'alicejohnson_21ur0163@psu.edu.ph', NULL, '$2y$10$CreGhdmQ3IdZrGaY8A3WPuygnQjxGSsA10N37C.blrrrVsbFYt7.u', NULL, '2024-05-29 11:24:23', '2024-05-29 11:24:23', '21-UR-0163', 'BSIT', '1st year', 0, 1, 'A', NULL, NULL),
(28, 'Bob Brown', 'bobbrown_21ur0164@psu.edu.ph', NULL, '$2y$10$W8zZ2MA03zHKmamJk2K6LemxMd7EiB.siFe7XRy13dyVDYnKdTEyu', NULL, '2024-05-29 11:24:23', '2024-05-29 11:24:23', '21-UR-0164', 'BSIT', '1st year', 0, 1, 'A', NULL, NULL),
(30, 'Elijahhhh Tabaaboo', 'etabos_21ur0111@psu.edu.ph', NULL, '$2y$10$HNf12NHcAbS0OqCU7VL5.u5LcUf5SPim3zYO6R/99E.TM/Gspm5bq', NULL, '2024-05-30 06:48:36', '2024-05-30 06:48:36', '21-UR-0111', 'BSIT', '2', 0, 1, '3A', NULL, NULL),
(31, 'dsfsadfas', 'dasdasd_21ur0199@psu.edu.ph', NULL, '$2y$10$2v.tpQGc7leR2U7qTBASCuZYo0dgcPJf8Y.QpjUxh6Tso1autIgxC', NULL, '2024-05-30 12:03:58', '2024-05-30 12:03:58', '21-UR-0199', 'BSIT', '2', 0, 1, '1A', NULL, NULL),
(32, 'Maria Mercadejas', 'mmercadijas_21ur0222@psu.edu.ph', NULL, '$2y$10$Rx1Q5b.pP4L2jCXDJut33ezMBe1tQsQQDOgO7aJVtMSvIT2YuAlY2', NULL, '2024-05-30 17:55:11', '2024-05-30 17:55:11', '21-UR-0222', 'BSMATH', '2nd Year', 0, 1, '2B', NULL, NULL),
(33, 'Elsa Ann Johnson', 'ejohn_20ur0001@psu.edu.ph', NULL, '$2y$10$fXrCMF/WPpxVugwVTh8Ej.WGXDQYrYcZA/uJNxeaAwjtDfYzDFisC', NULL, '2024-05-30 18:26:21', '2024-05-30 18:26:21', '20-UR-0001', 'BSIT', '1st Year', 0, 1, '1A', NULL, NULL),
(34, 'Zack Smith', 'nsmitht_22ur0002@psu.edu.ph', NULL, '$2y$10$mb6hwb1AkwAI.5OzM8XN0eyT2FBLpFd81cSzSinc1TI.ruFymvMeS', NULL, '2024-05-30 18:26:21', '2024-05-30 18:26:21', '22-UR-0002', 'BSMATH', '3rd Year', 0, 1, '3B', NULL, NULL),
(35, 'Olivia Mae  Williams', 'owill_19ur0003@psu.edu.ph', NULL, '$2y$10$rFnLQhT/BJuonnV37MqZUO7z.DiFClLwTqWtej.qdMjRLonFqXPS.', NULL, '2024-05-30 18:26:21', '2024-05-30 18:26:21', '19-UR-0003', 'BSIT', '3rd Year', 0, 1, '3C', NULL, NULL),
(36, 'Zian Liam Jones', 'ljones_22ur0004@psu.edu.ph', NULL, '$2y$10$iRNSZ8QrdDrJiR049aDV1.7Pu36PX7JxL4e08lF6Dijv45ooAjRSu', NULL, '2024-05-30 18:26:21', '2024-05-30 18:26:21', '22-UR-0004', 'BSMATH', '1st Year', 0, 1, '1A', NULL, NULL),
(37, 'Ava Pink Bautista', 'aoink_22ur0005@psu.edu.ph', NULL, '$2y$10$Cv0Xf3RefNvR1sBcNumX1uQt0ir0U2G9ylqggcHSRxDGdhcH8AkLO', NULL, '2024-05-30 18:26:21', '2024-05-30 18:26:21', '22-UR-0005', 'BSIT', '1st Year', 0, 1, '1A', NULL, NULL),
(38, 'Natalie Mae Sy', 'nsy_21ur0132@psu.edu.ph', NULL, '$2y$10$gytSxM4y/.bfIiDwJ9rD.uOIkblwVH4bHgS6P/BvLhaw9oSnNUaw6', NULL, '2024-05-30 18:28:02', '2024-05-30 18:29:36', '21-UR-0132', 'BSIT', '5', 0, 1, '4B', '2024-05-30 18:29:36', '2024-05-30 18:29:36'),
(39, 'Liza Kim Chu', 'lchu_21ur34@psu.edu.ph', NULL, '$2y$10$MYS.moCl3vfiKynBk1nQeuFzZGMPkautvJ3rIdnK7XfXNw100fDz2', NULL, '2024-05-30 18:28:51', '2024-05-30 18:42:50', '21-UR-34', 'BSMATH', '3', 0, 1, '3C', '2024-05-30 18:42:50', '2024-05-30 18:42:50'),
(40, 'Princess Mae Sy', 'pmaesy_21ur0273@psu.edu.ph', NULL, '$2y$10$AesGxcfFnl/YlCHalhxDruY0Fu0gm//ih1BPlBZNoG8mfQjARE05u', NULL, '2024-05-30 18:40:49', '2024-05-30 18:40:49', '21-UR-0273', 'BSIT', '2', 0, 1, '2B', NULL, NULL),
(41, 'Bob Johnson I', 'bobjohnson_21ur2345@psu.edu.ph', NULL, '$2y$10$WmPkgAJSI9bszwf.di8Zc.JRoq1d56yecxSVNuGR7qj98ZfHBPE4W', NULL, '2024-05-30 18:41:39', '2024-05-30 18:42:08', '21-UR-2345', 'BSIT', '2', 0, 1, '2B', '2024-05-30 18:42:08', '2024-05-30 18:42:08'),
(42, 'Emily Green', 'emilygreen_21ur3456@psu.edu.ph', NULL, '$2y$10$LuGf8gf/9GHtf52M1QC0leTJw.u8F45msiolPCBb2MGs.XkRHkrAS', NULL, '2024-05-30 18:48:06', '2024-05-30 18:48:06', '21-UR-3456', 'BSMATH', '4', 0, 1, '2A', NULL, NULL),
(43, 'Natalie Reed', 'nataliereed_21ur0173@psu.edu.ph', NULL, '$2y$10$EkCU/typRI7gI.9bLdnLleCMouatbz24wAZcENg9P2cn60mEq4SZi', NULL, '2024-05-30 19:17:09', '2024-05-30 19:17:27', '21-UR-0173', 'BSMATH', '3', 0, 1, '3B', '2024-05-30 19:17:27', '2024-05-30 19:17:27');

--
-- Indexes for dumped tables
--

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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pending_users_email_unique` (`email`),
  ADD UNIQUE KEY `pending_users_student_id_unique` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
