<?php
abstract class CoreController implements interfaceController{

	private $_mainMenu ;
	private $_modules_children;
	protected $defaultAction;
	protected $_pdo;
	protected $post ;
	protected $get;
	protected $useNewController;
    protected $css=array();
    protected $js=array();
    protected $moduleName='';



	public function __construct($smarty = 'null',$useNewController = false){
		$this->useNewController = $useNewController;
		$this->_modules_children = array();
			
		try {
			$this->_pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD,array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			));

		
			$this->_pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			$this->install();
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	/*
		if($this->useNewController){
			$this->post = $_POST;
			$this->get = $_GET;
			$this->useNewControllerController();
		}
		*/
	}
	/** 
	 * 
	 * Initialise le nouvaau controller. 
	 */
	protected function useNewControllerController(){
		if(empty($this->get['page']))$this->get['page']=$this->defaultAction;
		$method= $this->get['page'];
		var_dump($method);
		if(method_exists($this,$this->get['page']))
		$this->$method();
		else{
			$this->get404();
			echo 'aaa';
		}
	
	}
	

		protected function get404($h1=null,$message=null){
// 			header("Status : 404 Not Found");
// 			header('HTTP/1.0 404 Not Found');
// 			$this->assignVar('h1', $h1);
// 			$this->assignVar('message', $message);
// 			$this->_template = '404.tpl';
		}
	
	/**
	 *
	 * Permet l'installation du module ( bdd, tout ça)
	 */
	protected function install(){
	}
	/**
	 * Return URL
	 *
	 * @param String $module
	 * @param String $page
	 * @param String $action
	 * @return String $url
	 * @deprecated
	 */
	protected function create_url(User $user,$module=null,$page=null,$action=null){
		return Tools::create_url($user,$module,$page,$action);
	}

	/**
	 * This function return the mainMenu for this level.
	 * @param Int $level
	 * @return Array
	 */
	protected function getMainMenu( User $user){
		// appel de toogle menu vertical
		if($_SESSION['pageCourante'] != Tools::create_url($user,$_GET['module'],$_GET['page'],$_GET['action'])){
			$_SESSION['page-1'] = $_SESSION['pageCourante'];
			$_SESSION['pageCourante'] = Tools::create_url($user,$_GET['module'],$_GET['page'],$_GET['action']);
		}

		$level = $user->getLevelMember()->getIdLevelMember();
		if(isset($_SESSION['mainMenu']) ){
			$mainMenu = $_SESSION['mainMenu'];

		}else{
			$mainMenu =array();
				
			foreach (glob(dirname(__FILE__).'/../modules/*/menu.xml') as $filename) {
				$xml =  simplexml_load_file($filename);
				$modulName = $xml->attributes();
				foreach($xml->children() as $node){
					$attr = $node->attributes();
					if(($attr['principal']==1)&& ($level <= $node->level)&&($attr['visibility']=="1")){
						$array['url'] = Tools::create_url($user,$node->module,$node->page,$node->action);
						$array['module'] = (String)$node->module;
						$array['page'] = (String)$node->page;
						$array['action'] = (String)$node->action;
						$array['libelle'] = (String)$node->libelle;
						$array['short_libel'] = (String)$node->short_libel;
						// logo + chemin vers l'image
						$array['logo'] = (String)$node->logo ==''?'':Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.(String)$modulName.'/'.(String)$node->logo;
						$array['moduleName'] = (String)$modulName;
						$array['position']= (String)$this->_getPosition($modulName);
						$array['submenu']= $this->getMenu($user,$modulName);

						// array_push($mainMenu,$array);
						$mainMenu[]=$array;
					}
				}
			}
			$mainMenu = Tools::sort_by_key($mainMenu,'position');
			$_SESSION['mainMenu'] = $mainMenu ;
				
		}
		return $mainMenu;
	}

	/**
	 * This function return the mainMenu for this level.
	 * @param Int $level
	 * @return Array
	 */
	protected function getMenu( User $user, $module ){

		$level = $user->getLevelMember()->getIdLevelMember();
		$menu =array();
		foreach (glob(dirname(__FILE__).'/../modules/'.$module.'/menu.xml') as $filename) {
			$xml =  simplexml_load_file($filename);
			foreach($xml->children() as $node){
				$attr = $node->attributes();
				if(($attr['principal']!=1)&& ($level <= $node->level)&&($attr['visibility']=="1")){
					$array['url'] = Tools::create_url($user,$node->module,$node->page,$node->action);
					$array['libelle'] = (String)$node->libelle;
					$array['short_libel'] = (String)$node->short_libel;
						
					$array['module'] = (String)$node->module;
					$array['page'] = (String)$node->page;
					$array['action'] = (String)$node->action;
					// logo + chemin vers l'image
					$array['logo'] = (String)$node->logo ==''?'':Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.(String)$node->module.'/'.(String)$node->page.'/'.(String)$node->logo;
					array_push($menu,$array);
				}
			}
		}
		// Ajouter les liens des sous menus.

		return $menu;
	}

	protected function getLevelRequired($module=null,$page=null,$action =null){
		if(empty($module)||$module==null||$module=='')$module=Constant::DEFAULT_MODULE;
		foreach (glob(dirname(__FILE__).'/../modules/'.$module.'/menu.xml') as $filename) {
			$xml =  simplexml_load_file($filename);
			foreach($xml as $bloc){
				if(empty($bloc->action)||$bloc->action==null||$bloc->action=='')$bloc->action = 'test';
				if(empty($bloc->page)||$bloc->page==null||$bloc->page=='')$bloc->page = 'test';
				if(empty($page))$page = 'test';
				if($bloc->module==$module&&$bloc->page==$page){
					return $bloc->level;
				}
			}
		}
	}


	public function listModuleChildren(){
		return $this->_modules_children;
	}
	/**
	 * Return error template if error load module required.
	 * @return String
	 */
	protected function getTplErrorLoadModule(){
		return Constant::DEFAULT_MODULE_DIRECTORY.'tpl_default/errorLoadModule.tpl';
	}

	/**
	 * Return error template if error load module required.
	 * @return String
	 */
	protected function getTplErrorViolationAccess(){
		return Constant::DEFAULT_MODULE_DIRECTORY.'tpl_default/errorViolationAccess.tpl';
	}

	private function _getPosition($module){
		$error = false;
		$filename = Constant::DEFAULT_MODULE_DIRECTORY.$module.'/configuration.xml';
		$xml =  simplexml_load_file($filename);
		return $xml->position;
	}

	protected final function getInstallation($module){
		$error = false;
		$filename = Constant::DEFAULT_MODULE_DIRECTORY.$module.'/configuration.xml';
		$xml =  simplexml_load_file($filename);
		return (Int)$xml->install;
	}

	protected final function setInstallation($module,$etat){

		$filename = Constant::DEFAULT_MODULE_DIRECTORY.$module.'/configuration.xml';
		$xml =  simplexml_load_file($filename);
		$xml->install = $etat;
		$xml->asXML(Constant::DEFAULT_MODULE_DIRECTORY.$module.'/configuration.xml');

	}
	/**
	 * Inclu les fichiers dépendants (est récursif)
	 * @param String $module
	 * @return Bool
	 */
	protected function include_model_required( $module,$verif = array() ){
		$error = false;
		$filename = $module.'/configuration.xml';
		if(!is_dir($module)) return false;
		$xml =  simplexml_load_file($filename);

		foreach($xml->modules_required->module as $node){
			// verifie si le module n'a pas déjà été chargé, s'il est, on passe au module suivant.
			if(!in_array(  $node , $verif)){
				//Inclu les dépendances parentes...
				$verif[]=(String)$node;
				if(!$this->include_model_required( Constant::DEFAULT_MODULE_DIRECTORY.$node,$verif )){
					return false;
				}
				if(!is_dir($module.'/../'.$node))
				$error = true;
				else{
					foreach(glob($module.'/../'.$node.'/model/requires.php') as $model){
						if(!include_once($model)){
							$error = true;
						}
					}
				}
			}
		}
		return !$error;
	}
	protected function include_modules_Children( $module,$smarty){

		$ssmod = glob($module.'/modules/*');
		rsort($ssmod);
		foreach($ssmod as $elem ){

			if( is_file($elem.'/controller.php')){
				include_once  $elem.'/controller.php';
				if($objF->getHooks())
				$this->_modules_children = array_merge_recursive($objF->getHooks(),$this->_modules_children);
				unset($objF);
			}
		}
		$smarty->assign('hook' , $this->_modules_children );
	}

	private function toogleMenuVertical(){
		if(isset($_POST['toogleMenuVertical'])){
			$_SESSION['etatMenuVertical'] = $_SESSION['etatMenuVertical']=='repli'?'depli':'repli';
		}
	}
}
