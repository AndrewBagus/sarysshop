-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2022 pada 20.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-08-16-152857', 'App\\Database\\Migrations\\MRole', 'default', 'App', 1661094579, 1),
(2, '2022-08-16-161805', 'App\\Database\\Migrations\\MUser', 'default', 'App', 1661094579, 1),
(3, '2022-08-16-162334', 'App\\Database\\Migrations\\MUserRole', 'default', 'App', 1661094579, 1),
(4, '2022-08-16-163400', 'App\\Database\\Migrations\\MFeatureGroup', 'default', 'App', 1661094579, 1),
(5, '2022-08-16-163647', 'App\\Database\\Migrations\\MFeature', 'default', 'App', 1661094579, 1),
(6, '2022-08-16-164630', 'App\\Database\\Migrations\\MRoleFeature', 'default', 'App', 1661094579, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_feature`
--

CREATE TABLE `m_feature` (
  `id` int(11) UNSIGNED NOT NULL,
  `m_feature_group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `sequence` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status_data` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_feature`
--

INSERT INTO `m_feature` (`id`, `m_feature_group_id`, `name`, `code`, `icon`, `visible`, `sequence`, `url`, `status_data`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dashboard', 'dashboard', 'fa fa-dashboard', 1, 1, 'dashboard', 'active', '2022-08-21 10:11:51', NULL),
(2, 2, 'Order', 'order', 'fa fa-shopping-bag', 1, 1, 'order', 'active', '2022-08-21 10:11:51', NULL),
(3, 3, 'Penerimaan Barang', 'penerimaan_barang', 'fa fa-indent', 1, 1, 'receive', 'active', '2022-08-21 10:11:51', NULL),
(4, 4, 'Pengeluaran Barang', 'pengeluaran_barang', 'fa fa-outdent', 1, 1, 'expense', 'active', '2022-08-21 10:11:51', NULL),
(5, 5, 'Produk', 'produk', 'fa fa-list', 1, 1, 'product', 'active', '2022-08-21 10:11:51', NULL),
(6, 6, 'Supplier', 'supplier', 'fa fa-users', 1, 1, 'supplier', 'active', '2022-08-21 10:11:51', NULL),
(7, 7, 'Customer', 'customer', 'fa fa-users', 1, 1, 'customer', 'active', '2022-08-21 10:11:51', NULL),
(8, 8, 'Laporan', 'laporan', 'fa fa-th-list', 1, 1, 'report', 'active', '2022-08-21 10:11:51', NULL),
(9, 9, 'User Group', 'user_group', 'fa fa-users', 1, 1, 'user_group', 'active', '2022-08-21 10:11:51', NULL),
(10, 9, 'User', 'user', 'fa fa-user', 1, 2, 'user', 'active', '2022-08-21 10:11:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_feature_group`
--

CREATE TABLE `m_feature_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `sequence` int(11) NOT NULL,
  `status_data` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_feature_group`
--

INSERT INTO `m_feature_group` (`id`, `name`, `sequence`, `status_data`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 1, 'active', '2022-08-21 10:11:33', NULL),
(2, 'Order', 2, 'active', '2022-08-21 10:11:33', NULL),
(3, 'Penerimaan', 3, 'active', '2022-08-21 10:11:33', NULL),
(4, 'Pengeluaran', 4, 'active', '2022-08-21 10:11:33', NULL),
(5, 'Produk', 5, 'active', '2022-08-21 10:11:33', NULL),
(6, 'Supplier', 6, 'active', '2022-08-21 10:11:33', NULL),
(7, 'Customer', 7, 'active', '2022-08-21 10:11:33', NULL),
(8, 'Laporan ', 8, 'active', '2022-08-21 10:11:33', NULL),
(9, 'Akses ', 9, 'active', '2022-08-21 10:11:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_role`
--

CREATE TABLE `m_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `code` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status_data` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_role`
--

INSERT INTO `m_role` (`id`, `name`, `code`, `description`, `status_data`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '-', 'active', '2022-08-21 10:12:04', NULL),
(2, 'Shipper', 'shipper', '-', 'active', '2022-08-21 10:12:04', NULL),
(3, 'Owner', 'owner', '-', 'active', '2022-08-21 10:12:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_role_feature`
--

CREATE TABLE `m_role_feature` (
  `id` int(11) UNSIGNED NOT NULL,
  `m_role_id` int(11) NOT NULL,
  `m_feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_role_feature`
--

INSERT INTO `m_role_feature` (`id`, `m_role_id`, `m_feature_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user`
--

CREATE TABLE `m_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status_data` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_user`
--

INSERT INTO `m_user` (`id`, `email`, `name`, `phone`, `password`, `status_data`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', 'Administrator', '081', '$2y$10$tfKMK.Nlak3F81VYoFJxI.iBzoHghTUr3NeSfkXSGafP3V8Qrinb6', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user_role`
--

CREATE TABLE `m_user_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `m_role_id` int(11) NOT NULL,
  `m_user_id` int(11) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `status_data` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_user_role`
--

INSERT INTO `m_user_role` (`id`, `m_role_id`, `m_user_id`, `status_aktif`, `status_data`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 'active', '2022-08-21 10:12:12', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_role_feature`
--
ALTER TABLE `m_role_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_user_role`
--
ALTER TABLE `m_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_role_feature`
--
ALTER TABLE `m_role_feature`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_user_role`
--
ALTER TABLE `m_user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
