<?php
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../class/ftp.class.php';
require_once dirname(__FILE__).'/../libs/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/../class/SimpleMail/Email/SimpleMail.php';
require_once dirname(__FILE__).'/../class/upload/upload.class.php';
require_once dirname(__FILE__).'/../class/facebook_sdk3/facebook.php';

$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);

// module glob de tous les modules
foreach (glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $filename) {
    require_once $filename;
}

$app_config = array(
    'appId' => Constant::APP_ID_FACEBOOK,
    'secret' => Constant::APP_SECRET_FACEBOOK,
    'cookie' => true
);

$facebook = new Facebook($app_config);
/* on récupère les informations de l'utilisateur connecté à Facebook */
$user = $facebook->getUser();
/* si connecté */
if($user){
    try{
        $accounts = $facebook->api('/me/accounts');
        foreach(Passerelle::loadAll($pdo) as $passerelle){
            // requis seulement si la passerelle est active !
            if($passerelle->getAsset()){

                if($passerelle->getTypeExport() == 'facebook'){
                    $param = unserialize($passerelle->getParam());
                    $id_page=$param['pageId'];
                    foreach($accounts['data'] as $page){
                        if($id_page==$page['id']){
                            $passerelle->setParam(serialize(array('pageId'=>$id_page,'access_token'=>$page['access_token'] )));
                        }
                    }

                }
            }
        }
echo 'Jeton régénéré. Vous pouvez fermer cette page';
    }
    catch (FacebookApiException $e){
        error_log($e);
        $user = null;
    }
}
if(!$user){

    $login_params = array(
        'scope' => 'manage_pages,publish_actions'
    );
    $loginUrl = $facebook->getLoginUrl($login_params);
    echo '<a href="'.$loginUrl.'">Se connecter à facebook</a> pour régénérer votre jeton de connexion à l\'application facebook';
}






