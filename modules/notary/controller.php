<?php
class Controller extends CoreController {
	private $_smarty;
	private $_template ;
	private $_error_dependance;
	private $_user;
	private $_title;
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
			// autorisation necessaire pour cette action ?
			if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"dpe",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('notary');
				$this->_title = 'Gestion des notaires';
			}
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='list';
		if(isset($get['page'])&&$get['page']=='add'){
			$this->_template = dirname(__FILE__).'/views/add.tpl';
			$this->_title = 'Ajouter un notaire';
			$error = array();
			if(isset($post['notary_add_submit'])){
				if(empty($post['notary_add_name']))
				$error[] =Lang::ERROR_NOTARY_ADD_NAME_EMPTY;
				if(!empty($post['notary_add_mail'])&&!Tools::isEmail($post['notary_add_mail']))
				$error[] =Lang::ERROR_NOTARY_ADD_EMAIL_BAD_FORMAT;
				if(empty($error)){
					Notary::create(
					$this->_pdo,
					$post['notary_add_name'],
					$post['notary_add_firstname'],
					$post['notary_add_address'],
					$post['notary_add_city'],
					$post['notary_add_zip_code'],
					$post['notary_add_phone'],
					$post['notary_add_mobil_phone'],
					$post['notary_add_job_phone'],
					$post['notary_add_fax'],
					$post['notary_add_mail'],
					$post['notary_add_comments'],
					0);
					Log::create($this->_pdo,time(),'notary','Ajout du notaire : '.$post['notary_add_name'],$this->_user);
					header('location:'.$this->create_url($this->_user,$get['module']));
				}
			}
		}elseif(isset($get['page'])&&$get['page']=='list'){
			$this->_title='Liste des notaires';
			$this->_template = dirname(__FILE__).'/views/list.tpl';
			$tmp = Notary::loadAll($this->_pdo);
			$list = array();
			foreach($tmp as $item){
				$tmpA['id'] = $item->getIdNotary();
				$tmpA['name'] = $item->getFirstname().' '.$item->getName();
				$tmpA['email'] = $item->getEmail();
				$tmpA['number']= array($item->getPhone(),$item->getMobilPhone(),$item->getJobPhone());
				$tmpA['urlUpdate'] = $this->create_url($this->_user,$get['module'],'update',$item->getIdNotary());
				$tmpA['urlDelete'] = $this->create_url($this->_user,$get['module'],'delete',$item->getIdNotary());
				$tmpA['urlSee'] = $this->create_url($this->_user,$get['module'],'see',$item->getIdNotary());
				$list[]= $tmpA;
			}
			$this->_smarty->assign('list',$list);
		}
		elseif(isset($get['page'])&&$get['page']=='delete'){
			$this->_title = 'Suppression du notaire';
			$this->_template = dirname(__FILE__).'/views/delete.tpl';
			$notary = Notary::load($this->_pdo,$get['action']);
			$this->_smarty->assign('notary',$notary);
			if(isset($post['cancel_notary'])){
				header('location:'.$this->create_url($this->_user,$get['module'],'list'));
			}
			if(isset($post['send_notary'])){
					
				if($notary->getNumberUsed() == 0){
					Log::create($this->_pdo,time(),'notary','Suppression du notaire : '.$notary->getName(),$this->_user);
					$notary->delete();
					header('location:'.$this->create_url($this->_user,$get['module'],'list'));
				}else
				$error = Lang::ERROR_DELETE_NOTAIRE_BECAUSE_IS_USED;
			}
		}elseif(isset($get['page'])&&$get['page']=='update'){
			$this->_title = 'Mise à jour du notaire';
			$this->_template  = dirname(__FILE__).'/views/update.tpl';
			$notary = Notary::load($this->_pdo,$get['action']);
			if(empty($post)){
				$notary_update_name = $notary->getName();
				$notary_update_firstname= $notary->getFirstname();
				$notary_update_address= $notary->getAddress();
				$notary_update_city= $notary->getCity();
				$notary_update_zip_code= $notary->getZipCode();
				$notary_update_phone= $notary->getPhone();
				$notary_update_mobil_phone= $notary->getMobilPhone();
				$notary_update_job_phone= $notary->getJobPhone();
				$notary_update_fax= $notary->getFax();
				$notary_update_mail= $notary->getEmail();
				$notary_update_comments= $notary->getComments();
			}else{
				$notary_update_name = $post['notary_update_name'];
				$notary_update_firstname=  $post['notary_update_firstname'];
				$notary_update_address=  $post['notary_update_address'];
				$notary_update_city= $post['notary_update_city'];
				$notary_update_zip_code=  $post['notary_update_zip_code'];
				$notary_update_phone=  $post['notary_update_phone'];
				$notary_update_mobil_phone=  $post['notary_update_mobil_phone'];
				$notary_update_job_phone=  $post['notary_update_job_phone'];
				$notary_update_fax=  $post['notary_update_fax'];
				$notary_update_mail=  $post['notary_update_mail'];
				$notary_update_comments= $post['notary_update_comments'];

				if(isset($post['notary_update_submit'])){
					if(empty($post['notary_update_name']))
					$error[] =Lang::ERROR_NOTARY_ADD_NAME_EMPTY;
					if(!empty($post['notary_update_mail'])&&!Tools::isEmail($post['notary_update_mail']))
					$error[] =Lang::ERROR_NOTARY_ADD_EMAIL_BAD_FORMAT;
					if(empty($error)){
						$notary->setName($notary_update_name,false);
						$notary->setFirstname($notary_update_firstname,false);
						$notary->setAddress($notary_update_address,false);
						$notary->setCity($notary_update_city,false);
						$notary->setZipCode($notary_update_zip_code,false);
						$notary->setPhone($notary_update_phone,false);
						$notary->setMobilPhone($notary_update_mobil_phone,false);
						$notary->setJobPhone($notary_update_job_phone,false);
						$notary->setFax($notary_update_fax,false);
						$notary->setEmail($notary_update_mail,false);
						$notary->setComments($notary_update_comments,false);
						$notary->update();
						Log::create($this->_pdo,time(),'notary','Modification du notaire '.$notary->getName(),$this->_user );
						header('location:'.$this->create_url($this->_user,$get['module'],'list'));
					}
				}
			}
			$this->_smarty->assign('notary_update_name',$notary_update_name);
			$this->_smarty->assign('notary_update_firstname',$notary_update_firstname);
			$this->_smarty->assign('notary_update_address',$notary_update_address);
			$this->_smarty->assign('notary_update_city',$notary_update_city);
			$this->_smarty->assign('notary_update_zip_code',$notary_update_zip_code);
			$this->_smarty->assign('notary_update_phone',$notary_update_phone);
			$this->_smarty->assign('notary_update_mobil_phone',$notary_update_mobil_phone);
			$this->_smarty->assign('notary_update_job_phone',$notary_update_job_phone);
			$this->_smarty->assign('notary_update_fax',$notary_update_fax);
			$this->_smarty->assign('notary_update_mail',$notary_update_mail);
			$this->_smarty->assign('notary_update_comments',$notary_update_comments);
		}elseif(isset($get['page'])&&$get['page']=='see'){
			$this->_title='Visualiser la fiche du notaire';
			$this->_template = dirname(__FILE__).'/views/see.tpl';
			$notary = Notary::load($this->_pdo,$get['action']);
			$this->_smarty->assign('notary',$notary);
			$this->_smarty->assign('urlUpdate',$this->create_url($this->_user,'notary','update',$get['action']));
			$this->_smarty->assign('urlDelete',$this->create_url($this->_user,'notary','delete',$get['action']));
			// listes des clercs :
			$pdoStatement = $notary->selectNotaryClerks();
			
			$this->_smarty->assign('list',NotaryClerk::fetchAll($this->_pdo, $pdoStatement));
		}elseif(isset($get['page'])&&$get['page']=='seeClerk'){
				$this->_title='Visualiser la fiche du notaire';
				$this->_template = dirname(__FILE__).'/views/seeClerk.tpl';
				$clerk = NotaryClerk::load($this->_pdo,$get['action']);
				$this->_smarty->assign('clerk',$clerk);
				$this->_smarty->assign('urlUpdate',$this->create_url($this->_user,'notary','updateClerk',$get['action']));
				$this->_smarty->assign('urlDelete',$this->create_url($this->_user,'notary','deleteClerk',$get['action']));
				// listes des clercs :
				
		}elseif(isset($get['page'])&&$get['page']=='addClerk'){
			$this->_template = dirname(__FILE__).'/views/addClerk.tpl';
			$notary = Notary::load($this->_pdo, $get['action'] );
			$this->_smarty->assign('notary',$notary);
			
			// Si ajout ou annuler.
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'notary','see', $notary->getIdNotary() ));
			}
			if(isset($post['notary_add_submit'])){
				$name=$post['notary_add_name'];
				 $firstname=$post['notary_add_firstname'];
				 $address=$post['notary_add_address'];
				 $city=$post['notary_add_city'];
				 $zipCode=$post['notary_add_zip_code'];
				 $phone=$post['notary_add_phone'];
				 $mobilPhone=$post['notary_add_mobil_phone'];
				 $jobPhone=$post['notary_add_job_phone'];
				 $fax=$post['notary_add_fax'];
				$email=$post['notary_add_mail'];
				 $comments=$post['notary_add_comments'];
				
				NotaryClerk::create($this->_pdo, $name, $firstname, $address, $city, $zipCode, $phone, $mobilPhone, $jobPhone, $fax, $email, $comments, 0, $notary);
				header('location:'.Tools::create_url($this->_user,'notary','see', $notary->getIdNotary() ));
			}
			
		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
            // $this->_template =dirname(__FILE__).'/views/log.tpl';
            $this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'notary');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
		}
		$this->_smarty->assign('error',$error);
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