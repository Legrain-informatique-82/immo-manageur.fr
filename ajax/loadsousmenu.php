<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../libs/smarty/Smarty.class.php';

require_once dirname(__FILE__).'/../modules/user/model/requires.php';
// $pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
// $user = User::unserialize($pdo, $_SESSION['user']);

class LoadSmenu extends CoreController{

	private $_smarty;
	private $_template;
	private $_error_dependance;
	private $_user;
	private $_title;
	private $_error;

	public function __construct($smarty){
		parent::__construct();
		// 		$this -> _smarty = $smarty;
		$this -> _user = User::unserialize($this -> _pdo, $_SESSION['user']);
	}
	public function addMeta(  ){
	}
	public function displayTpl( ){
	}
	public function treatment( $post,$get){
	}



	public  function getNewMenu( $module ){
		return $this-> getMenu($this -> _user, $module);

	}
}



// $oSmarty = new Smarty();
$lm = new LoadSmenu('sdqsdq') ;
$ssm =  $lm-> getNewMenu( $_GET['module'] );

//var_dump($ssm);
$return = '';
if($ssm){
	foreach( $ssm as $item) {
		
		$return.='<a href="'.$item['url'].'">';
		 if ($item['logo']){
		 	$return.='<img src="'.$item['logo'].'" title="'.$item['libelle'].'" />';
		 }
		 $return.='	 <span>';
		  if( empty($item['short_libel'])){
		  
		  $return.= $item['libelle'];
		  }
		  else{
		  	 $return.=$item['short_libel'];
		  }
		  $return.=' </span> </a>';
		 
	}
}
echo $return;