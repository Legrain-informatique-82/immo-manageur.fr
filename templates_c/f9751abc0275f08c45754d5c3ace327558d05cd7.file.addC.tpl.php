<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 11:45:07
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/addC.tpl" */ ?>
<?php /*%%SmartyHeaderCode:641804954507d2ca3a04cf4-28693317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9751abc0275f08c45754d5c3ace327558d05cd7' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/addC.tpl',
      1 => 1350380706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '641804954507d2ca3a04cf4-28693317',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
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
<div class="bulle" id="blocContact">
<form action="" method="post">

<p><label for="name">Nom de la catégorie  </label><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
"/></p>
<p><input type="submit" value="Valider" name="go" /><input type="submit" value="Annuler" name="cancel" /></p>

</form>
</div>
</div>
