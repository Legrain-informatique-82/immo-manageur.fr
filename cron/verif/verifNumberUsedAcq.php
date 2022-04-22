<?php
echo 'Acquereur .....................';
foreach( Acquereur::loadAll($pdo) as $acq){

	// On Compare le nombre d'utilisation reele de l'acquereur avec un rapprochement et le nombre d'utilisation reelle.
	$nbReel = BddRapprochement::countByAcquereur($pdo, $acq);
	if( $nbReel != $acq->getNumberUsed() ){
		//echo  BddRapprochement::countByAcquereur($pdo, $acq).' =  '.$acq->getNumberUsed().'  => '.$acq->getName().'<br>';
		// Si ce n'est pas vrai, on met à jour.
		$acq->setNumberUsed($nbReel);
	}

}
echo 'done<br>';