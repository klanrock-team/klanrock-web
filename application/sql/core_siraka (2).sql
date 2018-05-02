-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 04:44 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `core_siraka`
--

-- --------------------------------------------------------

--
-- Table structure for table `tmst_conten`
--

CREATE TABLE IF NOT EXISTS `tmst_conten` (
  `idtmst_conten` int(11) NOT NULL,
  `judul` varchar(225) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT '1',
  `tmst_kategori_idtmst_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_group_kategori`
--

CREATE TABLE IF NOT EXISTS `tmst_group_kategori` (
  `idtmst_group_kategori` int(11) NOT NULL,
  `nama_group` varchar(225) DEFAULT NULL,
  `deskripsi` text,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_group_kategori`
--

INSERT INTO `tmst_group_kategori` (`idtmst_group_kategori`, `nama_group`, `deskripsi`, `status`) VALUES
(1, 'coba', 'cobacoab', NULL),
(2, 'uweou', 'poiue', NULL),
(3, 'nsdalkdn', 'kdnand', NULL),
(4, 'popop', 'poiuepopopop', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tmst_kategori`
--

CREATE TABLE IF NOT EXISTS `tmst_kategori` (
  `idtmst_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `tmst_group_kategori_idtmst_group_kategori` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmst_conten`
--
ALTER TABLE `tmst_conten`
  ADD PRIMARY KEY (`idtmst_conten`), ADD KEY `fk_tmst_conten_tmst_kategori1_idx` (`tmst_kategori_idtmst_kategori`);

--
-- Indexes for table `tmst_group_kategori`
--
ALTER TABLE `tmst_group_kategori`
  ADD PRIMARY KEY (`idtmst_group_kategori`);

--
-- Indexes for table `tmst_kategori`
--
ALTER TABLE `tmst_kategori`
  ADD PRIMARY KEY (`idtmst_kategori`), ADD KEY `fk_tmst_kategori_tmst_group_kategori_idx` (`tmst_group_kategori_idtmst_group_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tmst_conten`
--
ALTER TABLE `tmst_conten`
  MODIFY `idtmst_conten` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_group_kategori`
--
ALTER TABLE `tmst_group_kategori`
  MODIFY `idtmst_group_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tmst_kategori`
--
ALTER TABLE `tmst_kategori`
  MODIFY `idtmst_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tmst_conten`
--
ALTER TABLE `tmst_conten`
ADD CONSTRAINT `fk_tmst_conten_tmst_kategori1` FOREIGN KEY (`tmst_kategori_idtmst_kategori`) REFERENCES `tmst_kategori` (`idtmst_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_kategori`
--
ALTER TABLE `tmst_kategori`
ADD CONSTRAINT `fk_tmst_kategori_tmst_group_kategori` FOREIGN KEY (`tmst_group_kategori_idtmst_group_kategori`) REFERENCES `tmst_group_kategori` (`idtmst_group_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
