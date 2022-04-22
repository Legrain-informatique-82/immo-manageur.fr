<?php
class Module_Controller_mandate implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		$this->_pdo = $_pdo;
		// inclusion ou erreurs
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php':$this->_errorLoadModule[] = 'Le module "biens" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_features/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_features/model/requires.php':$this->_errorLoadModule[] = 'Le module "mandate_feature" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_type/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_type/model/requires.php':$this->_errorLoadModule[] = 'Le module "mandate_type" est manquant.';
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			if( (isset($_GET['page'] ) && $_GET['page']=='sees' ) ){
				$listMandate = Mandate::listMandateBySeller($this->_pdo,Seller::load($this->_pdo,$_GET['action']));
				$this->_smarty->assign('listMandate',$listMandate);
				$this->addHook('hook_fin_corps_droite',dirname(__FILE__).'/views/list.tpl');
			}
		}else{
			$this->_smarty->assign('errorLoadSousModule',$this->_errorLoadModule);
			$this->addHook('hook_fin_corps_droite',dirname(__FILE__).'/views/errorLoadSousModule.tpl');
		}
	}
	private function addHook($position,$tpl){
		$this->_hooks[$position][] =  $tpl  ;
	}
	public function getHooks(){
		return $this->_hooks;
	}
}
// Appel du module
$objF = new Module_Controller_mandate(  $this->_pdo,$smarty );
