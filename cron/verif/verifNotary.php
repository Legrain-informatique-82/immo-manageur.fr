<?php
class VerifMandateForNotary extends Mandate{

	public static function countMandateWithNotary(PDO $pdo,Notary $notary){

		// m.notary_idNotary_acq ++
		$sql = 'SELECT COUNT(m.notary_idNotary_acq) + COUNT(m.notary_idNotary) FROM Mandate m WHERE m.notary_idNotary_acq = ? OR m.notary_idNotary = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($notary->getIdNotary(),$notary->getIdNotary() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
echo 'Notary ....................... ';
foreach( Notary::loadAll($pdo) as $not){
	// On compte pour les mandats...
	$nbReel =  VerifMandateForNotary::countMandateWithNotary($pdo,$not);

	if( $nbReel != $not->getNumberUsed() ){
		//echo $nbReel .' = '. $not->getNumberUsed().'<br>';
		$not->setNumberUsed($nbReel);
	}
}
echo 'Done<br/>';