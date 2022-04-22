<?php
class Module_Controller_afficheMiniature implements interfaceModuleController{
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
			if( (isset($_GET['page'] ) && $_GET['page']=='list' ) || empty($_GET['page']) || (substr($_GET['page'],0,5)=='list_')){
				// Ajout du lien vers l'ajout d'une action
				// ça, ou utilisation d'un autre script permettant l'ajout de l'action.
				$this->addHook('hook_left',dirname(__FILE__).'/views/miniature.tpl');
				// Liste des actions
			}

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
$objF = new Module_Controller_afficheMiniature(  $this->_pdo,$smarty );