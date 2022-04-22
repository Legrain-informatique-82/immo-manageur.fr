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
			// autorisation necessaire pour cette action ? // reste le cas de la modification de sa propre fiche ...
			if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"export_site",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('export_site');
				$this->_title = 'Gestion du site d\'export';;
			}
		}
	}

	protected function install(){
		// 		if(!$this->getInstallation('acquereur')){
		// install
		// 			AcquereurAssocie::createTableIfNotExist($this->_pdo);
		// défini le module comme installé
		// 			$this->setInstallation('acquereur', 1);
		// 		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='upd';
		$error = array();
		if( isset($get['page'])&&$get['page']==='upd' ){
			$this->_title = 'Généralités';
			$this->_template =dirname(__FILE__).'/views/generalite.tpl';
			$this->_smarty->assign('themes',SiteExportTheme::loadAll($this->_pdo));
				
			$se = SiteExport::load($this->_pdo,1);
			if($se === null){
				$se= SiteExport::create($this->_pdo, '', '', '', '', '', '', '', '','', SiteExportTheme::load($this->_pdo, 1),false,'','','','','','','','','');
			}
				
			$this->_smarty->assign('se',$se);
				
			if(isset($post['send'])){
				$oldHeader = false;
				$oldLogo = false;
				$se->setNomSite($post['nomSite'],false);
				$se->setEmailContact($post['emailContact'],false);

				$se->setRobots( $post['robots'],false);
				$se->setTheme( SiteExportTheme::load($this->_pdo, $post['theme']),false);
				$se->setNbNouveauteParAgence($post['nbNouveauteParAgence'],false);
				$se->setNbAnnoncesParPage($post['nbAnnonceParPage'],false);
				
				$se->setNameAgency($post['nameAgency'],false);
				
				$se->setAddressAgency($post['addressAgency'],false);
				$se->setZipCodeAgency($post['zipCodeAgency'],false);
				$se->setCityAgency($post['cityAgency'],false);
				$se->setPhoneAgency($post['phoneAgency'],false);
				$se->setFaxAgency($post['faxAgency'],false);

				// endroit ou sauvegarder l'entete et le logo
				// /var/www/aptana/extra-immo/images/modules/export_site/images
				$file = new upload();
				$file->setTaille(9200000000);
				$file->setFichier( $_FILES['header'] );
				$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/images/' );
				$file->setExtension('jpg','jpeg');
				if($file->goUpload()){
					$file->rename('header_'.time().'.jpg');
					// mettre en const
					//Tools::redimentionne($file->getFichier(),Constant::SIZE_HEADER_EXPORT_SITE_X , Constant::SIZE_HEADER_EXPORT_SITE_Y);
					$oldHeader = $se->getHeader();
					$se->setHeader( $file->getNomFichier() ,false);
				}


				$file = new upload();
				$file->setTaille(9200000000);
				$file->setFichier( $_FILES['logo'] );
				$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/images/' );
				$file->setExtension('png');
				if($file->goUpload()){
					$file->rename('logo_'.time().'.png');
					// mettre en const
					//Tools::redimentionne($file->getFichier(), Constant::SIZE_LOGO_EXPORT_SITE_X, Constant::SIZE_LOGO_EXPORT_SITE_Y );
					$oldLogo = $se->getLogo();
					$se->setLogo( $file->getNomFichier() ,false);
				}

				if(empty($error)){
					if($oldHeader)
					unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/images/'.$oldHeader);
					if($oldLogo)
					unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/images/'.$oldLogo);
					// enregistrement
					$se->update();
					Log::create($this->_pdo, time(), 'export_site', 'Mise à jours des généralités', $this->_user);
					// header location inutile ici.
				}
			}
		}
		if( isset($get['page'])&&$get['page']==='fourchettes' ){
			$this->_title = 'Gestion des fourchettes';
			$this->_template =dirname(__FILE__).'/views/fourchettes.tpl';
			$this->_smarty->assign('fourchettesPrix',SiteExportFourchettePrix::loadAll($this->_pdo));
			$this->_smarty->assign('fourchettesSurface',SiteExportFourchetteTaille::loadAll($this->_pdo));
		}elseif( isset($get['page'])&&$get['page']==='delFp' ){
			$this->_title = 'Suppression d\'une fourchette de prix';
			$this->_template =dirname(__FILE__).'/views/delFourchette.tpl';
			$fp = SiteExportFourchettePrix::load($this->_pdo, $get['action']);
			$this->_smarty->assign('fo',$fp);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}elseif(isset($post['valid'])){
				Log::create($this->_pdo, time(), 'export_site', 'Suppression de la fourchette de prix : ( '.$fp->getTransactionType()->getName().' '.$fp->getMandateType()->getName().') '.$fp->getName(), $this->_user);
				$fp->delete();
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
					
			}
		}elseif( isset($get['page'])&&$get['page']==='delFt' ){
			$this->_title = 'Suppression d\'une fourchette de surface';
			$this->_template =dirname(__FILE__).'/views/delFourchette.tpl';
			$fp = SiteExportFourchetteTaille::load($this->_pdo, $get['action']);
			$this->_smarty->assign('fo',$fp);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}elseif(isset($post['valid'])){
				Log::create($this->_pdo, time(), 'export_site', 'Suppression de la fourchette de surface : ( '.$fp->getTransactionType()->getName().' '.$fp->getMandateType()->getName().') '.$fp->getName(), $this->_user);
				$fp->delete();
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));

			}
		}elseif( isset($get['page'])&&$get['page']==='updFp' ){
			$this->_title = 'Modification d\'une fourchette de prix';
			$this->_template =dirname(__FILE__).'/views/addFourchette.tpl';
            $this->_smarty->assign('add',false);
			$this->_smarty->assign('tt',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('tb',MandateType::loadAll($this->_pdo));

			// on load le fourchette
			$fo = SiteExportFourchettePrix::load($this->_pdo, $get['action']);
			$this->_smarty->assign('vtt',$fo->getTransactionType()->getId());
			$this->_smarty->assign('vtb',$fo->getMandateType()->getId() );
			$this->_smarty->assign('vname',$fo->getName());
			$this->_smarty->assign('vvalmin',$fo->getValMin());
			$this->_smarty->assign('vvalmax',$fo->getValMax());
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}
			if(isset($post['add'])){
				if(empty($error)){
					$fo->setTransactionType(TransactionType::load($this->_pdo, $post['tt']),false);
					$fo->setMandateType(MandateType::load($this->_pdo, $post['tb']),false);
					$fo->setName($post['name'],false);
					$fo->setValMin($post['valMin'],false);
					$fo->setValMax($post['valMax'],false);
					$fo->update();
					Log::create($this->_pdo, time(), 'export_site', 'Modification de la fourchette de prix : ( '.$fo->getTransactionType()->getName().' '.$fo->getMandateType()->getName().') '.$fo->getName(), $this->_user);
					header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
				}
			}
		}elseif( isset($get['page'])&&$get['page']==='updFt' ){
			$this->_title = 'Modification d\'une fourchette de surface';
			$this->_template =dirname(__FILE__).'/views/addFourchette.tpl';
            $this->_smarty->assign('add',false);
			$this->_smarty->assign('tt',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('tb',MandateType::loadAll($this->_pdo));
				
			// on load le fourchette
			$fo = SiteExportFourchetteTaille::load($this->_pdo, $get['action']);
			$this->_smarty->assign('vtt',$fo->getTransactionType()->getId());
			$this->_smarty->assign('vtb',$fo->getMandateType()->getId() );
			$this->_smarty->assign('vname',$fo->getName());
			$this->_smarty->assign('vvalmin',$fo->getValMin());
			$this->_smarty->assign('vvalmax',$fo->getValMax());
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}
			if(isset($post['add'])){
				if(empty($error)){
					$fo->setTransactionType(TransactionType::load($this->_pdo, $post['tt']),false);
					$fo->setMandateType(MandateType::load($this->_pdo, $post['tb']),false);
					$fo->setName($post['name'],false);
					$fo->setValMin($post['valMin'],false);
					$fo->setValMax($post['valMax'],false);
					$fo->update();
					Log::create($this->_pdo, time(), 'export_site', 'Modification de la fourchette de surface : ( '.$fo->getTransactionType()->getName().' '.$fo->getMandateType()->getName().') '.$fo->getName(), $this->_user);
					header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
				}
			}
		}elseif( isset($get['page'])&&$get['page']==='addFp' ){
			$this->_title = 'Ajout d\'une fourchette de prix';
			$this->_template =dirname(__FILE__).'/views/addFourchette.tpl';
			$this->_smarty->assign('tt',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('tb',MandateType::loadAll($this->_pdo));
			$this->_smarty->assign('add',true);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}
			if(isset($post['add'])){
				if(empty($error)){
					$fp = SiteExportFourchettePrix::create($this->_pdo, $post['name'], $post['valMin'], $post['valMax'], TransactionType::load($this->_pdo, $post['tt']), MandateType::load($this->_pdo, $post['tb']));
					Log::create($this->_pdo, time(), 'export_site', 'Ajout de la fourchette de prix : ( '.$fp->getTransactionType()->getName().' '.$fp->getMandateType()->getName().') '.$fp->getName(), $this->_user);
					header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
				}
			}
		}
		elseif( isset($get['page'])&&$get['page']==='addFt' ){
			$this->_title = 'Ajout d\'une fourchette de surface';
			$this->_template =dirname(__FILE__).'/views/addFourchette.tpl';
			$this->_smarty->assign('tt',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('tb',MandateType::loadAll($this->_pdo));
            $this->_smarty->assign('add',true);
            if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
			}
			if(isset($post['add'])){
				if(empty($error)){
					$fp = SiteExportFourchetteTaille::create($this->_pdo, $post['name'], $post['valMin'], $post['valMax'], TransactionType::load($this->_pdo, $post['tt']), MandateType::load($this->_pdo, $post['tb']));
					Log::create($this->_pdo, time(), 'export_site', 'Ajout de la fourchette de surface : ( '.$fp->getTransactionType()->getName().' '.$fp->getMandateType()->getName().') '.$fp->getName(), $this->_user);
					header('location:'.Tools::create_url($this->_user,'export_site','fourchettes'));
				}
			}
		}
		elseif( isset($get['page'])&&$get['page']==='cms'){
			$cms = Cms::load($this->_pdo, $get['action']);
			if($cms==null){
				$this->_title = 'La page que vous souhaitez modifier n\'existe pas';
				
			}else{
				$this->_title ="Page : ". $cms->getPublicName();
				$this->_template =dirname(__FILE__).'/views/cms.tpl';
				$this->_smarty->assign('cms',$cms);
				if(isset($post['send'])){
					// on sauve
					
					$cms->setPublicName($post['publicName'],false);
					$cms->setTitle($post['title'],false);
					$cms->setUrl($post['url'],false);
					$cms->setDescription($post['description'],false);
					$cms->setContent($post['content'],false);
					$cms->update();
					$error[]='Mise à jour effectuée le : '.date('d/m/Y à H:i:s');
					Log::create($this->_pdo, time(), 'export_site', 'Mise à jour de la page : '.$cms->getPrivateName(), $this->_user);
					
				}
			}
			// Bdd à creer.
// 			var_dump($get);
		}
		elseif( isset($get['page'])&&$get['page']==='messages'){
			$this->_title = 'Messages';
			$this->_template =dirname(__FILE__).'/views/messages.tpl';
				
			$variables = SiteExportVariable::loadAll($this->_pdo);
				
			$types = MandateType::loadAll($this->_pdo);
				
			$this->_smarty->assign('types',$types);
			$this->_smarty->assign('variables',$variables);
			if(isset($post['cancel'] )){
				header('location:'.Tools::create_url($this->_user,'export_site','messages'));
			}
			if(isset($post['send'] )){

				foreach($post as $key => $value){
					if(substr($key, 0,2) =='v_'){

						$elem = SiteExportVariable::load($this->_pdo,substr($key, 2) );
						if($elem)
						$elem->setValue($value);
					}elseif(substr($key,0,4) =='che_'){
						$arrayTypesExport = array();
						if($value){
								
							foreach($value as $e){
								if($e ==0 ){
									$arrayTypesExport[0] =ucfirst(strtolower(  Lang::TYPE_EXPORT_SITE_DEFAULT));
								}else{
									$arrayTypesExport[$e] = str_replace('&acirc;','â',ucfirst(strtolower( MandateType::load($this->_pdo, $e)->getName())));
								}
							}

						}
						$elem = SiteExportVariable::load($this->_pdo,substr($key, 4) );
						if($elem){
							$elem->setValue( serialize($arrayTypesExport) );
							Log::create($this->_pdo, time(), 'export_site', 'Mise à jour des messages', $this->_user);
						}
					}
						
				}

				header('location:'.Tools::create_url($this->_user,'export_site','messages'));
			}
				
		}

		elseif( isset($get['page'])&&$get['page']==='accueil' ){
			$this->_title = 'Gestion de la page d\'accueil';
			$this->_template =dirname(__FILE__).'/views/accueil.tpl';
				
			$se = SiteExport::load($this->_pdo,1);
			if($se === null){
				$se= SiteExport::create($this->_pdo, '', '', '', '', '', '', '', '','', SiteExportTheme::load($this->_pdo, 1));
			}

			$this->_smarty->assign('se',$se);
			if(isset($post['send'])){
				$se->setTitreAccueil($post['titreAccueil'],false);
				$se->setMetaDescriptionAccueil($post['metaDescriptionAccueil'],false);
				$se->setTxtIndex($post['txtAccueil'],false);
				if(empty($error)){

					$se->update();
					Log::create($this->_pdo, time(), 'export_site', 'Mise à jours de la page d\'accueil', $this->_user);
				}
			}
				
			// logs
		}elseif( isset($get['page'])&&$get['page']==='logs' ){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'export_site');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
		}elseif( isset($get['page'])&&$get['page']==='cptclients' ){
            $this->_title='Gestion des comptes clients';
            $this->_template =dirname(__FILE__).'/views/cptclients.tpl';
            // load infos dans la bdd.
            $se = SiteExport::load($this->_pdo,1);
            if($se === null){
                $se= SiteExport::create($this->_pdo, '', '', '', '', '', '', '', '','', SiteExportTheme::load($this->_pdo, 1),false,'','','','','','','','','','','','');
            }


            if(isset($_POST['send'])){

                $urlwebsite=$_POST['urlwebsite'];
                $emailwelcome=$_POST['emailwelcome'];
                $emailresetpassword=$_POST['emailresetpassword'];
                $subjectemailwelcome=$_POST['subjectemailwelcome'];
                $subjectemailresetpassword = $_POST['subjectemailresetpassword'];
                $subjectemailcontactcommercial = $_POST['subjectemailcontactcommercial'];

                $se->setExportWebsiteUrl($urlwebsite,false);
                $se->setEmailWelcomeClientAccount($emailwelcome,false);
                $se->setEmailResetPasswordClientAccount($emailresetpassword,false);
                $se->setSubjectEmailWelcomeClientAccount($subjectemailwelcome,false);
                $se->setSubjectEmailResetPasswordClientAccount($subjectemailresetpassword,false);
                $se->setSubjectEmailContactCommercial($subjectemailcontactcommercial,false);
                $se->update();


            }else{


                $urlwebsite=$se->getExportWebsiteUrl();
                $emailwelcome=$se->getEmailWelcomeClientAccount();
                $emailresetpassword=$se->getEmailResetPasswordClientAccount();
                $subjectemailwelcome=$se->getSubjectEmailWelcomeClientAccount();
                $subjectemailresetpassword = $se->getSubjectEmailResetPasswordClientAccount();
                $subjectemailcontactcommercial=$se->getSubjectEmailContactCommercial();
            }

            $this->_smarty->assign('subjectemailcontactcommercial',$subjectemailcontactcommercial);
            $this->_smarty->assign('subjectemailwelcome',$subjectemailwelcome);
            $this->_smarty->assign('subjectemailresetpassword',$subjectemailresetpassword);
            $this->_smarty->assign('urlwebsite',$urlwebsite);
            $this->_smarty->assign('emailwelcome',$emailwelcome);
            $this->_smarty->assign('emailresetpassword',$emailresetpassword);
        }

		$this->_smarty->assign('error',$error);
	}

	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
		}
		// inclusion des modules enfants
		$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
	}

	public function displayTpl( ){
		$this->_smarty->display('tpl_default/header.tpl');
		$this->_smarty->display( $this->_template );
		$this->_smarty->display('tpl_default/footer.tpl');
	}

	private function _addMainMenu(){
		//		var_dump($this->_user);
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}