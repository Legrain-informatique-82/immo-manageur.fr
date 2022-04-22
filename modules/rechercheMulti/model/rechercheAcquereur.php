<?php

require_once Constant::DEFAULT_MODULE_DIRECTORY.'/acquereur/model/requires.php';
class RechercheAcquereur extends Acquereur{


	/**
	 *
	 * Enter description here ...
	 * @param Pdo $pdo
	 * @param Array $criteres
	 * array contenant : critere, val1 et val2
	 */
	public static function loadByMultiCritere(Pdo $pdo, $criteres ){

		// Construction de la requete,
		$sql = 'SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType, a.user_idUser,a.comment, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector,a.mandateType_idMandateType FROM Acquereur a ';
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
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs depuis la base de donn�es');
		}

		$acqs = array();
		while ($acq = Acquereur::fetch($pdo,$pdoStatement,$easyload)) {
			$acqs[] = $acq;
		}

		// Retourner le tableau
		return $acqs;

		// return de la liste de bien

	}

}