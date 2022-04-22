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
				Log::create($this->_pdo,time(),"action",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('rechercheMulti');
				$this->_title = 'Recherches multicritères';
			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );

	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		//if(empty($get['page']))$get['page']='list';
		$error = array();
		if(isset($get['page'])&&$get['page']=='searchAcq'){
			$resultatsRecherche=null;
			$this->_title = 'Recherche d\'acquereurs';
			$this->_template =dirname(__FILE__).'/views/searchAcq.tpl';
			// load des critères

			$listCritere = Critere_acquereur::loadAll($this->_pdo);

			$this->_smarty->assign('listCritere',$listCritere);

			if(!empty($post['rechercher'])){
				//var_dump($post);
				$listElement =array();
				
				if($post['table']){
					foreach($post['table'] as $item){
						switch ($item){
							case 'User':
								$liste= User::loadAll($this->_pdo);
								break;
									
							case 'MandateType':
								$liste= MandateType::loadAll($this->_pdo);
								break;
							case 'TransactionType':
								$liste= TransactionType::loadAll($this->_pdo);
								break;
							case 'Sector':
								$liste= Sector::loadAll($this->_pdo);
								break;
							case 'City':
								$liste= City::loadAll($this->_pdo);
								break;
							case 'MandateNature':
								$liste= MandateNature::loadAll($this->_pdo);
								break;
							case 'MandateEtap':
								$liste= MandateEtap::loadAll($this->_pdo);
								break;
						}
						//echo $item;
						$listElement[$item]= $liste;
							
							
					}

					$this->_smarty->assign('listElement',$listElement);
				}
					
				// construction de la requête et passage des resultats.
				$resultatsRecherche =  RechercheAcquereur::loadByMultiCritere($this->_pdo, $post) ;
				//var_dump($resultatsRecherche);
			}
            //openmailListEmails
            if(isset($_POST['searchAcqSendEmail'])){
                $id_acqs =$_POST['idAcq'];
                $emails = '';
                if($id_acqs){
                    foreach($id_acqs as $idacq){
                        $tmpAcq = Acquereur::load($this->_pdo,$idacq);
                        if($tmpAcq->getEmail()){
                            $emails.=   $tmpAcq->getEmail().';';
                        }
                    }
                    $emails =  substr($emails,0,-1);
                }
                $_SESSION['openmailListEmails']=$emails;
                header('location:'.Tools::create_url($this->_user,'openmail','sendEmail'));
            }
            if(isset($_POST['searchAcqSendSms'])){
                $id_acqs =$_POST['idAcq'];
                $phones = '';
                if($id_acqs){
                    foreach($id_acqs as $idacq){
                        $tmpAcq = Acquereur::load($this->_pdo,$idacq);
                        if($tmpAcq->getMobilPhone()){
                            $phones.=   $tmpAcq->getMobilPhone().';';
                        }
                    }
                    $phones =  substr($phones,0,-1);
                }
                $_SESSION['openmailListPhones']=$phones;
                header('location:'.Tools::create_url($this->_user,'openmail','sendSms'));
            }
			// load de tous les critères
			$this->_smarty->assign( 'resultatsRecherche' , $resultatsRecherche );
			
		}if(isset($get['page'])&&$get['page']=='searchMandate'){
			$resultatsRecherche=null;
			$this->_title = 'Recherche de biens';
			$this->_template =dirname(__FILE__).'/views/searchMandate.tpl';

			// load des critères

			$listCritere = Critere_mandate::loadAll($this->_pdo);

			$this->_smarty->assign('listCritere',$listCritere);

			if(!empty($post['rechercher'])){
				//var_dump($post);
				$listElement =array();
				if($post['table']){
					foreach($post['table'] as $item){
						switch ($item){
							case 'User':
								$liste= User::loadAll($this->_pdo);
								break;
									
							case 'MandateType':
								$liste= MandateType::loadAll($this->_pdo);
								break;
							case 'TransactionType':
								$liste= TransactionType::loadAll($this->_pdo);
								break;
							case 'Sector':
								$liste= Sector::loadAll($this->_pdo);
								break;
							case 'City':
								$liste= City::loadAll($this->_pdo);
								break;
							case 'MandateNature':
								$liste= MandateNature::loadAll($this->_pdo);
								break;
							case 'MandateEtap':
								$liste= MandateEtap::loadAll($this->_pdo);
								break;
						}
						//echo $item;
						$listElement[$item]= $liste;
							
							
					}

					$this->_smarty->assign('listElement',$listElement);
				}
					
				// construction de la requête et passage des resultats.
				$resultatsRecherche =  RechercheMandate::loadByMultiCritere($this->_pdo, $post) ;
			}
            //searchMandateSendSms

            if(isset($_POST['searchMandateSendEmail'])){
                $id_sellers =array_unique($_POST['idSellers']);
                $emails = '';
                if($id_sellers){
                    foreach($id_sellers as $id){
                        $tmpSeller = Seller::load($this->_pdo,$id);
                        if($tmpSeller->getEmail()){
                            $emails.=   $tmpSeller->getEmail().';';
                        }
                    }
                    $emails =  substr($emails,0,-1);
                }
                $_SESSION['openmailListEmails']=$emails;
                header('location:'.Tools::create_url($this->_user,'openmail','sendEmail'));
            }

            if(isset($_POST['searchMandateSendSms'])){
                $id_sellers =array_unique($_POST['idSellers']);
                $phones = '';
                if($id_sellers){
                    foreach($id_sellers as $id){
                        $tmpSeller = Seller::load($this->_pdo,$id);
                        if($tmpSeller->getMobilPhone()){
                            $phones.=   $tmpSeller->getMobilPhone().';';
                        }
                    }
                    $phones =  substr($phones,0,-1);
                }
                $_SESSION['openmailListPhones']=$phones;
                header('location:'.Tools::create_url($this->_user,'openmail','sendSms'));
            }

			// load de tous les critères
			$this->_smarty->assign( 'resultatsRecherche' , $resultatsRecherche );

		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'logs du module recherche multicritere';
			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$a = Log::selectByModule($this->_pdo,'rechercheMulti');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );}

		}
		$this->_smarty->assign('error',$error);
	}
	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			// inclusion des modules enfants
			$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
			$this->_treatment( $post,$get);

		}
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