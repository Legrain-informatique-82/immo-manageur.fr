<?php
class Module_Controller_export implements interfaceModuleController{
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
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'export/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'export/model/requires.php':$this->_errorLoadModule[] = 'Le module "export" est manquant.';

		if(empty($this->_errorLoadModule)){
			if(isset($_GET['page'])&&$_GET['page']=='updatePub'){
				$m = Mandate::load($this->_pdo, $_GET['action']);
					
				// Liste de toutes les photos, ajout de la position.
				$listPicture = $m->listPictures();
				$listPictureWithPosition = array();
				foreach($listPicture as $pi){
					$photoExportee = PhotosExports::loadByNameAndMandate($this->_pdo,$pi->getName(), $m );
					$tmp['idPhoto'] = $pi->getIdMandatePicture();
					$tmp['name'] = $pi->getName();
					$tmp['position'] = $photoExportee?$photoExportee->getPosition():'';
					$tmp['positionList']= $photoExportee?$photoExportee->getPosition():'9999999';
					$tmp['idPhotoExportee'] = $photoExportee?$photoExportee->getIdPhotosExports():'';
					$listPictureWithPosition[] = $tmp;
				}
				$listPictureWithPosition = Tools::sort_by_key($listPictureWithPosition,'positionList');
				if(isset($_POST['valid'])){

					if($_POST['idPhoto']){
						$i=0;

						foreach($_POST['idPhoto'] as $idPhoto){
							$idPhotoExportee = $_POST['idPhotoExportee'][$i];
							$position = $_POST['position'][$i];
							$name =  $_POST['name'][$i];
							// Soit on update, soit on crée, soit un supprime....
							// si idPhotoExportee est vide mais que position est remplis, on crée la ligne
							if($idPhotoExportee==''&&$position!=''){
								PhotosExports::create($this->_pdo,$name,$position,$m);
							}elseif($idPhotoExportee!=''&&$position==''){
								// on loade la ligne pour la flinguer
								$tmp = PhotosExports::loadByNameAndMandate($this->_pdo,$name, $m );
								$tmp->delete();
							}elseif($idPhotoExportee!=''&&$position!=''){
								$tmp = PhotosExports::loadByNameAndMandate($this->_pdo,$name, $m );
								$tmp->setPosition($position );
							}

							$i++;
						}
					}
				}
				$this->_smarty->assign('listPictureWithPosition',$listPictureWithPosition);
				$this->addHook('hook_updatePhotosExport',dirname(__FILE__).'/views/updatePhotosExport.tpl');
			}

			if( (isset($_GET['page'] ) && $_GET['page']=='see' ) ){

				// recup du mandat
				$m = Mandate::load($this->_pdo, $_GET['action']);
				$listPasserelle = Passerelle::loadAllAsset($this->_pdo);

				// Chargement de toute les photos...
				foreach(PhotosExports::loadByMandate($this->_pdo,$m) as $pi){
					// On regarde que le fichier est bien présent
					if(!is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$_GET['module'].'/thumb/'.$pi->getName()   )){
						$pi->delete();
					}
				}
				$this->_smarty->assign('photosExportees',PhotosExports::loadByMandate($this->_pdo,$m));
				$this->addHook('hook_ExportsList',dirname(__FILE__).'/views/listPicturesExport.tpl');


				if(isset($_POST['goListExport'])){
					// si coché, on vérifie s'il est present dans la bdd. Si ce n'est pas le cas, on sauve
					// si pas coché, on tente de le supprimer dans la base
					$contentInPost = array();
					if(!empty($_POST['nomPasserelle'])){
							
						foreach($_POST['nomPasserelle'] as $p){
							$pp = Passerelle::load($this->_pdo, $p);
							$contentInPost[] = $pp;
							if(!$pp->isLinked($m)){
								LiasonPasserelleMandat::create($this->_pdo,$pp,$m);
								Log::create($this->_pdo,time(),'export','Ajout du mandat : '.$m->getNumberMandate().' dans la liste d\'export : '.$pp->getName(),$this->_user );
							}

						}
					}
					// supprimer toute les liasons, sauf celles dans le tableau ( $contentInPost ).
					//					var_dump( $contentInPost );
					LiasonPasserelleMandat::deleteByMandate($this->_pdo,$m,$contentInPost);
					//
				}
				$this->_smarty->assign('listPasserelle',$listPasserelle);
				$this->addHook('hook_site',dirname(__FILE__).'/views/addExport.tpl');
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
$objF = new Module_Controller_export(  $this->_pdo,$smarty );