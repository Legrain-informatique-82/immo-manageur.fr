-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Serveur: localhost:3306
-- Généré le : Ven 15 Avril 2011 à 09:43
-- Version du serveur: 5.0.77
-- Version de PHP: 5.2.6

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
-- Structure de la table `Acquereur`
--

CREATE TABLE IF NOT EXISTS `Acquereur` (
  `idAcquereur` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `mobilPhone` varchar(250) NOT NULL,
  `workPhone` varchar(250) NOT NULL,
  `fax` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL default '0',
  `priceMin` int(11) NOT NULL,
  `priceMax` int(11) NOT NULL,
  `surfaceTerrainMin` int(11) NOT NULL,
  `surfaceTerrainMax` int(11) NOT NULL,
  `surfaceHabitableMin` int(11) NOT NULL,
  `surfaceHabitableMax` int(11) NOT NULL,
  `villeAcquereur` int(11) NOT NULL,
  `titreAcquereur_idTitreAcquereur` int(11) NOT NULL,
  `transactionType_idTransactionType` int(11) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  `mandateStyle_idMandateStyle` int(11) default NULL,
  `rechercheCity_idCity` int(11) default NULL,
  `rechercheSector_idSector` int(11) default NULL,
  `mandateType_idMandateType` int(11) default NULL,
  PRIMARY KEY  (`idAcquereur`),
  KEY `villeAcquereur` (`villeAcquereur`),
  KEY `titreAcquereur_idTitreAcquereur` (`titreAcquereur_idTitreAcquereur`),
  KEY `transactionType_idTransactionType` (`transactionType_idTransactionType`),
  KEY `mandateStyle_idMandateStyle` (`mandateStyle_idMandateStyle`),
  KEY `rechercheCity_idCity` (`rechercheCity_idCity`),
  KEY `rechercheSector_idSector` (`rechercheSector_idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Acquereur`
--

INSERT INTO `Acquereur` (`idAcquereur`, `name`, `firstname`, `address`, `phone`, `mobilPhone`, `workPhone`, `fax`, `email`, `numberUsed`, `actif`, `priceMin`, `priceMax`, `surfaceTerrainMin`, `surfaceTerrainMax`, `surfaceHabitableMin`, `surfaceHabitableMax`, `villeAcquereur`, `titreAcquereur_idTitreAcquereur`, `transactionType_idTransactionType`, `user_idUser`, `mandateStyle_idMandateStyle`, `rechercheCity_idCity`, `rechercheSector_idSector`, `mandateType_idMandateType`) VALUES
(1, 'Achat', '', '', '01 02 03 04 05', '', '', '', '', 1, 0, 0, 90000, 1000, 0, 0, 0, 1, 1, 2, 1, NULL, 1, NULL, 1),
(2, 'lafon', 'alexandre', '', '', '', '', '', '', 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 2, 1, NULL, NULL, NULL, 3),
(3, 'a', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 1, NULL, NULL, NULL, 1),
(4, 'b', '', '', '', '', '', '', '', 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 2, 1, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Action`
--

CREATE TABLE IF NOT EXISTS `Action` (
  `idAction` int(11) NOT NULL auto_increment,
  `libel` varchar(250) NOT NULL,
  `initDate` datetime NOT NULL,
  `deadDate` datetime default NULL,
  `comment` text NOT NULL,
  `from_idUser` int(11) NOT NULL,
  `to_idUser` int(11) NOT NULL,
  `doDate` datetime default NULL,
  `mandate_idMandate` int(11) default NULL,
  PRIMARY KEY  (`idAction`),
  KEY `from_idUser` (`from_idUser`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Action`
--

INSERT INTO `Action` (`idAction`, `libel`, `initDate`, `deadDate`, `comment`, `from_idUser`, `to_idUser`, `doDate`, `mandate_idMandate`) VALUES
(1, 'ghsddhdqs', '2011-04-05 09:00:00', NULL, '', 33, 33, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Agency`
--

CREATE TABLE IF NOT EXISTS `Agency` (
  `idAgency` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`idAgency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Agency`
--

INSERT INTO `Agency` (`idAgency`, `name`) VALUES
(1, 'Auvillar'),
(2, 'Moissac'),
(3, 'La ville Dieu du Temple'),
(4, 'Montauban');

-- --------------------------------------------------------

--
-- Structure de la table `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `idCity` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  `sector_idSector` int(11) NOT NULL,
  PRIMARY KEY  (`idCity`),
  KEY `sector_idSector` (`sector_idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `City`
--

INSERT INTO `City` (`idCity`, `name`, `zipCode`, `numberUsed`, `sector_idSector`) VALUES
(1, 'MOISSAC', '82200', 17, 1),
(2, 'BOUDOU', '82200', 0, 1),
(3, 'LA BASTIDE DU TEMPLE ', '82100', 0, 1),
(4, 'ST NICOLAS DE LA GRAVE ', '82210', 0, 1),
(5, 'CASTELSARRASIN', '82100', 0, 1),
(6, 'MALAUSE ', '82200', 0, 1),
(7, 'GOUDOURVILLE', '82400', 0, 1),
(8, 'ST PAUL D ESPIS', '82400', 0, 1),
(9, 'CASTELSAGRAT ', '82400', 0, 1),
(10, 'MONTESQUIEU', '82200', 0, 1),
(11, 'DURFORT LA CAPELETTE ', '82390', 0, 1),
(12, 'LIZAC', '82200', 0, 1),
(13, 'LAFRANCAISE', '82130', 0, 1),
(14, 'CASTELMAYRAN', '82210', 0, 1),
(15, 'ALBEUFEUILLE-LAGARDE ', '82290', 0, 2),
(16, 'MONTBETON', '82290', 0, 2),
(17, 'MEAUZAC', '82290', 0, 2),
(18, 'LACOURT ST PIERRE', '82290', 0, 2),
(19, 'BARRY D ISLEMADE ', '82290', 0, 2),
(20, 'LES BARTHES ', '82100', 0, 2),
(21, 'ST PORQUIER ', '82700', 0, 2),
(22, 'MONTAUBAN ', '82000', 0, 2),
(23, 'ESPALAIS', '82400', 0, 3),
(24, 'BARDIGUES', '82340', 0, 3),
(25, 'SAINT LOUP ', '82340', 0, 3),
(26, 'VALENCE ', '82400', 0, 3),
(27, 'LE PIN', '82340', 0, 3),
(28, 'DONZAC', '82340', 0, 3),
(29, 'MERLES', '82210', 0, 3),
(30, 'GOLFECH', '82400', 0, 3),
(31, 'SAINT ANTOINE', '32340', 0, 3),
(32, 'SAINT CIRICE', '82340', 0, 3),
(33, 'POMMEVIC', '82400', 0, 3),
(34, 'LEOJAC', '82230', 0, 5),
(35, 'LAMOTHE CAPDEVILLE', '82130', 0, 5),
(36, 'SAINT NAUPHARY', '82370', 0, 5),
(37, 'SAINT ETIENNE DE TULMONT ', '82410', 0, 5),
(38, 'VILLEMADE', '82130', 0, 5),
(39, 'BRESSOLS', '82710', 0, 5),
(40, 'CORBARIEU', '82370', 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `Documents`
--

CREATE TABLE IF NOT EXISTS `Documents` (
  `idDocument` int(11) NOT NULL auto_increment,
  `sizetext` varchar(250) NOT NULL,
  `corps` text NOT NULL,
  `other` varchar(250) NOT NULL,
  PRIMARY KEY  (`idDocument`)
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
  `idDpe` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `fromValue` int(11) NOT NULL,
  `toValue` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`idDpe`)
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
-- Structure de la table `DpeConsoEner`
--

CREATE TABLE IF NOT EXISTS `DpeConsoEner` (
  `idDpeConsoEner` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `fromD` int(11) NOT NULL,
  `toD` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`idDpeConsoEner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `DpeConsoEner`
--

INSERT INTO `DpeConsoEner` (`idDpeConsoEner`, `name`, `fromD`, `toD`, `position`) VALUES
(1, 'A', 0, 50, 1),
(2, 'B', 51, 90, 2),
(3, 'C', 91, 150, 3),
(4, 'D', 151, 230, 4),
(5, 'E', 231, 330, 5),
(6, 'F', 331, 450, 6),
(7, 'G', 451, 9999999, 7);

-- --------------------------------------------------------

--
-- Structure de la table `DpeEmissionGaz`
--

CREATE TABLE IF NOT EXISTS `DpeEmissionGaz` (
  `idDpeEmissionGaz` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `fromD` int(11) NOT NULL,
  `toD` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`idDpeEmissionGaz`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `DpeEmissionGaz`
--

INSERT INTO `DpeEmissionGaz` (`idDpeEmissionGaz`, `name`, `fromD`, `toD`, `position`) VALUES
(1, 'A', 0, 5, 1),
(2, 'B', 6, 10, 2),
(3, 'C', 11, 20, 3),
(4, 'D', 21, 35, 4),
(5, 'E', 36, 55, 5),
(6, 'F', 56, 80, 6),
(7, 'G', 81, 2147483647, 7);

-- --------------------------------------------------------

--
-- Structure de la table `HistoricConnection`
--

CREATE TABLE IF NOT EXISTS `HistoricConnection` (
  `idHistoricConnection` int(11) NOT NULL auto_increment,
  `dateConnection` datetime NOT NULL,
  `ip` varchar(50) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY  (`idHistoricConnection`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `HistoricConnection`
--

INSERT INTO `HistoricConnection` (`idHistoricConnection`, `dateConnection`, `ip`, `user_idUser`) VALUES
(1, '2011-04-01 13:19:45', '92.149.238.218', 1),
(2, '2011-04-01 14:51:10', '92.149.238.218', 1),
(3, '2011-04-01 17:02:11', '77.193.114.34', 1),
(4, '2011-04-04 08:17:08', '92.149.238.218', 1),
(5, '2011-04-04 10:07:14', '92.149.238.218', 1),
(6, '2011-04-04 10:07:23', '92.149.238.218', 1),
(7, '2011-04-04 11:59:52', '92.149.238.218', 1),
(8, '2011-04-04 14:19:33', '92.149.238.218', 1),
(9, '2011-04-04 16:29:36', '92.149.238.218', 1),
(10, '2011-04-05 09:25:25', '86.213.8.170', 1),
(11, '2011-04-05 10:04:17', '93.24.247.175', 1),
(12, '2011-04-05 10:07:14', '93.24.247.175', 1),
(13, '2011-04-05 10:07:22', '93.24.247.175', 1),
(14, '2011-04-05 10:37:09', '93.24.247.175', 1),
(15, '2011-04-05 10:38:44', '93.24.247.175', 33),
(16, '2011-04-05 10:39:26', '93.24.247.175', 1),
(17, '2011-04-05 10:51:36', '93.24.247.175', 33),
(18, '2011-04-05 10:53:38', '93.24.247.175', 1),
(19, '2011-04-05 12:37:11', '86.213.8.170', 1),
(20, '2011-04-05 15:24:55', '86.213.8.170', 1),
(21, '2011-04-05 17:41:18', '93.24.247.175', 1),
(22, '2011-04-05 17:41:26', '93.24.247.175', 1),
(23, '2011-04-06 09:07:18', '86.213.8.170', 1),
(24, '2011-04-07 22:41:53', '82.125.168.224', 1),
(25, '2011-04-07 22:42:07', '82.125.168.224', 1),
(26, '2011-04-08 10:31:39', '92.149.235.60', 1),
(27, '2011-04-08 10:39:03', '92.149.235.60', 1),
(28, '2011-04-08 10:51:02', '92.149.235.60', 1),
(29, '2011-04-11 09:17:09', '90.55.39.63', 1),
(30, '2011-04-11 10:02:35', '79.80.142.107', 1),
(31, '2011-04-11 10:04:39', '79.80.142.107', 1),
(32, '2011-04-11 21:04:56', '86.221.0.54', 1),
(33, '2011-04-11 21:05:01', '86.221.0.54', 1),
(34, '2011-04-12 09:21:40', '79.80.142.107', 1),
(35, '2011-04-12 09:21:46', '79.80.142.107', 1),
(36, '2011-04-12 09:46:49', '79.80.142.107', 34),
(37, '2011-04-12 09:47:37', '79.80.142.107', 34),
(38, '2011-04-12 15:16:35', '79.86.18.69', 34),
(39, '2011-04-12 15:16:42', '79.86.18.69', 34),
(40, '2011-04-12 15:47:44', '79.86.18.69', 33),
(41, '2011-04-12 16:13:51', '79.86.18.69', 34),
(42, '2011-04-12 16:13:57', '79.86.18.69', 34),
(43, '2011-04-14 09:20:28', '92.149.231.149', 1),
(44, '2011-04-14 09:22:16', '92.149.231.149', 1),
(45, '2011-04-14 09:27:15', '92.149.231.149', 1),
(46, '2011-04-14 09:28:46', '92.149.231.149', 1),
(47, '2011-04-14 09:31:36', '92.149.231.149', 1),
(48, '2011-04-14 09:32:12', '92.149.231.149', 1),
(49, '2011-04-14 09:38:16', '92.149.231.149', 1),
(50, '2011-04-14 16:14:05', '92.149.231.149', 1),
(51, '2011-04-15 09:28:26', '92.149.231.149', 1),
(52, '2011-04-15 09:34:22', '92.149.231.149', 1);

-- --------------------------------------------------------

--
-- Structure de la table `LevelMember`
--

CREATE TABLE IF NOT EXISTS `LevelMember` (
  `idLevelMember` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`idLevelMember`)
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
-- Structure de la table `LiasonPasserelleMandat`
--

CREATE TABLE IF NOT EXISTS `LiasonPasserelleMandat` (
  `idLiasonPasserelleMandat` int(11) NOT NULL auto_increment,
  `passerelle_idPasserelle` int(11) NOT NULL,
  `mandate_idMandate` int(11) NOT NULL,
  PRIMARY KEY  (`idLiasonPasserelleMandat`),
  KEY `passerelle_idPasserelle` (`passerelle_idPasserelle`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `LiasonPasserelleMandat`
--


-- --------------------------------------------------------

--
-- Structure de la table `Log`
--

CREATE TABLE IF NOT EXISTS `Log` (
  `idLog` int(11) NOT NULL auto_increment,
  `dateLog` datetime NOT NULL,
  `pluginName` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY  (`idLog`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Contenu de la table `Log`
--

INSERT INTO `Log` (`idLog`, `dateLog`, `pluginName`, `log`, `user_idUser`) VALUES
(1, '2011-04-01 13:20:09', 'sector', ' Ajout du secteur : Moissac', 1),
(2, '2011-04-01 13:20:26', 'sector', 'Ajout de la ville : Moissac', 1),
(3, '2011-04-01 13:21:19', 'seller', 'Ajout du titre de vendeur : Monsieur', 1),
(4, '2011-04-01 13:21:24', 'seller', 'Ajout du titre de vendeur : Madame', 1),
(5, '2011-04-01 13:21:35', 'seller', 'Ajout du titre de vendeur : Monsieur et madame', 1),
(6, '2011-04-01 13:23:32', 'seller', 'Creation du vendeur : Vend1', 1),
(7, '2011-04-01 13:23:32', 'terrain', 'Ajout du terrain : 1', 1),
(8, '2011-04-01 13:23:32', 'terrain', 'nouvelle liaison terrain/vendeur principal : 1/Vend1', 1),
(9, '2011-04-01 13:24:39', 'terrain', 'Ajout/Modification des informations complementaires du terrain 1', 1),
(10, '2011-04-01 13:25:16', 'terrain', 'Ajout d''une image pour le mandat : 1', 1),
(11, '2011-04-01 13:26:11', 'acquereur', 'Ajout de l''aquereur : Achat', 1),
(12, '2011-04-01 13:26:44', 'rapprochement', ' Achat et le mandat numÃ©ro 1 rapprochÃ©s.', 1),
(13, '2011-04-01 13:26:56', 'rapprochement', 'Suppression du repprochement entre  Achat et le mandat numÃ©ro : 1', 1),
(14, '2011-04-01 14:18:45', 'rapprochement', ' Achat et le mandat numÃ©ro 1 rapprochÃ©s.', 1),
(15, '2011-04-01 14:18:54', 'rapprochement', 'Suppression du repprochement entre  Achat et le mandat numÃ©ro : 1', 1),
(16, '2011-04-01 17:03:13', 'acquereur', 'Ajout de l''aquereur : lafon', 1),
(17, '2011-04-04 16:29:58', 'rapprochement', ' Achat et le mandat numÃ©ro 1 rapprochÃ©s.', 1),
(18, '2011-04-04 16:41:24', 'rapprochement', 'Passage du mandat 1 en etat compromis', 1),
(19, '2011-04-04 16:41:32', 'terrain', 'finalisation de la vente du mandat', 1),
(20, '2011-04-04 16:42:25', 'terrain', 'Ajout du terrain : 12', 1),
(21, '2011-04-04 16:42:25', 'terrain', 'nouvelle liaison terrain/vendeur principal : 12/Vend1', 1),
(22, '2011-04-04 16:42:59', 'acquereur', 'Ajout de l''aquereur : a', 1),
(23, '2011-04-04 16:43:10', 'rapprochement', ' a et le mandat numÃ©ro 12 rapprochÃ©s.', 1),
(24, '2011-04-04 16:43:17', 'rapprochement', 'Passage du mandat 12 en etat compromis', 1),
(25, '2011-04-04 16:43:44', 'rapprochement', 'Passage du mandat 12 en etat compromis', 1),
(26, '2011-04-04 16:43:59', 'acquereur', 'Ajout de l''aquereur : b', 1),
(27, '2011-04-04 16:44:12', 'acquereur', 'Modification de l''acquereur : b', 1),
(28, '2011-04-04 16:44:44', 'terrain', 'Ajout du terrain : 13', 1),
(29, '2011-04-04 16:44:44', 'terrain', 'nouvelle liaison terrain/vendeur principal : 13/Vend1', 1),
(30, '2011-04-04 16:44:51', 'rapprochement', ' b et le mandat numÃ©ro 13 rapprochÃ©s.', 1),
(31, '2011-04-04 16:44:54', 'rapprochement', 'Passage du mandat 13 en etat compromis', 1),
(32, '2011-04-04 16:55:51', 'terrain', 'Reaffection du mandat', 1),
(33, '2011-04-05 08:58:36', 'rapprochement', 'Passage du mandat 12 en etat compromis', 1),
(34, '2011-04-05 08:58:42', 'terrain', 'finalisation de la vente du mandat', 1),
(35, '2011-04-05 08:58:53', 'terrain', 'Reaffection du mandat', 1),
(36, '2011-04-05 10:38:32', 'user', 'Ajout d''un nouvel utilisateur : david', 1),
(37, '2011-04-05 10:53:04', 'action', 'Ajout d''une action de CALVI pour CALVI', 33),
(38, '2011-04-05 17:41:41', 'user', 'Suppression de : axelle', 1),
(39, '2011-04-05 17:41:47', 'user', 'Suppression de : daniel', 1),
(40, '2011-04-05 17:42:08', 'user', 'Suppression de : Maryline', 1),
(41, '2011-04-08 10:40:52', 'mandat', 'Ajout du mandat : 666', 1),
(42, '2011-04-08 10:40:52', 'mandat', 'nouvelle liaison mandat/vendeur principal : 666/Vend1', 1),
(43, '2011-04-08 10:41:09', 'mandat', 'Ajout/Modification des informations complementaires du terrain 666', 1),
(44, '2011-04-08 10:41:28', 'mandat', 'Ajout/Modification des informations complementaires du terrain 666', 1),
(45, '2011-04-08 10:49:26', 'mandat', 'Ajout du mandat : 555', 1),
(46, '2011-04-08 10:49:26', 'mandat', 'nouvelle liaison mandat/vendeur principal : 555/Vend1', 1),
(47, '2011-04-08 10:49:42', 'mandat', 'Ajout/Modification des informations complementaires du terrain 555', 1),
(48, '2011-04-08 10:49:55', 'mandat', 'Ajout/Modification des informations complementaires du terrain 555', 1),
(49, '2011-04-11 09:26:42', 'mandat', 'Ajout du fichier showexe.py pour le mandat : 666', 1),
(50, '2011-04-11 09:42:53', 'mandat', 'Ajout du fichier search-engine-optimization-starter-guide-fr.pdf pour le mandat : 666', 1),
(51, '2011-04-11 09:43:50', 'mandat', 'suppression du fichier showexe.py pour le mandat : 666', 1),
(52, '2011-04-11 09:43:54', 'mandat', 'suppression du fichier search-engine-optimization-starter-guide-fr.pdf pour le mandat : 666', 1),
(53, '2011-04-11 10:07:10', 'sector', ' Ajout du secteur : LA VILLE DIEU DU TEMPLE', 1),
(54, '2011-04-11 10:07:23', 'sector', ' Ajout du secteur : AUVILLAR', 1),
(55, '2011-04-11 10:07:47', 'sector', ' modification du secteur : MOISSAC', 1),
(56, '2011-04-11 10:13:20', 'sector', 'Ajout de la ville : BOUDOU', 1),
(57, '2011-04-11 10:13:51', 'sector', ' modification de la ville : MOISSAC', 1),
(58, '2011-04-11 10:46:56', 'sector', 'Ajout de la ville : LA BASTIDE DU TEMPLE ', 1),
(59, '2011-04-11 10:47:45', 'sector', 'Ajout de la ville : ST NICOLAS DE LA GRAVE ', 1),
(60, '2011-04-11 10:48:03', 'sector', 'Ajout de la ville : CASTELSARRASIN', 1),
(61, '2011-04-11 10:48:58', 'sector', 'Ajout de la ville : MALAUSE ', 1),
(62, '2011-04-11 10:49:30', 'sector', 'Ajout de la ville : GOUDOURVILLE', 1),
(63, '2011-04-11 10:49:56', 'sector', 'Ajout de la ville : ST PAUL D ESPIS', 1),
(64, '2011-04-11 10:50:25', 'sector', 'Ajout de la ville : CASTELSAGRAT ', 1),
(65, '2011-04-11 10:51:01', 'sector', 'Ajout de la ville : MONTESQUIEU', 1),
(66, '2011-04-11 10:51:42', 'sector', 'Ajout de la ville : DURFORT LA CAPELETTE ', 1),
(67, '2011-04-11 10:53:15', 'sector', 'Ajout de la ville : LIZAC', 1),
(68, '2011-04-11 10:53:34', 'sector', 'Ajout de la ville : LAFRANCAISE', 1),
(69, '2011-04-11 10:54:09', 'sector', 'Ajout de la ville : CASTELMAYRAN', 1),
(70, '2011-04-11 10:56:14', 'sector', ' Ajout du secteur : LA VILLE DIEU DU TEMPLE', 1),
(71, '2011-04-11 10:56:40', 'sector', 'Suppression du secteur : LA VILLE DIEU DU TEMPLE', 1),
(72, '2011-04-11 10:58:00', 'sector', 'Ajout de la ville : ALBEUFEUILLE-LAGARDE ', 1),
(73, '2011-04-11 10:58:36', 'sector', 'Ajout de la ville : MONTBETON', 1),
(74, '2011-04-11 10:59:08', 'sector', 'Ajout de la ville : MEAUZAC', 1),
(75, '2011-04-11 10:59:53', 'sector', 'Ajout de la ville : LACOURT ST PIERRE', 1),
(76, '2011-04-11 11:00:39', 'sector', 'Ajout de la ville : BARRY D ISLEMADE ', 1),
(77, '2011-04-11 11:02:14', 'sector', 'Ajout de la ville : LES BARTHES ', 1),
(78, '2011-04-11 11:02:48', 'sector', 'Ajout de la ville : ST PORQUIER ', 1),
(79, '2011-04-11 11:03:02', 'sector', ' modification de la ville : ST PORQUIER ', 1),
(80, '2011-04-11 11:03:47', 'sector', 'Ajout de la ville : MONTAUBAN ', 1),
(81, '2011-04-11 11:04:00', 'sector', ' modification de la ville : MONTAUBAN ', 1),
(82, '2011-04-11 11:05:24', 'sector', 'Ajout de la ville : ESPALAIS', 1),
(83, '2011-04-11 11:06:54', 'sector', 'Ajout de la ville : BARDIGUES', 1),
(84, '2011-04-11 11:07:28', 'sector', 'Ajout de la ville : SAINT LOUP ', 1),
(85, '2011-04-11 11:08:05', 'sector', 'Ajout de la ville : VALENCE ', 1),
(86, '2011-04-11 11:08:35', 'sector', 'Ajout de la ville : LE PIN', 1),
(87, '2011-04-11 11:09:02', 'sector', 'Ajout de la ville : DONZAC', 1),
(88, '2011-04-11 11:09:28', 'sector', 'Ajout de la ville : MERLES', 1),
(89, '2011-04-11 11:09:56', 'sector', 'Ajout de la ville : GOLFECH', 1),
(90, '2011-04-11 11:11:22', 'sector', 'Ajout de la ville : SAINT ANTOINE', 1),
(91, '2011-04-11 11:12:50', 'sector', 'Ajout de la ville : SAINT CIRICE', 1),
(92, '2011-04-11 11:13:26', 'sector', 'Ajout de la ville : POMMEVIC', 1),
(93, '2011-04-11 11:54:31', 'sector', ' Ajout du secteur : MONTAUBAN', 1),
(94, '2011-04-11 11:57:11', 'sector', 'Ajout de la ville : LEOJAC', 1),
(95, '2011-04-11 11:57:50', 'sector', 'Ajout de la ville : LAMOTHE CAPDEVILLE', 1),
(96, '2011-04-11 11:58:48', 'sector', 'Ajout de la ville : SAINT NAUPHARY', 1),
(97, '2011-04-11 11:59:43', 'sector', 'Ajout de la ville : SAINT ETIENNE DE TULMONT ', 1),
(98, '2011-04-11 12:00:20', 'sector', 'Ajout de la ville : VILLEMADE', 1),
(99, '2011-04-11 12:04:32', 'sector', 'Ajout de la ville : BRESSOLS', 1),
(100, '2011-04-11 12:05:07', 'sector', 'Ajout de la ville : CORBARIEU', 1),
(101, '2011-04-12 09:23:37', 'mandate_features', 'Ajout d''une option de toiture : Bonne etat', 1),
(102, '2011-04-12 09:23:56', 'mandate_features', 'Mise Ã  jour de l''option de toiture  : Bonne Etat', 1),
(103, '2011-04-12 09:28:03', 'seller', 'Creation du vendeur : LAFON', 1),
(104, '2011-04-12 09:28:03', 'mandat', 'Ajout du mandat : 890', 1),
(105, '2011-04-12 09:28:03', 'mandat', 'nouvelle liaison mandat/vendeur principal : 890/LAFON', 1),
(106, '2011-04-12 09:30:01', 'mandat', 'Ajout/Modification des informations complementaires du terrain 890', 1),
(107, '2011-04-12 09:34:55', 'user', 'Ajout d''un nouvel utilisateur : AXELLE', 1),
(108, '2011-04-12 15:17:21', 'mandate_features', 'Ajout d''une option de chauffage : Fioul', 34),
(109, '2011-04-12 16:15:34', 'mandate_features', 'Ajout d''une option de chauffage : Electrique ', 34),
(110, '2011-04-12 16:16:33', 'mandate_features', 'Ajout d''une option de chauffage : Gaz', 34),
(111, '2011-04-12 16:17:14', 'mandate_features', 'Ajout d''une option de chauffage : Electrique + Fioul', 34),
(112, '2011-04-12 16:19:22', 'mandate_features', 'Mise Ã  jour de l''option de chauffage  : Gaz de ville', 34),
(113, '2011-04-12 16:19:49', 'mandate_features', 'Mise Ã  jour de l''option de chauffage  : Gaz individuel', 34),
(114, '2011-04-12 16:28:04', 'mandate_features', 'Ajout d''une option de chauffage : Individuel Ã©lectrique', 34),
(115, '2011-04-12 16:30:59', 'mandate_features', 'Ajout d''une option de chauffage : Climatisation rÃ©versible', 34),
(116, '2011-04-14 09:28:22', 'mandat', 'Ajout d''une image pour le mandat : 666', 1),
(117, '2011-04-14 09:29:08', 'mandat', 'Suppression d''une image pour le terrain : 666', 1),
(118, '2011-04-14 09:29:25', 'mandat', 'Ajout d''une image pour le mandat : 666', 1);

-- --------------------------------------------------------

--
-- Structure de la table `LogTransfert`
--

CREATE TABLE IF NOT EXISTS `LogTransfert` (
  `idLogTransfert` int(11) NOT NULL auto_increment,
  `passerelle_idPasserelle` int(11) NOT NULL,
  `mandate_idMandate` int(11) NOT NULL,
  `dateExport` datetime NOT NULL,
  PRIMARY KEY  (`idLogTransfert`),
  KEY `passerelle_idPasserelle` (`passerelle_idPasserelle`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `LogTransfert`
--


-- --------------------------------------------------------

--
-- Structure de la table `Mandate`
--

CREATE TABLE IF NOT EXISTS `Mandate` (
  `idMandate` int(11) NOT NULL auto_increment,
  `numberMandate` int(11) NOT NULL,
  `initDate` date NOT NULL,
  `deadDate` date NOT NULL,
  `freeDate` date default NULL,
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
  `zoneBDF` tinyint(1) NOT NULL default '0',
  `ligneDeCrete` tinyint(1) NOT NULL default '0',
  `zoneInondable` tinyint(1) NOT NULL default '0',
  `reglementDeLotissement` text NOT NULL,
  `eRNT` varchar(250) NOT NULL,
  `dPValide` tinyint(1) NOT NULL default '0',
  `dateDeclarationPrealable` date default NULL,
  `prorogationDPJusquau` date default NULL,
  `cuValide` tinyint(1) NOT NULL default '0',
  `dateCU` date default NULL,
  `prorogationCUJusquau` date default NULL,
  `cuOPSValide` tinyint(1) NOT NULL default '0',
  `dateCuOPS` date default NULL,
  `prorogationCuOPSJusquau` date default NULL,
  `permisDamenagerValide` tinyint(1) NOT NULL default '0',
  `datePermisDamenager` date default NULL,
  `terrainVenduViabilise` tinyint(1) NOT NULL default '0',
  `terrainVenduSemiViabilise` tinyint(1) NOT NULL default '0',
  `terrainVenduNonViabilise` tinyint(1) NOT NULL default '0',
  `passageEau` text NOT NULL,
  `passageElectricite` text NOT NULL,
  `passageGaz` text NOT NULL,
  `toutALegout` tinyint(1) NOT NULL default '0',
  `assainissementParFosseSceptique` tinyint(1) NOT NULL default '0',
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
  `coupCoeur` tinyint(1) NOT NULL default '0',
  `chargesMensuelle` int(11) NOT NULL,
  `taxesFonciere` int(11) NOT NULL,
  `taxeHabitation` int(11) NOT NULL,
  `nouveaute` date default NULL,
  `cheminee` tinyint(1) NOT NULL default '0',
  `cuisineEquipee` tinyint(1) NOT NULL default '0',
  `cuisineAmenagee` tinyint(1) NOT NULL default '0',
  `piscine` tinyint(1) NOT NULL default '0',
  `poolHouse` tinyint(1) NOT NULL default '0',
  `terrasse` tinyint(1) NOT NULL default '0',
  `mezzanine` tinyint(1) NOT NULL default '0',
  `dependance` tinyint(1) NOT NULL default '0',
  `gaz` tinyint(1) NOT NULL default '0',
  `cave` tinyint(1) NOT NULL default '0',
  `sousSol` tinyint(1) NOT NULL default '0',
  `garage` tinyint(1) NOT NULL default '0',
  `parking` tinyint(1) NOT NULL default '0',
  `rezDeJardin` tinyint(1) NOT NULL default '0',
  `plainPied` tinyint(1) NOT NULL default '0',
  `carriere` tinyint(1) NOT NULL default '0',
  `pointEau` tinyint(1) NOT NULL default '0',
  `user_idUser` int(11) NOT NULL,
  `sector_idSector` int(11) NOT NULL,
  `city_idCity` int(11) NOT NULL,
  `notary_idNotary` int(11) NOT NULL,
  `mandateType_idMandateType` int(11) NOT NULL,
  `transactionType_idTransactionType` int(11) NOT NULL,
  `slope_idMandateSlope` int(11) default NULL,
  `orientation_idMandateOrientation` int(11) default NULL,
  `insulation_idMandateInsulation` int(11) default NULL,
  `news_idMandateNews` int(11) default NULL,
  `heating_idMandateHeating` int(11) default NULL,
  `commonOwnership_idMandateCommonOwnership` int(11) default NULL,
  `roof_idMandateRoof` int(11) default NULL,
  `condition_idMandateCondition` int(11) default NULL,
  `style_idMandateStyle` int(11) default NULL,
  `construction_idMandateConstructionType` int(11) default NULL,
  `sanitationCorresponding_idMandateSanitationCorresponding` int(11) default NULL,
  `electricCorresponding_idMandateElectricCorresponding` int(11) default NULL,
  `gazCorresponding_idMandateGazCorresponding` int(11) default NULL,
  `waterCorresponding_idMandateWaterCorresponding` int(11) default NULL,
  `cos_idMandateCOS` int(11) default NULL,
  `zonagePLU_idMandateZonagePLU` int(11) default NULL,
  `zonageRNU_idMandateZonageRNU` int(11) default NULL,
  `bornageTerrain_idMandateBornageTerrain` int(11) default NULL,
  `geometer_idMandateGeometer` int(11) default NULL,
  `etap_idMandateEtap` int(11) NOT NULL,
  PRIMARY KEY  (`idMandate`),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Mandate`
--

INSERT INTO `Mandate` (`idMandate`, `numberMandate`, `initDate`, `deadDate`, `freeDate`, `address`, `priceFai`, `priceSeller`, `commission`, `estimationFai`, `margeNegociation`, `referenceCadastreParcelle1`, `referenceCadastreParcelle2`, `referenceCadastreParcelle3`, `autreReferenceParcelle`, `superficieParcelle1`, `superficieParcelle2`, `superficieParcelle3`, `superficieAutreParcelle`, `superficieConstructible`, `superficieNonConstructible`, `superficieTotale`, `numberLot`, `sHONAccordee`, `zoneBDF`, `ligneDeCrete`, `zoneInondable`, `reglementDeLotissement`, `eRNT`, `dPValide`, `dateDeclarationPrealable`, `prorogationDPJusquau`, `cuValide`, `dateCU`, `prorogationCUJusquau`, `cuOPSValide`, `dateCuOPS`, `prorogationCuOPSJusquau`, `permisDamenagerValide`, `datePermisDamenager`, `terrainVenduViabilise`, `terrainVenduSemiViabilise`, `terrainVenduNonViabilise`, `passageEau`, `passageElectricite`, `passageGaz`, `toutALegout`, `assainissementParFosseSceptique`, `voirie`, `tailleFacade`, `profondeurTerrain`, `commentaire`, `geolocalisation`, `proximiteEcole`, `proximiteCommerce`, `proximiteTransport`, `commentaireApparent`, `nbPiece`, `surfaceHabitable`, `nbChambre`, `surfacePieceVie`, `niveau`, `anneeConstruction`, `coupCoeur`, `chargesMensuelle`, `taxesFonciere`, `taxeHabitation`, `nouveaute`, `cheminee`, `cuisineEquipee`, `cuisineAmenagee`, `piscine`, `poolHouse`, `terrasse`, `mezzanine`, `dependance`, `gaz`, `cave`, `sousSol`, `garage`, `parking`, `rezDeJardin`, `plainPied`, `carriere`, `pointEau`, `user_idUser`, `sector_idSector`, `city_idCity`, `notary_idNotary`, `mandateType_idMandateType`, `transactionType_idTransactionType`, `slope_idMandateSlope`, `orientation_idMandateOrientation`, `insulation_idMandateInsulation`, `news_idMandateNews`, `heating_idMandateHeating`, `commonOwnership_idMandateCommonOwnership`, `roof_idMandateRoof`, `condition_idMandateCondition`, `style_idMandateStyle`, `construction_idMandateConstructionType`, `sanitationCorresponding_idMandateSanitationCorresponding`, `electricCorresponding_idMandateElectricCorresponding`, `gazCorresponding_idMandateGazCorresponding`, `waterCorresponding_idMandateWaterCorresponding`, `cos_idMandateCOS`, `zonagePLU_idMandateZonagePLU`, `zonageRNU_idMandateZonageRNU`, `bornageTerrain_idMandateBornageTerrain`, `geometer_idMandateGeometer`, `etap_idMandateEtap`) VALUES
(1, 1, '2011-04-01', '2012-04-01', NULL, '21 rue de la paix', 87000.00, 85000.00, 2000.00, 87000.00, 1000.00, 'REF', '', '', '', 2000, 0, 0, 0, 1500, 500, 2000, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, 'Superbe terrain, dans un cadre idyllique.', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1970-01-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4),
(2, 12, '2011-04-04', '2011-04-04', NULL, 'bla', 15000.00, 10000.00, 5000.00, 15000.00, 5000.00, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 13, '2011-04-04', '2011-04-23', NULL, 'aaa', 99.00, 9.00, 90.00, 9.00, 9.00, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(4, 666, '2011-04-08', '2012-04-08', NULL, '26 rue du malt', 400.00, 300.00, 100.00, 0.00, 0.00, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1970-01-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 555, '2011-04-08', '2012-04-08', NULL, '12 rue du test', 900.00, 800.00, 100.00, 0.00, 0.00, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1970-01-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 890, '2011-04-12', '2011-06-12', NULL, 'chemin du milieu', 260000.00, 240000.00, 20000.00, 0.00, 0.00, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, 0, 0, '', '', '', 0, 0, '', 0, 0, '', '', 0, 0, 0, '', 4, 140, 3, 50, 1, 2008, 0, 0, 1700, 0, '1970-01-01', 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `MandateBornageTerrain`
--

CREATE TABLE IF NOT EXISTS `MandateBornageTerrain` (
  `idMandateBornageTerrain` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateBornageTerrain`)
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
  `idMandateCommonOwnership` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateCommonOwnership`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `MandateCommonOwnership`
--

INSERT INTO `MandateCommonOwnership` (`idMandateCommonOwnership`, `name`, `code`) VALUES
(1, 'Gaz de ville', 'Gaz de ville'),
(2, 'Fioul', 'Fioul'),
(3, 'Electrique ', 'Electrique'),
(4, 'Gaz individuel', 'Gaz individuel'),
(5, 'Electrique + Fioul', 'Electrique + Fioul'),
(6, 'Individuel Ã©lectrique', 'Individuel Ã©lectrique'),
(7, 'Climatisation rÃ©versible', 'Climatisation rÃ©versible');

-- --------------------------------------------------------

--
-- Structure de la table `MandateCondition`
--

CREATE TABLE IF NOT EXISTS `MandateCondition` (
  `idMandateCondition` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateCondition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateCondition`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateConstructionType`
--

CREATE TABLE IF NOT EXISTS `MandateConstructionType` (
  `idMandateConstructionType` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateConstructionType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateConstructionType`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateCOS`
--

CREATE TABLE IF NOT EXISTS `MandateCOS` (
  `idMandateCOS` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateCOS`)
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
  `idMandateElectricCorresponding` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateElectricCorresponding`)
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
  `idMandateEtap` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateEtap`)
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
  `idMandateGazCorresponding` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateGazCorresponding`)
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
  `idMandateGeometer` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateGeometer`)
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
  `idMandateHeating` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateHeating`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateHeating`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateInsulation`
--

CREATE TABLE IF NOT EXISTS `MandateInsulation` (
  `idMandateInsulation` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateInsulation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateInsulation`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateNews`
--

CREATE TABLE IF NOT EXISTS `MandateNews` (
  `idMandateNews` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MandateNews`
--


-- --------------------------------------------------------

--
-- Structure de la table `MandateOrientation`
--

CREATE TABLE IF NOT EXISTS `MandateOrientation` (
  `idMandateOrientation` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateOrientation`)
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
  `idMandatePicture` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `isDefault` tinyint(1) NOT NULL default '0',
  `fk_idMandate` int(11) default NULL,
  PRIMARY KEY  (`idMandatePicture`),
  KEY `fk_idMandate` (`fk_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `MandatePicture`
--

INSERT INTO `MandatePicture` (`idMandatePicture`, `name`, `isDefault`, `fk_idMandate`) VALUES
(1, '1-1jpg', 1, 1),
(3, '4-3jpg', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `MandateRoof`
--

CREATE TABLE IF NOT EXISTS `MandateRoof` (
  `idMandateRoof` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateRoof`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateRoof`
--

INSERT INTO `MandateRoof` (`idMandateRoof`, `name`, `code`) VALUES
(1, 'Bonne Etat', 'Bonne Etat');

-- --------------------------------------------------------

--
-- Structure de la table `MandateSanitationCorresponding`
--

CREATE TABLE IF NOT EXISTS `MandateSanitationCorresponding` (
  `idMandateSanitationCorresponding` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateSanitationCorresponding`)
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
  `idMandateScan` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `fk_idMandate` int(11) default NULL,
  PRIMARY KEY  (`idMandateScan`),
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
  `idMandateSlope` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateSlope`)
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
  `idMandateStyle` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateStyle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `MandateStyle`
--

INSERT INTO `MandateStyle` (`idMandateStyle`, `name`, `code`) VALUES
(1, 'Nada', 'null');

-- --------------------------------------------------------

--
-- Structure de la table `MandateType`
--

CREATE TABLE IF NOT EXISTS `MandateType` (
  `idMandateType` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `exportCode` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateType`)
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
  `idMandateWaterCorresponding` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateWaterCorresponding`)
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
  `idMandateZonagePLU` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateZonagePLU`)
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
  `idMandateZonageRNU` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY  (`idMandateZonageRNU`)
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
(1, 2, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 2, 1),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Notary`
--

CREATE TABLE IF NOT EXISTS `Notary` (
  `idNotary` int(11) NOT NULL auto_increment,
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
  PRIMARY KEY  (`idNotary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Notary`
--

INSERT INTO `Notary` (`idNotary`, `name`, `fistname`, `address`, `city`, `zipCode`, `phone`, `mobilPhone`, `jobPhone`, `fax`, `email`, `comments`, `numberUsed`) VALUES
(1, 'Mo', 'jean', '12 rue du tord', 'MOISSAC', '82000', '', '', '', '', '', '', 14);

-- --------------------------------------------------------

--
-- Structure de la table `Passerelle`
--

CREATE TABLE IF NOT EXISTS `Passerelle` (
  `idPasserelle` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `typeExport` varchar(250) NOT NULL,
  `param` longtext NOT NULL,
  `asset` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`idPasserelle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Passerelle`
--

INSERT INTO `Passerelle` (`idPasserelle`, `name`, `typeExport`, `param`, `asset`) VALUES
(1, 'escalimmo.com', 'escalimmo_com', 'a:1:{s:3:"ftp";a:3:{s:4:"host";s:12:"monftp-1.net";s:4:"user";s:4:"alsa";s:8:"password";s:5:"naute";}}', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Rapprochement`
--

CREATE TABLE IF NOT EXISTS `Rapprochement` (
  `idRapprochement` int(11) NOT NULL auto_increment,
  `dateRapprochement` datetime NOT NULL,
  `dateVisite` datetime default NULL,
  `compteRenduLe` datetime default NULL,
  `resultat` varchar(250) NOT NULL,
  `pointsPositifs` varchar(250) NOT NULL,
  `pointsNegatifs` varchar(250) NOT NULL,
  `resultatVisite` tinyint(1) NOT NULL default '0',
  `actif` tinyint(1) NOT NULL default '0',
  `user_idUser` int(11) NOT NULL,
  `acquereur_idAcquereur` int(11) NOT NULL,
  `mandate_idMandate` int(11) NOT NULL,
  `compromis` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`idRapprochement`),
  KEY `user_idUser` (`user_idUser`),
  KEY `acquereur_idAcquereur` (`acquereur_idAcquereur`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Rapprochement`
--

INSERT INTO `Rapprochement` (`idRapprochement`, `dateRapprochement`, `dateVisite`, `compteRenduLe`, `resultat`, `pointsPositifs`, `pointsNegatifs`, `resultatVisite`, `actif`, `user_idUser`, `acquereur_idAcquereur`, `mandate_idMandate`, `compromis`) VALUES
(3, '2011-04-04 16:29:58', '1970-01-01 01:00:00', '1970-01-01 01:00:00', '', '', '', 0, 1, 1, 1, 1, 1),
(5, '2011-04-04 16:44:51', '1970-01-01 01:00:00', '1970-01-01 01:00:00', '', '', '', 0, 1, 1, 4, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Sector`
--

CREATE TABLE IF NOT EXISTS `Sector` (
  `idSector` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `numberUsed` int(11) NOT NULL,
  PRIMARY KEY  (`idSector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Sector`
--

INSERT INTO `Sector` (`idSector`, `name`, `numberUsed`) VALUES
(1, 'MOISSAC', 30),
(2, 'LA VILLE DIEU DU TEMPLE', 14),
(3, 'AUVILLAR', 22),
(5, 'MONTAUBAN', 14);

-- --------------------------------------------------------

--
-- Structure de la table `Seller`
--

CREATE TABLE IF NOT EXISTS `Seller` (
  `idSeller` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobilPhone` varchar(15) NOT NULL,
  `workPhone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comments` varchar(200) default NULL,
  `asset` tinyint(1) NOT NULL default '1',
  `numberUsed` int(11) NOT NULL,
  `city_idCity` int(11) NOT NULL,
  `sellerTitle_idSellerTitle` int(11) NOT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY  (`idSeller`),
  KEY `city_idCity` (`city_idCity`),
  KEY `sellerTitle_idSellerTitle` (`sellerTitle_idSellerTitle`),
  KEY `user_idUser` (`user_idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Seller`
--

INSERT INTO `Seller` (`idSeller`, `name`, `firstname`, `address`, `phone`, `mobilPhone`, `workPhone`, `fax`, `email`, `comments`, `asset`, `numberUsed`, `city_idCity`, `sellerTitle_idSellerTitle`, `user_idUser`) VALUES
(2, 'Vend1', 'a', '12 rue de la paix', '01 02 03 04 05', '', '', '', '', NULL, 1, 5, 1, 1, 1),
(4, 'LAFON', 'Alexandre', 'chemin du Milieu', '06.75.06.17.74', '', '', '', '', NULL, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `SellerTitle`
--

CREATE TABLE IF NOT EXISTS `SellerTitle` (
  `idSellerTitle` int(11) NOT NULL auto_increment,
  `libel` varchar(20) NOT NULL,
  PRIMARY KEY  (`idSellerTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `SellerTitle`
--

INSERT INTO `SellerTitle` (`idSellerTitle`, `libel`) VALUES
(1, 'Monsieur'),
(2, 'Madame'),
(3, 'Monsieur et madame');

-- --------------------------------------------------------

--
-- Structure de la table `TitreAcquereur`
--

CREATE TABLE IF NOT EXISTS `TitreAcquereur` (
  `idTitreAcquereur` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY  (`idTitreAcquereur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `TitreAcquereur`
--

INSERT INTO `TitreAcquereur` (`idTitreAcquereur`, `name`) VALUES
(1, 'Monsieur'),
(4, 'Madame'),
(5, 'Monsieur et Madame');

-- --------------------------------------------------------

--
-- Structure de la table `TransactionType`
--

CREATE TABLE IF NOT EXISTS `TransactionType` (
  `idTransactionType` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `exportCode` varchar(250) NOT NULL,
  PRIMARY KEY  (`idTransactionType`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `TransactionType`
--

INSERT INTO `TransactionType` (`idTransactionType`, `name`, `exportCode`) VALUES
(1, 'Location', 'LOC'),
(2, 'Vente', 'VEN');

-- --------------------------------------------------------

--
-- Structure de la table `Upload`
--

CREATE TABLE IF NOT EXISTS `Upload` (
  `idUpload` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `size` varchar(250) NOT NULL,
  `mandate_idMandate` int(11) NOT NULL,
  PRIMARY KEY  (`idUpload`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Upload`
--


-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `idUser` int(11) NOT NULL auto_increment,
  `identifiant` varchar(255) NOT NULL,
  `password` varchar(130) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `registration_date` datetime NOT NULL,
  `numberUsed` int(11) NOT NULL default '0',
  `levelMember_idLevelMember` int(11) NOT NULL,
  `agency_idAgency` int(11) NOT NULL,
  PRIMARY KEY  (`idUser`),
  UNIQUE KEY `identifiant` (`identifiant`),
  KEY `levelMember_idLevelMember` (`levelMember_idLevelMember`),
  KEY `agency_idAgency` (`agency_idAgency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `identifiant`, `password`, `name`, `firstname`, `email`, `registration_date`, `numberUsed`, `levelMember_idLevelMember`, `agency_idAgency`) VALUES
(1, 'admin', 'e8bf8d080f763a4e8f70ca0761ccd3e4e5eb8907', 'Doe', 'John', 'john.doe@promethee.biz', '2011-01-20 14:09:04', 1, 1, 2),
(34, 'AXELLE', '200e10114bfe3e6a666e14820099a94b87063e61', 'LEMAITRE', 'Axelle', 'alexandre.lafon@escalimmo.com', '2011-04-12 09:34:55', 0, 2, 2),
(33, 'david', '336e10ca9575d699fa18d7326442cc139a9990a2', 'CALVI', 'daniel', 'alexandre.lafon@escalimmo.com', '2011-04-05 10:38:32', 1, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ValDpe`
--

CREATE TABLE IF NOT EXISTS `ValDpe` (
  `idValDpe` int(11) NOT NULL auto_increment,
  `consoEner` int(11) NOT NULL,
  `emissionGaz` int(11) NOT NULL,
  `mandate_idMandate` int(11) NOT NULL,
  PRIMARY KEY  (`idValDpe`),
  KEY `mandate_idMandate` (`mandate_idMandate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ValDpe`
--

INSERT INTO `ValDpe` (`idValDpe`, `consoEner`, `emissionGaz`, `mandate_idMandate`) VALUES
(1, 45, 6, 4),
(2, 12, 5, 5),
(3, 153, 54, 6);
