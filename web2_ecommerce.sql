-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Mei 2019 pada 02.29
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web2_ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(10) unsigned NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` double(10,2) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `src` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `images`
--

INSERT INTO `images` (`id`, `title`, `description`, `src`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', '<p>Testing upload <strong>Image</strong></p>', 'image_20190324062809.jpg', '2019-03-23 23:28:09', '2019-03-23 23:28:09'),
(2, 'Oke', '<p>Oke</p>', 'image_20190324065154.jpg', '2019-03-23 23:51:54', '2019-03-23 23:51:54'),
(3, 'Testing', '<p>Oke oke oke</p>', 'image_20190406032632.png', '2019-04-05 20:26:32', '2019-04-05 20:26:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_23_071438_modul_ecommerce', 1),
(4, '2019_03_24_040529_create_images_table', 2),
(5, '2019_03_24_040902_create_videos_table', 2),
(6, '2019_04_06_024804_product_images', 3),
(7, '2019_04_19_150656_add_tabel_cart', 4),
(8, '2019_05_04_155830_modul_checkout', 5),
(9, '2019_05_05_014547_tambahan_tabel_order', 6),
(10, '2019_05_06_152243_product_reviews', 7),
(11, '2019_05_08_135247_add_product_id_r_eview', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `total_price` double(12,2) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `kelurahan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart_id`, `total_price`, `status`, `shipping_address`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `phone_number`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 2500000.00, 'PENDING', 'Bandung', 'Citeureup', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', '1234', '40512', '2019-05-06 07:16:18', '2019-05-06 07:16:18'),
(2, 1, NULL, 2525000.00, 'PENDING', 'Bandung', 'Citeureup', 'Cimahi Utara', 'Cimahi', 'Jawa Barat', '1234', '40512', '2019-05-06 07:22:50', '2019-05-06 07:22:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) unsigned NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1, 2500000.00, '2019-05-06 07:16:19', '2019-05-06 07:16:19'),
(2, 2, 7, 1, 25000.00, '2019-05-06 07:22:50', '2019-05-06 07:22:50'),
(3, 2, 10, 1, 2500000.00, '2019-05-06 07:22:50', '2019-05-06 07:22:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double(12,2) DEFAULT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `description`, `price`, `image_url`, `video_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mouse Optik LG', '<p>Oke sip</p>', 20000.00, NULL, NULL, '2019-03-23 01:47:01', '2019-04-05 20:10:11'),
(2, 1, 'Keyboard', '<p>Keyboard testing</p>', 50000.00, NULL, NULL, '2019-03-23 05:29:53', '2019-04-19 20:11:30'),
(3, 1, 'Monitor', 'Monitor Tabung', 250000.00, NULL, NULL, '2019-03-23 05:37:02', '2019-03-23 05:37:02'),
(5, 2, 'Mouse', 'Oke', 45000.00, NULL, NULL, '2019-03-23 05:41:34', '2019-03-23 05:41:34'),
(6, 1, 'Kamera', 'Kamera Webcam', 35000.00, NULL, NULL, '2019-03-23 06:18:21', '2019-03-23 06:18:21'),
(7, 1, 'Bohlam', '<p><strong>Testing Bohlam</strong></p>', 25000.00, NULL, NULL, '2019-04-05 20:46:51', '2019-04-05 20:46:51'),
(8, 1, 'Kacang', '<p>Kacang tanah berkualitas tinggi</p>', 12000.00, NULL, NULL, '2019-04-19 20:13:09', '2019-04-19 20:13:09'),
(9, 1, 'Baju', '<p>Baju tidur anak</p>', 15000.00, NULL, NULL, '2019-04-19 20:15:36', '2019-04-19 20:15:36'),
(10, 1, 'Samsung Galaxy S5 - 2005', '<p>TEsting saja</p>', 2500000.00, NULL, NULL, '2019-04-28 00:01:39', '2019-04-28 00:01:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(10) unsigned NOT NULL,
  `id_product` int(11) NOT NULL,
  `src` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `id_product`, `src`, `created_at`, `updated_at`) VALUES
(1, 7, 'image_product20190406040903_0.jpg', '2019-04-05 21:09:03', '2019-04-05 21:09:03'),
(2, 7, 'image_product20190406040903_1.jpg', '2019-04-05 21:09:03', '2019-04-05 21:09:03'),
(3, 1, 'image_product20190406045733_0.png', '2019-04-05 21:57:33', '2019-04-05 21:57:33'),
(4, 1, 'image_product20190406045733_1.png', '2019-04-05 21:57:33', '2019-04-05 21:57:33'),
(5, 2, 'image_product20190420031130_0.jpg', '2019-04-19 20:11:30', '2019-04-19 20:11:30'),
(6, 2, 'image_product20190420031130_1.png', '2019-04-19 20:11:30', '2019-04-19 20:11:30'),
(7, 2, 'image_product20190420031130_2.jpg', '2019-04-19 20:11:30', '2019-04-19 20:11:30'),
(8, 2, 'image_product20190420031130_3.jpg', '2019-04-19 20:11:30', '2019-04-19 20:11:30'),
(9, 8, 'image_product20190420031509_0.jpg', '2019-04-19 20:15:09', '2019-04-19 20:15:09'),
(10, 8, 'image_product20190420031510_1.jpg', '2019-04-19 20:15:10', '2019-04-19 20:15:10'),
(11, 8, 'image_product20190420031510_2.jpg', '2019-04-19 20:15:10', '2019-04-19 20:15:10'),
(12, 8, 'image_product20190420031510_3.jpg', '2019-04-19 20:15:10', '2019-04-19 20:15:10'),
(13, 9, 'image_product20190420031536_0.jpg', '2019-04-19 20:15:36', '2019-04-19 20:15:36'),
(14, 9, 'image_product20190420031536_1.png', '2019-04-19 20:15:36', '2019-04-19 20:15:36'),
(15, 9, 'image_product20190420031536_2.jpg', '2019-04-19 20:15:36', '2019-04-19 20:15:36'),
(16, 9, 'image_product20190420031536_3.jpg', '2019-04-19 20:15:36', '2019-04-19 20:15:36'),
(17, 10, 'image_product20190428070139_0.jpg', '2019-04-28 00:01:39', '2019-04-28 00:01:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_reviews`
--

CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `description`, `rating`, `created_at`, `updated_at`, `product_id`) VALUES
(1, 1, 'tes', 4, '2019-05-07 17:00:00', '2019-05-07 17:00:00', 10),
(2, 1, 'Bagus barang nya saya suka', 4, '2019-05-06 17:00:00', '2019-05-06 17:00:00', 9),
(3, 1, '<p>Productnya masih ada ?</p>', 4, '2019-05-08 07:22:09', '2019-05-08 07:22:09', 10),
(4, 1, '<p>Keren</p>', 3, '2019-05-08 07:34:24', '2019-05-08 07:34:24', 9),
(5, 1, '<p>warna coklatnya ada ?</p>', 3, '2019-05-08 07:35:40', '2019-05-08 07:35:40', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verification_token`, `reset_password_token`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dani Kurniawan', 'dann.sevens@gmail.com', NULL, NULL, '2019-04-05 17:00:00', '$2y$10$WGBb5X5Fzru0aZQ/QoI28ebOf8o10W.9/mHzudPOdo7mX6jeyE7ie', 'DDhrmWhgZwLcx6E2qrxmr9Kj1aSTo6RyZce7cdJfAJcN1o0BewLiZA4wh94K', '2019-03-23 00:24:30', '2019-03-23 00:24:30'),
(2, 'Dani Kurniawan', 'dani.kurniawan@gmail.com', NULL, NULL, NULL, '$2y$10$XBSf6m.ZzfjwvqCmlwuaUevEAyfGTFSRIJ6gPgiTY9LXn2z.A86Oa', 'Cz66nsiSzIXINpcGnt8gMzvNNdQokutTwPdeZO2vrjg3bKTSWQLOuGz5wXMx', '2019-03-23 05:41:11', '2019-03-23 05:41:11'),
(10, 'YT', 'ytnointro@gmail.com', 'JoR3gEXkgQjW1e54ymyernFutDybk1n8ROxznM5d', NULL, '2019-04-06 09:04:13', '$2y$10$BaaiO0E.HtiuZp7HKPxfNuf/rpuXIUtyisiakwkQBD9d5AW95yr8.', 'WAiw9DdNdRhZKrWvIIts8CPpJH44OwjO2WorjtEVow08UAziDIJjEWqbIOSi', '2019-04-06 09:03:49', '2019-04-06 09:15:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `src` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `src`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', '<p>Oke</p>', 'video_20190324064452.mp4', '2019-03-23 23:44:52', '2019-03-23 23:44:52'),
(2, 'Cekson', '<p>Cekson</p>', 'video_20190324064819.mp4', '2019-03-23 23:48:19', '2019-03-23 23:48:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
