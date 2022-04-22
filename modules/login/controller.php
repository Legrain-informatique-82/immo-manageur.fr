<?php


class Controller extends CoreController   {
	private $_smarty;
	private $_template;
	private $_error_dependance;


	public function __construct( $smarty){
		parent::__construct();

		$this->_smarty = $smarty;
		$this->_smarty->assign('login','1');
		$this->_template = dirname(__FILE__).'/views/connexion.tpl';
		$this->_error_dependance = false;
		if(!$this->include_model_required((String)dirname(__FILE__))){
			$this->_error_dependance = true;
			$this->_template = $this->getTplErrorLoadModule();



		}

	}
	public function addMeta($array = 'test'){
		$this->_smarty->assign('title','Se connecter');
	}
	private function _treatment(  $post,$get){
		// test
		//$test = User::load($this->_pdo,1);
		//echo sha1($test->getRegistration_date().'azerty'.$test->getRegistration_date());

		if(isset($post['login_send'])){
			$connexion = new Connection($this->_pdo,htmlspecialchars(addslashes($post['login_login']), ENT_QUOTES),htmlspecialchars(addslashes($post['login_password']), ENT_QUOTES));
			// verif du pseudo, du mdp
			if( ! $connexion->get_error()){

				header('location:'.$this->create_url($connexion->getUser(),$get['module'],$get['page'],$get['action']));
			}else{
				$this->_smarty->assign( 'error', $connexion->get_error());
			}
		}
		if(isset($get['page'])&&$get['page']=='disconnect'){
			Connection::disconnect();
			header('location:'.Constant::DEFAULT_URL);
		}

	}


	public function treatment( $post,$get){
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
		}
	}

	public function displayTpl( ){
		$this->_smarty->display('tpl_default/header.tpl');
		$this->_smarty->display( $this->_template );
		$this->_smarty->display('tpl_default/footer.tpl');
	}
}

