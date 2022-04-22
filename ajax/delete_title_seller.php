<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);

$sellerTitle = SellerTitle::load($pdo,$_GET['id']);



$error = array();

//$array['message'] = Seller::count($pdo,' WHERE sellerTitle_idSellerTitle='.$sellerTitle->getIdSellerTitle( ));
if(Seller::count($pdo,' WHERE sellerTitle_idSellerTitle='.$sellerTitle->getIdSellerTitle())>0){
	$error[] = $array['message'] = Lang::ERROR_SELLER_TITLE_DELETE ;
	$array['done'] = 0;
}

if(empty($error)){


	$nameOfTitle = $sellerTitle->getLibel();
	$sellerTitle->delete();
	Log::create($pdo,time(),'seller', 'Suppression du titre du vendeur : '.$nameOfTitle,$userToTakeAction);
	//					header('location:'.$this->create_url($this->_user,$get['module'],'list'));
	$array['message'] = "Titre supprimé";
	$array['done'] = 1;
}

echo json_encode($array);
