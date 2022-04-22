<?php /* Smarty version Smarty-3.0.6, created on 2013-04-16 09:25:00
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/update_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2034838569516cfccc3755e7-32568957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78ff42d6425ddb62f7eb93a644477fc58ef32f01' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/update_seller.tpl',
      1 => 1320665097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2034838569516cfccc3755e7-32568957',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Modifier le vendeur</h1>
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<ul class="contError">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php }} ?>
	</ul>

	<?php }?>
	<div id="blocSeller" class="bulle">
<form action="" method="post">

 <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
	<p>
		<label for="seller_update_user"> Utilisateur : </label> <select name="seller_update_user"
			id="seller_update_user"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if (($_smarty_tpl->getVariable('item')->value->getIdUser()==$_smarty_tpl->getVariable('seller_update_user')->value&&!empty($_smarty_tpl->getVariable('seller_update_user',null,true,false)->value))||($_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('item')->value->getIdUser()&&empty($_smarty_tpl->getVariable('seller_update_user',null,true,false)->value))){?>
					selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>

					<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>

		</select> 
	</p>
	<?php }?>
	<p>
		<label for="seller_update_list_title"> <?php echo Lang::LABEL_SELLER_ADD_TITLE;?>
</label>
			<select name="seller_update_list_title" id="seller_update_list_title">
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('seller_update_list_title')->value==$_smarty_tpl->getVariable('item')->value->getIdSellerTitle()){?>
					selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSellerTitle();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getLibel();?>
</option>
				<?php }} ?>
		</select> 
	</p>

	<p>
		<label for="seller_update_name"><?php echo Lang::LABEL_SELLER_ADD_NAME;?>
</label><input
			type="text" name="seller_update_name" value="<?php echo $_smarty_tpl->getVariable('seller_update_name')->value;?>
"
			id="seller_update_name" /> 
	</p>
	<p>
		<label for="seller_update_firstname"><?php echo Lang::LABEL_SELLER_ADD_FIRSTNAME;?>
</label><input
			type="text" name="seller_update_firstname"
			value="<?php echo $_smarty_tpl->getVariable('seller_update_firstname')->value;?>
" id="seller_update_firstname" /> 
	</p>
	<p>
		<label for="seller_update_address"><?php echo Lang::LABEL_SELLER_ADD_ADDRESS;?>
</label><input
			type="text" name="seller_update_address"
			value="<?php echo $_smarty_tpl->getVariable('seller_update_address')->value;?>
" id="seller_update_address" /> 
	</p>

	<p>
		<label for="seller_update_list_city"> <?php echo Lang::LABEL_SELLER_ADD_CITY;?>
</label> <select
			name="seller_update_list_city" id="seller_update_list_city"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('seller_update_list_city')->value==$_smarty_tpl->getVariable('item')->value->getIdCity()){?>
					selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdCity();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getZipCode();?>
 -
					<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
		</select> 
	</p>
	<p>
		<label for="seller_update_phone"><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
</label><input
			type="text" name="seller_update_phone" value="<?php echo $_smarty_tpl->getVariable('seller_update_phone')->value;?>
"
			id="seller_update_phone" /> 
	</p>
	<p>
		<label for="seller_update_mobil_phone"><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
</label><input
			type="text" name="seller_update_mobil_phone"
			value="<?php echo $_smarty_tpl->getVariable('seller_update_mobil_phone')->value;?>
" id="seller_update_mobil_phone" />
		
	</p>
	<p>
		<label for="seller_update_work_phone"><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
</label><input
			type="text" name="seller_update_work_phone"
			value="<?php echo $_smarty_tpl->getVariable('seller_update_work_phone')->value;?>
" id="seller_update_work_phone" />
		
	</p>
	<p>
		<label for="seller_update_fax"><?php echo Lang::LABEL_SELLER_ADD_FAX;?>
</label><input
			type="text" name="seller_update_fax" value="<?php echo $_smarty_tpl->getVariable('seller_update_fax')->value;?>
"
			id="seller_update_fax" /> 
	</p>
	<p>
		<label for="seller_update_email"><?php echo Lang::LABEL_SELLER_ADD_EMAIL;?>
</label><input
			type="text" name="seller_update_email" value="<?php echo $_smarty_tpl->getVariable('seller_update_email')->value;?>
"
			id="seller_update_email" /> 
	</p>
	<p>
		<label for="seller_update_comment"><?php echo Lang::LABEL_SELLER_ADD_COMMENT;?>
</label><textarea
				name="seller_update_comment" id="seller_update_comment" cols="30"
				rows="10"><?php echo $_smarty_tpl->getVariable('seller_update_comment')->value;?>
</textarea> 
	</p>
	<p>
		<input type="submit" value="<?php echo Lang::LABEL_SAVE;?>
"
			id="seller_update_submit_send" name="seller_update_submit_send" />
	</p>

</form>
</div>
</div>
