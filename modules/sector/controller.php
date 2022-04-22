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
				Log::create($this->_pdo,time(),"sector",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('sector');
				$this->_title = 'Gestion des secteurs / villes';
			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='listv';
		$error = false;
		// page par defaut du module (laquelle ? Peut être un "mur" avec les sous menus.

		// secteurs
		if(isset($get['page'])&&$get['page']=='adds'){
			$this->_title = 'Ajouter un secteur';
			$this->_template = dirname(__FILE__).'/views/add_sector.tpl';
			if(isset($post['send_sector'])){
				if (empty($post['sector_name'])||trim($post['sector_name'])=='')
				$error = Lang::ERROR_EMPTY_SECTOR_NAME;
				if(!$error){
					$sector = Sector::create($this->_pdo,$post['sector_name'],0);
					Log::create($this->_pdo,time(),"sector",' Ajout du secteur : '.$sector->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'lists'));
				}
			}
		}
		if(isset($get['page'])&&$get['page']=='lists'){
			$this->_title = 'Liste des secteurs';
			$a = Sector::loadAll($this->_pdo);
			$list = array();
			foreach ($a as $item){
				$tmp['id']=$item->getIdSector();
				$tmp['name']=$item->getName();
				$tmp['urlUpdate'] = $this->create_url($this->_user,$get['module'],'updates',$item->getIdSector());
				$tmp['urlDelete'] = $this->create_url($this->_user,$get['module'],'deletes',$item->getIdSector());
				array_push($list,$tmp);
			}
			$this->_smarty->assign('list',$list);
			$this->_template = dirname(__FILE__).'/views/list_sector.tpl';
		}
		if(isset($get['page'])&&$get['page']=='updates'){
			$this->_title = 'Mise à jour du secteur';
			$sectorToBeUpdated  = Sector::load($this->_pdo,$get['action']);
			if($sectorToBeUpdated!=null){
				$this->_template = dirname(__FILE__).'/views/update_sector.tpl';
				if(empty($post)){
					$sector = Sector::load($this->_pdo,$get['action']);
					$this->_smarty->assign('oldSector',$sector->getName());
					$this->_smarty->assign('sector_name',$sector->getName());
					$this->_smarty->assign('id_sector',$sector->getIdSector());
				}else{
					$this->_smarty->assign('oldSector',$post['oldSector']);
					$this->_smarty->assign('sector_name',$post['sector_name']);
					$this->_smarty->assign('id_sector',$post['id_sector']);
				}
				if(isset($post['send_sector'])){
					if (empty($post['sector_name'])||trim($post['sector_name'])=='')
					$error = Lang::ERROR_EMPTY_SECTOR_NAME;
					if(!$error){
						$sector = Sector::load($this->_pdo,$post['id_sector']);
						// maj
						$sector->setName($post['sector_name'],true);
						Log::create($this->_pdo,time(),"sector",' modification du secteur : '.$sector->getName(),$this->_user);
						header('location:'.$this->create_url($this->_user,$get['module'],'lists'));
					}
				}
					
				if(isset($post['sector_cancel'])){		header('location:'.$this->create_url($this->_user,$get['module'],'lists'));}
			}else{
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"sector",' tentative de modification d\'un secteur ,\'éxistant pas ou plus.',$this->_user);
			}
		}
		if(isset($get['page'])&&$get['page']=='deletes'){
			$this->_title = 'Suppression du secteur';
			$this->_template = dirname(__FILE__).'/views/delete_sector.tpl';
			$sector = Sector::load($this->_pdo,$get['action']);
			$this->_smarty->assign('sector',$sector);
			if(isset($post['sector_cancel'])){		header('location:'.$this->create_url($this->_user,$get['module'],'lists'));}
			if(isset($post['send_sector'])){
				// Si pas utilisé

				if($sector->getNumberUsed() == 0){
					Log::create($this->_pdo,time(),'sector','Suppression du secteur : '.$sector->getName(),$this->_user);

					$sector->delete();
					header('location:'.$this->create_url($this->_user,$get['module'],'lists'));
				}else
				$error = Lang::ERROR_DELETE_SECTOR_BECAUSE_IS_USED;
			}

		}
		// villes
		if(isset($get['page'])&&$get['page']=='addv'){
			$this->_title = 'Ajouter une ville';
			// Concerne toute les actions de ville
			if(Sector::count($this->_pdo) ==0){
				$this->_template = dirname(__FILE__).'/views/add_sector_first.tpl';
				// Pas de secteur, on doit en sauver 1 avant
				// tpl erreur
			}else{
				$this->_template = dirname(__FILE__).'/views/add_city.tpl';
				$this->_smarty->assign('listOfSector',Sector::loadAll( $this->_pdo ) );
				if(isset($post['sector_add_city_cancel'])){
					header('location:'.$this->create_url($this->_user,$get['module']));
				}
				if(isset($post['sector_add_city_send'])){
					// verif
					$error = array();
					// 	Ville et cp non vide
					if(empty($post['zipCode'])||$post['zipCode']=='')
					array_push($error,Lang::ERROR_CITY_ADD_EMPTY_ZIPCODE);
					if(empty($post['city_add_name'])||$post['city_add_name']=='')
					array_push($error,Lang::ERROR_CITY_ADD_EMPTY_CITY);
					elseif(City::count($this->_pdo,' name = '."'".htmlspecialchars(addslashes(strtoupper($post['city_add_name'])))."'" )!=0){
						array_push($error,Lang::ERROR_CITY_ADD_CITY_IS_IN_DB);
					}
					if(empty($error)){
						$sector = Sector::load($this->_pdo,$post['idSector']);
						$city = City::create($this->_pdo,$post['city_add_name'],$post['zipCode'],0,$sector);
						$sector->setNumberUsed( $sector->getNumberUsed()+1 );
						Log::create($this->_pdo,time(),'sector','Ajout de la ville : '.$city->getName(),$this->_user);
						header('location:'.$this->create_url($this->_user,$get['module']));
					}
				}
			}
		}
		if(isset($get['page'])&&$get['page']=='listv'){
			$this->_title = 'Liste des villes';
			$this->_template =  dirname(__FILE__).'/views/list_city.tpl';
			$tmp = City::loadAll($this->_pdo);
			$listCity = array();
			foreach($tmp as $item){
				$t['id'] = $item->getIdCity();
				$t['name'] = $item->getName();
				$t['zipCode'] = $item->getZipCode();
				$t['sector'] = $item->getSector()->getName();
				$t['urlUpdate'] = $this->create_url($this->_user,$get['module'],'updatev',$item->getIdCity());
				$t['urlDelete'] = $this->create_url($this->_user,$get['module'],'deletev',$item->getIdCity());
				array_push($listCity,$t);
			}
			$this->_smarty->assign('listCity',$listCity);
		}
		if(isset($get['page'])&&$get['page']=='updatev'){
			$this->_title = 'Mise à jour de la ville';

			//			$cityToBeUpdated = City::load($this->_pdo,$get['action']);
			$this->_smarty->assign('listOfSector', Sector::loadAll($this->_pdo));
			//			$this->_smarty->assign('city',$cityToBeUpdated);
			$city = City::load($this->_pdo,$get['action']);
			if($city!=null){
				$this->_template =  dirname(__FILE__).'/views/update_city.tpl';
				if(empty($post)){
					$this->_smarty->assign('oldCity',$city->getName());
					$this->_smarty->assign('city_name',$city->getName());
					$this->_smarty->assign('id_city',$city->getIdCity());
					$this->_smarty->assign('zipCode',$city->getZipCode());
					$this->_smarty->assign('idSector',$city->getSector()->getIdSector());
				}else{
					$this->_smarty->assign('oldCity',$post['oldCity']);
					$this->_smarty->assign('city_name',$post['city_name']);
					$this->_smarty->assign('id_city',$post['id_city']);
					$this->_smarty->assign('zipCode',$post['zipCode']);
					$this->_smarty->assign('idSector',$post['idSector']);
				}

				if(isset($post['send_city'])){
					$error = array();
					if(empty($post['zipCode'])||$post['zipCode']=='')
					array_push($error,Lang::ERROR_CITY_ADD_EMPTY_ZIPCODE);
					if(empty($post['city_name'])||$post['city_name']=='')
					array_push($error,Lang::ERROR_CITY_ADD_EMPTY_CITY);
					elseif($post['oldCity']!=$post['city_name']){
							
						if(City::count($this->_pdo,' name = '."'".htmlspecialchars(addslashes(strtoupper($post['city_name'])))."'" )!=0&&strtoupper($post['oldCity'])!=strtoupper($post['city_name'])){
							array_push($error,Lang::ERROR_CITY_ADD_CITY_IS_IN_DB);
						}
					}
					if(!$error){
						//						var_dump($city);
						$oldSector = $city->getSector();
						// UPD + SORTIR UNE UTIISATION DE SECTEUR, ET AJOUTER LA NOUVELLE !
						$newSector = Sector::load($this->_pdo,$post['idSector']);
							
						$city->setName($post['city_name'],false);
						$city->setZipCode($post['zipCode'],false);
						$city->setSector($newSector,false);
						$city->update();

						$oldSector->setNumberUsed( $oldSector->getNumberUsed()-1,true );
						$newSector->setNumberUsed($newSector->getNumberUsed()+1,true);

						Log::create($this->_pdo,time(),"sector",' modification de la ville : '.$city->getName(),$this->_user);
						header('location:'.$this->create_url($this->_user,$get['module'],'listv'));
					}
				}

				if(isset($post['city_cancel'])){		header('location:'.$this->create_url($this->_user,$get['module'],'listv'));}
			}else{
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"sector",' tentative de modification d\'un secteur ,\'éxistant pas ou plus.',$this->_user);
			}


		}
		if(isset($get['page'])&&$get['page']=='deletev'){
			$this->_title = 'Suppression de la ville';
			$this->_template =  dirname(__FILE__).'/views/delete_city.tpl';
			$city = City::load($this->_pdo,$get['action']);
			$this->_smarty->assign('city',$city);
			if(isset($post['city_cancel'])){		header('location:'.$this->create_url($this->_user,$get['module'],'listv'));}
			if(isset($post['send_city'])){
				// Si pas utilisé

				if($city->getNumberUsed() == 0){

					// Suppression de l'user
					//					$city->getUser()->setNumberUsed( $city->getUser()->getNumberUsed( ) -1);
					// -1 au secteur
					$city->getSector()->setNumberUsed($city->getSector()->getNumberUsed()-1);
					$city->delete();
					Log::create($this->_pdo,time(),'sector','Suppression de la ville : '.$city->getName(),$this->_user);
					header('location:'.$this->create_url($this->_user,$get['module'],'listv'));
				}else
				$error = Lang::ERROR_DELETE_CITY_BECAUSE_IS_USED;
			}
		}
		// log du module
		if(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'logs du module secteur / ville';
			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$a = Log::selectByModule($this->_pdo,'sector');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );}
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
		//		var_dump($this->_user);
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}