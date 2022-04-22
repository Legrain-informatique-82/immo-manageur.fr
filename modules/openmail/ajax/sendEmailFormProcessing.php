<?php

session_start();
require_once dirname(__FILE__).'/../../../const/config.php';
require_once dirname(__FILE__).'/../../../class/Tools.php';
require_once '../../openmail/model/requires.php';
$token = $_POST['token'];

$return=array();
$result=false;
$expediteur=$_POST['expediteur'];
$dest=$_POST['dest'];
$date=$_POST['date'];
$name=$_POST['name'];
$message=$_POST['message'];
$subject=$_POST['subject'];
$listSenders = unserialize(str_replace("%22",'"',$_POST['listSendersSerialize']));
$addressReplyTo=null;
$addressFrom=null;


$error = Validforms::validFormSendOneEmail($dest,$subject,$date,$name,$message);

if(!empty($_SESSION['emails_pj'][$token])){
    $arrayOfPj = array();
    $totalFilesize=0;
    foreach($_SESSION['emails_pj'][$token] as $pf){
        $totalFilesize+=$pf['filesize'];
        $arrayOfPj[]=new OpenMailAttachmentB64($pf['filename'],$pf['b64']);
    }
    if($totalFilesize>Constant::SIZE_MAX_BY_EMAIL_ATTACHMENT)$error[]='Vous ne pouvez pas envoyer plus de 10Mo en pièce jointes';
}


if(empty($error)){
    // Send emails...
    $name = $name==''?$subject:$name;
    if ($date == '') {
        $date_send = date ( 'Y-m-d H:i:s' );
        $now=true;
    } else {
        list ( $arrayDate, $arrayHours ) = explode ( ' ', $date );
        list ( $day, $month, $year ) = explode ( '/', $arrayDate );
        list ( $h, $m ) = explode ( ':', $arrayHours );
        $date_send = $year . '-' . $month . '-' . $day . ' ' . $h . ':' . $m . ':00';
        $now=false;
    }
    // Send
    $exit=false;
    foreach($listSenders as $s){
        if($exit)exit();
        if($s->id==$expediteur){
            $addressFrom=$s->address;
            $addressReplyTo=$s->addressReplyTo;
            $exit=true;
        }
    }
    $ato = explode(';',$dest);
    $arrayOfEmails = array();

    foreach($ato as $aato){
        $arrayOfEmails[] = new OpenMailEmail(
            $addressFrom,array($aato),$addressReplyTo,$subject,$message,$arrayOfPj,null,$date_send,null,$name)  ;
    }

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

        $serviceOpm->emailSend($opmConnect,$arrayOfEmails);
        $result=true;

        unset($_SESSION['emails_pj'][$token]);
        $dest='';
        $expediteur='';
        $subject='';
        $message='';
        $delpj=array();
        $name='';
        $error[]=  $now?'Email envoyé avec succès.':'Email programmé ('.$date.').' ;
        $date='';
        $token = empty($_POST['token'])?Tools::passwdGen(20):$_POST['token'];

    }catch (Exception $e){
        $error[]=$e->getMessage();
        $result=false;
    }

}

echo json_encode(array("result"=>$result,"errors"=>$error));
//echo implode('      ',$_POST);

//var_dump( );