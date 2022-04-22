<?php /* Smarty version Smarty-3.0.6, created on 2013-07-23 11:38:51
         compiled from "/var/www/aptana/extra-immo/modules/sector/views/update_city.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138763860351ee4f2bb156a3-76126190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '462bc6281724a8f90ba7bbd89fe9cc23cfbc0b5c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/sector/views/update_city.tpl',
      1 => 1369380641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138763860351ee4f2bb156a3-76126190',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_CITY_UPDATE;?>
</h1>

<?php if ($_smarty_tpl->getVariable('error')->value){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["error"]['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["error"]['last'] = $_smarty_tpl->tpl_vars['item']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['error']['first']){?>
	<ul class="contError">
		<?php }?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['error']['last']){?>
	</ul>
	<?php }?> <?php }} ?> <?php }?>
	
<div class="bulle" id="blocCity">
<p>Ancien nom : <?php echo $_smarty_tpl->getVariable('oldCity')->value;?>
</p>
<form action="" method="post">
	
	<p>
		<label for="city_name"><?php echo Lang::LABEL_SECTOR_NAME;?>
</label><input type="text"
			value="<?php echo $_smarty_tpl->getVariable('city_name')->value;?>
" name="city_name" id="city_name" /> 
	</p>
	<p>
		<label for="zipCode"><?php echo Lang::LABEL_CITY_ADD_ZIP_CODE;?>
</label><input type="text"
			value="<?php echo $_smarty_tpl->getVariable('zipCode')->value;?>
" name="zipCode" id="zipCode" /> 
	</p>
	<p>
		<label for="idSector"><?php echo Lang::LABEL_CITY_ADD_SECTOR;?>
 </label><select
			name="idSector" id="idSector"> <?php  $_smarty_tpl->tpl_vars['sector'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfSector')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sector']->key => $_smarty_tpl->tpl_vars['sector']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('sector')->value->getIdSector()==$_smarty_tpl->getVariable('idSector')->value){?>selected="selected"<?php }?>
					value="<?php echo $_smarty_tpl->getVariable('sector')->value->getIdSector();?>
"><?php echo $_smarty_tpl->getVariable('sector')->value->getName();?>
</option>
				<?php }} ?>
		</select>
	</p>
	<p>
		<input type="hidden" name="oldSector" value="<?php echo $_smarty_tpl->getVariable('oldSector')->value;?>
" /> <input
			type="hidden" name="oldCity" value="<?php echo $_smarty_tpl->getVariable('oldCity')->value;?>
" /> <input
			type="hidden" name="id_city" value="<?php echo $_smarty_tpl->getVariable('id_city')->value;?>
" /> <input
			type="submit" name="send_city" value="<?php echo Lang::LABEL_UPDATE;?>
" /> <input
			type="submit" name="city_cancel" value="<?php echo Lang::LABEL_CANCEL;?>
" />
	</p>
</form>
</div>
</div>