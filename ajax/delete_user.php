<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$userToDelete = User::load($pdo,$_GET['idUser']);
if($userToDelete->getNumberUsed()==0){
	if(!$userToTakeAction->equals($userToDelete)){
		$log = 'Suppression de : '.$userToDelete->getIdentifiant();
		// supprimer les logs de l'utilisateur
		Log::deleteByUser( $pdo, $userToDelete );
		// delete
		$userToDelete->delete( );
		Log::create($pdo,time(),'user',$log,$userToTakeAction);
		$array['message'] =  'utilisateur supprimé';
		$array['done'] = 1;
	}else{
		// Affiche impossibilité de suicider son utilisateur.
		$array['message'] =  Lang::ERROR_USER_DELETE;
		$array['done'] = 0;
	}
}else{
	$array['message'] = 'Impossible de supprimer cet utilisateur car il est utilisé';
	$array['done'] = 0;
}
echo json_encode($array);
