<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 16:12:21
         compiled from "/var/www/aptana/extra-immo/modules/sector/views/add_city.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5746085065166c4c59644f4-37147657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '089b8e742f17431fabb6c815f37532661e0c9b47' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/sector/views/add_city.tpl',
      1 => 1320741321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5746085065166c4c59644f4-37147657',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_CITY_ADD;?>
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
<form action="" method="post">
	<p>
		<label for="city_add_name"><?php echo Lang::LABEL_CITY_ADD_NAME;?>
 </label><input
			type="text" value="<?php echo $_POST['city_add_name'];?>
" name="city_add_name"
			id="city_add_name" />
	</p>
	<p>
		<label for="zipCode"><?php echo Lang::LABEL_CITY_ADD_ZIP_CODE;?>
</label><input type="text"
			value="<?php echo $_POST['zipCode'];?>
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
				<option <?php if ($_smarty_tpl->getVariable('sector')->value->getIdSector()==$_POST['idSector']){?>selected="selected"<?php }?>
					value="<?php echo $_smarty_tpl->getVariable('sector')->value->getIdSector();?>
"><?php echo $_smarty_tpl->getVariable('sector')->value->getName();?>
</option>
				<?php }} ?>
		</select> 
	</p>
	<p>
		<input type="submit" value="<?php echo Lang::LABEL_SAVE;?>
"
			name="sector_add_city_send" id="sector_add_city_send" /> <input
			type="submit" value="<?php echo Lang::LABEL_CANCEL;?>
"
			name="sector_add_city_cancel" id="sector_add_city_cancel" />
	</p>


</form>
</div>
</div>