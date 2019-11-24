-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2019 at 10:56 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipiapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `dimensi`
--

CREATE TABLE `dimensi` (
  `kode_d` int(11) NOT NULL,
  `nama_dimensi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dimensi`
--

INSERT INTO `dimensi` (`kode_d`, `nama_dimensi`) VALUES
(1, 'Indeks Pertumbuhan Ekonomi'),
(2, 'Indeks Inklusifitas'),
(3, 'Indeks Keberlanjutan');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `kode_indikator` int(11) NOT NULL,
  `nama_indikator` varchar(128) NOT NULL,
  `status` int(11) NOT NULL,
  `max_nilai` double NOT NULL DEFAULT 0,
  `min_nilai` double NOT NULL DEFAULT 0,
  `kode_sd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kode_indikator`, `nama_indikator`, `status`, `max_nilai`, `min_nilai`, `kode_sd`) VALUES
(1, 'Indeks Deflator PDRB', 1, 1.30563473, 1.114462916, 1),
(2, 'Indeks Deflator Sektor Pertanian', 1, 1.588604204, 1.170133092, 1),
(3, 'Indeks Deflator Sektor Pertambangan', 1, 1.343635264, 0.820265656, 1),
(4, 'Indeks Deflator Sektor Industri', 1, 1.316739472, 1.114506355, 1),
(5, 'Indeks Deflator Sektor Konstruksi', 1, 1.382268242, 1.068184125, 1),
(6, 'Indeks Deflator Sektor Perdagangan', 1, 1.361137545, 1.089844822, 1),
(7, 'Indeks Pertumbuhan PDRB harga konstan', 0, 7.04, 5.49, 2),
(8, 'Indeks PDRB perkapita harga konstan', 0, 70703.8, 55499, 2),
(9, 'Indeks Pertumbuhan PDRB riil per kapita', 0, 11.48843483, 5.755846473, 2),
(10, 'Indeks Pertumbuhan Sektor Pertanian', 0, 6.25, 4.46, 2),
(11, 'Indeks Pertumbuhan Sektor Industri', 0, 7.576369588, 4.21, 2),
(12, 'Indeks Kontribusi Sektor Industri', 0, 49.39004464, 47.54319065, 2),
(13, 'Indeks Pertumbuhan Pembentukan Modal Tetap Bruto', 0, 11.58, 4.59, 2),
(14, 'Indeks Pertumbuhan Ekspor', 0, 6.69, 3.6, 2),
(15, 'Indeks Persentase tenaga kerja sektor industri', 0, 35.22329346, 27.97073336, 3),
(16, 'Indeks Rata-rata Lama Sekolah', 0, 8.95, 8.41, 3),
(17, 'Indeks Angka Harapan Lama Sekolah', 0, 13.7, 12.63, 3),
(18, 'Indeks Angka Partisipasi Murni (APM) setingkat sekolah dasar', 0, 98.73, 91.47, 3),
(19, 'Indeks Angka Partisipasi Murni (APM) setingkat sekolah menengah pertama', 0, 90.61, 79.91, 3),
(20, 'Indeks Angka Partisipasi Murni (APM) setingkat sekolah menengah atas', 0, 79.27, 61.3, 3),
(21, 'Indeks Angka Harapan Hidup', 0, 72.36, 72.18, 3),
(22, 'Indeks Rasio Murid terhadap Guru SD', 1, 15.58678021, 15.07555988, 3),
(23, 'Indeks Rasio Murid terhadap Guru SMP', 1, 12.75116279, 11.59346847, 3),
(24, 'Indeks Rasio Murid terhadap Guru SMA', 1, 11.49681529, 8.355473555, 3),
(25, 'Indeks Rasio Murid terhadap Guru SMK', 1, 12.55679812, 11.26842461, 3),
(26, 'Indeks Rasio Murid terhadap Jumah SD', 1, 174.3536036, 170.8764045, 3),
(27, 'Indeks Rasio Murid terhadap Jumah SMP', 1, 326.0873786, 308.85, 3),
(28, 'Indeks Rasio Murid terhadap Jumah SMA', 1, 11.49681529, 8.355473555, 3),
(29, 'Indeks Rasio Murid terhadap Jumah SMK', 1, 402.5283019, 352.8653846, 3),
(30, 'Indeks Angka Kematian Bayi', 1, 20.95, 18.24, 3),
(31, 'Indeks Angka Morbiditas', 1, 13.21, 9.35, 3),
(32, 'Indeks Rasio Kasus Penyakit Utamas Masyarakat Gresik terhadap Penduduk', 1, 0.388702315, 0.080999474, 3),
(33, 'Indeks Persentase Bayi dengan Gizi Cukup (Berat Badan > 2.5 kg)', 0, 0.991074528, 0.972570613, 3),
(34, 'Indeks Rasio Rumah Sakit per Penduduk', 0, 0.74276669, 0.700379294, 3),
(35, 'Indeks Rasio Puskesmas Umum dan Pembantu per Penduduk', 0, 8.995729917, 8.171091767, 3),
(36, 'Indeks Persentase Penduduk Miskin', 1, 14.35, 12.8, 4),
(37, 'Indeks Indeks Keparahan Kemiskinan', 1, 2.58, 2.19, 4),
(38, 'Indeks Indeks Kedalaman Kemiskinan', 1, 0.72, 0.56, 4),
(39, 'Indeks Tingkat Pengangguran Terbuka', 1, 6.78, 4.54, 4),
(40, 'Indeks Indeks Pemberdayaan Gender', 0, 66.21, 62.26, 5),
(41, 'Indeks Persentase Rumah Tangga dengan Luas Lantai Hunian ? 50 m2', 0, 86.42, 82.36, 5),
(42, 'Indeks Persentase Rumah Tangga dengan Lantai Bukan Tanah', 0, 97.91, 93.83, 5),
(43, 'Indeks Persentase Rumah Tangga dengan Dinding Tembok', 0, 91.73, 85.02, 5),
(44, 'Indeks Persentase Rumah Tangga dengan Atap Beton/Tembok', 0, 94.66, 90.05, 5),
(45, 'Indeks Persentase Rumah Tangga dengan Sumber Air Minum Kemasan/Isi Ulang', 0, 84.78, 68.7, 5),
(46, 'Indeks Persentase Rumah Tangga dengan Fasilitas BAB Sendiri', 0, 91.8, 86.35, 5),
(47, 'Indeks Ruang Fiskal Daerah', 0, 0.683071642, 0.558244311, 6),
(48, 'Indeks Derajat Desentralisasi Fiskal', 0, 0.310386692, 0.240590091, 6),
(49, 'Indeks Rasio belanja pendidikan terhadap penduduk usia sekolah', 0, 2.259465144, 1.688141333, 6),
(50, 'Indeks Rasio belanja kesehatan terhadap total penduduk', 0, 0.350097427, 0.153151906, 6),
(51, 'Indeks Produktivitas Lahan Sawah', 0, 65.5, 61.55, 7),
(52, 'Indeks Ketersediaan air bersih perkapita', 0, 0.070404524, 0.050192935, 7),
(53, 'Indeks Ketersedian listrik per kapita', 0, 0.000739032, 0.000612356, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ipi`
--

CREATE TABLE `ipi` (
  `id_nilai_ipi` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipi`
--

INSERT INTO `ipi` (`id_nilai_ipi`, `tahun`, `nilai_rescale`) VALUES
(1, 2012, 4.61),
(2, 2013, 4.42),
(3, 2014, 5.01),
(4, 2015, 5.24),
(5, 2016, 5.5),
(6, 2017, 5.04);

-- --------------------------------------------------------

--
-- Table structure for table `nilaidimensi`
--

CREATE TABLE `nilaidimensi` (
  `id_nilai_d` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilaidimensi`
--

INSERT INTO `nilaidimensi` (`id_nilai_d`, `tahun`, `nilai_rescale`, `kode_d`) VALUES
(1, 2012, 6.23, 1),
(2, 2013, 5.4, 1),
(3, 2014, 4.36, 1),
(4, 2015, 4.72, 1),
(5, 2016, 3.68, 1),
(6, 2017, 3.38, 1),
(7, 2012, 2.6, 2),
(8, 2013, 4.37, 2),
(9, 2014, 5.37, 2),
(10, 2015, 3.86, 2),
(11, 2016, 7.74, 2),
(12, 2017, 5.85, 2),
(13, 2012, 4.99, 3),
(14, 2013, 3.5, 3),
(15, 2014, 5.31, 3),
(16, 2015, 7.13, 3),
(17, 2016, 5.08, 3),
(18, 2017, 5.9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilaiindikator`
--

CREATE TABLE `nilaiindikator` (
  `id_nilai_i` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_indikator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilaiindikator`
--

INSERT INTO `nilaiindikator` (`id_nilai_i`, `tahun`, `nilai`, `nilai_rescale`, `kode_indikator`) VALUES
(1, 2012, 1.114462916, 10, 1),
(2, 2013, 1.166009419, 7.3, 1),
(3, 2014, 1.228747206, 4.02, 1),
(4, 2015, 1.237994564, 3.54, 1),
(5, 2016, 1.256851373, 2.55, 1),
(6, 2017, 1.30563473, 0, 1),
(7, 2012, 1.170133092, 10, 2),
(8, 2013, 1.264279805, 7.75, 2),
(9, 2014, 1.382728966, 4.92, 2),
(10, 2015, 1.487290657, 2.42, 2),
(11, 2016, 1.529187201, 1.42, 2),
(12, 2017, 1.588604204, 0, 2),
(13, 2012, 1.177093351, 3.18, 3),
(14, 2013, 1.313975611, 0.57, 3),
(15, 2014, 1.343635264, 0, 3),
(16, 2015, 0.970545685, 7.13, 3),
(17, 2016, 0.820265656, 10, 3),
(18, 2017, 0.939018023, 7.73, 3),
(19, 2012, 1.114506355, 10, 4),
(20, 2013, 1.147156095, 8.39, 4),
(21, 2014, 1.213344729, 5.11, 4),
(22, 2015, 1.259474235, 2.83, 4),
(23, 2016, 1.281606401, 1.74, 4),
(24, 2017, 1.316739472, 0, 4),
(25, 2012, 1.068184125, 10, 5),
(26, 2013, 1.133610402, 7.92, 5),
(27, 2014, 1.226555119, 4.96, 5),
(28, 2015, 1.27917539, 3.28, 5),
(29, 2016, 1.340706349, 1.32, 5),
(30, 2017, 1.382268242, 0, 5),
(31, 2012, 1.089844822, 10, 6),
(32, 2013, 1.141677704, 8.09, 6),
(33, 2014, 1.18822219, 6.37, 6),
(34, 2015, 1.248645415, 4.15, 6),
(35, 2016, 1.315384454, 1.69, 6),
(36, 2017, 1.361137545, 0, 6),
(37, 2012, 6.92, 9.23, 7),
(38, 2013, 6.05, 3.61, 7),
(39, 2014, 7.04, 10, 7),
(40, 2015, 6.61, 7.23, 7),
(41, 2016, 5.49, 0, 7),
(42, 2017, 5.83, 2.19, 7),
(43, 2012, 55499, 0, 8),
(44, 2013, 58116, 1.72, 8),
(45, 2014, 61481.4, 3.93, 8),
(46, 2015, 64777.2, 6.1, 8),
(47, 2016, 67561.2, 7.93, 8),
(48, 2017, 70703.8, 10, 8),
(49, 2012, 9.971268353, 7.35, 9),
(50, 2013, 9.556382967, 6.63, 9),
(51, 2014, 11.48843483, 10, 9),
(52, 2015, 6.255691685, 0.87, 9),
(53, 2016, 5.755846473, 0, 9),
(54, 2017, 8.739224976, 5.2, 9),
(55, 2012, 5.2, 4.13, 10),
(56, 2013, 5.42, 5.36, 10),
(57, 2014, 5.18, 4.02, 10),
(58, 2015, 6.07, 8.99, 10),
(59, 2016, 6.25, 10, 10),
(60, 2017, 4.46, 0, 10),
(61, 2012, 6.636217302, 7.21, 11),
(62, 2013, 7.576369588, 10, 11),
(63, 2014, 6.98, 8.23, 11),
(64, 2015, 5.62, 4.19, 11),
(65, 2016, 4.21, 0, 11),
(66, 2017, 5.31, 3.27, 11),
(67, 2012, 49.39004464, 10, 12),
(68, 2013, 48.85255492, 7.09, 12),
(69, 2014, 48.81528174, 6.89, 12),
(70, 2015, 48.37712433, 4.52, 12),
(71, 2016, 47.77938205, 1.28, 12),
(72, 2017, 47.54319065, 0, 12),
(73, 2012, 6.32, 2.47, 13),
(74, 2013, 6.27, 2.4, 13),
(75, 2014, 4.59, 0, 13),
(76, 2015, 11.58, 10, 13),
(77, 2016, 5.52, 1.33, 13),
(78, 2017, 7.34, 3.93, 13),
(79, 2012, 5.12, 4.92, 14),
(80, 2013, 6.15, 8.25, 14),
(81, 2014, 3.6, 0, 14),
(82, 2015, 3.7, 0.32, 14),
(83, 2016, 4.42, 2.65, 14),
(84, 2017, 6.69, 10, 14),
(85, 2012, 35.22329346, 10, 15),
(86, 2013, 30.97948654, 4.15, 15),
(87, 2014, 29.38465121, 1.95, 15),
(88, 2015, 31.91964634, 5.44, 15),
(89, 2016, 29.94518985, 2.72, 15),
(90, 2017, 27.97073336, 0, 15),
(91, 2012, 8.41, 0, 16),
(92, 2013, 8.41, 0, 16),
(93, 2014, 8.42, 0.19, 16),
(94, 2015, 8.93, 9.63, 16),
(95, 2016, 8.94, 9.81, 16),
(96, 2017, 8.95, 10, 16),
(97, 2012, 12.63, 0, 17),
(98, 2013, 12.85, 2.06, 17),
(99, 2014, 13.17, 5.05, 17),
(100, 2015, 13.19, 5.23, 17),
(101, 2016, 13.69, 9.91, 17),
(102, 2017, 13.7, 10, 17),
(103, 2012, 91.47, 0, 18),
(104, 2013, 92.34, 1.2, 18),
(105, 2014, 93.55, 2.87, 18),
(106, 2015, 95.78, 5.94, 18),
(107, 2016, 96.59, 7.05, 18),
(108, 2017, 98.73, 10, 18),
(109, 2012, 80.08, 0.16, 19),
(110, 2013, 79.91, 0, 19),
(111, 2014, 84.31, 4.11, 19),
(112, 2015, 90.61, 10, 19),
(113, 2016, 85.57, 5.29, 19),
(114, 2017, 81.99, 1.94, 19),
(115, 2012, 64.3, 1.67, 20),
(116, 2013, 61.3, 0, 20),
(117, 2014, 69.73, 4.69, 20),
(118, 2015, 77.16, 8.83, 20),
(119, 2016, 76.93, 8.7, 20),
(120, 2017, 79.27, 10, 20),
(121, 2012, 72.18, 0, 21),
(122, 2013, 72.19, 0.56, 21),
(123, 2014, 72.2, 1.11, 21),
(124, 2015, 72.3, 6.67, 21),
(125, 2016, 72.33, 8.33, 21),
(126, 2017, 72.36, 10, 21),
(127, 2012, 15.07555988, 10, 22),
(128, 2013, 15.22475442, 7.08, 22),
(129, 2014, 15.55475186, 0.63, 22),
(130, 2015, 15.58678021, 0, 22),
(131, 2016, 15.28442211, 5.91, 22),
(132, 2017, 15.28442211, 5.91, 22),
(133, 2012, 11.59346847, 10, 23),
(134, 2013, 12.01438304, 6.36, 23),
(135, 2014, 12.75116279, 0, 23),
(136, 2015, 12.68870419, 0.54, 23),
(137, 2016, 12.40484805, 2.99, 23),
(138, 2017, 12.40484805, 2.99, 23),
(139, 2012, 10.27623643, 3.89, 24),
(140, 2013, 8.355473555, 10, 24),
(141, 2014, 10.49153567, 3.2, 24),
(142, 2015, 10.77686989, 2.29, 24),
(143, 2016, 11.49681529, 0, 24),
(144, 2017, 11.49681529, 0, 24),
(145, 2012, 11.33409263, 9.49, 25),
(146, 2013, 11.69100295, 6.72, 25),
(147, 2014, 11.26842461, 10, 25),
(148, 2015, 11.47529706, 8.39, 25),
(149, 2016, 12.55679812, 0, 25),
(150, 2017, 12.55679812, 0, 25),
(151, 2012, 174.3536036, 0, 26),
(152, 2013, 174.1438202, 0.6, 26),
(153, 2014, 173.9685393, 1.11, 26),
(154, 2015, 172.7505618, 4.61, 26),
(155, 2016, 170.8764045, 10, 26),
(156, 2017, 170.8764045, 10, 26),
(157, 2012, 308.85, 10, 27),
(158, 2013, 314.2772277, 6.85, 27),
(159, 2014, 325.7227723, 0.21, 27),
(160, 2015, 326.0873786, 0, 27),
(161, 2016, 320.4392523, 3.28, 27),
(162, 2017, 320.4392523, 3.28, 27),
(163, 2012, 10.27623643, 3.89, 28),
(164, 2013, 8.355473555, 10, 28),
(165, 2014, 10.49153567, 3.2, 28),
(166, 2015, 10.77686989, 2.29, 28),
(167, 2016, 11.49681529, 0, 28),
(168, 2017, 11.49681529, 0, 28),
(169, 2012, 373.175, 5.91, 29),
(170, 2013, 377.452381, 5.05, 29),
(171, 2014, 370.3555556, 6.48, 29),
(172, 2015, 352.8653846, 10, 29),
(173, 2016, 402.5283019, 0, 29),
(174, 2017, 402.5283019, 0, 29),
(175, 2012, 20.95, 0, 30),
(176, 2013, 20.59, 1.33, 30),
(177, 2014, 20.34, 2.25, 30),
(178, 2015, 20.1, 3.14, 30),
(179, 2016, 19.88, 3.95, 30),
(180, 2017, 18.24, 10, 30),
(181, 2012, 13.1, 0.28, 31),
(182, 2013, 11.95, 3.26, 31),
(183, 2014, 12.18, 2.67, 31),
(184, 2015, 13.21, 0, 31),
(185, 2016, 9.84, 8.73, 31),
(186, 2017, 9.35, 10, 31),
(187, 2012, 0.363042901, 0.83, 32),
(188, 2013, 0.388702315, 0, 32),
(189, 2014, 0.080999474, 10, 32),
(190, 2015, 0.093456806, 9.6, 32),
(191, 2016, 0.211596425, 5.76, 32),
(192, 2017, 0.364871154, 0.77, 32),
(193, 2012, 0.974983542, 1.3, 33),
(194, 2013, 0.972570613, 0, 33),
(195, 2014, 0.974424684, 1, 33),
(196, 2015, 0.978410883, 3.16, 33),
(197, 2016, 0.991074528, 10, 33),
(198, 2017, 0.973538585, 0.52, 33),
(199, 2012, 0.74276669, 10, 34),
(200, 2013, 0.73343596, 7.8, 34),
(201, 2014, 0.724863544, 5.78, 34),
(202, 2015, 0.716381984, 3.78, 34),
(203, 2016, 0.708269917, 1.86, 34),
(204, 2017, 0.700379294, 0, 34),
(205, 2012, 8.995729917, 10, 35),
(206, 2013, 8.882724405, 8.63, 35),
(207, 2014, 8.698362533, 6.39, 35),
(208, 2015, 8.596583813, 5.16, 35),
(209, 2016, 8.263149031, 1.12, 35),
(210, 2017, 8.171091767, 0, 35),
(211, 2012, 14.35, 0, 36),
(212, 2013, 13.94, 2.65, 36),
(213, 2014, 13.41, 6.06, 36),
(214, 2015, 13.63, 4.65, 36),
(215, 2016, 13.19, 7.48, 36),
(216, 2017, 12.8, 10, 36),
(217, 2012, 2.48, 2.56, 37),
(218, 2013, 2.46, 3.08, 37),
(219, 2014, 2.36, 5.64, 37),
(220, 2015, 2.58, 0, 37),
(221, 2016, 2.19, 10, 37),
(222, 2017, 2.51, 1.79, 37),
(223, 2012, 0.59, 8.13, 38),
(224, 2013, 0.72, 0, 38),
(225, 2014, 0.66, 3.75, 38),
(226, 2015, 0.67, 3.13, 38),
(227, 2016, 0.56, 10, 38),
(228, 2017, 0.71, 0.63, 38),
(229, 2012, 6.78, 0, 39),
(230, 2013, 4.55, 9.96, 39),
(231, 2014, 5.06, 7.68, 39),
(232, 2015, 5.67, 4.96, 39),
(233, 2016, 5.105, 7.48, 39),
(234, 2017, 4.54, 10, 39),
(235, 2012, 63.44, 2.99, 40),
(236, 2013, 66.21, 10, 40),
(237, 2014, 62.26, 0, 40),
(238, 2015, 62.79, 1.34, 40),
(239, 2016, 63.22941839, 2.45, 40),
(240, 2017, 63.35, 2.76, 40),
(241, 2012, 84.6, 5.52, 41),
(242, 2013, 84.8, 6.01, 41),
(243, 2014, 85.3, 7.24, 41),
(244, 2015, 84.2, 4.53, 41),
(245, 2016, 86.42, 10, 41),
(246, 2017, 82.36, 0, 41),
(247, 2012, 93.83, 0, 42),
(248, 2013, 94.23, 0.98, 42),
(249, 2014, 96.23, 5.88, 42),
(250, 2015, 96.83, 7.35, 42),
(251, 2016, 95.83, 4.9, 42),
(252, 2017, 97.91, 10, 42),
(253, 2012, 85.02, 0, 43),
(254, 2013, 88.15, 4.66, 43),
(255, 2014, 88.03, 4.49, 43),
(256, 2015, 89.36, 6.47, 43),
(257, 2016, 91.01, 8.93, 43),
(258, 2017, 91.73, 10, 43),
(259, 2012, 93.23, 6.9, 44),
(260, 2013, 94.3, 9.22, 44),
(261, 2014, 94.66, 10, 44),
(262, 2015, 90.05, 0, 44),
(263, 2016, 92.53, 5.38, 44),
(264, 2017, 90.92, 1.89, 44),
(265, 2012, 72.27, 2.22, 45),
(266, 2013, 68.7, 0, 45),
(267, 2014, 75.04, 3.94, 45),
(268, 2015, 77.02, 5.17, 45),
(269, 2016, 77.56, 5.51, 45),
(270, 2017, 84.78, 10, 45),
(271, 2012, 86.35, 0, 46),
(272, 2013, 87.89, 2.83, 46),
(273, 2014, 88.04, 3.1, 46),
(274, 2015, 90.1, 6.88, 46),
(275, 2016, 91.8, 10, 46),
(276, 2017, 90.71, 8, 46),
(277, 2012, 0.558244311, 0, 47),
(278, 2013, 0.60394102, 3.66, 47),
(279, 2014, 0.628332481, 5.61, 47),
(280, 2015, 0.648651454, 7.24, 47),
(281, 2016, 0.637380319, 6.34, 47),
(282, 2017, 0.683071642, 10, 47),
(283, 2012, 0.244148117, 0.51, 48),
(284, 2013, 0.240590091, 0, 48),
(285, 2014, 0.293664749, 7.6, 48),
(286, 2015, 0.302225088, 8.83, 48),
(287, 2016, 0.271063079, 4.37, 48),
(288, 2017, 0.310386692, 10, 48),
(289, 2012, 1.688141333, 0, 49),
(290, 2013, 1.844044032, 2.73, 49),
(291, 2014, 1.972016526, 4.97, 49),
(292, 2015, 2.259465144, 10, 49),
(293, 2016, 2.151041446, 8.1, 49),
(294, 2017, 1.910543931, 3.89, 49),
(295, 2012, 0.153151906, 0, 50),
(296, 2013, 0.225846762, 3.69, 50),
(297, 2014, 0.254688802, 5.16, 50),
(298, 2015, 0.308881223, 7.91, 50),
(299, 2016, 0.342165652, 9.6, 50),
(300, 2017, 0.350097427, 10, 50),
(301, 2012, 65.31, 9.52, 51),
(302, 2013, 61.55, 0, 51),
(303, 2014, 63.71, 5.47, 51),
(304, 2015, 65.25, 9.37, 51),
(305, 2016, 63.66, 5.34, 51),
(306, 2017, 65.5, 10, 51),
(307, 2012, 0.070404524, 10, 52),
(308, 2013, 0.062452147, 6.07, 52),
(309, 2014, 0.057915943, 3.82, 52),
(310, 2015, 0.052967092, 1.37, 52),
(311, 2016, 0.051175443, 0.49, 52),
(312, 2017, 0.050192935, 0, 52),
(313, 2012, 0.000739032, 10, 53),
(314, 2013, 0.000705822, 7.38, 53),
(315, 2014, 0.000675874, 5.01, 53),
(316, 2015, 0.000695332, 6.55, 53),
(317, 2016, 0.000654812, 3.35, 53),
(318, 2017, 0.000612356, 0, 53);

-- --------------------------------------------------------

--
-- Table structure for table `nilaisubdimensi`
--

CREATE TABLE `nilaisubdimensi` (
  `id_nilai_sd` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_sd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilaisubdimensi`
--

INSERT INTO `nilaisubdimensi` (`id_nilai_sd`, `tahun`, `nilai_rescale`, `kode_sd`) VALUES
(1, 2012, 8.8633333333333, 1),
(2, 2013, 6.67, 1),
(3, 2014, 4.23, 1),
(4, 2015, 3.8916666666667, 1),
(5, 2016, 3.12, 1),
(6, 2017, 1.2883333333333, 1),
(7, 2012, 5.66375, 2),
(8, 2013, 5.6325, 2),
(9, 2014, 5.38375, 2),
(10, 2015, 5.2775, 2),
(11, 2016, 2.89875, 2),
(12, 2017, 4.32375, 2),
(13, 2012, 4.1628571428571, 3),
(14, 2013, 3.8880952380952, 3),
(15, 2014, 3.4709523809524, 3),
(16, 2015, 4.9857142857143, 3),
(17, 2016, 5.0195238095238, 3),
(18, 2017, 4.5433333333333, 3),
(19, 2012, 2.6725, 4),
(20, 2013, 3.9225, 4),
(21, 2014, 5.7825, 4),
(22, 2015, 3.185, 4),
(23, 2016, 8.74, 4),
(24, 2017, 5.605, 4),
(25, 2012, 2.5185714285714, 5),
(26, 2013, 4.8142857142857, 5),
(27, 2014, 4.95, 5),
(28, 2015, 4.5342857142857, 5),
(29, 2016, 6.7385714285714, 5),
(30, 2017, 6.0928571428571, 5),
(31, 2012, 0.1275, 6),
(32, 2013, 2.52, 6),
(33, 2014, 5.835, 6),
(34, 2015, 8.495, 6),
(35, 2016, 7.1025, 6),
(36, 2017, 8.4725, 6),
(37, 2012, 9.84, 7),
(38, 2013, 4.4833333333333, 7),
(39, 2014, 4.7666666666667, 7),
(40, 2015, 5.7633333333333, 7),
(41, 2016, 3.06, 7),
(42, 2017, 3.3333333333333, 7);

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

CREATE TABLE `status_user` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`id`, `menu`) VALUES
(0, 'Administrator'),
(1, 'Operator Pertumbuhan Ekonomi'),
(2, 'Operator Inklusifitas'),
(3, 'Operator Keberlanjutan');

-- --------------------------------------------------------

--
-- Table structure for table `subdimensi`
--

CREATE TABLE `subdimensi` (
  `kode_sd` int(11) NOT NULL,
  `nama_sub_dimensi` varchar(128) NOT NULL,
  `kode_d` int(11) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subdimensi`
--

INSERT INTO `subdimensi` (`kode_sd`, `nama_sub_dimensi`, `kode_d`, `link`) VALUES
(1, 'Indeks Inflasi', 1, 'admin/pertumbuhanEkonomi/ii'),
(2, 'Indeks Aktivitas Ekonomi', 1, 'admin/pertumbuhanEkonomi/iae'),
(3, 'Indeks Pembangunan Sumberdaya Manusia', 1, 'admin/pertumbuhanEkonomi/ipsdm'),
(4, 'Indeks Penanggulangan Kemiskinan', 2, 'admin/inklusifitas/ipk'),
(5, 'Indeks Pemerataan', 2, 'admin/inklusifitas/ip'),
(6, 'Indeks Keberlanjutan Keuangan', 3, 'admin/sustainability/ikk'),
(7, 'Indeks Keberlanjutan Infrastruktur', 3, 'admin/sustainability/iki');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `tahun`) VALUES
(2012, 2012),
(2013, 2013),
(2014, 2014),
(2015, 2015),
(2016, 2016),
(2017, 2017),
(2018, 2018),
(2019, 2019),
(2020, 2020),
(2021, 2021),
(2022, 2022),
(2023, 2023),
(2024, 2024),
(2025, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status_user`) VALUES
(1, 'admin', '$2y$10$I5PumD0zV5jA6R3OvwymZOp8jPA0CkBQH01mBxK0kkpLuu5Ey/D1W', 0),
(4, 'Operator C', '$2y$10$I5PumD0zV5jA6R3OvwymZOp8jPA0CkBQH01mBxK0kkpLuu5Ey/D1W', 3),
(9, 'Operator A', '$2y$10$CLwmUagCYLLrvc7zV3S0T.pjzx02LJttncQHTiJFh6R3aiAjXs8mm', 1),
(10, 'admin2', '$2y$10$UYOabRPQooQsVb0ugqgVFO.XQt19J9OgbK9Q.RzdYMcyXYrNdhNuW', 2),
(11, 'OPD1', '$2y$10$e.O9XjeLVF2hgvy1DVQ0GOgzOZ7iEnrTGTM.ol9w9Z3V56iWvxPUq', 1),
(12, 'OPD2', '$2y$10$JZy9gU5GtTS4SzFGvd65heQ6OjNvEWAHIk5eg0Ol8f4NKlMJoz3Lu', 2),
(13, 'OPD3', '$2y$10$zXblJ8LuZ3Df1K6S9iWQTelOkM.bl/MzTfoOHMKe1DYQEJlOTtPGC', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dimensi`
--
ALTER TABLE `dimensi`
  ADD PRIMARY KEY (`kode_d`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`kode_indikator`),
  ADD KEY `kode_sd` (`kode_sd`);

--
-- Indexes for table `ipi`
--
ALTER TABLE `ipi`
  ADD PRIMARY KEY (`id_nilai_ipi`);

--
-- Indexes for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  ADD PRIMARY KEY (`id_nilai_d`),
  ADD KEY `kode_d` (`kode_d`);

--
-- Indexes for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  ADD PRIMARY KEY (`id_nilai_i`),
  ADD KEY `kode_indikator` (`kode_indikator`);

--
-- Indexes for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  ADD PRIMARY KEY (`id_nilai_sd`),
  ADD KEY `kode_sd` (`kode_sd`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subdimensi`
--
ALTER TABLE `subdimensi`
  ADD PRIMARY KEY (`kode_sd`),
  ADD KEY `kode_d` (`kode_d`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_ibfk_1` (`status_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dimensi`
--
ALTER TABLE `dimensi`
  MODIFY `kode_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `kode_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ipi`
--
ALTER TABLE `ipi`
  MODIFY `id_nilai_ipi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  MODIFY `id_nilai_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  MODIFY `id_nilai_i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  MODIFY `id_nilai_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subdimensi`
--
ALTER TABLE `subdimensi`
  MODIFY `kode_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2026;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`kode_sd`) REFERENCES `subdimensi` (`kode_sd`);

--
-- Constraints for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  ADD CONSTRAINT `nilaidimensi_ibfk_1` FOREIGN KEY (`kode_d`) REFERENCES `dimensi` (`kode_d`);

--
-- Constraints for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  ADD CONSTRAINT `nilaiindikator_ibfk_1` FOREIGN KEY (`kode_indikator`) REFERENCES `indikator` (`kode_indikator`);

--
-- Constraints for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  ADD CONSTRAINT `nilaisubdimensi_ibfk_1` FOREIGN KEY (`kode_sd`) REFERENCES `nilaisubdimensi` (`id_nilai_sd`);

--
-- Constraints for table `subdimensi`
--
ALTER TABLE `subdimensi`
  ADD CONSTRAINT `subdimensi_ibfk_1` FOREIGN KEY (`kode_d`) REFERENCES `dimensi` (`kode_d`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`status_user`) REFERENCES `status_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
