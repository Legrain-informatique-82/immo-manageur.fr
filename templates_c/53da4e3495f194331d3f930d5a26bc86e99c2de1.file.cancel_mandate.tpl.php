<?php /* Smarty version Smarty-3.0.6, created on 2013-04-12 11:52:40
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/cancel_mandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17371673325167d96892c771-87497993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53da4e3495f194331d3f930d5a26bc86e99c2de1' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/cancel_mandate.tpl',
      1 => 1308581455,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17371673325167d96892c771-87497993',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<form action="" method="post">

	<p>
		Nouvel Etat : <label for="newEtat"> <select name="newEtat"
			id="newEtat"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listEtap')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('newEtat')->value==$_smarty_tpl->getVariable('i')->value->getIdMandateEtap()){?> selected="selected"
					<?php }?> value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateEtap();?>
"><?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
				<?php }} ?>
		</select> </label>
	</p>
	<p>
		<label for="reason">Raison : <textarea name="reason" id="reason"
				cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('reason')->value;?>
</textarea> </label>
	</p>
	<p>
		<label for="disabledSellers">Rendre inactif les vendeurs n'ayant pas
			d'autres mandat associés : <input type="checkbox"
			name="disabledSellers" value="1" id="disabledSellers"
			<?php if ($_smarty_tpl->getVariable('disabledSellers')->value==1){?> checked="checked" <?php }?>/> </label>
	</p>
	<p>
		<input type="submit" value="Valider" name="valid" id="valid" /> <input
			type="submit" value="Annuler" name="cancel" id="cancel" />
	</p>

</form>
</div>
