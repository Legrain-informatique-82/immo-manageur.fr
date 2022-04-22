<?php /* Smarty version Smarty-3.0.6, created on 2013-04-15 12:53:37
         compiled from "/var/www/aptana/extra-immo/modules/acquereur/views/addT.tpl" */ ?>
<?php /*%%SmartyHeaderCode:882007049516bdc31da9293-34896833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '689d931a9457786453d8e1e45f25e76b723a0275' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/acquereur/views/addT.tpl',
      1 => 1320665945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '882007049516bdc31da9293-34896833',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Ajouter un titre d'acquereur</h1>
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
<form action="" method="post">

	<p class="bulle">
		<label for="name">Nom : <input type="text" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" name="name"
			id="name" /> </label>
	</p>
	<p>
		<input type="submit" name="send" value="Enregistrer" /> <input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
