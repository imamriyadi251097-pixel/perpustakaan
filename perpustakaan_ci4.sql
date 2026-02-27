-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 03:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jenis` enum('siswa','guru') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `alamat`, `foto`, `jenis`) VALUES
(1, 'arman', 'kp. pabuaran', '1770865672_4d51b1c8f52714548668.png', 'siswa'),
(2, 'Maman, S.Pd', 'kp. campur', '1770710541_58d43a2a65810ec2a2f4.png', 'guru'),
(3, 'Manda', 'kp. adaajja', '1770710472_d81d543980d9087262cf.png', 'siswa'),
(4, 'mima', 'kp. adaajja', '1770710316_021891e1aaeaea5cd9df.png', 'siswa'),
(5, 'Arman', 'kp. Pabuaran', '1770710577_146bbc1db594e63fa9d5.png', 'siswa'),
(6, 'Maman, S.Pd', 'kp. Campur', '1770710541_58d43a2a65810ec2a2f4.png', 'guru'),
(7, 'Manda', 'kp. Adaajja', '1770710472_d81d543980d9087262cf.png', 'siswa'),
(8, 'Mima', 'kp. Adaajja', '1770710316_021891e1aaeaea5cd9df.png', 'siswa'),
(9, 'Budi', 'kp. Sukamaju', '1770710600_9a8b7c6d5e4f3a2b1c0d.png', 'siswa'),
(10, 'Sari', 'kp. Sukamaju', '1770710601_abcdef1234567890.png', 'siswa'),
(11, 'Rina', 'kp. Mekar', '1770710602_1122334455667788.png', 'siswa'),
(12, 'Doni', 'kp. Mekar', '1770710603_a1b2c3d4e5f6g7h8.png', 'siswa'),
(13, 'Lina', 'kp. Harapan', '1770710604_z9y8x7w6v5u4t3s2.png', 'siswa'),
(14, 'Andi', 'kp. Harapan', '1770710605_qwertyuiop123456.png', 'siswa'),
(15, 'Tina', 'kp. Jaya', '1770710606_asdfghjkl098765.png', 'siswa'),
(16, 'Rudi', 'kp. Jaya', '1770710607_zxcvbnm11223344.png', 'siswa'),
(17, 'Fajar', 'kp. Sejahtera', '1770710608_lkjhgfdsapoiuyt.png', 'siswa'),
(18, 'Nina', 'kp. Sejahtera', '1770710609_mnbvcxz98765432.png', 'siswa'),
(19, 'Eka', 'kp. Maju', '1770710610_qazwsxedcrfvtgby.png', 'siswa'),
(20, 'Raka', 'kp. Maju', '1770710611_yhnujmik,ol.p;/.png', 'siswa'),
(21, 'Sinta', 'kp. Damai', '1770710612_123abc456def789.png', 'siswa'),
(22, 'Vina', 'kp. Damai', '1770710613_987zyx654wvu321.png', 'siswa'),
(23, 'Hadi', 'kp. Indah', '1770710614_a1s2d3f4g5h6j7k8.png', 'siswa'),
(24, 'Rani', 'kp. Indah', '1770710615_l9k8j7h6g5f4d3s2.png', 'siswa'),
(25, 'Dewi', 'kp. Lestari', '1770710616_z1x2c3v4b5n6m7a8.png', 'siswa'),
(26, 'Fauzi', 'kp. Lestari', '1770710617_p9o8i7u6y5t4r3e2.png', 'siswa'),
(27, 'Alya', 'kp. Sentosa', '1770710618_q1w2e3r4t5y6u7i8.png', 'siswa'),
(28, 'Bima', 'kp. Sentosa', '1770710619_a9s8d7f6g5h4j3k2.png', 'siswa'),
(29, 'Citra', 'kp. Makmur', '1770710620_z9x8c7v6b5n4m3l2.png', 'siswa'),
(30, 'Dedi', 'kp. Makmur', '1770710621_qazxswedcvfrtgbh.png', 'siswa'),
(31, 'Elsa', 'kp. Abadi', '1770710622_1q2w3e4r5t6y7u8i.png', 'siswa'),
(32, 'Feri', 'kp. Abadi', '1770710623_9i8u7y6t5r4e3w2q.png', 'siswa'),
(33, 'Gita', 'kp. Luhur', '1770710624_azsxdcfvgbhnjmkl.png', 'siswa'),
(34, 'Hendra', 'kp. Luhur', '1770710625_qwerasdfzxcvtyui.png', 'siswa'),
(35, 'Mira, S.Pd', 'kp. pabuaran', '1770818221_da0022268d89133a7f76.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `jenis` enum('fisik','ebook','jurnal') DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `jenis`, `stok`, `cover`) VALUES
(3, 'Tekateki', 'Rahman, S.Pd', 'ebook', 2, '1770804223_acf92b8705a0038ab3de.jpg'),
(5, 'PPKn', 'Rahman, S.Pd', 'fisik', 78, '1770866454_08406847440d5968b0a1.jpg'),
(6, 'Tekateki', 'Rahman, S.Pd', 'ebook', 3, '1770713334_28acb48bc7a26d9be1ea.jpeg'),
(7, 'PPKn', 'Rahman, S.Pd', 'fisik', 78, '1770713374_202c57b41aafb9fe6db5.jpg'),
(8, 'Matematika Dasar', 'Siti, M.Pd', 'fisik', 49, '1770783492_a554fbac8ccea4923b66.png'),
(9, 'Bahasa Indonesia', 'Dewi, S.Pd', 'ebook', 30, '1770783601_e4bb88140f34b3525772.png'),
(10, 'IPA Terpadu', 'Fajar, M.Si', 'fisik', 25, '1770784028_73807103f500b93689ec.png'),
(11, 'IPS Terpadu', 'Rina, M.Pd', 'fisik', 20, '1770784111_3fa22417ba23c418cf2a.png'),
(12, 'Sejarah Dunia', 'Hadi, S.Pd', 'ebook', 15, '1770784134_b33455b4c03e24a80760.png'),
(13, 'Geografi', 'Lina, M.Pd', 'fisik', 10, '1770784152_8a944caded6c06e6190c.png'),
(14, 'Biologi', 'Eka, M.Si', 'ebook', 12, '1770713406_bio1.jpg'),
(15, 'Fisika', 'Andi, S.Pd', 'fisik', 18, '1770713407_fis1.jpg'),
(16, 'Kimia', 'Rani, M.Si', 'fisik', 14, '1770713408_kimia1.jpg'),
(17, 'Seni Budaya', 'Sinta, S.Pd', 'fisik', 22, '1770713409_seni1.jpg'),
(18, 'Pendidikan Agama', 'Vina, S.Ag', 'ebook', 35, '1770713410_agama1.jpg'),
(19, 'Bahasa Inggris', 'Tina, S.Pd', 'fisik', 40, '1770713411_inggris1.jpg'),
(20, 'Komputer Dasar', 'Doni, M.Kom', 'ebook', 28, '1770713412_komp1.jpg'),
(21, 'Algoritma & Pemrograman', 'Fauzi, M.TI', 'ebook', 16, '1770713413_algoritma1.jpg'),
(22, 'Ekonomi', 'Bima, S.E', 'fisik', 20, '1770713414_ekonomi1.jpg'),
(23, 'Akuntansi', 'Citra, S.E', 'fisik', 18, '1770713415_akuntansi1.jpg'),
(24, 'Pemasaran', 'Dedi, M.M', 'ebook', 10, '1770713416_pemasaran1.jpg'),
(25, 'Manajemen', 'Elsa, M.M', 'fisik', 12, '1770713417_manajemen1.jpg'),
(26, 'Psikologi', 'Feri, M.Psi', 'ebook', 14, '1770713418_psiko1.jpg'),
(27, 'Sosiologi', 'Gita, S.Sos', 'fisik', 16, '1770713419_sosiologi1.jpg'),
(28, 'Filafat', 'Hendra, M.Pd', 'ebook', 8, '1770713420_filsafat1.jpg'),
(29, 'Pendidikan Jasmani', 'Alya, S.Pd', 'fisik', 30, '1770713421_penjas1.jpg'),
(30, 'Kimia Lanjut', 'Raka, M.Si', 'ebook', 5, '1770713422_kimia2.jpg'),
(31, 'Fisika Lanjut', 'Nina, M.Si', 'fisik', 7, '1770713423_fisika2.jpg'),
(32, 'Matematika Lanjut', 'Hadi, M.Pd', 'ebook', 6, '1770713424_math2.jpg'),
(33, 'Bahasa Jepang', 'Rani, S.Pd', 'ebook', 10, '1770713425_jepang1.jpg'),
(34, 'Bahasa Arab', 'Dewi, S.Pd', 'fisik', 12, '1770713426_arab1.jpg'),
(35, 'Kewirausahaan', 'Fajar, M.M', 'ebook', 15, '1770713427_wirausaha1.jpg'),
(36, 'Teknologi Informasi', 'Andi, M.TI', 'fisik', 20, '1770784609_a73fb056b2da7cf8d707.png');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `anggota_id` int(11) DEFAULT NULL,
  `buku_id` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','kembali') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `anggota_id`, `buku_id`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 1, 101, '2026-01-05', '2026-01-12', 'dipinjam'),
(2, 2, 102, '2026-01-08', '2026-01-15', 'kembali'),
(3, 3, 103, '2026-01-10', '2026-01-17', 'kembali'),
(4, 4, 104, '2026-01-12', '2026-01-19', 'dipinjam'),
(5, 5, 105, '2026-01-15', '2026-01-22', 'kembali'),
(6, 6, 106, '2026-01-18', '2026-01-25', 'dipinjam'),
(7, 7, 107, '2026-01-20', '2026-01-27', 'kembali'),
(8, 8, 108, '2026-01-22', '2026-01-29', 'dipinjam'),
(9, 9, 109, '2026-01-25', '2026-02-01', 'kembali'),
(10, 10, 110, '2026-01-28', '2026-02-04', 'kembali'),
(11, 1, 101, '2026-02-01', '2026-02-08', 'dipinjam'),
(12, 2, 102, '2026-02-02', '2026-02-09', 'dipinjam'),
(13, 3, 103, '2026-02-03', '2026-02-10', 'dipinjam'),
(14, 4, 104, '2026-02-04', '2026-02-11', 'dipinjam'),
(15, 5, 105, '2026-02-05', '2026-02-12', 'dipinjam'),
(16, 6, 106, '2026-02-06', '2026-02-13', 'dipinjam'),
(17, 7, 107, '2026-02-07', '2026-02-14', 'dipinjam'),
(18, 8, 108, '2026-02-08', '2026-02-15', 'dipinjam'),
(19, 9, 109, '2026-02-09', '2026-02-16', 'dipinjam'),
(20, 10, 110, '2026-02-10', '2026-02-17', 'dipinjam'),
(21, 11, 111, '2026-02-01', '2026-02-08', 'kembali'),
(22, 12, 112, '2026-02-02', '2026-02-09', 'kembali'),
(23, 13, 113, '2026-02-03', '2026-02-10', 'dipinjam'),
(24, 14, 114, '2026-02-04', '2026-02-11', 'dipinjam'),
(25, 15, 115, '2026-02-05', '2026-02-12', 'dipinjam'),
(26, 16, 116, '2026-02-06', '2026-02-13', 'dipinjam'),
(27, 17, 117, '2026-02-07', '2026-02-14', 'dipinjam'),
(28, 18, 118, '2026-02-08', '2026-02-15', 'dipinjam'),
(29, 19, 119, '2026-02-09', '2026-02-16', 'dipinjam'),
(30, 20, 120, '2026-02-10', '2026-02-17', 'dipinjam'),
(31, 21, 121, '2026-02-01', '2026-02-08', 'dipinjam'),
(32, 22, 122, '2026-02-02', '2026-02-09', 'dipinjam'),
(33, 23, 123, '2026-02-03', '2026-02-10', 'dipinjam'),
(34, 24, 124, '2026-02-04', '2026-02-11', 'dipinjam'),
(35, 25, 125, '2026-02-05', '2026-02-12', 'dipinjam'),
(36, 26, 126, '2026-02-06', '2026-02-13', 'dipinjam'),
(37, 27, 127, '2026-02-07', '2026-02-14', 'dipinjam'),
(38, 28, 128, '2026-02-08', '2026-02-15', 'dipinjam'),
(39, 29, 129, '2026-02-09', '2026-02-16', 'dipinjam'),
(40, 30, 130, '2026-02-10', '2026-02-17', 'dipinjam'),
(41, 2, 3, '2026-02-11', NULL, NULL),
(42, 1, 8, '2026-02-12', NULL, 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user','petugas','siswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', '', '$2y$10$yJA6hZaKxCsIjknJ4xqElOuWe/0r/a3qy6xufbrMhJJq2pIvAtEGC', 'admin'),
(2, 'siswa1', '', '$2y$10$RJnRfEI5X8t8vkW/Nd1TXuNXtJDmmKSC5MVzXYUnoG.wHiJYurj4a', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
