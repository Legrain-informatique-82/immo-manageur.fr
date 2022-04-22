<?php
require_once'../../../const/config.php';
require_once'../../../class/Tools.php';
require_once '../../openmail/model/requires.php';
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/08/14
 * Time: 10:58
 */

//$return = array("result"=>true,"post"=>$_POST);
$error=array();
$result=false;
// Verif des champs passés.
$expediteur=$_POST['expediteur'];
$dest=$_POST['dest'];
$date=$_POST['date'];
$name=$_POST['name'];
$message=$_POST['message'];
$smsClass='1';// int
$noStop=true; // bool //Bool $noStop Ne mets pas  'STOP au XXXXX' s'il est à true.

$error = Validforms::validFormSendOneSms($expediteur,$dest,$date,$name,$message);

if(empty($error)){
    $arrayDest=explode(';',$dest);
    if($date!=''){
        $dateFormatEn = date('Y-m-d H:i:s',Tools::dateTimeFrToTime($date));
    }else{
        $dateFormatEn = null;
    }

    $arrayOfSms = array(new OpenMailSms($expediteur,$arrayDest,$message,$smsClass,$noStop,$dateFormatEn,$name));

    try{
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
        $opmConnect = $serviceOpm->connection(Constant::ID_OPEN_MAIl,Constant::PASSWORD_OPEN_MAIL,Constant::OPEN_MAIL_LANG_API);





        $serviceOpm->smsSend($opmConnect,$arrayOfSms);
        $expediteur='';
        $dest='';
        $date='';
        $name='';
        $message='';

        $error[]=($dateFormatEn)?'SMS programmé':'SMS envoyé';
        $result=true;
    }catch (Exception $e){
        $result=false;
        $error[]=$e->getMessage();
    }

}

$return =array("result"=>$result,"errors"=>$error);
echo json_encode($return);
