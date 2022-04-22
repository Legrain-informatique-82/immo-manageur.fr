<?php
class Module_Controller_action implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		$this->_pdo = $_pdo;
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'action/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'action/model/requires.php':$this->_errorLoadModule[] = 'Le module "action" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php':$this->_errorLoadModule[] = 'Le module "biens" est manquant.';
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			if($_GET['page']=='see'){
				$listActions = array();
				// Select by mandate (pour le mandat)
				$l = Action::selectByTo($this->_pdo,User::load($this->_pdo,$_GET['action']),date('Y-m-d'));
				while($ll = Action::fetch($this->_pdo,$l)){
					if(!$ll->getDoDate())
					$listActions[] = $ll;
				}
				$this->_smarty->assign('listActions',$listActions);
				$this->addHook('hook_header',dirname(__FILE__).'/views/list.tpl');
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
$objF = new Module_Controller_action(  $this->_pdo,$smarty );


