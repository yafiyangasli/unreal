-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2020 at 10:08 AM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u8762162_unreal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id_bukti` int(11) NOT NULL,
  `id_checkout` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `nomor_akun` varchar(50) NOT NULL,
  `bank` varchar(25) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal_trans` varchar(100) NOT NULL,
  `bukti_trans` varchar(255) NOT NULL,
  `is_processed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti`
--

INSERT INTO `bukti` (`id_bukti`, `id_checkout`, `username`, `nama_akun`, `nomor_akun`, `bank`, `total`, `tanggal_trans`, `bukti_trans`, `is_processed`) VALUES
(29, 76, 'rizaldoar', 'aldo', '123i0138012301', 'mandiri', 185000, '12/07/2020', 'twitter-social-media-icon-design-template-vector-png_127015.jpg', 1),
(30, 83, 'rizaldoar', 'Anjay', '1234567890', 'BRI', 369000, '12 juni 2020', '20200618_152538.jpg', 1),
(31, 86, 'yafifahmi', 'Yafi', '0081229911', 'BCA', 1009000, 'AHAHAHAHAHAH', 'wp1921032-tzuyu-wallpapers(1).jpg', 1),
(32, 81, 'yafifahmi', 'YAFI', '0088992211', 'GO-JEK', 0, 'SEKARANG BANGET', 'WhatsApp_Image_2020-05-12_at_12.47.25.jpeg', 1),
(33, 87, 'rizaldoar', 'ads', 'qwe', '123', 4170000, '123', 'idea.png', 1),
(34, 88, 'yafifahmi', 'yafi', '0081229911', 'BCA', 4120000, 'sekarang banget', 'modul_3.pdf', 1),
(36, 96, 'rizaldoar', 'aldo', '123', 'mandiri', 1935000, '123', 'idea.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `username`, `id_produk`, `jumlah`, `size`, `harga`, `berat`) VALUES
(173, 'admin', 6, 2, 'M', 170000, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `is_upload` int(11) NOT NULL,
  `no_resi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `username`, `nama`, `address`, `provinsi`, `kota`, `ongkir`, `total`, `waktu`, `deadline`, `is_upload`, `no_resi`) VALUES
(76, 'rizaldoar', 'Rizaldo Abdulrachman', 'Jalan Pulau Bacan Gang DPR no 5', '', '', 0, 185000, '2020-06-19 11:11:01', '2020-06-20 11:11:01', 1, ''),
(81, 'yafifahmi', 'Yafi Fahmi', 'Jl. Perintis Kemerdekaan no. 63', '', '', 0, 0, '2020-06-20 15:40:23', '2020-06-21 15:40:23', 1, ''),
(83, 'rizaldoar', 'Rizaldo Abdulrachman', 'Jalan Pulau Bacan Gang DPR no 5', '', '', 0, 369000, '2020-06-20 16:24:19', '2020-06-21 16:24:19', 1, ''),
(86, 'yafifahmi', 'Yafi Fahmi', 'Jl. Perintis Kemerdekaan no. 63', '', '', 0, 1009000, '2020-06-20 17:33:53', '2020-06-21 17:33:53', 1, ''),
(87, 'rizaldoar', 'Rizaldo Abdulrachman', 'Jalan Pulau Bacan Gang DPR no 5', '', '', 0, 4170000, '2020-06-20 17:43:39', '2020-06-21 17:43:39', 1, ''),
(88, 'yafifahmi', 'Yafi Fahmi', 'Jl. Perintis Kemerdekaan no. 63', '', '', 0, 4120000, '2020-06-20 17:44:25', '2020-06-21 17:44:25', 1, ''),
(96, 'rizaldoar', 'Rizaldo Abdulrachman', 'Jalan Pulau Bacan Gang DPR no 5, 081274027237', '1', '17', 205000, 1935000, '2020-06-22 09:37:07', '2020-06-23 09:37:07', 1, '1234123');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `tempat` varchar(25) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`tempat`, `gambar`) VALUES
('Home', 'header.png'),
('Lookbook', 'Clothing-Mens-Sweats-And-Hoodies-Header-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id_help` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id_help`, `nama`, `email`, `subject`, `kategori`, `pesan`, `waktu`) VALUES
(14, 'YAFI', 'YAFI0721@GMAIL.COM', 'KOK KOSONG', 'Order', 'MAS MASA BAJU NYA KOSONG TERUS', '2020-06-20 17:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `jenis` varchar(25) NOT NULL,
  `id_jenis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`jenis`, `id_jenis`) VALUES
('Clothes', 'clothes'),
('Floapers', 'floapers'),
('Pants', 'pants'),
('Shoes', 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `liked_items`
--

CREATE TABLE `liked_items` (
  `username` varchar(128) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liked_items`
--

INSERT INTO `liked_items` (`username`, `id_produk`) VALUES
('admin', 2),
('admin', 4),
('admin', 6),
('rizaldoar', 6),
('yafifahmi', 5),
('yafifahmi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `lookbook`
--

CREATE TABLE `lookbook` (
  `id_lookbook` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date` varchar(200) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lookbook`
--

INSERT INTO `lookbook` (`id_lookbook`, `nama`, `date`, `gambar1`, `gambar2`, `gambar3`) VALUES
(40, 'Sunny Sides', '20-06-2020', 'jumpman.png', 'supreme.png', 'stussy.png'),
(41, 'Nighty Nide', '06-05-2020', 'trouser-styles-header1.jpg', 'Clothing-Mens-Sweats-And-Hoodies-Header-1.jpg', 'Header2.jpg'),
(42, 'Summer Vibes', '06-05-2020', 'stussy.png', 'Header2.jpg', 'jumpman.png');

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE `navbar` (
  `id_navbar` int(11) NOT NULL,
  `nama_navbar` varchar(25) NOT NULL,
  `link_navbar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`id_navbar`, `nama_navbar`, `link_navbar`) VALUES
(1, 'NEW PRODUCT', 'home'),
(2, 'LOOKBOOK', 'lookbook'),
(3, 'CATALOGUE', 'catalogue'),
(4, 'LOGIN', 'auth'),
(5, 'HELP', 'help'),
(6, 'ABOUT', 'about'),
(7, 'Cart', 'user/cart'),
(8, 'Saved Items', 'user/favorites');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `email`) VALUES
(44, 'nandagoreh@gmail.com'),
(45, 'roykosajiku04@gmail.com'),
(46, 'rizaldo.a.r@gmail.com'),
(47, 'unrealclubs@gmail.com'),
(48, 'yafi0721@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderan`
--

CREATE TABLE `orderan` (
  `id_orderan` int(11) NOT NULL,
  `id_checkout` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderan`
--

INSERT INTO `orderan` (`id_orderan`, `id_checkout`, `username`, `id_produk`, `jumlah`, `size`, `harga`, `waktu`) VALUES
(100, 76, 'rizaldoar', 6, 1, 'M', 170000, '2020-06-19 11:11:01'),
(105, 83, 'rizaldoar', 6, 2, 'M', 170000, '2020-06-20 16:24:19'),
(108, 86, 'yafifahmi', 6, 5, 'S', 170000, '2020-06-20 17:33:53'),
(109, 87, 'rizaldoar', 5, 20, 'S', 200000, '2020-06-20 17:43:39'),
(110, 88, 'yafifahmi', 5, 20, 'S', 200000, '2020-06-20 17:44:25'),
(119, 96, 'rizaldoar', 5, 1, 'S', 200000, '2020-06-22 09:37:07'),
(120, 96, 'rizaldoar', 6, 9, 'M', 170000, '2020-06-22 09:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(35) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `harga` int(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `gambarlarger` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambarlarger2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL,
  `gambarlarger3` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` float NOT NULL,
  `is_new` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `jenis`, `harga`, `gambar`, `gambarlarger`, `gambar2`, `gambarlarger2`, `gambar3`, `gambarlarger3`, `deskripsi`, `berat`, `is_new`) VALUES
(5, 'UNREAL F/W 19 Tie Dye Tee', 'Clothes', 200000, 'UNREAL_FLAT_LAY_005_smaller.jpg', 'UNREAL_FLAT_LAY_005_larger.jpg', 'UNREAL_FLAT_LAY_006_smaller.jpg', 'UNREAL_FLAT_LAY_006_larger.jpg', '', '', 'Pre washed 24s Cotton combed t-shirt. 100% Cotton. Plastisol print in front.', 0.5, 0),
(6, 'No Matter What Tee Black', 'Clothes', 170000, 'UNREAL_FLAT_LAY_017_smaller.jpg', 'UNREAL_FLAT_LAY_017_larger.jpg', 'UNREAL_FLAT_LAY_018_smaller.jpg', 'UNREAL_FLAT_LAY_018_larger.jpg', 'UNREAL_FLAT_LAY_019_smaller.jpg', 'UNREAL_FLAT_LAY_019_larger.jpg', 'No Matter What Tee Black', 0.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_lookbook`
--

CREATE TABLE `produk_lookbook` (
  `id_lookbook` int(11) NOT NULL,
  `nama_produk_lookbook` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_lookbook`
--

INSERT INTO `produk_lookbook` (`id_lookbook`, `nama_produk_lookbook`) VALUES
(40, 'UNREAL F/W 19 Tie Dye Tee'),
(41, 'Baju 1'),
(41, 'Baju 2'),
(41, 'Celana 1'),
(42, 'Baju 1'),
(42, 'Baju 2'),
(42, 'Celana 1');

-- --------------------------------------------------------

--
-- Table structure for table `sizestok`
--

CREATE TABLE `sizestok` (
  `id_produk` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizestok`
--

INSERT INTO `sizestok` (`id_produk`, `size`, `stok`) VALUES
(5, 'S', 40),
(6, 'M', 5),
(6, 'S', 7),
(7, 'S', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `email`, `password`, `telephone`, `address`, `role_id`, `is_active`) VALUES
('admin', '', 'admin@unrealclubs.com', '$2y$10$NXyzLnBFv79tAgRGZGDZauuIFIkhLutLcQDtdqfCInXd5UAmR0VFS', '', '', 1, 1),
('rizaldoar', 'Rizaldo Abdulrachman', 'rizaldo.a.r@gmail.com', '$2y$10$DrtUjjXF344.ml6Ght16QOnykFgsh6MBAR1nJ0qFaVCZkdklNbRcm', '081274027237', 'Jalan Pulau Bacan Gang DPR no 5', 2, 1),
('yafifahmi', 'Yafi Fahmi', 'yafi0721@gmail.com', '$2y$10$8lYkFE3yzDkyHVpEiFjJWeLSFN3WtXkfmWVWRi6QIj9SFatN0jI2C', '089503924256', 'Jl. Perintis Kemerdekaan no. 63', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(21, 2, 2),
(22, 2, 3),
(23, 2, 4),
(24, 2, 5),
(25, 2, 6),
(26, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'About'),
(3, 'Catalogue'),
(4, 'Help'),
(5, 'Home'),
(6, 'Lookbook'),
(7, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(0, 'yafi0721@gmail.com', 'vdmhy24/xZGIVHYiStrwQeyOWtq+zT+T6Rpnc0TAnSM=', 1592144715),
(6, 'yafi0721@gmail.com', 'PcBpzt3kQWMwnMtGfSPOcCdaPPtaPEEcqcw1nTV592k=', 1592144444),
(7, 'yafi0721@gmail.com', '5pZJU+6CMrnhcJlQXp/Zhm6qh/aozWGGgkIppJjfh0Q=', 1592144607);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`,`username`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`tempat`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id_help`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`jenis`);

--
-- Indexes for table `liked_items`
--
ALTER TABLE `liked_items`
  ADD PRIMARY KEY (`username`,`id_produk`);

--
-- Indexes for table `lookbook`
--
ALTER TABLE `lookbook`
  ADD PRIMARY KEY (`id_lookbook`);

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id_navbar`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`);

--
-- Indexes for table `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`id_orderan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_lookbook`
--
ALTER TABLE `produk_lookbook`
  ADD PRIMARY KEY (`id_lookbook`,`nama_produk_lookbook`);

--
-- Indexes for table `sizestok`
--
ALTER TABLE `sizestok`
  ADD PRIMARY KEY (`id_produk`,`size`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id_help` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lookbook`
--
ALTER TABLE `lookbook`
  MODIFY `id_lookbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id_navbar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orderan`
--
ALTER TABLE `orderan`
  MODIFY `id_orderan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
