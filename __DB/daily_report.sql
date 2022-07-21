-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 03:03 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daily_report`
--

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `ref_approve_status`
--

CREATE TABLE `ref_approve_status` (
  `id_ref_status` int(11) NOT NULL,
  `nama_status_ref` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_approve_status`
--

INSERT INTO `ref_approve_status` (`id_ref_status`, `nama_status_ref`) VALUES
(1, 'Approve'),
(2, 'Revision'),
(3, 'Reject');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_cust` int(11) NOT NULL,
  `nama_cust` varchar(255) NOT NULL,
  `alamat_cust` text NOT NULL,
  `option_cust` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_cust`, `nama_cust`, `alamat_cust`, `option_cust`) VALUES
(1, 'Customer', 'Jl. Podang', 'A123'),
(2, 'Customer2', 'Jl. Jalan', 'B123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jk`
--

CREATE TABLE `tbl_jk` (
  `id_jk` int(11) NOT NULL,
  `nama_jk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jk`
--

INSERT INTO `tbl_jk` (`id_jk`, `nama_jk`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mesin`
--

CREATE TABLE `tbl_mesin` (
  `id_mesin` int(11) NOT NULL,
  `model_mesin` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mesin`
--

INSERT INTO `tbl_mesin` (`id_mesin`, `model_mesin`, `serial_number`) VALUES
(4, 'coba123', 'cobaa'),
(6, 'Uji Coba', 'A01gh4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peran`
--

CREATE TABLE `tbl_peran` (
  `id_peran` int(11) NOT NULL,
  `nama_peran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_peran`
--

INSERT INTO `tbl_peran` (`id_peran`, `nama_peran`) VALUES
(1, 'Admin'),
(2, 'Teknisi'),
(3, 'Assistant Supervisor'),
(4, 'Supervisor'),
(5, 'Assistant Manager'),
(6, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_problem`
--

CREATE TABLE `tbl_problem` (
  `id_problem` int(11) NOT NULL,
  `nama_problem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_problem`
--

INSERT INTO `tbl_problem` (`id_problem`, `nama_problem`) VALUES
(1, 'C'),
(2, 'O'),
(3, 'M'),
(4, 'E'),
(5, 'OTH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `id_report` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `counter_before` varchar(255) NOT NULL,
  `counter_after` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `id_status` int(255) NOT NULL,
  `remarks` text NOT NULL,
  `time_call` time NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `notes` text NOT NULL,
  `id_work_for` int(255) DEFAULT NULL,
  `ttd` varchar(255) NOT NULL,
  `by_aspv` int(1) DEFAULT NULL,
  `by_spv` int(1) DEFAULT NULL,
  `by_asmng` int(1) DEFAULT NULL,
  `by_mng` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`id_report`, `id_cust`, `id_mesin`, `counter_before`, `counter_after`, `date`, `id_status`, `remarks`, `time_call`, `time_in`, `time_out`, `notes`, `id_work_for`, `ttd`, `by_aspv`, `by_spv`, `by_asmng`, `by_mng`) VALUES
(3, 2, 4, '123', 'AbcEdited2', '2022-07-19', 2, 'Abcd', '23:57:00', '23:58:00', '23:59:00', 'HHhh', 2, '1658305390_avatar1.png', 1, 1, 1, 1),
(4, 2, 4, '123', 'AbcEdited', '2022-07-20', 2, 'avcd', '22:32:00', '22:33:00', '22:33:00', 'aaa', 2, '1658331126_avatar1.png', 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id_status`, `nama_status`) VALUES
(1, 'I'),
(2, 'PM'),
(3, 'CM'),
(4, 'FU'),
(5, 'CS'),
(6, 'OTH');

-- --------------------------------------------------------

--
-- Table structure for table `trx_problem`
--

CREATE TABLE `trx_problem` (
  `id_trx_problem` int(11) NOT NULL,
  `id_report` int(255) NOT NULL,
  `id_problem` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_problem`
--

INSERT INTO `trx_problem` (`id_trx_problem`, `id_report`, `id_problem`) VALUES
(8, 3, 1),
(9, 3, 2),
(10, 3, 3),
(11, 4, 1),
(12, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` int(11) DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `peran` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `foto`, `jk`, `no_hp`, `email_verified_at`, `peran`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '1658169519_team-1.jpg', 1, '0', NULL, 1, '$2y$10$LAtgVcTrve7EIDgP4oHaCOTGgukAGPUfAPpx..0nThD.qRlUHlZ6i', NULL, '2022-07-16 10:09:28', '2022-07-18 11:38:39'),
(2, 'Teknisi', 'teknisi', '1658169452_1657268785_arashmil.jpg', 2, '0', NULL, 2, '$2y$10$AfmZO8rTaMBDDpY99VFhgeEOJqkbwoRlNdr1KdQpWLUSQUDc5WSxe', NULL, '2022-07-17 22:25:58', '2022-07-18 11:37:32'),
(5, 'Assistent Supervisor', 'aspv', '1658339562_avatar1.png', 1, '+628510101010', NULL, 3, '$2y$10$IsmXIECDuAwOJs59BYqrEuzYRR7j1eayzx3WwYQ.Tgnss/89IkK2y', NULL, '2022-07-18 11:37:12', '2022-07-20 10:52:42'),
(6, 'supervisor', 'supervisor', '1658337786_avatar1.png', 2, '1541930995', NULL, 4, '$2y$10$skaxLlNMRhDZC33IyO.gweWGmWWDUNL5Ed/qXKj8WYAVvDBV9in9q', NULL, '2022-07-20 10:23:06', '2022-07-20 10:23:06'),
(7, 'Assistent Manager', 'asmng', '1658337847_avatar1.png', 2, '1541930995', NULL, 5, '$2y$10$ZTK7UT/7d354xsK5gGeBRO9M4XBdwTJ/DjcM4VKLKpJbuYjWXtRAi', NULL, '2022-07-20 10:24:07', '2022-07-20 10:24:07'),
(8, 'Manager', 'mng', '1658337879_avatar1.png', 1, '1541930995', NULL, 6, '$2y$10$C2RhhiTuVEArTSF8r8zQfuXki0yhJ6Co20BwcwVjfG/MORv3FI0bK', NULL, '2022-07-20 10:24:39', '2022-07-20 10:24:39');

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ref_approve_status`
--
ALTER TABLE `ref_approve_status`
  ADD PRIMARY KEY (`id_ref_status`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `tbl_jk`
--
ALTER TABLE `tbl_jk`
  ADD PRIMARY KEY (`id_jk`);

--
-- Indexes for table `tbl_mesin`
--
ALTER TABLE `tbl_mesin`
  ADD PRIMARY KEY (`id_mesin`);

--
-- Indexes for table `tbl_peran`
--
ALTER TABLE `tbl_peran`
  ADD PRIMARY KEY (`id_peran`);

--
-- Indexes for table `tbl_problem`
--
ALTER TABLE `tbl_problem`
  ADD PRIMARY KEY (`id_problem`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `trx_problem`
--
ALTER TABLE `trx_problem`
  ADD PRIMARY KEY (`id_trx_problem`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_approve_status`
--
ALTER TABLE `ref_approve_status`
  MODIFY `id_ref_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jk`
--
ALTER TABLE `tbl_jk`
  MODIFY `id_jk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_mesin`
--
ALTER TABLE `tbl_mesin`
  MODIFY `id_mesin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_peran`
--
ALTER TABLE `tbl_peran`
  MODIFY `id_peran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_problem`
--
ALTER TABLE `tbl_problem`
  MODIFY `id_problem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trx_problem`
--
ALTER TABLE `trx_problem`
  MODIFY `id_trx_problem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
