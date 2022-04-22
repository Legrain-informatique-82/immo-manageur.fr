<?php

// Requires
require_once dirname(__FILE__).'/libs/php_functions_missing.php';
require_once dirname(__FILE__).'/const/config.php';
require_once dirname(__FILE__).'/class/interfaceController.php';
require_once dirname(__FILE__).'/class/CoreController.class.php';
require_once dirname(__FILE__).'/class/Tools.php';
require_once dirname(__FILE__).'/libs/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/class/SimpleMail/Email/SimpleMail.php';
require_once dirname(__FILE__).'/class/upload/upload.class.php';
session_start();
$oSmarty = new Smarty();
$oSmarty->template_dir =  dirname(__FILE__).'/modules';
$oSmarty->compile_dir = dirname(__FILE__).'/templates_c';

/******************************
 //var_dump($_GET);
 // module
 // page
 // action
 ***********************************/

if(Constant::EN_MAINTENANCE){
	$oSmarty->assign('login',true);
	$oSmarty->display('tpl_default/header.tpl');
	$oSmarty->display('tpl_default/maintenance.tpl');
	$oSmarty->display('tpl_default/footer.tpl');

}else{
	/*******************************
	 // Chargement du bon controller.
	 // Chargement du module, s'il est vide (arrivé sur le site) on charge le module par défaut (défini dans la constante).
	 *********************************************************** */
	$mod = empty($_GET['module'])?Constant::DEFAULT_MODULE:trim(htmlspecialchars(addslashes($_GET['module'])));

	/*************************************
	 *  Connexion
	 * On doit regarder si le membre est connecté, si ce n'est pas le cas, on doit appeller le module de connection.
	 *************************************/
	if(empty($_SESSION['login'])){
		$mod='login';
	}



	/***************************************************************
	 * 			Chargement du module (controller + class model associés)
	 **************************************************************/
	if(is_file(dirname(__FILE__).'/modules/'.$mod.'/controller.php')) {
		require dirname(__FILE__).'/modules/'.$mod.'/controller.php';
		// On charge les classes (métier) appartenant à CE module
		require dirname(__FILE__).'/modules/'.$mod.'/model/requires.php';
	} else {
		header("Status : 404 Not Found");
		header('HTTP/1.0 404 Not Found');
		require dirname(__FILE__).'/modules/404/controller.php';
	}

	$oController = new Controller($oSmarty);
	$oController->treatment($_POST,$_GET);

	// Ajoute les titres tout ça.
	$oController->addMeta( );






	$oController->displayTpl();
}



unset($oSmarty);
unset($oController);
