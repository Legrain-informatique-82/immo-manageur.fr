-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 18 Mars 2011 à 14:38
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
-- Structure de la table `Action`
--

CREATE TABLE IF NOT EXISTS `Action` (
  `idAction` int(11) NOT NULL AUTO_INCREMENT,
  `libel` varchar(250) NOT NULL,
  `initDate` datetime NOT NULL,
  `deadDate` datetime DEFAULT NULL,
  `comment` text NOT NULL,
  `from_idUser` int(11) NOT NULL,
  `to_idUser` int(11) NOT NULL,
  `doDate` datetime DEFAULT NULL,
  `mandate_idMandate` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAction`),
  KEY `from_idUser` (`from_idUser`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `Action`
--

INSERT INTO `Action` (`idAction`, `libel`, `initDate`, `deadDate`, `comment`, `from_idUser`, `to_idUser`, `doDate`, `mandate_idMandate`) VALUES
(1, 'dd', '2011-03-13 11:18:07', '2011-03-26 00:00:00', 'un essais super cool &quot; lol '' Fj', 1, 23, '2011-03-11 11:41:40', NULL),
(2, 'dd', '2011-03-13 11:18:07', NULL, 'un essais super cool &quot; lol '' Fj', 1, 23, NULL, NULL),
(3, 'dd', '2011-03-13 11:18:07', NULL, 'un essais super cool &quot; lol '' Fj\r\n\r\n&lt;/textarea&gt;\r\n&lt;h1&gt;HACK !!!&lt;/h1&gt;\r\n&lt;script&gt;alert(''ee'')&lt;/script&gt;;', 1, 23, NULL, NULL),
(4, 'dd', '2011-03-13 11:18:07', NULL, 'un essais super cool &quot; lol '' Fj\r\n\r\n&lt;/textarea&gt;\r\n&lt;h1&gt;HACK !!!&lt;/h1&gt;\r\n&lt;script&gt;alert(''ee'')&lt;/script&gt;;', 1, 23, NULL, NULL),
(5, 'dd', '2011-03-20 00:00:00', '2011-03-24 00:00:00', 'lol', 1, 1, '2011-03-04 14:38:38', NULL),
(6, 'dd', '2011-03-20 00:00:00', '2011-03-24 00:00:00', 'lol', 1, 1, '2011-03-04 14:38:34', NULL),
(7, 'dd', '2011-03-25 00:00:00', NULL, '', 1, 23, '0000-00-00 00:00:00', NULL),
(8, 'dd', '2011-03-09 00:00:00', NULL, '', 1, 1, '2011-03-04 14:38:44', NULL),
(9, 'XDXD', '2011-03-02 00:00:00', '2011-03-27 00:00:00', '', 1, 1, '2011-03-04 14:38:51', NULL),
(10, 'XDXD', '2011-03-09 00:00:00', '2011-03-19 00:00:00', '', 1, 1, '2011-03-04 14:38:41', NULL),
(11, 'XDXD', '2011-03-09 00:00:00', '2011-03-19 00:00:00', '', 1, 1, '2011-03-04 13:41:30', 2),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam rhoncus tortor vitae neque accumsan tempor. Aliquam quis pretium turpis', '2011-03-23 14:51:00', NULL, 'a0f0bc95016c862498bbad29d1f4d9d4lol\r\n \r\n\r\nEt toile', 1, 1, '2011-03-04 13:47:32', NULL),
(13, 'essais 2', '2011-03-03 16:10:07', NULL, '', 1, 1, '2011-03-04 14:38:47', 3),
(14, 'lol2', '2011-03-04 14:45:58', '2011-03-13 14:46:02', 'un dÃ©tail &lt;/textarea&gt;&lt;h1&gt;LOLLLLLO&lt;/h1&gt;', 1, 1, '2011-03-09 10:22:16', 3),
(15, 'idiotBete', '2011-03-17 00:00:00', '1970-01-01 01:00:00', '<br/> Commentaires post action : terminÃ©', 1, 1, '2011-03-08 12:31:38', 2),
(16, 'une acti', '2011-03-07 00:00:00', '2011-03-14 00:00:00', 'lol<br/> Commentaires post action : fini', 1, 23, '2011-03-08 10:04:47', NULL),
(17, 'lol2', '2011-03-07 15:52:48', '2011-03-15 15:52:51', 'Rappeler les proprios dans la matinÃ©e\r\nlol<br/> Commentaires post action : lol2', 1, 1, '2011-03-08 12:31:01', 3),
(18, 'Rappel 05.63.01.01.01', '2011-03-08 16:48:06', '1970-01-01 01:00:00', 'Blablabla<br/> Commentaires post action : fin du bla bla !', 1, 1, '2011-03-07 16:57:07', 1),
(19, 'mmmm', '2011-03-08 00:00:00', NULL, '', 1, 1, '2011-03-09 10:22:14', 3),
(20, 'mmmm', '2011-03-08 12:41:53', '2011-03-08 15:41:56', 'URGENT !!!!!!', 1, 1, '2011-03-09 10:22:12', 3),
(21, 'lollol', '2011-03-09 10:34:40', NULL, '', 1, 1, NULL, 1),
(22, 'lol', '2011-03-11 00:00:00', NULL, '', 1, 31, '2011-03-11 11:42:17', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `City`
--

INSERT INTO `City` (`idCity`, `name`, `zipCode`, `numberUsed`, `sector_idSector`) VALUES
(1, 'LAFRANCAISE', '82130', 19, 1),
(3, 'MONTAUBAN', '82000', 2, 1),
(4, 'ss', '888', 0, 1),
(5, 'sss', '888', 0, 1),
(6, 'sdfsdf', '888', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Documents`
--

CREATE TABLE IF NOT EXISTS `Documents` (
  `idDocument` int(11) NOT NULL AUTO_INCREMENT,
  `sizetext` varchar(250) NOT NULL,
  `corps` text NOT NULL,
  `other` varchar(250) NOT NULL,
  PRIMARY KEY (`idDocument`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Documents`
--

INSERT INTO `Documents` (`idDocument`, `sizetext`, `corps`, `other`) VALUES
(1, '12', 'Cher MaÃ®tre,\n				\nNous avons le plaisir de vous adresser, ci-joint, photocopie de l''acte sous seing privÃ© de vente, ci-dessus rÃ©fÃ©rencÃ©, intervenu entre les parties contractantes.\n\nNous avons pris bonne note que vous assisteriez nos clients acquÃ©reurs, pour parvenir Ã  la rÃ©itÃ©ration de cette vente.\n\nEn restant Ã  votre entiÃ¨re disposition, nous vous prions de croire, Cher MaÃ®tre, en l''assurance de notre parfaite considÃ©ration.\n				', 'Le Responsable d''Agence'),
(2, '12', 'Cher MaÃ®tre,\r\n\r\nNous avons le plaisir de vous adresser, ci-joint, photocopie de l''acte sous seing privÃ© de vente, ci-dessus rÃ©fÃ©rencÃ©, intervenu entre les parties contractantes.\r\n\r\nNous avons pris bonne note que vous assisteriez nos clients vendeurs, pour parvenir Ã  la rÃ©itÃ©ration de cette vente.\r\n\r\nNous vous remercions de nous aviser du rendez-vous que vous aurez fixÃ© avec votre confrere.\r\n\r\nNous restons Ã  votre entiÃ¨re disposition,\r\n\r\nNous vous prions de croire, Cher MaÃ®tre, en l''assurance de notre parfaite considÃ©ration.\r\n					', 'Le Responsable d''Agence'),
(3, '12', 'Cher MaÃ®tre,\n					\nNous avons le plaisir de vous adresser, ci-joint, photocopie de l''acte sous seing privÃ© de vente, ci-dessus rÃ©fÃ©rencÃ©, intervenu entre les parties contractantes.\n\nNous avons pris bonne note que vous assisteriez nos clients acquÃ©reurs et vendeurs, pour parvenir Ã  la rÃ©itÃ©ration de cette vente.\n\nEn restant Ã  votre entiÃ¨re disposition, nous vous prions de croire, Cher MaÃ®tre, en l''assurance de notre parfaite considÃ©ration.\n					', 'Le Responsable d''Agence'),
(4, '12', '[titreVendeur] [nomVendeur] [prenomVendeur],\r\n					\r\nNous avons le plaisir de vous adresser sous ce pli :\r\n\r\n<b>- un exemplaire de l''Engagement des Parties,</b>\r\n\r\nRestant Ã  votre entiÃ¨re disposition pour tous renseignements complÃ©mentaires que vous voudrez bien nous demander,\r\n\r\nNous vous prions de croire, [titreVendeur] [nomVendeur] [prenomVendeur], en l''assurance de notre sincÃ¨re considÃ©ration.\r\n					', 'Le Directeur');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `HistoricConnection`
--

INSERT INTO `HistoricConnection` (`idHistoricConnection`, `dateConnection`, `ip`, `user_idUser`) VALUES
(1, '2011-03-14 14:03:42', '127.0.0.1', 1),
(2, '2011-03-15 08:37:47', '127.0.0.1', 1),
(3, '2011-03-15 08:52:01', '127.0.0.1', 23),
(4, '2011-03-15 08:52:17', '127.0.0.1', 1),
(5, '2011-03-15 12:46:06', '127.0.0.1', 1),
(6, '2011-03-15 14:10:01', '127.0.0.1', 1),
(7, '2011-03-16 08:25:23', '127.0.0.1', 1),
(8, '2011-03-16 09:23:16', '127.0.0.1', 1),
(9, '2011-03-16 11:39:23', '127.0.0.1', 1),
(10, '2011-03-16 14:18:55', '127.0.0.1', 1),
(11, '2011-03-16 14:34:26', '127.0.0.1', 1),
(12, '2011-03-16 14:40:40', '127.0.0.1', 1),
(13, '2011-03-16 15:57:35', '127.0.0.1', 1),
(14, '2011-03-17 08:20:40', '127.0.0.1', 1),
(15, '2011-03-17 09:12:08', '127.0.0.1', 1),
(16, '2011-03-17 12:30:00', '127.0.0.1', 1),
(17, '2011-03-17 12:48:58', '127.0.0.1', 1),
(18, '2011-03-17 13:40:06', '127.0.0.1', 1),
(19, '2011-03-17 16:03:51', '127.0.0.1', 1),
(20, '2011-03-17 16:09:10', '127.0.0.1', 1),
(21, '2011-03-18 09:40:23', '127.0.0.1', 1),
(22, '2011-03-18 09:57:23', '127.0.0.1', 1),
(23, '2011-03-18 10:35:31', '127.0.0.1', 1),
(24, '2011-03-18 11:39:42', '127.0.0.1', 1),
(25, '2011-03-18 12:15:06', '127.0.0.1', 1),
(26, '2011-03-18 12:35:31', '127.0.0.1', 1),
(27, '2011-03-18 14:07:42', '127.0.0.1', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=220 ;

--
-- Contenu de la table `Log`
--

INSERT INTO `Log` (`idLog`, `dateLog`, `pluginName`, `log`, `user_idUser`) VALUES
(1, '2011-02-25 11:28:47', 'notary', 'Ajout du notaire : teszt', 1),
(2, '2011-02-25 11:29:04', 'sector', ' Ajout du secteur : a+', 1),
(3, '2011-02-25 11:29:08', 'sector', 'Ajout de la ville : a', 1),
(4, '2011-02-25 11:31:11', 'seller', 'Creation du vendeur : Vendeur', 1),
(5, '2011-02-25 11:31:11', 'terrain', 'Ajout du terrain : 4', 1),
(6, '2011-02-25 11:31:11', 'terrain', 'nouvelle liaison terrain/vendeur principal : 4/Vendeur', 1),
(7, '2011-02-25 11:33:31', 'seller', 'Creation du vendeur : Vendeur2', 1),
(8, '2011-02-25 11:33:31', 'terrain', 'Ajout du terrain : 4', 1),
(9, '2011-02-25 11:33:31', 'terrain', 'nouvelle liaison terrain/vendeur principal : 4/Vendeur2', 1),
(10, '2011-02-25 12:20:13', 'terrain', 'Ajout du terrain : 9', 1),
(11, '2011-02-25 12:20:13', 'terrain', 'nouvelle liaison terrain/vendeur principal : 9/Vendeur', 1),
(12, '2011-02-25 12:21:28', 'terrain', 'Modification des infos gÃ©nÃ©rale du mandat : 99', 1),
(13, '2011-02-25 14:36:48', 'terrain', 'Ajout d''un plan pour le mandat : 9', 1),
(14, '2011-02-25 14:37:23', 'terrain', 'Ajout d''un plan pour le mandat : 9', 1),
(15, '2011-02-25 14:39:07', 'terrain', 'Ajout d''une image pour le mandat : 9', 1),
(16, '2011-02-25 14:39:13', 'terrain', 'Suppression du plan pour le terrain : 9', 1),
(17, '2011-02-25 14:39:25', 'terrain', 'Suppression du plan pour le terrain : 9', 1),
(18, '2011-02-25 14:39:41', 'terrain', 'Ajout d''un plan pour le mandat : 9', 1),
(19, '2011-02-25 14:40:14', 'terrain', 'Suppression du plan pour le terrain : 9', 1),
(20, '2011-02-25 14:40:35', 'terrain', 'Ajout d''un plan pour le mandat : 9', 1),
(21, '2011-03-02 10:33:06', 'terrain', 'Ajout/Modification des informations complementaires du terrain 9', 1),
(22, '2011-03-02 10:34:19', 'terrain', 'Ajout/Modification des informations complementaires du terrain 9', 1),
(23, '2011-03-03 11:32:36', 'action', 'Ajout d''une action de Vernet pour un test', 1),
(24, '2011-03-03 11:42:07', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(25, '2011-03-03 11:42:29', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(26, '2011-03-03 11:42:41', 'action', 'Ajout d''une action de Vernet pour test', 1),
(27, '2011-03-03 11:43:40', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(28, '2011-03-03 11:43:56', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(29, '2011-03-03 11:44:08', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(30, '2011-03-03 11:45:47', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(31, '2011-03-03 14:45:49', 'action', 'accÃ¨s non autorisÃ©', 1),
(32, '2011-03-03 15:33:34', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(33, '2011-03-03 16:10:09', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(34, '2011-03-03 16:27:51', 'action', 'accÃ¨s non autorisÃ©', 1),
(35, '2011-03-03 16:29:08', 'terrain', 'Ajout/Modification des informations complementaires du terrain 9', 1),
(36, '2011-03-04 11:14:56', 'action', 'accÃ¨s non autorisÃ©', 1),
(37, '2011-03-04 11:14:59', 'action', 'accÃ¨s non autorisÃ©', 1),
(38, '2011-03-04 13:41:30', 'action', 'Action : "XDXD" effectuÃ©e.', 1),
(39, '2011-03-04 13:42:48', 'action', 'Action : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam rhoncus tortor vitae neque accumsan tempor. Aliquam quis pretium turpis" effectuÃ©e.', 1),
(40, '2011-03-04 13:44:20', 'action', 'Action : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam rhoncus tortor vitae neque accumsan tempor. Aliquam quis pretium turpis" effectuÃ©e.', 1),
(41, '2011-03-04 13:47:32', 'action', 'Action : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam rhoncus tortor vitae neque accumsan tempor. Aliquam quis pretium turpis" effectuÃ©e.', 1),
(42, '2011-03-04 14:38:34', 'action', 'Action : "dd" effectuÃ©e.', 1),
(43, '2011-03-04 14:38:38', 'action', 'Action : "dd" effectuÃ©e.', 1),
(44, '2011-03-04 14:38:41', 'action', 'Action : "XDXD" effectuÃ©e.', 1),
(45, '2011-03-04 14:38:44', 'action', 'Action : "dd" effectuÃ©e.', 1),
(46, '2011-03-04 14:38:47', 'action', 'Action : "essais 2" effectuÃ©e.', 1),
(47, '2011-03-04 14:38:51', 'action', 'Action : "XDXD" effectuÃ©e.', 1),
(48, '2011-03-04 14:46:04', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(49, '2011-03-04 14:52:52', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(50, '2011-03-07 10:55:40', 'action', 'accÃ¨s non autorisÃ©', 1),
(51, '2011-03-07 10:55:52', 'action', 'accÃ¨s non autorisÃ©', 1),
(52, '2011-03-07 11:16:14', 'user', 'Mise Ã  jour du membre : operateur', 1),
(53, '2011-03-07 11:16:24', 'user', 'Mise Ã  jour du membre : test', 1),
(54, '2011-03-07 11:16:40', 'user', 'Mise Ã  jour du membre : administrateur', 1),
(55, '2011-03-07 11:17:04', 'action', 'Ajout d''une action de Vernet pour OpÃ©rateur', 1),
(56, '2011-03-07 11:41:20', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(57, '2011-03-07 11:41:56', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(58, '2011-03-07 11:47:30', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(59, '2011-03-07 15:53:11', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(60, '2011-03-07 16:42:39', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(61, '2011-03-07 16:42:44', 'accueil', 'accÃ¨s non autorisÃ©', 1),
(62, '2011-03-07 16:48:10', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(63, '2011-03-07 16:56:55', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(64, '2011-03-07 16:57:07', 'action', 'Action : "Rappel 05.63.01.01.01" effectuÃ©e.', 1),
(65, '2011-03-08 09:12:13', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(66, '2011-03-08 09:13:26', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(67, '2011-03-08 09:13:28', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(68, '2011-03-08 09:13:30', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(69, '2011-03-08 09:36:42', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(70, '2011-03-08 09:36:53', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(71, '2011-03-08 09:36:55', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(72, '2011-03-08 09:36:56', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(73, '2011-03-08 09:36:57', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(74, '2011-03-08 09:37:34', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(75, '2011-03-08 09:41:58', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(76, '2011-03-08 09:51:43', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(77, '2011-03-08 09:51:54', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(78, '2011-03-08 09:51:56', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(79, '2011-03-08 09:58:49', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(80, '2011-03-08 10:00:35', 'action', 'Modification d''une action de Vernet pour OpÃ©rateur', 1),
(81, '2011-03-08 10:02:30', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(82, '2011-03-08 10:02:37', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(83, '2011-03-08 10:03:08', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(84, '2011-03-08 10:03:41', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(85, '2011-03-08 10:04:02', 'action', 'Modification d''une action de Vernet pour OpÃ©rateur', 1),
(86, '2011-03-08 10:04:43', 'action', 'Modification d''une action de Vernet pour OpÃ©rateur', 1),
(87, '2011-03-08 10:04:47', 'action', 'Action : "une acti" effectuÃ©e.', 1),
(88, '2011-03-08 10:05:37', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(89, '2011-03-08 10:05:44', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(90, '2011-03-08 10:05:46', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(91, '2011-03-08 10:05:47', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(92, '2011-03-08 10:05:58', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(93, '2011-03-08 10:06:12', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(94, '2011-03-08 10:06:14', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(95, '2011-03-08 10:13:47', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(96, '2011-03-08 10:13:49', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(97, '2011-03-08 10:13:51', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(98, '2011-03-08 10:13:52', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(99, '2011-03-08 10:14:15', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(100, '2011-03-08 10:14:23', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(101, '2011-03-08 10:14:24', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(102, '2011-03-08 10:14:27', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(103, '2011-03-08 10:14:28', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(104, '2011-03-08 10:16:31', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(105, '2011-03-08 11:29:09', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(106, '2011-03-08 12:19:41', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(107, '2011-03-08 12:19:44', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(108, '2011-03-08 12:19:47', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(109, '2011-03-08 12:20:00', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(110, '2011-03-08 12:20:02', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(111, '2011-03-08 12:20:04', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(112, '2011-03-08 12:20:06', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(113, '2011-03-08 12:20:40', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(114, '2011-03-08 12:29:20', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(115, '2011-03-08 12:29:27', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(116, '2011-03-08 12:29:30', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(117, '2011-03-08 12:29:33', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(118, '2011-03-08 12:30:56', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(119, '2011-03-08 12:31:01', 'action', 'Action : "lol2" effectuÃ©e.', 1),
(120, '2011-03-08 12:31:28', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(121, '2011-03-08 12:31:32', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(122, '2011-03-08 12:31:38', 'action', 'Action : "idiotBete" effectuÃ©e.', 1),
(123, '2011-03-08 12:31:49', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(124, '2011-03-08 12:42:10', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(125, '2011-03-09 10:22:12', 'action', 'Action : "mmmm" effectuÃ©e.', 1),
(126, '2011-03-09 10:22:14', 'action', 'Action : "mmmm" effectuÃ©e.', 1),
(127, '2011-03-09 10:22:16', 'action', 'Action : "lol2" effectuÃ©e.', 1),
(128, '2011-03-09 10:34:43', 'action', 'Ajout d''une action de Vernet pour Vernet', 1),
(129, '2011-03-09 10:37:10', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(130, '2011-03-09 10:38:48', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(131, '2011-03-09 10:39:14', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(132, '2011-03-09 10:42:21', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(133, '2011-03-09 10:43:06', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(134, '2011-03-09 10:43:08', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(135, '2011-03-09 10:43:31', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(136, '2011-03-09 10:43:39', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(137, '2011-03-09 10:43:40', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(138, '2011-03-09 10:44:35', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(139, '2011-03-09 10:45:10', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(140, '2011-03-09 10:45:12', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(141, '2011-03-09 10:53:22', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(142, '2011-03-09 10:53:27', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(143, '2011-03-09 10:54:38', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(144, '2011-03-09 10:55:35', 'action', 'Modification d''une action de Vernet pour Vernet', 1),
(145, '2011-03-10 11:30:10', 'seller', 'Creation du vendeur : plouc', 1),
(146, '2011-03-10 11:30:10', 'terrain', 'Ajout du terrain : 666', 1),
(147, '2011-03-10 11:30:10', 'terrain', 'nouvelle liaison terrain/vendeur principal : 666/plouc', 1),
(148, '2011-03-11 10:27:05', 'user', 'Ajout d''un nouvel utilisateur : del', 1),
(149, '2011-03-11 11:04:48', 'user', 'Ajout d''un nouvel utilisateur : del', 1),
(150, '2011-03-11 11:04:53', 'user', 'Suppression de : del', 1),
(151, '2011-03-11 11:05:31', 'user', 'Ajout d''un nouvel utilisateur : del', 1),
(152, '2011-03-11 11:05:35', 'user', 'Suppression de : del', 1),
(153, '2011-03-11 11:10:10', 'user', 'Ajout d''un nouvel utilisateur : del', 1),
(154, '2011-03-11 11:24:40', 'user', 'Suppression de : del', 1),
(155, '2011-03-11 11:24:44', 'user', 'Suppression de : administrateur', 1),
(156, '2011-03-11 11:24:52', 'user', 'Suppression de : date', 1),
(157, '2011-03-11 11:25:27', 'seller', 'Creation du vendeur : lol', 1),
(158, '2011-03-11 11:25:27', 'terrain', 'Ajout du terrain : 1', 1),
(159, '2011-03-11 11:25:27', 'terrain', 'nouvelle liaison terrain/vendeur principal : 1/lol', 1),
(160, '2011-03-11 11:41:09', 'user', 'Ajout d''un nouvel utilisateur : del', 1),
(161, '2011-03-11 11:41:21', 'action', 'Ajout d''une action de Vernet pour del', 1),
(162, '2011-03-11 11:41:40', 'action', 'Action : "dd" effectuÃ©e.', 1),
(163, '2011-03-11 11:42:17', 'action', 'Action : "lol" effectuÃ©e.', 1),
(164, '2011-03-11 12:16:56', 'user', 'Ajout d''un nouvel utilisateur : del2', 1),
(165, '2011-03-11 12:17:02', 'user', 'Suppression de : del2', 1),
(166, '2011-03-11 15:07:24', 'seller', 'Ajout du titre de vendeur : del', 1),
(167, '2011-03-11 15:11:49', 'seller', 'Ajout du titre de vendeur : XD', 1),
(168, '2011-03-11 15:15:51', 'seller', 'Ajout du titre de vendeur : mua', 1),
(169, '2011-03-11 15:16:09', 'seller', 'Suppression du titre du vendeur : mua', 1),
(170, '2011-03-14 09:15:27', 'seller', 'Suppression du  du vendeur : del', 1),
(171, '2011-03-14 09:23:06', 'notary', 'Ajout du notaire : del', 1),
(172, '2011-03-14 09:23:11', 'notary', 'Suppression du  du notaire : del', 1),
(173, '2011-03-14 09:23:27', 'sector', ' Ajout du secteur : del', 1),
(174, '2011-03-14 09:27:05', 'sector', 'Suppression du secteur : del', 1),
(175, '2011-03-14 09:30:11', 'sector', 'Ajout de la ville : del', 1),
(176, '2011-03-14 09:30:18', 'sector', 'Suppression de la ville : del', 1),
(177, '2011-03-14 09:44:29', 'terrain', 'Ajout du terrain : 99', 1),
(178, '2011-03-14 09:44:29', 'terrain', 'nouvelle liaison terrain/vendeur principal : 99/zÃ©', 1),
(179, '2011-03-14 10:23:47', 'terrain', 'Reaffection du mandat', 1),
(180, '2011-03-14 10:25:53', 'terrain', 'Reaffection du mandat', 1),
(181, '2011-03-14 10:26:06', 'terrain', 'Annulation du mandat', 1),
(182, '2011-03-14 10:26:17', 'terrain', 'Reaffection du mandat', 1),
(183, '2011-03-14 10:27:36', 'terrain', 'Annulation du mandat', 1),
(184, '2011-03-14 10:28:36', 'terrain', 'Reaffection du mandat', 1),
(185, '2011-03-14 11:55:25', 'seller', 'Mise Ã  jour du vendeur : zÃ©', 1),
(186, '2011-03-14 12:30:52', 'seller', 'Suppression du  du vendeur : inactif', 1),
(187, '2011-03-15 08:54:25', 'user', 'accÃ¨s non autorisÃ©', 1),
(188, '2011-03-15 09:36:20', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(189, '2011-03-15 09:46:51', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(190, '2011-03-15 10:33:08', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(191, '2011-03-15 10:33:09', 'terrain', 'accÃ¨s non autorisÃ©', 1),
(192, '2011-03-15 11:10:34', 'sector', ' modification de la ville : LAFRANCAISE', 1),
(193, '2011-03-15 11:43:15', 'terrain', 'Ajout/Modification des informations complementaires du terrain 99', 1),
(194, '2011-03-15 11:43:24', 'terrain', 'Modification des infos gÃ©nÃ©rale du mandat : 99', 1),
(195, '2011-03-15 15:29:36', 'terrain', 'Ajout d''une image pour le mandat : 99', 1),
(196, '2011-03-15 16:18:58', 'terrain', 'Ajout du terrain : 999', 1),
(197, '2011-03-15 16:18:58', 'terrain', 'nouvelle liaison terrain/vendeur principal : 999/inac', 1),
(198, '2011-03-15 16:19:05', 'terrain', 'Ajout/Modification des informations complementaires du terrain 999', 1),
(199, '2011-03-15 16:19:32', 'terrain', 'Ajout/Modification des informations complementaires du terrain 999', 1),
(200, '2011-03-15 16:19:43', 'terrain', 'Ajout d''une image pour le mandat : 999', 1),
(201, '2011-03-15 16:20:51', 'sector', ' modification de la ville : MONTAUBAN', 1),
(202, '2011-03-15 16:21:05', 'terrain', 'Modification des infos gÃ©nÃ©rale du mandat : 999', 1),
(203, '2011-03-15 16:25:14', 'sector', 'Ajout de la ville : sss', 1),
(204, '2011-03-15 16:27:09', 'sector', 'Ajout de la ville : sdfsdf', 1),
(205, '2011-03-15 16:27:55', 'terrain', 'Ajout/Modification des informations complementaires du terrain 999', 1),
(206, '2011-03-15 16:58:41', 'terrain', 'Suppression d''une image pour le terrain : 99', 1),
(207, '2011-03-15 16:59:03', 'terrain', 'Ajout d''une image pour le mandat : 99', 1),
(208, '2011-03-15 17:00:12', 'terrain', 'Suppression d''une image pour le terrain : 999', 1),
(209, '2011-03-16 09:27:15', 'terrain', 'Annulation du mandat', 1),
(210, '2011-03-16 09:27:21', 'terrain', 'Reaffection du mandat', 1),
(211, '2011-03-16 16:20:13', 'terrain', 'Modification des infos gÃ©nÃ©rale du mandat : 99', 1),
(212, '2011-03-16 16:20:31', 'sector', ' modification de la ville : LAFRANCAISE', 1),
(213, '2011-03-17 09:15:10', 'notary', 'Modification du notaire Mo', 1),
(214, '2011-03-17 09:26:10', 'notary', 'Modification du notaire Mo', 1),
(215, '2011-03-17 09:26:19', 'notary', 'Modification du notaire Mo', 1),
(216, '2011-03-17 12:39:47', 'terrain', 'Modification des infos gÃ©nÃ©rale du mandat : 99', 1),
(217, '2011-03-18 13:03:31', 'seller', 'Mise Ã  jour du vendeur : zÃ©', 1),
(218, '2011-03-18 13:04:09', 'seller', 'Mise Ã  jour du vendeur : zÃ©', 1),
(219, '2011-03-18 13:09:10', 'seller', 'Mise Ã  jour du vendeur : zÃ©', 1);

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
  `superficieNonConstructible` int(11) NOT NULL,
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
  `dateCU` date DEFAULT NULL,
  `prorogationCUJusquau` date DEFAULT NULL,
  `cuOPSValide` tinyint(1) NOT NULL DEFAULT '0',
  `dateCuOPS` date DEFAULT NULL,
  `prorogationCuOPSJusquau` date DEFAULT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Mandate`
--

INSERT INTO `Mandate` (`idMandate`, `numberMandate`, `initDate`, `deadDate`, `freeDate`, `address`, `priceFai`, `priceSeller`, `commission`, `estimationFai`, `margeNegociation`, `referenceCadastreParcelle1`, `referenceCadastreParcelle2`, `referenceCadastreParcelle3`, `autreReferenceParcelle`, `superficieParcelle1`, `superficieParcelle2`, `superficieParcelle3`, `superficieAutreParcelle`, `superficieConstructible`, `superficieNonConstructible`, `superficieTotale`, `numberLot`, `sHONAccordee`, `zoneBDF`, `ligneDeCrete`, `zoneInondable`, `reglementDeLotissement`, `eRNT`, `dPValide`, `dateDeclarationPrealable`, `prorogationDPJusquau`, `cuValide`, `dateCU`, `prorogationCUJusquau`, `cuOPSValide`, `dateCuOPS`, `prorogationCuOPSJusquau`, `permisDamenagerValide`, `datePermisDamenager`, `terrainVenduViabilise`, `terrainVenduSemiViabilise`, `terrainVenduNonViabilise`, `passageEau`, `passageElectricite`, `passageGaz`, `toutALegout`, `assainissementParFosseSceptique`, `voirie`, `tailleFacade`, `profondeurTerrain`, `commentaire`, `geolocalisation`, `proximiteEcole`, `proximiteCommerce`, `proximiteTransport`, `commentaireApparent`, `nbPiece`, `surfaceHabitable`, `nbChambre`, `surfacePieceVie`, `niveau`, `anneeConstruction`, `coupCoeur`, `chargesMensuelle`, `taxesFonciere`, `taxeHabitation`, `nouveaute`, `cheminee`, `cuisineEquipee`, `cuisineAmenagee`, `piscine`, `poolHouse`, `terrasse`, `mezzanine`, `dependance`, `gaz`, `cave`, `sousSol`, `garage`, `parking`, `rezDeJardin`, `plainPied`, `carriere`, `pointEau`, `user_idUser`, `sector_idSector`, `city_idCity`, `notary_idNotary`, `mandateType_idMandateType`, `transactionType_idTransactionType`, `slope_idMandateSlope`, `orientation_idMandateOrientation`, `insulation_idMandateInsulation`, `news_idMandateNews`, `heating_idMandateHeating`, `commonOwnership_idMandateCommonOwnership`, `roof_idMandateRoof`, `condition_idMandateCondition`, `style_idMandateStyle`, `construction_idMandateConstructionType`, `sanitationCorresponding_idMandateSanitationCorresponding`, `electricCorresponding_idMandateElectricCorresponding`, `gazCorresponding_idMandateGazCorresponding`, `waterCorresponding_idMandateWaterCorresponding`, `cos_idMandateCOS`, `zonagePLU_idMandateZonagePLU`, `zonageRNU_idMandateZonageRNU`, `bornageTerrain_idMandateBornageTerrain`, `geometer_idMandateGeometer`, `etap_idMandateEtap`) VALUES
(1, 99, '2011-03-14', '2011-04-24', NULL, '310 rue de la lavande', '58700.00', '999999.00', '-941299.00', '999999.00', '999.00', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 'Ferme Ã  restaurer entiÃ¨rement avec un trÃ¨s beau potentiel situÃ©e au calme sur un terrain de 6000mÂ² environ. A voir rapidement !!!', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1970-01-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 999, '2011-03-15', '2011-03-26', NULL, 'asdfsdefsd', '888888888.00', '88888.00', '888800000.00', '888888.00', '8888.00', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', 0, '1970-01-01', 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '1,4', 0, 0, 0, 'Super terrain pas cher offre Ã  saisir !!!!!!!\r\n\r\n#OMFG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1970-01-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 3, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `MandateBornageTerrain`
--

CREATE TABLE IF NOT EXISTS `MandateBornageTerrain` (
  `idMandateBornageTerrain` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateBornageTerrain`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `MandateBornageTerrain`
--

INSERT INTO `MandateBornageTerrain` (`idMandateBornageTerrain`, `name`, `code`) VALUES
(1, 'bornage', 'bo'),
(2, 'borne', 'b');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateCOS`
--

INSERT INTO `MandateCOS` (`idMandateCOS`, `name`, `code`) VALUES
(1, 'cos', 'co'),
(2, 'cos2', 'c');

-- --------------------------------------------------------

--
-- Structure de la table `MandateElectricCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateElectricCorresponding` (
  `idMandateElectricCorresponding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateElectricCorresponding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateElectricCorresponding`
--

INSERT INTO `MandateElectricCorresponding` (`idMandateElectricCorresponding`, `name`, `code`) VALUES
(1, 'M. bzzzzzz', 'bss'),
(2, 'bzz bzz', 'bz');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateGazCorresponding`
--

INSERT INTO `MandateGazCorresponding` (`idMandateGazCorresponding`, `name`, `code`) VALUES
(1, 'M. butagaz', 'blak'),
(2, 'butagaz', 'but');

-- --------------------------------------------------------

--
-- Structure de la table `MandateGeometer`
--

CREATE TABLE IF NOT EXISTS `MandateGeometer` (
  `idMandateGeometer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateGeometer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateGeometer`
--

INSERT INTO `MandateGeometer` (`idMandateGeometer`, `name`, `code`) VALUES
(1, 'M. G&eacute;ographie', 'geo'),
(2, 'geoT', 'gT');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `MandateOrientation`
--

INSERT INTO `MandateOrientation` (`idMandateOrientation`, `name`, `code`) VALUES
(1, 'Nord', 'N'),
(2, 'Est', 'E'),
(3, 'Sud', 'S'),
(4, 'Ouest', 'O'),
(5, 'Nord-Est', 'NE'),
(6, 'Nord-Ouest', 'NO'),
(7, 'Sud-Est', 'SE'),
(8, 'Sud-Ouest', 'SO');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `MandatePicture`
--

INSERT INTO `MandatePicture` (`idMandatePicture`, `name`, `isDefault`, `fk_idMandate`) VALUES
(3, '1-3jpg', 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `MandateSanitationCorresponding`
--

INSERT INTO `MandateSanitationCorresponding` (`idMandateSanitationCorresponding`, `name`, `code`) VALUES
(1, 'M. Wc', 'w'),
(2, 'wa', 'a'),
(3, 'yy', 'y');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `MandateScan`
--

INSERT INTO `MandateScan` (`idMandateScan`, `name`, `code`, `fk_idMandate`) VALUES
(4, 'plan-3-4jpg', '495.55 Ko', 3);

-- --------------------------------------------------------

--
-- Structure de la table `MandateSlope`
--

CREATE TABLE IF NOT EXISTS `MandateSlope` (
  `idMandateSlope` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateSlope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateSlope`
--

INSERT INTO `MandateSlope` (`idMandateSlope`, `name`, `code`) VALUES
(1, '10%', '10%'),
(2, '5%', '5%');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateWaterCorresponding`
--

INSERT INTO `MandateWaterCorresponding` (`idMandateWaterCorresponding`, `name`, `code`) VALUES
(1, 'M. Water', 'wa'),
(2, 'plouf ', 'plu');

-- --------------------------------------------------------

--
-- Structure de la table `MandateZonagePLU`
--

CREATE TABLE IF NOT EXISTS `MandateZonagePLU` (
  `idMandateZonagePLU` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateZonagePLU`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateZonagePLU`
--

INSERT INTO `MandateZonagePLU` (`idMandateZonagePLU`, `name`, `code`) VALUES
(1, 'PLU', 'plu'),
(2, 'plus', 'plp');

-- --------------------------------------------------------

--
-- Structure de la table `MandateZonageRNU`
--

CREATE TABLE IF NOT EXISTS `MandateZonageRNU` (
  `idMandateZonageRNU` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`idMandateZonageRNU`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `MandateZonageRNU`
--

INSERT INTO `MandateZonageRNU` (`idMandateZonageRNU`, `name`, `code`) VALUES
(1, 'Rnu', 'rnu'),
(2, 'Rnus', 'rns');

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
(1, 1, 1),
(2, 2, 1),
(3, 1, 1),
(4, 3, 1),
(5, 4, 1),
(1, 6, 1),
(2, 10, 1);

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
(1, 'Mo', 'jean', '12 rue du tord', 'MOISSAC', '82000', '', '', '', '', '', '', 7);

-- --------------------------------------------------------

--
-- Structure de la table `Sector`
--

CREATE TABLE IF NOT EXISTS `Sector` (
  `idSector` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  PRIMARY KEY (`idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Sector`
--

INSERT INTO `Sector` (`idSector`, `name`, `numberUsed`) VALUES
(1, 'a+', 7);

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
  `numberUsed` int(11) NOT NULL,
  `city_idCity` int(11) NOT NULL,
  `sellerTitle_idSellerTitle` int(11) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idSeller`),
  KEY `city_idCity` (`city_idCity`),
  KEY `sellerTitle_idSellerTitle` (`sellerTitle_idSellerTitle`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `Seller`
--

INSERT INTO `Seller` (`idSeller`, `name`, `firstname`, `address`, `phone`, `mobilPhone`, `workPhone`, `fax`, `email`, `comments`, `asset`, `numberUsed`, `city_idCity`, `sellerTitle_idSellerTitle`, `user_idUser`) VALUES
(10, 'inac', '', '', '', '', '', '', '', '', 0, 1, 1, 4, 1),
(6, 'zÃ©', '', 'blablabla', '01', '02', '03', 'fax', 'mail@mail.fr', '', 1, 1, 3, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `SellerTitle`
--

CREATE TABLE IF NOT EXISTS `SellerTitle` (
  `idSellerTitle` int(11) NOT NULL AUTO_INCREMENT,
  `libel` varchar(20) NOT NULL,
  PRIMARY KEY (`idSellerTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `SellerTitle`
--

INSERT INTO `SellerTitle` (`idSellerTitle`, `libel`) VALUES
(1, 'Madame'),
(4, 'SociÃ©tÃ©');

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
  `numberUsed` int(11) NOT NULL DEFAULT '0',
  `levelMember_idLevelMember` int(11) NOT NULL,
  `agency_idAgency` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `identifiant` (`identifiant`),
  KEY `levelMember_idLevelMember` (`levelMember_idLevelMember`),
  KEY `agency_idAgency` (`agency_idAgency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `identifiant`, `password`, `name`, `firstname`, `email`, `registration_date`, `numberUsed`, `levelMember_idLevelMember`, `agency_idAgency`) VALUES
(1, 'admin', 'e8bf8d080f763a4e8f70ca0761ccd3e4e5eb8907', 'Vernet', 'Julien', 'julien@localhost.fr', '2011-01-20 14:09:04', 1, 1, 2),
(31, 'del', '87378d7a423ab539985cc6d690e4a311d351beaa', 'del', '', 'del@del.fr', '2011-03-11 11:41:09', 1, 1, 1),
(23, 'operateur', '2a73c66f49649154b0f9f93a05e726bdd17d8514', 'OpÃ©rateur', '', 'aa@aa.fr', '2011-02-07 12:38:01', 1, 3, 1);
