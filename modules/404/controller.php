<?php

class Controller extends CoreController{
	private $_smarty;
	private $_template;
	public function __construct($smarty){
		$this->_smarty = $smarty;
		$this->_template = dirname(__FILE__).'/views/404.tpl';
	}
	public function addMeta($array ='404 File not found' ){
		return $array;
	}
	public function displayTpl( ){
		$this->_smarty->display($this->_template);
	}
	public function treatment( $post,$get){}


}


?>