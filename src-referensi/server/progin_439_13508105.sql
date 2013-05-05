-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2013 at 04:25 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progin_405_13510003`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE IF NOT EXISTS `hak_akses` (
  `username` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  KEY `username` (`username`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `id_kategori` (`id_kategori`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `username`) VALUES
(1, 'progin', 'jo'),
(2, 'sister', 'jo'),
(3, 'kripto', 'jo'),
(4, 'IMK', 'jo'),
(5, 'KAP', 'jo'),
(6, 'studium_generale', 'jo');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `username` varchar(50) NOT NULL,
  `id_tugas` int(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `isi` varchar(10000) NOT NULL,
  KEY `username` (`username`),
  KEY `komentar_ibfk_2` (`id_tugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mengerjakan`
--

CREATE TABLE IF NOT EXISTS `mengerjakan` (
  `username` varchar(30) NOT NULL,
  `status_tugas` tinyint(1) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  KEY `username` (`username`),
  KEY `id_tugas` (`id_tugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  UNIQUE KEY `Username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nama_lengkap`, `tanggal_lahir`, `email`, `avatar`) VALUES
('asdasdasd', 'asdasdasd', 'asdas asdasd', '2013-03-05', 'sad@asdas.com', 'asdasdads'),
('jo', 'jo', 'jo jo', '2013-03-05', 'sad@asdas.com', 'http://localhost/tubes2/pict/cancel.png'),
('progin', 'progin', 'progin progin', '2013-03-01', 'progin@aa.aa', 'http://localhost/tubes2/pict/avatar.jpg'),
('tes', 'tes', 'tes tes', '2013-03-04', 'asdadasa', 'dasdada');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE IF NOT EXISTS `tugas` (
  `id_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_tugas` varchar(50) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tag` varchar(500) NOT NULL,
  `attachment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_tugas`),
  UNIQUE KEY `ID` (`id_tugas`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_kategori`, `nama_tugas`, `deadline`, `status`, `tag`, `attachment`) VALUES
(1, 1, 'progin dewa', '2013-03-05 18:00:00', 0, '', ''),
(2, 1, 'tubes1', '2013-03-23 00:00:00', 0, 'html', '-'),
(3, 1, 'tubes2', '2013-03-23 00:00:00', 0, 'php', '-'),
(4, 3, 'tubes1', '2013-03-23 00:00:00', 0, 'steganografi', '-'),
(5, 2, 'tubes1', '2013-03-23 00:00:00', 0, 'gunbound', '-'),
(6, 4, 'tubes1', '2013-03-29 00:00:00', 0, 'nggajelas', '-'),
(7, 5, 'tubes1', '2013-03-29 00:00:00', 0, 'nggajelas', '-');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD CONSTRAINT `hak_akses_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hak_akses_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD CONSTRAINT `mengerjakan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengerjakan_ibfk_2` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
