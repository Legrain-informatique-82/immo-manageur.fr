<?php /* Smarty version Smarty-3.0.6, created on 2014-05-16 14:47:45
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/frm_add_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1433216170537608f1a75c55-13648616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39b8d3ebb0a38734dd1ffeaec106a7ced5d8c9b4' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/frm_add_seller.tpl',
      1 => 1400244462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1433216170537608f1a75c55-13648616',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<p>
	<label for="seller_add_list_title"> <?php echo Lang::LABEL_SELLER_ADD_TITLE;?>
</label> <select
		name="seller_add_list_title" id="seller_add_list_title"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
			<option <?php if (($_POST['seller_add_list_title']==$_smarty_tpl->getVariable('item')->value->getIdSellerTitle()||$_smarty_tpl->getVariable('seller_add_list_title')->value==$_smarty_tpl->getVariable('item')->value->getIdSellerTitle())){?>
				selected="selected"
				<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSellerTitle();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getLibel();?>
</option>
			<?php }} ?>
	</select> 
</p>

<p>
	<label for="seller_add_name"><?php echo Lang::LABEL_SELLER_ADD_NAME;?>
</label><input
		type="text" name="seller_add_name"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('nameSeller')->value;?>
<?php }?>"
		id="seller_add_name" /> 
</p>
<p>
	<label for="seller_add_firstname"><?php echo Lang::LABEL_SELLER_ADD_FIRSTNAME;?>
</label><input
		type="text" name="seller_add_firstname"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_firstname'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('firstnameSeller')->value;?>
<?php }?>"
		id="seller_add_firstname" /> 
</p>
<p>
	<label for="seller_add_address"><?php echo Lang::LABEL_SELLER_ADD_ADDRESS;?>
</label><input
		type="text" name="seller_add_address"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_address'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_address')->value;?>
<?php }?>"
		id="seller_add_address" /> 
</p>

<p>
	<label for="seller_add_list_city"> <?php echo Lang::LABEL_SELLER_ADD_CITY;?>
</label> <select
		name="seller_add_list_city" id="seller_add_list_city"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
			<option <?php if (($_POST['seller_add_list_city']==$_smarty_tpl->getVariable('item')->value->getIdCity())||($_smarty_tpl->getVariable('seller_add_list_city')->value==$_smarty_tpl->getVariable('item')->value->getIdCity())){?>
				selected="selected"
				<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdCity();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getZipCode();?>
 -
				<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
	</select> 
</p>
<p>
	<label for="seller_add_phone"><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
</label><input
		type="text" name="seller_add_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_phone')->value;?>
<?php }?>"
		id="seller_add_phone" /> 
</p>
<p>
	<label for="seller_add_mobil_phone"><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
</label><input
		type="text" name="seller_add_mobil_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_mobil_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_mobil_phone')->value;?>
<?php }?>"
		id="seller_add_mobil_phone" /> 
</p>
<p>
	<label for="seller_add_work_phone"><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
</label><input
		type="text" name="seller_add_work_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_work_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_work_phone')->value;?>
<?php }?>"
		id="seller_add_work_phone" /> 
</p>
<p>
	<label for="seller_add_fax"><?php echo Lang::LABEL_SELLER_ADD_FAX;?>
</label><input
		type="text" name="seller_add_fax"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_fax'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_fax')->value;?>
<?php }?>"
		id="seller_add_fax" /> 
</p>
<p>
	<label for="seller_add_email"><?php echo Lang::LABEL_SELLER_ADD_EMAIL;?>
</label><input
		type="text" name="seller_add_email"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_email'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_email')->value;?>
<?php }?>"
		id="seller_add_email" /> 
</p>

<p>Creer un compte client sur votre site Immo manageur</p>