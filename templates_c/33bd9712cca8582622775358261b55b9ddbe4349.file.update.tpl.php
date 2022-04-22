<?php /* Smarty version Smarty-3.0.6, created on 2012-10-17 09:59:35
         compiled from "/var/www/aptana/extra-immo/modules/notary/views/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:282520069507e65675bed83-84473534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33bd9712cca8582622775358261b55b9ddbe4349' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/notary/views/update.tpl',
      1 => 1350460773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '282520069507e65675bed83-84473534',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_NOTARY_UPDATE_H1;?>
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
			<label for="notary_update_name"><?php echo Lang::LABEL_NOTARY_ADD_NAME;?>
</label><input
				type="text" name="notary_update_name" value="<?php echo $_smarty_tpl->getVariable('notary_update_name')->value;?>
"
				id="notary_update_name" /> 
		</p>
		<p>
			<label for="notary_update_firstname"><?php echo Lang::LABEL_NOTARY_ADD_FISTNAME;?>
</label><input
				type="text" name="notary_update_firstname"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_firstname')->value;?>
" id="notary_update_firstname" /> 
		</p>
		<p>
			<label for="notary_update_address"><?php echo Lang::LABEL_NOTARY_ADD_ADDRESS;?>
</label><input
				type="text" name="notary_update_address"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_address')->value;?>
" id="notary_update_address" /> 
		</p>
		<p>
			<label for="notary_update_zip_code"><?php echo Lang::LABEL_NOTARY_ADD_ZIP_CODE;?>
</label><input
				type="text" name="notary_update_zip_code"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_zip_code')->value;?>
" id="notary_update_zip_code" /> 
		</p>
		<p>
			<label for="notary_update_city"><?php echo Lang::LABEL_NOTARY_ADD_CITY;?>
</label><input
				type="text" name="notary_update_city" value="<?php echo $_smarty_tpl->getVariable('notary_update_city')->value;?>
"
				id="notary_update_city" /> 
		</p>
		
		<p>
			<label for="notary_update_phone"><?php echo Lang::LABEL_NOTARY_ADD_PHONE;?>
</label><input
				type="text" name="notary_update_phone"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_phone')->value;?>
" id="notary_update_phone" /> 
		</p>
		<p>
			<label for="notary_update_mobil_phone"><?php echo Lang::LABEL_NOTARY_ADD_MOBIL_PHONE;?>
</label><input
				type="text" name="notary_update_mobil_phone"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_mobil_phone')->value;?>
" id="notary_update_mobil_phone" />
			
		</p>
		<p>
			<label for="notary_update_job_phone"><?php echo Lang::LABEL_NOTARY_ADD_JOB_PHONE;?>
</label><input
				type="text" name="notary_update_job_phone"
				value="<?php echo $_smarty_tpl->getVariable('notary_update_job_phone')->value;?>
" id="notary_update_job_phone" /> 
		</p>
		<p>
			<label for="notary_update_fax"><?php echo Lang::LABEL_NOTARY_ADD_FAX;?>
</label><input
				type="text" name="notary_update_fax" value="<?php echo $_smarty_tpl->getVariable('notary_update_fax')->value;?>
"
				id="notary_update_fax" /> 
		</p>
		<p>
			<label for="notary_update_mail"><?php echo Lang::LABEL_NOTARY_ADD_MAIL;?>
</label><input
				type="text" name="notary_update_mail" value="<?php echo $_smarty_tpl->getVariable('notary_update_mail')->value;?>
"
				id="notary_update_mail" /> 
		</p>
		<p>
			<label for="notary_update_comments">
				<?php echo Lang::LABEL_NOTARY_ADD_COMMENTS;?>
</label> <textarea cols="30" rows="10"
					name="notary_update_comments" id="notary_update_comments"><?php echo $_smarty_tpl->getVariable('notary_update_comments')->value;?>
</textarea>
			
		</p>
		<p>
			<input type="submit" name="notary_update_submit"
				value="<?php echo Lang::LABEL_SAVE;?>
">
		</p>
	</fieldset>
</form>
</div>
</div>