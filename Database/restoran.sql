-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 03:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `carts_v`
-- (See below for the actual view)
--
CREATE TABLE `carts_v` (
`namamenu` varchar(100)
,`harga` int(100)
,`idpelanggan` varchar(100)
,`namapelanggan` varchar(100)
,`jeniskelamin` varchar(100)
,`jumlah` int(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` varchar(100) NOT NULL,
  `namamenu` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `desk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `namamenu`, `harga`, `gambar`, `desk`) VALUES
('3fwxj498k884', 'Pizza Special ', 195200, 'pizza1.jpeg', 'American Pizza '),
('4gx8x84cq3uo', 'Teh Botol Sosro', 4500, 'tehbotol.jpg', 'Minuman Teh '),
('7tsxz7e22fo', 'VM Pizza', 57000, 'pizza2.png', 'VIetname Pizza'),
('b3ia6zqx988', 'Pizza Indonesia', 254500, 'pizza5.png', 'U.K Pizza');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` varchar(100) NOT NULL,
  `namapelanggan` varchar(100) NOT NULL,
  `jeniskelamin` varchar(100) NOT NULL,
  `nohp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `jeniskelamin`, `nohp`, `alamat`) VALUES
('PLG-336265718518161802606248060', 'Dandi', 'Laki-Laki', '08943274826', 'Bandung\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` varchar(100) NOT NULL,
  `idmenu` varchar(100) NOT NULL,
  `idpelanggan` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `iduser` varchar(100) NOT NULL,
  `status_pesanan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idmenu`, `idpelanggan`, `jumlah`, `iduser`, `status_pesanan`) VALUES
('PSN-1783428589651712642608202844', '4gx8x84cq3uo', 'PLG-336265718518161802606248060', 1, 'Ahmad David', 'Belum dibayar');

-- --------------------------------------------------------

--
-- Stand-in structure for view `report`
-- (See below for the actual view)
--
CREATE TABLE `report` (
`idpelanggan` varchar(100)
,`namapelanggan` varchar(100)
,`idpesanan` varchar(100)
,`jumlah` int(100)
,`namamenu` varchar(100)
,`harga` int(100)
,`total` int(100)
,`bayar` int(100)
,`tanggal` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `seecartv`
-- (See below for the actual view)
--
CREATE TABLE `seecartv` (
`idpelanggan` varchar(100)
,`idpesanan` varchar(100)
,`namamenu` varchar(100)
,`namapelanggan` varchar(100)
,`jumlah` int(100)
,`iduser` varchar(100)
,`status_pesanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` varchar(100) NOT NULL,
  `idpesanan` varchar(100) NOT NULL,
  `total` int(100) NOT NULL,
  `bayar` int(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpesanan`, `total`, `bayar`, `tanggal`) VALUES
('TSR-931643390538849064286426442', 'PSN-1783428589651712642608202844', 4500, 5000, '2019-07-04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksiv2`
-- (See below for the actual view)
--
CREATE TABLE `transaksiv2` (
`idpelanggan` varchar(100)
,`namapelanggan` varchar(100)
,`jumlah` int(100)
,`namamenu` varchar(100)
,`total` int(100)
,`bayar` int(100)
,`tanggal` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_v`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_v` (
`namapelanggan` varchar(100)
,`alamat` varchar(100)
,`idmenu` varchar(100)
,`idpesanan` varchar(100)
,`jumlah` int(100)
,`total` int(100)
,`bayar` int(100)
,`tanggal` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` varchar(100) NOT NULL,
  `namauser` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`, `username`, `password`, `level`) VALUES
('1', 'Dandi Ramdani', 'owner', 'owner', 'pemilik'),
('1744322377826324264262484028', 'Dicky Wendi', 'kasir', 'kasir', 'kasir'),
('27634767', 'Ahmad David', 'pelayan', 'pelayan', 'pelayan'),
('3676778', 'Andre Nurul', 'admin', 'admin', 'admin'),
('834677', 'Sandrya Pratama', 'kasir', 'kasir', 'kasir');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_grafik`
-- (See below for the actual view)
--
CREATE TABLE `v_grafik` (
`namamenu` varchar(100)
,`harga` int(100)
,`idmenu` varchar(100)
,`idpesanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `carts_v`
--
DROP TABLE IF EXISTS `carts_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `carts_v`  AS  select `menu`.`namamenu` AS `namamenu`,`menu`.`harga` AS `harga`,`pelanggan`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pelanggan`.`jeniskelamin` AS `jeniskelamin`,`pesanan`.`jumlah` AS `jumlah` from ((`pelanggan` join `pesanan` on((`pelanggan`.`idpelanggan` = `pesanan`.`idpelanggan`))) join `menu` on((`pesanan`.`idmenu` = `menu`.`idmenu`))) ;

-- --------------------------------------------------------

--
-- Structure for view `report`
--
DROP TABLE IF EXISTS `report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report`  AS  select `pelanggan`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pesanan`.`idpesanan` AS `idpesanan`,`pesanan`.`jumlah` AS `jumlah`,`menu`.`namamenu` AS `namamenu`,`menu`.`harga` AS `harga`,`transaksi`.`total` AS `total`,`transaksi`.`bayar` AS `bayar`,`transaksi`.`tanggal` AS `tanggal` from (((`pelanggan` join `pesanan` on((`pelanggan`.`idpelanggan` = `pesanan`.`idpelanggan`))) join `menu` on((`menu`.`idmenu` = `pesanan`.`idmenu`))) join `transaksi` on((`pesanan`.`idpesanan` = `transaksi`.`idpesanan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `seecartv`
--
DROP TABLE IF EXISTS `seecartv`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `seecartv`  AS  select `pelanggan`.`idpelanggan` AS `idpelanggan`,`pesanan`.`idpesanan` AS `idpesanan`,`menu`.`namamenu` AS `namamenu`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pesanan`.`jumlah` AS `jumlah`,`pesanan`.`iduser` AS `iduser`,`pesanan`.`status_pesanan` AS `status_pesanan` from ((`pesanan` join `menu` on((`pesanan`.`idmenu` = `menu`.`idmenu`))) join `pelanggan` on((`pesanan`.`idpelanggan` = `pelanggan`.`idpelanggan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `transaksiv2`
--
DROP TABLE IF EXISTS `transaksiv2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksiv2`  AS  select `pelanggan`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pesanan`.`jumlah` AS `jumlah`,`menu`.`namamenu` AS `namamenu`,`transaksi`.`total` AS `total`,`transaksi`.`bayar` AS `bayar`,`transaksi`.`tanggal` AS `tanggal` from (((`pelanggan` join `pesanan` on((`pelanggan`.`idpelanggan` = `pesanan`.`idpelanggan`))) join `menu` on((`pesanan`.`idmenu` = `menu`.`idmenu`))) join `transaksi` on((`pesanan`.`idpesanan` = `transaksi`.`idpesanan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_v`
--
DROP TABLE IF EXISTS `transaksi_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_v`  AS  select `pelanggan`.`namapelanggan` AS `namapelanggan`,`pelanggan`.`alamat` AS `alamat`,`pesanan`.`idmenu` AS `idmenu`,`pesanan`.`idpesanan` AS `idpesanan`,`pesanan`.`jumlah` AS `jumlah`,`transaksi`.`total` AS `total`,`transaksi`.`bayar` AS `bayar`,`transaksi`.`tanggal` AS `tanggal` from ((`pelanggan` join `pesanan` on((`pelanggan`.`idpelanggan` = `pesanan`.`idpelanggan`))) join `transaksi` on((`pesanan`.`idpesanan` = `transaksi`.`idpesanan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_grafik`
--
DROP TABLE IF EXISTS `v_grafik`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_grafik`  AS  select `menu`.`namamenu` AS `namamenu`,`menu`.`harga` AS `harga`,`pesanan`.`idmenu` AS `idmenu`,`pesanan`.`idpesanan` AS `idpesanan` from (`menu` join `pesanan`) where (`menu`.`idmenu` = `pesanan`.`idmenu`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
