CREATE TABLE MandateCom (
	idMandateCom       INT AUTO_INCREMENT NOT NULL,
	mandate_idMandate  INT NOT NULL,
	com                VARCHAR(250) NOT NULL,
	infoVisite         VARCHAR(250) NOT NULL,
	otherCom           VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateCom),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;
ALTER TABLE `MandateCom` CHANGE `com` `com` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE `infoVisite` `infoVisite` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE `otherCom` `otherCom` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL 