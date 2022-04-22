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
				Log::create($this->_pdo,time(),"export",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('export');
				$this->_title = 'Gestion des exports';
			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		if(empty($get['page']))$get['page']='preList';
		if(isset($get['page'])&&$get['page']=="listPasserelle"){
			$this->_title = "Liste des passerelles";
			$this->_template = dirname(__FILE__).'/views/listPasserelle.tpl';
			$this->_smarty->assign('listPasserelle',Passerelle::loadAll($this->_pdo));
		}elseif(isset($get['page'])&&$get['page']=="deletePasserelle"){

			$this->_title = "Suppression de la passerelle";
			$this->_template = dirname(__FILE__).'/views/delPasserelle.tpl';
			$p = Passerelle::load($this->_pdo,$get['action']);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'listPasserelle'));
			}elseif(isset($post['sent'])){
				$name = $p->getName();
				// suppression des lignes de liaisos et logs
				$l = $p->selectLiasonPasserelleMandats();
				while($ll = LiasonPasserelleMandat::fetch($this->_pdo,$l)){
					$ll->delete();
				}
				$l = $p->selectLogTransferts();
				while($ll = LogTransfert::fetch($this->_pdo,$l)){
					$ll->delete();
				}
				$p->delete();
				Log::create($this->_pdo,time(),$get['module'],'Suppression de la passerelle '.$name,$this->_user);
				header('location:'.Tools::create_url($this->_user,$get['module'],'listPasserelle'));
			}
		}elseif(isset($get['page'])&&$get['page']=="updatePasserelle"){
			$this->_title = "Mise à jour de la passerelle";
			$this->_template = dirname(__FILE__).'/views/updatePasserelle.tpl';
			$p = Passerelle::load($this->_pdo,$get['action']);
			$error = array();
			if(empty($post)){
				$name =$p->getName();

				$type=$p->getTypeExport();
				$param = $p->getParam();
				$asset = $p->getAsset();

			}else{
				$name = $post['name'];
				$type = $post['type'];
				$param = $post['param'];
				$asset = $post['asset'];
			}

			$p = Passerelle::load($this->_pdo,$get['action']);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'listPasserelle'));
			}elseif(isset($post['send'])){
				if(empty($error)){
					$p->setName($name,false);
					$p->setTypeExport($type,false);
					$p->setParam($param,false);

					$p->setAsset($asset==1?1:0,false);
					$p->update();
					Log::create($this->_pdo,time(),$get['module'],'Mise à jour du plugin : '.$p->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'listPasserelle'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('type',$type);
			$this->_smarty->assign('param',$param);
			$this->_smarty->assign('asset',$asset);
			}elseif(isset($get['page'])&&$get['page']=="preList"){
				// sélectionne la bonne passerelle ( qui est passé en parametre de page)
				// Choix de la passerelle 
				$this->_title = 'Choix de la passerelle';
				$this->_template = dirname(__FILE__).'/views/preList.tpl';
				$this->_smarty->assign('listPasserelle', Passerelle::loadAll($this->_pdo));
				// On liste toute les passerelles
				
				
		}elseif(isset($get['page'])&&$get['page']=="list"){
			// prelist
			$this->_title = "Mandats et exports";
			$this->_template = dirname(__FILE__).'/views/list.tpl';
			// il me faut ; la liste des passerelles 
			//$this->_smarty->assign('listPasserelle', Passerelle::loadAllAsset($this->_pdo));
			// utilisation de la passerelle choisie 
			$this->_smarty->assign('listPasserelle', array(Passerelle::load($this->_pdo,$get['action'])));
			// liste de tous les mandats, (à vendre)
			$agency = empty($post['agency'])?$this->_user->getAgency()->getIdAgency():$post['agency'];
			$this->_smarty->assign('agency',$agency);
			$this->_smarty->assign('listAgency',Agency::loadAll($this->_pdo));
				
			// Par l'agence de l'operateur connecté.
			$listExports = array();
			foreach( Mandate::loadByEtap($this->_pdo,MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL )) as $item){
				if($agency=='ALL' || $item->getUser()->getAgency()->getIdAgency()==$agency){
					$listExports[] = $item;
				}
			}
			$this->_smarty->assign('listMandate',$listExports);

			if(isset($post['send'])){

				foreach($post as $key => $item){
						
					$hidden = explode('hidden_', $key);
					if( $hidden[1]){
						$ee = explode('_',$hidden[1]);

						// si $e[1] existe; alors il faut creer la liaison // on cherche à afficher la valeur de export_



						//						$ee[0] = Id passerelle
						//						$ee[1] = Id Mandat
						// $item contient si la relation existe ou pas.
						// si coché, on le sauve s'il n'est pas linké
						$m = Mandate::load($this->_pdo,$ee[1]);
						$p = Passerelle::load($this->_pdo,$ee[0]);
							
						if($post['export_'.$ee[0].'_'.$ee[1]]==1){
							if(!$p->isLinked($m)){
								LiasonPasserelleMandat::create($this->_pdo,$p,$m);
								Log::create($this->_pdo,time(),'export','Ajout de l\'export entre le mandat : '.$m->getNumberMandate().' et la passerelle : '.$p->getName(),$this->_user);
							}
						}else{
							if($p->isLinked($m)){
								$lia = LiasonPasserelleMandat::loadByPasserelleAndMandate($this->_pdo,$p,$m);
								$lia->delete();
								Log::create($this->_pdo,time(),'export','Suppression de l\'export entre le mandat : '.$m->getNumberMandate().' et la passerelle : '.$p->getName(),$this->_user);
							}
						}

					}
				}
				// Au pire en cas re fraffraissiement, refait un appel à la bdd
				//		header('location:'.Tools::create_url($this->_user,$get['module'],$get['page']));
			}

		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'logs du module action';
			$this->_template = Constant::DEFAULT_MODULE_DIRECTORY.'/tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'export');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );}

		}elseif(isset($get['page'])&&$get['page']=='gest_fb'){
        $this->_title = 'Export facebook';
        $this->_template =dirname(__FILE__).'/views/export_fb.tpl';
        }
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