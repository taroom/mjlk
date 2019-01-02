-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2018 at 05:42 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mjlk`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `nama`, `level`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'admin'),
('8963cbb95f530cbfc6756d5945c5f7bc', '8963cbb95f530cbfc6756d5945c5f7bc', 'hendra', 'admin'),
('ce9689abdeab50b5bee3b56c7aadee27', '', 'Jaya', 'user'),
('ee11cbb19052e40b07aac0ca060c23ee', 'ee11cbb19052e40b07aac0ca060c23ee', 'Widodo', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `inc` int(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `min_size` int(11) NOT NULL,
  `max_size` int(11) NOT NULL,
  `barang_kategori` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`inc`, `barang_id`, `kode`, `barang_nama`, `min_size`, `max_size`, `barang_kategori`) VALUES
(1, 'BD41-45', 'BD', 'BANDENG', 41, 45, 'NM'),
(2, 'BD51-55', 'BD', 'Bandeng', 51, 55, 'NM');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `inc` int(9) NOT NULL,
  `beli_id` varchar(9) NOT NULL,
  `no_fak` varchar(50) NOT NULL,
  `tipe_transaksi` varchar(10) NOT NULL,
  `tgl_trans` varchar(10) NOT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `supplier_nama` varchar(90) NOT NULL,
  `no_kendaraan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`inc`, `beli_id`, `no_fak`, `tipe_transaksi`, `tgl_trans`, `jam_mulai`, `jam_selesai`, `supplier_nama`, `no_kendaraan`) VALUES
(1, 'BM-1', 'ADJIN/B-06/0001', 'ADJIN', '2018-06-28', '2018-06-28 05:34:00', '2018-06-28 05:34:00', 'IP', ''),
(2, 'BM-2', 'ADJIN/B-06/0002', 'ADJIN', '2018-06-28', '2018-06-28 05:39:00', '2018-06-28 05:39:00', 'IP', '6776');

-- --------------------------------------------------------

--
-- Table structure for table `beli_detail`
--

CREATE TABLE `beli_detail` (
  `beli_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `id_gudang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli_detail`
--

INSERT INTO `beli_detail` (`beli_id`, `barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`, `id_gudang`) VALUES
('BM-1', 'BD41-45', 'BD41-45', 'NM', '10.00', 'MC', 'B'),
('BM-1', 'BD51-55', 'BD51-55', 'NM', '10.00', 'MC', 'A'),
('BM-2', 'BD51-55', 'BD51-55', 'NM', '10.00', 'MC', 'B'),
('BM-2', 'BD41-45', 'BD41-45', 'NM', '13.00', 'MC', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `beli_id` varchar(9) NOT NULL,
  `sisa_bayar` double(20,0) NOT NULL,
  `keterangan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`beli_id`, `sisa_bayar`, `keterangan`) VALUES
('BM-1', 20, 'blm lunas'),
('BM-2', 23, 'blm lunas');

-- --------------------------------------------------------

--
-- Table structure for table `hutang_detail`
--

CREATE TABLE `hutang_detail` (
  `beli_id` varchar(9) NOT NULL,
  `tgl_bayar` varchar(10) NOT NULL,
  `jml_bayar` double(20,0) NOT NULL,
  `sisa_bayar` double(20,0) NOT NULL,
  `inc` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang_detail`
--

INSERT INTO `hutang_detail` (`beli_id`, `tgl_bayar`, `jml_bayar`, `sisa_bayar`, `inc`) VALUES
('BM-1', '2018-06-28', 0, 20, 1),
('BM-2', '2018-06-28', 0, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jt` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jt`, `nama`, `tipe`) VALUES
('ADJIN', 'ADJIN', 'IN'),
('ADJOUT', 'Adj Out', 'OUT'),
('BLM', 'BLM', 'IN'),
('BNK', 'Bongkar', 'IN'),
('EXP', 'Muat / Export', 'OUT'),
('PCK', 'Packing', 'IN'),
('RPK', 'RePacking', 'IN'),
('SJ', 'Muat', 'OUT');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `inc` int(9) NOT NULL,
  `jual_id` varchar(14) NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `tipe_transaksi` varchar(10) NOT NULL,
  `tgl_jual` varchar(10) NOT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `no_kendaraan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`inc`, `jual_id`, `no_nota`, `tipe_transaksi`, `tgl_jual`, `jam_mulai`, `jam_selesai`, `username`, `pelanggan_nama`, `no_kendaraan`) VALUES
(1, 'JL-1', 'ADJOUT/J-06/0001', 'ADJOUT', '2018-06-26', '2018-06-26 15:08:00', '2018-06-26 19:00:00', '21232f297a57a5a743894a0e4a801fc3', 'PLG-2', '6776'),
(2, 'JL-2', 'ADJOUT/J-06/0002', 'ADJOUT', '2018-06-28', '2018-06-28 05:48:00', '2018-06-28 05:48:00', '21232f297a57a5a743894a0e4a801fc3', 'PLG-2', '6776');

-- --------------------------------------------------------

--
-- Table structure for table `jual_detail`
--

CREATE TABLE `jual_detail` (
  `jual_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `id_gudang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jual_detail`
--

INSERT INTO `jual_detail` (`jual_id`, `barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`, `id_gudang`) VALUES
('JL-1', 'BD41-45', 'BANDENG', 'NM', '10.00', 'MC', 'A'),
('JL-1', 'BD41-45', 'BANDENG', 'NM', '10.00', 'MC', 'A'),
('JL-2', 'BD41-45', 'BANDENG', 'NM', '10.00', 'MC', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `kode_daerah`
--

CREATE TABLE `kode_daerah` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kode_daerah`
--

INSERT INTO `kode_daerah` (`id`, `nama`) VALUES
('BT', 'Bitung'),
('FKN', 'Fatkan'),
('JKT', 'Jakarta'),
('KDI', 'Kendari'),
('MCR', 'Muncar'),
('MKS', 'Makasar'),
('MLG', 'Malang'),
('PALU', 'Palu'),
('PRG', 'Prigi'),
('TLKNG', 'Tali Kuning'),
('TRK', 'Tarakan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `inc` int(9) NOT NULL,
  `pelanggan_id` varchar(9) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `pelanggan_alamat` varchar(90) NOT NULL,
  `pelanggan_kota` varchar(50) NOT NULL,
  `pelanggan_email` varchar(90) NOT NULL,
  `pelanggan_kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`inc`, `pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_kota`, `pelanggan_email`, `pelanggan_kontak`) VALUES
(2, 'PLG-2', 'Komang', 'Jl.Setiabudi Penarungan', 'Singaraja', 'komkim@yahoo.com', '082345245'),
(3, 'PLG-3', 'Fendi', 'Jl.Gn Agung', 'Denpasar', 'fendi@yahoo.com', '085755476792'),
(4, 'PLG-4', 'Hendra', 'Jl. Laksamana', 'Singaraja', 'hendrasatriani90@yahoo.co.id', '08452455424'),
(5, 'PLG-5', 'Ayu', 'Jl.Gn Guntur', 'Denpasar', 'ayu@yahoo.co.id', '0879967700'),
(6, 'PLG-6', 'Andy', 'Jl. Gatot Subroto Barat', 'Denpasar', 'andy@yahoo.com', '08500700'),
(7, 'PLG-7', 'Ketut Atmaja', 'Jl. Pulau Batam', 'Singaraja', 'ktatmaja@yahoo.com', '08512345'),
(8, 'PLG-8', 'Kadek Leo', 'Jl. Sermakarma', 'Singaraja', 'leo_kade@yahoo.com', '085789000'),
(9, 'PLG-9', 'Gusti Bagus Jayantara', 'Jl. A.Yani', 'Singaraja', 'gusti_bgst@yahoo.com', '0854372889');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `jual_id` varchar(9) NOT NULL,
  `no_nota` varchar(17) NOT NULL,
  `tgl_jual` varchar(10) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `piutang_awal` double(20,0) NOT NULL,
  `jml_bayar` double(20,0) NOT NULL,
  `piutang_sisa` double(20,0) NOT NULL,
  `tgl_jatuh_tempo` varchar(10) NOT NULL,
  `keterangan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`jual_id`, `no_nota`, `tgl_jual`, `pelanggan_nama`, `piutang_awal`, `jml_bayar`, `piutang_sisa`, `tgl_jatuh_tempo`, `keterangan`) VALUES
('JL-1', 'nota-1', '11/04/2012', 'Komang', 235000, 935000, 0, '12/04/2012', 'lunas'),
('JL-3', 'nota-3', '11/04/2012', 'Fendi', 404000, 500000, 404000, '12/04/2012', 'blm lunas'),
('JL-4', 'nota-4', '07/04/2012', 'Andy', 198000, 568000, 0, '09/04/2012', 'lunas'),
('JL-5', 'nota-5', '12/04/2012', 'Ketut Atmaja', 190000, 200000, 190000, '14/04/2012', 'blm lunas'),
('JL-6', 'nota-6', '24/04/2012', 'umum', 70000, 200000, 70000, '25/04/2012', 'blm lunas');

-- --------------------------------------------------------

--
-- Table structure for table `piutang_detail`
--

CREATE TABLE `piutang_detail` (
  `jual_id` varchar(9) NOT NULL,
  `tgl_bayar` varchar(10) NOT NULL,
  `jml_bayar` double(20,0) NOT NULL,
  `sisa_bayar` double(20,0) NOT NULL,
  `inc` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang_detail`
--

INSERT INTO `piutang_detail` (`jual_id`, `tgl_bayar`, `jml_bayar`, `sisa_bayar`, `inc`) VALUES
('JL-1', '11/04/2012', 700000, 235000, 1),
('JL-3', '11/04/2012', 500000, 404000, 1),
('JL-4', '07/04/2012', 370000, 198000, 1),
('JL-5', '12/04/2012', 200000, 190000, 1),
('JL-1', '15/04/2012', 235000, 0, 2),
('JL-4', '24/04/2012', 198000, 0, 2),
('JL-6', '24/04/2012', 200000, 70000, 1),
('JL-1', '27/04/2018', 0, 40000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `piutang_temp`
--

CREATE TABLE `piutang_temp` (
  `nota` varchar(14) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `cus` varchar(90) NOT NULL,
  `nilai` double(20,0) NOT NULL,
  `titip` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang_temp`
--

INSERT INTO `piutang_temp` (`nota`, `tgl`, `cus`, `nilai`, `titip`) VALUES
('12301', '07-11-2011', 'BDRA, B BADRA', 4700000, 0),
('12463', '10-11-2011', 'BDRA, B BADRA', 7800000, 0),
('12613', '13-11-2011', 'BDRA, B BADRA', 2850000, 0),
('13871', '01-12-2011', 'BDRA, B BADRA', 6325000, 0),
('18668', '02-12-2011', 'PSP, B PUSPA', 14410000, 6000000),
('19208', '13-12-2011', 'BDRA, B BADRA', 10375000, 0),
('19214', '14-12-2011', 'BDRA, B BADRA', 1250000, 0),
('19267', '15-12-2011', 'BDRA, B BADRA', 1900000, 0),
('19586', '24-12-2011', 'WLG, WAYAN LANGGENG', 10200000, 0),
('19717', '27-12-2011', 'BDRA, B BADRA', 14675000, 0),
('19746', '28-12-2011', 'WLG, WAYAN LANGGENG', 4500000, 0),
('19790', '29-12-2011', 'BDRA, B BADRA', 5570000, 0),
('19822', '30-12-2011', 'WLG, WAYAN LANGGENG', 6750000, 0),
('19855', '31-12-2011', 'WLG, WAYAN LANGGENG', 1485000, 0),
('19866', '31-12-2011', 'WLG, WAYAN LANGGENG', 6300000, 0),
('19881', '01-01-2012', 'WLG, WAYAN LANGGENG', 3600000, 0),
('19939', '02-01-2012', 'WLG, WAYAN LANGGENG', 4500000, 0),
('20222', '07-01-2012', 'WLG, WAYAN LANGGENG', 5700000, 0),
('20299', '08-01-2012', 'JRO, BU JERO PSR AYR', 270000, 0),
('20583', '14-01-2012', 'KDS, KADEK SUAR', 6800000, 0),
('20918', '19-01-2012', 'UDN, UDIN JAENAL', 1530000, 0),
('20918', '19-01-2012', 'UDN, UDIN JAENAL', 300000, 0),
('20982', '20-01-2012', 'UDN, UDIN JAENAL', 270000, 0),
('20996', '21-01-2012', 'SKT, BU SEKERTI', 310000, 0),
('21455', '25-01-2012', 'BDRA, B BADRA', 7175000, 0),
('21515', '25-01-2012', 'WATI, WATI T', 3300000, 0),
('21619', '26-01-2012', 'TUNAS, B TUNAS', 6380000, 0),
('21719', '26-01-2012', 'TUNAS, B TUNAS', 1035000, 0),
('21799', '27-01-2012', 'TUNAS, B TUNAS', 665000, 0),
('21923', '28-01-2012', 'TUNAS, B TUNAS', 950000, 0),
('13960', '29-01-2012', 'TUNAS, B TUNAS', 3150000, 0),
('22202', '29-01-2012', 'TUNAS, B TUNAS', 5700000, 0),
('22338', '29-01-2012', 'UDN, UDIN JAENAL', 800000, 0),
('22468', '30-01-2012', 'SKT, BU SEKERTI', 950000, 0),
('22623', '31-01-2012', 'WLG, WAYAN LANGGENG', 14750000, 0),
('22698', '03-02-2012', 'TUNAS, B TUNAS', 2080000, 0),
('22777', '04-02-2012', 'MANGKIN, B MANGKIN', 730000, 0),
('22853', '05-02-2012', 'TUNAS, B TUNAS', 900000, 0),
('22880', '05-02-2012', 'MANGKIN, B MANGKIN', 960000, 0),
('22942', '06-02-2012', 'TUNAS, B TUNAS', 350000, 0),
('22975', '06-02-2012', 'UDN, UDIN JAENAL', 900000, 0),
('22996', '06-02-2012', 'SD, DSK ADE', 7000000, 0),
('22997', '06-02-2012', 'MANGKIN, B MANGKIN', 180000, 0),
('23020', '07-02-2012', 'DUL, P DUL', 475000, 0),
('23081', '07-02-2012', 'TUNAS, B TUNAS', 2250000, 0),
('23103', '07-02-2012', 'MANGKIN, B MANGKIN', 570000, 0),
('23120', '07-02-2012', 'TUNAS, B TUNAS', 2575000, 0),
('23121', '07-02-2012', 'H,AWR, HJ.ANWAR', 10850000, 0),
('23137', '07-02-2012', 'TUNAS, B TUNAS', 1200000, 0),
('23148', '08-02-2012', 'DUL, P DUL', 1050000, 0),
('23201', '08-02-2012', 'TUNAS, B TUNAS', 1450000, 0),
('23260', '08-02-2012', 'TUNAS, B TUNAS', 3050000, 0),
('23296', '08-02-2012', 'SD, DSK ADE', 59800000, 0),
('23321', '08-02-2012', 'MANGKIN, B MANGKIN', 140000, 0),
('23345', '09-02-2012', 'TUNAS, B TUNAS', 1050000, 0),
('23364', '09-02-2012', 'SKT, BU SEKERTI', 1090000, 0),
('23368', '09-02-2012', 'SD, DSK ADE', 35850000, 0),
('23433', '09-02-2012', 'TUNAS, B TUNAS', 2950000, 0),
('23497', '10-02-2012', 'TUNAS, B TUNAS', 3000000, 0),
('23551', '10-02-2012', 'TUNAS, B TUNAS', 450000, 0),
('23571', '10-02-2012', 'MANGKIN, B MANGKIN', 435000, 0),
('23572', '10-02-2012', 'TUNAS, B TUNAS', 2215000, 0),
('23623', '12-02-2012', 'SML, SAMSOEL', 9150000, 0),
('23632', '12-02-2012', 'TUNAS, B TUNAS', 4250000, 0),
('23635', '12-02-2012', 'MANGKIN, B MANGKIN', 590000, 0),
('23653', '13-02-2012', 'SKT, BU SEKERTI', 305000, 0),
('23677', '13-02-2012', 'SKT, BU SEKERTI', 610000, 0),
('23689', '13-02-2012', 'MANGKIN, B MANGKIN', 125000, 0),
('23691', '13-02-2012', 'H,AWR, HJ.ANWAR', 15325000, 0),
('23697', '13-02-2012', 'BDRA, B BADRA', 4400000, 0),
('23711', '13-02-2012', 'MANGKIN, B MANGKIN', 125000, 0),
('23727', '14-02-2012', 'SKT, BU SEKERTI', 300000, 0),
('23779', '15-02-2012', 'TUNAS, B TUNAS', 1055000, 0),
('23786', '15-02-2012', 'MANGKIN, B MANGKIN', 430000, 0),
('23841', '16-02-2012', 'TUNAS, B TUNAS', 1190000, 0),
('23849', '17-02-2012', 'SKT, BU SEKERTI', 300000, 0),
('23880', '17-02-2012', 'SD, DSK ADE', 5800000, 0),
('23885', '17-02-2012', 'H,AWR, HJ.ANWAR', 7000000, 0),
('23886', '17-02-2012', 'ARIP, ARIP LOMBOK', 7200000, 0),
('23902', '17-02-2012', 'TUNAS, B TUNAS', 510000, 0),
('23913', '18-02-2012', 'TUNAS, B TUNAS', 2730000, 0),
('23956', '18-02-2012', 'SD, DSK ADE', 5800000, 0),
('23964', '18-02-2012', 'ARIP, ARIP LOMBOK', 14000000, 0),
('30', '19-02-2012', 'SKT, BU SEKERTI', 225000, 0),
('23996', '19-02-2012', 'TUNAS, B TUNAS', 5065000, 0),
('89', '19-02-2012', 'MANGKIN, B MANGKIN', 300000, 0),
('100', '19-02-2012', 'MHD, MAS HADI BALI BUAH', 2325000, 0),
('166', '19-02-2012', 'MHD, MAS HADI BALI BUAH', 1350000, 0),
('130', '20-02-2012', 'TUNAS, B TUNAS', 1900000, 0),
('137', '20-02-2012', 'MHD, MAS HADI BALI BUAH', 10650000, 0),
('146', '20-02-2012', 'SMP, BU SIMPEN LOMBOK', 21122500, 0),
('168', '20-02-2012', 'DVA, BU DIVA', 1810000, 1000000),
('171', '20-02-2012', 'MANGKIN, B MANGKIN', 190000, 0),
('176', '20-02-2012', 'ARIP, ARIP LOMBOK', 9800000, 0),
('238', '21-02-2012', 'YNN, YONO', 1060000, 0),
('244', '21-02-2012', 'MANGKIN, B MANGKIN', 270000, 0),
('270', '22-02-2012', 'MANGKIN, B MANGKIN', 600000, 0),
('271', '22-02-2012', 'CKR, CAK KARNO', 8150000, 0),
('277', '22-02-2012', 'TUNAS, B TUNAS', 700000, 0),
('283', '22-02-2012', 'HMURSID, H MURSID LOMBOK', 7650000, 0),
('285', '22-02-2012', 'SMP, BU SIMPEN LOMBOK', 20050000, 0),
('328', '23-02-2012', 'NENI, NENI LOMBOK', 4200000, 0),
('330', '23-02-2012', 'H,AWR, HJ.ANWAR', 3500000, 0),
('349', '24-02-2012', 'TUNAS, B TUNAS', 2120000, 0),
('353', '24-02-2012', 'NENI, NENI LOMBOK', 3250000, 0),
('355', '24-02-2012', 'CKR, CAK KARNO', 3950000, 0),
('363', '24-02-2012', 'KDG, KOMANG DOGOL', 1600000, 0),
('365', '24-02-2012', 'M.OKA, MADE OKA', 4400000, 0),
('370', '24-02-2012', 'MANGKIN, B MANGKIN', 280000, 0),
('396', '25-02-2012', 'TUNAS, B TUNAS', 1400000, 0),
('403', '25-02-2012', 'NENI, NENI LOMBOK', 5250000, 0),
('404', '25-02-2012', 'M.OKA, MADE OKA', 7250000, 0),
('430', '26-02-2012', 'KDG, KOMANG DOGOL', 4350000, 0),
('460', '27-02-2012', 'HMURSID, H MURSID LOMBOK', 5325000, 0),
('464', '27-02-2012', 'SD, DSK ADE', 4350000, 0),
('465', '27-02-2012', 'ARIP, ARIP LOMBOK', 8250000, 0),
('521', '29-02-2012', 'UDN, UDIN JAENAL', 340000, 0),
('522', '01-03-2012', 'SD, DSK ADE', 7000000, 0),
('537', '01-03-2012', 'CKR, CAK KARNO', 2675000, 0),
('543', '01-03-2012', 'H,AWR, HJ.ANWAR', 1400000, 0),
('544', '01-03-2012', 'UDN, UDIN JAENAL', 680000, 0),
('570', '02-03-2012', 'KML, KOMANG LILI LOMBOK', 2250000, 0),
('571', '02-03-2012', 'MANGKIN, B MANGKIN', 460000, 0),
('576', '02-03-2012', 'TD, P TUDE', 3715000, 3710000),
('582', '02-03-2012', 'SML, SAMSOEL', 11270000, 0),
('597', '03-03-2012', 'CKR, CAK KARNO', 6875000, 0),
('592', '03-03-2012', 'MANGKIN, B MANGKIN', 425000, 0),
('607', '03-03-2012', 'KDS, KADEK SUAR', 3785000, 0),
('627', '03-03-2012', 'H,AWR, HJ.ANWAR', 1700000, 0),
('652', '04-03-2012', 'ARIK, ARIK SEMPIDI', 1635000, 835000),
('701', '04-03-2012', 'CKR, CAK KARNO', 5625000, 0),
('712', '04-03-2012', 'MANGKIN, B MANGKIN', 300000, 0),
('720', '04-03-2012', 'NENI, NENI LOMBOK', 10125000, 0),
('723', '04-03-2012', 'KDL, KADEK LOLE', 3375000, 0),
('724', '04-03-2012', 'M.OKA, MADE OKA', 8687500, 0),
('748', '05-03-2012', 'SD, DSK ADE', 7550000, 0),
('783', '05-03-2012', 'MANGKIN, B MANGKIN', 475000, 0),
('809', '05-03-2012', 'KDG, KOMANG DOGOL', 7800000, 0),
('827', '05-03-2012', 'NENI, NENI LOMBOK', 3300000, 0),
('839', '06-03-2012', 'DEWI L, DEWI SEMPIDI', 1320000, 0),
('884', '06-03-2012', 'TUNAS, B TUNAS', 300000, 0),
('894', '06-03-2012', 'CKR, CAK KARNO', 10312500, 0),
('903', '06-03-2012', 'KML, KOMANG LILI LOMBOK', 19987500, 0),
('909', '06-03-2012', 'H,AWR, HJ.ANWAR', 6675000, 0),
('899', '06-03-2012', 'MANGKIN, B MANGKIN', 920000, 0),
('981', '08-03-2012', 'CKR, CAK KARNO', 4450000, 0),
('993', '08-03-2012', 'KML, KOMANG LILI LOMBOK', 8000000, 0),
('1026', '09-03-2012', 'KML, KOMANG LILI LOMBOK', 5500000, 0),
('1030', '09-03-2012', 'MANGKIN, B MANGKIN', 180000, 0),
('1062', '10-03-2012', 'HMURSID, H MURSID LOMBOK', 6850000, 0),
('1064', '10-03-2012', 'H,AWR, HJ.ANWAR', 3750000, 0),
('1066', '10-03-2012', 'KML, KOMANG LILI LOMBOK', 11500000, 0),
('1073', '10-03-2012', 'M.OKA, MADE OKA', 6000000, 0),
('1103', '11-03-2012', 'NENI, NENI LOMBOK', 6450000, 0),
('1104', '11-03-2012', 'H,AWR, HJ.ANWAR', 6450000, 0),
('1145', '12-03-2012', 'CKR, CAK KARNO', 3625000, 0),
('1157', '12-03-2012', 'M.OKA, MADE OKA', 3000000, 0),
('1159', '12-03-2012', 'SMP, BU SIMPEN LOMBOK', 13750000, 0),
('1162', '12-03-2012', 'KML, KOMANG LILI LOMBOK', 14710000, 0),
('1164', '12-03-2012', 'H,AWR, HJ.ANWAR', 3750000, 0),
('1165', '12-03-2012', 'TUNAS, B TUNAS', 2300000, 0),
('1189', '13-03-2012', 'MANGKIN, B MANGKIN', 285000, 0),
('1201', '13-03-2012', 'KDS, KADEK SUAR', 4025000, 0),
('1203', '13-03-2012', 'KML, KOMANG LILI LOMBOK', 3800000, 0),
('1207', '13-03-2012', 'GST, PAK GUSTI AJI', 750000, 0),
('1209', '13-03-2012', 'H,AWR, HJ.ANWAR', 6650000, 0),
('1226', '14-03-2012', 'KDEK, KADEK CARRY', 3730000, 0),
('1227', '14-03-2012', 'MANGKIN, B MANGKIN', 225000, 0),
('1240', '14-03-2012', 'BU BGS, GU BAGUS TABANAN', 705000, 0),
('1246', '14-03-2012', 'KDL, KADEK LOLE', 5580000, 0),
('1248', '14-03-2012', 'SD, DSK ADE', 14100000, 0),
('1359', '14-03-2012', 'TUNAS, B TUNAS', 1350000, 0),
('1391', '15-03-2012', 'MANGKIN, B MANGKIN', 350000, 0),
('1395', '15-03-2012', 'TUNAS, B TUNAS', 900000, 0),
('1410', '15-03-2012', 'M.OKA, MADE OKA', 5250000, 0),
('1411', '15-03-2012', 'KML, KOMANG LILI LOMBOK', 8400000, 0),
('1472', '16-03-2012', 'MANGKIN, B MANGKIN', 440000, 0),
('1502', '16-03-2012', 'TUNAS, B TUNAS', 1750000, 0),
('1530', '17-03-2012', 'ARIK, ARIK SEMPIDI', 3940000, 0),
('1265', '17-03-2012', 'PTN, PANTENE', 2160000, 0),
('1282', '17-03-2012', 'TUNAS, B TUNAS', 3100000, 0),
('1292', '17-03-2012', 'PWT, WATI KEDIRI', 540000, 0),
('1328', '17-03-2012', 'KDEK, KADEK CARRY', 4095000, 0),
('1349', '17-03-2012', 'P EDO, PAK EDO/SURYA NADI', 1520000, 0),
('1568', '18-03-2012', 'SML, SAMSOEL', 6765000, 0),
('1596', '18-03-2012', 'CKR, CAK KARNO', 9750000, 0),
('1601', '18-03-2012', 'MANGKIN, B MANGKIN', 635000, 0),
('1650', '18-03-2012', 'SMP, BU SIMPEN LOMBOK', 11250000, 0),
('1651', '18-03-2012', 'KML, KOMANG LILI LOMBOK', 22200000, 0),
('1663', '18-03-2012', 'KDL, KADEK LOLE', 1150000, 0),
('1674', '18-03-2012', 'TUNAS, B TUNAS', 2225000, 0),
('1676', '18-03-2012', 'STM, BU SUTAMI KLUNGKUNG', 11250000, 0),
('1692', '19-03-2012', 'SD, DSK ADE', 7200000, 0),
('1718', '19-03-2012', 'SM, SUMERTO', 1080000, 400000),
('1744', '19-03-2012', 'STM, BU SUTAMI KLUNGKUNG', 13000000, 0),
('1748', '19-03-2012', 'KDG, KOMANG DOGOL', 5750000, 0),
('1751', '19-03-2012', 'HMURSID, H MURSID LOMBOK', 9100000, 0),
('1752', '19-03-2012', 'KML, KOMANG LILI LOMBOK', 3900000, 0),
('1755', '19-03-2012', 'CKR, CAK KARNO', 14300000, 0),
('1760', '19-03-2012', 'BLH, BU ILUH SINGARAJA', 13325000, 0),
('1761', '19-03-2012', 'M.OKA, MADE OKA', 6750000, 0),
('1784', '19-03-2012', 'H,AWR, HJ.ANWAR', 4500000, 0),
('1785', '19-03-2012', 'M.OKA, MADE OKA', 5250000, 0),
('1854', '20-03-2012', 'STM, BU SUTAMI KLUNGKUNG', 14300000, 0),
('1859', '20-03-2012', 'CKR, CAK KARNO', 5700000, 0),
('1864', '20-03-2012', 'SD, DSK ADE', 9900000, 0),
('1876', '20-03-2012', 'KML, KOMANG LILI LOMBOK', 45500000, 0),
('1879', '21-03-2012', 'SMP, BU SIMPEN LOMBOK', 16750000, 0),
('1892', '21-03-2012', 'TUNAS, B TUNAS', 1125000, 0),
('1894', '21-03-2012', 'CKR, CAK KARNO', 5255000, 0),
('1896', '21-03-2012', 'PTN, PANTENE', 1190000, 0),
('1938', '21-03-2012', 'CKR, CAK KARNO', 2925000, 0),
('1942', '21-03-2012', 'MANGKIN, B MANGKIN', 720000, 0),
('1969', '24-03-2012', 'TUNAS, B TUNAS', 460000, 0),
('1984', '24-03-2012', 'CKR, CAK KARNO', 3500000, 0),
('1987', '24-03-2012', 'SD, DSK ADE', 11650000, 0),
('1992', '24-03-2012', 'HMURSID, H MURSID LOMBOK', 11600000, 0),
('1993', '24-03-2012', 'KML, KOMANG LILI LOMBOK', 6250000, 0),
('1996', '24-03-2012', 'M.OKA, MADE OKA', 7500000, 0),
('1979', '25-03-2012', 'BDY, BU DAYU KLUNGKUNG', 21115000, 0),
('2000', '25-03-2012', 'KDL, KADEK LOLE', 220000, 0),
('2019', '25-03-2012', 'BDY, BU DAYU KLUNGKUNG', 18325000, 0),
('2023', '25-03-2012', 'TUNAS, B TUNAS', 475000, 0),
('2027', '25-03-2012', 'DUL, P DUL', 1315000, 0),
('2030', '25-03-2012', 'JRN, GU JARNI KLUNGKUNG', 18925000, 0),
('2035', '25-03-2012', 'BJRP, BU JERO PENEBEL', 2075000, 0),
('2094', '25-03-2012', 'NIK, NIIIIK', 745000, 0),
('2103', '25-03-2012', 'KML, KOMANG LILI LOMBOK', 23225000, 0),
('2105', '25-03-2012', 'CKR, CAK KARNO', 6625000, 0),
('2106', '25-03-2012', 'BDY, BU DAYU KLUNGKUNG', 14300000, 0),
('2150', '26-03-2012', 'KDKYONI, KADEK YONI', 7350000, 0),
('2157', '26-03-2012', 'MANGKIN, B MANGKIN', 605000, 0),
('2167', '26-03-2012', 'KDKYONI, KADEK YONI', 2845000, 0),
('2173', '26-03-2012', 'BDY, BU DAYU KLUNGKUNG', 11525000, 0),
('2183', '26-03-2012', 'KDG, KOMANG DOGOL', 5250000, 0),
('2187', '26-03-2012', 'BLH, BU ILUH SINGARAJA', 22250000, 0),
('2193', '26-03-2012', 'KML, KOMANG LILI LOMBOK', 6315000, 0),
('2198', '26-03-2012', 'SML, SAMSOEL', 6275000, 0),
('2198', '26-03-2012', 'SML, SAMSOEL', 2150000, 0),
('2213', '27-03-2012', 'CKR, CAK KARNO', 11250000, 0),
('2229', '27-03-2012', 'KDKYONI, KADEK YONI', 2125000, 0),
('2232', '27-03-2012', 'BYOGA, YOGA', 1030000, 930000),
('2234', '27-03-2012', 'BDY, BU DAYU KLUNGKUNG', 4300000, 0),
('2236', '27-03-2012', 'MANGKIN, B MANGKIN', 840000, 0),
('2245', '27-03-2012', 'MANGKIN, B MANGKIN', 225000, 0),
('2254', '27-03-2012', 'KML, KOMANG LILI LOMBOK', 21025000, 0),
('2256', '27-03-2012', 'ANTONI, ANTONI', 790000, 410000),
('2259', '27-03-2012', 'SMP, BU SIMPEN LOMBOK', 7500000, 0),
('2260', '27-03-2012', 'AMB, AMBON ', 430000, 0),
('2295', '28-03-2012', 'KML, KOMANG LILI LOMBOK', 6750000, 0),
('2301', '28-03-2012', 'CKR, CAK KARNO', 2360000, 0),
('2324', '29-03-2012', 'BDY, BU DAYU KLUNGKUNG', 13185000, 0),
('2340', '29-03-2012', 'MANGKIN, B MANGKIN', 250000, 0),
('2349', '30-03-2012', 'MANGKIN, B MANGKIN', 740000, 0),
('2357', '30-03-2012', 'BYOGA, YOGA', 1125000, 0),
('2369', '30-03-2012', 'BDY, BU DAYU KLUNGKUNG', 9775000, 0),
('2373', '30-03-2012', 'P EDO, PAK EDO/SURYA NADI', 3300000, 0),
('2359', '30-03-2012', 'TUNAS, B TUNAS', 1550000, 0),
('2379', '30-03-2012', 'JRN, GU JARNI KLUNGKUNG', 1450000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `barang_id` varchar(14) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `satuan` varchar(9) NOT NULL,
  `id_gudang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`barang_id`, `qty`, `satuan`, `id_gudang`) VALUES
('BD41-45', '13.00', 'MC', 'B'),
('BD51-55', '10.00', 'MC', 'A'),
('BD51-55', '10.00', 'MC', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `stok_history`
--

CREATE TABLE `stok_history` (
  `barang_id` varchar(14) NOT NULL,
  `qty_before` decimal(10,2) NOT NULL,
  `qty_bal` decimal(12,2) NOT NULL,
  `satuan` varchar(9) NOT NULL,
  `type_history` varchar(3) NOT NULL,
  `id_gudang` varchar(10) NOT NULL,
  `time_record` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_history`
--

INSERT INTO `stok_history` (`barang_id`, `qty_before`, `qty_bal`, `satuan`, `type_history`, `id_gudang`, `time_record`) VALUES
('BD41-45', '0.00', '10.00', 'MC', 'IN', 'B', '2018-06-28 10:34:33'),
('BD51-55', '0.00', '10.00', 'MC', 'IN', 'A', '2018-06-28 10:34:33'),
('BD51-55', '0.00', '10.00', 'MC', 'IN', 'B', '2018-06-28 10:39:09'),
('BD41-45', '10.00', '13.00', 'MC', 'IN', 'B', '2018-06-28 10:39:09'),
('BD41-45', '23.00', '10.00', 'MC', 'OUT', 'B', '2018-06-28 10:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `inc` int(9) NOT NULL,
  `supplier_id` varchar(9) NOT NULL,
  `supplier_nama` varchar(90) NOT NULL,
  `supplier_alamat` varchar(90) NOT NULL,
  `supplier_kota` varchar(50) NOT NULL,
  `supplier_email` varchar(90) NOT NULL,
  `supplier_kontak` varchar(20) NOT NULL,
  `kode_daerah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`inc`, `supplier_id`, `supplier_nama`, `supplier_alamat`, `supplier_kota`, `supplier_email`, `supplier_kontak`, `kode_daerah`) VALUES
(1, 'IP', 'PT INDOPRIMA UTAMA MANDIRI', 'Jl.Buluh Indah', 'Denpasar', 'ptindoprima@gmail.com', '08174577889', 'KDI'),
(2, 'DWT', 'UD DEWATA SURYA UTAMA', 'BATU MALANG', 'Malang', 'dewata_surya_utama@yahoo.com', '085123456', 'KDI'),
(3, 'USMAN', 'UD PRIORITAS 1 ', 'jakarta', 'Jakarta', 'prioritas_@yahoo.com', '087128393', 'JKT'),
(4, 'SGR', 'SEGAR', 'ANYARSARI', 'DENPASAR', 'segar_buah@gmail.com', '036122157', 'KDI'),
(5, 'RJS', 'PT RAJASRI SEJAHTERA', 'JL TANAH MERDEKA PSR REBO ', 'JAKARTA', 'rajasri@yahoo.com', '087987653', 'JKT');

-- --------------------------------------------------------

--
-- Table structure for table `temp_beli_detail`
--

CREATE TABLE `temp_beli_detail` (
  `beli_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `id_gudang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_beli_detail`
--

INSERT INTO `temp_beli_detail` (`beli_id`, `barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`, `id_gudang`) VALUES
('BM-4', 'GBMM7898', 'GBMM7898', 'MM', '10.00', 'MC', ''),
('BM-4', 'TUNAMM5689', 'TUNAMM5689', 'MM', '19.00', 'MC', ''),
('BM-3', 'BD41-45', 'BD41-45', 'NM', '19.00', 'MC', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `temp_jual_detail`
--

CREATE TABLE `temp_jual_detail` (
  `jual_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `id_gudang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `beli_id` (`beli_id`),
  ADD KEY `supplier_id` (`supplier_nama`);

--
-- Indexes for table `beli_detail`
--
ALTER TABLE `beli_detail`
  ADD KEY `beli_id` (`beli_id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`beli_id`);

--
-- Indexes for table `hutang_detail`
--
ALTER TABLE `hutang_detail`
  ADD KEY `beli_id` (`beli_id`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jt`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `username` (`username`),
  ADD KEY `jual_id` (`jual_id`),
  ADD KEY `plg_fk` (`pelanggan_nama`);

--
-- Indexes for table `jual_detail`
--
ALTER TABLE `jual_detail`
  ADD KEY `jual_id` (`jual_id`);

--
-- Indexes for table `kode_daerah`
--
ALTER TABLE `kode_daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`jual_id`);

--
-- Indexes for table `piutang_detail`
--
ALTER TABLE `piutang_detail`
  ADD KEY `jual_id` (`jual_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `kd_daerah_fk` (`kode_daerah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `inc` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli`
--
ALTER TABLE `beli`
  ADD CONSTRAINT `sup_fk` FOREIGN KEY (`supplier_nama`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `beli_detail`
--
ALTER TABLE `beli_detail`
  ADD CONSTRAINT `beli_fk` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`beli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_ibfk_1` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`beli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hutang_detail`
--
ALTER TABLE `hutang_detail`
  ADD CONSTRAINT `hutang_detail_ibfk_1` FOREIGN KEY (`beli_id`) REFERENCES `hutang` (`beli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `plg_fk` FOREIGN KEY (`pelanggan_nama`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual_detail`
--
ALTER TABLE `jual_detail`
  ADD CONSTRAINT `jual_fk` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`jual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `piutang_detail`
--
ALTER TABLE `piutang_detail`
  ADD CONSTRAINT `piutang_detail_ibfk_2` FOREIGN KEY (`jual_id`) REFERENCES `piutang` (`jual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `kd_daerah_fk` FOREIGN KEY (`kode_daerah`) REFERENCES `kode_daerah` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
