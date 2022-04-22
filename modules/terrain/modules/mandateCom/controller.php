<?php
class Module_Controller_mandateCom implements interfaceModuleController {
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	public function __construct($_pdo, $_smarty) {
		$this -> _errorLoadModule = array();
		$this -> _pdo = $_pdo;
		$this -> _smarty = $_smarty;
		$this -> _user = User::unserialize($this -> _pdo, $_SESSION['user']);
		$this -> treatment();
	}

	private function treatment() {

		is_file(Constant::DEFAULT_MODULE_DIRECTORY . 'mandat/modules/mandateCom/model/requires.php') ?
		require_once Constant::DEFAULT_MODULE_DIRECTORY . 'mandat/modules/mandateCom/model/requires.php' : $this -> _errorLoadModule[] = 'Le module "mandateCom" est manquant.';

		if(empty($this -> _errorLoadModule)) {

			// prix par position :  $listPictureWithPosition

			//$this->_smarty->assign('listPictureWithPosition',$listPictureWithPosition);
			$m = Mandate::load($this -> _pdo, $_GET['action']);
			if($_GET['page'] == 'see') {
				// listOfDescription
				$this -> _smarty -> assign('elementMandateCom', MandateCom::loadByModule($this -> _pdo, $m));

				$this -> addHook('hook_see_mandateDescription', dirname(__FILE__) . '/views/see.tpl');
//				$this -> addHook('hook_elemMandateCom_see', dirname(__FILE__) . '/views/seeCom.tpl');

			}
			if($_GET['page'] == 'updateCom') {



				$elementMandateCom = MandateCom::loadByModule($this -> _pdo, $m);
				$this -> _smarty -> assign('elementMandateCom', $elementMandateCom);
				if(isset($_POST['cancel'])) {
					header('location:' . Tools::create_url($this -> _user, $_GET['module'], 'see', $_GET['action']));
				}
				if(isset($_POST['send'])) {
						
					if($elementMandateCom) {
							
						// update
						$elementMandateCom->setCom($_POST['com'],false );
						$elementMandateCom->setInfoVisite($_POST['infoVisite'],false );
						$elementMandateCom->setOtherCom($_POST['otherCom'],false );
						$elementMandateCom->update();
					} else {
						// create
						MandateCom::create($this -> _pdo,$m, $_POST['com'],$_POST['infoVisite'],$_POST['otherCom']) ;
					}
					// redirect
					header('location:' . Tools::create_url($this -> _user, $_GET['module'], 'see', $_GET['action']));
				}
				$this -> addHook('hook_updateMandateCom', dirname(__FILE__) . '/views/update.tpl');
			}

		}

	}

	private function addHook($position, $tpl) {
		$this -> _hooks[$position][] = $tpl;
	}

	public function getHooks() {
		return $this -> _hooks;
	}

}

// Appel du module
$objF = new Module_Controller_mandateCom($this -> _pdo, $smarty);
