-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 03:54 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stokbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang-keluar`
--

CREATE TABLE `barang-keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` varchar(100) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang-keluar`
--

INSERT INTO `barang-keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `harga_jual`, `satuan`, `qty`, `total`, `status`) VALUES
(37, 48, '2023-10-29 15:32:23', 'rivo', '250.000', 'Unit', 25, '', 'Menunggu'),
(38, 48, '2023-10-29 16:01:17', 'rivo', '250.000', 'Unit', 5, '', 'Menunggu'),
(44, 54, '2023-10-31 14:22:50', 'jason', '180000', '', 2, '360000', 'Menunggu'),
(45, 52, '2023-10-31 14:27:03', 'steve', '125000', 'Unit', 5, '625000', 'Menunggu'),
(46, 52, '2023-10-31 14:36:38', 'alo', '125000', 'Unit', 3, '375000', 'Menunggu'),
(47, 55, '2023-11-01 11:07:17', 'Jason', '350000', 'DOS', 10, '3500000', 'Ditolak'),
(48, 55, '2023-11-01 11:07:22', 'Siu', '350000', 'Buah', 5, '1750000', 'Ditolak'),
(49, 56, '2023-11-01 11:07:26', 'jason', '448000', 'Pack', 5, '2240000', 'Ditolak'),
(50, 56, '2023-11-01 11:07:29', 'alo', '350000', 'Buah', 2, '700000', 'Ditolak'),
(51, 73, '2023-11-01 11:07:20', 'Jason', '250000', 'Buah', 10, '2500000', 'Ditolak'),
(52, 57, '2023-11-12 13:14:39', 'jason', '1000000', 'DOS', 10, '10000000', 'Ditolak'),
(58, 55, '2023-11-24 13:06:34', 'steve', '350000', 'Buah', 5, '1750000', 'Disetujui'),
(59, 57, '2023-12-05 14:28:40', 'alo', '1000000', '', 11, '11000000', 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `barang-masuk`
--

CREATE TABLE `barang-masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `harga_beli` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `nama_supplier` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang-masuk`
--

INSERT INTO `barang-masuk` (`idmasuk`, `idbarang`, `tanggal`, `harga_beli`, `satuan`, `nama_supplier`, `qty`, `total`, `status`) VALUES
(125, 52, '2023-10-31 16:13:53', '120000', 'Pack', 'pt jumbo prima', 35, '4200000', 'Menunggu'),
(126, 54, '2023-10-31 16:14:20', '120000', 'Pack', 'pt honda tbk', 25, '3000000', 'Menunggu'),
(127, 55, '2023-11-01 10:10:38', '310000', '', 'Aneka Helm', 35, '10850000', 'Ditolak'),
(128, 56, '2023-11-01 10:18:26', '224000', 'Buah', 'PT Manado Mitra Mandiri', 8, '1792000', 'Ditolak'),
(129, 55, '2023-11-01 10:24:09', '310000', 'DOS', 'Aneka Helm', 15, '4650000', 'Ditolak'),
(130, 73, '2023-11-01 10:58:01', '175000', 'Buah', 'PT Bersama Jaya Perkasa', 30, '5250000', 'Disetujui'),
(131, 57, '2023-11-08 12:37:08', '975000', '', 'PT Bersama Jaya Perkasa', 21, '19500000', 'Ditolak'),
(133, 73, '2023-11-13 15:06:06', '175000', 'Buah', 'PT Bersama Jaya Perkasa', 10, '1750000', 'Disetujui'),
(134, 55, '2023-11-21 15:25:22', '310000', 'Buah', 'PT Bersama Jaya Perkasa', 15, '4650000', 'Ditolak'),
(135, 57, '2023-11-21 15:26:02', '975000', '', 'PT Bersama Jaya Perkasa', 10, '9750000', 'Disetujui'),
(153, 55, '2023-12-05 14:37:58', '310000', '', 'PT Bersama Jaya Perkasa', 10, '3100000', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `jenis-barang`
--

CREATE TABLE `jenis-barang` (
  `id_jenis` int(11) NOT NULL,
  `jenisbarang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis-barang`
--

INSERT INTO `jenis-barang` (`id_jenis`, `jenisbarang`) VALUES
(216, 'Helm Motor'),
(217, 'Ban Motor'),
(218, 'Aki Motor'),
(219, 'Oli Motor');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('petugas','pimpinan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`iduser`, `username`, `password`, `user_type`) VALUES
(1, 'jason', '12345', 'petugas'),
(2, 'pimpinan', 'pimpinan', 'pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(1, 'Buah'),
(2, 'DOS'),
(3, 'PCS'),
(4, 'Pack');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `jenisbarang` varchar(25) NOT NULL,
  `harga_beli` varchar(100) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `jenisbarang`, `harga_beli`, `harga_jual`, `satuan`, `stock`) VALUES
(55, 'Helm NHK R6 Solid Black', 'Helm Motor', '310000', '350000', 'Buah', 58),
(56, 'Aki Yuaza MF YTZ4V', 'Aki Motor', '224000', '448000', 'Pack', 1),
(57, 'Power 4T 10W40', 'Oli Motor', '975000', '1000000', 'Pack', 10),
(58, 'Ban Luar TL Sport XR Evo', 'Ban Motor', '3285000', '3400000', 'PCS', 0),
(73, 'Ban Luar FDR', 'Ban Motor', '175000', '250000', 'PCS', 30),
(81, 'Helm NHK R6 Solid White', 'Helm Motor', '400000', '475000', 'Buah', 0),
(84, 'Oli idemitsu', 'Oli Motor', '100000', '155000', 'Pack', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` varchar(100) NOT NULL,
  `no_telephone` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no_telephone`, `keterangan`) VALUES
(11, 'PT Bersama Jaya Perkasa', 'Jl Raya Manado Bitung', '08124409084', 'Supplier Ban FDR'),
(12, 'PT Casulut Lubrindo Utama', 'Jl Arie Lasut no 127 Wonasa', '08991657226', 'Supplier Oli Motul'),
(13, 'Aneka Helm', 'Jl Wolter Monginsidi Malalayang Satu', '08991657225', 'Supplier Helm'),
(14, 'PT Manado Mitra Mandiri', 'Jl TNI 8 No 18 Tikala', '082290492727', 'Supplier Aki Yuaza');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang-keluar`
--
ALTER TABLE `barang-keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `barang-masuk`
--
ALTER TABLE `barang-masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `jenis-barang`
--
ALTER TABLE `jenis-barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang-keluar`
--
ALTER TABLE `barang-keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `barang-masuk`
--
ALTER TABLE `barang-masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `jenis-barang`
--
ALTER TABLE `jenis-barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
