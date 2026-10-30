-- ========================================================
-- INCITRACK Database Dump (Clean Version)
-- Hanya Tabel Inti Aplikasi (Tanpa Cache, Jobs, Migrations)
-- Tanggal: 2026-10-30 08:49:28
-- ========================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Struktur tabel `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `users`

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Aditya Pratama Putra', 'putraadityapratama236@gmail.com', NULL, '$2y$12$XESbWoajtUan9ZRHsVC9VOf6ybwrm57Zm8SBPjci8cN279sH0jNdG', 'user', 'aktif', NULL, '2026-07-02 04:47:30', NULL),
('2', 'Admin Incitrack', 'admin@incitrack.id', '2026-05-18 18:18:40', '$2y$12$/MUkvaQ7r3B1bAcb6ob6k.vPC5OG2sge9dni/QV7Q4cf6ZDXcwnj.', 'admin', 'aktif', '6jpVQ6t7TZ', '2026-05-18 18:18:40', NULL),
('3', 'Aditya', 'putraadityapratama090@gmail.com', NULL, '$2y$12$IrPVXeyNM92IfKKFUQ02Lucxy4.yN6fnIanryGUnTbvajRzGfqG7y', 'user', 'aktif', NULL, '2026-07-20 13:29:07', NULL);

-- --------------------------------------------------------
-- Struktur tabel `jalans`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jalans`;
CREATE TABLE `jalans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jalan` varchar(255) NOT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `panjang` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `jalans`

INSERT INTO `jalans` (`id`, `nama_jalan`, `kota`, `panjang`, `created_at`, `updated_at`) VALUES
('1', 'Jalan Tol Jakarta-Cikampek (Japek)', 'Bekasi - Karawang', '83.00', '2026-05-18 18:18:40', NULL),
('2', 'Jalan Tol Jagorawi', 'Jakarta - Bogor - Ciawi', '59.00', '2026-05-18 18:18:40', NULL),
('3', 'Jalan Tol Cipularang', 'Cikampek - Purwakarta - Padalarang', '58.50', '2026-05-18 18:18:40', NULL),
('4', 'Jalan Tol Tangerang-Merak', 'Tangerang - Serang - Cilegon - Merak', '72.45', '2026-05-18 18:18:40', NULL),
('5', 'Jalan Tol Dalam Kota Jakarta', 'DKI Jakarta', '47.00', '2026-05-18 18:18:40', NULL),
('6', 'Jalan Tol Purbaleunyi', 'Purwakarta - Bandung', '90.00', '2026-05-18 18:18:40', NULL),
('7', 'Jalan Tol Trans-Jawa (Solo-Ngawi)', 'Solo - Sragen - Ngawi', '90.43', '2026-05-18 18:18:40', NULL),
('8', 'Jalan Tol Bakauheni-Terbanggi Besar', 'Lampung', '140.90', '2026-05-18 18:18:40', NULL),
('9', 'Jalan Tol Jakarta-Tangerang', 'DKI Jakarta - Tangerang', '33.00', '2026-07-02 12:09:26', NULL),
('10', 'Jalan Tol Prof. Dr. Sedyatmo', 'Jakarta - Bandara Soekarno Hatta', '14.30', '2026-07-02 12:09:26', NULL),
('11', 'Jalan Tol JORR', 'Jakarta Outer Ring Road', '65.00', '2026-07-02 12:09:26', NULL),
('12', 'Jalan Tol JORR 2', 'Jakarta Outer Ring Road 2', '110.00', '2026-07-02 12:09:26', NULL),
('13', 'Jalan Tol Cawang-Tomang-Pluit', 'DKI Jakarta', '23.00', '2026-07-02 12:09:26', NULL),
('14', 'Jalan Tol Cawang-Tanjung Priok', 'DKI Jakarta', '14.00', '2026-07-02 12:09:26', NULL),
('15', 'Jalan Tol Tanjung Priok', 'DKI Jakarta', '11.40', '2026-07-02 12:09:26', NULL),
('16', 'Jalan Tol Bekasi-Cawang-Kampung Melayu', 'Jakarta - Bekasi', '21.00', '2026-07-02 12:09:26', NULL),
('17', 'Jalan Tol Cimanggis-Cibitung', 'Depok - Bekasi', '26.18', '2026-07-02 12:09:26', NULL),
('18', 'Jalan Tol Cinere-Jagorawi', 'Depok - Bogor', '14.64', '2026-07-02 12:09:26', NULL),
('19', 'Jalan Tol Cinere-Serpong', 'Depok - Tangerang Selatan', '10.14', '2026-07-02 12:09:26', NULL),
('20', 'Jalan Tol Depok-Antasari', 'Jakarta Selatan - Depok', '21.54', '2026-07-02 12:09:26', NULL),
('21', 'Jalan Tol Serpong-Balaraja', 'Tangerang', '39.80', '2026-07-02 12:12:24', NULL),
('22', 'Jalan Tol Kunciran-Serpong', 'Tangerang', '11.19', '2026-07-02 12:09:26', NULL),
('23', 'Jalan Tol Kunciran-Cengkareng', 'Tangerang - Jakarta Barat', '14.19', '2026-07-02 12:09:26', NULL),
('24', 'Jalan Tol Ciawi-Sukabumi', 'Bogor - Sukabumi', '54.00', '2026-07-02 12:09:26', NULL),
('25', 'Jalan Tol Bogor Ring Road', 'Bogor', '13.25', '2026-07-02 12:09:26', NULL),
('26', 'Jalan Tol Cikopo-Palimanan (Cipali)', 'Purwakarta - Subang - Indramayu - Cirebon', '116.75', '2026-07-02 12:12:24', NULL),
('27', 'Jalan Tol Palimanan-Kanci', 'Cirebon', '26.30', '2026-07-02 12:12:24', NULL),
('28', 'Jalan Tol Kanci-Pejagan', 'Cirebon - Brebes', '35.00', '2026-07-02 12:12:24', NULL),
('29', 'Jalan Tol Pejagan-Pemalang', 'Brebes - Pemalang', '57.50', '2026-07-02 12:12:24', NULL),
('30', 'Jalan Tol Pemalang-Batang', 'Pemalang - Batang', '39.20', '2026-07-02 12:12:24', NULL),
('31', 'Jalan Tol Batang-Semarang', 'Batang - Semarang', '75.00', '2026-07-02 12:12:24', NULL),
('32', 'Jalan Tol Semarang ABC', 'Semarang', '24.75', '2026-07-02 12:12:24', NULL),
('33', 'Jalan Tol Semarang-Solo', 'Semarang - Solo', '72.64', '2026-07-02 12:12:24', NULL),
('34', 'Jalan Tol Solo-Kertosono', 'Solo - Ngawi - Kertosono', '176.00', '2026-07-02 12:09:26', NULL),
('35', 'Jalan Tol Ngawi-Kertosono', 'Ngawi - Nganjuk', '87.00', '2026-07-02 12:12:24', NULL),
('36', 'Jalan Tol Kertosono-Mojokerto', 'Nganjuk - Mojokerto', '40.50', '2026-07-02 12:12:24', NULL),
('37', 'Jalan Tol Mojokerto-Surabaya', 'Mojokerto - Surabaya', '36.27', '2026-07-02 12:12:24', NULL),
('38', 'Jalan Tol Surabaya-Gempol', 'Surabaya - Pasuruan', '49.00', '2026-07-02 12:12:24', NULL),
('39', 'Jalan Tol Gempol-Pandaan', 'Pasuruan', '13.61', '2026-07-02 12:12:24', NULL),
('40', 'Jalan Tol Pandaan-Malang', 'Pasuruan - Malang', '38.48', '2026-07-02 12:12:24', NULL),
('41', 'Jalan Tol Gempol-Pasuruan', 'Pasuruan', '34.15', '2026-07-02 12:12:24', NULL),
('42', 'Jalan Tol Waru-Juanda', 'Surabaya - Sidoarjo', '12.80', '2026-07-02 12:12:24', NULL),
('43', 'Jalan Tol Surabaya-Gresik', 'Surabaya - Gresik', '21.00', '2026-07-02 12:12:24', NULL),
('44', 'Jalan Tol Suramadu', 'Surabaya - Bangkalan', '5.43', '2026-07-02 12:09:26', NULL),
('45', 'Jalan Tol Bali Mandara', 'Denpasar - Benoa - Nusa Dua', '12.70', '2026-07-02 12:12:24', NULL),
('46', 'Jalan Tol Medan-Binjai', 'Medan - Binjai', '16.72', '2026-07-02 12:12:24', NULL),
('47', 'Jalan Tol Belmera', 'Belawan - Medan - Tanjung Morawa', '34.00', '2026-07-02 12:09:26', NULL),
('48', 'Jalan Tol Medan-Kualanamu-Tebing Tinggi', 'Medan - Tebing Tinggi', '61.70', '2026-07-02 12:12:24', NULL),
('49', 'Jalan Tol Kuala Tanjung-Tebing Tinggi-Parapat', 'Sumatera Utara', '143.25', '2026-07-02 12:12:24', NULL),
('50', 'Jalan Tol Pekanbaru-Dumai', 'Riau', '131.69', '2026-07-02 12:12:24', NULL),
('51', 'Jalan Tol Pekanbaru-Bangkinang', 'Riau', '40.00', '2026-07-02 12:12:24', NULL),
('52', 'Jalan Tol Indrapura-Kisaran', 'Batu Bara - Kisaran', '47.75', '2026-07-02 12:12:24', NULL),
('53', 'Jalan Tol Sigli-Banda Aceh', 'Aceh', '74.20', '2026-07-02 12:12:24', NULL),
('54', 'Jalan Tol Binjai-Langsa', 'Sumatera Utara - Aceh', '131.00', '2026-07-02 12:12:24', NULL),
('55', 'Jalan Tol Palembang-Indralaya', 'Palembang - Ogan Ilir', '22.00', '2026-07-02 12:12:24', NULL),
('56', 'Jalan Tol Kayu Agung-Palembang', 'Kayu Agung - Palembang', '42.50', '2026-07-02 12:12:24', NULL),
('57', 'Jalan Tol Indralaya-Prabumulih', 'Ogan Ilir - Prabumulih', '64.50', '2026-07-02 12:12:24', NULL),
('58', 'Jalan Tol Terbanggi Besar-Pematang Panggang', 'Lampung', '112.20', '2026-07-02 12:12:24', NULL),
('59', 'Jalan Tol Pematang Panggang-Kayu Agung', 'Lampung - Sumatera Selatan', '77.00', '2026-07-02 12:12:24', NULL),
('60', 'Jalan Tol Bengkulu-Taba Penanjung', 'Bengkulu', '17.60', '2026-07-02 12:12:24', NULL),
('61', 'Jalan Tol Balikpapan-Samarinda', 'Balikpapan - Samarinda', '97.27', '2026-07-02 12:12:24', NULL),
('62', 'Jalan Tol Manado-Bitung', 'Manado - Bitung', '39.80', '2026-07-02 12:12:24', NULL),
('63', 'Jalan Tol Serang-Panimbang', 'Banten', '83.60', '2026-07-02 12:09:26', NULL),
('64', 'Jalan Tol Yogyakarta-Solo', 'DIY - Jawa Tengah', '96.57', '2026-07-02 12:09:26', NULL),
('65', 'Jalan Tol Solo-Yogyakarta-NYIA', 'Solo - Yogyakarta', '96.57', '2026-07-02 12:12:24', NULL),
('66', 'Jalan Tol Semarang-Demak', 'Semarang - Demak', '26.95', '2026-07-02 12:12:24', NULL),
('67', 'Jalan Tol Probolinggo-Banyuwangi', 'Probolinggo - Banyuwangi', '175.40', '2026-07-02 12:12:24', NULL),
('68', 'Jalan Tol Gedebage-Tasikmalaya-Cilacap', 'Jawa Barat - Jawa Tengah', '206.65', '2026-07-02 12:09:26', NULL),
('69', 'Jalan Tol Padalarang-Cileunyi', 'Bandung', '58.50', '2026-07-02 12:12:24', NULL),
('70', 'Jalan Tol Soreang-Pasirkoja (Soroja)', 'Bandung', '10.55', '2026-07-02 12:12:24', NULL),
('71', 'Jalan Tol Cibitung-Cilincing', 'Bekasi - Jakarta Utara', '34.77', '2026-07-02 12:12:24', NULL),
('72', 'Jalan Tol Cimanggis-Cinere', 'Depok', '14.64', '2026-07-02 12:12:24', NULL),
('73', 'Jalan Tol Serpong-Cinere', 'Tangerang Selatan - Depok', '10.14', '2026-07-02 12:12:24', NULL),
('74', 'Jalan Tol Cileunyi-Sumedang-Dawuan (Cisumdawu)', 'Bandung - Sumedang - Majalengka', '61.75', '2026-07-02 12:12:24', NULL),
('75', 'Jalan Tol Jakarta-Cikampek II Selatan', 'Jakarta - Karawang', '62.00', '2026-07-02 12:12:24', NULL),
('76', 'Jalan Tol Akses Patimban', 'Subang', '37.05', '2026-07-02 12:12:24', NULL),
('77', 'Jalan Tol Solo-Ngawi', 'Solo - Ngawi', '90.10', '2026-07-02 12:12:24', NULL),
('78', 'Jalan Tol Krian-Legundi-Bunder-Manyar', 'Sidoarjo - Gresik', '38.30', '2026-07-02 12:12:24', NULL),
('79', 'Jalan Tol Belawan-Medan-Tanjung Morawa (Belmera)', 'Medan', '34.00', '2026-07-02 12:12:24', NULL),
('80', 'Jalan Tol Tebing Tinggi-Indrapura', 'Tebing Tinggi - Batu Bara', '28.50', '2026-07-02 12:12:24', NULL),
('81', 'Jalan Tol Padang-Sicincin', 'Sumatera Barat', '36.60', '2026-07-02 12:12:24', NULL),
('82', 'Jalan Tol Betung-Tempino-Jambi', 'Sumatera Selatan - Jambi', '170.00', '2026-07-02 12:12:24', NULL),
('83', 'Jalan Tol Akses Bandara VVIP IKN', 'Penajam Paser Utara', '18.00', '2026-07-02 12:12:24', NULL),
('84', 'Jalan Tol Makassar New Port', 'Makassar', '3.20', '2026-07-02 12:12:24', NULL);

-- --------------------------------------------------------
-- Struktur tabel `laporans`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `laporans`;
CREATE TABLE `laporans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `jalan_id` bigint(20) unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `km` varchar(50) DEFAULT NULL,
  `jumlah_korban` int(11) NOT NULL DEFAULT 0,
  `jenis` varchar(255) NOT NULL,
  `penyebab` varchar(255) DEFAULT NULL,
  `dampak` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporans_user_id_foreign` (`user_id`),
  KEY `laporans_jalan_id_foreign` (`jalan_id`),
  CONSTRAINT `laporans_jalan_id_foreign` FOREIGN KEY (`jalan_id`) REFERENCES `jalans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data untuk tabel `laporans`

INSERT INTO `laporans` (`id`, `user_id`, `jalan_id`, `tanggal`, `waktu`, `lokasi`, `km`, `jumlah_korban`, `jenis`, `penyebab`, `dampak`, `foto`, `video`, `status`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
('1', '1', '5', '2026-07-02', '15:34 Sore', 'Jakarta kota', 'KM 10', '0', 'Tabrakan Beruntun', 'Pengemudi Mengantuk', 'Macet total di sepanjang jalan tol cikarang', 'foto_1782981356_images.jpg', '', 'valid', '-6.2088', '106.8456', '2026-07-02 08:35:56', NULL),
('2', '3', '45', '2026-07-20', '20:30', 'ddd', 'KM 92', '0', 'ddd', 'ddd', 'dd', 'foto_1784554224_scaled_WIN_20240929_19_24_47_Pro.jpg', '', 'pending', '-6.336931937378196', '107.03683898533974', '2026-07-20 13:30:24', NULL);

-- --------------------------------------------------------
-- Struktur tabel `contacts`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
