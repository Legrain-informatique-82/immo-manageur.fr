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
			// Si la limite est atteinte, on redirige la sortie
			if(Constant::LIMIT_NB_USER <  (User::count($this->_pdo)+1)){
				$this->_template = dirname(__FILE__).'/../tpl_default/limit.tpl';
				$this->_smarty->assign('limit','<h1>Limite du nombre d\'utilisateurs atteinte</h1><div class="bulle"><p>Vous ne pouvez pas ajouter un nouvel utilisateur car votre contrat vous permet d\'en avoir '.Constant::LIMIT_NB_USER.'.</p><p> Pour augmenter cette limite, merci de contacter Legrain.</p></div>');
			}else{
				$this->_smarty->assign('listOfAgency',Agency::loadAll($this->_pdo));
				$this->_smarty->assign('listOfLevel',LevelMember::loadAll($this->_pdo));
				$user_add_theme = '';
				$listOfThemes = array();
				foreach( glob(Constant::DEFAULT_CSS_DIRECTORY.'*') as $th){
					if(is_dir($th)){
						$th = explode( '/',$th );
						$th = $th[count($th) -1 ];
						if($th !='pie' && $th !='CVS')
						$listOfThemes[]=$th;
					}
				}
				// limite de membres : Constant::LIMIT_NB_USER < count ($users)
					
				$this->_smarty->assign('listOfThemes',$listOfThemes);
				$this->_template = dirname(__FILE__).'/views/add.tpl';

				if(isset($post['user_add_submit'])){
					$user_add_theme = $post['theme'];
					$this->_smarty->assign('user_add_theme',$user_add_theme);
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
						$agency,
						$user_add_theme,
						$post['user_openInNewTab'],
                        $post['user_add_cellphone']
							
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

					$listOfThemes = array();
					foreach( glob(Constant::DEFAULT_CSS_DIRECTORY.'*') as $th){
						if(is_dir($th)){
							$th = explode( '/',$th );
							$th = $th[count($th) -1 ];
							if($th !='pie' && $th !='CVS')
							$listOfThemes[]=$th;
						}
					}
					$this->_smarty->assign('listOfThemes',$listOfThemes);
					if(empty($post)){
						// Utilisation du compte classique
						$this->_smarty->assign('user_update_identifiant',$userToBeUpdated->getIdentifiant() );
						$this->_smarty->assign('user_update_old_identifiant',$userToBeUpdated->getIdentifiant() );
						$this->_smarty->assign('user_update_name',$userToBeUpdated->getName() );
						$this->_smarty->assign('user_update_firstname',$userToBeUpdated->getFirstname());
						$this->_smarty->assign('user_update_email',$userToBeUpdated->getEmail());
						$this->_smarty->assign('user_update_agency',$userToBeUpdated->getAgency()->getIdAgency());
						$this->_smarty->assign('user_update_level',$userToBeUpdated->getLevelMember()->getIdLevelMember() );
						$this->_smarty->assign('user_update_theme',$userToBeUpdated->getTheme() );
						$this->_smarty->assign('user_openInNewTab',$userToBeUpdated->getOpenInNewTab() );
						$this->_smarty->assign('user_update_cellphone',$userToBeUpdated->getCellPhone() );

						// 						$this->_smarty->assign('openInNewTab',$userToBeUpdated->get );

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
							if(empty($post['user_update_identifiant'])){
								array_push($error,'L\'identifiant doit être renseigné.');
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
								$userToBeUpdated->setTheme($post['theme'],false);
								$userToBeUpdated->setCellPhone($post['user_update_cellphone'],false);

								if($post['user_update_level']) {
									$userToBeUpdated->setAgency(Agency::load($this->_pdo,$post['user_update_agency']),false);
								}
								if($post['user_update_level']){
									$userToBeUpdated->setLevelMember(LevelMember::load($this->_pdo,$post['user_update_level']),false);
								}
								$userToBeUpdated->setOpenInNewTab($post['user_openInNewTab'],false);
								
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
								$this->_smarty->assign('user_update_cellphone',$post['user_update_cellphone'] );
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
			$HistoricConnexion = HistoricConnection::selectByUser($this->_pdo,$userToSee,' ORDER BY h.dateConnection DESC');
			$arrayHistory = array();
			while ($historicConnection =HistoricConnection::fetch($this->_pdo,$HistoricConnexion) ) {
				$arrayHistory[] = $historicConnection;
			}
			$arrayLog = array();
			$a = Log::selectByUser($this->_pdo,$userToSee,' ORDER BY dateLog DESC');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
			$this->_smarty->assign('historicConnexion', $arrayHistory );
			$this->_template = dirname(__FILE__).'/views/see.tpl';
		}if(isset($get['page'])&&$get['page']=='addAgency'){
			$this->_title = 'Ajouter une agence';
			$error = array();
			if(Constant::LIMIT_NB_AGENCY <  (Agency::count($this->_pdo)+1)){

				$this->_template = dirname(__FILE__).'/../tpl_default/limit.tpl';
				$this->_smarty->assign('limit','<h1>Limite du nombre d\'agences atteinte</h1><div class="bulle"><p>Vous ne pouvez pas ajouter une nouvelle agence car votre contrat vous permet d\'en avoir '.Constant::LIMIT_NB_AGENCY.'.</p><p> Pour augmenter cette limite, merci de contacter Legrain.</p></div>');

			}else{
				// ajout de l'agence
				$this->_template =  dirname(__FILE__).'/views/addAgency.tpl';

				if($post['add']){
					// verif des erreurs

					// Ajout des uploads un peu apres
					$logoExtranet='';
					$logoAfficheMandat='';
					$logoAfficheTerrain='';
					$logoCourrier='';
					$enteteLettre='';
					$logoFooterLettre='';
					$footerLettre='';
					
					
					
					if($_FILES['enteteLettre']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['enteteLettre'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg');
						if($file->goUpload()){
							$name = 'entetelettre_'.time().'.jpg';
							$file->rename( $name );
							Tools::redimentionne(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$name, 564, 115);
							$enteteLettre = $name ;
							// 						$enteteLettre = $name;
						}else{
							$error['errorEnteteLettre'] = $file->afficheError();
						}
						unset($file);
					}
					
					if($_FILES['logoFooterLettre']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['logoFooterLettre'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg');
						if($file->goUpload()){
							$name = 'footerlettre_'.time().'.jpg';
							$file->rename( $name );
							Tools::redimentionne(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$name, 50, 50);
							$logoFooterLettre = $name ;
							// 						$enteteLettre = $name;
						}else{
							$error['errorLogoFooterLettre'] = $file->afficheError();
						}
						unset($file);
					}
					
					
					
					
					if($_FILES['logoExtranet']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['logoExtranet'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('png');
						if($file->goUpload()){
							$name = 'logoExtranet_'.time().'.png';
							$file->rename( $name );
							$logoExtranet = $name;
						}else{
							$error['errorlogoExtranet'] = $file->afficheError();
						}
						unset($file);
					}
					// logoAfficheMandat

					if($_FILES['logoAfficheMandat']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['logoAfficheMandat'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg');
						if($file->goUpload()){
							$name = 'logoAfficheMandat_'.time().'.jpg';
							$file->rename( $name );
							$logoAfficheMandat = $name;
						}else{
							$error['errorAfficheMandat'] = $file->afficheError();
						}
						unset($file);
					}
					// logoAfficheMandat
					if($_FILES['logoAfficheTerrain']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['logoAfficheTerrain'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg');
						if($file->goUpload()){
							$name = 'logoAfficheTerrain_'.time().'.jpg';
							$file->rename( $name );
							$logoAfficheTerrain = $name;
						}else{
							$error['errorAfficheTerrain'] = $file->afficheError();
						}
						unset($file);
					}
					// logoAfficheMandat
					if($_FILES['logoCourrier']['tmp_name']){
						// upload
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['logoCourrier'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg');
						if($file->goUpload()){
							$name = 'logoCourrier_'.time().'.jpg';
							$file->rename( $name );
							$logoCourrier = $name;
						}else{
							$error['errorAfficheTerrain'] = $file->afficheError();
						}
						unset($file);
					}
					//$enteteLettre,$logoFooterLettre,$footerLettre
			
					if(empty($error)){
						// on sauve
						// Puis on renomme les images ( bdd et physique)
						// 						var_dump($post);
								

						$agency = Agency::create($this->_pdo, $post['name'],$post['tel1'],$post['tel2'],$post['tel3'],$post['email'],$post['address'],$post['city'],$post['zipCode'],$post['contact'],$post['siret'],$post['capital'],$logoExtranet,$logoAfficheMandat,$logoAfficheTerrain,$logoCourrier,$post['generalName'],$post['url'],$enteteLettre,$logoFooterLettre,$post['footerLettre']);

						//$agency->getId();
						// On récupere les images et on les renommes/
						
						if($agency->getEnteteLettre()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getEnteteLettre() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getEnteteLettre(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/entetelettre_'.$agency->getId().'.jpg');
								$agency->setEnteteLettre('entetelettre_'.$agency->getId().'.jpg');
							}
						}
					
						if($agency->getLogoFooterLettre()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoFooterLettre() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoFooterLettre(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/footerlettre_'.$agency->getId().'.jpg');
								$agency->setLogoFooterLettre('footerlettre_'.$agency->getId().'.jpg');
							}
						}
						


						if($agency->getLogoExtranet()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoExtranet() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoExtranet(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/logoExtranet_'.$agency->getId().'.png');
								$agency->setLogoExtranet('logoExtranet_'.$agency->getId().'.png');
							}
						}

						if($agency->getLogoAfficheMandat()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoAfficheMandat() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoAfficheMandat(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/logoAfficheMandat_'.$agency->getId().'.jpg');
								$agency->setLogoAfficheMandat('logoAfficheMandat_'.$agency->getId().'.jpg');
							}
						}

						if($agency->getLogoAfficheTerrain()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoAfficheTerrain() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoAfficheTerrain(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/logoAfficheTerrain_'.$agency->getId().'.jpg');
								$agency->setLogoAfficheTerrain('logoAfficheTerrain_'.$agency->getId().'.jpg');
							}
						}

						if($agency->getLogoCourrier()){
							if(is_file(  Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoCourrier() )){
								rename(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$agency->getLogoCourrier(),Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/logoCourrier_'.$agency->getId().'.jpg');
								$agency->setLogoCourrier('logoCourrier_'.$agency->getId().'.jpg');
							}
						}
						// + redirection à la liste des agences
						header('location:'.Tools::create_url($this->_user,$get['module'], 'listAgencies' ));
					}
				}
				$this->_smarty->assign('error',$error);
			}


			// 			$this->_template =  dirname(__FILE__).'/views/listAgencies.tpl';
		}if(isset($get['page'])&&$get['page']=='listAgencies'){
			// Affiche a liste des agences
			$this->_title = 'Liste des agences';
			$this->_template =  dirname(__FILE__).'/views/listAgencies.tpl';
			$this->_smarty->assign('agencies',Agency::loadAll($this->_pdo) ) ;

		}if(isset($get['page'])&&$get['page']=='updAgency'){
			$this->_title = 'Mise à jour de l\'agence';
			$this->_template =  dirname(__FILE__).'/views/updAgency.tpl';
			$agency = Agency::load( $this->_pdo,$get['action'] );

			if(!empty($post)){
				// truc general
				$agency->setName($post['name'],false);
				$agency->setTel1($post['tel1'],false);
				$agency->setTel2($post['tel2'],false);
				$agency->setTel3($post['tel3'],false);
				$agency->setEmail($post['email'],false);
				$agency->setAddress($post['address'],false);
				$agency->setCity($post['city'],false);
				$agency->setZipCode($post['zipCode'],false);
				$agency->setContact($post['contact'],false);
				$agency->setSiret($post['siret'],false);
				$agency->setCapital($post['capital'],false);
				$agency->setGeneralName($post['generalName'],false);
				$agency->setUrl($post['url'],false);
				
				$agency->setFooterLettre($post['footerLettre'],false);
				

				// upload

				// logo extranet
				if($_FILES['logoExtranet']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['logoExtranet'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('png');
					if($file->goUpload()){
						$name = 'logoExtranet_'.$agency->getId().'.png';
						$file->rename( $name );
						$agency->setLogoExtranet($name);
					}else{
						$error['errorlogoExtranet'] = $file->afficheError();
					}
					unset($file);
				}
				// logoAfficheMandat

				if($_FILES['logoAfficheMandat']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['logoAfficheMandat'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$name = 'logoAfficheMandat_'.$agency->getId().'.jpg';
						$file->rename( $name );
						$agency->setLogoAfficheMandat($name);
					}else{
						$error['errorAfficheMandat'] = $file->afficheError();
					}
					unset($file);
				}
				// logoAfficheMandat
				if($_FILES['logoAfficheTerrain']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['logoAfficheTerrain'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$name = 'logoAfficheTerrain_'.$agency->getId().'.jpg';
						$file->rename( $name );
						$agency->setLogoAfficheTerrain($name);
					}else{
						$error['errorAfficheTerrain'] = $file->afficheError();
					}
					unset($file);
				}
				// logoAfficheMandat
				if($_FILES['logoCourrier']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['logoCourrier'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$name = 'logoCourrier_'.$agency->getId().'.jpg';
						$file->rename( $name );
						$agency->setLogoCourrier($name);
					}else{
						$error['errorAfficheTerrain'] = $file->afficheError();
					}
					unset($file);
				}
				
				if($_FILES['enteteLettre']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['enteteLettre'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$name = 'entetelettre_'.$agency->getId().'.jpg';
						$file->rename( $name );
						Tools::redimentionne(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$name, 564, 115);
						$agency->setEnteteLettre($name );
// 						$enteteLettre = $name;
					}else{
						$error['errorEnteteLettre'] = $file->afficheError();
					}
					unset($file);
				}
				
				if($_FILES['logoFooterLettre']['tmp_name']){
					// upload
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['logoFooterLettre'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$name = 'footerlettre_'.$agency->getId().'.jpg';
						$file->rename( $name );
						Tools::redimentionne(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/'.$name, 50, 50);
						$agency->setLogoFooterLettre($name );
						// 						$enteteLettre = $name;
					}else{
						$error['errorLogoFooterLettre'] = $file->afficheError();
					}
					unset($file);
				}
				
				// Si pas d'erreurs
				if(empty($error)){
					// upd

					$agency->update();
					header('location:'.Tools::create_url($this->_user,'user','listAgencies'));

				}
			}
			$this->_smarty->assign('agency',$agency) ;
			$this->_smarty->assign('errorlogoExtranet',$error['errorlogoExtranet']) ;
			$this->_smarty->assign('errorAfficheMandat',$error['errorAfficheMandat']) ;
			$this->_smarty->assign('errorAfficheTerrain',$error['errorAfficheTerrain']) ;
			$this->_smarty->assign('errorEnteteCourrier',$error['errorEnteteCourrier']) ;
			$this->_smarty->assign('errorEnteteLettre',$error['errorEnteteLettre']) ;




		}
		// logs
		if(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
//			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'user');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
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