<?php
class Module_Controller_upload implements interfaceModuleController{
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
				require_once 'model/requires.php';
				// recup du mandat
				$m = Mandate::load($this->_pdo, $_GET['action']);
				$listUpload = BddUpload::loadByMandate($this->_pdo,$m);

				if(isset($_POST['sendDocForMandate'])){
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['newDoc'] );
					// Creer le repertoire s'il n'existe pas
					$chemU = Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'upload/'.$m->getIdMandate();
					if(!is_dir($chemU) ){
						mkdir($chemU,0777);
						chmod($chemU,0777);
					}
					$file->setCheminUpload( $chemU.'/' );
					if($file->goUpload(false,true)){
						$u = BddUpload::create($this->_pdo,$file->getNomFichier(), Tools::format_bytes(filesize($file->getFichier())),$m);
						Log::create($this->_pdo,time(),$_GET['module'],'Ajout du fichier '. $u->getName().' pour le mandat : '.$m->getNumberMandate(),$this->_user );
						header('location:'.Tools::create_url($this->_user,$_GET['module'],$_GET['page'],$_GET['action']));//
					}else{
						$this->_smarty->assign('errorUpload', $file->afficheError());
					}
				}
				if(isset($_POST['delDocument'])){
					$u = BddUpload::load($this->_pdo,$_POST['idDoc']);
					$name = $u->getName();
					if($u->delete()){
						// delete file
						unlink( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'upload/'.$m->getIdMandate().'/'.$name);
						Log::create($this->_pdo,time(),$_GET['module'],'suppression du fichier '.$u->getName().' pour le mandat : '.$m->getNumberMandate(),$this->_user );
						header('location:'.Tools::create_url($this->_user,$_GET['module'],$_GET['page'],$_GET['action']));
					}

				}
				$this->_smarty->assign('listUpload',$listUpload);
				$this->addHook('hook_files',dirname(__FILE__).'/views/upload.tpl');
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
$objF = new Module_Controller_upload(  $this->_pdo,$smarty );