<?php /* Smarty version Smarty-3.0.6, created on 2013-04-15 09:12:48
         compiled from "/var/www/aptana/extra-immo/modules/mandate_features/views/add_update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:257482279516ba870ccc600-69095294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd77247f5903ddad76af9f75e3f55f180d83f5b9d' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandate_features/views/add_update.tpl',
      1 => 1320674479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '257482279516ba870ccc600-69095294',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
 :</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul>
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<div id="blocMandateFeadture" class="bulle">
<form action="" method="post">
	<p>
		<input type="hidden" name="idOpt" value="<?php echo $_smarty_tpl->getVariable('idOpt')->value;?>
" /> <input
			type="hidden" name="oldName" value="<?php echo $_smarty_tpl->getVariable('oldName')->value;?>
" /> <input
			type="hidden" name="oldCode" value="<?php echo $_smarty_tpl->getVariable('oldCode')->value;?>
" /> <label for="name"><?php echo $_smarty_tpl->getVariable('labelName')->value;?>

			:</label> <input type="text" name="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" id="name" /> 
	</p>
	<p>
		<label for="code"><?php echo $_smarty_tpl->getVariable('labelCode')->value;?>
 :</label> <input type="text" name="code"
			value="<?php echo $_smarty_tpl->getVariable('code')->value;?>
" id="code" /> 
	</p>
	<p>
		<label for="isDisabled">Actif ? </label><input type="checkbox"
			<?php if ($_smarty_tpl->getVariable('isDisabled')->value){?> checked="checked" <?php }?> name="isDisabled"
			id="isDisabled" value="1" /> 
	</p>
	<p>
		<input type="submit" name="valider" value="<?php echo Lang::LABEL_SAVE;?>
" />
	</p>
</form>
</div>
</div>