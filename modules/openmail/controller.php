<?php

class Controller extends CoreController {
	private $_smarty;
	private $_template ;
	private $_error_dependance;
	private $_user;
	private $_title;
    private $serviceOpm;
    private $opmConnect;


	public function __construct( $smarty){
		parent::__construct();
		$this->_smarty = $smarty;
		$this->_error_dependance = false;
		// membre connecté
		if(!$this->include_model_required((String)dirname(__FILE__))){
			$this->_error_dependance = true;
			$this->_template = $this->getTplErrorLoadModule();
		}else{
			$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
			// autorisation necessaire pour cette action ? // reste le cas de la modification de sa propre fiche ...
			if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"seller",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('openmail');
                $this->moduleName='openmail';
				$this->_title = 'Gestion des parametres';
                // On teste la connexion à OPM
                $this->serviceOpm = new SoapClient(Constant::OPEN_MAIL_URL_API,
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
                if($_GET['page']!=='errorCo'){
                try{
                    $this->opmConnect = $this->serviceOpm->connection(Constant::ID_OPEN_MAIl,Constant::PASSWORD_OPEN_MAIL,Constant::OPEN_MAIL_LANG_API);
                }catch (Exception $e){
                     header('location:'.Tools::create_url($this->_user,'openmail','errorCo'));
                }

			}
            }
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
        if(empty($get['page']))$get['page']='home';
        $error =array();
        if(isset($get['page'])&&$get['page']=='home'){
            $this->home();
        }elseif(isset($get['page'])&&$get['page']=='errorCo'){
            $this->errorCo();
         }elseif(isset($get['page'])&&$get['page']=='sendSms'){
            $this->sendSms();
        }elseif(isset($get['page'])&&$get['page']=='sendEmail'){
            $this->sendEmail();
        }

	}
    private function errorCo(){
        $this->_title="Open mail - erreur de connexion";
        $this->_template = dirname(__FILE__).'/views/errorCo.tpl';
    }
    private function sendSms(){
        $this->_title="Envoyer un Sms";
        $this->_template = dirname(__FILE__).'/views/sendSms.tpl';
        $error=array();
        $smsClass='1';// int
        $noStop=true; // bool //Bool $noStop Ne mets pas  'STOP au XXXXX' s'il est à true.
        if(!isset($_POST['send'])){
            $expediteur='';
            $dest='';
            $date='';
            $name='';
            $message='';
            if($_SESSION['openmailListPhones']){
                $dest=$_SESSION['openmailListPhones'];
                unset($_SESSION['openmailListPhones']);
            }

        }else{
            $expediteur=$_POST['expediteur'];
            $dest=$_POST['dest'];
            $date=$_POST['date'];
            $name=$_POST['name'];
            $message=$_POST['message'];
            // verif des erreurs.
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
                $this->serviceOpm->smsSend($this->opmConnect,$arrayOfSms);
                    $expediteur='';
                    $dest='';
                    $date='';
                    $name='';
                    $message='';

                    $error[]=($dateFormatEn)?'SMS programmé':'SMS envoyé';
                }catch (Exception $e){
                    $error[]=$e->getMessage();
                }
            }
        }

            $this->_smarty->assign('expediteur',$expediteur);
            $this->_smarty->assign('dest',$dest);
            $this->_smarty->assign('date',$date);
            $this->_smarty->assign('name',$name);
            $this->_smarty->assign('message',$message);
            $this->_smarty->assign('error',$error);
            $this->_smarty->assign('listSenders',$this->serviceOpm->smsListPhoneSender($this->opmConnect));

    }
    private function sendEmail(){

        $error=array();
        $this->_title="Envoyer un Email";
//      $this->css[]="../../../libs/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css";
//      $this->js[]="../../../libs/plupload/js/plupload.full.min.js";
//      $this->js[]="../../../libs/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js";
        $this->js[]="../../../libs/plupload/js/i18n/fr.js";
        $this->js[]="sendEmail.js";

        $this->_template = dirname(__FILE__).'/views/sendEmail.tpl';

        $token = $_POST['token']==''?Tools::passwdGen(20):$_POST['token'];

        if(!$_SESSION['listSenders']){
            $listSenders=array();

            $tmp = $this->serviceOpm->emailListEmailAddressFrom($this->opmConnect,null);
            foreach($tmp as $i){
                if($i->active)$listSenders[]=$i;
            }
           // $_SESSION['listSenders']=$listSenders;
        }
        else{$listSenders=$_SESSION['listSenders'];}



        if(empty($_POST)){

            $expediteur='';
            $dest='';
            $date='';
            $name='';
            $message='';
            $subject='';

            if($_SESSION['openmailListEmails']){
                $dest=$_SESSION['openmailListEmails'];
                unset($_SESSION['openmailListEmails']);
            }

        }else{
            $expediteur=$_POST['expediteur'];
            $message=$_POST['message'];
            $subject = $_POST['subject'];
            $dest=$_POST['dest'];
            $date=$_POST['date'];
            $name=$_POST['name'];

            if(!empty($_POST['submitDelPj'])){

                if(!empty($_POST['delpj'])){
                    foreach($_POST['delpj'] as $index){
                        unset($_SESSION['emails_pj'][$token][$index]);
                    }
                }
            }

            if(isset($_POST['send'])){
               $error=Validforms::validFormSendOneEmail($dest,$subject,$date,$name,$message);

                // upload de la pj ?
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

                        /*
                            $from[0]->address,$ato,$acc,$abcc,$from[0]->addressReplyTo,$subject,$content,$arrayOfPj,null,$date_send,null)  ;
                         */
                        foreach($ato as $aato){
                            $arrayOfEmails[] = new OpenMailEmail(
                                $addressFrom,array($aato),$addressReplyTo,$subject,$message,$arrayOfPj,null,$date_send,null,$name)  ;
                        }
                        try{
                            $this->serviceOpm->emailSend($this->opmConnect,$arrayOfEmails);


                            unset($_SESSION['emails_pj'][$token]);
                            $dest='';
                            $expediteur='';
                            $subject='';
                            $message='';
                            $delpj=array();
                            $name='';
                            $error[]=  $now?'Email envoyé avec succès.':'Email programmé ('.$date.').' ;
                            $date='';
                            $token = empty($this->_post['token'])?Tools::passwdGen(20):$this->_post['token'];
                            $listSenders=array();
                            $tmp = $this->serviceOpm->emailListEmailAddressFrom($this->opmConnect,null);
                            foreach($tmp as $i){
                                if($i->active)$listSenders[]=$i;
                            }
                        }catch (Exception $e){
                            $error[]=$e->getMessage();
                        }
                    }
                }

        }




        $this->_smarty->assign('token',$token);
        $this->_smarty->assign('error',$error);
        $this->_smarty->assign('subject',$subject);
        $this->_smarty->assign('pjs',$_SESSION['emails_pj'][$token]);
        $this->_smarty->assign("urlScriptUpload",Constant::DEFAULT_URL.'/modules/'.$this->moduleName.'/ajax/');
        $this->_smarty->assign("urlBtns",Constant::DEFAULT_DIRECTORY.'/libs/plupload');

        $this->_smarty->assign('listSenders',$listSenders);
        $this->_smarty->assign('message',$message);
        $this->_smarty->assign('dest',$dest);
        $this->_smarty->assign('date',$date);
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('expediteur',$expediteur);
    }
    private function home(){
        // Affichage du solde des "options" OPM que l'on possède. Ainsi que le lien vers ope mail pour renouveler/s'inscrire
            $this->_title="Open mail";
            $this->_template = dirname(__FILE__).'/views/home.tpl';
        try{
            $smsCreditleft=$this->serviceOpm->smsCreditLeft($this->opmConnect);
        }catch (Exception $e){
            $smsCreditleft='error';
        }
        try{
          //  $faxCreditleft=$this->serviceOpm->faxCreditLeft($this->opmConnect);
            $faxCreditleft='error';
        }catch (Exception $e){
            $faxCreditleft='error';
        }
        try{
            $emailCreditleft=$this->serviceOpm->emailCreditLeft($this->opmConnect);
        }catch (Exception $e){
            $emailCreditleft='error';
        }


            $this->_smarty->assign('smsCreditleft',$smsCreditleft);
            $this->_smarty->assign('faxCreditleft',$faxCreditleft);
            $this->_smarty->assign('emailCreditleft',$emailCreditleft);


        }

	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
			// inclusion des modules enfants
			$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
		}
	}

	public function displayTpl( ){
        $this->_smarty->assign('js', $this->js);
        $this->_smarty->assign('css', $this->css);
        $this->_smarty->assign('module', $this->moduleName  );
		$this->_smarty->display('tpl_default/header.tpl');
		$this->_smarty->display( $this->_template );
		$this->_smarty->display('tpl_default/footer.tpl');
	}

	private function _addMainMenu(){
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}