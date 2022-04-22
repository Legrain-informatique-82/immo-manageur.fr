<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
// recuperation de l'image par defaut
//$idMandate = $_GET['idMandate'];
$idPicture=$_GET['idPicture'];
$pict = MandatePicture::load($pdo,$idPicture);
$m= $pict->getMandate();
$mod = $m->getMandateType()->getName()=='Terrain'?'terrain':'mandat';
$user = User::unserialize($pdo,$_SESSION['user']);

$return['url']= Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.$mod.'/'.$pict->getName();
$return['isDefault'] = $pict->getIsDefault();
$return['idMandate'] = $m->getIdMandate();
$return['idPicture'] = $idPicture;
$return['autorized']=(($m->getUser()->getIdUser() == $user->getIdUser()) || $user->getLevelMember()->getIdLevelMember() < 3 )?1:0;


echo json_encode($return);