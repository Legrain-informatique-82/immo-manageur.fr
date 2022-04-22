<?php /* Smarty version Smarty-3.0.6, created on 2013-03-29 12:15:44
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/list_title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1455908670515577e078b208-78205267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f116db8d73beb8c4c05af9f4099c4dc124914f1b' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/list_title.tpl',
      1 => 1320313842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1455908670515577e078b208-78205267',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_SELLER_LIST_TITLE_H1;?>
</h1>

<table class="standard">
	<thead>
		<tr>
			<th>Titre</th>
			<th><?php echo Lang::LABEL_UPDATE;?>
</th>
			<th><?php echo Lang::LABEL_DELETE;?>
</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['libel'];?>
</td>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlUpdate'];?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
			<td><a class="jsdelTitleSeller" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['idSellerTitle'];?>
"
				href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a></td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
