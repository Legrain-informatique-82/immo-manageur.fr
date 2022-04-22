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
				//	            $this->_template = $this->getTplErrorViolationAccess();
				//				Log::create($this->_pdo,time(),"sector",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				//				$this->_addMenu('sector');
				//				$this->_title = 'Gestion des secteurs / villes';
			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){

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
		//		$this->_smarty->display('tpl_default/header.tpl');
		//		$this->_smarty->display( $this->_template );
		//		$this->_smarty->display('tpl_default/footer.tpl');
	}

	private function _addMainMenu(){
		//		var_dump($this->_user);
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}