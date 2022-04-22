CREATE TABLE User (
	idUser                                                    INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idUser))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Sector (
	idSector                                                  INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idSector))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE City (
	idCity                                                    INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idCity))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Notary (
	idNotary                                                  INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idNotary))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateType (
	idMandateType                                             INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idMandateType))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE TransactionType (
	idTransactionType                                         INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	PRIMARY KEY (idTransactionType))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Seller (
	idSeller                                                  INT AUTO_INCREMENT NOT NULL,
	n                                                         INT NOT NULL,
	fk_idMandate                                              INT,
	PRIMARY KEY (idSeller),
	FOREIGN KEY (fk_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandatePicture (
	idMandatePicture                                          INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	isDefault                                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	fk_idMandate                                              INT,
	PRIMARY KEY (idMandatePicture),
	FOREIGN KEY (fk_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateSlope (
	idMandateSlope                                            INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateSlope))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateScan (
	idMandateScan                                             INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	fk_idMandate                                              INT,
	PRIMARY KEY (idMandateScan),
	FOREIGN KEY (fk_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateOrientation (
	idMandateOrientation                                      INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateOrientation))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateInsulation (
	idMandateInsulation                                       INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateInsulation))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateNews (
	idMandateNews                                             INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateNews))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateHeating (
	idMandateHeating                                          INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateHeating))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateCommonOwnership (
	idMandateCommonOwnership                                  INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateCommonOwnership))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateRoof (
	idMandateRoof                                             INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateRoof))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateCondition (
	idMandateCondition                                        INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateCondition))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateStyle (
	idMandateStyle                                            INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateStyle))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateConstructionType (
	idMandateConstructionType                                 INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateConstructionType))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateSanitationCorresponding (
	idMandateSanitationCorresponding                          INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateSanitationCorresponding))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateElectricCorresponding (
	idMandateElectricCorresponding                            INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateElectricCorresponding))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateGazCorresponding (
	idMandateGazCorresponding                                 INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateGazCorresponding))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateWaterCorresponding (
	idMandateWaterCorresponding                               INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateWaterCorresponding))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateCOS (
	idMandateCOS                                              INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateCOS))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateZonagePLU (
	idMandateZonagePLU                                        INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateZonagePLU))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateZonageRNU (
	idMandateZonageRNU                                        INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateZonageRNU))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateBornageTerrain (
	idMandateBornageTerrain                                   INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateBornageTerrain))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateGeometer (
	idMandateGeometer                                         INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateGeometer))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE MandateEtap (
	idMandateEtap                                             INT AUTO_INCREMENT NOT NULL,
	name                                                      VARCHAR(250) NOT NULL,
	code                                                      VARCHAR(250) NOT NULL,
	PRIMARY KEY (idMandateEtap))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE Mandate (
	idMandate                                                 INT AUTO_INCREMENT NOT NULL,
	numberMandate                                             INT NOT NULL,
	initDate                                                  DATE NOT NULL,
	deadDate                                                  DATE NOT NULL,
	address                                                   VARCHAR(250) NOT NULL,
	priceFai                                                  DECIMAL NOT NULL,
	priceSeller                                               DECIMAL NOT NULL,
	commission                                                DECIMAL NOT NULL,
	estimationFai                                             DECIMAL NOT NULL,
	margeNegociation                                          DECIMAL NOT NULL,
	referenceCadastreParcelle1                                VARCHAR(250) NOT NULL,
	referenceCadastreParcelle2                                VARCHAR(250) NOT NULL,
	referenceCadastreParcelle3                                VARCHAR(250) NOT NULL,
	autreReferenceParcelle                                    VARCHAR(250) NOT NULL,
	superficieParcelle1                                       INT NOT NULL,
	superficieParcelle2                                       INT NOT NULL,
	superficieParcelle3                                       INT NOT NULL,
	superficieAutreParcelle                                   INT NOT NULL,
	superficieConstructible                                   INT NOT NULL,
	superficieTotale                                          INT NOT NULL,
	numberLot                                                 VARCHAR(10) NOT NULL,
	sHONAccordee                                              INT NOT NULL,
	zoneBDF                                                   TINYINT(1) DEFAULT FALSE NOT NULL,
	ligneDeCrete                                              TINYINT(1) DEFAULT FALSE NOT NULL,
	zoneInondable                                             TINYINT(1) DEFAULT FALSE NOT NULL,
	reglementDeLotissement                                    TEXT(900) NOT NULL,
	eRNT                                                      VARCHAR(250) NOT NULL,
	dPValide                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	dateDeclarationPrealable                                  DATE NOT NULL,
	prorogationDPJusquau                                      DATE NOT NULL,
	cuValide                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	dateCU                                                    TINYINT(1) DEFAULT FALSE NOT NULL,
	prorogationCUJusquau                                      TINYINT(1) DEFAULT FALSE NOT NULL,
	cuOPSValide                                               TINYINT(1) DEFAULT FALSE NOT NULL,
	dateCuOPS                                                 DATE NOT NULL,
	prorogationCuOPSJusquau                                   TINYINT(1) DEFAULT FALSE NOT NULL,
	permisDamenagerValide                                     TINYINT(1) DEFAULT FALSE NOT NULL,
	datePermisDamenager                                       DATE NOT NULL,
	terrainVenduViabilise                                     TINYINT(1) DEFAULT FALSE NOT NULL,
	terrainVenduSemiViabilise                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	terrainVenduNonViabilise                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	passageEau                                                TEXT(900) NOT NULL,
	passageElectricite                                        TEXT(900) NOT NULL,
	passageGaz                                                TEXT(900) NOT NULL,
	toutALegout                                               TINYINT(1) DEFAULT FALSE NOT NULL,
	assainissementParFosseSceptique                           TINYINT(1) DEFAULT FALSE NOT NULL,
	voirie                                                    TEXT(900) NOT NULL,
	tailleFacade                                              INT NOT NULL,
	profondeurTerrain                                         INT NOT NULL,
	commentaire                                               TEXT(5000) NOT NULL,
	geolocalisation                                           VARCHAR(250) NOT NULL,
	proximiteEcole                                            INT NOT NULL,
	proximiteCommerce                                         INT NOT NULL,
	proximiteTransport                                        INT NOT NULL,
	commentaireApparent                                       VARCHAR(200) NOT NULL,
	nbPiece                                                   INT NOT NULL,
	surfaceHabitable                                          INT NOT NULL,
	nbChambre                                                 INT NOT NULL,
	surfacePieceVie                                           INT NOT NULL,
	niveau                                                    INT NOT NULL,
	anneeConstruction                                         INT NOT NULL,
	coupCoeur                                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	chargesMensuelle                                          INT NOT NULL,
	taxesFonciere                                             INT NOT NULL,
	taxeHabitation                                            INT NOT NULL,
	nouveaute                                                 DATE NOT NULL,
	cheminee                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	cuisineEquipee                                            TINYINT(1) DEFAULT FALSE NOT NULL,
	cuisineAmenagee                                           TINYINT(1) DEFAULT FALSE NOT NULL,
	piscine                                                   TINYINT(1) DEFAULT FALSE NOT NULL,
	poolHouse                                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	terrasse                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	mezzanine                                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	dependance                                                TINYINT(1) DEFAULT FALSE NOT NULL,
	gaz                                                       TINYINT(1) DEFAULT FALSE NOT NULL,
	cave                                                      TINYINT(1) DEFAULT FALSE NOT NULL,
	sousSol                                                   TINYINT(1) DEFAULT FALSE NOT NULL,
	garage                                                    TINYINT(1) DEFAULT FALSE NOT NULL,
	parking                                                   TINYINT(1) DEFAULT FALSE NOT NULL,
	rezDeJardin                                               TINYINT(1) DEFAULT FALSE NOT NULL,
	plainPied                                                 TINYINT(1) DEFAULT FALSE NOT NULL,
	carriere                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	pointEau                                                  TINYINT(1) DEFAULT FALSE NOT NULL,
	user_idUser                                               INT NOT NULL,
	sector_idSector                                           INT NOT NULL,
	city_idCity                                               INT NOT NULL,
	notary_idNotary                                           INT NOT NULL,
	mandateType_idMandateType                                 INT NOT NULL,
	transactionType_idTransactionType                         INT NOT NULL,
	slope_idMandateSlope                                      INT NOT NULL,
	orientation_idMandateOrientation                          INT NOT NULL,
	insulation_idMandateInsulation                            INT NOT NULL,
	news_idMandateNews                                        INT NOT NULL,
	heating_idMandateHeating                                  INT NOT NULL,
	commonOwnership_idMandateCommonOwnership                  INT NOT NULL,
	roof_idMandateRoof                                        INT NOT NULL,
	condition_idMandateCondition                              INT NOT NULL,
	style_idMandateStyle                                      INT NOT NULL,
	construction_idMandateConstructionType                    INT NOT NULL,
	sanitationCorresponding_idMandateSanitationCorresponding  INT NOT NULL,
	electricCorresponding_idMandateElectricCorresponding      INT NOT NULL,
	gazCorresponding_idMandateGazCorresponding                INT NOT NULL,
	waterCorresponding_idMandateWaterCorresponding            INT NOT NULL,
	cos_idMandateCOS                                          INT NOT NULL,
	zonagePLU_idMandateZonagePLU                              INT NOT NULL,
	zonageRNU_idMandateZonageRNU                              INT NOT NULL,
	bornageTerrain_idMandateBornageTerrain                    INT NOT NULL,
	geometer_idMandateGeometer                                INT NOT NULL,
	etap_idMandateEtap                                        INT NOT NULL,
	PRIMARY KEY (idMandate),
	FOREIGN KEY (user_idUser) REFERENCES User (idUser),
	FOREIGN KEY (sector_idSector) REFERENCES Sector (idSector),
	FOREIGN KEY (city_idCity) REFERENCES City (idCity),
	FOREIGN KEY (notary_idNotary) REFERENCES Notary (idNotary),
	FOREIGN KEY (mandateType_idMandateType) REFERENCES MandateType (idMandateType),
	FOREIGN KEY (transactionType_idTransactionType) REFERENCES TransactionType (idTransactionType),
	FOREIGN KEY (slope_idMandateSlope) REFERENCES MandateSlope (idMandateSlope),
	FOREIGN KEY (orientation_idMandateOrientation) REFERENCES MandateOrientation (idMandateOrientation),
	FOREIGN KEY (insulation_idMandateInsulation) REFERENCES MandateInsulation (idMandateInsulation),
	FOREIGN KEY (news_idMandateNews) REFERENCES MandateNews (idMandateNews),
	FOREIGN KEY (heating_idMandateHeating) REFERENCES MandateHeating (idMandateHeating),
	FOREIGN KEY (commonOwnership_idMandateCommonOwnership) REFERENCES MandateCommonOwnership (idMandateCommonOwnership),
	FOREIGN KEY (roof_idMandateRoof) REFERENCES MandateRoof (idMandateRoof),
	FOREIGN KEY (condition_idMandateCondition) REFERENCES MandateCondition (idMandateCondition),
	FOREIGN KEY (style_idMandateStyle) REFERENCES MandateStyle (idMandateStyle),
	FOREIGN KEY (construction_idMandateConstructionType) REFERENCES MandateConstructionType (idMandateConstructionType),
	FOREIGN KEY (sanitationCorresponding_idMandateSanitationCorresponding) REFERENCES MandateSanitationCorresponding (idMandateSanitationCorresponding),
	FOREIGN KEY (electricCorresponding_idMandateElectricCorresponding) REFERENCES MandateElectricCorresponding (idMandateElectricCorresponding),
	FOREIGN KEY (gazCorresponding_idMandateGazCorresponding) REFERENCES MandateGazCorresponding (idMandateGazCorresponding),
	FOREIGN KEY (waterCorresponding_idMandateWaterCorresponding) REFERENCES MandateWaterCorresponding (idMandateWaterCorresponding),
	FOREIGN KEY (cos_idMandateCOS) REFERENCES MandateCOS (idMandateCOS),
	FOREIGN KEY (zonagePLU_idMandateZonagePLU) REFERENCES MandateZonagePLU (idMandateZonagePLU),
	FOREIGN KEY (zonageRNU_idMandateZonageRNU) REFERENCES MandateZonageRNU (idMandateZonageRNU),
	FOREIGN KEY (bornageTerrain_idMandateBornageTerrain) REFERENCES MandateBornageTerrain (idMandateBornageTerrain),
	FOREIGN KEY (geometer_idMandateGeometer) REFERENCES MandateGeometer (idMandateGeometer),
	FOREIGN KEY (etap_idMandateEtap) REFERENCES MandateEtap (idMandateEtap))
ENGINE = MYISAM CHARACTER SET UTF8;

CREATE TABLE OtherComplementMandate (
	idOtherComplementMandate  INT AUTO_INCREMENT NOT NULL,
	afficheEnVitrine          TINYINT(1) DEFAULT FALSE NOT NULL,
	mandate_idMandate         INT NOT NULL,
	PRIMARY KEY (idOtherComplementMandate),
	FOREIGN KEY (mandate_idMandate) REFERENCES Mandate (idMandate))
ENGINE = MYISAM CHARACTER SET UTF8;