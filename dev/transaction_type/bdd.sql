CREATE TABLE TransactionType (
	idTransactionType  INT AUTO_INCREMENT NOT NULL,
	name               VARCHAR(250) NOT NULL,
	exportCode         VARCHAR(250) NOT NULL,
	PRIMARY KEY (idTransactionType))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateType (
	idMandateType      INT AUTO_INCREMENT NOT NULL,
	name               VARCHAR(250) NOT NULL,
	exportCode         VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateType))
ENGINE = MYISAM CHARACTER SET UTF8;
