<?php

class VerifMandateForSeller extends Mandate{

	public static function countSeller(PDO $pdo,Seller $seller){

		// m.notary_idNotary_acq ++
		$sql = 'SELECT COUNT(m.fk_idSeller) FROM Mandate_Seller m WHERE m.fk_idSeller = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($seller->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
echo 'Seller ....................... ';
foreach( Seller::loadAll($pdo) as $seller){
	// On compte pour les mandats...
	
	 $nbReel =  VerifMandateForSeller::countSeller($pdo,$seller);

	if( $nbReel != $seller->getNumberUsed() ){
		//echo $nbReel .' = '. $not->getNumberUsed().'<br>';
		$seller->setNumberUsed($nbReel);
	}
	
}
echo 'Done<br/>';