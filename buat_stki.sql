-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 05:36 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `buat_stki`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
`id_berita` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `isi_berita` text NOT NULL,
  `status_url` enum('1','0') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kata`
--

CREATE TABLE IF NOT EXISTS `kata` (
`id_kata` int(11) NOT NULL,
  `kata` varchar(255) NOT NULL,
  `kata_dasar` varchar(255) NOT NULL,
  `id_berita` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=654277 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kata_mentah`
--

CREATE TABLE IF NOT EXISTS `kata_mentah` (
`id` int(11) NOT NULL,
  `kata` varchar(256) NOT NULL,
  `id_berita` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1126 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `kata`
--
ALTER TABLE `kata`
 ADD PRIMARY KEY (`id_kata`), ADD KEY `id_berita` (`id_berita`);

--
-- Indexes for table `kata_mentah`
--
ALTER TABLE `kata_mentah`
 ADD PRIMARY KEY (`id`), ADD KEY `id_berita` (`id_berita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT for table `kata`
--
ALTER TABLE `kata`
MODIFY `id_kata` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=654277;
--
-- AUTO_INCREMENT for table `kata_mentah`
--
ALTER TABLE `kata_mentah`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1126;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kata`
--
ALTER TABLE `kata`
ADD CONSTRAINT `kata_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kata_mentah`
--
ALTER TABLE `kata_mentah`
ADD CONSTRAINT `kata_mentah_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
