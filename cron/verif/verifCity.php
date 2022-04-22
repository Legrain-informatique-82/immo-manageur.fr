<?php
class VerifMandateForCity extends Mandate{

	public static function countMandate (PDO $pdo, City $city ){
		// m.notary_idNotary_acq ++
		$sql = '
			SELECT COUNT(m.city_idCity) 
			FROM  Mandate m
			WHERE m.city_idCity = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($city->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
class VerifSellerForCity extends Seller{
	
	public static function countSeller (PDO $pdo, City $city ){
		// m.notary_idNotary_acq ++
		$sql = '
				SELECT COUNT(s.city_idCity) 
				FROM  Seller s
				WHERE s.city_idCity = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($city->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}

class VerifAcqForCity extends Acquereur{
	public static function countAcq (PDO $pdo, City $city ){
		// m.rechercheCity_idCity ++ villeAcquereur
		$sql = '
					SELECT COUNT(a.rechercheCity_idCity) + COUNT(a.villeAcquereur)
					FROM  Acquereur a
					WHERE a.rechercheCity_idCity = ? OR  a.villeAcquereur = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($city->getId(),$city->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}

echo 'City ....................... ';
foreach( City::loadAll($pdo) as $city){
	// On compte pour les mandats...
	//$nbReel =  VerifMandateForNotary::countMandateWithNotary($pdo,$not);
	$nbReel =  VerifMandateForCity::countMandate($pdo, $city) + VerifSellerForCity::countSeller($pdo, $city)+VerifAcqForCity::countAcq($pdo, $city).'<br>';

	if( $nbReel != $city->getNumberUsed() ){
		//echo $nbReel .' = '. $not->getNumberUsed().'<br>';
		$city->setNumberUsed($nbReel);
	}
	
}
echo 'Done<br/>';