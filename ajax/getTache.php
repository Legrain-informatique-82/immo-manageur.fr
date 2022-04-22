<?php
session_start();
require_once dirname(__FILE__) . '/../libs/php_functions_missing.php';
require_once dirname(__FILE__) . '/../const/config.php';
require_once dirname(__FILE__) . '/../class/interfaceController.php';
require_once dirname(__FILE__) . '/../class/CoreController.class.php';
require_once dirname(__FILE__) . '/../class/Tools.php';
require_once dirname(__FILE__) . '/../modules/action/model/requires.php';
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
$idAction = $_GET['idTache'];

$act = Action::load($pdo, $idAction);
echo $act->getComment();
// var_dump($_GET);
// idTache = $_GET['idTache']