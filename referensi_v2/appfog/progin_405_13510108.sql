-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2013 at 03:32 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progin_405_13510108`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignee`
--

CREATE TABLE IF NOT EXISTS `assignee` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `idtask` int(3) DEFAULT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222 ;

--
-- Dumping data for table `assignee`
--

INSERT INTO `assignee` (`id`, `idtask`, `nama_user`) VALUES
(189, 24, 'dekha'),
(191, 25, 'dekha'),
(204, 30, 'dekha'),
(206, 31, 'jokoism'),
(207, 31, 'to'),
(208, 32, 'haanif'),
(209, 32, 'jokoism'),
(213, 36, 'jokoism'),
(215, 37, 'angga'),
(216, 37, 'haanif'),
(218, 38, 'mahdans'),
(219, 38, 'haniflyon'),
(220, 39, ''),
(221, 40, 'pabot');

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(40) NOT NULL,
  `idtask` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`id`, `filename`, `idtask`) VALUES
(1, 'a.jpg', 24),
(2, 'pabot.jpg', 24),
(3, 'nyo.jpg', 35),
(4, 'nike.jpg', 35),
(5, 'nyo.jpg', 30),
(6, 'nike.jpg', 36),
(7, 'phone-icon.jpg', 37),
(8, 'nyo.jpg', 37),
(9, 'mov_bbb.ogg', 38),
(10, 'mov_bbb.ogg', 38),
(11, 'developers-toolkit kinect.pdf', 39),
(12, 'mov_bbb.ogg', 40);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcreator` int(11) NOT NULL,
  `namakat` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcreator` (`idcreator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `idcreator`, `namakat`) VALUES
(1, 1, 'Kuliah'),
(3, 2, 'Kategori X');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtask` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `komentar` varchar(1000) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtask` (`idtask`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `idtask`, `iduser`, `komentar`, `waktu`) VALUES
(48, 25, 2, 'tubes ini rada lumayan euy', '04:28 22/03'),
(49, 25, 2, 'susah gituu ?', '04:37 22/03'),
(50, 25, 1, 'masssa sih ?', '04:39 22/03'),
(51, 30, 1, 'lucu ih ini', '06:52 23/03'),
(52, 30, 1, 'apaan sih dek ?', '06:55 23/03'),
(53, 30, 1, 'lucu ih ini', '06:55 23/03'),
(54, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(55, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(56, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(57, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(58, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(59, 30, 1, 'sok lucu maneh', '06:56 23/03'),
(60, 30, 1, 'sok lucu maneh', '06:56 23/03');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtask` int(11) NOT NULL,
  `namatag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtask_2` (`idtask`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `idtask`, `namatag`) VALUES
(145, 25, 'imam'),
(146, 25, 'sister'),
(147, 25, 'jarkom'),
(158, 30, 'coba'),
(159, 30, ' video'),
(160, 30, ' lucu'),
(170, 36, 'unit'),
(171, 36, 'sunken'),
(172, 37, 'santai'),
(173, 37, 'bioskop'),
(175, 24, 'unit'),
(176, 24, 'sunken'),
(179, 38, 'tes'),
(180, 38, 'uji'),
(181, 38, 'coba'),
(182, 39, 'a'),
(183, 39, ' b'),
(184, 39, ' c'),
(185, 40, 'co'),
(186, 40, ' li');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE IF NOT EXISTS `tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkat` int(11) NOT NULL,
  `idcreator` int(11) NOT NULL,
  `namatask` varchar(100) NOT NULL,
  `deadline` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkat_2` (`idkat`),
  KEY `idcreator` (`idcreator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `idkat`, `idcreator`, `namatask`, `deadline`, `status`) VALUES
(24, 3, 1, 'beli baju', '2013-03-07', 1),
(25, 1, 2, 'tubes sister', '2013-03-03', 1),
(30, 3, 1, 'videooooo', '2013-05-21', 1),
(36, 1, 1, 'Nonton GMC', '2013-03-19', 0),
(37, 3, 1, 'Nonton Pelem', '2013-03-13', 0),
(38, 1, 13, 'Uji Add', '2013-03-05', 0),
(39, 1, 2, 'Cocoli', '2013-03-23', 0),
(40, 1, 2, 'cocolili', '2013-03-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` varchar(11) NOT NULL,
  `avatar` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `email`, `birthdate`, `avatar`) VALUES
(1, 'dekha', 'dekhadekha', 'Dekha A', 'danggareska@yahoo.com', '30-01-1993', 'a.jpg'),
(2, 'pabot', 'pabotpabot', 'Pabot', 'pabot@pabot.com', '1994/03/20', 'pabot.jpg'),
(3, 'haanif', 'haanif', 'Hanif Lyonnais', 'hanif@itb.ac.id', '09/23/1992', 'hanif.jpg'),
(4, 'fdh', 'fdhfdh', 'Filbert Dekha Hanif', 'fdh@microsoft.com', '03/12/2013', 'fdh.jpg'),
(5, 'jokoism', 'jokoisme', 'Joko Susanto', 'joko@gmail.com', '1992/03/12', 'joko.jpg'),
(6, 'tono', 'tonogitu', 'tono surono', 'tono@gmail', '1992/03/14', 'tono.jpg'),
(10, 'mahdan', 'mahdanmahdan', 'Mahdan A', 'mahdan@gmail.com', '1992-03-20', ''),
(11, 'admin', 'adminadmin', 'Admin gile', 'admin@gmail.com', '1992-04-02', ''),
(12, 'angga', 'anggaangga', 'Angga Res', 'angga@gmail.com', '1992-03-13', 'buku.jpg'),
(13, 'haniflyon', 'lyonnais', 'H Lyonnais', 'lyon@yahoo.com', '2013-03-27', 'kecewa.jpg'),
(14, 'mahdans', 'mahdansmahdans', 'Mahdan Ach', 'mahdan@gmail.cid', '2013-03-26', 'nyo.jpg'),
(15, 'oooooo', 'oooooo', 'aaa', 'bbb@ccc.co.id', '2013-03-21', 'paboot.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`idtask`) REFERENCES `tugas` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`idtask`) REFERENCES `tugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`idkat`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`idcreator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
