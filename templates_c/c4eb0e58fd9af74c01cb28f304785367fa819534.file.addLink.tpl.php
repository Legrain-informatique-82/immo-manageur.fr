<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 09:42:55
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/action/views/addLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1521388696541fd2ff1992f8-61120595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4eb0e58fd9af74c01cb28f304785367fa819534' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/action/views/addLink.tpl',
      1 => 1411371773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1521388696541fd2ff1992f8-61120595',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','add',$_GET['action']);?>
"><i class="fa fa-plus-circle"></i> Ajouter une tâche</a>