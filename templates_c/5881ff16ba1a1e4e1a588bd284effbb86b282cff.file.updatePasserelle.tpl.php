<?php /* Smarty version Smarty-3.0.6, created on 2013-02-04 15:54:58
         compiled from "/var/www/aptana/extra-immo/modules/export/views/updatePasserelle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160669568510fcbc2578a81-99245465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5881ff16ba1a1e4e1a588bd284effbb86b282cff' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export/views/updatePasserelle.tpl',
      1 => 1308581453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160669568510fcbc2578a81-99245465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post">
	<p>
		<label for="name">Nom : <input type="text" name="name" id="name"
			value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" /> </label>
	</p>
	<p>
		<label for="type">Type d'export : <input type="text" name="type"
			id="type" value="<?php echo $_smarty_tpl->getVariable('type')->value;?>
" /> </label>
	</p>
	<p>
		<label for="param">Paramètres : <textarea name="param" id="param"
				cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('param')->value;?>
</textarea> </label>
	</p>
	<p>
		<label for="asset">Active : <input type="checkbox" <?php if ($_smarty_tpl->getVariable('asset')->value==1){?> checked="checked" <?php }?> name="asset" id="asset" value="1" /> </label>
	</p>
	<p>
		<input type="submit" name="send" value="Modifier" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
