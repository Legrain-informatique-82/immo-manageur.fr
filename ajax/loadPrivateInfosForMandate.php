<?php
session_start();
// augmentation de la mémoire, le refaire si des images non réduites devaient réaparaitre.
ini_set("memory_limit", "512M");

require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$user = User::unserialize($pdo,$_SESSION['user']);
$mandate = Mandate::load($pdo,$_POST['idmandat']);

$mod = $mandate->getMandateType()->getId()==Constant::ID_PLOT_OF_LAND?'terrain':'mandat';
$pictures = $mandate->listPictures();
$return='';


$return=array();

$defaultSeller=$mandate->getDefaultSeller();

$return['address']=$mandate->getAddress();
$return['zipCode']=$mandate->getCity()->getZipCode();
$return['city']=$mandate->getCity()->getName();

$return['sellerName']=$defaultSeller->getName();

$return['sellerPhone']=$defaultSeller->getPhone();
$return['sellerCellPhone']=$defaultSeller->getMobilPhone();
$return['sellerWorkPhone']=$defaultSeller->getWorkPhone();
$return['sellerFax']=$defaultSeller->getFax();
$return['sellerEmail']=$defaultSeller->getEmail();


$return['sellerFirstname']=$defaultSeller->getFirstname();
// type accord
$return['nature']=$mandate->getNature()->getName();
// téléphones

// email

// fax



echo json_encode($return);