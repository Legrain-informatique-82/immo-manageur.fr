<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$acq = Acquereur::load($pdo,$_GET['id']);
$error = array();
//$array['message'] = 'aaa';
//	$array['done'] = 0;
if($acq->getNumberUsed()>0){
	$error[] = $array['message'] = 'Impossible de supprimer l\'acquereur car il est utilisé.';
	$array['done'] = 0;
}
if(empty($error)){
	if($userToTakeAction->getLevelMember()->getIdLevelMember()<3||$userToTakeAction->getIdUser() == $acq->getUser()->getIdUser()){

		// - 1 à l'utilisation de la ville et de l'utilisateur
		if($acq->getRechercheCity( ))$acq->getRechercheCity( )->setNumberUsed( $acq->getRechercheCity( )->getNumberUsed() -1);
		$acq->getVilleAcquereur()->setNumberUsed( $acq->getVilleAcquereur()->getNumberUsed( ) -1 );
		$acq->getUser()->setNumberUsed($acq->getUser()->getNumberUsed()-1);
		$name = $acq->getName();
		//Récupération des relations ( situation famille)
		$rel = RelSituaTionAcq::loadByAcquereur($pdo, $acq);
		if($rel)$rel->delete();
		// Suppression des acq associés
		foreach (AcquereurAssocie::loadByAcq($pdo, $acq) as $item){
			// -1 sur l'utilisation de la ville
			$item->getCity()->setNumberUsed($item->getCity()->getNumberUsed() -1);
			// Suppression des relations des acqAssociés
			$rel = RelSituaTionAcq::loadByAcquereurAssos($pdo, $acq);
			if($rel)$rel->delete();
			
			
			$item->delete();
		}
 		$acq->delete();
		Log::create($pdo,time(),'acquereur','Suppression de l\'acquereur : '.$name,$userToTakeAction);
		$array['message'] = "acquereur supprimé";
		$array['done'] = 1;
	}else{
	$array['message'] = "niveau d'acces insufisant";
	$array['done'] = 0;
}
}
echo json_encode($array);
