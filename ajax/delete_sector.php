<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$sector = Sector::load($pdo,$_GET['id']);
$error = array();
if($sector->getNumberUsed()>0){
	$error[] = $array['message'] = 'Impossible de supprimer le secteur.';
	$array['done'] = 0;
}
if(empty($error)){
	Log::create($pdo,time(),'sector', 'Suppression du secteur : '.$sector->getName() ,$userToTakeAction);
	$sector->delete();
	$array['message'] = "secteur supprimé";
	$array['done'] = 1;
}
echo json_encode($array);