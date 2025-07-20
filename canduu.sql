-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 06:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canduu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id_anak` varchar(20) NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL DEFAULT 'L',
  `nama_ibu` varchar(50) NOT NULL DEFAULT '',
  `nama_ayah` varchar(50) NOT NULL DEFAULT '',
  `alamat` text,
  `panjang_badan` decimal(5,2) NOT NULL DEFAULT '0.00',
  `berat_lahir` decimal(5,2) NOT NULL DEFAULT '0.00',
  `lingkar_kepala` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id_anak`, `nama_anak`, `tanggal_lahir`, `jenis_kelamin`, `nama_ibu`, `nama_ayah`, `alamat`, `panjang_badan`, `berat_lahir`, `lingkar_kepala`) VALUES
('A0001', 'Budi', '2023-01-01', 'L', 'Siti', 'Ahmad', 'Jl. Melati', '50.00', '3.20', '34.50');

-- --------------------------------------------------------

--
-- Table structure for table `ibu_hamil`
--

CREATE TABLE `ibu_hamil` (
  `id_ibu` char(5) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ibu_hamil`
--

INSERT INTO `ibu_hamil` (`id_ibu`, `nik`, `nama_ibu`, `alamat`, `telepon`, `tgl_daftar`) VALUES
('I0001', '1234567890123456', 'SITI NURHALIZA', 'Jl Melati 1', '0812345678', '2025-07-14'),
('I0002', '34321321', 'waktu', 'fwefwerfre', '08787371445', '2025-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `imunisasi`
--

CREATE TABLE `imunisasi` (
  `id_imunisasi` int(11) NOT NULL,
  `jenis_imunisasi` varchar(20) NOT NULL,
  `usia_wajib` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imunisasi`
--

INSERT INTO `imunisasi` (`id_imunisasi`, `jenis_imunisasi`, `usia_wajib`) VALUES
(0, 'BCG', 0),
(1, 'BCG', 6),
(2, 'DPT 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kematian`
--

CREATE TABLE `kematian` (
  `id_kematian` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `tanggal_kematian` date NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kematian`
--

INSERT INTO `kematian` (`id_kematian`, `id_anak`, `tanggal_kematian`, `keterangan`) VALUES
(0, 0, '2025-07-01', 'waktu'),
(1, 1, '2016-10-09', 'Kecelakaan');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_ibu`
--

CREATE TABLE `pemeriksaan_ibu` (
  `id_periksa` char(5) NOT NULL,
  `id_ibu` char(5) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `usia_kandungan` int(2) NOT NULL,
  `bb_ibu` decimal(5,2) NOT NULL,
  `tb_ibu` decimal(5,2) NOT NULL,
  `imunisasi` varchar(30) DEFAULT NULL,
  `vitamin` varchar(30) DEFAULT NULL,
  `saran` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeriksaan_ibu`
--

INSERT INTO `pemeriksaan_ibu` (`id_periksa`, `id_ibu`, `tgl_periksa`, `usia_kandungan`, `bb_ibu`, `tb_ibu`, `imunisasi`, `vitamin`, `saran`) VALUES
('H0001', 'I0002', '2025-07-13', 2, '2.00', '3.00', 'TT', 'fe', 'fwefwefwe');

-- --------------------------------------------------------

--
-- Table structure for table `penimbangan`
--

CREATE TABLE `penimbangan` (
  `id_penimbangan` varchar(20) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `tanggal_timbang` date NOT NULL,
  `usia` varchar(20) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `id_imunisasi` int(11) NOT NULL,
  `id_vitamin` int(11) NOT NULL,
  `saran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vitamin`
--

CREATE TABLE `vitamin` (
  `id_vitamin` int(11) NOT NULL,
  `jenis_vitamin` varchar(20) NOT NULL,
  `usia_wajib` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vitamin`
--

INSERT INTO `vitamin` (`id_vitamin`, `jenis_vitamin`, `usia_wajib`) VALUES
(0, 'Vitamin A', 0),
(1, 'Vitamin A Biru', 0),
(2, 'Vitamin A Merah', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indexes for table `ibu_hamil`
--
ALTER TABLE `ibu_hamil`
  ADD PRIMARY KEY (`id_ibu`);

--
-- Indexes for table `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD PRIMARY KEY (`id_imunisasi`);

--
-- Indexes for table `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`id_kematian`);

--
-- Indexes for table `pemeriksaan_ibu`
--
ALTER TABLE `pemeriksaan_ibu`
  ADD PRIMARY KEY (`id_periksa`),
  ADD KEY `id_ibu` (`id_ibu`);

--
-- Indexes for table `penimbangan`
--
ALTER TABLE `penimbangan`
  ADD PRIMARY KEY (`id_penimbangan`);

--
-- Indexes for table `vitamin`
--
ALTER TABLE `vitamin`
  ADD PRIMARY KEY (`id_vitamin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
