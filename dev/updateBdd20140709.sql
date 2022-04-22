ALTER TABLE `Acquereur` ENGINE=InnoDB;
ALTER TABLE `AcquereurAssocie` ENGINE=InnoDB;
ALTER TABLE `Action` ENGINE=InnoDB;
ALTER TABLE `Agency` ENGINE=InnoDB;
ALTER TABLE `categorycontact` ENGINE=InnoDB;
ALTER TABLE `categorycontact_contact` ENGINE=InnoDB;
ALTER TABLE `champscontact` ENGINE=InnoDB;
ALTER TABLE `City` ENGINE=InnoDB;
ALTER TABLE `Cms` ENGINE=InnoDB;
ALTER TABLE `CmsMenu` ENGINE=InnoDB;
ALTER TABLE `contact` ENGINE=InnoDB;
ALTER TABLE `Critere_acquereur` ENGINE=InnoDB;
ALTER TABLE `Critere_mandate` ENGINE=InnoDB;
ALTER TABLE `Documents` ENGINE=InnoDB;
ALTER TABLE `Dpe` ENGINE=InnoDB;
ALTER TABLE `DpeConsoEner` ENGINE=InnoDB;
ALTER TABLE `DpeEmissionGaz` ENGINE=InnoDB;
ALTER TABLE `HistoricConnection` ENGINE=InnoDB;
ALTER TABLE `LevelMember` ENGINE=InnoDB;
ALTER TABLE `LiasonPasserelleMandat` ENGINE=InnoDB;
ALTER TABLE `LibelAction` ENGINE=InnoDB;
ALTER TABLE `Log` ENGINE=InnoDB;
ALTER TABLE `LogTransfert` ENGINE=InnoDB;
ALTER TABLE `Mandate` ENGINE=InnoDB;
ALTER TABLE `MandateAdjoining` ENGINE=InnoDB;
ALTER TABLE `MandateBornageTerrain` ENGINE=InnoDB;
ALTER TABLE `MandateCom` ENGINE=InnoDB;
ALTER TABLE `MandateCommonOwnership` ENGINE=InnoDB;
ALTER TABLE `MandateCondition` ENGINE=InnoDB;
ALTER TABLE `MandateConstructionType` ENGINE=InnoDB;
ALTER TABLE `MandateCOS` ENGINE=InnoDB;
ALTER TABLE `MandateDescription` ENGINE=InnoDB;
ALTER TABLE `MandateElectricCorresponding` ENGINE=InnoDB;
ALTER TABLE `MandateEtap` ENGINE=InnoDB;
ALTER TABLE `MandateGazCorresponding` ENGINE=InnoDB;
ALTER TABLE `MandateGeometer` ENGINE=InnoDB;
ALTER TABLE `MandateHeating` ENGINE=InnoDB;
ALTER TABLE `MandateInsulation` ENGINE=InnoDB;
ALTER TABLE `MandateNature` ENGINE=InnoDB;
ALTER TABLE `MandateNews` ENGINE=InnoDB;
ALTER TABLE `MandateOrientation` ENGINE=InnoDB;
ALTER TABLE `MandatePicture` ENGINE=InnoDB;
ALTER TABLE `MandateRoof` ENGINE=InnoDB;
ALTER TABLE `MandateSanitationCorresponding` ENGINE=InnoDB;
ALTER TABLE `MandateScan` ENGINE=InnoDB;
ALTER TABLE `MandateSlope` ENGINE=InnoDB;
ALTER TABLE `MandateStyle` ENGINE=InnoDB;
ALTER TABLE `MandateType` ENGINE=InnoDB;
ALTER TABLE `MandateWaterCorresponding` ENGINE=InnoDB;
ALTER TABLE `MandateZonagePLU` ENGINE=InnoDB;
ALTER TABLE `MandateZonageRNU` ENGINE=InnoDB;
ALTER TABLE `Mandate_Seller` ENGINE=InnoDB;
ALTER TABLE `notary` ENGINE=InnoDB;
ALTER TABLE `notaryclerk` ENGINE=InnoDB;
ALTER TABLE `OtherComplementMandate` ENGINE=InnoDB;
ALTER TABLE `Passerelle` ENGINE=InnoDB;
ALTER TABLE `PhotosExports` ENGINE=InnoDB;
ALTER TABLE `Rapprochement` ENGINE=InnoDB;
ALTER TABLE `RelSituaTionAcq` ENGINE=InnoDB;
ALTER TABLE `Sector` ENGINE=InnoDB;
ALTER TABLE `Seller` ENGINE=InnoDB;
ALTER TABLE `SellerTitle` ENGINE=InnoDB;
ALTER TABLE `SiteExport` ENGINE=InnoDB;
ALTER TABLE `SiteExportFourchettePrix` ENGINE=InnoDB;
ALTER TABLE `SiteExportFourchetteTaille` ENGINE=InnoDB;
ALTER TABLE `SiteExportTheme` ENGINE=InnoDB;
ALTER TABLE `SiteExportVariable` ENGINE=InnoDB;
ALTER TABLE `SituationAcquereur` ENGINE=InnoDB;
ALTER TABLE `TitreAcquereur` ENGINE=InnoDB;
ALTER TABLE `TransactionType` ENGINE=InnoDB;
ALTER TABLE `typechampscontact` ENGINE=InnoDB;
ALTER TABLE `Upload` ENGINE=InnoDB;
ALTER TABLE `User` ENGINE=InnoDB;
ALTER TABLE `ValDpe` ENGINE=InnoDB;

-- Table Acquereur

ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`villeAcquereur`) REFERENCES `City`(`idCity`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`titreAcquereur_idTitreAcquereur`) REFERENCES `TitreAcquereur`(`idTitreAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`transactionType_idTransactionType`) REFERENCES `TransactionType`(`idTransactionType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`mandateStyle_idMandateStyle`) REFERENCES `MandateStyle`(`idMandateStyle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`rechercheCity_idCity`) REFERENCES `City`(`idCity`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`rechercheSector_idSector`) REFERENCES `Sector`(`idSector`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Acquereur` ADD  FOREIGN KEY (`mandateType_idMandateType`) REFERENCES `MandateType`(`idMandateType`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- Table AcquereurAssocie
ALTER TABLE `AcquereurAssocie` ADD  FOREIGN KEY (`city_idCity`) REFERENCES `City`(`idCity`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `AcquereurAssocie` ADD  FOREIGN KEY (`acquereur_idAcquereur`) REFERENCES `Acquereur`(`idAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `AcquereurAssocie` ADD  FOREIGN KEY (`titreAcquereur_idTitreAcquereur`) REFERENCES `TitreAcquereur`(`idTitreAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Table Action
ALTER TABLE `Action` ADD  FOREIGN KEY (`from_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Action` ADD  FOREIGN KEY (`to_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Action` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;



-- categorycontact_contact
ALTER TABLE `categorycontact_contact` ADD  FOREIGN KEY (`fk_idcontact`) REFERENCES `contact`(`idcontact`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `categorycontact_contact` ADD  FOREIGN KEY (`fk_idcategorycontact`) REFERENCES `categorycontact`(`idcategorycontact`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- champscontact
ALTER TABLE `champscontact` ADD  FOREIGN KEY (`contact_idcontact`) REFERENCES `contact`(`idcontact`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `champscontact` ADD  FOREIGN KEY (`typechampscontact_idtypechampscontact`) REFERENCES `typechampscontact`(`idtypechampscontact`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- City
ALTER TABLE `City` ADD  FOREIGN KEY (`sector_idSector`) REFERENCES `Sector`(`idSector`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Cms
ALTER TABLE `Cms` ADD  FOREIGN KEY (`cmsMenu_idCmsMenu`) REFERENCES `CmsMenu`(`idCmsMenu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- CmsMenu
ALTER TABLE `CmsMenu` ADD  FOREIGN KEY (`cmsMenu_idCmsMenu`) REFERENCES `CmsMenu`(`idCmsMenu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- contact
ALTER TABLE `contact` ADD  FOREIGN KEY (`user_iduser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- HistoricConnection
ALTER TABLE `HistoricConnection` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- LiasonPasserelleMandat
ALTER TABLE `LiasonPasserelleMandat` ADD  FOREIGN KEY (`passerelle_idPasserelle`) REFERENCES `Passerelle`(`idPasserelle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `LiasonPasserelleMandat` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Log
ALTER TABLE `Log` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- LogTransfert
ALTER TABLE `LogTransfert` ADD  FOREIGN KEY (`passerelle_idPasserelle`) REFERENCES `Passerelle`(`idPasserelle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `LogTransfert` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Mandate
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`city_idCity`) REFERENCES `City`(`idCity`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`sector_idSector`) REFERENCES `Sector`(`idSector`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`notary_idNotary`) REFERENCES `notary`(`idnotary`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`mandateType_idMandateType`) REFERENCES `MandateType`(`idMandateType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`transactionType_idTransactionType`) REFERENCES `TransactionType`(`idTransactionType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`slope_idMandateSlope`) REFERENCES `MandateSlope`(`idMandateSlope`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`orientation_idMandateOrientation`) REFERENCES `MandateOrientation`(`idMandateOrientation`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`insulation_idMandateInsulation`) REFERENCES `MandateInsulation`(`idMandateInsulation`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`news_idMandateNews`) REFERENCES `MandateNews`(`idMandateNews`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`heating_idMandateHeating`) REFERENCES `MandateHeating`(`idMandateHeating`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`commonOwnership_idMandateCommonOwnership`) REFERENCES `MandateCommonOwnership`(`idMandateCommonOwnership`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`roof_idMandateRoof`) REFERENCES `MandateRoof`(`idMandateRoof`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`condition_idMandateCondition`) REFERENCES `MandateCondition`(`idMandateCondition`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`style_idMandateStyle`) REFERENCES `MandateStyle`(`idMandateStyle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`construction_idMandateConstructionType`) REFERENCES `MandateConstructionType`(`idMandateConstructionType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`sanitationCorresponding_idMandateSanitationCorresponding`) REFERENCES `MandateSanitationCorresponding`(`idMandateSanitationCorresponding`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`electricCorresponding_idMandateElectricCorresponding`) REFERENCES `MandateElectricCorresponding`(`idMandateElectricCorresponding`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`gazCorresponding_idMandateGazCorresponding`) REFERENCES `MandateGazCorresponding`(`idMandateGazCorresponding`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`waterCorresponding_idMandateWaterCorresponding`) REFERENCES `MandateWaterCorresponding`(`idMandateWaterCorresponding`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`cos_idMandateCOS`) REFERENCES `MandateCOS`(`idMandateCOS`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`zonagePLU_idMandateZonagePLU`) REFERENCES `MandateZonagePLU`(`idMandateZonagePLU`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`zonageRNU_idMandateZonageRNU`) REFERENCES `MandateZonageRNU`(`idMandateZonageRNU`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`bornageTerrain_idMandateBornageTerrain`) REFERENCES `MandateBornageTerrain`(`idMandateBornageTerrain`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`geometer_idMandateGeometer`) REFERENCES `MandateGeometer`(`idMandateGeometer`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`etap_idMandateEtap`) REFERENCES `MandateEtap`(`idMandateEtap`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`nature_idMandateNature`) REFERENCES `MandateNature`(`idMandateNature`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate` ADD  FOREIGN KEY (`MandateAdjoining_idMandateAdjoining`) REFERENCES `MandateAdjoining`(`idMandateAdjoining`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- MandatePicture
ALTER TABLE `MandatePicture` ADD  FOREIGN KEY (`fk_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- OtherComplementMandate
ALTER TABLE `OtherComplementMandate` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Mandate_Seller
ALTER TABLE `Mandate_Seller` ADD  FOREIGN KEY (`fk_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Mandate_Seller` ADD  FOREIGN KEY (`fk_idSeller`) REFERENCES `Seller`(`idSeller`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- notaryclerk
ALTER TABLE `notaryclerk` ADD  FOREIGN KEY (`notary_idnotary`) REFERENCES `notary`(`idnotary`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- PhotosExports
ALTER TABLE `PhotosExports` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Rapprochement
ALTER TABLE `Rapprochement` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Rapprochement` ADD  FOREIGN KEY (`acquereur_idAcquereur`) REFERENCES `Acquereur`(`idAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Rapprochement` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- RelSituaTionAcq
ALTER TABLE `RelSituaTionAcq` ADD  FOREIGN KEY (`acquereur_idAcquereur`) REFERENCES `Acquereur`(`idAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `RelSituaTionAcq` ADD  FOREIGN KEY (`acquereurAssocie_idAcquereurAssocie`) REFERENCES `AcquereurAssocie`(`idAcquereurAssocie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `RelSituaTionAcq` ADD  FOREIGN KEY (`situationAcquereur_idSituationAcquereur`) REFERENCES `SituationAcquereur`(`idSituationAcquereur`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- Seller
ALTER TABLE `Seller` ADD  FOREIGN KEY (`city_idCity`) REFERENCES `City`(`idCity`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Seller` ADD  FOREIGN KEY (`sellerTitle_idSellerTitle`) REFERENCES `SellerTitle`(`idSellerTitle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Seller` ADD  FOREIGN KEY (`user_idUser`) REFERENCES `User`(`idUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- SiteExport
ALTER TABLE `SiteExport` ADD  FOREIGN KEY (`theme_idSiteExportTheme`) REFERENCES `SiteExportTheme`(`idSiteExportTheme`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- SiteExportFourchettePrix
ALTER TABLE `SiteExportFourchettePrix` ADD  FOREIGN KEY (`transactionType_idTransactionType`) REFERENCES `TransactionType`(`idTransactionType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `SiteExportFourchettePrix` ADD  FOREIGN KEY (`mandateType_idMandateType`) REFERENCES `MandateType`(`idMandateType`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- SiteExportFourchetteTaille
ALTER TABLE `SiteExportFourchetteTaille` ADD  FOREIGN KEY (`transactionType_idTransactionType`) REFERENCES `TransactionType`(`idTransactionType`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `SiteExportFourchetteTaille` ADD  FOREIGN KEY (`mandateType_idMandateType`) REFERENCES `MandateType`(`idMandateType`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Upload
ALTER TABLE `Upload` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- User
ALTER TABLE `User` ADD  FOREIGN KEY (`levelMember_idLevelMember`) REFERENCES `LevelMember`(`idLevelMember`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `User` ADD  FOREIGN KEY (`agency_idAgency`) REFERENCES `Agency`(`idAgency`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ValDpe
ALTER TABLE `ValDpe` ADD  FOREIGN KEY (`mandate_idMandate`) REFERENCES `Mandate`(`idMandate`) ON DELETE RESTRICT ON UPDATE RESTRICT;




CREATE TABLE categorydocument (
  idcategorydocument                   INT AUTO_INCREMENT NOT NULL,
  name                                 VARCHAR(255) NOT NULL,
  PRIMARY KEY (idcategorydocument))
  ENGINE = InnoDB CHARACTER SET UTF8;

ALTER TABLE  `categorydocument` ADD  `code` VARCHAR( 255 ) NOT NULL ;

ALTER TABLE `Documents` ADD  (name varchar(255) NULL, categorydocument_idcategorydocument  INT NOT NULL );
ALTER TABLE  `Documents` DROP  `sizetext` ,
DROP  `other` ;

UPDATE `Documents` SET categorydocument_idcategorydocument=1;
ALTER TABLE `Documents` ADD FOREIGN KEY (`categorydocument_idcategorydocument`) REFERENCES `categorydocument`(`idcategorydocument`) ON DELETE RESTRICT ON UPDATE RESTRICT;


CREATE TABLE documents_mandateetap (
  fk_iddocuments                       INT NOT NULL,
  fk_idmandateetap                     INT NOT NULL,
  PRIMARY KEY (fk_iddocuments,fk_idmandateetap),
  FOREIGN KEY (fk_iddocuments) REFERENCES Documents (idDocument),
  FOREIGN KEY (fk_idmandateetap) REFERENCES MandateEtap (idMandateEtap))
  ENGINE = InnoDB CHARACTER SET UTF8;

CREATE TABLE documents_mandatetype (
  fk_iddocuments                       INT NOT NULL,
  fk_idmandatetype                     INT NOT NULL,
  PRIMARY KEY (fk_iddocuments,fk_idmandatetype),
  FOREIGN KEY (fk_iddocuments) REFERENCES Documents (idDocument),
  FOREIGN KEY (fk_idmandatetype) REFERENCES MandateType (idMandateType))
  ENGINE = InnoDB CHARACTER SET UTF8;
