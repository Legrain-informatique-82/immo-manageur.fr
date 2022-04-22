CREATE TABLE DpeConsoEner (
	idDpeConsoEner     INT AUTO_INCREMENT NOT NULL,
	name               VARCHAR(250) NOT NULL,
	fromD               INT NOT NULL,
	toD                 INT NOT NULL,
	position           INT NOT NULL,
	PRIMARY KEY (idDpeConsoEner))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE DpeEmissionGaz (
	idDpeEmissionGaz   INT AUTO_INCREMENT NOT NULL,
	name               VARCHAR(250) NOT NULL,
	fromD               INT NOT NULL,
	toD                 INT NOT NULL,
	position           INT NOT NULL,
	PRIMARY KEY (idDpeEmissionGaz))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE ValDpe (
	idValDpe           INT AUTO_INCREMENT NOT NULL,
	consoEner          INT NOT NULL,
	emissionGaz        INT NOT NULL,
	mandate_idMandate  INT NOT NULL,
	PRIMARY KEY (idValDpe),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;
