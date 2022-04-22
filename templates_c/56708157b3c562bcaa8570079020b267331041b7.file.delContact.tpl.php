<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 16:02:06
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/delContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1704837086507d68de894568-54234737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56708157b3c562bcaa8570079020b267331041b7' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/delContact.tpl',
      1 => 1320742798,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1704837086507d68de894568-54234737',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="bulle">
<p>Êtes-vous sûr de vouloir supprimer ce contact ?</p>
<form action="" method="post">
	<p>
		<input type="submit" name="del" value="Supprimer" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
</div>