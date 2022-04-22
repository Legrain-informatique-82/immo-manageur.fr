<?php
/**
 * Controle que le nombre de fois ou est utilisé un acquereur est correct. Le cas échéant, on corrige.
 */

require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);


foreach( Acquereur::loadAll($pdo) as $acq){
	
// On Compare le nombre d'utilisation reele de l'acquereur avec un rapprochement et le nombre d'utilisation reelle.
$nbReel = BddRapprochement::countByAcquereur($pdo, $acq); 
if( $nbReel != $acq->getNumberUsed() ){
	 echo  BddRapprochement::countByAcquereur($pdo, $acq).' =  '.$acq->getNumberUsed().'  => '.$acq->getName().'<br>';
	// Si ce n'est pas vrai, on met à jour.
	$acq->setNumberUsed($nbReel);
	
}
	
}