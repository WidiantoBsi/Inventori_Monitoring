-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2021 pada 15.31
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventoridb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_adm`
--

CREATE TABLE `db_adm` (
  `Id_Adm` varchar(15) NOT NULL,
  `Id_Devisi` varchar(25) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(25) DEFAULT NULL,
  `Status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_adm`
--

INSERT INTO `db_adm` (`Id_Adm`, `Id_Devisi`, `Nama`, `Email`, `Password`, `Status`) VALUES
('20211026905766', '124534', 'Widianto', 'widianto@gmail.com', 'admin', 'Y'),
('20211108116180', '20211026WTHTYG', 'Widianto A.Md.Kom', 'widianto1404@gmail.com', '20211108HUVDMUTC', 'N'),
('20211108251121', '20211026274077', 'Bang Boy', 'bangboy@gmail.com', '20211108BQBRGJBV', 'N'),
('20211111934923', '20211111LJIKAC', 'Anto', 'anto@gmail.com', '20211111BJBMQVZD', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_barang`
--

CREATE TABLE `db_barang` (
  `Id_Barang` varchar(15) NOT NULL,
  `Barang` varchar(80) DEFAULT NULL,
  `Item` int(25) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Status` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_barang`
--

INSERT INTO `db_barang` (`Id_Barang`, `Barang`, `Item`, `Tanggal`, `Status`) VALUES
('21102712427', 'Mous Robot M200', 4, '2021-10-27', 'N'),
('21110831580', 'Kertas A4 80 Gram', 6, '2021-11-08', 'N'),
('21110844238', 'Pulpen Faster', 20, '2021-11-08', 'N'),
('21111181736', 'Kertas Invoice', 5, '2021-11-11', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_detail`
--

CREATE TABLE `db_detail` (
  `Id_Devisi` varchar(25) DEFAULT NULL,
  `Id_barang` varchar(50) DEFAULT NULL,
  `Item` int(11) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_devisi`
--

CREATE TABLE `db_devisi` (
  `Id_Devisi` varchar(25) NOT NULL,
  `NamaDevisi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_devisi`
--

INSERT INTO `db_devisi` (`Id_Devisi`, `NamaDevisi`) VALUES
('124534', 'Accounting'),
('20211026274077', 'Sales'),
('20211026WTHTYG', 'Warehouse'),
('20211111LJIKAC', 'Distribution');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_pesanan`
--

CREATE TABLE `db_pesanan` (
  `Id_Pesanan` varchar(20) NOT NULL,
  `Id_barang` varchar(20) NOT NULL,
  `Id_Devisi` varchar(25) DEFAULT NULL,
  `Item` int(11) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_pesanan`
--

INSERT INTO `db_pesanan` (`Id_Pesanan`, `Id_barang`, `Id_Devisi`, `Item`, `Tanggal`, `Keterangan`) VALUES
('80KJZOK', '21111181736', '20211026WTHTYG', 5, '2021-11-11', 'Simpanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_terima`
--

CREATE TABLE `db_terima` (
  `ID` varchar(25) NOT NULL,
  `Id_Barang` varchar(15) DEFAULT NULL,
  `Id_Devisi` varchar(25) DEFAULT NULL,
  `Item` int(15) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_terima`
--

INSERT INTO `db_terima` (`ID`, `Id_Barang`, `Id_Devisi`, `Item`, `Tanggal`) VALUES
('211108442382021-11-11', '21110844238', '20211026WTHTYG', 5, '2021-11-11'),
('211111817362021-11-11', '21111181736', '20211026WTHTYG', 5, '2021-11-11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_adm`
--
ALTER TABLE `db_adm`
  ADD PRIMARY KEY (`Id_Adm`),
  ADD KEY `Id_Devisi` (`Id_Devisi`);

--
-- Indeks untuk tabel `db_barang`
--
ALTER TABLE `db_barang`
  ADD PRIMARY KEY (`Id_Barang`);

--
-- Indeks untuk tabel `db_detail`
--
ALTER TABLE `db_detail`
  ADD KEY `Id_barang` (`Id_barang`),
  ADD KEY `Id_adm` (`Id_Devisi`) USING BTREE;

--
-- Indeks untuk tabel `db_devisi`
--
ALTER TABLE `db_devisi`
  ADD PRIMARY KEY (`Id_Devisi`);

--
-- Indeks untuk tabel `db_pesanan`
--
ALTER TABLE `db_pesanan`
  ADD PRIMARY KEY (`Id_Pesanan`),
  ADD KEY `Id_barang` (`Id_barang`),
  ADD KEY `Id_Devisi` (`Id_Devisi`);

--
-- Indeks untuk tabel `db_terima`
--
ALTER TABLE `db_terima`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Id_Barang` (`Id_Barang`) USING BTREE,
  ADD KEY `Id_Devisi` (`Id_Devisi`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `db_adm`
--
ALTER TABLE `db_adm`
  ADD CONSTRAINT `FK_db_adm_db_devisi` FOREIGN KEY (`Id_Devisi`) REFERENCES `db_devisi` (`Id_Devisi`);

--
-- Ketidakleluasaan untuk tabel `db_detail`
--
ALTER TABLE `db_detail`
  ADD CONSTRAINT `FK_db_detail_db_barang` FOREIGN KEY (`Id_barang`) REFERENCES `db_barang` (`Id_Barang`),
  ADD CONSTRAINT `FK_db_detail_db_devisi` FOREIGN KEY (`Id_Devisi`) REFERENCES `db_devisi` (`Id_Devisi`);

--
-- Ketidakleluasaan untuk tabel `db_pesanan`
--
ALTER TABLE `db_pesanan`
  ADD CONSTRAINT `FK_db_pesanan_db_barang` FOREIGN KEY (`Id_barang`) REFERENCES `db_barang` (`Id_Barang`),
  ADD CONSTRAINT `FK_db_pesanan_db_devisi` FOREIGN KEY (`Id_Devisi`) REFERENCES `db_devisi` (`Id_Devisi`);

--
-- Ketidakleluasaan untuk tabel `db_terima`
--
ALTER TABLE `db_terima`
  ADD CONSTRAINT `FK_db_terima_db_barang` FOREIGN KEY (`Id_Barang`) REFERENCES `db_barang` (`Id_Barang`),
  ADD CONSTRAINT `FK_db_terima_db_devisi` FOREIGN KEY (`Id_Devisi`) REFERENCES `db_devisi` (`Id_Devisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
