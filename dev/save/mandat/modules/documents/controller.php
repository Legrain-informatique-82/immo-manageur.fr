<?php
class Module_Controller_documents implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	private $_isCompromis;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		$this->_pdo = $_pdo;
		$this->_isCompromis=false;
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			if( (isset($_GET['page'] ) && $_GET['page']=='see' ) ){
				// Ajout du lien vers l'ajout d'une action
				// ça, ou utilisation d'un autre script permettant l'ajout de l'action.
				// Si le mandat est rapproché.
				$mandate = Mandate::load($this->_pdo,$_GET['action']);
				$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);

				//					var_dump($rapp);
				if($rapp!=null){
					$this->_isCompromis=  true;
				}

				// passage des differents documents
				$this->_smarty->assign('isCompromis',$this->_isCompromis);
				$this->addHook('hook_imp',dirname(__FILE__).'/views/links.tpl');
			}
		}
	}
	private function addHook($position,$tpl){
		$this->_hooks[$position][] = $tpl  ;
	}
	public function getHooks(){
		return $this->_hooks;
	}
}
// Appel du module
$objF = new Module_Controller_documents(  $this->_pdo,$smarty );
