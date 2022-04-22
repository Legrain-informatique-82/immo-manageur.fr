<?php
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
$mandates = array();
foreach( Mandate::loadAll($pdo) as $m){
	// Si le mandate n'est pas un terrain
	if($m->getMandateType()->getIdMandateType() != Constant::ID_PLOT_OF_LAND ){
		// On regarde s'il ne possede pas de DPE
		$valDpe =  ValDpe::loadByMandate($pdo, $m);
		if( $valDpe ){
			if($valDpe->getConsoEner() ==0 || $valDpe->getEmissionGaz() ==0){
				// On ajoute le mandat
				$mandates[]=$m;
			}
		}else{
			// On ajoute le mandat
			$mandates[]=$m;
		}
	}
}
// 418 résultats (local).


// Extraire le mandat dans un fichier csv.
$fp = fopen( Constant::DEFAULT_TMP_DIRECTORY.'mandateWithoutDpe.csv', 'w');
fputcsv($fp, array( 'numero de mandat','prix','ville','nom vendeur','nom commercial','url escal82.com'   ),';');
foreach($mandates as $m ){

	// On place les champs nous interessant dans le fichier
	fputcsv($fp,
	array( $m->getNumberMandate(),round($m->getPriceFai(),0) ,$m->getCity()->getName(),$m->getDefaultSeller()?$m->getDefaultSeller()->getFirstname().' '.$m->getDefaultSeller()->getName():'NC',$m->getUser()->getFirstname().' '.$m->getUser()->getName(),Tools::create_url($m->getUser(),'mandat','see',$m->getIdMandate() )  ),
	';');
}
fclose($fp);