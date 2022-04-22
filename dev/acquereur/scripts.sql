

CREATE TABLE TitreAcquereur (
	idTitreAcquereur                   INT AUTO_INCREMENT NOT NULL,
	name                               VARCHAR(250) NOT NULL,
	PRIMARY KEY (idTitreAcquereur))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Acquereur (
	idAcquereur                        INT AUTO_INCREMENT NOT NULL,
	name                               VARCHAR(255) NOT NULL,
	firstname                          VARCHAR(255) NOT NULL,
	address                            VARCHAR(250) NOT NULL,
	phone                              VARCHAR(250) NOT NULL,
	mobilPhone                         VARCHAR(250) NOT NULL,
	workPhone                          VARCHAR(250) NOT NULL,
	fax                                VARCHAR(250) NOT NULL,
	email                              VARCHAR(250) NOT NULL,
	numberUsed                         INT NOT NULL,
	actif                              TINYINT(1) DEFAULT FALSE NOT NULL,
	priceMin                           INT NOT NULL,
	priceMax                           INT NOT NULL,
	surfaceTerrainMin                  INT NOT NULL,
	surfaceTerrainMax                  INT NOT NULL,
	surfaceHabitableMin                INT NOT NULL,
	surfaceHabitableMax                INT NOT NULL,
	villeAcquereur                     INT NOT NULL,
	titreAcquereur_idTitreAcquereur    INT NOT NULL,
	transactionType_idTransactionType  INT NOT NULL,
	mandateStyle_idMandateStyle        INT NOT NULL,
	rechercheCity_idCity               INT,
	rechercheSector_idSector           INT,
	PRIMARY KEY (idAcquereur),
	FOREIGN KEY (villeAcquereur) REFERENCES City (idCity),
	FOREIGN KEY (titreAcquereur_idTitreAcquereur) REFERENCES TitreAcquereur (idTitreAcquereur),
	FOREIGN KEY (transactionType_idTransactionType) REFERENCES TransactionType (idTransactionType),
	FOREIGN KEY (mandateStyle_idMandateStyle) REFERENCES MandateStyle (idMandateStyle),
	FOREIGN KEY (rechercheCity_idCity) REFERENCES City (idCity),
	FOREIGN KEY (rechercheSector_idSector) REFERENCES Sector (idSector))
ENGINE = MYISAM CHARACTER SET UTF8;
