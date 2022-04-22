<?php

require_once Constant::DEFAULT_MODULE_DIRECTORY.'/biens/model/requires.php';
class RechercheMandate extends Mandate{


	/**
	 *
	 * Enter description here ...
	 * @param Pdo $pdo
	 * @param Array $criteres
	 * array contenant : critere, val1 et val2
	 */
	public static function loadByMultiCritere(Pdo $pdo, $criteres ){

		// Construction de la requete,
		$sql = 'SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieNonConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer, m.nature_idMandateNature,m.estimationMaxi,m.pubInternet FROM Mandate m';
		//var_dump($criteres['critere']);
		if($criteres['critere'][0]!=''){
				
			$sql.=' WHERE ';
			$i =0;
			$array = array();
			foreach ($criteres['critere'] as $value) {
				if($value != ''){
					$sql.=$value.' AND ';
					// on en profite pour renseigner le tableau des résultats
					$array[]=$criteres['val1'][$i];
					// si c'est double, on doit utiliser val2.
					if($criteres['type'][$i]=='double'){
						// si val 2 est vide, on y attribut une valeur enorme afin de valider le critère et ainsi ne pas faire planter le script
						if($criteres['val2'][$i]==''){
							$array[]=  99999999999999999999999999999999999999;
						}
						else {
							// sinon, on applique val2
							$array[]=  $criteres['val2'][$i];
						}

					}
				}
				$i++;
			}
			$sql = substr($sql, 0,-4);
		}
		
		//echo $sql;
		//var_dump($array);
		// foreach des critères.

		$pdoStatement = $pdo->prepare($sql);

		if (!$pdoStatement->execute($array)) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates depuis la base de donn�es');
		}

		$mandates = array();
		while ($mandate = Mandate::fetch($pdo,$pdoStatement,$easyload)) {
			$mandates[] = $mandate;
		}

		// Retourner le tableau
		return $mandates;

		// return de la liste de bien

	}

}