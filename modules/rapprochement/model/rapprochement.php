<?php
/**
 *
 * Classe abstraite de rapprochement entre les mandats et les acquereurs
 *
 */
abstract class Rapprochement{
	/**
	 *
	 * @param Acquereur $acq
	 * @return $listMandate
	 */
	public static function listMandateForAcq(PDO $pdo,Acquereur $acq){
		$where = array();
		// Finir la requete .

		$sql = "SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller,
		 m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2,
	 	 m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, 
	 	 m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieNonConstructible, 
	 	 m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, 
	 	 m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire,
	 	 m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, 
	 	 m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle,
	 	 m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary,
	 	 m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, 
	 	 m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau,
	 	 m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, 
	 	 m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, 
	 	 m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute,
	 	 m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine,
	 	 m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, 
	 	 m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation,
	 	 m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, 
	 	 m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, 
	 	 m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, 
	 	 m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, 
	 	 m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, 
	 	 m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer 
	 	 FROM Mandate m WHERE  m.etap_idMandateEtap=".Constant::ID_ETAP_TO_SELL;

		// voir en fct des critères
		// champs obligatoires
		// type transaction
		$sql.=" AND (m.transactionType_idTransactionType = ?)";
		$where[] = $acq->getTransactionType()->getIdTransactionType();
		// type de mandat
		if($acq->getMandateType()){
			$sql.=" AND (m.mandateType_idMandateType = ?)";
			$where[] = $acq->getMandateType()->getIdMandateType();
		}

		// champs facultatifs
		// prix
		$sql.= " AND (m.priceFai >= ?) ";
		$where[] = $acq->getPriceMin();
		if($acq->getPriceMax()!=0){
			$sql.= " AND (m.priceFai <= ?) ";
			$where[] = $acq->getPriceMax();
		}
		// si different de 0, on regarde.
		if( $acq->getSurfaceTerrainMin() > 0 ){
			$sql.=" AND ( m.superficieTotale >= ?)";
			$where[] = $acq->getSurfaceTerrainMin();
		}
		if( $acq->getSurfaceTerrainMax() > 0 ){
			$sql.=" AND ( m.superficieTotale <= ?)";
			$where[] = $acq->getSurfaceTerrainMax();
		}

		// si different de 0, on regarde.
		if( $acq->getSurfaceHabitableMin()>0 ){
			$sql.=" AND ( m.surfaceHabitable <= ?)";
			$where[] = $acq->getSurfaceHabitableMin();
		}
		if( $acq->getSurfaceHabitableMax()>0 ){
			$sql.=" AND ( m.surfaceHabitable >= ?)";
			$where[] = $acq->getSurfaceHabitableMax();
		}

		if($acq->getMandateStyle()){
			$sql.=" AND ( m.style_idMandateStyle = ?)";
			$where[] = $acq->getMandateStyle()->getIdMandateStyle();
		}
		if($acq->getRechercheSector()){
			$sql.=" AND ( m.sector_idSector = ?)";
			$where[] = $acq->getRechercheSector()->getIdSector();
		}

		if($acq->getRechercheCity()){
			$sql.=" AND ( m.city_idCity = ?)";
			$where[] = $acq->getRechercheCity()->getIdCity();
		}



		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( $where )) {
			throw new Exception('Erreur ');
		}
		$mandates = array();
		while ($mandate = Mandate::fetch($pdo,$pdoStatement)) {
			$mandates[] = $mandate;
		}
		return $mandates;


	}
	/**
	 * @param Mandate $mandate
	 * @return $listAcq
	 */
	public static function listAcqForMandate(PDO $pdo,Mandate $mandate){
		$where = array();
		// preparation de la requete.
		$sql = "SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax,
		     a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin,
			 a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType, 
			 a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector,
			 a.mandateType_idMandateType FROM Acquereur a WHERE a.actif =1 ";
		// champs obligatoires
		// type transaction
		$sql.=" AND (a.transactionType_idTransactionType = ?)";
		$where[] = $mandate->getTransactionType()->getIdTransactionType();
		// type de mandat
		$sql.=" AND (a.mandateType_idMandateType = ?  OR a.mandateType_idMandateType IS NULL)";
		$where[] = $mandate->getMandateType()->getIdMandateType();
		// champs facultatifs
		$sql.=" AND a.priceMin < ? AND ( ? < a.priceMax OR a.priceMax = 0 )";
		$where[] = $mandate->getPriceFai();
		$where[] = $mandate->getPriceFai();
		// 999999999999999999999999999999999999999999999999999999999999999 sert à rendre la condition faisable si on lui fait l'impasse
		$sql.=" AND a.surfaceTerrainMin < ? AND ( ? < a.surfaceTerrainMax OR a.surfaceTerrainMax = 0 )";
		$where[] = $mandate->getSuperficieTotale()==0?999999999999999999999999999999999999999999999999999999999999999:$mandate->getSuperficieTotale();
		$where[] = $mandate->getSuperficieTotale()==0?999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999:$mandate->getSuperficieTotale();
		$sql.=" AND a.surfaceHabitableMin < ? AND ( ? < a.surfaceHabitableMax OR a.surfaceHabitableMax = 0 )";
		$where[] = $mandate->getSurfaceHabitable()==0?999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999:$mandate->getSurfaceHabitable();
		$where[] = $mandate->getSurfaceHabitable()==0?999999999999999999999999999999999999999999999999999999999999999:$mandate->getSurfaceHabitable();
		$sql.=" AND (a.mandateStyle_idMandateStyle = ? OR a.mandateStyle_idMandateStyle IS NULL)";
		$where[] = $mandate->getStyle()?$mandate->getStyle()->getIdMandateStyle():null;
		$sql.=" AND (a.rechercheSector_idSector = ? OR a.rechercheSector_idSector IS NULL)";
		$where[] = $mandate->getSector()?$mandate->getSector()->getIdSector():null;
		$sql.=" AND (a.rechercheCity_idCity = ? OR a.rechercheCity_idCity IS NULL)";
		$where[] = $mandate->getCity()?$mandate->getCity()->getIdCity():null;
		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( $where )) {
			throw new Exception('Erreur ');
		}
		$acquereurs = array();
		while ($acquereur = Acquereur::fetch($pdo,$pdoStatement)) {
			$acquereurs[] = $acquereur;
		}
		return $acquereurs;
	}


}