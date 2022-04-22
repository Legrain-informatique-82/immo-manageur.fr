<?php /* Smarty version Smarty-3.0.6, created on 2013-10-30 11:45:20
         compiled from "/var/www/aptana/extra-immo/modules/user/views/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7192378205270e34069e477-44594208%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb57b2da738492e7934d48630476bb51caf6b3f6' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/user/views/update.tpl',
      1 => 1369380413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7192378205270e34069e477-44594208',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Modifier un utilisateur</h1>
<div id="blocUser">
	<?php if ($_smarty_tpl->getVariable('error')->value){?> <?php  $_smarty_tpl->tpl_vars["e"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["e"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["e"]->iteration=0;
 $_smarty_tpl->tpl_vars["e"]->index=-1;
if ($_smarty_tpl->tpl_vars["e"]->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["e"]->key => $_smarty_tpl->tpl_vars["e"]->value){
 $_smarty_tpl->tpl_vars["e"]->iteration++;
 $_smarty_tpl->tpl_vars["e"]->index++;
 $_smarty_tpl->tpl_vars["e"]->first = $_smarty_tpl->tpl_vars["e"]->index === 0;
 $_smarty_tpl->tpl_vars["e"]->last = $_smarty_tpl->tpl_vars["e"]->iteration === $_smarty_tpl->tpl_vars["e"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["ee"]['first'] = $_smarty_tpl->tpl_vars["e"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["ee"]['last'] = $_smarty_tpl->tpl_vars["e"]->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['ee']['first']){?>
	<ul class="contError">
		<?php }?>
		<li class="error"><?php echo $_smarty_tpl->getVariable('e')->value;?>
</li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['ee']['last']){?>
	</ul>
	<?php }?> <?php }} ?> <?php }?>

	<form action="" method="post">
		<fieldset>
			<legend>Identifiants :</legend>
			<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1){?>
			<p>
				<label for="user_update_identifiant"><?php echo Lang::LABEL_USER_ADD_IDENTIFIANT;?>
</label><input
					type="text" name="user_update_identifiant"
					id="user_update_identifiant" value="<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>
" />
				 <input type="hidden" name="user_update_old_identifiant"
					id="user_update_old_identifiant"
					value="<?php echo $_smarty_tpl->getVariable('user_update_old_identifiant')->value;?>
" />
			</p>
			<?php }else{ ?>
			<p><?php echo Lang::LABEL_USER_ADD_IDENTIFIANT;?>
<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>

			 <input type="hidden" name="user_update_identifiant"  value="<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>
" />
			 <input type="hidden" name="user_update_old_identifiant" id="user_update_old_identifiant" value="<?php echo $_smarty_tpl->getVariable('user_update_old_identifiant')->value;?>
" />
			</p>
			<?php }?>
			<p><?php echo Lang::LABEL_EDITO_PASSWORD;?>
</p>
			<p>
				<label for="user_update_password"><?php echo Lang::LABEL_USER_ADD_PASSWORD;?>
 </label> <input
					type="password" name="user_update_password"
					id="user_update_password" value="<?php echo $_smarty_tpl->getVariable('user_update_password')->value;?>
" />
			</p>
			<p>
				<label for="user_update_confirm_password"><?php echo Lang::LABEL_USER_ADD_CONFIRM_PASSWORD;?>
</label><input
					type="password" name="user_update_confirm_password"
					id="user_update_confirm_password"
					value="<?php echo $_smarty_tpl->getVariable('user_update_confirm_password')->value;?>
" /> 
			</p>
		</fieldset>
		<fieldset>
			<legend>Général :</legend>
			<p>
				<label for="user_update_name"><?php echo Lang::LABEL_USER_ADD_NAME;?>
</label><input
					type="text" name="user_update_name" id="user_update_name"
					value="<?php echo $_smarty_tpl->getVariable('user_update_name')->value;?>
" /> 
			</p>
			<p>
				<label for="user_update_firstname"><?php echo Lang::LABEL_USER_ADD_FIRSTNAME;?>
</label><input
					type="text" name="user_update_firstname" id="user_update_firstname"
					value="<?php echo $_smarty_tpl->getVariable('user_update_firstname')->value;?>
" /> 
			</p>
			<p>
				<label for="user_update_email"><?php echo Lang::LABEL_USER_ADD_EMAIL;?>
</label><input
					type="text" name="user_update_email" id="user_update_email"
					value="<?php echo $_smarty_tpl->getVariable('user_update_email')->value;?>
" /> 
			</p>

			 <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1){?>
			<p>
				<label for="user_update_agency"> <?php echo Lang::LABEL_USER_ADD_AGENCY_NAME;?>
</label>
					<select name="user_update_agency" id="user_update_agency"> <?php  $_smarty_tpl->tpl_vars["ag"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["ag"]->key => $_smarty_tpl->tpl_vars["ag"]->value){
?>
						<option <?php if ($_smarty_tpl->getVariable('ag')->value->getIdAgency()==$_smarty_tpl->getVariable('user_update_agency')->value){?>
							selected="selected" <?php }?>
							value="<?php echo $_smarty_tpl->getVariable('ag')->value->getIdAgency();?>
"><?php echo $_smarty_tpl->getVariable('ag')->value->getName();?>
</option> <?php }} ?>
				</select> 
			</p>
			<p>
				<label for="user_update_level"> <?php echo Lang::LABEL_USER_ADD_LEVEL;?>
</label> <select
					name="user_update_level" id="user_update_level"> <?php  $_smarty_tpl->tpl_vars["lv"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfLevel')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["lv"]->key => $_smarty_tpl->tpl_vars["lv"]->value){
?>
						<option <?php if ($_smarty_tpl->getVariable('lv')->value->getIdLevelMember()==$_smarty_tpl->getVariable('user_update_level')->value){?>
							selected="selected" <?php }?>
							value="<?php echo $_smarty_tpl->getVariable('lv')->value->getIdLevelMember();?>
"><?php echo $_smarty_tpl->getVariable('lv')->value->getName();?>
</option>
						<?php }} ?>
				</select> 
			</p>
			<?php }?>
			<p>
			<label for="theme">Thème : </label>
				<select name="theme" id="theme">
				<?php  $_smarty_tpl->tpl_vars['th'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfThemes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['th']->key => $_smarty_tpl->tpl_vars['th']->value){
?>
				
					<option <?php if ($_smarty_tpl->tpl_vars['th']->value==$_smarty_tpl->getVariable('user_update_theme')->value||($_smarty_tpl->getVariable('user_update_theme')->value==''&&$_smarty_tpl->tpl_vars['th']->value==Constant::THEME)){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['th']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['th']->value;?>
</option>
				<?php }} ?>
				</select>
			
			</p>
			<p><label for="user_openInNewTab">Ouverture des pages dans de nouveaux onglets :</label> <select name="user_openInNewTab" id="user_openInNewTab">
				<option value="0" <?php if ($_smarty_tpl->getVariable('user_openInNewTab')->value==0){?> selected="selected"<?php }?>>Non</option>
				<option value="1" <?php if ($_smarty_tpl->getVariable('user_openInNewTab')->value==1){?> selected="selected"<?php }?>>Oui</option>
			</select></p>
			
			<p>
				<input type="submit" value="<?php echo Lang::LABEL_USER_UPDATE_SUBMIT;?>
"
					id="user_update_submit" name="user_update_submit" />
			</p>
		</fieldset>


	</form>
</div>
</div>
