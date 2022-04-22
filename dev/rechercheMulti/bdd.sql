CREATE TABLE Critere_mandate (
	idCritere_mandate    INT AUTO_INCREMENT NOT NULL,
	nom                  VARCHAR(250) NOT NULL,
	champsCorrespondant  VARCHAR(250) NOT NULL,
	type                 VARCHAR(250) NOT NULL,
	nameTable            VARCHAR(250) NOT NULL,
	PRIMARY KEY (idCritere_mandate))
ENGINE = MYISAM CHARACTER SET UTF8;
CREATE TABLE Critere_acquereur (
	idCritere_acquereur  INT AUTO_INCREMENT NOT NULL,
	nom                  VARCHAR(250) NOT NULL,
	champsCorrespondant  VARCHAR(250) NOT NULL,
	type                 VARCHAR(250) NOT NULL,
	nameTable            VARCHAR(250) NOT NULL,
	PRIMARY KEY (idCritere_acquereur))
ENGINE = MYISAM CHARACTER SET UTF8;

INSERT INTO `Critere_acquereur` (`idCritere_acquereur`, `nom`, `champsCorrespondant`, `type`, `nameTable`) VALUES
(1, 'Le prix du bien recherch&eacute; est compris entre', '(a.priceMin >= ? AND a.priceMax <= ?) 	', 'double', ''),
(2, 'L''utilisateur est', '( a.user_idUser = ? )', 'list', 'User'),
(3, 'Le type de transaction du bien recherch&eacute; est', '( a.transactionType_idTransactionType = ? )', 'list', 'TransactionType'),
(4, 'Le type de bien recherch&eacute; est', '( a.mandateType_idMandateType = ? )', 'list', 'MandateType'),
(5, 'La ville dans laquelle le bien est recherch&eacute;', '(a.rechercheCity_idCity = ? )', 'list', 'City'),
(6, 'Le secteur dans lequel le bien est recherch&eacute;', '(a.rechercheSector_idSector = ? )', 'list', 'Sector'),
(7, 'L''acquereur r&eacute;side dans la ville', '(a.villeAcquereur = ? )', 'list', 'City'),
(8, 'L''acquereur r&eacute;side dans le secteur', '( (  SELECT count( c.idCity ) FROM City c WHERE c.sector_idSector =? ) !=0)', 'list', 'Sector'),
(9, 'La surface de terrain du bien recherch&eacute; est comprise entre', '(a.surfaceTerrainMin >= ? AND a.surfaceTerrainMax <= ?)', 'double', ''),
(10, 'La surface habitable du bien recherch&eacute; est compris entre', '(a.	surfaceHabitableMin >= ? AND a.	surfaceHabitableMax <= ?)', 'double', '');

INSERT INTO `Critere_mandate` (`idCritere_mandate`, `nom`, `champsCorrespondant`, `type`, `nameTable`) VALUES
(1, 'L''utilisateur est :', '( m.user_idUser = ? )', 'list', 'User'),
(2, 'Le numero de mandat est compris entre', '( m.numberMandate BETWEEN ? AND ? )', 'double', ''),
(4, 'Le prix est compris entre', '( m.priceFAi BETWEEN ? AND ? )', 'double', ''),
(5, 'Le prix est', '( m.priceFAI = ? )', 'simple', ''),
(6, 'Le numero de mandat est', '( m.numberMandate = ? )', 'simple', ''),
(7, 'Le nombre de piece est ', '( m.nbPiece = ? )', 'simple', ''),
(8, 'Le nombre de piece est compris entre', '( m.nbPiece BETWEEN ? AND ? )', 'double', ''),
(9, 'La surface habitable est', '( m.surfaceHabitable = ? )', 'simple', ''),
(10, 'La surface habitable est comprise entre', '( m.surfaceHabitable BETWEEN ? AND ? )', 'double', ''),
(11, 'La superficie du terrain est ', '( m.superficieTotale = ? )', 'simple', ''),
(12, 'La superficie du terrain est comprise entre', '( m.superficieTotale BETWEEN ? AND ? )', 'double', ''),
(13, 'Le type de bien est', '( m.mandateType_idMandateType = ? )', 'list', 'MandateType'),
(14, 'Le type de transaction est', '( m.transactionType_idTransactionType = ? )', 'list', 'TransactionType'),
(15, 'La ville est', '( m.city_idCity = ? )', 'list', 'City'),
(16, 'Le secteur est', '(m.sector_idSector = ? )', 'list', 'Sector'),
(17, 'La nature est', '( m.nature_idMandateNature = ? )', 'list', 'MandateNature'),
(18, 'L''etat du mandat est ', '( m.etap_idMandateEtap = ? )', 'list', 'MandateEtap');