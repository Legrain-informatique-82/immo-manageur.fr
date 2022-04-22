<?php
//header ("Content-type: image/png");
//require_once 'modules/dpe/model/generateDpe.php';

// voir pour un text
//new generateDpe($_GET['value']);

//header ("Content-type: image/png"); // 1 : on indique qu'on va envoyer une image PNG
//$image = imagecreate(200,50); // 2 : on crée une nouvelle image de taille 200x50
// 3 : on s'amuse avec notre image (on va apprendre à le faire)
//imagepng($image); // 4 : on a fini de faire joujou, on demande à afficher l'image
/*
 *
 *
 */


 require_once dirname(__FILE__).'/libs/php_functions_missing.php';
require_once dirname(__FILE__).'/const/config.php';
require_once dirname(__FILE__).'/class/interfaceController.php';
require_once dirname(__FILE__).'/class/CoreController.class.php';
require_once dirname(__FILE__).'/class/Tools.php';
require_once dirname(__FILE__).'/libs/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/class/SimpleMail/Email/SimpleMail.php';
require_once dirname(__FILE__).'/class/upload/upload.class.php';

//$float = 44.00330;
$float = 1.22268;

echo $float.' -> '.Tools::convertSexadecimalInDecimal($float);
// testmal($float);
