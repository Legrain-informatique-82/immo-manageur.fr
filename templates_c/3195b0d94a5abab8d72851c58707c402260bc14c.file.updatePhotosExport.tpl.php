<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 12:54:41
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/export/views/updatePhotosExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:710912184507d3cf18b6388-32270704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3195b0d94a5abab8d72851c58707c402260bc14c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/export/views/updatePhotosExport.tpl',
      1 => 1320399413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '710912184507d3cf18b6388-32270704',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Images exportées</h2>
<div class="bulle">
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPictureWithPosition')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
<p class="miniExport bulle">
	<img
		src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
"
		alt="" /> <input type="hidden" name="idPhoto[]" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['idPhoto'];?>
" />
	<input type="hidden" name="name[]" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
" /> <input
		type="hidden" name="idPhotoExportee[]" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['idPhotoExportee'];?>
" />
	<input type="text" name="position[]" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['position'];?>
" />
</p>
<?php }} ?>

<hr class="invi clear" />
</div>
