-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 20, 2023 at 01:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `clasess`
--

CREATE TABLE `clasess` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(25) NOT NULL,
  `class_level` varchar(25) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clasess`
--

INSERT INTO `clasess` (`id`, `class_name`, `class_level`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '10', '1', 1, 1, NULL, '2023-09-03 21:33:23', '2023-09-03 21:54:56', NULL),
(2, '10', '2', 1, NULL, NULL, '2023-09-03 21:55:03', '2023-09-03 21:55:03', NULL),
(3, '10', '3', 1, NULL, NULL, '2023-09-03 21:55:12', '2023-09-03 21:55:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(12) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `deskripsi` varchar(30) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `kode`, `name`, `deskripsi`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PMK', 'Pramuka', 'Kegiatan Pramuka', '1', 1, 1, NULL, '2023-09-11 21:26:42', '2023-09-11 23:36:20', NULL),
(2, 'PKB', 'Paskibraka', 'Pengibaran Bendera Pusaka', '1', 1, 6, NULL, '2023-09-11 21:26:42', '2023-09-12 18:14:04', NULL),
(3, 'FS', 'Futsal', 'Futsal', '1', 1, 1, NULL, '2023-09-11 23:59:21', '2023-09-11 23:59:29', NULL);

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
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ketua` bigint(20) UNSIGNED DEFAULT NULL,
  `id_wakil` bigint(20) UNSIGNED DEFAULT NULL,
  `no_urut` varchar(1) DEFAULT NULL,
  `id_periode` bigint(20) UNSIGNED DEFAULT NULL,
  `quote` varchar(256) NOT NULL,
  `visi_misi` text DEFAULT NULL,
  `avatar_kandidat` varchar(64) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id`, `id_ketua`, `id_wakil`, `no_urut`, `id_periode`, `quote`, `visi_misi`, `avatar_kandidat`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 5, '1', 1, 'Bersenang-senang dan bermain-main', '<p>Seorang di antara mereka berkata, \"Janganlah kamu membunuh Yusuf, tetapi masukan saja dia ke dasar sumur agar dia dipungut oleh sebagian musafir, jika kamu hendak berbuat.\"</p>', '230911084140_sgHQ9sdmxvxOLNjBvCLZyTBAp.jpg', 1, 1, NULL, '2023-09-11 01:39:17', '2023-09-11 02:12:01', NULL);

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
(5, '2023_08_11_030812_add_field_user_table', 1),
(6, '2023_08_12_222048_create_periode_table', 1),
(7, '2023_08_12_222447_create_kandidat_table', 1),
(8, '2023_08_12_222817_create_vote_table', 1),
(9, '2023_08_14_023324_create_clasess_models_table', 1),
(10, '2023_08_14_221554_add_field_class_in_user', 1),
(11, '2023_08_15_015352_add_no_urut_table_kandidat', 1),
(12, '2023_08_16_055344_add_coulumn_table_user', 1),
(13, '2023_08_21_025840_temporrary_file_table_upload', 1),
(14, '2023_09_09_231938_add_foto_kandidat', 2),
(15, '2023_09_10_053921_add_flag_foto_periode', 2),
(17, '2023_09_12_030731_create_extra_table', 3),
(20, '2023_09_13_084944_create_table_hari', 4),
(21, '2023_09_14_033122_create_table_jadwal_hari', 4),
(24, '2023_09_14_061822_create_table_pengikut_data', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode_name` varchar(128) NOT NULL,
  `type_foto` varchar(15) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `periode_name`, `type_foto`, `flag`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023', 'User', NULL, 1, NULL, NULL, '2023-09-11 01:36:31', '2023-09-11 01:36:31', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_hari`
--

CREATE TABLE `table_hari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` tinyint(3) UNSIGNED DEFAULT NULL,
  `nama_hari` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_hari`
--

INSERT INTO `table_hari` (`id`, `kode`, `nama_hari`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Senin', NULL, NULL, NULL),
(2, 2, 'Selasa', NULL, NULL, NULL),
(3, 3, 'Rabu', NULL, NULL, NULL),
(4, 4, 'Kamis', NULL, NULL, NULL),
(5, 5, 'Jumat', NULL, NULL, NULL),
(6, 6, 'Sabtu', NULL, NULL, NULL),
(7, 7, 'Minggu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_jadwal_hari`
--

CREATE TABLE `table_jadwal_hari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pembina` bigint(20) UNSIGNED NOT NULL,
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `id_hari` bigint(20) UNSIGNED NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_jadwal_hari`
--

INSERT INTO `table_jadwal_hari` (`id`, `id_pembina`, `id_kegiatan`, `id_hari`, `jam_mulai`, `jam_selesai`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 2, 2, '13:00:00', '13:45:00', NULL, 1, NULL, NULL, '2023-09-13 20:57:06', '2023-09-13 20:57:06', NULL),
(2, 13, 2, 4, '14:00:00', '13:45:00', NULL, 1, NULL, NULL, '2023-09-13 20:57:06', '2023-09-13 20:57:06', NULL),
(3, 15, 3, 3, '13:45:00', '13:45:00', NULL, 1, NULL, NULL, '2023-09-13 21:40:31', '2023-09-13 21:40:31', NULL),
(4, 10, 1, 4, '14:00:00', '16:00:00', NULL, 1, NULL, NULL, '2023-09-13 21:50:59', '2023-09-13 21:50:59', NULL),
(5, 10, 1, 5, '15:00:00', '17:00:00', NULL, 1, NULL, NULL, '2023-09-13 21:51:00', '2023-09-13 21:51:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_pengikut_data`
--

CREATE TABLE `table_pengikut_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ekstra` bigint(20) UNSIGNED NOT NULL,
  `id_pengikut` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_pengikut_data`
--

INSERT INTO `table_pengikut_data` (`id`, `id_ekstra`, `id_pengikut`, `status`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, NULL, 1, NULL, NULL, '2023-09-20 01:48:02', '2023-09-20 01:48:02', NULL),
(2, 2, 5, NULL, 1, NULL, NULL, '2023-09-20 02:53:04', '2023-09-20 02:53:04', NULL),
(3, 3, 6, NULL, 1, NULL, NULL, '2023-09-20 03:00:32', '2023-09-20 03:00:32', NULL),
(4, 1, 7, NULL, 1, NULL, NULL, '2023-09-20 03:03:26', '2023-09-20 03:03:26', NULL),
(5, 1, 5, NULL, 1, NULL, NULL, '2023-09-20 03:04:15', '2023-09-20 03:04:15', NULL),
(6, 1, 6, NULL, 1, NULL, NULL, '2023-09-20 03:09:48', '2023-09-20 03:09:48', NULL),
(7, 2, 6, NULL, 1, NULL, NULL, '2023-09-20 03:16:58', '2023-09-20 03:16:58', NULL),
(8, 2, 7, NULL, 1, NULL, NULL, '2023-09-20 03:21:10', '2023-09-20 03:21:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temporary_file`
--

CREATE TABLE `temporary_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `roles` varchar(255) DEFAULT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `pin` varchar(4) DEFAULT NULL,
  `nis` varchar(15) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `roles` varchar(15) DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `date_login` datetime DEFAULT NULL,
  `date_logout` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `pin`, `nis`, `address`, `phone`, `roles`, `class_id`, `avatar`, `date_login`, `date_logout`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Riki', 'administrator@gmail.com', '2023-09-11 00:27:43', '$2y$10$UBYErFQhD3LRwCIvC48.k.ADaUMgI.VaTtqCPkuJZRnHs1xP93FRS', NULL, '1234', '89565555', 'Jalan Utama', '08569789744', 'Administrator', NULL, NULL, NULL, '2023-09-13 01:10:41', '2023-09-11 00:27:43', '2023-09-12 18:10:41', NULL),
(2, 'Olivia Ajeng', 'riki@gmail.com', '2023-09-11 00:27:43', '$2y$10$Zg8tZEqHytTFZILB40K5TO1gnWLwtSe8ok29sLyvGNRqZandE5loq', NULL, '1234', '89565555', 'Jalan Hutan Kayu', '0896566644', 'guru', NULL, NULL, NULL, NULL, '2023-09-11 00:27:43', '2023-09-11 00:27:43', NULL),
(3, 'Tania', 'tania@gmail.com', '2023-09-11 00:27:43', '$2y$10$j15g24DTUyWq6Gf.uhIiTee9nQvOY5hCletMFOtNgleW258qUGNny', NULL, '1234', '895675789', 'Jalan Jaksa 7', '0896547788', 'guru', NULL, NULL, NULL, NULL, '2023-09-11 00:27:43', '2023-09-11 00:27:43', NULL),
(4, 'Nuririana', 'Nuririana@gmail.com', NULL, '$2y$10$eArqoo4IK5UlSsjpZaRnd.ws6tcezhCzZuFmTjcJLzFXxSArZdpOi', NULL, '1234', '6125888', 'jalan kacang Panjang', '856954555', 'siswa', 1, NULL, NULL, NULL, '2023-09-11 01:34:09', '2023-09-11 01:34:09', NULL),
(5, 'Asmi', 'Asmi@gmail.com', NULL, '$2y$10$pG5ilIkU5.iwtEOFY2HyF.LLjQLpKfKcSZJHzJXpFeWjjzy2zf1i6', NULL, '1234', '895666', 'Jalan Panjang', '85655886', 'siswa', 1, NULL, NULL, NULL, '2023-09-11 01:34:45', '2023-09-11 01:34:45', NULL),
(6, 'Genta Rahmat Adrian', 'genta@gmail.com', NULL, '$2y$10$XVltTc7lmzgJ/6WjJLIOleLUpuId.3r59vl.GWerSNVJIAF2G5jjO', NULL, '1234', '8956652', 'Jalan kampung 2', '085695845555', 'siswa', 2, NULL, NULL, '2023-09-13 01:26:39', '2023-09-11 19:12:52', '2023-09-12 18:26:39', NULL),
(7, 'Rudi Hartono', 'rudi@gmail.com', NULL, '$2y$10$biYOZiu9jl4fCH9u.hgKMeBmNTk7yTak2jTTATHSFWc5PO34pKGlG', NULL, '1234', '58745325', 'Jalan Kampung 5', '85623545', 'siswa', 3, NULL, NULL, NULL, '2023-09-11 19:13:30', '2023-09-11 19:13:30', NULL),
(10, 'Rudi Hartono', 'rudi1@gmail.com', NULL, '$2y$10$3Z69L66CjPamOic2YxU5CenXuMKSVnYTSJ9ae4DZ5.21KeBE5Ophq', NULL, '1234', '58749851', 'Jalan Kampung 5', '85623545', 'pembina', NULL, NULL, NULL, NULL, '2023-09-11 19:13:30', '2023-09-12 20:47:48', NULL),
(12, 'wawan', 'wawan@gmail.com', NULL, '$2y$10$hgv75uC2dIv2DaQxafQXQu/.lG.i5QzuzZNpLfVF4WofRQ.eV.OZi', NULL, '1234', '7888999', 'Jalan Kampung H', '085642355', 'pembina', NULL, NULL, NULL, NULL, '2023-09-12 01:18:50', '2023-09-12 20:37:14', '2023-09-12 20:37:14'),
(13, 'Deutsc Adrian', 'Deutsc@gmail.com', NULL, '$2y$10$Mbww/epGbWyVsmA9HU/zNOmC008b8ONcoiYhu/PjexTw6oBN0Zggq', NULL, '1234', '878525', 'Jalan Nirmala', '085621455', 'pembina', NULL, NULL, NULL, NULL, '2023-09-12 01:23:14', '2023-09-12 20:33:59', NULL),
(14, 'Dhea Ananda', 'dhea@gmail.com', NULL, '$2y$10$BF0xXVfoFUvrDezlGTGzVufKp4fh1GVtRu1itmyA2IRzNp7urVm7G', NULL, '1234', '085654', 'jalan kapur', '085323255', 'pembina', NULL, NULL, NULL, NULL, '2023-09-12 02:13:19', '2023-09-12 20:32:12', NULL),
(15, 'Albert', 'albert@gmail.com', NULL, '$2y$10$MmQzJDxX45qojJumdhp5Oeol3uzeEec9pmteXD32gDuX8k/HSvyDi', NULL, '1234', '8956855', 'Jalan kapus Timur', '085665556', 'pembina', NULL, NULL, NULL, NULL, '2023-09-12 21:06:12', '2023-09-12 21:06:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trx_number` varchar(64) NOT NULL,
  `id_user_vote` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kandidat` bigint(20) UNSIGNED DEFAULT NULL,
  `id_periode` bigint(20) UNSIGNED DEFAULT NULL,
  `user_created` bigint(20) UNSIGNED DEFAULT NULL,
  `user_updated` bigint(20) UNSIGNED DEFAULT NULL,
  `user_deleted` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `trx_number`, `id_user_vote`, `id_kandidat`, `id_periode`, `user_created`, `user_updated`, `user_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2309130001', 6, 1, 1, 6, NULL, NULL, '2023-09-12 18:11:09', '2023-09-12 18:11:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clasess`
--
ALTER TABLE `clasess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clasess_user_created_foreign` (`user_created`),
  ADD KEY `clasess_user_updated_foreign` (`user_updated`),
  ADD KEY `clasess_user_deleted_foreign` (`user_deleted`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekstrakurikuler_user_created_foreign` (`user_created`),
  ADD KEY `ekstrakurikuler_user_updated_foreign` (`user_updated`),
  ADD KEY `ekstrakurikuler_user_deleted_foreign` (`user_deleted`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kandidat_id_ketua_foreign` (`id_ketua`),
  ADD KEY `kandidat_id_wakil_foreign` (`id_wakil`),
  ADD KEY `kandidat_id_periode_foreign` (`id_periode`),
  ADD KEY `kandidat_user_created_foreign` (`user_created`),
  ADD KEY `kandidat_user_updated_foreign` (`user_updated`),
  ADD KEY `kandidat_user_deleted_foreign` (`user_deleted`);

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
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periode_user_created_foreign` (`user_created`),
  ADD KEY `periode_user_updated_foreign` (`user_updated`),
  ADD KEY `periode_user_deleted_foreign` (`user_deleted`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `table_hari`
--
ALTER TABLE `table_hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_jadwal_hari`
--
ALTER TABLE `table_jadwal_hari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_jadwal_hari_id_pembina_foreign` (`id_pembina`),
  ADD KEY `table_jadwal_hari_id_kegiatan_foreign` (`id_kegiatan`),
  ADD KEY `table_jadwal_hari_id_hari_foreign` (`id_hari`),
  ADD KEY `table_jadwal_hari_user_created_foreign` (`user_created`),
  ADD KEY `table_jadwal_hari_user_updated_foreign` (`user_updated`),
  ADD KEY `table_jadwal_hari_user_deleted_foreign` (`user_deleted`);

--
-- Indexes for table `table_pengikut_data`
--
ALTER TABLE `table_pengikut_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_pengikut_data_id_ekstra_foreign` (`id_ekstra`),
  ADD KEY `table_pengikut_data_id_pengikut_foreign` (`id_pengikut`),
  ADD KEY `table_pengikut_data_user_created_foreign` (`user_created`),
  ADD KEY `table_pengikut_data_user_updated_foreign` (`user_updated`),
  ADD KEY `table_pengikut_data_user_deleted_foreign` (`user_deleted`);

--
-- Indexes for table `temporary_file`
--
ALTER TABLE `temporary_file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `temporary_file_nis_unique` (`nis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_class_id_foreign` (`class_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vote_id_user_vote_foreign` (`id_user_vote`),
  ADD KEY `vote_id_kandidat_foreign` (`id_kandidat`),
  ADD KEY `vote_id_periode_foreign` (`id_periode`),
  ADD KEY `vote_user_created_foreign` (`user_created`),
  ADD KEY `vote_user_updated_foreign` (`user_updated`),
  ADD KEY `vote_user_deleted_foreign` (`user_deleted`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clasess`
--
ALTER TABLE `clasess`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_hari`
--
ALTER TABLE `table_hari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `table_jadwal_hari`
--
ALTER TABLE `table_jadwal_hari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_pengikut_data`
--
ALTER TABLE `table_pengikut_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `temporary_file`
--
ALTER TABLE `temporary_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clasess`
--
ALTER TABLE `clasess`
  ADD CONSTRAINT `clasess_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `clasess_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `clasess_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD CONSTRAINT `ekstrakurikuler_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ekstrakurikuler_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ekstrakurikuler_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD CONSTRAINT `kandidat_id_ketua_foreign` FOREIGN KEY (`id_ketua`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kandidat_id_periode_foreign` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`),
  ADD CONSTRAINT `kandidat_id_wakil_foreign` FOREIGN KEY (`id_wakil`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kandidat_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kandidat_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kandidat_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `periode`
--
ALTER TABLE `periode`
  ADD CONSTRAINT `periode_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `periode_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `periode_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `table_jadwal_hari`
--
ALTER TABLE `table_jadwal_hari`
  ADD CONSTRAINT `table_jadwal_hari_id_hari_foreign` FOREIGN KEY (`id_hari`) REFERENCES `table_hari` (`id`),
  ADD CONSTRAINT `table_jadwal_hari_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `ekstrakurikuler` (`id`),
  ADD CONSTRAINT `table_jadwal_hari_id_pembina_foreign` FOREIGN KEY (`id_pembina`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_jadwal_hari_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_jadwal_hari_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_jadwal_hari_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `table_pengikut_data`
--
ALTER TABLE `table_pengikut_data`
  ADD CONSTRAINT `table_pengikut_data_id_ekstra_foreign` FOREIGN KEY (`id_ekstra`) REFERENCES `ekstrakurikuler` (`id`),
  ADD CONSTRAINT `table_pengikut_data_id_pengikut_foreign` FOREIGN KEY (`id_pengikut`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_pengikut_data_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_pengikut_data_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_pengikut_data_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `clasess` (`id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_id_kandidat_foreign` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id`),
  ADD CONSTRAINT `vote_id_periode_foreign` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`),
  ADD CONSTRAINT `vote_id_user_vote_foreign` FOREIGN KEY (`id_user_vote`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vote_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vote_user_deleted_foreign` FOREIGN KEY (`user_deleted`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vote_user_updated_foreign` FOREIGN KEY (`user_updated`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
