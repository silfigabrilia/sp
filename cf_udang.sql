-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 07:07 AM
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
-- Database: `cf_udang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '12345', 'Admin'),
(7, 'silfi gabrilia', 'silfi g', '12345', 'user'),
(9, 'User', 'user', '12345', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aturan`
--

CREATE TABLE `tb_aturan` (
  `id_aturan` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai_gejala` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_aturan`
--

INSERT INTO `tb_aturan` (`id_aturan`, `id_gejala`, `id_penyakit`, `nilai_gejala`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0.8),
(3, 3, 1, -0.2),
(4, 4, 1, 0.6),
(5, 5, 2, 0.8),
(6, 6, 2, 0.8),
(7, 7, 2, 0.8),
(8, 8, 2, 0),
(9, 9, 2, 0.2),
(10, 9, 6, 0.2),
(11, 9, 7, 0.8),
(12, 10, 2, 0.2),
(13, 10, 8, 0),
(14, 11, 2, 0.2),
(15, 11, 3, 0.2),
(16, 11, 8, 0),
(17, 12, 2, 0.2),
(18, 13, 2, 0.2),
(19, 14, 3, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` int(11) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `nama_gejala`) VALUES
(1, 'perilaku berenang yang tidak normal – berenang lambat, berenang menyamping, berenang di dekat permukaan air dan berkumpul di sekitar tepi petak pemeliharaan'),
(2, 'Terdapat bercak putih dikarapas dan rostrum, tidak selalu tampak pada fase akut tetapi akan tampak pada fase subakut dan kronis. Bintik putih berukuran 3mm'),
(3, 'Udang berubah warna menjadi kemerahan atau merah muda'),
(4, 'Mortalitas dapat mencapai 100% dalam jangka waktu 3-10 hari'),
(5, 'Necrosis pada otot abdomen'),
(6, 'Fase akut : udang yang hampir mati akibat TSV ditandai dengan perluasan kromatopor merah. udang yang terkena dampak secara umum warna kemerahan pucat membuat kipas ekor (telson) dan pleopod menjadi merah. Udang yang terkena dampak akut biasanya mati pada proses moulting (proses ganti kulit)'),
(7, 'Epitel kutikula mengalami nekrosis (seperti tepi uropoda atau pleopoda) '),
(8, 'Kutikula lunak, '),
(9, 'Usus kosong'),
(10, 'Udang lemah'),
(11, 'Nafsu makan menurun'),
(12, 'Pada Infeksi berat, Udang mengalami kesulitan dalam bernafas'),
(13, 'Epitel tubulus antena rusak'),
(14, 'Pertumbuhan lambat, '),
(15, 'Perubahan warna kulit/karapas'),
(16, 'Perubahan tingkah laku');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `no_regidentifikasi` char(10) NOT NULL,
  `tgl_identifikasi` date NOT NULL,
  `penyakit_cf` text NOT NULL,
  `nilai_cf` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `id_akun`, `no_regidentifikasi`, `tgl_identifikasi`, `penyakit_cf`, `nilai_cf`) VALUES
(1, 0, '', '2024-08-27', '', 0),
(2, 7, 'CEXRDF1X1K', '2024-08-28', 'WSSV', 80.27);

-- --------------------------------------------------------

--
-- Table structure for table `tb_identifikasi`
--

CREATE TABLE `tb_identifikasi` (
  `id_identifikasi` int(11) NOT NULL,
  `no_regidentifikasi` char(10) NOT NULL,
  `tgl_identifikasi` date NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `nilai_user` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_identifikasi`
--

INSERT INTO `tb_identifikasi` (`id_identifikasi`, `no_regidentifikasi`, `tgl_identifikasi`, `id_akun`, `id_gejala`, `nilai_user`) VALUES
(1, 'TYBEM1UPYZ', '2024-08-25', 7, 1, 0.2),
(2, 'TYBEM1UPYZ', '2024-08-25', 7, 2, 0.8),
(3, 'TYBEM1UPYZ', '2024-08-25', 7, 3, 1),
(4, '2FYQFKKQXB', '2024-08-27', 7, 1, 0.2),
(5, '2FYQFKKQXB', '2024-08-27', 7, 2, 0.8),
(6, '2FYQFKKQXB', '2024-08-27', 7, 3, 0.2),
(7, '2FYQFKKQXB', '2024-08-27', 7, 4, 0.8),
(8, 'PS1CKHW9YT', '2024-08-27', 7, 1, 0.4),
(9, 'PS1CKHW9YT', '2024-08-27', 7, 2, 0.6),
(10, 'PS1CKHW9YT', '2024-08-27', 7, 3, 0.2),
(11, 'PS1CKHW9YT', '2024-08-27', 7, 4, 0.8),
(12, 'G5SO7SU58W', '2024-08-28', 7, 1, 0.2),
(13, 'G5SO7SU58W', '2024-08-28', 7, 2, 0.6),
(14, 'G5SO7SU58W', '2024-08-28', 7, 3, 0.2),
(15, 'G5SO7SU58W', '2024-08-28', 7, 4, 0.8),
(16, 'LCEERPGNKZ', '2024-08-28', 7, 1, 0.4),
(17, 'LCEERPGNKZ', '2024-08-28', 7, 2, 0.8),
(18, 'LCEERPGNKZ', '2024-08-28', 7, 3, 0.2),
(19, 'LCEERPGNKZ', '2024-08-28', 7, 4, 1),
(20, 'CEXRDF1X1K', '2024-08-28', 7, 1, 0.2),
(21, 'CEXRDF1X1K', '2024-08-28', 7, 2, 0.4),
(22, 'CEXRDF1X1K', '2024-08-28', 7, 3, 0.6),
(23, 'CEXRDF1X1K', '2024-08-28', 7, 4, 0.8),
(24, 'M12YHJQ4O9', '2024-10-13', 9, 1, 0.8),
(25, 'M12YHJQ4O9', '2024-10-13', 9, 2, 0.6),
(26, 'M12YHJQ4O9', '2024-10-13', 9, 3, 0.2),
(27, 'M12YHJQ4O9', '2024-10-13', 9, 4, 0.4),
(28, 'M12YHJQ4O9', '2024-10-13', 9, 5, 0.4),
(29, '6DX3RLT3XT', '2024-10-13', 9, 1, 0.8),
(30, '6DX3RLT3XT', '2024-10-13', 9, 2, 0.2),
(31, 'LAKF48EQAP', '2024-10-13', 9, 1, 0.6),
(32, 'LAKF48EQAP', '2024-10-13', 9, 2, 0.8),
(33, 'LAKF48EQAP', '2024-10-13', 9, 3, 0.4),
(34, 'QDY1FMD7FU', '2024-10-13', 9, 1, 0.8),
(35, 'QDY1FMD7FU', '2024-10-13', 9, 2, 0.6),
(36, 'QDY1FMD7FU', '2024-10-13', 9, 3, 0.4),
(37, 'QDY1FMD7FU', '2024-10-13', 9, 4, 0.2),
(38, 'QDY1FMD7FU', '2024-10-13', 9, 5, 0.4),
(39, 'QDY1FMD7FU', '2024-10-13', 9, 6, 0.2),
(40, 'QDY1FMD7FU', '2024-10-13', 9, 7, 0.8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `nama_penyakit` text NOT NULL,
  `keterangan` text NOT NULL,
  `pengendalian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id_penyakit`, `nama_penyakit`, `keterangan`, `pengendalian`) VALUES
(1, 'WSSV', 'Disebabkan oleh Virus Famili Nimaviridae berbentuk bulat telur/ellipsoid. Berukuran diameter 80-120 nm dan panjang 250-380 nm. Envelop virion', ''),
(2, 'Taura Syndrome Virus (TSV)', '• Disebabkan oleh Virus RNA \r\n• Non envelope icosahedral virusUkuran diameternya 22 nm \r\n•  Ukuran diameternya 22 nm\r\n• Familia Parvoviridae', ''),
(3, 'IHHN', '', ''),
(4, 'IMNV', '', ''),
(5, 'YHV', '', ''),
(6, 'CMNV', '', ''),
(7, 'AHPND', '', ''),
(8, 'VIBRIOSIS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `umur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_akun`, `nama_lengkap`, `jenis_kelamin`, `umur`) VALUES
(2, 7, 'silfi gabrilia', 'Wanita', 23),
(4, 9, 'User', 'Wanita', 24),
(5, 10, '', '', 0),
(6, 11, '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_aturan`
--
ALTER TABLE `tb_aturan`
  ADD PRIMARY KEY (`id_aturan`);

--
-- Indexes for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_identifikasi`
--
ALTER TABLE `tb_identifikasi`
  ADD PRIMARY KEY (`id_identifikasi`);

--
-- Indexes for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_aturan`
--
ALTER TABLE `tb_aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_identifikasi`
--
ALTER TABLE `tb_identifikasi`
  MODIFY `id_identifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
