CREATE TABLE Action (
	idAction           INT AUTO_INCREMENT NOT NULL,
	libel              VARCHAR(250) NOT NULL,
	initDate           DATE NOT NULL,
	deadDate           DATE NOT NULL,
	comment            TEXT(1000) NOT NULL,
	from_idUser        INT NOT NULL,
	to_idUser          INT NOT NULL,
	doDate             DATE,
	mandate_idMandate  INT,
	PRIMARY KEY (idAction),
	FOREIGN KEY (from_idUser) REFERENCES User (idUser),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE LibelAction (
	idLibelAction  INT AUTO_INCREMENT NOT NULL,
	libel          VARCHAR(250) NOT NULL,
	PRIMARY KEY (idLibelAction))
ENGINE = MYISAM CHARACTER SET UTF8;
