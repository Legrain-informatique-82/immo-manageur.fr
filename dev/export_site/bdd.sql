

CREATE TABLE SiteExportFourchettePrix (
idSiteExportFourchettePrix         INT AUTO_INCREMENT NOT NULL,
name                               VARCHAR(250) NOT NULL,
valMin                             INT NOT NULL,
valMax                             INT NOT NULL,
transactionType_idTransactionType  INT NOT NULL,
mandateType_idMandateType          INT NOT NULL,
PRIMARY KEY (idSiteExportFourchettePrix),
FOREIGN KEY (transactionType_idTransactionType) REFERENCES TransactionType (idTransactionType),
FOREIGN KEY (mandateType_idMandateType) REFERENCES MandateType (idMandateType))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE SiteExportFourchetteTaille (
idSiteExportFourchetteTaille       INT AUTO_INCREMENT NOT NULL,
name                               VARCHAR(250) NOT NULL,
valMin                             INT NOT NULL,
valMax                             INT NOT NULL,
transactionType_idTransactionType  INT NOT NULL,
mandateType_idMandateType          INT NOT NULL,
PRIMARY KEY (idSiteExportFourchetteTaille),
FOREIGN KEY (transactionType_idTransactionType) REFERENCES TransactionType (idTransactionType),
FOREIGN KEY (mandateType_idMandateType) REFERENCES MandateType (idMandateType))
ENGINE = MYISAM CHARACTER SET UTF8;



CREATE TABLE SiteExportTheme (
	idSiteExportTheme        INT AUTO_INCREMENT NOT NULL,
	name                     VARCHAR(250) NOT NULL,
	PRIMARY KEY (idSiteExportTheme))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE SiteExport (
	idSiteExport             INT AUTO_INCREMENT NOT NULL,
	robots                   TINYINT(1) DEFAULT FALSE NOT NULL,
	nbAnnoncesParPage        INT NOT NULL,
	txtIndex                 VARCHAR(250) NOT NULL,
	emailContact             VARCHAR(250) NOT NULL,
	nbNouveauteParAgence     INT NOT NULL,
	nomSite                  VARCHAR(250) NOT NULL,
	titreAccueil             VARCHAR(250) NOT NULL,
	metaDescriptionAccueil   VARCHAR(250) NOT NULL,
	header                   VARCHAR(250) NOT NULL,
	logo                     VARCHAR(250) NOT NULL,
	theme_idSiteExportTheme  INT NOT NULL,
	PRIMARY KEY (idSiteExport),
	FOREIGN KEY (theme_idSiteExportTheme) REFERENCES SiteExportTheme (idSiteExportTheme))
ENGINE = MYISAM CHARACTER SET UTF8;

INSERT INTO  SiteExportTheme (`idSiteExportTheme` ,`name`)VALUES ('1',  'defaut');





CREATE TABLE SiteExportVariable (
	idSiteExportVariable  INT AUTO_INCREMENT NOT NULL,
	name                  VARCHAR(250) NOT NULL,
	label                 VARCHAR(250) NOT NULL,
	exportName            VARCHAR(250) NOT NULL,
	value                 VARCHAR(250) NOT NULL,
	type                  VARCHAR(250) NOT NULL,
	PRIMARY KEY (idSiteExportVariable))
ENGINE = MYISAM CHARACTER SET UTF8;




CREATE TABLE CmsMenu (
	idCmsMenu          INT AUTO_INCREMENT NOT NULL,
	name               INT NOT NULL,
	cmsMenu_idCmsMenu  INT,
	PRIMARY KEY (idCmsMenu),
	FOREIGN KEY (cmsMenu_idCmsMenu) REFERENCES CmsMenu (idCmsMenu))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Cms (
	idCms              INT AUTO_INCREMENT NOT NULL,
	publicName         VARCHAR(250) NOT NULL,
	privateName        VARCHAR(250) NOT NULL,
	title              VARCHAR(250) NOT NULL,
	url                VARCHAR(250) NOT NULL,
	description        VARCHAR(250) NOT NULL,
	content            VARCHAR(250) NOT NULL,
	position           INT NOT NULL,
	cmsMenu_idCmsMenu  INT NOT NULL,
	PRIMARY KEY (idCms),
	FOREIGN KEY (cmsMenu_idCmsMenu) REFERENCES CmsMenu (idCmsMenu))
ENGINE = MYISAM CHARACTER SET UTF8;



