<?php
class Controller extends CoreController {
	private $_smarty;
	private $_template;
	private $_error_dependance;
	private $_user;
	private $_title;
	private $_error;

	public function __construct($smarty) {

		$this -> _smarty = $smarty;
		$this -> _error_dependance = false;
		$this->defaultAction = 'list';
		parent::__construct($smarty);
		// membre connecté
		if(!$this -> include_model_required((String)dirname(__FILE__))) {
			$this -> _error_dependance = true;
			$this -> _template = $this -> getTplErrorLoadModule();
		} else {

			$this -> _user = User::unserialize($this -> _pdo, $_SESSION['user']);
			// autorisation necessaire pour cette action ? // reste le cas de la modification de sa propre fiche ...
			if($this -> getLevelRequired($_GET['module'], $_GET['page'], $_GET['action']) < $this -> _user -> getLevelMember() -> getIdLevelMember()) {
				$this -> _error_dependance = true;
				$this -> _template = $this -> getTplErrorViolationAccess();
				Log::create($this -> _pdo, time(), "sector", 'accès non autorisé', $this -> _user);
			} else {
				$this -> _template = dirname(__FILE__) . '/views/default.tpl';
				$this -> _addMainMenu();
				$this -> _addMenu('contacts');
				$this -> _title = 'Gestion des contacts';
			}
		}
	}

	public function addMeta() {
		$this -> _smarty -> assign('title', $this -> _title);
	}

	private function _treatment($post, $get) {
		// par defaut list
		if(empty($get['page']))$get['page']='list';
		// 		$this->useNewControllerController($get);

		// ajouter type de contact
		switch($get['page']){
			// Type de contacts
			case 'addTC':
				$this->_addTC($post,$get);
				break;
			case 'listTC':
				$this->_listTC($post,$get);
				break;
			case 'updPosTC':
				$this->_updPosTC($get);
				break;
			case 'delTC':
				$this->_delTC($get,$post);
				break;
			case 'updTC':
				$this->_updTC($get,$post);
				break;
				// Contact
			case 'add':
				$this->_addContact($get,$post);
				break;
			case 'upd':
				$this->_updateContact($get,$post);
				break;
			case 'list':
				$this->_listContact($get,$post);
				break;
			case 'see':
				$this->_seeContact($get,$post);
				break;
			case 'del':
				$this->_delContact($get,$post);
				break;
				// logs
			case 'log':
				$this->_seeLog();
				break;
			case 'addC':
				$this->addC($get,$post);
				break;
			case 'listC':
				$this->listC($get,$post);
				break;
			case 'updC':
				$this->updC($get,$post);
				break;
			case 'delC':
				$this->delC($get,$post);
				break;
		}
	}

	public function treatment($post, $get) {
		$this->_error = array();
		$this -> _smarty -> assign('user', $this -> _user);
		if(!$this -> _error_dependance) {
			// inclusion des modules enfants
			$this -> include_modules_Children((String)dirname(__FILE__), $this -> _smarty);
			$this -> _treatment($post, $get);
			$this->_smarty->assign('error',$this->_error);

		}
	}

	public function displayTpl() {
		$this->_smarty->display('tpl_default/header.tpl');
		$this->_smarty->display( $this->_template );
		$this->_smarty->display('tpl_default/footer.tpl');
	}

	private function _addMainMenu() {
		//		var_dump($this->_user);
		$this -> _smarty -> assign('mainMenu', $this -> getMainMenu($this -> _user));
	}

	private function _addMenu($module) {
		$this -> _smarty -> assign('menu', $this -> getMenu($this -> _user, $module));
	}

	/*
	 Traitement
	*/
	/**
	 *
	 * Enter description here ...
	 * @param array $post
	 * @param array $get
	 * @return void
	 */
	private function _addTC($post,$get){
		$this->_title='Ajouter un type de champs de contact';
		$this -> _template = dirname(__FILE__) . '/views/addTc.tpl';
		$this->_smarty->assign('labelBtn','Ajouter');
		if(isset($post['cancelAddTc'])){
			header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
		}
		if(isset($post['submitAddTc'])){
			$this->_traitmentTC($post, $get);
		}
	}
	private function _traitmentTC($post,$get){
		// On vérifie que le champs est renseigné
		if(empty($post['typeContact']))$this->_error[]='Le champs doit être renseigné.';
		if(empty($this->_error)){
			$libel = htmlspecialchars($post['typeContact']);
			$tmp = TypeChampsContact::getMaxPosition($this->_pdo);
			$position = $tmp==null?0:$tmp;
			// save + redirection
			$item = TypeChampsContact::create($this->_pdo, $libel, 0, $position+1);
			Log::create($this->_pdo, time(), 'contacts', 'Ajout du type de contact : '.$item->getLibel(), $this->_user);
			header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
		}
	}

	private function _listTC($post,$get){
		$this->_title='Liste des types de champs de contacts';
		$this -> _template = dirname(__FILE__) . '/views/listTc.tpl';

		// liste des type
		$this->_smarty->assign('listTypeChampsContact',TypeChampsContact::loadAll($this->_pdo));
	}
	private function _updPosTC($get){
		$idToUpdate = $get['action'];
		$sens = $get['action2'];
		if($sens=="up"){
			$typeContactToUpdate = TypeChampsContact::load($this->_pdo, $idToUpdate);
			$other = TypeChampsContact::loadByPosition($this->_pdo, $typeContactToUpdate->getPosition() -1 );
			$typeContactToUpdate->setPosition( $typeContactToUpdate->getPosition() -1 );
			$other->setPosition( $other->getPosition() +1 );
		}elseif($sens=="down"){
			$typeContactToUpdate = TypeChampsContact::load($this->_pdo, $idToUpdate);
			$other = TypeChampsContact::loadByPosition($this->_pdo, $typeContactToUpdate->getPosition() +1 );
			$typeContactToUpdate->setPosition( $typeContactToUpdate->getPosition() +1 );
			$other->setPosition( $other->getPosition() -1 );
		}
		header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
	}
	private function _delTC($get,$post){
		// load du truc à flinguer.
		$typeContactToDel = TypeChampsContact::load($this->_pdo, $get['action']);
		$this->_title = 'Suppression du type de champs de contact : '.$typeContactToDel->getLibel();
		$this -> _template = dirname(__FILE__) . '/views/delTc.tpl';

		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
		}
		if(isset($post['delTc'])){
			$this->_execDelTC($typeContactToDel);
		}
	}
	private function _execDelTC(TypeChampsContact $typeChampsContact){
		$posit = $typeChampsContact->getPosition();
		$name = $typeChampsContact->getLibel();
		$typeChampsContact->delete();
		// maj des autres positions
		if($typeChampsContact->getNumberUsed()==0){
			foreach(TypeChampsContact::loadSupPosition($this->_pdo, $posit) as $item){
				$item->setPosition($item->getPosition()-1 );
			}
			Log::create($this->_pdo, time(), 'contacts', 'Suppression du type de contact : '.$name, $this->_user);
		}

		header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
	}
	private function _updTC($get,$post){
		$tcToUpd = TypeChampsContact::load($this->_pdo, $get['action']);
		$this->_title='Modifier le champs : '.$tcToUpd->getLibel();
		$this -> _template = dirname(__FILE__) . '/views/addTc.tpl';
		$this->_smarty->assign('labelBtn','Modifier');
		$typeContact = $tcToUpd->getLibel();
		if(isset($post['cancelAddTc'])){
			header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
		}
		if(isset($post['submitAddTc'])){
			$typeContact = $post['typeContact'];
			$this->_execUpdTC($post, $tcToUpd);
		}
		$this->_smarty->assign('typeContact',$typeContact);
	}
	private function _execUpdTC($post,TypeChampsContact $tcToUpd){
		if(empty($post['typeContact']))$this->_error[]='Le champs doit être renseigné.';
		if(empty($this->_error)){
			$libel = htmlspecialchars($post['typeContact']);
			$tcToUpd->setLibel($libel);
			Log::create($this->_pdo, time(), 'contacts', 'Modification du type de contact :'.$tcToUpd->getLibel(), $this->_user);
			header('location:'.Tools::create_url($this->_user,'contacts','listTC'));
		}
	}

	/**
	 *
	 * Contact
	 */

	private function _addContact($get,$post){
		$this->_title = 'Ajout d\'un contact';
		$this -> _template = dirname(__FILE__) . '/views/addContact.tpl';
		$listUser=null;
		if($this->_user->getLevelMember()<3){
			$listUser = User::loadAll($this->_pdo);
		}
		$this->_smarty->assign('listUser',$listUser);
		$userSelected=$post['userSelected']==null?$this->_user->getIdUser():$post['userSelected'];
		$this->_smarty->assign('userSelected',$userSelected);

		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'contacts','list'));
		}
		if(isset($post['add'])){
			//header('location:'.Tools::create_url($this->_user,'contacts','list'));
			$this->_execAddContact($get,$post);
		}
	}


	private function _execAddContact($get,$post ){
		$userSelected=$post['userSelected']==null?$this->_user->getIdUser():$post['userSelected'];
		if(empty($post['name']))$this->_error[]='Le champs nom doit être renseigné.';
		if(empty($this->_error)){
			// on sauve le contact
			$contact = Contact::create($this->_pdo,	 time(), User::load($this->_pdo,$userSelected));
			// On sauve le nom du contact
			$tc = TypeChampsContact::load($this->_pdo, 1);
			$tc->setNumberUsed( $tc->getNumberUsed()+1   );
			ChampsContact::create($this->_pdo, 'Nom', htmlspecialchars($post['name']), 1, $tc,$contact,true);
			// save + redirection
			Log::create($this->_pdo, time(), 'contacts', 'Ajout du contact : '.htmlspecialchars($post['name']), $this->_user);
			// redirection sur update afin de renseigner les autres champs
			header('location:'.Tools::create_url($this->_user,'contacts','upd',$contact->getIdContact()));
		}
	}

	private function _updateContact($get,$post){
		$contact = Contact::load($this->_pdo, $get['action']);
		$this -> _template = dirname(__FILE__) . '/views/updContact.tpl';
		$this->_title = 'Mise à jour du contact';
		$listChampsContacts = ChampsContact::selectByContact($this->_pdo, $contact);
		$this->_smarty->assign('listTC',TypeChampsContact::loadAll($this->_pdo));
		$arrayCc = array();

		// Liste des catégories DEJA associées au contact
		$categoriesForContact = array();
		$ObjcategoryContact = CategoryContact::fetchAll($this->_pdo, $contact->selectCategoryContacts());
		foreach($ObjcategoryContact as $cat1){
			$categoriesForContact[]=$cat1->getIdCategoryContact();
		}
		// On passe la liste des catégories
		$listCategories = CategoryContact::loadAll($this->_pdo);


		while($cc = ChampsContact::fetch($this->_pdo, $listChampsContacts) ){
			$arrayCC[ $cc->getTypeChampsContact()->getIdTypeChampsContact() ][]= $cc;
		}
		$this->_smarty->assign('listCC',$arrayCC);
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'contacts','see',$get['action']));
		}
		if(isset($post['validAndQuit'])||isset($post['valid'])){
			//	var_dump($post);
			$i=0;
			foreach($post['pos'] as $item){
				// update ou creation (ajout de l'id)
				if($post['id'][$i]){
					// upd
					$tmpcc = ChampsContact::load($this->_pdo, $post['id'][$i]);
					$tmpcc->setPosition($post['pos'][$i],false);
					$tmpcc->setLibel($post['libel'][$i],false);
					$tmpcc->setVal($post['val'][$i],false);
					$tmpcc->update();
				}else{
					// create
					// si au moins un des champs n'est pas vide
					if(!empty($post['pos'][$i])||$post['libel'][$i]||$post['val'][$i]){
						$tmpcc = ChampsContact::create($this->_pdo, $post['libel'][$i], $post['val'][$i], $post['pos'][$i], TypeChampsContact::load($this->_pdo,$post['type'][$i]),Contact::load($this->_pdo, $get['action']));
						$tmptc = $tmpcc->getTypeChampsContact();
						$tmptc->setNumberUsed($tmptc->getNumberUsed() +1 );
					}
				}
				$i++;


			}
			// Catégories associées
			// On supprime les relations et on en crait de nouvelles
			if(!empty($categoriesForContact)){
				foreach ($categoriesForContact as $item){
					$contact->delCategoryContact(CategoryContact::load($this->_pdo, $item));
				}
			}
			if(!empty($post['cat'])){
				// On ajoute les nouvelles :
				foreach($post['cat'] as $item){
					$contact->addCategoryContact(CategoryContact::load($this->_pdo, (Int)$item));
				}
			}


			// del
			if($post['del']){
				foreach($post['del'] as $item){
					$tmpcc = ChampsContact::load($this->_pdo, $item);
					$this->_delChampsContact($tmpcc);

				}
			}
			if(isset($post['validAndQuit'])){
				header('location:'.Tools::create_url($this->_user,'contacts','see',$get['action']));
			}
			if(isset($post['valid'])){
				header('location:'.Tools::create_url($this->_user,'contacts','upd',$get['action']));
			}
		}
		$this->_smarty->assign('categoriesForContact',$categoriesForContact);
		// 		var_dump($listCategories);
		$this->_smarty->assign('listCategories',$listCategories);
	}

	private function _delChampsContact(ChampsContact $item){



		$tmptc = $item->getTypeChampsContact();
		$tmptc->setNumberUsed($tmptc->getNumberUsed() -1 );
		return $item->delete();
	}
	private function _listContact($get,$post){

		$this->_title= 'Liste des contacts';
		$this -> _template = dirname(__FILE__) . '/views/listContact.tpl';
		$listContact = Contact::loadAll($this->_pdo);
		$array=array();

		foreach($listContact as $c){
			$tmp['obj'] = $c;
			$tmp['name'] = ChampsContact::loadByContactAndIndestructible($this->_pdo,$c)->getVal();
			$array[]=$tmp;
		}
		$this->_smarty->assign('listContact',$array);
	}

	private function _seeContact($get,$post){
		$contact = Contact::load($this->_pdo, $get['action']);
		$this -> _template = dirname(__FILE__) . '/views/seeContact.tpl';
		$this->_title = 'détail du contact';
		$listChampsContacts = ChampsContact::selectByContact($this->_pdo, $contact);

		$this->_smarty->assign('listTC',TypeChampsContact::loadAll($this->_pdo));
		$categories = CategoryContact::fetchAll($this->_pdo, $contact->selectCategoryContacts());
		$this->_smarty->assign('categories', $categories   );
		$arrayCc = array();
		while($cc = ChampsContact::fetch($this->_pdo, $listChampsContacts) ){
			$arrayCC[ $cc->getTypeChampsContact()->getIdTypeChampsContact() ][]= $cc;
		}
		$this->_smarty->assign('listCC',$arrayCC);

	}
	private function _delContact($get,$post){
		$this->_title='Suppression du contact';
		$this -> _template = dirname(__FILE__) . '/views/delContact.tpl';
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'contacts','see',$get['action']));
		}
		if(isset($post['del'])){
			// on loade le contact
			$c = Contact::load($this->_pdo, $get['action']);
			// suppression des champs
			$pdoStatement = ChampsContact::selectByContact($this->_pdo, $c);
			$name=null;
			while($res = ChampsContact::fetch($this->_pdo, $pdoStatement)){
				if($res->getIndestructible()==1)
				$name=$res->getVal();
				$this->_delChampsContact($res);
			}
			// on flingue le contact
			$c->delete();
			// on logue
			Log::create($this->_pdo, time(), 'contacts', 'Suppression du contact : '.$name, $this->_user);
			// on redirige
			header('location:'.Tools::create_url($this->_user,'contacts','list'));
		}
	}
	private function _seeLog(){
		$this->_title = 'Logs du module';
		$this->_template =dirname(__FILE__).'/views/log.tpl';
		$a = Log::selectByModule($this->_pdo,'contacts');
		while($logs = Log::fetch($this->_pdo,$a)){
			$arrayLog[] = $logs;
			$this->_smarty->assign('arrayLog', $arrayLog );
		}
	}

	protected function addC($get,$post){
		$this->_title = 'Ajouter une catégorie';
		$this->_template =dirname(__FILE__).'/views/addC.tpl';
		$name='';
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'contacts','listC'));
		}
		if(isset($post['go'])){
			$name=$post['name'];
			if(empty($name))$this->_error[]='Le champs doit être renseigné.';
			elseif(CategoryContact::nameExist( $this->_pdo,$name ))$this->_error[]='Cette catégorie existe déjà.';
			if(empty($this->_error)){
				CategoryContact::create($this->_pdo, $name);
				header('location:'.Tools::create_url($this->_user,'contacts','listC'));
			}
		}
		$this->_smarty->assign('name', $name );
	}
	protected function listC($get,$post){
		$this->_title = 'Liste des catégories';
		$this->_template =dirname(__FILE__).'/views/listC.tpl';
		$this->_smarty->assign('lc', CategoryContact::loadAll($this->_pdo));
	}
	protected function updC($get,$post){
		$c = CategoryContact::load($this->_pdo, $get['action']);
		if($c){
			$this->_title = 'Modifier la catégorie '.$c->getName();
			$this->_template =dirname(__FILE__).'/views/addC.tpl';
			$name= $c->getName();
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'contacts','listC'));
			}
			if(isset($post['go'])){
				$name=$post['name'];
				if($name!= $c->getName()){
					if(CategoryContact::nameExist( $this->_pdo,$name ))$this->_error[]='Cette catégorie existe déjà.';
				}
				if(empty($name))$this->_error[]='Le champs doit être renseigné.';
					
				if(empty($this->_error)){
					if($name!= $c->getName()){
						$c->setName($name);
					}
					header('location:'.Tools::create_url($this->_user,'contacts','listC'));
				}


			}
			$this->_smarty->assign('name', $name );
		}
	}
	protected function delC($get,$post){
		$cc = CategoryContact::load($this->_pdo, $get['action']);
		if($cc){
			$this->_title = 'Supprimer la catégorie '.$cc->getName();
			$this->_template =dirname(__FILE__).'/views/delC.tpl';
			$this->_smarty->assign('cat',$cc);
			$contactAssociés = $cc->selectContacts();
			$listContact = Contact::fetchAll($this->_pdo,$contactAssociés) ;
			// Contacts utilisés
			$array=array();
			foreach($listContact as $c){
				$array[]= ChampsContact::loadByContactAndIndestructible($this->_pdo,$c)->getVal();
			}
			$this->_smarty->assign('listContact',$array);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'contacts','listC'));
			}
			if(isset($post['submit'])){
				$cc->delete();
				header('location:'.Tools::create_url($this->_user,'contacts','listC'));
			}			

		}
	}

}
