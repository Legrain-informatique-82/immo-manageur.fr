<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 10:03:32
         compiled from "/var/www/aptana/extra-immo/modules/export_site/views/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103503818251666e54246ba2-31467105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68c3d91d4181d286e1129b3feb8b5d5d8a727302' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export_site/views/messages.tpl',
      1 => 1327657037,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103503818251666e54246ba2-31467105',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

	<div id="blocMandate" class="bulle">
		<form action="" method="post">
	

<?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('variables')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value){
?>
	<?php if ($_smarty_tpl->getVariable('var')->value->getType()=='text'){?>
		<p><label for="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
</label><input type="text" name="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" id="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" value="<?php echo $_smarty_tpl->getVariable('var')->value->getValue();?>
"/></p>
		<?php }elseif($_smarty_tpl->getVariable('var')->value->getType()=='textarea'){?>
		<p><label for="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
</label><textarea name="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" id="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('var')->value->getValue();?>
</textarea></p>
		<?php }elseif($_smarty_tpl->getVariable('var')->value->getType()=='serialize'){?>
			<?php if ($_smarty_tpl->getVariable('var')->value->getExportName()=='TYPES_VENTE_LOCATION'){?>
			
			<?php $_smarty_tpl->tpl_vars['typesSelected'] = new Smarty_variable(unserialize($_smarty_tpl->getVariable('var')->value->getValue()), null, null);?>
				
					<h2><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
</h2>
					
					
					
					
					<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars['i']->first;
?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
						<p class="inlineBlock bulle">
						<label for="che_0">	<input 
						<?php if ($_smarty_tpl->getVariable('typesSelected')->value){?><?php if (array_key_exists(0,$_smarty_tpl->getVariable('typesSelected')->value)){?> checked="checked"<?php }?><?php }?>
						type="checkbox" name="che_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
[]" id="che_0" value="0" />
						<?php echo ucfirst(strtolower(Lang::TYPE_EXPORT_SITE_DEFAULT));?>
</label>
							
						</p>
					<?php }?>
						<p class="inlineBlock bulle">
							<label for="che_<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
"><input 
							<?php if ($_smarty_tpl->getVariable('typesSelected')->value){?><?php if (array_key_exists($_smarty_tpl->getVariable('i')->value->getIdMandateType(),$_smarty_tpl->getVariable('typesSelected')->value)){?> checked="checked"<?php }?><?php }?>
							type="checkbox" name="che_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
[]" id="che_<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
" value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
"/>
						<?php echo ucfirst(strtolower($_smarty_tpl->getVariable('i')->value->getName()));?>
</label>
						</p>
					<?php }} ?>
					
			<?php }?>
	<?php }?>
<?php }} ?>
<p><input type="submit" name="send" value="Valider"/> <input type="submit" name="cancel" value="Annuler"/></p>
		</form>
	</div>
</div>