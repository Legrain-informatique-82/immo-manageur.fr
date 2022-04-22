<?php /* Smarty version Smarty-3.0.6, created on 2012-07-19 09:43:52
         compiled from "/var/www/aptana/extra-immo/modules/terrain/modules/action/views/addLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12571413885007bab82f2e05-85274257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e812dc04471b7a30a57c1375c5371ecaa7dd93f' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/terrain/modules/action/views/addLink.tpl',
      1 => 1323155757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12571413885007bab82f2e05-85274257',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul>
	<li><a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','add',$_GET['action']);?>
">Ajouter
			une tâche</a></li>
</ul>
