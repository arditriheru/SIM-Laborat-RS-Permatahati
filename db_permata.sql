-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 08:07 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_permata`
--

-- --------------------------------------------------------

--
-- Table structure for table `lab_sampel`
--

CREATE TABLE `lab_sampel` (
  `id_lab_sampel` int(3) NOT NULL,
  `nama_sampel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_sampel`
--

INSERT INTO `lab_sampel` (`id_lab_sampel`, `nama_sampel`) VALUES
(1, 'Darah'),
(2, 'Urine'),
(3, 'Tinja');

-- --------------------------------------------------------

--
-- Table structure for table `lab_tarif`
--

CREATE TABLE `lab_tarif` (
  `id_lab_tarif` int(3) NOT NULL,
  `id_lab_sampel` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai_normal` varchar(20) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tarif` int(11) NOT NULL,
  `kel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_tarif`
--

INSERT INTO `lab_tarif` (`id_lab_tarif`, `id_lab_sampel`, `nama`, `nilai_normal`, `satuan`, `tarif`, `kel`) VALUES
(1, 1, 'HB (RUJUKAN)', '11-14.0', 'g/dL', 103000, 1),
(2, 1, 'AL (LEKOSIT)', '4 -11.0', '10?/?L', 64000, 1),
(3, 1, 'ASAM URAT (L)', '3.6-7.2', 'mg/dL', 54000, 2),
(4, 2, 'URIN RUTIN', '0-0.0 ', '-', 68, 3),
(5, 1, 'HIV', 'NON REAKTIF', '-', 32, 4),
(6, 3, 'FESES RUTIN  ', '0-0.0', 'NEGATIF', 93000, 5),
(7, 1, 'HB (HEMOGLOBIN)', '13 -18.0', 'g/dL', 64000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_trn`
--

CREATE TABLE `lab_trn` (
  `id_lab_trn` int(100) NOT NULL,
  `id_mr_pendaftaran` int(100) NOT NULL,
  `pemeriksaan` varchar(100) NOT NULL,
  `dx` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(8) NOT NULL,
  `selesai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_trn`
--

INSERT INTO `lab_trn` (`id_lab_trn`, `id_mr_pendaftaran`, `pemeriksaan`, `dx`, `tanggal`, `jam`, `selesai`) VALUES
(52, 23, '2,7,4,6', 'DEMAM TINGGI', '2020-10-09', '09:55:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_trn_hasil`
--

CREATE TABLE `lab_trn_hasil` (
  `id_lab_trn_hasil` int(11) NOT NULL,
  `id_lab_trn` int(100) NOT NULL,
  `id_lab_tarif` int(3) NOT NULL,
  `id_petugas` int(3) NOT NULL,
  `hasil_uji` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_trn_hasil`
--

INSERT INTO `lab_trn_hasil` (`id_lab_trn_hasil`, `id_lab_trn`, `id_lab_tarif`, `id_petugas`, `hasil_uji`, `tanggal`, `jam`) VALUES
(16, 52, 2, 1, 'NEGATIF', '2020-10-09', '10:47:44'),
(17, 52, 4, 1, '11-14.0', '2020-10-09', '13:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `mr_dokter`
--

CREATE TABLE `mr_dokter` (
  `id_dokter` int(3) NOT NULL,
  `id_unit` int(2) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mr_dokter`
--

INSERT INTO `mr_dokter` (`id_dokter`, `id_unit`, `nama_dokter`) VALUES
(1, 1, 'Soeroyo Machfudz, Sp.A (K), MPH. dr.'),
(2, 2, 'Irwan Taufiqurahman, Sp.OG (K). dr.'),
(3, 2, 'Arsi Palupi, Sp.OG. dr.'),
(4, 1, 'Restu Maharany, MSc, Sp.A. dr.'),
(5, 2, 'Marie Caesarini, Sp.OG. dr.'),
(8, 2, 'Akbar Novan Dwi, Sp.OG. dr.');

-- --------------------------------------------------------

--
-- Table structure for table `mr_pasien`
--

CREATE TABLE `mr_pasien` (
  `id_pasien` int(10) NOT NULL,
  `id_catatan_medik` int(8) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `sex` int(1) NOT NULL COMMENT '1. Laki-laki, 2. Perempuan',
  `tempat` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kabupaten` varchar(20) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `kelurahan` varchar(20) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mr_pasien`
--

INSERT INTO `mr_pasien` (`id_pasien`, `id_catatan_medik`, `nama_pasien`, `sex`, `tempat`, `tgl_lahir`, `alamat`, `kabupaten`, `kecamatan`, `kelurahan`, `telp`, `email`) VALUES
(24, 10000000, 'UMUM', 1, 'YOGYAKARTA', '1995-08-28', 'SEDOGAN 02/21', 'SLEMAN', 'TEMPEL', 'LUMBUNGREJO', '089629671717', 'arditriheruh@gmail.com'),
(27, 10000001, 'MAYA NANDA DEWI', 2, 'MAGELANG', '1995-07-10', 'GOWOK POS RT 03 RW 07', 'MAGELANG', 'SRUMBUNG', 'DUKUN', '12345678910', 'mayananda@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mr_pendaftaran`
--

CREATE TABLE `mr_pendaftaran` (
  `id_mr_pendaftaran` int(100) NOT NULL,
  `id_catatan_medik` int(8) NOT NULL,
  `id_dokter` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(8) NOT NULL,
  `selesai` int(1) NOT NULL COMMENT '0=belum selesai, 1=selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mr_pendaftaran`
--

INSERT INTO `mr_pendaftaran` (`id_mr_pendaftaran`, `id_catatan_medik`, `id_dokter`, `tanggal`, `jam`, `selesai`) VALUES
(23, 10000001, 3, '2020-10-09', '09:55:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_unit`
--

CREATE TABLE `mr_unit` (
  `id_unit` int(3) NOT NULL,
  `nama_unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mr_unit`
--

INSERT INTO `mr_unit` (`id_unit`, `nama_unit`) VALUES
(1, 'POLI ANAK'),
(2, 'POLI OBSGYN');

-- --------------------------------------------------------

--
-- Table structure for table `psdi_petugas`
--

CREATE TABLE `psdi_petugas` (
  `id_petugas` int(3) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psdi_petugas`
--

INSERT INTO `psdi_petugas` (`id_petugas`, `nama_petugas`, `username`, `password`) VALUES
(1, 'Admin Permata', 'admin', '53289b238246d5426f6de38962411a66'),
(2, 'Ardi Tri Heru', 'arditriheru', 'cfab1ba8c67c7c838db98d666f02a132');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lab_sampel`
--
ALTER TABLE `lab_sampel`
  ADD PRIMARY KEY (`id_lab_sampel`);

--
-- Indexes for table `lab_tarif`
--
ALTER TABLE `lab_tarif`
  ADD PRIMARY KEY (`id_lab_tarif`);

--
-- Indexes for table `lab_trn`
--
ALTER TABLE `lab_trn`
  ADD PRIMARY KEY (`id_lab_trn`);

--
-- Indexes for table `lab_trn_hasil`
--
ALTER TABLE `lab_trn_hasil`
  ADD PRIMARY KEY (`id_lab_trn_hasil`);

--
-- Indexes for table `mr_dokter`
--
ALTER TABLE `mr_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `mr_pasien`
--
ALTER TABLE `mr_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `id_catatan_medik` (`id_catatan_medik`);

--
-- Indexes for table `mr_pendaftaran`
--
ALTER TABLE `mr_pendaftaran`
  ADD PRIMARY KEY (`id_mr_pendaftaran`);

--
-- Indexes for table `mr_unit`
--
ALTER TABLE `mr_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `psdi_petugas`
--
ALTER TABLE `psdi_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lab_sampel`
--
ALTER TABLE `lab_sampel`
  MODIFY `id_lab_sampel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lab_tarif`
--
ALTER TABLE `lab_tarif`
  MODIFY `id_lab_tarif` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lab_trn`
--
ALTER TABLE `lab_trn`
  MODIFY `id_lab_trn` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `lab_trn_hasil`
--
ALTER TABLE `lab_trn_hasil`
  MODIFY `id_lab_trn_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mr_dokter`
--
ALTER TABLE `mr_dokter`
  MODIFY `id_dokter` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mr_pasien`
--
ALTER TABLE `mr_pasien`
  MODIFY `id_pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mr_pendaftaran`
--
ALTER TABLE `mr_pendaftaran`
  MODIFY `id_mr_pendaftaran` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mr_unit`
--
ALTER TABLE `mr_unit`
  MODIFY `id_unit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `psdi_petugas`
--
ALTER TABLE `psdi_petugas`
  MODIFY `id_petugas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
