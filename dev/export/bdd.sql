CREATE TABLE Passerelle (
	idPasserelle              INT AUTO_INCREMENT NOT NULL,
	name                      VARCHAR(250) NOT NULL,
	typeExport                VARCHAR(250) NOT NULL,
	param                     VARCHAR(250) NOT NULL,
	PRIMARY KEY (idPasserelle))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE LiasonPasserelleMandat (
	idLiasonPasserelleMandat  INT AUTO_INCREMENT NOT NULL,
	passerelle_idPasserelle   INT NOT NULL,
	mandate_idMandate         INT NOT NULL,
	PRIMARY KEY (idLiasonPasserelleMandat),
	FOREIGN KEY (passerelle_idPasserelle) REFERENCES Passerelle (idPasserelle),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE LogTransfert (
	idLogTransfert            INT AUTO_INCREMENT NOT NULL,
	passerelle_idPasserelle   INT NOT NULL,
	mandate_idMandate         INT NOT NULL,
	dateExport                DATETIME NOT NULL,
	PRIMARY KEY (idLogTransfert),
	FOREIGN KEY (passerelle_idPasserelle) REFERENCES Passerelle (idPasserelle),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;



CREATE TABLE PhotosExports (
	idPhotosExports    INT AUTO_INCREMENT NOT NULL,
	name               VARCHAR(255) NOT NULL,
	position           TINYINT NOT NULL,
	mandate_idMandate  INT NOT NULL,
	PRIMARY KEY (idPhotosExports),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;