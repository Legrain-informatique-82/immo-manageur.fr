<?php /* Smarty version Smarty-3.0.6, created on 2013-04-12 12:04:58
         compiled from "/var/www/aptana/extra-immo/modules/action/views/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2861540325167dc4a0beff0-05691543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b70c7f76a79058b900905286cc298db90a1f738' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/action/views/update.tpl',
      1 => 1323155935,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2861540325167dc4a0beff0-05691543',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Modifier la tâche</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<div id="blocAct" class="bulle">
<form action="" method="post">
	 <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
	<p>
		<label for="from">De : </label><select name="from" id="from"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('from')->value==$_smarty_tpl->getVariable('i')->value->getIdUser()){?> selected="selected" <?php }?>
					value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdUser();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
				<?php }} ?>
		</select> 
	</p>
	<?php }?>

	<p>
		<label for="to">Pour :</label> <select name="to" id="to"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('to')->value==$_smarty_tpl->getVariable('i')->value->getIdUser()){?> selected="selected" <?php }?>
					value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdUser();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
				<?php }} ?>
		</select> 
	</p>

	<p>
		<label for="mandate">Attribué à : </label> <select name="mandate" id="mandate">
				<option value="">Aucun mandat</option> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('mandate')->value==$_smarty_tpl->getVariable('i')->value->getIdMandate()){?> selected="selected"
					<?php }?> value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandate();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getNumberMandate();?>

					<?php echo $_smarty_tpl->getVariable('i')->value->getMandateType()->getName();?>
</option> <?php }} ?>
		</select>
	</p>


	<p>
		<label for="libel">Libelé :</label> <input type="text" name="libel" id="libel"
			value="<?php echo $_smarty_tpl->getVariable('libel')->value;?>
" /> 
	</p>
	<p>
		<label for="initDate">Date de début de l'action :</label> <input type="text"
			name="initDate" value="<?php echo $_smarty_tpl->getVariable('initDate')->value;?>
" id="initDate"
			class="dateTimepicker" /> 
	</p>
	<p>
		 <label for="comment">Détail : </label><textarea name="comment" id="comment"
				cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('comment')->value;?>
</textarea>
	</p>
	<p>
		<input type="submit" name="send" value="Valider" />
	</p>
</form>
</div>
</div>