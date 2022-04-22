<?php
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';


foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}

// épuration des logs
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
// On charge les logs
$logs = Log::loadAll($pdo);

foreach ($logs as $log){
	$fileXml = Constant::DEFAULT_LOGS_DIRECTORY.date('Ym',$log->getDateLog()).'_logs.xml';
	if(date('Ym',$log->getDateLog()) < date('Ym')){
		//echo date('Ym',$log->getDateLog()).'-';
		// creation ou update d'un fichier xml logs contenant l'année et le mois comme nom
		if( is_file( $fileXml)){
			$xml = simplexml_load_file($fileXml );
		}else{
			// xml maker
			$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><logs></logs>");
			
		}
			$l = $xml -> addChild("log");
			
			
			$l->addChild('date',date('d/m/Y',$log->getDateLog()));
			
			$l->addChild('module',$log->getPluginName());
			$l->addChild('utilisateur',$log->getUser()->getFirstname().' '.$log->getUser()->getName());
			$l->addChild('libelle',$log->getLog());
			
		// Ajout de la ligne du log
		$xml -> asXml($fileXml);
		// Suppression du log dans la bdd
		$log->delete();
	}
}

foreach( glob( Constant::DEFAULT_LOGS_DIRECTORY.'*.xml' ) as $file){
	$name = explode('/',$file); 
	$init = explode('_', $name[count($name)-1] );
	// si la date actuelle _ la date du fichier > 100 on supprime
	if(date('Ym') - $init[0] > 100){
		unlink($file);	
	}
	
}
