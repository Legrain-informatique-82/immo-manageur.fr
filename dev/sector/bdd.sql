CREATE TABLE Sector (
	idSector         INT AUTO_INCREMENT NOT NULL,
	name             VARCHAR(250) NOT NULL,
	numberUsed       INT NOT NULL,
	PRIMARY KEY (idSector))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE City (
	idCity           INT AUTO_INCREMENT NOT NULL,
	name             VARCHAR(250) NOT NULL,
	zipCode          VARCHAR(10) NOT NULL,
	numberUsed       INT NOT NULL,
	sector_idSector  INT NOT NULL,
	PRIMARY KEY (idCity),
	FOREIGN KEY (sector_idSector) REFERENCES Sector (idSector))
ENGINE = MYISAM CHARACTER SET UTF8;
