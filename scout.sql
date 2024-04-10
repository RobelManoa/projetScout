-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2024 at 12:41 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scout`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(100) DEFAULT NULL,
  `prenom_admin` varchar(100) DEFAULT NULL,
  `residence_admin` varchar(100) DEFAULT NULL,
  `age_admin` date DEFAULT NULL,
  `mail_admin` varchar(100) DEFAULT NULL,
  `contact_admin` int DEFAULT NULL,
  `mdp_admin` varchar(100) DEFAULT NULL,
  `id_responsabilite` int DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  `totem` varchar(100) DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idAdmin`, `nom_admin`, `prenom_admin`, `residence_admin`, `age_admin`, `mail_admin`, `contact_admin`, `mdp_admin`, `id_responsabilite`, `date_inscription`, `totem`, `photo`) VALUES
(1, 'ROBEL', 'Tsilavina', 'Ivato', '2005-03-11', 'tsilavina@gmail.com', 341085296, '$2y$10$hd5SpfvQfzg/7EbW8ixD3.wyls0ExT7zoNlTFfmpRcNXYt1TOeuFi', 2, '2024-04-10', 'Sarijo', 'images/madara_render__pockie_ninja__by_maxiuchiha22_deinl0a.png'),
(6, '\'njara\'', '\'lalao\'', NULL, NULL, '\'lalao@gmail.com\'', NULL, '$2y$10$LYAh8jS6fMxlodSnMOBuBed3yERHqVEnx19ofa51GGxq/lYah/uDu', 3, '2024-03-20', NULL, NULL),
(4, 'Rabearinoro', 'Iounty', 'Itosy', '2008-04-09', 'iounty@gmail.com', 328574123, '$2y$10$j2fYEndb5QVFWqaM2.Qj0uBtYtx2zi3KzwrlJYSQeJsf8yhtVpbMu', 1, '2024-03-19', 'balou', 'images/pdp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `beazina`
--

DROP TABLE IF EXISTS `beazina`;
CREATE TABLE IF NOT EXISTS `beazina` (
  `id_beazina` int NOT NULL AUTO_INCREMENT,
  `nom_beazina` varchar(100) DEFAULT NULL,
  `prenom_beazina` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `contact_beazina` int DEFAULT NULL,
  `nom_pere` varchar(100) DEFAULT NULL,
  `contact_pere` int DEFAULT NULL,
  `nom_mere` varchar(100) DEFAULT NULL,
  `contact_mere` int DEFAULT NULL,
  `adresse_beazina` varchar(100) DEFAULT NULL,
  `date_inscriptionb` date DEFAULT NULL,
  `ecole` varchar(100) DEFAULT NULL,
  `totem` varchar(100) DEFAULT NULL,
  `photo` text,
  `categories` int DEFAULT NULL,
  `exploits` text,
  PRIMARY KEY (`id_beazina`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beazina`
--

INSERT INTO `beazina` (`id_beazina`, `nom_beazina`, `prenom_beazina`, `date_naissance`, `contact_beazina`, `nom_pere`, `contact_pere`, `nom_mere`, `contact_mere`, `adresse_beazina`, `date_inscriptionb`, `ecole`, `totem`, `photo`, `categories`, `exploits`) VALUES
(1, 'Robel', 'Fy Manoa Andrianavalona', '2005-04-25', 341040801, 'Robel Rivo', 340232350, 'Ravalomanana Haingo', 349183451, 'Ambohipo', '2024-04-01', 'ISIME', '', './images/1636294130075.png', 3, 'LFTT'),
(4, 'Rakoto', 'kely', '0000-00-00', 341085236, 'RAKOTO', 338574123, 'RABARY', 325678954, 'Ivandry', '0000-00-00', 'ESCA', 'Lemiso', NULL, 2, NULL),
(3, 'Finidy', 'Safidy', '2013-04-02', 336985245, 'Finidy ray', 328574123, 'Finidy reny', 329632154, 'Itosy', '0000-00-00', 'JJR', '', './images/2.png', 1, 'info');

-- --------------------------------------------------------

--
-- Table structure for table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `id_caisse` int NOT NULL AUTO_INCREMENT,
  `fond` int DEFAULT NULL,
  `dates` date DEFAULT NULL,
  PRIMARY KEY (`id_caisse`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `caisse`
--

INSERT INTO `caisse` (`id_caisse`, `fond`, `dates`) VALUES
(1, 20000, '2024-04-03'),
(2, 40000, '2024-04-03'),
(3, 36000, '2024-04-04'),
(4, 31000, '2024-04-18'),
(5, 37000, '2024-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int NOT NULL AUTO_INCREMENT,
  `nom_resp` varchar(100) DEFAULT NULL,
  `prenom_resp` varchar(100) DEFAULT NULL,
  `mail_resp` varchar(100) DEFAULT NULL,
  `mdp_resp` varchar(100) DEFAULT NULL,
  `categories` int DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_evenement` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `legende` text,
  `datevenement` date DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `piece_evenement` text,
  PRIMARY KEY (`id_evenement`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `titre`, `legende`, `datevenement`, `responsable`, `piece_evenement`) VALUES
(24, 'petit texte', 'je veux faire un petit texte', '2024-04-11', NULL, '[\"..\\/assets\\/uploads\\/CV Safidy.pdf\"]'),
(13, 'ninho', 'azerty', '2024-04-09', 'Rahamefy', '[\"uploads\\/couverture fetra.pdf\"]'),
(17, 'ninhoooo', 'azerty', '2024-04-09', 'Rahamefy', '[\"uploads\\/javaCode.txt\"]'),
(20, 'teste image', 'voici un fichier image', '2024-04-10', NULL, '[\"uploads\\/cart noel.docx\"]'),
(23, 'Hira', 'Hira sendra atao teste', '2024-04-08', NULL, '[\"uploads\\/GAZO - ADAPTER(MP3_128K).mp3\"]'),
(21, 'ma video', 'voici une video', '2024-04-10', NULL, '[\"uploads\\/(39) EPISTOLIER - Tia Anao Aho (Acoustic) - YouTube.mkv\"]');

-- --------------------------------------------------------

--
-- Table structure for table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
CREATE TABLE IF NOT EXISTS `mouvement` (
  `id_mouvement` int NOT NULL AUTO_INCREMENT,
  `types` int DEFAULT NULL,
  `motif` varchar(100) DEFAULT NULL,
  `montant` int DEFAULT NULL,
  `dates_mouvement` date DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_mouvement`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mouvement`
--

INSERT INTO `mouvement` (`id_mouvement`, `types`, `motif`, `montant`, `dates_mouvement`, `responsable`) VALUES
(1, 1, 'Fety', 20000, '2024-04-03', 'Rahamefy'),
(2, 2, 'vonjy', 4000, '2024-04-04', 'Rahamefy'),
(3, 2, 'ilaina', 5000, '2024-04-18', '\'Robel\''),
(4, 1, 'Lasy', 6000, '2024-04-09', 'ROBEL');

-- --------------------------------------------------------

--
-- Table structure for table `presence_admin`
--

DROP TABLE IF EXISTS `presence_admin`;
CREATE TABLE IF NOT EXISTS `presence_admin` (
  `id_presenceA` int NOT NULL AUTO_INCREMENT,
  `id_admin_present` int UNSIGNED DEFAULT NULL,
  `categ_admin` int DEFAULT NULL,
  `dates_presence` date DEFAULT NULL,
  `presence` int DEFAULT NULL,
  PRIMARY KEY (`id_presenceA`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `presence_admin`
--

INSERT INTO `presence_admin` (`id_presenceA`, `id_admin_present`, `categ_admin`, `dates_presence`, `presence`) VALUES
(1, 4, 1, '2024-04-03', 1),
(2, 1, 1, '2024-04-09', 1),
(3, 6, 1, '2024-04-09', 1),
(4, 4, 1, '2024-04-09', 1),
(5, 1, 1, '2024-04-10', 1),
(6, 6, 1, '2024-04-10', 1),
(7, 4, 1, '2024-04-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `presence_beazina`
--

DROP TABLE IF EXISTS `presence_beazina`;
CREATE TABLE IF NOT EXISTS `presence_beazina` (
  `id_presenceB` int NOT NULL AUTO_INCREMENT,
  `id_beazinaP` int UNSIGNED DEFAULT NULL,
  `categ_beazina` int DEFAULT NULL,
  `dates_present` date DEFAULT NULL,
  `presence` int DEFAULT NULL,
  PRIMARY KEY (`id_presenceB`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `presence_beazina`
--

INSERT INTO `presence_beazina` (`id_presenceB`, `id_beazinaP`, `categ_beazina`, `dates_present`, `presence`) VALUES
(1, 1, 1, '2024-04-03', 1),
(2, 2, 1, '2024-04-03', 1),
(3, 3, 1, '2024-04-03', 1),
(4, 3, 1, '2024-04-03', 1),
(5, 1, 1, '2024-04-03', 1),
(6, 1, 1, '2024-04-10', 1),
(7, 3, 1, '2024-04-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tonia`
--

DROP TABLE IF EXISTS `tonia`;
CREATE TABLE IF NOT EXISTS `tonia` (
  `id_tonia` int NOT NULL AUTO_INCREMENT,
  `nom_tonia` varchar(100) DEFAULT NULL,
  `prenom_tonia` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `mdp_tonia` varchar(100) DEFAULT NULL,
  `date_dirige` date DEFAULT NULL,
  `totem` varchar(100) DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`id_tonia`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tonia`
--

INSERT INTO `tonia` (`id_tonia`, `nom_tonia`, `prenom_tonia`, `date_naissance`, `mail`, `mdp_tonia`, `date_dirige`, `totem`, `photo`) VALUES
(1, '.$nom.', '.$prenom.', '0000-00-00', '.$mail.', '.$mdp.', '0000-00-00', '.$totem.', NULL),
(2, 'Rahamefy', 'Radoniaina', '2024-03-21', 'sianga@gmail.com', '$2y$10$wj34W0xrnRh01.gvATl/u.IpmR6TU/xXsTqzaBNbu1GYQiXZNc7Fi', '2024-03-30', 'Sianga', 'assets/img/7ad2914b503b2f83938956f0d61d284f.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
