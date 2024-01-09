-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 05:47 PM
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
  `satuan` varchar(50) NOT NULL,
  `qty_keluar` int(11) NOT NULL,
  `foto_barang` varchar(900) NOT NULL,
  `no_do` varchar(75) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang-keluar`
--

INSERT INTO `barang-keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `satuan`, `qty_keluar`, `foto_barang`, `no_do`, `status`) VALUES
(180, 122, '2023-12-24 04:45:05', 'Jason', 'Buah', 20, 'WhatsApp Image 2020-09-08 at 12.09.41.jpeg', '001', 'Menunggu'),
(181, 122, '2023-12-24 05:25:40', 'Thomas', 'Buah', 150, '6cad856a-7d75-462c-98a7-123f7a8f4341.png', '002', 'Menunggu'),
(182, 122, '2023-12-26 12:46:18', 'thomas', 'Buah', 5, 'Manager.png', '003', 'Menunggu'),
(183, 122, '2024-01-09 05:17:08', 'Jason', 'Buah', 25, '8d98wrhcwlp51.png', '004', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `barang-masuk`
--

CREATE TABLE `barang-masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `satuan` varchar(50) NOT NULL,
  `nama_supplier` varchar(200) NOT NULL,
  `qty_masuk` int(11) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang-masuk`
--

INSERT INTO `barang-masuk` (`idmasuk`, `idbarang`, `tanggal`, `satuan`, `nama_supplier`, `qty_masuk`, `status`) VALUES
(252, 122, '2023-12-24 04:44:24', 'Buah', 'Aneka Helm', 200, 'Menunggu'),
(253, 122, '2024-01-09 05:18:24', 'Buah', 'PT Bersama Jaya Perkasa', 50, 'Menunggu');

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
  `satuan` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `Tanggal_Expired` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `jenisbarang`, `satuan`, `keterangan`, `Tanggal_Expired`, `stock`) VALUES
(122, 'Helm NHK R6 Solid Black', 'Helm Motor', 'Buah', '', '', 50),
(123, 'Oli idemitsu', 'Helm Motor', 'DOS', 'motor honda', '31 Desember 2023', 0),
(124, 'Helm NHK R6 Solid White', 'Helm Motor', 'Buah', '', '', 0),
(125, 'Ban Luar FDR', 'Ban Motor', 'PCS', 'ban yamaha', '', 0),
(126, 'Ban Luar TL Sport XR Evo', 'Ban Motor', 'PCS', 'ban suzuki', '', 0),
(127, 'Aki Yuaza MF YTZ4V', 'Aki Motor', 'Pack', '', '', 0),
(128, 'Power 4T 10W40', 'Aki Motor', 'DOS', '', '', 0);

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
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `barang-masuk`
--
ALTER TABLE `barang-masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `jenis-barang`
--
ALTER TABLE `jenis-barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
