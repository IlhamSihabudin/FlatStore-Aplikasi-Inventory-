-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Mei 2018 pada 06.34
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_barang` (
`kd_barang` varchar(10)
,`nama_barang` varchar(100)
,`merek` varchar(50)
,`nama_distributor` varchar(100)
,`tanggal_masuk` date
,`harga_barang` int(20)
,`stok_barang` int(20)
,`gambar` varchar(100)
,`keterangan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_transaksi` (
`kd_transaksi` varchar(10)
,`nama_barang` varchar(100)
,`username` varchar(100)
,`harga_barang` int(20)
,`jumlah_beli` int(10)
,`total_harga` int(20)
,`tanggal_beli` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kd_merek` varchar(10) NOT NULL,
  `kd_distributor` varchar(10) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int(20) NOT NULL,
  `stok_barang` int(20) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_distributor`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('B0001', 'pepsodent', 'M0001', 'D0001', '2018-03-14', 2000, 10, 'Bahan.png', 'Is The Best'),
('B0002', 'sikat gigi', 'M0001', 'D0001', '2018-03-14', 4000, 38, '1447338105_Abstract-Texture-Wallpapers-HD.jpg', ''),
('B0003', 'chiki', 'M0002', 'D0002', '2018-03-14', 1000, 15, 'bg.jpg', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_distributor`
--

CREATE TABLE `tbl_distributor` (
  `kd_distributor` varchar(10) NOT NULL,
  `nama_distributor` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_distributor`
--

INSERT INTO `tbl_distributor` (`kd_distributor`, `nama_distributor`, `alamat`, `no_telp`) VALUES
('D0001', 'Rahmad', 'cisarua', '08563569654'),
('D0002', 'ridwan', 'cibeureum', '0845712549');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_merek`
--

CREATE TABLE `tbl_merek` (
  `kd_merek` varchar(10) NOT NULL,
  `merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_merek`
--

INSERT INTO `tbl_merek` (`kd_merek`, `merek`) VALUES
('M0001', 'Indofood'),
('M0002', 'Bendera');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `kd_transaksi` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `kd_user` int(10) NOT NULL,
  `jumlah_beli` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`kd_transaksi`, `kd_barang`, `kd_user`, `jumlah_beli`, `total_harga`, `tanggal_beli`) VALUES
('T0001', 'B0001', 1, 2, 4000, '2018-03-21'),
('T0002', 'B0001', 3, 5, 10000, '2018-04-25'),
('T0003', 'B0003', 3, 5, 5000, '2018-05-07'),
('T0004', 'B0001', 3, 4, 8000, '2018-05-05'),
('T0005', 'B0001', 3, 2, 4000, '2018-05-05'),
('T0005', 'B0003', 3, 2, 2000, '2018-05-05'),
('T0006', 'B0001', 3, 4, 8000, '2018-04-25'),
('T0006', 'B0003', 3, 3, 3000, '2018-04-25'),
('T0007', 'B0002', 3, 2, 8000, '2018-05-06');

--
-- Trigger `tbl_transaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `tbl_transaksi` FOR EACH ROW BEGIN
UPDATE tbl_barang
SET tbl_barang.stok_barang = tbl_barang.stok_barang + OLD.jumlah_beli
WHERE
tbl_barang.kd_barang = OLD.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jual_barang` AFTER INSERT ON `tbl_transaksi` FOR EACH ROW BEGIN
 UPDATE tbl_barang
 SET stok_barang = stok_barang - NEW.jumlah_beli
 WHERE
 kd_barang = NEW.kd_barang;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `kd_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`kd_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'YWRtaW4xMjM=', 'admin'),
(2, 'manager', 'bWFuYWdlcjEyMw==', 'manager'),
(3, 'kasir', 'a2FzaXIxMjM=', 'kasir');

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_barang`
--
DROP TABLE IF EXISTS `daftar_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_barang`  AS  select `tbl_barang`.`kd_barang` AS `kd_barang`,`tbl_barang`.`nama_barang` AS `nama_barang`,`tbl_merek`.`merek` AS `merek`,`tbl_distributor`.`nama_distributor` AS `nama_distributor`,`tbl_barang`.`tanggal_masuk` AS `tanggal_masuk`,`tbl_barang`.`harga_barang` AS `harga_barang`,`tbl_barang`.`stok_barang` AS `stok_barang`,`tbl_barang`.`gambar` AS `gambar`,`tbl_barang`.`keterangan` AS `keterangan` from ((`tbl_barang` join `tbl_merek` on((`tbl_barang`.`kd_merek` = `tbl_merek`.`kd_merek`))) join `tbl_distributor` on((`tbl_barang`.`kd_distributor` = `tbl_distributor`.`kd_distributor`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_transaksi`
--
DROP TABLE IF EXISTS `daftar_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_transaksi`  AS  select `tbl_transaksi`.`kd_transaksi` AS `kd_transaksi`,`tbl_barang`.`nama_barang` AS `nama_barang`,`tbl_user`.`username` AS `username`,`tbl_barang`.`harga_barang` AS `harga_barang`,`tbl_transaksi`.`jumlah_beli` AS `jumlah_beli`,`tbl_transaksi`.`total_harga` AS `total_harga`,`tbl_transaksi`.`tanggal_beli` AS `tanggal_beli` from ((`tbl_transaksi` join `tbl_user` on((`tbl_user`.`kd_user` = `tbl_transaksi`.`kd_user`))) join `tbl_barang` on((`tbl_barang`.`kd_barang` = `tbl_transaksi`.`kd_barang`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tbl_distributor`
--
ALTER TABLE `tbl_distributor`
  ADD PRIMARY KEY (`kd_distributor`);

--
-- Indexes for table `tbl_merek`
--
ALTER TABLE `tbl_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `kd_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
