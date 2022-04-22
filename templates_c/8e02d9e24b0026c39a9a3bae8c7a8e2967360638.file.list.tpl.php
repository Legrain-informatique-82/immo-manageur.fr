<?php /* Smarty version Smarty-3.0.6, created on 2013-04-15 09:09:30
         compiled from "/var/www/aptana/extra-immo/modules/mandate_features/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:866737034516ba7aa24e446-22579580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e02d9e24b0026c39a9a3bae8c7a8e2967360638' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandate_features/views/list.tpl',
      1 => 1325249981,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '866737034516ba7aa24e446-22579580',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Code</th>
			<th>Modifier</th>
			<th>Actif</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getCode();?>
</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_smarty_tpl->getVariable('page')->value,$_smarty_tpl->getVariable('i')->value->getId());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
			</td>
			<td><?php if ($_smarty_tpl->getVariable('i')->value->getIsDisabled()){?>Désactivé<?php }else{ ?>Activé<?php }?></td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>