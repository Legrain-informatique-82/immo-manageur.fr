<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 12:27:53
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/addContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55213969507be52929a4e3-30271659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17b5d6308b99ceff8ecace5ed24cc166574daf7e' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/addContact.tpl',
      1 => 1320742280,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55213969507be52929a4e3-30271659',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<ul class="contError">
		<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
	</ul>
	<?php }?> 
<div class="bulle" id="blocContact">
<form action="" method="post">

	
	
	<input type="hidden" name="userSelected" value="<?php echo $_smarty_tpl->getVariable('user')->value->getIdUser();?>
" />
	<p>
		<label for="name">Nom du contact : </label><input type="text"
			name="name" id="name" />
	</p>
	<p>
		<input type="submit" value="Ajouter" name="add" /><input type="submit"
			value="Annuler" name="cancel" />
	</p>

</form>
</div>
</div>