<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$seller = Seller::load($pdo,$_GET['id']);
$error = array();
if($seller->getNumberUsed()>0){
	$error[] = $array['message'] = Lang::ERROR_SELLER_DELETE;
	$array['done'] = 0;
}
if(empty($error)){
	Log::create($pdo,time(),'seller', 'Suppression du vendeur : '.$seller->getName() ,$userToTakeAction);
	// - 1 à l'utilisation de la ville et de l'utilisateur
	$seller->getUser()->setNumberUsed( $seller->getUser()->getNumberUsed()-1 );
	$seller->getCity()->setNumberUsed($seller->getCity()->getNumberUsed( ) -1);
	$seller->delete();
	$array['message'] = "vendeur supprimé";
	$array['done'] = 1;
}
echo json_encode($array);