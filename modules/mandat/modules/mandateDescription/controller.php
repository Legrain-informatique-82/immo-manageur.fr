<?php
class Module_Controller_mandateDescription implements interfaceModuleController {
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

		is_file(Constant::DEFAULT_MODULE_DIRECTORY . 'mandat/modules/mandateDescription/model/requires.php') ?
		require_once Constant::DEFAULT_MODULE_DIRECTORY . 'mandat/modules/mandateDescription/model/requires.php' : $this -> _errorLoadModule[] = 'Le module "mandateDescription" est manquant.';

		if(empty($this -> _errorLoadModule)) {

			// prix par position :  $listPictureWithPosition

			//$this->_smarty->assign('listPictureWithPosition',$listPictureWithPosition);
			$m = Mandate::load($this -> _pdo, $_GET['action']);
			if($_GET['page'] == 'see') {
				// listOfDescription
				$this -> _smarty -> assign('listOfDescription', MandateDescription::loadByMandate($this -> _pdo, $m));
				$this -> addHook('hook_see_mandateDescription', dirname(__FILE__) . '/views/see.tpl');
			}
			if($_GET['page'] == 'updateDescription') {
				$this -> _smarty -> assign('listOfDescription', MandateDescription::loadByMandate($this -> _pdo, $m));
				$this -> addHook('hook_updateMandateDescription', dirname(__FILE__) . '/views/update.tpl');

				if(isset($_POST['close'])){
					header('location:' . Tools::create_url($this -> _user, $_GET['module'], 'see', $_GET['action']));
				}

				if(isset($_POST['addNewLine'])) {
					$i = 0;

					foreach($_POST['id'] as $id) {
						if($id == '') {
							if($_POST['niveau'][$i] != '' && $_POST['piece'][$i] != '' && $_POST['surface'][$i] != '' && $_POST['carac'][$i])
							MandateDescription::create($this -> _pdo, $m, $_POST['niveau'][$i], $_POST['piece'][$i], $_POST['surface'][$i], $_POST['carac'][$i]);
						} else {
							$tmp = MandateDescription::load($this -> _pdo, $id);
							$tmp -> setNiveau($_POST['niveau'][$i], false);
							$tmp -> setPiece($_POST['piece'][$i], false);
							$tmp -> setSurface( str_replace(',','.',$_POST['surface'][$i] ), false);
							$tmp -> setCarac($_POST['carac'][$i], false);
							$tmp -> update();
							unset($tmp);
						}
						$i++;
					}
					// suppression des lignes cochées
					if($_POST['del']) {
							
						foreach($_POST['del'] as $id) {
							$tmp = MandateDescription::load($this -> _pdo, $id);
							$tmp -> delete();
							unset($tmp);
						}
					}
					header('location:' . Tools::create_url($this -> _user, $_GET['module'], $_GET['page'], $_GET['action']));
				}
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
$objF = new Module_Controller_mandateDescription($this -> _pdo, $smarty);
