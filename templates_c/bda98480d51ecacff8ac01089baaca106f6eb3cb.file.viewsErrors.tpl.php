<?php /* Smarty version Smarty-3.0.6, created on 2013-03-29 13:47:31
         compiled from "/var/www/aptana/extra-immo/modules/tpl_default/viewsErrors.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33849390251558d632c6e12-89075880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bda98480d51ecacff8ac01089baaca106f6eb3cb' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/tpl_default/viewsErrors.tpl',
      1 => 1308581470,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33849390251558d632c6e12-89075880',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="error">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
