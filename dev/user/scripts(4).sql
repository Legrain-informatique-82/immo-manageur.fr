CREATE TABLE LevelMember (
	idLevelMember              INT AUTO_INCREMENT NOT NULL,
	name                       TEXT(512) NOT NULL,
	PRIMARY KEY (idLevelMember))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Agency (
	idAgency                   INT AUTO_INCREMENT NOT NULL,
	name                       TEXT(512) NOT NULL,
	PRIMARY KEY (idAgency))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE User (
	idUser                     INT AUTO_INCREMENT NOT NULL,
	identifiant                VARCHAR(255) NOT NULL,
	password                   VARCHAR(130) NOT NULL,
	name                       VARCHAR(255) NOT NULL,
	firstname                  VARCHAR(255) NOT NULL,
	email                      TEXT(512) NOT NULL,
	registration_date          DATETIME NOT NULL,
	levelMember_idLevelMember  INT NOT NULL,
	agency_idAgency            INT NOT NULL,
	PRIMARY KEY (idUser),
	FOREIGN KEY (levelMember_idLevelMember) REFERENCES LevelMember (idLevelMember),
	FOREIGN KEY (agency_idAgency) REFERENCES Agency (idAgency))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Log (
	idLog                      INT AUTO_INCREMENT NOT NULL,
	dateLog                    DATETIME NOT NULL,
	pluginName                 VARCHAR(255) NOT NULL,
	log                        TEXT(1000) NOT NULL,
	user_idUser                INT NOT NULL,
	PRIMARY KEY (idLog),
	FOREIGN KEY (user_idUser) REFERENCES User (idUser))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE HistoricConnection (
	idHistoricConnection       INT AUTO_INCREMENT NOT NULL,
	dateConnection             DATETIME NOT NULL,
	user_idUser                INT NOT NULL,
	PRIMARY KEY (idHistoricConnection),
	FOREIGN KEY (user_idUser) REFERENCES User (idUser))
ENGINE = MYISAM CHARACTER SET UTF8;
