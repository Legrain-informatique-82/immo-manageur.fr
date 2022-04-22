<?php

class Module_Controller_test implements interfaceModuleController{
	private $_smarty;
	public function __construct( $smarty ){
		$this->_smarty = $smarty;
	}
	public function addMeta($array = 'module test dans user'){
		return $array;
	}
	public function displayTpl( ){}
	public function treatment( $array){}


}
// Appel du module
$module = new Module_Controller_test( $this->_smarty );

?>