<?php
class Module_Controller_acquereur implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		$this->_pdo = $_pdo;
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'acquereur/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'acquereur/model/requires.php':$this->_errorLoadModule[] = 'Le module "acquereur" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'rapprochement/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'rapprochement/model/requires.php':$this->_errorLoadModule[] = 'Le module "rapprochement" est manquant.';
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			// traitement
			if($_GET['page']=='see'){
				$m = Mandate::load($this->_pdo, $_GET['action']);
				// add hook
				$this->addHook('hook_acqTitle',dirname(__FILE__).'/views/seeTitle.tpl');
				$this->addHook('hook_acq',dirname(__FILE__).'/views/see.tpl');
				// liste des acq potentiels

				$listAcqPotentiels = Rapprochement::listAcqForMandate($this->_pdo, $m);

				$listRapprochement = BddRapprochement::loadByMandate($this->_pdo, $m);
				$numberVisite = BddRapprochement::countVisiteByMandate($this->_pdo, $m);
				$resteAVisite = BddRapprochement::resteAVisiteByMandate($this->_pdo, $m);

				/****************************************************************
				 * 				Smarty
				 ****************************************************************/
				$this->_smarty->assign('listAcqPotentiels',$listAcqPotentiels);
				$this->_smarty->assign('pdo',$this->_pdo);
				$this->_smarty->assign('numberVisite',$numberVisite);
				$this->_smarty->assign('resteAVisite',$resteAVisite);
				$this->_smarty->assign('listRapprochement',$listRapprochement);
				// Liste de tous les rapprochement pour un bien donné.


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
$objF = new Module_Controller_acquereur(  $this->_pdo,$smarty );