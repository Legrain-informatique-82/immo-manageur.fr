<?php
class Module_Controller_documents implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	private $_isCompromis;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
        is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'documents/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'documents/model/requires.php':$this->_errorLoadModule[] = 'Le module "documents" est manquant.';
        $this->_pdo = $_pdo;
		$this->_isCompromis=false;
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){
			$page = empty($_GET['page'])?'list':$_GET['page'];
			if( (isset($page ) && $page=='see' ) ){
				// Ajout du lien vers l'ajout d'une action
				
				// Si le mandat est rapproché.
				$mandate = Mandate::load($this->_pdo,$_GET['action']);
				$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);

				if($rapp!=null){
					$this->_isCompromis=  true;
				}



                /**
                 * NOUVEAUX DOCUMENTS
                 */
                // récupèration des documents en fct du type de mandat, et tu type de bien
                $newDocs = Documents::loadAllByMandate($this->_pdo,$mandate);
//                $d = Documents::load($this->_pdo,1);

                /**
                 * FIN NOUVEAUX DOCUMENTS
                 */

                // passage des differents documents
                $this->_smarty->assign('newDocs',$newDocs);
                $this->_smarty->assign('arrayParametersLinks',array('idMandate'=>$mandate->getId()));
				$this->_smarty->assign('isCompromis',$this->_isCompromis);
				$this->addHook('hook_imp',dirname(__FILE__).'/views/links.tpl');
			}
		}


		if( $page=='list' ){
			$this->addHook('hook_leftList',dirname(__FILE__).'/views/genList.tpl');
		}
		
		// Si on clique sur imprimer fiche vide... ( + entrée dans le menu menu ).

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