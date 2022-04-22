<?php /* Smarty version Smarty-3.0.6, created on 2013-04-12 12:08:02
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/add_title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1936610075167dd02dd4f76-32942302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '702f11764579393e28f4c26be06557e0c2c0d0db' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/add_title.tpl',
      1 => 1320664241,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1936610075167dd02dd4f76-32942302',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo lang::LABEL_SELLER_ADD_TITLE_h1;?>
</h1>
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
<form action="" method="post">
	<p class="bulle">
		<label for="seller_add_title_name"><?php echo lang::LABEL_SELLER_ADD_TITLE_NAME;?>
<input
			type="text" name="seller_add_title_name" id="seller_add_title_name">
		</label>
	</p>
	<p>
		<input type="submit" name="seller_add_title_submit"
			value="<?php echo lang::LABEL_SAVE;?>
">
	</p>
</form>
</div>
