-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 18 Février 2011 à 14:43
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `extranet_escalimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Agency`
--

CREATE TABLE IF NOT EXISTS `Agency` (
  `idAgency` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`idAgency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Agency`
--

INSERT INTO `Agency` (`idAgency`, `name`) VALUES
(1, 'Auvillar'),
(2, 'Moissac'),
(3, 'La ville Dieu du Temple');

-- --------------------------------------------------------

--
-- Structure de la table `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `idCity` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  `sector_idSector` int(11) NOT NULL,
  PRIMARY KEY (`idCity`),
  KEY `sector_idSector` (`sector_idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `City`
--

INSERT INTO `City` (`idCity`, `name`, `zipCode`, `numberUsed`, `sector_idSector`) VALUES
(1, 'Montauban', '82000', 39, 6),
(5, 'Auvillar', '82340', 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `Dpe`
--

CREATE TABLE IF NOT EXISTS `Dpe` (
  `idDpe` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `fromValue` int(11) NOT NULL,
  `toValue` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`idDpe`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `Dpe`
--

INSERT INTO `Dpe` (`idDpe`, `name`, `fromValue`, `toValue`, `position`) VALUES
(1, 'A', 0, 50, 1),
(2, 'B', 51, 90, 2),
(3, 'C', 91, 150, 3),
(4, 'D', 151, 230, 4),
(5, 'E', 231, 330, 5),
(6, 'F', 331, 450, 6),
(7, 'G', 451, 9999999, 7);

-- --------------------------------------------------------

--
-- Structure de la table `HistoricConnection`
--

CREATE TABLE IF NOT EXISTS `HistoricConnection` (
  `idHistoricConnection` int(11) NOT NULL AUTO_INCREMENT,
  `dateConnection` datetime NOT NULL,
  `ip` varchar(50) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idHistoricConnection`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- Contenu de la table `HistoricConnection`
--

INSERT INTO `HistoricConnection` (`idHistoricConnection`, `dateConnection`, `ip`, `user_idUser`) VALUES
(3, '2011-01-20 15:12:33', '', 1),
(2, '2011-01-20 15:10:04', '', 1),
(4, '2011-01-20 15:13:30', '', 1),
(5, '2011-01-20 15:14:52', '', 1),
(6, '2011-01-20 15:22:41', '', 1),
(7, '2011-01-20 15:23:06', '', 1),
(8, '2011-01-20 15:23:28', '', 1),
(9, '2011-01-20 15:28:31', '', 1),
(10, '2011-01-20 15:29:48', '', 1),
(11, '2011-01-20 15:32:28', '', 1),
(12, '2011-01-21 08:39:29', '', 1),
(13, '2011-01-21 08:39:48', '', 1),
(93, '2011-01-31 15:20:25', '127.0.0.1', 14),
(15, '2011-01-21 10:56:10', '', 1),
(17, '2011-01-21 11:44:43', '', 1),
(18, '2011-01-21 11:48:40', '', 1),
(92, '2011-01-31 14:59:15', '127.0.0.1', 1),
(20, '2011-01-21 11:49:27', '', 1),
(91, '2011-01-31 14:58:52', '127.0.0.1', 14),
(23, '2011-01-21 11:51:12', '', 1),
(25, '2011-01-21 12:00:38', '', 1),
(26, '2011-01-21 12:04:54', '', 1),
(90, '2011-01-31 14:40:05', '127.0.0.1', 1),
(28, '2011-01-21 12:07:45', '', 1),
(89, '2011-01-31 14:29:39', '127.0.0.1', 1),
(31, '2011-01-21 12:27:14', '', 1),
(33, '2011-01-21 14:20:09', '', 1),
(88, '2011-01-31 14:06:30', '127.0.0.1', 1),
(35, '2011-01-21 14:48:42', '', 1),
(36, '2011-01-24 08:31:24', '', 1),
(38, '2011-01-24 08:56:51', '', 1),
(87, '2011-01-31 13:01:14', '127.0.0.1', 1),
(40, '2011-01-24 10:03:17', '', 1),
(42, '2011-01-24 10:15:39', '', 1),
(43, '2011-01-24 10:16:23', '', 1),
(44, '2011-01-24 10:18:39', '', 1),
(45, '2011-01-24 10:18:57', '', 1),
(46, '2011-01-24 10:19:24', '', 1),
(47, '2011-01-24 10:24:45', '', 1),
(48, '2011-01-24 11:46:21', '', 1),
(85, '2011-01-31 12:59:49', '127.0.0.1', 1),
(50, '2011-01-24 12:09:21', '', 1),
(52, '2011-01-24 12:24:34', '', 1),
(83, '2011-01-31 12:57:55', '127.0.0.1', 1),
(54, '2011-01-24 12:31:12', '', 1),
(55, '2011-01-24 13:03:31', '127.0.0.1', 1),
(56, '2011-01-24 16:20:08', '127.0.0.1', 1),
(86, '2011-01-31 13:01:01', '127.0.0.1', 14),
(81, '2011-01-31 12:54:56', '127.0.0.1', 1),
(59, '2011-01-24 16:56:47', '127.0.0.1', 1),
(60, '2011-01-24 16:59:06', '127.0.0.1', 1),
(61, '2011-01-24 16:59:27', '127.0.0.1', 1),
(62, '2011-01-25 08:50:27', '127.0.0.1', 1),
(63, '2011-01-27 16:16:04', '127.0.0.1', 1),
(64, '2011-01-31 09:32:20', '127.0.0.1', 1),
(65, '2011-01-31 09:38:43', '127.0.0.1', 1),
(66, '2011-01-31 09:46:12', '127.0.0.1', 1),
(67, '2011-01-31 10:15:12', '127.0.0.1', 1),
(68, '2011-01-31 10:28:50', '127.0.0.1', 1),
(69, '2011-01-31 10:36:58', '127.0.0.1', 1),
(70, '2011-01-31 10:41:59', '127.0.0.1', 1),
(71, '2011-01-31 11:06:36', '127.0.0.1', 1),
(72, '2011-01-31 12:03:32', '127.0.0.1', 1),
(80, '2011-01-31 12:53:46', '127.0.0.1', 15),
(74, '2011-01-31 12:07:42', '127.0.0.1', 1),
(79, '2011-01-31 12:53:29', '127.0.0.1', 14),
(76, '2011-01-31 12:30:54', '127.0.0.1', 1),
(77, '2011-01-31 12:37:43', '127.0.0.1', 1),
(78, '2011-01-31 12:42:57', '127.0.0.1', 1),
(94, '2011-01-31 15:22:21', '127.0.0.1', 14),
(95, '2011-01-31 15:22:35', '127.0.0.1', 1),
(96, '2011-01-31 15:39:49', '127.0.0.1', 1),
(97, '2011-01-31 16:48:43', '127.0.0.1', 14),
(98, '2011-01-31 16:48:50', '127.0.0.1', 1),
(99, '2011-01-31 16:48:59', '127.0.0.1', 19),
(100, '2011-01-31 16:49:23', '127.0.0.1', 1),
(101, '2011-02-01 08:54:51', '127.0.0.1', 1),
(102, '2011-02-01 00:00:00', '127.0.0.1', 20),
(103, '2011-02-01 12:37:16', '127.0.0.1', 1),
(104, '2011-02-01 14:09:04', '127.0.0.1', 1),
(105, '2011-02-02 08:16:05', '127.0.0.1', 1),
(106, '2011-02-02 08:28:59', '127.0.0.1', 1),
(107, '2011-02-02 09:35:06', '127.0.0.1', 14),
(108, '2011-02-02 09:36:33', '127.0.0.1', 1),
(109, '2011-02-02 09:38:51', '127.0.0.1', 14),
(110, '2011-02-02 09:40:17', '127.0.0.1', 14),
(111, '2011-02-02 09:41:12', '127.0.0.1', 1),
(112, '2011-02-02 09:41:58', '127.0.0.1', 1),
(113, '2011-02-02 09:43:17', '127.0.0.1', 14),
(114, '2011-02-02 09:43:33', '127.0.0.1', 1),
(115, '2011-02-02 09:45:44', '127.0.0.1', 14),
(116, '2011-02-02 09:48:40', '127.0.0.1', 14),
(117, '2011-02-02 09:52:07', '127.0.0.1', 1),
(118, '2011-02-02 10:50:18', '127.0.0.1', 1),
(119, '2011-02-02 14:01:57', '127.0.0.1', 14),
(120, '2011-02-02 14:02:25', '127.0.0.1', 1),
(121, '2011-02-02 14:06:02', '127.0.0.1', 14),
(122, '2011-02-02 14:10:16', '127.0.0.1', 1),
(123, '2011-02-02 15:01:39', '127.0.0.1', 1),
(124, '2011-02-02 16:18:34', '127.0.0.1', 1),
(125, '2011-02-02 16:19:02', '127.0.0.1', 1),
(126, '2011-02-02 16:27:55', '127.0.0.1', 1),
(127, '2011-02-02 16:33:42', '127.0.0.1', 1),
(128, '2011-02-02 16:34:26', '127.0.0.1', 1),
(129, '2011-02-02 16:35:30', '127.0.0.1', 1),
(130, '2011-02-02 16:36:18', '127.0.0.1', 1),
(131, '2011-02-02 16:49:30', '127.0.0.1', 1),
(132, '2011-02-02 17:02:52', '127.0.0.1', 1),
(133, '2011-02-03 08:37:57', '127.0.0.1', 1),
(134, '2011-02-03 08:56:12', '127.0.0.1', 14),
(135, '2011-02-03 08:59:41', '127.0.0.1', 1),
(136, '2011-02-03 09:28:10', '127.0.0.1', 1),
(137, '2011-02-03 09:37:47', '127.0.0.1', 1),
(138, '2011-02-03 09:38:31', '127.0.0.1', 1),
(139, '2011-02-03 09:39:18', '127.0.0.1', 1),
(140, '2011-02-03 09:55:16', '127.0.0.1', 1),
(141, '2011-02-03 09:56:45', '127.0.0.1', 1),
(142, '2011-02-03 09:57:18', '127.0.0.1', 1),
(143, '2011-02-03 09:57:56', '127.0.0.1', 1),
(144, '2011-02-03 10:25:40', '127.0.0.1', 1),
(145, '2011-02-03 10:27:24', '127.0.0.1', 1),
(146, '2011-02-03 10:28:17', '127.0.0.1', 1),
(147, '2011-02-03 10:28:45', '127.0.0.1', 1),
(148, '2011-02-03 10:29:24', '127.0.0.1', 1),
(149, '2011-02-03 11:02:27', '127.0.0.1', 14),
(150, '2011-02-03 11:02:45', '127.0.0.1', 1),
(151, '2011-02-03 11:29:36', '127.0.0.1', 1),
(152, '2011-02-03 11:30:48', '127.0.0.1', 1),
(153, '2011-02-03 11:31:48', '127.0.0.1', 1),
(154, '2011-02-03 11:32:48', '127.0.0.1', 1),
(155, '2011-02-03 11:55:11', '127.0.0.1', 1),
(156, '2011-02-03 12:52:36', '127.0.0.1', 1),
(157, '2011-02-03 14:27:21', '127.0.0.1', 1),
(158, '2011-02-03 15:54:22', '127.0.0.1', 1),
(159, '2011-02-04 08:19:49', '127.0.0.1', 14),
(160, '2011-02-04 08:20:00', '127.0.0.1', 1),
(161, '2011-02-04 08:34:41', '127.0.0.1', 1),
(162, '2011-02-04 08:44:40', '127.0.0.1', 1),
(163, '2011-02-04 08:46:51', '127.0.0.1', 1),
(164, '2011-02-04 08:56:38', '127.0.0.1', 14),
(165, '2011-02-04 08:56:45', '127.0.0.1', 1),
(166, '2011-02-04 08:57:15', '127.0.0.1', 21),
(167, '2011-02-04 13:11:32', '127.0.0.1', 1),
(168, '2011-02-04 14:11:15', '127.0.0.1', 1),
(169, '2011-02-07 08:45:53', '127.0.0.1', 1),
(170, '2011-02-07 09:26:42', '127.0.0.1', 19),
(171, '2011-02-07 09:26:56', '127.0.0.1', 1),
(172, '2011-02-07 09:46:22', '127.0.0.1', 1),
(173, '2011-02-07 10:32:45', '127.0.0.1', 1),
(174, '2011-02-07 10:33:23', '127.0.0.1', 1),
(175, '2011-02-07 10:34:09', '127.0.0.1', 1),
(176, '2011-02-07 12:01:26', '127.0.0.1', 1),
(177, '2011-02-07 12:37:26', '127.0.0.1', 19),
(178, '2011-02-07 12:37:34', '127.0.0.1', 1),
(179, '2011-02-07 12:38:09', '127.0.0.1', 23),
(180, '2011-02-07 12:38:24', '127.0.0.1', 1),
(181, '2011-02-07 12:43:09', '127.0.0.1', 19),
(182, '2011-02-07 12:45:40', '127.0.0.1', 1),
(183, '2011-02-07 14:02:37', '127.0.0.1', 1),
(184, '2011-02-07 14:56:51', '127.0.0.1', 23),
(185, '2011-02-07 14:57:04', '127.0.0.1', 1),
(186, '2011-02-07 14:57:58', '127.0.0.1', 23),
(187, '2011-02-07 14:58:34', '127.0.0.1', 1),
(188, '2011-02-08 08:56:37', '127.0.0.1', 1),
(189, '2011-02-08 10:22:05', '127.0.0.1', 1),
(190, '2011-02-08 15:15:36', '127.0.0.1', 1),
(191, '2011-02-08 16:25:05', '127.0.0.1', 1),
(192, '2011-02-09 08:24:47', '127.0.0.1', 1),
(193, '2011-02-09 10:41:20', '127.0.0.1', 1),
(194, '2011-02-09 12:11:17', '127.0.0.1', 1),
(195, '2011-02-09 14:27:12', '127.0.0.1', 1),
(196, '2011-02-09 15:25:18', '127.0.0.1', 1),
(197, '2011-02-09 16:36:32', '127.0.0.1', 1),
(198, '2011-02-10 15:23:28', '127.0.0.1', 1),
(199, '2011-02-10 15:52:41', '127.0.0.1', 1),
(200, '2011-02-10 15:53:28', '127.0.0.1', 1),
(201, '2011-02-10 15:54:43', '127.0.0.1', 1),
(202, '2011-02-11 08:35:09', '127.0.0.1', 1),
(203, '2011-02-11 09:37:51', '127.0.0.1', 1),
(204, '2011-02-11 09:45:50', '127.0.0.1', 23),
(205, '2011-02-11 09:46:08', '127.0.0.1', 1),
(206, '2011-02-11 14:40:13', '127.0.0.1', 23),
(207, '2011-02-11 14:40:27', '127.0.0.1', 1),
(208, '2011-02-14 08:48:38', '127.0.0.1', 1),
(209, '2011-02-14 09:52:26', '127.0.0.1', 1),
(210, '2011-02-14 14:09:32', '127.0.0.1', 1),
(211, '2011-02-14 16:26:15', '127.0.0.1', 23),
(212, '2011-02-14 16:26:29', '127.0.0.1', 1),
(213, '2011-02-15 08:31:04', '127.0.0.1', 1),
(214, '2011-02-15 13:54:05', '127.0.0.1', 1),
(215, '2011-02-15 17:00:32', '127.0.0.1', 1),
(216, '2011-02-16 08:37:12', '127.0.0.1', 1),
(217, '2011-02-16 08:52:28', '127.0.0.1', 1),
(218, '2011-02-16 11:12:17', '127.0.0.1', 1),
(219, '2011-02-16 12:49:51', '127.0.0.1', 23),
(220, '2011-02-16 12:51:12', '127.0.0.1', 1),
(221, '2011-02-16 14:10:00', '127.0.0.1', 1),
(222, '2011-02-17 08:09:38', '127.0.0.1', 1),
(223, '2011-02-17 08:40:57', '127.0.0.1', 1),
(224, '2011-02-17 10:56:03', '127.0.0.1', 1),
(225, '2011-02-17 13:54:58', '127.0.0.1', 1),
(226, '2011-02-17 15:20:06', '127.0.0.1', 23),
(227, '2011-02-17 15:20:22', '127.0.0.1', 1),
(228, '2011-02-17 15:24:27', '127.0.0.1', 23),
(229, '2011-02-17 15:26:00', '127.0.0.1', 1),
(230, '2011-02-17 15:26:14', '127.0.0.1', 23),
(231, '2011-02-17 15:31:25', '127.0.0.1', 1),
(232, '2011-02-17 15:32:43', '127.0.0.1', 23),
(233, '2011-02-17 15:40:06', '127.0.0.1', 1),
(234, '2011-02-17 15:40:40', '127.0.0.1', 23),
(235, '2011-02-17 15:40:58', '127.0.0.1', 1),
(236, '2011-02-18 08:20:41', '127.0.0.1', 1),
(237, '2011-02-18 08:49:59', '127.0.0.1', 23),
(238, '2011-02-18 08:50:19', '127.0.0.1', 1),
(239, '2011-02-18 12:06:16', '127.0.0.1', 1),
(240, '2011-02-18 12:06:52', '127.0.0.1', 1),
(241, '2011-02-18 13:12:31', '127.0.0.1', 1),
(242, '2011-02-18 14:26:53', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `LevelMember`
--

CREATE TABLE IF NOT EXISTS `LevelMember` (
  `idLevelMember` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`idLevelMember`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `LevelMember`
--

INSERT INTO `LevelMember` (`idLevelMember`, `name`) VALUES
(1, 'Super Administrateur'),
(2, 'Administrateur'),
(3, 'OpÃ©rateur');

-- --------------------------------------------------------

--
-- Structure de la table `Log`
--

CREATE TABLE IF NOT EXISTS `Log` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `dateLog` datetime NOT NULL,
  `pluginName` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idLog`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=282 ;

--
-- Contenu de la table `Log`
--

INSERT INTO `Log` (`idLog`, `dateLog`, `pluginName`, `log`, `user_idUser`) VALUES
(76, '2011-01-31 16:07:19', 'sector', 'accÃ¨s non autorisÃ©', 1),
(75, '2011-01-31 16:07:14', 'sector', 'accÃ¨s non autorisÃ©', 1),
(74, '2011-01-31 16:07:08', 'sector', 'accÃ¨s non autorisÃ©', 1),
(72, '2011-01-31 16:01:26', 'sector', 'accÃ¨s non autorisÃ©', 1),
(73, '2011-01-31 16:07:06', 'sector', 'accÃ¨s non autorisÃ©', 1),
(71, '2011-01-31 14:59:06', 'user', 'accÃ¨s non autorisÃ©', 14),
(11, '2011-01-21 12:06:41', 'user', 'accÃ¨s non autorisÃ©', 1),
(10, '2011-01-21 12:06:33', 'user', 'accÃ¨s non autorisÃ©', 1),
(70, '2011-01-31 14:56:16', 'user', 'Mise Ã  jour du membre : test', 1),
(69, '2011-01-31 13:05:05', 'user', 'Ajout d''un nouvel utilisateur : test', 1),
(68, '2011-01-31 12:59:56', 'user', 'Suppression de : zol', 1),
(67, '2011-01-31 12:59:24', 'user', 'Ajout d''un nouvel utilisateur : zol', 1),
(21, '2011-01-21 12:31:25', 'user', 'accÃ¨s non autorisÃ©', 1),
(22, '2011-01-21 13:20:12', 'user', 'Ajout d''un nouvel utilisateur : diotbÃªte_-', 1),
(23, '2011-01-21 13:23:53', 'user', 'Ajout d''un nouvel utilisateur : diotbÃªte_-_', 1),
(24, '2011-01-21 13:25:05', 'user', 'Ajout d''un nouvel utilisateur : diotbÃªte_-_-', 1),
(25, '2011-01-21 13:26:18', 'user', 'Ajout d''un nouvel utilisateur : diotbÃªte_--', 1),
(26, '2011-01-21 13:26:46', 'user', 'Ajout d''un nouvel utilisateur : diotbÃªte_---', 1),
(27, '2011-01-21 13:28:30', 'user', 'Ajout d''un nouvel utilisateur : test55', 1),
(28, '2011-01-21 14:22:24', 'user', 'accÃ¨s non autorisÃ©', 1),
(30, '2011-01-24 08:36:14', 'user', 'Suppression de : test55', 1),
(31, '2011-01-24 08:36:20', 'user', 'Suppression de : diotbÃªte_---', 1),
(32, '2011-01-24 08:36:22', 'user', 'Suppression de : diotbÃªte_--', 1),
(33, '2011-01-24 08:36:27', 'user', 'Suppression de : diotbÃªte_-_-', 1),
(34, '2011-01-24 08:36:30', 'user', 'Suppression de : diotbÃªte_-_', 1),
(35, '2011-01-24 08:36:33', 'user', 'Suppression de : diotbÃªte_-', 1),
(36, '2011-01-24 08:39:30', 'user', 'Suppression de : XD', 1),
(66, '2011-01-31 12:58:11', 'user', 'Mise Ã  jour du membre : macg', 1),
(38, '2011-01-24 09:00:05', 'user', 'Suppression de : test3', 1),
(64, '2011-01-31 12:57:22', 'user', 'Ajout d''un nouvel utilisateur : zol', 1),
(65, '2011-01-31 12:58:00', 'user', 'Suppression de : zol', 1),
(62, '2011-01-31 12:56:54', 'user', 'Ajout d''un nouvel utilisateur : hola', 1),
(63, '2011-01-31 12:57:06', 'user', 'Suppression de : hola', 1),
(61, '2011-01-31 12:51:50', 'user', 'Ajout d''un nouvel utilisateur : idiot', 1),
(45, '2011-01-24 10:03:43', 'user', 'Mise Ã  jour du membre : jv1i3n', 1),
(46, '2011-01-24 10:18:30', 'user', 'Mise Ã  jour du membre : jv1i3n', 1),
(47, '2011-01-24 10:19:08', 'user', 'Mise Ã  jour du membre : julien', 1),
(48, '2011-01-24 10:19:34', 'user', 'Mise Ã  jour du membre : julien', 1),
(49, '2011-01-24 10:22:05', 'user', 'Mise Ã  jour du membre : julien', 1),
(50, '2011-01-24 10:22:10', 'user', 'Mise Ã  jour du membre : test', 1),
(51, '2011-01-24 10:22:14', 'user', 'Mise Ã  jour du membre : test', 1),
(52, '2011-01-24 10:22:18', 'user', 'Mise Ã  jour du membre : test2', 1),
(53, '2011-01-24 12:31:25', 'user', 'Suppression de : test', 1),
(54, '2011-01-24 12:31:32', 'user', 'Suppression de : test2', 1),
(60, '2011-01-31 12:50:41', 'user', 'Ajout d''un nouvel utilisateur : julien', 1),
(59, '2011-01-31 12:50:16', 'user', 'Suppression de : julien', 1),
(58, '2011-01-31 11:30:41', 'user', 'Mise Ã  jour du membre : jv1i3n', 1),
(77, '2011-01-31 16:07:38', 'sector', 'accÃ¨s non autorisÃ©', 1),
(78, '2011-01-31 16:07:39', 'sector', 'accÃ¨s non autorisÃ©', 1),
(79, '2011-01-31 16:07:39', 'sector', 'accÃ¨s non autorisÃ©', 1),
(80, '2011-01-31 16:07:39', 'sector', 'accÃ¨s non autorisÃ©', 1),
(81, '2011-02-01 10:15:34', 'Sector', ' tentative de modification d''un secteur ,''Ã©xistant pas ou plus.', 1),
(82, '2011-02-01 10:16:53', 'Sector', ' Ajout du secteur : Secteur La Ville Dieu Du Temple', 1),
(83, '2011-02-01 10:46:35', 'Sector', ' modification du secteur : Secteur Auvillar', 1),
(84, '2011-02-01 10:50:48', 'Sector', ' modification du secteur : Secteur Auvillar s', 1),
(85, '2011-02-01 10:50:54', 'Sector', ' modification du secteur : Secteur Auvillar', 1),
(86, '2011-02-01 10:51:00', 'Sector', ' Ajout du secteur : del', 1),
(87, '2011-02-01 11:23:58', 'sector', 'Suppression du secteur : del', 1),
(88, '2011-02-01 12:22:59', 'user', 'Ajout d''un nouvel utilisateur : date', 1),
(89, '2011-02-01 15:00:42', 'sector', 'Suppression du secteur : Secteur Auvillar', 1),
(90, '2011-02-01 15:00:44', 'sector', 'Suppression du secteur : Secteur La Ville Dieu Du Temple', 1),
(91, '2011-02-01 15:00:46', 'sector', 'Suppression du secteur : Secteur Moissac', 1),
(92, '2011-02-01 15:03:59', 'Sector', ' Ajout du secteur : Secteur Auvillar', 1),
(93, '2011-02-01 15:04:06', 'Sector', ' Ajout du secteur : Secteur Moissac', 1),
(94, '2011-02-01 15:04:10', 'Sector', ' Ajout du secteur : Secteur La Ville Dieu Du Temple', 1),
(95, '2011-02-01 15:57:00', 'sector', 'Ajout de la ville : pompignan', 1),
(96, '2011-02-01 15:57:08', 'sector', 'Suppression du secteur : Secteur Auvillar', 1),
(97, '2011-02-01 15:57:29', 'Sector', ' Ajout du secteur : Secteur Auvillar', 1),
(98, '2011-02-01 16:11:33', 'sector', 'Ajout de la ville : DEL', 1),
(99, '2011-02-01 16:31:23', 'sector', 'Suppression de la ville : DEL', 1),
(100, '2011-02-01 16:31:39', 'sector', 'Ajout de la ville : del', 1),
(101, '2011-02-01 16:34:04', 'sector', 'Suppression de la ville : del', 1),
(102, '2011-02-02 09:09:01', 'sector', 'Ajout de la ville : test', 1),
(103, '2011-02-02 09:18:37', 'sector', ' modification de la ville : Pompignan', 1),
(104, '2011-02-02 09:19:46', 'sector', ' modification de la ville : test', 1),
(105, '2011-02-02 09:20:06', 'sector', ' modification de la ville : test', 1),
(106, '2011-02-02 09:20:56', 'sector', ' modification de la ville : test', 1),
(107, '2011-02-02 09:21:13', 'sector', ' modification de la ville : test', 1),
(108, '2011-02-02 09:21:45', 'sector', ' modification de la ville : test', 1),
(109, '2011-02-02 09:21:54', 'sector', ' modification de la ville : test', 1),
(110, '2011-02-02 09:23:06', 'sector', ' modification de la ville : test', 1),
(111, '2011-02-02 09:24:42', 'sector', ' modification de la ville : test', 1),
(112, '2011-02-02 09:25:03', 'sector', ' modification de la ville : test', 1),
(113, '2011-02-02 09:25:09', 'sector', ' modification de la ville : test', 1),
(114, '2011-02-02 09:25:27', 'sector', ' modification de la ville : test', 1),
(115, '2011-02-02 09:25:31', 'sector', ' modification de la ville : test', 1),
(116, '2011-02-02 09:27:03', 'sector', ' modification de la ville : test', 1),
(117, '2011-02-02 09:27:43', 'sector', ' modification de la ville : test', 1),
(118, '2011-02-02 09:27:45', 'sector', ' modification de la ville : test', 1),
(119, '2011-02-02 09:27:50', 'sector', ' modification de la ville : test', 1),
(120, '2011-02-02 09:28:16', 'sector', ' modification de la ville : test', 1),
(121, '2011-02-02 09:28:50', 'sector', ' modification de la ville : test', 1),
(122, '2011-02-02 09:29:33', 'sector', ' modification de la ville : test', 1),
(123, '2011-02-02 09:29:53', 'sector', ' modification de la ville : test', 1),
(124, '2011-02-02 09:30:02', 'user', 'Mise Ã  jour du membre : date', 1),
(125, '2011-02-02 09:43:21', 'user', 'accÃ¨s non autorisÃ©', 14),
(126, '2011-02-02 09:45:50', 'user', 'Mise Ã  jour du membre : julien', 14),
(127, '2011-02-02 09:45:56', 'user', 'Mise Ã  jour du membre : julien', 14),
(128, '2011-02-02 09:48:11', 'user', 'Mise Ã  jour du membre : julien', 14),
(129, '2011-02-02 09:48:48', 'user', 'Mise Ã  jour du membre : julien', 14),
(130, '2011-02-02 09:50:36', 'user', 'Mise Ã  jour du membre : julien', 14),
(131, '2011-02-02 09:51:52', 'user', 'Mise Ã  jour du membre : julien', 14),
(132, '2011-02-02 09:51:59', 'user', 'Mise Ã  jour du membre : julien', 14),
(133, '2011-02-02 09:52:26', 'user', 'Mise Ã  jour du membre : julienR', 1),
(134, '2011-02-02 09:52:34', 'user', 'Mise Ã  jour du membre : julien', 1),
(135, '2011-02-02 09:52:41', 'user', 'Mise Ã  jour du membre : jv1i3n', 1),
(136, '2011-02-02 09:52:50', 'user', 'Mise Ã  jour du membre : jv1i3n', 1),
(137, '2011-02-02 09:55:18', 'sector', ' modification de la ville : test', 1),
(138, '2011-02-02 09:55:26', 'sector', ' modification de la ville : Pompignan', 1),
(139, '2011-02-02 09:55:43', 'sector', 'Suppression de la ville : test', 1),
(140, '2011-02-02 09:55:50', 'sector', ' modification de la ville : Pompignan', 1),
(141, '2011-02-02 11:29:09', 'sector', ' modification de la ville : Pompignan', 1),
(142, '2011-02-02 14:10:05', 'user', 'Mise Ã  jour du membre : julien', 14),
(143, '2011-02-02 15:25:31', 'sector', 'accÃ¨s non autorisÃ©', 1),
(144, '2011-02-02 15:25:56', 'sector', 'accÃ¨s non autorisÃ©', 1),
(145, '2011-02-02 15:27:00', 'sector', 'accÃ¨s non autorisÃ©', 1),
(146, '2011-02-02 15:27:01', 'sector', 'accÃ¨s non autorisÃ©', 1),
(147, '2011-02-02 15:27:01', 'sector', 'accÃ¨s non autorisÃ©', 1),
(148, '2011-02-02 15:27:06', 'sector', 'accÃ¨s non autorisÃ©', 1),
(149, '2011-02-03 09:28:32', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(150, '2011-02-03 09:32:15', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(151, '2011-02-03 09:32:16', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(152, '2011-02-03 09:33:23', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(153, '2011-02-03 09:35:01', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(154, '2011-02-03 09:35:02', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(155, '2011-02-03 09:36:27', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(156, '2011-02-03 09:36:29', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(157, '2011-02-03 09:38:26', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(158, '2011-02-04 08:20:14', 'user', 'Mise Ã  jour du membre : admin', 1),
(159, '2011-02-04 08:57:05', 'user', 'Ajout d''un nouvel utilisateur : user', 1),
(160, '2011-02-04 10:11:46', 'notary', 'Ajout du notaire : ', 21),
(161, '2011-02-04 10:42:25', 'notary', 'Ajout du notaire : ', 21),
(162, '2011-02-04 10:56:18', 'dpe', 'accÃ¨s non autorisÃ©', 21),
(163, '2011-02-04 11:35:08', 'notary', 'Suppression du notaire : test', 21),
(164, '2011-02-04 12:17:53', 'notary', 'Modification du notaire nom', 21),
(165, '2011-02-07 10:03:01', 'user', 'Ajout d''un nouvel utilisateur : aaa', 1),
(166, '2011-02-07 10:48:08', 'seller', 'Ajout du titre de vendeur : Enregistrer', 1),
(167, '2011-02-07 10:48:32', 'seller', 'Ajout du titre de vendeur : Enregistrer', 1),
(168, '2011-02-07 10:48:48', 'seller', 'Ajout du titre de vendeur : Enregistrer', 1),
(169, '2011-02-07 11:06:18', 'seller', 'accÃ¨s non autorisÃ©', 1),
(170, '2011-02-07 11:10:43', 'seller', 'accÃ¨s non autorisÃ©', 1),
(171, '2011-02-07 11:18:48', 'seller', 'Modification du titre de vendeur : un titre en : un titreTTT', 1),
(172, '2011-02-07 11:18:57', 'seller', 'Modification du titre de vendeur : un titreTTT en : un titre', 1),
(173, '2011-02-07 11:28:45', 'seller', 'Ajout du titre de vendeur : Enregistrer', 1),
(174, '2011-02-07 12:28:53', 'sector', ' modification de la ville : Montauban', 1),
(175, '2011-02-07 12:38:01', 'user', 'Ajout d''un nouvel utilisateur : operateur', 1),
(176, '2011-02-07 12:56:57', 'seller', 'Ajout du titre de vendeur : Enregistrer', 1),
(177, '2011-02-07 14:23:07', 'seller', 'accÃ¨s non autorisÃ©', 1),
(178, '2011-02-07 14:25:42', 'seller', 'Suppression du titre du vendeur : del', 1),
(179, '2011-02-07 14:50:03', 'seller', 'accÃ¨s non autorisÃ©', 1),
(180, '2011-02-07 14:56:56', 'seller', 'accÃ¨s non autorisÃ©', 23),
(181, '2011-02-07 15:03:00', 'seller', 'Ajout du titre de vendeur : test', 1),
(182, '2011-02-07 15:09:03', 'seller', 'accÃ¨s non autorisÃ©', 1),
(183, '2011-02-07 15:36:55', 'seller', 'Suppression du vendeur : Test', 1),
(184, '2011-02-07 15:52:30', 'sector', 'Ajout de la ville : auvillar', 1),
(185, '2011-02-08 09:25:46', 'seller', 'Mise Ã  jour du vendeur : blaF', 1),
(186, '2011-02-08 09:25:59', 'seller', 'Mise Ã  jour du vendeur : blaF', 1),
(187, '2011-02-08 10:52:54', 'seller', 'Mise Ã  jour du vendeur : blaF', 1),
(188, '2011-02-10 15:48:02', 'sector', 'accÃ¨s non autorisÃ©', 1),
(189, '2011-02-14 15:33:31', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(190, '2011-02-15 15:48:07', 'seller', 'Suppression du vendeur : XD', 1),
(191, '2011-02-15 15:48:12', 'seller', 'Suppression du vendeur : lol', 1),
(192, '2011-02-16 12:44:59', 'seller', 'Creation du vendeur : new', 1),
(193, '2011-02-16 12:44:59', 'terrain', 'Ajout du terrain : 369', 1),
(194, '2011-02-16 12:44:59', 'terrain', 'nouvelle liaison terrain/vendeur principal : 369/new', 1),
(195, '2011-02-16 12:51:05', 'terrain', 'Ajout du terrain : 999', 23),
(196, '2011-02-16 12:51:05', 'terrain', 'nouvelle liaison terrain/vendeur principal : 999/mon vendeur', 23),
(197, '2011-02-16 15:01:27', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(198, '2011-02-16 15:01:35', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(199, '2011-02-16 16:18:14', 'seller', 'Mise Ã  jour du vendeur : mon vendeur', 1),
(200, '2011-02-16 16:18:43', 'seller', 'Mise Ã  jour du vendeur : mon vendeur', 1),
(201, '2011-02-17 09:04:43', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(202, '2011-02-17 09:16:34', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(203, '2011-02-17 09:48:55', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(204, '2011-02-17 09:51:31', 'sector', ' modification de la ville : Auvillar', 1),
(205, '2011-02-17 12:06:06', 'seller', 'Mise Ã  jour du vendeur : Le blanc', 1),
(206, '2011-02-17 12:55:37', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(207, '2011-02-17 15:26:56', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(208, '2011-02-17 15:27:07', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(209, '2011-02-17 15:27:09', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(210, '2011-02-17 15:27:16', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(211, '2011-02-17 15:27:52', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(212, '2011-02-17 15:28:00', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(213, '2011-02-17 15:31:16', 'terrain', 'Suppression de la liaison terrain/vendeur : 354/mon vendeur', 23),
(214, '2011-02-17 15:32:50', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(215, '2011-02-17 15:35:05', 'terrain', 'accÃ¨s non autorisÃ©', 23),
(216, '2011-02-17 16:02:36', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(217, '2011-02-17 16:03:31', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(218, '2011-02-17 17:00:45', 'terrain', 'Ajout d''une image', 1),
(219, '2011-02-18 08:46:31', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(220, '2011-02-18 08:46:36', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(221, '2011-02-18 09:15:01', 'terrain', 'Suppression d''une image pour le terrain : 354', 1),
(222, '2011-02-18 09:16:25', 'terrain', 'Ajout d''une image pour le mandat : 354', 1),
(223, '2011-02-18 09:17:00', 'terrain', 'Suppression d''une image pour le terrain : 354', 1),
(224, '2011-02-18 09:18:16', 'terrain', 'Suppression d''une image pour le terrain : 354', 1),
(225, '2011-02-18 09:18:26', 'terrain', 'Ajout d''une image pour le mandat : 354', 1),
(226, '2011-02-18 09:27:09', 'terrain', 'Ajout d''une image pour le mandat : 354', 1),
(227, '2011-02-18 09:28:01', 'terrain', 'Suppression d''une image pour le terrain : 354', 1),
(228, '2011-02-18 09:28:14', 'terrain', 'Ajout d''une image pour le mandat : 354', 1),
(229, '2011-02-18 09:28:19', 'terrain', 'Suppression d''une image pour le terrain : 354', 1),
(230, '2011-02-18 09:30:19', 'terrain', 'Ajout d''une image pour le mandat : 354', 1),
(231, '2011-02-18 09:48:37', 'terrain', 'Changement de vendeur principal pour le terrain 354', 1),
(232, '2011-02-18 09:57:28', 'terrain', 'Ajout d''une image pour le mandat : 369', 1),
(233, '2011-02-18 10:09:17', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(234, '2011-02-18 10:47:32', 'terrain', 'Affectation d''un nouveau vendeur (mon vendeur ) au mandat : 354', 1),
(235, '2011-02-18 10:48:30', 'terrain', 'Affectation d''un nouveau vendeur (mon vendeur ) au mandat : 354', 1),
(236, '2011-02-18 10:48:44', 'terrain', 'Changement de vendeur principal pour le terrain 354', 1),
(237, '2011-02-18 10:50:33', 'terrain', 'Affectation d''un nouveau vendeur (mon vendeur ) au mandat : 354', 1),
(238, '2011-02-18 10:50:38', 'terrain', 'Changement de vendeur principal pour le terrain 354', 1),
(239, '2011-02-18 10:52:15', 'terrain', 'Ajout du terrain : 1', 1),
(240, '2011-02-18 10:52:15', 'terrain', 'nouvelle liaison terrain/vendeur principal : 1/mon vendeur', 1),
(241, '2011-02-18 10:52:58', 'terrain', 'Ajout du terrain : 2', 1),
(242, '2011-02-18 10:52:58', 'terrain', 'nouvelle liaison terrain/vendeur principal : 2/mon vendeur', 1),
(243, '2011-02-18 10:53:15', 'terrain', 'Ajout d''une image pour le mandat : 1', 1),
(244, '2011-02-18 10:53:27', 'terrain', 'Affectation d''un nouveau vendeur (mon vendeur ) au mandat : 1', 1),
(245, '2011-02-18 10:54:26', 'terrain', 'Affectation d''un nouveau vendeur (Le blanc ) au mandat : 1', 1),
(246, '2011-02-18 10:54:34', 'terrain', 'Changement de vendeur principal pour le terrain 1', 1),
(247, '2011-02-18 10:57:46', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/mon vendeur', 1),
(248, '2011-02-18 10:57:57', 'terrain', 'Affectation d''un nouveau vendeur (Le blanc ) au mandat : 1', 1),
(249, '2011-02-18 10:59:25', 'terrain', 'Affectation d''un nouveau vendeur (Le blanc ) au mandat : 1', 1),
(250, '2011-02-18 11:05:19', 'terrain', 'Affectation d''un nouveau vendeur (blaF ) au mandat : 1', 1),
(251, '2011-02-18 11:05:26', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/blaF', 1),
(252, '2011-02-18 11:05:32', 'terrain', 'Affectation d''un nouveau vendeur (dgdfg ) au mandat : 1', 1),
(253, '2011-02-18 11:05:37', 'terrain', 'Changement de vendeur principal pour le terrain 1', 1),
(254, '2011-02-18 11:05:42', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/dgdfg', 1),
(255, '2011-02-18 11:05:50', 'terrain', 'Affectation d''un nouveau vendeur (mon vendeur ) au mandat : 1', 1),
(256, '2011-02-18 11:05:59', 'terrain', 'Affectation d''un nouveau vendeur (dgdfg ) au mandat : 1', 1),
(257, '2011-02-18 11:06:05', 'terrain', 'Changement de vendeur principal pour le terrain 1', 1),
(258, '2011-02-18 11:06:09', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/dgdfg', 1),
(259, '2011-02-18 11:06:13', 'terrain', 'Changement de vendeur principal pour le terrain 1', 1),
(260, '2011-02-18 11:18:49', 'terrain', 'Affectation d''un nouveau vendeur (dgdfg ) au mandat : 1', 1),
(261, '2011-02-18 11:18:56', 'terrain', 'Affectation d''un nouveau vendeur (Test ) au mandat : 1', 1),
(262, '2011-02-18 11:19:03', 'terrain', 'Affectation d''un nouveau vendeur (XDXD ) au mandat : 1', 1),
(263, '2011-02-18 11:19:07', 'terrain', 'Affectation d''un nouveau vendeur (new ) au mandat : 1', 1),
(264, '2011-02-18 11:19:11', 'terrain', 'Affectation d''un nouveau vendeur (blaF ) au mandat : 1', 1),
(265, '2011-02-18 11:19:27', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/blaF', 1),
(266, '2011-02-18 11:19:31', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/dgdfg', 1),
(267, '2011-02-18 11:19:40', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/mon vendeur', 1),
(268, '2011-02-18 11:19:44', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/XDXD', 1),
(269, '2011-02-18 11:19:48', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/new', 1),
(270, '2011-02-18 11:19:51', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/Test', 1),
(271, '2011-02-18 11:27:38', 'terrain', 'Ajout du terrain : 3', 1),
(272, '2011-02-18 11:27:38', 'terrain', 'nouvelle liaison terrain/vendeur principal : 3/Test', 1),
(273, '2011-02-18 11:28:04', 'terrain', 'Ajout du terrain : 4', 1),
(274, '2011-02-18 11:28:04', 'terrain', 'nouvelle liaison terrain/vendeur principal : 4/blaF', 1),
(275, '2011-02-18 11:55:57', 'seller', 'Ajout du vendeur : super un nouveau vendeur tout beau', 1),
(276, '2011-02-18 11:55:57', 'terrain', 'Affectation d''un nouveau vendeur (super un nouveau vendeur tout beau ) au mandat : 1', 1),
(277, '2011-02-18 11:56:03', 'terrain', 'Changement de vendeur principal pour le terrain 1', 1),
(278, '2011-02-18 11:56:10', 'seller', 'Ajout du vendeur : 2', 1),
(279, '2011-02-18 11:56:10', 'terrain', 'Affectation d''un nouveau vendeur (2 ) au mandat : 1', 1),
(280, '2011-02-18 11:56:18', 'terrain', 'Suppression de la liaison terrain/vendeur : 1/2', 1),
(281, '2011-02-18 13:13:15', 'terrain', 'Ajout d''une image pour le mandat : 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Mandate`
--

CREATE TABLE IF NOT EXISTS `Mandate` (
  `idMandate` int(11) NOT NULL AUTO_INCREMENT,
  `numberMandate` int(11) NOT NULL,
  `initDate` date NOT NULL,
  `deadDate` date NOT NULL,
  `freeDate` date DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `priceFai` decimal(11,2) NOT NULL,
  `priceSeller` decimal(11,2) NOT NULL,
  `commission` decimal(11,2) NOT NULL,
  `estimationFai` decimal(11,2) NOT NULL,
  `margeNegociation` decimal(11,2) NOT NULL,
  `referenceCadastreParcelle1` varchar(250) NOT NULL,
  `referenceCadastreParcelle2` varchar(250) NOT NULL,
  `referenceCadastreParcelle3` varchar(250) NOT NULL,
  `autreReferenceParcelle` varchar(250) NOT NULL,
  `superficieParcelle1` int(11) NOT NULL,
  `superficieParcelle2` int(11) NOT NULL,
  `superficieParcelle3` int(11) NOT NULL,
  `superficieAutreParcelle` int(11) NOT NULL,
  `superficieConstructible` int(11) NOT NULL,
  `superficieTotale` int(11) NOT NULL,
  `numberLot` varchar(10) NOT NULL,
  `sHONAccordee` int(11) NOT NULL,
  `zoneBDF` tinyint(1) NOT NULL DEFAULT '0',
  `ligneDeCrete` tinyint(1) NOT NULL DEFAULT '0',
  `zoneInondable` tinyint(1) NOT NULL DEFAULT '0',
  `reglementDeLotissement` text NOT NULL,
  `eRNT` varchar(250) NOT NULL,
  `dPValide` tinyint(1) NOT NULL DEFAULT '0',
  `dateDeclarationPrealable` date DEFAULT NULL,
  `prorogationDPJusquau` date DEFAULT NULL,
  `cuValide` tinyint(1) NOT NULL DEFAULT '0',
  `dateCU` tinyint(1) NOT NULL DEFAULT '0',
  `prorogationCUJusquau` tinyint(1) NOT NULL DEFAULT '0',
  `cuOPSValide` tinyint(1) NOT NULL DEFAULT '0',
  `dateCuOPS` date DEFAULT NULL,
  `prorogationCuOPSJusquau` tinyint(1) NOT NULL DEFAULT '0',
  `permisDamenagerValide` tinyint(1) NOT NULL DEFAULT '0',
  `datePermisDamenager` date DEFAULT NULL,
  `terrainVenduViabilise` tinyint(1) NOT NULL DEFAULT '0',
  `terrainVenduSemiViabilise` tinyint(1) NOT NULL DEFAULT '0',
  `terrainVenduNonViabilise` tinyint(1) NOT NULL DEFAULT '0',
  `passageEau` text NOT NULL,
  `passageElectricite` text NOT NULL,
  `passageGaz` text NOT NULL,
  `toutALegout` tinyint(1) NOT NULL DEFAULT '0',
  `assainissementParFosseSceptique` tinyint(1) NOT NULL DEFAULT '0',
  `voirie` text NOT NULL,
  `tailleFacade` int(11) NOT NULL,
  `profondeurTerrain` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `geolocalisation` varchar(250) NOT NULL,
  `proximiteEcole` int(11) NOT NULL,
  `proximiteCommerce` int(11) NOT NULL,
  `proximiteTransport` int(11) NOT NULL,
  `commentaireApparent` varchar(200) NOT NULL,
  `nbPiece` int(11) NOT NULL,
  `surfaceHabitable` int(11) NOT NULL,
  `nbChambre` int(11) NOT NULL,
  `surfacePieceVie` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `anneeConstruction` int(11) NOT NULL,
  `coupCoeur` tinyint(1) NOT NULL DEFAULT '0',
  `chargesMensuelle` int(11) NOT NULL,
  `taxesFonciere` int(11) NOT NULL,
  `taxeHabitation` int(11) NOT NULL,
  `nouveaute` date DEFAULT NULL,
  `cheminee` tinyint(1) NOT NULL DEFAULT '0',
  `cuisineEquipee` tinyint(1) NOT NULL DEFAULT '0',
  `cuisineAmenagee` tinyint(1) NOT NULL DEFAULT '0',
  `piscine` tinyint(1) NOT NULL DEFAULT '0',
  `poolHouse` tinyint(1) NOT NULL DEFAULT '0',
  `terrasse` tinyint(1) NOT NULL DEFAULT '0',
  `mezzanine` tinyint(1) NOT NULL DEFAULT '0',
  `dependance` tinyint(1) NOT NULL DEFAULT '0',
  `gaz` tinyint(1) NOT NULL DEFAULT '0',
  `cave` tinyint(1) NOT NULL DEFAULT '0',
  `sousSol` tinyint(1) NOT NULL DEFAULT '0',
  `garage` tinyint(1) NOT NULL DEFAULT '0',
  `parking` tinyint(1) NOT NULL DEFAULT '0',
  `rezDeJardin` tinyint(1) NOT NULL DEFAULT '0',
  `plainPied` tinyint(1) NOT NULL DEFAULT '0',
  `carriere` tinyint(1) NOT NULL DEFAULT '0',
  `pointEau` tinyint(1) NOT NULL DEFAULT '0',
  `user_idUser` int(11) NOT NULL,
  `sector_idSector` int(11) NOT NULL,
  `city_idCity` int(11) NOT NULL,
  `notary_idNotary` int(11) NOT NULL,
  `mandateType_idMandateType` int(11) NOT NULL,
  `transactionType_idTransactionType` int(11) NOT NULL,
  `slope_idMandateSlope` int(11) DEFAULT NULL,
  `orientation_idMandateOrientation` int(11) DEFAULT NULL,
  `insulation_idMandateInsulation` int(11) DEFAULT NULL,
  `news_idMandateNews` int(11) DEFAULT NULL,
  `heating_idMandateHeating` int(11) DEFAULT NULL,
  `commonOwnership_idMandateCommonOwnership` int(11) DEFAULT NULL,
  `roof_idMandateRoof` int(11) DEFAULT NULL,
  `condition_idMandateCondition` int(11) DEFAULT NULL,
  `style_idMandateStyle` int(11) DEFAULT NULL,
  `construction_idMandateConstructionType` int(11) DEFAULT NULL,
  `sanitationCorresponding_idMandateSanitationCorresponding` int(11) DEFAULT NULL,
  `electricCorresponding_idMandateElectricCorresponding` int(11) DEFAULT NULL,
  `gazCorresponding_idMandateGazCorresponding` int(11) DEFAULT NULL,
  `waterCorresponding_idMandateWaterCorresponding` int(11) DEFAULT NULL,
  `cos_idMandateCOS` int(11) DEFAULT NULL,
  `zonagePLU_idMandateZonagePLU` int(11) DEFAULT NULL,
  `zonageRNU_idMandateZonageRNU` int(11) DEFAULT NULL,
  `bornageTerrain_idMandateBornageTerrain` int(11) DEFAULT NULL,
  `geometer_idMandateGeometer` int(11) DEFAULT NULL,
  `etap_idMandateEtap` int(11) NOT NULL,
  PRIMARY KEY (`idMandate`),
  KEY `user_idUser` (`user_idUser`),
  KEY `sector_idSector` (`sector_idSector`),
  KEY `city_idCity` (`city_idCity`),
  KEY `notary_idNotary` (`notary_idNotary`),
  KEY `mandateType_idMandateType` (`mandateType_idMandateType`),
  KEY `transactionType_idTransactionType` (`transactionType_idTransactionType`),
  KEY `slope_idMandateSlope` (`slope_idMandateSlope`),
  KEY `orientation_idMandateOrientation` (`orientation_idMandateOrientation`),
  KEY `insulation_idMandateInsulation` (`insulation_idMandateInsulation`),
  KEY `news_idMandateNews` (`news_idMandateNews`),
  KEY `heating_idMandateHeating` (`heating_idMandateHeating`),
  KEY `commonOwnership_idMandateCommonOwnership` (`commonOwnership_idMandateCommonOwnership`),
  KEY `roof_idMandateRoof` (`roof_idMandateRoof`),
  KEY `condition_idMandateCondition` (`condition_idMandateCondition`),
  KEY `style_idMandateStyle` (`style_idMandateStyle`),
  KEY `construction_idMandateConstructionType` (`construction_idMandateConstructionType`),
  KEY `sanitationCorresponding_idMandateSanitationCorresponding` (`sanitationCorresponding_idMandateSanitationCorresponding`),
  KEY `electricCorresponding_idMandateElectricCorresponding` (`electricCorresponding_idMandateElectricCorresponding`),
  KEY `gazCorresponding_idMandateGazCorresponding` (`gazCorresponding_idMandateGazCorresponding`),
  KEY `waterCorresponding_idMandateWaterCorresponding` (`waterCorresponding_idMandateWaterCorresponding`),
  KEY `cos_idMandateCOS` (`cos_idMandateCOS`),
  KEY `zonagePLU_idMandateZonagePLU` (`zonagePLU_idMandateZonagePLU`),
  KEY `zonageRNU_idMandateZonageRNU` (`zonageRNU_idMandateZonageRNU`),
  KEY `bornageTerrain_idMandateBornageTerrain` (`bornageTerrain_idMandateBornageTerrain`),
  KEY `geometer_idMandateGeometer` (`geometer_idMandateGeometer`),
  KEY `etap_idMandateEtap` (`etap_idMandateEtap`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Mandate`
--

INSERT INTO `Mandate` (`idMandate`, `numberMandate`, `initDate`, `deadDate`, `freeDate`, `address`, `priceFai`, `priceSeller`, `commission`, `estimationFai`, `margeNegociation`, `referenceCadastreParcelle1`, `referenceCadastreParcelle2`, `referenceCadastreParcelle3`, `autreReferenceParcelle`, `superficieParcelle1`, `superficieParcelle2`, `superficieParcelle3`, `superficieAutreParcelle`, `superficieConstructible`, `superficieTotale`, `numberLot`, `sHONAccordee`, `zoneBDF`, `ligneDeCrete`, `zoneInondable`, `reglementDeLotissement`, `eRNT`, `dPValide`, `dateDeclarationPrealable`, `prorogationDPJusquau`, `cuValide`, `dateCU`, `prorogationCUJusquau`, `cuOPSValide`, `dateCuOPS`, `prorogationCuOPSJusquau`, `permisDamenagerValide`, `datePermisDamenager`, `terrainVenduViabilise`, `terrainVenduSemiViabilise`, `terrainVenduNonViabilise`, `passageEau`, `passageElectricite`, `passageGaz`, `toutALegout`, `assainissementParFosseSceptique`, `voirie`, `tailleFacade`, `profondeurTerrain`, `commentaire`, `geolocalisation`, `proximiteEcole`, `proximiteCommerce`, `proximiteTransport`, `commentaireApparent`, `nbPiece`, `surfaceHabitable`, `nbChambre`, `surfacePieceVie`, `niveau`, `anneeConstruction`, `coupCoeur`, `chargesMensuelle`, `taxesFonciere`, `taxeHabitation`, `nouveaute`, `cheminee`, `cuisineEquipee`, `cuisineAmenagee`, `piscine`, `poolHouse`, `terrasse`, `mezzanine`, `dependance`, `gaz`, `cave`, `sousSol`, `garage`, `parking`, `rezDeJardin`, `plainPied`, `carriere`, `pointEau`, `user_idUser`, `sector_idSector`, `city_idCity`, `notary_idNotary`, `mandateType_idMandateType`, `transactionType_idTransactionType`, `slope_idMandateSlope`, `orientation_idMandateOrientation`, `insulation_idMandateInsulation`, `news_idMandateNews`, `heating_idMandateHeating`, `commonOwnership_idMandateCommonOwnership`, `roof_idMandateRoof`, `condition_idMandateCondition`, `style_idMandateStyle`, `construction_idMandateConstructionType`, `sanitationCorresponding_idMandateSanitationCorresponding`, `electricCorresponding_idMandateElectricCorresponding`, `gazCorresponding_idMandateGazCorresponding`, `waterCorresponding_idMandateWaterCorresponding`, `cos_idMandateCOS`, `zonagePLU_idMandateZonagePLU`, `zonageRNU_idMandateZonageRNU`, `bornageTerrain_idMandateBornageTerrain`, `geometer_idMandateGeometer`, `etap_idMandateEtap`) VALUES
(1, 1, '2011-02-18', '2012-02-18', '1970-01-01', '36 rue des inconnus', '300000.00', '250000.00', '50000.00', '300000.00', '5.00', 'Blabla', '', '', '', 0, 0, 0, 0, 0, 0, '45', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, 0, 'passage eau', '', '', 0, 0, 'voirie', 0, 0, '', 'GEOLOC', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 7, 5, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 2, '2011-02-18', '2012-02-18', '1970-01-01', '45 avenue des pigeons', '999999.00', '100000.00', '899999.00', '999999.00', '70.00', '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, 0, 'passage eau', '', '', 0, 0, 'voirie', 0, 0, '', 'GEOLOC', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 3, '2011-02-18', '2012-02-18', '1970-01-01', '36 rue des inconnus', '300000.00', '100000.00', '200000.00', '300000.00', '5.00', '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, 0, 'passage eau', '', '', 0, 0, 'voirie', 0, 0, '', 'GEOLOC', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 4, '2011-02-18', '2012-02-18', '1970-01-01', 'lol', '1.00', '1.00', '1.00', '1.00', '1.00', '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, 0, 'passage eau', '', '', 0, 0, 'voirie', 0, 0, '', 'GEOLOC', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `MandateBornageTerrain`
--

CREATE TABLE IF NOT EXISTS `MandateBornageTerrain` (
  `idMandateBornageTerrain` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateBornageTerrain`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateBornageTerrain`
--

INSERT INTO `MandateBornageTerrain` (`idMandateBornageTerrain`, `name`, `code`) VALUES
(1, 'bornage', 'bo');

-- --------------------------------------------------------

--
-- Structure de la table `MandateCommonOwnership`
--

CREATE TABLE IF NOT EXISTS `MandateCommonOwnership` (
  `idMandateCommonOwnership` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateCommonOwnership`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateCommonOwnership`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateCondition`
--

CREATE TABLE IF NOT EXISTS `MandateCondition` (
  `idMandateCondition` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateCondition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateCondition`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateConstructionType`
--

CREATE TABLE IF NOT EXISTS `MandateConstructionType` (
  `idMandateConstructionType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateConstructionType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateConstructionType`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateCOS`
--

CREATE TABLE IF NOT EXISTS `MandateCOS` (
  `idMandateCOS` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateCOS`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateCOS`
--

INSERT INTO `MandateCOS` (`idMandateCOS`, `name`, `code`) VALUES
(1, 'cos', 'co');

-- --------------------------------------------------------

--
-- Structure de la table `MandateElectricCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateElectricCorresponding` (
  `idMandateElectricCorresponding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateElectricCorresponding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateElectricCorresponding`
--

INSERT INTO `MandateElectricCorresponding` (`idMandateElectricCorresponding`, `name`, `code`) VALUES
(1, 'M. bzzzzzz', 'b');

-- --------------------------------------------------------

--
-- Structure de la table `MandateEtap`
--

CREATE TABLE IF NOT EXISTS `MandateEtap` (
  `idMandateEtap` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateEtap`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `MandateEtap`
--

INSERT INTO `MandateEtap` (`idMandateEtap`, `name`, `code`) VALUES
(1, 'A vendre / A louer', 'list'),
(2, 'Compromis', 'list_comp'),
(3, 'Annul&eacute;', 'list_annul'),
(4, 'Vendu par l''agence', 'list_vendu_a'),
(5, 'Vendu par un tiers', 'list_vendu_t');

-- --------------------------------------------------------

--
-- Structure de la table `MandateGazCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateGazCorresponding` (
  `idMandateGazCorresponding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateGazCorresponding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateGazCorresponding`
--

INSERT INTO `MandateGazCorresponding` (`idMandateGazCorresponding`, `name`, `code`) VALUES
(1, 'M. butagaz', 'bla');

-- --------------------------------------------------------

--
-- Structure de la table `MandateGeometer`
--

CREATE TABLE IF NOT EXISTS `MandateGeometer` (
  `idMandateGeometer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateGeometer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateGeometer`
--

INSERT INTO `MandateGeometer` (`idMandateGeometer`, `name`, `code`) VALUES
(1, 'M. G&eacute;ographie', 'geo');

-- --------------------------------------------------------

--
-- Structure de la table `MandateHeating`
--

CREATE TABLE IF NOT EXISTS `MandateHeating` (
  `idMandateHeating` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateHeating`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateHeating`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateInsulation`
--

CREATE TABLE IF NOT EXISTS `MandateInsulation` (
  `idMandateInsulation` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateInsulation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateInsulation`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateNews`
--

CREATE TABLE IF NOT EXISTS `MandateNews` (
  `idMandateNews` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateNews`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateOrientation`
--

CREATE TABLE IF NOT EXISTS `MandateOrientation` (
  `idMandateOrientation` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateOrientation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateOrientation`
--

INSERT INTO `MandateOrientation` (`idMandateOrientation`, `name`, `code`) VALUES
(1, 'nord', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `MandatePicture`
--

CREATE TABLE IF NOT EXISTS `MandatePicture` (
  `idMandatePicture` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `fk_idMandate` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMandatePicture`),
  KEY `fk_idMandate` (`fk_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandatePicture`
--

INSERT INTO `MandatePicture` (`idMandatePicture`, `name`, `isDefault`, `fk_idMandate`) VALUES
(1, '1-1jpg', 1, 1),
(2, '1-2jpg', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `MandateRoof`
--

CREATE TABLE IF NOT EXISTS `MandateRoof` (
  `idMandateRoof` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateRoof`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateRoof`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateSanitationCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateSanitationCorresponding` (
  `idMandateSanitationCorresponding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateSanitationCorresponding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateSanitationCorresponding`
--

INSERT INTO `MandateSanitationCorresponding` (`idMandateSanitationCorresponding`, `name`, `code`) VALUES
(1, 'M. Wc', '');

-- --------------------------------------------------------

--
-- Structure de la table `MandateScan`
--

CREATE TABLE IF NOT EXISTS `MandateScan` (
  `idMandateScan` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `fk_idMandate` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMandateScan`),
  KEY `fk_idMandate` (`fk_idMandate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateScan`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateSlope`
--

CREATE TABLE IF NOT EXISTS `MandateSlope` (
  `idMandateSlope` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateSlope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateSlope`
--

INSERT INTO `MandateSlope` (`idMandateSlope`, `name`, `code`) VALUES
(1, '10%', '10%');

-- --------------------------------------------------------

--
-- Structure de la table `MandateStyle`
--

CREATE TABLE IF NOT EXISTS `MandateStyle` (
  `idMandateStyle` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateStyle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateStyle`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateType`
--

CREATE TABLE IF NOT EXISTS `MandateType` (
  `idMandateType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `exportCode` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateType`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `MandateType`
--

INSERT INTO `MandateType` (`idMandateType`, `name`, `exportCode`) VALUES
(1, 'Terrain', 'TE'),
(2, 'Appartement', 'AP'),
(3, 'Maison', 'MA'),
(4, 'Parking', 'PA');

-- --------------------------------------------------------

--
-- Structure de la table `MandateWaterCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateWaterCorresponding` (
  `idMandateWaterCorresponding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateWaterCorresponding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateWaterCorresponding`
--

INSERT INTO `MandateWaterCorresponding` (`idMandateWaterCorresponding`, `name`, `code`) VALUES
(1, 'M. Water', 'wa');

-- --------------------------------------------------------

--
-- Structure de la table `MandateZonagePLU`
--

CREATE TABLE IF NOT EXISTS `MandateZonagePLU` (
  `idMandateZonagePLU` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateZonagePLU`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateZonagePLU`
--

INSERT INTO `MandateZonagePLU` (`idMandateZonagePLU`, `name`, `code`) VALUES
(1, 'PLU', 'plu');

-- --------------------------------------------------------

--
-- Structure de la table `MandateZonageRNU`
--

CREATE TABLE IF NOT EXISTS `MandateZonageRNU` (
  `idMandateZonageRNU` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateZonageRNU`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateZonageRNU`
--

INSERT INTO `MandateZonageRNU` (`idMandateZonageRNU`, `name`, `code`) VALUES
(1, 'Rnu', 'rnu');

-- --------------------------------------------------------

--
-- Structure de la table `Mandate_Seller`
--

CREATE TABLE IF NOT EXISTS `Mandate_Seller` (
  `fk_idMandate` int(11) NOT NULL,
  `fk_idSeller` int(11) NOT NULL,
  `isDefault` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Mandate_Seller`
--

INSERT INTO `Mandate_Seller` (`fk_idMandate`, `fk_idSeller`, `isDefault`) VALUES
(2, 21, 1),
(1, 8, 1),
(3, 3, 1),
(1, 23, 0),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Notary`
--

CREATE TABLE IF NOT EXISTS `Notary` (
  `idNotary` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `fistname` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `zipCode` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `mobilPhone` varchar(250) NOT NULL,
  `jobPhone` varchar(250) NOT NULL,
  `fax` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  PRIMARY KEY (`idNotary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Notary`
--

INSERT INTO `Notary` (`idNotary`, `name`, `fistname`, `address`, `city`, `zipCode`, `phone`, `mobilPhone`, `jobPhone`, `fax`, `email`, `comments`, `numberUsed`) VALUES
(1, 'nom', 'prenom', '410 rue de l''arnaque', 'castres', '81000', '01.02.03.04.05', '06.06.06.06.06', '05.05.05.05.05', '0 315 315 315', 'notaire@notaire.fr', 'ffrdfdgdfg', 15);

-- --------------------------------------------------------

--
-- Structure de la table `Sector`
--

CREATE TABLE IF NOT EXISTS `Sector` (
  `idSector` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  PRIMARY KEY (`idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `Sector`
--

INSERT INTO `Sector` (`idSector`, `name`, `numberUsed`) VALUES
(7, 'Secteur La Ville Dieu Du Temple', 1),
(8, 'Secteur Auvillar', 0),
(6, 'Secteur Moissac', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Seller`
--

CREATE TABLE IF NOT EXISTS `Seller` (
  `idSeller` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobilPhone` varchar(15) NOT NULL,
  `workPhone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `asset` tinyint(1) NOT NULL DEFAULT '1',
  `city_idCity` int(11) NOT NULL,
  `sellerTitle_idSellerTitle` int(11) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idSeller`),
  KEY `city_idCity` (`city_idCity`),
  KEY `sellerTitle_idSellerTitle` (`sellerTitle_idSellerTitle`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `Seller`
--

INSERT INTO `Seller` (`idSeller`, `name`, `firstname`, `address`, `phone`, `mobilPhone`, `workPhone`, `fax`, `email`, `comments`, `asset`, `city_idCity`, `sellerTitle_idSellerTitle`, `user_idUser`) VALUES
(4, 'blaF', 'blagghj', '', '', '', '', '', '', '', 1, 1, 1, 23),
(2, 'dgdfg', '', '', '', '', '', '', '', '', 1, 1, 1, 1),
(3, 'Test', 'sqdqsd', 'blablabla', '01.02.03.04.05', '01.02.03.04.05', '01.02.03.04.05', '01.02.03.04.05', 'sdffsd@h.fr', 'sdffsdfsdfsdfsdfsdfq VZDQSF', 1, 1, 1, 1),
(10, 'XDXD', '', '', '', '', '', '', '', '', 1, 1, 1, 1),
(8, 'Le blanc', 'Just', 'impasse des pampres', '01.02.03.04.05', '06.02.03.04.05', '02.02.03.04.05', '03.04.05.06.07', 'sellSell@hotmail.com', 'Un vendeur\r\n', 1, 1, 1, 1),
(19, 'new', '', '', '', '', '', '', '', NULL, 1, 1, 1, 1),
(21, 'mon vendeur', 'lol', '', '05.02.03.04.05', '06.02.03.04.05', '05.02.03.04.05', '05.02.03.04.06', 'test@vendeur.fr', 'blablabla\r\n', 1, 1, 1, 23),
(22, 'dfgdfg', '', '', '', '', '', '', '', NULL, 1, 1, 1, 1),
(23, 'super un nouveau vendeur tout ', '', '', '', '', '', '', '', '', 1, 1, 1, 1),
(24, '2', '', '', '', '', '', '', '', '', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `SellerTitle`
--

CREATE TABLE IF NOT EXISTS `SellerTitle` (
  `idSellerTitle` int(11) NOT NULL AUTO_INCREMENT,
  `libel` varchar(20) NOT NULL,
  PRIMARY KEY (`idSellerTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `SellerTitle`
--

INSERT INTO `SellerTitle` (`idSellerTitle`, `libel`) VALUES
(1, 'un titre'),
(3, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `TransactionType`
--

CREATE TABLE IF NOT EXISTS `TransactionType` (
  `idTransactionType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `exportCode` varchar(250) NOT NULL,
  PRIMARY KEY (`idTransactionType`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `TransactionType`
--

INSERT INTO `TransactionType` (`idTransactionType`, `name`, `exportCode`) VALUES
(1, 'Location', 'LOC'),
(2, 'Vente', 'VEN');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `password` varchar(130) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `registration_date` datetime NOT NULL,
  `levelMember_idLevelMember` int(11) NOT NULL,
  `agency_idAgency` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `identifiant` (`identifiant`),
  KEY `levelMember_idLevelMember` (`levelMember_idLevelMember`),
  KEY `agency_idAgency` (`agency_idAgency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `identifiant`, `password`, `name`, `firstname`, `email`, `registration_date`, `levelMember_idLevelMember`, `agency_idAgency`) VALUES
(1, 'admin', 'e8bf8d080f763a4e8f70ca0761ccd3e4e5eb8907', 'Vernet', 'Julien', 'julien@localhost.fr', '2011-01-20 14:09:04', 1, 2),
(14, 'julien', '092c821bb39359452aa2c29105cfd780709aa79c', 'vernet', 'test', 'julien@legrain.fr', '2011-01-31 12:50:41', 3, 1),
(15, 'macg', '93b19c7abb067584faac2fd69d1d06a2386886b9', 'test', 'test', 'juju@tt.fr', '2011-01-31 12:51:50', 3, 1),
(19, 'test', '9d894615d40fe53e8dd7a4a9ac0a280ab2cbdcac', 'un test', '', 'julien@legrain.fr', '2011-01-31 13:05:05', 2, 2),
(20, 'date', 'b27b10be5197730dc28eef7ed2e737cc9fcff040', 'test', 'etee', 'ju@ju.fr', '2011-02-01 12:22:59', 3, 1),
(21, 'user', 'b4dd9ca8e0500322de6934467738a6cab5a0323d', 'test', 'test', 'julien@legrain.fr', '2011-02-04 08:57:05', 2, 1),
(22, 'aaa', 'cfb7696368fa17bf21bab90115b3ce14b8d9c742', 'test', 'test', 'aa@aa.fr', '2011-02-07 10:03:01', 1, 1),
(23, 'operateur', '2a73c66f49649154b0f9f93a05e726bdd17d8514', 'blabla', '', 'aa@aa.fr', '2011-02-07 12:38:01', 3, 1);
