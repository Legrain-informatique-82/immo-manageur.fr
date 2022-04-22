<?php /* Smarty version Smarty-3.0.6, created on 2012-10-17 08:58:24
         compiled from "/var/www/aptana/extra-immo/modules/notary/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153988710507e5710c2eb75-05547888%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e5b45ed3e8adf61e7875f334ba155e3508dc13d' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/notary/views/add.tpl',
      1 => 1320665587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153988710507e5710c2eb75-05547888',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_NOTARY_ADD_H1;?>
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
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['first']){?>
<ul class="contError">
	<?php }?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['last']){?>
</ul>
<?php }?> <?php }} ?> <?php }?>
<div id="blocNotary">
<form action="" method="post">
	<fieldset>
		<p>
			<label for="notary_add_name"><?php echo Lang::LABEL_NOTARY_ADD_NAME;?>
</label><input
				type="text" name="notary_add_name"
				value="<?php echo $_POST['notary_add_name'];?>
" id="notary_add_name" /> 
		</p>
		<p>
			<label for="notary_add_firstname"><?php echo Lang::LABEL_NOTARY_ADD_FISTNAME;?>
</label><input
				type="text" name="notary_add_firstname"
				value="<?php echo $_POST['notary_add_firstname'];?>
"
				id="notary_add_firstname" /> 
		</p>
		<p>
			<label for="notary_add_address"><?php echo Lang::LABEL_NOTARY_ADD_ADDRESS;?>
</label><input
				type="text" name="notary_add_address"
				value="<?php echo $_POST['notary_add_address'];?>
" id="notary_add_address" />
			
		</p>
		<p>
			<label for="notary_add_city"><?php echo Lang::LABEL_NOTARY_ADD_CITY;?>
</label><input
				type="text" name="notary_add_city"
				value="<?php echo $_POST['notary_add_city'];?>
" id="notary_add_city" /> 
		</p>
		<p>
			<label for="notary_add_zip_code"><?php echo Lang::LABEL_NOTARY_ADD_ZIP_CODE;?>
</label><input
				type="text" name="notary_add_zip_code"
				value="<?php echo $_POST['notary_add_zip_code'];?>
" id="notary_add_zip_code" />
			
		</p>
		<p>
			<label for="notary_add_phone"><?php echo Lang::LABEL_NOTARY_ADD_PHONE;?>
</label><input
				type="text" name="notary_add_phone"
				value="<?php echo $_POST['notary_add_phone'];?>
" id="notary_add_phone" /> 
		</p>
		<p>
			<label for="notary_add_mobil_phone"><?php echo Lang::LABEL_NOTARY_ADD_MOBIL_PHONE;?>
</label><input
				type="text" name="notary_add_mobil_phone"
				value="<?php echo $_POST['notary_add_mobil_phone'];?>
"
				id="notary_add_mobil_phone" /> 
		</p>
		<p>
			<label for="notary_add_job_phone"><?php echo Lang::LABEL_NOTARY_ADD_JOB_PHONE;?>
</label><input
				type="text" name="notary_add_job_phone"
				value="<?php echo $_POST['notary_add_job_phone'];?>
"
				id="notary_add_job_phone" /> 
		</p>
		<p>
			<label for="notary_add_fax"><?php echo Lang::LABEL_NOTARY_ADD_FAX;?>
</label><input
				type="text" name="notary_add_fax"
				value="<?php echo $_POST['notary_add_fax'];?>
" id="notary_add_fax" /> 
		</p>
		<p>
			<label for="notary_add_mail"><?php echo Lang::LABEL_NOTARY_ADD_MAIL;?>
</label><input
				type="text" name="notary_add_mail"
				value="<?php echo $_POST['notary_add_mail'];?>
" id="notary_add_mail" /> 
		</p>
		<p>
			<label for="notary_add_comments"> <?php echo Lang::LABEL_NOTARY_ADD_COMMENTS;?>
</label> <textarea
					cols="30" rows="10" name="notary_add_comments"
					id="notary_add_comments"><?php echo $_POST['notary_add_comments'];?>
</textarea>
			
		</p>
		<p>
			<input type="submit" name="notary_add_submit"
				value="<?php echo Lang::LABEL_SAVE;?>
">
		</p>
	</fieldset>
</form>
</div>
</div>