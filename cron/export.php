<?php
// ne pas afficher les erreurs
// ini_set('display_errors', 0);
// Requires général
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';



require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../class/ftp.class.php';
require_once dirname(__FILE__).'/../libs/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/../class/SimpleMail/Email/SimpleMail.php';
require_once dirname(__FILE__).'/../class/upload/upload.class.php';

if(date('H') == '03' || $_GET['force']=='ok') {
    $pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
// module glob de tous les modules
    foreach (glob(dirname(__FILE__) . '/../modules/*/model/requires.php') as $filename) {
        require_once $filename;
    }
    foreach (Passerelle::loadAll($pdo) as $passerelle) {
        // requis seulement si la passerelle est active !
        if ($passerelle->getAsset()) {
            if ($passerelle->getTypeExport() != 'facebook') {
                require dirname(__FILE__) . '/../modules/export/typeExport/' . $passerelle->getTypeExport() . '.php';
            }
        }
    }
}
