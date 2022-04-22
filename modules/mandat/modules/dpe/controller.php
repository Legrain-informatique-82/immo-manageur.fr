<?php
class Module_Controller_dpe implements interfaceModuleController{
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
			if( (isset($_GET['page'] ) && $_GET['page']=='see' ) ){
				// generation des images de dpe ...
				// sauf si ladite image existe
				$m = Mandate::load($this->_pdo, $_GET['action']);
				// on récupere les valeurs
				$valDpe = ValDpe::loadByMandate($this->_pdo,$m);

				if($valDpe!=null){

					require_once Constant::DEFAULT_MODULE_DIRECTORY.'/dpe/model/generateDpe.php';
					if($valDpe->getConsoEner()>0){
						$nameOfPictureCes = 'ces_'.$m->getIdMandate();
						GenerateDpe::generateCes($valDpe->getConsoEner(),$nameOfPictureCes);
						$this->_smarty->assign('ces',  Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'dpe/'.$nameOfPictureCes.'.png' );
					}
					else
					$this->_smarty->assign('ces',  false );
					if($valDpe->getEmissionGaz()>0){
						$nameOfPictureGes = 'ges_'.$m->getIdMandate();
						GenerateDpe::generateGes($valDpe->getEmissionGaz(),$nameOfPictureGes);
						$this->_smarty->assign('ges',  Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'dpe/'.$nameOfPictureGes.'.png' );
					}else
					$this->_smarty->assign('ges',  false );

					$this->addHook('hook_center',dirname(__FILE__).'/views/dpe.tpl');
				}
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
$objF = new Module_Controller_dpe(  $this->_pdo,$smarty );