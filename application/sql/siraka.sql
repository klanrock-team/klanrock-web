-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 04:43 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siraka`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', 'administrator', 1517105214);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_emi`
--

CREATE TABLE IF NOT EXISTS `td_emi` (
  `id` int(11) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `realisasi` int(11) DEFAULT NULL,
  `tmst_emi_id` int(11) NOT NULL,
  `tmst_kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_ikk`
--

CREATE TABLE IF NOT EXISTS `td_ikk` (
  `id` int(11) NOT NULL,
  `target` text,
  `realisasi` text,
  `tmst_kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_jadwal_pelaksanaan`
--

CREATE TABLE IF NOT EXISTS `td_jadwal_pelaksanaan` (
  `id` int(11) NOT NULL,
  `bulan` int(2) DEFAULT NULL,
  `tmst_kegiatan_id` int(11) NOT NULL,
  `tmst_tipe_jadwal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_kpi`
--

CREATE TABLE IF NOT EXISTS `td_kpi` (
  `id` int(11) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `realisasi` int(11) DEFAULT NULL,
  `tmst_kpi_id` int(11) NOT NULL,
  `tmst_kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_pagu`
--

CREATE TABLE IF NOT EXISTS `td_pagu` (
  `id` int(11) NOT NULL,
  `total_pagu` varchar(45) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `tmst_unit_id` int(11) NOT NULL,
  `tmst_sumberdana_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_proker`
--

CREATE TABLE IF NOT EXISTS `td_proker` (
  `id` int(11) NOT NULL,
  `nama_proker` varchar(200) DEFAULT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `base` varchar(45) DEFAULT NULL,
  `tahun1` varchar(45) DEFAULT NULL,
  `tahun2` varchar(45) DEFAULT NULL,
  `tahun3` varchar(45) DEFAULT NULL,
  `tahun4` varchar(45) DEFAULT NULL,
  `tahun5` varchar(45) DEFAULT NULL,
  `tmst_ikss_id` int(11) NOT NULL,
  `tmst_unit_id` int(11) NOT NULL,
  `tmst_periode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_proker_unit`
--

CREATE TABLE IF NOT EXISTS `td_proker_unit` (
  `id` int(11) NOT NULL,
  `nama_proker` varchar(200) DEFAULT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `base` varchar(45) DEFAULT NULL,
  `tahun1` varchar(45) DEFAULT NULL,
  `tahun2` varchar(45) DEFAULT NULL,
  `tahun3` varchar(45) DEFAULT NULL,
  `tahun4` varchar(45) DEFAULT NULL,
  `tahun5` varchar(45) DEFAULT NULL,
  `tmst_unit_id` int(11) NOT NULL,
  `tmst_periode_id` int(11) NOT NULL,
  `tmst_ikss_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_rab`
--

CREATE TABLE IF NOT EXISTS `td_rab` (
  `id` int(11) NOT NULL,
  `komponen` text NOT NULL,
  `sub_komponen` text,
  `volume` int(11) DEFAULT NULL,
  `multiply` int(5) NOT NULL DEFAULT '1',
  `biaya_satuan` int(11) DEFAULT NULL,
  `keterangan` text,
  `tmst_satuan_ukur_id` int(11) NOT NULL,
  `tmst_kegiatan_id` int(11) NOT NULL,
  `tmst_rkakl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_tor`
--

CREATE TABLE IF NOT EXISTS `td_tor` (
  `id` int(11) NOT NULL,
  `file` text,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tmst_kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_emi`
--

CREATE TABLE IF NOT EXISTS `tmst_emi` (
  `id` int(11) NOT NULL,
  `emi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_ikk`
--

CREATE TABLE IF NOT EXISTS `tmst_ikk` (
  `id` int(11) NOT NULL,
  `ikk` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_ikss`
--

CREATE TABLE IF NOT EXISTS `tmst_ikss` (
  `id` int(11) NOT NULL,
  `indikator` text,
  `tmst_ss_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_kegiatan`
--

CREATE TABLE IF NOT EXISTS `tmst_kegiatan` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `nama_kegiatan` text,
  `tmst_sumberdana_id` int(11) NOT NULL,
  `td_proker_unit_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_kpi`
--

CREATE TABLE IF NOT EXISTS `tmst_kpi` (
  `id` int(11) NOT NULL,
  `kpi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_level`
--

CREATE TABLE IF NOT EXISTS `tmst_level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(200) NOT NULL,
  `level_status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_misi`
--

CREATE TABLE IF NOT EXISTS `tmst_misi` (
  `id` int(11) NOT NULL,
  `misi` text,
  `tmst_visi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_periode`
--

CREATE TABLE IF NOT EXISTS `tmst_periode` (
  `id` int(11) NOT NULL,
  `periode` varchar(45) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmst_periode`
--

INSERT INTO `tmst_periode` (`id`, `periode`, `aktif`) VALUES
(0, 'saaa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmst_rkakl`
--

CREATE TABLE IF NOT EXISTS `tmst_rkakl` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(45) NOT NULL,
  `nama_akun` varchar(200) NOT NULL,
  `keterangan` text,
  `access_code` text,
  `tmst_level_id` int(11) NOT NULL,
  `parent_id` int(11) unsigned zerofill DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_satuan_ukur`
--

CREATE TABLE IF NOT EXISTS `tmst_satuan_ukur` (
  `id` int(11) NOT NULL,
  `satuan_ukur` varchar(45) DEFAULT NULL,
  `singkatan` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_ss`
--

CREATE TABLE IF NOT EXISTS `tmst_ss` (
  `id` int(11) NOT NULL,
  `sasaran_strategis` text,
  `tmst_periode_id` int(11) NOT NULL,
  `tmst_unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_sumberdana`
--

CREATE TABLE IF NOT EXISTS `tmst_sumberdana` (
  `id` int(11) NOT NULL,
  `nama_sumberdana` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_tipe_jadwal`
--

CREATE TABLE IF NOT EXISTS `tmst_tipe_jadwal` (
  `id` int(11) NOT NULL,
  `nama_tipe_jadwal` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_tujuan`
--

CREATE TABLE IF NOT EXISTS `tmst_tujuan` (
  `id` int(11) NOT NULL,
  `tujuan` text,
  `tmst_unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_unit`
--

CREATE TABLE IF NOT EXISTS `tmst_unit` (
  `id` int(11) NOT NULL,
  `nama_unit` varchar(200) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmst_visi`
--

CREATE TABLE IF NOT EXISTS `tmst_visi` (
  `id` int(11) NOT NULL,
  `visi` text,
  `tmst_unit_id` int(11) NOT NULL,
  `tmst_periode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_proker`
--

CREATE TABLE IF NOT EXISTS `tr_proker` (
  `id` int(11) NOT NULL,
  `td_proker_id` int(11) DEFAULT NULL,
  `td_proker_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_user_unit`
--

CREATE TABLE IF NOT EXISTS `tr_user_unit` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `profile_nik` varchar(20) NOT NULL,
  `tmst_unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1517108095, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `td_emi`
--
ALTER TABLE `td_emi`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_emi_tmst_emi1_idx` (`tmst_emi_id`), ADD KEY `fk_td_emi_tmst_kegiatan1_idx` (`tmst_kegiatan_id`);

--
-- Indexes for table `td_ikk`
--
ALTER TABLE `td_ikk`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_ikk_tmst_kegiatan1_idx` (`tmst_kegiatan_id`);

--
-- Indexes for table `td_jadwal_pelaksanaan`
--
ALTER TABLE `td_jadwal_pelaksanaan`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_jadwal_pelaksanaan_tmst_kegiatan1_idx` (`tmst_kegiatan_id`), ADD KEY `fk_td_jadwal_pelaksanaan_tmst_tipe_jadwal1_idx` (`tmst_tipe_jadwal_id`);

--
-- Indexes for table `td_kpi`
--
ALTER TABLE `td_kpi`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_kpi_tmst_kpi1_idx` (`tmst_kpi_id`), ADD KEY `fk_td_kpi_tmst_kegiatan1_idx` (`tmst_kegiatan_id`);

--
-- Indexes for table `td_pagu`
--
ALTER TABLE `td_pagu`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_pagu_tmst_unit1_idx` (`tmst_unit_id`), ADD KEY `fk_td_pagu_tmst_sumberdana1_idx` (`tmst_sumberdana_id`);

--
-- Indexes for table `td_proker`
--
ALTER TABLE `td_proker`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_proker_tmst_ikss1_idx` (`tmst_ikss_id`), ADD KEY `fk_td_proker_tmst_unit1_idx` (`tmst_unit_id`), ADD KEY `fk_td_proker_tmst_periode1_idx` (`tmst_periode_id`);

--
-- Indexes for table `td_proker_unit`
--
ALTER TABLE `td_proker_unit`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_proker_unit_tmst_unit1_idx` (`tmst_unit_id`), ADD KEY `fk_td_proker_unit_tmst_periode1_idx` (`tmst_periode_id`), ADD KEY `fk_td_proker_unit_tmst_ikss1_idx` (`tmst_ikss_id`);

--
-- Indexes for table `td_rab`
--
ALTER TABLE `td_rab`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_rab_tmst_satuan_ukur1_idx` (`tmst_satuan_ukur_id`), ADD KEY `fk_td_rab_tmst_kegiatan1_idx` (`tmst_kegiatan_id`), ADD KEY `fk_td_rab_tmst_rkakl1_idx` (`tmst_rkakl_id`);

--
-- Indexes for table `td_tor`
--
ALTER TABLE `td_tor`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_tor_tmst_kegiatan1_idx` (`tmst_kegiatan_id`);

--
-- Indexes for table `tmst_emi`
--
ALTER TABLE `tmst_emi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_ikk`
--
ALTER TABLE `tmst_ikk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_ikss`
--
ALTER TABLE `tmst_ikss`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tmst_ikss_tmst_ss1_idx` (`tmst_ss_id`);

--
-- Indexes for table `tmst_kegiatan`
--
ALTER TABLE `tmst_kegiatan`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_td_kegiatan_tmst_sumberdana1_idx` (`tmst_sumberdana_id`), ADD KEY `fk_tmst_kegiatan_td_proker_unit1_idx` (`td_proker_unit_id`);

--
-- Indexes for table `tmst_kpi`
--
ALTER TABLE `tmst_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_level`
--
ALTER TABLE `tmst_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_misi`
--
ALTER TABLE `tmst_misi`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tmst_misi_tmst_visi1_idx` (`tmst_visi_id`);

--
-- Indexes for table `tmst_periode`
--
ALTER TABLE `tmst_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_rkakl`
--
ALTER TABLE `tmst_rkakl`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `kode_akun_UNIQUE` (`kode_akun`), ADD KEY `fk_tmst_rkakl_tmst_level1_idx` (`tmst_level_id`);

--
-- Indexes for table `tmst_satuan_ukur`
--
ALTER TABLE `tmst_satuan_ukur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_ss`
--
ALTER TABLE `tmst_ss`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tmst_ss_tmst_periode1_idx` (`tmst_periode_id`), ADD KEY `fk_tmst_ss_tmst_unit1_idx` (`tmst_unit_id`);

--
-- Indexes for table `tmst_sumberdana`
--
ALTER TABLE `tmst_sumberdana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_tipe_jadwal`
--
ALTER TABLE `tmst_tipe_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_tujuan`
--
ALTER TABLE `tmst_tujuan`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tmst_tujuan_UNIT1_idx` (`tmst_unit_id`);

--
-- Indexes for table `tmst_unit`
--
ALTER TABLE `tmst_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_visi`
--
ALTER TABLE `tmst_visi`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tmst_visi_UNIT1_idx` (`tmst_unit_id`), ADD KEY `fk_tmst_visi_tmst_periode1_idx` (`tmst_periode_id`);

--
-- Indexes for table `tr_proker`
--
ALTER TABLE `tr_proker`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tr_proker_td_proker1_idx` (`td_proker_id`), ADD KEY `fk_tr_proker_td_proker_unit1_idx` (`td_proker_unit_id`);

--
-- Indexes for table `tr_user_unit`
--
ALTER TABLE `tr_user_unit`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_tr_user_unit_profile1_idx` (`profile_nik`), ADD KEY `fk_tr_user_unit_tmst_unit1_idx` (`tmst_unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `td_ikk`
--
ALTER TABLE `td_ikk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_jadwal_pelaksanaan`
--
ALTER TABLE `td_jadwal_pelaksanaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_kpi`
--
ALTER TABLE `td_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_proker`
--
ALTER TABLE `td_proker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_proker_unit`
--
ALTER TABLE `td_proker_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_rab`
--
ALTER TABLE `td_rab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_tor`
--
ALTER TABLE `td_tor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_emi`
--
ALTER TABLE `tmst_emi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_ikk`
--
ALTER TABLE `tmst_ikk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_ikss`
--
ALTER TABLE `tmst_ikss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_kegiatan`
--
ALTER TABLE `tmst_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_kpi`
--
ALTER TABLE `tmst_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_level`
--
ALTER TABLE `tmst_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_misi`
--
ALTER TABLE `tmst_misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_rkakl`
--
ALTER TABLE `tmst_rkakl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_satuan_ukur`
--
ALTER TABLE `tmst_satuan_ukur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_ss`
--
ALTER TABLE `tmst_ss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_sumberdana`
--
ALTER TABLE `tmst_sumberdana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_tujuan`
--
ALTER TABLE `tmst_tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_unit`
--
ALTER TABLE `tmst_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmst_visi`
--
ALTER TABLE `tmst_visi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_proker`
--
ALTER TABLE `tr_proker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_user_unit`
--
ALTER TABLE `tr_user_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `td_emi`
--
ALTER TABLE `td_emi`
ADD CONSTRAINT `fk_td_emi_tmst_emi1` FOREIGN KEY (`tmst_emi_id`) REFERENCES `tmst_emi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_emi_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_ikk`
--
ALTER TABLE `td_ikk`
ADD CONSTRAINT `fk_td_ikk_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_jadwal_pelaksanaan`
--
ALTER TABLE `td_jadwal_pelaksanaan`
ADD CONSTRAINT `fk_td_jadwal_pelaksanaan_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_jadwal_pelaksanaan_tmst_tipe_jadwal1` FOREIGN KEY (`tmst_tipe_jadwal_id`) REFERENCES `tmst_tipe_jadwal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_kpi`
--
ALTER TABLE `td_kpi`
ADD CONSTRAINT `fk_td_kpi_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_kpi_tmst_kpi1` FOREIGN KEY (`tmst_kpi_id`) REFERENCES `tmst_kpi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_pagu`
--
ALTER TABLE `td_pagu`
ADD CONSTRAINT `fk_td_pagu_tmst_sumberdana1` FOREIGN KEY (`tmst_sumberdana_id`) REFERENCES `tmst_sumberdana` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_pagu_tmst_unit1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_proker`
--
ALTER TABLE `td_proker`
ADD CONSTRAINT `fk_td_proker_tmst_ikss1` FOREIGN KEY (`tmst_ikss_id`) REFERENCES `tmst_ikss` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_proker_tmst_periode1` FOREIGN KEY (`tmst_periode_id`) REFERENCES `tmst_periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_proker_tmst_unit1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_proker_unit`
--
ALTER TABLE `td_proker_unit`
ADD CONSTRAINT `fk_td_proker_unit_tmst_ikss1` FOREIGN KEY (`tmst_ikss_id`) REFERENCES `tmst_ikss` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_proker_unit_tmst_periode1` FOREIGN KEY (`tmst_periode_id`) REFERENCES `tmst_periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_proker_unit_tmst_unit1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_rab`
--
ALTER TABLE `td_rab`
ADD CONSTRAINT `fk_td_rab_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_rab_tmst_rkakl1` FOREIGN KEY (`tmst_rkakl_id`) REFERENCES `tmst_rkakl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_td_rab_tmst_satuan_ukur1` FOREIGN KEY (`tmst_satuan_ukur_id`) REFERENCES `tmst_satuan_ukur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `td_tor`
--
ALTER TABLE `td_tor`
ADD CONSTRAINT `fk_td_tor_tmst_kegiatan1` FOREIGN KEY (`tmst_kegiatan_id`) REFERENCES `tmst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_ikss`
--
ALTER TABLE `tmst_ikss`
ADD CONSTRAINT `fk_tmst_ikss_tmst_ss1` FOREIGN KEY (`tmst_ss_id`) REFERENCES `tmst_ss` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_kegiatan`
--
ALTER TABLE `tmst_kegiatan`
ADD CONSTRAINT `fk_td_kegiatan_tmst_sumberdana1` FOREIGN KEY (`tmst_sumberdana_id`) REFERENCES `tmst_sumberdana` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tmst_kegiatan_td_proker_unit1` FOREIGN KEY (`td_proker_unit_id`) REFERENCES `td_proker_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_misi`
--
ALTER TABLE `tmst_misi`
ADD CONSTRAINT `fk_tmst_misi_tmst_visi1` FOREIGN KEY (`tmst_visi_id`) REFERENCES `tmst_visi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_rkakl`
--
ALTER TABLE `tmst_rkakl`
ADD CONSTRAINT `fk_tmst_rkakl_tmst_level1` FOREIGN KEY (`tmst_level_id`) REFERENCES `tmst_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_ss`
--
ALTER TABLE `tmst_ss`
ADD CONSTRAINT `fk_tmst_ss_tmst_periode1` FOREIGN KEY (`tmst_periode_id`) REFERENCES `tmst_periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tmst_ss_tmst_unit1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_tujuan`
--
ALTER TABLE `tmst_tujuan`
ADD CONSTRAINT `fk_tmst_tujuan_UNIT1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmst_visi`
--
ALTER TABLE `tmst_visi`
ADD CONSTRAINT `fk_tmst_visi_UNIT1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tmst_visi_tmst_periode1` FOREIGN KEY (`tmst_periode_id`) REFERENCES `tmst_periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tr_proker`
--
ALTER TABLE `tr_proker`
ADD CONSTRAINT `fk_tr_proker_td_proker1` FOREIGN KEY (`td_proker_id`) REFERENCES `td_proker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_tr_proker_td_proker_unit1` FOREIGN KEY (`td_proker_unit_id`) REFERENCES `td_proker_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tr_user_unit`
--
ALTER TABLE `tr_user_unit`
ADD CONSTRAINT `fk_tr_user_unit_profile1` FOREIGN KEY (`profile_nik`) REFERENCES `profile` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_tr_user_unit_tmst_unit1` FOREIGN KEY (`tmst_unit_id`) REFERENCES `tmst_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
