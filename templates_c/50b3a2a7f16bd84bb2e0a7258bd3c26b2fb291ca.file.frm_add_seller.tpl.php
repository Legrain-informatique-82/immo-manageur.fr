<?php /* Smarty version Smarty-3.0.6, created on 2014-09-01 12:21:28
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/frm_add_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1861493977540448a8f107e6-49132585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50b3a2a7f16bd84bb2e0a7258bd3c26b2fb291ca' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/frm_add_seller.tpl',
      1 => 1409563148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1861493977540448a8f107e6-49132585',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_list_title"> <?php echo Lang::LABEL_SELLER_ADD_TITLE;?>
</label>
    <div class="col-sm-8">
    <select
		name="seller_add_list_title" id="seller_add_list_title" class="form-control"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
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
        </div>
</div>

    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_name"><?php echo Lang::LABEL_SELLER_ADD_NAME;?>
</label>
        <div class="col-sm-8">
        <input
		type="text" name="seller_add_name"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('nameSeller')->value;?>
<?php }?>"
		id="seller_add_name" class="form-control"/>
            </div>
</div>
        <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_firstname"><?php echo Lang::LABEL_SELLER_ADD_FIRSTNAME;?>
</label>
            <div class="col-sm-8">
            <input
		type="text" name="seller_add_firstname"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_firstname'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('firstnameSeller')->value;?>
<?php }?>"
		id="seller_add_firstname" class="form-control"/>
                </div>
</div>
            <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_address"><?php echo Lang::LABEL_SELLER_ADD_ADDRESS;?>
</label>
                <div class="col-sm-8">
                <input
		type="text" name="seller_add_address"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_address'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_address')->value;?>
<?php }?>"
		id="seller_add_address" class="form-control" /></div>
</div>

                <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_list_city"> <?php echo Lang::LABEL_SELLER_ADD_CITY;?>
</label>
                    <div class="col-sm-8">
                    <select class="form-control"
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
                        </div>
</div>

                    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_phone"><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
</label>
                        <div class="col-sm-8">
                        <input class="form-control"
		type="text" name="seller_add_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_phone')->value;?>
<?php }?>"
		id="seller_add_phone" /> </div>
</div>
                        <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_mobil_phone"><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
</label>
                            <div class="col-sm-8">
                            <input class="form-control"
		type="text" name="seller_add_mobil_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_mobil_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_mobil_phone')->value;?>
<?php }?>"
		id="seller_add_mobil_phone" /> </div>
</div>
                            <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_work_phone"><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
</label>
                                <div class="col-sm-8">
                                <input class="form-control"
		type="text" name="seller_add_work_phone"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_work_phone'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_work_phone')->value;?>
<?php }?>"
		id="seller_add_work_phone" /> </div>
</div>
                                <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_fax"><?php echo Lang::LABEL_SELLER_ADD_FAX;?>
</label>
                                    <div class="col-sm-8">
                                    <input class="form-control"
		type="text" name="seller_add_fax"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_fax'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_fax')->value;?>
<?php }?>"
		id="seller_add_fax" /> </div>
</div>
                                    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_email"><?php echo Lang::LABEL_SELLER_ADD_EMAIL;?>
</label>
                                        <div class="col-sm-8">
                                        <input class="form-control"
		type="text" name="seller_add_email"
		value="<?php if ($_POST){?><?php echo $_POST['seller_add_email'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('seller_add_email')->value;?>
<?php }?>"
		id="seller_add_email" /> </div>
</div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
         <div class="checkbox">
            <label>
               <input type="checkbox" name="vitrine" id="vitrine" value="1" <?php if ($_POST['vitrine']==1||$_smarty_tpl->getVariable('vitrine')->value==1){?> checked="checked" <?php }?> /> Creer un compte client sur votre site vitrine.
            </label>
          </div>
    </div>
  </div>


