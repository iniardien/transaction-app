-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 04:56 AM
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
-- Database: `db_transaksi`
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
(32, '2014_10_12_000000_create_users_table', 1),
(33, '2014_10_12_100000_create_password_resets_table', 1),
(34, '2019_08_19_000000_create_failed_jobs_table', 1),
(35, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(36, '2024_08_03_124213_create_customers_table', 1),
(37, '2024_08_03_124826_create_barangs_table', 1),
(38, '2024_08_03_125423_create_sales_table', 1),
(39, '2024_08_03_125506_create_sales_detail_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`id`, `kode`, `nama`, `harga`, `qty`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'BRG1', 'Iphone 15 Pro Max', 10000000.00, 10, 0, '2024-08-05 11:21:07', '2024-08-05 12:11:04'),
(2, 'BRG2', 'Samsung S21 Ultra', 2100000.00, 10, 0, '2024-08-05 11:47:21', '2024-08-05 12:07:42'),
(3, 'BRG3', 'Poco M3', 500000.00, 4, 0, '2024-08-05 12:07:54', '2024-08-08 15:57:14'),
(4, 'BRG4', 'Redmi 6a', 300000.00, 0, 0, '2024-08-05 12:09:52', '2024-08-08 15:57:14'),
(5, 'BRG5', 'Casing Iphone 14', 2000.00, 2, 1, '2024-08-05 12:10:35', '2024-08-05 12:14:04'),
(6, 'BRG6', 'Charger type C', 15000.00, 15, 0, '2024-08-05 12:11:27', '2024-08-08 15:57:14'),
(7, 'BRG7', 'Headset', 19999.00, 8, 0, '2024-08-05 12:12:03', '2024-08-05 12:12:03'),
(8, 'C001', 'Kaset Rusak', 2000.00, 0, 0, '2024-08-06 06:58:11', '2024-08-08 15:02:30'),
(9, 'A', 'Ardien', 1234.00, 3, 0, '2024-08-06 07:56:13', '2024-08-06 07:56:13'),
(10, 'A001', 'TEST', 1200000.00, 120, 0, '2024-08-06 07:56:31', '2024-08-06 07:57:26'),
(11, 'A0012', 'Ardien Ibrahimovic', 21000.00, 0, 0, '2024-08-06 08:00:45', '2024-08-08 15:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `m_customer`
--

CREATE TABLE `m_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_customer`
--

INSERT INTO `m_customer` (`id`, `kode`, `name`, `telp`, `is_delete`, `created_at`, `updated_at`) VALUES
(9, 'CUS99', 'Reri', '083191847226', 0, '2024-08-05 01:09:36', '2024-08-06 06:56:41'),
(13, 'CUS10', 'Edit', '123', 1, '2024-08-05 01:30:15', '2024-08-06 06:43:17'),
(14, 'CUS14', 'Ardien', '083191847226', 1, '2024-08-05 09:26:42', '2024-08-08 15:11:09'),
(15, 'CUS15', 'Reri', '0831293229932', 0, '2024-08-05 09:26:58', '2024-08-05 09:26:58'),
(16, 'CUS16', 'AsepSaepudin', '123456', 1, '2024-08-05 09:27:08', '2024-08-06 06:43:14'),
(17, 'CUS17', 'Jajanx', '1234', 0, '2024-08-05 09:27:32', '2024-08-05 09:27:32'),
(18, 'CUST017', 'Salwa', '083191847226', 0, '2024-08-06 06:34:01', '2024-08-06 06:43:24'),
(19, 'CUS012', 'Korman', '083191847226', 0, '2024-08-06 06:50:29', '2024-08-06 06:50:29'),
(20, 'ZKS12', '01', '01', 0, '2024-08-06 06:50:38', '2024-08-06 06:50:38');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_sales`
--

CREATE TABLE `t_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `tgl` datetime NOT NULL,
  `cust_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `diskon` decimal(15,2) NOT NULL,
  `ongkir` decimal(15,2) NOT NULL,
  `total_bayar` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_sales`
--

INSERT INTO `t_sales` (`id`, `kode`, `tgl`, `cust_id`, `subtotal`, `diskon`, `ongkir`, `total_bayar`, `created_at`, `updated_at`) VALUES
(10, '202408-001', '2024-08-09 00:00:00', 17, 1425000.00, 20000.00, 30000.00, 1435000.00, '2024-08-08 12:42:55', '2024-08-08 15:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `t_sales_detail`
--

CREATE TABLE `t_sales_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `harga_bandrol` decimal(15,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon_pct` decimal(15,2) NOT NULL,
  `diskon_nilai` decimal(15,2) NOT NULL,
  `harga_diskon` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_sales_detail`
--

INSERT INTO `t_sales_detail` (`id`, `sales_id`, `barang_id`, `harga_bandrol`, `qty`, `diskon_pct`, `diskon_nilai`, `harga_diskon`, `total`, `created_at`, `updated_at`) VALUES
(22, 10, 4, 300000.00, 2, 15.00, 45000.00, 255000.00, 51.00, '2024-08-08 15:57:14', '2024-08-08 15:57:14'),
(23, 10, 6, 15000.00, 1, 33.00, 5000.00, 15000.00, 1.50, '2024-08-08 15:57:14', '2024-08-08 15:57:14'),
(24, 10, 3, 500000.00, 2, 10.00, 50000.00, 450000.00, 900.00, '2024-08-08 15:57:14', '2024-08-08 15:57:14'),
(25, 10, 11, 21000.00, 4, 100.00, 21000.00, 21000.00, 0.00, '2024-08-08 15:57:14', '2024-08-08 15:57:14');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_customer`
--
ALTER TABLE `m_customer`
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
-- Indexes for table `t_sales`
--
ALTER TABLE `t_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_sales_cust_id_foreign` (`cust_id`);

--
-- Indexes for table `t_sales_detail`
--
ALTER TABLE `t_sales_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_sales_detail_sales_id_foreign` (`sales_id`),
  ADD KEY `t_sales_detail_barang_id_foreign` (`barang_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `m_customer`
--
ALTER TABLE `m_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_sales`
--
ALTER TABLE `t_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_sales_detail`
--
ALTER TABLE `t_sales_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_sales`
--
ALTER TABLE `t_sales`
  ADD CONSTRAINT `t_sales_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `m_customer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_sales_detail`
--
ALTER TABLE `t_sales_detail`
  ADD CONSTRAINT `t_sales_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_sales_detail_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `t_sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
