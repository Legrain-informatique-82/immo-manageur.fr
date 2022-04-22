<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:47
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/export/views/addExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:878567101519f1c4f00ea44-58842587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08fa12d3e79ba83a7acc6d24834917736e7e411b' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/export/views/addExport.tpl',
      1 => 1369380362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '878567101519f1c4f00ea44-58842587',
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
 </label><input type="checkbox"
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
