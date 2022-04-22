<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandat/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/document/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);

echo 'aaa';