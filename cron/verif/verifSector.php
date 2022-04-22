<?php
class VerifAcqForSector extends Acquereur{

	public static function countAcq (PDO $pdo, Sector $sector ){

		$sql = '
		SELECT COUNT(a.rechercheSector_idSector) 
		FROM  Acquereur a
		WHERE a.rechercheSector_idSector = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($sector->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
class VerifCityForSector extends City{
	
	public static function countSectorWithCity (PDO $pdo, Sector $sector ){
	
		$sql = '
		SELECT COUNT(c.sector_idSector) 
		FROM  City c
		WHERE c.sector_idSector = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($sector->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
class VerifMandateForSector extends Mandate{
	
	public static function countSectorWithmandate (PDO $pdo, Sector $sector ){
		// m.notary_idNotary_acq ++
		$sql = '
			SELECT COUNT(m.sector_idSector) 
			FROM  Mandate m
			WHERE m.sector_idSector = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($sector->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
echo 'Sector ....................... ';
foreach( Sector::loadAll($pdo) as $sector){
	$nbReel =  VerifCityForSector::countSectorWithCity($pdo, $sector) + VerifMandateForSector::countSectorWithmandate($pdo, $sector)+VerifAcqForSector::countAcq($pdo, $sector);
	if( $nbReel != $sector->getNumberUsed() ){
		//echo $nbReel .' = '. $sector->getNumberUsed().'<br>';
		$sector->setNumberUsed($nbReel);
	}
	
}
echo 'Done<br>';