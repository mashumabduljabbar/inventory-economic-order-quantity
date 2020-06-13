-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_inventoryracing
CREATE DATABASE IF NOT EXISTS `db_inventoryracing` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_inventoryracing`;


-- Dumping structure for table db_inventoryracing.tbl_barang
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` char(4) DEFAULT NULL COMMENT 'Kode Barang',
  `nm_barang` varchar(50) DEFAULT NULL COMMENT 'Nama Barang',
  `hrg_jual_khusus` int(15) DEFAULT NULL COMMENT 'Harga Jual Khusus',
  `hrg_jual_umum` int(15) DEFAULT NULL COMMENT 'Harga Jual Umum',
  `satuan` varchar(50) DEFAULT NULL COMMENT 'Satuan',
  `stok_opname` int(15) DEFAULT NULL COMMENT 'Stok dihitung dari pembelian - penjualan',
  `kd_kategori` char(4) DEFAULT NULL COMMENT 'Nama Kategori',
  PRIMARY KEY (`id_barang`),
  UNIQUE KEY `kd_barang` (`kd_barang`),
  KEY `FK_tbl_barang_tbl_kategori` (`kd_kategori`),
  CONSTRAINT `FK_tbl_barang_tbl_kategori` FOREIGN KEY (`kd_kategori`) REFERENCES `tbl_kategori` (`kd_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` (`id_barang`, `kd_barang`, `nm_barang`, `hrg_jual_khusus`, `hrg_jual_umum`, `satuan`, `stok_opname`, `kd_kategori`) VALUES
	(1, 'P001', 'YamaTube', 50000, 65000, 'Botol', 7, 'K001');
INSERT INTO `tbl_barang` (`id_barang`, `kd_barang`, `nm_barang`, `hrg_jual_khusus`, `hrg_jual_umum`, `satuan`, `stok_opname`, `kd_kategori`) VALUES
	(2, 'P002', 'Busy', 18000, 20000, 'Buah', 2, 'K002');
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kategori` char(4) DEFAULT NULL COMMENT 'Kode Kategori',
  `nm_kategori` varchar(25) DEFAULT NULL COMMENT 'Nama Kategori',
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `kd_kategori` (`kd_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `kd_kategori`, `nm_kategori`) VALUES
	(1, 'K001', 'Oli');
INSERT INTO `tbl_kategori` (`id_kategori`, `kd_kategori`, `nm_kategori`) VALUES
	(2, 'K002', 'Spare Parts');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_pelanggan
CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pelanggan` char(4) DEFAULT NULL COMMENT 'Kode Pelanggan',
  `nm_pelanggan` varchar(25) DEFAULT NULL COMMENT 'Nama Pelanggan',
  `alamat_pelanggan` varchar(50) DEFAULT NULL COMMENT 'Alamat Pelanggan',
  `no_telp_pelanggan` varchar(20) DEFAULT NULL COMMENT 'Nomor Telefon Pelanggan',
  `keterangan_pelanggan` varchar(100) DEFAULT NULL COMMENT 'Keterangan Pelanggan',
  `jenis` varchar(25) DEFAULT NULL COMMENT 'Jenis',
  PRIMARY KEY (`id_pelanggan`),
  UNIQUE KEY `kd_pelanggan` (`kd_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_pelanggan: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_pelanggan` DISABLE KEYS */;
INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `kd_pelanggan`, `nm_pelanggan`, `alamat_pelanggan`, `no_telp_pelanggan`, `keterangan_pelanggan`, `jenis`) VALUES
	(1, 'P001', 'Eren', 'Paus', '081365', 'Testing', 'Umum');
/*!40000 ALTER TABLE `tbl_pelanggan` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_pembelian
CREATE TABLE IF NOT EXISTS `tbl_pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` char(4) DEFAULT NULL COMMENT 'Nomor Pembelian',
  `tgl_pembelian` date DEFAULT NULL COMMENT 'Tanggal Pembelian',
  `kd_supplier` char(3) DEFAULT NULL,
  `kd_user` char(3) DEFAULT NULL COMMENT 'Petugas',
  PRIMARY KEY (`id_pembelian`),
  UNIQUE KEY `no_pembelian` (`no_pembelian`),
  KEY `FK_tbl_pembelian_tbl_user` (`kd_user`),
  KEY `FK_tbl_pembelian_tbl_supplier` (`kd_supplier`),
  CONSTRAINT `FK_tbl_pembelian_tbl_supplier` FOREIGN KEY (`kd_supplier`) REFERENCES `tbl_supplier` (`kd_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pembelian_tbl_user` FOREIGN KEY (`kd_user`) REFERENCES `tbl_user` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_pembelian: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_pembelian` DISABLE KEYS */;
INSERT INTO `tbl_pembelian` (`id_pembelian`, `no_pembelian`, `tgl_pembelian`, `kd_supplier`, `kd_user`) VALUES
	(1, 'B001', '2020-06-13', 'S01', 'U01');
/*!40000 ALTER TABLE `tbl_pembelian` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_pembelian_barang
CREATE TABLE IF NOT EXISTS `tbl_pembelian_barang` (
  `id_pembelian_barang` int(11) NOT NULL AUTO_INCREMENT,
  `no_pembelian` char(4) NOT NULL COMMENT 'Nomor Pembelian',
  `kd_barang` char(4) NOT NULL COMMENT 'Kode Barang',
  `harga_beli` int(15) NOT NULL COMMENT 'Harga Beli',
  `jumlah` int(15) NOT NULL COMMENT 'Jumlah',
  PRIMARY KEY (`id_pembelian_barang`),
  KEY `FK__tbl_pembelian` (`no_pembelian`),
  KEY `FK__tbl_barang` (`kd_barang`),
  CONSTRAINT `FK__tbl_barang` FOREIGN KEY (`kd_barang`) REFERENCES `tbl_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tbl_pembelian` FOREIGN KEY (`no_pembelian`) REFERENCES `tbl_pembelian` (`no_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_pembelian_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_pembelian_barang` DISABLE KEYS */;
INSERT INTO `tbl_pembelian_barang` (`id_pembelian_barang`, `no_pembelian`, `kd_barang`, `harga_beli`, `jumlah`) VALUES
	(17, 'B001', 'P001', 50000, 7);
INSERT INTO `tbl_pembelian_barang` (`id_pembelian_barang`, `no_pembelian`, `kd_barang`, `harga_beli`, `jumlah`) VALUES
	(19, 'B001', 'P002', 56000, 4);
/*!40000 ALTER TABLE `tbl_pembelian_barang` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_penjualan
CREATE TABLE IF NOT EXISTS `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` char(4) NOT NULL COMMENT 'Nomor Penjualan',
  `tgl_penjualan` date NOT NULL COMMENT 'Tanggal Penjualan',
  `kd_user` char(3) NOT NULL COMMENT 'Petugas',
  `kd_pelanggan` char(4) NOT NULL COMMENT 'Pelanggan',
  PRIMARY KEY (`id_penjualan`),
  UNIQUE KEY `no_penjualan` (`no_penjualan`),
  KEY `FK_tbl_penjualan_tbl_pelanggan` (`kd_pelanggan`),
  KEY `FK_tbl_penjualan_tbl_user` (`kd_user`),
  CONSTRAINT `FK_tbl_penjualan_tbl_pelanggan` FOREIGN KEY (`kd_pelanggan`) REFERENCES `tbl_pelanggan` (`kd_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_penjualan_tbl_user` FOREIGN KEY (`kd_user`) REFERENCES `tbl_user` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_penjualan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_penjualan` DISABLE KEYS */;
INSERT INTO `tbl_penjualan` (`id_penjualan`, `no_penjualan`, `tgl_penjualan`, `kd_user`, `kd_pelanggan`) VALUES
	(1, 'J001', '2020-06-14', 'U01', 'P001');
/*!40000 ALTER TABLE `tbl_penjualan` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_penjualan_barang
CREATE TABLE IF NOT EXISTS `tbl_penjualan_barang` (
  `id_penjualan_barang` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` char(4) DEFAULT NULL,
  `kd_barang` char(4) DEFAULT NULL,
  `harga_jual` int(15) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_barang`),
  KEY `FK_tbl_penjualan_barang_tbl_penjualan` (`no_penjualan`),
  KEY `FK_tbl_penjualan_barang_tbl_barang` (`kd_barang`),
  CONSTRAINT `FK_tbl_penjualan_barang_tbl_barang` FOREIGN KEY (`kd_barang`) REFERENCES `tbl_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_penjualan_barang_tbl_penjualan` FOREIGN KEY (`no_penjualan`) REFERENCES `tbl_penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_penjualan_barang: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_penjualan_barang` DISABLE KEYS */;
INSERT INTO `tbl_penjualan_barang` (`id_penjualan_barang`, `no_penjualan`, `kd_barang`, `harga_jual`, `jumlah`) VALUES
	(14, 'J001', 'P002', 20000, 2);
/*!40000 ALTER TABLE `tbl_penjualan_barang` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_supplier
CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `kd_supplier` char(3) DEFAULT NULL COMMENT 'Kode Supplier',
  `nm_supplier` varchar(50) DEFAULT NULL COMMENT 'Nama Supplier',
  `alamat_supplier` varchar(100) DEFAULT NULL COMMENT 'Alamat Supplier',
  `no_telp_supplier` varchar(20) DEFAULT NULL COMMENT 'Nomor Telefon Supplier',
  `keterangan` varchar(100) DEFAULT NULL COMMENT 'Keterangan',
  PRIMARY KEY (`id_supplier`),
  UNIQUE KEY `kd_supplier` (`kd_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_supplier: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_supplier` DISABLE KEYS */;
INSERT INTO `tbl_supplier` (`id_supplier`, `kd_supplier`, `nm_supplier`, `alamat_supplier`, `no_telp_supplier`, `keterangan`) VALUES
	(1, 'S01', 'Yamaha Pekanbaru', 'Jl. SM Yamin No. 10', '076112345', 'Test');
INSERT INTO `tbl_supplier` (`id_supplier`, `kd_supplier`, `nm_supplier`, `alamat_supplier`, `no_telp_supplier`, `keterangan`) VALUES
	(2, 'S02', 'Honda Pekanbaru', 'Jl. SM Yamin No. 10', '076112345', 'Test');
/*!40000 ALTER TABLE `tbl_supplier` ENABLE KEYS */;


-- Dumping structure for table db_inventoryracing.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kd_user` char(3) DEFAULT NULL COMMENT 'Kode User',
  `nm_user` varchar(100) DEFAULT NULL COMMENT 'Nama User',
  `username` varchar(20) DEFAULT NULL COMMENT 'User Name',
  `password` varchar(200) DEFAULT NULL COMMENT 'Password',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `kd_user` (`kd_user`),
  UNIQUE KEY `nm_user` (`nm_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_inventoryracing.tbl_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id_user`, `kd_user`, `nm_user`, `username`, `password`) VALUES
	(1, 'U01', 'Tank', 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `tbl_user` (`id_user`, `kd_user`, `nm_user`, `username`, `password`) VALUES
	(2, 'U02', 'Marskman', 'mm', 'b3cd915d758008bd19d0f2428fbb354a');
INSERT INTO `tbl_user` (`id_user`, `kd_user`, `nm_user`, `username`, `password`) VALUES
	(3, 'U03', 'Mage', 'mage', '9a519a0f7d29f1ffa549fada8b667b02');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
