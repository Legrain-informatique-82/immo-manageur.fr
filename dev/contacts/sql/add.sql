CREATE TABLE user (
	iduser                                 INT AUTO_INCREMENT NOT NULL,
	a                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (iduser))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE typechampscontact (
	idtypechampscontact                    INT AUTO_INCREMENT NOT NULL,
	libel                                  VARCHAR(250) NOT NULL,
	numberused                             INT NOT NULL,
	position                               INT NOT NULL,
	PRIMARY KEY (idtypechampscontact))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE champscontact (
	idchampscontact                        INT AUTO_INCREMENT NOT NULL,
	libel                                  VARCHAR(5000) NOT NULL,
	val                                    VARCHAR(5000) NOT NULL,
	position                               INT NOT NULL,
	indestructible                         TINYINT(1) DEFAULT FALSE NOT NULL,
	typechampscontact_idtypechampscontact  INT NOT NULL,
	contact_idcontact                      INT NOT NULL,
	PRIMARY KEY (idchampscontact),
	FOREIGN KEY (typechampscontact_idtypechampscontact) REFERENCES typechampscontact (idtypechampscontact),
	FOREIGN KEY (contact_idcontact) REFERENCES contact (idcontact))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE categorycontact (
	idcategorycontact                      INT AUTO_INCREMENT NOT NULL,
	name                                   VARCHAR(250) NOT NULL,
	PRIMARY KEY (idcategorycontact))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE contact (
	idcontact                              INT AUTO_INCREMENT NOT NULL,
	datecreation                           DATETIME NOT NULL,
	user_iduser                            INT NOT NULL,
	PRIMARY KEY (idcontact),
	FOREIGN KEY (user_iduser) REFERENCES user (iduser))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE categorycontact_contact (
	fk_idcontact                           INT NOT NULL,
	fk_idcategorycontact                   INT NOT NULL,
	PRIMARY KEY (fk_idcontact,fk_idcategorycontact),
	FOREIGN KEY (fk_idcontact) REFERENCES contact (idcontact),
	FOREIGN KEY (fk_idcategorycontact) REFERENCES categorycontact (idcategorycontact))
ENGINE = MYISAM CHARACTER SET UTF8;