<?php
session_start();
require_once '../../../libs/php_functions_missing.php';
require_once '../../../const/config.php';
require_once '../../../libs/smarty/Smarty.class.php';
require_once '../../../class/interfaceController.php';
require_once '../../../class/CoreController.class.php';
require_once '../../../class/Tools.php';
require_once '../../../modules/openmail/model/requires.php';
require_once '../../../modules/user/model/requires.php';
require_once '../../../modules/sector/model/requires.php';

$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$user = User::unserialize($pdo,$_SESSION['user']);
$smarty = new Smarty();
$smarty->template_dir =  Constant::DEFAULT_DIRECTORY.'/modules';
$smarty->compile_dir = Constant::DEFAULT_DIRECTORY.'/templates_c';
$token = empty($_POST['token'])?Tools::passwdGen(20):$_POST['token'];
// opm
//$serviceOpm=

//$smarty->assign('listSenders',$serviceOpm->smsListPhoneSender($connect));
$serviceOpm = new SoapClient(Constant::OPEN_MAIL_URL_API,
    array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_DEFLATE,
        'classmap' =>
            array(
                'OpenmailFaxNumberInformation'=>'OpenmailFaxNumberInformation',
                'OpenMailFax' =>'OpenMailFax',
                'OpenMailFaxReferer'=>'OpenMailFaxReferer',
                'OpenMailFaxRecipient'=>'OpenMailFaxRecipient',
                'OpenMailSms'=>'OpenMailSms',
                'Connect'=>'Connect',
                'OpenMailEmailCampaign'=>'OpenMailEmailCampaign',
                'OpenMailEmail'=>'OpenMailEmail',
                'OpenMailAttachmentB64'=>'OpenMailAttachmentB64',
                'OpenMailAttachment'=>'OpenMailAttachment',
                'OpenMailEmailFrom'=>'OpenMailEmailFrom',
                'OpenMailGroupEmail'=>'OpenMailGroupEmail',
                'OpenMailEmailCampaignListsContact'=>'OpenMailEmailCampaignListsContact',
                'OpenMailEmailCampaignContacts'=>'OpenMailEmailCampaignContacts'
            )
    ));

    try{
        $opmConnect = $serviceOpm->connection(Constant::ID_OPEN_MAIl,Constant::PASSWORD_OPEN_MAIL,Constant::OPEN_MAIL_LANG_API);


        if(empty($_GET['dest'])){
            $dest='';
        }else{
            $dest=$_GET['dest'];
        }
        if(!$_SESSION['listSenders']){
            $listSenders=array();

            $tmp = $serviceOpm->emailListEmailAddressFrom($opmConnect,null);
            foreach($tmp as $i){
                if($i->active)$listSenders[]=$i;
            }
           // $_SESSION['listSenders']=$listSenders;
        }
        else{$listSenders=$_SESSION['listSenders'];}

        $smarty->assign('listSenders',$listSenders);
        $smarty->assign('idForm','ajaxFormSendEmail');
        $smarty->assign('dest',$dest);
        $smarty->assign('pjs',$_SESSION['emails_pj'][$token]);
        $smarty->assign('token',$token);

        $smarty->assign("urlScriptUpload",Constant::DEFAULT_URL.'/modules/openmail/ajax/');
        $smarty->assign("urlBtns",Constant::DEFAULT_DIRECTORY.'/libs/plupload');

        $smarty->display('openmail/formFancybox/tpl/sendEmail.tpl');
    }catch (Exception $e){
        //header('location:'.Tools::create_url($this->_user,'openmail','errorCo'));
        //var_dump($e->getMessage());
        //echo '<h1>Erreur de connexion</h1><p>'.$e->getMessage().'</p><p>Pensez à vérifier</p>';
        $error = '<h1>Open mail</h1>
<p>
    La connexion à Open mail a échoué. <a href="'.Tools::create_url($user,'parameters').'">Pensez à vérifier vos identifiants.</a></p>
    <p>Si vous n\'avez pas de compte Open mail, <a href="http://app1.openmail.fr">vous pouvez en creer un.</a>
</p>';
echo $error;

    }

