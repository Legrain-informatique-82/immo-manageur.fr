<?php
/**
 * Réaffecte les secteurs de tous les mandats en fonction des secteurs des villes.
 */
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';


foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}

$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);

foreach(Mandate::loadAll($pdo) as $m){
	if(!$m->getSector()->equals( $m->getCity()->getSector() )   ){
		$m->setSector( $m->getCity()->getSector() ) ;
	}
}