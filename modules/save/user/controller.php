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
				Log::create($this->_pdo,time(),"user",'accès non autorisé',$this->_user);
			} else{
				$this->_template = dirname(__FILE__).'/views/accueil.tpl';
				$this->_addMainMenu();
				$this->_addMenu('user');
				$this->_title = 'Gestion des utilisateurs';
			}
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',$this->_title);
	}
	public function treatment( $post,$get){
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
			// inclusion des modules enfants
			$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
		}
	}

	private function _treatment(  $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='list';
		$this->_smarty->assign('user',$this->_user );
		if(isset($get['page'])&&$get['page']=='add'){
			$this->_title = 'Ajout d\'un utilisateur';
			$this->_smarty->assign('listOfAgency',Agency::loadAll($this->_pdo));
			$this->_smarty->assign('listOfLevel',LevelMember::loadAll($this->_pdo));

			$this->_template = dirname(__FILE__).'/views/add.tpl';

			if(isset($post['user_add_submit'])){

				$error =array();
				if(Tools::characters_allowed( $post['user_add_identifiant'] )){
					array_push($error,Lang::ERROR_USER_ADD_IDENTIFIANT_CHARACTERS_ALLOWED);
				}elseif( User::count($this->_pdo, "identifiant='".htmlspecialchars(addslashes($post['user_add_identifiant']))."'")!=0){
					array_push($error,Lang::ERROR_USER_ADD_IDENTIFIANT_IS_IN_DB);
				}
				if(!empty($post['user_add_password'])){
					$password = $post['user_add_password'];
					// On vérifie que le champ est correct (pas de caracteres prohibés)
					if(Tools::characters_allowed( $post['user_add_password'] )){
						array_push($error,Lang::ERROR_USER_ADD_PASSWORD_CHARACTERS_ALLOWED);
					}
					if( Tools::strlenWithAccentedCharacters($post['user_add_password'])< Constant::LENGHT_MIN_PASSWORD  || strlen($post['user_add_password'])>Constant::LENGHT_MAX_PASSWORD){
						array_push($error,str_replace(array('{sizeMin}','{sizeMax}'),array(Constant::LENGHT_MIN_PASSWORD,Constant::LENGHT_MAX_PASSWORD),Lang::ERROR_USER_ADD_SIZE_PASSWORD));
					}
					if($post['user_add_password']!==$post['user_add_confirm_password']){
						array_push($error,Lang::ERROR_USER_ADD_DIFFERENT_PASSWORD);
					}
				}else{
					$password = Tools::passwdGen(Constant::LENGHT_PASSWORD_GENERATE);
				}
				if(empty($post['user_add_name'])){
					array_push($error,Lang::ERROR_USER_ADD_EMPTY_NAME);
				}
				if(empty($post['user_add_email'])){
					array_push($error,Lang::ERROR_USER_ADD_EMPTY_EMAIL);
				}else{
					if(!Tools::isEmail($post['user_add_email'])){
						array_push($error,Lang::ERROR_USER_ADD_CORRECT_EMAIL);
					}

				}
				//	echo $password;
				$this->_smarty->assign('error',$error);
				if(empty($error)){
					$registration_date = time();
					$agency = Agency::load($this->_pdo,$post['user_add_agency']);
					$level = LevelMember::load($this->_pdo,$post['user_add_level']);
					User::create($this->_pdo,
					$post['user_add_identifiant'],
					sha1($registration_date.$password.$registration_date),
					$post['user_add_name'],
					$post['user_add_firstname'],
					$post['user_add_email'],
					$registration_date,
					0, // nombre d'utilisation
					$level,
					$agency
					);
					// Ajout du log d'action
					Log::create($this->_pdo,time(),'user','Ajout d\'un nouvel utilisateur : '.$post['user_add_identifiant'],$this->_user);
					// Mail de rappel
					try {
						$oEmail = new SimpleMail ();
						$oEmail->From = Constant::EMAIL_APP;
						$oEmail->To = array ($post['user_add_email']);
						$oEmail->Subject = Lang::SUBJECT_REGISTRATION_MAIL;
						$oEmail->addBody (
						str_replace(
						array('{identifiant}','{password}','{name}','{url}'),
						array($post['user_add_identifiant'],$password,$post['user_add_name'],Constant::DEFAULT_URL),
						LANG::CONTENT_REGISTRATION_MAIL),
						'text/html');
						$oEmail->send ();
					}catch (Exception $oE) {
						var_dump ($oE);
						echo 'An error occured during sending the message.<br />'.$oE->getMessage ();
					}
					// redirection // Si le membre n'a pas accès au module principal, il faut le rediriger vers le module par defaut.
					header('location:'.$this->create_url($this->_user,$get['module']));
				}
			}
		}
		if(isset($get['page'])&&$get['page']=='list'){
			$this->_title = 'liste des utilisateurs';
			$this->_template = dirname(__FILE__).'/views/list.tpl';
			$users = User::loadAll($this->_pdo);
			$listUsers = array();
			// niveau accès del'utilisateur connecté
			$this->_smarty->assign('user',$this->_user );

			foreach( $users as $u ){
				$a['idUser'] = $u->getIdUser();
				$a['identifiant'] = $u->getIdentifiant();
				$a['name'] = $u->getName().' '.$u->getFirstname();
				$a['agency'] = $u->getAgency()->getName();
				$a['levelMember'] = $u->getLevelMember()->getName();
				$a['urlUpdate'] = $this->create_url($this->_user,'user','update',$u->getIdUser());
				$a['urlDelete'] = $this->create_url($this->_user,'user','delete',$u->getIdUser());
				$a['urlSee'] = $this->create_url($this->_user,'user','see',$u->getIdUser());
				array_push($listUsers,$a);
			}
			$this->_smarty->assign('listUsers',$listUsers);
		}
		// delete
		if(isset($get['page'])&&$get['page']=='delete'){
			$this->_title = 'Suppression d\'un utilisateur';
			$this->_template = dirname(__FILE__).'/views/delete.tpl';
			if(isset($post['user_delete_submit_cancel'])&&$post['user_delete_submit_cancel']=='Annuler'){
				header('location:'.$this->create_url($this->_user,'user','list') );
			}
			if(isset($post['user_delete_submit_valid'])&&$post['user_delete_submit_valid']=='Valider'){
				$userDel = User::load($this->_pdo,$post['user_delete_id_user']);
				if($userDel->getNumberUsed()==0){
					if(!$this->_user->equals($userDel)){
						$log = 'Suppression de : '.$userDel->getIdentifiant();
						// supprimer les logs de l'utilisateur
						Log::deleteByUser( $this->_pdo, $userDel );
						// delete
						$userDel->delete( );
						Log::create($this->_pdo,time(),'user',$log,$this->_user);
						header('location:'.$this->create_url($this->_user,'user','list') );
					}else{
						// Affiche impossibilité de suicider son utilisateur.
						$this->_smarty->assign('error',Lang::ERROR_USER_DELETE);
					}
				}else{
					$this->_smarty->assign('error','Impossible de supprimer cet utilisateur car il est utilisé');
				}
			}
		}
		// update
		if(isset($get['page'])&&$get['page']=='update'){
			$this->_title = 'Mise à jour de l\'utilisateur';
			if(is_numeric($get['action'])){
				// On regarde que le membre modifie son propre compte s'il n'est pas admin
				if( ( $this->_user->getLevelMember()->getIdLevelMember() == 1) || $this->_user->getIdUser()== $get['action'] ){
					$this->_template = dirname(__FILE__).'/views/update.tpl';
					// Load du bon utilisateur
					$userToBeUpdated = User::load($this->_pdo,$get['action']);
					$this->_smarty->assign('listOfAgency',Agency::loadAll($this->_pdo));
					$this->_smarty->assign('listOfLevel',LevelMember::loadAll($this->_pdo));
					if(empty($post)){
						// Utilisation du compte classique
						$this->_smarty->assign('user_update_identifiant',$userToBeUpdated->getIdentifiant() );
						$this->_smarty->assign('user_update_old_identifiant',$userToBeUpdated->getIdentifiant() );
						$this->_smarty->assign('user_update_name',$userToBeUpdated->getName() );
						$this->_smarty->assign('user_update_firstname',$userToBeUpdated->getFirstname());
						$this->_smarty->assign('user_update_email',$userToBeUpdated->getEmail());
						$this->_smarty->assign('user_update_agency',$userToBeUpdated->getAgency()->getIdAgency());
						$this->_smarty->assign('user_update_level',$userToBeUpdated->getLevelMember()->getIdLevelMember() );
					}else{
						if(isset($post['user_update_submit'])){
							// vérif des données.
							$error =array();
							if($post['user_update_identifiant']){
								if(Tools::characters_allowed( $post['user_update_identifiant'] ) ){
									array_push($error,Lang::ERROR_USER_ADD_IDENTIFIANT_CHARACTERS_ALLOWED);
								}elseif($post['user_update_identifiant']!==$post['user_update_old_identifiant']&& User::count($this->_pdo, "identifiant='".htmlspecialchars(addslashes($post['user_update_identifiant']))."'")!=0){
									array_push($error,Lang::ERROR_USER_ADD_IDENTIFIANT_IS_IN_DB);
								}
							}
							if(!empty($post['user_update_password'])){
								$password = $post['user_update_password'];
								// On vérifie que le champ est correct (pas de caracteres prohibés)
								if(Tools::characters_allowed( $post['user_update_password'] )){
									array_push($error,Lang::ERROR_USER_ADD_PASSWORD_CHARACTERS_ALLOWED);
								}
								if( Tools::strlenWithAccentedCharacters($post['user_update_password'])< Constant::LENGHT_MIN_PASSWORD  || strlen($post['user_update_password'])>Constant::LENGHT_MAX_PASSWORD){
									array_push($error,str_replace(array('{sizeMin}','{sizeMax}'),array(Constant::LENGHT_MIN_PASSWORD,Constant::LENGHT_MAX_PASSWORD),Lang::ERROR_USER_ADD_SIZE_PASSWORD));
								}
								if($post['user_update_password']!==$post['user_update_confirm_password']){
									array_push($error,Lang::ERROR_USER_ADD_DIFFERENT_PASSWORD);
								}
							}
							if(empty($post['user_update_name'])){
								array_push($error,Lang::ERROR_USER_ADD_EMPTY_NAME);
							}
							if(empty($post['user_update_email'])){
								array_push($error,Lang::ERROR_USER_ADD_EMPTY_EMAIL);
							}else{
								if(!Tools::isEmail($post['user_update_email'])){
									array_push($error,Lang::ERROR_USER_ADD_CORRECT_EMAIL);
								}
							}
							//	echo $password;
							$this->_smarty->assign('error',$error);
							if(empty($error)){
								// SAVE
								if($post['user_update_identifiant']){
									$userToBeUpdated->setIdentifiant($post['user_update_identifiant']);
								}
								if(!empty($post['user_update_password'])){
									$userToBeUpdated->setPassword( sha1($userToBeUpdated->getRegistration_date().$post['user_update_password'].$userToBeUpdated->getRegistration_date()),false ) ;
								}
								$userToBeUpdated->setName($post['user_update_name'],false);
								$userToBeUpdated->setFirstname($post['user_update_firstname'],false);
								$userToBeUpdated->setEmail($post['user_update_email'],false);
								if($post['user_update_level']) {
									$userToBeUpdated->setAgency(Agency::load($this->_pdo,$post['user_update_agency']),false);
								}
								if($post['user_update_level']){
									$userToBeUpdated->setLevelMember(LevelMember::load($this->_pdo,$post['user_update_level']),false);
								}
								$userToBeUpdated->update();
								Log::create($this->_pdo,time(),'user','Mise à jour du membre : '.$userToBeUpdated->getIdentifiant() , $this->_user);
								if(!empty($post['user_update_password'])){
									try {
										$oEmail = new SimpleMail ();
										$oEmail->From = Constant::EMAIL_APP;
										$oEmail->To = array ($post['user_update_email']);
										$oEmail->Subject = Lang::SUBJECT_UPDATE_MAIL;
										$oEmail->addBody (
										str_replace(
										array('{identifiant}','{password}','{name}','{url}'),
										array($post['user_update_identifiant'],$post['user_update_password'],$post['user_update_name'],Constant::DEFAULT_URL),LANG::CONTENT_UPDATE_MAIL),'text/html');
										$oEmail->send ();
									}catch (Exception $oE) {
										var_dump ($oE);
										echo 'An error occured during sending the message.<br />'.$oE->getMessage ();
									}
								}
								if($userToBeUpdated->equals($this->_user)){
									$_SESSION['user'] = $this->_user->serialize();
								}
								header('location:'.$this->create_url($this->_user,'user','list') );
							}else{
								// passage de post
								$this->_smarty->assign('user_update_identifiant',$post['user_update_identifiant']);
								$this->_smarty->assign('user_update_old_identifiant',$post['user_update_old_identifiant'] );
								$this->_smarty->assign('user_update_name',$post['user_update_name'] );
								$this->_smarty->assign('user_update_firstname',$post['user_update_firstname']);
								$this->_smarty->assign('user_update_email',$post['user_update_email']);
								$this->_smarty->assign('user_update_agency',$post['user_update_agency']);
								$this->_smarty->assign('user_update_level',$post['user_update_level'] );
							}
						}

					}

				}else{
					$this->_template = $this->getTplErrorViolationAccess();
					Log::create($this->_pdo,time(),"user",'accès non autorisé : tentative de modification d\'un autre compte que le sien.',$this->_user);
				}

			}else{
				$this->_template = $this->getTplErrorViolationAccess();
			}
		}
		if(isset($get['page'])&&$get['page']=='see'){
			$this->_title = 'Fiche de l\'utilisateur';
			// utilisateur à voir
			$userToSee = User::load($this->_pdo,$get['action']);
			$this->_smarty->assign('userToSee', $userToSee );
			// utilisateur connecté
			$this->_smarty->assign('user',$this->_user );
			$HistoricConnexion = HistoricConnection::selectByUser($this->_pdo,$userToSee,' ORDER BY h.dateConnection DESC LIMIT 0,5');
			$arrayHistory = array();
			while ($historicConnection =HistoricConnection::fetch($this->_pdo,$HistoricConnexion) ) {
				$arrayHistory[] = $historicConnection;
			}
			$arrayLog = array();
			$a = Log::selectByUser($this->_pdo,$userToSee,' ORDER BY dateLog DESC');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );}
				$this->_smarty->assign('historicConnexion', $arrayHistory );
				$this->_template = dirname(__FILE__).'/views/see.tpl';
		}
		// logs
		if(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$a = Log::selectByModule($this->_pdo,'user');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );}
		}
	}


	public function displayTpl(){
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