<?php /* Smarty version Smarty-3.0.6, created on 2012-11-12 14:24:00
         compiled from "/var/www/aptana/extra-immo/modules/action/views/list_libel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123801920850a0f8702eb2d7-76126099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd24a63811c788fef893210c8423a3c3b68b7bcad' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/action/views/list_libel.tpl',
      1 => 1320672786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123801920850a0f8702eb2d7-76126099',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<table class="standard">
	<thead>
		<tr>
			<th>Libellé</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listLibelAct')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getLibel();?>
</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'upd_libel',$_smarty_tpl->getVariable('i')->value->getIdLibelAction());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
			</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'del_libel',$_smarty_tpl->getVariable('i')->value->getIdLibelAction());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
			</td>

		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
