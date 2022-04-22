<?php
session_id(str_rot13($_POST['idSess']));
// augmentation de la mémoire, le refaire si des images non réduites devaient réaparaitre.
ini_set("memory_limit", "512M");
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$mandate = Mandate::load($pdo,$_POST['idMandat']);
if($userToTakeAction->getLevelMember()->getIdLevelMember() < 3 || $userToTakeAction->getIdUser() == $mandate->getUser()->getIdUser()){
	/*
    if (!empty($_FILES)) {
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$module = $mandate->getMandateType()->getName()=='Terrain'?'terrain':'mandat';
		$targetPath =Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/';
		$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
		// Regarder si le mandat possede déjà une image principale, définir celle uploadé en fct
		$pictureByDefault= $mandate->getPictureByDefault();
		$isDefault=$pictureByDefault==null?1:0;
		// ajouter l'image au mandat, sans zapper le log.
		$pict = MandatePicture::create($pdo,'tmpName',$isDefault,$mandate);
		// le déplacer dans big
		move_uploaded_file($tempFile,$targetPath.'big/'.$_FILES['Filedata']['name']);
		// renomer le fichier.
		$newName= $mandate->getIdMandate().'-'.$pict->getIdMandatePicture().'.jpg';
		rename($targetPath.'big/'.$_FILES['Filedata']['name'],$targetPath.'big/'.$newName);
		// modifier le nom dans la bdd
		$pict->setName($newName);
		// le copier dans .. et dans ../thumb
		copy($targetPath.'big/'.$newName,$targetPath.$newName);
		copy($targetPath.'big/'.$newName,$targetPath.'thumb/'.$newName);
		//  retailler le fichier ..
		if(!Tools::redimentionne($targetPath.$newName,Constant::SIZE_X_PICTURE,Constant::SIZE_Y_PICTURE)){
			mail('julien@legrain.fr','test','JE PASSE PAR LA et je ne redimentionne pas ....');
		};
		// retailler le fichier ../thumb
		Tools::redimentionne($targetPath.'thumb/'.$newName,Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE);
		// log
		Log::create($pdo,time(),$module,'Ajout de d\'une image pour le mandat : '.$mandate->getNumberMandate(),$userToTakeAction);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	}
	*/

}