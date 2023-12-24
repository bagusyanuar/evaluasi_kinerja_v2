-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2021 at 12:07 AM
-- Server version: 10.3.30-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u7082880_evaluasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessor`
--

CREATE TABLE `accessor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessor`
--

INSERT INTO `accessor` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 14, 'Asesor Balai', '2021-09-02 01:02:12', '2021-09-28 08:49:26'),
(2, 24, 'Asesor Balai 2', '2021-09-02 23:52:43', '2021-09-02 23:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `accessor_ppk`
--

CREATE TABLE `accessor_ppk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppk_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessor_ppk`
--

INSERT INTO `accessor_ppk` (`id`, `user_id`, `name`, `created_at`, `updated_at`, `ppk_id`) VALUES
(5, 13, 'Asesor PPK 1.1 Prov. Jawa Timur', '2021-09-02 01:00:59', '2021-09-28 08:21:09', 2),
(6, 16, 'Asesor PPK 1.2 Prov. Jawa Timur', '2021-09-02 01:41:14', '2021-09-28 08:21:37', 1),
(7, 21, 'Asesor PPK 1.3 Prov. Jawa Timur', '2021-09-02 23:50:40', '2021-09-28 08:22:16', 3),
(8, 22, 'Asesor PPK 1.4 Prov. Jawa Timur', '2021-09-02 23:51:32', '2021-09-28 08:23:11', 1),
(9, 23, 'Asesor PPK 1.5 Prov. Jawa Timur', '2021-09-02 23:52:05', '2021-09-28 08:24:07', 3),
(10, 25, 'Asesor PPK 1.6 Prov. Jawa Timur', '2021-09-28 08:24:39', '2021-09-28 08:24:39', 6),
(11, 26, 'Asesor PPK 1.7 Prov. Jawa Timur', '2021-09-28 08:25:12', '2021-09-28 08:25:12', 7),
(12, 27, 'Asesor PPK 2.1 Prov. Jawa Timur', '2021-09-28 08:26:09', '2021-09-28 08:26:09', 8),
(13, 28, 'Asesor PPK 2.2 Prov. Jawa Timur', '2021-09-28 08:26:51', '2021-09-28 08:26:51', 9),
(14, 29, 'Asesor PPK 2.3 Prov. Jawa Timur', '2021-09-28 08:27:24', '2021-09-28 08:27:24', 10),
(15, 30, 'Asesor PPK 2.4 Prov. Jawa Timur', '2021-09-28 08:28:20', '2021-09-28 08:28:20', 11),
(16, 31, 'Asesor PPK 2.5 Prov. Jawa Timur', '2021-09-28 08:28:58', '2021-09-28 08:28:58', 12),
(17, 32, 'Asesor PPK 2.6 Prov. Jawa Timur', '2021-09-28 08:29:37', '2021-09-28 08:29:37', 13),
(18, 33, 'Asesor PPK 3.1 Prov. Jawa Timur', '2021-09-28 08:30:24', '2021-09-28 08:30:24', 14),
(19, 34, 'Asesor PPK 3.2 Prov. Jawa Timur', '2021-09-28 08:31:03', '2021-09-28 08:31:03', 15),
(20, 35, 'Asesor PPK 3.3 Prov. Jawa Timur', '2021-09-28 08:31:45', '2021-09-28 08:31:45', 16),
(21, 36, 'Asesor PPK 3.4 Prov. Jawa Timur', '2021-09-28 08:32:21', '2021-09-28 08:32:21', 17),
(22, 37, 'Asesor PPK 3.5 Prov. Jawa Timur', '2021-09-28 08:32:58', '2021-09-28 08:32:58', 18),
(23, 38, 'Asesor PPK 3.6 Prov. Jawa Timur', '2021-09-28 08:33:31', '2021-09-28 08:33:31', 19),
(24, 39, 'Asesor PPK 4.1 Prov. Jawa Timur', '2021-09-28 08:34:04', '2021-09-28 08:34:04', 20),
(25, 40, 'Asesor PPK 4.2 Prov. Jawa Timur', '2021-09-28 08:34:35', '2021-09-28 08:34:35', 21),
(26, 41, 'Asesor PPK 4.3 Prov. Jawa Timur', '2021-09-28 08:35:42', '2021-09-28 08:35:42', 22),
(27, 42, 'Asesor PPK 4.4 Prov. Jawa Timur', '2021-09-28 08:36:30', '2021-09-28 08:36:30', 23),
(28, 43, 'Asesor PPK 4.5 Prov. Jawa Timur', '2021-09-28 08:37:03', '2021-09-28 08:37:03', 24),
(29, 44, 'Asesor PPK 4.6 Prov. Jawa Timur', '2021-09-28 08:37:31', '2021-09-28 08:37:31', 25),
(30, 45, 'Asesor PPK 1.1 Prov. Bali', '2021-09-28 08:38:08', '2021-09-28 08:38:08', 32),
(31, 46, 'Asesor PPK 1.2 Prov. Bali', '2021-09-28 08:38:44', '2021-09-28 08:38:44', 33),
(32, 47, 'Asesor PPK 2.1 Prov. Bali', '2021-09-28 08:39:31', '2021-09-28 08:39:31', 34),
(33, 48, 'Asesor PPK 2.2 Prov. Bali', '2021-09-28 08:40:15', '2021-09-28 08:40:15', 35),
(34, 49, 'Asesor PPK 3.1 Prov. Bali', '2021-09-28 08:40:52', '2021-09-28 08:40:52', 36),
(35, 50, 'Asesor PPK 3.2 Prov. Bali', '2021-09-28 08:41:25', '2021-09-28 08:41:25', 37),
(36, 51, 'Asesor PPK 3.3 Prov. Bali', '2021-09-28 08:42:01', '2021-09-28 08:42:01', 38),
(37, 52, 'Asesor PPK Perencanaan P2JN Prov. Jawa Timur', '2021-09-28 08:43:25', '2021-09-28 08:43:25', 28),
(38, 53, 'Asesor PPK Pengawasan P2JN Prov. Jawa Timur', '2021-09-28 08:45:44', '2021-09-28 08:45:44', 29),
(39, 54, 'Asesor PPK Pengawasan P2JN Prov. Bali', '2021-09-28 08:46:48', '2021-09-28 08:46:48', 31),
(40, 55, 'Asesor PPK Perencanaan P2JN Prov. Bali', '2021-09-28 08:47:33', '2021-09-28 08:47:33', 30),
(41, 56, 'Asesor PPK Suramadu 1', '2021-09-28 08:48:16', '2021-09-28 08:48:16', 26),
(42, 57, 'Asesor PPK Suramadu 2', '2021-09-28 08:48:42', '2021-09-28 08:48:42', 27);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 15, 'Admin Balai', '2021-09-02 01:02:45', '2021-09-28 08:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `claim_notification`
--

CREATE TABLE `claim_notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claim_notification`
--

INSERT INTO `claim_notification` (`id`, `title`, `description`, `text`, `file`, `sender_id`, `recipient_id`, `notification_id`, `created_at`, `updated_at`, `is_read`) VALUES
(1, 'Pesan Sanggahan', 'Pesan Sanggahan Terhadap Penilaian Indicator Pemenuhan Seluruh Kompetensi TK Yang Di Perlukan.', 'Pesan Sanggahan Terhadap Penilaian Indicator Pemenuhan Seluruh Kompetensi TK Yang Di Perlukan. bos ku', '/files/9f909d72-1c51-11ec-8458-2cf05d717790.pdf', 10, 16, 7, '2021-09-23 02:24:44', '2021-09-23 02:35:43', 0),
(2, 'Pesan Sanggahan', 'Pesan Sanggahan Terhadap Penilaian Indicator Produktivitas Tenaga Kerja (TK) Secara Umum.', 'asdasdfqwe', '/files/c4f9e900-1cfc-11ec-957a-2cf05d717790.xlsx', 10, 16, 6, '2021-09-24 06:00:50', '2021-09-24 06:00:50', 1);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indicator`
--

CREATE TABLE `indicator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weight` double(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indicator`
--

INSERT INTO `indicator` (`id`, `name`, `created_at`, `updated_at`, `weight`) VALUES
(6, 'Sumber Daya Manusia / Personil', '2021-08-30 03:01:11', '2021-08-30 03:01:11', 0.155),
(7, 'Bahan / Material', '2021-08-30 03:08:51', '2021-08-30 03:08:51', 0.132),
(8, 'Peralatan Berat', '2021-08-30 03:10:57', '2021-08-30 03:10:57', 0.117),
(9, 'Peralatan Laboratorium', '2021-08-30 03:17:49', '2021-09-01 00:29:57', 0.114),
(10, 'Keuangan', '2021-09-01 00:30:24', '2021-09-01 00:30:24', 0.109),
(11, 'Lingkungan Lokasi', '2021-09-01 00:33:34', '2021-09-01 00:33:34', 0.066),
(12, 'Metode Kerja', '2021-09-01 00:36:19', '2021-09-01 00:36:19', 0.091),
(13, 'Pengendalian Pekerjaan', '2021-09-01 00:40:51', '2021-09-01 00:40:51', 0.083),
(14, 'Manajemen Kontrak dan Addendum', '2021-09-01 00:43:40', '2021-09-01 00:43:40', 0.070),
(15, 'Hubugan Dengan Stakeholder', '2021-09-01 00:44:13', '2021-09-01 00:44:13', 0.061);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_08_27_071853_admin_profile', 1),
(6, '2021_08_27_072048_accessor_profile', 1),
(7, '2021_08_27_072254_accessor_ppk_profile', 1),
(8, '2021_08_27_072346_vendor_profile', 1),
(9, '2021_08_27_072821_ppk', 1),
(10, '2021_08_27_073137_packet_packet_', 1),
(11, '2021_08_27_073616_indicator', 1),
(12, '2021_08_27_075319_sub_indicator', 1),
(14, '2021_08_27_082304_add_vendor_package', 2),
(15, '2021_08_27_090300_add_ppk_to_accessor_ppk', 3),
(16, '2021_08_29_092449_add_value_sub_indicator', 4),
(17, '2021_08_29_094141_create_score', 5),
(18, '2021_08_29_181905_create_superadmins_table', 6),
(19, '2021_08_30_061211_add_duration_to_package', 7),
(21, '2021_08_30_075658_add_no_kontrak', 8),
(22, '2021_08_30_082812_create_package_detail', 9),
(23, '2021_08_30_092842_add_no_addendum', 10),
(26, '2021_08_30_103727_add_type_to_score', 11),
(27, '2021_08_31_064601_add_indicator_weight', 11),
(28, '2021_08_31_065543_drop_sub_indicator_weight', 12),
(29, '2021_08_31_070611_change_float_score_to_int', 13),
(30, '2021_08_31_090426_update_indicator_table', 14),
(31, '2021_09_16_085602_create_history', 15),
(32, '2021_09_22_071656_add_image', 16),
(35, '2021_09_22_080022_create_notification', 17),
(38, '2021_09_23_053757_add_claim_notif', 18),
(39, '2021_09_23_055228_add_isread', 18),
(42, '2021_09_23_071831_add_is_read_claim_notification', 19),
(43, '2021_09_23_073538_add_type_to_notif', 19);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('accessorppk','accessor') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `score_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `type`, `vendor_id`, `sender_id`, `score_id`, `is_active`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Kesesuaian Penempatan TK Terhadap Bidang Keahlian Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessor', 10, 14, 124, 0, 1, '2021-09-22 02:35:22', '2021-09-23 01:50:59'),
(2, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Koordinasi Antar TK Pada Saat Pelaksanaan Pekerjaan Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessor', 10, 14, 125, 0, 1, '2021-09-22 02:40:51', '2021-09-23 01:48:20'),
(3, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Konsistensi TK Sesuai Kontrak (Tidak Berganti Personil) Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessor', 10, 14, 126, 0, 1, '2021-09-22 02:44:33', '2021-09-23 01:48:15'),
(4, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Kelengkapan Dokumen Sertifikasi Keahlian dan Ketrampilan Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessor', 10, 14, 127, 0, 1, '2021-09-22 22:42:39', '2021-09-23 01:48:12'),
(5, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Pemenuhan Administrasi Pengujian dan Ijin Persetujuan Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessor', 10, 14, 128, 0, 1, '2021-09-23 00:51:37', '2021-09-23 01:48:03'),
(6, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Produktivitas Tenaga Kerja (TK) Secara Umum Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessorppk', 10, 16, 129, 1, 1, '2021-09-23 00:52:09', '2021-09-23 01:53:35'),
(7, 'Peringatan Nilai', 'Hasil Penilaian dari Indikator Pemenuhan Seluruh Kompetensi TK Yang Di Perlukan Masih Belum Memenuhi Standar Baik. Silahkan Melakukan Perbaikan.', 'accessorppk', 10, 16, 131, 1, 1, '2021-09-23 00:57:22', '2021-09-23 02:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `ppk_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` date NOT NULL DEFAULT '2021-08-30',
  `finish_at` date NOT NULL DEFAULT '2021-08-30',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `no_reference`, `date`, `name`, `vendor_id`, `ppk_id`, `start_at`, `finish_at`, `created_at`, `updated_at`) VALUES
(1, 'PKT_1/29123/123', '2021-08-30', 'Pelebaran Jalan Menambah Lajur Titik A - Titik B', 10, 1, '2021-09-01', '2021-09-30', '2021-08-27 08:42:02', '2021-08-27 08:42:02'),
(5, 'PKT_5/245/1200', '2021-09-01', 'Pembuatan Jembatan Jombang', 12, 2, '2021-09-01', '2021-09-30', '2021-09-02 01:03:58', '2021-09-28 08:50:36'),
(6, 'PKT_6/12841/12049', '2021-09-30', 'Pengaspalan Jalan Raya Waru', 18, 3, '2021-09-01', '2021-09-30', '2021-09-02 23:43:48', '2021-09-28 08:51:02'),
(7, 'PKT_4/12378/91230', '2021-09-01', 'Pembuatan Fly Over di Mojokerto', 20, 3, '2021-09-02', '2021-10-31', '2021-09-02 23:54:05', '2021-09-28 08:51:26'),
(8, 'PKT_7/6767/9284', '2021-09-09', 'Pembuatan Underpass Malang', 19, 1, '2021-09-30', '2021-10-31', '2021-09-02 23:55:49', '2021-09-02 23:55:49'),
(9, 'PKT_9/9282/9918', '2021-09-08', 'Penutupan Lubang Jalan Di Jalan Ahmad Yani', 18, 2, '2021-09-01', '2021-09-30', '2021-09-02 23:57:49', '2021-09-28 08:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `package_detail`
--

CREATE TABLE `package_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `no_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_addendum` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_detail`
--

INSERT INTO `package_detail` (`id`, `package_id`, `no_reference`, `date_addendum`, `created_at`, `updated_at`) VALUES
(1, 1, 'ADD_1/123/1234', '2021-08-30', '2021-08-30 09:32:30', '2021-08-30 09:32:30'),
(2, 1, 'ADD_2/234/2345', '2021-08-31', '2021-08-30 02:49:13', '2021-08-30 02:49:13');

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppk`
--

CREATE TABLE `ppk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ppk`
--

INSERT INTO `ppk` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PPK 1.1 Provinsi Jawa Timur', '2021-08-27 08:42:18', '2021-09-28 08:09:54'),
(2, 'PPK 1.2 Provinsi Jawa Timur', '2021-08-27 08:42:31', '2021-09-28 08:10:05'),
(3, 'PPK 1.3 Provinsi Jawa Timur', '2021-09-02 23:42:22', '2021-09-28 08:10:22'),
(4, 'PPK 1.4 Provinsi Jawa Timur', '2021-09-28 08:10:34', '2021-09-28 08:10:34'),
(5, 'PPK 1.5 Provinsi Jawa Timur', '2021-09-28 08:10:42', '2021-09-28 08:10:42'),
(6, 'PPK 1.6 Provinsi Jawa Timur', '2021-09-28 08:10:51', '2021-09-28 08:10:51'),
(7, 'PPK 1.7 Provinsi Jawa Timur', '2021-09-28 08:10:59', '2021-09-28 08:10:59'),
(8, 'PPK 2.1 Provinsi Jawa Timur', '2021-09-28 08:11:11', '2021-09-28 08:11:11'),
(9, 'PPK 2.2 Provinsi Jawa Timur', '2021-09-28 08:11:20', '2021-09-28 08:11:20'),
(10, 'PPK 2.3 Provinsi Jawa Timur', '2021-09-28 08:11:30', '2021-09-28 08:11:30'),
(11, 'PPK 2.4 Provinsi Jawa Timur', '2021-09-28 08:11:39', '2021-09-28 08:11:39'),
(12, 'PPK 2.5 Provinsi Jawa Timur', '2021-09-28 08:11:53', '2021-09-28 08:11:53'),
(13, 'PPK 2.6 Provinsi Jawa Timur', '2021-09-28 08:12:38', '2021-09-28 08:12:38'),
(14, 'PPK 3.1 Provinsi Jawa Timur', '2021-09-28 08:12:50', '2021-09-28 08:12:50'),
(15, 'PPK 3.2 Provinsi Jawa Timur', '2021-09-28 08:12:59', '2021-09-28 08:12:59'),
(16, 'PPK 3.3 Provinsi Jawa Timur', '2021-09-28 08:13:09', '2021-09-28 08:13:09'),
(17, 'PPK 3.4 Provinsi Jawa Timur', '2021-09-28 08:13:20', '2021-09-28 08:13:20'),
(18, 'PPK 3.5 Provinsi Jawa Timur', '2021-09-28 08:13:30', '2021-09-28 08:13:30'),
(19, 'PPK 3.6 Provinsi Jawa Timur', '2021-09-28 08:13:42', '2021-09-28 08:13:42'),
(20, 'PPK 4.1 Provinsi Jawa Timur', '2021-09-28 08:13:54', '2021-09-28 08:13:54'),
(21, 'PPK 4.2 Provinsi Jawa Timur', '2021-09-28 08:14:03', '2021-09-28 08:14:03'),
(22, 'PPK 4.3 Provinsi Jawa Timur', '2021-09-28 08:14:19', '2021-09-28 08:14:19'),
(23, 'PPK 4.4 Provinsi Jawa Timur', '2021-09-28 08:14:30', '2021-09-28 08:14:30'),
(24, 'PPK 4.5 Provinsi Jawa Timur', '2021-09-28 08:14:40', '2021-09-28 08:14:40'),
(25, 'PPK 4.6 Provinsi Jawa Timur', '2021-09-28 08:14:48', '2021-09-28 08:14:48'),
(26, 'PPK Suramadu 1', '2021-09-28 08:15:47', '2021-09-28 08:15:47'),
(27, 'PPK Suramadu 2', '2021-09-28 08:15:55', '2021-09-28 08:15:55'),
(28, 'PPK Perencanaan P2JN Prov. Jawa Timur', '2021-09-28 08:16:42', '2021-09-28 08:16:42'),
(29, 'PPK Pengawasan P2JN Prov. Jawa Timur', '2021-09-28 08:16:55', '2021-09-28 08:16:55'),
(30, 'PPK Perencanaan P2JN Prov. Bali', '2021-09-28 08:17:59', '2021-09-28 08:17:59'),
(31, 'PPK Pengawasan P2JN Prov. Bali', '2021-09-28 08:18:13', '2021-09-28 08:18:13'),
(32, 'PPK 1.1 Provinsi Bali', '2021-09-28 08:18:40', '2021-09-28 08:18:40'),
(33, 'PPK 1.2 Provinsi Bali', '2021-09-28 08:18:48', '2021-09-28 08:18:48'),
(34, 'PPK 2.1 Provinsi Bali', '2021-09-28 08:18:56', '2021-09-28 08:18:56'),
(35, 'PPK 2.2 Provinsi Bali', '2021-09-28 08:19:04', '2021-09-28 08:19:04'),
(36, 'PPK 3.1 Provinsi Bali', '2021-09-28 08:19:16', '2021-09-28 08:19:16'),
(37, 'PPK 3.2 Provinsi Bali', '2021-09-28 08:19:24', '2021-09-28 08:19:24'),
(38, 'PPK 3.3 Provinsi Bali', '2021-09-28 08:19:40', '2021-09-28 08:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_id` bigint(20) UNSIGNED NOT NULL,
  `sub_indicator_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bad',
  `type` enum('office','ppk','vendor') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `package_id`, `evaluator_id`, `sub_indicator_id`, `score`, `text`, `type`, `file`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 1, 10, 10, 3, 'good', 'vendor', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Produktivitas-Tenaga-Kerja-(TK)-Secara-Umum.pdf', 10, '2021-08-31 07:04:41', '2021-09-01 22:59:02'),
(3, 1, 10, 11, 3, 'good', 'vendor', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Pemenuhan-Seluruh-Kompetensi-TK-Yang-Di-Perlukan.docx', 10, '2021-08-31 07:04:41', '2021-09-02 00:53:13'),
(5, 1, 10, 12, 3, 'good', 'vendor', NULL, 10, '2021-08-31 07:04:41', '2021-08-31 07:04:41'),
(6, 1, 10, 25, 3, 'good', 'vendor', NULL, 10, '2021-08-31 07:04:41', '2021-08-31 07:04:41'),
(7, 1, 10, 26, 3, 'good', 'vendor', NULL, 10, '2021-08-31 07:04:41', '2021-08-31 07:04:41'),
(8, 1, 10, 27, 3, 'good', 'vendor', NULL, 10, '2021-08-31 07:04:41', '2021-08-31 07:04:41'),
(9, 1, 10, 28, 3, 'good', 'vendor', NULL, 10, '2021-08-31 07:04:41', '2021-09-01 22:51:26'),
(10, 1, 10, 13, 1, 'bad', 'vendor', NULL, 10, '2021-09-01 03:19:44', '2021-09-01 03:24:56'),
(11, 1, 10, 14, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:20:20', '2021-09-01 03:25:03'),
(12, 1, 10, 15, 2, 'bad', 'vendor', NULL, 10, '2021-09-01 03:20:25', '2021-09-01 03:25:09'),
(13, 1, 11, 10, 3, 'good', 'office', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Produktivitas-Tenaga-Kerja-(TK)-Secara-Umum.png', 11, '2021-08-31 07:04:41', '2021-09-22 01:18:55'),
(14, 1, 10, 29, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:25:16', '2021-09-01 03:25:16'),
(15, 1, 10, 30, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:25:18', '2021-09-01 03:25:18'),
(16, 1, 10, 31, 1, 'bad', 'vendor', NULL, 10, '2021-09-01 03:25:33', '2021-09-01 03:25:33'),
(17, 1, 10, 32, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:25:41', '2021-09-01 03:25:41'),
(18, 1, 10, 33, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:25:44', '2021-09-01 03:25:44'),
(19, 1, 10, 16, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:33:44', '2021-09-01 03:33:44'),
(20, 1, 10, 17, 2, 'bad', 'vendor', NULL, 10, '2021-09-01 03:33:46', '2021-09-01 03:33:46'),
(21, 1, 10, 18, 3, 'good', 'vendor', NULL, 10, '2021-09-01 03:33:49', '2021-09-02 00:55:25'),
(22, 1, 10, 19, 3, 'good', 'vendor', NULL, 10, '2021-09-01 03:33:51', '2021-09-02 00:55:27'),
(23, 1, 10, 20, 3, 'good', 'vendor', NULL, 10, '2021-09-01 03:33:53', '2021-09-02 00:55:30'),
(24, 1, 10, 21, 3, 'good', 'vendor', NULL, 10, '2021-09-01 03:33:56', '2021-09-02 00:55:34'),
(25, 1, 10, 22, 2, 'medium', 'vendor', NULL, 10, '2021-09-01 03:34:02', '2021-09-02 00:55:32'),
(26, 1, 10, 23, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:35:22', '2021-09-01 03:35:22'),
(27, 1, 10, 24, 2, 'bad', 'vendor', NULL, 10, '2021-09-01 03:35:39', '2021-09-01 03:35:39'),
(28, 1, 10, 34, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:35:44', '2021-09-01 03:35:44'),
(29, 1, 10, 35, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:37:15', '2021-09-01 03:37:15'),
(30, 1, 10, 36, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:37:18', '2021-09-01 03:37:18'),
(31, 1, 10, 37, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:37:20', '2021-09-01 03:37:20'),
(32, 1, 10, 38, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:37:22', '2021-09-01 03:37:22'),
(33, 1, 10, 39, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:39:20', '2021-09-01 03:39:20'),
(34, 1, 10, 40, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:39:43', '2021-09-01 03:39:43'),
(35, 1, 10, 41, 3, 'medium', 'vendor', NULL, 10, '2021-09-01 03:39:45', '2021-09-01 03:39:45'),
(36, 1, 10, 45, 3, 'good', 'vendor', NULL, 10, '2021-09-01 22:49:41', '2021-09-01 22:49:41'),
(37, 1, 10, 46, 2, 'medium', 'vendor', NULL, 10, '2021-09-01 22:50:11', '2021-09-01 22:50:11'),
(38, 1, 10, 47, 3, 'good', 'vendor', NULL, 10, '2021-09-01 22:50:13', '2021-09-01 22:50:13'),
(39, 5, 14, 10, 3, 'good', 'office', '/files/Pembuatan-Jembatan-Jurug-Produktivitas-Tenaga-Kerja-(TK)-Secara-Umum.xlsx', 14, '2021-09-02 01:25:39', '2021-09-02 01:26:32'),
(40, 5, 14, 11, 3, 'good', 'office', NULL, 14, '2021-09-02 01:26:51', '2021-09-02 01:26:51'),
(41, 5, 14, 12, 3, 'good', 'office', NULL, 14, '2021-09-02 01:26:53', '2021-09-02 01:26:53'),
(42, 5, 14, 25, 3, 'good', 'office', NULL, 14, '2021-09-02 01:26:56', '2021-09-02 01:26:56'),
(43, 5, 14, 26, 3, 'good', 'office', NULL, 14, '2021-09-02 01:26:58', '2021-09-02 01:26:58'),
(44, 5, 14, 27, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:00', '2021-09-02 01:27:00'),
(45, 5, 14, 28, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:27:06', '2021-09-02 01:27:06'),
(46, 5, 14, 13, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:27:14', '2021-09-02 01:27:14'),
(47, 5, 14, 14, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:19', '2021-09-02 01:27:19'),
(48, 5, 14, 15, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:27:22', '2021-09-02 01:27:22'),
(49, 5, 14, 29, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:33', '2021-09-02 01:27:33'),
(50, 5, 14, 30, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:35', '2021-09-02 01:27:35'),
(51, 5, 14, 31, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:27:39', '2021-09-02 01:27:39'),
(52, 5, 14, 32, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:42', '2021-09-02 01:27:42'),
(53, 5, 14, 33, 3, 'good', 'office', NULL, 14, '2021-09-02 01:27:44', '2021-09-02 01:27:44'),
(54, 5, 14, 16, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:28:21', '2021-09-02 01:28:21'),
(55, 5, 14, 17, 3, 'good', 'office', NULL, 14, '2021-09-02 01:28:25', '2021-09-02 01:28:25'),
(56, 5, 14, 18, 3, 'good', 'office', NULL, 14, '2021-09-02 01:28:29', '2021-09-02 01:28:29'),
(57, 5, 14, 19, 3, 'good', 'office', NULL, 14, '2021-09-02 01:28:40', '2021-09-02 01:28:40'),
(58, 5, 14, 20, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:28:42', '2021-09-02 01:28:42'),
(59, 5, 14, 21, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:28:45', '2021-09-02 01:28:45'),
(60, 5, 14, 22, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:28:47', '2021-09-02 01:28:47'),
(61, 5, 14, 23, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:29:17', '2021-09-02 01:29:17'),
(62, 5, 14, 24, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:29:20', '2021-09-02 01:29:20'),
(63, 5, 14, 34, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:29:22', '2021-09-02 01:29:22'),
(64, 5, 14, 35, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:29:26', '2021-09-02 01:29:26'),
(65, 5, 14, 36, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:29:31', '2021-09-02 01:29:31'),
(66, 5, 14, 37, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:29:33', '2021-09-02 01:29:33'),
(67, 5, 14, 38, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:29:38', '2021-09-02 01:29:38'),
(68, 5, 14, 39, 3, 'good', 'office', NULL, 14, '2021-09-02 01:29:47', '2021-09-02 01:29:47'),
(69, 5, 14, 40, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:29:49', '2021-09-02 01:29:49'),
(70, 5, 14, 41, 3, 'good', 'office', NULL, 14, '2021-09-02 01:29:51', '2021-09-02 01:29:51'),
(71, 5, 14, 42, 3, 'good', 'office', NULL, 14, '2021-09-02 01:29:55', '2021-09-02 01:29:55'),
(72, 5, 14, 43, 3, 'good', 'office', NULL, 14, '2021-09-02 01:29:58', '2021-09-02 01:29:58'),
(73, 5, 14, 44, 3, 'good', 'office', NULL, 14, '2021-09-02 01:30:01', '2021-09-02 01:30:01'),
(74, 5, 14, 45, 3, 'good', 'office', NULL, 14, '2021-09-02 01:32:01', '2021-09-02 01:32:01'),
(75, 5, 14, 46, 3, 'good', 'office', NULL, 14, '2021-09-02 01:32:03', '2021-09-02 01:32:03'),
(76, 5, 14, 47, 3, 'good', 'office', NULL, 14, '2021-09-02 01:32:05', '2021-09-02 01:32:05'),
(77, 5, 14, 48, 3, 'good', 'office', NULL, 14, '2021-09-02 01:32:07', '2021-09-02 01:32:07'),
(78, 5, 14, 49, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:32:13', '2021-09-02 01:32:13'),
(79, 5, 14, 50, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:32:41', '2021-09-02 01:32:41'),
(80, 5, 14, 51, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:32:43', '2021-09-02 01:32:43'),
(81, 5, 14, 52, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:32:46', '2021-09-02 01:32:46'),
(82, 5, 14, 53, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:32:50', '2021-09-02 01:32:50'),
(83, 5, 14, 54, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:32:52', '2021-09-02 01:32:52'),
(84, 5, 14, 55, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:32:55', '2021-09-02 01:32:55'),
(85, 5, 14, 56, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:33:00', '2021-09-02 01:33:00'),
(86, 5, 14, 57, 3, 'good', 'office', NULL, 14, '2021-09-02 01:33:08', '2021-09-02 01:33:08'),
(87, 5, 14, 58, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:33:10', '2021-09-02 01:33:10'),
(88, 5, 14, 59, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:33:12', '2021-09-02 01:33:12'),
(89, 5, 14, 60, 3, 'good', 'office', NULL, 14, '2021-09-02 01:33:19', '2021-09-02 01:33:19'),
(90, 5, 14, 61, 3, 'good', 'office', NULL, 14, '2021-09-02 01:33:22', '2021-09-02 01:33:22'),
(91, 5, 14, 62, 3, 'good', 'office', NULL, 14, '2021-09-02 01:33:25', '2021-09-02 01:33:25'),
(92, 5, 14, 63, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:33:48', '2021-09-02 01:33:48'),
(93, 5, 14, 64, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:33:51', '2021-09-02 01:33:51'),
(94, 5, 14, 65, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:33:53', '2021-09-02 01:33:53'),
(95, 5, 14, 66, 1, 'bad', 'office', NULL, 14, '2021-09-02 01:33:58', '2021-09-02 01:33:58'),
(96, 5, 14, 67, 3, 'good', 'office', NULL, 14, '2021-09-02 01:34:03', '2021-09-02 01:34:03'),
(97, 5, 14, 68, 3, 'good', 'office', NULL, 14, '2021-09-02 01:34:06', '2021-09-02 01:34:06'),
(98, 5, 14, 69, 3, 'good', 'office', NULL, 14, '2021-09-02 01:34:09', '2021-09-02 01:34:09'),
(99, 5, 14, 70, 2, 'medium', 'office', NULL, 14, '2021-09-02 01:34:12', '2021-09-02 01:34:12'),
(100, 5, 14, 71, 3, 'good', 'office', NULL, 14, '2021-09-02 01:34:16', '2021-09-02 01:34:16'),
(101, 5, 13, 10, 2, 'medium', 'ppk', NULL, 13, '2021-09-02 01:44:54', '2021-09-02 01:44:54'),
(102, 5, 13, 11, 3, 'good', 'ppk', NULL, 13, '2021-09-02 01:44:56', '2021-09-02 01:44:56'),
(103, 5, 13, 12, 3, 'good', 'ppk', NULL, 13, '2021-09-02 01:44:59', '2021-09-02 01:44:59'),
(104, 5, 13, 25, 2, 'medium', 'ppk', NULL, 13, '2021-09-02 01:45:01', '2021-09-02 01:45:01'),
(105, 5, 13, 26, 3, 'good', 'ppk', NULL, 13, '2021-09-02 01:45:04', '2021-09-02 01:45:04'),
(106, 5, 13, 27, 3, 'good', 'ppk', NULL, 13, '2021-09-02 01:45:06', '2021-09-02 01:45:06'),
(107, 5, 13, 28, 2, 'medium', 'ppk', NULL, 13, '2021-09-02 01:45:09', '2021-09-02 01:45:09'),
(108, 5, 12, 10, 3, 'good', 'vendor', NULL, 12, '2021-09-02 01:54:04', '2021-09-02 01:54:04'),
(111, 5, 13, 13, 3, 'good', 'ppk', NULL, 13, '2021-09-14 23:54:16', '2021-09-14 23:54:16'),
(112, 5, 13, 14, 3, 'good', 'ppk', NULL, 13, '2021-09-16 02:45:15', '2021-09-16 02:45:15'),
(113, 5, 13, 15, 2, 'medium', 'ppk', NULL, 13, '2021-09-16 02:46:34', '2021-09-16 02:46:34'),
(121, 9, 13, 10, 3, 'good', 'ppk', NULL, 13, '2021-09-17 00:49:49', '2021-09-17 01:09:43'),
(122, 1, 14, 11, 2, 'medium', 'office', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Pemenuhan-Seluruh-Kompetensi-TK-Yang-Di-Perlukan1632299448.pdf', 14, '2021-09-21 01:42:38', '2021-09-22 01:30:48'),
(123, 1, 14, 12, 3, 'good', 'office', NULL, 14, '2021-09-22 02:34:58', '2021-09-22 02:39:19'),
(124, 1, 14, 25, 3, 'good', 'office', NULL, 14, '2021-09-22 02:35:22', '2021-09-22 02:39:01'),
(125, 1, 14, 26, 3, 'good', 'office', NULL, 14, '2021-09-22 02:40:51', '2021-09-22 02:40:58'),
(126, 1, 14, 27, 3, 'good', 'office', NULL, 14, '2021-09-22 02:44:28', '2021-09-22 02:44:40'),
(127, 1, 14, 28, 2, 'medium', 'office', NULL, 14, '2021-09-22 22:42:39', '2021-09-22 22:42:39'),
(128, 1, 14, 13, 2, 'medium', 'office', '/files/Pembuatan-Jembatan-Jurug-Produktivitas-Tenaga-Kerja-(TK)-Secara-Umum.xlsx', 14, '2021-09-23 00:51:37', '2021-09-23 00:51:37'),
(129, 1, 16, 10, 2, 'medium', 'ppk', NULL, 16, '2021-09-23 00:52:09', '2021-09-23 00:52:09'),
(131, 1, 16, 11, 1, 'bad', 'ppk', NULL, 16, '2021-09-23 00:57:22', '2021-09-23 00:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `score_history`
--

CREATE TABLE `score_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `sub_indicator_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('office','ppk','vendor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `score_before` int(11) NOT NULL DEFAULT 0,
  `text_before` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bad',
  `file_before` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_after` int(11) NOT NULL DEFAULT 0,
  `text_after` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bad',
  `file_after` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_total_before` double(8,2) NOT NULL DEFAULT 0.00,
  `score_total_after` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `score_history`
--

INSERT INTO `score_history` (`id`, `package_id`, `author_id`, `sub_indicator_id`, `type`, `score_before`, `text_before`, `file_before`, `score_after`, `text_after`, `file_after`, `score_total_before`, `score_total_after`, `created_at`, `updated_at`) VALUES
(14, 9, 13, 10, 'ppk', 3, 'good', NULL, 2, 'medium', NULL, -4.43, -5.53, '2021-09-17 00:50:03', '2021-09-17 00:50:03'),
(15, 9, 13, 10, 'ppk', 2, 'medium', NULL, 3, 'good', NULL, -5.53, -4.43, '2021-09-17 01:09:43', '2021-09-17 01:09:43'),
(16, 1, 14, 10, 'office', 3, 'good', NULL, 2, 'medium', NULL, -4.43, -5.53, '2021-09-21 01:37:47', '2021-09-21 01:37:47'),
(17, 1, 14, 10, 'office', 2, 'medium', NULL, 1, 'bad', NULL, -2.21, -3.32, '2021-09-21 01:51:02', '2021-09-21 01:51:02'),
(18, 1, 14, 10, 'office', 1, 'bad', NULL, 3, 'good', NULL, -3.32, -1.11, '2021-09-21 01:52:24', '2021-09-21 01:52:24'),
(19, 1, 14, 11, 'office', 3, 'good', NULL, 2, 'medium', NULL, -1.11, -2.21, '2021-09-21 01:59:36', '2021-09-21 01:59:36'),
(20, 1, 14, 10, 'office', 3, 'good', NULL, 3, 'good', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Produktivitas-Tenaga-Kerja-(TK)-Secara-Umum.png', -2.21, -2.21, '2021-09-22 01:18:55', '2021-09-22 01:18:55'),
(21, 1, 14, 11, 'office', 2, 'medium', NULL, 2, 'medium', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Pemenuhan-Seluruh-Kompetensi-TK-Yang-Di-Perlukan.pdf', -2.21, -2.21, '2021-09-22 01:21:07', '2021-09-22 01:21:07'),
(22, 1, 14, 11, 'office', 2, 'medium', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Pemenuhan-Seluruh-Kompetensi-TK-Yang-Di-Perlukan.pdf', 2, 'medium', '/files/Pelebaran-Jalan-Menambah-Lajur-Titik-A---Titik-B-Pemenuhan-Seluruh-Kompetensi-TK-Yang-Di-Perlukan1632299448.pdf', -2.21, -2.21, '2021-09-22 01:30:48', '2021-09-22 01:30:48'),
(23, 1, 14, 25, 'office', 1, 'bad', NULL, 3, 'good', NULL, 1.11, 3.32, '2021-09-22 02:39:01', '2021-09-22 02:39:01'),
(24, 1, 14, 12, 'office', 2, 'medium', NULL, 2, 'medium', NULL, 3.32, 3.32, '2021-09-22 02:39:15', '2021-09-22 02:39:15'),
(25, 1, 14, 12, 'office', 2, 'medium', NULL, 3, 'good', NULL, 3.32, 4.43, '2021-09-22 02:39:19', '2021-09-22 02:39:19'),
(26, 1, 14, 26, 'office', 1, 'bad', NULL, 3, 'good', NULL, 5.54, 7.75, '2021-09-22 02:40:58', '2021-09-22 02:40:58'),
(27, 1, 14, 27, 'office', 3, 'good', NULL, 2, 'medium', NULL, 11.07, 9.97, '2021-09-22 02:44:33', '2021-09-22 02:44:33'),
(28, 1, 14, 27, 'office', 2, 'medium', NULL, 3, 'good', NULL, 9.97, 11.07, '2021-09-22 02:44:40', '2021-09-22 02:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `sub_indicator`
--

CREATE TABLE `sub_indicator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_indicator`
--

INSERT INTO `sub_indicator` (`id`, `name`, `indicator_id`, `created_at`, `updated_at`) VALUES
(10, 'Produktivitas Tenaga Kerja (TK) Secara Umum', 6, '2021-08-30 03:02:12', '2021-08-30 03:02:12'),
(11, 'Pemenuhan Seluruh Kompetensi TK Yang Di Perlukan', 6, '2021-08-30 03:03:04', '2021-08-30 03:03:04'),
(12, 'Pemenuhan Jumlah TK Saat Pelaksanaan Kegiatan', 6, '2021-08-30 03:08:38', '2021-08-30 03:08:38'),
(13, 'Pemenuhan Administrasi Pengujian dan Ijin Persetujuan', 7, '2021-08-30 03:09:43', '2021-08-30 03:09:43'),
(14, 'Pemenuhan Jumlah Supply Terhadap Kebutuhan', 7, '2021-08-30 03:10:10', '2021-08-30 03:10:10'),
(15, 'Kecepatan Waktu Pemesanan dan Pengiriman', 7, '2021-08-30 03:10:46', '2021-08-30 03:10:46'),
(16, 'Pemenuhan Standar Kelaikan dan Surat Ijin Operasi', 8, '2021-08-30 03:11:45', '2021-08-30 03:11:45'),
(17, 'Pemenuhan Jumlah dan Jenis Peralatan Yang Dibutuhkan', 8, '2021-08-30 03:13:18', '2021-08-30 03:13:18'),
(18, 'Kecepatan Waktu Mobilisasi Peralatan Berat', 8, '2021-08-30 03:14:13', '2021-08-30 03:14:13'),
(19, 'Kondisi Peralatan Berat (Fungsionalitas dan Produktifitas)', 8, '2021-08-30 03:15:09', '2021-08-30 03:15:09'),
(20, 'Kompetensi dan Sertifikasi Operator Peralatan Berat', 8, '2021-08-30 03:15:58', '2021-08-30 03:15:58'),
(21, 'Ketersediaan Suku Cadang dan Peralatan Servis', 8, '2021-08-30 03:16:39', '2021-08-30 03:16:39'),
(22, 'Kelengkapan Petunjuk Teknis Operasional / Buku Manual', 8, '2021-08-30 03:17:32', '2021-08-30 03:17:32'),
(23, 'Kesesuaian Jenis Peralatan Dengan Kebutuhan Pengujian', 9, '2021-08-30 03:19:03', '2021-08-30 03:19:03'),
(24, 'Pemenuhan Jumlah Peralatan dan Perlengakapannya', 9, '2021-08-30 03:30:01', '2021-08-30 03:30:01'),
(25, 'Kesesuaian Penempatan TK Terhadap Bidang Keahlian', 6, '2021-09-01 00:21:18', '2021-09-01 00:21:18'),
(26, 'Koordinasi Antar TK Pada Saat Pelaksanaan Pekerjaan', 6, '2021-09-01 00:22:25', '2021-09-01 00:22:25'),
(27, 'Konsistensi TK Sesuai Kontrak (Tidak Berganti Personil)', 6, '2021-09-01 00:22:50', '2021-09-01 00:22:50'),
(28, 'Kelengkapan Dokumen Sertifikasi Keahlian dan Ketrampilan', 6, '2021-09-01 00:23:18', '2021-09-01 00:23:18'),
(29, 'Kondisi Bahan/Material Sesuai dan Tidak Rusak', 7, '2021-09-01 00:23:55', '2021-09-01 00:23:55'),
(30, 'Kesiapan Terhadap Quarry Cadangan Bila Dibutuhkan', 7, '2021-09-01 00:24:21', '2021-09-01 00:24:21'),
(31, 'Pemenuhan Kaji ulang Setiap Kedatangan Bahan / Material', 7, '2021-09-01 00:26:21', '2021-09-01 00:26:21'),
(32, 'Konsistensi Harga Sesuai Kesepakatan Kontrak', 7, '2021-09-01 00:26:42', '2021-09-01 00:26:42'),
(33, 'Konsistensi Tipe dan Spesifikasi Bahan / Material', 7, '2021-09-01 00:27:03', '2021-09-01 00:27:03'),
(34, 'Kalaikan Fungsi Peralatan Laboratorium', 9, '2021-09-01 00:27:36', '2021-09-01 00:27:36'),
(35, 'Pemenuhan Kompetensi Teknisi Laboratorium', 9, '2021-09-01 00:27:59', '2021-09-01 00:27:59'),
(36, 'Kondisi Fisik dan Fungsional Peralatan Laboratorium', 9, '2021-09-01 00:28:31', '2021-09-01 00:28:31'),
(37, 'Ketersediaan Cadangan Atau Suku Cadang Peralatan Uji', 9, '2021-09-01 00:29:14', '2021-09-01 00:29:14'),
(38, 'Pemenuhan Kalibrasi dan Pemeriksaan Akurasi Hasil Uji', 9, '2021-09-01 00:29:39', '2021-09-01 00:29:39'),
(39, 'Kecepatan Dalam Penyiapan Data Dukung MC', 10, '2021-09-01 00:30:59', '2021-09-01 00:30:59'),
(40, 'Ketepatan Waktu dan Kelengkapan Backup MC', 10, '2021-09-01 00:31:47', '2021-09-01 00:31:47'),
(41, 'Alur Kas / Pengelolaan Keuangan Penyedia Jasa', 10, '2021-09-01 00:32:09', '2021-09-01 00:32:09'),
(42, 'Pengendalian Biaya Konstruksi (Efisiensi)', 10, '2021-09-01 00:32:27', '2021-09-01 00:32:27'),
(43, 'Pembayaran Kewajiban Terhadap Supplier / Vendor / Subkon', 10, '2021-09-01 00:32:50', '2021-09-01 00:32:50'),
(44, 'Respon Terhadap Perubahan Kebijakan dan Eskalasi BIaya', 10, '2021-09-01 00:33:10', '2021-09-01 00:33:10'),
(45, 'Kecepatan Pengenalan dan Peninjauan Lokasi', 11, '2021-09-01 00:33:56', '2021-09-01 00:33:56'),
(46, 'Upaya Identifikasi Potensi Perubahan Akibat Kondisi Lokasi', 11, '2021-09-01 00:34:20', '2021-09-01 00:34:20'),
(47, 'Kesiapan Strategi Adaptif Terhadap Perubahan Iklim', 11, '2021-09-01 00:35:09', '2021-09-01 00:35:09'),
(48, 'Kesiapan Terhadap Gangguan Keamanan / Keselamatan', 11, '2021-09-01 00:35:36', '2021-09-01 00:35:36'),
(49, 'Pengelolaan Konflik dan Hubungan Masyarakat', 11, '2021-09-01 00:35:57', '2021-09-01 00:35:57'),
(50, 'Ketepatan Analisa Pemilihan Metode Pekerjaan', 12, '2021-09-01 00:37:15', '2021-09-01 00:37:15'),
(51, 'Kepatuhan Terhadap Metode Kerja yang Telah Di Sepakati', 12, '2021-09-01 00:37:37', '2021-09-01 00:37:37'),
(52, 'Kesesuaian Metode Kerja Dengan Standar dan Spesifikasi', 12, '2021-09-01 00:38:07', '2021-09-01 00:38:07'),
(53, 'Penyediaan Dokumen Teknis Pendukung Pelaksanaan', 12, '2021-09-01 00:39:14', '2021-09-01 00:39:14'),
(54, 'Penggunaan Alokasi SDM Sesuai Kebutuhan Kerja', 12, '2021-09-01 00:39:34', '2021-09-01 00:39:34'),
(55, 'Penggunaan Alat dan Bahan Sesuai Kebutuhan Kerja', 12, '2021-09-01 00:40:03', '2021-09-01 00:40:03'),
(56, 'Kecepatan Penyesuaian Metode Kerja Bila Diperlukan', 12, '2021-09-01 00:40:21', '2021-09-01 00:40:21'),
(57, 'Pembuatan skedul dan Perubahannya Bila Di Perlukan', 13, '2021-09-01 00:41:25', '2021-09-01 00:41:25'),
(58, 'Kecepatan Pengajuan dan Tindal Lanjut Request', 13, '2021-09-01 00:41:41', '2021-09-01 00:41:41'),
(59, 'Pengujian Mutu Hasil Pekerjaan dan Pelaporannya', 13, '2021-09-01 00:42:01', '2021-09-01 00:42:01'),
(60, 'Penerapan SMKK dan Pengadministrasiannya', 13, '2021-09-01 00:42:21', '2021-09-01 00:42:21'),
(61, 'Kepatuhan Terhadap Mekanisme Pengendalian', 13, '2021-09-01 00:42:47', '2021-09-01 00:42:47'),
(62, 'Setiap Manajer Efektif Melaksanakan Pengendalian', 13, '2021-09-01 00:43:07', '2021-09-01 00:43:07'),
(63, 'Kecepatan Penyiapan Kebutuhan Data Dukung Teknis', 14, '2021-09-01 00:44:59', '2021-09-01 00:44:59'),
(64, 'Kemampuan Melakukan Analisis Justifikasi Teknis', 14, '2021-09-01 00:45:17', '2021-09-01 00:45:17'),
(65, 'Pengendalian Kontrak Dengan sub Kontraktor', 14, '2021-09-01 00:45:32', '2021-09-01 00:45:32'),
(66, 'Kecepatan Pengajuan Addendum (Sebelum Progress 50%)', 14, '2021-09-01 00:45:55', '2021-09-01 00:45:55'),
(67, 'Komunikasi dan Koordinasi Dengan Pengguna Jasa', 15, '2021-09-01 00:46:16', '2021-09-01 00:46:16'),
(68, 'Koordinasi Dengan Konsultan Pengawas / Supervisi', 15, '2021-09-01 00:46:35', '2021-09-01 00:46:35'),
(69, 'Koordinasi Dengan Pihak Ke-3 (Supplier, Vendor, Subkon)', 15, '2021-09-01 00:47:03', '2021-09-01 00:47:03'),
(70, 'Koordinasi Dengan Masyarakat / Aparat Desa Setempat', 15, '2021-09-01 00:47:21', '2021-09-01 00:47:21'),
(71, 'Koordinasi Dengan Pemda dan Unit Teknis Lain Terkait', 15, '2021-09-01 00:47:38', '2021-09-01 00:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `superuser`
--

CREATE TABLE `superuser` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `superuser`
--

INSERT INTO `superuser` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 11, 'Super User', '2021-09-01 00:19:51', '2021-09-27 10:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `roles`, `created_at`, `updated_at`, `image`) VALUES
(10, 'wika@gmail.com', 'wikakon', '$2y$10$XwC.uE6uqWlM9Zku09iP.OdMlwp6Dx3oFEbyPDElfCHwPnEZ2g4p.', '[\"vendor\"]', '2021-08-27 02:54:17', '2021-09-28 08:54:12', '/images/profile/a6a5c506-2039-11ec-82c5-83122ef1fa0b.png'),
(11, 'super@gmail.com', 'super', '$2y$10$nMcAZmxtp9GHiE5p6EvyXurJh1SJxczyVDCw55QV32vfdg2BQR9zu', '[\"superuser\"]', '2021-09-01 00:19:51', '2021-09-27 10:32:18', '/images/profile/308d8dba-1f7e-11ec-8e32-850f7085b21e.png'),
(12, 'apb@gmail.com', 'apb123', '$2y$10$quwcyhI/MgYOaCqpIzU.c.4D7MFRj0qCh4GqYOqpx63m66mxpOAOq', '[\"vendor\"]', '2021-09-02 01:00:05', '2021-09-28 08:55:40', '/images/profile/db43aae4-2039-11ec-bc55-05c7b05b9360.jpg'),
(13, 'asesorjatim11@gmail.com', 'asesorjatim11', '$2y$10$qAUZ9T8e68CushPcYW75g.fCnCwVKHrR/zixOk1M6kTUdYzpYlw3.', '[\"accessorppk\"]', '2021-09-02 01:00:59', '2021-09-28 08:21:08', NULL),
(14, 'asesorbalai@gmail.com', 'asesorbalai', '$2y$10$BZlwiUNS2QYLV8lLRLwv0esLxHtCC1VPszpYGSAt6527emEhmNKxS', '[\"accessor\"]', '2021-09-02 01:02:12', '2021-09-28 08:49:26', '/images/profile/fc6e1ebc-2038-11ec-8fc0-b98950120211.png'),
(15, 'adminbalai@gmail.com', 'adminbalai', '$2y$10$hPpWdR5Qlah8OMYHOIqopOrNZg3gPF1OvhHdgsaRpBFxzDwLuc9gO', '[\"admin\"]', '2021-09-02 01:02:45', '2021-09-28 08:49:54', '/images/profile/0cd5686e-2039-11ec-a696-d1ef5c415194.png'),
(16, 'asesorjatim12@gmail.com', 'asesorjatim12', '$2y$10$HH4nwLu29rXGfdWATD1S1.IHu3qTAsBoCyvvbWjTU7RBfp9p0K4em', '[\"accessorppk\"]', '2021-09-02 01:41:14', '2021-09-28 08:21:37', NULL),
(17, 'nindyakarya@gmail.com', 'nindyakarya', '$2y$10$2/Es7C7tev02ev3HNbkUs.yqTyo4E9lO0iekOdzTGxOBdFkCsPF2K', '[\"vendor\"]', '2021-09-02 23:45:52', '2021-09-28 08:56:31', '/images/profile/f9d94108-2039-11ec-add6-a1409c46230d.png'),
(18, 'adhikarya@gmail.com', 'adhikarya', '$2y$10$XgGqMvtbwnx81bQuwNgsxezwZDYgzpdDEPRv3FFZFZVnglDYGuEtC', '[\"vendor\"]', '2021-09-02 23:46:42', '2021-09-28 08:58:56', '/images/profile/5008a71c-203a-11ec-8e64-fb0840105047.jpg'),
(19, 'amartakarya@gmail.com', 'amartakarya', '$2y$10$0HVu.Nk.9m57cWc24exaqOvNtQtcFsHmQbsbdQubRtn75Hz84l5cu', '[\"vendor\"]', '2021-09-02 23:47:10', '2021-09-28 08:59:40', '/images/profile/6a1c2a66-203a-11ec-9a18-75c56c1cd9bf.jpg'),
(20, 'brantasabi@gmail.com', 'brantasabi', '$2y$10$qKB8YPlSbzCFM9UorCb/8.vpd2DKo2wLMgpDrTInQnXccwWJCaXCu', '[\"vendor\"]', '2021-09-02 23:48:33', '2021-09-28 09:00:17', '/images/profile/807e57a2-203a-11ec-a508-9fbcde8d7b09.jpg'),
(21, 'asesorjatim13@gmail.com', 'asesorjatim13', '$2y$10$QhcnnclB5sw7yHi2PZhlOeIn2dMqgfnPhgCmNC0i.2rUddzmF8UXa', '[\"accessorppk\"]', '2021-09-02 23:50:40', '2021-09-28 08:22:16', NULL),
(22, 'asesorjatim14@gmail.com', 'asesorjatim14', '$2y$10$s243nWndeOmYAb.8GLjs8evC9H/fvQ0.0EbINoAmxchi3AXyPHcL6', '[\"accessorppk\"]', '2021-09-02 23:51:32', '2021-09-28 08:23:11', NULL),
(23, 'asesorjatim15@gmail.com', 'asesorjatim15', '$2y$10$fraeQ5b9CaVYbeMQ8gxe9OPDf34P6CsN37as1Q0pIPzFkayQW45A2', '[\"accessorppk\"]', '2021-09-02 23:52:05', '2021-09-28 08:24:07', NULL),
(24, 'asesorbalai2@gmail.com', 'asesorbalai2', '$2y$10$CB4Lqq9NOl5KBJYOOl/0Ne6XeVUJjUKrGQiEYZ8Bdk4KI2yHPtTG6', '[\"accessor\"]', '2021-09-02 23:52:43', '2021-09-02 23:52:43', NULL),
(25, 'asesorjatim16@gmail.com', 'asesorjatim16', '$2y$10$f3P2V1fTOVbsg8878oVfKOho4FOVsCGlDkHMOfxyCxyRh.T/2qUYG', '[\"accessorppk\"]', '2021-09-28 08:24:39', '2021-09-28 08:24:39', NULL),
(26, 'asesorjatim17@gmail.com', 'asesorjatim17', '$2y$10$W4Tqxz/x3lNZHq69mx6X9.01nxbmw3DJDusoJNzvADKJdQ4kK5/Nm', '[\"accessorppk\"]', '2021-09-28 08:25:12', '2021-09-28 08:25:12', NULL),
(27, 'asesorjatim21@gmail.com', 'asesorjatim21', '$2y$10$W.KdfFh2b1xZYo430aTMsup2ugypj5gtO5MpmrX3Sl/NnBCAd.bVW', '[\"accessorppk\"]', '2021-09-28 08:26:09', '2021-09-28 08:26:09', NULL),
(28, 'asesorjatim22@gmail.com', 'asesorjatim22', '$2y$10$BvmcAGn.ZCMm/Hod3WuFkuiyiwY6lJ3lDXYDgKSiN4ux3nrlTuryK', '[\"accessorppk\"]', '2021-09-28 08:26:51', '2021-09-28 08:26:51', NULL),
(29, 'asesorjatim23@gmail.com', 'asesorjatim23', '$2y$10$vLg00fDKCCL8qmtpRqAfn.jVa6BLJhHG1UnH3EUNH29Q7/6oqOMcC', '[\"accessorppk\"]', '2021-09-28 08:27:24', '2021-09-28 08:27:24', NULL),
(30, 'asesorjatim24@gmail.com', 'asesorjatim24', '$2y$10$jFZ.05y.BRX5vh6qAOGxKu7c8ysms9JII5.elGfpWY3a4NUcUXy1W', '[\"accessorppk\"]', '2021-09-28 08:28:20', '2021-09-28 08:28:20', NULL),
(31, 'asesorjatim25@gmail.com', 'asesorjatim25', '$2y$10$oTgHNgU0Z9JVAqxyQjIc1OgCx9Vhh/372Y3v7IZV3H0/1hKlD4ayy', '[\"accessorppk\"]', '2021-09-28 08:28:58', '2021-09-28 08:28:58', NULL),
(32, 'asesorjatim26@gmail.com', 'asesorjatim26', '$2y$10$5nTuVZi8WXM//4QcL/hjIeistpq3yfu1Wfy28Fnpk7kU1NC3w4qlW', '[\"accessorppk\"]', '2021-09-28 08:29:37', '2021-09-28 08:29:37', NULL),
(33, 'asesorjatim31@gmail.com', 'asesorjatim31', '$2y$10$vV5gXQ5C5R6Lc8WdK7HI8ONnL/8ZjXAsNwKFA/yrCM41txvC/G0SC', '[\"accessorppk\"]', '2021-09-28 08:30:24', '2021-09-28 08:30:24', NULL),
(34, 'asesorjatim32@gmail.com', 'asesorjatim32', '$2y$10$KK.i5WeL5.inR5CZ0O/zTuaYQL84flPhr3rFixlZNaEFUBGuru07q', '[\"accessorppk\"]', '2021-09-28 08:31:03', '2021-09-28 08:31:03', NULL),
(35, 'asesorjatim33@gmail.com', 'asesorjatim33', '$2y$10$P0rIWPTuAkdC1x7AioGaqeHdFmuOiFOgQGby41Lm0ca8BIsxSWPxa', '[\"accessorppk\"]', '2021-09-28 08:31:45', '2021-09-28 08:31:45', NULL),
(36, 'asesorjatim34@gmail.com', 'asesorjatim34', '$2y$10$YInrJZbGkyxu281ME0IqUeyzvZQ.5syMsCO1gS6jEHQ8/nrb4y.dq', '[\"accessorppk\"]', '2021-09-28 08:32:21', '2021-09-28 08:32:21', NULL),
(37, 'asesorjatim35@gmail.com', 'asesorjatim35', '$2y$10$Cb1xf0psr568.OxasuJe0OPAQqzj1/Kmy21ZNAxwnkRrt7Kvzy2ka', '[\"accessorppk\"]', '2021-09-28 08:32:58', '2021-09-28 08:32:58', NULL),
(38, 'asesorjatim36@gmail.com', 'asesorjatim36', '$2y$10$HlLY.dZt58geSp/P6GUW9eEIdPHZTFEfchrjXxNbdsVsFN4ffqGlW', '[\"accessorppk\"]', '2021-09-28 08:33:31', '2021-09-28 08:33:31', NULL),
(39, 'asesorjatim41@gmail.com', 'asesorjatim41', '$2y$10$dYksqzWhRrtd.7951TWCl.bZFonEEO30zqBGTUd/xYbtFyyCnpytW', '[\"accessorppk\"]', '2021-09-28 08:34:04', '2021-09-28 08:34:04', NULL),
(40, 'asesorjatim42@gmail.com', 'asesorjatim42', '$2y$10$qoUy9oGPvHEVHwLU/1rO.eN.LC1TzkAbgjqpsUC1/83APrLFaLGBm', '[\"accessorppk\"]', '2021-09-28 08:34:35', '2021-09-28 08:34:35', NULL),
(41, 'asesorjatim43@gmail.com', 'asesorjatim43', '$2y$10$SG7UVVTMWzj3pgPEgKFxjenRD9AXD019nO4hsbnjqN/ksUUeUixdy', '[\"accessorppk\"]', '2021-09-28 08:35:42', '2021-09-28 08:35:42', NULL),
(42, 'asesorjatim44@gmail.com', 'asesorjatim44', '$2y$10$9dgj7xJ6XLfR7TK7Zl4ZXeZ7wT9U/yty73oeQSoQHXsI6q1TyHrsO', '[\"accessorppk\"]', '2021-09-28 08:36:30', '2021-09-28 08:36:30', NULL),
(43, 'asesorjatim45@gmail.com', 'asesorjatim45', '$2y$10$ND2dJ78w09K/Q3gyFM3zuOMtuUOigDcpfbe.FMRUOF0yOIoOTWcIq', '[\"accessorppk\"]', '2021-09-28 08:37:03', '2021-09-28 08:37:03', NULL),
(44, 'asesorjatim46@gmail.com', 'asesorjatim46', '$2y$10$keHYsLxVL7adZXHzE2lHh.bWwyok2UEWgO2p7pMnNcTtY70ae/Xtq', '[\"accessorppk\"]', '2021-09-28 08:37:31', '2021-09-28 08:37:31', NULL),
(45, 'asesorbali11@gmail.com', 'asesorbali11', '$2y$10$xEcJrxWDqIzVgfFFKQsdveEWnXF.TPKjYbAAOWVPnVpGFj4t3R7Om', '[\"accessorppk\"]', '2021-09-28 08:38:08', '2021-09-28 08:38:08', NULL),
(46, 'asesorbali12@gmail.com', 'asesorbali12', '$2y$10$UqqjxaBrMFUp/EP2iDLfxeNbGbuBNu6lTzxlgg1SjbXPhC5Dzv9ty', '[\"accessorppk\"]', '2021-09-28 08:38:44', '2021-09-28 08:38:44', NULL),
(47, 'asesorbali21@gmail.com', 'asesorbali21', '$2y$10$S8w58xuJr70F3.ZW8tFIpewZ8cuCTNXli7ZyGMl9MvLgAV2qacYIe', '[\"accessorppk\"]', '2021-09-28 08:39:31', '2021-09-28 08:39:31', NULL),
(48, 'asesorbali22@gmail.com', 'asesorbali22', '$2y$10$JiaBf/j2BCS5exFYhC6whe1w1CflMZojbNJHLOmS/u81aIO28Feh.', '[\"accessorppk\"]', '2021-09-28 08:40:15', '2021-09-28 08:40:15', NULL),
(49, 'asesorbali31@gmail.com', 'asesorbali31', '$2y$10$NhN7gzQVUDz85Cpp63r1ledLEfLdaSSt45ZHXrsQB7QBvAUlswMn6', '[\"accessorppk\"]', '2021-09-28 08:40:52', '2021-09-28 08:40:52', NULL),
(50, 'asesorbali32@gmail.com', 'asesorbali32', '$2y$10$vT1gqvwi6DiB/Cncn2pbjOnGIncNr5GQo7z27uWGJwgLVGtuTk.hm', '[\"accessorppk\"]', '2021-09-28 08:41:25', '2021-09-28 08:41:25', NULL),
(51, 'asesorbali33@gmail.com', 'asesorbali33', '$2y$10$7czC/VOfyD3e.KT8CYCzLeIUjFuJbThoBH7jM1lT7Ryb4C/.40YZu', '[\"accessorppk\"]', '2021-09-28 08:42:01', '2021-09-28 08:42:01', NULL),
(52, 'asesorperencanaanjatim@gmail.com', 'asesorperencanaanjatim', '$2y$10$b0nQ0tSC.44bnyriPtErpOwYVU59AqYFq7Xict9fOgTi4HPWM/u5u', '[\"accessorppk\"]', '2021-09-28 08:43:25', '2021-09-28 08:43:25', NULL),
(53, 'asesorpengawasanjatim@gmail.com', 'asesorpengawasanjatim', '$2y$10$tDNq1escHnWBIFVwWWJdhOTqemIA9WdcIj8AL.itgoNP6jj2/HpDK', '[\"accessorppk\"]', '2021-09-28 08:45:43', '2021-09-28 08:45:43', NULL),
(54, 'asesorpengawasanbali@gmail.com', 'asesorpengawasanbali', '$2y$10$3TWPo2P6lcRCxH36NNhNsuTkmSWAw7Ef1yWl9aF8Ida.BYD990/YW', '[\"accessorppk\"]', '2021-09-28 08:46:48', '2021-09-28 08:46:48', NULL),
(55, 'asesorperencanaanbali@gmail.com', 'asesorperencanaanbali', '$2y$10$y3XpBDjB1M37V7ghhtGjHe0XY56G7TER07F6HM1OlMINjTZcAUxEW', '[\"accessorppk\"]', '2021-09-28 08:47:33', '2021-09-28 08:47:33', NULL),
(56, 'asesorsuramadu1@gmail.com', 'asesorsuramadu1', '$2y$10$Upm.Dz0zq2a1SwnkeRl.JOjN8Nkh7pQiPP5irhCmBxrp4d.er.uvy', '[\"accessorppk\"]', '2021-09-28 08:48:16', '2021-09-28 08:48:16', NULL),
(57, 'asesorsuramadu2@gmail.com', 'asesorsuramadu2', '$2y$10$gnZAxvyTVmyvP0xF25YwZ.iQT6LmhBnaPN44sQfPvNpEAHCdMtfam', '[\"accessorppk\"]', '2021-09-28 08:48:42', '2021-09-28 08:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(3, 10, 'Wika Kontraktor', '2021-09-01 09:00:18', '2021-09-28 08:54:12'),
(4, 12, 'Aries Putra Beton', '2021-09-02 01:00:05', '2021-09-28 08:55:40'),
(5, 17, 'Nindya Karya', '2021-09-02 23:45:52', '2021-09-28 08:56:31'),
(6, 18, 'PT. Adhi Karya', '2021-09-02 23:46:42', '2021-09-28 08:58:56'),
(7, 19, 'PT. Amarta Karya', '2021-09-02 23:47:10', '2021-09-28 08:59:40'),
(8, 20, 'PT. Brantas Abipraya', '2021-09-02 23:48:33', '2021-09-28 09:00:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessor`
--
ALTER TABLE `accessor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessor_user_id_foreign` (`user_id`);

--
-- Indexes for table `accessor_ppk`
--
ALTER TABLE `accessor_ppk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessor_ppk_user_id_foreign` (`user_id`),
  ADD KEY `accessor_ppk_ppk_id_foreign` (`ppk_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_user_id_foreign` (`user_id`);

--
-- Indexes for table `claim_notification`
--
ALTER TABLE `claim_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_notification_sender_id_foreign` (`sender_id`),
  ADD KEY `claim_notification_recipient_id_foreign` (`recipient_id`),
  ADD KEY `claim_notification_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `indicator`
--
ALTER TABLE `indicator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_vendor_id_foreign` (`vendor_id`),
  ADD KEY `notifications_sender_id_foreign` (`sender_id`),
  ADD KEY `notifications_score_id_foreign` (`score_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_vendor_id_foreign` (`vendor_id`),
  ADD KEY `package_ppk_id_foreign` (`ppk_id`);

--
-- Indexes for table `package_detail`
--
ALTER TABLE `package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_detail_package_id_foreign` (`package_id`);

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
-- Indexes for table `ppk`
--
ALTER TABLE `ppk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_package_id_foreign` (`package_id`),
  ADD KEY `score_evaluator_id_foreign` (`evaluator_id`),
  ADD KEY `score_sub_indicator_id_foreign` (`sub_indicator_id`),
  ADD KEY `score_author_id_foreign` (`author_id`);

--
-- Indexes for table `score_history`
--
ALTER TABLE `score_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_history_package_id_foreign` (`package_id`),
  ADD KEY `score_history_author_id_foreign` (`author_id`),
  ADD KEY `score_history_sub_indicator_id_foreign` (`sub_indicator_id`);

--
-- Indexes for table `sub_indicator`
--
ALTER TABLE `sub_indicator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_indicator_indicator_id_foreign` (`indicator_id`);

--
-- Indexes for table `superuser`
--
ALTER TABLE `superuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `superuser_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessor`
--
ALTER TABLE `accessor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accessor_ppk`
--
ALTER TABLE `accessor_ppk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `claim_notification`
--
ALTER TABLE `claim_notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicator`
--
ALTER TABLE `indicator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `package_detail`
--
ALTER TABLE `package_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppk`
--
ALTER TABLE `ppk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `score_history`
--
ALTER TABLE `score_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sub_indicator`
--
ALTER TABLE `sub_indicator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `superuser`
--
ALTER TABLE `superuser`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessor`
--
ALTER TABLE `accessor`
  ADD CONSTRAINT `accessor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `accessor_ppk`
--
ALTER TABLE `accessor_ppk`
  ADD CONSTRAINT `accessor_ppk_ppk_id_foreign` FOREIGN KEY (`ppk_id`) REFERENCES `ppk` (`id`),
  ADD CONSTRAINT `accessor_ppk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `claim_notification`
--
ALTER TABLE `claim_notification`
  ADD CONSTRAINT `claim_notification_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `claim_notification_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `claim_notification_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_score_id_foreign` FOREIGN KEY (`score_id`) REFERENCES `score` (`id`),
  ADD CONSTRAINT `notifications_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ppk_id_foreign` FOREIGN KEY (`ppk_id`) REFERENCES `ppk` (`id`),
  ADD CONSTRAINT `package_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `package_detail`
--
ALTER TABLE `package_detail`
  ADD CONSTRAINT `package_detail_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `score_evaluator_id_foreign` FOREIGN KEY (`evaluator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `score_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`),
  ADD CONSTRAINT `score_sub_indicator_id_foreign` FOREIGN KEY (`sub_indicator_id`) REFERENCES `sub_indicator` (`id`);

--
-- Constraints for table `score_history`
--
ALTER TABLE `score_history`
  ADD CONSTRAINT `score_history_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `score_history_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`),
  ADD CONSTRAINT `score_history_sub_indicator_id_foreign` FOREIGN KEY (`sub_indicator_id`) REFERENCES `sub_indicator` (`id`);

--
-- Constraints for table `sub_indicator`
--
ALTER TABLE `sub_indicator`
  ADD CONSTRAINT `sub_indicator_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicator` (`id`);

--
-- Constraints for table `superuser`
--
ALTER TABLE `superuser`
  ADD CONSTRAINT `superuser_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
