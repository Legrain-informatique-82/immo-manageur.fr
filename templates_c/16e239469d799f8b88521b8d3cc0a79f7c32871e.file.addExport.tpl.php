<?php /* Smarty version Smarty-3.0.6, created on 2012-07-19 09:43:52
         compiled from "/var/www/aptana/extra-immo/modules/terrain/modules/export/views/addExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5483323055007bab85b77b7-70546393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16e239469d799f8b88521b8d3cc0a79f7c32871e' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/terrain/modules/export/views/addExport.tpl',
      1 => 1320918103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5483323055007bab85b77b7-70546393',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="listPasserelleForExport">
	<form action="" method="post">
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
?>
		<p class="inlineBlock bulle">
			<label for="<?php echo $_smarty_tpl->getVariable('p')->value->getName();?>
"><?php echo $_smarty_tpl->getVariable('p')->value->getName();?>
</label> <input type="checkbox"
				<?php if ($_smarty_tpl->getVariable('p')->value->isLinked($_smarty_tpl->getVariable('mandate')->value)){?> checked="checked" <?php }?>
				name="nomPasserelle[]" value="<?php echo $_smarty_tpl->getVariable('p')->value->getIdPasserelle();?>
"
				id="<?php echo $_smarty_tpl->getVariable('p')->value->getName();?>
" /> 
		</p>
		<?php }} ?>
		<p>
			<input type="submit" name="goListExport" value="Valider" />
		</p>
	</form>
</div>
