<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/action/views/addLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1726794427519f1c4ecc5ca3-92739980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c76ef7290e01aadb60f3cd2a1010bfefba7de6cd' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/action/views/addLink.tpl',
      1 => 1369380335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1726794427519f1c4ecc5ca3-92739980',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

	<li><a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','add',$_GET['action']);?>
">Ajouter
			une tâche</a></li>

