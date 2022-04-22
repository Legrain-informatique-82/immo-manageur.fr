<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 12:44:18
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/addTc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:878464146507be90293a2d7-40936518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b72804dd344f6ee49c737a472ce1dfc3302fc5c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/addTc.tpl',
      1 => 1320742246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '878464146507be90293a2d7-40936518',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?> 
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<?php if (!empty($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
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
<div class="bulle" id="blocContact">

<form action="" method="post">
	<p>
		<label for="typeContact">Type de contact : </label> <input type="text"
			name="typeContact" id="typeContact" value="<?php echo $_smarty_tpl->getVariable('typeContact')->value;?>
" />
	
	
	<p>
		<input type="submit" value="<?php echo $_smarty_tpl->getVariable('labelBtn')->value;?>
" name="submitAddTc" /> <input
			type="submit" value="Annuler" name="cancelAddTc" />
	</p>
	</p>
</form>



</div>
</div>