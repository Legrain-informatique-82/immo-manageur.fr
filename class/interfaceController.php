<?php
interface interfaceController
{
	public function __construct(  $smarty );
	public function addMeta(  );
	public function displayTpl( );
	public function treatment( $post,$get);


}
interface interfaceModuleController
{
	public function __construct( $_pdo ,$smarty );
	public function getHooks();
}




?>