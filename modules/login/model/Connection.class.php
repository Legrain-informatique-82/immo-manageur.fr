<?php
/**
 *
 * @author julien
 * @var String $_error
 * @var Object $_pdo PDOObject
 * @method __construct($pdo,$login,$password)
 *
 */
class Connection{
	private $_error = false;
	private $obj_user;
	private $_pdo;
	private $_user;
	public function __construct(PDO $pdo,$login,$password){
		$this->_pdo = $pdo;
		if ($this->_isUser($login) ){
			// load user ($this->User() )
			$this->_user = User::loadByIdentifiant($this->_pdo,$login);

		 if($this->_isPassword($password) ){
		 	$this->_connexion();
		 }else{$this->_error = Lang::ERROR_BAD_PASSWORD; return false;}

		}else{$this->_error = Lang::ERROR_UNKNOW_LOGIN; return false;}
	}

	private function _isUser($login){
		return User::count($this->_pdo,"identifiant='$login'" )==0?false:true;
	}
	private function _isPassword($password){
		return sha1($this->_user->getRegistration_date().$password.$this->_user->getRegistration_date())==$this->_user->getPassword()?true:false;
	}
	public function get_error(){
		return $this->_error;
	}
	private function _connexion(){
		// add variable in session.
		// return true or false.
		$_SESSION['login']=true;
		$_SESSION['user'] = $this->_user->serialize();
		// prend 2 valeurs; repli ou depli
		$_SESSION['etatMenuVertical'] ='repli';
		// Add in log (historic connexion)
		HistoricConnection::create($this->_pdo,time(),$_SERVER["REMOTE_ADDR"],$this->_user);
	}
	public function getUser(){
		return $this->_user;
	}
	public static function disconnect(){
		return session_destroy();
	}
}