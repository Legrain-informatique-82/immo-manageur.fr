<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 09:12:11
         compiled from "/var/www/aptana/immo-manageur.fr/modules/tpl_default/hook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15587447715379aecba66ac9-51493107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcb2a1e7cf3c3fa2addee84cf9ee780eafb5c74d' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/tpl_default/hook.tpl',
      1 => 1369380374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15587447715379aecba66ac9-51493107',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
 <?php if ($_smarty_tpl->getVariable('hook')->value[$_smarty_tpl->getVariable('position')->value]){?> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hook')->value[$_smarty_tpl->getVariable('position')->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?> <?php $_template = new Smarty_Internal_Template($_smarty_tpl->tpl_vars['i']->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?> <?php }} ?> <?php }?>
