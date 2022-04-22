CREATE TABLE Rapprochement (
	idRapprochement        INT AUTO_INCREMENT NOT NULL,
	dateRapprochement      DATETIME NOT NULL,
	dateVisite             DATETIME NOT NULL,
	resultat               VARCHAR(250) NOT NULL,
	pointsPositifs         VARCHAR(250) NOT NULL,
	pointsNegatifs         VARCHAR(250) NOT NULL,
	resultatVisite         TINYINT(1) DEFAULT FALSE NOT NULL,
	actif                  TINYINT(1) DEFAULT FALSE NOT NULL,
	user_idUser            INT NOT NULL,
	acquereur_idAcquereur  INT NOT NULL,
	mandate_idMandate      INT NOT NULL,
	PRIMARY KEY (idRapprochement),
	FOREIGN KEY (user_idUser) REFERENCES User (idUser),
	FOREIGN KEY (acquereur_idAcquereur) REFERENCES Acquereur (idAcquereur),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;
