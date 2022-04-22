<?php
class Module_Controller_documents implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		$this->_pdo = $_pdo;
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			$page = empty($_GET['page'])?'list':$_GET['page'];
			if( (isset($page ) && $page=='see' ) ){
				// Ajout du lien vers l'ajout d'une action
				// ça, ou utilisation d'un autre script permettant l'ajout de l'action.
				// passage des differents documents
				$this->addHook('hook_imp',dirname(__FILE__).'/views/links.tpl');
			}
		}
		if( $page=='list' ){

			$this->addHook('hook_left',dirname(__FILE__).'/views/genList.tpl');
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
$objF = new Module_Controller_documents(  $this->_pdo,$smarty );