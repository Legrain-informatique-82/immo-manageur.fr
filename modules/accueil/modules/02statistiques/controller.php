<?php
class Module_Controller_statistiques implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct( $_pdo,$_smarty ){
		$this->_pdo = $_pdo;
		$this->_errorLoadModule = array();

		
		
		// Chargement des modules
        is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_type/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_type/model/requires.php':$this->_errorLoadModule[] = 'Le module "mandate_type" est manquant.';
        is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_features/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'mandate_features/model/requires.php':$this->_errorLoadModule[] = 'Le module "mandate_features" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'biens/model/requires.php':$this->_errorLoadModule[] = 'Le module "biens" est manquant.';
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'acquereur/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'acquereur/model/requires.php':$this->_errorLoadModule[] = 'Le module "acquereur" est manquant.';

        is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'statistiques/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'statistiques/model/requires.php':$this->_errorLoadModule[] = 'Le module "statistiques" est manquant.';

		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		
		if(empty($this->_errorLoadModule)){
			
			
 			$this->_smarty->assign('nbMandats',Statistiques::getNbMandatsByUser($this->_pdo,$this->_user, MandateType::load($this->_pdo, Constant::ID_ETAP_TO_SELL)));
 			$this->_smarty->assign('nbTerrains',Statistiques::getNbTerrainsByUser($this->_pdo,$this->_user, MandateType::load($this->_pdo, Constant::ID_ETAP_TO_SELL)));
 			
 			$this->_smarty->assign('nbAcq',Statistiques::getNbAcqByUser($this->_pdo,$this->_user));
 			
 			$this->_smarty->assign('nbRapprochement',Statistiques::getNbRapprochementByUser($this->_pdo,$this->_user));
 			$this->_smarty->assign('nbCompromis',Statistiques::getNbCompromisByUser($this->_pdo,$this->_user));
	

 			
			$this->addHook('hook_header',dirname(__FILE__).'/views/stats.tpl');
		}else{
			$this->_smarty->assign('errorLoadSousModule',$this->_errorLoadModule);
			$this->addHook('hook_header',dirname(__FILE__).'/views/errorLoadSousModule.tpl');
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
$objF = new Module_Controller_statistiques(  $this->_pdo,$smarty );



