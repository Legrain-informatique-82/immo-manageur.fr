<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 09:49:40
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/action/views/addLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:765517488541fd494921660-85561094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ded8492a97665215e9175c691987dc068efa809e' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/action/views/addLink.tpl',
      1 => 1411371773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '765517488541fd494921660-85561094',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

    <a class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','add',$_GET['action']);?>
"><i class="fa fa-plus-circle"></i> Ajouter une tâche</a>

